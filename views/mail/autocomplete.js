$(function(){
 
    $('#client').autocomplete('/mail/autofill/client/', {
        width: 500,
        max: 10
    });
    $('#fio').autocomplete('/mail/autofill/fio/', {
        width: 500,
        max: 5
    });
    $('#position').autocomplete('/mail/autofill/position/', {
        width: 500,
        max: 5
    });
    $('#coment1').autocomplete('/mail/autofill/coment1/', {
        width: 500,
        max: 5
    });
    $('#coment2').autocomplete('/mail/autofill/coment2/', {
        width: 500,
        max: 5
    });
    $('#note').autocomplete('/mail/autofill/note/', {
        width: 500,
        max: 5
    });
 
});