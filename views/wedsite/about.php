<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
$WeddingID=0;
$profilePAth=0;
$FirstPartnerName="";
$SecondPartnerName="";
$FirstPartnerPic="";
$SecondPartnerPic="";
if (Yii::$app->user->identity!=null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
    $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
    $profilePAth = Yii::$app->user->identity->weddings0[0]->COUPLE_IMG;
    $FirstPartnerName = Yii::$app->user->identity->weddings0[0]->fIRSTCOUPLEPARTNER->COUPLE_PARTNER_FIRST_NAME ;
    $SecondPartnerName = (isset(Yii::$app->user->identity->weddings0) &&  Yii::$app->user->identity->weddings0!=null && sizeof(Yii::$app->user->identity->weddings0)>0 && Yii::$app->user->identity->weddings0[0]->sECONDCOUPLEPARTNER!=null ? Yii::$app->user->identity->weddings0[0]->sECONDCOUPLEPARTNER->COUPLE_PARTNER_FIRST_NAME :"") ;
    $FirstPartnerPic = Yii::$app->user->identity->weddings0[0]->fIRSTCOUPLEPARTNER->USER_PROFILE_PIC!=null ?Yii::$app->user->identity->weddings0[0]->fIRSTCOUPLEPARTNER->USER_PROFILE_PIC:"" ;
    $SecondPartnerPic = (isset(Yii::$app->user->identity->weddings0) &&  Yii::$app->user->identity->weddings0!=null && sizeof(Yii::$app->user->identity->weddings0)>0 && Yii::$app->user->identity->weddings0[0]->sECONDCOUPLEPARTNER!=null ? Yii::$app->user->identity->weddings0[0]->sECONDCOUPLEPARTNER->USER_PROFILE_PIC :"") ;
    $WeddingType = Yii::$app->user->identity->weddings0[0]->wEDDINGTYPE!=null && Yii::$app->user->identity->weddings0[0]->wEDDINGTYPE->weddingTypeTranslation!=null && Yii::$app->user->identity->weddings0[0]->wEDDINGTYPE->weddingTypeTranslation->WEDDING_TYPE_TRANSLATION!=null  ?Yii::$app->user->identity->weddings0[0]->wEDDINGTYPE->weddingTypeTranslation->WEDDING_TYPE_TRANSLATION:0;
} else if (Yii::$app->user->identity!=null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
    $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
    $profilePAth = Yii::$app->user->identity->weddings[0]->COUPLE_IMG;
    $FirstPartnerName = Yii::$app->user->identity->weddings[0]->fIRSTCOUPLEPARTNER->COUPLE_PARTNER_FIRST_NAME ;
    $SecondPartnerName = Yii::$app->user->identity->weddings[0]->sECONDCOUPLEPARTNER->COUPLE_PARTNER_FIRST_NAME ;
    $FirstPartnerPic = Yii::$app->user->identity->weddings[0]->fIRSTCOUPLEPARTNER->USER_PROFILE_PIC!=null ? Yii::$app->user->identity->weddings[0]->fIRSTCOUPLEPARTNER->USER_PROFILE_PIC : "" ;
    $SecondPartnerPic = Yii::$app->user->identity->weddings[0]->sECONDCOUPLEPARTNER->USER_PROFILE_PIC!=null ?Yii::$app->user->identity->weddings[0]->sECONDCOUPLEPARTNER->USER_PROFILE_PIC :"" ;
    $WeddingType = Yii::$app->user->identity->weddings[0]->wEDDINGTYPE!=null && Yii::$app->user->identity->weddings[0]->wEDDINGTYPE->weddingTypeTranslation!=null && Yii::$app->user->identity->weddings[0]->wEDDINGTYPE->weddingTypeTranslation->WEDDING_TYPE_TRANSLATION!=null  ?Yii::$app->user->identity->weddings[0]->wEDDINGTYPE->weddingTypeTranslation->WEDDING_TYPE_TRANSLATION:0;
}

$FirstPartnerID=0;
$SecondPartnerID=0;
if (Yii::$app->user->identity!=null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
    $FirstPartnerID = Yii::$app->user->identity->weddings0[0]->FIRST_COUPLE_PARTNER_ID;
    $SecondPartnerID = Yii::$app->user->identity->weddings0[0]->SECOND_COUPLE_PARTNER_ID;
    
} else if (Yii::$app->user->identity!=null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
   $FirstPartnerID = Yii::$app->user->identity->weddings[0]->FIRST_COUPLE_PARTNER_ID;
    $SecondPartnerID = Yii::$app->user->identity->weddings[0]->SECOND_COUPLE_PARTNER_ID;
}
?>
<style>


#croppic,
#croppic2,
#croppic3,
#croppic4,
#croppic5,
#croppic6 {
  width: 100%;
  height: 312px;
  position: relative;
  margin: 0;
  border: 0;
  box-sizing: content-box;
  -moz-box-sizing: content-box;
  border-radius: 2px;
  background-repeat: no-repeat;
  background-position: center;
  box-shadow: 0 0 0 transparent;
  background-image: url("<?=Yii::getAlias('@web').'/img/about/emptypic.jpg'?>");
  background-size: 279px; }

#croppic3,
#croppic4,
#croppic5,
#croppic6 {
  margin-bottom: 11px;
  overflow: hidden; }

.add-review-block .form-horizontal .cst-btn-input-photo {
  background-color: #fbc49e;
  transition: background-color .2s ease-in-out;
  outline: 0;
  margin-left: auto;
  margin-right: auto;
  display: block;
  width: 100px;
  border-radius: 30px;
  border-top-right-radius: 0;
  border-bottom-right-radius: 0; }

.my-cst-readonly-input {
  border-top-right-radius: 30px;
  border-bottom-right-radius: 30px; }

.add-photo-input-margin11 {
  margin-bottom: 11px; }

.add-new-member-block1 {
  max-width: 320px;
  padding: 20px 20px; }

.croppedImg {
  width: 100%;
  height: auto; }

@media (min-width: 768px) {
  .about-pr-40px {
    padding-right: 30px; }
  .about-pl-40px {
    padding-left: 30px; } }


@media (min-width: 768px) {
  #OurStoryText {
      /*width: 869px;*/
      margin-right: auto; 
      margin-left: auto; 
      margin-bottom: 20px; 
      text-align: justify; 
      /*position: relative;*/
   
  } }

@media (min-width: 992px) {
  #OurStoryText {
    width: 869px; 
    margin-right: auto; 
    margin-left: auto; 
    margin-bottom: 20px; 
    text-align: justify; 
    position: relative;
  } 
}
    </style>
<!-- about block1 -->
          <div class="container-fluid about-block1-fluid">
            <div class="container about-block1">
              <div class="row">

                <div class="col-xs-12 col-sm-6 ab-b-25">
<div class="about-him-and-her">
                  <div role="presentation" class="dropdown profile-photo">
<!--                                     $FirstPartnerPic="";
$SecondPartnerPic="";-->
                                <div id="image-editorHim" class="image-editor">
                                   <?= Html::img($FirstPartnerPic != "" ? Yii::getAlias('@web') . '/' . $FirstPartnerPic : Yii::getAlias('@web') . '/img/emptypic.jpg', ['id' => 'testtttt123Him', 'alt' => '', 'class' => '','style'=>'height : 310px;margin-left: 0px;margin-right: 0px;']); ?>   
                                        
                                    <div class="cropit-preview cropit-preview-big" id="PreviewImgHim" style="display : none;" ></div>
<!--                                    <div class="row">
                                        <div class="col-sm-3">-->
                                           <img class="rotate-ccw  imgrotator leftimgrotate" id="rotate-ccwHim" src="<?=Yii::getAlias('@web') . '/img/left.png'?>" width="16px" alt="" style='margin-right: 2px;'>&nbsp;
                                           <img class="rotate-cw imgrotator " id="rotate-cwHim" src="<?=Yii::getAlias('@web') . '/img/right.png'?>" width="16px" alt="" style="">  
<!--                                        </div>
                                        <div class="col-sm-5">-->
<input type="range"  id="ImgZoomRangHim" class=" ImgZoomRang cropit-image-zoom-input cropit-image-zoom-input-big">
<!--                                        </div>
                                        <div class="col-sm-4">-->
<span id="SpanForSelectHim" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <a href="#/" id="immediatorselectHim" class="immediatorselect">Select</a>
                                            <a href="#/" id="exportHim"  class="export exportbutton">Save</a>
<!--                                        </div>
                                    </div>             -->
          
      
   
   
   <div id="wrapperofselectHim" class="wrapperofselect">
     
   </div>
    <input type="file" id="cropit-image-inputHim" class="cropit-image-input"  style="visibility:hidden;">
    </div>
         
                               
                                </div>
                </div>
<?php


$this->registerJs(<<<JS
        $('#cropit-image-inputHim').change(function (){
            $('#testtttt123Him').hide();
        $("#ImgZoomRangHim").show();
        $("#exportHim").show();
        $("#immediatorselectHim").show();
        $("#rotate-ccwHim").show();
        $("#rotate-cwHim").show();
        $('#PreviewImgHim').show();
        $('#SpanForSelectHim').hide();
            }); 
        
         $(function() {
        $("#immediatorselectHim").on("click" , function(){
            $("#cropit-image-inputHim").click();
        });
       
        $('#image-editorHim').cropit({
          exportZoom: 1,
            quality : 0.9,
          imageBackground: true,
          imageBackgroundBorderWidth: 20
          
        });
        $('#exportHim').click(function() {
          var imageData = $('#image-editorHim').cropit('export');
//          alert(imageData);
        $('#testtttt123Him').attr('src',imageData);
          $('#ImgModalHim').modal('toggle');
        $('#testtttt123Him').show();
        $('#PreviewImgHim').hide();
        
        var formData = new FormData();
    formData.append('image',imageData);
      
    console.log(formData);
        $('#cropit-image-inputHim').val(null);
    $.ajax({
        url:'saveprofileimg',  //Server script to process data Saveprofileimg
        type: 'POST',

        // Form data
        data: formData,

         // its a function which you have to define

        success: function(response) {
            console.log(response.return);
        $("#ImgZoomRangHim").hide();
        $("#exportHim").hide();
        $("#immediatorselectHim").show();
        $("#rotate-ccwHim").hide();
        $("#rotate-cwHim").hide();
        $('#SpanForSelectHim').show();
        
//      $("#testtttt123Him").attr('src', response.return);  
        },

        error: function(){
            alert('ERROR at PHP side!!');
        },


        //Options to tell jQuery not to process data or worry about content-type.
        cache: false,
        contentType: false,
        processData: false
    });
        });
        $('#rotate-cwHim').click(function() {
          $('#image-editorHim').cropit('rotateCW');
        });
        $('#rotate-ccwHim').click(function() {
          $('#image-editorHim').cropit('rotateCCW');
        });

       
      });
 
        
        
           $(document).ready(function() {
   	$(".dropdown.profile-photo").css("height" , "312px");
   	$("#rotate-ccwHim, #rotate-cwHim, #ImgZoomRangHim, #immediatorselectHim, #exportHim,#SpanForSelectHim").wrapAll("<div class='deltagamma' id='deltagammaHim'></div>");
   	$("#deltagammaHim").css({"z-index" : "0" , "position" : "absolute" , "transition" : ".8s ease all" , "bottom" : "-35px" , "display" : "none", "left" : "5px"});
   	$("#ImgZoomRangHim").css({"z-index" : "0","display" :"inline-block"});
   	$("#exportHim").css({"z-index" : "0", "display" :"inline-block"});
   	$('#sidebarHim').css({"z-index"  : "100","display" :"inline-block"});
        
        
        $("#ImgZoomRangHim").hide();
        $("#exportHim").hide();
        $("#immediatorselectHim").show();
        $('#SpanForSelectHim').show();
        $("#rotate-ccwHim").hide();
        $("#rotate-cwHim").hide();
   	$("#image-editorHim").on("mouseenter" , function(){
   		$("#deltagammaHim").css("bottom" , "12px");
        $("#deltagammaHim").show( );
   	});
   	$("#image-editorHim").on("mouseleave" , function(){
        
   		$("#image-editorHim").css("bottom" , "-35px" );
                $("#deltagammaHim").hide( );
   	});
   	$("#image-editorHim").on("mouseenter" , function(){
   		$("#deltagammaHim").css("bottom" , "12px");
                 $("#deltagammaHim").show( );
   	});
   	$("#image-editor->WEDDING_EVENT_ID").on("mouseleave" , function(){
   		$("#deltagammaHim").css("bottom" , "-35px");
        $("#deltagammaHim").hide( );
   	});
   });
JS
);
?>
                    
                  <h3 class="ab-b-25">
                    <?=$FirstPartnerName!="" ? $FirstPartnerName :'First Partner Name'?> 
                   
                      <span class="edit-link">
                      <a href="#/" id="FirstPartnerEdit"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                    </span>
                  </h3>
                    <?php    dosamigos\ckeditor\CKEditorInline::begin(['preset' => 'basic','id'=>'FirstPartnerHistory','options'=>[ 'class'=>'','style' =>' ']]);?>
                 <?=$dataProviderWedsiteAbout!=null && sizeof($dataProviderWedsiteAbout)>0 && $dataProviderWedsiteAbout[0]->HIS_HISTORY ? $dataProviderWedsiteAbout[0]->HIS_HISTORY :"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo." ?> 
                    <?php  dosamigos\ckeditor\CKEditorInline::end(); ?>
                  <?php


