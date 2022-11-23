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

$conn = new PDO("mysql:host=$server;dbname=$dbName", $user, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
