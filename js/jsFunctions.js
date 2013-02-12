
var VMS = {
    comment : {
        eventID : undefined,
        submitComment : function(event,that){
            var form = $(that).parent();
            VMS.comment.action = $(form).attr('action');
            $(form).attr('action');
            event.preventDefault();
             $.ajax({
                 url:$(form).attr('action'),
                 type:"POST",
                 data: $(form).serialize(),
                 success : function(data){
                     VMS.comment.addCommentToDom(data,form);
                     $(form).remove();
                 }//end success
             });
 
        },//end submitComment
        bindCommentSubmit : function(){
            $('.submitComment').live('click enter',function(event){
                VMS.comment.submitComment(event,this);
            });
        }(),//end bindCommentSubmit
        addCommentToDom : function(inc,form){
            $(form).parent().after(inc);
        },//end addCommentToDom
        replyClick : function(){
            $('.commentReplyButton').live('click',function(){
                if($(this).next('.commentForm').length){
                    $(this).next().remove();
                }//end if
                else{
                    var comment = $(this).parent();
                    var cID = $(comment).attr('cid');
                    var uID = $(comment).attr('uid');
                    var form = '<form class="commentForm" action="ajaxPortal.php?sEventID='+VMS.comment.eventID+'"><input type="hidden" name="recipID" value="'+uID+'" /><input type="hidden" name="parentID" value="'+cID+'"/><textarea name="submitComment"></textarea><input class="submitComment" type="submit" value="Reply"></form>';
                    $(this).after(form);                
                }//end else
            });
        }(),//end replyClick
        toggleCommentView : function(){
            $('.toggleCommentView').live('click',function(){
                $(this).next().toggle();
                $(this).next().next().toggle();
            });
        }()//end toggleCommentview

    },//end comment

    googleMap : {
        lat: undefined,
        lng: undefined,
        title: undefined,
        map : function(){
            $(document).ready(function(){
            if($('#googleMap').length){
                var mapOptions = {
                    center: new google.maps.LatLng(VMS.googleMap.lat,VMS.googleMap.lng),
                    zoom:15,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                };//end mapOptions

                var map = new google.maps.Map(document.getElementById("googleMap"),mapOptions);

                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(VMS.googleMap.lat,VMS.googleMap.lng),
                    map: map,
                    title: VMS.googleMap.title 
                });

            }//end if
            })
        }()//end map

    }//end googleMap

}//end VMS




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
//ORGANIZATION EVENTS HANDLING
$('#addEventTitle').on('click',function(){
    var $div = $(this).next()
    if($div.css('display')=='none'){
        $(this).children('span').children('img').attr("src","photos/icons//minus.png");
        $div.slideDown(500);
    }
    else {
        $div.fadeOut(500);
        $(this).children('span').children('img').attr("src","photos/icons/plus.png");
    }
})

$(function() {
    $("#datepicker").datepicker({ dateFormat:'yy-mm-dd'});
})
$('#sTime').ptTimeSelect({});
$('#eTime').ptTimeSelect({});
});


