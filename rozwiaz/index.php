<?php
require '/virtual/itk.cba.pl/sincos/scripts/config.php';
/***************************************
/
/	Sinus cosinus - Patryk Kisielewski
/
/	Strona rozwiąż test
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

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

mysqli_set_charset($conn,"utf8");

$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM (SELECT test_id, test_name, subject_name, test_start, test_stop, test_rep, IF(ISNULL(solutions), 0, solutions), quest_type AS solutions, IF(ISNULL(contin), 0, contin) AS contin FROM SC_tests LEFT JOIN SC_subjects ON test_subj=subjectsID INNER JOIN SC_class_perm ON test_id=cp_test INNER JOIN SC_users ON cp_class=class LEFT JOIN (SELECT score_user, score_test, COUNT(score_id) AS solutions, IF(MIN(score_stop)='0000-00-00 00:00:00', 1, 0) AS contin FROM SC_score GROUP BY score_user, score_test) AS info ON usersID=score_user AND test_id=score_test INNER JOIN SC_quest ON test_base=quest_id WHERE usersID=".$userID." AND test_stop>'".$today."' UNION SELECT test_id, test_name, subject_name, test_start, test_stop, test_rep, IF(ISNULL(solutions), 0, solutions), quest_type AS solutions, IF(ISNULL(contin), 0, contin) AS contin FROM SC_tests LEFT JOIN SC_subjects ON test_subj=subjectsID INNER JOIN SC_school_perm ON test_id=sp_test INNER JOIN SC_users ON sp_school=school LEFT JOIN (SELECT score_user, score_test, COUNT(score_id) AS solutions, IF(MIN(score_stop)='0000-00-00 00:00:00', 1, 0) AS contin FROM SC_score GROUP BY score_user, score_test) AS info ON usersID=score_user AND test_id=score_test INNER JOIN SC_quest ON test_base=quest_id WHERE usersID=".$userID." AND test_stop>'".$today."' UNION SELECT test_id, test_name, subject_name, test_start, test_stop, test_rep, IF(ISNULL(solutions), 0, solutions), quest_type AS solutions, IF(ISNULL(contin), 0, contin) AS contin FROM SC_tests LEFT JOIN SC_subjects ON test_subj=subjectsID INNER JOIN SC_group_perm ON test_id=grp_test INNER JOIN SC_gr_user ON grp_group=group_id LEFT JOIN (SELECT score_user, score_test, COUNT(score_id) AS solutions, IF(MIN(score_stop)='0000-00-00 00:00:00', 1, 0) AS contin FROM SC_score GROUP BY score_user, score_test) AS info ON gruser=score_user AND test_id=score_test INNER JOIN SC_quest ON test_base=quest_id WHERE gruser=".$userID." AND test_stop>'".$today."' UNION SELECT test_id, test_name, subject_name, test_start, test_stop, test_rep, IF(ISNULL(solutions), 0, solutions), quest_type AS solutions, IF(ISNULL(contin), 0, contin) AS contin FROM SC_tests LEFT JOIN SC_subjects ON test_subj=subjectsID INNER JOIN SC_users_perm ON test_id=up_test LEFT JOIN (SELECT score_user, score_test, COUNT(score_id) AS solutions, IF(MIN(score_stop)='0000-00-00 00:00:00', 1, 0) AS contin FROM SC_score GROUP BY score_user, score_test) AS info ON up_user=score_user AND test_id=score_test INNER JOIN SC_quest ON test_base=quest_id WHERE up_user=".$userID." AND test_stop>'".$today."' UNION SELECT test_id, test_name, subject_name, test_start, test_stop, test_rep, IF(ISNULL(solutions), 0, solutions), quest_type AS solutions, IF(ISNULL(contin), 0, contin) AS contin FROM SC_tests LEFT JOIN SC_subjects ON test_subj=subjectsID INNER JOIN SC_glob_perm ON test_id=gp_test LEFT JOIN (SELECT score_test, COUNT(score_id) AS solutions, IF(MIN(score_stop)='0000-00-00 00:00:00', 1, 0) AS contin FROM SC_score WHERE score_user=".$userID." GROUP BY score_test) AS info ON test_id=score_test INNER JOIN SC_quest ON test_base=quest_id WHERE test_stop>'".$today."') AS data WHERE test_id=".$test.";";
$result = $conn->query($sql);

if($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	echo $row["quest_type"];
	//if($row["quest_type"] == 1){
		//echo "TAK";
		require $phplocal.'/scripts/tests/quiz.php';
	//}
} else {
	header('Location: '.$httplocal.'/start');
}

?>