$this->registerJs(<<<JS

        $('#FirstPartnerEdit').click(function() {
        CKEDITOR.instances['FirstPartnerHistory'].focus();
        $('#FirstPartnerHistory').css('border', '#f9a66d solid');
        $('#FirstPartnerEdit').hide();
        });
        var HisHistoryInstance = CKEDITOR.instances['FirstPartnerHistory'];
        HisHistoryInstance.on( 'focus', function (ev) {
        $('#FirstPartnerHistory').css('border', '#f9a66d solid');
        $('#FirstPartnerEdit').hide();
        });
     HisHistoryInstance.on( 'blur', function (ev) {
        $('#FirstPartnerEdit').show();
         $('#FirstPartnerHistory').css('border', '');
        $.post("add-wedsite-about",
                {
                    HisHistory:HisHistoryInstance.getData() ,
                },
                function (data, status) {

                }); 
		}); 
JS
);
?>
                </div>
                  
                <div class="col-xs-12 col-sm-6 ab-b-25">
                  <div class="about-him-and-her">
                    <div role="presentation" class="dropdown profile-photo">
<!--                                     $FirstPartnerPic="";
$SecondPartnerPic="";-->
                                <div id="image-editorHer" class="image-editor">
                                   <?= Html::img($SecondPartnerPic != "" ? Yii::getAlias('@web') . '/' . $SecondPartnerPic : Yii::getAlias('@web') . '/img/emptypic.jpg', ['id' => 'testtttt123Her', 'alt' => '', 'class' => '','style'=>'height : 310px;margin-left: 0px;margin-right: 0px;']); ?>   
                                        
                                    <div class="cropit-preview cropit-preview-big" id="PreviewImgHer" style="display : none;" ></div>
<!--                                    <div class="row">
                                        <div class="col-sm-3">-->
                                           <img class="rotate-ccw  imgrotator leftimgrotate" id="rotate-ccwHer" src="<?=Yii::getAlias('@web') . '/img/left.png'?>" width="16px" alt="" style='margin-right: 2px;'>&nbsp;
                                           <img class="rotate-cw imgrotator " id="rotate-cwHer" src="<?=Yii::getAlias('@web') . '/img/right.png'?>" width="16px" alt="" style="">  
<!--                                        </div>
                                        <div class="col-sm-5">-->
<input type="range"  id="ImgZoomRangHer" class=" ImgZoomRang cropit-image-zoom-input cropit-image-zoom-input-big ">
<!--                                        </div>
                                        <div class="col-sm-4">-->
<span id="SpanForSelectHer" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <a href="#/" id="immediatorselectHer" class="immediatorselect">Select</a>
                                            <a href="#/" id="exportHer"  class="export exportbutton">Save</a>
<!--                                        </div>
                                    </div>             -->
          
      
   
   
   <div id="wrapperofselectHer" class="wrapperofselect">
     
   </div>
    <input type="file" id="cropit-image-inputHer" class="cropit-image-input"  style="visibility:hidden;">
    </div>
         
                               
                                </div>
                  </div>
                    
                    
                    <?php


$this->registerJs(<<<JS
        $('#cropit-image-inputHer').change(function (){
            $('#testtttt123Her').hide();
        $("#ImgZoomRangHer").show();
        $("#exportHer").show();
        $("#immediatorselectHer").show();
        $("#rotate-ccwHer").show();
        $("#rotate-cwHer").show();
        $('#PreviewImgHer').show();
        $('#SpanForSelectHer').hide();
            }); 
        
         $(function() {
        $("#immediatorselectHer").on("click" , function(){
            $("#cropit-image-inputHer").click();
        });
       
        $('#image-editorHer').cropit({
          exportZoom: 1,
            quality : 0.9,
          imageBackground: true,
          imageBackgroundBorderWidth: 20
          
        });
        $('#exportHer').click(function() {
          var imageData = $('#image-editorHer').cropit('export');
//          alert(imageData);
        $('#testtttt123Her').attr('src',imageData);
          $('#ImgModalHer').modal('toggle');
        $('#testtttt123Her').show();
        $('#PreviewImgHer').hide();
        
        var formData = new FormData();
    formData.append('image',imageData);
      
    console.log(formData);
        $('#cropit-image-inputHer').val(null);
    $.ajax({
        url:'saveprofileimg',  //Server script to process data Saveprofileimg
        type: 'POST',

        // Form data
        data: formData,

         // its a function which you have to define

        success: function(response) {
            console.log(response.return);
        $("#ImgZoomRangHer").hide();
        $("#exportHer").hide();
        $("#immediatorselectHer").show();
        $("#rotate-ccwHer").hide();
        $("#rotate-cwHer").hide();
        $('#SpanForSelectHer').show();
        
//      $("#testtttt123Her").attr('src', response.return);  
        },

        error: function(){
            alert('ERROR at PHP side!!');
        },


        //Options to tell jQuery not to process data or worry about content-type.
        cache: false,
        contentType: false,
        processData: false
    });
        });
        $('#rotate-cwHer').click(function() {
          $('#image-editorHer').cropit('rotateCW');
        });
        $('#rotate-ccwHer').click(function() {
          $('#image-editorHer').cropit('rotateCCW');
        });

       
      });
 
        
        
           $(document).ready(function() {
   	$(".dropdown.profile-photo").css("height" , "312px");
   	$("#rotate-ccwHer, #rotate-cwHer, #ImgZoomRangHer, #immediatorselectHer, #exportHer,#SpanForSelectHer").wrapAll("<div class='deltagamma' id='deltagammaHer'></div>");
   	$("#deltagammaHer").css({"z-index" : "0" , "position" : "absolute" , "transition" : ".8s ease all" , "bottom" : "-35px" , "display" : "none", "left" : "5px"});
   	$("#ImgZoomRangHer").css({"z-index" : "0","display" :"inline-block"});
   	$("#exportHer").css({"z-index" : "0", "display" :"inline-block"});
   	$('#sidebarHer').css({"z-index"  : "100","display" :"inline-block"});
        
        
        $("#ImgZoomRangHer").hide();
        $("#exportHer").hide();
        $("#immediatorselectHer").show();
        $('#SpanForSelectHer').show();
        $("#rotate-ccwHer").hide();
        $("#rotate-cwHer").hide();
   	$("#image-editorHer").on("mouseenter" , function(){
   		$("#deltagammaHer").css("bottom" , "12px");
        $("#deltagammaHer").show( );
   	});
   	$("#image-editorHer").on("mouseleave" , function(){
        
   		$("#image-editorHer").css("bottom" , "-35px" );
                $("#deltagammaHer").hide( );
   	});
   	$("#image-editorHer").on("mouseenter" , function(){
   		$("#deltagammaHer").css("bottom" , "12px");
                 $("#deltagammaHer").show( );
   	});
   	$("#image-editor->WEDDING_EVENT_ID").on("mouseleave" , function(){
   		$("#deltagammaHer").css("bottom" , "-35px");
        $("#deltagammaHer").hide( );
   	});
   });
JS
);
?>
                    
                    
                    
                  <h3 class="ab-b-25">
                   <?=$SecondPartnerName!="" ? $SecondPartnerName :'Second Partner Name'?> 
                    <span class="edit-link">
                      <a href="#/" id="SecondPartnerEdit"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                    </span>
                  </h3>
                     
                    <?php    dosamigos\ckeditor\CKEditorInline::begin(['preset' => 'basic','id'=>'SecondPartnerHistory','options'=>['class'=>'','style' =>' ']]);?>
                  <?=$dataProviderWedsiteAbout!=null && sizeof($dataProviderWedsiteAbout)>0 && $dataProviderWedsiteAbout[0]->HER_HISTORY ? $dataProviderWedsiteAbout[0]->HER_HISTORY :"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo." ?>
                      <?php  dosamigos\ckeditor\CKEditorInline::end(); ?>
<?php
$this->registerJs(<<<JS
        
         $('#SecondPartnerEdit').click(function() {
             CKEDITOR.instances['SecondPartnerHistory'].focus();
         $('#SecondPartnerHistory').css('border', '#f9a66d solid');
        $('#SecondPartnerEdit').hide();
        });
        var SecondPartnerHistory = CKEDITOR.instances['SecondPartnerHistory'];
        SecondPartnerHistory.on( 'focus', function (ev) {
        $('#SecondPartnerHistory').css('border', '#f9a66d solid');
        $('#SecondPartnerEdit').hide();
        });
     SecondPartnerHistory.on( 'blur', function (ev) {
        $('#SecondPartnerEdit').show();
         $('#SecondPartnerHistory').css('border', '');
        $.post("add-wedsite-about",
                {
                   HerHistory:SecondPartnerHistory.getData() ,
                },
                function (data, status) {

                }); 
		}); 
        
        
JS
);
?>
                </div>

              </div>

              <div class="row second-row ab-b-25">
                <div class="col-xs-12 col-sm-12">
                   <h3 class="text-center rnd-size30">Our Story
                    <span class="edit-link">
                      <a href="#/" id="OurHistoryEdit"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                    </span>
                  </h3>
                     
                    <?php    dosamigos\ckeditor\CKEditorInline::begin(['preset' => 'basic','id'=>'OurStoryText','options'=>['class'=>'text-justify rnd-width871-centered','style' =>'     text-align: center;']]);?>
                  <?=$dataProviderWedsiteAbout!=null && sizeof($dataProviderWedsiteAbout)>0 && $dataProviderWedsiteAbout[0]->OUR_HISTORY ? $dataProviderWedsiteAbout[0]->OUR_HISTORY :"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo." ?>
                      
               <?php  dosamigos\ckeditor\CKEditorInline::end(); ?>
                  <?php
$this->registerJs(<<<JS
                  
        
        $('#OurHistoryEdit').click(function() {
             CKEDITOR.instances['OurStoryText'].focus();
         $('#OurStoryText').css('border', '#f9a66d solid');
        $('#OurHistoryEdit').hide();
        });
        var OurStoryText = CKEDITOR.instances['OurStoryText'];
        OurStoryText.on( 'focus', function (ev) {
        $('#OurStoryText').css('border', '#f9a66d solid');
        $('#OurHistoryEdit').hide();
        });
     OurStoryText.on( 'blur', function (ev) {
        $('#OurHistoryEdit').show();
         $('#OurStoryText').css('border', '');
        $.post("add-wedsite-about",
                {
                   OurHistory:OurStoryText.getData() ,
                },
                function (data, status) {

                }); 
		}); 
JS
);
?>
                </div>
              </div>

              <div class="row third-row ab-b-25">
                <div class="col-xs-12 col-sm-12">
                  <h3 class="text-center rnd-size30">Our Galery
                    <span class="edit-link">
                      <a href="#"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                    </span>
                  </h3> 

                  <div class="owl-carousel owl-carousel6">
                      
                    <a href="#">
                      <img src="<?=Yii::getAlias('@web').'/img/about/gallery-item.png'?>" class="img-responsive center-block">
                    </a>

                    <a href="#">
                      <img src="<?=Yii::getAlias('@web').'/img/about/gallery-item.png'?>" class="img-responsive center-block">
                    </a>

                    <a href="#">
                      <img src="<?=Yii::getAlias('@web').'/img/about/gallery-item.png'?>" class="img-responsive center-block">
                    </a>

                    <a href="#">
                      <img src="<?=Yii::getAlias('@web').'/img/about/gallery-item.png'?>" class="img-responsive center-block">
                    </a>

                    <a href="#">
                      <img src="<?=Yii::getAlias('@web').'/img/about/gallery-item.png'?>" class="img-responsive center-block">
                    </a>

                  </div>




                  <a class="cst-btn-add-gallery-photo" role="button" data-toggle="collapse" href="#addPhoto1" aria-expanded="false" aria-controls="collapseExample">
                    Add New Photo
                  </a>

                  <div class="collapse" id="addPhoto1">
                    <div class="add-review-block">
                      <h3 class="text-center">Add New Photo</h3>

                      <form class="form-horizontal">



                      <!--
                        <div class="form-group">
                          <label for="inputName" class="col-sm-2 control-label">Select images: </label>
                          <div class="col-sm-10">
                            <input type="file" class="form-control" id="inputName" placeholder="Input name" multiple>
                            <label class="btn btn-default btn-file">
                                Browse <input type="file" style="display: none;" multiple>
                            </label>
                          </div>
                        </div>
                      --> 

                        <div class="input-group add-photo-input-margin11">
                            <label class="input-group-btn">
                                <span class="btn cst-btn-input-photo">
                                    Browse&hellip; <input type="file" style="display: none;" multiple>
                                </span>
                            </label>
                            <input type="text" class="form-control my-cst-readonly-input" readonly>
                        </div>

                        <button type="submit" class="btn btn-default">Save</button>
                      </form>


                      
                    </div>
                  </div>
                </div>

              </div>


              <div class="row forth-row ab-b-25">
                <div class="col-xs-12 col-sm-12">
                  <h3 class="text-center rnd-size30">Our Family
                    <span class="edit-link">
                      <a href="#"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                    </span>
                  </h3>  

                  <div class="col-xs-12 col-sm-6 about-pr-40px">
                    <h3 class="text-center rnd-size30 rnd-weight400">Groom's family</h3>
