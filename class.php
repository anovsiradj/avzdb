<?php
class avzdb {
	private $sql;
	private $data = array();
	private $table;
	private $key;
	public $hasil = 0;
	function __construct($a,$b,$c,$d) {
		$this->sql = new mysqli($a,$b,$c,$d);
	}
	function setting($x,$y) {
		$this->table = $x;
		$this->key = $y;
	}
	function all() {
		$a = $this->sql->query("SELECT * FROM {$this->table}");
		$b = $a->num_rows;
		if ($b < 1) {
			$this->hasil = 0;
		} else {
			$this->hasil = 1;
			while ($d = $a->fetch_assoc()) {
				$this->data[] = $d;
			}
		}
	}
	function one($x) {
		$a = $this->sql->query("SELECT * FROM {$this->table} WHERE {$this->key}='{$x}'");
		$b = $a->num_rows;
		if ($b < 1) {
			$this->hasil = 0;
		} else {
			$this->hasil = 1;
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
	function result() {
		return $this->data;
	}
}
$q = new avzdb("localhost","user","pass","database");
$q->setting("tahun_ajaran","id"); // from example sql file

if (isset($_GET['simpan'])) {
	$q->create();
}

echo "<pre>\n";
?>

<form action="?simpan" method="post">
	<input type="text" name="nama" value="lorem" />
	<input type="text" name="id_sekolah" value="2222" />
	<input type="submit" value="simpan" />
</form>


<?php
$q->all();
print_r($q->display());
?>