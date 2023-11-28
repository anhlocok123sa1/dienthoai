<?php
	$dsn = "mysql:host=localhost;dbname=dienthoai";
	$username = "root";
	$password = "";
	
	try {
		$dbh = new PDO($dsn, $username, $password);
		// echo "Connected to database: " . $dbh->query("SELECT DATABASE()")->fetchColumn() . "\n";
	} catch (PDOException $e) {
		// echo "Error: " . $e->getMessage() . "\n";
	}
?>
