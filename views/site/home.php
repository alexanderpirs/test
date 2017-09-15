<!-- block1 -->

<?php

use yii\helpers\Html;

use yii\bootstrap\ActiveForm;
$MainWebimg = Yii::getAlias('@web');
?>
          <div class="container-fluid block1-fluid" style="
    height: 450px;
" >
            <div class="container block1" style="
  text-align:center;
">
              <div class="b1-copy" dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>">
                <h1 dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>"><?=Yii::t('app', 'Your Relaxed Wedding<br>Preparatory Journey')?></h1>
                <h4 dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>" style="    margin-bottom: 17px;"><?=Yii::t('app', 'Exclusive Offers, Free Advice, Cashback and more...')?></h4>
                <a dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>" class="cst-btn cst-btn-b1"  data-toggle="modal" href="#qwerty"><?=Yii::t('app', 'Get Started')?></a>
              </div>
            </div>
          </div>




          <!-- block2 -->
          <div class="container-fluid block2-fluid">
            <div class="container block2">
              <div class="b2-copy">
                <h2 dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>" style="
    margin-bottom: 5px;
"><?=Yii::t('app', 'Exclusive and Limited Nuptial Offers')?></h2>
                <h4 dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>"style="margin-bottom: 0px;font-size : 23px;"><?=Yii::t('app', '<a href="#/" style="color: #fbc49e;" >Packages</a><span style="color : #fbc49e">,</span> <a href="#/" style="color: #fbc49e;" >Venues</a><span style="color : #fbc49e">,</span><a href="#/" style="color: #fbc49e;" > Bridal Dresses</a><span style="color : #fbc49e">,</span><a href="#/" style="color: #fbc49e;"> Wedding Bands</a><span style="color : #fbc49e">, …</span>')?></h4>
                <h4 dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>"><?=Yii::t('app', 'Search our Comprehensive Listings to Compare Prices, Availability, Location and Reviews.')?></h4>
                <a  dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>" class="cst-btn cst-btn-b2" href="#"><?=Yii::t('app', 'Browse All')?></a>
              </div>
            </div>
          </div>

 <div class="container-fluid block5-fluid">
            <div class="container block5">
              <div class="row">
                <div class="col-xs-12 col-sm-6 img-wrap">
                  <img src="<?=$MainWebimg.'/img/b5-img1.jpg'?>">
                </div> 
                <div class="col-xs-12 col-sm-6">
                  <div class="b5-copy" style="text-align:center;">
                    <h2 dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>"><?=Yii::t('app', 'Packages & Deals')?></h2>
                    <p dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>"> <?=Yii::t('app', 'Trust Professionals to Plan Your Wedding the Relaxed Way')?></p>
                    <?= Html::a(Yii::t('app', 'Enquire Now'), ['/packages/index'], ['class' => 'cst-btn cst-btn-b5']) ?>
                    <!--<a class="cst-btn cst-btn-b5" href="#"></a>-->
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- block3 -->
          <div class="container-fluid block3-fluid"  style="display :none;">
            <div class="container block3">
              <div class="owl-carousel">
                <div>
                  <a href="#">
                    <img src="<?=$MainWebimg.'/img/b3-img1.png'?>" class="img-responsive center-block">
                    <p  class="sli-cat">Accessories</p>
                    <p class="sli-name" style="display : none;">Tiaras & Teirs</p>
                  </a>
                </div>

                <div>
                  <a href="#">
                    <img src="<?=$MainWebimg.'/img/b3-img2.png'?>" class="img-responsive center-block">
                    <p class="sli-cat">Wedding Dress</p>
                    <p class="sli-name" style="display : none;">Maggie Sottero</p>
                  </a>
                </div>

                <div>
                  <a href="#">
                    <img src="<?=$MainWebimg.'/img/b3-img3.png'?>" class="img-responsive center-block">
                    <p class="sli-cat">Photography</p>
                    <p class="sli-name" style="display : none;">Tiaras & Teirs</p>
                  </a>
                </div>

                <div>
                  <a href="#">
                    <img src="<?=$MainWebimg.'/img/b3-img4.png'?>" class="img-responsive center-block">
                    <p class="sli-cat">Flowers</p>
                    <p class="sli-name" style="display : none;">Maggie Sottero</p>
                  </a>
                </div>

                <div>
                  <a href="#">
                    <img src="<?=$MainWebimg.'/img/b3-img1.png'?>" class="img-responsive center-block">
                    <p class="sli-cat">Accessories</p>
                    <p class="sli-name" style="display : none;">Tiaras & Teirs</p>
                  </a>
                </div>
                
              </div>
            </div>
          </div>



          <!-- block4 -->
          <div class="container-fluid block4-fluid">
            <div class="container block4">
              <h2 class="text-center"><?=Yii::t('app', 'Free Support & Tools')?></h2>
              <div class="row">
               

               

                <div class="col-xs-12 col-sm-3">
                  <div class="b4-copy">
                      <a href="#/" style="color : #fbc49e;">
                    <img class="center-block" src="<?=$MainWebimg.'/img/b4-img3.svg'?>">
                    <p class="text-center" style="color : #fbc49e;"><?=Yii::t('app', 'Manage your <br>Wedding Spending')?></p>
                      </a>
                  </div>
                </div>
 <div class="col-xs-12 col-sm-3">
                  <div class="b4-copy">
                      <a href="#/" style="color : #fbc49e;">
                    <img class="center-block" src="<?=$MainWebimg.'/img/Checklist.PNG'?>" style="
    margin-bottom: 30px;
