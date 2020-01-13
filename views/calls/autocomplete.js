$(function(){
 
    $('#description').autocomplete('/calls/autofill/description/', {
        width: 500,
        max: 15
    });
    $('#what_to_do').autocomplete('/calls/autofill/what_to_do/', {
        width: 500,
        max: 15
    });
    $('#etc_data').autocomplete('/calls/autofill/etc_data/', {
        width: 500,
        max: 15
    });
    $('#client').autocomplete('/calls/autofill/client/', {
        width: 500,
        max: 15
    });
    $('#fio').autocomplete('/calls/autofill/fio/', {
        width: 500,
        max: 15
    });
 
});