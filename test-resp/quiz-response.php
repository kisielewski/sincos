<?php
/***************************************
/
/	Sinus cosinus - Patryk Kisielewski
/
/	Quiz odpowiedzi serwera
/
***************************************/
header('Content-Type: application/json');
if($_POST["test_id"] == ""){
	die(json_encode(["error" => "No testID"]));
}
if($_POST["status"] == "init"){
	sleep(2);
	$tmp = ["status" => "new_test", "time" => 20000];
} elseif($_POST["status"] == "question"){
	if($_POST["questid"] == 1){
		$tmp = ["status" => "question", "questid" => 1, "timeq" => 3000, "timer" => 20000, "b1" => "sdfsd", "b2" => "sdff", "p1" => "sin(&alpha;)", "p2" => "cos(&alpha;)", "p3" => "tg(&alpha;)", "p4" => "ctg(&alpha;)"];
	} else {
		$tmp = ["error" => true];
	}
} else {
	$tmp = ["error" => true];
}
echo json_encode($tmp);
?>