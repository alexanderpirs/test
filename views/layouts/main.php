<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use app\controllers\MainController;
use kartik\ipinfo\IpInfo;
use kartik\popover\PopoverX;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>


<?php
//$realIP = file_get_contents("http://ipecho.net/plain");
 $country_code ='LB'; 
//         trim(file_get_contents("http://ipinfo.io/{$realIP}/country",FILE_USE_INCLUDE_PATH));
//$var_export = var_export(unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$realIP)),true);
//if($var_export!=null && sizeof($var_export)>0){
////  $countryName=  $var_export[0]['geoplugin_countryName'];
//}
//$print_r = print_r($var_export);
//$array = explode(' ', $string);
//$print_r = print_r($var_export);
//echo "adsddddddddddddd : ".$print_r['geoplugin_countryName'];
$currentLang = "";
if (\Yii::$app->getRequest()->getCookies()->has('_lang') && array_key_exists(\Yii::$app->getRequest()->getCookies()->getValue('_lang'), \Yii::$app->params['LanguagesToSelectFrom'])) {

    $currentLang = Yii::$app->getRequest()->getCookies()->getValue('_lang');
} else {
    $currentLang = Yii::$app->language;
}
$webLAnd = Yii::$app->language;
$languages = Yii::$app->params['LanguagesToSelectFrom'];
?>

<?php
$CurrentLan = "";
$CurrentSelectedValue = "";
$ToSelectLan = "";
foreach ($languages as $key => $value) {
    if ($currentLang == $key) {
       $CurrentLan = '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$value[0].$value[1].'</a>';
        
        $CurrentSelectedValue = $value;
//              echo $value . " in " . $key . ", ";   
    }
}

//Yii::$app->view->params['customParam'] = 'customValue';
//   echo Html::dropDownList('_lang', $currentLang, $languages,
//                        array(
//                            'onchange' => 'language_change(this)',
//                            'csrf'=>true,
//                        ),'Language'
//                    );
?>

<?php
$p = 0;
$ToSelectLan = "";
foreach ($languages as $key => $value) {
    if ($currentLang == $key) {

        $ToSelectLan = $ToSelectLan .'<li><a class="active" onclick="language_change(\'' . $key . '\');" href="#/">' . $value . '</a></li>';
    } else {
       $ToSelectLan = $ToSelectLan .'<li><a class="" onclick="language_change(\'' . $key . '\');" href="#/">' . $value . '</a></li>';
    }

//              echo $value . " in " . $key . ", ";   
}
?>
<!DOCTYPE html>
<html   lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<?= Html::csrfMetaTags() ?>

        <title><?= Html::encode($this->title) ?></title>
        <link rel="shortcut icon" href="<?= Yii::$app->request->baseUrl .'/img/favicon.png'?>" type="image/png">
<?php $this->head() ?>
        
    </head>
    <body>
<?php $this->beginBody() ?>

   </body>



    <!-- NAVIGATION & HEAD IMAGE -->
      
        <!-- NAVIGATION -->
          <nav class="navbar navbar-default top35-nav main-menu-of-the-web" id="wrap" style="">
              <div class="container " style="z-index : 1000000000">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse" aria-expanded="false">
                  <span class="sr-only"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= Url::to(['site/home'])?>">
                    <img src="<?= Yii::$app->request->baseUrl . '/img/logo.svg' ?>" >
                </a>
              </div>

              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="main-navbar-collapse" style="z-index :100001;">

                <ul class="nav navbar-nav navbar-right  nav-pills">

                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img width="18" src="<?= Yii::$app->request->baseUrl . '/img/bell.svg' ?>" ></a>
                    <ul class="dropdown-menu my-loc-div my-notific">
                      <li>
                          <p><a href="#">Notification text lorem ipsum</a></p>
                          <p><a href="#">Notification text lorem ipsum</a></p>
                          <p><a href="#">Notification text lorem ipsum</a></p>
                          <p><a href="#">Notification text lorem ipsum</a></p>
                      </li>                      
                    </ul>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img width="20" src="<?= Yii::$app->request->baseUrl . '/img/cart.svg' ?>" ></a>
                    <ul class="dropdown-menu my-loc-div my-notific2">
                      <li>
                        <table class="to-highlight">
                          <tr>
                            <td>Item name</td>
                            <td class="few-percents">$9.99</td>
                          </tr>
                          <tr>
                            <td>Item name</td>
                            <td class="few-percents">$9.99</td>
                          </tr>
                          <tr>
                            <td>Item name</td>
                            <td class="few-percents">$9.99</td>
                          </tr>
                        </table>
                        <hr />
                        <table>
                          <tr>
                            <td>Total</td>
                            <td class="few-percents">$32.77</td>
                          </tr>
                        </table>
                        <a class="cst-btn cst-btn-cart" href="#">Checkout</a>
                      </li>                      
                    </ul>
                  </li>
                  <li class=" dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                          <?php 
                          $cookies = Yii::$app->request->cookies;
                          $CounCode='0';
                          if (isset($cookies['countryCode'])) {
                            $CounCode = $cookies['countryCode']->value;
                      }