">
                    <p class="text-center" style="color : #fbc49e;"><?=Yii::t('app', 'Check Your<br> To-do Task List')?></p>
                      </a>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-3">
                  <div class="b4-copy">
                      <a href="#/" style="color : #fbc49e;">
                    <img class="center-block" src="<?=$MainWebimg.'/img/b4-img4.svg'?>">
                    <p class="text-center" style="color : #fbc49e;"><?=Yii::t('app', 'Create Your Registry and Own Website')?> </p>
                      </a>
                  </div>
                </div>
                  
                   <div class="col-xs-12 col-sm-3">
                  <div class="b4-copy">
                      <a href="#/" style="color : #fbc49e;">
                    <img class="center-block"  src="<?=$MainWebimg.'/img/advisor.PNG'?>">
                    <p class="text-center" style="color : #fbc49e;"><?=Yii::t('app', 'Ask Assistance to Wedding Advisors')?></p>
                      </a>
                  </div>
                </div>
              </div>
            </div>
          </div>




          <!-- block5 -->
         



          <!-- block6 -->
          <div class="container-fluid block6-fluid" style="display: none;">
            <div class="container block6">
              <div class="row">
                <div class="col-xs-12 col-sm-4">
                <div class="b6-copy">
                  <img class="img-responsive" src="<?=$MainWebimg.'/img/b6-img1.png'?>">
                  <p dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>" class="b6-cat"><?=Yii::t('app', 'News')?></p>
                  <p  dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>" class="b6-head"><?=Yii::t('app', 'Enter the Draw to Win Tickets at the Wedding Fair')?></p>
                  <p dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>" class="b6-sub"><?=Yii::t('app', 'The British Wedding Awards are a celebration of the UK’s favourite wedding brands and products.')?> </p>
                </div>
                </div>

                <div class="col-xs-12 col-sm-4">
                <div class="b6-copy">
                  <img class="img-responsive" src="<?=$MainWebimg.'/img/b6-img2.png'?>">
                  <p class="b6-cat"><?=Yii::t('app', 'Ideas')?></p>
                  <p class="b6-head"><?=Yii::t('app', 'A Breakdown and Definition of Every Wedding Theme')?></p>
                  <p class="b6-sub"><?=Yii::t('app', 'Not sure how to define the look of your wedding day? Consider this your Merriam-Webster of wedding style.')?></p>
                </div>
                </div>

                <div class="col-xs-12 col-sm-4">
                <div class="b6-copy">
                  <img class="img-responsive" src="<?=$MainWebimg.'/img/b6-img3.png'?>">
                  <p dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>" class="b6-cat"><?=Yii::t('app', 'Advice')?></p>
                  <p dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>" class="b6-head"><?=Yii::t('app', '9 Rules for Accessorizing Your Wedding Dress')?></p>
                  <p dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>" class="b6-sub"><?=Yii::t('app', 'Now that you\'ve found your gown, the next step is choosing the finishing touches.')?></p>
                </div>
                </div>
              </div>
            </div>
          </div>



          <!-- block7 -->
          <div class="container-fluid block7-fluid">
            <div class="container block7">
              <div class="row">
                <div class="col-xs-12 col-sm-4 news-col">
                  <p class="b7-advice"><?=Yii::t('app', 'News, Tips and Advice')?> </p>
                  <div class="news-wrap">
                    <div class="row news-block">
                      <a href="#">
                        <div class="col-xs-12 col-sm-5">
                          <img src="<?=$MainWebimg.'/img/b7-img1.png'?>" class="img-responsive">
                        </div>
                        <div class="col-xs-12 col-sm-7 news-copy">
                          <p dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>"><?=Yii::t('app', '5 things to consider when setting your budget')?></p>
                        </div>
                      </a>
                    </div>


                    <div class="row news-block">
                      <a href="#">
                        <div class="col-xs-12 col-sm-5">
                          <img src="<?=$MainWebimg.'/img/b7-img1.png'?>" class="img-responsive">
                        </div>
                        <div class="col-xs-12 col-sm-7 news-copy">
                          <p dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>"><?=Yii::t('app', '7 things you need to avoid')?></p>
                        </div>
                      </a>
                    </div>

                    <div class="row news-block">
                      <a href="#">
                        <div class="col-xs-12 col-sm-5">
                          <img src="<?=$MainWebimg.'/img/b7-img1.png'?>" class="img-responsive">
                        </div>
                        <div class="col-xs-12 col-sm-7 news-copy">
                          <p dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>"><?=Yii::t('app', '7 things you need to avoid')?></p>
                        </div>
                      </a>
                    </div>

                    <div class="row news-block">
                      <a href="#">
                        <div class="col-xs-12 col-sm-5">
                          <img src="<?=$MainWebimg.'/img/b7-img1.png'?>" class="img-responsive">
                        </div>
                        <div class="col-xs-12 col-sm-7 news-copy">
                          <p dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>"><?=Yii::t('app', '7 things you need to avoid')?></p>
                        </div>
                      </a>
                    </div>

                  </div>

                </div>

                <div class="col-xs-12 col-sm-8">
                  <p class="b7-advice"><?=Yii::t('app', 'Wedding Showcase')?></p>

                  <?php
                 
                  if($Videos!=null && sizeof($Videos)){
                      $o=0;
                      ?>
                  
                  <div class="vid-container">
                     
                      <iframe id="vid_frame" src="<?=$Videos[0]->VIDEO_LINK?>?rel=0&showinfo=0&autohide=1" frameborder="0" width="560" height="315"></iframe>
                  </div>
                  <div class="vid-list-container">
                        <ol id="vid-list">
                  <?php
                     foreach($Videos as $Video){
                        
                         ?>
                  <li>
                            <a href="javascript:void();" onClick="document.getElementById('vid_frame').src='<?=$Video->VIDEO_LINK?>?autoplay=1&rel=0&showinfo=0&autohide=1'">
                              <span class="vid-thumb"><img width=72 src="<?=$Video->VIDEO_IMG?>" /></span>
                              <div class="desc"><?=$Video->VIDEO_NAME?></div>
                            </a>
                          </li>
                  <?php
                  
                   } 
                  }
                  ?>
                 
                           
                          
                          
                          
                        </ol>
                   </div>
                </div>

              </div>
            </div>
          </div>



          <!-- block8 -->
          <div class="container-fluid block8-fluid">
            <div class="container block8">
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 cst-marg-bot40 cst-padding-0">
                  <div class="col-xs-12 col-sm-6 col-md-6">
                    <img class="center-block img-responsive" src="<?=$MainWebimg.'/img/b8-img1.png'?>">
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6" >
                    <div class="b8-copy" style="text-align:center;">
                      <h3 dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>"><?=Yii::t('app', 'Win two Free Tickets For Your Couple')?></h3>
                      <p dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>"><?=Yii::t('app', 'Drop Your Bullet to Enter The Next Draw (on October 31)<br>&nbsp;&nbsp;&nbsp;')?> </p>
                      <a dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>" href="#" class="cst-btn cst-btn-b8"><?=Yii::t('app', 'Enter Draw')?></a>
                    </div>
                  </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 cst-marg-bot40 cst-padding-0">
                  <div class="col-xs-12 col-sm-6 col-md-6">
                    <img class="center-block img-responsive" src="<?=$MainWebimg.'/img/b8-img2.png'?>">
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6" style="text-align:center;">
                    <div class="b8-copy">
                      <h3 dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>"><?=Yii::t('app', 'Benefit From Our Added Values')?></h3>
                      <p dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>"><?=Yii::t('app', '- Related Insurance<br>- Reward Points For Discounts<br>&nbsp;&nbsp;&nbsp;... and More ')?> </p>
                      <a href="#" class="cst-btn cst-btn-b8"><?=Yii::t('app', 'Learn How')?></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>






          <!-- block9 -->
          <div class="container-fluid block9-fluid" style="display : none;">
            <div class="container block9">
              <h2 dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>" class="text-center"><?=Yii::t('app', 'Some Of Our Brands')?></h2>
              <div class="row">
                <div class="col-xs-12 col-sm-3">
                    <a href="#/">
                  <img class="img-responsive center-block" src="<?=$MainWebimg.'/img/b9-img1.png'?>">
                    </a>
                </div>
                <div class="col-xs-12 col-sm-3">
                     <a href="#/">
                  <img class="img-responsive center-block" src="<?=$MainWebimg.'/img/b9-img2.png'?>">
                   </a>
                </div>
                <div class="col-xs-12 col-sm-3">
                     <a href="#/">
                  <img class="img-responsive center-block" src="<?=$MainWebimg.'/img/b9-img3.png'?>">
                   </a>
                </div>
                <div class="col-xs-12 col-sm-3">
                     <a href="#/">
                  <img class="img-responsive center-block" src="<?=$MainWebimg.'/img/b9-img4.png'?>">
                   </a>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-12 col-sm-3">
                     <a href="#/">
                  <img class="img-responsive center-block" src="<?=$MainWebimg.'/img/b9-img5.png'?>">
                   </a>
                </div>
                <div class="col-xs-12 col-sm-3">
                     <a href="#/">
                  <img class="img-responsive center-block" src="<?=$MainWebimg.'/img/b9-img6.png'?>">
                   </a>
                </div>
                <div class="col-xs-12 col-sm-3">
                     <a href="#/">
                  <img class="img-responsive center-block" src="<?=$MainWebimg.'/img/b9-img7.png'?>">
                     </a>
                    
                </div>
                <div class="col-xs-12 col-sm-3">
                     <a href="#/">
                  <img class="img-responsive center-block" src="<?=$MainWebimg.'/img/b9-img8.png'?>">
                     </a>
                </div>
              </div>
            </div>
          </div>


          <!-- block10 -->
          <div class="container-fluid block10-fluid">
            <div class="container block10">
              <div class="b10-copy">
                <h2 dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>" class="text-center"><?=Yii::t('app', 'Suppliers! Partner with Us')?></h2>
                <h4  dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>" class="text-center" style="margin-bottom: 0px;font-size : 23px;"><?=Yii::t('app', 'Reach Crowd of Couples Preparing Their Weddings.')?></h4> 
                <h4 dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>" class="text-center" ><?=Yii::t('app', 'Learn How Our Unique Partnership Model Would be of a Mutual Benefit.')?></h4>
                <a dir="<?= Yii::$app->language=='ar' ?'rtl':'ltr' ?>" class="cst-btn cst-btn-b10" href="#"><?=Yii::t('app', 'Register Now')?></a>
              </div>
            </div>
          </div>
          
          <div class="modal fade" id="qwerty" tabindex="-1" role="dialog">
    <div class="modal-dialog gettingStartedModal">
        <div class="modal-content">
            <?php