<!--                    'dataProviderFamilySecondPartner'=>$dataProviderFamilySecondPartner,
                    'dataProviderFamilyFirstPartner'=>$dataProviderFamilyFirstPartner-->
  <div class="row" id="FirstFamilyRow">
                    <?php
                    if($dataProviderFamilyFirstPartner !=null && sizeof($dataProviderFamilyFirstPartner)>0){
                        foreach($dataProviderFamilyFirstPartner as $FirstPartnerFamily){
                          ?>
       <div class="col-xs-12 col-sm-12 col-md-6">
           <div role="presentation" class="dropdown profile-photo" style="margin-bottom: 20px;s">
<!--                                     $FirstPartnerPic="";
$SecondPartnerPic="";-->
                                <div id="image-editor<?=$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID ?>" class="image-editor">
                                    <img src="<?= $FirstPartnerFamily->FAMILY_MEMBER_PIC!=null  ? Yii::getAlias('@web').'/'.$FirstPartnerFamily->FAMILY_MEMBER_PIC : Yii::getAlias('@web').'/img/about/emptypic.jpg' ?>" id='testtttt123<?=$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID ?>' style="height : 240px;" class="">
                                   
                                        
                                    <div class="cropit-preview cropit-preview-big" id="PreviewImg<?=$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID ?>" style="display : none;" ></div>
<!--                                    <div class="row">
                                        <div class="col-sm-3">-->
                                           <img class="rotate-ccw  imgrotator leftimgrotate" id="rotate-ccw<?=$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID ?>" src="<?=Yii::getAlias('@web') . '/img/left.png'?>" width="16px" alt="" style='margin-right: 2px;'>&nbsp;
                                           <img class="rotate-cw imgrotator " id="rotate-cw<?=$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID ?>" src="<?=Yii::getAlias('@web') . '/img/right.png'?>" width="16px" alt="" style="">  
<!--                                        </div>
                                        <div class="col-sm-5">-->
<input type="range"  id="ImgZoomRang<?=$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID ?>" class=" ImgZoomRang cropit-image-zoom-input cropit-image-zoom-input-big ">
<!--                                        </div>
                                        <div class="col-sm-4">-->
<span id="SpanForSelect<?=$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID ?>" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <a href="#/" id="immediatorselect<?=$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID ?>" class="immediatorselect">Select</a>
                                            <a href="#/" id="export<?=$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID ?>"  class="export exportbutton">Save</a>
<!--                                        </div>
                                    </div>             -->
          
      
   
   
   <div id="wrapperofselect<?=$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID ?>" class="wrapperofselect">
     
   </div>
    <input type="file" id="cropit-image-input<?=$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID ?>" class="cropit-image-input"  style="visibility:hidden;">
    </div>
         
                               
                                </div>
                        <?php


$this->registerJs(<<<JS
        $('#cropit-image-input$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').change(function (){
            $('#testtttt123$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').hide();
        $("#ImgZoomRang$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").show();
        $("#export$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").show();
        $("#immediatorselect$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").show();
        $("#rotate-ccw$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").show();
        $("#rotate-cw$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").show();
        $('#PreviewImg$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').show();
        $('#SpanForSelect$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').hide();
            }); 
        
         $(function() {
        $("#immediatorselect$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").on("click" , function(){
            $("#cropit-image-input$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").click();
        });
       
        $('#image-editor$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').cropit({
          exportZoom: 1,
            quality : 0.9,
          imageBackground: true,
          imageBackgroundBorderWidth: 20
          
        });
        $('#export$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').click(function() {
          var imageData = $('#image-editor$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').cropit('export');
//          alert(imageData);
        $('#testtttt123$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').attr('src',imageData);
          $('#ImgModal$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').modal('toggle');
        $('#testtttt123$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').show();
        $('#PreviewImg$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').hide();
        
        var formData = new FormData();
    formData.append('image',imageData);
        formData.append('FamilyMemberID',$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID);
     
       
    console.log(formData);
        $('#cropit-image-input$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').val(null);
    $.ajax({
        url:'upload-family-img',  //Server script to process data Saveprofileimg
        type: 'POST',

        // Form data
        data: formData,

         // its a function which you have to define

        success: function(response) {
            console.log(response.return);
        $("#ImgZoomRang$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").hide();
        $("#export$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").hide();
        $("#immediatorselect$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").show();
        $("#rotate-ccw$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").hide();
        $("#rotate-cw$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").hide();
        $('#SpanForSelect$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').show();
        
//      $("#testtttt123$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").attr('src', response.return);  
        },

        error: function(){
            alert('ERROR at PHP side!!');
        },


        //Options to tell jQuery not to process data or worry about content-type.
        cache: false,
        contentType: false,
        processData: false
    });
        });
        $('#rotate-cw$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').click(function() {
          $('#image-editor$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').cropit('rotateCW');
        });
        $('#rotate-ccw$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').click(function() {
          $('#image-editor$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').cropit('rotateCCW');
        });

       
      });
 
        
        
           $(document).ready(function() {
   	$(".dropdown.profile-photo").css("height" , "240px");
   	$("#rotate-ccw$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID, #rotate-cw$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID, #ImgZoomRang$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID, #immediatorselect$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID, #export$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID,#SpanForSelect$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").wrapAll("<div class='deltagamma' id='deltagamma$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID'></div>");
   	$("#deltagamma$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").css({"z-index" : "0" , "position" : "absolute" , "transition" : ".8s ease all" , "bottom" : "-35px" , "display" : "none", "left" : "5px"});
   	$("#ImgZoomRang$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").css({"z-index" : "0","display" :"inline-block"});
   	$("#export$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").css({"z-index" : "0", "display" :"inline-block"});
   	$('#sidebar$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').css({"z-index"  : "100","display" :"inline-block"});
        
        
        $("#ImgZoomRang$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").hide();
        $("#export$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").hide();
        $("#immediatorselect$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").show();
        $('#SpanForSelect$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').show();
        $("#rotate-ccw$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").hide();
        $("#rotate-cw$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").hide();
   	$("#image-editor$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").on("mouseenter" , function(){
   		$("#deltagamma$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").css("bottom" , "12px");
        $("#deltagamma$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").show( );
   	});
   	$("#image-editor$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").on("mouseleave" , function(){
        
   		$("#image-editor$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").css("bottom" , "-35px" );
                $("#deltagamma$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").hide( );
   	});
   	$("#image-editor$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").on("mouseenter" , function(){
   		$("#deltagamma$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").css("bottom" , "12px");
                 $("#deltagamma$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").show( );
   	});
   	$("#image-editor$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").on("mouseleave" , function(){
   		$("#deltagamma$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").css("bottom" , "-35px");
        $("#deltagamma$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").hide( );
   	});
   });
JS
);
?>
                        <div class="row">
                            <div class="col-md-8 ">
                                <?php    dosamigos\ckeditor\CKEditorInline::begin(['preset' => 'basic','id'=>'FirstFamilyNameCk'.$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID,'options'=>['class'=>'text-justify ab-b-25','style' =>'margin-bottom: 0px;font-size : 23px;']]);?>
                                <?=$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_NAME!=null ?$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_NAME :'enter name'?>
                                <?php  dosamigos\ckeditor\CKEditorInline::end(); ?>
                                <?php
$this->registerJs(<<<JS
         $('#FirstFamilyNameCkEdit$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').click(function() {
             CKEDITOR.instances['FirstFamilyNameCk$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID'].focus();
         $('#FirstFamilyNameCk$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').css('border', '#f9a66d solid');
        $('#FirstFamilyNameCkEdit$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').hide();
        });
        
        CKEDITOR.instances['FirstFamilyNameCk$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID'].on( 'focus', function (ev) {
        $('#FirstFamilyNameCk$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').css('border', '#f9a66d solid');
        $('#FirstFamilyNameCkEdit$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').hide();
        });
     CKEDITOR.instances['FirstFamilyNameCk$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID'].on( 'blur', function (ev) {
        $('#FirstFamilyNameCkEdit$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').show();
         $('#FirstFamilyNameCk$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').css('border', '');
        $.post("add-wedsite-about-family",
                {
                    FimalyMemberID : $FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID,
                    FamilyMemberName:CKEDITOR.instances['FirstFamilyNameCk$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID'].getData() ,
                },
                function (data, status) {

                }); 
		}); 
JS
);
?>
                            </div>
                            <div class="col-md-4 text-right">
                                <span class="edit-link"  style="position: initial;">
                            <a href="#/" id="FirstFamilyNameCkEdit<?=$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID?>"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                          </span>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-right">
                                <span class="edit-link" style="position: initial;">
                            <a href="#/" id="FirstFamilyCkEdit<?=$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID?>"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                          </span>
                            </div>
                        </div>
<?php    dosamigos\ckeditor\CKEditorInline::begin(['preset' => 'basic','id'=>'FirstFamilyCk'.$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID,'options'=>['class'=>'text-justify ab-b-25','style' =>'']]);?>
                       <?=$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_DESCRIPTION!=null ?$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_DESCRIPTION : "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."?>
                        <?php  dosamigos\ckeditor\CKEditorInline::end(); ?>
 <?php
$this->registerJs(<<<JS
         $('#FirstFamilyCkEdit$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').click(function() {
             CKEDITOR.instances['FirstFamilyCk$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID'].focus();
         $('#FirstFamilyCk$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').css('border', '#f9a66d solid');
        $('#FirstFamilyCkEdit$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').hide();
        });
        
        CKEDITOR.instances['FirstFamilyCk$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID'].on( 'focus', function (ev) {
        $('#FirstFamilyCk$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').css('border', '#f9a66d solid');
        $('#FirstFamilyCkEdit$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').hide();
        });
     CKEDITOR.instances['FirstFamilyCk$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID'].on( 'blur', function (ev) {
        $('#FirstFamilyCkEdit$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').show();
         $('#FirstFamilyCk$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').css('border', '');
        $.post("add-wedsite-about",
                {
                    FimalyMemberID : $FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID,
                    FamilyMemberDesc:CKEDITOR.instances['FirstFamilyCk$FirstPartnerFamily->WEDSITE_ABOUT_FAMILY_ID'].getData() ,
                },
                function (data, status) {

                }); 
		}); 
JS
);
?>
                      </div>
      <?php
                        }
                    }
                    ?>
                  
                     
                     
                    </div>




                    <a class="cst-btn-add-gallery-photo ab-b-25 to-trigger-btn" id="addnewfirstfirstmember" role="button" data-toggle="collapse" href="#addNewMember1" aria-expanded="false" aria-controls="addNewMember1">
                    Add New Member
                    </a>

                    <div class="collapse in" id="addNewMember1" >
                      <div class="add-review-block add-new-member-block1 ab-b-25">
                        <h3 class="text-center">Add New Member</h3>
<?php $FirstFamily = ActiveForm::begin([
    
        'id' => 'FirstFamilyForm',
        'action' => ['wedsite/validate-first-family'],
        'method' => 'post',
        'enableAjaxValidation' => true,
        'options' => ['class'=>'form-horizontal']
        
//        'validationUrl' => ['budget/validate'],
//       WedCategoryEstimatedBudget[CATEGORY_ID]
                                                                                        
                                                                                        
    ]); ?>         

                       <div role="presentation" class="dropdown profile-photo" style="margin-bottom: 20px;s">
<!--                                     $FirstPartnerPic="";
$SecondPartnerPic="";-->
                                <div id="image-editorFirstFamily" class="image-editor">
                                    <img src="<?= Yii::getAlias('@web').'/img/about/emptypic.jpg' ?>" id='testtttt123FirstFamily' style="height : 240px;" class="">
                                   
                                        
                                    <div class="cropit-preview cropit-preview-big" id="PreviewImgFirstFamily" style="display : none;" ></div>
<!--                                    <div class="row">
                                        <div class="col-sm-3">-->
                                           <img class="rotate-ccw  imgrotator leftimgrotate" id="rotate-ccwFirstFamily" src="<?=Yii::getAlias('@web') . '/img/left.png'?>" width="16px" alt="" style='margin-right: 2px;'>&nbsp;
                                           <img class="rotate-cw imgrotator " id="rotate-cwFirstFamily" src="<?=Yii::getAlias('@web') . '/img/right.png'?>" width="16px" alt="" style="">  
<!--                                        </div>
                                        <div class="col-sm-5">-->
<input type="range"  id="ImgZoomRangFirstFamily" class=" ImgZoomRang cropit-image-zoom-input cropit-image-zoom-input-big ">
<!--                                        </div>
                                        <div class="col-sm-4">-->
<span id="SpanForSelectFirstFamily" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <a href="#/" id="immediatorselectFirstFamily" class="immediatorselect">Select</a>
                                            <a href="#/" id="exportFirstFamily"  class="export exportbutton">Save</a>
<!--                                        </div>
                                    </div>             -->
          
      
   
   
   <div id="wrapperofselectFirstFamily" class="wrapperofselect">
     
   </div>
    <input type="file" id="cropit-image-inputFirstFamily" class="cropit-image-input"  style="visibility:hidden;">
    </div>
         
                               
                                </div>
                        <?php


