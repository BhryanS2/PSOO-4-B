<?php
$server = "localhost";
$user = "root";
$password = "";
$dbName = "PSOO";

$conn = new PDO("mysql:host=$server;dbname=$dbName", $user, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
