<?php

/*
 * This Controller is used for dashboard page 
 * 
 */

namespace app\controllers;

use Yii;
use app\models\AgendaPeriodes;
//use \app\models\AgendaPeriodeTranslation;
use \app\models\WeddingTentativePeriodes;
use app\models\WeddingAgendaTasks;
use yii\web\Response;
use yii\helpers\Json;
//use yii\
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\widgets\ActiveForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \app\models\AgendaNote;
//use yii\filters\VerbFilter;
//use \app\models\AgendaNote;
use yii\filters\AccessControl;

class WeddingEstimatedBudgetController extends \yii\web\Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
//                
//                'only' => ['login', 'logout', 'signup'],
                'rules' => [

                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['save-estimated-budget'],
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $CouplePartnerID = 0;
        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }

        $WeddingModel = new \app\models\Weddings();
        $WeddingID = 0;
        if ($CouplePartnerID != 0) {

            $where = new ActiveDataProvider([
                'query' => $WeddingModel->find()->where('FIRST_COUPLE_PARTNER_ID = ' . $CouplePartnerID . ' OR SECOND_COUPLE_PARTNER_ID=' . $CouplePartnerID . ' '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);

            if ($where != null && isset($where)) {
                $models1 = $where->getModels();
                if ($models1 != null && sizeof($models1) > 0 && $models1[0]->WEDDING_ID != NULL) {
                    $WeddingID = $models1[0]->WEDDING_ID;
                }
            }
        }
        if ($WeddingID != 0) {

            $dataProvider1 = new ActiveDataProvider([
                'query' => WeddingTentativePeriodes::find()->where('WEDDING_ID =' . $WeddingID . ' '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $dataProvider = new ActiveDataProvider([
                'query' => AgendaPeriodes::find()->orderBy(['SEQUENCE_NUMBER' => SORT_ASC]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $dataEstimatedBudget = new ActiveDataProvider([
                'query' => \app\models\WeddingEstimatedBudget::find()->where(' WEDDING_ID =' . $WeddingID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $WeddingEventDataProvider = new ActiveDataProvider([
                'query' => \app\models\WeddingEvent::find()->where("WEDDING_ID =  " . $WeddingID . " OR WEDDING_ID IS NULL ORDER BY EVENT_SEQUENCE_NUMBER ASC "),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);

            $CategorydataProvider = new ActiveDataProvider([
                'query' => \app\models\CategoryOfItems::find()->where(['CATEGORY_PUBLIC' => 'P']),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            
            
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
 $WeddingEstimatedDataProvider = new ActiveDataProvider([
            'query' => \app\models\WeddingEstimatedBudget::find()->where("WEDDING_ID =  " . $WeddingID . ""),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
 if($WeddingEstimatedDataProvider!=null ){
  $WeddingEstimatedDataProvider=$WeddingEstimatedDataProvider->getModels();   
 }
 
 $Invitees = new ActiveDataProvider([
            'query' => \app\models\Invitees::find()->where('WEDDING_ID = '.$WeddingID),
            'pagination'=>false,
        ]);
$WedsiteHomeData = new ActiveDataProvider([
                'query' => \app\models\WedsiteHome::find()->where('WEDDING_ID =' . $WeddingID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            if ($WedsiteHomeData != null) {
                $WedsiteHomeData = $WedsiteHomeData->getModels();
            }
       $RegistryInfo = new ActiveDataProvider([
                'query' => \app\models\RegistrySelectedItems::find()->where('WEDDING_ID =' . $WeddingID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            if ($RegistryInfo != null) {
                $RegistryInfo = $RegistryInfo->getModels();
            }     
            return $this->render('index', [
                        'dataEstimatedBudget' => $dataEstimatedBudget,
                        'dataProvider1' => $dataProvider1,
                        'dataProvider' => $dataProvider,
                        'WeddingModel' => $WeddingModel,
                        'WeddingEventDataProvider' => $WeddingEventDataProvider,
                        'CategorydataProvider' => $CategorydataProvider,
                        'PersonalDataProvider'=>$PersonalDataProvider,
                        'PrivateSponsorDataProvider'=>$PrivateSponsorDataProvider,
                        'CommercialSponsorDataProvider'=>$CommercialSponsorDataProvider,
                        'FinancialLoanDataProvider'=>$FinancialLoanDataProvider,
                        'SavingDataProvider' => $SavingDataProvider,
                        'WeddingEstimatedDataProviderModels'=>$WeddingEstimatedDataProvider,
                        'Invitees'=>$Invitees,
                        'WedsiteHomeData'=>$WedsiteHomeData,
                        'RegistryInfo'=>$RegistryInfo
            ]);
        }
    }

    public function actionSaveEstimatedBudget() {
        $value = Yii::$app->request->post();
        $WeddingID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
    
         $cookies = Yii::$app->response->cookies;
         if($WeddingID==0){
         $cookies->remove('Che');
         $cookies->remove('face');
$cookies->remove('estimatedbudget');
$cookies->remove('EstimatedFunding');
$cookies->remove('InviteeNumber');
$cookies->remove('DateRangePicker');
$cookies->remove('preferedDays');

         }
         $cookies->add(new \yii\web\Cookie([
                'name' => 'preferedDays',
                'value' => isset($value['chosenDay']) && $value['chosenDay']!=null ?$value['chosenDay']:"",
            ]));
        $cookies->add(new \yii\web\Cookie([
                'name' => 'Che',
                'value' => isset($value['Che']) && $value['Che']!=null ?$value['Che']:"",
            ]));
        $cookies->add(new \yii\web\Cookie([
                'name' => 'face',
                'value' => isset($value['face'])? $value['face']:"",
            ]));
            $cookies->add(new \yii\web\Cookie([
                'name' => 'estimatedbudget',
                'value' => isset($value['rangepicker1'])? $value['rangepicker1']:"",
            ]));
            $cookies->add(new \yii\web\Cookie([
                'name' => 'EstimatedFunding',
                'value' => isset($value['rangepicker2'])? $value['rangepicker2']:"",
            ]));

            $cookies->add(new \yii\web\Cookie([
                'name' => 'InviteeNumber',
                'value' => isset($value['rangepicker3'])? $value['rangepicker3']:"", 
            ]));
            $cookies->add(new \yii\web\Cookie([
                'name' => 'DateRangePicker',
                'value' =>isset($value['DateRangePicker'])? $value['DateRangePicker']:"",
            ]));
        if ($WeddingID != 0) {
            
             Yii::error("Addiihhh 1 ");
            
            
            $where0 = \app\models\GetStarted::find()->where(['WEDDING_ID'=> $WeddingID])->all();
            if($where0==null){
                Yii::error("Addiihhh 2 ");
              $GetStarted=  new \app\models\GetStarted();
//              $cookies = Yii::$app->request->cookies;
              $EstimatedFunding = $cookies->getValue('EstimatedFunding', '0');
              $EstimatedBudget=$cookies->getValue('estimatedbudget', '0');
              $InviteeNumber=$cookies->getValue('InviteeNumber', '0');
              $DateRangePicker=$cookies->getValue('DateRangePicker', '0');
              $PreferedDays=$cookies->getValue('preferedDays', '0');
              if($EstimatedFunding!= "" && $EstimatedFunding!='0' && $InviteeNumber!="" && $InviteeNumber!=null && $InviteeNumber!='0' && $DateRangePicker!='0'){
              $GetStarted->FUNDING_ESTIMATED_VALUE=$EstimatedFunding;
              $GetStarted->INVITEE_NUMBER=$InviteeNumber;
              $GetStarted->WEDDING_ID=$WeddingID;
              $GetStarted->PREFFERED_DAY=$PreferedDays;
              $GetStarted->save(false);
              $cookies = Yii::$app->response->cookies;
         $cookies->remove('Che');
         unset($cookies['Che']);
         $cookies->remove('face');
         unset($cookies['face']);
         $cookies->remove('preferedDays');
unset($cookies['preferedDays']);
         
$cookies->remove('estimatedbudget');
unset($cookies['estimatedbudget']);
$cookies->remove('EstimatedFunding');
unset($cookies['EstimatedFunding']);
$cookies->remove('InviteeNumber');
unset($cookies['InviteeNumber']);
$cookies->remove('DateRangePicker');
unset($cookies['DateRangePicker']);
              $where1 = \app\models\WeddingTentativePeriodes::find()->where(['WEDDING_ID'=>$WeddingID , 'WEDDING_EVENT_ID' => 1])->all();
              if($where1==null){
                  Yii::error("Addiihhh 3 ");
                $WeddingTentativePeriod = new \app\models\WeddingTentativePeriodes();   
             $WeddingTentativePeriod->WEDDING_ID=  $WeddingID;
             $explode = explode(" - ",$DateRangePicker);
             if($explode!=null && sizeof($explode)>0){
                $Fromtime = strtotime($explode[0]);
                $newFromformat = date('Y-m-d H:i:s',$Fromtime);
              $WeddingTentativePeriod->FROM_DATE= $newFromformat;
              $Fromtime = strtotime($explode[1]);
                $newToformat = date('Y-m-d H:i:s',$Fromtime);
              $WeddingTentativePeriod->TO_DATE=$newToformat;  
             }
             $WeddingTentativePeriod0->WEDDING_EVENT_ID=1;
             $WeddingTentativePeriod->IN_USE_OR_NO='Y';
             $WeddingTentativePeriod->save(false);
             
              }else{
                  $where1=new \app\models\WeddingTentativePeriodes();
                  $explode = explode(" - ",$DateRangePicker);
             if($explode!=null && sizeof($explode)>0){
                $Fromtime = strtotime($explode[0]);
                $newFromformat = date('Y-m-d H:i:s',$Fromtime);
              $where1->FROM_DATE= $newFromformat;
              $Fromtime = strtotime($explode[1]);
                $newToformat = date('Y-m-d H:i:s',$Fromtime);
              $where1->TO_DATE=$newToformat;  
             }
                $where1->WEDDING_EVENT_ID=1;
                $where1->WEDDING_ID=$WeddingID;
                $where1->save(false);  
              }
              
              
              
              
             $where1 = \app\models\EstimatedFunding::find()->where(['WEDDING_ID'=>$WeddingID ])->all();
              if($where1==null){
                  Yii::error("Addiihhh 3 ");
                $EstimatedFundng = new \app\models\EstimatedFunding();   
             $EstimatedFundng->WEDDING_ID=  $WeddingID;
             $EstimatedFundng->ESTIMATED_VALUE=$EstimatedFunding;
             $EstimatedFundng->CURRENCY_ID=2;
             $EstimatedFundng->save(false);
             
              }else{
                $where1 = new \app\models\EstimatedFunding();
                $where1->ESTIMATED_VALUE=$EstimatedFunding;
                $where1->CURRENCY_ID=1;
                $where1->save(false);  
              }
            }
            
            $Check=$cookies->getValue('Che', '0');
              $Face=$cookies->getValue('face', '0');
              if($Check=="on"){
                  if($Face=="1" || $Face=="2" || $Face=="3" ||$Face=="4"){
                      return Yii::$app->getResponse()->redirect(['/category-of-items/index','Reg'=>'C']);
                       
                  }
              }else{
               if($Face=="1" || $Face=="2"){
                   return  Yii::$app->getResponse()->redirect(['/agenda-periodes/index']);
          
                  }  
                  if($Face=="3" ||$Face=="4"){
                     return Yii::$app->getResponse()->redirect(['/category-of-items/index','Reg'=>'C']);  
                  }
              }
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['close' => 'Y'];
        }} else {
             $Check=$cookies->getValue('Che', '0');
              $Face=$cookies->getValue('face', '0');
              if($Check=="on"){
                  if($Face=="1" || $Face=="2" || $Face=="3" ||$Face=="4"){
                      return Yii::$app->getResponse()->redirect(['/category-of-items/index','Reg'=>'C']);
                       
                  }
              }else{
               if($Face=="1" || $Face=="2"){
                   return  Yii::$app->getResponse()->redirect(['/agenda-periodes/index']);
          
                  }  
                  if($Face=="3" ||$Face=="4"){
                     return Yii::$app->getResponse()->redirect(['/category-of-items/index','Reg'=>'C']);  
                  }
              }
            Yii::error("Index ");
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['success' => true];
        }
    }

}
