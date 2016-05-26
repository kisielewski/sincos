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
$page = 1;
$tmp = intval($_GET["p"]);
if(is_int($tmp) & $tmp>1){
	$page = $tmp;
}
if($tmp < 0){
	header('Location: '.$httplocal.'/testy/1/');
}
$today = date('Y-m-d G:i:s');
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
				<a href="<?php echo $httplocal;?>/testy"><div class="start-bookmark-open">Testy aktualne</div></a>
			</h1>
			<table class="start-table">
				<tr><th class="start-table-name">Nazwa</th><th class="start-table-date">Przedmiot</th><th class="start-table-date">Początek</th><th class="start-table-date">Koniec</th><th class="start-table-action">Akcja</th></tr>
<?php
	$conn = new mysqli($servername, $username, $password, $database);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	mysqli_set_charset($conn,"utf8");
	
	$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM (SELECT test_id, test_name, subject_name, test_start, test_stop, test_dateadd, test_rep, IF(ISNULL(solutions), 0, solutions) AS solutions, IF(ISNULL(contin), 0, contin) AS contin FROM SC_tests LEFT JOIN SC_subjects ON test_subj=subjectsID INNER JOIN SC_class_perm ON test_id=cp_test INNER JOIN SC_users ON cp_class=class LEFT JOIN (SELECT score_user, score_test, COUNT(score_id) AS solutions, IF(MIN(score_stop)='0000-00-00 00:00:00', 1, 0) AS contin FROM SC_score GROUP BY score_user, score_test) AS info ON usersID=score_user AND test_id=score_test WHERE usersID=".$userID." AND test_stop>'".$today."' UNION SELECT test_id, test_name, subject_name, test_start, test_stop, test_dateadd, test_rep, IF(ISNULL(solutions), 0, solutions) AS solutions, IF(ISNULL(contin), 0, contin) AS contin FROM SC_tests LEFT JOIN SC_subjects ON test_subj=subjectsID INNER JOIN SC_school_perm ON test_id=sp_test INNER JOIN SC_users ON sp_school=school LEFT JOIN (SELECT score_user, score_test, COUNT(score_id) AS solutions, IF(MIN(score_stop)='0000-00-00 00:00:00', 1, 0) AS contin FROM SC_score GROUP BY score_user, score_test) AS info ON usersID=score_user AND test_id=score_test WHERE usersID=".$userID." AND test_stop>'".$today."' UNION SELECT test_id, test_name, subject_name, test_start, test_stop, test_dateadd, test_rep, IF(ISNULL(solutions), 0, solutions) AS solutions, IF(ISNULL(contin), 0, contin) AS contin FROM SC_tests LEFT JOIN SC_subjects ON test_subj=subjectsID INNER JOIN SC_group_perm ON test_id=grp_test INNER JOIN SC_gr_user ON grp_group=group_id LEFT JOIN (SELECT score_user, score_test, COUNT(score_id) AS solutions, IF(MIN(score_stop)='0000-00-00 00:00:00', 1, 0) AS contin FROM SC_score GROUP BY score_user, score_test) AS info ON gruser=score_user AND test_id=score_test WHERE gruser=".$userID." AND test_stop>'".$today."' UNION SELECT test_id, test_name, subject_name, test_start, test_stop, test_dateadd, test_rep, IF(ISNULL(solutions), 0, solutions) AS solutions, IF(ISNULL(contin), 0, contin) AS contin FROM SC_tests LEFT JOIN SC_subjects ON test_subj=subjectsID INNER JOIN SC_users_perm ON test_id=up_test LEFT JOIN (SELECT score_user, score_test, COUNT(score_id) AS solutions, IF(MIN(score_stop)='0000-00-00 00:00:00', 1, 0) AS contin FROM SC_score GROUP BY score_user, score_test) AS info ON up_user=score_user AND test_id=score_test WHERE up_user=".$userID." AND test_stop>'".$today."' UNION SELECT test_id, test_name, subject_name, test_start, test_stop, test_dateadd, test_rep, IF(ISNULL(solutions), 0, solutions) AS solutions, IF(ISNULL(contin), 0, contin) AS contin FROM SC_tests LEFT JOIN SC_subjects ON test_subj=subjectsID INNER JOIN SC_glob_perm ON test_id=gp_test LEFT JOIN (SELECT score_test, COUNT(score_id) AS solutions, IF(MIN(score_stop)='0000-00-00 00:00:00', 1, 0) AS contin FROM SC_score WHERE score_user=".$userID." GROUP BY score_test) AS info ON test_id=score_test WHERE test_stop>'".$today."') AS data ORDER BY test_dateadd DESC LIMIT ".(15*($page-1)).", 15;";
	$result = $conn->query($sql);
	
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo '<tr><td class="start-table-name"><a href="'.$httplocal.'/info/'.$row["test_id"].'">'.$row["test_name"].'</a></td><td class="start-table-date">'.$row["subject_name"].'</td><td class="start-table-date">'.date("d-m-Y H:i", strtotime($row["test_start"])).'</td><td class="start-table-date">'.date("d-m-Y H:i", strtotime($row["test_stop"])).'</td><td class="start-table-action"><a href="'.$httplocal.'/info/'.$row["test_id"].'"><div class="start-table-button">Info</div></a>';
			if($row["test_start"] < $today){
				if(($row["test_rep"] == 0) || ($row["test_rep"] > $row["solutions"])){
					if($row["contin"] == 0){
						echo '<a><div class="start-table-button" title="Rozwiąż nowy test">Rozpocznij</div></a>';
					} else {
						echo '<a><div class="start-table-button" title="Dokończ rozpoczęty test">Kontynuuj</div></a>';
					}
				} elseif($row["test_rep"] == $row["solutions"]){
					if($row["contin"] == 0){
						echo '<div class="start-table-button start-table-button-block" title="Już rozwiązałeś ten test">Rozpocznij</div>';
					} else {
						echo '<a><div class="start-table-button" title="Dokończ rozpoczęty test">Kontynuuj</div></a>';
					}
				} else {
					echo '<div class="start-table-button start-table-button-block" title="Już rozwiązałeś ten test">Rozpocznij</div>';
				}
			} else {
				echo '<div class="start-table-button start-table-button-block" title="Test jeszcze się nie rozpoczął">Rozpocznij</div>';
			}
			'<a><div class="start-table-button">'.$row["contin"].' Rozpocznij '.$row["solutions"].'</div></a></td></tr>';
		}
	} else {
		echo '<tr><td class="start-table-name" colspan="5">Brak testów bieżących</td></tr>';
	}
