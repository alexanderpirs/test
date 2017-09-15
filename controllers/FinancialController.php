<?php

namespace app\controllers;
use Yii;

use yii\web\Response;
//use yii\widgets\ActiveForm;

//use yii\
use yii\data\ActiveDataProvider;

use yii\widgets\ActiveForm;

class FinancialController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $WeddingID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        
        $EstimatedFunding=new \app\models\EstimatedFunding();
        $Currencies = new ActiveDataProvider([
            'query' => \app\models\Currencies::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        
       
        if ($Currencies != null) {
            $Currencies = $Currencies->getModels();
        }
    $EstimatedFundingProvider = new ActiveDataProvider([
            'query' => \app\models\EstimatedFunding::find()->where("WEDDING_ID =  " . $WeddingID ),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
if($EstimatedFundingProvider!=null){
    $EstimatedFundingProvider=$EstimatedFundingProvider->getModels();
}    
$PersonalDataProvider = new ActiveDataProvider([
            'query' => \app\models\PersonalContribution::find()->where("WEDDING_ID =  " . $WeddingID ),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
if($PersonalDataProvider!=null){
    $PersonalDataProvider=$PersonalDataProvider->getModels();
}


$PrivateSponsorDataProvider = new ActiveDataProvider([
            'query' => \app\models\PrivateSponsor::find()->where("WEDDING_ID =  " . $WeddingID ),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
if($PrivateSponsorDataProvider!=null){
    $PrivateSponsorDataProvider=$PrivateSponsorDataProvider->getModels();
}
$CommercialSponsorDataProvider = new ActiveDataProvider([
            'query' => \app\models\CommercialWeddingSponsor::find()->where("WEDDING_ID =  " . $WeddingID ),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
if($CommercialSponsorDataProvider!=null){
    $CommercialSponsorDataProvider=$CommercialSponsorDataProvider->getModels();
}
$FinancialLoanDataProvider = new ActiveDataProvider([
            'query' => \app\models\FinancialLoan::find()->where("WEDDING_ID =  " . $WeddingID ),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
if($FinancialLoanDataProvider!=null){
    $FinancialLoanDataProvider=$FinancialLoanDataProvider->getModels();
}
$SavingDataProvider = new ActiveDataProvider([
            'query' => \app\models\Saving::find()->where("WEDDING_ID =  " . $WeddingID ),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
if($SavingDataProvider!=null){
    $SavingDataProvider=$SavingDataProvider->getModels();
}
        return $this->renderAjax('index',[
            'PersonalDataProvider'=>$PersonalDataProvider,
            'PrivateSponsorDataProvider'=>$PrivateSponsorDataProvider,
            'CommercialSponsorDataProvider'=>$CommercialSponsorDataProvider,
            'FinancialLoanDataProvider'=>$FinancialLoanDataProvider,
            'SavingDataProvider' => $SavingDataProvider,
            'EstimatedFundingProvider'=>$EstimatedFundingProvider,
            'Currencies'=>$Currencies,
            'EstimatedFundinggg'=>$EstimatedFunding,
            
        ]);
    }
    
    public function actionPersonalContributionValidate() {
        $model = new \app\models\PersonalContribution();
        Yii::error('Validating : ');

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }
    
    public function actionNewPersonalContribution() {
//    $EstimatedBudget=new \app\models\WedCategoryEstimatedBudget();
        $PersonalContribution = new \app\models\PersonalContribution();
        $CouplePArtnerIDFromPAge=Yii::$app->request->get('CouplePartnerID');
        $WeddingID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        
        
        $ExistPersonalContribution = new ActiveDataProvider([
            'query' => \app\models\PersonalContribution::find()->where('RELATED_TO_ID = ' . $CouplePArtnerIDFromPAge .' AND WEDDING_ID='.$WeddingID ),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        
       


        $Currencies = new ActiveDataProvider([
            'query' => \app\models\Currencies::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        
        if ($ExistPersonalContribution != null) {
            $ExistPersonalContribution = $ExistPersonalContribution->getModels();
        }
        if ($Currencies != null) {
            $Currencies = $Currencies->getModels();
        }
        return $this->renderAjax('_personalcontribution', [
                    'PersonalContribution' => $PersonalContribution,
                    'ExistPersonalContribution' => $ExistPersonalContribution,
                    'Currencies' => $Currencies,
                    'CouplePartnerIDFromPAge'=>$CouplePArtnerIDFromPAge,
//        'EstimatedBudget'=>$EstimatedBudget
        ]);
    }
    
    public function actionSavePersonalContribution() {

        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }


        Yii::error('Saving : ');
        $model = new \app\models\PersonalContribution();
        
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($model->validate() && $WeddingID != 0) {
            $find = \app\models\PersonalContribution::findOne(['WEDDING_ID'=>$WeddingID ,'RELATED_TO_ID'=>$model->RELATED_TO_ID]);
            if($find!=null){
                $find->CURRENCY_ID=$model->CURRENCY_ID;
                $find->PERSONAL_CONTRIBUTION_VALUE=$model->PERSONAL_CONTRIBUTION_VALUE;
                if($find->save(false)){
                  Yii::$app->response->format = Response::FORMAT_JSON;
//                    $this->actionIndex();
                  $PersonalDataProvider = new ActiveDataProvider([
            'query' => \app\models\PersonalContribution::find()->where("WEDDING_ID =  " . $WeddingID . " AND RELATED_TO_ID = ".$model->RELATED_TO_ID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
                  $FormToSend="";
                  if($PersonalDataProvider!=null){
                    $PersonalDataProvider=$PersonalDataProvider->getModels();  
                    if($PersonalDataProvider!=null && sizeof($PersonalDataProvider)>0){
                      $FormToSend=$PersonalDataProvider[0]->cURRENCY->CURRENCY_SYM.''.$model->PERSONAL_CONTRIBUTION_VALUE;  
                    }
                  }
                    return [
                        'success' => true,
                        'formToShow'=>$FormToSend
                        ];  
                }
            }else{
              Yii::error('Saving : 1 ');

                Yii::error('Saving : ');
                $model->WEDDING_ID = $WeddingID;
                if ($model->save(false)) {
//                    unset($_POST['WedCategoryEstimatedBudget']);
                    Yii::$app->response->format = Response::FORMAT_JSON;
//                    $this->actionIndex();
                    $PersonalDataProvider = new ActiveDataProvider([
            'query' => \app\models\PersonalContribution::find()->where("WEDDING_ID =  " . $WeddingID . " AND RELATED_TO_ID = ".$model->RELATED_TO_ID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
                  $FormToSend="";
                  if($PersonalDataProvider!=null){
                    $PersonalDataProvider=$PersonalDataProvider->getModels();  
                    if($PersonalDataProvider!=null && sizeof($PersonalDataProvider)>0){
                      $FormToSend=$PersonalDataProvider[0]->cURRENCY->CURRENCY_SYM.''.$model->PERSONAL_CONTRIBUTION_VALUE;  
                    }
                  }
                    return [
                        'success' => true,
                        'formToShow'=>$FormToSend
                        ]; 
                }  
            }
            
                
            } else {
                if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }
            }
        }
    }
public function actionSaveEstimatedBudget() {

        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }


        Yii::error('Saving : ');
        $model = new \app\models\EstimatedFunding();
        
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($model->validate() && $WeddingID != 0) {
            $find = \app\models\EstimatedFunding::findOne(['WEDDING_ID'=>$WeddingID ]);
            if($find!=null){
                $find->CURRENCY_ID=$model->CURRENCY_ID;
                $find->ESTIMATED_VALUE=$model->ESTIMATED_VALUE;
                if($find->save(false)){
                  Yii::$app->response->format = Response::FORMAT_JSON;
//                    $this->actionIndex();
                  $PersonalDataProvider = new ActiveDataProvider([
            'query' => \app\models\EstimatedFunding::find()->where("WEDDING_ID =  " . $WeddingID ),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
                  $FormToSend="";
                  if($PersonalDataProvider!=null){
                    $PersonalDataProvider=$PersonalDataProvider->getModels();  
                    if($PersonalDataProvider!=null && sizeof($PersonalDataProvider)>0){
                      $FormToSend=$PersonalDataProvider[0]->cURRENCY->CURRENCY_SYM.''.$model->ESTIMATED_VALUE;  
                    }
                  }
                    return [
                        'success' => true,
                        'formToShow'=>$FormToSend
                        ];  
                }
            }else{
              Yii::error('Saving : 1 ');

                Yii::error('Saving : ');
                $model->WEDDING_ID = $WeddingID;
                if ($model->save(false)) {
//                    unset($_POST['WedCategoryEstimatedBudget']);
                    Yii::$app->response->format = Response::FORMAT_JSON;
//                    $this->actionIndex();
                    $PersonalDataProvider = new ActiveDataProvider([
            'query' => \app\models\EstimatedFunding::find()->where("WEDDING_ID =  " . $WeddingID ),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
                  $FormToSend="";
                  if($PersonalDataProvider!=null){
                    $PersonalDataProvider=$PersonalDataProvider->getModels();  
                    if($PersonalDataProvider!=null && sizeof($PersonalDataProvider)>0){
                      $FormToSend=$PersonalDataProvider[0]->cURRENCY->CURRENCY_SYM.''.$model->ESTIMATED_VALUE;  
                    }
                  }
                    return [
                        'success' => true,
                        'formToShow'=>$FormToSend
                        ]; 
                }  
            }
            
                
            } else {
                if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }
            }
        }
    }
    
    
        public function actionNewPrivateSponsor() {
//    $EstimatedBudget=new \app\models\WedCategoryEstimatedBudget();
        $PrivateSponsorModel = new \app\models\PrivateSponsor();
        $PrivateSponsorRecordID=Yii::$app->request->get('PrivateSponsorID');
        $WeddingID = 0;
        
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        
        
        $ExistPrivateSponsor = new ActiveDataProvider([
            'query' => \app\models\PrivateSponsor::find()->where('PRIVATE_SPONSOR_ID = ' . $PrivateSponsorRecordID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        
       $WeddingDataProvider = new ActiveDataProvider([
            'query' => \app\models\Weddings::find()->where(['WEDDING_ID'=>$WeddingID]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);


        $Currencies = new ActiveDataProvider([
            'query' => \app\models\Currencies::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        
        if ($ExistPrivateSponsor != null) {
            $ExistPrivateSponsor = $ExistPrivateSponsor->getModels();
        }
        if ($Currencies != null) {
            $Currencies = $Currencies->getModels();
        }
        $CouplePartner = [];
        if ($WeddingDataProvider != null) {
            $WeddingDataProvider = $WeddingDataProvider->getModels();
            
        
            if ($WeddingDataProvider != null && sizeof($WeddingDataProvider) > 0) {
                $i = 0;
                foreach ($WeddingDataProvider as $WeddingMod) {

//                   $sECONDCOUPLEPARTNER
// * @property CouplePartner $fIRSTCOUPLEPARTNER
                    $i=0;
                        if($WeddingMod->FIRST_COUPLE_PARTNER_ID!=null){
                          $CouplePartner[$i]['COUPLE_PARTNER_ID'] = $WeddingMod->FIRST_COUPLE_PARTNER_ID;
                        $CouplePartner[$i]['COUPLE_PARTNER_NAME'] = $WeddingMod->fIRSTCOUPLEPARTNER->COUPLE_PARTNER_FIRST_NAME .' '.$WeddingMod->fIRSTCOUPLEPARTNER->COUPLE_PARTNER_LAST_NAME;  
                        $i++;
                        }
                        if($WeddingMod->SECOND_COUPLE_PARTNER_ID!=null){
                          $CouplePartner[$i]['COUPLE_PARTNER_ID'] = $WeddingMod->SECOND_COUPLE_PARTNER_ID;
                        $CouplePartner[$i]['COUPLE_PARTNER_NAME'] = $WeddingMod->sECONDCOUPLEPARTNER->COUPLE_PARTNER_FIRST_NAME .' '.$WeddingMod->sECONDCOUPLEPARTNER->COUPLE_PARTNER_LAST_NAME;  
                        $i++;
                        }
                  
                }
            }
        
        }
        
        $InviteesRelationTypeTransModels = \app\models\InviteesRelationTypeTrans::find(['RELATION_TYPE_ID','RELATION_TYPE_NAME_TRANS'])->where('LANGUAGE_ID = 1')->all();
        $InviteesModels = \app\models\Invitees::find()->where('WEDDING_ID = '.$WeddingID)->all();
        return $this->renderAjax('_privatesponsor', [
                    'PrivateSponsorModel' => $PrivateSponsorModel,
                    'ExistPrivateSponsor' => $ExistPrivateSponsor,
                    'Currencies' => $Currencies,
                    'PrivateSponsorRecordID'=>$PrivateSponsorRecordID,
                    'InviteesRelationTypeTransModels'=>$InviteesRelationTypeTransModels,
                    'InviteesModels'=>$InviteesModels,
                    'CouplePartnerArray'=>$CouplePartner
//        'EstimatedBudget'=>$EstimatedBudget
        ]);
    }
    
//    private-sponsor-validate
    
    public function actionPrivateSponsorValidate() {
        $model = new \app\models\PrivateSponsor();
        Yii::error('Validating : ');

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }
    
    
    public function actionSavePrivateSponsor() {

        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }


        Yii::error('Saving : ');
        $model = new \app\models\PrivateSponsor();
        
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($model->validate() && $WeddingID != 0) {
            $find = \app\models\PrivateSponsor::findOne(['WEDDING_ID'=>$WeddingID ,'PRIVATE_SPONSOR_ID'=>$model->PRIVATE_SPONSOR_ID]);
            if($find!=null){
                
                if($find->save(false)){
                  Yii::$app->response->format = Response::FORMAT_JSON;
//                    $this->actionIndex();
                  $PrivateSponsorDataProvider = new ActiveDataProvider([
            'query' => \app\models\PrivateSponsor::find()->where("WEDDING_ID =  " . $WeddingID . " AND PRIVATE_SPONSOR_ID = ".$model->PRIVATE_SPONSOR_ID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
                  $FormToSend="";
                  if($PrivateSponsorDataProvider!=null){
                    $PrivateSponsorDataProvider=$PrivateSponsorDataProvider->getModels();  
                    if($PrivateSponsorDataProvider!=null && sizeof($PrivateSponsorDataProvider)>0){
                      $FormToSend='<td>'.($PrivateSponsorDataProvider[0]->iNVITEE!=null && $PrivateSponsorDataProvider[0]->iNVITEE->FIRST_INVITEE_NAME!=null ?$PrivateSponsorDataProvider[0]->iNVITEE->FIRST_INVITEE_NAME:"Empty").'</td>
																					<td>'.$PrivateSponsorDataProvider[0]->rELATEDTO->COUPLE_PARTNER_FIRST_NAME.' '.$PrivateSponsorDataProvider[0]->rELATEDTO->COUPLE_PARTNER_LAST_NAME.'</td>
																					<td>'.($PrivateSponsorDataProvider[0]->rELATIONTYPE->inviteesRelationTypeTrans[0]->RELATION_TYPE_NAME_TRANS).'</td>
																					<td>'.($PrivateSponsorDataProvider[0]->cURRENCY->CURRENCY_SYM .''.$PrivateSponsorDataProvider[0]->AMOUNT).'</td>
																					<td>
																						<div class="action">
																						<button class="btnEdit iconEdit" id="EditPrivateSponsor'.$PrivateSponsorDataProvider[0]->PRIVATE_SPONSOR_ID.'>Edit</button>
																						</div>
																					</td>';
                      
                    }
                  }
                    return [
                        'success' => true,
                        'formToShow'=>$FormToSend
                        ];  
                }
            }else{
              Yii::error('Saving : 1 ');

                Yii::error('Saving : ');
                $model->WEDDING_ID = $WeddingID;
                if ($model->save(false)) {
                  $PrivateSponsorID=  $model->getPrimaryKey();
//                    unset($_POST['WedCategoryEstimatedBudget']);
                    Yii::$app->response->format = Response::FORMAT_JSON;
//                    $this->actionIndex();
                    $PrivateSponsorDataProvider = new ActiveDataProvider([
            'query' => \app\models\PrivateSponsor::find()->where("WEDDING_ID =  " . $WeddingID . " AND PRIVATE_SPONSOR_ID = ".$PrivateSponsorID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
                  $FormToSend="";
                  if($PrivateSponsorDataProvider!=null){
                    $PrivateSponsorDataProvider=$PrivateSponsorDataProvider->getModels();  
                    if($PrivateSponsorDataProvider!=null && sizeof($PrivateSponsorDataProvider)>0){
                      $FormToSend='<td>'.($PrivateSponsorDataProvider[0]->iNVITEE!=null && $PrivateSponsorDataProvider[0]->iNVITEE->FIRST_INVITEE_NAME!=null ?$PrivateSponsorDataProvider[0]->iNVITEE->FIRST_INVITEE_NAME:"Empty").'</td>
																					<td>'.$PrivateSponsorDataProvider[0]->rELATEDTO->COUPLE_PARTNER_FIRST_NAME.' '.$PrivateSponsorDataProvider[0]->rELATEDTO->COUPLE_PARTNER_LAST_NAME.'</td>
																					<td>'.($PrivateSponsorDataProvider[0]->rELATIONTYPE->inviteesRelationTypeTrans[0]->RELATION_TYPE_NAME_TRANS).'</td>
																					<td>'.($PrivateSponsorDataProvider[0]->cURRENCY->CURRENCY_SYM .''.$PrivateSponsorDataProvider[0]->AMOUNT).'</td>
																					<td>
																						<div class="action">
																						<button class="btnEdit iconEdit" id="EditPrivateSponsor'.$PrivateSponsorDataProvider[0]->PRIVATE_SPONSOR_ID.'>Edit</button>
																						</div>
																					</td>';
                      
                    }
                  }
                    return [
                        'success' => true,
                        'formToShow'=>$FormToSend
                        ]; 
                }  
            }
            
                
            } else {
                if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }
            }
        }
    }
    
    
    public function actionFinancialLoanValidate() {
        $model = new \app\models\FinancialLoan();
        Yii::error('Validating : ');

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }
    
    public function actionNewFinancialLoan() {
//    $EstimatedBudget=new \app\models\WedCategoryEstimatedBudget();
        $FinancialLoanModel = new \app\models\FinancialLoan();
        $FinancialLoanID=Yii::$app->request->get('FinancialLoanID');
        $WeddingID = 0;
        
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        
        
        $ExistFinancialLoan = new ActiveDataProvider([
            'query' => \app\models\FinancialLoan::find()->where('FINANCIAL_LOAN_ID = ' . $FinancialLoanID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        
       


        $Currencies = new ActiveDataProvider([
            'query' => \app\models\Currencies::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        
        if ($ExistFinancialLoan != null) {
            $ExistFinancialLoan = $ExistFinancialLoan->getModels();
        }
        if ($Currencies != null) {
            $Currencies = $Currencies->getModels();
        }
       $SuppliersDataProvider = new ActiveDataProvider([
            'query' => \app\models\Suppliers::find()->where('SUPPLIER_TYPE_ID = 2' ),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
       if ($SuppliersDataProvider != null) {
            $SuppliersDataProvider = $SuppliersDataProvider->getModels();
        }
        return $this->renderAjax('_financialloan', [
                    'FinancialLoanModel' => $FinancialLoanModel,
                    'ExistFinancialLoan' => $ExistFinancialLoan,
                    'FinancialLoanID'=>$FinancialLoanID,
                    'Currencies' => $Currencies,
                    'SuppliersDataProvider'=>$SuppliersDataProvider,
                    'FinancialLoanID'=>$FinancialLoanID,
            ]);
    }
    
    public function actionSaveFinancialLoan() {

        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }


        Yii::error('Saving : ');
        $model = new \app\models\FinancialLoan();
        
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($model->validate() && $WeddingID != 0) {
            $find = \app\models\FinancialLoan::findOne(['WEDDING_ID'=>$WeddingID ,'FINANCIAL_LOAN_ID'=>$model->FINANCIAL_LOAN_ID]);
            if($find!=null){
                
                if($model->save(false)){
                  Yii::$app->response->format = Response::FORMAT_JSON;
//                    $this->actionIndex();
                  $FinancialLoanDataProvider = new ActiveDataProvider([
                        'query' => \app\models\FinancialLoan::find()->where("WEDDING_ID =  " . $WeddingID . " AND FINANCIAL_LOAN_ID = ".$model->FINANCIAL_LOAN_ID),
                    ]);
                  $FormToSend="";
                  if($FinancialLoanDataProvider!=null){
                    $FinancialLoanDataProvider=$FinancialLoanDataProvider->getModels();  
                    if($FinancialLoanDataProvider!=null && sizeof($FinancialLoanDataProvider)>0){
                      $FormToSend='<td>'.($FinancialLoanDataProvider->sUPPLIER!=null && $FinancialLoanDataProvider->sUPPLIER->SUPPLIER_NAME!=null ?$FinancialLoanDataProvider->sUPPLIER->SUPPLIER_NAME:"Unknown").'</td>
																					<td>'.$FinancialLoanDataProvider->RATE!=null ?$FinancialLoanDataProvider->RATE.'%':"".'</td>
																					<td>'.$FinancialLoanDataProvider->DURATION!=null ?$FinancialLoanDataProvider->DURATION:"0".' months</td>
                                                                                                                                                                        <td>'.$FinancialLoanDataProvider->cURRENCY!=null && $FinancialLoanDataProvider->cURRENCY->CURRENCY_SYM!=null ?$FinancialLoanDataProvider->cURRENCY->CURRENCY_SYM:"".''.$FinancialLoanDataProvider->LOAN_AMOUNT!=null ?$FinancialLoanDataProvider->LOAN_AMOUNT:"0".'</td>
																					<td>'.$FinancialLoanDataProvider->cURRENCY!=null && $FinancialLoanDataProvider->cURRENCY->CURRENCY_SYM!=null ?$FinancialLoanDataProvider->cURRENCY->CURRENCY_SYM:"".''.$FinancialLoanDataProvider->TOTAL!=null ?$FinancialLoanDataProvider->TOTAL:"0".'</td>
                                                                                                                                                                        <td>
																						<div class="action">
																						<button class="btnEdit iconEdit" id="EditFinancialLoan'.$FinancialLoanDataProvider->FINANCIAL_LOAN_ID.'">Edit</button>
																						</div>
																					</td>';
                      
                    }
                  }
                    return [
                        'success' => true,
                        'formToShow'=>$FormToSend
                        ];  
                }
            }else{
              Yii::error('Saving : 1 ');

                Yii::error('Saving : ');
                $model->WEDDING_ID = $WeddingID;
                if ($model->save(false)) {
                  $FinancialLoanID=  $model->getPrimaryKey();
//                    unset($_POST['WedCategoryEstimatedBudget']);
                    Yii::$app->response->format = Response::FORMAT_JSON;
//                    $this->actionIndex();
                    $FinancialLoanDataProvider = new ActiveDataProvider([
            'query' => \app\models\FinancialLoan::find()->where("WEDDING_ID =  " . $WeddingID . " AND FINANCIAL_LOAN_ID = ".$FinancialLoanID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
                  $FormToSend="";
                  if($FinancialLoanDataProvider!=null){
                    $FinancialLoanDataProvider=$FinancialLoanDataProvider->getModels();  
                    if($FinancialLoanDataProvider!=null && sizeof($FinancialLoanDataProvider)>0){
                      $FormToSend='<td>'.($FinancialLoanDataProvider->sUPPLIER!=null && $FinancialLoanDataProvider->sUPPLIER->SUPPLIER_NAME!=null ?$FinancialLoanDataProvider->sUPPLIER->SUPPLIER_NAME:"Unknown").'</td>
																					<td>'.$FinancialLoanDataProvider->RATE!=null ?$FinancialLoanDataProvider->RATE.'%':"".'</td>
																					<td>'.$FinancialLoanDataProvider->DURATION!=null ?$FinancialLoanDataProvider->DURATION:"0".' months</td>
                                                                                                                                                                        <td>'.$FinancialLoanDataProvider->cURRENCY!=null && $FinancialLoanDataProvider->cURRENCY->CURRENCY_SYM!=null ?$FinancialLoanDataProvider->cURRENCY->CURRENCY_SYM:"".''.$FinancialLoanDataProvider->LOAN_AMOUNT!=null ?$FinancialLoanDataProvider->LOAN_AMOUNT:"0".'</td>
																					<td>'.$FinancialLoanDataProvider->cURRENCY!=null && $FinancialLoanDataProvider->cURRENCY->CURRENCY_SYM!=null ?$FinancialLoanDataProvider->cURRENCY->CURRENCY_SYM:"".''.$FinancialLoanDataProvider->TOTAL!=null ?$FinancialLoanDataProvider->TOTAL:"0".'</td>
                                                                                                                                                                        <td>
																						<div class="action">
																						<button class="btnEdit iconEdit" id="EditFinancialLoan'.$FinancialLoanDataProvider->FINANCIAL_LOAN_ID.'">Edit</button>
																						</div>
																					</td>';
                      
                    }
                  }
                    return [
                        'success' => true,
                        'formToShow'=>$FormToSend
                        ]; 
                }  
            }
            
                
            } else {
                if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }
            }
        }
    }
    
    public function actionEstimatedFundingValidate() {
        $model = new \app\models\EstimatedFunding();
        Yii::error('Validating : ');

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }
    
        public function actionCommercialSponsorValidate() {
        $model = new \app\models\PersonalContribution();
        Yii::error('Validating : ');

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }
    
    public function actionNewCommercialSponsor() {
//    $EstimatedBudget=new \app\models\WedCategoryEstimatedBudget();
        $CommercialSponsorModel = new \app\models\CommercialWeddingSponsor();
        $CommercialSponsorID=Yii::$app->request->get('CommercialSponsorID');
        $WeddingID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        
        
        $ExistCommercialSponsor = new ActiveDataProvider([
            'query' => \app\models\CommercialWeddingSponsor::find()->where('COMMERCIAL_WEDDING_SPONSOR_ID = ' . $CommercialSponsorID .' AND WEDDING_ID='.$WeddingID ),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        
       


        $Currencies = new ActiveDataProvider([
            'query' => \app\models\Currencies::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        
        if ($ExistCommercialSponsor != null) {
            $ExistCommercialSponsor = $ExistCommercialSponsor->getModels();
        }
        if ($Currencies != null) {
            $Currencies = $Currencies->getModels();
        }
        return $this->renderAjax('_commercialsponsor', [
                    'CommercialSponsorModel' => $CommercialSponsorModel,
                    'ExistCommercialSponsor' => $ExistCommercialSponsor,
                    'Currencies' => $Currencies,
                    'CommercialSponsorID'=>$CommercialSponsorID,
//        'EstimatedBudget'=>$EstimatedBudget
        ]);
    }
public function actionSaveCommercialSponsor() {

        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }


        Yii::error('Saving : ');
        $model = new \app\models\CommercialWeddingSponsor();
        
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($model->validate() && $WeddingID != 0) {
            $find = \app\models\CommercialWeddingSponsor::findOne(['WEDDING_ID'=>$WeddingID ,'COMMERCIAL_WEDDING_SPONSOR_ID'=>$model->COMMERCIAL_WEDDING_SPONSOR_ID]);
            if($find!=null){
                $model->WEDDING_ID = $WeddingID;
                if($model->save(false)){
                  Yii::$app->response->format = Response::FORMAT_JSON;
//                    $this->actionIndex();
                  $CommercialSponsorDataProvider = new ActiveDataProvider([
            'query' => \app\models\CommercialWeddingSponsor::find()->where("WEDDING_ID =  " . $WeddingID . " AND COMMERCIAL_WEDDING_SPONSOR_ID = ".$model->COMMERCIAL_WEDDING_SPONSOR_ID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
                  $FormToSend="";
                  if($CommercialSponsorDataProvider!=null){
                    $CommercialSponsorDataProvider=$CommercialSponsorDataProvider->getModels();  
                    if($CommercialSponsorDataProvider!=null && sizeof($CommercialSponsorDataProvider)>0){
                      $FormToSend ='<td>'.$CommercialSponsorDataProvider[0]->sPONSOR!=null && $CommercialSponsorDataProvider[0]->sPONSOR->SPONSOR_NAME!=null ?$CommercialSponsorDataProvider[0]->sPONSOR->SPONSOR_NAME:"Empty".'</td>
																					<td>'.$CommercialSponsorDataProvider[0]->cURRENCY->CURRENCY_SYM .''.$CommercialSponsorDataProvider[0]->AMOUNT.'</td>
																					<td>
																						<div class="action">
																						<button class="btnEdit iconEdit" id="EditCommercialSponsor'.$CommercialSponsorDataProvider[0]->COMMERCIAL_WEDDING_SPONSOR_ID.'">Edit</button>
																						</div>
																					</td>'; 
                    }
                  }
                    return [
                        'success' => true,
                        'formToShow'=>$FormToSend
                        ];  
                }
            }else{
              Yii::error('Saving : 1 ');

                Yii::error('Saving : ');
                $model->WEDDING_ID = $WeddingID;
                if ($model->save(false)) {
                $CommercialSponsorID=$model->getPrimaryKey();
                Yii::$app->response->format = Response::FORMAT_JSON;
                $CommercialSponsorDataProvider = new ActiveDataProvider([
            'query' => \app\models\CommercialWeddingSponsor::find()->where("WEDDING_ID =  " . $WeddingID . " AND COMMERCIAL_WEDDING_SPONSOR_ID = ".$CommercialSponsorID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
                 $FormToSend="";
                  if($CommercialSponsorDataProvider!=null){
                    $CommercialSponsorDataProvider=$CommercialSponsorDataProvider->getModels();  
                    if($CommercialSponsorDataProvider!=null && sizeof($CommercialSponsorDataProvider)>0){
                      $FormToSend ='<td>'.$CommercialSponsorDataProvider[0]->sPONSOR!=null && $CommercialSponsorDataProvider[0]->sPONSOR->SPONSOR_NAME!=null ?$CommercialSponsorDataProvider[0]->sPONSOR->SPONSOR_NAME:"Empty".'</td>
																					<td>'.$CommercialSponsorDataProvider[0]->cURRENCY->CURRENCY_SYM .''.$CommercialSponsorDataProvider[0]->AMOUNT.'</td>
																					<td>
																						<div class="action">
																						<button class="btnEdit iconEdit" id="EditCommercialSponsor'.$CommercialSponsorDataProvider[0]->COMMERCIAL_WEDDING_SPONSOR_ID.'">Edit</button>
																						</div>
																					</td>'; 
                    }
                  }
                    return [
                        'success' => true,
                        'formToShow'=>$FormToSend
                        ]; 
                }  
            }
            
                
            } else {
                if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }
            }
        }
    }
    
    
            public function actionSavingValidate() {
        $model = new \app\models\Saving();
        Yii::error('Validating : ');

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }
    
    public function actionNewSaving() {
//    $EstimatedBudget=new \app\models\WedCategoryEstimatedBudget();
        $SavingModel = new \app\models\Saving();
        $SavingID=Yii::$app->request->get('SavingID');
        $WeddingID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        
        
        $ExistSaving = new ActiveDataProvider([
            'query' => \app\models\Saving::find()->where('SavingID = ' . $SavingID .' AND WEDDING_ID='.$WeddingID ),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        
       


        $Currencies = new ActiveDataProvider([
            'query' => \app\models\Currencies::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        
        if ($ExistSaving != null) {
            $ExistSaving = $ExistSaving->getModels();
        }
        if ($Currencies != null) {
            $Currencies = $Currencies->getModels();
        }
        
        $SuppliersDataProvider = new ActiveDataProvider([
            'query' => \app\models\Suppliers::find()->where('SUPPLIER_TYPE_ID = 2' ),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
       if ($SuppliersDataProvider != null) {
            $SuppliersDataProvider = $SuppliersDataProvider->getModels();
        }
        return $this->renderAjax('_saving', [
                    'SavingModel' => $SavingModel,
                    'ExistSaving' => $ExistSaving,
                    'Currencies' => $Currencies,
                    'SavingID'=>$SavingID,
                    'SuppliersDataProvider'=>$SuppliersDataProvider,
//        'EstimatedBudget'=>$EstimatedBudget
        ]);
    }
public function actionSaveSaving() {

        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }


        Yii::error('Saving : ');
        $model = new \app\models\Saving();
        
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($model->validate() && $WeddingID != 0) {
            $find = \app\models\Saving::findOne(['WEDDING_ID'=>$WeddingID ,'SAVING_ID'=>$model->SAVING_ID]);
            if($find!=null){
                $model->WEDDING_ID = $WeddingID;
                if($model->save(false)){
                  Yii::$app->response->format = Response::FORMAT_JSON;
//                    $this->actionIndex();
                  $SavingDataProvider = new ActiveDataProvider([
            'query' => \app\models\Saving::find()->where("WEDDING_ID =  " . $WeddingID . " AND SAVING_ID = ".$model->SAVING_ID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
                  $FormToSend="";
                  if($SavingDataProvider!=null){
                    $Saving=$SavingDataProvider->getModels();  
                    if($Saving!=null && sizeof($Saving)>0){
                      $FormToSend ='<td>'.$Saving->sUPPLIER!=null && $Saving->sUPPLIER->SUPPLIER_NAME!=null ?$Saving->sUPPLIER->SUPPLIER_NAME:$Saving->SAVING_BANK_NAME.'</td>
																					<td>'.$Saving->RATE!=null ?$Saving->RATE.'%':"".'</td>
																					<td>'.$Saving->NUMBER_OF_MONTHES!=null ?$Saving->NUMBER_OF_MONTHES:"0".' months</td>
                                                                                                                                                                        <td>'.$Saving->cURRENCY!=null && $Saving->cURRENCY->CURRENCY_SYM!=null ?$Saving->cURRENCY->CURRENCY_SYM:""?><?=$Saving->AMOUNT!=null ?$Saving->AMOUNT:"0".'</td>
																					<td>'.$Saving->cURRENCY!=null && $Saving->cURRENCY->CURRENCY_SYM!=null ?$Saving->cURRENCY->CURRENCY_SYM:""?><?=$Saving->TOTAL!=null ?$Saving->TOTAL:"0".'</td>
                                                                                                                                                                        <td>
																						<div class="action">
																						<button class="btnEdit iconEdit" id="EditSaving'.$Saving->SAVING_ID.'">Edit</button>
																						</div>
																					</td>';
                    }
                  }
                    return [
                        'success' => true,
                        'formToShow'=>$FormToSend
                        ];  
                }
            }else{
              Yii::error('Saving : 1 ');

                Yii::error('Saving : ');
                $model->WEDDING_ID = $WeddingID;
                if ($model->save(false)) {
                $SavingID=$model->getPrimaryKey();
                Yii::$app->response->format = Response::FORMAT_JSON;
                $SavingDataProvider = new ActiveDataProvider([
            'query' => \app\models\Saving::find()->where("WEDDING_ID =  " . $WeddingID . " AND SAVING_ID = ".$SavingID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
                  $FormToSend="";
                  if($SavingDataProvider!=null){
                    $Saving=$SavingDataProvider->getModels();  
                    if($Saving!=null && sizeof($Saving)>0){
                      $FormToSend ='<td>'.$Saving->sUPPLIER!=null && $Saving->sUPPLIER->SUPPLIER_NAME!=null ?$Saving->sUPPLIER->SUPPLIER_NAME:$Saving->SAVING_BANK_NAME.'</td>
																					<td>'.$Saving->RATE!=null ?$Saving->RATE.'%':"".'</td>
																					<td>'.$Saving->NUMBER_OF_MONTHES!=null ?$Saving->NUMBER_OF_MONTHES:"0".' months</td>
                                                                                                                                                                        <td>'.$Saving->cURRENCY!=null && $Saving->cURRENCY->CURRENCY_SYM!=null ?$Saving->cURRENCY->CURRENCY_SYM:""?><?=$Saving->AMOUNT!=null ?$Saving->AMOUNT:"0".'</td>
																					<td>'.$Saving->cURRENCY!=null && $Saving->cURRENCY->CURRENCY_SYM!=null ?$Saving->cURRENCY->CURRENCY_SYM:""?><?=$Saving->TOTAL!=null ?$Saving->TOTAL:"0".'</td>
                                                                                                                                                                        <td>
																						<div class="action">
																						<button class="btnEdit iconEdit" id="EditSaving'.$Saving->SAVING_ID.'">Edit</button>
																						</div>
																					</td>';
                    }
                  }
                    return [
                        'success' => true,
                        'formToShow'=>$FormToSend
                        ]; 
                }  
            }
            
                
            } else {
                if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }
            }
        }
    }
//    _newmanualinvitee
//    new-manual-invitee
    public function actionDeleteCommercialSponsor() {
        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }

        $CommercialWeddingSponsor=new \app\models\CommercialWeddingSponsor();
        $data = Yii::$app->request->post();

        $CommercialSponsorID = $data['CommercialSponsorID'];
        Yii::error('BudgetID : '.$CommercialSponsorID);
//        ProducValue: ProducValue,
//                    SubCategoryID : $SubCategoryID ,
        $findOne = $CommercialWeddingSponsor->findOne(['WEDDING_ID' => $WeddingID,'COMMERCIAL_WEDDING_SPONSOR_ID' => $CommercialSponsorID]);
        if($findOne!=null){
            $deleteAll = $CommercialWeddingSponsor->deleteAll(['COMMERCIAL_WEDDING_SPONSOR_ID' => $CommercialSponsorID]);
            Yii::error('deleteAll : '.$deleteAll);
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($deleteAll==1){
                 return ['response' => 'true'];
            }else{
                return ['response' => 'false']; 
            }
        }

        
    }
public function actionDeletePrivateSponsor() {
        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }

        $PrivateSponsor=new \app\models\PrivateSponsor();
        $data = Yii::$app->request->post();

        $PrivateSponsorID = $data['PrivateSponsorID'];
        Yii::error('BudgetID : '.$PrivateSponsorID);
//        ProducValue: ProducValue,
//                    SubCategoryID : $SubCategoryID ,
        $findOne = $PrivateSponsor->findOne(['WEDDING_ID' => $WeddingID,'PRIVATE_SPONSOR_ID' => $PrivateSponsorID]);
        if($findOne!=null){
            $deleteAll = $PrivateSponsor->deleteAll(['PRIVATE_SPONSOR_ID' => $PrivateSponsorID]);
            Yii::error('deleteAll : '.$deleteAll);
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($deleteAll==1){
                 return ['response' => 'true'];
            }else{
                return ['response' => 'false']; 
            }
        }

        
    }
    public function actionDeleteLoan() {
        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }

        $FinancialLoan=new \app\models\FinancialLoan();
        $data = Yii::$app->request->post();

        $LoanID = $data['LoanID'];
        Yii::error('BudgetID : '.$LoanID);
//        ProducValue: ProducValue,
//                    SubCategoryID : $SubCategoryID ,
        $findOne = $FinancialLoan->findOne(['WEDDING_ID' => $WeddingID,'FINANCIAL_LOAN_ID' => $LoanID]);
        if($findOne!=null){
            $deleteAll = $FinancialLoan->deleteAll(['FINANCIAL_LOAN_ID' => $LoanID]);
            Yii::error('deleteAll : '.$deleteAll);
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($deleteAll==1){
                 return ['response' => 'true'];
            }else{
                return ['response' => 'false']; 
            }
        }

        
    }
    
    public function actionDeleteSaving() {
        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }

        $Saving=new \app\models\Saving();
        $data = Yii::$app->request->post();

        $SavingID = $data['SavingID'];
        Yii::error('BudgetID : '.$SavingID);
//        ProducValue: ProducValue,
//                    SubCategoryID : $SubCategoryID ,
        $findOne = $Saving->findOne(['WEDDING_ID' => $WeddingID,'SAVING_ID' => $SavingID]);
        if($findOne!=null){
            $deleteAll = $Saving->deleteAll(['SAVING_ID' => $SavingID]);
            Yii::error('deleteAll : '.$deleteAll);
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($deleteAll==1){
                 return ['response' => 'true'];
            }else{
                return ['response' => 'false']; 
            }
        }

        
    }
//    &Saving=
}
