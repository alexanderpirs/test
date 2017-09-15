<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\models\InviteesCircle;

?>


<style>

    /* EVENTS */
    .event-block1-fluid {
        padding-top: 25px;
        padding-bottom: 50px;
    }

    .event-block1-fluid h3 {
        color: #777777;
        font-weight: 700;
    }

    .event-block1-fluid p {
        color: #777777;
    }

    .e-b-wrap {
        max-width: 921px;
        margin-right: auto;
        margin-left: auto;
        padding: 20px;
        border: 2px solid #fbc49e;
        margin-bottom: 25px;
    }

    .e-b-p1 {
        font-weight: 700;
    }

    .eventAtt {
        color: #fbc49e;
    }

    .e-b-wrap p {
        font-size: 18px;
        margin-bottom: 5px;
    }

    .cst-btn-event-map,
    .form-horizontal.e-rsvp-forms .cst-btn-event-map {
        width: 143px;
        height: 45px;
        border-radius: 19px;
        border: 2px solid #fbc49e;
        line-height: 43px;
        text-align: center;
        color: #777777;
        font-size: 18px;
        float: right;
        text-decoration: none;
        cursor: pointer;
        transition: color .2s ease-in-out,
        background-color .2s ease-in-out;
    }

    .form-horizontal.e-rsvp-forms button.cst-btn-event-map {
        background-color: #ffffff;
        outline: none;
    }

    .form-horizontal.e-rsvp-forms button.cst-btn-event-map:hover,
    .form-horizontal.e-rsvp-forms button.cst-btn-event-map:focus,
    .form-horizontal.e-rsvp-forms button.cst-btn-event-map:active {
        background-color: #fbc49e;
        color: #1d1d1d;
        text-decoration: none;
    }

    .cst-btn-event-map:hover,
    .cst-btn-event-map:focus,
    .cst-btn-event-map:active {
        background-color: #fbc49e;
        color: #1d1d1d;
        text-decoration: none;
    }

    .e-mr-25 {
        margin-right: 25px;
    }

    .modal-dialog {
        width: auto;
        max-width: 871px;
    }

    .modal-content {
        padding: 50px 100px;
        box-shadow: -4px 6px 22px 2px rgba(0, 0, 0, 0.22);
        border-radius: 0;
        border: 0;
    }

    .modal-backdrop.in {
        opacity: 0.7;
        background-color: #feede2;
    }

    .rsvp-modal .rsvp-header {
        color: #666666;
        font-size: 30px;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 25px;
    }

    .rsvp-modal .rsvp-sub-header {
        color: #666666;
        font-size: 24px;
        font-weight: 400;
        margin-bottom: 20px;
    }

    .rsvp-modal .rsvp-sub-header2 {
        color: #666666;
        font-size: 18px;
        font-weight: 400;
        margin-bottom: 20px;
    }

    .event-filt-a-i {
        position: relative;
        color: #666666;
        font-size: 18px;
        font-weight: 400;
        cursor: pointer;
    }

    .event-circle-a-i {
        position: relative;
        width: 14px;
        height: 14px;
        display: inline-block;
        border: 1px solid #f49c6f;
        border-radius: 100%;
        margin-right: 10px;
    }

    .event-circle-a-i-2 {
        position: absolute;
        top: 2px;
        left: 2px;
        width: 8px;
        height: 8px;
        background-color: #f49c6f;
        border-radius: 100%;
        opacity: 0;
        transition: opacity .2s ease-in-out;
    }

    .e-a-i-toggled div div {
        opacity: 1;
    }

    .e-filt-mb-20 {
        margin-bottom: 20px;
    }

    .form-horizontal.e-rsvp-forms .control-label {
        text-align: left;
        color: #666666;
        font-size: 18px;
        font-weight: 400;
    }

    .form-horizontal.e-rsvp-forms .form-control {
        border-radius: 19px;
        border: 1px solid #f39462;
    }

    .rsvp-sub-header3 {
        color: #666666;
        font-size: 18px;
        font-weight: 400;
        margin-bottom: 20px !important;
    }

    .rsvp-radio-label {
        position: relative;
        color: #666666;
        left: 40px;
        font-size: 18px !important;
    }

    @media (max-width: 767px) {
        .e-b-wrap img {
            margin-bottom: 25px;
        }

        .cst-btn-event-map,
        .form-horizontal.e-rsvp-forms button.cst-btn-event-map {
            display: block;
            float: none;
            margin-right: auto;
            margin-left: auto;
            margin-top: 20px;
        }

        .modal-content {
            padding: 15px 20px;
        }

        .modal-dialog {
            margin-bottom: 50px;
        }
    }

    @media (min-width: 768px) {
        .modal-dialog {
            width: auto;
            max-width: 871px;
        }
    }

    @media (min-width: 768px) {
        .modal-dialog {
            width: auto;
            max-width: 700px;
        }
    }

    @media (min-width: 992px) {
        .modal-dialog {
            width: auto;
            max-width: 871px;
        }
    }

    @media (min-width: 768px) {
        #EventsHola {
            /*width: 869px;*/
            /*      margin-right: auto; 
                  margin-left: auto; */
            margin-bottom: 20px;
            text-align: justify;
            position: relative;

        }
    }

    @media (min-width: 992px) {
        #EventsHola {
            width: 869px;
            margin-right: auto;
            margin-left: auto;
            margin-bottom: 20px;
            text-align: justify;
            position: relative;
        }
    }

    .EventHotelClass p {
        font-weight: 700;
    }

    /* END EVENTS */


