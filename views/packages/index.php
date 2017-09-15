
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\widgets\Breadcrumbs;
use app\controllers\WedsiteController; 

//echo $WeddingEventModel[0]->weddingTentativePeriodes[0]->TO_DATE;
//$newDate = date("d/m/Y", strtotime($WeddingEventModel[0]->weddingTentativePeriodes[0]->TO_DATE));
//echo '<br>' . $newDate."<br>";
$WeddingID = 0;
$FirstPartnerName = "";
$SecondPartnerName = "";
$WeddingType = "";
//sECONDCOUPLEPARTNER weddingTypeTranslation wEDDINGTYPE
$profilePAth = "";
$UserProfilePic="";
$CouplePartnerD=0;
//USER_PROFILE_PIC
if (Yii::$app->user->identity != null){
    $UserProfilePic = Yii::$app->user->identity->USER_PROFILE_PIC;
    $CouplePartnerD = Yii::$app->user->identity->COUPLE_PARTNER_ID;
}
//sECONDCOUPLEPARTNER weddingTypeTranslation wEDDINGTYPE
if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
    $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
    $profilePAth = Yii::$app->user->identity->weddings0[0]->COUPLE_IMG;
    $FirstPartnerName = Yii::$app->user->identity->weddings0[0]->fIRSTCOUPLEPARTNER->COUPLE_PARTNER_FIRST_NAME;
    $SecondPartnerName = (isset(Yii::$app->user->identity->weddings0) && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0 && Yii::$app->user->identity->weddings0[0]->sECONDCOUPLEPARTNER != null ? Yii::$app->user->identity->weddings0[0]->sECONDCOUPLEPARTNER->COUPLE_PARTNER_FIRST_NAME : "");
    $WeddingType = Yii::$app->user->identity->weddings0[0]->wEDDINGTYPE != null && Yii::$app->user->identity->weddings0[0]->wEDDINGTYPE->weddingTypeTranslation != null && Yii::$app->user->identity->weddings0[0]->wEDDINGTYPE->weddingTypeTranslation->WEDDING_TYPE_TRANSLATION != null ? Yii::$app->user->identity->weddings0[0]->wEDDINGTYPE->weddingTypeTranslation->WEDDING_TYPE_TRANSLATION : 0;
} else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
    $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
    $profilePAth = Yii::$app->user->identity->weddings[0]->COUPLE_IMG;
    $FirstPartnerName = Yii::$app->user->identity->weddings[0]->fIRSTCOUPLEPARTNER->COUPLE_PARTNER_FIRST_NAME;
    $SecondPartnerName = Yii::$app->user->identity->weddings[0]->sECONDCOUPLEPARTNER->COUPLE_PARTNER_FIRST_NAME;
    $WeddingType = Yii::$app->user->identity->weddings[0]->wEDDINGTYPE != null && Yii::$app->user->identity->weddings[0]->wEDDINGTYPE->weddingTypeTranslation != null && Yii::$app->user->identity->weddings[0]->wEDDINGTYPE->weddingTypeTranslation->WEDDING_TYPE_TRANSLATION != null ? Yii::$app->user->identity->weddings[0]->wEDDINGTYPE->weddingTypeTranslation->WEDDING_TYPE_TRANSLATION : 0;
}


?>

