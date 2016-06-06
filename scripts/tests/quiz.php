<?php
/***************************************
/
/	Sinus cosinus - Patryk Kisielewski
/
/	Test typu: Quiz
/
***************************************/
if(!isset($test)){
	exit('Error: No testID');
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sinus cosinus - Rozwiąż test</title>
		<meta charset="UTF-8">
		<link rel="shortcut icon" href="<?php echo $httplocal;?>/images/sincos.ico"/>
		<link rel="stylesheet" type="text/css" href="<?php echo $httplocal;?>/css/main.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $httplocal;?>/css/tests/quiz.css">
		<meta name="author" content="Patryk Kisielewski">
		<meta name="description" content="Platforma edukacyjna">
		<script src="<?php echo $httplocal;?>/js/test/quiz.js"></script>
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

		<div class="quiz-container">
			<div class="quiz-left-panel">
				<div id="box1" class="quiz-bigbox"></div>
			</div>
			<div class="quiz-right-panel">
				<div class="quiz-round-box">
					<div class="quiz-round-number"></div>
					<div class="quiz-round-label"></div>
				</div>
				<div class="quiz-counters-box">
					<div id="quiz-question" class="quiz-question"></div>
					<div class="quiz-counter-line">
						<div class="quiz-counter-label"></div>
						<div class="quiz-counter"></div>
					</div>
					<div class="quiz-counter-line">
						<div class="quiz-counter-label"></div>
						<div class="quiz-counter"></div>
					</div>
				</div>
				<div class="quiz-progressbar-round"></div>
				<div class="quiz-smallbox-div"><div id="box2" class="quiz-smallbox"></div></div>
				<div class="quiz-button-grid"><div class="quiz-button inactive"></div></div>
				<div class="quiz-button-grid quiz-button-grid-right"><div class="quiz-button inactive"></div></div>
				<div class="quiz-button-grid"><div class="quiz-button inactive"></div></div>
				<div class="quiz-button-grid quiz-button-grid-right"><div class="quiz-button inactive"></div></div>
			</div>
			<div class="quiz-progressbar-question-box">
				<div class="quiz-progressbar-question-bg"></div><div class="quiz-progressbar-question"></div>
			</div>
		</div>		
		<?php include $phplocal.'/scripts/footer.php';?>
	</body>
</html>		