//                       $CounCode="0";
                          if($CounCode!="0"){
                              
//                                 echo $CounCode;
                              ?>
                          <link href="<?=Yii::getAlias('@web').'/css/flag-icon.css'?>" rel="stylesheet">
                         
                          <style>
                              #w0-country_code-i {
                                display: none;  
                              }
/*                              .flag-icon:before {
    content: "\00a0";
}

.flag-icon-lb {
    background-image: url(../flags/4x3/<?=strtolower($CounCode)?>.svg);
}


.flag-icon {
    background-size: contain;
    background-position: 50%;
    background-repeat: no-repeat;
    position: relative;
    display: inline-block;
    width: 1.33333333em;
    line-height: 1em;
}*/
                          </style>
                          <div id="w0"> <span id="w0-flag"><span class="flag-icon flag-icon-<?=strtolower($CounCode)?>"></span></span> <span id="w0-country_code-i"><?=$CounCode?></span> </div>
                              <?php
                          }else{
                              ?>
                          <style>
                              #w0-country_code-i {
                                display: none;  
                              }
                              #w1-country_code-i {
                                display: none;  
                              }
                              #w2-country_code-i {
                                display: none;  
                              }
                          </style>
                          <?= IpInfo::widget([
    
//    'showFlag' => true,
    'showPopover' => false,
    'template' => ['inlineContent'=>' {flag} {country_code} '],
                           
    'popoverOptions' => [
        'placement' => PopoverX::ALIGN_BOTTOM_LEFT,
        'size' => PopoverX::SIZE_MEDIUM
    ]
]);?>
                              <?php
                          }
                          
                        ?>
                          
                          
                          
                          
                      </a>
                    <ul class="dropdown-menu my-loc-div">
                      <li>
                          <h4 dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>" style="    font-size: 17px;"><b><?=Yii::t('app', 'Where would be your Wedding?')?></b></h4>
                         <?php
                         
                          $AllCountries= MainController::GetAllCountries();
                             $p=0;
                            $pp=0;
                              if($AllCountries!=null && sizeof($AllCountries)>0){
                                    foreach($AllCountries as $Country){
                                        if($p==0){
                                            ?>
                          <div class="col-xs-6 col-sm-6 cst-padding-left0">
                            <ul class="list-unstyled">
                                            <?php
                                            
                                        
                                            
                                        }
                                        
                                       $CountryID= $Country->cOUNTRY->COUNTRY_ID;
                                       $CountryCode=$Country->cOUNTRY->COUNTRY_CODE;
                                       if($CounCode!="0"){
                                          $country_code= $CounCode;
                                       }
                                        if($country_code==$CountryCode ){
                                          ?>
                                <li><a href="#/" onclick="ChangeFlag('<?=$CountryCode?>');" style="background-color: rgba(128, 128, 128, 0.13);"><?=$Country->COUNTRY_TRANS_NAME?></a></li>
                                <?php
                                        }else{
                                         ?>
                                <li><a href="#/" onclick="ChangeFlag('<?=$CountryCode?>');" ><?=$Country->COUNTRY_TRANS_NAME?></a></li>
                                <?php
                                        }
                                        ?>
                          
                         
                                        <?php
                                         $p++;
                                        if($p==3 || $pp==sizeof($AllCountries)-1){
                                          ?>
                          </ul>
                          </div>
                          <?php
                          $p=0;              
                          
                                        }
                                        $pp++;
                                        }
                                    }
                         ?>
                          
                          
                                
                             
                             <!--<li><a href="#">Egypt</a></li>-->
                            
                         
                      </li>                      
                    </ul>
                  </li>
                  <script>
                  
                  function ChangeFlag(FgalValue){
                      
                     
                      
                      $.post('<?= Url::to('@web/main/save-country-to-cookies')?>',
                      {
                        Code : FgalValue  
                    },
                      function(data,status){
                          if(data.success==='Y'){
                       $('.flag-icon').removeClass().addClass('flag-icon flag-icon-'+FgalValue.toLowerCase());
                      $('#w0-country_code-i').html(FgalValue);
                       location.reload();
                          }
                        }
                              );
                }
                  
                  </script>
                  <li class="dropdown language-a">
                  <?=$CurrentLan?>
                    <ul class="dropdown-menu lang-drop">
                      <?=$ToSelectLan?>
                    </ul>
                  </li>

                </ul>
                  <?php if (Yii::$app->user->isGuest) { ?>
                                        <a  class="cst-btn navbar-right" data-toggle="modal" href='#login-modal'><?=Yii::t('app', 'Login / Register Free')?></a>
                                <?php } else { ?>

                                        <?= Html::a(Yii::t('app', 'Log out'), ['/site/logout'], ['class' => 'cst-btn navbar-right', 'aria-hidden' => 'true']) ?>

                                <?php } ?>
                
