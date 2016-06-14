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
var timer_newtest;
var licznik_pyt = 1;
var timer_pytanie;
var timer_progressbar_pytnie;
var progressbar_pytanie_poz = 0;

var dots = ["", ".", "..", "..."];

//NEW TEST WAIT
var nt_h = 0;
var nt_m = 0;
var nt_s = 20;

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
	var formDatax = new FormData();
	formDatax.append("test_id", "2");
	formDatax.append("status", "init");
	send_server(formDatax);
}
function send_server(data){
	var xmlhttp = new XMLHttpRequest();
	var url = "/sincos/test-resp/quiz-response.php";
	
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var myArr = JSON.parse(xmlhttp.responseText);
			response_server(myArr);
		}
	};
	xmlhttp.open("POST", url, true);
	xmlhttp.send(data);
}
function response_server(arr){
	console.log(arr);
	console.log(arr.error);
	if(!arr.error){
		if(arr.status == "new_test"){
			wait_new_test(arr.time);
		} else if(arr.status == "question"){
			document.getElementById("quiz-question").innerHTML = "Pytanie "+arr.questid;
			document.getElementsByClassName("quiz-round-number")[0].innerHTML = "1";
			document.getElementsByClassName("quiz-round-label")[0].innerHTML = "Runda";
			document.getElementsByClassName("quiz-counter-label")[0].innerHTML = "Do końca rundy:";
			document.getElementsByClassName("quiz-counter")[0].innerHTML = "10 s";
			document.getElementsByClassName("quiz-counter-label")[1].innerHTML = "Do końca pytania:";
			document.getElementsByClassName("quiz-counter")[1].innerHTML = "10 s";
			
			document.getElementById("box1").innerHTML=arr.b1;
			document.getElementById("box2").innerHTML=arr.b2;
			document.getElementById("button1").innerHTML = arr.p1;
			document.getElementById("button2").innerHTML = arr.p2;
			document.getElementById("button3").innerHTML = arr.p3;
			document.getElementById("button4").innerHTML = arr.p4;
			
			document.getElementById("button1").className = "quiz-button";
			document.getElementById("button2").className = "quiz-button";
			document.getElementById("button3").className = "quiz-button";
			document.getElementById("button4").className = "quiz-button";
			
			document.getElementById("button1").onclick = deaktywuj;
			document.getElementById("button2").onclick = deaktywuj;
			document.getElementById("button3").onclick = deaktywuj;
			document.getElementById("button4").onclick = deaktywuj;
			
			timer_progressbar_pytnie = setInterval(progress, arr.timeq/750);
			
		}
	}
}
function progress(){
	progressbar_pytanie_poz++;
	if(progressbar_pytanie_poz >= 750){
		clearInterval(timer_progressbar_pytnie);
		progressbar_pytanie_poz = 0;
		deaktywuj();
	}
	document.getElementsByClassName("quiz-progressbar-question")[0].style.width = progressbar_pytanie_poz+"px";
}
function deaktywuj(){
	document.getElementById("button1").className = "quiz-button inactive";
	document.getElementById("button2").className = "quiz-button inactive";
	document.getElementById("button3").className = "quiz-button inactive";
	document.getElementById("button4").className = "quiz-button inactive";
}
function wait_new_test(time){
	loading_stop();
	document.getElementById("quiz-question").textContent = "Oczekiwanie";
	document.getElementById("box2").innerHTML = 'Oczekiwanie na rozpoczęcie nowego testu: <div id="timer_newtest"></div>';
	time_nt();
	timer_newtest = setInterval(time_nt, 1000);
	setTimeout(pytanie, time);
}

function pytanie(){
	var formDatax = new FormData();
	formDatax.append("test_id", "1");
	formDatax.append("status", "question");
	formDatax.append("questid", licznik_pyt);
	send_server(formDatax);
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
	if(nt_h == 0 && nt_m == 0 && nt_s == 0){
		clearInterval(timer_newtest);
	}
}