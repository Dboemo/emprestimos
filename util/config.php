<?php

$databaseHost = 'localhost';
$databaseName = 'bdemprestimo';
$databaseUsername = 'root';
$databasePassword = '';

try {
	
	$dbConn = new PDO("mysql:host={$databaseHost};dbname={$databaseName}", $databaseUsername, $databasePassword);
	
	$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	
} catch(PDOException $e) {
	echo $e->getMessage();
}
 
?>