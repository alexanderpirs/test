
<?php
use app\controllers\WedsiteController; 

if($Comment!=null && sizeof($Comment)>0){
    $Comment=$Comment[0];
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
                      <span class="review-date"><?=$StringDate?></span>
                      <p><?=$Comment->PACKAGE_COMMENT_VALUE?></p>
                    </div>

<?php } ?>