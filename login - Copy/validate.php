<?php
session_start(); 




include_once('connection.php');

function test_input($data) {
	
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if ($_SERVER["REQUEST_METHOD"]== "POST") {
	
	$adminname = test_input($_POST["adminName"]);
	$password = test_input($_POST["password"]);
	$stmt = $conn->prepare("SELECT * FROM adminLogin");
	$stmt->execute();
	$users = $stmt->fetchAll();
	
	foreach($users as $user) {
		
		if(($user['adminName'] == $adminname) &&
			($user['password'] == $password)) {
				$_SESSION['loggedin']=$adminname; 
				header("Location: adminPage.php");
		}
		else {
			echo "<script language='javascript'>";
			echo "alert('WRONG INFORMATION')";
			echo "</script>";
			die();
		}
	}
}

?>
