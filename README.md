sddDB
===
----------
**Kontribusi kecil** saya untuk [Solusi Dunia Digital](https://twitter.com/SolusiD)
. **PHP class untuk MySQLi**.

Persiapan
----
**Membuat definisi untuk Koneksi MySQL.**

Host		: **SQL_HOST**<br/>
Username	: **SQL_USER**<br/>
passwd		: **SQL_PASS**<br/>
dbname		: **SQL_DBNAME**

----

Memulai
----
Memanggil (instance) Class :

    $q = new sddDB();
    $q->apply("nama_tabel","kolom_primary_key"); // required

----

Metode 'readOne' dan 'readMany'
-----
Fungsi **readOne** digunakan untuk memanggil data tunggal.

    $q->readOne("primary_key"); // required

Fungsi **readOne** digunakan untuk memanggil data banyak.

    $q->readMany();

----

Metode 'delete'
-----
Fungsi ini digunakan menghapus data.

    $q->delete("primary_key"); // required

----

Metode 'update'
-----
Fungsi ini digunakan menghapus data.

    $q->update("primary_key"); // required

----

Metode 'create'
-----
**Peringatan!**

Dalam menggunakan metode ini, atribut *name* pada tag *input* **HARUS SAMA** dengan nama kolom (field) pada database.

	<?php
	if(isset($_GET['save'])) {
		$q->create();
	}
	?>

	<form action="?save" method="post">
		<input type="text" name="judul" value="sddDB: PHP Clas"/>
		<input type="text" name="pengarang" value="Anov Siradj a.k.a Mayendra Costanov"/>
		<input type="submit" value="simpan" />
	</form>

----

**Peringatan !**
===
>
>  Jangan memberi *attribute* ***name*** pada ***input/button*** dengan *type* ***submit***. Karena **Class** ini akan membuat Query **create** secara ***otomatis***.