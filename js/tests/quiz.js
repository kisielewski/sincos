/***************************************
/
/	Sinus cosinus - Patryk Kisielewski
/
/	JavaScript: Quiz
/
***************************************/
var loading_image //obrazek ładowania
var loading_timer;
var loading_dots = 0;

var dots = ["", ".", "..", "..."];

//NEW TEST WAIT
var nt_h = 0;
var nt_m = 10;
var nt_s = 0;

window.onload = function(){
	load_image();
	display_loading_img();
	loading_start();
	init_server();
}
function load_image(){
	loading_image = new Image(410, 163);
	loading_image.src = "/sincos/images/loading.gif";
	loading_image.title = "Ładowanie";
}
function display_loading_img(){
	var bigbox = document.getElementById("box1");
	bigbox.innerHTML = "";
	bigbox.className = "quiz-bigbox";
	bigbox.appendChild(loading_image);
}
function loading_start(){
	document.getElementById("quiz-question").className = "quiz-question loading";
	loading_change();
	loading_timer = setInterval(loading_change, 500);
}
function loading_change(){
	document.getElementById("quiz-question").textContent = "Ładowanie"+dots[loading_dots];
	loading_dots++;
	if(loading_dots > 3) loading_dots = 0;
}
function loading_stop(){
	clearInterval(loading_timer);
	var question = document.getElementById("quiz-question");
	question.className = "quiz-question";
	question.innerHTML = "";
}
function image(){
	loading_image.src ="/sincos/images/logo_sincos.png";
}
function init_server(){
	var xmlhttp = new XMLHttpRequest();
	var url = "/sincos/test-resp/quiz-response.php";

	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var myArr = JSON.parse(xmlhttp.responseText);
			response_server(myArr);
		}
	};
	xmlhttp.open("POST", url, true);
	xmlhttp.send();
}
function response_server(arr){
	if(arr.status == "create"){
		wait_new_test();
	}
}
function wait_new_test(){
	loading_stop();
	document.getElementById("quiz-question").textContent = "Oczekiwanie";
	document.getElementById("box2").innerHTML = 'Oczekiwanie na rozpoczęcie nowego testu: <div id="timer_newtest"></div>';
	time_nt();
	setInterval(time_nt, 1000);
}
function time_nt(){
	var cont;
	if(nt_h < 10){
		cont = "0"+nt_h;
	} else {
		cont = nt_h;
	}
	cont += ":";
	if(nt_m < 10){
		cont += "0"+nt_m;
	} else {
		cont += nt_m;
	}cont += ":";
	if(nt_s < 10){
		cont += "0"+nt_s;
	} else {
		cont += nt_s;
	}
	document.getElementById("timer_newtest").textContent = cont;
	nt_s--;
	if(nt_s < 0){
		nt_m--;
		nt_s += 60;
		if(nt_m < 0){
			nt_h--;
			nt_m += 60;
		}
	}
}