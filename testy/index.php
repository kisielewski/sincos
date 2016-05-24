<?php
require '/virtual/itk.cba.pl/sincos/scripts/config.php';
/***************************************
/
/	Sinus cosinus - Patryk Kisielewski
/
/	Strona testy
/
***************************************/
require $phplocal.'/scripts/verification.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sinus cosinus - Testy</title>
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
			<h1 class="start-headline">Testy aktualne
				<a href="<?php echo $httplocal;?>/testy_zakonczone"><div class="start-bookmark">Testy zakończone</div></a>
				<a><div class="start-bookmark-open">Testy aktualne</div></a>
			</h1>
			<table class="start-table">
				<tr><th class="start-table-name">Nazwa</th><th class="start-table-date">Przedmiot</th><th class="start-table-date">Początek</th><th class="start-table-date">Koniec</th><th class="start-table-action">Akcja</th></tr>
<?php
	$conn = new mysqli($servername, $username, $password, $database);

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		mysqli_set_charset($conn,"utf8");
		
		$sql = "SELECT test_id, test_name, subject_name, test_start, test_stop FROM SC_tests LEFT JOIN SC_subjects ON test_subj=subjectsID";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '<tr><td class="start-table-name"><a href="'.$httplocal.'/info/'.$row["test_id"].'">'.$row["test_name"].'</a></td><td class="start-table-date">'.$row["subject_name"].'</td><td class="start-table-date">'.date("d-m-Y H:i", strtotime($row["test_start"])).'</td><td class="start-table-date">'.date("d-m-Y H:i", strtotime($row["test_stop"])).'</td><td class="start-table-action"><a href="'.$httplocal.'/info/'.$row["test_id"].'"><div class="start-table-button">Info</div></a><a><div class="start-table-button">Rozpocznij</div></a></td></tr>';
			}
		} else {
			echo '<tr><td class="start-table-name" colspan="5">Brak testów bieżących</td></tr>';
		}

				
?>				
				<!--<tr><td class="start-table-name"><a>Konkurs Sinus i cosunus</a></td><td class="start-table-date">Matematyka</td><td class="start-table-date">13-12-2015 20:15</td><td class="start-table-date">13-12-2015 23:15</td><td class="start-table-action"><a><div class="start-table-button" style="display: inline; padding: 0 7px;">Info</div></a><a><div class="start-table-button" style="display: inline; padding: 0 7px;">Rozpocznij</div></a></td></tr>-->
			</table>
		</div>
		<?php include $phplocal.'/scripts/footer.php';?>
	</body>
</html>