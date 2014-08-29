<?php
class sddDB extends mysqli {
	private $c;
	private $data = array();
	private $tb;
	private $key;
	public $hasil = 0;
	function __construct($a,$b,$c,$d) {
		$this->c = new mysqli($a,$b,$c,$d);
	}
	function setting($x,$y) {
		$this->tb = $x;
		$this->key = $y;
	}
	function semua() {
		$a = $this->c->query("SELECT * from {$this->tb}");
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
	function satu($x) {
		$a = $this->c->query("SELECT * from {$this->tb} where {$this->key}='{$x}'");
		$b = $a->num_rows;
		if ($b < 1) {
			$this->hasil = 0;
		} else {
			$this->hasil = 1;
			$this->data = $a->fetch_assoc();
		}
	}
	function edit($x) {
		if (count($_POST) > 0) {
			$R = array();
			foreach($_POST as $k => $v) {
				$R[$k] = $this->c->real_escape_string($_POST[$k]);
			}
			$s = "";
			foreach($R as $k => $v) {
				$s .= $k."='{$v}',";
			}
			$s = rtrim($s,",");
			$this->c->query("UPDATE {$this->tb} SET {$s} WHERE {$this->key}='{$x}'");
		}
	}
	function delete($x) {
		$this->c->query("DELETE FROM {$this->tb} WHERE {$this->key}='{$x}'");

	}
	function insert() {
		if (count($_POST) > 0) {
			$R = array();
			foreach($_POST as $k => $v) {
				$R[$k] = $this->c->real_escape_string($_POST[$k]);
			}
			$c = "";
			$s = "";
			foreach ($R as $k => $v) {
				$c .= "{$k},";
				$s .= "'{$v}',";
			}
			$c = rtrim($c,",");
			$s = rtrim($s,",");
			$this->c->query("INSERT INTO {$this->tb} ({$c}) VALUES ({$s})");
		}
	}
	function tampil() {
		return $this->data;
	}
}
$q = new sddDB("localhost","root","sdd","sdd");
$q->setting("tahun_ajaran","id");

if (isset($_GET['simpan'])) {
	$q->insert();
	$q->redirect("class.php");
}

echo "<pre>\n";
?>

<form action="?simpan" method="post">
	<input type="text" name="nama" value="lorem" />
	<input type="text" name="id_sekolah" value="2222" />
	<input type="submit" value="simpan" />
</form>



<?php
$q->semua();
print_r($q->tampil());
?>