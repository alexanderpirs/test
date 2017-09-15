<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use \kartik\select2\Select2;
?>

<style>

    .select2-dropdown {
        z-index: 100000000;
    }


</style>
<?php
$this->registerJs(<<<JS
$(document).ready(function() {
$.fn.modal.Constructor.prototype.enforceFocus = $.noop;
       
        $('#invitees-wedding_event_id').select2();
 });
       
JS
);
?>
<?php
$ManuallyAddInviteeForm = ActiveForm::begin([

            'id' => 'ManuallyAddInviteeForm',
            'action' => ['seating-invitees/new-manual-invitee-validate'],
            'method' => 'post',
        'enableAjaxValidation' => true,
            'enableClientValidation' => false,
//                                    'fieldConfig' => [
//            'template' => "{label}\n{input}\n{hint}"
//        ],
//        'fieldConfig' => ['template' => "{label}\n{input}\n{hint}"],
        ]);
?>
<div class="wrapperofaformqwe">
    <h2>Add Invitee Manually</h2>
</div>


<div class="area-avatar clearfix">
    <img src="assets/img/iconplusddd.png" alt="" class="imgonimg">
    <div class="wrap-avatar">

        <div role="presentation" class="dropdown profile-photo">
            <!--                                     $FirstPartnerPic="";
            $SecondPartnerPic="";-->
            <div id="image-editorIn" class="image-editor">
<?= Html::img($InviteeProvider != null && sizeof($InviteeProvider) && $InviteeProvider[0]->INVITEE_PIC != null ? $InviteeProvider[0]->INVITEE_PIC : Yii::getAlias('@web') . '/img/emptypic.jpg', ['id' => 'InviteeImg', 'alt' => '', 'class' => '', 'style' => 'height : 310px;margin-left: 0px;margin-right: 0px;']); ?>   

                <div class="cropit-preview cropit-preview-big" id="PreviewImgIn" style="display : none;" ></div>
                <!--                                    <div class="row">
                                                        <div class="col-sm-3">-->
                <img class="rotate-ccw  imgrotator leftimgrotate" id="rotate-ccwIn" src="<?= Yii::getAlias('@web') . '/img/left.png' ?>" width="16px" alt="" style='margin-right: 2px;'>&nbsp;
                <img class="rotate-cw imgrotator " id="rotate-cwIn" src="<?= Yii::getAlias('@web') . '/img/right.png' ?>" width="16px" alt="" style="">  
                <!--                                        </div>
                                                        <div class="col-sm-5">-->
                <input type="range"  id="ImgZoomRangIn" class=" ImgZoomRang cropit-image-zoom-input cropit-image-zoom-input-big">
                <!--                                        </div>
                                                        <div class="col-sm-4">-->
                <span id="SpanForSelectIn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <a href="#/" id="immediatorselectIn" class="immediatorselect">Select</a>
                <a href="#/" id="exportIn"  class="export exportbutton">Save</a>
                <!--                                        </div>
                                                    </div>             -->




                <div id="wrapperofselectIn" class="wrapperofselect">

                </div>
                <input type="file" id="cropit-image-inputIn" class="cropit-image-input"  style="visibility:hidden;">
            </div>


        </div>
<!--								<img src="assets/img/person.png" alt="" class="img-thumbnail img-avatar">

                                         <div class="update-caption" style="text-align:center;">
                                                <i class="fa fa-camera" class="minecamera"></i><br/>
                                                Update<br/> Profile Picture
                                        </div> 
                                        <input type="file" class="inputformimg">-->
    </div>
    
    
    <?php


