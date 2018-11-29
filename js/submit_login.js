$(document).ready(function(){
    $('form')[0].reset();
    $('.close').click(function(){
      $('.forma').hide();
    });
    $('.closea').click(function(){
      $('.formaa').hide();
    });
    $('.closea1').click(function(){
      $('.form1').hide();
    });
// $('.bota').click(function(e){
//     e.preventDefault();

//     var name = $('form #name').val();
//     var pass = $('form #pass').val();
//     var email = $('form #email').val();
//     var formData = $('form').serialize();

//     if (name = '' || name.length <= 2  ){
       
//     }
//     if (email = '' || email.length <= 2  ){
       
//     }
//     submitForm(formData);
// });

    
//     function submitForm(formData){
//         $.ajax({
//             type:'post',
//             url: 'signup.php',
//             data: formData,
//             dataType: 'json',
//             cache: false,
//             timeout: 7000,
//             success: function(data){
//               console.log(formData)
//               console.log("success")
//             }
//             ,
//             error: 
//             console.log("fail"),
            
           
//             complete: function (XMLHttpRequest, status){
//                 $('form')[0].reset();
//             }
//         })
//     }
   
});