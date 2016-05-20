<?php
// KONTO
require '/virtual/itk.cba.pl/sincos.itk.cba.pl/verification/index.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sinus cosinus - Konto</title>
		<meta charset="UTF-8">
		<link rel="icon" href="/images/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="/css/sincos.css">
	</head>
	<body>
		<div class="area-for-logo"></div>
		<div class="headline">
			<div class="headline-content">
				<a href="/"><img src="/logo/logo_sincos.png" class="headline-logo"/></a>
			<div class="user-menu">
					<div class="user-menu-head"><?php echo $users_login;?></div>
					<a href="/logout" class="user-menu-link"><div class="user-menu-content">Wyloguj</div></a>
					<a href="/konto" class="user-menu-link"><div class="user-menu-content">Konto</div></a>
				</div>
			</div>
		</div>
		<div class="headline-navi-bar-area">
			<div class="headline-navi-bar">
				<a href="/" class="headline-navi-link">strona główna</a> / 
				<a href="/start"  class="headline-navi-link">start</a> / 
				<a href="/testy"  class="headline-navi-link">testy</a> / 
				<a href="/konto" class="headline-navi-link"><?php echo $users_login;?></a>
			</div>
		</div>	
		<div class="main-container">
			<h1 class="start-headline">Konto</h1>
			<h2 class="article-title" id="o_projekcie">Login</h2>
			<p class="article-paragraph"><?php echo $users_log;?></p>
			<h2 class="article-title" id="o_projekcie">Imię</h2>
			<p class="article-paragraph"><?php if($users_name != 0) echo $users_name; else echo "---"; ?></p>
			<h2 class="article-title" id="o_projekcie">Nazwisko</h2>
			<p class="article-paragraph"><?php if($users_surname != 0) echo $users_surname; else echo "---"; ?></p>
			<h2 class="article-title" id="o_projekcie">Typ konta</h2>
			<p class="article-paragraph"><?php if($users_type == 1) echo "Uczeń"; else echo "---"; ?></p>
<?php
$servername = "localhost";
$username = "itkscdb";
$password = "21hasGUODTlo123";
$database = "itk_cba_pl";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

mysqli_set_charset($conn,"utf8");

$sql = "SELECT SC_schools.school_name, SC_schools.school_short, SC_class.class_name FROM SC_schools, SC_class, SC_users WHERE SC_users.usersID=".$userID." AND SC_users.school=SC_schools.schoolsID AND SC_class.classID=SC_users.class";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$school = $row["school_name"];
	$school_short = $row["school_short"];
	$class = $row["class_name"];
}
?>			
			<h2 class="article-title" id="o_projekcie">Szkoła</h2>
			<p class="article-paragraph"><?php echo $school." [".$school_short."]"; ?></p>
			<h2 class="article-title" id="o_projekcie">Klasa</h2>
			<p class="article-paragraph"><?php echo $class; ?></p>
			<h2 class="article-title" id="o_projekcie">Grupy</h2>
			<p class="article-paragraph">
<?php
$sql = "SELECT SC_groups.groups_name FROM SC_groups, SC_gr_user WHERE SC_gr_user.user=".$userID." AND SC_gr_user.group_id=SC_groups.groupsID";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
		echo $row["groups_name"].", ";
	}
} else {
	echo "---";
}
$conn->close();
?>
			</p>
		</div>
		<div class="main-footer">2015 - KIMBI Projects</div>		
	</body>
</html>