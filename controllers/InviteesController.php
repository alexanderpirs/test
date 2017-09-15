<?php

namespace app\controllers;

use Yii;
use app\models\AgendaPeriodes;
use \app\models\WeddingTentativePeriodes;
use yii\data\ActiveDataProvider;
use app\models\WeddingEvent;
use yii\web\Response;
use yii\widgets\ActiveForm;
//use yii\web\Response;
use yii\filters\AccessControl;
use PHPExcel_IOFactory;
use yii\filters\VerbFilter;

class InviteesController extends \yii\web\Controller {

    public function actionNewinviteebutton() {
        $CouplePartnerID = 0;
        $WeddingID = 0;
        $Clicked = 1;
        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }

        Yii::error("Index Controller ");

        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }

        $CouplePartnerModel = new \app\models\CouplePartner();
        $WeddingEvents = new \app\models\WeddingEvent();
        $WeddingTentativePeriods = new \app\models\WeddingTentativePeriodes();


        $WeddingEventDataProvider = new ActiveDataProvider([
            'query' => WeddingEvent::find()->where("WEDDING_ID =  " . $WeddingID . " OR WEDDING_ID IS NULL ORDER BY EVENT_SEQUENCE_NUMBER ASC "),
        ]);
        $dataProvider1 = new ActiveDataProvider([
            'query' => WeddingTentativePeriodes::find()->where('WEDDING_ID =' . $WeddingID . ' '),
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => AgendaPeriodes::find()->orderBy(['SEQUENCE_NUMBER' => SORT_ASC]),
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
        ]);

        $dataProviderForInviteeTitle = new ActiveDataProvider([
            'query' => \app\models\InviteeTitleTrans::find()->select('invitee_title_trans.INVITEE_TITLE_ID,invitee_title_trans.INVITEE_TITLE_TRANS')->where('LANGUAGE_ID = 1'),
        ]);

        $dataProviderForEvents = new ActiveDataProvider([
            'query' => WeddingTentativePeriodes::find()->select('wedding_event_translation.wedding_event_id,wedding_event_translation.wedding_event_VALUE,wedding_tentative_periodes.TO_DATE')->innerJoin('wedding_event_translation', 'wedding_event_translation.wedding_event_id=wedding_tentative_periodes.WEDDING_EVENT_ID')->where("(wedding_tentative_periodes.WEDDING_ID =  " . $WeddingID . " ) AND wedding_tentative_periodes.IN_USE_OR_NO = 'Y' AND wedding_event_translation.LANGUAGE_ID = 1 ORDER BY wedding_tentative_periodes.TO_DATE ASC "),
        ]);
        $WeddingModel = new \app\models\Weddings();
        $InviteeModel = new \app\models\Invitees();
        return $this->render('new', [
                    'dataProvider' => $dataProvider,
                    'dataProvider1' => $dataProvider1,
                    'WeddingEvents' => $WeddingEvents,
                    'WeddingTentativePeriods' => $WeddingTentativePeriods,
                    'WeddingEventDataProvider' => $WeddingEventDataProvider,
                    'dataProviderForWeddingDate1' => $dataProviderForWeddingDate1,
                    'CouplePartnerModel' => $CouplePartnerModel,
                    'WeddingModel' => $WeddingModel,
                    'Clicked' => $Clicked,
                    'dataProviderForInviteeTitle' => $dataProviderForInviteeTitle,
                    'dataProviderForEvents' => $dataProviderForEvents,
                    'InviteeModel' => $InviteeModel,
        ]);
    }

    public function actionIndex() {

        $CouplePartnerID = 0;
        $WeddingID = 0;
        $Clicked = 0;
        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }

        Yii::error("Index Controller ");

        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }

        $CouplePartnerModel = new \app\models\CouplePartner();
        $WeddingEvents = new \app\models\WeddingEvent();
        $WeddingTentativePeriods = new \app\models\WeddingTentativePeriodes();


        $WeddingEventDataProvider = new ActiveDataProvider([
            'query' => WeddingEvent::find()->where("WEDDING_ID =  " . $WeddingID . " OR WEDDING_ID IS NULL ORDER BY EVENT_SEQUENCE_NUMBER ASC "),
        ]);
        $dataProvider1 = new ActiveDataProvider([
            'query' => WeddingTentativePeriodes::find()->where('WEDDING_ID =' . $WeddingID . ' '),
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => AgendaPeriodes::find()->orderBy(['SEQUENCE_NUMBER' => SORT_ASC]),
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
        ]);

        $WeddingModel = new \app\models\Weddings();

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'dataProvider1' => $dataProvider1,
                    'WeddingEvents' => $WeddingEvents,
                    'WeddingTentativePeriods' => $WeddingTentativePeriods,
                    'WeddingEventDataProvider' => $WeddingEventDataProvider,
                    'dataProviderForWeddingDate1' => $dataProviderForWeddingDate1,
                    'CouplePartnerModel' => $CouplePartnerModel,
                    'WeddingModel' => $WeddingModel,
                    'Clicked' => $Clicked,
        ]);
    }

    public function actionList() {
        
        
        $CouplePartnerID = 0;
        $WeddingID = 0;
        $Clicked = 0;
        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }

        Yii::error("Index Controller ");

        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }

        $CouplePartnerModel = new \app\models\CouplePartner();
        $WeddingEvents = new \app\models\WeddingEvent();
        $WeddingTentativePeriods = new \app\models\WeddingTentativePeriodes();


        $WeddingEventDataProvider = new ActiveDataProvider([
            'query' => WeddingEvent::find()->where("WEDDING_ID =  " . $WeddingID . " OR WEDDING_ID IS NULL ORDER BY EVENT_SEQUENCE_NUMBER ASC "),
        ]);
        $dataProvider1 = new ActiveDataProvider([
            'query' => WeddingTentativePeriodes::find()->where('WEDDING_ID =' . $WeddingID . ' '),
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => AgendaPeriodes::find()->orderBy(['SEQUENCE_NUMBER' => SORT_ASC]),
        ]);
        $Invitees = new ActiveDataProvider([
            'query' => \app\models\Invitees::find()->where('WEDDING_ID = '.$WeddingID),
            'pagination'=>false,
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
        ]);