$form = ActiveForm::begin([
            'id' => 'EstimetadedBudget',
            'enableAjaxValidation' => true,
            'action' => ['site/validate'],
//        'fieldConfig' => [
//            'template' => "{label}<br><div class=\"col-lg-5\">{input}</div><br><div class=\"col-lg-5\">{error}</div>",
//            'labelOptions' => ['class' => 'col-lg-2 control-label'],
//        ],
        ]);
?>
                <?php
                $this->registerJs(<<<JS

//       $(document).ready(function () {
     var start = moment().subtract(29, 'days');
    var end = moment();

   

     $('#keks_date').daterangepicker({
        startDate: start,
        endDate: end
    }, cbs);

    function cbs(start, end) {
        $('#keks_date span').html(start.format('D/M/YYYY') + ' - ' + end.format('D/M/YYYY'));
                        document.getElementById('DateRangePicker').value=start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY');
    }

    cbs(start, end);
//    cb(start, end);

//          var start = moment().add(30, 'days');
//          var end = moment().add(1, 'year');
//
//      $('#estimateWeddingCalendar').daterangepicker({
//   format : 'DD-MM-YYYY',
//       autoclose: true,
//   startDate: new Date(),
//        endDate: end,
//        
//        autoUpdateInput: true
//        
//      })


     

//    });
                        $('#preferableDayItemm').click(function() {
                        alert(document.getElementById('momhidden').value);
                        if(document.getElementById('momhidden').value=='false'){
                        $('#monPrefer').prop('checked', true);
                        document.getElementById('momhidden').value='true';
                        }else{
                        $('#monPrefer').prop('checked', false);
                        document.getElementById('momhidden').value='false';
                        }
 
           });
                        
                        
                        
JS
                );
