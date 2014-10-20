sddDB
===
----------
**Kontribusi kecil** Saya untuk [Solusi Dunia Digital](https://twitter.com/SolusiD)

PHP class untuk MySQLi.

Persiapan
----
Membuat definisi untuk Koneksi MySQL.

Host : **SQL_HOST**

Username : **SQL_USER**

passwd : **SQL_PASS**

dbname : **SQL_DBNAME**

----

Instance
----
    $q = new sddDB();
    $q->apply("nama_tabel","kolom_primary_key");

----

Read
-----
    $q->all();
    $q->one("primaryKey");

----

Delete
-----
    $q->delete("primaryKey");

----

Create
-----
	<?php
	if(isset($_GET['save'])) {
		$q->create();
	}
	?>

	<form action="?save" method="post">
		<input type="text" name="nama" value="lorem"/>
		<input type="text" name="id_sekolah" value="2222"/>
		<input type="submit" value="simpan" />
	</form>

	// input Attribute Name equal with Column Name !

----

> **Warning !**
>
>  Jangan memberi *attribute* ***name*** pada ***input/button*** dengan tipe ***submit***. Karena class akan membuat query create secara ***otomatis***.