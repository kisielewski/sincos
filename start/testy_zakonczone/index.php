<?php
require '/virtual/itk.cba.pl/sincos/scripts/config.php';
/***************************************
/
/	Sinus cosinus - Patryk Kisielewski
/
/	Strona testy zakończone
/
/
***************************************/
require $phplocal.'/scripts/verification.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sinus cosinus - Testy zakończone</title>
		<meta charset="UTF-8">
		<link rel="icon" href="<?php echo $httplocal;?>/images/favicon.ico" type="image/x-icon">
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
				<a href="<?php echo $httplocal;?>/konto" class="headline-navi-link"><?php echo $users_login;?></a>
			</div>
		</div>	
		<div class="main-container">
			<h1 class="start-headline">Testy zakończone
				<a><div class="start-bookmark-open">Testy zakończone</div></a>
				<a href="<?php echo $httplocal;?>/testy"><div class="start-bookmark">Testy aktualne</div></a>
			</h1>
			<table class="start-table">
				<tr><th class="start-table-name">Nazwa</th><th class="start-table-date">Początek</th><th class="start-table-date">Koniec</th><th class="start-table-action">Akcja</th></tr>
				<tr><td class="start-table-name"><a>Konkurs Sinus i cosunus</a></td><td class="start-table-date">13-12-2015 20:15</td><td class="start-table-date">13-12-2015 23:15</td><td class="start-table-action"><a><div class="start-table-button" style="display: inline; padding: 0 7px;">Info</div></a> <a><div class="start-table-button" style="display: inline; padding: 0 7px;">Mój wynik</div></a></td></tr>
			</table>
		</div>
		<div class="main-footer">&#x24D2 Patryk Kisielewski 2015 - 2016<br>
			Projekt wspierany przez KIMBI Projects</div>
	</body>
</html>