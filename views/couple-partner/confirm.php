<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\social\FacebookPlugin;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
//$models0 = $dataProvider1->getModels();


//echo print_r($AllGenders[0]);
//dataProvider' => $dataProvider,
//            'CouplePartnerModel' =>  $CouplePartnerModel,
//* @property integer $COUPLE_PARTNER_ID
// * @property string $COUPLE_PARTNER_FIRST_NAME
// * @property string $COUPLE_PARTNER_MIDDLE_NAME
// * @property string $COUPLE_PARTNER_LAST_NAME
// * @property string $COUPLE_PARTNER_EMAIL
// * @property string $COUPLE_PARTNER_PASSWORD
// * @property string $COUPLE_PARTNER_MOBILE_NUMBER
// * @property string $COUPLE_PARTNER_ADDRESS
// * @property integer $GENDER_ID
// * @property string $BIRTHDAY
// * @property integer $MARITAL_STATUS_ID
// * @property string $PIN
// * @property string $FACEBOOK_EMAIL
// * @property string $FACEBOOK_ID
// * @property integer $COUNTRY_ID
// * @property integer $CITY_ID
// * @property string $ZIP_CODE
// * @property string $USER_PROFILE_PIC
// * @property string $authKey
//echo $models[0]->agendaPeriodeTranslations[0]->AGENDA_PERIODE_TRANS_NAME;
//echo $dataProvider->AGENDA_PERIODE_TRANS_NAME;
$this->title = Yii::t('app', 'Confirm');
//$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('@web/js/Planning.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<script>


</script>

<style>
    .auth-clients {
    padding-left: 32%;
    }
</style>
<div class="main-content container">

    <?php
    $form = ActiveForm::begin([
                'id' => 'CouplePartnerForm',
                'action' => ['couple-partner/confirmpa'],
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
                'method' => 'post',
//            'validationUrl' => ['couple-partner/validatecouplepartner'],
                'validateOnSubmit' => true,
//                'options' => ['enctype' => 'multipart/form-data']
    ]);
    ?>
    <div class="marketing">
        <div class="row features">
            <div class="col-md-6 col-lg-6">
                <div class="feature-container">
                    <legend>Set Password</legend>
                   
<?= $form->field($CouplePartnerModel, 'COUPLE_PARTNER_ID')->hiddenInput(['value' => $TechID])->Label(false)?>

                    <div class="row">
                        <div class="col-md-6">
                            <!--TechID-->
                            
                            <?= $form->field($CouplePartnerModel, 'COUPLE_PARTNER_PASSWORD')->passwordInput(['value' =>  "", 'placeholder' => 'Password...'])->Label(false) ?>  
                        </div>
                        
                        <div class="col-md-6">
                            <?= $form->field($CouplePartnerModel, 'password_repeat')->passwordInput(['value' =>  "", 'placeholder' => 'Confirm password...'])->Label(false) ?> 

                        </div>

                    </div>
                   

                    
        <div class="row">
            <div class="col-lg-12">
<?php echo Html::submitButton('Save', ['class' => 'btn btn-primary', 'id' => 'submit_id',]) ?>
            </div>
            <!--ValidateFormAjax(\'CouplePartnerForm\')-->
        </div>
        <div class="row">
            <div class="col-lg-12">
                &nbsp;
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>
</div>
        </div>
    </div>

<script>
    function onmouseOverImg(FirstPartnerEditButton, FirstPartnerDelButton) {
        $("#" + FirstPartnerEditButton).show();
        $("#" + FirstPartnerDelButton).show();
    }
    function onmouseoutImg(FirstPartnerEditButton, FirstPartnerDelButton) {
        $("#" + FirstPartnerEditButton).hide();
        $("#" + FirstPartnerDelButton).hide();
    }
</script>    
<?php
$this->registerJs(<<<JS

JS
);
?>
<?php

$this->registerJs(<<<JS
 $('#WeddingImgFile').change(function(e){
    var formData = new FormData();
    formData.append('image', $('#WeddingImgFile')[0].files[0]);
    console.log(formData);
    $.ajax({
        url:'index.php?r=couple-partner%2Fsaveweddingprofileimg',  //Server script to process data Saveprofileimg
        type: 'POST',

        // Form data
        data: formData,

         // its a function which you have to define

        success: function(response) {
            console.log(response.return);
      $("#WeddingImg").attr('src', response.return);  
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
JS
);

$this->registerJs(<<<JS
 $('#couplepartner-imagefile').change(function(e){
    var formData = new FormData();
    formData.append('image', $('#couplepartner-imagefile')[0].files[0]);
    console.log(formData);
    $.ajax({
        url:'index.php?r=couple-partner%2Fsaveprofileimg',  //Server script to process data Saveprofileimg
        type: 'POST',

        // Form data
        data: formData,

         // its a function which you have to define

        success: function(response) {
            console.log(response.return);
      $("#testtttt").attr('src', response.return);  
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
JS
);

$this->registerJs(<<<JS
 
JS
);
?>
<script>
  
    
</script>
<script>

</script>



