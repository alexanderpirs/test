<?php

namespace app\controllers;
use Yii;
use app\models\AgendaPeriodes;
use \app\models\WeddingTentativePeriodes;
use yii\data\ActiveDataProvider;
use app\models\WeddingEvent;
use app\models\CategoryOfItems;
class RegistryController extends \yii\web\Controller
{
        public function actionIndex()
    {
        $CouplePartnerID = 0;
        $WeddingID = 0;

        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }

        
Yii::error("Index Controller ");

//        $weddings $weddings0
        $WeddingModel = new \app\models\Weddings();
       
if(Yii::$app->user->identity!=null &&  Yii::$app->user->identity->weddings0!=null && sizeof(Yii::$app->user->identity->weddings0)>0){
 $WeddingID=  Yii::$app->user->identity->weddings0[0]->WEDDING_ID; 
}else if( Yii::$app->user->identity!=null && Yii::$app->user->identity->weddings!=null && sizeof(Yii::$app->user->identity->weddings)>0){
 $WeddingID=  Yii::$app->user->identity->weddings[0]->WEDDING_ID;    
}
//        $TransModel=  \app\models\AgendaPeriodeTranslation();
//        $TransModel->
        $CouplePartnerModel = new \app\models\CouplePartner();
        $WeddingEvents = new \app\models\WeddingEvent();
        $WeddingTentativePeriods = new \app\models\WeddingTentativePeriodes();
        
        $CategoryOfItems=new CategoryOfItems();
        $CategoryOfItemsDataProvider = new ActiveDataProvider([
            'query' => CategoryOfItems::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $WeddingEventDataProvider = new ActiveDataProvider([
            'query' => WeddingEvent::find()->where("WEDDING_ID =  " . $WeddingID . " OR WEDDING_ID IS NULL ORDER BY EVENT_SEQUENCE_NUMBER ASC "),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $dataProvider1 = new ActiveDataProvider([
            'query' => WeddingTentativePeriodes::find()->where('WEDDING_ID ='.$WeddingID .' '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => AgendaPeriodes::find()->orderBy(['SEQUENCE_NUMBER' => SORT_ASC]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        
        
        
                              $models = $dataProvider->getModels();
                              $WeddingPeriodsmodels = $dataProvider1->getModels();
                                $MaxEventID="0";
                                $MaxDate = "";
                                $AgendaPeriodsToUse = null;
                                foreach ($models as $AgendaPeriods) {
                                    if (sizeof($WeddingPeriodsmodels) > 0) {
                                        foreach ($WeddingPeriodsmodels as $WeddingDatee) {
                                            if($WeddingDatee->IN_USE_OR_NO=='Y'){
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
                                                $MaxEventID=$WeddingDatee->wEDDINGEVENT->weddingEventTranslations[0]->wedding_event_id;
                                                
                                            }
                                        }
                                    }
                                    }
                                }
        $dataProviderForWeddingDate1 = new ActiveDataProvider([
            'query' => WeddingTentativePeriodes::find()->where('WEDDING_ID ='.$WeddingID .' AND WEDDING_EVENT_ID='.$MaxEventID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'dataProvider1' => $dataProvider1,
                    'CategoryOfItems' => $CategoryOfItems,
                    'CategoryOfItemsDataProvider' => $CategoryOfItemsDataProvider,
                    'WeddingEvents' => $WeddingEvents,
                    'WeddingTentativePeriods' => $WeddingTentativePeriods,
                    'WeddingEventDataProvider' => $WeddingEventDataProvider,
                    'dataProviderForWeddingDate1' => $dataProviderForWeddingDate1,
                    'CouplePartnerModel' => $CouplePartnerModel,
//            'dataProvider1' => $dataProvider1,
        ]);
    }

}
