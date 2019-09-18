/*
* Smart Timesheet Preview
* Email: official.smarttimesheet@gmail.com
* Version: 3.0
* License: The MIT License
* Author: Brian Luna
* Copyright 2018 Brian Luna
* Website: https://github.com/brianluna/smarttimesheet
*/

$(document).ready(function() {
    $('#slidesidebar').on('click', function() {
        $('#sidebar').toggleClass('active');
        $('#body').toggleClass('active');
    });

    $('input, textarea').focusout(function(event) {
    	$notempty = $(this).val();
    	if($notempty !== '') {
    		$(this).addClass('notempty');
	    }
    });

    $('input, textarea').each(function(index, el) {
        $input = $(this).val();
        if($input !== '') {
            $(this).addClass('notempty');
        };
    });

    $('.ui.dropdown.selection').each(function(index, el) {
        var dropdown = $(this).find('select').val();
        for (var i = 0; i < dropdown.length; i++) {
            $(this).addClass('notempty');
        };
    });

    $('.ui.selection.dropdown, .ui.search.dropdown').focusout(function(event) {
        var dropdown = $(this).find('select').val();
        if(dropdown !== '') {
            $(this).addClass('notempty');
        }
    });

});

$(window).resize(function(){
    if($(window).width() <= 768){
        $('#sidebar, #body').addClass('active');
    }
});

$('.ui.dropdown').dropdown();
$('.ui.checkbox').checkbox();
$('.ui.radio.checkbox').checkbox();
$('select.dropdown').dropdown();
$('.ui.modal').modal();
$('.ui.basic.modal').modal();

$('.ui.add.modal').modal('attach events', '.btn-add', 'toggle');
$('.ui.edit.modal').modal('attach events', '.btn-edit', 'toggle');
$('.ui.modal.import').modal('attach events', '.btn-import', 'toggle');

// $('.airdatepicker').datepicker({ language: 'en' });
// $('.jtimepicker').mdtimepicker();

function time(timenow) {
    date = new Date();
    h = date.getHours();
    hours = ((h + 11) % 12 + 1);
    var ampm = h >= 12 ? 'PM' : 'AM';
    if(hours<10) { hours = "0"+hours; }
    m = date.getMinutes();
    if(m<10) { m = "0"+m; }
    s = date.getSeconds();
    if(s<10) { s = "0"+s; }
    timecurrent = hours+':'+m+':'+s+' '+ampm;
    return timecurrent;
}

function date_time(timetoday) {
    date = new Date();
    h = date.getHours();
    hours = ((h + 11) % 12 + 1);
    var ampm = h >= 12 ? 'PM' : 'AM';
    if(hours<10) { hours = "0"+hours; }
    m = date.getMinutes();
    if(m<10) { m = "0"+m; }
    s = date.getSeconds();
    if(s<10) { s = "0"+s; }
    timecurrent = hours+':'+m+':'+s+' '+ampm;
    document.getElementById(timetoday).innerHTML = timecurrent;
    setTimeout('date_time("'+timetoday+'");','1000');
    return true;
}

function date_today(datetoday) {
    date = new Date;
    year = date.getFullYear();
    month = date.getMonth();
    months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    d = date.getDate();
    day = date.getDay();
    days = new Array('Sunday,', 'Monday,', 'Tuesday,', 'Wednesday,', 'Thursday,', 'Friday,', 'Saturday,');
    datecurrent = months[month]+' '+d+', '+year;
    document.getElementById(datetoday).innerHTML = datecurrent;
    return true;
}

function day_today(daytoday) {
    date = new Date;
    year = date.getFullYear();
    month = date.getMonth();
    months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    d = date.getDate();
    day = date.getDay();
    days = new Array('Sunday,', 'Monday', 'Tuesday', 'Wednesday', 'Thursday,', 'Friday', 'Saturday');
    daycurrent = days[day];
    document.getElementById(daytoday).innerHTML = daycurrent;
    return true;
}
