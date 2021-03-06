<?php
require '/virtual/itk.cba.pl/sincos/scripts/config.php';
/***************************************
/
/	Sinus cosinus - Patryk Kisielewski
/
/	Skrypt weryfikacji użytkownika
/
***************************************/
session_start();
if(isset($_SESSION["login_token"])){
	
	$conn = new mysqli($servername, $username, $password, $database);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	mysqli_set_charset($conn,"utf8");
	
	
	$sql = "SELECT SC_users.usersID, login, name, surname, type FROM SC_token, SC_users WHERE SC_token.usersID=SC_users.usersID AND token='".$_SESSION["login_token"]."'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$userID = $row["usersID"];
		$users_log = $row["login"];
		$users_name = $row["name"];
		$users_surname = $row["surname"];
		$users_type = $row["type"];
		if($row["name"] == "0"){
			$users_login = $row["login"];
		} else {
			$users_login = $row["name"];
		}
	} else {
		setcookie('loginpage', $_SERVER['REQUEST_URI'], time()+120, $httplocal);
		header('Location: '.$httplocal.'/logout');
		exit;
	}
	
	$conn->close();
} else {
	setcookie('loginpage', $_SERVER['REQUEST_URI'], time()+120, $httplocal);
	header('Location: '.$httplocal);
	exit;
}
?>