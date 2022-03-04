<?php

$conn = "";

try {
	$servername = "ctoner28.lampt.eeecs.qub.ac.uk";
	$dbname = "ctoner28";
	$username = "ctoner28";
	$password = "rMdwfTm1mY6ZQHSR";

	$conn = new PDO(
		"mysql:host=$servername; dbname=ctoner28",
		$username, $password
	);
	
$conn->setAttribute(PDO::ATTR_ERRMODE,
					PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}

?>