<style>
    .menu-padding {
        padding-top:76px;
    }
    .navbar-header{
        height: 87px;
    }
    .sticky {
        position:fixed;
        top:0;
        z-index: 10000;
        width:100%;
    }
</style>
                <ul class="nav navbar-nav navbar-right">
                  <li class="my-full-width dropdown yamm-fw">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" id="StoreButton" aria-expanded="false"><?=Yii::t('app', 'Store')?></a>
                    <?php

    $this->registerJs(<<<JS
            
                $(document).ready(function () {

        var menu = $('.main-menu-of-the-web');
        var origOffsetY = menu.offset().top;

        function scroll() {
            if ($(window).scrollTop() >= origOffsetY) {
                $('.main-menu-of-the-web').addClass('sticky');
                $('.main-content').addClass('menu-padding');
            } else {
                $('.main-menu-of-the-web').removeClass('sticky');
                $('.main-content').removeClass('menu-padding');
            }


        }

        document.onscroll = scroll;

    });
 $('#StoreDropDownMenu').click(function() {
            alert('test');
            $("#StoreButton").attr("aria-expanded", "true");
            $("#StoreDropDownMenu").attr("style", "left: 0px; right: 0px; display: block;");
      
   });

            
       
JS
    );

?>
                    <ul class="dropdown-menu" style="left:0;right:0;" id="StoreDropDownMenu">
                      <li>
                        <div class="container">
                          <div class="row">
                            <div class="col-sx-12 col-sm-12 col-lg-4 visible-lg photo-nav">
                              <div class="photo-block">
                                <img class="img-responsive" src="<?= Yii::$app->request->baseUrl . '/img/nav-banner.png' ?>" >
                                <div class="photo-signature">
                                  Berta Wedding Dress
                                </div>
                              </div>
                            </div>
                            <div class="col-sx-12 col-sm-12 col-lg-8 lot-of-links">
                                <h3 class="visible-lg">Store <div style="float : right;"><span id="SortingCategories"> Sort By</span><select  ><option>test</option></select></div> </h3>
                              
                              <?php 
                             $AllSub= MainController::GetAllSubCategories();
                             $p=0;
                            
                              if($AllSub!=null && sizeof($AllSub)>0){
                                  foreach($AllSub as $Sub){
                                     
                                      if($p==0){
                                          ?>
                                        <div class="col-xs-12 col-sm-3 col-lg-3 cst-padding-left0">
                                        <ul class="list-unstyled">  
                                     <?php } ?>
                                      <li><a href="#"><?=$Sub->SUB_CATEGORY_NAME?></a></li>
                                      
                                      <?php
                                      $p++; 
                                      if($p==9 || $p==sizeof($AllSub)-1){
                                          ?>
                                          </ul>
                                </div>
                              <?php
                                        $p=0;  
                                      }
                                    ?>
                               
                              <?php
                             
                                  }
                              }
                              
                              ?>
                            
                              <div class="col-sx-12 col-sm-12 col-lg-6"></div>
                              
                            </div>
                          </div>
                        </div>
                      </li>
                    </ul>
                    
                  </li>
                  <li><a href="#block4"><?=Yii::t('app', 'Planning Tool')?></a></li>
                  <li><a href="#block5"><?=Yii::t('app', 'Blog')?></a></li>
                </ul>


                <form class="navbar-form navbar-right dropdown" dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>">
                  <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="form-group inner-addon left-addon" dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>">
                        <i class="fa fa-search" aria-hidden="true" style="z-index: 100;"></i>
                      <input type="text" dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>" class="form-control" style="border-color: black;">
                    </div>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="#" class="">Greek</a></li>
                    <li><a href="#" class="">French</a></li>
                    <li><a href="#" class="">Arabiс</a></li>
                  </ul>
                </form>

              </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
          </nav>

        <div class="main-content">

