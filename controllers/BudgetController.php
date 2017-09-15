<?php

namespace app\controllers;

use Yii;
use app\models\AgendaPeriodes;
//use \app\models\AgendaPeriodeTranslation;
use \app\models\WeddingTentativePeriodes;
use app\models\WeddingAgendaTasks;
use \app\models\WeddingEvent;
use yii\web\Response;
//use yii\widgets\ActiveForm;
use yii\helpers\Json;
//use yii\
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\widgets\ActiveForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \app\models\AgendaNote;
use yii\filters\AccessControl;

class BudgetController extends \yii\web\Controller {

    public function actionIndex() {
        $CouplePartnerID = 0;
        $WeddingID = 0;
//        $EventID=2;
        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }


        Yii::error("Index Controller ");

//        $weddings $weddings0
        $WeddingRealBudgetModel = new \app\models\WeddingRealBudget();

        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
//        $TransModel=  \app\models\AgendaPeriodeTranslation();
//        $TransModel->
        $CouplePartnerModel = new \app\models\CouplePartner();
        $WeddingEvents = new \app\models\WeddingEvent();
        $WeddingTentativePeriods = new \app\models\WeddingTentativePeriodes();
        $WeddingTaskModel = new \app\models\WeddingAgendaTasks();
        $AgendaNoteModel = new \app\models\AgendaNote();
        $AgendaPeriodsModel = new \app\models\AgendaPeriodes();
        $TaskModel = new \app\models\Agenda();