$this->registerJs(<<<JS
        $('#cropit-image-inputFirstFamily').change(function (){
            $('#testtttt123FirstFamily').hide();
        $("#ImgZoomRangFirstFamily").show();
        $("#exportFirstFamily").show();
        $("#immediatorselectFirstFamily").show();
        $("#rotate-ccwFirstFamily").show();
        $("#rotate-cwFirstFamily").show();
        $('#PreviewImgFirstFamily').show();
        $('#SpanForSelectFirstFamily').hide();
            }); 
        
         $(function() {
        $("#immediatorselectFirstFamily").on("click" , function(){
            $("#cropit-image-inputFirstFamily").click();
        });
       
        $('#image-editorFirstFamily').cropit({
          exportZoom: 1,
            quality : 0.9,
          imageBackground: true,
          imageBackgroundBorderWidth: 20
          
        });
        $('#exportFirstFamily').click(function() {
          var imageData = $('#image-editorFirstFamily').cropit('export');
//          alert(imageData);
        $('#FirstFamilyImage').val(imageData);
        $('#testtttt123FirstFamily').attr('src',imageData);
         $('#testtttt123FirstFamily').show();
        $('#PreviewImgFirstFamily').hide();
        
   
        $('#cropit-image-inputFirstFamily').val(null);
        $("#ImgZoomRangFirstFamily").hide();
        $("#exportFirstFamily").hide();
        $("#immediatorselectFirstFamily").show();
        $("#rotate-ccwFirstFamily").hide();
        $("#rotate-cwFirstFamily").hide();
        $('#SpanForSelectFirstFamily').show();
        });
        $('#rotate-cwFirstFamily').click(function() {
          $('#image-editorFirstFamily').cropit('rotateCW');
        });
        $('#rotate-ccwFirstFamily').click(function() {
          $('#image-editorFirstFamily').cropit('rotateCCW');
        });

       
      });
 
        
        
           $(document).ready(function() {
   	$(".dropdown.profile-photo").css("height" , "240px");
   	$("#rotate-ccwFirstFamily, #rotate-cwFirstFamily, #ImgZoomRangFirstFamily, #immediatorselectFirstFamily, #exportFirstFamily,#SpanForSelectFirstFamily").wrapAll("<div class='deltagamma' id='deltagammaFirstFamily'></div>");
   	$("#deltagammaFirstFamily").css({"z-index" : "0" , "position" : "absolute" , "transition" : ".8s ease all" , "bottom" : "-35px" , "display" : "none", "left" : "5px"});
   	$("#ImgZoomRangFirstFamily").css({"z-index" : "0","display" :"inline-block"});
   	$("#exportFirstFamily").css({"z-index" : "0", "display" :"inline-block"});
   	$('#sidebarFirstFamily').css({"z-index"  : "100","display" :"inline-block"});
        
        
        $("#ImgZoomRangFirstFamily").hide();
        $("#exportFirstFamily").hide();
        $("#immediatorselectFirstFamily").show();
        $('#SpanForSelectFirstFamily').show();
        $("#rotate-ccwFirstFamily").hide();
        $("#rotate-cwFirstFamily").hide();
   	$("#image-editorFirstFamily").on("mouseenter" , function(){
   		$("#deltagammaFirstFamily").css("bottom" , "12px");
        $("#deltagammaFirstFamily").show( );
   	});
   	$("#image-editorFirstFamily").on("mouseleave" , function(){
        
   		$("#image-editorFirstFamily").css("bottom" , "-35px" );
                $("#deltagammaFirstFamily").hide( );
   	});
   	$("#image-editorFirstFamily").on("mouseenter" , function(){
   		$("#deltagammaFirstFamily").css("bottom" , "12px");
                 $("#deltagammaFirstFamily").show( );
   	});
   	$("#image-editorFirstFamily").on("mouseleave" , function(){
   		$("#deltagammaFirstFamily").css("bottom" , "-35px");
        $("#deltagammaFirstFamily").hide( );
   	});
   });
JS
);
?>
                        

                                                                                                    
                        <?= $FirstFamily->field($FamilyModel, 'WEDSITE_ABOUT_FAMILY_NAME')->textInput(['id'=>'WedsiteAboutFirstName','placeholder'=>"Input name...",'class'=>'form-control add-photo-input-margin11'])->label(false) ?>
                        <?= $FirstFamily->field($FamilyModel, 'WEDSITE_ABOUT_FAMILY_DESCRIPTION')->textarea(['id'=>'WedsiteAboutFirstDEscription','class'=>'form-control','rows'=>"3" ,'placeholder'=>"Review..."])->label(false) ?>
			<?=  $FirstFamily->field($FamilyModel, 'RELATED_TO')->hiddenInput(['value'=>$FirstPartnerID])->label(false)  ?>	
                        <?=  Html::hiddenInput('image','',['id'=>'FirstFamilyImage'])   ?>	
                        <button type="submit" class="btn btn-default">Save</button> 
                                                                          
	
                                                                                                        <?php 
ActiveForm::end();
?>
                        <div id="Tempform" style="display : none;"></div>                                                                              
                                                                                                                                                                                    <?php
$this->registerJs(<<<JS

      $(document).ready(function(){       
$('body').on('submit', '#FirstFamilyForm', function () {
     var form = $(this);
//       alert('adasdas');
     // return false if form still have some validation errors
     if (form.find('.has-error').length) {
          return false;
     }
     // submit form
     $.ajax({
          url: 'save-first-family',
          type: 'post',
          data: form.serialize(),
          success: function (response) {
            $('#addnewfirstfirstmember').click();
        $('#WedsiteAboutFirstName').val('');
         $('#WedsiteAboutFirstDEscription').val('');
   $('#Tempform').load('first-family-form?FamilyID='+response.success,function() {
           $('#FirstFamilyRow').append($('#Tempform').html());
   $('#Tempform').html('');
            })
        
          }
     });
     return false;
});
 });
        
      
JS
);
?>
                                                                                    <script>
      </script>
                        

                      </div>
                    </div>



                  </div>

                  <div class="col-xs-12 col-sm-6 about-pl-40px">
                    <h3 class="text-center rnd-size30 rnd-weight400">Bride's family</h3>

                    <div class="row" id="SecondFamilyRow">
                      <?php
                    if($dataProviderFamilySecondPartner !=null && sizeof($dataProviderFamilySecondPartner)>0){
                        foreach($dataProviderFamilySecondPartner as $SecondPartnerFamily){
                          ?>
       <div class="col-xs-12 col-sm-12 col-md-6">
                  
                        <div role="presentation" class="dropdown profile-photo" style="margin-bottom: 20px;">
<!--                                     $FirstPartnerPic="";
$SecondPartnerPic="";-->
                                <div id="image-editor<?=$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID ?>" class="image-editor">
                                   <img src="<?= $SecondPartnerFamily->FAMILY_MEMBER_PIC!=null  ? Yii::getAlias('@web').'/'.$SecondPartnerFamily->FAMILY_MEMBER_PIC : Yii::getAlias('@web').'/img/about/emptypic.jpg' ?>"  style="height : 240px;"   id='testtttt123<?=$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID ?>' class="">
                                        
                                    <div class="cropit-preview cropit-preview-big" id="PreviewImg<?=$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID ?>" style="display : none;" ></div>
<!--                                    <div class="row">
                                        <div class="col-sm-3">-->
                                           <img class="rotate-ccw  imgrotator leftimgrotate" id="rotate-ccw<?=$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID ?>" src="<?=Yii::getAlias('@web') . '/img/left.png'?>" width="16px" alt="" style='margin-right: 2px;'>&nbsp;
                                           <img class="rotate-cw imgrotator " id="rotate-cw<?=$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID ?>" src="<?=Yii::getAlias('@web') . '/img/right.png'?>" width="16px" alt="" style="">  
<!--                                        </div>
                                        <div class="col-sm-5">-->
<input type="range"  id="ImgZoomRang<?=$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID ?>" class=" ImgZoomRang cropit-image-zoom-input cropit-image-zoom-input-big ">
<!--                                        </div>
                                        <div class="col-sm-4">-->
<span id="SpanForSelect<?=$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID?>" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <a href="#/" id="immediatorselect<?=$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID ?>" class="immediatorselect">Select</a>
                                            <a href="#/" id="export<?=$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID ?>"  class="export exportbutton">Save</a>
<!--                                        </div>
                                    </div>             -->
          
      
   
   
   <div id="wrapperofselect<?=$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID ?>" class="wrapperofselect">
     
   </div>
    <input type="file" id="cropit-image-input<?=$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID ?>" class="cropit-image-input"  style="visibility:hidden;">
    </div>
         
                               
                                </div>
                        <?php


$this->registerJs(<<<JS
        $('#cropit-image-input$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').change(function (){
            $('#testtttt123$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').hide();
        $("#ImgZoomRang$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").show();
        $("#export$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").show();
        $("#immediatorselect$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").show();
        $("#rotate-ccw$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").show();
        $("#rotate-cw$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").show();
        $('#PreviewImg$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').show();
        $('#SpanForSelect$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').hide();
            }); 
        
         $(function() {
        $("#immediatorselect$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").on("click" , function(){
            $("#cropit-image-input$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").click();
        });
       
        $('#image-editor$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').cropit({
          exportZoom: 1,
            quality : 0.9,
          imageBackground: true,
          imageBackgroundBorderWidth: 20
          
        });
        $('#export$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').click(function() {
          var imageData = $('#image-editor$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').cropit('export');
//          alert(imageData);
        $('#testtttt123$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').attr('src',imageData);
          $('#ImgModal$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').modal('toggle');
        $('#testtttt123$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').show();
        $('#PreviewImg$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').hide();
        
        var formData = new FormData();
    formData.append('image',imageData);
        formData.append('FamilyMemberID',$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID);
     
       
    console.log(formData);
        $('#cropit-image-input$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').val(null);
    $.ajax({
        url:'upload-family-img',  //Server script to process data Saveprofileimg
        type: 'POST',

        // Form data
        data: formData,

         // its a function which you have to define

        success: function(response) {
            console.log(response.return);
        $("#ImgZoomRang$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").hide();
        $("#export$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").hide();
        $("#immediatorselect$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").show();
        $("#rotate-ccw$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").hide();
        $("#rotate-cw$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").hide();
        $('#SpanForSelect$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').show();
        
//      $("#testtttt123$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").attr('src', response.return);  
        },

        error: function(){
            alert('ERROR at PHP side!!');
        },


        //Options to tell jQuery not to process data or worry about content-type.
        cache: false,
        contentType: false,
        processData: false
    });
        });
        $('#rotate-cw$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').click(function() {
          $('#image-editor$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').cropit('rotateCW');
        });
        $('#rotate-ccw$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').click(function() {
          $('#image-editor$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').cropit('rotateCCW');
        });

       
      });
 
        
        
           $(document).ready(function() {
   	$(".dropdown.profile-photo").css("height" , "240px");
   	$("#rotate-ccw$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID, #rotate-cw$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID, #ImgZoomRang$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID, #immediatorselect$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID, #export$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID,#SpanForSelect$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").wrapAll("<div class='deltagamma' id='deltagamma$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID'></div>");
   	$("#deltagamma$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").css({"z-index" : "0" , "position" : "absolute" , "transition" : ".8s ease all" , "bottom" : "-35px" , "display" : "none", "left" : "5px"});
   	$("#ImgZoomRang$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").css({"z-index" : "0","display" :"inline-block"});
   	$("#export$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").css({"z-index" : "0", "display" :"inline-block"});
   	$('#sidebar$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').css({"z-index"  : "100","display" :"inline-block"});
        
        
        $("#ImgZoomRang$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").hide();
        $("#export$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").hide();
        $("#immediatorselect$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").show();
        $('#SpanForSelect$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').show();
        $("#rotate-ccw$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").hide();
        $("#rotate-cw$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").hide();
   	$("#image-editor$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").on("mouseenter" , function(){
   		$("#deltagamma$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").css("bottom" , "12px");
        $("#deltagamma$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").show( );
   	});
   	$("#image-editor$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").on("mouseleave" , function(){
        
   		$("#image-editor$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").css("bottom" , "-35px" );
                $("#deltagamma$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").hide( );
   	});
   	$("#image-editor$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").on("mouseenter" , function(){
   		$("#deltagamma$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").css("bottom" , "12px");
                 $("#deltagamma$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").show( );
   	});
   	$("#image-editor$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").on("mouseleave" , function(){
   		$("#deltagamma$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").css("bottom" , "-35px");
        $("#deltagamma$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID").hide( );
   	});
   });
JS
);
?>
                        <div class="row">
                            <div class="col-md-8 ">
                                <?php    dosamigos\ckeditor\CKEditorInline::begin(['preset' => 'basic','id'=>'SecondeFimalyNameCk'.$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID,'options'=>['class'=>'text-justify ab-b-25','style' =>'margin-bottom: 0px;']]);?>
                                <span><?=$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_NAME!=null ?$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_NAME :'enter name'?></span>
                                 <?php  dosamigos\ckeditor\CKEditorInline::end(); ?>
                            </div>
                            
                            <?php
$this->registerJs(<<<JS
         $('#SecondFamlyEdit$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').click(function() {
             CKEDITOR.instances['SecondeFimalyNameCk$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID'].focus();
         $('#SecondeFimalyNameCk$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').css('border', '#f9a66d solid');
        $('#SecondFamlyEdit$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').hide();
        });
        
        CKEDITOR.instances['SecondeFimalyNameCk$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID'].on( 'focus', function (ev) {
        $('#SecondeFimalyNameCk$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').css('border', '#f9a66d solid');
        $('#SecondFamlyEdit$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').hide();
        });
     CKEDITOR.instances['SecondeFimalyNameCk$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID'].on( 'blur', function (ev) {
        $('#SecondFamlyEdit$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').show();
         $('#SecondeFimalyNameCk$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').css('border', '');
        $.post("add-wedsite-about",
                {
                   FimalyMemberID : $SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID,
                    FamilyMemberName:CKEDITOR.instances['SecondeFimalyNameCk$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID'].getData() ,
                },
                function (data, status) {

                }); 
		}); 
JS
);
?>
                            <div class="col-md-4">
                                <span class="edit-link">
                            <a href="#/" id="SecondFamlyEdit<?=$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID?>"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                          </span>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-right">
                                <span class="edit-link" style="position: initial;">
                            <a href="#/" id="SecondFamilyCkEdit<?=$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID?>"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                          </span>
                            </div>
                        </div>
<?php    dosamigos\ckeditor\CKEditorInline::begin(['preset' => 'basic','id'=>'SecondFamilyDesc'.$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID,'options'=>['class'=>'text-justify ab-b-25','style' =>'']]);?>
                       <?=$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_DESCRIPTION!=null ?$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_DESCRIPTION : "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."?>
                        <?php  dosamigos\ckeditor\CKEditorInline::end(); ?>
<?php
$this->registerJs(<<<JS
         $('#SecondFamilyCkEdit$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').click(function() {
             CKEDITOR.instances['SecondFamilyDesc$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID'].focus();
         $('#SecondFamilyDesc$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').css('border', '#f9a66d solid');
        $('#SecondFamilyCkEdit$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').hide();
        });
        
        CKEDITOR.instances['SecondFamilyDesc$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID'].on( 'focus', function (ev) {
        $('#SecondFamilyDesc$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').css('border', '#f9a66d solid');
        $('#SecondFamilyCkEdit$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').hide();
        });
     CKEDITOR.instances['SecondFamilyDesc$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID'].on( 'blur', function (ev) {
        $('#SecondFamilyCkEdit$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').show();
          $('#SecondFamilyDesc$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID').css('border', '');
        $.post("add-wedsite-about",
                {
        
                FimalyMemberID : $SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID,
                FamilyMemberDesc:CKEDITOR.instances['SecondFamilyDesc$SecondPartnerFamily->WEDSITE_ABOUT_FAMILY_ID'].getData() ,
                        
                },
                function (data, status) {

                }); 
		}); 
JS
);
?>
                      </div>
      <?php
                        }
                    }
                    ?>
                    </div>
                    <div id="TempDiv2">
                        
                    </div>
                    <a class="cst-btn-add-gallery-photo ab-b-25 to-trigger-btn" id="addnewSecondfirstmember" role="button" data-toggle="collapse" href="#addNewMember2" aria-expanded="false" aria-controls="addNewMember2">
                    Add New Member
                    </a>

                    <div class="collapse in" id="addNewMember2">
                      <div class="add-review-block add-new-member-block1 ab-b-25">
                        <h3 class="text-center">Add New Member</h3>
