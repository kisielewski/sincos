<?php
require '/virtual/itk.cba.pl/sincos/scripts/config.php';
/***************************************
/
/	Sinus cosinus - Patryk Kisielewski
/
/	Strona informacje o teście
/
***************************************/
require $phplocal.'/scripts/verification.php';
if($_GET["id"] == ''){
	header('Location: '.$httplocal.'/start');
}
$tmp = intval($_GET["id"]);
if(is_int($tmp) & $tmp>=1){
	$test = $tmp;
}
if($tmp < 0){
	header('Location: '.$httplocal.'/start');
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sinus cosinus - Informacje o teście</title>
		<meta charset="UTF-8">
		<link rel="shortcut icon" href="<?php echo $httplocal;?>/images/sincos.ico"/>
		<link rel="stylesheet" type="text/css" href="<?php echo $httplocal;?>/css/main.css">
		<meta name="author" content="Patryk Kisielewski">
		<meta name="description" content="Platforma edukacyjna">
	</head>
	<body>
		<div class="area-for-logo"></div>
		<div class="headline">
			<div class="headline-content">
				<a href="<?php echo $httplocal;?>/"><img src="<?php echo $httplocal;?>/images/logo_sincos.png" class="headline-logo"/></a>
			<div class="user-menu">
					<div class="user-menu-head"><?php echo $users_login;?></div>
					<a href="<?php echo $httplocal;?>/logout" class="user-menu-link"><div class="user-menu-content">Wyloguj</div></a>
					<a href="<?php echo $httplocal;?>/konto" class="user-menu-link"><div class="user-menu-content">Konto</div></a>
				</div>
			</div>
		</div>
		<div class="headline-navi-bar-area">
			<div class="headline-navi-bar">
				<a href="<?php echo $httplocal;?>/" class="headline-navi-link">strona główna</a> / 
				<a href="<?php echo $httplocal;?>/start"  class="headline-navi-link">start</a> / 
				<a href="<?php echo $httplocal;?>/testy"  class="headline-navi-link">testy</a> / 
				<a href="<?php echo $httplocal;?>/konto" class="headline-navi-link"><?php echo $users_log;?></a>
			</div>
		</div>	
		<div class="main-container">
			<h1 class="start-headline">Informacje o teście</h1>
	<?php
	$conn = new mysqli($servername, $username, $password, $database);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	mysqli_set_charset($conn,"utf8");
	
	$sql = "SELECT test_name, test_desc, test_start, test_stop, test_dateadd, test_rep, subject_name, type_name, agree_name, name, surname, login FROM SC_tests LEFT JOIN SC_subjects ON test_subj=subjectsID INNER JOIN SC_quest ON test_base=quest_id INNER JOIN SC_types ON quest_type=type_id INNER JOIN SC_users ON test_add=usersID WHERE test_id=".$test;
	$result = $conn->query($sql);
	
	if($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		
		echo '<div class="info-record"><div class="info-label">Nazwa:</div><div class="info-content">'.$row["test_name"].'</div></div>';
		echo '<div class="info-record"><div class="info-label">Opis:</div><div class="info-content">'.$row["test_desc"].'</div></div>';
		echo '<div class="info-record"><div class="info-label">Przedmiot:</div><div class="info-content">'.$row["subject_name"].'</div></div>';
		echo '<div class="info-record"><div class="info-label">Data rozpoczęcia:</div><div class="info-content">'.date("d-m-Y H:i:s", strtotime($row["test_start"])).'</div></div>';
		echo '<div class="info-record"><div class="info-label">Data zakończenia:</div><div class="info-content">'.date("d-m-Y H:i:s", strtotime($row["test_stop"])).'</div></div>';
		echo '<div class="info-record"><div class="info-label">Typ testu:</div><div class="info-content">'.$row["type_name"].'</div></div>';
		echo '<div class="info-record"><div class="info-label">Ilość możliwych rozwiązań:</div><div class="info-content">';
		if($row["test_rep"] == 0){
			echo "brak ograniczeń";
		} else {
			echo $row["test_rep"];
		}
		echo '</div></div>';
		echo '<div class="info-record"><div class="info-label">Data dodania:</div><div class="info-content">'.date("d-m-Y H:i", strtotime($row["test_stop"])).'</div></div>';
		echo '<div class="info-record"><div class="info-label">Dodał:</div><div class="info-content">';
		if($row["agree_name"] == 1){
			echo $row["name"].' '.$row["surname"].' ['.$row["login"].']';
		} else {
			echo $row["login"].' ['.$row["login"].']';
		}
		echo '</div></div>';
	} else {
		header('Location: '.$httplocal.'/start');
	}
	?>
		</div>
		<?php include $phplocal.'/scripts/footer.php';?>
	</body>
</html>
