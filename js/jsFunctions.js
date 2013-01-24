$(document).ready(function(){


$('#login').on("click",function (){
    if($('#login').attr('v')==0){
        $('#loginDiv').show();
        $('#login').text('(Close)');
        $('#login').attr('v',1);
    }
    else{
        $('#loginDiv').hide();
        $('#login').text('Login');
        $('#login').attr('v',0);
    }
})

$('#signup').on("click",function (){
    $('#signupDiv').toggle();
    if($('#signup').attr('v')==0){
        $('#signup').text('(Close)');
        $('#signup').attr('v',1);
    }
    else{
        $('#signup').text('Sign up');
        $('#signup').attr('v',0);
    }
})
$('#oSignup').on("click",function (){
    $('#oSignupDiv').toggle();
    if($('#oSignup').attr('v')==0){
        $('#oSignup').text('(Close)');
        $('#oSignup').attr('v',1);
    }
    else{
        $('#oSignup').text('Organization Sign up');
        $('#oSignup').attr('v',0);
    }
})


$('#changePassword').on("click",function (){
    $('#changePasswordDiv').toggle();
})

$('#loginButton').on("click enter", function(event){
    event.preventDefault();
    if($('#email').val()){
        if($('#password').val()){
            $.ajax({         
            url: "ajaxPortal.php",
            type: "POST",
            data: $('.loginForm').serialize(),
            success: function (data) {
                if(data=='student'){
                    window.location.replace("volunteer.php");
                }//end if
                else if(data=='org'){
                    window.location.replace("organization.php");
                }
                else if(data=='admin'){
                    window.location.replace("admin.php");
                }
                else{
                    $('.loginForm').effect("shake",{ times:2 }, 200);
                }//end else
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {

            }//end error
            });//end ajax
        }//end if
    }//end if
})

$('.seSignUp').on('click',function(event){
    var s = $(this).attr('s');
    var eID = $(this).attr('eID');
    var e = {eventID :eID, signedUp:s};
    var me = $(this);
    if(s==0){
        $.ajax({         
            url: "ajaxPortal.php",
            type: "POST",
            data: e,
            success: function (data) {
                me.attr('s',1);
                me.children('span').html('Revoke');
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {

            }//end error

        })
    }
    else {
        $.ajax({         
            url: "ajaxPortal.php",
            type: "POST",
            data: e,
            success: function (data) {
                me.attr('s',0);
                me.children('span').html('Sign up');
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {

            }//end error

        })


    }
})

$('#accordion').easyAccordion({
    autoStart: true,
    slideInterval: 3000,
    slideNum: false
})

});