<div class="container-fluid ctg-block1-fluid">
<?php // Pjax::begin(['id'=>'CategoryPjax', 'enablePushState' => false]);   ?>
   
    <div id="" class="container ctg-block1">
        <div class="row">
         


            <div class="col-md-12 col-packages">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Packages</li>
            </ol>
            <ul class="nav nav-tabs nav-justified">
                <?php
                $i=0;
                if($dataPackages!=null && sizeof($dataPackages)>0){
                    foreach($dataPackages as $Package){
                        
                     ?>
                <li class="<?= $i==0 ? "active":""?>" ><a  href="#group<?=$Package->PACKAGE_GROUP_ID?>" data-toggle="tab"><?=$Package->PACKAGE_GROUP_VALUE?></a></li>
                <?php
                    $i++;}
                }
                ?>
              
              
            </ul>
                
            <div class="tab-content">
                
                <?php
                $i=0;
                if($dataPackages!=null && sizeof($dataPackages)>0){
                    foreach($dataPackages as $Package){
                        ?>
                <div class="tab-pane fade <?= $i==0 ?"active in" :""?>" id="group<?=$Package->PACKAGE_GROUP_ID?>">
                <div class="row">
                <?php
                        if($Package->packages!=null && sizeof($Package->packages)>0){
                          foreach($Package->packages as $pa){
                            ?>
                    <div class="col-lg-6">
                        
                    <div class="package">
                      <div class="package-caption"><?=$pa->PACKAGE_NAME?>
                        <span class="price"><?=$pa->CURRENCY_ID!=null ?$pa->cURRENCY->CURRENCY_SYM:""?><?= number_format(intval($pa->PACKAGE_PRICE)) ?> </span>
                      </div>
                      <div class="package-info">Empowered by <strong><?=$pa->sUPPLIER->SUPPLIER_NAME?></strong>
                        <span class="raty">
                            <?php
                            if($pa->PACKAGE_RATE==0){
                                ?>
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <?php
                            }
                            ?>
                            <?php
                            if($pa->PACKAGE_RATE==1){
                                ?>
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <?php
                            }
                            ?>
                          <?php
                            if($pa->PACKAGE_RATE==2){
                                ?>
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <?php
                            }
                            ?>
                            <?php
                            if($pa->PACKAGE_RATE==3){
                                ?>
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <?php
                            }
                            ?>
                            <?php
                            if($pa->PACKAGE_RATE==4){
                                ?>
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <?php
                            }
                            ?>
                            <?php
                            if($pa->PACKAGE_RATE==5){
                                ?>
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <?php
                            }
                            ?>
                          
                          <span class="package-transaction"><img src="<?=Yii::getAlias('@web').'/img/transaction.png'?>" alt=""> 68</span>
                        </span>
                      </div>
                      <div class="row">
                          <?php if($pa->packageImages!=null && sizeof($pa->packageImages)>0){
                                                                            $i=0;
                                                                          foreach($pa->packageImages as $image){
                                                                              if($i==0){
                                                                                  ?>
                                                                   <div class="col-xs-8">
										<!--<img src="<?=$image->IMAGE_PATH?>" alt="" >-->
                                                                       
                                                                                <div class="package-img package-img-big" style="background-image: url(<?=Yii::getAlias('@web').'/'.$image->IMAGE_PATH?>);" data-toggle="modal" data-target="#modal"></div>
									</div>
                                                                    <?php
                                                                              }else{
                                                                                ?>
                                                                    <div class="col-xs-4">
                                                                                <?php if($i==1){
                                                                                   ?>
                                                                       
                                                                         <div class="package-img package-img-small" style="background-image: url(<?=Yii::getAlias('@web').'/'.$image->IMAGE_PATH?>);" data-toggle="modal" data-target="#modal"></div>
                                                                        <?php
                                                                                }
                                                                                
                                                                                if($i==2){
                                                                                    ?>
                                                                        
                                                                        
                                                                        <div class="package-img package-img-small" style="background-image: url(<?=Yii::getAlias('@web').'/'.$image->IMAGE_PATH?>);" data-toggle="modal" data-target="#modal"></div>
                                                                        <?php
                                                                                }
?>
										
										
									</div>
                                                                    <?php
                                                                              }
                                                                              $i++;
                                                                          }  
                                                                        }
                                                                        ?>
                       
                      </div>
                      <button class="btn btn-yellow btn-block" data-toggle="modal" data-target="#modal<?=$pa->PACKAGE_ID?>">Details</button>
                    

                  </div>
                    </div>
                    <?php
                        } }
                     ?>
                </div>
                </div>
                         <?php
                   $i++; }
                }
                ?>
             
            </div>
          </div>


        </div>
    </div>




   
</div>



