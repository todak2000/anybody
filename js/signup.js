// process the form
$(document).ready(function(){
    $('form #form').submit(function(event) {

    var formData = {
        'name'              : $('input[name=usrnm]').val(),
        'email'             : $('input[name=email]').val(),
        'password'    : $('input[name=psw]').val()
    };
$.ajax({
    type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
    url         : 'signup.php', // the url where we want to POST
    data        : formData, // our data object
    dataType    : 'json',
    cache       : false,
    timeout     : 5000,
    success     : function(){
        alert('success'); 
    } ,
    error       : function(){
        alert('failed');
    }
})
    
});
});