//        $Invitees = new ActiveDataProvider([
//            'query' => \app\models\Invitees::find()->where('WEDDING_ID =' . $WeddingID),
//            'pagination'=>false,
//        ]);
        $WeddingModel = new \app\models\Weddings();
        $WeddingEvent = new ActiveDataProvider([
            'query' => \app\models\WeddingEvent::find()->where('(WEDDING_ID = ' . $WeddingID . ' OR WEDDING_ID IS NULL)'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $EventArray = [];
        if ($WeddingEvent != null) {
            $WeddingEvent = $WeddingEvent->getModels();
            if ($WeddingEvent != null && sizeof($WeddingEvent) > 0) {
                $i = 0;
                foreach ($WeddingEvent as $WeddingEven) {

                    if ($WeddingEven->WEDDING_ID != null && $WeddingEven->WEDDING_ID == $WeddingID) {
                        $EventArray[$WeddingEven->WEDDING_EVENT_ID] = $WeddingEven->WEDDING_EVENT_VALUE;
                    }if ($WeddingEven->WEDDING_ID == null) {
                        $EventArray[$WeddingEven->WEDDING_EVENT_ID] = $WeddingEven->weddingEventTranslations != null && sizeof($WeddingEven->weddingEventTranslations) > 0 && $WeddingEven->weddingEventTranslations[0]->wedding_event_VALUE != null ? $WeddingEven->weddingEventTranslations[0]->wedding_event_VALUE : "";
                    }
                    $i++;
                }
            }
        }


        $SendCartBy = new ActiveDataProvider([
            'query' => \app\models\SendCartByTrans::find()->where('LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $SendCartByArray = [];
        if ($SendCartBy != null) {
            $SendCartBy = $SendCartBy->getModels();
            if ($SendCartBy != null && sizeof($SendCartBy) > 0) {
                $i = 0;
                foreach ($SendCartBy as $Cart) {
                    if ($Cart->SEND_CART_BY_NAME != null) {
                        $SendCartByArray[$Cart->SEND_CART_BY_ID] = $Cart->SEND_CART_BY_NAME;
                    }
                    $i++;
                }
            }
        }
        
        $GetEstimatedInviteesDataModel = new ActiveDataProvider([
            'query' => \app\models\InviteeEstimation::find()->where('WEDDING_ID = '.$WeddingID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
$GetStartedModel = new ActiveDataProvider([
            'query' => \app\models\GetStarted::find()->where('WEDDING_ID = '.$WeddingID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        $Circles = new ActiveDataProvider([
            'query' => \app\models\InviteesCirclesTrans::find()->where('LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $CirclesArray = [];
        if ($Circles != null) {
            $Circles = $Circles->getModels();
            if ($Circles != null && sizeof($Circles) > 0) {
                $i = 0;
                foreach ($Circles as $Circle) {
                    if ($Circle->INVITEE_CIRCLE_TRANS != null) {
                        $CirclesArray[$Circle->INVITEE_CIRCLE_ID] = $Circle->INVITEE_CIRCLE_TRANS;
                    }
                    $i++;
                }
            }
        }


        $PlaceWiths = new ActiveDataProvider([
            'query' => \app\models\InviteesPlaceWithTrans::find()->where('LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $PlaceWithsArray = [];
        if ($PlaceWiths != null) {
            $PlaceWiths = $PlaceWiths->getModels();
            if ($PlaceWiths != null && sizeof($PlaceWiths) > 0) {
                $i = 0;
                foreach ($PlaceWiths as $PlaceWith) {
                    if ($PlaceWith->INVITEE_PALCE_WITH_VALUE != null) {
                        $PlaceWithsArray[$PlaceWith->INVITEE_PLACE_WITH_ID] = $PlaceWith->INVITEE_PALCE_WITH_VALUE;
                    }
                    $i++;
                }
            }
        }
        return $this->render('list', [
                    'dataProvider' => $dataProvider,
                    'dataProvider1' => $dataProvider1,
                    'WeddingEvents' => $WeddingEvents,
                    'WeddingTentativePeriods' => $WeddingTentativePeriods,
                    'WeddingEventDataProvider' => $WeddingEventDataProvider,
                    'dataProviderForWeddingDate1' => $dataProviderForWeddingDate1,
                    'CouplePartnerModel' => $CouplePartnerModel,
                    'WeddingModel' => $WeddingModel,
                    'Clicked' => $Clicked,
                    'Invitees' => $Invitees,
                    'GetStartedModel'=>$GetStartedModel,
                    'SendCartByArray' => $SendCartByArray,
                    'EventArray' => $EventArray,
                    'CirclesArray' => $CirclesArray,
                    'PlaceWithsArray' => $PlaceWithsArray,
                    'GetEstimatedInviteesDataModel'=>$GetEstimatedInviteesDataModel,
        ]);
    }

    public function actionNewManualInvitee() {

        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        $InviteeID = Yii::$app->request->get('InviteeID');
        $InviteesModal = new \app\models\Invitees();

        $InviteeProvider = new ActiveDataProvider([
            'query' => \app\models\Invitees::find()->where('WEDDING_ID =' . $WeddingID .' AND INVITEE_ID = '.$InviteeID ),
        ]);
        $WeddingEvent = new ActiveDataProvider([
            'query' => \app\models\WeddingEvent::find()->where('(WEDDING_ID = ' . $WeddingID . ' OR WEDDING_ID IS NULL)'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $EventArray = [];
        if ($WeddingEvent != null) {
            $WeddingEvent = $WeddingEvent->getModels();
            if ($WeddingEvent != null && sizeof($WeddingEvent) > 0) {
                $i = 0;
                foreach ($WeddingEvent as $WeddingEven) {

                    if ($WeddingEven->WEDDING_ID != null && $WeddingEven->WEDDING_ID == $WeddingID) {
                        $EventArray[$WeddingEven->WEDDING_EVENT_ID] = $WeddingEven->WEDDING_EVENT_VALUE;
                    }if ($WeddingEven->WEDDING_ID == null) {
                        $EventArray[$WeddingEven->WEDDING_EVENT_ID] = $WeddingEven->weddingEventTranslations != null && sizeof($WeddingEven->weddingEventTranslations) > 0 && $WeddingEven->weddingEventTranslations[0]->wedding_event_VALUE != null ? $WeddingEven->weddingEventTranslations[0]->wedding_event_VALUE : "";
                    }
                    $i++;
                }
            }
        }


        $SendCartBy = new ActiveDataProvider([
            'query' => \app\models\SendCartByTrans::find()->where('LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $SendCartByArray = [];
        if ($SendCartBy != null) {
            $SendCartBy = $SendCartBy->getModels();
            if ($SendCartBy != null && sizeof($SendCartBy) > 0) {
                $i = 0;
                foreach ($SendCartBy as $Cart) {
                    if ($Cart->SEND_CART_BY_NAME != null) {
                        $SendCartByArray[$Cart->SEND_CART_BY_ID] = $Cart->SEND_CART_BY_NAME;
                    }
                    $i++;
                }
            }
        }

        $CircleDataProvider = new ActiveDataProvider([
            'query' => \app\models\InviteesCirclesTrans::find()->where('LANGUAGE_ID =1'),
        ]);
        if ($CircleDataProvider != null) {
            $CircleDataProvider = $CircleDataProvider->getModels();
        }
        $PlaceWithDataProvider = new ActiveDataProvider([
            'query' => \app\models\InviteesPlaceWithTrans::find()->where('LANGUAGE_ID =1'),
        ]);

        if ($PlaceWithDataProvider != null) {
            $PlaceWithDataProvider = $PlaceWithDataProvider->getModels();
        }
        if ($InviteeProvider != null) {
            $InviteeProvider = $InviteeProvider->getModels();
        }
        return $this->renderAjax('_newmanualinvitee', [
                    'InviteesModal' => $InviteesModal,
                    'EventArray' => $EventArray,
                    'PlaceWithDataProvider' => $PlaceWithDataProvider,
                    'CircleDataProvider' => $CircleDataProvider,
                    'SendCartByArray' => $SendCartByArray,
                    'InviteeProvider' => $InviteeProvider,
                    'InviteeID'=>$InviteeID,
        ]);
    }

    public function actionSaveManualyInvitee() {

        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }


        Yii::error('Saving : ');
        $model = new \app\models\Invitees();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $model->validate()) {

  Yii::error('Saving : 1');
            if ($WeddingID != 0) {
                  Yii::error('Saving : 2');
                $model->WEDDING_ID = $WeddingID;
                if ($model->save(false)) {
                      Yii::error('Saving : 3');
                    $InviteeID = $model->getPrimaryKey();
                    if ($InviteeID != null) {
                        if (isset($model->Circle) && $model->Circle != null && sizeof($model->Circle)) {
                            $i = 0;
                            foreach ($model->Circle as $Circle) {
                                $GuestModel = new \app\models\InviteeGuests();
                                $GuestName = $model->guestname[$i];
                                $PlaceWith = $model->placewith[$i];
                                $GuestModel->GUEST_NAME = $GuestName;
                                $GuestModel->INVITEE_ID = $InviteeID;
                                $GuestModel->PLACE_WITH = $PlaceWith;
                                $GuestModel->CIRLE_ID = $Circle;
                                $GuestModel->save();
                                $i++;
                            }
                        }

                        if ($model->WEDDING_EVENT_ID != null && sizeof($model->WEDDING_EVENT_ID)) {
                            $i = 0;
                            foreach ($model->WEDDING_EVENT_ID as $EventID) {
                                $InviteeEventModel = new \app\models\InviteeEvents();
                                $InviteeEventModel->EVENT_ID = $EventID;
                                $InviteeEventModel->INVITEE_ID = $InviteeID;
                                $InviteeEventModel->save();
                                $i++;
                            }
                        }
                         Yii::error('SEND_CART_BY_ID : '.print_r($model->SEND_CART_BY_ID,true));
                        if ($model->SEND_CART_BY_ID != null && sizeof($model->SEND_CART_BY_ID)) {
                            $i = 0;
                            foreach ($model->SEND_CART_BY_ID as $SendCartByID) {
                                $InviteeSendCartByModel = new \app\models\InviteeSendCartBy();
                                $InviteeSendCartByModel->SEND_CART_BY_ID = $SendCartByID;
                                $InviteeSendCartByModel->INVITEE_ID = $InviteeID;
                                $InviteeSendCartByModel->save();
                                $i++;
                            }
                        }
                        Yii::$app->response->format = Response::FORMAT_JSON;
                    return [
                        'success' => true,
                        'InviteeID'=> $InviteeID,
                    ];
                    }
                    
                }
            }
        } else {
            if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
                Yii::error('Error ');
                Yii::$app->response->format = Response::FORMAT_JSON;
                Yii::error(print_r(ActiveForm::validate($model),true));
                return ActiveForm::validate($model);
            }
        }
    }

    public function actionNewManualInviteeValidate() {
        $model = new \app\models\Invitees();
        Yii::error('Validating : ');

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            Yii::error(print_r(ActiveForm::validate($model),true));
            return ActiveForm::validate($model);
        }
    }

    public function actionNewGuests() {
//        guestform
        $InviteeModel = new \app\models\Invitees();
        $number = Yii::$app->request->get('number');
        $InviteeID = Yii::$app->request->get('InviteeID');
        $WeddingID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        $InviteeProvider=null;
        if($InviteeID!=null && $InviteeID!=''){
         $InviteeProvider = new ActiveDataProvider([
            'query' => \app\models\Invitees::find()->where('WEDDING_ID =' . $WeddingID . ' AND INVITEE_ID = ' . $InviteeID),
        ]);   
        }
        
        $CircleDataProvider = new ActiveDataProvider([
            'query' => \app\models\InviteesCirclesTrans::find()->where('LANGUAGE_ID =1'),
        ]);
        if ($CircleDataProvider != null) {
            $CircleDataProvider = $CircleDataProvider->getModels();
        }
        $PlaceWithDataProvider = new ActiveDataProvider([
            'query' => \app\models\InviteesPlaceWithTrans::find()->where('LANGUAGE_ID =1'),
        ]);
        if ($PlaceWithDataProvider != null) {
            $PlaceWithDataProvider = $PlaceWithDataProvider->getModels();
        }
        if ($InviteeProvider != null) {
            $InviteeProvider = $InviteeProvider->getModels();
        }

        return $this->renderAjax('guestform', [
                    'number' => $number,
                    'PlaceWithDataProvider' => $PlaceWithDataProvider,
                    'CircleDataProvider' => $CircleDataProvider,
                    'InviteeProvider' => $InviteeProvider,
                    'InviteeModel' => $InviteeModel
        ]);
    }
     public function actionAfterAnyChangesStatisticsInvitee() {
      $WeddingID=0;
      if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        
       $Invitees = new ActiveDataProvider([
            'query' => \app\models\Invitees::find()->where('WEDDING_ID = '.$WeddingID),
            'pagination'=>false,
        ]);
        
$numberOfInvitees = 0;
                        if (isset($Invitees) && $Invitees != null) {
                            $Inviteess = $Invitees->getModels();
                            if ($Inviteess != null && sizeof($Inviteess) > 0) {
                                $numberOfInvitees = $numberOfInvitees + sizeof($Inviteess);
                                foreach ($Inviteess as $invitee) {

                                    if ($invitee->inviteeGuests != null && sizeof($invitee->inviteeGuests) > 0) {
                                        $numberOfInvitees = $numberOfInvitees + sizeof($invitee->inviteeGuests);
                                    }
                                }
                            }
                        }
        return $this->renderAjax('_statistics', [
                    'Invitees'=>$Invitees,
                    'SSS' => 'Hayde From Search',
                    'numberOfInvitees'=>$numberOfInvitees,
        ]);
    }
  public function actionAfterAddingManuallyInvitee() {
      $WeddingID=0;
      if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        
       $Invitees = new ActiveDataProvider([
            'query' => \app\models\Invitees::find()->where('WEDDING_ID = '.$WeddingID),
            'pagination'=>false,
        ]);
       
        return $this->renderAjax('_search', [
                    'Invitees'=>$Invitees,
                    'SSS' => 'Hayde From Search'
        ]);
    }
    public function actionSearch() {
        $SearchInvitees = new \app\models\Invitees;
        $Invitees = $SearchInvitees->search(Yii::$app->request->getQueryParams());
        Yii::error('Search ');

        $CouplePartnerID = 0;
        $WeddingID = 0;
        $Clicked = 0;
        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }

        Yii::error("Index Controller ");

        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }

        $CouplePartnerModel = new \app\models\CouplePartner();
        $WeddingEvents = new \app\models\WeddingEvent();
        $WeddingTentativePeriods = new \app\models\WeddingTentativePeriodes();


        $WeddingEventDataProvider = new ActiveDataProvider([
            'query' => WeddingEvent::find()->where("WEDDING_ID =  " . $WeddingID . " OR WEDDING_ID IS NULL ORDER BY EVENT_SEQUENCE_NUMBER ASC "),
        ]);
        $dataProvider1 = new ActiveDataProvider([
            'query' => WeddingTentativePeriodes::find()->where('WEDDING_ID =' . $WeddingID . ' '),
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => AgendaPeriodes::find()->orderBy(['SEQUENCE_NUMBER' => SORT_ASC]),
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
        ]);
//        $Invitees = new ActiveDataProvider([
//            'query' => \app\models\Invitees::find()->where('WEDDING_ID =' . $WeddingID),
//            'pagination'=>false,
//        ]);
        $WeddingModel = new \app\models\Weddings();
        $WeddingEvent = new ActiveDataProvider([
            'query' => \app\models\WeddingEvent::find()->where('(WEDDING_ID = ' . $WeddingID . ' OR WEDDING_ID IS NULL)'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $EventArray = [];
        if ($WeddingEvent != null) {
            $WeddingEvent = $WeddingEvent->getModels();
            if ($WeddingEvent != null && sizeof($WeddingEvent) > 0) {
                $i = 0;
                foreach ($WeddingEvent as $WeddingEven) {

                    if ($WeddingEven->WEDDING_ID != null && $WeddingEven->WEDDING_ID == $WeddingID) {
                        $EventArray[$WeddingEven->WEDDING_EVENT_ID] = $WeddingEven->WEDDING_EVENT_VALUE;
                    }if ($WeddingEven->WEDDING_ID == null) {
                        $EventArray[$WeddingEven->WEDDING_EVENT_ID] = $WeddingEven->weddingEventTranslations != null && sizeof($WeddingEven->weddingEventTranslations) > 0 && $WeddingEven->weddingEventTranslations[0]->wedding_event_VALUE != null ? $WeddingEven->weddingEventTranslations[0]->wedding_event_VALUE : "";
                    }
                    $i++;
                }
            }
        }


        $SendCartBy = new ActiveDataProvider([
            'query' => \app\models\SendCartByTrans::find()->where('LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $SendCartByArray = [];
        if ($SendCartBy != null) {
            $SendCartBy = $SendCartBy->getModels();
            if ($SendCartBy != null && sizeof($SendCartBy) > 0) {
                $i = 0;
                foreach ($SendCartBy as $Cart) {
                    if ($Cart->SEND_CART_BY_NAME != null) {
                        $SendCartByArray[$Cart->SEND_CART_BY_ID] = $Cart->SEND_CART_BY_NAME;
                    }
                    $i++;
                }
            }
        }


        $Circles = new ActiveDataProvider([
            'query' => \app\models\InviteesCirclesTrans::find()->where('LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $CirclesArray = [];
        if ($Circles != null) {
            $Circles = $Circles->getModels();
            if ($Circles != null && sizeof($Circles) > 0) {
                $i = 0;
                foreach ($Circles as $Circle) {
                    if ($Circle->INVITEE_CIRCLE_TRANS != null) {
                        $CirclesArray[$Circle->INVITEE_CIRCLE_ID] = $Circle->INVITEE_CIRCLE_TRANS;
                    }
                    $i++;
                }
            }
        }


        $PlaceWiths = new ActiveDataProvider([
            'query' => \app\models\InviteesPlaceWithTrans::find()->where('LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $PlaceWithsArray = [];
        if ($PlaceWiths != null) {
            $PlaceWiths = $PlaceWiths->getModels();
            if ($PlaceWiths != null && sizeof($PlaceWiths) > 0) {
                $i = 0;
                foreach ($PlaceWiths as $PlaceWith) {
                    if ($PlaceWith->INVITEE_PALCE_WITH_VALUE != null) {
                        $PlaceWithsArray[$PlaceWith->INVITEE_PLACE_WITH_ID] = $PlaceWith->INVITEE_PALCE_WITH_VALUE;
                    }
                    $i++;
                }
            }
        }
        return $this->renderAjax('_search', [
                    'dataProvider' => $dataProvider,
                    'dataProvider1' => $dataProvider1,
                    'WeddingEvents' => $WeddingEvents,
                    'WeddingTentativePeriods' => $WeddingTentativePeriods,
                    'WeddingEventDataProvider' => $WeddingEventDataProvider,
                    'dataProviderForWeddingDate1' => $dataProviderForWeddingDate1,
                    'CouplePartnerModel' => $CouplePartnerModel,
                    'WeddingModel' => $WeddingModel,
                    'Clicked' => $Clicked,
                    'Invitees' => $Invitees,
                    'SendCartByArray' => $SendCartByArray,
                    'EventArray' => $EventArray,
                    'CirclesArray' => $CirclesArray,
                    'PlaceWithsArray' => $PlaceWithsArray,
                    'SSS' => 'Hayde From Search'
        ]);
    }

    public function actionDownload() {

        Yii::error("Download 1 ");
        $objPHPExcel = new \PHPExcel();
        $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load('Testing.xlsm');

        $objPHPExcel->setActiveSheetIndex(0);


        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Title');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Invitee Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Circle'); //Last Name first partner
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Place With'); //second Partner Title
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Events'); // Second Partner First Name
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Relation Type'); // Last Name 
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Invite By'); // Last Name 
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Phone'); //Invite By
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Address'); // Related To
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Note'); //Phone
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Guest Number'); //Phone
//$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Relation Type');
//$objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Your Notewffsfdfdsee');

        $LanguageID = 1;
//        $_POST['LanguageID'];
//$Counter = $_POST['Counter'];

        $array = array();
        $NewInviteeForm = "";
        $UserID = 1;
        $numberofInviteeTitles = 1;
        $numberOfCircls = 1;
        $numberOfrelationType = 1;
        $numberOfPlaceWith = 1;
        $numberOfInviteBy = 1;
//$AllRelatedToValues="";
        $AllCircls = "";
        $AllInviteByValues = "";
        $AllTitlesValues = "";
        $AllPlaceWith = "";
//        $_SESSION['UserID'];
//echo "\$_SESSION['ProgressBar']]]]]]]]]]]]]]]]]]]]]]]".$_SESSION['ProgressBar'];
//echo "\$_SESSION['ProgressBar']]]]]]]]]]]]]]]]]]]]]]]".$_SESSION['ProgressBar'];
        $WeddingID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        $p=0;
        for($p=2;$p<1000;$p++){
           $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$p,"");
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,$p,"");
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,$p,"");
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,$p,"");
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,$p,"");
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,$p,"");
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6,$p,"");
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7,$p,"");
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8,$p,"");
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9,$p,"");
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10,$p,"");
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11,$p,"");
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12,$p,"");
                   
        }
// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow
                    
        if ($WeddingID != 0) {
            $Invitees = new ActiveDataProvider([
                'query' => \app\models\Invitees::find()->where('WEDDING_ID =' . $WeddingID),
                'pagination' => false,
            ]);
            
            $i = 2;
            if ($Invitees != null) {
                $Invitees = $Invitees->getModels();
            }
            if ($Invitees != null && sizeof($Invitees) > 0) {
                foreach ($Invitees as $Invitee) {
                    $EventsValue = "";
                    if ($Invitee->inviteeEvents != null && sizeof($Invitee->inviteeEvents) > 0) {
                        foreach ($Invitee->inviteeEvents as $Event) {
                            $EventsValue = $EventsValue . $Event->eVENT->weddingEventTranslations[0]->wedding_event_VALUE . ',';
                        }
                    }
                   
                    $SendCartByValuee = "";
                    if ($Invitee->inviteeSendCartBies != null && sizeof($Invitee->inviteeSendCartBies) > 0) {
                         $m=0;
                        foreach ($Invitee->inviteeSendCartBies as $inviteeSendCartBy) {
                            if($m==sizeof($Invitee->inviteeSendCartBies)-1){
                               $SendCartByValuee = $SendCartByValuee . $inviteeSendCartBy->sENDCARTBY->sendCartByTrans[0]->SEND_CART_BY_NAME ; 
                            }else{
                              $SendCartByValuee = $SendCartByValuee . $inviteeSendCartBy->sENDCARTBY->sendCartByTrans[0]->SEND_CART_BY_NAME . ',';  
                            }
                            $m++;
                        }
                    }
                    Yii::error("Download 2 ");
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, $Invitee->FIRST_INVITEE_MSMRS_ID != null && $Invitee->fIRSTINVITEEMSMRS != null && $Invitee->fIRSTINVITEEMSMRS->inviteeTitleTrans != null && sizeof($Invitee->fIRSTINVITEEMSMRS->inviteeTitleTrans) > 0 ? $Invitee->fIRSTINVITEEMSMRS->inviteeTitleTrans[0]->INVITEE_TITLE_TRANS : "");
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, ($Invitee->FIRST_INVITEE_NAME != null ? $Invitee->FIRST_INVITEE_NAME : ""));
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, ($Invitee->INVITEE_CIRCLE_ID != null && $Invitee->iNVITEECIRCLE != null && $Invitee->iNVITEECIRCLE->inviteesCirclesTrans != null && sizeof($Invitee->iNVITEECIRCLE->inviteesCirclesTrans) > 0 && $Invitee->iNVITEECIRCLE->inviteesCirclesTrans[0]->INVITEE_CIRCLE_TRANS ? $Invitee->iNVITEECIRCLE->inviteesCirclesTrans[0]->INVITEE_CIRCLE_TRANS : ""));
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, ($Invitee->INVITEE_PLACE_WITH_ID != null && $Invitee->iNVITEEPLACEWITH != null && $Invitee->iNVITEEPLACEWITH->inviteesPlaceWithTrans != null && sizeof($Invitee->iNVITEEPLACEWITH->inviteesPlaceWithTrans) > 0 && $Invitee->iNVITEEPLACEWITH->inviteesPlaceWithTrans[0]->INVITEE_PALCE_WITH_VALUE ? $Invitee->iNVITEEPLACEWITH->inviteesPlaceWithTrans[0]->INVITEE_PALCE_WITH_VALUE : ""));
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, ($EventsValue));
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $i, "Him Self");
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i, $SendCartByValuee);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i, ($Invitee->INVITEE_EMAIL != null ? $Invitee->INVITEE_EMAIL : ""));
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i, ($Invitee->PHONE != null ? $Invitee->PHONE : ""));
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $i, ($Invitee->ADDRESS != null ? $Invitee->ADDRESS : ""));
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $i, ($Invitee->NOTE != null ? $Invitee->NOTE : ""));
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $i, $Invitee->INVITEE_ID);
                    $InviteByString = "";
                    if ($Invitee->inviteeSendCartBies != null && sizeof($Invitee->inviteeSendCartBies) > 0) {
                        foreach ($Invitee->inviteeSendCartBies as $inviteBy) {
                            if ($inviteBy->sENDCARTBY != null) {
                                $InviteByString = $InviteByString . ($inviteBy->sENDCARTBY->sendCartByTrans != null && sizeof($inviteBy->sENDCARTBY->sendCartByTrans) > 0 ? $inviteBy->sENDCARTBY->sendCartByTrans[0]->SEND_CART_BY_NAME . "," : "");
                            }
                        }
                    }
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i, $InviteByString);

                    $i++;
                }
            }
        }
        $InviteesTitles = new ActiveDataProvider([
            'query' => \app\models\InviteeTitleTrans::find()->where('LANGUAGE_ID = 1'),
        ]);
        if ($InviteesTitles != null) {
            $InviteesTitles = $InviteesTitles->getModels();
        }

//  echo $data;
        $l = 0;
        foreach ($InviteesTitles as $InviteesTitle) {
            if ($l == sizeof($InviteesTitles) - 1) {
                $AllTitlesValues = $AllTitlesValues . $InviteesTitle->INVITEE_TITLE_TRANS;
            } else {
                $AllTitlesValues = $AllTitlesValues . $InviteesTitle->INVITEE_TITLE_TRANS . ',';
            }
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(20, ($numberofInviteeTitles + 1), $InviteesTitle->INVITEE_TITLE_ID);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(19, ($numberofInviteeTitles + 1), $InviteesTitle->INVITEE_TITLE_TRANS);
            $numberofInviteeTitles++;
            $l++;
        }

//$numberOfCircls
        $InviteesCirls = new ActiveDataProvider([
            'query' => \app\models\InviteesCirclesTrans::find()->where('LANGUAGE_ID = 1'),
        ]);
        if ($InviteesCirls != null) {
            $InviteesCirls = $InviteesCirls->getModels();
        }

        $l = 0;
        foreach ($InviteesCirls as $Circle) {

            if ($l == sizeof($InviteesCirls) - 1) {
                $AllCircls = $AllCircls . $Circle->INVITEE_CIRCLE_TRANS;
            } else {
                $AllCircls = $AllCircls . $Circle->INVITEE_CIRCLE_TRANS . ',';
            }

            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(21, ($numberOfCircls + 1), $Circle->INVITEE_CIRCLE_TRANS);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(22, ($numberOfCircls + 1), $Circle->INVITEE_CIRCLE_ID);
            $numberOfCircls++;


            $l++;
        }



        $InviteePlaceWiths = new ActiveDataProvider([
            'query' => \app\models\InviteesPlaceWithTrans::find()->where('LANGUAGE_ID = 1'),
        ]);
        if ($InviteePlaceWiths != null) {
            $InviteePlaceWiths = $InviteePlaceWiths->getModels();
        }
        $l = 0;
        foreach ($InviteePlaceWiths as $InviteePlaceWith) {

            if ($l == sizeof($InviteePlaceWiths) - 1) {
                $AllPlaceWith = $AllPlaceWith . $InviteePlaceWith->INVITEE_PALCE_WITH_VALUE;
            } else {
                $AllPlaceWith = $AllPlaceWith . $InviteePlaceWith->INVITEE_PALCE_WITH_VALUE . ',';
            }
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(23, ($numberOfPlaceWith + 1), $InviteePlaceWith->INVITEE_PALCE_WITH_VALUE);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(24, ($numberOfPlaceWith + 1), $InviteePlaceWith->INVITEE_PLACE_WITH_ID);
            $numberOfPlaceWith++;
            $l++;
        }


        $InviteeSendCardBys = new ActiveDataProvider([
            'query' => \app\models\SendCartByTrans::find()->where('LANGUAGE_ID = 1'),
        ]);
        if ($InviteeSendCardBys != null) {
            $InviteeSendCardBys = $InviteeSendCardBys->getModels();
        }
        $l = 0;
        foreach ($InviteeSendCardBys as $InviteeSendCardBy) {

            if ($l == sizeof($InviteeSendCardBys) - 1) {
                $AllInviteByValues = $AllInviteByValues . $InviteeSendCardBy->SEND_CART_BY_NAME;
            } else {
                $AllInviteByValues = $AllInviteByValues . $InviteeSendCardBy->SEND_CART_BY_NAME . ',';
            }
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(25, ($numberOfInviteBy + 1), $InviteeSendCardBy->SEND_CART_BY_NAME);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(26, ($numberOfInviteBy + 1), $InviteeSendCardBy->SEND_CART_BY_ID);
            $numberOfInviteBy++;
            $l++;
        }
//('A1', 'Title');
//$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Invitee Name');
//$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Circle');//Last Name first partner
//$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Place With');//second Partner Title
//$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Events');// Second Partner First Name
//$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Invite By');// Last Name 
//$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Address');
//$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Phone');//Invite By
//$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Email');// Related To
//$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Note');//Phone
        for ($j = 1; $j < 200; $j++) {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(14, $j + 1, "=IF(ISNA(VLOOKUP(A" . ($j + 1) . ",T2:U" . ($numberofInviteeTitles + 1) . ",2,FALSE)),\"\",VLOOKUP(Invitees!A" . ($j + 1) . ",T2:U" . ($numberofInviteeTitles + 1) . ",2,FALSE))");
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(16, $j + 1, "=IF(ISNA(VLOOKUP(C" . ($j + 1) . ",V2:W" . ($numberOfCircls + 1) . ",2,FALSE)),\"\",VLOOKUP(Invitees!C" . ($j + 1) . ",V2:W" . ($numberOfCircls + 1) . ",2,FALSE))");
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(17, $j + 1, "=IF(ISNA(VLOOKUP(D" . ($j + 1) . ",X2:Y" . ($numberOfPlaceWith + 1) . ",2,FALSE)),\"\",VLOOKUP(Invitees!D" . ($j + 1) . ",X2:Y" . ($numberOfPlaceWith + 1) . ",2,FALSE))");
//            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(18, $j + 1, "=IF(ISNA(VLOOKUP(G" . ($j + 1) . ",Z2:AA" . ($numberOfInviteBy + 1) . ",2,FALSE)),\"\",VLOOKUP(Invitees!G" . ($j + 1) . ",Z2:AA" . ($numberOfInviteBy + 1) . ",2,FALSE))");
//          IF(ISNA(VLOOKUP(A"".($j+1)",T2:U".($numberofInviteeTitles+1).",2,FALSE)),\"\",VLOOKUP(A".($j+1).",T2:U".($numberofInviteeTitles+1).",2,FALSE))
//            $worksheet->writeFormula($j, 12, '=VLOOKUP(\$A'.($j+1).',\$T2:\$U'.($numberofInviteeTitles+1).',2,FALSE)');
        }

//  $objValidation = $objPHPExcel->getActiveSheet();    
        Yii::error("AllInviteByValues 2 ".$AllInviteByValues);
        for ($g = 2; $g < 500; $g++) {
            $objValidation = $objPHPExcel->getActiveSheet()->getCell('G' . $g)->getDataValidation();
            $objValidation->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
            $objValidation->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
            $objValidation->setAllowBlank(false);
            $objValidation->setShowInputMessage(true);
            $objValidation->setShowErrorMessage(true);
            $objValidation->setShowDropDown(true);
            $objValidation->setErrorTitle('Input error');
            $objValidation->setError('Value is not in list.');
            $objValidation->setPromptTitle('Pick from list');
            $objValidation->setPrompt('Please pick a value from the drop-down list.');
            $objValidation->setFormula1('"' . $AllInviteByValues . '"');
        }

        for ($g = 2; $g < 500; $g++) {
            $objValidation3 = $objPHPExcel->getActiveSheet()->getCell('A' . $g)->getDataValidation();
            $objValidation3->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
            $objValidation3->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
            $objValidation3->setAllowBlank(false);
            $objValidation3->setShowInputMessage(true);
            $objValidation3->setShowErrorMessage(true);
            $objValidation3->setShowDropDown(true);
            $objValidation3->setFormula1('"' . $AllTitlesValues . '"');
        }

        for ($g = 2; $g < 500; $g++) {
            $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('C' . $g)->getDataValidation();
            $objValidation2->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
            $objValidation2->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
            $objValidation2->setAllowBlank(false);
            $objValidation2->setShowInputMessage(true);
            $objValidation2->setShowErrorMessage(true);
            $objValidation2->setShowDropDown(true);
            $objValidation2->setFormula1('"' . $AllCircls . '"');
        }
        for ($g = 2; $g < 500; $g++) {
            $objValidation1 = $objPHPExcel->getActiveSheet()->getCell('D' . $g)->getDataValidation();
            $objValidation1->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
            $objValidation1->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
            $objValidation1->setAllowBlank(false);
            $objValidation1->setShowInputMessage(true);
            $objValidation1->setShowErrorMessage(true);
            $objValidation1->setShowDropDown(true);
            $objValidation1->setFormula1('"' . $AllPlaceWith . '"');
        }

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->setPreCalculateFormulas(true);
        $objWriter->save("Testing.xlsm");
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="Invitees.xlsm"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize("Testing.xlsm"));
//    readfile("/yiiApp/basic/web/Testing.xlsm",true);
        exit;
        ob_clean();
    }
    
    public function actionDeleteInvitee() {
        $InviteeID = Yii::$app->request->post('InviteeID');
       
        $WeddingID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
//       EventID : EventID,
//                 InviteeID : InviteeID
        $Weddingmodels = \app\models\Invitees::find()->where('INVITEE_ID = ' . $InviteeID . ' AND  WEDDING_ID = ' . $WeddingID)->all();
        if ($Weddingmodels != null && sizeof($Weddingmodels) > 0 && sizeof($Weddingmodels) ==1) {
            
                $Weddingmodels[0]->delete();
            
        }
        $Invitees = new ActiveDataProvider([
            'query' => \app\models\Invitees::find()->where('WEDDING_ID = '.$WeddingID),
            'pagination'=>false,
        ]);
$numberOfInvitees = 0;
                        if (isset($Invitees) && $Invitees != null) {
                            $Inviteess = $Invitees->getModels();
                            if ($Inviteess != null && sizeof($Inviteess) > 0) {
                                $numberOfInvitees = $numberOfInvitees + sizeof($Inviteess);
                                foreach ($Inviteess as $invitee) {

                                    if ($invitee->inviteeGuests != null && sizeof($invitee->inviteeGuests) > 0) {
                                        $numberOfInvitees = $numberOfInvitees + sizeof($invitee->inviteeGuests);
                                    }
                                }
                            }
                        }
        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'success' => true,
            'numberOfInvitees'=>$numberOfInvitees,
        ]; 
        
    }
    public function actionDeleteSendByCard(){
        $InviteeID = Yii::$app->request->post('InviteeID');
        $SendCardByID = Yii::$app->request->post('SendCardByID');
        $WeddingID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
//       EventID : EventID,
//                 InviteeID : InviteeID
        $Weddingmodels = \app\models\Invitees::find()->where('INVITEE_ID = ' . $InviteeID . ' AND  WEDDING_ID = ' . $WeddingID)->all();
        if ($Weddingmodels != null && sizeof($Weddingmodels) > 0) {
            $models = \app\models\InviteeSendCartBy::find()->where('INVITEE_ID = ' . $InviteeID . ' AND SEND_CART_BY_ID = ' . $SendCardByID)->all();
            foreach ($models as $model) {
                $model->delete();
            }
        }
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'success' => true,
           
        ]; 
    }
