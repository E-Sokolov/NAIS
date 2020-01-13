<script type="text/javascript">
 
$(function() {
 
$(window).scroll(function() {
 
if($(this).scrollTop() != 0) {
 
$('#toTop').fadeIn();
 
} else {
 
$('#toTop').fadeOut();
 
}
 
});
 
$('#toTop').click(function() {
 
$('body,html').animate({scrollTop:0},800);
 
});
 
});
 
</script>
<script type="text/javascript">
 
$(function() {
 
$(window).scroll(function() {
 
if($(this).scrollTop() == 0) {
 
$('#toBottom').fadeIn();
 
} else {
 
$('#toBottom').fadeOut();
 
}
 
});
 
$('#toBottom').click(function() {
 
$('body,html').animate({scrollTop:20000},800);
 
});
 
});
 
</script>
<DIV ID = "toTop" > ^ Наверх </DIV>
<DIV ID = "toBottom" > Вниз </DIV>
		<div id='footer' class='col-xs-12'> 
			 &copy Сектор технічного супроводження Одеської філії ДП "НАІС" 2018 - 2019 <a target='_blanck' href=''></a> <br /> 
			 
		</div>
	
</body>
</html>