//                'EstimatedFunding'=>$EstimatedFunding,
//                    'EstimatedBudget'=>$EstimatedBudget,
//                    'InviteeNumber'=>$InviteeNumber,
//                    'DateRangePicker'=>$DateRangePicker,
//                    'PreferedDays'=>$PreferedDays,
                
                 $cookies = Yii::$app->request->cookies;
//        $EstimatedFunding = null;
//        $EstimatedBudget = null;
          
                $EstimatedFunding = $cookies->getValue('EstimatedFunding', '0');
              $EstimatedBudget=$cookies->getValue('estimatedbudget', '0');
              $InviteeNumber=$cookies->getValue('InviteeNumber', '0');
              $DateRangePicker=$cookies->getValue('DateRangePicker', '0');
              $PreferedDays=$cookies->getValue('preferedDays', '0');
                
                ?>
            <div class="modal-body">
                
                <button type="button" class="close gettingStartedModalCloseBtn" data-dismiss="modal">&times;</button>
                <h3 class="h3">Get Started</h3>
                <form action="">
                    <div class="row estimateWeddingWrap">

                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 ">
                            <span class="estimateWedding">Estimated wedding date </span>
                            <input type="hidden" id="DateRangePicker" name="DateRangePicker" value="">
                            <div id="keks_date" class="estimateWeddingCalendar">
                                <span></span>
                                <i class="glyphicon glyphicon-calendar fa fa-calendar pull-right"></i>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 ">
                            <span class="preferableDayDesc">Select preferred days:</span>
                        <ul class="preferableDayUl">
                            <li class="preferableDayItem" id="preferableDayItemm">
                                <input type="hidden" id="momhidden" value="false">
                                <label for="monPrefer"><input id="monPrefer" name="chosenDayMon" value="Mon" type="radio"><span>Mon</span></label></li>
                            <li class="preferableDayItem"><label for="tuePrefer"><input id="tuePrefer" name="chosenDayTue" value="Tue" type="radio"><span>Tue</span></label></li>
                            <li class="preferableDayItem"><label for="wedPrefer"><input id="wedPrefer" name="chosenDayWed" value="Wed" type="radio"><span>Wed</span></label></li>
                            <li class="preferableDayItem"><label for="thuPrefer"><input id="thuPrefer" name="chosenDayThu" value="Thu" type="radio"><span>Thu</span></label></li>
                            <li class="preferableDayItem"><label for="friPrefer"><input id="friPrefer" name="chosenDayFri" value="Fri" type="radio"><span>Fri</span></label></li>
                            <li class="preferableDayItem"><label for="satPrefer"><input id="satPrefer" name="chosenDaySat" value="Sat" type="radio"><span>Sat</span></label></li>
                            <li class="preferableDayItem"><label for="sunPrefer"><input id="sunPrefer" name="chosenDaySun" value="Sun" type="radio"><span>Sun</span></label></li>
                        </ul>

                            <ul class="preferableDayUl preferableDayUlWeekDays">
                                <li class="preferableDayItem preferableDayItemLi1"><label class="preferableDayItemWeekdaysLabel" for="weekdaysPrefer"><input id="weekdaysPrefer" name="chosenDayweekdays" value="weekdays" type="radio"><span class="preferableDayItemWeekdaysSpan">Weekdays</span></label></li>
                                <li class="preferableDayItem preferableDayItemLi2"><label class="preferableDayItemWeekdaysLabel" for="weekendsPrefer"><input id="weekendsPrefer" name="chosenDayweekends" value="weekends" type="radio"><span class="preferableDayItemWeekdaysSpan">Weekends</span></label></li>
                            </ul>
                        </div>

                    </div>
                    <!--Estimated budget start-->
                    <div class="row calculateBudgetWrap">


                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 ">
                            <span class="calculateBudgetValue">Estimated budget<span class="value1"><?='$'. number_format(intval($EstimatedBudget))?></span></span>

                            <input
                                    type="range"
                                    min="0"
                                    max="250000"
                                    name="rangepicker1"
                                    step="1"
                                    value="<?= $EstimatedBudget?>" 
                                    class="rangepicker1"
                            >
                        </div>

                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                            <div class="first_range_text calculateBudgetSelect">
                                <select id="firstselect" class="calculateBudgetSelectOption">
                                    <?php
                        if ($Range != null && sizeof($Range) > 0) {
                            foreach ($Range as $ra) {
                                if ($ra->FROM_AMOUNT != 0 && $ra->TO_AMOUNT != 0) {
                                    $Moyen = (intval($ra->FROM_AMOUNT) + intval($ra->TO_AMOUNT)) / 2;
                                    $Selected="";
                                    if($ra->FROM_AMOUNT < intval($EstimatedBudget) && $ra->TO_AMOUNT > intval($EstimatedBudget)){
                                      $Selected="selected";  
                                    }
                                    ?>
                                    <option <?=$Selected?> value="<?= $Moyen ?>"><?= '$'.number_format($ra->FROM_AMOUNT) . ' - $' . number_format($ra->TO_AMOUNT).'' ?></option>

                                    <?php
                                } else if ($ra->FROM_AMOUNT == 0 && $ra->TO_AMOUNT != 0) {
                                    $Moyen = (intval($ra->FROM_AMOUNT) + intval($ra->TO_AMOUNT)) / 2;
                                    $Selected="";
                                    if($ra->FROM_AMOUNT < intval($EstimatedBudget) && $ra->TO_AMOUNT > intval($EstimatedBudget)){
                                      $Selected="selected";  
                                    }
                                    ?>
                                    <option <?=$Selected?> value="<?= $Moyen ?>"><?= 'lest than $' . number_format($ra->TO_AMOUNT) .''?></option>

                                    <?php
                                }
                                ?>	


                                <?php
                            }
                        }
                        ?>
                                </select>
                            </div>
                        </div>


                    </div>
                    <!--Estimated budget end-->
                    <!--Estimated fundingt start -->
                    <div class="row calculateBudgetWrap">


                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 ">
                            <span class="calculateBudgetValue">Available funding<span class="value2"><?='$'. number_format(intval($EstimatedFunding))?></span></span>

                            <input
                                    type="range"
                                    min="0"
                                    max="250000"
                                    name="rangepicker2"
                                    step="1"
                                    value="<?=$EstimatedFunding?>"
                                    class="rangepicker2"
                            >

                        </div>

                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                            <div class="second_range_text calculateBudgetSelect">
                                <select name="" id="secondselect" class="calculateBudgetSelectOption" >
                                     <?php
                        if ($Range != null && sizeof($Range) > 0) {
                            foreach ($Range as $ra) {
                                $Moyen = (intval($ra->FROM_AMOUNT) + intval($ra->TO_AMOUNT)) / 2;
                                
                                if ($ra->FROM_AMOUNT != 0 && $ra->TO_AMOUNT != 0) {
                                    $Selected="";
                                    if($ra->FROM_AMOUNT < intval($EstimatedFunding) && $ra->TO_AMOUNT > intval($EstimatedFunding)){
                                      $Selected="selected";  
                                    }
                                    ?>
                                    <option <?=$Selected?> value="<?= $Moyen ?>"><?= '$'.number_format($ra->FROM_AMOUNT) . ' - $' . number_format($ra->TO_AMOUNT) ?></option>
                                    <?php
                                } else if ($ra->FROM_AMOUNT == 0 && $ra->TO_AMOUNT != 0) {
                                    $Selected="";
                                    if($ra->FROM_AMOUNT < intval($EstimatedFunding) && $ra->TO_AMOUNT > intval($EstimatedFunding)){
                                      $Selected="selected";  
                                    }
                                    ?>
                                    <option <?=$Selected?> value="<?= $Moyen ?>"><?= 'lest than $' . number_format($ra->TO_AMOUNT) ?></option>
                                    <?php
                                }
                                ?>	


                                <?php
                            }
                        }
                        ?>
                                </select>
                            </div>
                        </div>


                    </div>

                    <!--Estimated fundingt end -->

                    <!--People to invite start -->
                    <div class="row calculateBudgetWrap">

                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 ">
                              <span class="calculateBudgetValue">People to invite<span
                                      class="value3"><?=$InviteeNumber ?></span></span>

                                <input
                                        type="range"
                                        min="0"
                                        max="400"
                                        name="rangepicker3"
                                        step="1"
                                        value="<?=$InviteeNumber ?>"
                                        class="rangepicker3"
                                >

                        </div>

                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                            <div class="third_range_text calculateBudgetSelect">
                                <select name="" id="thirdselect" class="calculateBudgetSelectOption">
                                    <option value="0">less than 100 persons</option>
                                    <option value="150">100 - 200 persons</option>
                                    <option value="250">200 - 300 persons</option>
                                    <option value="350">300 - 400 persons</option>
                                    <option value="400">more than 400 persons</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <!--People to invite end -->
                        <!--preparationIcons start-->
                    <div class="row preparationIconsWrap">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                           
                            <div class="iconsblock howToStart" id="1">
                                 <a href="#/" style="color : #fbc49e;">
                                <img src="<?=Yii::getAlias('@web').'/img/don\'t-know-smile.png'?>" alt="don't-know-smile"  class="unselectedimg">
                                <img src="<?=Yii::getAlias('@web').'/img/don\'t-know-smile-active.png'?>" alt="don't-know-smile-active" class="selectedimg" style="display: none;">
                                <p class="abouttexticons" style="color : #fbc49e">Need to chat with wedding advisor<br>(free support)
                                    </p>
                                     </a>
                            </div>
                           
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" >
                            <div class="iconsblock freeAssistance" id="2">
                                <a href="#/" style="color : #fbc49e;">
                                <img src="<?=Yii::getAlias('@web').'/img/need-assistance-smile.png'?>" alt="need-assistance-smile"  class="unselectedimg">
                                <img src="<?=Yii::getAlias('@web').'/img/need-assistance-smile-active.png'?>" alt="need-assistance-smile-active" class="selectedimg" style="display: none;">
                                <p class="abouttexticons" style="color : #fbc49e">Don't know <br>how to start</p>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="iconsblock behindSchedule" id="3">
                                <a href="#/" style="color : #fbc49e;">
                                <img src="<?=Yii::getAlias('@web').'/img/behind-the-schedule-smile.png'?>" alt="behind-the-schedule-smile"  class="unselectedimg">
                                <img src="<?=Yii::getAlias('@web').'/img/behind-the-schedule-smile-active.png'?>" alt="behind-the-schedule-smile-active" class="selectedimg" style="display: none;">
                                <p class="abouttexticons" style="color : #fbc49e">Can't find what <br>I am looking for</p>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="iconsblock myPreparation" id="4" >
                                <a href="#/" style="color : #fbc49e;">
                                <img src="<?=Yii::getAlias('@web').'/img/smile.png'?>" alt="smile" class="unselectedimg">
                                <img src="<?=Yii::getAlias('@web').'/img/smile-active.png'?>" alt="smile-active" class="selectedimg" style="display: none;">
                                <p class="abouttexticons" style="color : #fbc49e">Doing well <br>in my preparation</p>
                                </a>
                            </div>
                        </div>

                    </div>
                        <input type="hidden" value="" id="face" name="face">
                    <!--preparationIcons end-->