public function actionDeleteEvent() {
        $InviteeID = Yii::$app->request->post('InviteeID');
        $EventID = Yii::$app->request->post('EventID');
        $WeddingID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
//       EventID : EventID,
//                 InviteeID : InviteeID
        $Weddingmodels = \app\models\Invitees::find()->where('INVITEE_ID = ' . $InviteeID . ' AND  WEDDING_ID = ' . $WeddingID)->all();
        if ($Weddingmodels != null && sizeof($Weddingmodels) > 0) {
            $models = \app\models\InviteeEvents::find()->where('INVITEE_ID = ' . $InviteeID . ' AND EVENT_ID = ' . $EventID)->all();
            foreach ($models as $model) {
                $model->delete();
            }
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'success' => true,
        ];
    }
    public function actionEditInviteeNumber() {
        $InviteeNumber = Yii::$app->request->post('InviteeNumber');
        
        $WeddingID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
//       EventID : EventID,
//                 InviteeID : InviteeID
        
//                            
        $Weddingmodels = \app\models\InviteeEstimation::findOne(['WEDDING_ID'=> $WeddingID]);
        if ($Weddingmodels != null ) {
            $Weddingmodels->INVITEE_NUMBER=$InviteeNumber;
            if($Weddingmodels->save(false)){
           Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'output'=>$InviteeNumber,'message'=>''
        ];
            }
        }else{
           $Weddingmodels = new \app\models\InviteeEstimation(); 
           $Weddingmodels->WEDDING_ID=$WeddingID;
           $Weddingmodels->INVITEE_NUMBER=$InviteeNumber;
           if($Weddingmodels->save(false)){
          Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'output'=>$InviteeNumber,'message'=>''
        ];  
           }
        }

        
    }
