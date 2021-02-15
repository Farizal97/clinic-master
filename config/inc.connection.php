<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "hospital_db";

$koneksidb = mysql_connect($server,$user,$pass)or die("Gagal Koneksi".mysql_error());
if(!$koneksidb){
    echo "Failed Connection";
}

mysql_select_db($db)or die("Database Not Found".mysql_error());
?>