//var target_date = new Date().getTime() + (1000*3600*48); // установить дату обратного отсчета
var target_date = new  Date(2020, 7, 30); // установить дату обратного отсчета
var days, hours, minutes, seconds; // переменные для единиц времени

var countdown = document.getElementById("timer"); // получить элемент тега

getCountdown();

setInterval(function () { getCountdown(); }, 1000);

function getCountdown(){

    var current_date = new Date().getTime();
    var seconds_left = (target_date - current_date) / 1000;

    days = pad( parseInt(seconds_left / 86400) );
    seconds_left = seconds_left % 86400;

    hours = pad( parseInt(seconds_left / 3600) );
    seconds_left = seconds_left % 3600;

    minutes = pad( parseInt(seconds_left / 60) );
    seconds = pad( parseInt( seconds_left % 60 ) );
    // строка обратного отсчета  + значение тега
    countdown.innerHTML = "Дней: "+days+" Часов: "+ hours +" Минут: "+ minutes + " Секунд: " + seconds + "</span>";
}
function pad(n) {
    return (n < 10 ? '0' : '') + n;
}