?>
			</table>
<?php
		$sql = "	SELECT FOUND_ROWS() AS how;";
		$result = $conn->query($sql);
		
		$res_count = 0;
		
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			$res_count = $row["how"];
		}
		
		$res_pages = ceil($res_count/15);
		
		if(($page > 1) && ($page > $res_pages)){
			header('Location: '.$httplocal.'/testy/'.$res_pages.'/');
		}
		
		if($res_pages > 1){
			echo '<div class="start-pages-box"><div class="start-pages-box-container">';
			
			$i_a = $page-3;
			if($i_a < 1){
				$i_a = 1;
			}
			if($i_a > 1){
				echo '<a href="'.$httplocal.'/testy/1/"><div class="start-pages-button">1</div></a>';
			}
			if($i_a > 2){
				echo '...';
			}
			for($i = $i_a; $i < $page; $i++){
				echo '<a href="'.$httplocal.'/testy/'.$i.'/"><div class="start-pages-button">'.$i.'</div></a>';
			}
			echo '<a href="'.$httplocal.'/testy/'.$page.'/"><div class="start-pages-button start-pages-button-active">'.$page.'</div></a>';
			
			$i_b = $page+3;
			if($i_b > $res_pages){
				$i_b = $res_pages;
			}
			for($i = $page+1; $i <= $i_b; $i++){
				echo '<a href="'.$httplocal.'/testy/'.$i.'/"><div class="start-pages-button">'.$i.'</div></a>';
			}		
			if($i_b < $res_pages-1){
				echo '...';
			}
			if($i_b < $res_pages){
				echo '<a href="'.$httplocal.'/testy/'.$res_pages.'/"><div class="start-pages-button">'.$res_pages.'</div></a>';
			}
			
			echo '</div></div>';
		}
		
		$conn->close();
?>
		</div>
		<?php include $phplocal.'/scripts/footer.php';?>
	</body>
</html>