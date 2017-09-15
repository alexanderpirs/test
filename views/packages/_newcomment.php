
<?php

$UserProfilePic="";
$CouplePartnerD=0;
//USER_PROFILE_PIC
if (Yii::$app->user->identity != null){
    $UserProfilePic = Yii::$app->user->identity->USER_PROFILE_PIC;
    $CouplePartnerD = Yii::$app->user->identity->COUPLE_PARTNER_ID;
}
?>
<div class="wrap-text-review">
                      <img src="<?=$UserProfilePic!="" ? Yii::getAlias('@web').'/'.$UserProfilePic  : Yii::getAlias('@web') . '/img/emptypic.jpg' ?>" alt="" class="avatar">
                      <textarea name="Comment" id="CommentID<?=$packageID?>" placeholder="Write comment..."></textarea>
                    </div>
                   
                    <div id="star" class="review-raty"></div>
                    <br>
                     <?php
 

$this->registerJs(<<<JS


  $('#star').raty();
$(document).ready(function() {
document.getElementById('CommentID$packageID').onkeyup = function (e) {
	    e = e || window.event;
	    if (e.keyCode === 13) {
        
         var Score=  document.getElementsByName('score');
        var Sc="0";
        
        if(Score!=null && Score.length>0){
           Sc = Score[0].value;
        }
        if(Sc==""){
        Sc=0;
        }
	        if ($("#CommentID$packageID").val() != "") {
               var Comment= $("#CommentID$packageID").val();
        $.post("add-comment",
    {
        Comment: Comment,
        PackageID : $packageID,
        Sc : Sc
      
    },
    function(data, status){
//     alert(data.success);
        if(data.success!='false'){
//        response.response
//        $('#HeaderUploadImg').attr('src',response.response);
        $('#HiddenOne$packageID').load('comment-by-id?CommentID='+data.success,function(){
        $('#reviews-wrap$packageID').prepend($('#HiddenOne$packageID').html()); 
        $('#HiddenOne$packageID').html('');   
       $('#newComment$packageID').html('');  
        $('#review-add$packageID').show();
        $("#CommentID$packageID").val('');
   });
       
        }
    });

	        }
	    }
	  
	    return false;
	}

  });
 
JS
);
                                                                   
                                                                ?>