<?php
require '/virtual/itk.cba.pl/sincos/scripts/config.php';
/***************************************
/
/	Sinus cosinus - Patryk Kisielewski
/
/	Skrypt logout
/
***************************************/
session_start();
if(isset($_SESSION["login_token"])){

	$conn = new mysqli($servername, $username, $password, $database);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	mysqli_set_charset($conn,"utf8");

	$sql = "SELECT usersID FROM SC_token WHERE token='".$_SESSION["login_token"]."'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$userID = $row["usersID"];
		$sql = "UPDATE SC_token SET token='0' WHERE usersID=".$userID;
		$result = $conn->query($sql);
	}
	$conn->close();

	session_unset(); 
	session_destroy(); 
}
header('Location: '.$httplocal);
?>