<?= $content ?>
        </div>
 <div class="container-fluid block11-fluid">
            <div class="container block11">
              <div class="row">
                <div class="col-xs-6 col-sm-4 col-md-2 hidden-xs">
                  <h3><?=Yii::t('app', 'Support')?></h3>
                  <ul class="list-unstyled">
                    <li><a href="#"><?=Yii::t('app', 'FAQ')?></a></li>
                    <li><a href="#"><?=Yii::t('app', 'Chat with us')?></a></li>
                    <li><a href="#"><?=Yii::t('app', 'Call Assitance')?></a></li>
                    <li><a href="#"><?=Yii::t('app', 'Call Webmaster')?></a></li>
                  </ul>
                </div>
                <div class="col-xs-6 col-sm-4 col-md-3">
                  <h3><?=Yii::t('app', 'Info')?></h3>
                  <ul class="list-unstyled">
                    <li><a href="#"><?=Yii::t('app', 'Terms and Conditions')?></a></li>
                    <li><a href="#"><?=Yii::t('app', 'About Us')?></a></li>
                    <li><a href="#"><?=Yii::t('app', 'Site Map')?></a></li>
                  </ul>
                </div>
                <div class="col-xs-6 col-sm-4 col-md-3">
                  <h3><?=Yii::t('app', 'Augury and Luck')?></h3>
                  <ul class="list-unstyled">
                       <li><a href="#"><?=Yii::t('app', 'Enter Draw')?></a></li>
                    <!--<li><a href="#"><?=Yii::t('app', 'Horoscope & Compatiblity')?></a></li>-->
                   
                  </ul>
                </div>
                <div class="col-xs-6 col-sm-4 col-md-2">
                  <h3><?=Yii::t('app', 'Supplier')?></h3>
                  <ul class="list-unstyled">
