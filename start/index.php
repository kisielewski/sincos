<?php
// START
require '/virtual/itk.cba.pl/sincos/scripts/config.php';
require $phplocal.'/verification/index.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sinus cosinus - Start</title>
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
				<a href="/"><img src="<?php echo $httplocal;?>/images/logo_sincos.png" class="headline-logo"/></a>
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
			<h1 class="start-headline">Start</h1>
			<div class="start-box">
				<a href="<?php echo $httplocal;?>/testy">
					<div class="start-box-icons">
						<div class="start-box-img" style="background-image: url('<?php echo $httplocal;?>/images/test_b.jpg');"></div>
						<div class="start-box-label">Testy aktualne</div>
					</div>
				</a>
				<a href="<?php echo $httplocal;?>/start/test_zakonczone">
					<div class="start-box-icons">
						<div class="start-box-img" style="background-image: url('<?php echo $httplocal;?>/images/test_z.jpg');"></div>
						<div class="start-box-label">Testy zakończone / wyniki</div>
					</div>
				</a>
			</div>
			<div class="start-box">
				<a href="<?php echo $httplocal;?>/konto">
					<div class="start-box-icons-red">
						<div class="start-box-img" style="background-image: url('<?php echo $httplocal;?>/images/konto.jpg');"></div>
						<div class="start-box-label-red">Konto</div>
					</div>
				</a>
			</div>
		</div>
		<div class="main-footer">&#x24D2 Patryk Kisielewski 2015 - 2016<br>
			Projekt wspierany przez KIMBI Projects</div>		
	</body>
</html>