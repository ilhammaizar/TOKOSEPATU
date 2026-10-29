<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$dbHost = 'localhost';
$dbUser = 'root';
$dbPassword = '';
$databaseName = 'db_koneksi';

$db = new mysqli($dbHost, $dbUser, $dbPassword, $databaseName);
$db->set_charset('utf8mb4');
?>