<div class="row footerModalWrap">
    <div class="footerModal">

        <label class="control control--checkbox needSupportLabel" id="checkboxc">I need external support in preparation
            <input type="checkbox" checked="checked" name="Che" class="needSupportCheck" id="Che">
            <div class="control__indicator needSupportControlIndicator" id="cheee"></div>
        </label>
              
                <div class="buttons">
                    <a href="#/" id="getstaredbutton" class="letsGetStartedBtn">Let's get started</a>
                    <a href="#" class="slipContinue">Skip
                        and continue</a>
                </div>
    </div>
</div>


 <?php
 
 $Webb=Yii::getAlias('@web');
                $this->registerJs(<<<JS

//                        $('#checkboxc').click(function(){
//                        alert($('#cheee').html());
                        
//                        if($('#cheee').html()===""){
//  document.getElementById('Che').checked = false;
//   }else{
//       document.getElementById('Che').checked = true;                  
//   }
//                            })
                        
                        
$( ".iconsblock" ).click(function() {
        document.getElementById('face').value=$( this ).attr("id");
                        $('.unselectedimg').show();
                        $('.selectedimg').hide();
       var images = $(this).find('img');       
        var Parag = $(this).find('p'); 
       $('.abouttexticons').css({"text-decoration": "none"});
//           alert(images.length);
                        if(images.length==2){
                        if($(images[0]).is(":visible")){
                        $(images[0]).hide();
                        $(images[1]).show();
                        Parag.css({"text-decoration": "underline","color" : "#fbc49e" });
                        }else{
                         $(images[0]).show();
                          $(images[1]).hide();
                       
                            }
                        }
                        
});
$('#getstaredbutton').click(function(){
                        $('#EstimetadedBudget').submit();
   });
                        
 $(document).ready(function(){       
$('body').on('beforeSubmit', '#EstimetadedBudget', function () {
   
   var form = $(this);
       alert('test');
     // return false if form still have some validation errors
     if (form.find('.has-error').length) {
          return false;
     }
     // submit form
     $.ajax({
          url: '$Webb/wedding-estimated-budget/save-estimated-budget',
          type: 'post',
          data: form.serialize(),
          success: function (response) {
        if(response.close!=null){
        $('#qwerty').modal('hide');
          $('#GetStartedB').remove();  
        }else{
        $('#qwerty').modal('hide');
            $('.LoginshowModalButton').click();
   }
            
          }
     });
        
     return false;
});
 });
      
        
  
        
JS
                );
                ?>









            </div>
 <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
          
          <script>
    