<?php $SecondFamily = ActiveForm::begin([
    
        'id' => 'SecondFamilyForm',
        'action' => ['wedsite/validate-first-family'],
        'method' => 'post',
        'enableAjaxValidation' => true,
        'options' => ['class'=>'form-horizontal']
        
//        'validationUrl' => ['budget/validate'],
//       WedCategoryEstimatedBudget[CATEGORY_ID]
                                                                                        
                                                                                        
    ]); ?>         

                        <div role="presentation" class="dropdown profile-photo" style="margin-bottom: 20px;s">
<!--                                     $FirstPartnerPic="";
$SecondPartnerPic="";-->
                                <div id="image-editorSecondFamily" class="image-editor">
                                    <img src="<?= Yii::getAlias('@web').'/img/about/emptypic.jpg' ?>" id='testtttt123SecondFamily' style="height : 240px;" class="">
                                   
                                        
                                    <div class="cropit-preview cropit-preview-big" id="PreviewImgSecondFamily" style="display : none;" ></div>
<!--                                    <div class="row">
                                        <div class="col-sm-3">-->
                                           <img class="rotate-ccw  imgrotator leftimgrotate" id="rotate-ccwSecondFamily" src="<?=Yii::getAlias('@web') . '/img/left.png'?>" width="16px" alt="" style='margin-right: 2px;'>&nbsp;
                                           <img class="rotate-cw imgrotator " id="rotate-cwSecondFamily" src="<?=Yii::getAlias('@web') . '/img/right.png'?>" width="16px" alt="" style="">  
<!--                                        </div>
                                        <div class="col-sm-5">-->
<input type="range"  id="ImgZoomRangSecondFamily" class=" ImgZoomRang cropit-image-zoom-input cropit-image-zoom-input-big ">
<!--                                        </div>
                                        <div class="col-sm-4">-->
<span id="SpanForSelectSecondFamily" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <a href="#/" id="immediatorselectSecondFamily" class="immediatorselect">Select</a>
                                            <a href="#/" id="exportSecondFamily"  class="export exportbutton">Save</a>
<!--                                        </div>
                                    </div>             -->
          
      
   
   
   <div id="wrapperofselectSecondFamily" class="wrapperofselect">
     
   </div>
    <input type="file" id="cropit-image-inputSecondFamily" class="cropit-image-input"  style="visibility:hidden;">
    </div>
         
                               
                                </div>
                        <?php


$this->registerJs(<<<JS
        $('#cropit-image-inputSecondFamily').change(function (){
            $('#testtttt123SecondFamily').hide();
        $("#ImgZoomRangSecondFamily").show();
        $("#exportSecondFamily").show();
        $("#immediatorselectSecondFamily").show();
        $("#rotate-ccwSecondFamily").show();
        $("#rotate-cwSecondFamily").show();
        $('#PreviewImgSecondFamily').show();
        $('#SpanForSelectSecondFamily').hide();
            }); 
        
         $(function() {
        $("#immediatorselectSecondFamily").on("click" , function(){
            $("#cropit-image-inputSecondFamily").click();
        });
       
        $('#image-editorSecondFamily').cropit({
          exportZoom: 1,
            quality : 0.9,
          imageBackground: true,
          imageBackgroundBorderWidth: 20
          
        });
        $('#exportSecondFamily').click(function() {
          var imageData = $('#image-editorSecondFamily').cropit('export');
//          alert(imageData);
        $('#SecondFamilyImage').val(imageData);
        $('#testtttt123SecondFamily').attr('src',imageData);
         $('#testtttt123SecondFamily').show();
        $('#PreviewImgSecondFamily').hide();
        
   
        $('#cropit-image-inputSecondFamily').val(null);
        $("#ImgZoomRangSecondFamily").hide();
        $("#exportSecondFamily").hide();
        $("#immediatorselectSecondFamily").show();
        $("#rotate-ccwSecondFamily").hide();
        $("#rotate-cwSecondFamily").hide();
        $('#SpanForSelectSecondFamily').show();
        });
        $('#rotate-cwSecondFamily').click(function() {
          $('#image-editorSecondFamily').cropit('rotateCW');
        });
        $('#rotate-ccwSecondFamily').click(function() {
          $('#image-editorSecondFamily').cropit('rotateCCW');
        });

       
      });
 
        
        
           $(document).ready(function() {
   	$(".dropdown.profile-photo").css("height" , "240px");
   	$("#rotate-ccwSecondFamily, #rotate-cwSecondFamily, #ImgZoomRangSecondFamily, #immediatorselectSecondFamily, #exportSecondFamily,#SpanForSelectSecondFamily").wrapAll("<div class='deltagamma' id='deltagammaSecondFamily'></div>");
   	$("#deltagammaSecondFamily").css({"z-index" : "0" , "position" : "absolute" , "transition" : ".8s ease all" , "bottom" : "-35px" , "display" : "none", "left" : "5px"});
   	$("#ImgZoomRangSecondFamily").css({"z-index" : "0","display" :"inline-block"});
   	$("#exportSecondFamily").css({"z-index" : "0", "display" :"inline-block"});
   	$('#sidebarSecondFamily').css({"z-index"  : "100","display" :"inline-block"});
        
        
        $("#ImgZoomRangSecondFamily").hide();
        $("#exportSecondFamily").hide();
        $("#immediatorselectSecondFamily").show();
        $('#SpanForSelectSecondFamily').show();
        $("#rotate-ccwSecondFamily").hide();
        $("#rotate-cwSecondFamily").hide();
   	$("#image-editorSecondFamily").on("mouseenter" , function(){
   		$("#deltagammaSecondFamily").css("bottom" , "12px");
        $("#deltagammaSecondFamily").show( );
   	});
   	$("#image-editorSecondFamily").on("mouseleave" , function(){
        
   		$("#image-editorSecondFamily").css("bottom" , "-35px" );
                $("#deltagammaSecondFamily").hide( );
   	});
   	$("#image-editorSecondFamily").on("mouseenter" , function(){
   		$("#deltagammaSecondFamily").css("bottom" , "12px");
                 $("#deltagammaSecondFamily").show( );
   	});
   	$("#image-editorSecondFamily").on("mouseleave" , function(){
   		$("#deltagammaSecondFamily").css("bottom" , "-35px");
        $("#deltagammaSecondFamily").hide( );
   	});
   });
JS
);
?>
                        

                                                                                                    
                        <?= $SecondFamily->field($FamilyModel, 'WEDSITE_ABOUT_FAMILY_NAME')->textInput(['id'=>'WedsiteAboutSecondName','placeholder'=>"Input name...",'class'=>'form-control add-photo-input-margin11'])->label(false) ?>
                        <?= $SecondFamily->field($FamilyModel, 'WEDSITE_ABOUT_FAMILY_DESCRIPTION')->textarea(['id'=>'WedsiteAboutSecondDEscription','class'=>'form-control','rows'=>"3" ,'placeholder'=>"Review..."])->label(false) ?>
			<?=  $SecondFamily->field($FamilyModel, 'RELATED_TO')->hiddenInput(['value'=>$SecondPartnerID])->label(false)  ?>	
                        <?=  Html::hiddenInput('image','',['id'=>'SecondFamilyImage'])   ?>    
                        <button type="submit" class="btn btn-default">Save</button> 
                                                                          
	
                                                                                                        <?php 
ActiveForm::end();
?>
                        <div id="Tempform" style="display : none;"></div>                                                                              
                                                                                                                                                                                    <?php
$this->registerJs(<<<JS

      $(document).ready(function(){       
$('body').on('submit', '#SecondFamilyForm', function () {
     var form = $(this);
//       alert('adasdas');
     // return false if form still have some validation errors
     if (form.find('.has-error').length) {
          return false;
     }
     // submit form
     $.ajax({
          url: 'save-first-family',
          type: 'post',
          data: form.serialize(),
          success: function (response) {
            $('#addnewSecondfirstmember').click();
        $('#WedsiteAboutSecondName').val('');
         $('#WedsiteAboutSecondDEscription').val('');
   $('#TempDiv2').load('first-family-form?FamilyID='+response.success,function() {
           $('#SecondFamilyRow').append($('#TempDiv2').html());
   $('#TempDiv2').html('');
            })
        
          }
     });
     return false;
});
 });
        
      
JS
);
?>
                                                                                    <script>
      </script>
                        

                      </div>
                    </div>                    
                  </div>

                </div>              
              </div>







              <div class="row fifth-row ab-b-25">
                <div class="col-xs-12 col-sm-12">
                  <h3 class="text-center rnd-size30">Wedding Team
                    <span class="edit-link">
                      <a href="#"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                    </span>
                  </h3>  

                  <div class="col-xs-12 col-sm-6 about-pr-40px">

                    <div class="row" id="FirstTeamMeber">
