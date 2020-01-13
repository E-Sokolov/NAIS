$(function(){
    $('#coment').autocomplete('/gauth/autofill/coment/', {
        width: 500,
        max: 15
    });
    $('#name').autocomplete('/gauth/autofill/name/', {
        width: 500,
        max: 15
    });
    $('#client').autocomplete('/gauth/autofill/client/', {
        width: 500,
        max: 15
    });

 
});