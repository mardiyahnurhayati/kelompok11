<?php

$host   = "localhost"; // nama server
$userdb = "root"; // user database
$passdb = ""; //password database
$namadb = "dbsekolah"; // nama database

// koneksi ke MySQL
$koneksi = mysql_connect($host, $userdb, $passdb);
if(!$koneksi) die("Gagal dalam Koneksi ke MySQL");
else {
	// memilih database
	mysql_select_db($namadb, $koneksi)
	
	//jika database tidak ditemukan
	or die("Database tidak ditemukan");
}