$this->registerJs(<<<JS
        $('#cropit-image-inputIn').change(function (){
            $('#InviteeImg').hide();
        $("#ImgZoomRangIn").show();
        $("#exportIn").show();
        $("#immediatorselectIn").show();
        $("#rotate-ccwIn").show();
        $("#rotate-cwIn").show();
        $('#PreviewImgIn').show();
        $('#SpanForSelectIn').hide();
            }); 
        
         $(function() {
        $("#immediatorselectIn").on("click" , function(){
            $("#cropit-image-inputIn").click();
        });
       
        $('#image-editorIn').cropit({
          exportZoom: 1,
            quality : 0.9,
          imageBackground: true,
          imageBackgroundBorderWidth: 20
          
        });
        $('#exportIn').click(function() {
          var imageData = $('#image-editorIn').cropit('export');
//          alert(imageData);
        $('#InviteeImg').attr('src',imageData);
          $('#ImgModalIn').modal('toggle');
        $('#InviteeImg').show();
        $('#PreviewImgIn').hide();
        
        var formData = new FormData();
    formData.append('image',imageData);
      
    console.log(formData);
        $('#cropit-image-inputIn').val(null);
    $.ajax({
        url:'saveprofileimg',  //Server script to process data Saveprofileimg
        type: 'POST',

        // Form data
        data: formData,

         // its a function which you have to define

        success: function(response) {
            console.log(response.return);
        $("#ImgZoomRangIn").hide();
        $("#exportIn").hide();
        $("#immediatorselectIn").show();
        $("#rotate-ccwIn").hide();
        $("#rotate-cwIn").hide();
        $('#SpanForSelectIn').show();
        $('#InviteesPjax').load('index.php?r=invitees%2Fafter-adding-manually-invitee');
        $('#Statics').load('index.php?r=invitees%2Fafter-any-changes-statistics-invitee');
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
        $('#rotate-cwIn').click(function() {
          $('#image-editorIn').cropit('rotateCW');
        });
        $('#rotate-ccwIn').click(function() {
          $('#image-editorIn').cropit('rotateCCW');
        });

       
      });
 
        
        
           $(document).ready(function() {
   	$(".dropdown.profile-photo").css("height" , "312px");
   	$("#rotate-ccwIn, #rotate-cwIn, #ImgZoomRangIn, #immediatorselectIn, #exportIn,#SpanForSelectIn").wrapAll("<div class='deltagamma' id='deltagammaIn'></div>");
   	$("#deltagammaIn").css({"z-index" : "0" , "position" : "absolute" , "transition" : ".8s ease all" , "bottom" : "-35px" , "display" : "none", "left" : "5px"});
   	$("#ImgZoomRangIn").css({"z-index" : "0","display" :"inline-block"});
   	$("#exportIn").css({"z-index" : "0", "display" :"inline-block"});
   	$('#sidebarIn').css({"z-index"  : "100","display" :"inline-block"});
        
        
        $("#ImgZoomRangIn").hide();
        $("#exportIn").hide();
        $("#immediatorselectIn").show();
        $('#SpanForSelectIn').show();
        $("#rotate-ccwIn").hide();
        $("#rotate-cwIn").hide();
   	$("#image-editorIn").on("mouseenter" , function(){
   		$("#deltagammaIn").css("bottom" , "12px");
        $("#deltagammaIn").show( );
   	});
   	$("#image-editorIn").on("mouseleave" , function(){
        
   		$("#image-editorIn").css("bottom" , "-35px" );
                $("#deltagammaIn").hide( );
   	});
   	$("#image-editorIn").on("mouseenter" , function(){
   		$("#deltagammaIn").css("bottom" , "12px");
                 $("#deltagammaIn").show( );
   	});
   	$("#image-editor->WEDDING_EVENT_ID").on("mouseleave" , function(){
   		$("#deltagammaIn").css("bottom" , "-35px");
        $("#deltagammaIn").hide( );
   	});
   });
JS
);
?>
    
    
    
    
    
    <div class="blockoffirstp">
        <p class="morefonts">Escorting:</p>
        <span class="number alone spanwithval dropdown-toggle" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" type="button" id="DropdownDelta">
            <span>  Alone</span>   <i class="fa fa-caret-down firstdropcaret" aria-hidden="true"></i>
        </span>
        <ul class="dropdown-menu mydrop" id="menudropdown" aria-labelledby="DropdownDelta">
            <li><a  href='#' value='0'>Alone</a></li>
            <li><a  href='#' value='1'>+1 guest</a></li>
            <li><a href="#" value='2'>+2 guest</a></li>
            <li><a href="#" value='3'>+3 guest</a></li>
            <li><a href="#" value='4'>+4 guest</a></li>
            <li><a href="#" value='5'>+5 guest</a></li>
            <li><a href="#" value='6'>+6 guest</a></li>
            <li><a href="#" value='7'>+7 guest</a></li>
            <li><a href="#" value='8'>+8 guest</a></li>
            <li><a href="#" value='9'>+9 guest</a></li>


        </ul>
    </div>
    <div class="blockofsecondp">
        <p class="morefonts">Circles:</p>
        <!---->
<?= Html::hiddenInput('Invitees[INVITEE_CIRCLE_ID]', ($InviteeProvider != null && sizeof($InviteeProvider) && $InviteeProvider[0]->INVITEE_CIRCLE_ID != null ? $InviteeProvider[0]->INVITEE_CIRCLE_ID : ""), ['id' => 'SelectedCircle']) ?>
        <span class="number alone spanwithvalsecond dropdown-toggle" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" type="button" id="DropdownGamma">
            <span>  Groom's family</span>   <i class="fa fa-caret-down secdropcaret" aria-hidden="true"></i>
        </span>
        <ul class="dropdown-menu mydropqwer" id="menudropdownfamily" aria-labelledby="DropdownGamma">
            <!--$CircleDataProvider), 'INVITEE_CIRCLE_ID', 'INVITEE_CIRCLE_TRANS'-->
        <?php
        if ($CircleDataProvider != null && sizeof($CircleDataProvider) > 0) {
            foreach ($CircleDataProvider as $Circle) {
                ?>
                    <li><a  href='#' value='<?= $Circle->INVITEE_CIRCLE_ID ?>'><?= $Circle->INVITEE_CIRCLE_TRANS ?></a></li>
                    <?php
                }
            }
            ?>
            <!--                    <li><a  href='#' value='0'>Groom's family</a></li>
                                <li><a  href='#' value='1'>Mutual friends</a></li>
                                <li><a href="#" value='2'>Groom's colleagues</a></li>
                                <li><a href="#" value='3'>Groom's friends</a></li>
                                 <li><a href="#" value='4'>Bride's family</a></li>
                                 <li><a href="#" value='5'>Bride's friends</a></li>
                            <li><a href="#" value='6'>Bride's colleagues</a></li>
                            <li><a href="#" value='7'>Bride's friends</a></li>
                            <li><a href="#" value='8'>Other</a></li>-->


        </ul>
    </div>

</div>
<?php
$this->registerJs(<<<JS

$(".mydropqwer>li>a").on("click" , function(){
	var dropatext = $(this).text();
	var dropatextval = $(this).attr('value');
	$(".spanwithvalsecond>span").text(dropatext);
	$(".spanwithvalsecond>span").attr('value'  , dropatextval);
	$('#SelectedCircle').val($(this).attr('value'));
	
		
//		var paddingqwe = $('.spanwithval').css('padding-left').toNum() + $('.spanwithval').css('padding-right').toNum();
//		var widthofspan = $('.spanwithval').width() + paddingqwe;
//		$('.blockoffirstp>#menudropdown').css("width" ,  widthofspan);
});
JS
);
?>

<div class="form-group clearfix" style="margin-bottom:0px;">
    <div class="col-xs-2 col-sm-2">
            <!-- <select name="" id="" class="inputborderr">
                    <option value="">Circle</option>
                    <option value="">optional</option>
                    <option value="">optional</option>
            </select> -->
        <div class="gender">
<?= Html::activeDropDownList($InviteesModal, 'FIRST_INVITEE_MSMRS_ID', yii\helpers\ArrayHelper::map(yii\helpers\ArrayHelper::toArray($titles), 'INVITEE_TITLE_ID', 'INVITEE_TITLE_TRANS'), ['class' => 'fullyinputborder', 'prompt' => 'Title', 'onchange' => '', 'options' => [ $InviteeProvider != null && sizeof($InviteeProvider) && $InviteeProvider[0]->FIRST_INVITEE_MSMRS_ID != null ? $InviteeProvider[0]->FIRST_INVITEE_MSMRS_ID : 0 => ['selected' => true]]]) ?>

        </div>
    </div>
    <div class="form-full-name col-xs-10 col-sm-10" style="height: 51px;" >
        <style >
            
            .field-invitees-first_invitee_name{
                width: 100%;
            }
/*            .form-group{
                 height: 51px;
            }
           
            .help-block {
             height: 22px;   
            }*/
        </style>
            <?= $ManuallyAddInviteeForm->field($InviteesModal, 'FIRST_INVITEE_NAME')->textInput( [ 'placeholder' => 'Full Name...', 'class' => 'fullyinputborder', 'value' => $InviteeProvider != null && sizeof($InviteeProvider) && $InviteeProvider[0]->FIRST_INVITEE_NAME != null ? $InviteeProvider[0]->FIRST_INVITEE_NAME : ""])->label(false) ?>
        <!-- <div class="fullname">
                <input type="text" placeholder="Full name" class="inputcolwithoutborder">
                <select name="" class="borderrightcol">
                        <option value="">Place with</option>
                        <option value="">Optional</option>
                </select>
        </div> -->
    </div>
</div>

<div class="form-group clearfix" style="height: 1px;">
    <div class="col-xs-2 col-sm-2">
    </div>
    <div class="col-xs-10 col-sm-10 form-dynamic">
        <!-- Default 0 row -->
    </div>
</div>



<div class="form-group clearfix">
    <div class="col-xs-2 col-sm-2">
        <label for="" class="Textinmodal">Place with:</label>
    </div>
    <div class="form-full-name col-xs-10 col-sm-10 " style="padding-right: 31px;padding-left: 28px;">
<?= Html::activeDropDownList($InviteesModal, 'INVITEE_PLACE_WITH_ID', yii\helpers\ArrayHelper::map(yii\helpers\ArrayHelper::toArray($PlaceWithDataProvider), 'INVITEE_PLACE_WITH_ID', 'INVITEE_PALCE_WITH_VALUE'), ['class' => 'fullyinputborder', 'prompt' => 'Place With', 'onchange' => '', 'options' => [ $InviteeProvider != null && sizeof($InviteeProvider) && $InviteeProvider[0]->INVITEE_PLACE_WITH_ID != null ? $InviteeProvider[0]->INVITEE_PLACE_WITH_ID : 0 => ['selected' => true]]]) ?>
    </div>
</div>
<div class="form-group clearfix">
    <div class="col-xs-2 col-sm-2">
        <label for="" class="Textinmodal">Select events:</label>
    </div>
    <div class="col-xs-10 col-sm-10">

<?php
$Events = [];
if ($InviteeProvider != null && sizeof($InviteeProvider) > 0 && $InviteeProvider[0]->inviteeEvents != null && sizeof($InviteeProvider[0]->inviteeEvents) > 0) {
    $i = 0;
    foreach ($InviteeProvider[0]->inviteeEvents as $Event) {
        $Events[$i] = $Event->EVENT_ID;
        $i++;
    }
}

//                                                            echo print_r($EventArray,true);
?>

        <?=
        $ManuallyAddInviteeForm->field($InviteesModal, 'WEDDING_EVENT_ID')->widget(Select2::classname(), [
            'id' => 'EvID',
            'data' => $EventArray,
            'value' => $Events,
//                 'tabindex' => false,               
            'size' => Select2::SMALL,
            'options' => ['placeholder' => 'Select Events ...', 'multiple' => true],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false);
        ?>

    </div>
</div>
<div class="form-group  clearfix">
    <div class="col-xs-2 col-sm-2">
        <label for="" class="Textinmodal">Invited by:</label>
    </div>
    <div class="col-xs-10 col-sm-10 ">
<?php
$SendCartBy = [];
if ($InviteeProvider != null && sizeof($InviteeProvider) > 0 && $InviteeProvider[0]->inviteeSendCartBies != null && sizeof($InviteeProvider[0]->inviteeSendCartBies) > 0) {
    $i = 0;
    foreach ($InviteeProvider[0]->inviteeSendCartBies as $SendC) {
        $SendCartBy[$i] = $SendC->SEND_CART_BY_ID;
        $i++;
    }
}
?>
        <?=
        $ManuallyAddInviteeForm->field($InviteesModal, 'SEND_CART_BY_ID')->widget(Select2::classname(), [
            'data' => $SendCartByArray,
            'size' => Select2::SMALL,
            'options' => ['class' => 'fullyinputborder', 'placeholder' => 'Invite By...', 'multiple' => true, 'value' => $SendCartBy],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false);
        ?>
    </div>
</div>
<h2 class="contactinform">Contacts</h2>




<div class="form-group clearfix">
    <div class="col-xs-2 col-sm-2">
        <label for="" class="Textinmodal">Email:</label>
    </div>
    <div class="col-xs-10 col-sm-10">

<?= $ManuallyAddInviteeForm->field($InviteesModal, 'INVITEE_EMAIL')->textInput([ 'class' => 'fullyinputborder', 'placeholder' => 'Email...', 'value' => $InviteeProvider != null && sizeof($InviteeProvider) && $InviteeProvider[0]->INVITEE_EMAIL != null ? $InviteeProvider[0]->INVITEE_EMAIL : ""])->label(false) ?>  
    </div>
</div>
<div class="form-group  clearfix">
    <div class="col-xs-2 col-sm-2">
        <label for="" class="Textinmodal">Phone:</label>
    </div>
    <div class="col-xs-10 col-sm-10">
        <?= $ManuallyAddInviteeForm->field($InviteesModal, 'PHONE')->textInput(['class' => 'fullyinputborder', 'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57', 'placeholder' => 'Phone...', 'value' => $InviteeProvider != null && sizeof($InviteeProvider) && $InviteeProvider[0]->PHONE != null ? $InviteeProvider[0]->PHONE : ""])->label(false) ?>  

    </div>
</div>
<div class="form-group clearfix">
    <div class="col-xs-2 col-sm-2">
        <label for="" class="Textinmodal">Full Address:</label>
    </div>
    <div class="col-xs-10 col-sm-10">
<?= $ManuallyAddInviteeForm->field($InviteesModal, 'ADDRESS')->textInput(['class' => 'fullyinputborder', 'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57', 'placeholder' => 'Address...', 'value' => $InviteeProvider != null && sizeof($InviteeProvider) && $InviteeProvider[0]->ADDRESS != null ? $InviteeProvider[0]->ADDRESS : ""])->label(false) ?>  
    </div>
</div>
<div class="form-group clearfix">
    <div class="col-xs-2 col-sm-2">
        <label for="" class="Textinmodal">Note:</label>
    </div>
    <div class="col-xs-10 col-sm-10">
        <?= $ManuallyAddInviteeForm->field($InviteesModal, 'NOTE')->textarea(['class' => 'fullyinputbordertext', 'rows' => '4', 'value' => $InviteeProvider != null && sizeof($InviteeProvider) && $InviteeProvider[0]->NOTE != null ? $InviteeProvider[0]->NOTE : ""])->label(false) ?>

    </div>
</div>
<div class="form-group form-button clearfix">
    <div class="col-xs-offset-2 col-sm-offset-2 col-xs-10 col-sm-10">
        <button class="btn bgBlue closebutmodal">Close</button>
        <?php echo Html:: submitButton('Add', ['class' => 'btn bgBlue confbut', 'id' => 'submit_idddddddd']) ?>

    </div>
</div>


<?php
$Webb = Yii::getAlias('@web');
$this->registerJs(<<<JS

 $(document).ready(function(){       
$('body').on('submit', '#ManuallyAddInviteeForm', function () {
     var form = $(this);
//       alert('test');
     // return false if form still have some validation errors
     if (form.find('.has-error').length) {
          return false;
     }
     // submit form
     $.ajax({
          url: '$Webb/seating-invitees/save-manualy-invitee',
          type: 'post',
          data: form.serialize(),
          success: function (response) {
            
            if(response.success){
//        alert(response.InviteeID);
//        Up(response.InviteeID);
//         $.pjax.reload({container: "#p0"});
//          $('#PrivateSponsorRow').html(response.formToShow);
//        $('#AddCategory').hide();
//        $('#NewCAtegory').show();
         $('#InviteesPjax').load('$Webb/seating-invitees/after-adding-manually-invitee');
        $('#Statics').load('$Webb/seating-invitees/after-any-changes-statistics-invitee');
        $('#modal').modal('toggle');
        $('#manuallyModal').html('');
            }
        
       
}
          });
          return false;
      });
   });

     
    
   
 
        
JS
);
?>
<?php
$Webb = Yii::getAlias('@web');
$this->registerJs(<<<JS
                                                        
        $(".mydrop>li>a").on("click" , function(){
                                               
	var dropatext = $(this).text();
	var dropatextval = $(this).attr('value');
	$(".spanwithval>span").text(dropatext);
	$(".spanwithval>span").attr('value'  , dropatextval);
	$(".form-dynamic").empty();
	if ($('.spanwithval>span').attr('value') == 0) {
		$(this).addClass('alone');
	} else {
		$(this).removeClass('alone');
	}       alert($('.spanwithval>span').attr("value"));
                         $(".form-dynamic").load('$Webb/seating-invitees/new-guests?number='+$('.spanwithval>span').attr("value"));                               
//			$(".form-dynamic").append(newRow);

//		var paddingqwe = $('.spanwithval').css('padding-left').toNum() + $('.spanwithval').css('padding-right').toNum();
//		var widthofspan = $('.spanwithval').width() + paddingqwe;
//		$('.blockoffirstp>#menudropdown').css("width" ,  widthofspan);
});
//$('#selectNbGuest').change(function(){
//    var selectNb=document.getElementById('selectNbGuest').value;
//    $('.form-dynamic').load('index.php?r=invitees%2Fnew-guests&number='+selectNb);
//        
//});
JS
);
?>
<script>


    function Up(InviteeID) {
        var formData = new FormData();
        if ($('#InviteePic')[0].files[0] !== null) {
            formData.append('image', $('#InviteePic')[0].files[0]);
            formData.append('InviteeID', InviteeID);
            console.log(formData);

            $.ajax({
                url: 'index.php?r=invitees%2Fsave-invitee-img', //Server script to process data Saveprofileimg
                type: 'POST',
// Form data
                data: formData,
// its a function which you have to define

                success: function (response) {
                    console.log(response.return);

                    $("#WeddingImg").attr('src', response.return);

                },
                error: function () {
                    alert('ERROR at PHP side!!');
                },
//Options to tell jQuery not to process data or worry about content-type.
                cache: false,
                contentType: false,
                processData: false
            });
        }
        $('#InviteesPjax').load('index.php?r=invitees%2Fafter-adding-manually-invitee');
        $('#Statics').load('index.php?r=invitees%2Fafter-any-changes-statistics-invitee');
        $('#modal').modal('toggle');
        $('#manuallyModal').html('');

        return false;
    }
    function SelectNumberOfGuest() {



    }
</script>   
<?php
ActiveForm::end();
?>