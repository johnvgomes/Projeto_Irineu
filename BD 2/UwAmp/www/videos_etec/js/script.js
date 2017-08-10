$(document).ready(function() {
	var day=['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado'],
	   month=['janeiro','fevereiro','março','abril','maio','junho','julho','agosto','setembro','outobro','novembro','dezembro'];
   SetData();
   function SetData() {
	   var now = new Date();
	   $('.date').html(day[now.getDay()]+', ');
           $('.date').append(now.getDate()+' de ');
	   $('.date').append(' '+month[now.getMonth()]+' de '); 
	   $('.date').append(now.getFullYear()+' &nbsp; - &nbsp;');
	   hour=now.getHours();
	   minutes=now.getMinutes();
	   if (minutes<10) {minutes='0'+minutes};
	   $('.date').append(hour+':'+minutes);
	}
  	setInterval(SetData,60);

});