</style>

<?php
$FormData = "";
if ($WedsiteEventsData != null && sizeof($WedsiteEventsData) > 0) {
    $FormData = $WedsiteEventsData[0]->WEDSITE_EVENT_WELCOME;
}

$WeddingID = 0;
if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
    $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
} else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
    $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
}
?>
<!-- event block1 -->
<div class="container-fluid event-block1-fluid">
    <div class="container event-block1">

        <h3 class="text-center rnd-size30">Titles</h3>

        <?php dosamigos\ckeditor\CKEditorInline::begin(['preset' => 'full', 'id' => 'EventsHola', 'options' => []]); ?>

        <?= $FormData != "" ? $FormData : "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ornare nunc orci, et viverra risus fringilla ac. Nullam quis rutrum eros, vitae scelerisque purus. Suspendisse ullamcorper at arcu sit amet pulvinar. Nam ut porta erat, at gravida elit. Morbi iaculis lorem a lectus ultrices vulputate. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat." ?>

        <?php dosamigos\ckeditor\CKEditorInline::end(); ?>
        <?php
        $this->registerJs(<<<JS
          var SaveDateinstance = CKEDITOR.instances['EventsHola'];
     SaveDateinstance.on( 'blur', function ( ev ) {
//        alert( SaveDateinstance.getData());
        $.post("add-events",
                {
                 EventWelcome:SaveDateinstance.getData() ,
                },
                function (data, status) {
//        alert(data);
                }); 
		});
              

JS
        );
        ?>


        <div class="row">

            <?php
            $p = 0;


            if ($WedEventsData != null && sizeof($WedEventsData) > 0) {
                foreach ($WedEventsData as $Event) {

                    $ImgPath = "";
                    $WedsiteEventInfo = $Event->wEDDINGEVENT->wedsiteEventsInfos;
                    if ($WedsiteEventInfo != null && sizeof($WedsiteEventInfo) > 0) {
                        $ImgPath = $WedsiteEventInfo[0]->EVENT_IMG;
                    }
                    ?>

                    <div class="col-xs-12 col-sm-12">
                        <div class="e-b-wrap">
                            <h3 class="text-center rnd-size30"><?= $Event->wEDDINGEVENT != null && $Event->wEDDINGEVENT->weddingEventTranslations != null && sizeof($Event->wEDDINGEVENT->weddingEventTranslations) > 0 ? $Event->wEDDINGEVENT->weddingEventTranslations[0]->wedding_event_VALUE : "" ?></h3>
                            <div class="row">
                                <div class="col-xs-12 col-sm-4">
                                    <div role="presentation" class="dropdown profile-photo">

                                        <div id="image-editor<?= $Event->WEDDING_EVENT_ID ?>" class="image-editor">
                                            <?= Html::img($ImgPath != "" ? Yii::getAlias('@web') . '/' . $ImgPath : Yii::getAlias('@web') . '/img/emptypic.jpg', ['id' => 'testtttt123' . $Event->WEDDING_EVENT_ID, 'alt' => '', 'class' => '', 'style' => 'height : 240px;height : 240px;margin-left: 0px;margin-right: 0px;']); ?>

                                            <div class="cropit-preview" id="PreviewImg<?= $Event->WEDDING_EVENT_ID ?>"
                                                 style="display : none;"></div>
                                            <!--                                    <div class="row">
                                                                                    <div class="col-sm-3">-->
                                            <img class="rotate-ccw  imgrotator leftimgrotate"
                                                 id="rotate-ccw<?= $Event->WEDDING_EVENT_ID ?>"
                                                 src="<?= Yii::getAlias('@web') . '/img/left.png' ?>" width="16px"
                                                 alt="" style='margin-right: 2px;'>&nbsp;
                                            <img class="rotate-cw imgrotator "
                                                 id="rotate-cw<?= $Event->WEDDING_EVENT_ID ?>"
                                                 src="<?= Yii::getAlias('@web') . '/img/right.png' ?>" width="16px"
                                                 alt="" style="">
                                            <!--                                        </div>
                                                                                    <div class="col-sm-5">-->
                                            <input type="range" id="ImgZoomRang<?= $Event->WEDDING_EVENT_ID ?>"
                                                   class=" ImgZoomRang cropit-image-zoom-input">
                                            <!--                                        </div>
                                                                                    <div class="col-sm-4">-->
<span id="SpanForSelect<?= $Event->WEDDING_EVENT_ID ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <a href="#/" id="immediatorselect<?= $Event->WEDDING_EVENT_ID ?>"
                                               class="immediatorselect">Select</a>
                                            <a href="#/" id="export<?= $Event->WEDDING_EVENT_ID ?>"
                                               class="export exportbutton">Save</a>
                                            <!--                                        </div>
                                                                                </div>             -->


                                            <div id="wrapperofselect<?= $Event->WEDDING_EVENT_ID ?>"
                                                 class="wrapperofselect">

                                            </div>
                                            <input type="file" id="cropit-image-input<?= $Event->WEDDING_EVENT_ID ?>"
                                                   class="cropit-image-input" style="visibility:hidden;">
                                        </div>


                                    </div>
                                    <?php


                                    $this->registerJs(<<<JS
        $('#cropit-image-input$Event->WEDDING_EVENT_ID').change(function (){
            $('#testtttt123$Event->WEDDING_EVENT_ID').hide();
        $("#ImgZoomRang$Event->WEDDING_EVENT_ID").show();
        $("#export$Event->WEDDING_EVENT_ID").show();
        $("#immediatorselect$Event->WEDDING_EVENT_ID").show();
        $("#rotate-ccw$Event->WEDDING_EVENT_ID").show();
        $("#rotate-cw$Event->WEDDING_EVENT_ID").show();
        $('#PreviewImg$Event->WEDDING_EVENT_ID').show();
        $('#SpanForSelect$Event->WEDDING_EVENT_ID').hide();
            }); 
        
         $(function() {
        $("#immediatorselect$Event->WEDDING_EVENT_ID").on("click" , function(){
            $("#cropit-image-input$Event->WEDDING_EVENT_ID").click();
        });
       
        $('#image-editor$Event->WEDDING_EVENT_ID').cropit({
          exportZoom: 1,
            quality : 0.9,
          imageBackground: true,
          imageBackgroundBorderWidth: 20
          
        });
        $('#export$Event->WEDDING_EVENT_ID').click(function() {
          var imageData = $('#image-editor$Event->WEDDING_EVENT_ID').cropit('export');
//          alert(imageData);
        $('#testtttt123$Event->WEDDING_EVENT_ID').attr('src',imageData);
          $('#ImgModal$Event->WEDDING_EVENT_ID').modal('toggle');
        $('#testtttt123$Event->WEDDING_EVENT_ID').show();
        $('#PreviewImg$Event->WEDDING_EVENT_ID').hide();
        
        var formData = new FormData();
    formData.append('image',imageData);
      formData.append('EventID','$Event->WEDDING_EVENT_ID');
    console.log(formData);
        $('#cropit-image-input$Event->WEDDING_EVENT_ID').val(null);
    $.ajax({
        url:'upload-event-img',  //Server script to process data Saveprofileimg
        type: 'POST',

        // Form data
        data: formData,

         // its a function which you have to define

        success: function(response) {
            console.log(response.return);
        $("#ImgZoomRang$Event->WEDDING_EVENT_ID").hide();
        $("#export$Event->WEDDING_EVENT_ID").hide();
        $("#immediatorselect$Event->WEDDING_EVENT_ID").show();
        $("#rotate-ccw$Event->WEDDING_EVENT_ID").hide();
        $("#rotate-cw$Event->WEDDING_EVENT_ID").hide();
        $('#SpanForSelect$Event->WEDDING_EVENT_ID').show();
        
//      $("#testtttt123$Event->WEDDING_EVENT_ID").attr('src', response.return);  
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
        $('#rotate-cw$Event->WEDDING_EVENT_ID').click(function() {
          $('#image-editor$Event->WEDDING_EVENT_ID').cropit('rotateCW');
        });
        $('#rotate-ccw$Event->WEDDING_EVENT_ID').click(function() {
          $('#image-editor$Event->WEDDING_EVENT_ID').cropit('rotateCCW');
        });

       
      });
 
        
        
           $(document).ready(function() {
   	$(".dropdown.profile-photo").css("height" , "250px");
   	$("#rotate-ccw$Event->WEDDING_EVENT_ID, #rotate-cw$Event->WEDDING_EVENT_ID, #ImgZoomRang$Event->WEDDING_EVENT_ID, #immediatorselect$Event->WEDDING_EVENT_ID, #export$Event->WEDDING_EVENT_ID,#SpanForSelect$Event->WEDDING_EVENT_ID").wrapAll("<div class='deltagamma' id='deltagamma$Event->WEDDING_EVENT_ID'></div>");
   	$("#deltagamma$Event->WEDDING_EVENT_ID").css({"z-index" : "0" , "position" : "absolute" , "transition" : ".8s ease all" , "bottom" : "-35px" , "display" : "none", "left" : "5px"});
   	$("#ImgZoomRang$Event->WEDDING_EVENT_ID").css({"z-index" : "0","display" :"inline-block"});
   	$("#export$Event->WEDDING_EVENT_ID").css({"z-index" : "0", "display" :"inline-block"});
   	$('#sidebar$Event->WEDDING_EVENT_ID').css({"z-index"  : "100","display" :"inline-block"});
        
        
        $("#ImgZoomRang$Event->WEDDING_EVENT_ID").hide();
        $("#export$Event->WEDDING_EVENT_ID").hide();
        $("#immediatorselect$Event->WEDDING_EVENT_ID").show();
        $('#SpanForSelect$Event->WEDDING_EVENT_ID').show();
        $("#rotate-ccw$Event->WEDDING_EVENT_ID").hide();
        $("#rotate-cw$Event->WEDDING_EVENT_ID").hide();
   	$("#image-editor$Event->WEDDING_EVENT_ID").on("mouseenter" , function(){
   		$("#deltagamma$Event->WEDDING_EVENT_ID").css("bottom" , "12px");
        $("#deltagamma$Event->WEDDING_EVENT_ID").show( );
   	});
   	$("#image-editor$Event->WEDDING_EVENT_ID").on("mouseleave" , function(){
        
   		$("#image-editor$Event->WEDDING_EVENT_ID").css("bottom" , "-35px" );
                $("#deltagamma$Event->WEDDING_EVENT_ID").hide( );
   	});
   	$("#image-editor$Event->WEDDING_EVENT_ID").on("mouseenter" , function(){
   		$("#deltagamma$Event->WEDDING_EVENT_ID").css("bottom" , "12px");
                 $("#deltagamma$Event->WEDDING_EVENT_ID").show( );
   	});
   	$("#image-editor->WEDDING_EVENT_ID").on("mouseleave" , function(){
   		$("#deltagamma$Event->WEDDING_EVENT_ID").css("bottom" , "-35px");
        $("#deltagamma$Event->WEDDING_EVENT_ID").hide( );
   	});
   });
JS
                                    );
                                    ?>
                                    <!--<img src="<?= $ImgPath != "" ? Yii::getAlias('@web') . '/' . $ImgPath : Yii::getAlias('@web') . '/img/about/emptypic.jpg' ?>" class="img-responsive center-block">-->

                                </div>
                                <div class="col-xs-12 col-sm-8">

                                    <?php dosamigos\ckeditor\CKEditorInline::begin(['preset' => 'full', 'id' => 'EventHotel' . $Event->WEDDING_EVENT_ID, 'options' => ['maxCharCount' => 10, 'class' => 'EventHotelClass', 'style' => 'font-size: 18px;margin-bottom: 5px;']]); ?>
                                    <?= $WedsiteEventInfo != null && sizeof($WedsiteEventInfo) > 0 && $WedsiteEventInfo[0]->EVENT_PLACE_NAME != null ? $WedsiteEventInfo[0]->EVENT_PLACE_NAME : "Crosby Street Hotel" ?>
                                    <?php dosamigos\ckeditor\CKEditorInline::end(); ?>
                                    <?php
                                    $this->registerJs(<<<JS
          
     CKEDITOR.instances['EventHotel$Event->WEDDING_EVENT_ID'].on( 'blur', function ( ev ) {
//        alert( SaveDateinstance.getData());
       $.post("add-event-info",
                {
                 EventID:$Event->WEDDING_EVENT_ID,
                 EventEditHotel : CKEDITOR.instances['EventHotel$Event->WEDDING_EVENT_ID'].getData(),
                 
                },
                function (data, status) {
                }); 
		});
              

JS
                                    );
                                    ?>
                                    <?php dosamigos\ckeditor\CKEditorInline::begin(['preset' => 'full', 'id' => 'EventDate' . $Event->WEDDING_EVENT_ID, 'options' => ['class' => '', 'style' => 'font-size: 18px;margin-bottom: 5px;']]); ?>
                                    <?= $WedsiteEventInfo != null && sizeof($WedsiteEventInfo) > 0 && $WedsiteEventInfo[0]->EVNET_DATE != null ? $WedsiteEventInfo[0]->EVNET_DATE : "Mar 28, 2017 6:30 PM" ?>
                                    <?php dosamigos\ckeditor\CKEditorInline::end(); ?>

                                    <?php
                                    $this->registerJs(<<<JS
        
     CKEDITOR.instances['EventDate$Event->WEDDING_EVENT_ID'].on( 'blur', function ( ev ) {
//        alert( SaveDateinstance.getData());
       $.post("add-event-info",
                {
                 EventID:$Event->WEDDING_EVENT_ID,
                 EventDate : CKEDITOR.instances['EventDate$Event->WEDDING_EVENT_ID'].getData(),
                 
                },
                function (data, status) {
                }); 
		});
              

JS
                                    );
                                    ?>
                                    <?php dosamigos\ckeditor\CKEditorInline::begin(['preset' => 'full', 'id' => 'EventDescription' . $Event->WEDDING_EVENT_ID, 'options' => ['class' => '', 'style' => '    text-align: justify;']]); ?>
                                    <?= $WedsiteEventInfo != null && sizeof($WedsiteEventInfo) > 0 && $WedsiteEventInfo[0]->EVENT_DESCRIPTION != null ? $WedsiteEventInfo[0]->EVENT_DESCRIPTION : "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ornare nunc orci, et viverra risus fringilla ac. Nullam quis rutrum eros, vitae scelerisque purus. Suspendisse ullamcorper at arcu sit amet pulvinar. Nam ut porta erat, at gravida elit. Morbi iaculis lorem a lectus ultrices vulputate." ?>
                                    <?php dosamigos\ckeditor\CKEditorInline::end(); ?>
                                    <?php
                                    $this->registerJs(<<<JS
          
     CKEDITOR.instances['EventDescription$Event->WEDDING_EVENT_ID'].on( 'blur', function ( ev ) {
//        alert( SaveDateinstance.getData());
// alert(CKEDITOR.instances['EventDescription$Event->WEDDING_EVENT_ID'].getData());
       $.post("add-event-info",
                {
                 EventID:$Event->WEDDING_EVENT_ID,
                 EventDescription : CKEDITOR.instances['EventDescription$Event->WEDDING_EVENT_ID'].getData(),
                 
                },
                function (data, status) {
                }); 
		});
              

JS
                                    );
                                    ?>
                                    <p>
                                        <span class='eventAtt'>Attire</span>
                                        <?php dosamigos\ckeditor\CKEditorInline::begin(['preset' => 'full', 'id' => 'EventAttribute' . $Event->WEDDING_EVENT_ID, 'options' => ['class' => '', 'style' => 'display: inline;']]); ?>
                                        <?= $WedsiteEventInfo != null && sizeof($WedsiteEventInfo) > 0 && $WedsiteEventInfo[0]->EVENT_ATTIRE != null ? $WedsiteEventInfo[0]->EVENT_ATTIRE : "Comfy cocktail attire" ?>
                                        <?php dosamigos\ckeditor\CKEditorInline::end(); ?>
                                        <?php
                                        $this->registerJs(<<<JS
          
     CKEDITOR.instances['EventAttribute$Event->WEDDING_EVENT_ID'].on( 'blur', function ( ev ) {
//        alert( SaveDateinstance.getData());
       $.post("add-event-info",
                {
                 EventID:$Event->WEDDING_EVENT_ID,
                 EventAttire : CKEDITOR.instances['EventAttribute$Event->WEDDING_EVENT_ID'].getData(),
                 
                },
                function (data, status) {
                }); 
		});
              

JS
                                        );
                                        ?>
                                    </p>
                                    <p>
                                        <span class='eventAtt'>Address</span>
                                        <?php dosamigos\ckeditor\CKEditorInline::begin(['preset' => 'full', 'id' => 'Address' . $Event->WEDDING_EVENT_ID, 'options' => ['class' => '', 'style' => 'display: inline;']]); ?>
                                        <?= $WedsiteEventInfo != null && sizeof($WedsiteEventInfo) > 0 && $WedsiteEventInfo[0]->EVENT_ADDRESS != null ? $WedsiteEventInfo[0]->EVENT_ADDRESS : " 79 Crosby St New York, NY" ?>
                                        <?php dosamigos\ckeditor\CKEditorInline::end(); ?>
                                        <?php
                                        $this->registerJs(<<<JS
        
     CKEDITOR.instances['Address$Event->WEDDING_EVENT_ID'].on( 'blur', function ( ev ) {
//        alert( SaveDateinstance.getData());
       $.post("add-event-info",
                {
                 EventID:$Event->WEDDING_EVENT_ID,
                 Address : CKEDITOR.instances['Address$Event->WEDDING_EVENT_ID'].getData(),
                 
                },
                function (data, status) {
                }); 
		});
              

JS
                                        );
                                        ?>
                                    </p>
                                    <p>
                                        <span class='eventAtt'>Transport</span>
                                        <?php dosamigos\ckeditor\CKEditorInline::begin(['preset' => 'full', 'id' => 'Transport' . $Event->WEDDING_EVENT_ID, 'options' => ['class' => '', 'style' => 'display: inline;']]); ?>
                                        <?= $WedsiteEventInfo != null && sizeof($WedsiteEventInfo) > 0 && $WedsiteEventInfo[0]->TRANSPORT != null ? $WedsiteEventInfo[0]->TRANSPORT : "By train or buss" ?>
                                        <?php dosamigos\ckeditor\CKEditorInline::end(); ?>
                                        <?php
                                        $this->registerJs(<<<JS
         
     CKEDITOR.instances['Transport$Event->WEDDING_EVENT_ID'].on( 'blur', function ( ev ) {
//        alert( SaveDateinstance.getData());
//alert( CKEDITOR.instances['Transport$Event->WEDDING_EVENT_ID'].getData());
       $.post("add-event-info",
                {
                 EventID:$Event->WEDDING_EVENT_ID,
                 Transport : CKEDITOR.instances['Transport$Event->WEDDING_EVENT_ID'].getData(),
                 
                },
                function (data, status) {
                }); 
		});
              

JS
                                        );
                                        ?>
                                    </p>


                                    <a type="button" class="cst-btn-event-map" data-toggle="modal"
                                       data-target="#ceremonyModal">
                                        RSVP
                                    </a>
                                    <a class="cst-btn-event-map e-mr-25">View on Map</a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="ceremonyModal" tabindex="-1" role="dialog"
                                         aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body rsvp-modal">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <p class="text-center rsvp-header">R.S.V.P.</p>
                                                            <p class="text-center rsvp-sub-header">Will you be gracing
                                                                us with your presence on ceremony?</p>
                                                            <p class="text-center rsvp-sub-header2">A very important
                                                                ceremony is happen on December 24, 2017, and we’d like
                                                                you to come. Will you be available?</p>

                                                            <?php
                                                            $rsvp = new \app\models\Rsvp();
                                                            Pjax::begin(['id' => 'rsvp-form']);
                                                            $form = ActiveForm::begin([
                                                                'method' => 'post',
                                                                'action' => '/wedsite/rsvp-save',
                                                                'options' => ['class' => 'form-horizontal e-rsvp-forms', 'id' => 'rsvp-form']
                                                            ]); ?>

                                                            <div class="radio rsvp-radio-label">
                                                                <?=$form->field($rsvp, 'RSVP_RESPONSE')->radioList([0 => 'Sorry, can’t come', 1 => 'I’m so in!'], [
                                                                    'itemOptions' => [
                                                                        'style' => 'left: 20px !important; border: 1px solid #f49c6f; display: block !important; position: static',
                                                                    ]
                                                                ])->label(false); ?>
                                                            </div>

                                                            <div class="form-group">
                                                                    <label for="inputOfAttendees" class="col-sm-4 control-label">
                                                                        # of attendees
                                                                    </label>
                                                                <div class="col-sm-8">
                                                                    <?= $form->field($rsvp, 'NUMBER_OF_ATTENDEES', [
                                                                        'inputOptions' => [
                                                                            'id'    => 'inputOfAttendees',
                                                                            'class' => 'form-control',
                                                                            'style' => 'max-width:120px;',

                                                                        ]
                                                                    ])->input('text')->label(false); ?>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="inputDietaryRestrictions" class="col-sm-4 control-label">
                                                                    Dietary restrictions
                                                                </label>
                                                                <div class="col-sm-8">
                                                                    <?= $form->field($rsvp, 'DIETARY_RESTRICTIONS', [
                                                                        'inputOptions' => [
                                                                            'id'    => 'inputDietaryRestrictions',
                                                                            'class' => 'form-control'
                                                                        ]
                                                                    ])->input('text')->label(false); ?>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="inputSpecialPreferences" class="col-sm-4 control-label">
                                                                    Specialpreferences
                                                                </label>
                                                                <div class="col-sm-8">
                                                                    <?= $form->field($rsvp, 'SPECIAL_PREFERENCES', [
                                                                        'inputOptions' => [
                                                                            'id'    => 'inputSpecialPreferences',
                                                                            'class' => 'form-control'
                                                                        ]
                                                                    ])->textarea(['rows' => '5'])->label(false); ?>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="inputSeatingPreferences" class="col-sm-4 control-label">
                                                                    Seatingpreferences
                                                                </label>
                                                                <div class="col-sm-8">
                                                                    <?= $form->field($rsvp, 'SEATING_PREFERENCES_ID', [
                                                                        'inputOptions' => [
                                                                            'id'    => 'inputSeatingPreferences',
                                                                            'class' => 'form-control',
                                                                            'style' => 'max-width:120px;',
                                                                        ],
                                                                    ])->dropDownList($rsvp->getInvitesCircleIds())->label(false); ?>
                                                                </div>
                                                            </div>

                                                            <p class="text-center rsvp-sub-header3">Please. respond
                                                                before 12.05.2017<br>
                                                                Call us on +890 222 22 22 if you have any questions.</p>


                                                            <button type="submit" class="cst-btn-event-map">Ok</button>

                                                            <?php ActiveForm::end();
                                                            Pjax::end(); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>


        </div>
    </div>
</div>