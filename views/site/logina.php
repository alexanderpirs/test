<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php
						$session = Yii::$app->session;
$EmailFromS="";
if($session->get('em')!=null){
   $EmailFromS = $session->get('em');
}
           
?>
                                            <style>
    

.login-boxx {
  position: relative !important;
  margin: 5% auto !important;
  width: 600px !important;
  height: 400px !important;
  background: #FFF !important;
  border-radius: 2px !important;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4) !important;
}
#login-box {
  position: relative !important;
  margin: 5% auto !important;
  width: 600px !important;
  height: 457px !important;
  background: #FFF !important;
  border-radius: 2px !important;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4) !important;
}

.leftt {
  position: absolute !important;
  top: 29px !important;
  left: 0 !important;
  box-sizing: border-box !important; 
  padding: 40px!important;
  width: 300px!important;
  height: 400px!important;
}

.h1 {
  margin: 0 0 20px 0!important;
  font-weight: 300!important;
  font-size: 28px !important;
}

#email,
#password {
  display: block !important;
  box-sizing: border-box !important;
  /*margin-bottom: 20px !important;*/
  padding: 4px !important;
  width: 220px !important;
  height: 32px !important;
  border: none !important;
  border-bottom: 1px solid #AAA !important;
  font-family: 'Roboto', sans-serif !important;
  font-weight: 400 !important;
  font-size: 15px !important;
  transition: 0.2s ease !important;
}

#password:focus,
#email:focus {
  border-bottom: 2px solid #16a085 !important;
  color: #16a085 !important;
  transition: 0.2s ease !important;
}

#LoginButton {

  width: 120px!important;
  height: 32px!important;
  background: #16a085!important;
  border: none!important;
  border-radius: 2px!important;
  color: #FFF!important;
  font-family: 'Roboto', sans-serif!important;
  font-weight: 500!important;
  text-transform: uppercase!important;
  transition: 0.1s ease!important;
  cursor: pointer!important;
}

#LoginButton:hover,
#LoginButton:focus {
  opacity: 0.8 !important;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4)!important;
  transition: 0.1s ease!important;
}

#LoginButton:active {
  opacity: 1!important;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.4)!important;
  transition: 0.1s ease!important;
}

.or {
  position: absolute !important;
  top: 180px!important;
  left: 280px !important;
  width: 40px!important;
  height: 40px!important;
  background: #DDD!important;
  border-radius: 50%!important;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4)!important;
  line-height: 40px !important;
  text-align: center !important;
}

.rightt {
  position: absolute !important;
  top: 29px  !important;
  right: 0 !important;
  box-sizing: border-box !important;
  padding: 40px !important;
  width: 300px !important;
  height: 400px !important;
  background: url('../img/login Img Background.jpg') !important;
  background-size: cover !important;
  background-position: center !important; 
  border-radius: 0 2px 2px 0 !important;
}

.rightt .loginwith {
  display: block !important;
  margin-bottom: 40px !important;
  font-size: 28px !important;
  color: #FFF !important;
  text-align: center !important;
}

button.social-signin {
  margin-bottom: 20px !important;
  width: 220px !important;
  height: 36px !important;
  border: none !important;
  border-radius: 2px !important;
  color: #FFF !important;
  font-family: 'Roboto', sans-serif !important;
  font-weight: 500 !important;
  transition: 0.2s ease !important;
  cursor: pointer !important;
}

button.social-signin:hover,
button.social-signin:focus {
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
  transition: 0.2s ease;
}

button.social-signin:active {
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.4);
  transition: 0.2s ease;
}

button.social-signin.facebook {
  background: #32508E !important;
}
.facebook {
  background: #32508E !important;
}
.auth-icon:hover,
.auth-icon:focus {
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4) !important;
  transition: 0.2s ease !important;
}
button.social-signin.twitter {
  background: #55ACEE !important;
}

button.social-signin.google {
  background: #DD4B39 !important;
}
 
.has-error .form-control {
    border: none !important;
  border-bottom: 1px solid #AAA !important;
    border-color: #a94442 !important;
    
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075) !important;
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075) !important;
}

.auth-clients{
    margin-bottom: 0px!Important; 
    padding-left: 0px !important;

}
.auth-icon.facebook:after {
    content: "Login With facebook" !Important;
    color: white !Important;
}
.auth-icon{
    margin-bottom: 20px!important;
    width: 220px !important;
    height: 36px !important;
    border: none !important;
    border-radius: 2px !important;
    color: #FFF !important;
    font-family: 'Roboto', sans-serif !important;
    font-weight: 500 !important;
    transition: 0.2s ease !important;
    cursor: pointer !important;
}

