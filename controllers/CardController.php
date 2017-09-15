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
class CardController extends \yii\web\Controller
{
    
    
    public function actionDesign()
    {
        

        $WeddingID = 0;
        $CouplePartnerID = 0;
        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        $CorePartModel=new \app\models\CorePage();
        $dataCorePart = new ActiveDataProvider([
            'query' => \app\models\CorePage::find()->where(' WEDDING_ID = '.$WeddingID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        if($dataCorePart!=null){
            $dataCorePart=$dataCorePart->getModels();
        }
        $dataSupplierType = new ActiveDataProvider([
            'query' => \app\models\SuplierTypeTrans::find()->select(['suplier_type_trans.SUPLIER_TYPE_ID', 'suplier_type_trans.SUPLIER_TYPE_NAME'])->where(' LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        $dataSupplier = new ActiveDataProvider([
            'query' => Suppliers::find()->where('COUNTRY_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        Yii::error("Index Controller ");

        

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
        
        $dataProviderForInviteeTitle = new ActiveDataProvider([
            'query' => \app\models\InviteeTitleTrans::find()->select('invitee_title_trans.INVITEE_TITLE_ID,invitee_title_trans.INVITEE_TITLE_TRANS')->where('LANGUAGE_ID = 1'),
        ]);
         if($dataProviderForInviteeTitle!=null){
             $dataProviderForInviteeTitle=$dataProviderForInviteeTitle->getModels();
         }
         
         $dataProviderCorePageWords = new ActiveDataProvider([
            'query' => \app\models\CorePageWords::find()->select('CORE_PAGE_WORDS_ID,CORE_PAGE_WORD_VALUE')->where(' WEDDING_ID = '.$WeddingID.' OR WEDDING_ID IS NULL'),
        ]);
         if($dataProviderCorePageWords!=null){
             $dataProviderCorePageWords=$dataProviderCorePageWords->getModels();
         }
        $WeddingModel = new \app\models\Weddings();
        $Supplier = new \app\models\Suppliers();
        
        return $this->render('design', [
                    'dataProvider' => $dataProvider,
                    'dataProvider1' => $dataProvider1,
                    'WeddingEvents' => $WeddingEvents,
                    'WeddingTentativePeriods' => $WeddingTentativePeriods,
                    'WeddingEventDataProvider' => $WeddingEventDataProvider,
                    'dataProviderForWeddingDate1' => $dataProviderForWeddingDate1,
                    'CouplePartnerModel' => $CouplePartnerModel,
                    'dataCorePart'=>$dataCorePart,
                    'dataSupplierType' => $dataSupplierType,
                    'dataSupplier' => $dataSupplier,
                    'dataCity' => $dataCity,
                    'Supplier' => $Supplier,
                    'WeddingModel' => $WeddingModel,
                    'CorePartModel'=>$CorePartModel,
                    'dataProviderForInviteeTitle'=>$dataProviderForInviteeTitle,
                    'dataProviderCorePageWords'=>$dataProviderCorePageWords,
//            'dataProvider1' => $dataProvider1,
        ]);
 
    }
    public function actionIndex()
    {
      
      

        $CouplePartnerID = 0;
        $WeddingID = 0;

        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }

       

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
//                    'dataProviderItems' => $dataProviderItems,
                    'dataSupplierType' => $dataSupplierType,
                    'dataSupplier' => $dataSupplier,
                    'dataCity' => $dataCity,
                    'Supplier' => $Supplier,
                    'WeddingModel' => $WeddingModel,
//            'dataProvider1' => $dataProvider1,
        ]);
 
    }
    public function actionSaveCorePage() {


        $CorePageModel = new \app\models\CorePage();
        
//       $actionperformAjaxValidation = $this->actionperformAjaxValidation($CouplePartnerModel);

        Yii::error("testtttttttttttadasdsa ");
        $CouplePartnerID = 0;
        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }
        $WeddingID=0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }

      
//        if($CouplePartnerModel===null)
//        {
//            $profile=new Profile;
//            $profile->user_id = Yii::app()->user->id;
//        }else{
//            
//        }
//        && $profile->load(Yii::$app->request->post())
          $CorePageModel = \app\models\CorePage::find()->where('WEDDING_ID = '.$WeddingID)->one();
        
        if ($WeddingID != 0 && isset($_FILES['CorePage'])) {
            $imagetypes = array(
                'image/png' => '.png',
                'image/gif' => '.gif',
                'image/jpeg' => '.jpg',
                'image/bmp' => '.bmp');
            $ext = $imagetypes[$_FILES['CorePage']['type']['imageFile']];
            
            $tmpImg = $_FILES['CorePage']['tmp_name']['imageFile'];
            $SizeofImg = $_FILES['CorePage']['size']['imageFile'];
            if (!is_dir('uploads/CorePageLogos' . $WeddingID)) {
                mkdir('uploads/CorePageLogos' . $WeddingID, 0777, true);
            }
            $RandN=rand();
//        /PartnerImg'.$SizeofImg.rand()
            if (move_uploaded_file($tmpImg, 'uploads/CorePageLogos' . $WeddingID. '/CorePageLogonImg' . $SizeofImg .$RandN . $ext)) {

                if ($CorePageModel != null) {
                    $CorePageModel->LOGO_PATH = 'uploads/CorePageLogos' . $WeddingID. '/CorePageLogonImg' . $SizeofImg .$RandN . $ext;
                    $CorePageModel->save(false);
                    
                } else {
                   $CorePageModel = new \app\models\CorePage();
                   $CorePageModel->LOGO_PATH = 'uploads/CorePageLogos' . $WeddingID. '/CorePageLogonImg' . $SizeofImg .$RandN . $ext;
                   $CorePageModel->WEDDING_ID=$WeddingID; 
                   $CorePageModel->save(false);
                }
            }
        } 
        $CorePageModel = \app\models\CorePage::find()->where('WEDDING_ID = '.$WeddingID)->one();
        if ($CorePageModel != null) {
            Yii::error("testtttttttttttadasdsa 1");
            if ($CorePageModel->load(Yii::$app->request->post()) && $CorePageModel->validate()) {
                $timestamp = strtotime($CorePageModel->DATE_TIME);
                $date = date("Y-m-d H:i", $timestamp);
                $CorePageModel->DATE_TIME=$date;
                $timestamp1 = strtotime($CorePageModel->RESPONSE_DATE);
                $date1 = date("Y-m-d H:i", $timestamp1);
                $CorePageModel->RESPONSE_DATE=$date1;
                $CorePageModel->WEDDING_ID=$WeddingID;
                $CorePageModel->save(false);  
               return $this->redirect(['card/design']);
                }else {
                    // validation failed: $errors is an array containing error messages
                    $errors = $CorePageModel->errors;
                }
            }
         else {
           $CorePageModel=new \app\models\CorePage();
           if ($CorePageModel->load(Yii::$app->request->post()) && $CorePageModel->validate()) {
               $timestamp = strtotime($CorePageModel->DATE_TIME);
                $date = date("Y-m-d H:i:s", $timestamp);
                $CorePageModel->DATE_TIME=$date;
                $timestamp1 = strtotime($CorePageModel->RESPONSE_DATE);
                $date1 = date("Y-m-d H:i:s", $timestamp1);
                $CorePageModel->RESPONSE_DATE=$date1;
                $CorePageModel->WEDDING_ID=$WeddingID;
                $CorePageModel->save(false);  
               return $this->redirect(['card/design']);
                }else {
                    // validation failed: $errors is an array containing error messages
                    $errors = $CorePageModel->errors;
                }
        }
//   $this->re
//
    }
}