<?php
                if($dataPackages!=null && sizeof($dataPackages)>0){
                    foreach($dataPackages as $Package){
                      
                        if($Package->packages!=null && sizeof($Package->packages)>0){
                          foreach($Package->packages as $pa){
                          
                              ?>
 <div class="modall modal fade"  id="modal<?=$pa->PACKAGE_ID?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="row">
            <div class="col-md-6">

              <div class="gallery-img">
                <div class="item-img-wrap">
                  <span class="heart active"></span>
                  <div id="sync1" class="owl-carousel owl-theme">
                     <?php
                      if($pa->packageImages!=null && sizeof($pa->packageImages)>0){
                          foreach($pa->packageImages as $image){
                             ?>
                      <img src="<?=Yii::getAlias('@web').'/'.$image->IMAGE_PATH?>" alt="">
                      
                      <?php
                          }
                      }
                     ?>
                    
                    
                  </div>
                </div>
                <div id="sync2" class="owl-carousel owl-theme">
                  <?php
                      if($pa->packageImages!=null && sizeof($pa->packageImages)>0){
                          foreach($pa->packageImages as $image){
                             ?>
                      <img src="<?=Yii::getAlias('@web').'/'.$image->IMAGE_PATH?>" alt="">
                      <img src="<?=Yii::getAlias('@web').'/'.$image->IMAGE_PATH?>" alt="">
                      <?php
                          }
                      }
                     ?>
                </div>
              </div>

            </div>
            <div class="col-md-6">
                <div class="logo-companny"><img src="<?=Yii::getAlias('@web').'/img/logo-company.png'?>" alt=""></div>
              <div class="package-caption"><?=$pa->PACKAGE_NAME?></div>
              <div class="package-info">Empowered by <strong><?=$pa->sUPPLIER->SUPPLIER_NAME?></strong></div>
              <div class="package-raty">
                <span class="raty">
                   <?php
                            if($pa->PACKAGE_RATE==0){
                                ?>
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <?php
                            }
                            ?>
                            <?php
                            if($pa->PACKAGE_RATE==1){
                                ?>
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <?php
                            }
                            ?>
                          <?php
                            if($pa->PACKAGE_RATE==2){
                                ?>
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <?php
                            }
                            ?>
                            <?php
                            if($pa->PACKAGE_RATE==3){
                                ?>
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <?php
                            }
                            ?>
                            <?php
                            if($pa->PACKAGE_RATE==4){
                                ?>
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <?php
                            }
                            ?>
                            <?php
                            if($pa->PACKAGE_RATE==5){
                                ?>
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <?php
                            }
                            ?>
                  <span class="package-transaction"><img src="<?=Yii::getAlias('@web').'/img/transaction.png'?>" alt=""> 68</span>
                </span>
                <span class="reviews"><span class="number-of-reviews"><?=$pa->packageComments!=null ?(sizeof($pa->packageComments)==1 ? '1 review': sizeof($pa->packageComments).' reviews'):""?></span></span>
              </div>
              <button class="btn btn-yellow-op btn-block">Buy for <?=$pa->CURRENCY_ID ?$pa->cURRENCY->CURRENCY_SYM:""?><?= $pa->PACKAGE_PRICE ?></button>
              <ul class="nav nav-tabs">
                <li class="active"><a href="#description<?=$pa->PACKAGE_ID?>" data-toggle="tab">Description</a></li>
                <li><a href="#reviews<?=$pa->PACKAGE_ID?>" data-toggle="tab">Reviews (<span class="number-of-reviews"><?=$pa->packageComments!=null ?(sizeof($pa->packageComments)==1 ? '1 ': sizeof($pa->packageComments).' '):""?></span>)</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane fade in active" id="description<?=$pa->PACKAGE_ID?>">
                    <ul class="modaldescription">
                                                                            <?php if($pa->packageDescriptions!=null && sizeof($pa->packageDescriptions)>0){
                                                                                foreach($pa->packageDescriptions as $Description){
                                                                                ?>
										<li><a href=""><?=$Description->PACKAGE_DESCRIPTION_VALUE?></a></li>
										
                                                                                <?php }} ?>
                                                                        </ul>
                </div>
                    <div class="tab-pane fade" id="reviews<?=$pa->PACKAGE_ID?>">
                        <div style="display : none;" id='HiddenOne<?=$pa->PACKAGE_ID?>'></div>  
                  <a href="#" class='review-add' id="review-add<?=$pa->PACKAGE_ID?>" >Add review</a>
                   <?php
 

$this->registerJs(<<<JS
        
        $('#review-add$pa->PACKAGE_ID').click(function() {
        $('#newComment$pa->PACKAGE_ID').show();
            $('#newComment$pa->PACKAGE_ID').load('new-comment-form?PackageID=$pa->PACKAGE_ID');
        });

JS
);
                                                                   
                                                                ?>
                  <div class="new-review" id='newComment<?=$pa->PACKAGE_ID?>'>
                    
                  </div>
                  
                   <?php
 

$this->registerJs(<<<JS

JS
);
                                                                   
                                                                ?>
                  
                  <div id="reviews-wrap<?=$pa->PACKAGE_ID?>" >
                    <?php if($pa->packageComments!=null && sizeof($pa->packageComments)>0){ 
                                                                            foreach($pa->packageComments as $Comment){
                                                                            
                                                                               ?>
                      <div class="review">
                      <img src="<?=$Comment->cOUPLEPARTNER->USER_PROFILE_PIC!=null ?Yii::getAlias('@web') . '/' . $Comment->cOUPLEPARTNER->USER_PROFILE_PIC :Yii::getAlias('@web') . '/img/emptypic.jpg'?>" alt="" class="avatar">
                      <span class="review-name"><?=$Comment->cOUPLEPARTNER->COUPLE_PARTNER_FIRST_NAME.' '.$Comment->cOUPLEPARTNER->COUPLE_PARTNER_LAST_NAME ?></span>
                      <span class="review-raty">
                          <?php
                         if($Comment->RATING==0){
                                ?>
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <?php
                            }
                            ?>
                            <?php
                            if($Comment->RATING==1){
                                ?>
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <?php
                            }
                            ?>
                          <?php
                            if($Comment->RATING==2){
                                ?>
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <?php
                            }
                            ?>
                            <?php
                            if($Comment->RATING==3){
                                ?>
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <?php
                            }
                            ?>
                            <?php
                            if($Comment->RATING==4){
                                ?>
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-off.png'?>" alt="">
                            <?php
                            }
                            ?>
                            <?php
                            if($Comment->RATING==5){
                                ?>
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <img src="<?=Yii::getAlias('@web').'/img/star-on.png'?>" alt="">
                            <?php
                            }
                            ?>
                      </span>
                      <?php
                                                                                $secondsToTime= WedsiteController::secondsToTime(strtotime($Comment->POST_DATE));
                                                                                     
                    $StringDate="just now";
                    if($secondsToTime!=null){
                        if($secondsToTime['years']!=0){
                           $StringDate= $WedsiteTopic->WEDSITE_TOPIC_DATE;
                           
                        }
                        if($StringDate=="just now" && $secondsToTime['months']!=0 ){
                          $StringDate='before '.$secondsToTime['months'].' months'; 
                        }
                        if($StringDate=="just now" && $secondsToTime['days']!=0 ){
                          $StringDate='before '.$secondsToTime['days'].' days'; 
                        }
                        if($StringDate=="just now" && $secondsToTime['hours']!=0 ){
                          $StringDate='before '.$secondsToTime['hours'].' hours'; 
                        }
                        if($StringDate=="just now" && $secondsToTime['minutes']!=0 ){
                          $StringDate='before '.$secondsToTime['minutes'].' minutes '; 
                        }
                    }
                                                                                ?>
                      <span class="review-date">
                    <span class="review-date-cont"><?=$StringDate?></span>
                    <a href="#"><span class="glyphicon glyphicon-trash"></span></a>
                      <a href="#"><span class="glyphicon glyphicon-pencil"></span></a>
                      
                          
                      </span>
                      <p><?=$Comment->PACKAGE_COMMENT_VALUE?></p>
                      
                    </div>
                                                                                <?php
                                                                            }
                                                                            }
                                                                        ?>
                    

                   

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
                
                          }
                          
                          }
                              ?>
                          





                                                                    
                                                                    
                                                                                                            

 <?php
 
 $PID = 0;
if (isset($_GET['PackageID'])) {
    $PID = $_GET['PackageID'];
}
$this->registerJs(<<<JS
$(document).ready(function() {

  // gallery-img-product:
  var sync1 = $("#sync1");
  var sync2 = $("#sync2");

  sync1.owlCarousel({
    responsive: { 
      0: {
        items: 1,
        nav: false,
        dots: false,
        mouseDrag: true,
        touchDrag: true
      },
      768: {
        items: 1,
        dots: false,
        mouseDrag: false,
        touchDrag: false,
      }
    },
    navText: ["",""],
    smartSpeed : 1000,
  });

  sync1.on('changed.owl.carousel', function(event) {
    var current = event.item.index;
    sync2.trigger('to.owl.carousel', [current, 300, true]);
    $("#sync2")
      .find(".owl-item")
      .removeClass("synced")
      .eq(current)
      .addClass("synced");
  });

  sync2.on('initialized.owl.carousel', function(event) {
    $(event.target).find(".owl-item").eq(0).addClass("synced");   
  });

  sync2.on('click', '.owl-item', function () {
    sync1.trigger('to.owl.carousel', [$(this).index(), 300, true]);
  });

  sync2.owlCarousel({
    items: 3,
    nav : true,
    dots: false,
    margin: 10,
    navText: ["<img src='../img/arrow-left.png' alt=''>","<img src='../img/arrow-right.png' alt=''>"],
    smartSpeed : 1000
  });
  // end gallery-img-product

//  $('#star').raty();

  Date.prototype.format = function (mask, utc) {
    return dateFormat(this, mask, utc);
  };

  $("#review-add").on("click", function() {
    $(this).slideToggle();
    $(this).siblings(".new-review").slideToggle();
  });

 

});
$(document).ready(function() {
var PID='$PID';
if(PID!=0){
   $('#modal'+PID).modal('show');   
   }
  });
        
        
        


         $("#add").on("click", function() {
          var Comment=document.getElementById('Comment').value; 
          var Score=  document.getElementsByName('score');
        var Sc="0";
        
        if(Score!=null && Score.length>0){
           Sc = Score[0].value;
        }
        if(Sc==""){
        Sc=0;
        }
        
  });
JS
);
                                                                   
                                                                ?>

