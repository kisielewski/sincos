<?php
require '/virtual/itk.cba.pl/sincos/scripts/config.php';
/***************************************
/
/	Sinus cosinus - Patryk Kisielewski
/
/	Strona główna
/
***************************************/
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sinus cosinus - Strona główna</title>
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
<?php
if(isset($_SESSION["login_token"])){
	require $phplocal.'/scripts/verification.php';
?>	
				<div class="user-menu">
					<div class="user-menu-head"><?php echo $users_login;?></div>
					<a href="<?php echo $httplocal;?>/logout" class="user-menu-link"><div class="user-menu-content">Wyloguj</div></a>
					<a href="<?php echo $httplocal;?>/konto" class="user-menu-link"><div class="user-menu-content">Konto</div></a>
				</div>
<?php
}
?>
			</div>
		</div>
<?php
if(isset($_SESSION["login_token"])){
?>
		<div class="headline-navi-bar-area">
			<div class="headline-navi-bar">
				<a href="<?php echo $httplocal;?>/" class="headline-navi-link">strona główna</a> / 
				<a href="<?php echo $httplocal;?>/start"  class="headline-navi-link">start</a> / 
				<a href="<?php echo $httplocal;?>/testy"  class="headline-navi-link">testy</a> / 
				<a href="<?php echo $httplocal;?>/konto" class="headline-navi-link"><?php echo $users_log;?></a>
			</div>
		</div>
<?php
}
?>
		<div class='main-page-box-bg' style="background-image: url('<?php echo $httplocal;?>/images/main_page_bg.jpg');">
			<div class="main-page-box-bg-txt"></div>
			<div class="main-page-box-txt-area">
				<div class="main-page-box-txt">
					<div class="main-page-name-box">
						<div class="main-page-name-box-txt">Platforma<br>edukacyjna</div>
					</div>
<?php
if(!isset($_SESSION["login_token"])){
	$error_log = 0;
	require $phplocal.'/scripts/login.php';
?>
					<div class="main-page-login-area">
						<div class="main-page-login">
							<form method="post" action="./">
								  <span class="login-label">Login:</span><span id="error" class="login-error"><?php if($error_log == 1) echo "Błędny login lub hasło";?></span>
								  <input class="login-input<?php if($error_log == 1) echo " login-input-error"; ?>" type="text" name="login" value="<?php if(isset($_POST["login"])) echo $_POST["login"]; ?>">
								  <span class="login-label">Hasło:</span>
								  <input class="login-input<?php if($error_log == 1) echo " login-input-error"; ?>" type="password" name="passwd">
								  <input class="login-submit" type="submit" value="Zaloguj">
							</form>
						</div>
					</div>
<?php
} else {
?>
					<div class="welcome-box-area">
						<div class="welcome-box">
							Witaj,<br>
		
<?php
	echo $users_login."!";
?>
							<br>
							<a href="<?php echo $httplocal;?>/start"><div class="welcome-button">Przejdź do strony startowej</div></a>
						</div>
					</div>
<?php
}
?>
				</div>
			</div>
		</div>
		<div class="main-container">
			<h1 class="article-title" id="o_projekcie">O projekcie</h1>
			<p class="article-paragraph">Strona w trakcie budowy.<br>Strona domyślnie ma służyć do przeprowadzania testów i quizów.</p>
			<p class="article-paragraph">Masz pytania? Napisz e-mail: <a class="link" href="mailto:admin@itk.cba.pl">admin@itk.cba.pl</a></p>
			<img src="<?php echo $httplocal;?>/images/logo_itk.png" style="display: inline-block; margin: 30px 100px; vertical-align: middle;"/><img src="<?php echo $httplocal;?>/images/logo_kimbi.png" style="display: inline-block; margin: 30px 120px; vertical-align: middle;"/>
		</div>
		<div class="main-footer">&#x24D2 Patryk Kisielewski 2015 - 2016<br>
			Projekt wspierany przez KIMBI Projects</div>
	</body>
</html>