.help-block {
    height : 18px!important;
}
.form-group{
   margin-bottom: 2px!important;

}

label {
    font-size: 12px !important;
}

.tab-group {
    list-style: none;
    padding: 0;
    margin: 0 0 40px 0;
}

.tab-group .active .la {
    background: #1ab188;
    color: #ffffff;
}
.la {
    display: block;
    text-decoration: none;
    /*padding: 15px;*/
    background: rgba(160, 179, 176, 0.25);
    color: #a0b3b0;
    font-size: 20px;
    float: left;
    width: 50%;
    text-align: center;
    cursor: pointer;
    -webkit-transition: .5s ease;
    transition: .5s ease;
}



/*custom font*/


/*basic reset*/
*, *:before, *:after {
  box-sizing: border-box;
}
/*form styles*/
#msform {
	width: 400px;
	margin: 50px auto;
        margin-top: 0px;

	text-align: center;
	position: relative;
}
#msform div {
	background: white;
	border: 0 none;
	border-radius: 3px;
	/*box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);*/
	/*padding: 20px 30px;*/
	box-sizing: border-box;
	width: 80%;
	margin: 0 10%;
	
	/*stacking fieldsets above each other*/
	position: relative;
}
/*Hide all except first fieldset*/
#msform div:not(:first-of-type) {
	display: none;
}
/*inputs*/
#msform input, #msform textarea {
	padding: 15px;
	border: 1px solid #ccc;
	border-radius: 3px;
	margin-bottom: 10px;
	width: 100%;
	box-sizing: border-box;
	font-family: montserrat;
	color: #2C3E50;
	font-size: 13px;
}
/*buttons*/
#msform .action-button {
	width: 100px;
	background: #27AE60;
	font-weight: bold;
	color: white;
	border: 0 none;
	border-radius: 1px;
	cursor: pointer;
	padding: 10px 5px;
	margin: 10px 5px;
}
#msform .action-button:hover, #msform .action-button:focus {
	box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;
}
/*headings*/
.fs-title {
	font-size: 15px;
	text-transform: uppercase;
	color: #2C3E50;
	margin-bottom: 10px;
}
.fs-subtitle {
	font-weight: normal;
	font-size: 13px;
	color: #666;
	margin-bottom: 20px;
}
/*progressbar*/
#progressbar {
	margin-bottom: 30px;
	overflow: hidden;
	/*CSS counters to number the steps*/
	counter-reset: step;
}
#progressbar li {
	list-style-type: none;
	color: #f9a76d;
	text-transform: uppercase;
	font-size: 9px;
	width: 33.33%;
	float: left;
	position: relative;
}
#progressbar li:before {
	content: counter(step);
	counter-increment: step;
	width: 20px;
	line-height: 20px;
	display: block;
	font-size: 10px;
	color: #333;
	background: white;
	border-radius: 3px;
	margin: 0 auto 5px auto;
}
/*progressbar connectors*/
#progressbar li:after {
	content: '';
	width: 100%;
	height: 2px;
	background: white;
	position: absolute;
	left: -50%;
	top: 9px;
	z-index: -1; /*put it behind the numbers*/
}
#progressbar li:first-child:after {
	/*connector not needed before the first step*/
	content: none; 
}
/*marking active/completed steps green*/
/*The number of the step and the connector before it = green*/
#progressbar li.active:before,  #progressbar li.active:after{
	background: #27AE60;
	color: white;
}




</style>
 <div id="login-box">

  <ul class="tab-group" style="margin-bottom: 0px;">
      <li class="tab active" style="height: 1px;"><a href="#login" id="loginB" class="la">Log In</a></li>
        <li class="tab" style=""><a href="#signup" class="la" id="SignupB">Sign Up</a></li>
       
      </ul>
<div class="tab-content">
    
        <div id="login" style="display: block;">  
   <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'enableAjaxValidation' => true,
        'action' =>['site/validate'],
