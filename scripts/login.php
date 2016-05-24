<?php
require '/virtual/itk.cba.pl/sincos/scripts/config.php';
/***************************************
/
/	Sinus cosinus - Patryk Kisielewski
/
/	Skrypt logowania
/
***************************************/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if($_POST["login"] != "" && $_POST["passwd"] != ""){
		
		$login_text = htmlspecialchars($_POST["login"]);
		$passwd_text = htmlspecialchars($_POST["passwd"]);

		$conn = new mysqli($servername, $username, $password, $database);

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		mysqli_set_charset($conn,"utf8");
		
		$sql = "SELECT SC_passwd.password, SC_users.usersID FROM SC_passwd, SC_users WHERE SC_passwd.usersID=SC_users.usersID AND SC_users.login='".$login_text."'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$userID = $row["usersID"];
			if($row["password"] == $passwd_text){
				$token = md5(rand(200, getrandmax()));
				
				$sql = "SELECT * FROM SC_token WHERE usersID=".$userID;
				$result = $conn->query($sql);
				if($result->num_rows > 0){
					$sql = "UPDATE SC_token SET token='".$token."' WHERE usersID=".$userID;
				} else {
					$sql = "INSERT INTO SC_token (usersID, token) VALUES (".$userID.", '".$token."')";
				}
				$conn->query($sql);
				
				$sql = "UPDATE SC_users SET last_login_date='".date('Y-m-d H:i:s')."', last_login_ip='".$_SERVER['REMOTE_ADDR']."' WHERE usersID=".$userID.";";
				$conn->query($sql);
				
				session_start();
				$_SESSION["login_token"] = $token;
				
				header('Location: '.$httplocal.'/start');
				
			} else {
				$error_log = 1;
				$sql = "UPDATE SC_users SET wrong_login_date='".date('Y-m-d H:i:s')."', wrong_login_ip='".$_SERVER['REMOTE_ADDR']."' WHERE usersID=".$userID.";";
				$conn->query($sql);
			}
		} else {
			$error_log = 1;
		}
		$conn->close();

	} else {
		$error_log = 1;
	}
}
?>