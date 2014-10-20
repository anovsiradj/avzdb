<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class sddDB {
	private $sql;
	private $table;
	private $key;
	private $tb;
	private $tbk;
	private $cmd;
	private $field = "*";
	private $readtype;
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

	function watch() {
		return $this->cmd;
	}

	function update($x) {
		if (count($_POST) > 0) {
			$R = array();
			foreach($_POST as $k => $v) {
				$R[$k] = $this->sql->real_escape_string($_POST[$k]);
			}
			$s = "";
			foreach($R as $k => $v) {
				$s .= $k."='{$v}',";
			}
			$s = rtrim($s,",");
			$this->sql->query("UPDATE {$this->table} SET {$s} WHERE {$this->key}='{$x}'");
		}
	}
	function delete($x) {
		$this->sql->query("DELETE FROM {$this->table} WHERE {$this->key}='{$x}'");

	}

	function create() {
		if (count($_POST) > 0) {
			$R = array();
			foreach($_POST as $k => $v) {
				$R[$k] = $this->sql->real_escape_string($_POST[$k]);
			}
			$c = "";
			$s = "";
			foreach ($R as $k => $v) {
				$c .= "{$k},";
				$s .= "'{$v}',";
			}
			$c = rtrim($c,",");
			$s = rtrim($s,",");
			$this->sql->query("INSERT INTO {$this->table} ({$c}) VALUES ({$s})");
		}
	}
}
?>