public function actionUploadExcelFile() {
     $WeddingID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        header('Content-Type: text/plain; charset=utf-8');

try {
    
    // Undefined | Multiple Files | $_FILES Corruption Attack
    // If this request falls under any of them, treat it invalid.
    if (
        !isset($_FILES['UploadFileEx']['error']) ||
        is_array($_FILES['UploadFileEx']['error'])
    ) {
        throw new \RuntimeException('Invalid parameters.');
    }

    // Check $_FILES['upfile']['error'] value.
    switch ($_FILES['UploadFileEx']['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new \RuntimeException('No file sent.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new \RuntimeException('Exceeded filesize limit.');
        default:
            throw new \RuntimeException('Unknown errors.');
    }

    // You should also check filesize here. 
    if ($_FILES['UploadFileEx']['size'] > 1000000) {
        throw new \RuntimeException('Exceeded filesize limit.');
    }

    // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
    // Check MIME Type by yourself.
    $finfo = new \finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
        $finfo->file($_FILES['UploadFileEx']['tmp_name']),
        array(
            'xlsm' => 'application/vnd.ms-excel.sheet.macroEnabled.12',
            
        ),
        true
    )) {
       
    }

    // You should name it uniquely.
    // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
    // On this example, obtain safe unique name from its binary data.
//    if (!move_uploaded_file(
//        $_FILES['UploadFileEx']['tmp_name'],
//        sprintf('./uploads/%s.%s',
//            sha1_file($_FILES['UploadFileEx']['tmp_name']),
//            $ext
//        )
//    )) {
//        throw new \RuntimeException('Failed to move uploaded file.');
//    }

//    echo 'File is uploaded successfully.';

} catch (\RuntimeException $e) {

    echo $e->getMessage();

}
Yii::error("Index Controller ");
        ini_set('max_execution_time', 3000);
        $dataa = \moonland\phpexcel\Excel::widget([
                    'mode' => 'import',
                    'fileName' => $_FILES['UploadFileEx']['tmp_name'],
                    'setFirstRecordAsKeys' => true, // if you want to set the keys of record column with first record, if it not set, the header with use the alphabet column on excel. 
                    'setIndexSheetByName' => true, // set this if your excel data with multiple worksheet, the index of array will be set with the sheet name. If this not set, the index will use numeric. 
                    'getOnlySheet' => 'Honeymoon', // you can set this property if you want to get the specified sheet from the excel data with multiple worksheet.
        ]);
