<?php

session_start();

$AJAX = array (
	'db_host'	 	=> '127.0.0.1',
	'db_username' 	=> 'root',
	'db_password' 	=> '',
	'db_name'		=> 'mapulsa'
);

$conn = new mysqli($AJAX['db_host'], $AJAX['db_username'], $AJAX['db_password'], $AJAX['db_name']);

if ($conn->connect_error){
	echo "Gagal terkoneksi ke database : (".$mysqli->connect_error.")".$mysqli->connect_error;
	
}

