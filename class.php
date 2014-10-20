<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class sddDB {
	private $sql;
	private $key;
	private $tb;
	private $tbk;
	private $cmd;
	private $field = "*";
	private $readtype;
	private $developtype;
	private $content = array();
	public $status = 0;

	function __construct() {}

	function apply($x,$y) {
		$this->sql = new mysqli(SQL_HOST,SQL_USER,SQL_PASS,SQL_DBNAME);
		$this->tb = $x;
		$this->tbk = $y;
	}

	function readOne($x) {
		$this->cmd = "SELECT {$this->field} FROM {$this->tb} WHERE {$this->tb}.{$this->tbk}='{$x}' LIMIT 1";
		$this->readtype = "one";
	}

	function readMany() {
		$this->cmd = "SELECT {$this->field} FROM {$this->tb}";
		$this->readtype = "many";
	}

	function readMany() {
		$this->cmd = "SELECT {$this->field} FROM {$this->tb}";
		$this->readtype = "many";
	}

	function build() {
		$x = $this->sql->query($this->cmd);
		$y = $x->num_rows;
		if($y < 1) {
			$this->status = 0;
		} else {
			$this->status = 1;
			switch($this->readtype) {
				case("one"):
				$this->content = $x->fetch_assoc();
				break;
				case("many"):
				while($z = $x->fetch_assoc()) {
					$this->content[]=$z;
				}
				break;
			}
		}
	}

	function watch() {
		return $this->cmd;
	}

	function develop() {
		
	}

	function update($x) {
		if (count($_POST) > 0) {
			$y = array();
			$z = "";
			foreach($_POST as $k => $v) {
				$y[$k] = $this->sql->real_escape_string($v);
			}
			foreach($y as $k => $v) {
				$z .= $k."='{$v}',";
			}
			$z = rtrim($z,",");
			$this->cmd = "UPDATE {$this->tb} SET {$z} WHERE {$this->tbk}='{$x}'";
			$this->developtype = "update";
		}
	}

	function delete($x) {
		$this->cmd = "DELETE FROM {$this->tb} WHERE {$this->tbk}='{$x}'";
		$this->developtype = "delete";

	}

	function create() {
		if (count($_POST) > 0) {
			$y = array();
			foreach($_POST as $k => $v) {
				$y[$k] = $this->sql->real_escape_string($v);
			}
			$a = "";
			$b = "";
			foreach ($y as $k => $v) {
				$a .= "{$k},";
				$b .= "'{$v}',";
			}
			$a = rtrim($a,",");
			$b = rtrim($b,",");
			$this->sql->query("INSERT INTO {$this->tb} ({$a}) VALUES ({$b})");
		}
	}
}
?>