//
        Yii::error('Data : '.print_r($dataa,true));
        if($dataa!=null && sizeof($dataa)>0){
            foreach($dataa as $data){
                if(!empty($data['ID']) && $data['ID']!=''){
                   $InviteeID = $data['ID'] ;
                   $findOne = \app\models\Invitees::findOne($InviteeID);
                   if($findOne!=null){
                      $findOne-> WEDDING_ID=$WeddingID ;
                      $findOne-> FIRST_INVITEE_NAME=$data['Invitee Name'] ;
                      $findOne-> INVITEE_EMAIL=$data['Email'] ;
                      $findOne-> PHONE=$data['Phone'] ;
                      $findOne-> ADDRESS=$data['Address'] ;
                      $findOne-> INVITEE_CIRCLE_ID=$data['CircleID'] ;
                      $findOne-> INVITEE_PLACE_WITH_ID=$data['PlaceWithID'] ;
                      $findOne-> NOTE=$data['Note'] ;
                         $findOne->save(false);     
                              
                              
                   }else{
                       $findOne=new \app\models\Invitees();
                      $findOne->WEDDING_ID=$WeddingID ;
                      $findOne->FIRST_INVITEE_NAME=$data['Invitee Name'] ;
                      $findOne->INVITEE_EMAIL=$data['Email'] ;
                      $findOne->PHONE=$data['Phone'] ;
                      $findOne->ADDRESS=$data['Address'] ;
                      $findOne->INVITEE_CIRCLE_ID=$data['CircleID'] ;
                      $findOne->INVITEE_PLACE_WITH_ID=$data['PlaceWithID'] ;
                      $findOne->NOTE=$data['Note'] ;
                         $findOne->save(false);    
                   }
                }else{
                    if(empty($data['Invitee Name']) &&empty($data['Invitee Name'])&&empty($data['Email'])&&empty($data['Address'])&&empty($data['CircleID'])&&empty($data['PlaceWithID'])&& empty($data['Note'])){
                        
                    }else{
                     $findOne=new \app\models\Invitees();
                      $findOne->WEDDING_ID=$WeddingID ;
                      $findOne->FIRST_INVITEE_NAME=$data['Invitee Name'] ;
                      $findOne->INVITEE_EMAIL=$data['Email'] ;
                      $findOne->PHONE=$data['Phone'] ;
                      $findOne->ADDRESS=$data['Address'] ;
                      $findOne->INVITEE_CIRCLE_ID=$data['CircleID'] ;
                      $findOne->INVITEE_PLACE_WITH_ID=$data['PlaceWithID'] ;
                      $findOne->NOTE=$data['Note'] ;
                         $findOne->save(false);    
                    }
                }
            }
        }