</script>
  <?php
$FirstSelectJavaScriptCode = "";
if ($Range != null && sizeof($Range) > 0) {
    foreach ($Range as $ra) {
        $Moyen = (intval($ra->FROM_AMOUNT) + intval($ra->TO_AMOUNT)) / 2;
        if ($ra->FROM_AMOUNT != 0 && $ra->TO_AMOUNT != 0) {
            $FirstSelectJavaScriptCode = $FirstSelectJavaScriptCode . 'if (value < ' . $ra->TO_AMOUNT . ' && value > ' . $ra->FROM_AMOUNT . ') {
 	  				$(\'#firstselect\').val(\'' . $Moyen . '\');
 	  			}';
        } else if ($ra->FROM_AMOUNT == 0 && $ra->TO_AMOUNT != 0) {
            $FirstSelectJavaScriptCode = $FirstSelectJavaScriptCode . ' if (value < ' . $ra->TO_AMOUNT . ' && value > 0 ){
 	  				$(\'#firstselect\').val(\'' . $Moyen . '\');
 	  			}';
        }
    }
}

$SecondSelectJavaScriptCode = "";
if ($Range != null && sizeof($Range) > 0) {
    foreach ($Range as $ra) {
        $Moyen = (intval($ra->FROM_AMOUNT) + intval($ra->TO_AMOUNT)) / 2;
        if ($ra->FROM_AMOUNT != 0 && $ra->TO_AMOUNT != 0) {
            $SecondSelectJavaScriptCode = $SecondSelectJavaScriptCode . 'if (value < ' . $ra->TO_AMOUNT . ' && value > ' . $ra->FROM_AMOUNT . ') {
 	  				$(\'#secondselect\').val(\'' . $Moyen . '\');
 	  			}';
        } else if ($ra->FROM_AMOUNT == 0 && $ra->TO_AMOUNT != 0) {
            $SecondSelectJavaScriptCode = $SecondSelectJavaScriptCode . ' if (value < ' . $ra->TO_AMOUNT . ' && value > 0 ){
 	  				$(\'#secondselect\').val(\'' . $Moyen . '\');
 	  			}';
        }
    }
}
?>