//       'enableClientValidation' => true,
//       'options' => [
//        'validateOnSubmit' => true,
//        
//    ],
//        'fieldConfig' => [
//            'template' => "{label}<br><div class=\"col-lg-5\">{input}</div><br><div class=\"col-lg-5\">{error}</div>",
//            'labelOptions' => ['class' => 'col-lg-2 control-label'],
//        ],
    ]); ?>

  <div class="leftt">
      <h1 class="h1">Log in</h1>
   
       <?= $form->field($model, 'username')->input('email',['id'=>'email','value' => $EmailFromS,'style'=>'  display: block;
  box-sizing: border-box;
  margin-bottom: 0px;
  padding: 4px;
  width: 220px;
  height: 32px;
  border: none;
  border-bottom: 1px solid #AAA;
  font-family: \'Roboto\', sans-serif;
  font-weight: 400;
  font-size: 15px;
  transition: 0.2s ease;']) ?>
<!--    <input type="text" name="email" placeholder="E-mail" />-->
     <?= $form->field($model, 'password')->passwordInput(['id'=>'password','style'=>'  display: block;
  box-sizing: border-box;
  margin-bottom: 0px;
  padding: 4px;
  width: 220px;
  height: 32px;
  border: none;
  border-bottom: 1px solid #AAA;
  font-family: \'Roboto\', sans-serif;
  font-weight: 400;
  font-size: 15px;
  transition: 0.2s ease;']) ?>  
    <div class="row">
        <div class="col-lg-1" style="height: 40px;">
            <?= $form->field($model, 'rememberMe')->checkbox(['style'=>'',
            'template' => "{input}",
        ]) ?>
        </div>
        <div class="col-lg-7" style="
    height: 35px;
   align-content: center;
">
            <label style='padding-top: 10px;'>remember me</label>
        </div>
    </div>
    <!--<input type="password" name="password" placeholder="Password" />-->
  
    <div class="row">
           
            <div class="col-lg-7">
                <?= Html::submitButton('Login', ['class' => '', 'name' => 'login-button','id'=>'LoginButton','style'=>'
  width: 120px!important;
  height: 32px!important;
  background: #16a085!important;
  border: none!important;
  border-radius: 2px!important;
  color: #FFF!important;
  font-family: \'Roboto\', sans-serif!important;
  font-weight: 500!important;
  text-transform: uppercase!important;
  transition: 0.1s ease!important;
  cursor: pointer!important;']) ?>
            </div>
            <div class="col-lg-5 text-right"style="
    padding-right: 0px;
    padding-left: 0px !important;
">
               <?= Html::a('forgot password?','#/',['class' => 'showModalButton text-highlight','style'=>'font-size : 12px;']); ?>

            </div>
           
            
        </div> 
    <div class="row" style="padding-top: 20px;">
        <div class="col-lg-4" style="
    padding-right: 0px;
">
            <label><b>Register as:</b></label>
        </div>
        <div class="col-lg-8" style="padding-left: 5px;">
             <?= Html::a('User', ['couple-partner/index'],['class' => 'text-highlight','style'=>'', 'name' => 'Register-button']) ?>&nbsp;
             <small><b>or as</b></small>&nbsp;&nbsp;<?=Html::a('Partner',['/supplier/index'],['class' => 'text-highlight','aria-hidden' => 'true'])?>
        </div>
    </div>

    <!--<input type="submit" name="signup_submit" value="Login" />--> 
 
  </div>
  
  <div class="rightt">
    <span class="loginwith">Log in with<br />social network</span>
    <?= yii\authclient\widgets\AuthChoice::widget(['class' => 'social-signin facebook',
     'baseAuthUrl' => ['couple-partner/auth']
]) ?>

    <button class="social-signin twitter">Log in with Twitter</button>
    <button class="social-signin google">Log in with Google+</button>
  </div>
  <div class="or">OR</div>

				
	    <?php
            $Webb=Yii::getAlias('@web');
$this->registerJs(<<<JS



  $(document).ready(function(){       
$('.modal-body').on('beforeSubmit', '#login-form', function () {
     var form = $(this);
//       alert('test');
     // return false if form still have some validation errors
     if (form.find('.has-error').length) {
          return false;
     }
     // submit form
     $.ajax({
          url: '$Webb/site/login',
          type: 'post',
          data: form.serialize(),
          success: function (response) {
            
            if(response.success){
//         $.pjax.reload({container: "#p0"});
//          
//        $('#AddCategory').hide();
//        $('#NewCAtegory').show();
        
        }
          }
     });
     return false;
});
 }); 
   
          $('#loginB').on('click', function (e) {
  
  e.preventDefault();
  
  $('#loginB').parent().addClass('active');
  $('#loginB').parent().siblings().removeClass('active');
  
  target = $('#loginB').attr('href');

  $('.tab-content > div').not(target).hide();
  
  $(target).fadeIn(600);
  
});
        
                $('#SignupB').on('click', function (e) {
  
  e.preventDefault();
  
  $('#SignupB').parent().addClass('active');
  $('#SignupB').parent().siblings().removeClass('active');
  
  target = $('#SignupB').attr('href');

  $('.tab-content > div').not(target).hide();
  
  $(target).fadeIn(600);
  
});
//        $('SignupB').on('click', function (e) {
//  
//  e.preventDefault();
//  
//  $(this).parent().addClass('active');
//  $(this).parent().siblings().removeClass('active');
//  
//  target = $(this).attr('href');
//
//  $('.tab-contentt > div').not(target).hide();
//  
//  $(target).fadeIn(600);
//  
//});
        
  

JS
);
?>			

           <?php ActiveForm::end(); ?>			
        </div>
    <div id="signup" style="display: none;float: top;"> 
        <ul class="tab-group" style="width: 50%;float:right;float: top;">
      <li class="tab active" style="height: 1px;"><a href="#UserRegister" class="la">User</a></li>
        <li class="tab" style=""><a href="#SupplierRegister" class="la">Partner</a></li>
       
      </ul>
        <div class="tab-contentt">
            <div id="UserRegister" style="display: block;">  
            
  <!-- progressbar -->
  <div class="row">
      
  </div>
  <div class="row">
      <div class="col-12 text-center">
         <ul id="progressbar">
    <li class="active">Account Setup</li>
    <li>Social Profiles</li>
    <li>Personal Details</li>
  </ul> 
      </div>
  </div>
  
  <?php

//use yii\helpers\Html;
//use yii\widgets\ActiveForm;
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
  <div id="msform">
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
  
  

      
   
          
          
          
          <div class="row">
         <div class="col-md-12 col-lg-12">
              
                    <!--<legend>You, As a Partner</legend>-->
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
      
    
  
  
<!--  <div>
    <h2 class="fs-title">Social Profiles</h2>
    <h3 class="fs-subtitle">Your presence on the social network</h3>
    <input type="text" name="twitter" placeholder="Twitter" />
    <input type="text" name="facebook" placeholder="Facebook" />
    <input type="text" name="gplus" placeholder="Google Plus" />
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="button" name="next" class="next action-button" value="Next" />
  </div>-->
<!--  <div>
    <h2 class="fs-title">Personal Details</h2>
    <h3 class="fs-subtitle">We will never sell it</h3>
    <input type="text" name="fname" placeholder="First Name" />
    <input type="text" name="lname" placeholder="Last Name" />
    <input type="text" name="phone" placeholder="Phone" />
    <textarea name="address" placeholder="Address"></textarea>
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="submit" name="submit" class="submit action-button" value="Submit" />
  </div>-->
   
  <?php ActiveForm::end(); ?>
           </div>
            </div> 
             <div id="SupplierRegister" style="display: none;">  
            <div id="msformm">
  <!-- progressbar -->
  <ul id="progressbarr">
    <li class="active">Account Setup</li>
    <li>Social Profiles</li>
    <li>Personal Details</li>
  </ul>
        
   <div>
    <h2 class="fs-title">Create your account</h2>
    <h3 class="fs-subtitle">This is step 1</h3>
    <input type="text" name="email" placeholder="Email" />
    <input type="password" name="pass" placeholder="Password" />
    <input type="password" name="cpass" placeholder="Confirm Password" />
    <input type="button" name="next" class="next action-button" value="Next" />
  </div>
  
  
  <div>
    <h2 class="fs-title">Social Profiles</h2>
    <h3 class="fs-subtitle">Your presence on the social network</h3>
    <input type="text" name="twitter" placeholder="Twitter" />
    <input type="text" name="facebook" placeholder="Facebook" />
    <input type="text" name="gplus" placeholder="Google Plus" />
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="button" name="next" class="next action-button" value="Next" />
  </div>
  <div>
    <h2 class="fs-title">Personal Details</h2>
    <h3 class="fs-subtitle">We will never sell it</h3>
    <input type="text" name="fname" placeholder="First Name" />
    <input type="text" name="lname" placeholder="Last Name" />
    <input type="text" name="phone" placeholder="Phone" />
    <textarea name="address" placeholder="Address"></textarea>
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="submit" name="submit" class="submit action-button" value="Submit" />
  </div>
        </div>
             </div>
        </div>
        
    </div>
</div></div>

<script>
//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	next_fs = $(this).parent().next();
	
	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("div").index(next_fs)).addClass("active");
	alert('ttt');
	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({
        'transform': 'scale('+scale+')',
        'position': 'absolute'
      });
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".previous").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("div").index(current_fs)).removeClass("active");
	
	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".submit").click(function(){
	return false;
})
      

</script>
