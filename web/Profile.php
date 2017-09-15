


 <?php
 use yii\helpers\Html;

$profilePAth = Yii::$app->user->identity->USER_PROFILE_PIC;
?>
 <div class="wedbox profile-box" id="profile-box">
                            <div role="presentation" class="dropdown profile-photo">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
<!--                                    <img class="" src="img/profile-cover.png" alt="">-->

                                    <?= Html::img(Yii::getAlias('@web') . '' . $profilePAth, ['id' => 'testtttt', 'alt' => '', 'style' => 'width: 250px;height: 140px;', 'class' => 'img-responsive']); ?>   
                                    <span class="badge">
                                        <h5 id="NumberOfRemaingDays"><?= $days ?></h5>
                                        <span>days</span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <div style="display : none;">
                                        <?= $form->field($CouplePartnerModel, 'imageFile')->fileInput()->Label(false) ?>   
                                    </div>      
                                    <li>Logged in as <h4>First name Last Name</h4></li>
                                    <li></li>
                                    <li><button href="#" class="btn btn-primary center-block" onclick="$('#couplepartner-imagefile').click();" >Profile Update</button></li>

                                    <li><a class="btn btn-primary center-block" href="logout.html">Logout</a></li>
                                </ul>
                            </div>
                            <div class="wedbox-content">
                                <div class="row">
                                    <div class="col-md-12 content-wrapper">
                                        <div class="widget-listings">
                                            <div class="listing couple-name">
                                                Samir &amp; Maya
                                                <div class="wedding-type">
                                                    Civil Marriage
                                                </div>
                                            </div>
                                            <div class="listing wedding-interval">
                                                <strong id="Before"><?= str_replace("Before", "", $CurrentAgendaPeriodsName); ?></strong> <span>until wedding</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>