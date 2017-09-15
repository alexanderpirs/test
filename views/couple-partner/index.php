<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\social\FacebookPlugin;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
//$models0 = $dataProvider1->getModels();
$models = null;
if (isset($dataProvider)) {
    $models = $dataProvider->getModels();
}
   $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Register'), 'url' => ['couple-partner/index']];
                        
$SecondPartnermodels = null;
if (isset($SecondPartnerDataProvider) && $SecondPartnerDataProvider != null) {
    $SecondPartnermodels = $SecondPartnerDataProvider->getModels();
}
//'SecondPartnerDataProvider' => $SecondPartnerDataProvider,
$SecondPartnerCityModel = null;
if (isset($SeconddataCity) && $SeconddataCity != null) {
    $SecondPartnerCityModel = $SeconddataCity->getModels();
}

$CountryModel = null;
if (isset($dataCountry)) {
    $CountryModel = $dataCountry->getModels();
}
$CityModel = null;
if (isset($dataCity)) {
    $CityModel = $dataCity->getModels();
}

$WeddingTypeModel = null;
if (isset($dataWeddingType)) {
    $WeddingTypeModel = $dataWeddingType->getModels();
}

$WeddingCountryModel = null;
if (isset($dataWeddingCountry)) {
    $WeddingCountryModel = $dataWeddingCountry->getModels();
}

//if($CityModel!=NULL){
//    echo print_r($CityModel);
//}
$AllGenders = null;
if (isset($dataGenders)) {
    $AllGenders = $dataGenders->getModels();
}

$WeddingID = 0;
$FirstPartnerName="";
$SecondPartnerName="";
$WeddingType="";
$profilePAth="";

//sECONDCOUPLEPARTNER weddingTypeTranslation wEDDINGTYPE
if (Yii::$app->user->identity!=null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
    $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
    $profilePAth = Yii::$app->user->identity->weddings0[0]->COUPLE_IMG;
    $FirstPartnerName = Yii::$app->user->identity->weddings0[0]->fIRSTCOUPLEPARTNER->COUPLE_PARTNER_FIRST_NAME ;
    $SecondPartnerName = (isset(Yii::$app->user->identity->weddings0) &&  Yii::$app->user->identity->weddings0!=null && sizeof(Yii::$app->user->identity->weddings0)>0 && Yii::$app->user->identity->weddings0[0]->sECONDCOUPLEPARTNER!=null ? Yii::$app->user->identity->weddings0[0]->sECONDCOUPLEPARTNER->COUPLE_PARTNER_FIRST_NAME :"") ;
    $WeddingType = Yii::$app->user->identity->weddings0[0]->wEDDINGTYPE!=null && Yii::$app->user->identity->weddings0[0]->wEDDINGTYPE->weddingTypeTranslation!=null && Yii::$app->user->identity->weddings0[0]->wEDDINGTYPE->weddingTypeTranslation->WEDDING_TYPE_TRANSLATION!=null  ?Yii::$app->user->identity->weddings0[0]->wEDDINGTYPE->weddingTypeTranslation->WEDDING_TYPE_TRANSLATION:0;
} else if (Yii::$app->user->identity!=null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
    $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
    $profilePAth = Yii::$app->user->identity->weddings[0]->COUPLE_IMG;
    $FirstPartnerName = Yii::$app->user->identity->weddings[0]->fIRSTCOUPLEPARTNER->COUPLE_PARTNER_FIRST_NAME ;
    $SecondPartnerName = Yii::$app->user->identity->weddings[0]->sECONDCOUPLEPARTNER->COUPLE_PARTNER_FIRST_NAME ;
    $WeddingType = Yii::$app->user->identity->weddings[0]->wEDDINGTYPE!=null && Yii::$app->user->identity->weddings[0]->wEDDINGTYPE->weddingTypeTranslation!=null && Yii::$app->user->identity->weddings[0]->wEDDINGTYPE->weddingTypeTranslation->WEDDING_TYPE_TRANSLATION!=null  ?Yii::$app->user->identity->weddings[0]->wEDDINGTYPE->weddingTypeTranslation->WEDDING_TYPE_TRANSLATION:0;
}
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
$this->title = Yii::t('app', 'Registration');
//$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('@web/js/Planning.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<script>

