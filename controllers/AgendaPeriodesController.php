<?php

namespace app\controllers;

use \DateTime;

ini_set('display_errors', 1);

//$errorPath = ini_get('error_log');
//echo $errorPath;
// phpinfo();
error_reporting(E_ALL);

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

/**
 * AgendaPeriodesController implements the CRUD actions for AgendaPeriodes model.
 */
class AgendaPeriodesController extends Controller {

    /**
     * @inheritdoc
     */
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
                        'actions' => ['index','plan', 'get-suppliers','validate', 'live', 'saveweddingprivatetask', 'deleteweddingevent', 'saveweddingevent', 'savetasknote', 'saveweddingtask', 'validatenote', 'updateprivatetask', 'deleteprivatetask'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','plan', 'get-suppliers'],
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all AgendaPeriodes models.
     * @return mixed
     */
    public function actionIndex() {

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
                    'TotalPoints'=>$TotalPoints,
                    'WeddingTotalEstimatedDataProvider'=>$WeddingTotalEstimatedDataProvider,
                    'WeddingEstimatedDataProviderModels'=>$WeddingEstimatedDataProvider,
//            'dataProvider1' => $dataProvider1,
        ]);
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
    public function actionPlan() {

        $CouplePartnerID = 0;
        $WeddingID = 0;

        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }

        Yii::error("Index Controller ");

        $WeddingModel = new \app\models\Weddings();

        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }

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
        ]);
        $WeddingModel = new \app\models\Weddings();

        return $this->renderAjax('TestComponent', [
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
                    'WeddingID'=>$WeddingID,
//            'dataProvider1' => $dataProvider1,
        ]);
    }

    public function actionLive() {

        $CouplePartnerID = 0;
        $WeddingID = 0;
//        $EventID=2;
        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }
