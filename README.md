sdddb
=====

sdd database class mysqli extend

----------
Instance
----
    $q = new avzdb("host","user","pass","database");
    $q->setting("tableName","columnNameForKey");

-----
Read
-----

    $q->all();
    $q->one("primaryKey");

----------
Delete
-----
    $q->delete("primaryKey");

-----
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

----------


> **Warning !**
>
>  Jangan memberi *attribute* ***name*** pada ***input/button*** dengan tipe ***submit***. Karena class akan membuat query create secara ***otomatis***.