<!--                        'dataProviderFirstTeam'=>$dataProviderFirstTeam,
                    'dataProviderSecondTeam'=>$dataProviderSecondTeam,-->
                     <?php
                    if($dataProviderFirstTeam !=null && sizeof($dataProviderFirstTeam)>0){
                        foreach($dataProviderFirstTeam as $FirstTeam){
                          ?>
       <div class="col-xs-12 col-sm-12 col-md-6">
                      
                        <div role="presentation" class="dropdown profile-photo" style="margin-bottom: 20px;">
<!--                                     $FirstPartnerPic="";
$SecondPartnerPic="";-->
                                <div id="image-editorr<?=$FirstTeam->WEDSITE_ABOUT_TEAM_ID ?>" class="image-editor">
                                   <img src="<?= $FirstTeam->TEAM_MEMBER_PIC!=null  ? Yii::getAlias('@web').'/'.$FirstTeam->TEAM_MEMBER_PIC : Yii::getAlias('@web').'/img/about/emptypic.jpg' ?>"  style="height : 240px;"   id='testtttt123A<?=$FirstTeam->WEDSITE_ABOUT_TEAM_ID ?>' class="">
                                        
                                    <div class="cropit-preview cropit-preview-big" id="PreviewImgg<?=$FirstTeam->WEDSITE_ABOUT_TEAM_ID ?>" style="display : none;" ></div>
<!--                                    <div class="row">
                                        <div class="col-sm-3">-->
                                           <img class="rotate-ccw  imgrotator leftimgrotate" id="rotate-ccww<?=$FirstTeam->WEDSITE_ABOUT_TEAM_ID ?>" src="<?=Yii::getAlias('@web') . '/img/left.png'?>" width="16px" alt="" style='margin-right: 2px;'>&nbsp;
                                           <img class="rotate-cw imgrotator " id="rotate-cww<?=$FirstTeam->WEDSITE_ABOUT_TEAM_ID ?>" src="<?=Yii::getAlias('@web') . '/img/right.png'?>" width="16px" alt="" style="">  
<!--                                        </div>
                                        <div class="col-sm-5">-->
<input type="range"  id="ImgZoomRangg<?=$FirstTeam->WEDSITE_ABOUT_TEAM_ID ?>" class=" ImgZoomRang cropit-image-zoom-input cropit-image-zoom-input-big ">
<!--                                        </div>
                                        <div class="col-sm-4">-->
<span id="SpanForSelectt<?=$FirstTeam->WEDSITE_ABOUT_TEAM_ID?>" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <a href="#/" id="immediatorselectt<?=$FirstTeam->WEDSITE_ABOUT_TEAM_ID ?>" class="immediatorselect">Select</a>
                                            <a href="#/" id="exportt<?=$FirstTeam->WEDSITE_ABOUT_TEAM_ID ?>"  class="export exportbutton">Save</a>
<!--                                        </div>
                                    </div>             -->
          
      
   
   
   <div id="wrapperofselectt<?=$FirstTeam->WEDSITE_ABOUT_TEAM_ID ?>" class="wrapperofselect">
     
   </div>
    <input type="file" id="cropit-image-inputt<?=$FirstTeam->WEDSITE_ABOUT_TEAM_ID ?>" class="cropit-image-input"  style="visibility:hidden;">
    </div>
         
                               
                                </div>
                        <?php


$this->registerJs(<<<JS
        $('#cropit-image-inputt$FirstTeam->WEDSITE_ABOUT_TEAM_ID').change(function (){
            $('#testtttt123A$FirstTeam->WEDSITE_ABOUT_TEAM_ID').hide();
        $("#ImgZoomRangg$FirstTeam->WEDSITE_ABOUT_TEAM_ID").show();
        $("#exportt$FirstTeam->WEDSITE_ABOUT_TEAM_ID").show();
        $("#immediatorselectt$FirstTeam->WEDSITE_ABOUT_TEAM_ID").show();
        $("#rotate-ccww$FirstTeam->WEDSITE_ABOUT_TEAM_ID").show();
        $("#rotate-cww$FirstTeam->WEDSITE_ABOUT_TEAM_ID").show();
        $('#PreviewImgg$FirstTeam->WEDSITE_ABOUT_TEAM_ID').show();
        $('#SpanForSelectt$FirstTeam->WEDSITE_ABOUT_TEAM_ID').hide();
            }); 
        
         $(function() {
        $("#immediatorselectt$FirstTeam->WEDSITE_ABOUT_TEAM_ID").on("click" , function(){
            $("#cropit-image-inputt$FirstTeam->WEDSITE_ABOUT_TEAM_ID").click();
        });
       
        $('#image-editorr$FirstTeam->WEDSITE_ABOUT_TEAM_ID').cropit({
          exportZoom: 1,
            quality : 0.9,
          imageBackground: true,
          imageBackgroundBorderWidth: 20
          
        });
        $('#exportt$FirstTeam->WEDSITE_ABOUT_TEAM_ID').click(function() {
          var imageData = $('#image-editorr$FirstTeam->WEDSITE_ABOUT_TEAM_ID').cropit('export');
//          alert(imageData);
        $('#testtttt123A$FirstTeam->WEDSITE_ABOUT_TEAM_ID').attr('src',imageData);
          $('#ImgModall$FirstTeam->WEDSITE_ABOUT_TEAM_ID').modal('toggle');
        $('#testtttt123A$FirstTeam->WEDSITE_ABOUT_TEAM_ID').show();
        $('#PreviewImgg$FirstTeam->WEDSITE_ABOUT_TEAM_ID').hide();
        
        var formData = new FormData();
    formData.append('image',imageData);
        formData.append('TeamMemberID',$FirstTeam->WEDSITE_ABOUT_TEAM_ID);
     
       
    console.log(formData);
        $('#cropit-image-inputt$FirstTeam->WEDSITE_ABOUT_TEAM_ID').val(null);
    $.ajax({
        url:'upload-team-img',  //Server script to process data Saveprofileimg
        type: 'POST',

        // Form data
        data: formData,

         // its a function which you have to define

        success: function(response) {
            console.log(response.return);
        $("#ImgZoomRangg$FirstTeam->WEDSITE_ABOUT_TEAM_ID").hide();
        $("#exportt$FirstTeam->WEDSITE_ABOUT_TEAM_ID").hide();
        $("#immediatorselectt$FirstTeam->WEDSITE_ABOUT_TEAM_ID").show();
        $("#rotate-ccww$FirstTeam->WEDSITE_ABOUT_TEAM_ID").hide();
        $("#rotate-cww$FirstTeam->WEDSITE_ABOUT_TEAM_ID").hide();
        $('#SpanForSelectt$FirstTeam->WEDSITE_ABOUT_TEAM_ID').show();
        
//      $("#testtttt123A$FirstTeam->WEDSITE_ABOUT_TEAM_ID").attr('src', response.return);  
        },

        error: function(){
            alert('ERROR at PHP side!!');
        },


        //Options to tell jQuery not to process data or worry about content-type.
        cache: false,
        contentType: false,
        processData: false
    });
        });
        $('#rotate-cww$FirstTeam->WEDSITE_ABOUT_TEAM_ID').click(function() {
          $('#image-editorr$FirstTeam->WEDSITE_ABOUT_TEAM_ID').cropit('rotateCW');
        });
        $('#rotate-ccww$FirstTeam->WEDSITE_ABOUT_TEAM_ID').click(function() {
          $('#image-editorr$FirstTeam->WEDSITE_ABOUT_TEAM_ID').cropit('rotateCCW');
        });

       
      });
 
        
        
           $(document).ready(function() {
   	$(".dropdown.profile-photo").css("height" , "240px");
   	$("#rotate-ccww$FirstTeam->WEDSITE_ABOUT_TEAM_ID, #rotate-cww$FirstTeam->WEDSITE_ABOUT_TEAM_ID, #ImgZoomRangg$FirstTeam->WEDSITE_ABOUT_TEAM_ID, #immediatorselectt$FirstTeam->WEDSITE_ABOUT_TEAM_ID, #exportt$FirstTeam->WEDSITE_ABOUT_TEAM_ID,#SpanForSelectt$FirstTeam->WEDSITE_ABOUT_TEAM_ID").wrapAll("<div class='deltagamma' id='deltagammaa$FirstTeam->WEDSITE_ABOUT_TEAM_ID'></div>");
   	$("#deltagammaa$FirstTeam->WEDSITE_ABOUT_TEAM_ID").css({"z-index" : "0" , "position" : "absolute" , "transition" : ".8s ease all" , "bottom" : "-35px" , "display" : "none", "left" : "5px"});
   	$("#ImgZoomRangg$FirstTeam->WEDSITE_ABOUT_TEAM_ID").css({"z-index" : "0","display" :"inline-block"});
   	$("#exportt$FirstTeam->WEDSITE_ABOUT_TEAM_ID").css({"z-index" : "0", "display" :"inline-block"});
   	$('#sidebarr$FirstTeam->WEDSITE_ABOUT_TEAM_ID').css({"z-index"  : "100","display" :"inline-block"});
        
        
        $("#ImgZoomRangg$FirstTeam->WEDSITE_ABOUT_TEAM_ID").hide();
        $("#exportt$FirstTeam->WEDSITE_ABOUT_TEAM_ID").hide();
        $("#immediatorselectt$FirstTeam->WEDSITE_ABOUT_TEAM_ID").show();
        $('#SpanForSelectt$FirstTeam->WEDSITE_ABOUT_TEAM_ID').show();
        $("#rotate-ccww$FirstTeam->WEDSITE_ABOUT_TEAM_ID").hide();
        $("#rotate-cww$FirstTeam->WEDSITE_ABOUT_TEAM_ID").hide();
   	$("#image-editorr$FirstTeam->WEDSITE_ABOUT_TEAM_ID").on("mouseenter" , function(){
   		$("#deltagammaa$FirstTeam->WEDSITE_ABOUT_TEAM_ID").css("bottom" , "12px");
        $("#deltagammaa$FirstTeam->WEDSITE_ABOUT_TEAM_ID").show( );
   	});
   	$("#image-editorr$FirstTeam->WEDSITE_ABOUT_TEAM_ID").on("mouseleave" , function(){
        
   		$("#image-editorr$FirstTeam->WEDSITE_ABOUT_TEAM_ID").css("bottom" , "-35px" );
                $("#deltagammaa$FirstTeam->WEDSITE_ABOUT_TEAM_ID").hide( );
   	});
   	$("#image-editorr$FirstTeam->WEDSITE_ABOUT_TEAM_ID").on("mouseenter" , function(){
   		$("#deltagammaa$FirstTeam->WEDSITE_ABOUT_TEAM_ID").css("bottom" , "12px");
                 $("#deltagammaa$FirstTeam->WEDSITE_ABOUT_TEAM_ID").show( );
   	});
   	$("#image-editorr$FirstTeam->WEDSITE_ABOUT_TEAM_ID").on("mouseleave" , function(){
   		$("#deltagammaa$FirstTeam->WEDSITE_ABOUT_TEAM_ID").css("bottom" , "-35px");
        $("#deltagammaa$FirstTeam->WEDSITE_ABOUT_TEAM_ID").hide( );
   	});
   });
JS
);
?>
                        
                        <div class="row">
                            <div class="col-md-8">
                                <?php    dosamigos\ckeditor\CKEditorInline::begin(['preset' => 'basic','id'=>'FirstTeamNameCk'.$FirstTeam->WEDSITE_ABOUT_TEAM_ID,'options'=>['class'=>'text-justify ab-b-25','style' =>'margin-bottom: 0px;']]);?>
                                <?=$FirstTeam->WEDSITE_ABOUT_TEAM_MEMBER_NAME!=null ?$FirstTeam->WEDSITE_ABOUT_TEAM_MEMBER_NAME :'enter name'?> 
                                <?php  dosamigos\ckeditor\CKEditorInline::end(); ?>
                           <?php
$this->registerJs(<<<JS
         $('#FirstTeamNameCkEdit$FirstTeam->WEDSITE_ABOUT_TEAM_ID').click(function() {
         CKEDITOR.instances['FirstTeamNameCk$FirstTeam->WEDSITE_ABOUT_TEAM_ID'].focus();
         $('#FirstTeamNameCk$FirstTeam->WEDSITE_ABOUT_TEAM_ID').css('border', '#f9a66d solid');
        $('#FirstTeamNameCkEdit$FirstTeam->WEDSITE_ABOUT_TEAM_ID').hide();
        });
        
        CKEDITOR.instances['FirstTeamNameCk$FirstTeam->WEDSITE_ABOUT_TEAM_ID'].on( 'focus', function (ev) {
        $('#FirstTeamNameCk$FirstTeam->WEDSITE_ABOUT_TEAM_ID').css('border', '#f9a66d solid');
        $('#FirstTeamNameCkEdit$FirstTeam->WEDSITE_ABOUT_TEAM_ID').hide();
        });
     CKEDITOR.instances['FirstTeamNameCk$FirstTeam->WEDSITE_ABOUT_TEAM_ID'].on( 'blur', function (ev) {
        $('#FirstTeamNameCkEdit$FirstTeam->WEDSITE_ABOUT_TEAM_ID').show();
         $('#FirstTeamNameCk$FirstTeam->WEDSITE_ABOUT_TEAM_ID').css('border', '');
        $.post("add-wedsite-about-team",
                {
                    TeamMemberID : $FirstTeam->WEDSITE_ABOUT_TEAM_ID,
                    TeamMemberName:CKEDITOR.instances['FirstTeamNameCk$FirstTeam->WEDSITE_ABOUT_TEAM_ID'].getData() ,
                },
                function (data, status) {

                }); 
		}); 
JS
);
?>
                            </div>
                            
                            <div class="col-md-4">
                                <span class="edit-link">
                            <a href="#/" id="FirstTeamNameCkEdit<?=$FirstTeam->WEDSITE_ABOUT_TEAM_ID?>"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                          </span>
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 text-right">
                                <span class="edit-link" style="position: initial;">
                            <a href="#/" id="FirstTeamCkEdit<?=$FirstTeam->WEDSITE_ABOUT_TEAM_ID?>"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                          </span>
                            </div>
                        </div>
                        
<?php    dosamigos\ckeditor\CKEditorInline::begin(['preset' => 'basic','id'=>'FirstTeamDesc'.$FirstTeam->WEDSITE_ABOUT_TEAM_ID,'options'=>['class'=>'text-justify ab-b-25','style' =>'']]);?>
                       <?=$FirstTeam->WEDSITE_ABOUT_TEAM_MEMBER_DESC!=null ?$FirstTeam->WEDSITE_ABOUT_TEAM_MEMBER_DESC : "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."?>
                        <?php  dosamigos\ckeditor\CKEditorInline::end(); ?>
 <?php
$this->registerJs(<<<JS
         $('#FirstTeamCkEdit$FirstTeam->WEDSITE_ABOUT_TEAM_ID').click(function() {
         CKEDITOR.instances['FirstTeamDesc$FirstTeam->WEDSITE_ABOUT_TEAM_ID'].focus();
         $('#FirstTeamDesc$FirstTeam->WEDSITE_ABOUT_TEAM_ID').css('border', '#f9a66d solid');
        $('#FirstTeamCkEdit$FirstTeam->WEDSITE_ABOUT_TEAM_ID').hide();
        });
        
        CKEDITOR.instances['FirstTeamDesc$FirstTeam->WEDSITE_ABOUT_TEAM_ID'].on( 'focus', function (ev) {
        $('#FirstTeamDesc$FirstTeam->WEDSITE_ABOUT_TEAM_ID').css('border', '#f9a66d solid');
        $('#FirstTeamCkEdit$FirstTeam->WEDSITE_ABOUT_TEAM_ID').hide();
        });
     CKEDITOR.instances['FirstTeamDesc$FirstTeam->WEDSITE_ABOUT_TEAM_ID'].on( 'blur', function (ev) {
        $('#FirstTeamCkEdit$FirstTeam->WEDSITE_ABOUT_TEAM_ID').show();
         $('#FirstTeamDesc$FirstTeam->WEDSITE_ABOUT_TEAM_ID').css('border', '');
        $.post("add-wedsite-about-team",
                {
                    TeamMemberID : $FirstTeam->WEDSITE_ABOUT_TEAM_ID,
                    TeamMemberDesc:CKEDITOR.instances['FirstTeamDesc$FirstTeam->WEDSITE_ABOUT_TEAM_ID'].getData() ,
                },
                function (data, status) {

                }); 
		}); 
JS
);
?>
                      </div>
      <?php
                        }
                    }
                    ?>
                    </div>

                    <a class="cst-btn-add-gallery-photo ab-b-25 to-trigger-btn" role="button" id="AddFirstTeamMember" data-toggle="collapse" href="#addNewMember3" aria-expanded="false" aria-controls="addNewMember3">
                    Add New Member
                    </a>

                    <div class="collapse in" id="addNewMember3">
                      <div class="add-review-block add-new-member-block1 ab-b-25">
                        <h3 class="text-center">Add New Member</h3>