window.fbAsyncInit = function() {
    FB.init({
      appId      : '373328526349264',
      xfbml      : true,
      version    : 'v2.8',
        status: true,
        cookie: true
       
    });
     
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
   
function ShowSend(){
    FB.init({
      appId      : '373328526349264',
      xfbml      : true,
      version    : 'v2.8',
        status: true,
        cookie: true
       
    });
    FB.ui({
  method: 'send',
//  link: 'http://localhost/yiiApp/basic/web/index.php?r=couple-partner%2Findex#/',
link: 'http://www.google.com.lb',
});
}
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
                'action' => ['couple-partner/savecouplepartner'],
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
                    <legend>You, As a Partner</legend>
                    <?php
                    if (Yii::$app->user->identity == null &&($models==null)) {
                        echo '<div class="row"><div class="col-md-12 text-center"  >' . yii\authclient\widgets\AuthChoice::widget([
                            'baseAuthUrl' => ['couple-partner/auth'],
                        ]) . '</div></div><div class="row"><div class="col-md-12 text-center">OR</div></div>';
                    }
                    ?>



                    <div class="row">
                        <div class="col-md-4">

                            <?= $form->field($CouplePartnerModel, 'COUPLE_PARTNER_FIRST_NAME')->textInput(['value' => $models != NULL && sizeof($models) > 0 && $models[0]->COUPLE_PARTNER_FIRST_NAME != NULL ? $models[0]->COUPLE_PARTNER_FIRST_NAME : "", 'placeholder' => 'First Name...'])->Label(false) ?>  
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($CouplePartnerModel, 'COUPLE_PARTNER_LAST_NAME')->textInput(['value' => $models != NULL && sizeof($models) > 0 && $models[0]->COUPLE_PARTNER_LAST_NAME != NULL ? $models[0]->COUPLE_PARTNER_LAST_NAME : "", 'placeholder' => 'Last Name...'])->Label(false) ?>  
                        </div>
                        <div class="col-md-4">

                            <?= $form->field($CouplePartnerModel, 'GENDER_ID')->dropDownList(yii\helpers\ArrayHelper::map(yii\helpers\ArrayHelper::toArray($AllGenders), 'GENDER_ID', 'GENDER_TRANS_VALUE'), ['prompt' => 'Gender...', 'placeholder' => 'Gender', 'class' => 'form-control', 'options' => [isset($models) && $models[0]->GENDER_ID != null ? $models[0]->GENDER_ID : 0 => ['selected' => true]]])->Label(false); ?>                              

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            
                            <?= $form->field($CouplePartnerModel, 'COUNTRY_ID')->dropDownList(yii\helpers\ArrayHelper::map(yii\helpers\ArrayHelper::toArray($CountryModel), 'COUNTRY_ID', 'COUNTRY_TRANS_NAME'), ['prompt' => 'Country of Residance...', 'onchange' => '
                $.post( "' . Yii::$app->request->baseUrl . '/index.php?r=couple-partner%2Fcitiesbycountry",{id : $(this).val(),_csrf : "' . Yii::$app->request->csrfToken . '"}, function( data ) {
                  $( "select#couplepartner-city_id" ).html( data.response );
                });
            ', 'class' => 'form-control', 'options' => [isset($models) && $models[0]->COUNTRY_ID != null ? $models[0]->COUNTRY_ID : 0 => ['selected' => true]]])->Label(false); ?>   
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($CouplePartnerModel, 'CITY_ID')->dropDownList(yii\helpers\ArrayHelper::map(yii\helpers\ArrayHelper::toArray($CityModel), 'CITY_ID', 'CITY_TRANSLATION'), ['prompt' => 'City...', 'class' => 'form-control', 'options' => [isset($models) && $models[0]->GENDER_ID != null ? $models[0]->GENDER_ID : 0 => ['selected' => true]]])->Label(false); ?>   
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($CouplePartnerModel, 'ZIP_CODE')->textInput(['value' => $models != NULL && sizeof($models) > 0 && $models[0]->ZIP_CODE != NULL ? $models[0]->ZIP_CODE : "", 'placeholder' => 'Zip Code...'])->Label(false); ?>   
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-12">
                            <div class="well">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label style="align-self: center;display:inline-block;vertical-align: middle" for="usr">Contact:<font color="red"><span style="width: 15px;">*</span></font></label>
                                    </div>
                                </div>
                                <div class="row" id="nameeee">
                                    <div class="col-xs-12 col-sm-12" style="white-space:nowrap;vertical-align: middle;">
                                        <div class="col-xs-1">

                                        </div>
                                        <div class=" col-lg-5" valign="center">
                                            <?= $form->field($CouplePartnerModel, 'COUPLE_PARTNER_EMAIL')->textInput(['value' => $models != NULL && sizeof($models) > 0 && $models[0]->COUPLE_PARTNER_EMAIL != NULL ? $models[0]->COUPLE_PARTNER_EMAIL : "", 'placeholder' => 'Email...'])->Label(false) ?>  

                                        </div>
                                        <div class="col-lg-1 text-center" style="height:30px;vertical-align: middle;line-height: 30px;text-align: center;padding-left: 0;">
                                            <label for="usr" style="color: red;font-size: 13px;">and / or</label>
                                        </div>
                                        <div class="col-lg-5" style="vertical-align: middle;">
                                            <?= $form->field($CouplePartnerModel, 'COUPLE_PARTNER_MOBILE_NUMBER')->textInput(['value' => $models != NULL && sizeof($models) > 0 && $models[0]->COUPLE_PARTNER_MOBILE_NUMBER != NULL ? $models[0]->COUPLE_PARTNER_MOBILE_NUMBER : "", 'placeholder' => 'Mobile Number...'])->Label(false) ?>  

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <?php if($models!=null){?>
                      <div class="row">
                        <div class="col-md-6">
                        <?= Html::button('Reset Password', ['value' => Url::to(['couple-partner/reset-password']), 'title' => 'Creating New Company', 'class' => 'showModalButton btn btn-success']); ?>
                        </div>
                          <?php if (Yii::$app->user->identity != null ||( $models!=null && sizeof($models[0])>0 &&  $models[0]->COUPLE_PARTNER_ID!=NULL)) { ?>
                        
                            <div class="col-lg-6" onmouseover="onmouseOverImg('FirstPartnerEditButton', 'FirstPartnerDelButton');" onmouseout="onmouseoutImg('FirstPartnerEditButton', 'FirstPartnerDelButton')" id="imgdiv" style="display:inline-block;position: relative;left : 5%;height: 110px;width: 150px;">
                                <?php // Pjax::begin(['timeout' => 40000, 'id' => 'myPjax',]);  ?>
                                <div style="display : none;">
                                    <?= $form->field($CouplePartnerModel, 'imageFile')->fileInput()->Label(false) ?>   
                                </div>

                                <?= Html::img(Yii::getAlias('@web') . '/' . ($models != NULL && sizeof($models) > 0 && $models[0]->USER_PROFILE_PIC != NULL ? $models[0]->USER_PROFILE_PIC : ""), ['id' => 'testtttt', 'alt' => 'some', 'style' => 'cursor: pointer;width:100%;height:100%;', 'class' => 'thing']); ?>                     
    <!--<img src="uploads/Home Page.png" style="cursor: pointer;width:100%;height:100% " id="firstPartnerProfilePic" class="img-thumbnail ">-->
                                <div data-role="fieldcontain" id="FirstPartnerEditButton" style="position: absolute; top: 2%; left: 10%; display: none;">
                                    <button type="button" class="btn btn-default btn-sm" onclick="$('#couplepartner-imagefile').click();">
                                        <span class="glyphicon glyphicon-edit"></span> edit
                                    </button>
                                </div>
                                <div data-role="fieldcontain" id="FirstPartnerDelButton" style="position: absolute; top: 2%; right: 10%; display: none;">
                                    <button type="button" class="btn btn-default btn-sm">
                                        <span class="glyphicon glyphicon-remove"></span> del
                                    </button>
                                </div>                         

                                <!---->                      
                                <?php // echo Html::submitButton('Upload', ['class' => 'btn btn-primary', 'id' => 'submit_iddddd',])  ?>
                                <?php
//echo Html::endForm();
                                ?>
                            </div>



                     
<?php }?>
                      </div>
                    <?php }else{?>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($CouplePartnerModel, 'COUPLE_PARTNER_PASSWORD')->passwordInput(['value' => $models != NULL && sizeof($models) > 0 && $models[0]->COUPLE_PARTNER_PASSWORD != NULL ? $models[0]->COUPLE_PARTNER_PASSWORD : "", 'placeholder' => 'Password...'])->Label(false) ?>  
                        </div>
                        <?php if ($models == NULL && sizeof($models) == 0 || $models[0]->COUPLE_PARTNER_PASSWORD == NULL) { ?>
                        <?php } ?>
                        <div class="col-md-6">
                            <?= $form->field($CouplePartnerModel, 'password_repeat')->passwordInput(['value' => $models != NULL && sizeof($models) > 0 && $models[0]->COUPLE_PARTNER_PASSWORD != NULL ? $models[0]->COUPLE_PARTNER_PASSWORD : "", 'placeholder' => 'Confirm password...'])->Label(false) ?> 

                        </div>

                    </div>
                    <?php } ?>
                    <div class="row" style="display : none;">
                        <div class="col-md-12">
                            <?= $form->field($CouplePartnerModel, 'FACEBOOK_EMAIL')->hiddenInput(['value' => $models != NULL && sizeof($models) > 0 && $models[0]->FACEBOOK_EMAIL != NULL ? $models[0]->FACEBOOK_EMAIL : ""])->label(false) ?>  
                        </div>
                    </div>

                    <?php if (Yii::$app->user->identity != null ||( $models!=null && sizeof($models[0])>0 &&  $models[0]->COUPLE_PARTNER_ID!=NULL)) { ?>
                        
<?php }else{ ?>
                    <div class="row">
                        <div class="col-lg-2" style="align-content: center;">
                            &nbsp;
                        </div>
                        <div class="col-lg-8">
                            
                        
                    <?=
    
     $form->field($CouplePartnerModel, 'reCaptcha')->widget(
    \himiklab\yii2\recaptcha\ReCaptcha::className(),
    ['siteKey' => '6LcySRMUAAAAAKTOeMZ3XmnflPoRbR6YXgCLGKYU',],['style' =>'align-content: center']
)->label(false);
    
 ?> 
                            </div>
                        <div class="col-lg-2" style="align-content: center;">
                            &nbsp;
                        </div>
                    </div>
<?php }?>
                </div>
            </div>

            <div class="col-md-6 col-lg-6">
                <div class="feature-container">


<?php
//                    
if ((Yii::$app->user->identity == null && $models==null ) || $SecondPartnermodels == null ) {
    ?>
                        <legend> Invite Your Second Partner</legend>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                
                                <a href="#/" onclick="ShowSend();" style="text-align: center;"><span class="send-message-facebook"></span></a>
                               
<!--                                <script>
                                FB.ui({
  method: 'send',
  link: 'http://www.nytimes.com/interactive/2015/04/15/travel/europe-favorite-streets.html',
});  
                                </script>-->


                            <!--<div id="fb-root"></div>-->
                            <!--<div id="Zoom" style="background-color: blue; top: 1077px; left: 378px; position: absolute; display: block;">
                                Send 
                                <fb:send colorscheme="dark" font="" href="http://tinyurl.com/3e7ggl6">
                                </fb:send>
                                <br> 
                                <textarea rows="7" cols="40">bla bla</textarea>
                            </div>-->
                            </div>
                        </div>
                        <!--<script src="http://connect.facebook.net/en_US/all.js"></script>
                        <script>
                          FB.init({
                            appId  : '373328526349264',
                            status : false, // don't check login status if you don't need it
                        //    cookie : , // don't enable cookies to allow the server to access the session unless you need it
                            xfbml  : true, // parse XFBML
                            channelUrl : 'http://localhost/yiiApp/basic/web/index.php?r=couple-partner%2Findex', // channel.html file, see the JS docs
                            oauth  : true // enable OAuth 2.0 // It's the future, man
                          });
                        </script>-->
                        <!--</div>-->
                        <div class="row" ><div class="col-md-12 text-center" style="height: 12px;">&nbsp;</div></div>
                        <div class="row"><div class="col-md-12 text-center">OR</div></div>
                        <div class="row">
                            <div class="col-md-6">
                                <!--'First_Name','Last_Name'-->
    <?= $form->field($SecCpuplePartnerModel, 'First_Name')->textInput(['placeholder'=>'First Name...','value' => $SecondPartnermodels != NULL && sizeof($SecondPartnermodels) > 0 && $SecondPartnermodels[0]->COUPLE_PARTNER_FIRST_NAME != NULL ? $SecondPartnermodels[0]->COUPLE_PARTNER_FIRST_NAME : ""])->Label(false); ?>  
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($SecCpuplePartnerModel, 'Last_Name')->textInput(['placeholder'=>'Last Name...','value' => $SecondPartnermodels != NULL && sizeof($SecondPartnermodels) > 0 && $SecondPartnermodels[0]->COUPLE_PARTNER_LAST_NAME != NULL ? $SecondPartnermodels[0]->COUPLE_PARTNER_LAST_NAME : ""])->Label(false) ?>  
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="well">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label style="align-self: center;display:inline-block;vertical-align: middle" for="usr">Contact:<font color="red"><span style="width: 15px;">*</span></font></label>
                                        </div>
                                    </div>
                                    <div class="row" id="nameeee">
                                        <div class="col-xs-12 col-sm-12" style="white-space:nowrap;vertical-align: middle;">
                                            <div class="col-xs-1">

                                            </div>
                                            <div class=" col-lg-5" valign="center">
    <?= $form->field($SecCpuplePartnerModel, 'SecondEmail')->textInput(['placeholder' => 'Email...','value' => $SecondPartnermodels != NULL && sizeof($SecondPartnermodels) > 0 && $SecondPartnermodels[0]->COUPLE_PARTNER_EMAIL != NULL ? $SecondPartnermodels[0]->COUPLE_PARTNER_EMAIL : ""])->Label(false) ?>  

                                            </div>
                                            
                                            <div class="col-xs-1 col-sm-1 col-lg-1" style="height:30px;vertical-align: middle;line-height: 30px;text-align: center;padding-left: 0;">

                                            
                                            <label for="usr" style="color: red;font-size: 13px;">and / or</label>
                                        </div> 
                                            <!--SecondEmail', 'SecondPhoneNumber-->
                                            <div class="col-lg-5" style="vertical-align: middle;">
    <?= $form->field($SecCpuplePartnerModel, 'SecondPhoneNumber')->textInput(['placeholder'=>'Mobile Number...','value' => $SecondPartnermodels != NULL && sizeof($SecondPartnermodels) > 0 && $SecondPartnermodels[0]->COUPLE_PARTNER_MOBILE_NUMBER != NULL ? $SecondPartnermodels[0]->COUPLE_PARTNER_MOBILE_NUMBER : ""])->Label(false) ?>  

                                            </div>
                                        </div>
                                    </div>
                                    
                                   
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 text-center">

                            </div>
                        </div>

    <?php
} else {

//                           $form1 = ActiveForm::begin([
//            'id' => 'CouplePartnerFormmmmmm',
////            'action' => ['couple-partner/savecouplepartner'],
//            'enableAjaxValidation' => true,
//            'enableClientValidation' => true,
////            'method' => 'post',
////            'validationUrl' => 'index.php?r=couple-partner%2Fvalidatecouplepartner',
////            'validateOnSubmit' => true,
//        ]);
    ?>

                        <legend>Your Partner</legend>
                        <div class="row">
                            <div class="col-md-4">
    <?=
    $Acc = $form->field($CouplePartnerModel, 'First_Name')->textInput(['value' => $SecondPartnermodels != NULL && sizeof($SecondPartnermodels) > 0 && $SecondPartnermodels[0]->COUPLE_PARTNER_FIRST_NAME != NULL ? $SecondPartnermodels[0]->COUPLE_PARTNER_FIRST_NAME : "", 'disabled' => 'true'])->label(false);
    $Acc->enableAjaxValidation = false;
    $Acc->enableClientValidation = false;
    ?>  
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($CouplePartnerModel, 'Last_Name')->textInput(['value' => $SecondPartnermodels != NULL && sizeof($SecondPartnermodels) > 0 && $SecondPartnermodels[0]->COUPLE_PARTNER_LAST_NAME != NULL ? $SecondPartnermodels[0]->COUPLE_PARTNER_LAST_NAME : "", 'disabled' => 'true'])->label(false)
                                ?>  
                            </div>
                            <div class="col-md-4">

    <?= $form->field($CouplePartnerModel, 'Gender')->dropDownList(yii\helpers\ArrayHelper::map(yii\helpers\ArrayHelper::toArray($AllGenders), 'GENDER_ID', 'GENDER_TRANS_VALUE'), ['disabled' => 'true', 'prompt' => 'Select...', 'class' => 'form-control', 'options' => [isset($SecondPartnermodels) && $SecondPartnermodels[0]->GENDER_ID != null ? $SecondPartnermodels[0]->GENDER_ID : 0 => ['selected' => true]]])->label(false); ?>                              

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
    <?= $form->field($CouplePartnerModel, 'Country')->dropDownList(yii\helpers\ArrayHelper::map(yii\helpers\ArrayHelper::toArray($CountryModel), 'COUNTRY_ID', 'COUNTRY_TRANS_NAME'), ['disabled' => 'true', 'prompt' => 'Select...', 'onchange' => '
                $.post( "' . Yii::$app->request->baseUrl . '/index.php?r=couple-partner%2Fcitiesbycountry",{id : $(this).val(),_csrf : "' . Yii::$app->request->csrfToken . '"}, function( data ) {
                  $( "select#couplepartner-city_id" ).html( data );
                });
            ', 'class' => 'form-control', 'options' => [isset($SecondPartnermodels) && $SecondPartnermodels[0]->COUNTRY_ID != null ? $SecondPartnermodels[0]->COUNTRY_ID : 0 => ['selected' => true]]])->label(false); ?>   
                            </div>
                            <div class="col-md-4">
    <?= $form->field($CouplePartnerModel, 'City')->dropDownList(yii\helpers\ArrayHelper::map(yii\helpers\ArrayHelper::toArray($CityModel), 'CITY_ID', 'CITY_TRANSLATION'), ['disabled' => 'true', 'prompt' => 'Select...', 'class' => 'form-control', 'options' => [isset($SecondPartnermodels) && $SecondPartnermodels[0]->GENDER_ID != null ? $SecondPartnermodels[0]->GENDER_ID : 0 => ['selected' => true]]])->label(false); ?>   
                            </div>
                            <div class="col-md-4">
    <?= $form->field($CouplePartnerModel, 'Zip_Code')->textInput(['value' => $SecondPartnermodels != NULL && sizeof($SecondPartnermodels) > 0 && $SecondPartnermodels[0]->ZIP_CODE != NULL ? $SecondPartnermodels[0]->ZIP_CODE : "", 'disabled' => 'true'])->label(false); ?>   
                            </div>
                        </div>
                        


                       
                        <div class="row">
                            <div class="col-md-12">
                                <div class="well">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label style="align-self: center;display:inline-block;vertical-align: middle" for="usr">Contact:<font color="red"><span style="width: 15px;">*</span></font></label>
                                        </div>
                                    </div>
                                    <div class="row" id="nameeee">
                                        <div class="col-xs-12 col-sm-12" style="white-space:nowrap;vertical-align: middle;">
                                            <div class="col-xs-1">

                                            </div>
                                            <div class=" col-lg-5" valign="center">
    <?= $form->field($SecCpuplePartnerModel, 'SecondEmail')->textInput(['disabled'=>'','placeholder' => 'Email...','value' => $SecondPartnermodels != NULL && sizeof($SecondPartnermodels) > 0 && $SecondPartnermodels[0]->COUPLE_PARTNER_EMAIL != NULL ? $SecondPartnermodels[0]->COUPLE_PARTNER_EMAIL : ""])->Label(false) ?>  

                                            </div>
                                            
                                            <div class="col-xs-1 col-sm-1 col-lg-1" style="height:30px;vertical-align: middle;line-height: 30px;text-align: center;padding-left: 0;">

                                            
                                            <label for="usr" style="color: red;font-size: 13px;">and / or</label>
                                        </div> 
                                            <!--SecondEmail', 'SecondPhoneNumber-->
                                            <div class="col-lg-5" style="vertical-align: middle;">
    <?= $form->field($SecCpuplePartnerModel, 'SecondPhoneNumber')->textInput(['disabled'=>'', 'placeholder'=>'Mobile Number...','value' => $SecondPartnermodels != NULL && sizeof($SecondPartnermodels) > 0 && $SecondPartnermodels[0]->COUPLE_PARTNER_MOBILE_NUMBER != NULL ? $SecondPartnermodels[0]->COUPLE_PARTNER_MOBILE_NUMBER : ""])->Label(false) ?>  
                                           </div>
                                        </div>
                                    </div>
                                    
                                   
                                </div>
                            </div>
                        </div>
                        <div class="row profileimg">
                            <div class="col-lg-12" onmouseover="onmouseOverImg('FirstPartnerEditButton', 'FirstPartnerDelButton');" onmouseout="onmouseoutImg('FirstPartnerEditButton', 'FirstPartnerDelButton')" id="imgdiv" style="display:inline-block;position: relative;left : 35%;height: 110px;width: 150px;">
                                <img src="./../img/empty.png" style="cursor: pointer;width:100%;height:100% " id="firstPartnerProfilePic" class="img-thumbnail ">

                            </div>

                        </div>
    <?php
    //  ActiveForm::end(); }
}
?>
                </div>
                <?php if($WeddingID==0 ){?>
                <br>
                <div class="feature-container">

                    <legend>Couple</legend>
                   <?php if(Yii::$app->user->identity !=null){ ?>
                    <div class="row">
                        <div class="col-lg-4">
                            &nbsp;
                        </div>

                        <div class="col-lg-4" onmouseover="onmouseOverImg('WeddingEditButton', 'WeddingDelButton');" onmouseout="onmouseoutImg('WeddingEditButton', 'WeddingDelButton')" id="imgdiv" style="display:inline-block;position: relative;left : 35%;height: 110px;width: 150px;">
<?php 
                            $WeddingImgPath="";
       if(Yii::$app->user->identity !=null && Yii::$app->user->identity->weddings0!=null && sizeof(Yii::$app->user->identity->weddings0)>0){
 $WeddingImgPath=  Yii::$app->user->identity->weddings0[0]->COUPLE_IMG; 
}else if( Yii::$app->user->identity !=null && Yii::$app->user->identity->weddings!=null && sizeof(Yii::$app->user->identity->weddings)>0){
 $WeddingImgPath=  Yii::$app->user->identity->weddings[0]->COUPLE_IMG;    
}
                            ?>


                            <div style="display : none;">
                            <?= $form->field($WeddingModel, 'imageFile')->fileInput(['id'=>'WeddingImgFile'])->Label(false) ?>   
                            </div>

<?= Html::img(Yii::getAlias('@web') . '/' . ($WeddingImgPath), ['id' => 'WeddingImg', 'alt' => 'some', 'style' => 'cursor: pointer;width:100%;height:100%;', 'class' => 'thing']); ?>                     
<!--<img src="uploads/Home Page.png" style="cursor: pointer;width:100%;height:100% " id="firstPartnerProfilePic" class="img-thumbnail ">-->
                            <div data-role="fieldcontain" id="WeddingEditButton" style="position: absolute; top: 2%; left: 10%; display: none;">
                                <button type="button" class="btn btn-default btn-sm" onclick="$('#WeddingImgFile').click();">
                                    <span class="glyphicon glyphicon-edit"></span> edit
                                </button>
                            </div>
                            <div data-role="fieldcontain" id="WeddingDelButton" style="position: absolute; top: 2%; right: 10%; display: none;">
                                <button type="button" class="btn btn-default btn-sm">
                                    <span class="glyphicon glyphicon-remove"></span> del
                                </button>
                            </div>                         

                            <!---->                      

                            <?php
//echo Html::endForm();
                            ?>
                        </div>

                        <div class="col-lg-4">
                            &nbsp;
                        </div>
                    </div>
                    <?php }  ?>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="col-xs-1">

                            </div>
                            <div class="col-xs-10 col-sm-10 col-lg-10" valign="center">
<?= $form->field($WeddingModel, 'WEDDING_TYPE_ID')->dropDownList(yii\helpers\ArrayHelper::map(yii\helpers\ArrayHelper::toArray($WeddingTypeModel), 'WEDDING_TYPE_ID', 'WEDDING_TYPE_TRANSLATION'), ['prompt' => 'Select...', 'class' => 'form-control', 'options' => [isset($models) && $models[0]->weddings0 != null && sizeof($models[0]->weddings0) > 0 ? $models[0]->weddings0[0]->WEDDING_TYPE_ID : 0 => ['selected' => true]]]); ?> 
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="col-xs-1">

                            </div>
                            <div class="col-xs-10 col-sm-10 col-lg-10" valign="center">
<?= $form->field($WeddingModel, 'WEDDING_COUNTRY_ID')->dropDownList(yii\helpers\ArrayHelper::map(yii\helpers\ArrayHelper::toArray($WeddingCountryModel), 'COUNTRY_ID', 'COUNTRY_TRANS_NAME'), ['prompt' => 'Select...', 'class' => 'form-control', 'options' => [isset($models) && $models[0]->weddings0 != null && sizeof($models[0]->weddings0) > 0 ? $models[0]->weddings0[0]->WEDDING_COUNTRY_ID : 0 => ['selected' => true]]]); ?>
                            </div>

                        </div>
                    </div>

                    <br>
                </div>
                
                <?php } ?>
            </div>
        </div>
        <?php if($WeddingID!=0 ){?>
        <div class="row features">
            <div class="col-md-12 col-lg-12">
                <div class="feature-container">

                    <legend>Couple</legend>
                   <?php if(Yii::$app->user->identity !=null){ ?>
                    <div class="row">
                        <div class="col-lg-4">
                            &nbsp;
                        </div>

                         <div class="wedbox profile-box" id="profile-box">
                               
                                <div role="presentation" class="dropdown profile-photo">
                                     
                                <div class="image-editor">
                                   <?= Html::img($profilePAth != "" ? Yii::getAlias('@web') . '/' . $profilePAth : Yii::getAlias('@web') . '/../img/emptypic.jpg', ['id' => 'testtttt123', 'alt' => '', 'class' => '','style'=>'height : 240px;height : 240px;margin-left: 0px;margin-right: 0px;']); ?>   
                                        
                                    <div class="cropit-preview" id="PreviewImg" style="display : none;" ></div>
          <img class="rotate-ccw  imgrotator leftimgrotate" src="../img/left.png" width="16px" alt="" style='margin-right: 2px;'>&nbsp;
     <img class="rotate-cw imgrotator " src="../img/right.png" width="16px" alt="">
      <input type="range" id="ImgZoomRang" class="cropit-image-zoom-input">
   <button class="immediatorselect">Select</button>
   <button class="export exportbutton">Save</button>
   <div class="wrapperofselect">
     
   </div>
    <input type="file" class="cropit-image-input"  style="visibility:hidden;">
    </div>
         
                               
                                </div>
<?php

$Paa=$profilePAth != "" ? Yii::getAlias('@web') . '/' . $profilePAth : Yii::getAlias('@web') . '/../img/emptypic.jpg';
$this->registerJs(<<<JS
        $('.cropit-image-input').change(function (){
            $('#testtttt123').hide();
        $('#PreviewImg').show();
            }); 
        
         $(function() {
        $(".immediatorselect").on("click" , function(){
            $(".cropit-image-input").click();
        });
       
        $('.image-editor').cropit({
          exportZoom: 1,
            quality : 0.9,
          imageBackground: true,
          imageBackgroundBorderWidth: 20
          
        });
        $('.export').click(function() {
          var imageData = $('.image-editor').cropit('export');
          alert(imageData);
        $('#testtttt123').attr('src',imageData);
          $('#ImgModal').modal('toggle');
        $('#testtttt123').show();
        $('#PreviewImg').hide();
        var formData = new FormData();
    formData.append('image',imageData);
    console.log(formData);
        $('.cropit-image-input').val(null);
    $.ajax({
        url:'index.php?r=couple-partner%2Fsaveweddingprofileimg',  //Server script to process data Saveprofileimg
        type: 'POST',

        // Form data
        data: formData,

         // its a function which you have to define

        success: function(response) {
            console.log(response.return);
//      $("#testtttt123").attr('src', response.return);  
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
        $('.rotate-cw').click(function() {
          $('.image-editor').cropit('rotateCW');
        });
        $('.rotate-ccw').click(function() {
          $('.image-editor').cropit('rotateCCW');
        });

       
      });
 
        
        
           $(document).ready(function() {
   	$(".dropdown.profile-photo").css("height" , "250px");
   	$(".rotate-ccw, .rotate-cw, .cropit-image-zoom-input, .immediatorselect, .exportbutton").wrapAll("<div class='deltagamma'></div>");
   	$(".deltagamma").css({"z-index" : "0" ,"bottom" : "12px", "position" : "absolute" , "transition" : ".8s ease all"  ,  "left" : "390px"});
   	$(".cropit-image-zoom-input").css("z-index" , "0");
   	$(".exportbutton").css("z-index" , "0");
   	$('.sidebar').css("z-index"  , "100");
//   	$(".image-editor").on("mouseenter" , function(){
//   		$(".deltagamma").css("bottom" , "12px");
//   	});
//   	$(".image-editor").on("mouseleave" , function(){
//   		$(".deltagamma").css("bottom" , "-35px");
//   	});
//   	$(".deltagamma").on("mouseenter" , function(){
//   		$(".deltagamma").css("bottom" , "12px");
//   	});
//   	$(".deltagamma").on("mouseleave" , function(){
//   		$(".deltagamma").css("bottom" , "-35px");
//   	});
   });
JS
);
?>
                                
                              
                               
                            </div>

                        <div class="col-lg-4">
                            &nbsp;
                        </div>
                    </div>
                    <?php }  ?>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="col-xs-1">

                            </div>
                            <div class="col-xs-5 col-sm-4 col-lg-4" valign="center">
<?= $form->field($WeddingModel, 'WEDDING_TYPE_ID')->dropDownList(yii\helpers\ArrayHelper::map(yii\helpers\ArrayHelper::toArray($WeddingTypeModel), 'WEDDING_TYPE_ID', 'WEDDING_TYPE_TRANSLATION'), ['prompt' => 'Select...', 'class' => 'form-control', 'options' => [isset($models) && $models[0]->weddings0 != null && sizeof($models[0]->weddings0) > 0 ? $models[0]->weddings0[0]->WEDDING_TYPE_ID : 0 => ['selected' => true]]]); ?> 
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="col-xs-1">

                            </div>
                            <div class="col-xs-5 col-sm-4 col-lg-4" valign="center">
<?= $form->field($WeddingModel, 'WEDDING_COUNTRY_ID')->dropDownList(yii\helpers\ArrayHelper::map(yii\helpers\ArrayHelper::toArray($WeddingCountryModel), 'COUNTRY_ID', 'COUNTRY_TRANS_NAME'), ['prompt' => 'Select...', 'class' => 'form-control', 'options' => [isset($models) && $models[0]->weddings0 != null && sizeof($models[0]->weddings0) > 0 ? $models[0]->weddings0[0]->WEDDING_COUNTRY_ID : 0 => ['selected' => true]]]); ?>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>
        
        <?php } ?>
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

    <?php
yii\bootstrap\Modal::begin([
    'header' => '<span id="modalHeaderTitle"></span>',
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'modal',
    'size' => 'modal-lg',
    'closeButton' => ['id' => 'close-button'],
    //keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or  to close
    'clientOptions' => []
]);
echo "<div id='modalContent'></div>";
yii\bootstrap\Modal::end();
?>

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
        
        
        $(function(){
    //get the click of modal button to create / update item
    //we get the button by class not by ID because you can only have one id on a page and you can
    //have multiple classes therefore you can have multiple open modal buttons on a page all with or without
    //the same link.
//we use on so the dom element can be called again if they are nested, otherwise when we load the content once it kills the dom element and wont let you load anther modal on click without a page refresh
      $(document).on('click', '.showModalButton', function(){
          
          
         //check if the modal is open. if it's open just reload content not whole modal
        //also this allows you to nest buttons inside of modals to reload the content it is in
        //the if else are intentionally separated instead of put into a function to get the 
        //button since it is using a class not an #id so there are many of them and we need
        //to ensure we get the right button and content. 
        if ($('#modal').data('bs.modal').isShown) {
            $('#modal').find('#modalContent')
                    .load($(this).attr('value'));
            //dynamiclly set the header for the modal
            document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        } else {
            //if modal isn't open; open it and load content
            $('#modal').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'));
             //dynamiclly set the header for the modal
            document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        }
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




