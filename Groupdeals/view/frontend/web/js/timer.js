require([
		"jquery"
	], function($){
var timer;
var t = jQuery('#avato').val();
t = t.split(/[- :]/);
var d = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));

var compareDate = d;

//compareDate.setDate(compareDate.getDate() + 7); //just for this demo today + 7 days

timer = setInterval(function() {
  timeBetweenDates(compareDate);
}, 1000);

function timeBetweenDates(toDate) {
  var dateEntered = toDate;
  var now = new Date();
  var difference = dateEntered.getTime() - now.getTime();

  if (difference <= 0) {

    // Timer done
    clearInterval(timer);

  } else {

    var seconds = Math.floor(difference / 1000);
    var minutes = Math.floor(seconds / 60);
    var hours = Math.floor(minutes / 60);
    var days = Math.floor(hours / 24);

    hours %= 24;
    minutes %= 60;
    seconds %= 60;

    $("#days").text(days);
    $("#hours").text(hours);
    $("#minutes").text(minutes);
    $("#seconds").text(seconds);
  }
}
});

