<?php
$server = "localhost";
$user = "root";
$password = "";
$dbName = "PSOO";

// if server is not localhost
if ($_SERVER['SERVER_NAME'] != 'localhost') {
	$server = "sql310.epizy.com";
	$user = "epiz_33063653";
	$password = "WrDwdPq1yeo4Pzx";
	$dbName = "epiz_33063653_bimestral";
}


function newConnection()
{
	global $server, $user, $password, $dbName;
	$conn = new mysqli($server, $user, $password, $dbName);

	return $conn;
}

$conn = newConnection();