<?php $FirstTeam = ActiveForm::begin([
    
        'id' => 'FirstTeamForm',
        'action' => ['wedsite/validate-team'],
        'method' => 'post',
        'enableAjaxValidation' => true,
        'options' => ['class'=>'form-horizontal']
        
//        'validationUrl' => ['budget/validate'],
//       WedCategoryEstimatedBudget[CATEGORY_ID]
                                                                                        
                                                                                        
    ]); ?>         

                        <div id="croppic3"></div>
                        

                                                                                                    
                        <?= $FirstTeam->field($TeamModel, 'WEDSITE_ABOUT_TEAM_MEMBER_NAME')->textInput(['id'=>'WedsiteAboutFirstTeamName','placeholder'=>"Input name...",'class'=>'form-control add-photo-input-margin11'])->label(false) ?>
                        <?= $FirstTeam->field($TeamModel, 'WEDSITE_ABOUT_TEAM_MEMBER_DESC')->textarea(['id'=>'WedsiteAboutFirstTeamDEscription','class'=>'form-control','rows'=>"3" ,'placeholder'=>"Review..."])->label(false) ?>
			<?=  $FirstTeam->field($TeamModel, 'RELATED_TO')->hiddenInput(['value'=>$FirstPartnerID])->label(false)  ?>	
                        <button type="submit" class="btn btn-default">Save</button> 
                                                                          
	
                                                                                                        <?php 
ActiveForm::end();
?>
                        <div id="Tempform3" style="display : none;"></div>                                                                              
                                                                                                                                                                                    <?php
$this->registerJs(<<<JS

      $(document).ready(function(){       
$('body').on('submit', '#FirstTeamForm', function () {
     var form = $(this);
//       alert('adasdas');
     // return false if form still have some validation errors
     if (form.find('.has-error').length) {
          return false;
     }
     // submit form
     $.ajax({
          url: 'save-team',
          type: 'post',
          data: form.serialize(),
          success: function (response) {
            $('#AddFirstTeamMember').click();
        $('#WedsiteAboutFirstTeamName').val('');
         $('#WedsiteAboutFirstTeamDEscription').val('');
   $('#Tempform3').load('new-team-member-form?MemberTeamID='+response.success,function() {
           $('#FirstTeamMeber').append($('#Tempform3').html());
   $('#Tempform3').html('');
            })
        
          }
     });
     return false;
});
 });
        
      
JS
);
?>
                                                                                    <script>
      </script>
                        

                      </div>
                    </div>
                  </div>

                  <div class="col-xs-12 col-sm-6 about-pl-40px">

                    <div class="row" id="SecondTeamMemberrrr">
                      <?php
                    if($dataProviderSecondTeam !=null && sizeof($dataProviderSecondTeam)>0){
                        foreach($dataProviderSecondTeam as $SecondTeam){
                          ?>
       <div class="col-xs-12 col-sm-12 col-md-6">
                        <div role="presentation" class="dropdown profile-photo" style="margin-bottom: 20px;">
<!--                                     $FirstPartnerPic="";
$SecondPartnerPic="";-->
                                <div id="image-editorr<?=$SecondTeam->WEDSITE_ABOUT_TEAM_ID ?>" class="image-editor">
                                   <img src="<?= $SecondTeam->TEAM_MEMBER_PIC!=null  ? Yii::getAlias('@web').'/'.$SecondTeam->TEAM_MEMBER_PIC : Yii::getAlias('@web').'/img/about/emptypic.jpg' ?>"  style="height : 240px;"   id='testtttt123A<?=$SecondTeam->WEDSITE_ABOUT_TEAM_ID ?>' class="">
                                        
                                    <div class="cropit-preview cropit-preview-big" id="PreviewImgg<?=$SecondTeam->WEDSITE_ABOUT_TEAM_ID ?>" style="display : none;" ></div>
<!--                                    <div class="row">
                                        <div class="col-sm-3">-->
                                           <img class="rotate-ccw  imgrotator leftimgrotate" id="rotate-ccww<?=$SecondTeam->WEDSITE_ABOUT_TEAM_ID ?>" src="<?=Yii::getAlias('@web') . '/img/left.png'?>" width="16px" alt="" style='margin-right: 2px;'>&nbsp;
                                           <img class="rotate-cw imgrotator " id="rotate-cww<?=$SecondTeam->WEDSITE_ABOUT_TEAM_ID ?>" src="<?=Yii::getAlias('@web') . '/img/right.png'?>" width="16px" alt="" style="">  
<!--                                        </div>
                                        <div class="col-sm-5">-->
<input type="range"  id="ImgZoomRangg<?=$SecondTeam->WEDSITE_ABOUT_TEAM_ID ?>" class=" ImgZoomRang cropit-image-zoom-input cropit-image-zoom-input-big ">
<!--                                        </div>
                                        <div class="col-sm-4">-->
<span id="SpanForSelectt<?=$SecondTeam->WEDSITE_ABOUT_TEAM_ID?>" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <a href="#/" id="immediatorselectt<?=$SecondTeam->WEDSITE_ABOUT_TEAM_ID ?>" class="immediatorselect">Select</a>
                                            <a href="#/" id="exportt<?=$SecondTeam->WEDSITE_ABOUT_TEAM_ID ?>"  class="export exportbutton">Save</a>
<!--                                        </div>
                                    </div>             -->
          
      
   
   
   <div id="wrapperofselectt<?=$SecondTeam->WEDSITE_ABOUT_TEAM_ID ?>" class="wrapperofselect">
     
   </div>
    <input type="file" id="cropit-image-inputt<?=$SecondTeam->WEDSITE_ABOUT_TEAM_ID ?>" class="cropit-image-input"  style="visibility:hidden;">
    </div>
         
                               
                                </div>
                        <?php


$this->registerJs(<<<JS
        $('#cropit-image-inputt$SecondTeam->WEDSITE_ABOUT_TEAM_ID').change(function (){
            $('#testtttt123A$SecondTeam->WEDSITE_ABOUT_TEAM_ID').hide();
        $("#ImgZoomRangg$SecondTeam->WEDSITE_ABOUT_TEAM_ID").show();
        $("#exportt$SecondTeam->WEDSITE_ABOUT_TEAM_ID").show();
        $("#immediatorselectt$SecondTeam->WEDSITE_ABOUT_TEAM_ID").show();
        $("#rotate-ccww$SecondTeam->WEDSITE_ABOUT_TEAM_ID").show();
        $("#rotate-cww$SecondTeam->WEDSITE_ABOUT_TEAM_ID").show();
        $('#PreviewImgg$SecondTeam->WEDSITE_ABOUT_TEAM_ID').show();
        $('#SpanForSelectt$SecondTeam->WEDSITE_ABOUT_TEAM_ID').hide();
            }); 
        
         $(function() {
        $("#immediatorselectt$SecondTeam->WEDSITE_ABOUT_TEAM_ID").on("click" , function(){
            $("#cropit-image-inputt$SecondTeam->WEDSITE_ABOUT_TEAM_ID").click();
        });
       
        $('#image-editorr$SecondTeam->WEDSITE_ABOUT_TEAM_ID').cropit({
          exportZoom: 1,
            quality : 0.9,
          imageBackground: true,
          imageBackgroundBorderWidth: 20
          
        });
        $('#exportt$SecondTeam->WEDSITE_ABOUT_TEAM_ID').click(function() {
          var imageData = $('#image-editorr$SecondTeam->WEDSITE_ABOUT_TEAM_ID').cropit('export');
//          alert(imageData);
        $('#testtttt123A$SecondTeam->WEDSITE_ABOUT_TEAM_ID').attr('src',imageData);
          $('#ImgModall$SecondTeam->WEDSITE_ABOUT_TEAM_ID').modal('toggle');
        $('#testtttt123A$SecondTeam->WEDSITE_ABOUT_TEAM_ID').show();
        $('#PreviewImgg$SecondTeam->WEDSITE_ABOUT_TEAM_ID').hide();
        
        var formData = new FormData();
    formData.append('image',imageData);
        formData.append('TeamMemberID',$SecondTeam->WEDSITE_ABOUT_TEAM_ID);
     
       
    console.log(formData);
        $('#cropit-image-inputt$SecondTeam->WEDSITE_ABOUT_TEAM_ID').val(null);
    $.ajax({
        url:'upload-team-img',  //Server script to process data Saveprofileimg
        type: 'POST',

        // Form data
        data: formData,

         // its a function which you have to define

        success: function(response) {
            console.log(response.return);
        $("#ImgZoomRangg$SecondTeam->WEDSITE_ABOUT_TEAM_ID").hide();
        $("#exportt$SecondTeam->WEDSITE_ABOUT_TEAM_ID").hide();
        $("#immediatorselectt$SecondTeam->WEDSITE_ABOUT_TEAM_ID").show();
        $("#rotate-ccww$SecondTeam->WEDSITE_ABOUT_TEAM_ID").hide();
        $("#rotate-cww$SecondTeam->WEDSITE_ABOUT_TEAM_ID").hide();
        $('#SpanForSelectt$SecondTeam->WEDSITE_ABOUT_TEAM_ID').show();
        
//      $("#testtttt123A$SecondTeam->WEDSITE_ABOUT_TEAM_ID").attr('src', response.return);  
        },

        error: function(){
            alert('ERROR at PHP side!!');
        },


        //Options to tell jQuery not to process data or worry about content-type.
        cache: false,
        contentType: false,
        processData: false
    });
        });
        $('#rotate-cww$SecondTeam->WEDSITE_ABOUT_TEAM_ID').click(function() {
          $('#image-editorr$SecondTeam->WEDSITE_ABOUT_TEAM_ID').cropit('rotateCW');
        });
        $('#rotate-ccww$SecondTeam->WEDSITE_ABOUT_TEAM_ID').click(function() {
          $('#image-editorr$SecondTeam->WEDSITE_ABOUT_TEAM_ID').cropit('rotateCCW');
        });

       
      });
 
        
        
           $(document).ready(function() {
   	$(".dropdown.profile-photo").css("height" , "240px");
   	$("#rotate-ccww$SecondTeam->WEDSITE_ABOUT_TEAM_ID, #rotate-cww$SecondTeam->WEDSITE_ABOUT_TEAM_ID, #ImgZoomRangg$SecondTeam->WEDSITE_ABOUT_TEAM_ID, #immediatorselectt$SecondTeam->WEDSITE_ABOUT_TEAM_ID, #exportt$SecondTeam->WEDSITE_ABOUT_TEAM_ID,#SpanForSelectt$SecondTeam->WEDSITE_ABOUT_TEAM_ID").wrapAll("<div class='deltagamma' id='deltagammaa$SecondTeam->WEDSITE_ABOUT_TEAM_ID'></div>");
   	$("#deltagammaa$SecondTeam->WEDSITE_ABOUT_TEAM_ID").css({"z-index" : "0" , "position" : "absolute" , "transition" : ".8s ease all" , "bottom" : "-35px" , "display" : "none", "left" : "5px"});
   	$("#ImgZoomRangg$SecondTeam->WEDSITE_ABOUT_TEAM_ID").css({"z-index" : "0","display" :"inline-block"});
   	$("#exportt$SecondTeam->WEDSITE_ABOUT_TEAM_ID").css({"z-index" : "0", "display" :"inline-block"});
   	$('#sidebarr$SecondTeam->WEDSITE_ABOUT_TEAM_ID').css({"z-index"  : "100","display" :"inline-block"});
        
        
        $("#ImgZoomRangg$SecondTeam->WEDSITE_ABOUT_TEAM_ID").hide();
        $("#exportt$SecondTeam->WEDSITE_ABOUT_TEAM_ID").hide();
        $("#immediatorselectt$SecondTeam->WEDSITE_ABOUT_TEAM_ID").show();
        $('#SpanForSelectt$SecondTeam->WEDSITE_ABOUT_TEAM_ID').show();
        $("#rotate-ccww$SecondTeam->WEDSITE_ABOUT_TEAM_ID").hide();
        $("#rotate-cww$SecondTeam->WEDSITE_ABOUT_TEAM_ID").hide();
   	$("#image-editorr$SecondTeam->WEDSITE_ABOUT_TEAM_ID").on("mouseenter" , function(){
   		$("#deltagammaa$SecondTeam->WEDSITE_ABOUT_TEAM_ID").css("bottom" , "12px");
        $("#deltagammaa$SecondTeam->WEDSITE_ABOUT_TEAM_ID").show( );
   	});
   	$("#image-editorr$SecondTeam->WEDSITE_ABOUT_TEAM_ID").on("mouseleave" , function(){
        
   		$("#image-editorr$SecondTeam->WEDSITE_ABOUT_TEAM_ID").css("bottom" , "-35px" );
                $("#deltagammaa$SecondTeam->WEDSITE_ABOUT_TEAM_ID").hide( );
   	});
   	$("#image-editorr$SecondTeam->WEDSITE_ABOUT_TEAM_ID").on("mouseenter" , function(){
   		$("#deltagammaa$SecondTeam->WEDSITE_ABOUT_TEAM_ID").css("bottom" , "12px");
                 $("#deltagammaa$SecondTeam->WEDSITE_ABOUT_TEAM_ID").show( );
   	});
   	$("#image-editorr$SecondTeam->WEDSITE_ABOUT_TEAM_ID").on("mouseleave" , function(){
   		$("#deltagammaa$SecondTeam->WEDSITE_ABOUT_TEAM_ID").css("bottom" , "-35px");
        $("#deltagammaa$SecondTeam->WEDSITE_ABOUT_TEAM_ID").hide( );
   	});
   });
JS
);
?>
                        
                        <div class="row">
                            <div class="col-md-8">
                                <?php    dosamigos\ckeditor\CKEditorInline::begin(['preset' => 'basic','id'=>'SecondTeamNameCk'.$SecondTeam->WEDSITE_ABOUT_TEAM_ID,'options'=>['class'=>'text-justify ab-b-25','style' =>'margin-bottom: 0px;']]);?>
                                <?=$SecondTeam->WEDSITE_ABOUT_TEAM_MEMBER_NAME!=null ?$SecondTeam->WEDSITE_ABOUT_TEAM_MEMBER_NAME :'enter name'?>
                                    <?php  dosamigos\ckeditor\CKEditorInline::end(); ?>
                              
                                <?php
$this->registerJs(<<<JS
         $('#SecondTeamEditB$SecondTeam->WEDSITE_ABOUT_TEAM_ID').click(function() {
         CKEDITOR.instances['SecondTeamNameCk$SecondTeam->WEDSITE_ABOUT_TEAM_ID'].focus();
         $('#SecondTeamNameCk$SecondTeam->WEDSITE_ABOUT_TEAM_ID').css('border', '#f9a66d solid');
        $('#SecondTeamEditB$SecondTeam->WEDSITE_ABOUT_TEAM_ID').hide();
        });
        
        CKEDITOR.instances['SecondTeamNameCk$SecondTeam->WEDSITE_ABOUT_TEAM_ID'].on( 'focus', function (ev) {
        $('#SecondTeamNameCk$SecondTeam->WEDSITE_ABOUT_TEAM_ID').css('border', '#f9a66d solid');
        $('#SecondTeamEditB$SecondTeam->WEDSITE_ABOUT_TEAM_ID').hide();
        });
     CKEDITOR.instances['SecondTeamNameCk$SecondTeam->WEDSITE_ABOUT_TEAM_ID'].on( 'blur', function (ev) {
        $('#SecondTeamEditB$SecondTeam->WEDSITE_ABOUT_TEAM_ID').show();
         $('#SecondTeamNameCk$SecondTeam->WEDSITE_ABOUT_TEAM_ID').css('border', '');
        $.post("add-wedsite-about-team",
                {
                    TeamMemberID : $SecondTeam->WEDSITE_ABOUT_TEAM_ID,
                    TeamMemberName:CKEDITOR.instances['SecondTeamNameCk$SecondTeam->WEDSITE_ABOUT_TEAM_ID'].getData() ,
                },
                function (data, status) {

                }); 
		}); 
JS
);
?>
                            </div>
                            <div class="col-md-4">
                                <span class="edit-link">
                            <a href="#/" id="SecondTeamEditB<?=$SecondTeam->WEDSITE_ABOUT_TEAM_ID?>"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                          </span>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-right">
                                <span class="edit-link" style="position: initial;">
                            <a href="#/" id="SecondTeamCkEdit<?=$SecondTeam->WEDSITE_ABOUT_TEAM_ID?>"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                          </span>
                            </div>
                        </div>
<?php    dosamigos\ckeditor\CKEditorInline::begin(['preset' => 'full','id'=>'SecondTeamDesc'.$SecondTeam->WEDSITE_ABOUT_TEAM_ID,'options'=>['class'=>'text-justify ab-b-25','style' =>'']]);?>
                       <?=$SecondTeam->WEDSITE_ABOUT_TEAM_MEMBER_DESC!=null ?$SecondTeam->WEDSITE_ABOUT_TEAM_MEMBER_DESC : "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."?>
                        <?php  dosamigos\ckeditor\CKEditorInline::end(); ?>
                                <?php
$this->registerJs(<<<JS
         $('#SecondTeamCkEdit$SecondTeam->WEDSITE_ABOUT_TEAM_ID').click(function() {
         CKEDITOR.instances['SecondTeamDesc$SecondTeam->WEDSITE_ABOUT_TEAM_ID'].focus();
         $('#SecondTeamDesc$SecondTeam->WEDSITE_ABOUT_TEAM_ID').css('border', '#f9a66d solid');
        $('#SecondTeamCkEdit$SecondTeam->WEDSITE_ABOUT_TEAM_ID').hide();
        });
        
        CKEDITOR.instances['SecondTeamDesc$SecondTeam->WEDSITE_ABOUT_TEAM_ID'].on( 'focus', function (ev) {
        $('#SecondTeamDesc$SecondTeam->WEDSITE_ABOUT_TEAM_ID').css('border', '#f9a66d solid');
        $('#SecondTeamCkEdit$SecondTeam->WEDSITE_ABOUT_TEAM_ID').hide();
        });
     CKEDITOR.instances['SecondTeamDesc$SecondTeam->WEDSITE_ABOUT_TEAM_ID'].on( 'blur', function (ev) {
        $('#SecondTeamCkEdit$SecondTeam->WEDSITE_ABOUT_TEAM_ID').show();
         $('#SecondTeamDesc$SecondTeam->WEDSITE_ABOUT_TEAM_ID').css('border', '');
        $.post("add-wedsite-about-team",
                {
        
                    TeamMemberID : $SecondTeam->WEDSITE_ABOUT_TEAM_ID,
                    TeamMemberDesc:CKEDITOR.instances['SecondTeamDesc$SecondTeam->WEDSITE_ABOUT_TEAM_ID'].getData() ,
                },
                function (data, status) {

                }); 
		}); 
JS
);
?>
                      </div>
      <?php
                        }
                    }
                    ?>
                    </div>
 <div id="Tempform4" style="display : none;"></div>   
                    <a class="cst-btn-add-gallery-photo ab-b-25 to-trigger-btn" id="SecondMemberNew" role="button" data-toggle="collapse" href="#addNewMember4" aria-expanded="false" aria-controls="addNewMember4">
                    Add New Member
                    </a>

                    <div class="collapse in" id="addNewMember4">
                      <div class="add-review-block add-new-member-block1 ab-b-25">
                        <h3 class="text-center">Add New Member</h3>