        $WeddingEventDataProvider = new ActiveDataProvider([
            'query' => WeddingEvent::find()->where("WEDDING_ID =  " . $WeddingID . " OR WEDDING_ID IS NULL ORDER BY EVENT_SEQUENCE_NUMBER ASC "),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $WeddingEstimatedDataProvider = new ActiveDataProvider([
            'query' => \app\models\WeddingEstimatedBudget::find()->where("WEDDING_ID =  " . $WeddingID . ""),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $dataAddToCart = new ActiveDataProvider([
            'query' => \app\models\AddToCart::find()->orderBy(['WEDDING_ID' => $WeddingID]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $TotalPoints=0;
        if($dataAddToCart!=null ){
            $dataAddToCart=$dataAddToCart->getModels();
            if($dataAddToCart!=null && sizeof($dataAddToCart)>0){
                foreach($dataAddToCart as $AddToCart){
                    
                 $TotalPoints= $TotalPoints + ($AddToCart->iTEMSUPPLIER->POINTS*$AddToCart->QUANTITY);
                }
            }
        }
        $dataProvider = new ActiveDataProvider([
            'query' => AgendaPeriodes::find()->orderBy(['SEQUENCE_NUMBER' => SORT_ASC]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
$WeddingTotalEstimatedDataProvider = new ActiveDataProvider([
            'query' => \app\models\TotalEstimatedBudget::find()->where("WEDDING_ID =  " . $WeddingID . ""),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $dataProvider1 = null;
        $MaxDateModels = null;
        $WeddingRealBudgetForNullCategories = null;
        $WeddingRealBudgetForNotNullCategories = null;
        if ($WeddingID != 0) {

            $WeddingRealBudgetForNullCategories = new ActiveDataProvider([
                'query' => \app\models\WeddingRealBudget::find()->where("WEDDING_ID =  " . $WeddingID . " AND CATEGORY_OF_ITEM_ID IS NULL AND PRODUCT_ID IS NULL AND SUB_CATEGORY_ID IS NULL AND ITEM_ID IS NULL "),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $WeddingRealBudgetForNotNullCategories = new ActiveDataProvider([
                'query' => \app\models\WeddingRealBudget::find()->where("WEDDING_ID =  " . $WeddingID . " AND CATEGORY_OF_ITEM_ID IS NOT NULL "),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);

            $dataProvider1 = new ActiveDataProvider([
                'query' => WeddingTentativePeriodes::find()->where(['WEDDING_ID' => $WeddingID]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);

            $MaxDateModels = new ActiveDataProvider([
                'query' => WeddingAgendaTasks::find()->where(['WEDDING_ID' => $WeddingID])->orderBy('POSTING_DATE DESC'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            if ($MaxDateModels != null) {
                $MaxDateModels = $MaxDateModels->getModels();
            }
        }




        $models = $dataProvider->getModels();
        $WeddingPeriodsmodels = null;
        if (isset($dataProvider1)) {
            $WeddingPeriodsmodels = $dataProvider1->getModels();
        }
        $MaxEventID = "0";
        $MaxDate = "";
        $AgendaPeriodsToUse = null;
        foreach ($models as $AgendaPeriods) {
            if (sizeof($WeddingPeriodsmodels) > 0) {
                foreach ($WeddingPeriodsmodels as $WeddingDatee) {
                    if ($WeddingDatee->IN_USE_OR_NO == 'Y') {
                        $ToDate = "";
                        if ($WeddingDatee->TO_DATE != NULL) {
                            $ToDate = $WeddingDatee->TO_DATE;
                            $explode = explode("T", $ToDate);
                            $ToDate = $explode[0];
                        }
                        if (strtotime($MaxDate) < strtotime($ToDate)) {
                            $MaxDate = $ToDate;
                            $AgendaPeriodsToUse = $AgendaPeriods;

//                                                $MAxEventName = $WeddingDatee->wEDDINGEVENT->weddingEventTranslations[0]->wedding_event_VALUE;
                            $MaxEventID = $WeddingDatee->wEDDINGEVENT->weddingEventTranslations[0]->wedding_event_id;
                        }
                    }
                }
            }
        }
        $dataProviderForWeddingDate1 = new ActiveDataProvider([
            'query' => WeddingTentativePeriodes::find()->where('WEDDING_ID =' . $WeddingID . ' AND WEDDING_EVENT_ID=' . $MaxEventID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $WeddingModel = new \app\models\Weddings();
//        ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->where('agenda_periode_translation.LANGUAGE_ID=2' )->all()
//        $dataProvider1 = new ActiveDataProvider([
//            'query' => AgendaPeriodeTranslation::find(), 
////                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
//        ]);
//        $query=AgendaPeriodes::find()->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->where(['=','agenda_periode_translation.LANGUAGE_ID', 2]);
//        print_r($query->createCommand()->getRawSql()) ;
//$AgendaPeriodsModel=new \app\models\AgendaPeriodes();
//        $AgendaPeriods=new \app\models\Agenda();
        
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
        
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'dataProvider1' => $dataProvider1,
                    'WeddingTaskModel' => $WeddingTaskModel,
                    'AgendaNoteModel' => $AgendaNoteModel,
                    'WeddingEvents' => $WeddingEvents,
                    'WeddingTentativePeriods' => $WeddingTentativePeriods,
                    'WeddingEventDataProvider' => $WeddingEventDataProvider,
                    'dataProviderForWeddingDate1' => $dataProviderForWeddingDate1,
                    'AgendaPeriodsModel' => $AgendaPeriodsModel,
                    'TaskModel' => $TaskModel,
                    'WeddingModel' => $WeddingModel,
                    'CouplePartnerModel' => $CouplePartnerModel,
                    'MaxDateModels' => $MaxDateModels != null && sizeof($MaxDateModels) > 0 ? $MaxDateModels[0] : null,
                    'WeddingRealBudgetForNullCategories' => $WeddingRealBudgetForNullCategories,
                    'WeddingRealBudgetForNotNullCategories' => $WeddingRealBudgetForNotNullCategories,
                    'WeddingEstimatedDataProvider' => $WeddingEstimatedDataProvider,
                    'WeddingTotalEstimatedDataProvider'=>$WeddingTotalEstimatedDataProvider,
            'PersonalDataProvider'=>$PersonalDataProvider,
            'PrivateSponsorDataProvider'=>$PrivateSponsorDataProvider,
            'CommercialSponsorDataProvider'=>$CommercialSponsorDataProvider,
            'FinancialLoanDataProvider'=>$FinancialLoanDataProvider,
            'SavingDataProvider' => $SavingDataProvider,
            'TotalPoints'=>$TotalPoints,
        ]);
    }
    
    public function actionShowBudgetForm() {
        $CouplePartnerID = 0;
        $WeddingID = 0;
//        $EventID=2;
        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }


        Yii::error("Index Controller ");

//        $weddings $weddings0
        $WeddingRealBudgetModel = new \app\models\WeddingRealBudget();

        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
//        $TransModel=  \app\models\AgendaPeriodeTranslation();
//        $TransModel->
        $CouplePartnerModel = new \app\models\CouplePartner();
        $WeddingEvents = new \app\models\WeddingEvent();
        $WeddingTentativePeriods = new \app\models\WeddingTentativePeriodes();
        $WeddingTaskModel = new \app\models\WeddingAgendaTasks();
        $AgendaNoteModel = new \app\models\AgendaNote();
        $AgendaPeriodsModel = new \app\models\AgendaPeriodes();
        $TaskModel = new \app\models\Agenda();

        $WeddingEventDataProvider = new ActiveDataProvider([
            'query' => WeddingEvent::find()->where("WEDDING_ID =  " . $WeddingID . " OR WEDDING_ID IS NULL ORDER BY EVENT_SEQUENCE_NUMBER ASC "),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $WeddingEstimatedDataProvider = new ActiveDataProvider([
            'query' => \app\models\WeddingEstimatedBudget::find()->where("WEDDING_ID =  " . $WeddingID . ""),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $WeddingTotalEstimatedDataProvider = new ActiveDataProvider([
            'query' => \app\models\TotalEstimatedBudget::find()->where("WEDDING_ID =  " . $WeddingID . ""),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => AgendaPeriodes::find()->orderBy(['SEQUENCE_NUMBER' => SORT_ASC]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
$Range=  \app\models\GetStartedRange::find()->where(['CURRENCY_ID'=> 1])->all();
        $dataProvider1 = null;
        $MaxDateModels = null;
        $WeddingRealBudgetForNullCategories = null;
        $WeddingRealBudgetForNotNullCategories = null;
        if ($WeddingID != 0) {

            $WeddingRealBudgetForNullCategories = new ActiveDataProvider([
                'query' => \app\models\WeddingRealBudget::find()->where("WEDDING_ID =  " . $WeddingID . " AND CATEGORY_OF_ITEM_ID IS NULL AND PRODUCT_ID IS NULL AND SUB_CATEGORY_ID IS NULL AND ITEM_ID IS NULL "),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $WeddingRealBudgetForNotNullCategories = new ActiveDataProvider([
                'query' => \app\models\WeddingRealBudget::find()->where("WEDDING_ID =  " . $WeddingID . " AND CATEGORY_OF_ITEM_ID IS NOT NULL "),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);

            $dataProvider1 = new ActiveDataProvider([
                'query' => WeddingTentativePeriodes::find()->where(['WEDDING_ID' => $WeddingID]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);

            $MaxDateModels = new ActiveDataProvider([
                'query' => WeddingAgendaTasks::find()->where(['WEDDING_ID' => $WeddingID])->orderBy('POSTING_DATE DESC'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            if ($MaxDateModels != null) {
                $MaxDateModels = $MaxDateModels->getModels();
            }
        }




        $models = $dataProvider->getModels();
        $WeddingPeriodsmodels = null;
        if (isset($dataProvider1)) {
            $WeddingPeriodsmodels = $dataProvider1->getModels();
        }
        $MaxEventID = "0";
        $MaxDate = "";
        $AgendaPeriodsToUse = null;
        foreach ($models as $AgendaPeriods) {
            if (sizeof($WeddingPeriodsmodels) > 0) {
                foreach ($WeddingPeriodsmodels as $WeddingDatee) {
                    if ($WeddingDatee->IN_USE_OR_NO == 'Y') {
                        $ToDate = "";
                        if ($WeddingDatee->TO_DATE != NULL) {
                            $ToDate = $WeddingDatee->TO_DATE;
                            $explode = explode("T", $ToDate);
                            $ToDate = $explode[0];
                        }
                        if (strtotime($MaxDate) < strtotime($ToDate)) {
                            $MaxDate = $ToDate;
                            $AgendaPeriodsToUse = $AgendaPeriods;

//                                                $MAxEventName = $WeddingDatee->wEDDINGEVENT->weddingEventTranslations[0]->wedding_event_VALUE;
                            $MaxEventID = $WeddingDatee->wEDDINGEVENT->weddingEventTranslations[0]->wedding_event_id;
                        }
                    }
                }
            }
        }
        $dataProviderForWeddingDate1 = new ActiveDataProvider([
            'query' => WeddingTentativePeriodes::find()->where('WEDDING_ID =' . $WeddingID . ' AND WEDDING_EVENT_ID=' . $MaxEventID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $WeddingModel = new \app\models\Weddings();
//        ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->where('agenda_periode_translation.LANGUAGE_ID=2' )->all()
//        $dataProvider1 = new ActiveDataProvider([
//            'query' => AgendaPeriodeTranslation::find(), 
////                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
//        ]);
//        $query=AgendaPeriodes::find()->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->where(['=','agenda_periode_translation.LANGUAGE_ID', 2]);
//        print_r($query->createCommand()->getRawSql()) ;
//$AgendaPeriodsModel=new \app\models\AgendaPeriodes();
//        $AgendaPeriods=new \app\models\Agenda();
        $dataPackages = new ActiveDataProvider([
            'query' => \app\models\Packages::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
           if($dataPackages!=null){
               $dataPackages=$dataPackages->getModels();
           }  
        return $this->renderAjax('_budgetform', [
                    'dataProvider' => $dataProvider,
                    'dataProvider1' => $dataProvider1,
                    'WeddingTaskModel' => $WeddingTaskModel,
                    'AgendaNoteModel' => $AgendaNoteModel,
                    'WeddingEvents' => $WeddingEvents,
                    'WeddingTentativePeriods' => $WeddingTentativePeriods,
                    'WeddingEventDataProvider' => $WeddingEventDataProvider,
                    'dataProviderForWeddingDate1' => $dataProviderForWeddingDate1,
                    'AgendaPeriodsModel' => $AgendaPeriodsModel,
                    'TaskModel' => $TaskModel,
                    'WeddingModel' => $WeddingModel,
                    'CouplePartnerModel' => $CouplePartnerModel,
                    'MaxDateModels' => $MaxDateModels != null && sizeof($MaxDateModels) > 0 ? $MaxDateModels[0] : null,
                    'WeddingRealBudgetForNullCategories' => $WeddingRealBudgetForNullCategories,
                    'WeddingRealBudgetForNotNullCategories' => $WeddingRealBudgetForNotNullCategories,
                    'WeddingEstimatedDataProvider' => $WeddingEstimatedDataProvider,
                    'WeddingTotalEstimatedDataProvider'=>$WeddingTotalEstimatedDataProvider,
                    'Hide'=>"N",
                    'Range'=>$Range,
                    'dataPackages'=>$dataPackages
        ]);
    }
    public function actionHiddenBudgetForm() {
        $CouplePartnerID = 0;
        $WeddingID = 0;
//        $EventID=2;
        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }


        Yii::error("Index Controller ");

//        $weddings $weddings0
        $WeddingRealBudgetModel = new \app\models\WeddingRealBudget();

        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
//        $TransModel=  \app\models\AgendaPeriodeTranslation();
//        $TransModel->
        $CouplePartnerModel = new \app\models\CouplePartner();
        $WeddingEvents = new \app\models\WeddingEvent();
        $WeddingTentativePeriods = new \app\models\WeddingTentativePeriodes();
        $WeddingTaskModel = new \app\models\WeddingAgendaTasks();
        $AgendaNoteModel = new \app\models\AgendaNote();
        $AgendaPeriodsModel = new \app\models\AgendaPeriodes();
        $TaskModel = new \app\models\Agenda();

        $WeddingEventDataProvider = new ActiveDataProvider([
            'query' => WeddingEvent::find()->where("WEDDING_ID =  " . $WeddingID . " OR WEDDING_ID IS NULL ORDER BY EVENT_SEQUENCE_NUMBER ASC "),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $WeddingEstimatedDataProvider = new ActiveDataProvider([
            'query' => \app\models\WeddingEstimatedBudget::find()->where("WEDDING_ID =  " . $WeddingID . ""),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => AgendaPeriodes::find()->orderBy(['SEQUENCE_NUMBER' => SORT_ASC]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

         $WeddingTotalEstimatedDataProvider = new ActiveDataProvider([
            'query' => \app\models\TotalEstimatedBudget::find()->where("WEDDING_ID =  " . $WeddingID . ""),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
         
         
        $dataProvider1 = null;
        $MaxDateModels = null;
        $WeddingRealBudgetForNullCategories = null;
        $WeddingRealBudgetForNotNullCategories = null;
        if ($WeddingID != 0) {

            $WeddingRealBudgetForNullCategories = new ActiveDataProvider([
                'query' => \app\models\WeddingRealBudget::find()->where("WEDDING_ID =  " . $WeddingID . " AND CATEGORY_OF_ITEM_ID IS NULL AND PRODUCT_ID IS NULL AND SUB_CATEGORY_ID IS NULL AND ITEM_ID IS NULL "),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $WeddingRealBudgetForNotNullCategories = new ActiveDataProvider([
                'query' => \app\models\WeddingRealBudget::find()->where("WEDDING_ID =  " . $WeddingID . " AND CATEGORY_OF_ITEM_ID IS NOT NULL "),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);

            $dataProvider1 = new ActiveDataProvider([
                'query' => WeddingTentativePeriodes::find()->where(['WEDDING_ID' => $WeddingID]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);

            $MaxDateModels = new ActiveDataProvider([
                'query' => WeddingAgendaTasks::find()->where(['WEDDING_ID' => $WeddingID])->orderBy('POSTING_DATE DESC'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            if ($MaxDateModels != null) {
                $MaxDateModels = $MaxDateModels->getModels();
            }
        }




        $models = $dataProvider->getModels();
        $WeddingPeriodsmodels = null;
        if (isset($dataProvider1)) {
            $WeddingPeriodsmodels = $dataProvider1->getModels();
        }
        $MaxEventID = "0";
        $MaxDate = "";
        $AgendaPeriodsToUse = null;
        foreach ($models as $AgendaPeriods) {
            if (sizeof($WeddingPeriodsmodels) > 0) {
                foreach ($WeddingPeriodsmodels as $WeddingDatee) {
                    if ($WeddingDatee->IN_USE_OR_NO == 'Y') {
                        $ToDate = "";
                        if ($WeddingDatee->TO_DATE != NULL) {
                            $ToDate = $WeddingDatee->TO_DATE;
                            $explode = explode("T", $ToDate);
                            $ToDate = $explode[0];
                        }
                        if (strtotime($MaxDate) < strtotime($ToDate)) {
                            $MaxDate = $ToDate;
                            $AgendaPeriodsToUse = $AgendaPeriods;

//                                                $MAxEventName = $WeddingDatee->wEDDINGEVENT->weddingEventTranslations[0]->wedding_event_VALUE;
                            $MaxEventID = $WeddingDatee->wEDDINGEVENT->weddingEventTranslations[0]->wedding_event_id;
                        }
                    }
                }
            }
        }
        $dataProviderForWeddingDate1 = new ActiveDataProvider([
            'query' => WeddingTentativePeriodes::find()->where('WEDDING_ID =' . $WeddingID . ' AND WEDDING_EVENT_ID=' . $MaxEventID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $Range=  \app\models\GetStartedRange::find()->where(['CURRENCY_ID'=> 1])->all();
        $WeddingModel = new \app\models\Weddings();
//        ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->where('agenda_periode_translation.LANGUAGE_ID=2' )->all()
//        $dataProvider1 = new ActiveDataProvider([
//            'query' => AgendaPeriodeTranslation::find(), 
////                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
//        ]);
//        $query=AgendaPeriodes::find()->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->where(['=','agenda_periode_translation.LANGUAGE_ID', 2]);
//        print_r($query->createCommand()->getRawSql()) ;
//$AgendaPeriodsModel=new \app\models\AgendaPeriodes();
//        $AgendaPeriods=new \app\models\Agenda();
        
        $dataPackages = new ActiveDataProvider([
            'query' => \app\models\Packages::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
           if($dataPackages!=null){
               $dataPackages=$dataPackages->getModels();
           }  
        return $this->renderAjax('_budgetform', [
                    'dataProvider' => $dataProvider,
                    'dataProvider1' => $dataProvider1,
                    'WeddingTaskModel' => $WeddingTaskModel,
                    'AgendaNoteModel' => $AgendaNoteModel,
                    'WeddingEvents' => $WeddingEvents,
                    'WeddingTentativePeriods' => $WeddingTentativePeriods,
                    'WeddingEventDataProvider' => $WeddingEventDataProvider,
                    'dataProviderForWeddingDate1' => $dataProviderForWeddingDate1,
                    'AgendaPeriodsModel' => $AgendaPeriodsModel,
                    'TaskModel' => $TaskModel,
                    'WeddingModel' => $WeddingModel,
                    'CouplePartnerModel' => $CouplePartnerModel,
                    'MaxDateModels' => $MaxDateModels != null && sizeof($MaxDateModels) > 0 ? $MaxDateModels[0] : null,
                    'WeddingRealBudgetForNullCategories' => $WeddingRealBudgetForNullCategories,
                    'WeddingRealBudgetForNotNullCategories' => $WeddingRealBudgetForNotNullCategories,
                    'WeddingEstimatedDataProvider' => $WeddingEstimatedDataProvider,
                    'WeddingTotalEstimatedDataProvider'=>$WeddingTotalEstimatedDataProvider,
                    'Hide'=>'Y',
                    'Range'=>$Range,
                    'dataPackages'=>$dataPackages
        ]);
    }

    public function actionNewCategoryForm() {
        $EstimatedBudget = new \app\models\WedCategoryEstimatedBudget();
        $request = Yii::$app->request;
        $EventID = $request->get('EventID');

        $WeddingID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }

        $CategoryUsed = new ActiveDataProvider([
            'query' => \app\models\WedCategoryEstimatedBudget::find()->where('WEDDING_EVENT_ID=' . $EventID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $IdIn = "";
        if ($CategoryUsed != null) {
            $CategoryUsed = $CategoryUsed->getModels();
            $i = 0;
            foreach ($CategoryUsed as $Category) {
                if ($i == (sizeof($CategoryUsed) - 1)) {
                    $IdIn = $IdIn . $Category->CATEGORY_ID;
                } else {
                    $IdIn = $IdIn . $Category->CATEGORY_ID . ',';
                }
                $i++;
            }
        }


        $Categories = null;
        if ($IdIn != "") {
            $Categories = new ActiveDataProvider([
                'query' => \app\models\CategoryOfItems::find()->where(' CATEGORY_OF_ITEM_ID NOT IN (' . $IdIn . ')  AND (WEDDING_ID IS NULL OR WEDDING_ID = ' . $WeddingID . ')'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
        } else {
            $Categories = new ActiveDataProvider([
                'query' => \app\models\CategoryOfItems::find()->where('  (WEDDING_ID IS NULL OR WEDDING_ID = ' . $WeddingID . ')'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
        }
        $EventArray = [];
        if ($Categories != null) {
            $Categories = $Categories->getModels();
            if ($Categories != null && sizeof($Categories) > 0) {
                $i = 0;
                foreach ($Categories as $Category) {

                    if ($Category->WEDDING_ID != null && $Category->WEDDING_ID == $WeddingID) {
                        $EventArray[$i]['CATEGORY_OF_ITEM_ID'] = $Category->CATEGORY_OF_ITEM_ID;
                        $EventArray[$i]['CATEGORY_OF_ITEM_TRANS'] = $Category->CATEGORY_VALUE;
                    }if ($Category->WEDDING_ID == null) {
                        $EventArray[$i]['CATEGORY_OF_ITEM_ID'] = $Category->CATEGORY_OF_ITEM_ID;
                        $EventArray[$i]['CATEGORY_OF_ITEM_TRANS'] = $Category->categoryOfItemsTrans != null && sizeof($Category->categoryOfItemsTrans) > 0 && $Category->categoryOfItemsTrans[0]->CATEGORY_OF_ITEM_TRANS != null ? $Category->categoryOfItemsTrans[0]->CATEGORY_OF_ITEM_TRANS : "";
                    }
                    $i++;
                }
            }
        }



//        $Categories = new ActiveDataProvider([
//            'query' => \app\models\CategoryOfItemsTrans::find()->where('LANGUAGE_ID =1'),
////                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
//        ]);
        $Currencies = new ActiveDataProvider([
            'query' => \app\models\Currencies::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        if ($Currencies != null) {
            $Currencies = $Currencies->getModels();
        }
        Yii::error('Ana Kabasetttttttttt : ');
        return $this->renderAjax('_newcategoryform', [
                    'Categories' => $EventArray,
                    'Currencies' => $Currencies,
                    'EstimatedBudget' => $EstimatedBudget,
                    'EventID' => $EventID,
        ]);
    }

    public function actionNewTotalForm() {
//    $EstimatedBudget=new \app\models\WedCategoryEstimatedBudget();
//        CategoryID=$CategoryID&EventID=$WeddingEventID
        $WeddingID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
                
        $TotalEstimatedBudgetModel = new \app\models\TotalEstimatedBudget();

        $Currencies = new ActiveDataProvider([
            'query' => \app\models\Currencies::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);


        if ($Currencies != null) {
            $Currencies = $Currencies->getModels();
        }

        return $this->renderAjax('_totalbuget', [
                    'TotalEstimatedBudgetModel' => $TotalEstimatedBudgetModel,
                    'Currencies' => $Currencies,
                   

//        'EstimatedBudget'=>$EstimatedBudget
        ]);
    }
    public function actionNewSubCategoryForm() {
//    $EstimatedBudget=new \app\models\WedCategoryEstimatedBudget();
//        CategoryID=$CategoryID&EventID=$WeddingEventID
        $WeddingID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        $request = Yii::$app->request;
        $EventID = $request->get('EventID');
        $CategoryID = $request->get('CategoryID');
        $SubCategoryEstimatedBudget = new \app\models\WedSubCategoryEstimatedBudget();

        $SubProductUsed = new ActiveDataProvider([
            'query' => \app\models\WedSubCategoryEstimatedBudget::find()->where('WEDDING_EVENT_ID=' . $EventID . ' AND CATEGORY_ID = ' . $CategoryID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $IdIn = "";
        if ($SubProductUsed != null) {
            $SubProductUsed = $SubProductUsed->getModels();
            $i = 0;
            foreach ($SubProductUsed as $SubCat) {
                if ($i == (sizeof($SubProductUsed) - 1)) {
                    $IdIn = $IdIn . $SubCat->SUB_CATEGORY_ID;
                } else {
                    $IdIn = $IdIn . $SubCat->SUB_CATEGORY_ID . ',';
                }

                $i++;
            }
        }


        $SubCategory = null;
        if ($IdIn != "") {
            $SubCategory = new ActiveDataProvider([
                'query' => \app\models\SubCategoriesOfItems::find()->where(' SUB_CATEGORY_ID NOT IN (' . $IdIn . ') and CATEGORY_OF_ITEM_ID = ' . $CategoryID . ' AND (WEDDING_ID IS NULL OR WEDDING_ID = ' . $WeddingID . ')'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
        } else {
            $SubCategory = new ActiveDataProvider([
                'query' => \app\models\SubCategoriesOfItems::find()->where(' CATEGORY_OF_ITEM_ID = ' . $CategoryID . ' AND (WEDDING_ID IS NULL OR WEDDING_ID = ' . $WeddingID . ')'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
        }
        $EventArray = [];
        if ($SubCategory != null) {
            $SubCategory = $SubCategory->getModels();
            if ($SubCategory != null && sizeof($SubCategory) > 0) {
                $i = 0;
                foreach ($SubCategory as $SubCategor) {

                    if ($SubCategor->WEDDING_ID != null && $SubCategor->WEDDING_ID == $WeddingID) {
                        $EventArray[$i]['SUB_CATEGORY_ID'] = $SubCategor->SUB_CATEGORY_ID;
                        $EventArray[$i]['SUB_CATEGORY_NAME'] = $SubCategor->SUB_CATEGORY_VALUE;
                    }if ($SubCategor->WEDDING_ID == null) {
                        $EventArray[$i]['SUB_CATEGORY_ID'] = $SubCategor->SUB_CATEGORY_ID;
                        $EventArray[$i]['SUB_CATEGORY_NAME'] = $SubCategor->subCategoriesTrans != null && sizeof($SubCategor->subCategoriesTrans) > 0 && $SubCategor->subCategoriesTrans[0]->SUB_CATEGORY_NAME != null ? $SubCategor->subCategoriesTrans[0]->SUB_CATEGORY_NAME : "";
                    }
                    $i++;
                }
            }
        }



//        $SubCategory = new ActiveDataProvider([
//            'query' => \app\models\SubCategoriesTrans::find()->where('LANGUAGE_ID =1'),
////                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
//        ]);

        $Currencies = new ActiveDataProvider([
            'query' => \app\models\Currencies::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);


        if ($Currencies != null) {
            $Currencies = $Currencies->getModels();
        }

        return $this->renderAjax('_newsubcategory', [
                    'SubCategory' => $EventArray,
                    'SubCategoryEstimatedBudget' => $SubCategoryEstimatedBudget,
                    'Currencies' => $Currencies,
                    'EventID' => $EventID,
                    'CategoryID' => $CategoryID

//        'EstimatedBudget'=>$EstimatedBudget
        ]);
    }

    public function actionProductForm() {
//    $EstimatedBudget=new \app\models\WedCategoryEstimatedBudget();
//        SubCategoryID=$SubCategoryID&EventID=$WeddingEventID
        $WeddingID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        $request = Yii::$app->request;
        $EventID = $request->get('EventID');
        $SubCategoryID = $request->get('SubCategoryID');
        $CategoryID = $request->get('CategoryID');
        $WedProductEstimation = new \app\models\WedProductEstimation();
        $ProductsUsed = new ActiveDataProvider([
            'query' => \app\models\WedProductEstimation::find()->where('WEDDING_EVENT_ID=' . $EventID . ' AND SUB_CATEGORY_ID = ' . $SubCategoryID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $IdIn = "";
        if ($ProductsUsed != null) {
            $ProductsUsed = $ProductsUsed->getModels();
            $i = 0;
            foreach ($ProductsUsed as $Productss) {
                if ($i == (sizeof($ProductsUsed) - 1)) {
                    $IdIn = $IdIn . $Productss->PRODUCT_ID;
                } else {
                    $IdIn = $IdIn . $Productss->PRODUCT_ID . ',';
                }
                $i++;
            }
        }


//        $WeddingEvent = new ActiveDataProvider([
//            'query' => \app\models\WeddingEvent::find()->where('WEDDING_ID = '.$WeddingID.' OR WEDDING_ID IS NULL AND WEDDING_EVENT_ID NOT IN ('.$IdIn.')'),
////                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
//        ]);
        $Products = null;
        if ($IdIn != "") {
            $Products = new ActiveDataProvider([
                'query' => \app\models\Products::find()->where(' products.PRODUCT_ID NOT IN (' . $IdIn . ') and products.SUB_CATEGORY_ID = ' . $SubCategoryID . ' AND (WEDDING_ID IS NULL OR WEDDING_ID = ' . $WeddingID . ')'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
        } else {
            $Products = new ActiveDataProvider([
                'query' => \app\models\Products::find()->where('  products.SUB_CATEGORY_ID = ' . $SubCategoryID . ' AND (WEDDING_ID IS NULL OR WEDDING_ID = ' . $WeddingID . ')'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
        }
        $EventArray = [];
        if ($Products != null) {
            $Products = $Products->getModels();
            if ($Products != null && sizeof($Products) > 0) {
                $i = 0;
                foreach ($Products as $Product) {

                    if ($Product->WEDDING_ID != null && $Product->WEDDING_ID == $WeddingID) {
                        $EventArray[$i]['PRODUCT_ID'] = $Product->PRODUCT_ID;
                        $EventArray[$i]['PRODUCT_NAME'] = $Product->PRODUCT_NAME;
                    }if ($Product->WEDDING_ID == null) {
                        $EventArray[$i]['PRODUCT_ID'] = $Product->PRODUCT_ID;
                        $EventArray[$i]['PRODUCT_NAME'] = $Product->productsTrans != null && sizeof($Product->productsTrans) > 0 && $Product->productsTrans[0]->PRODUCT_NAME != null ? $Product->productsTrans[0]->PRODUCT_NAME : "";
                    }
                    $i++;
                }
            }
        }
        $Currencies = new ActiveDataProvider([
            'query' => \app\models\Currencies::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        if ($Currencies != null) {
            $Currencies = $Currencies->getModels();
        }


        return $this->renderAjax('_newproductform', [
                    'Products' => $EventArray,
                    'WedProductEstimation' => $WedProductEstimation,
                    'Currencies' => $Currencies,
                    'EventID' => $EventID,
                    'SubCategoryID' => $SubCategoryID,
                    'CategoryID' => $CategoryID, //hayde 3am bib3ata 3al form kirmel l ID bas kirmel hek...iza ma7ayta btou2af l delete lal row
//        'EstimatedBudget'=>$EstimatedBudget
        ]);
    }

    public function actionItemForm() {
        $EstimatedBudget = new \app\models\WeddingRealBudget();
        $request = Yii::$app->request;
        $EventID = $request->get('EventID');
        $ProductID = $request->get('ProductID');
       $WeddingID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
//        ProductID=$ProdutID&EventID=$WeddingEventID
$ItemUsed = new ActiveDataProvider([
            'query' => \app\models\WeddingRealBudget::find()->where('WEDDING_EVENT_ID=' . $EventID . ' AND PRODUCT_ID = ' . $ProductID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $IdIn = "";
        if ($ItemUsed != null) {
            $ItemUsed = $ItemUsed->getModels();
            $i = 0;
            foreach ($ItemUsed as $Item) {
                if ($i == (sizeof($ItemUsed) - 1)) {
                    $IdIn = $IdIn . $Item->ITEM_ID;
                } else {
                    $IdIn = $IdIn . $Item->ITEM_ID . ',';
                }
                $i++;
            }
        }


//        $WeddingEvent = new ActiveDataProvider([
//            'query' => \app\models\WeddingEvent::find()->where('WEDDING_ID = '.$WeddingID.' OR WEDDING_ID IS NULL AND WEDDING_EVENT_ID NOT IN ('.$IdIn.')'),
////                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
//        ]);
        $Items = null;
        if ($IdIn != "") {
            $Items = new ActiveDataProvider([
                'query' => \app\models\Items::find()->where(' ITEM_ID NOT IN (' . $IdIn . ') and PRODUCT_ID = ' . $ProductID . ' AND (WEDDING_ID IS NULL OR WEDDING_ID = ' . $WeddingID . ')'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
        } else {
            $Items = new ActiveDataProvider([
                'query' => \app\models\Items::find()->where('PRODUCT_ID = ' . $ProductID . ' AND (WEDDING_ID IS NULL OR WEDDING_ID = ' . $WeddingID . ')'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
        }
        $EventArray = [];
        if ($Items != null) {
            $Items = $Items->getModels();
            if ($Items != null && sizeof($Items) > 0) {
                $i = 0;
                foreach ($Items as $Item) {

                    if ($Item->WEDDING_ID != null && $Item->WEDDING_ID == $WeddingID) {
                        $EventArray[$i]['ITEM_ID'] = $Item->ITEM_ID;
                        $EventArray[$i]['ITEM_NAME'] = $Item->ITEM_VALUE;
                    }if ($Item->WEDDING_ID == null) {
                        $EventArray[$i]['ITEM_ID'] = $Item->ITEM_ID;
                        $EventArray[$i]['ITEM_NAME'] = $Item->itemsTrans != null && sizeof($Item->itemsTrans) > 0 && $Item->itemsTrans[0]->ITEM_NAME != null ? $Item->itemsTrans[0]->ITEM_NAME : "";
                    }
                    $i++;
                }
            }
        }
      



        $Currencies = new ActiveDataProvider([
            'query' => \app\models\Currencies::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        if ($Currencies != null) {
            $Currencies = $Currencies->getModels();
        }
        return $this->renderAjax('_newitemform', [
                    'Items' => $EventArray,
                    'Currencies' => $Currencies,
                    'EstimatedBudget' => $EstimatedBudget,
                    'ProductID'=> $ProductID,
                    'EventID' => $EventID,
//        'EstimatedBudget'=>$EstimatedBudget
        ]);
    }

    public function actionNewEventFrom() {
//    $EstimatedBudget=new \app\models\WedCategoryEstimatedBudget();
        $WeddingEstimatedBudget = new \app\models\WeddingEstimatedBudget();
        $WeddingID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }

        $EventUsed = new ActiveDataProvider([
            'query' => \app\models\WeddingEstimatedBudget::find()->where('WEDDING_ID = ' . $WeddingID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $IdIn = "";
        if ($EventUsed != null) {
            $EventUsed = $EventUsed->getModels();
            $i = 0;
            foreach ($EventUsed as $Event) {
                if ($i == (sizeof($EventUsed) - 1)) {
                    $IdIn = $IdIn . $Event->WEDDING_EVENT_ID;
                } else {
                    $IdIn = $IdIn . $Event->WEDDING_EVENT_ID . ',';
                }
                $i++;
            }
        }
        $WeddingEvent = null;
        if ($IdIn != "") {
            $WeddingEvent = new ActiveDataProvider([
                'query' => \app\models\WeddingEvent::find()->where('WEDDING_ID = ' . $WeddingID . ' OR WEDDING_ID IS NULL AND WEDDING_EVENT_ID NOT IN (' . $IdIn . ')'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
        } else {
            $WeddingEvent = new ActiveDataProvider([
                'query' => \app\models\WeddingEvent::find()->where('(WEDDING_ID = ' . $WeddingID . ' OR WEDDING_ID IS NULL)'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
        }



        $Currencies = new ActiveDataProvider([
            'query' => \app\models\Currencies::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $EventArray = [];
        if ($WeddingEvent != null) {
            $WeddingEvent = $WeddingEvent->getModels();
            if ($WeddingEvent != null && sizeof($WeddingEvent) > 0) {
                $i = 0;
                foreach ($WeddingEvent as $WeddingEven) {

                    if ($WeddingEven->WEDDING_ID != null && $WeddingEven->WEDDING_ID == $WeddingID) {
                        $EventArray[$i]['WEDDING_EVENT_ID'] = $WeddingEven->WEDDING_EVENT_ID;
                        $EventArray[$i]['WEDDING_EVENT_VALUE'] = $WeddingEven->WEDDING_EVENT_VALUE;
                    }if ($WeddingEven->WEDDING_ID == null) {
                        $EventArray[$i]['WEDDING_EVENT_ID'] = $WeddingEven->WEDDING_EVENT_ID;
                        $EventArray[$i]['WEDDING_EVENT_VALUE'] = $WeddingEven->weddingEventTranslations != null && sizeof($WeddingEven->weddingEventTranslations) > 0 && $WeddingEven->weddingEventTranslations[0]->wedding_event_VALUE != null ? $WeddingEven->weddingEventTranslations[0]->wedding_event_VALUE : "";
                    }
                    $i++;
                }
            }
        }
        if ($Currencies != null) {
            $Currencies = $Currencies->getModels();
        }

        return $this->renderAjax('_newevent', [
                    'WeddingEstimatedBudget' => $WeddingEstimatedBudget,
                    'EventArray' => $EventArray,
                    'Currencies' => $Currencies,
//        'EstimatedBudget'=>$EstimatedBudget
        ]);
    }
//new-total-form
    public function actionValidate() {
        $model = new \app\models\WedCategoryEstimatedBudget();
        Yii::error('Validating : ');

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return \yii\bootstrap\ActiveForm::validate($model);
        }
    }

    public function actionSaveCategory() {

        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }


        Yii::error('Saving : ');
        $model = new \app\models\WedCategoryEstimatedBudget();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($model->validate() && $WeddingID != 0) {
                Yii::error('Saving : 1 ');

                Yii::error('Saving : ');
                $model->WEDDING_ID = $WeddingID;
                if ($model->save(false)) {
                    unset($_POST['WedCategoryEstimatedBudget']);
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    $this->actionIndex();
                    return ['success' => true];
                }
            } else {
                if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }
            }
        }
    }

    public function actionSubValidate() {
        $model = new \app\models\WedSubCategoryEstimatedBudget();
        Yii::error('Validating : ');

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }
    public function actionTotalValidation() {
        $model = new \app\models\TotalEstimatedBudget();
        Yii::error('Validating : ');

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }
public function actionSaveTotalBudget() {

        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }


        Yii::error('Saving : ');
        $model = new \app\models\TotalEstimatedBudget();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($model->validate() && $WeddingID != 0) {
                Yii::error('Saving : 1 ');
                Yii::$app->response->format = Response::FORMAT_JSON;
                Yii::error('Saving : ');
                $model->WEDDING_ID = $WeddingID;
                if ($model->save(false)) {
                    $this->actionIndex();
                    return ['success' => true];
                }
            } else {
                if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }
            }
        }
    }
    public function actionSaveSubCategory() {

        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }


        Yii::error('Saving : ');
        $model = new \app\models\WedSubCategoryEstimatedBudget();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($model->validate() && $WeddingID != 0) {
                Yii::error('Saving : 1 ');
                Yii::$app->response->format = Response::FORMAT_JSON;
                Yii::error('Saving : ');
                $model->WEDDING_ID = $WeddingID;
                if ($model->save(false)) {
                    $this->actionIndex();
                    return ['success' => true];
                }
            } else {
                if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }
            }
        }
    }

    public function actionProdValidate() {
        $model = new \app\models\WedProductEstimation();
        Yii::error('Validating : ');

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    public function actionSaveProductEstimation() {

        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }


        Yii::error('Saving : ');
        $model = new \app\models\WedProductEstimation();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($model->validate() && $WeddingID != 0) {
                Yii::error('Saving : 1 ');
                Yii::$app->response->format = Response::FORMAT_JSON;
                Yii::error('Saving : ');
                $model->WEDDING_ID = $WeddingID;
                if ($model->save(false)) {
                    $this->actionIndex();
                    return ['success' => true];
                }
            } else {
                if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }
            }
        }
    }

    public function actionItemValidate() {
        $model = new \app\models\WeddingRealBudget();
        Yii::error('Validating : ');

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    public function actionSaveItemEstimation() {

        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }


        Yii::error('Saving : ');
        $model = new \app\models\WeddingRealBudget();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($model->validate() && $WeddingID != 0) {
                Yii::error('Saving : 1 ');
                Yii::$app->response->format = Response::FORMAT_JSON;
                Yii::error('Saving : ');
                $model->WEDDING_ID = $WeddingID;
                if ($model->save(false)) {
                    $this->actionIndex();
                    return ['success' => true];
                }
            } else {
                if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }
            }
        }
    }

    public function actionEventValidate() {
        $model = new \app\models\WeddingEstimatedBudget();
        Yii::error('Validating : ');

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    public function actionSaveEventEstimation() {

        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }


        Yii::error('Saving : ');
        $model = new \app\models\WeddingEstimatedBudget();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($model->validate() && $WeddingID != 0) {
                Yii::error('Saving : 1 ');
                Yii::$app->response->format = Response::FORMAT_JSON;
                Yii::error('Saving : ');
                $model->WEDDING_ID = $WeddingID;
                if ($model->save(false)) {
                    $this->actionIndex();
                    return ['success' => true];
                }
            } else {
                if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }
            }
        }
    }

    public function getCategoryEstimatedBydgetByEventID($EventID) {
        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        $CategoryEstimatedBudget = new ActiveDataProvider([
            'query' => \app\models\WedCategoryEstimatedBudget::find()->where('WEDDING_ID =' . $WeddingID . ' AND WEDDING_EVENT_ID=' . $EventID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        if ($CategoryEstimatedBudget != null) {
            $CategoryEstimatedBudget = $CategoryEstimatedBudget->getModels();
        }
        return $CategoryEstimatedBudget;
    }

    public function getSubCategoryEstimatedBydgetByEventIDAndCategoryID($EventID, $CategoryID) {
        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        $SubCategoryEstimatedBudget = new ActiveDataProvider([
            'query' => \app\models\WedSubCategoryEstimatedBudget::find()->where('WEDDING_ID =' . $WeddingID . ' AND WEDDING_EVENT_ID=' . $EventID . ' AND CATEGORY_ID = ' . $CategoryID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        if ($SubCategoryEstimatedBudget != null) {
            $SubCategoryEstimatedBudget = $SubCategoryEstimatedBudget->getModels();
        }
        return $SubCategoryEstimatedBudget;
    }

    public function getProductEstimatedBydgetByEventIDAndSubCategoryID($EventID, $SubCategoryID) {
        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        $ProductEstimatedBudget = new ActiveDataProvider([
            'query' => \app\models\WedProductEstimation::find()->where('WEDDING_ID =' . $WeddingID . ' AND WEDDING_EVENT_ID=' . $EventID . ' AND SUB_CATEGORY_ID = ' . $SubCategoryID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        if ($ProductEstimatedBudget != null) {
            $ProductEstimatedBudget = $ProductEstimatedBudget->getModels();
        }
        return $ProductEstimatedBudget;
    }

    public function getItemsEstimatedBydgetByEventIDAndProductID($WeddingEventID, $ProductID) {
        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        $ItemEstimatedBudget = new ActiveDataProvider([
            'query' => \app\models\WeddingRealBudget::find()->where('WEDDING_ID =' . $WeddingID . ' AND WEDDING_EVENT_ID=' . $WeddingEventID . ' AND PRODUCT_ID = ' . $ProductID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        if ($ItemEstimatedBudget != null) {
            $ItemEstimatedBudget = $ItemEstimatedBudget->getModels();
        }
        return $ItemEstimatedBudget;
    }

    public function actionAddNewPrivateProduct() {
        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }

        $Product = new \app\models\Products();
//        ProducValue: ProducValue,
//                    SubCategoryID : $SubCategoryID ,

        $data = Yii::$app->request->post();

        $ProducValue = $data['ProducValue'];
        $SubCategoryID = $data['SubCategoryID'];
        if ($ProducValue != "") {
            $Product->WEDDING_ID = $WeddingID;
            $Product->PRODUCT_NAME = $ProducValue;
            $Product->SUB_CATEGORY_ID = $SubCategoryID;
            $save = $Product->save(false);
            if ($save) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                $primaryKey = $Product->getPrimaryKey();
                return ['response' => '<option selected value="' . $primaryKey . '">' . $ProducValue . '</option>'];
            }
        }
    }
public function actionAddNewPrivateItem(){
    $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }

        $Items = new \app\models\Items();
//ItemValue: ItemValue,
//                    ProductID : $ProductID 

        $data = Yii::$app->request->post();

        $ItemValue = $data['ItemValue'];
        $ProductID = $data['ProductID'];
        if ($ItemValue != "") {
            $Items->WEDDING_ID = $WeddingID;
            $Items->ITEM_VALUE = $ItemValue;
            $Items->PRODUCT_ID = $ProductID;
            $save = $Items->save(false);
            if ($save) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                $primaryKey = $Items->getPrimaryKey();
                return ['response' => '<option selected value="' . $primaryKey . '">' . $ItemValue . '</option>'];
            }
        }
}
    public function actionAddNewPrivateSubCategory() {
//       SubValue: SubValue,
//                    CategoryID : $CategoryID 

        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }

        $SubCategory = new \app\models\SubCategoriesOfItems();
//        ProducValue: ProducValue,
//                    SubCategoryID : $SubCategoryID ,

        $data = Yii::$app->request->post();

        $SubValue = $data['SubValue'];
        $CategoryID = $data['CategoryID'];
        if ($SubValue != "") {
            $SubCategory->WEDDING_ID = $WeddingID;
            $SubCategory->SUB_CATEGORY_VALUE = $SubValue;
            $SubCategory->CATEGORY_OF_ITEM_ID = $CategoryID;
            $save = $SubCategory->save(false);
            if ($save) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                $primaryKey = $SubCategory->getPrimaryKey();
                return ['response' => '<option selected value="' . $primaryKey . '">' . $SubValue . '</option>'];
            }
        }
    }

    public function actionAddNewPrivateCategory() {
        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }

        $Category = new \app\models\CategoryOfItems();
//        ProducValue: ProducValue,
//                    SubCategoryID : $SubCategoryID ,

        $data = Yii::$app->request->post();

        $CatValue = $data['CatValue'];

        if ($CatValue != "") {
            $Category->WEDDING_ID = $WeddingID;
            $Category->CATEGORY_VALUE = $CatValue;

            $save = $Category->save(false);
            if ($save) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                $primaryKey = $Category->getPrimaryKey();
                return ['response' => '<option selected value="' . $primaryKey . '">' . $CatValue . '</option>'];
            }
        }
    }
public function actionDeleteBudget() {
        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }

        $WeddingRealBudget=new \app\models\WeddingRealBudget();
        $data = Yii::$app->request->post();

        $BudgetID = $data['BudgetID'];
        Yii::error('BudgetID : '.$BudgetID);
//        ProducValue: ProducValue,
//                    SubCategoryID : $SubCategoryID ,
        $findOne = $WeddingRealBudget->findOne(['WEDDING_ID' => $WeddingID,'BUDGET_ID' => $BudgetID]);
        if($findOne!=null){
            $deleteAll = $WeddingRealBudget->deleteAll('BUDGET_ID = '.$BudgetID);
            Yii::error('deleteAll : '.$deleteAll);
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($deleteAll==1){
                 return ['response' => 'true'];
            }else{
                return ['response' => 'false']; 
            }
        }

        
    }
    public function actionSaveTotalEstimatedBudget() {

        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }

        if($WeddingID!=0){
        Yii::error('Saving : ');
        
        $EstimatedValueExist= \app\models\TotalEstimatedBudget::find()->where('WEDDING_ID = '.$WeddingID)->one();
        if($EstimatedValueExist!=null){
           $data = Yii::$app->request->post();

        $BudgetValue= $data['BudgetValue'];
            
                $EstimatedValueExist->TOTAL_ESTIMATEG_BUDGET_VALUE=$BudgetValue;
                
                if ($EstimatedValueExist->save(false)) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ['success' => true];
                
                } 
        }else{
            $model = new \app\models\TotalEstimatedBudget();
            $data = Yii::$app->request->post();

        $BudgetValue= $data['BudgetValue'];
            
                $model->TOTAL_ESTIMATEG_BUDGET_VALUE=$BudgetValue;
                $model->CURRENCY_ID=2;
                $model->WEDDING_ID = $WeddingID;
                if ($model->save(false)) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ['success' => true];
                
                }
        }
       
                }
             
    }
    
}
