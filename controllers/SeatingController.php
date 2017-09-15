<?php

namespace app\controllers;
use Yii;
use app\models\AgendaPeriodes;
use \app\models\WeddingTentativePeriodes;
use yii\data\ActiveDataProvider;
use app\models\WeddingEvent;
use yii\web\Response;
use \app\models\Items;
use \app\models\Suppliers;
use \app\models\Products;
use \app\models\CategoryOfItems;
class SeatingController extends \yii\web\Controller
{
    public function actionIndex()
    {
  $productID = 0;
        if (Yii::$app->request != null && Yii::$app->request->get('productID') != null) {
            $productID = Yii::$app->request->get('productID');
        }

        Yii::error("Index Controller productID : " . $productID);

        $CouplePartnerID = 0;
        $WeddingID = 0;

        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }

        $dataProviderItems = new ActiveDataProvider([
            'query' => Items::find()->where(['PRODUCT_ID' => $productID]),
        ]);

        $dataSupplierType = new ActiveDataProvider([
            'query' => \app\models\SuplierTypeTrans::find()->select(['suplier_type_trans.SUPLIER_TYPE_ID', 'suplier_type_trans.SUPLIER_TYPE_NAME'])->where(' LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        $dataSupplier = new ActiveDataProvider([
            'query' => Suppliers::find()->where('COUNTRY_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        Yii::error("Index Controller ");

//        $weddings $weddings0
//        $WeddingModel = new \app\models\Weddings();

        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
         if (Yii::$app->user->identity == null){
           $WeddingID=1; 
        }
//        $TransModel=  \app\models\AgendaPeriodeTranslation();
//        $TransModel->
        $CouplePartnerModel = new \app\models\CouplePartner();
        $WeddingEvents = new \app\models\WeddingEvent();
        $WeddingTentativePeriods = new \app\models\WeddingTentativePeriodes();


        $WeddingEventDataProvider = new ActiveDataProvider([
            'query' => WeddingEvent::find()->where("WEDDING_ID =  " . $WeddingID . " OR WEDDING_ID IS NULL ORDER BY EVENT_SEQUENCE_NUMBER ASC "),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $dataProvider1 = new ActiveDataProvider([
            'query' => WeddingTentativePeriodes::find()->where('WEDDING_ID =' . $WeddingID . ' '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => AgendaPeriodes::find()->orderBy(['SEQUENCE_NUMBER' => SORT_ASC]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);



        $models = $dataProvider->getModels();
        $WeddingPeriodsmodels = $dataProvider1->getModels();
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
        $dataCity = new ActiveDataProvider([
            'query' => \app\models\CitiesTranslation::findBySql('select t.CITY_ID, t.CITY_TRANSLATION from cities inner join cities_translation t on cities.CITY_ID=t.CITY_ID where cities.COUNTRY_ID = 1 AND t.LANGUAGE_ID=1 '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $WeddingModel = new \app\models\Weddings();
        $Supplier = new \app\models\Suppliers();
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'dataProvider1' => $dataProvider1,
                    'WeddingEvents' => $WeddingEvents,
                    'WeddingTentativePeriods' => $WeddingTentativePeriods,
                    'WeddingEventDataProvider' => $WeddingEventDataProvider,
                    'dataProviderForWeddingDate1' => $dataProviderForWeddingDate1,
                    'CouplePartnerModel' => $CouplePartnerModel,
                    'dataProviderItems' => $dataProviderItems,
                    'dataSupplierType' => $dataSupplierType,
                    'dataSupplier' => $dataSupplier,
                    'dataCity' => $dataCity,
                    'Supplier' => $Supplier,
                    'WeddingModel' => $WeddingModel,
//            'dataProvider1' => $dataProvider1,
        ]);
    }
public function actionSeats()
    {
  $productID = 0;
        if (Yii::$app->request != null && Yii::$app->request->get('productID') != null) {
            $productID = Yii::$app->request->get('productID');
        }

        Yii::error("Index Controller productID : " . $productID);

        $CouplePartnerID = 0;
        $WeddingID = 0;

        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }

        $dataProviderItems = new ActiveDataProvider([
            'query' => Items::find()->where(['PRODUCT_ID' => $productID]),
        ]);

        $dataSupplierType = new ActiveDataProvider([
            'query' => \app\models\SuplierTypeTrans::find()->select(['suplier_type_trans.SUPLIER_TYPE_ID', 'suplier_type_trans.SUPLIER_TYPE_NAME'])->where(' LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        $dataSupplier = new ActiveDataProvider([
            'query' => Suppliers::find()->where('COUNTRY_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        Yii::error("Index Controller ");

//        $weddings $weddings0
//        $WeddingModel = new \app\models\Weddings();

        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
         if (Yii::$app->user->identity == null){
           $WeddingID=1; 
        }
//        $TransModel=  \app\models\AgendaPeriodeTranslation();
//        $TransModel->
        $CouplePartnerModel = new \app\models\CouplePartner();
        $WeddingEvents = new \app\models\WeddingEvent();
        $WeddingTentativePeriods = new \app\models\WeddingTentativePeriodes();


        $WeddingEventDataProvider = new ActiveDataProvider([
            'query' => WeddingEvent::find()->where("WEDDING_ID =  " . $WeddingID . " OR WEDDING_ID IS NULL ORDER BY EVENT_SEQUENCE_NUMBER ASC "),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $dataProvider1 = new ActiveDataProvider([
            'query' => WeddingTentativePeriodes::find()->where('WEDDING_ID =' . $WeddingID . ' '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => AgendaPeriodes::find()->orderBy(['SEQUENCE_NUMBER' => SORT_ASC]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);



        $models = $dataProvider->getModels();
        $WeddingPeriodsmodels = $dataProvider1->getModels();
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
        $dataCity = new ActiveDataProvider([
            'query' => \app\models\CitiesTranslation::findBySql('select t.CITY_ID, t.CITY_TRANSLATION from cities inner join cities_translation t on cities.CITY_ID=t.CITY_ID where cities.COUNTRY_ID = 1 AND t.LANGUAGE_ID=1 '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $WeddingModel = new \app\models\Weddings();
        $Supplier = new \app\models\Suppliers();
        return $this->render('seats', [
                    'dataProvider' => $dataProvider,
                    'dataProvider1' => $dataProvider1,
                    'WeddingEvents' => $WeddingEvents,
                    'WeddingTentativePeriods' => $WeddingTentativePeriods,
                    'WeddingEventDataProvider' => $WeddingEventDataProvider,
                    'dataProviderForWeddingDate1' => $dataProviderForWeddingDate1,
                    'CouplePartnerModel' => $CouplePartnerModel,
                    'dataProviderItems' => $dataProviderItems,
                    'dataSupplierType' => $dataSupplierType,
                    'dataSupplier' => $dataSupplier,
                    'dataCity' => $dataCity,
                    'Supplier' => $Supplier,
                    'WeddingModel' => $WeddingModel,
//            'dataProvider1' => $dataProvider1,
        ]);
    }
}
