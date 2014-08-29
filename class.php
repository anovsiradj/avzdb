<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class avzdb {
	private $sql;
	private $data = array();
	private $table;
	private $key;
	public $status = 0;
	function __construct($a,$b,$c,$d) {
		$this->sql = new mysqli($a,$b,$c,$d);
	}
	function setting($x,$y) {
		$this->table = $x;
		$this->key = $y;
	}
	function all($x = array()) {
		$l = "";
		if (count($x) > 0) {
			$e = false;
			foreach($x as $p){
				if(!is_numeric($p)){
					$e = true;
				}
			}
			if (!$e) {
				$y = implode(",", $x);
				$l = "limit {$y}";
			}
		}
		$a = $this->sql->query("SELECT * FROM {$this->table} {$l}");
		$b = $a->num_rows;
		if ($b < 1) {
			$this->status = 0;
		} else {
			$this->status = 1;
			while ($d = $a->fetch_assoc()) {
				$this->data[] = $d;
			}
		}
	}
	function one($x) {
		$a = $this->sql->query("SELECT * FROM {$this->table} WHERE {$this->key}='{$x}'");
		$b = $a->num_rows;
		if ($b < 1) {
			$this->status = 0;
		} else {
			$this->status = 1;
			$this->data = $a->fetch_assoc();
		}
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
	function display() {
		return $this->data;
	}
}
$q = new avzdb("localhost","root","sdd","sdd");
$q->setting("tahun_ajaran","id"); // from example sql file

echo "<pre>\n".$q->status."\n";

$q->all();

if ($q->status) {
	print_r($q->display());
} else {
	echo "NaN";
}

?>