//        $EventIDS="";
//        if(Yii::$app->request->post()!=null){
//            $EventCheckedOrNo = Yii::$app->request->post('EventCheckedOrNo');
//            $AllEventID=Yii::$app->request->post('AllEventID');
//            Yii::error('EventCheckedOrNo : '. implode(" ", $EventCheckedOrNo));
//            Yii::error('AllEventID : '.print_r($AllEventID));
//            $k=0;
//            for($k=0;$k<sizeof($EventCheckedOrNo);$k++){
//                if($EventCheckedOrNo[$k]=='Y'){
//                 $EventIDS=$EventIDS.$AllEventID[$k].',';    
//                }
//               
//            }
////            $EventCheckedOrNo=
//        }


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
        return $this->render('live', [
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
//            'dataProvider1' => $dataProvider1,
        ]);
    }

    /**
     * Displays a single AgendaPeriodes model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AgendaPeriodes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new AgendaPeriodes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->AGENDA_PERIODE_ID]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    public function getWeddingTasks($fromdate, $todate) {
        $Queryy = "";
//            if($todate==0){
//              $Queryy='FROM_PERIOD <'.$fromdate;  
//            }else{
//             $Queryy='FROM_PERIOD <'.$fromdate.' AND TO_PERIOD > '.$todate;   
//            }
        if ($todate == 0 && $fromdate > 0) {
            $Queryy = 'FROM_PERIOD <' . $fromdate;
        } else if ($todate > 0 && $fromdate > 0) {
            $Queryy = 'FROM_PERIOD <' . $fromdate . ' AND TO_PERIOD > ' . $todate;
        } else if ($fromdate == 0 && $todate == 0) {
            $Queryy = 'FROM_PERIOD > 0';
        }
        $WeddingEventDataProvider = new ActiveDataProvider([
            'query' => AgendaPeriodes::find()->where($Queryy),
        ]);
        return $WeddingEventDataProvider;
    }

    /**
     * Updates an existing AgendaPeriodes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
//        this->
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->AGENDA_PERIODE_ID]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AgendaPeriodes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
//    public function actionDelete($id)
//    {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }

    /**
     * Finds the AgendaPeriodes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AgendaPeriodes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = AgendaPeriodes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionValidate() {
        $model = new WeddingAgendaTasks();
        $request = \Yii::$app->getRequest();
        echo Yii::trace(CVarDumper::dumpAsString($request->post()), 'vardump');
//    echo print_r($request->getBodyParams(),true);
        if ($request->isPost && $model->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
//        $model->attributes=$_POST['']
//        echo 'testttt';
        }
    }

    public function actionValidatenote() {
        $model = new AgendaNote();
        $request = \Yii::$app->getRequest();
//    echo Yii::trace(CVarDumper::dumpAsString($request->post()),'vardump');
//    echo print_r($request->getBodyParams(),true);
        if ($request->isPost && $model->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
//        $model->attributes=$_POST['']
//        echo 'testttt';
        }
    }

    public function actionSaveweddingtask() {
        $model = new WeddingAgendaTasks();
        $request = Yii::$app->getRequest();
        Yii::error("testtttttttttttadasdsa honnn ");
        $CouplePartnerID = 0;
        $FirstName = "";
        $LastName = "";
        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
            $FirstName = Yii::$app->user->identity->COUPLE_PARTNER_FIRST_NAME != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_FIRST_NAME : "";
            $LastName = Yii::$app->user->identity->COUPLE_PARTNER_LAST_NAME != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_LAST_NAME : "";
        }
        if ($request->isAjax) {
            Yii::error("testtttttttttttadasdsa honnn 1");
            $request->post();
            Yii::$app->response->format = Response::FORMAT_JSON;
//            
            Yii::error("testtttttttttttadasdsa " . json_encode($_POST['WeddingAgendaTasks']['AGENDA_TASKS_ID']));
            Yii::error("testtttttttttttadasdsa " . json_encode($_POST['WeddingAgendaTasks']['WEDDING_AGENDA_TASK_ID_CHECKED']));
//name="WeddingAgendaTasks[WEDDING_AGENDA_TASK_ID][]"
            $AgendaTaskIDs = $_POST['WeddingAgendaTasks']['AGENDA_TASKS_ID'];
            $WeddingAgendaTaskIDs = $_POST['WeddingAgendaTasks']['WEDDING_AGENDA_TASK_ID'];
            $WeddingTaskCheckedOrNo = $_POST['WeddingAgendaTasks']['WEDDING_AGENDA_TASK_ID_CHECKED'];
            $CliedDate = $_POST['CurrentTime'];
            $newformat = null;
            if ($CliedDate != null && $CliedDate != "") {
                $time = strtotime($CliedDate);

                $newformat = date('Y-m-d H:i:s', $time);
            }
            if (sizeof($AgendaTaskIDs) > 0) {
                $i = 0;
                for ($i = 0; $i < sizeof($AgendaTaskIDs); $i++) {
                    Yii::error("AgendaTaskIDs " . $AgendaTaskIDs[$i]);
//          WeddingAgendaTasks::
//          $model = WeddingAgendaTasks::;
                    $findOne = new WeddingAgendaTasks();
                    Yii::error("WeddingAgendaTaskIDs[] : " . $WeddingAgendaTaskIDs[$i]);
                    $findOne = $findOne->findOne($WeddingAgendaTaskIDs[$i]);

                    if ($findOne != null) {
                        $findOne->POSTING_DATE = $newformat;
                        $findOne->POSTED_BY = $CouplePartnerID;
                        $findOne->AGENDA_TASKS_ID = $AgendaTaskIDs[$i];
                        $findOne->WEDDING_ID = 1;
                    } else {
                        $findOne = new WeddingAgendaTasks();
                        $findOne->POSTING_DATE = $newformat;
                        $findOne->POSTED_BY = $CouplePartnerID;
                        $findOne->AGENDA_TASKS_ID = $AgendaTaskIDs[$i];
                        $findOne->WEDDING_ID = 1;
                    }
                    if ($WeddingTaskCheckedOrNo[$i] == 'false') {

                        $findOne = $findOne->findOne($WeddingAgendaTaskIDs[$i]);
                        if ($findOne != null) {
                            $findOne->delete();
                        }
                    } else {
                        if ($findOne->save(false)) {
                            Yii::error("Addeddd...");
                        } else {
                            Yii::error("model " . var_dump($model));
                            exit;
                        }
                    }
//          $model->setAttribute('AGENDA_TASKS_ID', $AgendaTaskIDs[$i]);
//          $model->setAttribute('WEDDING_ID', 1);
                }
//          $i++;
            }

            $this->actionIndex();

            return ['success' => '(Change by : ' . $FirstName . ' ' . $LastName . ' on ' . $CliedDate . ')'];
        }
        Yii::error("testtttttttttttadasdsa honnn 2");
        $this->actionIndex();
        return ['success' => 'failed'];

//        return $this->renderAjax('index', [
//                    'model' => $model,
//        ]);
    }

    public function actionSavetasknote() {

//    ['doctor' => $id, 'room_category' => $this->room_name]
//        TaskID: TaskID,
//                    NoteValue : NoteValue
//        if ($model->load(Yii::$app->request->post())) {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $NoteValue = $data['NoteValue'];
            $TaskID = $data['TaskID'];
            $AgendaNote = new AgendaNote();
            $CouplePartnerID = 0;
//        $WeddingID = 0;
            if (Yii::$app->user->identity != null) {
                $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
            }
            if ($CouplePartnerID != 0) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                AgendaNote::deleteAll(['TASK_ID' => $TaskID, 'COUPLE_PARTNER_ID' => $CouplePartnerID]);
                $AgendaNote->TASK_ID = $TaskID;
                $AgendaNote->COUPLE_PARTNER_ID = $CouplePartnerID;
                $AgendaNote->NOTE = $NoteValue;
                if ($AgendaNote->save(false)) {
                    return ['success' => 'Submit Successfuly'];
                } else {
                    return ['success' => 'Error'];
                }

//        && $model->save()
            }
        }
    }

//saveweddingtask
    public function actionSaveweddingevent() {

        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
//    array('imageFile')
        $weddingEvent = new \app\models\WeddingEvent();
        $weddingEvent = $weddingEvent->find()->orderBy("EVENT_SEQUENCE_NUMBER DESC")->one();
        $MAxSequnec = $weddingEvent->EVENT_SEQUENCE_NUMBER;
        $WeddingTentativePeriods = new \app\models\WeddingTentativePeriodes();
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->getRequest();
        Yii::error("ana honnn  : " . $MAxSequnec);
//    ['doctor' => $id, 'room_category' => $this->room_name]
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            Yii::error("ana honnn1  : " . json_encode($data));
            $wedding_event_value = explode(":", $data['wedding_event_value']);
            $wedding_event_value = $wedding_event_value[0];
            $EventID = explode(":", $data['EventID']);
            $EventID = $EventID[0];
            $WeddingIDD = explode(":", $data['WeddingID']);
            $WeddingIDD = $WeddingIDD[0];
            $FromDate = '';
            $to_date = explode(":", $data['to_date']);
            $to_date = $to_date[0];
            if ($to_date != '') {
                $explode0 = explode(" -> ", $to_date);
                if ($explode0 != null && sizeof($explode0) == 2) {
                    $to_date = $explode0[1];
                    $FromDate = $explode0[0];
                }
            }
            $CheckedOrNo = explode(":", $data['CheckedOrNo']);
            $CheckedOrNo = $CheckedOrNo[0];
            Yii::error("EventID..........1 : " . $EventID);
            if ($EventID != "0") {
                Yii::error("EventID..........66 : " . $EventID);
                $weddingEvent = $weddingEvent->findOne(['WEDDING_EVENT_ID' => $EventID]);
            } else {
                $weddingEvent = null;
            }
            if ($weddingEvent != null) {
                Yii::error("EventID.......... :2 " . $EventID);
                if ($wedding_event_value != "") {
                    if ($weddingEvent->PUBLIC_PRIVATE == "V") {
                        $weddingEvent->WEDDING_EVENT_VALUE = $wedding_event_value;
                        if ($WeddingID == $WeddingIDD) {
                            $weddingEvent->WEDDING_ID = $WeddingID;
                        }
                    }
                }

                $save = $weddingEvent->save(false);
            } else {
                Yii::error("EventID.......... 3 " . $EventID);
                $weddingEvent = new \app\models\WeddingEvent();
                $weddingEvent->PUBLIC_PRIVATE = "V";
                $weddingEvent->WEDDING_ID = $WeddingID;
                $weddingEvent->WEDDING_EVENT_VALUE = $wedding_event_value;
                $weddingEvent->EVENT_SEQUENCE_NUMBER = $MAxSequnec + 1;
                $weddingEvent->save(false);
                if ($EventID == "0") {
                    $EventID = $weddingEvent->getPrimaryKey();
                }
            }
            Yii::error("EventID.......... 4 " . $EventID);
            $WeddingTentativePeriods = $WeddingTentativePeriods->findOne(['WEDDING_ID' => $WeddingID, 'WEDDING_EVENT_ID' => $EventID]);
            if ($WeddingTentativePeriods != null) {
                $WeddingTentativePeriods->WEDDING_EVENT_ID = $EventID;
                $WeddingTentativePeriods->TO_DATE = $to_date != "" ? date("Y-m-d", strtotime($to_date)) : "";
                $WeddingTentativePeriods->FROM_DATE = $FromDate != "" ? date("Y-m-d", strtotime($FromDate)) : "";
                $WeddingTentativePeriods->IN_USE_OR_NO = $CheckedOrNo;
                $WeddingTentativePeriods->WEDDING_ID = $WeddingID;
                $WeddingTentativePeriods->save(false);
            } else {
                Yii::error("EventID.......... 44333 " . $EventID);
                $WeddingTentativePeriods = new \app\models\WeddingTentativePeriodes();
                $WeddingTentativePeriods->WEDDING_EVENT_ID = $EventID;
                $WeddingTentativePeriods->TO_DATE = $to_date != "" ? date("Y-m-d", strtotime($to_date)) : "";
                $WeddingTentativePeriods->FROM_DATE = $FromDate != "" ? date("Y-m-d", strtotime($FromDate)) : "";
                $WeddingTentativePeriods->IN_USE_OR_NO = $CheckedOrNo;
                $WeddingTentativePeriods->WEDDING_ID = $WeddingID;

                $WeddingTentativePeriods->save(false);
            }



            $CouplePartnerID = 0;
            $WeddingID = 0;
            if (Yii::$app->user->identity != null) {
                $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
            }

//       
            $this->actionIndex();

            return ['return' => 'Test'];
        }
    }

    public function actionDeleteweddingevent() {

        $WeddingID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
//    array('imageFile')
        $weddingEvent = new \app\models\WeddingEvent();
        $weddingEvent = $weddingEvent->find()->orderBy("EVENT_SEQUENCE_NUMBER DESC")->one();
        $MAxSequnec = $weddingEvent->EVENT_SEQUENCE_NUMBER;
        $WeddingTentativePeriods = new \app\models\WeddingTentativePeriodes();
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->getRequest();
        Yii::error("ana honnn  : " . $MAxSequnec);
//    ['doctor' => $id, 'room_category' => $this->room_name]
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            Yii::error("ana honnn1  : " . json_encode($data));

            $EventID = explode(":", $data['EventID']);
            $EventID = $EventID[0];

            Yii::error("EventID..........1 : " . $EventID);
            if ($EventID != "0" && $WeddingID != "0") {
                Yii::error("EventID..........66 : " . $EventID);
                $weddingEvent = $weddingEvent->findOne(['WEDDING_EVENT_ID' => $EventID, 'WEDDING_ID' => $WeddingID]);
            } else {
                $weddingEvent = null;
            }
            if ($weddingEvent != null) {
//             $findOne = $findOne->findOne($WeddingAgendaTaskIDs[$i]);
                $weddingEvent->delete();
            }


//       
            $this->actionIndex();

            return ['return' => 'Test'];
        }
    }

    public function actionSaveweddingprivatetask() {
        $CouplePartnerID = 0;
        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID;
        }
        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
//    array('imageFile')
        $Agenda = new \app\models\Agenda();

        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->getRequest();
//        'AgendaPeriod=' + AgendaPeriod + '&NewPrivateTask=' + NewPrivateTaskk + '&EventID=' + EventID+'&TaskID='+TaskID 
//    ['doctor' => $id, 'room_category' => $this->room_name]
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            Yii::error("ana honnn1  : " . json_encode($data));
            $AgendaPeriod = explode(":", $data['AgendaPeriod']);
            $AgendaPeriod = $AgendaPeriod[0];
            $NewPrivateTask = explode(":", $data['NewPrivateTask']);
            $NewPrivateTask = $NewPrivateTask[0];
            $EventID = explode(":", $data['EventID']);
            $EventID = $EventID[0];
            $TaskID = explode(":", $data['TaskID']);
            $TaskID = $TaskID[0];


            if ($TaskID != "0") {
                Yii::error("TaskID..........66 : " . $TaskID);
                $Agenda = $Agenda->findOne(['TASK_ID' => $TaskID, 'WEDDING_ID' => $WeddingID]);
            } else {
                $Agenda = null;
            }
            if ($Agenda != null) {
                Yii::error("TaskID.......... :2 " . $TaskID);
                if ($NewPrivateTask != "") {
                    $Agenda->TASK_NAME = $NewPrivateTask;
                }

                $save = $Agenda->save(false);
            } else {
                Yii::error("EventID.......... 3 " . $EventID);
                $Agenda = new \app\models\Agenda();
                $Agenda->TASK_NAME = $NewPrivateTask;
                $Agenda->WEDDING_ID = $WeddingID;
                $Agenda->WEDDING_EVENT_ID = $EventID;
                $Agenda->AGENDA_PERIODE_ID = $AgendaPeriod;
                $Agenda->save(false);
                $TaskID = $Agenda->getPrimaryKey();
            }
            $form = '<tr>
                                            <td width="84%" class="text-danger" style="padding-left :3;">
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="hidden" id="weddingagendatasks-agenda_tasks_id" name="WeddingAgendaTasks[AGENDA_TASKS_ID][]" value="' . $TaskID . '">                                                   
                                                    <input type="hidden" id="weddingagendatasks-wedding_agenda_task_id" name="WeddingAgendaTasks[WEDDING_AGENDA_TASK_ID][]" value="0">   
                                                    <input type="hidden" id="TaskCheckedOrNo' . $TaskID . '" name="WeddingAgendaTasks[WEDDING_AGENDA_TASK_ID_CHECKED][]" value="false">   
                                                    &nbsp;&nbsp;&nbsp;<input type="checkbox" name="TaskCheced" value="1" onclick="ChangeHidden(this,\'TaskCheckedOrNo' . $TaskID . '\');">&nbsp;&nbsp;   ' . $NewPrivateTask . '<br><div style="display :none;" id="TaskNot' . $TaskID . '">

                                                    <form id="AgendaTasksForm' . $TaskID . '" action="index.php?r=agenda-periodes%2Fsavetasknote" method="post">
<input type="hidden" name="_csrf" value="RXgyUUdSLW4AT3ZiPhFGPxoRYz0PG1lYHElqNg86WR8ADlsHajweNg=="><div class="form-group field-agendanote-note">
<label class="control-label" for="agendanote-note">Note</label>
<textarea id="agendanote-note" class="form-control" name="AgendaNote[NOTE]" rows="3" cols="100"></textarea>

<div class="help-block"></div>
</div>                                                <input type="hidden" id="agendanote-couple_partner_id" name="AgendaNote[COUPLE_PARTNER_ID][]" value="' . $CouplePartnerID . '">                                                <input type="hidden" id="agendanote-task_id" name="AgendaNote[TASK_ID][]" value="' . $TaskID . '"><br>
<button type="submit" class="btn btn-success" onclick="SaveNoteAjax(\'AgendaTasksForm' . $TaskID . '\')">Save</button>      

                                                </form></div>


                                                

                                            </td>

                                            <td width="16%" align="right">
                                        <span style="cursor :pointer" onclick="ShowHide(\'TaskNot232\');" class="glyphicon glyphicon-pencil"></span>                                            </td>

                                        </tr>';
//       
//            $this->actionIndex();

            return ['return' => $form];
        }
    }

    public function actionUpdateprivatetask() {
        $CouplePartnerID = 0;
        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID;
        }
        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
//    array('imageFile')
        $Agenda = new \app\models\Agenda();

        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->getRequest();
//        'AgendaPeriod=' + AgendaPeriod + '&NewPrivateTask=' + NewPrivateTaskk + '&EventID=' + EventID+'&TaskID='+TaskID 
//    ['doctor' => $id, 'room_category' => $this->room_name]
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

//             TaskID: TaskID,
//                    TaskValue : TaskValuee
            $TaskValue = explode(":", $data['TaskValue']);
            $TaskValue = $TaskValue[0];

            $TaskID = explode(":", $data['TaskID']);
            $TaskID = $TaskID[0];


            if ($TaskID != "0") {
                Yii::error("TaskID..........66 : " . $TaskID);
                $Agenda = $Agenda->findOne(['TASK_ID' => $TaskID, 'WEDDING_ID' => $WeddingID]);
            }
            if ($Agenda != null) {

                if ($TaskValue !== "") {
                    $Agenda->TASK_NAME = $TaskValue;
                }

                if ($Agenda->save(false)) {
                    return ['response' => $TaskValue];
                } else {
                    return ['response' => 'Error On Update'];
                }
            }
        }
    }

    function actionDeleteprivatetask() {
        $CouplePartnerID = 0;
        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID;
        }
        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
//    array('imageFile')
        $Agenda = new \app\models\Agenda();

        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->getRequest();
//        'AgendaPeriod=' + AgendaPeriod + '&NewPrivateTask=' + NewPrivateTaskk + '&EventID=' + EventID+'&TaskID='+TaskID 
//    ['doctor' => $id, 'room_category' => $this->room_name]
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

//             TaskID: TaskID,
//                    TaskValue : TaskValuee


            $TaskID = explode(":", $data['TaskID']);
            $TaskID = $TaskID[0];


            if ($TaskID != "0") {
                Yii::error("TaskID..........66 : " . $TaskID);
                $Agenda = $Agenda->findOne(['TASK_ID' => $TaskID, 'WEDDING_ID' => $WeddingID]);
            }
            if ($Agenda != null) {
                $deleteAll = $Agenda->deleteAll(['TASK_ID' => $TaskID, 'WEDDING_ID' => $WeddingID]);
                if ($deleteAll) {
                    return ['response' => 'true'];
                } else {
                    return ['response' => 'false'];
                }
            }
        }
    }
public function actionGetItems(){
    $TaskID = 0;
        if (Yii::$app->request != null && Yii::$app->request->get('TaskID') != null) {
            $TaskID = Yii::$app->request->get('TaskID');
        }
        if($TaskID!=0){
            
        }
}

public function actionGetSuppliers(){
   $SupplierDataProvider = new ActiveDataProvider([
            'query' => \app\models\Suppliers::find()->where('SUPPLIER_TYPE_ID = 2'),
        ]);  
   
   if($SupplierDataProvider!=null){
       $SupplierDataProvider=$SupplierDataProvider->getModels();
   }
    return $this->renderAjax('view', [
                    'SupplierDataProvider'=>$SupplierDataProvider
//            'dataProvider1' => $dataProvider1,
        ]);
}
}
