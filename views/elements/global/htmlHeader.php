<!DOCTYPE html>
<head>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">

	<title> <?php echo $lang[0]; ?> </title>

	<link rel='icon' href='/views/elements/img/icon.png' />
	
	<link rel="stylesheet" href="/views/elements/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="/views/elements/css/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<link href="/views/elements/css/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
	<script src="/views/elements/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="/views/elements/js/jquery.min.js"></script>
 	<script type="text/javascript" src="/views/elements/js/jquery.autocomplete.js"></script>
 	<script type="text/javascript" src="/views/elements/js/modal.js"></script>
 	<script type="text/javascript" src="/views/elements/js/jqdownload.js"></script> 
 	<script type="text/javascript">
 		$(document).ready(function() {
var monthNames = [ "<?php echo $lang[3]; ?>", "<?php echo $lang[4]; ?>", "<?php echo $lang[5]; ?>", "<?php echo $lang[6]; ?>",
 "<?php echo $lang[7]; ?>", "<?php echo $lang[8]; ?>", "<?php echo $lang[9]; ?>", "<?php echo $lang[10]; ?>", "<?php echo $lang[11]; ?>", "<?php echo $lang[12]; ?>", "<?php echo $lang[13]; ?>", "<?php echo $lang[14]; ?>" ]; 
var dayNames= ["<?php echo $lang[15]; ?>","<?php echo $lang[16]; ?>","<?php echo $lang[17]; ?>","<?php echo $lang[18]; ?>","<?php echo $lang[19]; ?>","<?php echo $lang[20]; ?>","<?php echo $lang[21]; ?>"];

var newDate = new Date();
newDate.setDate(newDate.getDate());
   
$('#Date').html("<b>" + dayNames[newDate.getDay()] + "<br> " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ', ' + newDate.getFullYear()+"</b>");

setInterval( function() {
	var seconds = new Date().getSeconds();
	$("#sec").html(( seconds < 10 ? "0" : "" ) + seconds);
	},1000);
	
setInterval( function() {
	var minutes = new Date().getMinutes();
	$("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
    },1000);
	
setInterval( function() {
	var hours = new Date().getHours();
	$("#hrs").html(( hours < 10 ? "0" : "" ) + hours);
    }, 1000);	

  
  $(".night").click(function() {
    $(".clock").css("background-color", "rgba(0,0,0, .9)");
    $("ul, #Date").css("color", "#b1d4d4");
  });

  $(".day").click(function() {
    $(".clock").css("background-color", "rgba(0,0,0, .1)");
    $("ul, #Date").css("color", "#000");
  });
});
 	</script>
	<link rel='stylesheet' href='/views/elements/style/style.css' /> 
</head>
