sdddb
=====

sdd database class mysqli extend

----------
Instance
----
    $q = new sddDB("host","user","pass","database");
    $q->setting("namaTabel","namaKolomDariPrimaryKey");

-----
Read
-----

    $q->semua();
    $q->satu("data_id");

----------
Delete
-----
    $q->delete("data_id");

-----
Create
-----
	<?php
	if(isset($_GET['save'])) {
		$q->insert();
	}
	?>
	
	<form action="?save" method="post">
		<input type="text" name="nama" value="lorem"/>
		<input type="text" name="id_sekolah" value="2222"/>
		<input type="submit" value="simpan" />
	</form>

> **Peringatan !**
>  Jangan memberi *attribute* *"**name**"* pada *"**input/button**"* dengan tipe *"**submit**"*. Karena class akan membuat query insert secara *"**otomatis**"*.