<?php $SecondTeam = ActiveForm::begin([
    
        'id' => 'SecondTeamForm',
        'action' => ['wedsite/validate-team'],
        'method' => 'post',
        'enableAjaxValidation' => true,
        'options' => ['class'=>'form-horizontal']
        
//        'validationUrl' => ['budget/validate'],
//       WedCategoryEstimatedBudget[CATEGORY_ID]
                                                                                        
                                                                                        
    ]); ?>         

                        <div id="croppic3"></div>
                        

                                                                                                    
                        <?= $SecondTeam->field($TeamModel, 'WEDSITE_ABOUT_TEAM_MEMBER_NAME')->textInput(['id'=>'WedsiteAboutSecondTeamName','placeholder'=>"Input name...",'class'=>'form-control add-photo-input-margin11'])->label(false) ?>
                        <?= $SecondTeam->field($TeamModel, 'WEDSITE_ABOUT_TEAM_MEMBER_DESC')->textarea(['id'=>'WedsiteAboutSecondTeamDEscription','class'=>'form-control','rows'=>"3" ,'placeholder'=>"Review..."])->label(false) ?>
			<?=  $SecondTeam->field($TeamModel, 'RELATED_TO')->hiddenInput(['value'=>$SecondPartnerID])->label(false)  ?>	
                        <button type="submit" class="btn btn-default">Save</button> 
                                                                          
	
                                                                                                        <?php 
ActiveForm::end();
?>
                                                                                                  
                                                                                                                                                                                    <?php
$this->registerJs(<<<JS

      $(document).ready(function(){       
$('body').on('submit', '#SecondTeamForm', function () {
     var form = $(this);
//       alert('adasdas');
     // return false if form still have some validation errors
     if (form.find('.has-error').length) {
          return false;
     }
     // submit form
     $.ajax({
          url: 'save-team',
          type: 'post',
          data: form.serialize(),
          success: function (response) {
            $('#SecondMemberNew').click();
        $('#WedsiteAboutSecondTeamName').val('');
         $('#WedsiteAboutSecondTeamDEscription').val('');
   $('#Tempform4').load('new-team-member-form?MemberTeamID='+response.success,function() {
           $('#SecondTeamMemberrrr').append($('#Tempform4').html());
   $('#Tempform4').html('');
            })
        
          }
     });
     return false;
});
 });
        
      
JS
);
?>
                                                                                    <script>
      </script>
                        

                      </div>
                    </div>                    
                  </div>

                </div>              
              </div>






              <div class="row fifth-row ab-b-25">
                <div class="col-xs-12 col-sm-12">
                  <h3 class="text-center rnd-size30">Your Insight</h3>

                  <div class="your-insight-textarea">
                    <textarea class="form-control ab-b-25" placeholder="Say something to this couple" rows="10"></textarea>
                    <a href="#" class="cst-btn-add-gallery-photo ab-b-25">Send</a>
                  </div>
                </div>
              </div>  

            
            </div>
          </div>

  <script>
    
    var croppicHeaderOptions = {
        uploadUrl:'img_save_to_file.php',
        cropUrl:'img_crop_to_file.php',
        customUploadButtonId:'block-add-new-photo',
        modal:false,
        processInline:true,
        doubleZoomControls:false,
        rotateControls: false,
        imgEyecandy:false,
        loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
        onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
        onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
        onImgDrag: function(){ console.log('onImgDrag') },
        onImgZoom: function(){ console.log('onImgZoom') },
        onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
        onAfterImgCrop:function(){ console.log('onAfterImgCrop') },
        onReset:function(){ console.log('onReset') },
        onError:function(errormessage){ console.log('onError:'+errormessage) }
    } 
    var croppic = new Croppic('croppic', croppicHeaderOptions);

    var croppicHeaderOptions2 = {
        uploadUrl:'img_save_to_file.php',
        cropUrl:'img_crop_to_file.php',
        customUploadButtonId:'block-add-new-photo2',
        modal:false,
        processInline:true,
        doubleZoomControls:false,
        rotateControls: false,
        imgEyecandy:false,
        loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
        onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
        onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
        onImgDrag: function(){ console.log('onImgDrag') },
        onImgZoom: function(){ console.log('onImgZoom') },
        onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
        onAfterImgCrop:function(){ console.log('onAfterImgCrop') },
        onReset:function(){ console.log('onReset') },
        onError:function(errormessage){ console.log('onError:'+errormessage) }
    } 
    var croppic2 = new Croppic('croppic2', croppicHeaderOptions2);



    var croppicHeaderOptions3 = {
        uploadUrl:'img_save_to_file.php',
        cropUrl:'img_crop_to_file.php',
        modal:false,
        processInline:true,
        doubleZoomControls:false,
        rotateControls: false,
        imgEyecandy:false,
        loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
        onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
        onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
        onImgDrag: function(){ console.log('onImgDrag') },
        onImgZoom: function(){ console.log('onImgZoom') },
        onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
        onAfterImgCrop:function(){ console.log('onAfterImgCrop') },
        onReset:function(){ console.log('onReset') },
        onError:function(errormessage){ console.log('onError:'+errormessage) }
    } 
    var croppic3 = new Croppic('croppic3', croppicHeaderOptions3);

    var croppicHeaderOptions4 = {
        uploadUrl:'img_save_to_file.php',
        cropUrl:'img_crop_to_file.php',
        modal:false,
        processInline:true,
        doubleZoomControls:false,
        rotateControls: false,
        imgEyecandy:false,
        loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
        onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
        onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
        onImgDrag: function(){ console.log('onImgDrag') },
        onImgZoom: function(){ console.log('onImgZoom') },
        onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
        onAfterImgCrop:function(){ console.log('onAfterImgCrop') },
        onReset:function(){ console.log('onReset') },
        onError:function(errormessage){ console.log('onError:'+errormessage) }
    } 
    var croppic4 = new Croppic('croppic4', croppicHeaderOptions4);

    var croppicHeaderOptions5 = {
        uploadUrl:'img_save_to_file.php',
        cropUrl:'img_crop_to_file.php',
        modal:false,
        processInline:true,
        doubleZoomControls:false,
        rotateControls: false,
        imgEyecandy:false,
        loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
        onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
        onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
        onImgDrag: function(){ console.log('onImgDrag') },
        onImgZoom: function(){ console.log('onImgZoom') },
        onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
        onAfterImgCrop:function(){ console.log('onAfterImgCrop') },
        onReset:function(){ console.log('onReset') },
        onError:function(errormessage){ console.log('onError:'+errormessage) }
    } 
    var croppic5 = new Croppic('croppic5', croppicHeaderOptions5);

    var croppicHeaderOptions6 = {
        uploadUrl:'img_save_to_file.php',
        cropUrl:'img_crop_to_file.php',
        modal:false,
        processInline:true,
        doubleZoomControls:false,
        rotateControls: false,
        imgEyecandy:false,
        loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
        onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
        onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
        onImgDrag: function(){ console.log('onImgDrag') },
        onImgZoom: function(){ console.log('onImgZoom') },
        onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
        onAfterImgCrop:function(){ console.log('onAfterImgCrop') },
        onReset:function(){ console.log('onReset') },
        onError:function(errormessage){ console.log('onError:'+errormessage) }
    } 
    var croppic6 = new Croppic('croppic6', croppicHeaderOptions6);

  
    </script>


    <script>
      // We can watch for our custom `fileselect` event like this
       $(function() {
	$('.owl-carousel6').owlCarousel({
		margin: 20,
	    loop:true,
		nav:true,
		navText: ["<img src='../img/prev.svg'>","<img src='../img/next.svg'>"],
	    responsiveClass:true,
	    responsive:{
	        0:{
	            items:1	            
	        },
	        768:{
	            items:4
	        },
	        992:{
	            items:4
	        }
	    },
	    autoplay: true,
	    dots: false,
	    autoplayHoverPause: true,
	    autoplayTimeout: 4000
	});
        // We can attach the `fileselect` event to all file inputs on the page
        $(document).on('change', ':file', function() {
          var input = $(this),
              numFiles = input.get(0).files ? input.get(0).files.length : 1,
              label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
          input.trigger('fileselect', [numFiles, label]);
        });

        // We can watch for our custom `fileselect` event like this
        $(document).ready( function() {
            $(':file').on('fileselect', function(event, numFiles, label) {

                var input = $(this).parents('.input-group').find(':text'),
                    log = numFiles > 1 ? numFiles + ' files selected' : label;

                if( input.length ) {
                    input.val(log);
                }

            });
        });
        
      });
    </script>

    <script>
      $(function() {
        $('.to-trigger-btn').trigger('click');
      });
      
    </script>