<?php
$this->registerJs(
        "
     $(document).ready(function(){
 	  	$('.rangepicker1').rangeslider({polyfill: false ,
 	  		onSlide: function(position, value) {
//                        alert('rangepicker1');
 	  			$(\".value1\").text(\"$\" + numberWithCommas($(\".rangepicker1\").val()));
 	  			$FirstSelectJavaScriptCode
 	  		}
 	  	});
 	  	$('.rangepicker2').rangeslider({polyfill: false ,
 	  		onSlide: function(position, value) {
 	  			$(\".value2\").text( \"$\" + numberWithCommas($(\".rangepicker2\").val()) );
 	  			$SecondSelectJavaScriptCode
 	  		}
 	  	});
 	  	$('.rangepicker3').rangeslider({polyfill: false ,
 	  		onSlide: function(position, value) {
 	  			$(\".value3\").text($(\".rangepicker3\").val() +\" persons\");
 	  			if (value == 400){
 	  				$('#thirdselect').val('400');
 	  			}
 	  			if (value < 100){
 	  				$('#thirdselect').val('0');
 	  			}
 	  			if (value < 200 && value > 100) {
 	  				$('#thirdselect').val('150');
 	  			}
 	  			if (value < 300 && value > 200) {
 	  				$('#thirdselect').val('250');
 	  			}
 	  			if (value < 400 && value > 300) {
 	  				$('#thirdselect').val('350');
 	  			}
 	  		}
 	  	});
 	  });
          
$('#firstselect').on('change' , function(){
		$('.rangepicker1').val($(this).val()).change(); 
                alert('test');
	});
	$('#secondselect').on('change' , function(){
		$('.rangepicker2').val($(this).val()).change(); 
	});
	$('#thirdselect').on('change' , function(){
		$('.rangepicker3').val($(this).val()).change(); 
	});
        
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, \",\");
}
"
);
?>			