<!--                    <li class="hidden-xs"><a href="#">Partner Sign up</a></li>-->
                    <li><a href="#"><?=Yii::t('app', 'Terms and Conditions')?></a></li>
                    <li><a href="#"><?=Yii::t('app', 'FAQ')?></a></li>
                    <li><a href="#"><?=Yii::t('app', 'Supplier Login')?></a></li>
                  </ul>
                </div>
                <div class="col-xs-6 col-sm-4 col-md-2 ">
                  <h3><?=Yii::t('app', 'Follow Us')?></h3>
                  
                  <ul class="list-unstyled social-icons-list">
                    <li><a href="#"><i class="fa fa-facebook fa-lg" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-twitter fa-lg" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-instagram fa-lg" aria-hidden="true"></i></a></li>
                  </ul>
                  
                  <ul class="list-unstyled">
<!--                    <li class="hidden-xs"><a href="#">Partner Sign up</a></li>-->
<li><h3><a href="#" style="font-weight: 100;font-size:23px;"><?=Yii::t('app', 'Media Releases')?></a></h3></li>
                   
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <!-- footer -->
          <div class="container-fluid footer-block">
            <div class="container">
              <?=Yii::t('app', 'Copyright © 2016 - {currentYear}, Xperteam S.A.L., All Rights Reserved.',[
                  'currentYear'=>date("Y")
              ])?>
            </div>
          </div>

<?php

    $this->registerJs(<<<JS
            
            
            
//$("*").click(function(e){
//    //do something
//           if(e.target.id==='NeedAs'){
//            
//            List-Un
//});
//$("#thatElement").click(function(){
//    return; //do nothing
//});
//$("#").(function(){
//    $(this).hide();
//});
  $(document).ready(function()
{
    $('html').click(function(e)
    {
//            alert(e.target.id );
        var subject = $('#NeedAs'); 
            
        if(e.target.id != subject.attr('id'))
        {
            $("#List-Un").hide();
        }
    });
});
            
       
JS
    );

?>

          <!-- fixed tool -->
          <div class="fixed-wrap">
            <div class="fixed-list" id="List-Un" >
              <ul class="list-unstyled" >
                <li><a href="#"><?=Yii::t('app', 'FAQ')?></a></li>
                <li><a href="#"><?=Yii::t('app', 'Chat with us')?></a></li>
                <li><a href="#"><?=Yii::t('app', 'Call Assitance')?></a></li>
                <li><a href="#"><?=Yii::t('app', 'Call Webmaster')?></a></li>
              </ul>
            </div>
            <a class="cst-btn cst-btn-fixed" id="NeedAs"> <span  id="NeedAs" class="hidden-xs"><?=Yii::t('app', 'Need Assistance')?></span> <i  id="NeedAs" class="fa fa-question visible-xs" aria-hidden="true"></i></a>
          </div>
    


    <?php $this->endBody() ?>
</body>

             
<script type="text/javascript">
    function language_change(selected)
    {
    <?php
    echo '$.ajax(\'' . Yii::$app->getUrlManager()->createUrl("site/language") . "'," . PHP_EOL;
    echo "{'type':'post'," . PHP_EOL;
    echo "success : function(data) {window.location.reload();}," . PHP_EOL;
    echo "'data':'_lang='+selected+'&_csrf=" . Yii::$app->request->csrfToken . "',";
    ?>

        }
        );
    }
</script>
<?php
if (Yii::$app->user->isGuest) {
  $WebPat=Yii::getAlias('@web');
    $this->registerJs(<<<JS
 $(document).ready(function () { 
    $('#LoginC').load('$WebPat/site/login');
        
});
  $(document).ready(function()
{
    $('html').click(function(e)
    {
          
        var subject = $("#List-Un"); 

        if(e.target.id != subject.attr('id'))
        {
            subject.hide();
        }
    });
});
            
       
JS
    );
}
?>
<?php if (Yii::$app->user->isGuest) { ?>			
    <div id="login-modal" class="fade modal " role="dialog" tabindex="-1" >

        <!--<div class="modal-dialog ">
        <div class="modal-content">-->
        <!--<div id="LoginmodalHeader" class="modal-header"><h2>log in</h2></div>-->
        <div class="modal-body" id="LoginC">




        </div>

        <!--</div>
        </div>-->
    </div>
<?php } ?>

<script>


</script>
</html>








<?php $this->endPage() ?>

