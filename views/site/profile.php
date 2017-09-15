


 <?php
 use yii\helpers\Html;
//$models = $dataProvider->getModels();
//$WeddingPeriodsmodels = $dataProvider1->getModels();
//print_r($WeddingPeriodsmodels);
$WeddingPeriodsmodelsForWeddingDays = $dataProviderForWeddingDate1->getModels();
$WeddingEventModel = null;
if (isset($WeddingEventDataProvider)) {
    $WeddingEventModel = $WeddingEventDataProvider->getModels();
}
//echo $WeddingEventModel[0]->weddingTentativePeriodes[0]->TO_DATE;
//$newDate = date("d/m/Y", strtotime($WeddingEventModel[0]->weddingTentativePeriodes[0]->TO_DATE));
//echo '<br>' . $newDate."<br>";
$WeddingID = 0;
$FirstPartnerName="";
$SecondPartnerName="";
$WeddingType="";
//sECONDCOUPLEPARTNER weddingTypeTranslation wEDDINGTYPE
if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
    $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
    $FirstPartnerName = Yii::$app->user->identity->weddings0[0]->fIRSTCOUPLEPARTNER->COUPLE_PARTNER_FIRST_NAME ;
    $SecondPartnerName = Yii::$app->user->identity->weddings0[0]->sECONDCOUPLEPARTNER->COUPLE_PARTNER_FIRST_NAME ;
    $WeddingType=Yii::$app->user->identity->weddings0[0]->wEDDINGTYPE->weddingTypeTranslation->WEDDING_TYPE_TRANSLATION;
} else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
    $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
    $FirstPartnerName = Yii::$app->user->identity->weddings[0]->fIRSTCOUPLEPARTNER->COUPLE_PARTNER_FIRST_NAME ;
    $SecondPartnerName = Yii::$app->user->identity->weddings[0]->sECONDCOUPLEPARTNER->COUPLE_PARTNER_FIRST_NAME ;
    $WeddingType=Yii::$app->user->identity->weddings[0]->wEDDINGTYPE->weddingTypeTranslation->WEDDING_TYPE_NAME;
}
$profilePAth = Yii::$app->user->identity->USER_PROFILE_PIC;
//$profilePAth = Yii::$app->user->identity->USER_PROFILE_PIC;
$days = 0;
    foreach ($WeddingPeriodsmodelsForWeddingDays as $WeddingDate) {
if($WeddingDate->IN_USE_OR_NO=='Y'){
    
        $FromDate = "";
        if ($WeddingDate->FROM_DATE != NULL) {
            $FromDate = $WeddingDate->FROM_DATE;
            $explode = explode("T", $FromDate);
            $FromDate = $explode[0];
        }
        $ToDate = "";
        if ($WeddingDate->TO_DATE != NULL) {
            $ToDate = $WeddingDate->TO_DATE;
            $explode = explode("T", $ToDate);
            $ToDate = $explode[0];
        }
        $numberOfDays = 0;
        $SysDate = date("Y-m-d");
        if ($FromDate != "" && $ToDate != "") {
            $datetime1 = new DateTime($SysDate);

            $datetime2 = new DateTime($FromDate);

            $difference = $datetime1->diff($datetime2);
            $days = $difference->days;
//            echo $difference->days .'days';
        }
        if ($FromDate == "" && $ToDate != "") {
            $datetime1 = new DateTime($SysDate);

            $datetime2 = new DateTime($ToDate);

            $difference = $datetime1->diff($datetime2);
            $days = $difference->days;
//            echo $difference->days-1 .'days';
        }
    }
    }
?>
 <div class="wedbox profile-box" id="profile-box">
                            <div role="presentation" class="dropdown profile-photo">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
<!--                                    <img class="" src="../img/profile-cover.png" alt="">-->

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