//        $TemCategory = "";
//        $WeddingType = new ActiveDataProvider([
//                        'query' => \app\models\WeddingType::find(),
////                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
//                    ]);
//        if ($WeddingType != null && sizeof($WeddingType) > 0) {
//                        $WeddingType = $WeddingType->getModels();
//        }
//        $Countries = new ActiveDataProvider([
//                        'query' => \app\models\Countries::find(),
////                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
//                    ]);
//        if ($Countries != null && sizeof($Countries) > 0) {
//        $Countries = $Countries->getModels();
//        
//        }
//        if ($dataa != null && sizeof($dataa) > 0) {
//            for ($i = 0; $i < sizeof($dataa); $i++) {
//                $CategoryValue = $dataa[$i]['Category'];
//                if ($CategoryValue != null && $CategoryValue != "") {
//                    $TemCategory = $CategoryValue;
//                }
//                echo ' ' . $TemCategory . ' --- ' . $dataa[$i]['Sub-Category'] . ' <br>';
//
//
//                $SubCategoryValue = $dataa[$i]['Sub-Category'];
//                $CategoryMo = new \app\models\CategoryOfItems();
//                $CategoryMoTrans = new \app\models\CategoryOfItemsTrans();
//                $SubCategory = new \app\models\SubCategoriesOfItems();
//                $SubCategoryTrans = new \app\models\SubCategoriesTrans();
//                $CategoryWeddingTye = new \app\models\CategoriesWeddingType();
//                $CategoruCountry=new \app\models\CategoriesCountries();
//                $SubCategoryWeddingTye = new \app\models\SubCategoriesWeddingType();
//                $SubCategoryCountries=new \app\models\SubCategoriesCountries();
//                $where = \app\models\CategoryOfItemsTrans::findOne(['CATEGORY_OF_ITEM_TRANS' => $TemCategory, 'LANGUAGE_ID' => 1]);
//                if ($where != null && sizeof($where) > 0) {
//                    
//                   
//                    if ($WeddingType != null && sizeof($WeddingType) > 0) {
//                        
//                        foreach ($WeddingType as $WeddingTy) {
//                            $findOne = \app\models\CategoriesWeddingType::findOne(['CATEGORY_ID' => $where->CATEGORY_OF_ITEM_ID, 'WEDDING_TYPE_ID' => $WeddingTy->WEDDING_TYPE_ID]);
//                            if ($findOne != null && sizeof($findOne) > 0) {
//                                
//                            } else {
//                                $CategoryWeddingTye->CATEGORY_ID = $where->CATEGORY_OF_ITEM_ID;
//                                $CategoryWeddingTye->WEDDING_TYPE_ID = $WeddingTy->WEDDING_TYPE_ID;
//                                $CategoryWeddingTye->save(false);
//                            }
//                        }
//                    } // Category Wedding Type for existing Categories
//                    
//                    if ($Countries != null && sizeof($Countries) > 0) {
////                        $Countries = $Countries->getModels();
//                        foreach ($Countries as $CountriesM) {
//                            $findOne = \app\models\CategoriesCountries::findOne(['CATEGORY_ID' => $where->CATEGORY_OF_ITEM_ID, 'COUNTRY_ID' => $CountriesM->COUNTRY_ID]);
//                            if ($findOne != null && sizeof($findOne) > 0) {
//                                
//                            } else {
//                                $CategoruCountry->CATEGORY_ID = $where->CATEGORY_OF_ITEM_ID;
//                                $CategoruCountry->COUNTRY_ID = $CountriesM->COUNTRY_ID;
//                                $CategoruCountry->save(false);
//                            }
//                        }
//                    } // CAtegory Countries for Existing Categories
//                    
//                    $where0 = \app\models\SubCategoriesTrans::findOne(['SUB_CATEGORY_NAME' => $SubCategoryValue, 'LANGUAGE_ID' => 1]);
//                    if ($where0 != null && sizeof($where0) > 0) {
//                        if ($WeddingType != null && sizeof($WeddingType) > 0) {
////                                $find0 = $find0->getModels();
//                                foreach ($WeddingType as $WeddingTy) {
//                                    $findOne = \app\models\SubCategoriesWeddingType::findOne(['SUB_CATEGORY_ID' => $where0->SUB_CATEGORY_ID, 'WEDDING_TYPE_ID' => $WeddingTy->WEDDING_TYPE_ID]);
//                                    if ($findOne != null && sizeof($findOne) > 0) {
//                                        
//                                    } else {
//                                        $SubCategoryWeddingTye->SUB_CATEGORY_ID = $where0->SUB_CATEGORY_ID;
//                                        $SubCategoryWeddingTye->WEDDING_TYPE_ID = $WeddingTy->WEDDING_TYPE_ID;
//                                        $SubCategoryWeddingTye->save(false);
//                                    }
//                                }
//                            }
//                            
//                            
//                            if ($Countries != null && sizeof($Countries) > 0) {
////                        $Countries = $Countries->getModels();
//                        foreach ($Countries as $CountriesM) {
//                            $findOne = \app\models\SubCategoriesCountries::findOne(['SUB_CATEGORY_ID' => $where0->SUB_CATEGORY_ID, 'COUNTRY_ID' => $CountriesM->COUNTRY_ID]);
//                            if ($findOne != null && sizeof($findOne) > 0) {
//                                
//                            } else {
//                                $SubCategoryCountries->SUB_CATEGORY_ID = $where0->SUB_CATEGORY_ID;
//                                $SubCategoryCountries->COUNTRY_ID = $CountriesM->COUNTRY_ID;
//                                $SubCategoryCountries->save(false);
//                            }
//                        }
//                    }
//                    } else {
//                        $CategoryID = $where->CATEGORY_OF_ITEM_ID;
//                        $SubCategory->CATEGORY_OF_ITEM_ID = $CategoryID;
//                        if ($SubCategory->save(false)) {
//                            $SubCategoryID = $SubCategory->getPrimaryKey();
//                            $SubCategoryTrans->LANGUAGE_ID = 1;
//                            $SubCategoryTrans->SUB_CATEGORY_ID = $SubCategoryID;
//                            $SubCategoryTrans->SUB_CATEGORY_NAME = $SubCategoryValue;
//                            $SubCategoryTrans->save(false);
//
//                            if ($WeddingType != null && sizeof($WeddingType) > 0) {
////                                $find0 = $find0->getModels();
//                                foreach ($WeddingType as $WeddingTy) {
//                                    $findOne = \app\models\SubCategoriesWeddingType::findOne(['SUB_CATEGORY_ID' => $SubCategoryID, 'WEDDING_TYPE_ID' => $WeddingTy->WEDDING_TYPE_ID]);
//                                    if ($findOne != null && sizeof($findOne) > 0) {
//                                        
//                                    } else {
//                                        $SubCategoryWeddingTye->SUB_CATEGORY_ID = $SubCategoryID;
//                                        $SubCategoryWeddingTye->WEDDING_TYPE_ID = $WeddingTy->WEDDING_TYPE_ID;
//                                        $SubCategoryWeddingTye->save(false);
//                                    }
//                                }
//                            }
//                            
//                            
//                            if ($Countries != null && sizeof($Countries) > 0) {
////                        $Countries = $Countries->getModels();
//                        foreach ($Countries as $CountriesM) {
//                            $findOne = \app\models\SubCategoriesCountries::findOne(['SUB_CATEGORY_ID' => $SubCategoryID, 'COUNTRY_ID' => $CountriesM->COUNTRY_ID]);
//                            if ($findOne != null && sizeof($findOne) > 0) {
//                                
//                            } else {
//                                $SubCategoryCountries->SUB_CATEGORY_ID = $SubCategoryID;
//                                $SubCategoryCountries->COUNTRY_ID = $CountriesM->COUNTRY_ID;
//                                $SubCategoryCountries->save(false);
//                            }
//                        }
//                    }
//                        }
//                    }
//                } else {
//                    $CategoryMo->CATEGORY_FLAG = 'H';
//                    $CategoryMo->BUSINESS_TYPE_ID =3;
//                    if ($CategoryMo->save(false)) {
//                        $CAtegoryID = $CategoryMo->getPrimaryKey();
//                        $CategoryMoTrans->CATEGORY_OF_ITEM_ID = $CAtegoryID;
//                        $CategoryMoTrans->CATEGORY_OF_ITEM_TRANS = $TemCategory;
//                        $CategoryMoTrans->LANGUAGE_ID = 1;
//                        $CategoryMoTrans->save(false);
//
//                        
//                        if ($WeddingType != null && sizeof($WeddingType) > 0) {
////                            $find0 = $find0->getModels();
//                            foreach ($WeddingType as $WeddingTy) {
//                                $findOne = \app\models\CategoriesWeddingType::findOne(['CATEGORY_ID' => $CAtegoryID, 'WEDDING_TYPE_ID' => $WeddingTy->WEDDING_TYPE_ID]);
//                                if ($findOne != null && sizeof($findOne) > 0) {
//                                    
//                                } else {
//                                    $CategoryWeddingTye->CATEGORY_ID = $CAtegoryID;
//                                    $CategoryWeddingTye->WEDDING_TYPE_ID = $WeddingTy->WEDDING_TYPE_ID;
//                                    $CategoryWeddingTye->save(false);
//                                }
//                            }
//                        } // Wedding Type For New CAtegories
//                         if ($Countries != null && sizeof($Countries) > 0) {
////                        $Countries = $Countries->getModels();
//                        foreach ($Countries as $CountriesM) {
//                            $findOne = \app\models\CategoriesCountries::findOne(['CATEGORY_ID' => $CAtegoryID, 'COUNTRY_ID' => $CountriesM->COUNTRY_ID]);
//                            if ($findOne != null && sizeof($findOne) > 0) {
//                                
//                            } else {
//                                $CategoruCountry->CATEGORY_ID = $CAtegoryID;
//                                $CategoruCountry->COUNTRY_ID = $CountriesM->COUNTRY_ID;
//                                $CategoruCountry->save(false);
//                            }
//                        }
//                    } // CAtegory Countries for New Categories
//
////            $CategoryID=$where->CATEGORY_OF_ITEM_ID;
//                        $SubCategory->CATEGORY_OF_ITEM_ID = $CAtegoryID;
//                        if ($SubCategory->save(false)) {
//                            $SubCategoryID = $SubCategory->getPrimaryKey();
//                            $SubCategoryTrans->LANGUAGE_ID = 1;
//                            $SubCategoryTrans->SUB_CATEGORY_ID = $SubCategoryID;
//                            $SubCategoryTrans->SUB_CATEGORY_NAME = $SubCategoryValue;
//                            $SubCategoryTrans->save(false);
//
//                            if ($WeddingType != null && sizeof($WeddingType) > 0) {
////                                $find0 = $find0->getModels();
//                                foreach ($WeddingType as $WeddingTy) {
//                                    $findOne = \app\models\SubCategoriesWeddingType::findOne(['SUB_CATEGORY_ID' => $SubCategoryID, 'WEDDING_TYPE_ID' => $WeddingTy->WEDDING_TYPE_ID]);
//                                    if ($findOne != null && sizeof($findOne) > 0) {
//                                        
//                                    } else {
//                                        $SubCategoryWeddingTye->SUB_CATEGORY_ID = $SubCategoryID;
//                                        $SubCategoryWeddingTye->WEDDING_TYPE_ID = $WeddingTy->WEDDING_TYPE_ID;
//                                        $SubCategoryWeddingTye->save(false);
//                                    }
//                                }
//                            } // Wedding Type For New Sub-CAtegories
//                            if ($Countries != null && sizeof($Countries) > 0) {
////                        $Countries = $Countries->getModels();
//                        foreach ($Countries as $CountriesM) {
//                            $findOne = \app\models\SubCategoriesCountries::findOne(['SUB_CATEGORY_ID' => $SubCategoryID, 'COUNTRY_ID' => $CountriesM->COUNTRY_ID]);
//                            if ($findOne != null && sizeof($findOne) > 0) {
//                                
//                            } else {
//                                $SubCategoryCountries->SUB_CATEGORY_ID = $SubCategoryID;
//                                $SubCategoryCountries->COUNTRY_ID = $CountriesM->COUNTRY_ID;
//                                $SubCategoryCountries->save(false);
//                            }
//                        }
//                    } // Countries For New Sub-CAtegories
//                        }
//                    }
//                }
//            }
//        }
//    }
//    new-guests&
}
 public function actionSaveInviteeImg() {
    Yii::error('Upload ');
        $model = new \app\models\Invitees();
        $InviteeID = Yii::$app->request->post('InviteeID');
        $WeddingID=0;
         if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        if ($InviteeID != 0 && $WeddingID!=0) {
            $RandN=rand();
            $imagetypes = array(
                'image/png' => '.png',
                'image/gif' => '.gif',
                'image/jpeg' => '.jpg',
                'image/bmp' => '.bmp');
            $ext = $imagetypes[$_FILES['image']['type']];
            
            $tmpImg = $_FILES['image']['tmp_name'];
            $SizeofImg = $_FILES['image']['size'];
            
            $findOne = \app\models\Invitees::findOne(['INVITEE_ID' => $InviteeID,'WEDDING_ID'=>$WeddingID]);
            if ($findOne != null) {
            if (!is_dir('uploads/InviteesImg' . $WeddingID)) {
                mkdir('uploads/InviteesImg' . $WeddingID, 0777, true);
            }
           
//        /PartnerImg'.$SizeofImg.rand()
            if ( move_uploaded_file($tmpImg, 'uploads/InviteesImg' . $WeddingID . '/InviteeImg'.$InviteeID. $ext)) {

                if ($findOne != null) {
                    $findOne->INVITEE_PIC = 'uploads/InviteesImg' . $WeddingID . '/InviteeImg' . $InviteeID.$ext;
                    $findOne->save(false);
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ['response' => 'uploads/InviteesImg' . $WeddingID . '/InviteeImg' . $InviteeID. $ext];
                } else {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ['error' => 'Login First'];
                }
            } else {

                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['error' => 'Error saving recipe images, Please enter valid images'];
            }
        }
        } 

    }
}
