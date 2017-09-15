<?php

namespace app\controllers;
    use Yii;
use app\models\AgendaPeriodes;
//use \app\models\AgendaPeriodeTranslation;
use \app\models\WeddingTentativePeriodes;
use app\models\WeddingAgendaTasks;
use \app\models\WeddingEvent;
use yii\web\Response;
use yii\helpers\Json;
//use yii\
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\widgets\ActiveForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \app\models\AgendaNote;
use yii\filters\AccessControl;
class VenuesController extends \yii\web\Controller
{
    public function actionIndex()
    {
       $CouplePartnerID = 0;
        $WeddingID = 0;
//        $EventID=2;
        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }


        Yii::error("Index Controller ");

//        $weddings $weddings0
        $WeddingModel = new \app\models\Weddings();

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

        $dataProvider = new ActiveDataProvider([
            'query' => AgendaPeriodes::find()->orderBy(['SEQUENCE_NUMBER' => SORT_ASC]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        $dataProvider1 = null;
        $MaxDateModels = null;
        if ($WeddingID != 0) {
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
//        ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->where('agenda_periode_translation.LANGUAGE_ID=2' )->all()
//        $dataProvider1 = new ActiveDataProvider([
//            'query' => AgendaPeriodeTranslation::find(), 
////                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
//        ]);
//        $query=AgendaPeriodes::find()->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->where(['=','agenda_periode_translation.LANGUAGE_ID', 2]);
//        print_r($query->createCommand()->getRawSql()) ;
//$AgendaPeriodsModel=new \app\models\AgendaPeriodes();
//        $AgendaPeriods=new \app\models\Agenda();
        
        $WeddingTotalEstimatedDataProvider = new ActiveDataProvider([
            'query' => \app\models\TotalEstimatedBudget::find()->where("WEDDING_ID =  " . $WeddingID . ""),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        if($WeddingTotalEstimatedDataProvider!=null){
            $WeddingTotalEstimatedDataProvider=$WeddingTotalEstimatedDataProvider->getModels();
        }
        $WeddingEstimatedDataProvider = new ActiveDataProvider([
            'query' => \app\models\WeddingEstimatedBudget::find()->where("WEDDING_ID =  " . $WeddingID . ""),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        if($WeddingEstimatedDataProvider!=null){
            $WeddingEstimatedDataProvider=$WeddingEstimatedDataProvider->getModels();
        }
        $dataCountry = new ActiveDataProvider([
            'query' => \app\models\CountriesTrans::find()->select(['countries_trans.COUNTRY_ID', 'countries_trans.COUNTRY_TRANS_NAME'])->where(' LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        if($dataCountry!=null){
            $dataCountry=$dataCountry->getModels();
        }
     

       $VenueQuotationModel = new \app\models\VenusQuotation();
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'dataProvider1' => $dataProvider1,
                    
                    'WeddingEvents' => $WeddingEvents,
                    'WeddingTentativePeriods' => $WeddingTentativePeriods,
                    'WeddingEventDataProvider' => $WeddingEventDataProvider,
                    'dataProviderForWeddingDate1' => $dataProviderForWeddingDate1,
                    'AgendaPeriodsModel' => $AgendaPeriodsModel,
                    
                    'CountryModel'=>$dataCountry,
                    'CouplePartnerModel' => $CouplePartnerModel,
                    'MaxDateModels' => $MaxDateModels != null && sizeof($MaxDateModels) > 0 ? $MaxDateModels[0] : null,
                    'TotalPoints'=>$TotalPoints,
                    'VenueQuotationModel'=>$VenueQuotationModel,
                    
//            'dataProvider1' => $dataProvider1,
        ]); 
        
         

    }

}
