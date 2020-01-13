$(function(){
 
    $('#note').autocomplete('/maintenance/autofill/note/', {
        width: 500,
        max: 15
    });
    $('#client').autocomplete('/maintenance/autofill/client/', {
        width: 500,
        max: 15
    });

 
});