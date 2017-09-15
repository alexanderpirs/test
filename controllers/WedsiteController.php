<?php

namespace app\controllers;

use app\models\Rsvp;
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

class WedsiteController extends \yii\web\Controller
{

    public $LastProductID = 0;

    public function actionGoToWedsite()
    {
        $Email = "";


        if (Yii::$app->request != null && Yii::$app->request->post('Email') != null) {
            $Email = Yii::$app->request->post('Email');
        }

        $PinCode = "";
        if (Yii::$app->request != null && Yii::$app->request->post('Code') != null) {
            $PinCode = Yii::$app->request->post('Code');
        }
        $DataPinCode = null;
        if ($PinCode != "" && $Email != "") {
            $DataPinCode = new ActiveDataProvider([
                'query' => \app\models\WedsiteInviteePinCode::find()->where(['INVITEE_PIN_CODE' => $PinCode, 'INVITEE_EMAIL' => $Email]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            Yii::error("Index PinCode " . $PinCode);
            if ($DataPinCode != null) {
                $DataPinCode = $DataPinCode->getModels();
                Yii::error("Index sizeof(DataPinCode) " . sizeof($DataPinCode));
                if ($DataPinCode != null && sizeof($DataPinCode) > 0) {
                    $InviteeEmail = $DataPinCode[0]->INVITEE_EMAIL;
                    $InviteeCode = $DataPinCode[0]->HASHED_CODE;

                    return $this->redirect(['wedsite/index',
                        'Code' => $InviteeCode,
                        'Email' => $InviteeEmail,
//            'dataProvider1' => $dataProvider1,
                    ]);
                }
            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['error' => 'Invalid Email/Pin'];
            }
        } else {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['error' => 'Invalid Email/Pin'];
        }
    }

    public function actionIndex()
    {
//        Email:Email ,
//                    Code:PinCode
        $Email = "";
        if (Yii::$app->request != null && Yii::$app->request->get('Email') != null) {
            $Email = Yii::$app->request->get('Email');
        }


        $Code = "";
        if (Yii::$app->request != null && Yii::$app->request->get('Code') != null) {
            $Code = Yii::$app->request->get('Code');
        }


        Yii::error("Index Code " . $Code);
        Yii::error("Index Email " . $Email);
        $DataInvitee = new ActiveDataProvider([
            'query' => \app\models\Invitees::find()->where(['INVITEE_EMAIL' => $Email]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        if ($DataInvitee != null) {
            $DataInvitee = $DataInvitee->getModels();
        }
        $DataWedsitePublishLink = new ActiveDataProvider([
            'query' => \app\models\WedsitePublishLink::find()->where(['LINK_PIN_CODE' => $Code]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        if ($DataWedsitePublishLink != null) {
            $DataWedsitePublishLink = $DataWedsitePublishLink->getModels();
        }
        Yii::error("Index DataWedsitePublishLink : " . sizeof($DataWedsitePublishLink));
        $InviteeWeddsingID = null;
        $PublishedWeddingID = null;
        if ($DataInvitee != null && sizeof($DataInvitee) > 0 && $DataWedsitePublishLink != null && sizeof($DataWedsitePublishLink) > 0) {
            $InviteeWeddsingID = $DataInvitee[0]->WEDDING_ID;
            $PublishedWeddingID = $DataWedsitePublishLink[0]->WEDDING_ID;
            Yii::error("Index InviteeWeddsingID " . $InviteeWeddsingID);
            Yii::error("Index PublishedWeddingID " . $PublishedWeddingID);
        }

        if ($PublishedWeddingID != null && $InviteeWeddsingID != null && $PublishedWeddingID == $InviteeWeddsingID) {
            $InviteeID = $DataInvitee[0]->INVITEE_ID;
            $InviteeName = $DataInvitee[0]->FIRST_INVITEE_NAME;
            Yii::error("Index InviteeID " . $InviteeID);
            Yii::error("Index InviteeName " . $InviteeName);
            return $this->render('index', [
                'InviteeID' => $InviteeID,
                'InviteeName' => $InviteeName,
//            'dataProvider1' => $dataProvider1,
            ]);
        } else {


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
            if (Yii::$app->user->identity == null) {
                $WeddingID = 1;
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

                'dataSupplierType' => $dataSupplierType,
                'dataSupplier' => $dataSupplier,
                'dataCity' => $dataCity,
                'Supplier' => $Supplier,
                'WeddingModel' => $WeddingModel
//            'dataProvider1' => $dataProvider1,
            ]);
        }


    }

    public function actionHome()
    {
        $WeddingID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        if (Yii::$app->user->identity == null) {
            $WeddingID = 1;
        }
        $WedsiteHomeData = null;
        if ($WeddingID != 0) {
            $WedsiteHomeData = new ActiveDataProvider([
                'query' => \app\models\WedsiteHome::find()->where('WEDDING_ID =' . $WeddingID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            if ($WedsiteHomeData != null) {
                $WedsiteHomeData = $WedsiteHomeData->getModels();
            }
        }
        $WedEventsData = new ActiveDataProvider([
            'query' => \app\models\WeddingTentativePeriodes::find()->where(['WEDDING_ID' => $WeddingID, 'IN_USE_OR_NO' => 'Y']),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        if ($WedEventsData != null) {
            $WedEventsData = $WedEventsData->getModels();
        }
        return $this->renderAjax('_home', [
            'WedsiteHomeData' => $WedsiteHomeData,
            'WedEventsData' => $WedEventsData,
        ], false, true);
    }

    public function actionAbout()
    {

        $FirstPartnerID = 0;
        $SecondPartnerID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $FirstPartnerID = Yii::$app->user->identity->weddings0[0]->FIRST_COUPLE_PARTNER_ID;
            $SecondPartnerID = Yii::$app->user->identity->weddings0[0]->SECOND_COUPLE_PARTNER_ID;

        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $FirstPartnerID = Yii::$app->user->identity->weddings[0]->FIRST_COUPLE_PARTNER_ID;
            $SecondPartnerID = Yii::$app->user->identity->weddings[0]->SECOND_COUPLE_PARTNER_ID;
        }
        $WeddingID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }

        if (Yii::$app->user->identity == null) {
            $WeddingID = 1;
        }
        $dataProviderWedsiteAbout = new ActiveDataProvider([
            'query' => \app\models\WedsiteAbout::find()->where(['WEDDING_ID' => $WeddingID]),
        ]);
        if ($dataProviderWedsiteAbout != null) {
            $dataProviderWedsiteAbout = $dataProviderWedsiteAbout->getModels();
        }

        $dataProviderItemsImg = new ActiveDataProvider([
            'query' => \app\models\WedsiteAboutGalery::find()->where(['WEDDING_ID' => $WeddingID]),
        ]);
        if ($dataProviderItemsImg != null) {
            $dataProviderItemsImg = $dataProviderItemsImg->getModels();
        }
        $dataProviderFamilyFirstPartner = new ActiveDataProvider([
            'query' => \app\models\WedsiteAboutFamily::find()->where(['WEDDING_ID' => $WeddingID, 'RELATED_TO' => $FirstPartnerID]),
        ]);
        if ($dataProviderFamilyFirstPartner != null) {
            $dataProviderFamilyFirstPartner = $dataProviderFamilyFirstPartner->getModels();
        }
        $dataProviderFamilySecondPartner = new ActiveDataProvider([
            'query' => \app\models\WedsiteAboutFamily::find()->where(['WEDDING_ID' => $WeddingID, 'RELATED_TO' => $SecondPartnerID]),
        ]);
        if ($dataProviderFamilySecondPartner != null) {
            $dataProviderFamilySecondPartner = $dataProviderFamilySecondPartner->getModels();
        }

        $dataProviderFirstTeam = new ActiveDataProvider([
            'query' => \app\models\WedsiteAboutTeam::find()->where(['WEDDING_ID' => $WeddingID, 'RELATED_TO' => $FirstPartnerID]),
        ]);
        if ($dataProviderFirstTeam != null) {
            $dataProviderFirstTeam = $dataProviderFirstTeam->getModels();
        }
        $dataProviderSecondTeam = new ActiveDataProvider([
            'query' => \app\models\WedsiteAboutTeam::find()->where(['WEDDING_ID' => $WeddingID, 'RELATED_TO' => $SecondPartnerID]),
        ]);
        if ($dataProviderSecondTeam != null) {
            $dataProviderSecondTeam = $dataProviderSecondTeam->getModels();
        }
        $FamilyModel = new \app\models\WedsiteAboutFamily();
        $TeamModel = new \app\models\WedsiteAboutTeam();
        return $this->renderAjax('about', [
            'dataProviderWedsiteAbout' => $dataProviderWedsiteAbout,
            'dataProviderItemsImg' => $dataProviderItemsImg,
            'dataProviderFamilySecondPartner' => $dataProviderFamilySecondPartner,
            'dataProviderFamilyFirstPartner' => $dataProviderFamilyFirstPartner,
            'dataProviderFirstTeam' => $dataProviderFirstTeam,
            'dataProviderSecondTeam' => $dataProviderSecondTeam,
            'FamilyModel' => $FamilyModel,
            'TeamModel' => $TeamModel
        ]);
    }

    public function actionCommunity()
    {
        $WeddingID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        if (Yii::$app->user->identity == null) {
            $WeddingID = 1;
        }
        $WedsiteTopicsModel = new \app\models\WedsiteTopics();
        $WedsiteTopicCommentsModel = new \app\models\WedsiteTopicComments();
        $dataProviderWedsiteTopics = new ActiveDataProvider([
            'query' => \app\models\WedsiteTopics::find()->where(['WEDDING_ID' => $WeddingID]),
        ]);
        if ($dataProviderWedsiteTopics != null) {
            $dataProviderWedsiteTopics = $dataProviderWedsiteTopics->getModels();
        }
        return $this->renderAjax('community', [
            'dataProviderWedsiteTopics' => $dataProviderWedsiteTopics,
            'WedsiteTopicsModel' => $WedsiteTopicsModel,
            'WedsiteTopicCommentsModel' => $WedsiteTopicCommentsModel,
        ]);
    }

    public function actionEvents()
    {
        $WeddingID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        if (Yii::$app->user->identity == null) {
            $WeddingID = 1;
        }
        $WedsiteEventsData = new ActiveDataProvider([
            'query' => \app\models\WedsiteEvents::find()->where(['WEDDING_ID' => $WeddingID]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        if ($WedsiteEventsData != null) {
            $WedsiteEventsData = $WedsiteEventsData->getModels();
        }
        $WedEventsData = new ActiveDataProvider([
            'query' => \app\models\WeddingTentativePeriodes::find()->where(['WEDDING_ID' => $WeddingID, 'IN_USE_OR_NO' => 'Y']),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        if ($WedEventsData != null) {
            $WedEventsData = $WedEventsData->getModels();
        }
        return $this->renderAjax('events', [
            'WedEventsData' => $WedEventsData,
            'WedsiteEventsData' => $WedsiteEventsData,
        ]);
    }

    public function actionLive()
    {
        return $this->renderAjax('_live', [
        ]);
    }

    public function actionRegister()
    {

        $WeddingID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        if (Yii::$app->user->identity == null) {
            $WeddingID = 1;
        }
        $dataProviderCategory = new ActiveDataProvider([
            'query' => \app\models\CategoryOfItems::find()->where(['CATEGORY_FLAG' => 'R']),
        ]);
        $ProductIDs = [];
        $i = 0;
        if ($dataProviderCategory != null) {
            $dataProviderCategory = $dataProviderCategory->getModels();
            if ($dataProviderCategory != null && sizeof($dataProviderCategory) > 0) {
//                subCategoriesOfItems  [] 
//                products[]
                foreach ($dataProviderCategory as $category) {
                    if ($category->subCategoriesOfItems != null && sizeof($category->subCategoriesOfItems) > 0) {
                        foreach ($category->subCategoriesOfItems as $Sub) {
                            if ($Sub->products != null && sizeof($Sub->products) > 0) {
                                foreach ($Sub->products as $Produc) {
                                    $ProductIDs[$i] = $Produc->PRODUCT_ID;
                                    $i++;
                                }
                            }
                        }
                    }
                }
            }
        }

        $sortingby = "";
        if (Yii::$app->request != null && Yii::$app->request->get('sortingby') != null) {
            $sortingby = Yii::$app->request->get('sortingby');
        }
        $Reg = "";
        if (Yii::$app->request != null && Yii::$app->request->get('Reg') != null) {
            $Reg = Yii::$app->request->get('Reg');
        }
        $SortByMethod = "";
        if (Yii::$app->request != null && Yii::$app->request->get('SortByMethod') != null) {
            $SortByMethod = Yii::$app->request->get('SortByMethod');
        }
//        sorting
        $productID = 0;
        if (Yii::$app->request != null && Yii::$app->request->get('productID') != null) {
            $productID = Yii::$app->request->get('productID');
        }

        $LocationID = 0;
        if (Yii::$app->request != null && Yii::$app->request->get('Location') != null && Yii::$app->request->get('Location') != '') {
            $LocationID = Yii::$app->request->get('Location');
        }
        $SupplierTypeID = 0;
        if (Yii::$app->request != null && Yii::$app->request->get('SupplierTypeID') != null && Yii::$app->request->get('SupplierTSupplierTypeSupplierTypeypeID') != '') {
            $SupplierTypeID = Yii::$app->request->get('SupplierType');
        }
        $SupplierID = 0;
        if (Yii::$app->request != null && Yii::$app->request->get('SupplierName') != null && Yii::$app->request->get('SupplierName') != '') {
            $SupplierID = Yii::$app->request->get('SupplierName');
        }
        $searchterms = '';
        if (Yii::$app->request != null && Yii::$app->request->get('searchterms') != null && Yii::$app->request->get('searchterms') != '') {
            $searchterms = Yii::$app->request->get('searchterms');
        }
        $minprice = '';
        if (Yii::$app->request != null && Yii::$app->request->get('min-price') != null && Yii::$app->request->get('min-price') != '') {
            $minprice = Yii::$app->request->get('min-price');
        }
        $maxprice = '';
        if (Yii::$app->request != null && Yii::$app->request->get('max-price') != null && Yii::$app->request->get('max-price') != '') {
            $maxprice = Yii::$app->request->get('max-price');
        }
        $cookies = Yii::$app->response->cookies;

        $session = Yii::$app->session;
        $session['sortMethod'] = $SortByMethod;
//$sortMethod = $cookies->getValue('sortMethod', 'ASC');
//        $session['ColumnName'] = $sortingby;
//        $session['sortMethod'] = $SortByMethod;
//        Yii::error("SESSION['sortMethod'] : " . $SortByMethod);
        //            searchterms='+searchterms+'&minprice='+minprice+'&maxprice='+maxprice
        //       'LocationID=' + LocationID+'&SupplierTypeID='+SupplierTypeID+'&SupplierID='+SupplierID,
        Yii::error("Index Controller productID : " . $productID);

        $CouplePartnerID = 0;
        $WeddingID = 0;

        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }
        $dataProviderSuplliers = new ActiveDataProvider([
            'query' => Suppliers::find(),
        ]);
        $dataProviderItems = null;
        if ($productID != 0 && $LocationID == 0 && $SupplierID == 0 && $SupplierTypeID == 0) {
            $dataProviderItems = new ActiveDataProvider([
                'query' => Products::find()->where(['PRODUCT_ID' => $productID]),
            ]);
        } else {
            $Cond = [];
            if ($SupplierID != 0) {
                $Cond['items_supplieirs.SUPPLIER_ID'] = $SupplierID;
            }
            if ($LocationID != 0) {
                $Cond['suppliers.CITY_ID'] = $LocationID;
            }
            if ($SupplierTypeID != 0) {
                $Cond['suppliers.SUPPLIER_TYPE_ID'] = $SupplierTypeID;
            }

//            searchterms='+searchterms+'&minprice='+minprice+'&maxprice='+maxprice

            if (($Cond != null && $Cond != '' && sizeof($Cond > 0))) {


//                    $Cond['items_trans.ITEM_NAME'] = '%' . $searchterms . '%';
//                    Yii::error("Index Controller productID helloooo   : " . $Cond['items_supplieirs.SUPPLIER_ID']);
                $dataProviderItems = new ActiveDataProvider([
//            'query' => Suppliers::find()->where($Cond),
                    'query' => Products::find()->innerJoin('products_trans', 'products_trans.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items', 'items.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items_supplieirs', 'items.ITEM_ID=items_supplieirs.ITEM_ID')->innerJoin('suppliers', 'items_supplieirs.SUPPLIER_ID=suppliers.SUPPLIER_ID')->innerJoin('items_trans', 'items_trans.ITEM_ID=items.ITEM_ID')->where($Cond)->andWhere('(products_trans.PRODUCT_NAME LIKE \'%' . $searchterms . '%\' OR suppliers.SUPPLIER_NAME LIKE \'%' . $searchterms . '%\' )'),
                ]);
            } else {
                $dataProviderItems = new ActiveDataProvider([
//            'query' => Suppliers::find()->where($Cond),
                    'query' => Products::find()->innerJoin('products_trans', 'products_trans.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items', 'items.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items_supplieirs', 'items.ITEM_ID=items_supplieirs.ITEM_ID')->innerJoin('suppliers', 'items_supplieirs.SUPPLIER_ID=suppliers.SUPPLIER_ID')->innerJoin('items_trans', 'items_trans.ITEM_ID=items.ITEM_ID')->where('(products_trans.PRODUCT_NAME LIKE \'%' . $searchterms . '%\' OR suppliers.SUPPLIER_NAME LIKE \'%' . $searchterms . '%\' )'),
                ]);
            }
        }

        $CouplePartnerID = 0;
        $WeddingID = 0;

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
        if (Yii::$app->user->identity == null) {
            $WeddingID = 1;
        }
//        $TransModel=  \app\models\AgendaPeriodeTranslation();
//        $TransModel->


        $CategoryOfItemsDataProvider = new ActiveDataProvider([
            'query' => CategoryOfItems::find()->where(['CATEGORY_FLAG' => 'C']),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
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


        $dataCity = new ActiveDataProvider([
            'query' => \app\models\CitiesTranslation::findBySql('select t.CITY_ID, t.CITY_TRANSLATION from cities inner join cities_translation t on cities.CITY_ID=t.CITY_ID where cities.COUNTRY_ID = 1 AND t.LANGUAGE_ID=1 '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        $dataSupplierType = new ActiveDataProvider([
            'query' => \app\models\SuplierTypeTrans::find()->select(['suplier_type_trans.SUPLIER_TYPE_ID', 'suplier_type_trans.SUPLIER_TYPE_NAME'])->where(' LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        $dataSupplier = new ActiveDataProvider([
            'query' => Suppliers::find()->where('COUNTRY_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $Supplier = new \app\models\Suppliers();


        return $this->renderAjax('_register', [
            'ProductIDs' => $ProductIDs,
            'dataProvider' => $dataProvider,
            'dataProvider1' => $dataProvider1,
            'CategoryOfItemsDataProvider' => $CategoryOfItemsDataProvider,
            'WeddingEventDataProvider' => $WeddingEventDataProvider,
            'dataProviderItems' => $dataProviderItems,
            'dataSupplierType' => $dataSupplierType,
            'dataSupplier' => $dataSupplier,
            'dataCity' => $dataCity,
            'Supplier' => $Supplier,
            'WeddingModel' => $WeddingModel,
        ]);
    }

    public function getItemsByProductID($ProductID)
    {
        $WeddingID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        if (Yii::$app->user->identity == null) {
            $WeddingID = 1;
        }
        $dataProviderRegistrySelectedItems = new ActiveDataProvider([
            'query' => \app\models\RegistrySelectedItems::find()->where(['WEDDING_ID' => $WeddingID, 'PRODUCT_ID' => $ProductID]),
        ]);

        if ($dataProviderRegistrySelectedItems != null) {
            $dataProviderRegistrySelectedItems = $dataProviderRegistrySelectedItems->getModels();
        }
        return $dataProviderRegistrySelectedItems;
    }

    public function actionAddWeddingEventHome()
    {
        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }

        $WedsiteHomeEvents = new \app\models\WedsiteHomeEvents();

//        EventID:EventID,
//                 Description : instance3.getData()

        $data = Yii::$app->request->post();
//        Info  
        $EventID = "";
        if (isset($data['EventID'])) {
            $EventID = $data['EventID'];
        }
        $Description = "";
        if (isset($data['Description'])) {
            $Description = $data['Description'];
        }
        $Date = "";

        if (isset($data['Date'])) {
            $Date = $data['Date'];
        }


//        ProducValue: ProducValue,
//                    SubCategoryID : $SubCategoryID ,
        if ($EventID != "") {
            $findOne = $WedsiteHomeEvents->find(['WEDDING_ID' => $WeddingID, 'EVENT_ID' => $EventID])->one();
            if ($findOne != null) {
                if ($Description != "") {
                    $findOne->EVENT_DESCIPTION = $Description;
                }
                $findOne->save(false);

                Yii::$app->response->format = Response::FORMAT_JSON;

                return ['response' => 'true'];
            } else {
                $WedsiteHomeEvents->WEDDING_ID = $WeddingID;
                $WedsiteHomeEvents->EVENT_ID = $EventID;
                if ($Description != "") {
                    $WedsiteHomeEvents->EVENT_DESCIPTION = $Description;
                }
                if ($Date != "") {
                    $WedsiteHomeEvents->EVENT_DATE_TIME = $Date;
                }
                $WedsiteHomeEvents->save(false);
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['response' => 'true'];
            }
        }
    }

    public function actionAddGetStartHome()
    {
        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }

        $WedsiteHome = new \app\models\WedsiteHome();
        $data = Yii::$app->request->post();
//        Info  
        $WedsiteGetStartValue = "";
        if (isset($data['GetStart'])) {
            $WedsiteGetStartValue = $data['GetStart'];
        }
        $SaveDate = "";
        if (isset($data['SaveDate'])) {
            $SaveDate = $data['SaveDate'];
        }
        $HotelName = "";
        if (isset($data['HotelName'])) {
            $HotelName = $data['HotelName'];
        }
        $WelcomeTitle = "";
        if (isset($data['WelcomeTitle'])) {
            $WelcomeTitle = $data['WelcomeTitle'];
        }
        $Info = "";
        if (isset($data['Info'])) {
            $Info = $data['Info'];
        }

        $CustomHeaderParagr = "";
        if (isset($data['CustomParag'])) {
            $CustomHeaderParagr = $data['CustomParag'];
        }

        $CustomHeader = "";
        if (isset($data['CustomHeader'])) {
            $CustomHeader = $data['CustomHeader'];
        }
//         
        Yii::error('BudgetID : ' . $WedsiteGetStartValue);
//        ProducValue: ProducValue,
//                    SubCategoryID : $SubCategoryID ,
        $findOne = $WedsiteHome->findOne(['WEDDING_ID' => $WeddingID]);
        if ($findOne != null) {
            if ($WedsiteGetStartValue != "") {
                $findOne->GET_START = $WedsiteGetStartValue;
            }
            if ($SaveDate != "") {
                $findOne->SAVE_THE_DATE = $SaveDate;
            }
            if ($HotelName != "") {
                $findOne->HOTEL_NAME = $HotelName;
            }
            if ($WelcomeTitle != "") {
                $findOne->WELCOME = $WelcomeTitle;
            }

            if ($Info != "") {
                $findOne->INFO = $Info;
            }
            if ($CustomHeader != "") {
                $findOne->CUSTOM = $CustomHeader;
            }
            if ($CustomHeaderParagr != "") {
                $findOne->CUSTOM_PARAG = $CustomHeaderParagr;
            }

            $findOne->save(false);

            Yii::$app->response->format = Response::FORMAT_JSON;

            return ['response' => 'true'];
        } else {
            $WedsiteHome->WEDDING_ID = $WeddingID;
            if ($WedsiteGetStartValue != "") {
                $WedsiteHome->GET_START = $WedsiteGetStartValue;
            }
            if ($SaveDate != "") {
                $findOne->SAVE_THE_DATE = $SaveDate;
            }
            if ($HotelName != "") {
                $WedsiteHome->HOTEL_NAME = $HotelName;
            }
            if ($WelcomeTitle != "") {
                $WedsiteHome->WELCOME = $WelcomeTitle;
            }
            if ($Info != "") {
                $WedsiteHome->INFO = $Info;
            }
            if ($CustomHeader != "") {
                $WedsiteHome->CUSTOM = $CustomHeader;
            }
            if ($CustomHeaderParagr != "") {
                $WedsiteHome->CUSTOM_PARAG = $CustomHeaderParagr;
            }
            $WedsiteHome->save(false);
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['response' => 'true'];
        }
    }

//add-event-info",
//                {
//                 EventID:EventID,
//                 EventEditHotel : instance3.getData()
//                 EventEdit : instance4.getData();

    public function actionAddEventInfo()
    {
        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }

        $WedsiteEventsInfo = new \app\models\WedsiteEventsInfo();
        $data = Yii::$app->request->post();
//        Info  
        $EventEditHotel = null;
        if (isset($data['EventEditHotel'])) {
            $EventEditHotel = $data['EventEditHotel'];
        }
        $Address = null;
        if (isset($data['Address'])) {
            $Address = $data['Address'];
        }

        $EventEdit = null;
        if (isset($data['EventDescription'])) {
            $EventEdit = $data['EventDescription'];
        }
        $EventAttire = null;
        if (isset($data['EventAttire'])) {
            $EventAttire = $data['EventAttire'];
        }
        $Transport = null;
        if (isset($data['Transport'])) {
            $Transport = $data['Transport'];
        }

        $EventDate = null;
        if (isset($data['EventDate'])) {
            $EventDate = $data['EventDate'];
        }
        $EventID = 0;
        if (isset($data['EventID'])) {
            $EventID = $data['EventID'];
        }
        if ($EventID != 0) {
            $findOne = $WedsiteEventsInfo->findOne(['WEDDING_ID' => $WeddingID, 'WEDDING_EVENT_ID' => $EventID]);
            if ($findOne != null) {
                if ($EventEditHotel != null) {
                    $findOne->EVENT_PLACE_NAME = $EventEditHotel;
                }
                if ($Transport != null) {
                    $findOne->TRANSPORT = $Transport;
                }
                if ($EventAttire != null) {
                    $findOne->EVENT_ATTIRE = $EventAttire;
                }
                if ($Address != null) {
                    $findOne->EVENT_ADDRESS = $Address;
                }
                if ($EventDate != null) {
                    $findOne->EVNET_DATE = $EventDate;
                }
                if ($EventEdit != null) {
                    $findOne->EVENT_DESCRIPTION = $EventEdit;
                }
                $findOne->save(false);

                Yii::$app->response->format = Response::FORMAT_JSON;

                return ['response' => 'true'];
            } else {
                $WedsiteEventsInfo->WEDDING_ID = $WeddingID;
                if ($EventID != 0) {
                    $WedsiteEventsInfo->WEDDING_EVENT_ID = $EventID;
                }
                if ($EventEditHotel != null) {
                    $WedsiteEventsInfo->EVENT_PLACE_NAME = $EventEditHotel;
                }
                if ($Transport != null) {
                    $WedsiteEventsInfo->TRANSPORT = $Transport;
                }
                if ($Address != null) {
                    $WedsiteEventsInfo->EVENT_ADDRESS = $Address;
                }
                if ($EventDate != null) {
                    $WedsiteEventsInfo->EVNET_DATE = $EventDate;
                }
                if ($EventAttire != null) {
                    $WedsiteEventsInfo->EVENT_ATTIRE = $EventAttire;
                }
                if ($EventEdit != null) {
                    $WedsiteEventsInfo->EVENT_DESCRIPTION = $EventEdit;
                }
                $WedsiteEventsInfo->save(false);
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['response' => 'true'];
            }
        }
    }

    public function actionAddEvents()
    {
        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }

        $WedsiteEvents = new \app\models\WedsiteEvents();
        $data = Yii::$app->request->post();
//        Info  
        $EventWelcome = "";
        if (isset($data['EventWelcome'])) {
            $EventWelcome = $data['EventWelcome'];
        }

        $findOne = $WedsiteEvents->findOne(['WEDDING_ID' => $WeddingID]);
        if ($findOne != null) {
            if ($EventWelcome != "") {
                $findOne->WEDSITE_EVENT_WELCOME = $EventWelcome;
            }

            $findOne->save(false);

            Yii::$app->response->format = Response::FORMAT_JSON;

            return ['response' => 'true'];
        } else {
            $WedsiteEvents->WEDDING_ID = $WeddingID;
            if ($EventWelcome != "") {
                $WedsiteEvents->WEDSITE_EVENT_WELCOME = $EventWelcome;
            }

            $WedsiteEvents->save(false);
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['response' => 'true'];
        }
    }

    public function actionUploadGalery()
    {
        Yii::error('Upload ');
        $model = new \app\models\WedsiteAboutGalery();

        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        $tmpImg = $_FILES['imageFile']['tmp_name'];
        if (!is_dir('WedisteAboutGaleryImg/AboutGaleryImg' . $WeddingID)) {
            mkdir('WedisteAboutGaleryImg/AboutGaleryImg' . $WeddingID, 0777, true);
        }
        if (move_uploaded_file($tmpImg, 'WedisteAboutGaleryImg/AboutGaleryImg' . $WeddingID . '/' . $_FILES['imageFile']['name'])) {
//                            $ItemsSupplieirsImgsModel->ITEM_SUPPLIER_ID = $ItemSupplierID;
//                            $ItemsSupplieirsImgsModel->IMG_PATH = 'WedisteAboutGaleryImg/AboutGaleryImg'.$WeddingID. '/' . $_FILES['imageFile']['name'];
//                            Yii::error("testingImg/SupplierImg : " . 'testingImg/SupplierImg' . $SupplierID . '/SupplierItem' . $ItemSupplierID . '/' . $SelectedstepImg);
//                            $ItemsSupplieirsImgsModel->save(false);
            $model->IMAGE_PATH = 'WedisteAboutGaleryImg/AboutGaleryImg' . $WeddingID . '/' . $_FILES['imageFile']['name'];
            $model->WEDDING_ID = $WeddingID;
            $model->save(false);
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['response' => 'WedisteAboutGaleryImg/AboutGaleryImg' . $WeddingID . '/' . $_FILES['imageFile']['name']];
        } else {

            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['error' => 'Error saving recipe images, Please enter valid images'];
        }
    }

    public function actionUploadImg()
    {
//        WELCOME_PIC

        Yii::error('Upload ');
        $model = new \app\models\WedsiteHome();

        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        $imagetypes = array(
            'image/png' => '.png',
            'image/gif' => '.gif',
            'image/jpeg' => '.jpg',
            'image/bmp' => '.bmp');
        $ext = $imagetypes[$_FILES['ImageFile']['type']];
        $findOne = $model->findOne(['WEDDING_ID' => $WeddingID]);
        $tmpImg = $_FILES['ImageFile']['tmp_name'];
        if (!is_dir('AllWedsiteImgs/HomePageImgs/HomePage' . $WeddingID)) {
            mkdir('AllWedsiteImgs/HomePageImgs/HomePage' . $WeddingID, 0777, true);
        }
        if (move_uploaded_file($tmpImg, 'AllWedsiteImgs/HomePageImgs/HomePage' . $WeddingID . '/WelcomeHomePage' . $WeddingID . $ext)) {

            if ($findOne != null) {
                $findOne->WELCOME_PIC = 'AllWedsiteImgs/HomePageImgs/HomePage' . $WeddingID . '/WelcomeHomePage' . $WeddingID . $ext;
                $findOne->save(false);
            } else {
                $model->WELCOME_PIC = 'AllWedsiteImgs/HomePageImgs/HomePage' . $WeddingID . '/WelcomeHomePage' . $WeddingID . $ext;
                $model->WEDDING_ID = $WeddingID;
                $model->save(false);
            }

            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['response' => 'AllWedsiteImgs/HomePageImgs/HomePage' . $WeddingID . '/WelcomeHomePage' . $WeddingID . $ext];
        } else {

            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['error' => 'Error saving recipe images, Please enter valid images'];
        }
    }

    public function actionUploadCustomImg()
    {
//        WELCOME_PIC

        Yii::error('Upload ');
        $model = new \app\models\WedsiteHome();

        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        $imagetypes = array(
            'image/png' => '.png',
            'image/gif' => '.gif',
            'image/jpeg' => '.jpg',
            'image/bmp' => '.bmp');
        $ext = $imagetypes[$_FILES['ImageFile']['type']];
        $findOne = $model->findOne(['WEDDING_ID' => $WeddingID]);
        $tmpImg = $_FILES['ImageFile']['tmp_name'];
        if (!is_dir('AllWedsiteImgs/HomePageImgs/HomePage' . $WeddingID)) {
            mkdir('AllWedsiteImgs/HomePageImgs/HomePage' . $WeddingID, 0777, true);
        }
        if (move_uploaded_file($tmpImg, 'AllWedsiteImgs/HomePageImgs/HomePage' . $WeddingID . '/CustomImg' . $WeddingID . $ext)) {

            if ($findOne != null) {
                $findOne->CUSTOM_PIC = 'AllWedsiteImgs/HomePageImgs/HomePage' . $WeddingID . '/CustomImg' . $WeddingID . $ext;
                $findOne->save(false);
            } else {
                $model->CUSTOM_PIC = 'AllWedsiteImgs/HomePageImgs/HomePage' . $WeddingID . '/CustomImg' . $WeddingID . $ext;
                $model->WEDDING_ID = $WeddingID;
                $model->save(false);
            }

            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['response' => 'AllWedsiteImgs/HomePageImgs/HomePage' . $WeddingID . '/CustomImg' . $WeddingID . $ext];
        } else {

            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['error' => 'Error saving recipe images, Please enter valid images'];
        }
    }

    public function actionUploadHeaderImg()
    {
//        WELCOME_PIC

        Yii::error('Upload ');
        $model = new \app\models\WedsiteHome();

        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        $imagetypes = array(
            'image/png' => '.png',
            'image/gif' => '.gif',
            'image/jpeg' => '.jpg',
            'image/bmp' => '.bmp');
        $ext = $imagetypes[$_FILES['ImageFile']['type']];
        $findOne = $model->findOne(['WEDDING_ID' => $WeddingID]);
        $tmpImg = $_FILES['ImageFile']['tmp_name'];
        if (!is_dir('AllWedsiteImgs/HomePageImgs/HomePage' . $WeddingID)) {
            mkdir('AllWedsiteImgs/HomePageImgs/HomePage' . $WeddingID, 0777, true);
        }
        if (move_uploaded_file($tmpImg, 'AllWedsiteImgs/HomePageImgs/HomePage' . $WeddingID . '/HeaderImg' . $WeddingID . $ext)) {

            if ($findOne != null) {
                $findOne->HEADER_PIC = 'AllWedsiteImgs/HomePageImgs/HomePage' . $WeddingID . '/HeaderImg' . $WeddingID . $ext;
                $findOne->save(false);
            } else {
                $model->HEADER_PIC = 'AllWedsiteImgs/HomePageImgs/HomePage' . $WeddingID . '/HeaderImg' . $WeddingID . $ext;
                $model->WEDDING_ID = $WeddingID;
                $model->save(false);
            }

            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['response' => 'AllWedsiteImgs/HomePageImgs/HomePage' . $WeddingID . '/HeaderImg' . $WeddingID . $ext];
        } else {

            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['error' => 'Error saving recipe images, Please enter valid images'];
        }
    }

    public function actionSaveprofileimg()
    {
        Yii::error('Upload ');
        $model = new \app\models\CouplePartner();
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
        $Image = $_POST['image'];
        $exp = explode(',', $Image);
        $data = base64_decode($exp[1]);
        if (!is_dir('ProfilePics/Wedding' . $WeddingID)) {
            mkdir('ProfilePics/Wedding' . $WeddingID, 0777, true);
        }
        $findOne = $model->findOne(['COUPLE_PARTNER_ID' => $CouplePartnerID]);
        if (file_put_contents('ProfilePics/Wedding' . $WeddingID . '/ProfilePicForPartner' . $CouplePartnerID . '.png', $data)) {

            if ($findOne != null) {
                $findOne->USER_PROFILE_PIC = 'ProfilePics/Wedding' . $WeddingID . '/ProfilePicForPartner' . $CouplePartnerID . '.png';
                $findOne->save(false);
            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['error' => 'User Don\'t Exist'];
            }

            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['response' => 'ProfilePics/Wedding' . $WeddingID . '/ProfilePicForPartner' . $CouplePartnerID . '.png'];
        } else {

            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['error' => 'Error saving recipe images, Please enter valid images'];
        }
    }

    public function actionUploadEventImg()
    {
//        WELCOME_PIC

        Yii::error('Upload ');
        $model = new \app\models\WedsiteEventsInfo();
        $EventID = $_POST['EventID'];
        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        $Image = $_POST['image'];
        $exp = explode(',', $Image);
        $data = base64_decode($exp[1]);
        if (!is_dir('AllWedsiteImgs/EventPages/EventPage' . $WeddingID . '/EventImgs' . $WeddingID)) {
            mkdir('AllWedsiteImgs/EventPages/EventPage' . $WeddingID . '/EventImgs' . $WeddingID, 0777, true);
        }
        $findOne = $model->findOne(['WEDDING_ID' => $WeddingID, 'WEDDING_EVENT_ID' => $EventID]);
        if (file_put_contents('AllWedsiteImgs/EventPages/EventPage' . $WeddingID . '/EventImgs' . $WeddingID . '/EventName' . $EventID . '.png', $data)) {

            if ($findOne != null) {
                $findOne->EVENT_IMG = 'AllWedsiteImgs/EventPages/EventPage' . $WeddingID . '/EventImgs' . $WeddingID . '/EventName' . $EventID . '.png';
                $findOne->save(false);
            } else {
                $model->EVENT_IMG = 'AllWedsiteImgs/EventPages/EventPage' . $WeddingID . '/EventImgs' . $WeddingID . '/EventName' . $EventID . '.png';
                $model->WEDDING_ID = $WeddingID;
                $model->EVENT_ID = $EventID;
                $model->save(false);
            }

            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['response' => 'AllWedsiteImgs/EventPages/EventPage' . $WeddingID . '/EventImgs' . $WeddingID . '/EventName' . $EventID . '.png'];
        } else {

            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['error' => 'Error saving recipe images, Please enter valid images'];
        }
    }

    public function actionUploadFamilyImg()
    {
//        WELCOME_PIC

        Yii::error('Upload ');
        $model = new \app\models\WedsiteAboutFamily();
        $FamilyMemberID = $_POST['FamilyMemberID'];

        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        $Image = $_POST['image'];
        $exp = explode(',', $Image);
        $data = base64_decode($exp[1]);
        if (!is_dir('AllFamilyGalery/FamilyPic' . $WeddingID)) {
            mkdir('AllFamilyGalery/FamilyPic' . $WeddingID, 0777, true);
        }
        $findOne = $model->findOne(['WEDSITE_ABOUT_FAMILY_ID' => $FamilyMemberID, 'WEDDING_ID' => $WeddingID]);
        if (file_put_contents('AllFamilyGalery/FamilyPic' . $WeddingID . '/FamilyMemeberPic' . $FamilyMemberID . '.png', $data)) {

            if ($findOne != null) {
                $findOne->FAMILY_MEMBER_PIC = 'AllFamilyGalery/FamilyPic' . $WeddingID . '/FamilyMemeberPic' . $FamilyMemberID . '.png';
                $findOne->save(false);
            }

            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['response' => 'AllFamilyGalery/FamilyPic' . $WeddingID . '/FamilyMemeberPic' . $FamilyMemberID . '.png'];
        } else {

            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['error' => 'Error saving recipe images, Please enter valid images'];
        }
    }

    public function actionUploadTeamImg()
    {
//        WELCOME_PIC

        Yii::error('Upload ');
        $model = new \app\models\WedsiteAboutTeam();
        $TeamMemberID = $_POST['TeamMemberID'];

        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        $Image = $_POST['image'];
        $exp = explode(',', $Image);
        $data = base64_decode($exp[1]);
        if (!is_dir('AllTeamGalery/TeamPic' . $WeddingID)) {
            mkdir('AllTeamGalery/TeamPic' . $WeddingID, 0777, true);
        }
        $findOne = $model->findOne(['WEDSITE_ABOUT_TEAM_ID' => $TeamMemberID, 'WEDDING_ID' => $WeddingID]);
        if (file_put_contents('AllTeamGalery/TeamPic' . $WeddingID . '/TeamMemeberPic' . $TeamMemberID . '.png', $data)) {

            if ($findOne != null) {
                $findOne->TEAM_MEMBER_PIC = 'AllTeamGalery/TeamPic' . $WeddingID . '/TeamMemeberPic' . $TeamMemberID . '.png';
                $findOne->save(false);
            }

            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['response' => 'AllTeamGalery/TeamPic' . $WeddingID . '/TeamMemeberPic' . $TeamMemberID . '.png'];
        } else {

            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['error' => 'Error saving recipe images, Please enter valid images'];
        }
    }

    public function actionUploadImgSaveDate()
    {
//        WELCOME_PIC

        Yii::error('Upload ');
        $model = new \app\models\WedsiteHomeEvents();
        $EventID = $_POST['EventID'];
        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        $imagetypes = array(
            'image/png' => '.png',
            'image/gif' => '.gif',
            'image/jpeg' => '.jpg',
            'image/bmp' => '.bmp');
        $ext = $imagetypes[$_FILES['EventName' . $EventID]['type']];
        $findOne = $model->findOne(['WEDDING_ID' => $WeddingID, 'EVENT_ID' => $EventID]);
        $tmpImg = $_FILES['EventName' . $EventID]['tmp_name'];
        if (!is_dir('AllWedsiteImgs/HomePageImgs/HomePage' . $WeddingID . '/EventImg' . $WeddingID)) {
            mkdir('AllWedsiteImgs/HomePageImgs/HomePage' . $WeddingID . '/EventImg' . $WeddingID, 0777, true);
        }
        if (move_uploaded_file($tmpImg, 'AllWedsiteImgs/HomePageImgs/HomePage' . $WeddingID . '/EventImg' . $WeddingID . '/EventName' . $EventID . $WeddingID . $ext)) {

            if ($findOne != null) {
                $findOne->IMG_PATH = 'AllWedsiteImgs/HomePageImgs/HomePage' . $WeddingID . '/EventImg' . $WeddingID . '/EventName' . $EventID . $WeddingID . $ext;
                $findOne->save(false);
            } else {
                $model->IMG_PATH = 'AllWedsiteImgs/HomePageImgs/HomePage' . $WeddingID . '/EventImg' . $WeddingID . '/EventName' . $EventID . $WeddingID . $ext;
                $model->WEDDING_ID = $WeddingID;
                $model->EVENT_ID = $EventID;
                $model->save(false);
            }

            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['response' => 'AllWedsiteImgs/HomePageImgs/HomePage' . $WeddingID . '/EventImg' . $WeddingID . '/EventName' . $EventID . $WeddingID . $ext];
        } else {

            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['error' => 'Error saving recipe images, Please enter valid images'];
        }
    }


//                    TeamMemberID : $SecondTeam->WEDSITE_ABOUT_TEAM_ID,
//                    TeamMemberDesc:CKEDITOR.instances['SecondTeamDesc$SecondTeam->WEDSITE_ABOUT_TEAM_ID'].getData() ,
    public function actionAddWedsiteAboutTeam()
    {
        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        Yii::error('AddWedsiteAboutTeam ');
        $WedsiteAboutTeam = new \app\models\WedsiteAboutTeam();

        $data = Yii::$app->request->post();
//        Info  
        $TeamMemberID = 0;
        if (isset($data['TeamMemberID'])) {
            $TeamMemberID = $data['TeamMemberID'];
        }

        $TeamMemberName = null;
        if (isset($data['TeamMemberName'])) {
            $TeamMemberName = $data['TeamMemberName'];
        }

        $TeamMemberDesc = null;
        if (isset($data['TeamMemberDesc'])) {
            $TeamMemberDesc = $data['TeamMemberDesc'];
        }


//        ProducValue: ProducValue,
//                    SubCategoryID : $SubCategoryID ,

        $findOne = $WedsiteAboutTeam->find()->where(['WEDDING_ID' => $WeddingID, 'WEDSITE_ABOUT_TEAM_ID' => $TeamMemberID])->one();
        if ($findOne != null) {
            if ($TeamMemberName != null) {
                $findOne->WEDSITE_ABOUT_TEAM_MEMBER_NAME = $TeamMemberName;
            }
            if ($TeamMemberDesc != null) {
                $findOne->WEDSITE_ABOUT_TEAM_MEMBER_DESC = $TeamMemberDesc;
            }


            $findOne->save(false);

            Yii::$app->response->format = Response::FORMAT_JSON;

            return ['response' => 'true'];
        } else {
            $WedsiteAboutTeam->WEDDING_ID = $WeddingID;

            if ($TeamMemberName != null) {
                $WedsiteAboutTeam->WEDSITE_ABOUT_FAMILY_NAME = $TeamMemberName;
            }
            if ($TeamMemberDesc != null) {
                $WedsiteAboutTeam->WEDSITE_ABOUT_FAMILY_DESCRIPTION = $TeamMemberDesc;
            }
            $WedsiteAboutTeam->save(false);
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['response' => 'true'];
        }
    }

    public function actionAddWedsiteAboutFamily()
    {
        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }

        $WedsiteAboutFamily = new \app\models\WedsiteAboutFamily();

        $data = Yii::$app->request->post();
//        Info  
        $FimalyMemberID = 0;
        if (isset($data['FimalyMemberID'])) {
            $FimalyMemberID = $data['FimalyMemberID'];
        }

        $FamilyMemberName = null;
        if (isset($data['FamilyMemberName'])) {
            $FamilyMemberName = $data['FamilyMemberName'];
        }

        $FamilyMemberDesc = null;
        if (isset($data['FamilyMemberDesc'])) {
            $FamilyMemberDesc = $data['FamilyMemberDesc'];
        }


//        ProducValue: ProducValue,
//                    SubCategoryID : $SubCategoryID ,

        $findOne = $WedsiteAboutFamily->find(['WEDDING_ID' => $WeddingID, 'WEDSITE_ABOUT_FAMILY_ID' => $FimalyMemberID])->one();
        if ($findOne != null) {
            if ($FamilyMemberName != null) {
                $findOne->WEDSITE_ABOUT_FAMILY_NAME = $FamilyMemberName;
            }
            if ($FamilyMemberDesc != null) {
                $findOne->WEDSITE_ABOUT_FAMILY_DESCRIPTION = $FamilyMemberDesc;
            }


            $findOne->save(false);

            Yii::$app->response->format = Response::FORMAT_JSON;

            return ['response' => 'true'];
        } else {
            $WedsiteAboutFamily->WEDDING_ID = $WeddingID;

            if ($FamilyMemberName != null) {
                $WedsiteAboutFamily->WEDSITE_ABOUT_FAMILY_NAME = $FamilyMemberName;
            }
            if ($FamilyMemberDesc != null) {
                $WedsiteAboutFamily->WEDSITE_ABOUT_FAMILY_DESCRIPTION = $FamilyMemberDesc;
            }
            $WedsiteAboutFamily->save(false);
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['response' => 'true'];
        }
    }

    public function actionAddWedsiteAbout()
    {
        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }

        $WedsiteAbout = new \app\models\WedsiteAbout();

        $data = Yii::$app->request->post();
//        Info  
        $HisHistory = "";
        if (isset($data['HisHistory'])) {
            $HisHistory = $data['HisHistory'];
        }

        $HerHistory = "";
        if (isset($data['HerHistory'])) {
            $HerHistory = $data['HerHistory'];
        }

        $OurHistory = "";
        if (isset($data['OurHistory'])) {
            $OurHistory = $data['OurHistory'];
        }

        $HisFirstPart = "";
        $HisSecondPart = "";
        $HerFirstPart = "";
        $HerSecondPart = "";
        if (isset($data['HisFirstPart'])) {
            $HisFirstPart = $data['HisFirstPart'];
        }


        if (isset($data['HisSecondPart'])) {
            $HisSecondPart = $data['HisSecondPart'];
        }


        if (isset($data['HerFirstPart'])) {
            $HerFirstPart = $data['HerFirstPart'];
        }


        if (isset($data['HerSecondPart'])) {
            $HerSecondPart = $data['HerSecondPart'];
        }

//        ProducValue: ProducValue,
//                    SubCategoryID : $SubCategoryID ,

        $findOne = $WedsiteAbout->find(['WEDDING_ID' => $WeddingID])->one();
        if ($findOne != null) {
            if ($HisHistory != "") {
                $findOne->HIS_HISTORY = $HisHistory;
            }
            if ($HerHistory != "") {
                $findOne->HER_HISTORY = $HerHistory;
            }
            if ($OurHistory != "") {
                $findOne->OUR_HISTORY = $OurHistory;
            }
            if ($HerSecondPart != "") {
                $findOne->HER_SECOND_PART = $HerSecondPart;
            }
            if ($HerFirstPart != "") {
                $findOne->HER_FIRST_PART = $HerFirstPart;
            }
            if ($HisSecondPart != "") {
                $findOne->HIS_SECOND_PART = $HisSecondPart;
            }
            if ($HisFirstPart != "") {
                $findOne->HIS_FIRST_PART = $HisFirstPart;
            }

            $findOne->save(false);

            Yii::$app->response->format = Response::FORMAT_JSON;

            return ['response' => 'true'];
        } else {
            $WedsiteAbout->WEDDING_ID = $WeddingID;

            if ($HisHistory != "") {
                $WedsiteAbout->HIS_HISTORY = $HisHistory;
            }
            if ($HerHistory != "") {
                $WedsiteAbout->HER_HISTORY = $HerHistory;
            }
            if ($OurHistory != "") {
                $WedsiteAbout->OUR_HISTORY = $OurHistory;
            }
            if ($HerSecondPart != "") {
                $WedsiteAbout->HER_SECOND_PART = $HerSecondPart;
            }
            if ($HerFirstPart != "") {
                $WedsiteAbout->HER_FIRST_PART = $HerFirstPart;
            }
            if ($HisSecondPart != "") {
                $WedsiteAbout->HIS_SECOND_PART = $HisSecondPart;
            }
            if ($HisFirstPart != "") {
                $WedsiteAbout->HIS_FIRST_PART = $HisFirstPart;
            }
            $WedsiteAbout->save(false);
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['response' => 'true'];
        }
    }

    public function actionUploadFirstPartnerImg()
    {
//        WELCOME_PIC

        Yii::error('Upload ');
        $model = new \app\models\CouplePartner();
        $WeddingID = 0;
        $FirstPartnerID = 0;
        $SecondPartnerID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
            $FirstPartnerID = (isset(Yii::$app->user->identity->weddings0) && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0 ? Yii::$app->user->identity->weddings0[0]->FIRST_COUPLE_PARTNER_ID : 0);
            $SecondPartnerID = (isset(Yii::$app->user->identity->weddings0) && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0 ? Yii::$app->user->identity->weddings0[0]->SECOND_COUPLE_PARTNER_ID : 0);
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
            $FirstPartnerID = (isset(Yii::$app->user->identity->weddings) && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0 ? Yii::$app->user->identity->weddings[0]->FIRST_COUPLE_PARTNER_ID : 0);
            $SecondPartnerID = (isset(Yii::$app->user->identity->weddings) && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0 ? Yii::$app->user->identity->weddings[0]->SECOND_COUPLE_PARTNER_ID : 0);
        }
        if ($FirstPartnerID != 0) {
            $imagetypes = array(
                'image/png' => '.png',
                'image/gif' => '.gif',
                'image/jpeg' => '.jpg',
                'image/bmp' => '.bmp');
            $ext = $imagetypes[$_FILES['FirstPartnerFile']['type']];
            $findOne = $model->findOne(['COUPLE_PARTNER_ID' => $FirstPartnerID]);
            $tmpImg = $_FILES['FirstPartnerFile']['tmp_name'];
            $SizeofImg = $_FILES['FirstPartnerFile']['size'];
            if (!is_dir('uploads/Partner' . $FirstPartnerID)) {
                mkdir('uploads/Partner' . $FirstPartnerID, 0777, true);
            }
            $RandN = rand();
//        /PartnerImg'.$SizeofImg.rand()
            if (move_uploaded_file($tmpImg, 'uploads/Partner' . $FirstPartnerID . '/PartnerImg' . $SizeofImg . $RandN . $ext)) {

                if ($findOne != null) {
                    $findOne->USER_PROFILE_PIC = 'uploads/Partner' . $FirstPartnerID . '/PartnerImg' . $SizeofImg . $RandN . $ext;
                    $findOne->save(false);
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ['response' => 'uploads/Partner' . $FirstPartnerID . '/PartnerImg' . $SizeofImg . $RandN . $ext];
                } else {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ['error' => 'Login First'];
                }
            } else {

                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['error' => 'Error saving recipe images, Please enter valid images'];
            }
        } else {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['error' => 'Login First'];
        }
    }

    public function actionUploadSecondPartnerImg()
    {

        Yii::error('Upload ');
        $model = new \app\models\CouplePartner();
        $WeddingID = 0;
        $FirstPartnerID = 0;
        $SecondPartnerID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
            $FirstPartnerID = (isset(Yii::$app->user->identity->weddings0) && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0 ? Yii::$app->user->identity->weddings0[0]->FIRST_COUPLE_PARTNER_ID : 0);
            $SecondPartnerID = (isset(Yii::$app->user->identity->weddings0) && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0 ? Yii::$app->user->identity->weddings0[0]->SECOND_COUPLE_PARTNER_ID : 0);
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
            $FirstPartnerID = (isset(Yii::$app->user->identity->weddings) && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0 ? Yii::$app->user->identity->weddings[0]->FIRST_COUPLE_PARTNER_ID : 0);
            $SecondPartnerID = (isset(Yii::$app->user->identity->weddings) && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0 ? Yii::$app->user->identity->weddings[0]->SECOND_COUPLE_PARTNER_ID : 0);
        }
        if ($SecondPartnerID != 0) {
            $imagetypes = array(
                'image/png' => '.png',
                'image/gif' => '.gif',
                'image/jpeg' => '.jpg',
                'image/bmp' => '.bmp');
            $ext = $imagetypes[$_FILES['SecondPartnerFile']['type']];
            $findOne = $model->findOne(['COUPLE_PARTNER_ID' => $SecondPartnerID]);
            $tmpImg = $_FILES['SecondPartnerFile']['tmp_name'];
            $SizeofImg = $_FILES['SecondPartnerFile']['size'];
            if (!is_dir('uploads/Partner' . $SecondPartnerID)) {
                mkdir('uploads/Partner' . $SecondPartnerID, 0777, true);
            }
            $RandN = rand();
//        /PartnerImg'.$SizeofImg.rand()
            if (move_uploaded_file($tmpImg, 'uploads/Partner' . $SecondPartnerID . '/PartnerImg' . $SizeofImg . $RandN . $ext)) {

                if ($findOne != null) {
                    $findOne->USER_PROFILE_PIC = 'uploads/Partner' . $SecondPartnerID . '/PartnerImg' . $SizeofImg . $RandN . $ext;
                    $findOne->save(false);
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ['response' => 'uploads/Partner' . $SecondPartnerID . '/PartnerImg' . $SizeofImg . $RandN . $ext];
                } else {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ['error' => 'Login First'];
                }
            } else {

                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['error' => 'Error saving recipe images, Please enter valid images'];
            }
        } else {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['error' => 'Login First'];
        }
    }

    public function actionValidate()
    {
        $model = new \app\models\WedsiteTopics();
        Yii::error('Validating : ');

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return \yii\bootstrap\ActiveForm::validate($model);
        }
    }

    public function actionSaveTopics()
    {

        $WeddingID = 0;
        $CouplePartnerID = 0;
        $Name = "";

        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID;
            $Name = Yii::$app->user->identity->COUPLE_PARTNER_FIRST_NAME . ' ' . Yii::$app->user->identity->COUPLE_PARTNER_LAST_NAME;
        }
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }


        Yii::error('Saving : ');
        $model = new \app\models\WedsiteTopics();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($model->validate() && $WeddingID != 0) {
                Yii::error('Saving : 1 ');
                $Time = time();
                Yii::error('Saving : 1 ' . $Time);
                $date = date("Y-m-d H:i:s", $Time);
                $model->WEDDING_ID = $WeddingID;
                $model->WEDSITE_TOPIC_DATE = $date;
                $model->WEDDING_ID = $WeddingID;
                $model->POSTED_BY = $CouplePartnerID;

                if ($model->save()) {

                    Yii::$app->response->format = Response::FORMAT_JSON;
                    $Res = '<div class="point" for="firstblock">
				<h3>' . $model->TOPIC_TITLE . '</h3>
											<p>just now by <span>' . $Name . '</span> &bull; 0 comments</p>
										</div>   ';
                    return [
                        'success' => true,
                        'Res' => $Res,
                    ];
                }
            } else {
                if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }
            }
        }
    }

    public function actionSaveTeam()
    {
        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        $model = new \app\models\WedsiteAboutTeam();
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->WEDDING_ID = $WeddingID;
                if ($model->save()) {
                    $TeamMemberID = $model->getPrimaryKey();
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return [
                        'success' => $TeamMemberID,

                    ];
                }
            }

        } else {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'failed' => 'error',

            ];
        }
    }

    public function actionNewTeamMemberForm()
    {
        $WeddingID = 0;

        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        $MemberTeamID = 0;
        if (Yii::$app->request != null && Yii::$app->request->get('MemberTeamID') != null) {
            $MemberTeamID = Yii::$app->request->get('MemberTeamID');
        }
        $TeamData = new ActiveDataProvider([
            'query' => \app\models\WedsiteAboutTeam::find()->where('WEDSITE_ABOUT_TEAM_ID = ' . $MemberTeamID . ' AND  WEDDING_ID = ' . $WeddingID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        if ($TeamData != null) {
            $TeamData = $TeamData->getModels();

        }
        return $this->renderAjax('_teammember', [
            'TeamData' => $TeamData
        ]);
    }

    public function actionValidateTeam()
    {
        $model = new \app\models\WedsiteAboutTeam();
        Yii::error('Validating : ');

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return \yii\bootstrap\ActiveForm::validate($model);
        }
    }

    public function actionSaveFirstFamily()
    {
        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }

        $Image = $_POST['image'];
        $exp = explode(',', $Image);
        $data = base64_decode($exp[1]);
        if (!is_dir('AllFamilyGalery/FamilyPic' . $WeddingID)) {
            mkdir('AllFamilyGalery/FamilyPic' . $WeddingID, 0777, true);
        }


        $model = new \app\models\WedsiteAboutFamily();
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->WEDDING_ID = $WeddingID;

                if ($model->save()) {

                    $FirstfamilyID = $model->getPrimaryKey();
                    $findOne = $model->findOne(['WEDDING_ID' => $WeddingID, 'WEDSITE_ABOUT_FAMILY_ID' => $FirstfamilyID]);
                    if (file_put_contents('AllFamilyGalery/FamilyPic' . $WeddingID . '/FamilyMemeberPic' . $FirstfamilyID . '.png', $data)) {
                        $findOne->FAMILY_MEMBER_PIC = 'AllFamilyGalery/FamilyPic' . $WeddingID . '/FamilyMemeberPic' . $FirstfamilyID . '.png';
                        $findOne->save();
                    }
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return [
                        'success' => $FirstfamilyID,

                    ];
                }
            }

        } else {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'failed' => 'error',

            ];
        }
    }

    public function actionFirstFamilyForm()
    {
        $FamilyID = 0;
        if (Yii::$app->request != null && Yii::$app->request->get('FamilyID') != null) {
            $FamilyID = Yii::$app->request->get('FamilyID');
        }
        $FirstFamilyData = new ActiveDataProvider([
            'query' => \app\models\WedsiteAboutFamily::find()->where('WEDSITE_ABOUT_FAMILY_ID = ' . $FamilyID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        if ($FirstFamilyData != null) {
            $FirstFamilyData = $FirstFamilyData->getModels();

        }
        return $this->renderAjax('_firstfamily', [
            'FirstFamilyData' => $FirstFamilyData
        ]);
    }

    public function actionValidateFirstFamily()
    {
        $model = new \app\models\WedsiteAboutFamily();
        Yii::error('Validating : ');

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return \yii\bootstrap\ActiveForm::validate($model);
        }
    }

//date("Y-m-d h:i:sa", $d)
    public function actionDynamic()
    {
        return $this->renderAjax('__dynamic', [
        ]);
    }

    public function secondsToTime($inputSeconds)
    {
        $then = new \DateTime(date('Y-m-d H:i:s', $inputSeconds));
        $now = new \DateTime(date('Y-m-d H:i:s', time()));
        $diff = $then->diff($now);
        return array('years' => $diff->y, 'months' => $diff->m, 'days' => $diff->d, 'hours' => $diff->h, 'minutes' => $diff->i, 'seconds' => $diff->s);
    }

    public function actionValidateComment()
    {
        $model = new \app\models\WedsiteTopicComments();
        Yii::error('Validating : ');

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return \yii\bootstrap\ActiveForm::validate($model);
        }
    }

    public function actionSaveComments()
    {

        $WeddingID = 0;
        $CouplePartnerID = 0;
        $Name = "";

        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID;
            $Name = Yii::$app->user->identity->COUPLE_PARTNER_FIRST_NAME . ' ' . Yii::$app->user->identity->COUPLE_PARTNER_LAST_NAME;
        }
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        if (Yii::$app->user->identity == null) {
            $WeddingID = 1;
        }

        Yii::error('Saving : ');
        $model = new \app\models\WedsiteTopicComments();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($model->validate() && $WeddingID != 0) {
                Yii::error('Saving : 1 ');
                $Time = time();
                Yii::error('Saving : 1 ' . $Time);
                $date = date("Y-m-d H:i:s", $Time);

                $model->POSTED_DATE_TIME = $date;
                $model->WEDDING_ID = $WeddingID;
                $model->POSTED_BY = $CouplePartnerID;

                if ($model->save()) {

                    Yii::$app->response->format = Response::FORMAT_JSON;
//                    
                    $Res = '<div class="comment_wrapper">
													<div class="comment_img">
														<img src="img/invitee-avatar.jpg" alt="">
													</div>
													<div class="comment_inf">
														<span><span class="username">' . $Name . '</span> • just now</span>
														<p>' . $model->WEDSITE_TOPIC_COMMENT . '</p>
													</div>
													<div class="comment_action">
														<div class="comment_like">
															<span>❤</span> 0
														</div>
														<div class="comment_replay">
															<i class="fa fa-reply" aria-hidden="true"></i> Replay
														</div>
													</div>
													<div class="clearfix"></div>
												</div>';

                    return [
                        'success' => true,
                        'Res' => $Res,
                    ];
                }
            } else {
                if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }
            }
        }
    }

    public function actionSaveToRegistry()
    {

        $WeddingID = 0;

        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        if (Yii::$app->user->identity == null) {
            $WeddingID = 1;
        }
        $data = Yii::$app->request->get();
        $optionID = $data['OptionID'];
        $Options = new \app\models\ItemOptions();
        $RegistrySelectedItemsModel = new \app\models\RegistrySelectedItems();
        $Options = $Options->findOne($optionID);
        if ($Options != null) {
            $RegistrySelectedItemsModel->ITEM_SUPPLIER_ID = $Options->ITEM_SUPPLIER_ID;
            $RegistrySelectedItemsModel->OPTION_ID = $optionID;
            $RegistrySelectedItemsModel->WEDDING_ID = $WeddingID;
            if ($RegistrySelectedItemsModel->save()) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                    'success' => true,
                ];
            }
        }
    }

    public function actionItembyproduct()
    {
//        $session = Yii::$app->session;
//        session_start();
//        $searchModel = new StatusSearch();
//         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $sortingby = "";
        if (Yii::$app->request != null && Yii::$app->request->get('sortingby') != null) {
            $sortingby = Yii::$app->request->get('sortingby');
        }
        $Reg = "";
        if (Yii::$app->request != null && Yii::$app->request->get('Reg') != null) {
            $Reg = Yii::$app->request->get('Reg');
        }
        $SortByMethod = "";
        if (Yii::$app->request != null && Yii::$app->request->get('SortByMethod') != null) {
            $SortByMethod = Yii::$app->request->get('SortByMethod');
        }
//        sorting
        $productID = 0;
        if (Yii::$app->request != null && Yii::$app->request->get('productID') != null) {
            $productID = Yii::$app->request->get('productID');
        }

        $LocationID = 0;
        if (Yii::$app->request != null && Yii::$app->request->get('Location') != null && Yii::$app->request->get('Location') != '') {
            $LocationID = Yii::$app->request->get('Location');
        }
        $SupplierTypeID = 0;
        if (Yii::$app->request != null && Yii::$app->request->get('SupplierTypeID') != null && Yii::$app->request->get('SupplierTSupplierTypeSupplierTypeypeID') != '') {
            $SupplierTypeID = Yii::$app->request->get('SupplierType');
        }
        $SupplierID = 0;
        if (Yii::$app->request != null && Yii::$app->request->get('SupplierName') != null && Yii::$app->request->get('SupplierName') != '') {
            $SupplierID = Yii::$app->request->get('SupplierName');
        }
        $searchterms = '';
        if (Yii::$app->request != null && Yii::$app->request->get('searchterms') != null && Yii::$app->request->get('searchterms') != '') {
            $searchterms = Yii::$app->request->get('searchterms');
        }
        $minprice = '';
        if (Yii::$app->request != null && Yii::$app->request->get('min-price') != null && Yii::$app->request->get('min-price') != '') {
            $minprice = Yii::$app->request->get('min-price');
        }
        $maxprice = '';
        if (Yii::$app->request != null && Yii::$app->request->get('max-price') != null && Yii::$app->request->get('max-price') != '') {
            $maxprice = Yii::$app->request->get('max-price');
        }
        $cookies = Yii::$app->response->cookies;

        $session = Yii::$app->session;
        $session['sortMethod'] = $SortByMethod;
//$sortMethod = $cookies->getValue('sortMethod', 'ASC');
//        $session['ColumnName'] = $sortingby;
//        $session['sortMethod'] = $SortByMethod;
//        Yii::error("SESSION['sortMethod'] : " . $SortByMethod);
        //            searchterms='+searchterms+'&minprice='+minprice+'&maxprice='+maxprice
        //       'LocationID=' + LocationID+'&SupplierTypeID='+SupplierTypeID+'&SupplierID='+SupplierID,
        Yii::error("Index Controller productID : " . $productID);

        $CouplePartnerID = 0;
        $WeddingID = 0;

        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }
        $dataProviderSuplliers = new ActiveDataProvider([
            'query' => Suppliers::find(),
        ]);
        $dataProviderItems = null;
        if ($productID != 0 && $LocationID == 0 && $SupplierID == 0 && $SupplierTypeID == 0) {
            $dataProviderItems = new ActiveDataProvider([
                'query' => Products::find()->where(['PRODUCT_ID' => $productID]),
            ]);
        } else {
            $Cond = [];
            if ($SupplierID != 0) {
                $Cond['items_supplieirs.SUPPLIER_ID'] = $SupplierID;
            }
            if ($LocationID != 0) {
                $Cond['suppliers.CITY_ID'] = $LocationID;
            }
            if ($SupplierTypeID != 0) {
                $Cond['suppliers.SUPPLIER_TYPE_ID'] = $SupplierTypeID;
            }

//            searchterms='+searchterms+'&minprice='+minprice+'&maxprice='+maxprice

            if (($Cond != null && $Cond != '' && sizeof($Cond > 0))) {


//                    $Cond['items_trans.ITEM_NAME'] = '%' . $searchterms . '%';
//                    Yii::error("Index Controller productID helloooo   : " . $Cond['items_supplieirs.SUPPLIER_ID']);
                $dataProviderItems = new ActiveDataProvider([
//            'query' => Suppliers::find()->where($Cond),
                    'query' => Products::find()->innerJoin('products_trans', 'products_trans.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items', 'items.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items_supplieirs', 'items.ITEM_ID=items_supplieirs.ITEM_ID')->innerJoin('suppliers', 'items_supplieirs.SUPPLIER_ID=suppliers.SUPPLIER_ID')->innerJoin('items_trans', 'items_trans.ITEM_ID=items.ITEM_ID')->where($Cond)->andWhere('(products_trans.PRODUCT_NAME LIKE \'%' . $searchterms . '%\' OR suppliers.SUPPLIER_NAME LIKE \'%' . $searchterms . '%\' )'),
                ]);
            } else {
                $dataProviderItems = new ActiveDataProvider([
//            'query' => Suppliers::find()->where($Cond),
                    'query' => Products::find()->innerJoin('products_trans', 'products_trans.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items', 'items.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items_supplieirs', 'items.ITEM_ID=items_supplieirs.ITEM_ID')->innerJoin('suppliers', 'items_supplieirs.SUPPLIER_ID=suppliers.SUPPLIER_ID')->innerJoin('items_trans', 'items_trans.ITEM_ID=items.ITEM_ID')->where('(products_trans.PRODUCT_NAME LIKE \'%' . $searchterms . '%\' OR suppliers.SUPPLIER_NAME LIKE \'%' . $searchterms . '%\' )'),
                ]);
            }
        }

        $CouplePartnerID = 0;
        $WeddingID = 0;

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
        if (Yii::$app->user->identity == null) {
            $WeddingID = 1;
        }
//        $TransModel=  \app\models\AgendaPeriodeTranslation();
//        $TransModel->
        $CouplePartnerModel = new \app\models\CouplePartner();
        $WeddingEvents = new \app\models\WeddingEvent();
        $WeddingTentativePeriods = new \app\models\WeddingTentativePeriodes();

        $CategoryOfItemss = new CategoryOfItems();
        $CategoryOfItemsDataProvider = new ActiveDataProvider([
            'query' => CategoryOfItems::find()->where(['CATEGORY_FLAG' => 'C']),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
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

        $dataSupplierType = new ActiveDataProvider([
            'query' => \app\models\SuplierTypeTrans::find()->select(['suplier_type_trans.SUPLIER_TYPE_ID', 'suplier_type_trans.SUPLIER_TYPE_NAME'])->where(' LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        $dataSupplier = new ActiveDataProvider([
            'query' => Suppliers::find()->where('COUNTRY_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $Supplier = new \app\models\Suppliers();
        $WeddingModel = new \app\models\Weddings();
//Yii::$app->response->format = Response::FORMAT_JSON;
        return $this->renderAjax('_search', [
            'dataProvider' => $dataProvider,
            'dataProvider1' => $dataProvider1,
            'CategoryOfItems' => $CategoryOfItemss,
            'CategoryOfItemsDataProvider' => $CategoryOfItemsDataProvider,
            'WeddingEvents' => $WeddingEvents,
            'WeddingTentativePeriods' => $WeddingTentativePeriods,
            'WeddingEventDataProvider' => $WeddingEventDataProvider,
            'dataProviderForWeddingDate1' => $dataProviderForWeddingDate1,
            'CouplePartnerModel' => $CouplePartnerModel,
            'dataProviderItems' => $dataProviderItems,
            'dataProviderSuplliers' => $dataProviderSuplliers,
            'dataSupplierType' => $dataSupplierType,
            'dataSupplier' => $dataSupplier,
            'dataCity' => $dataCity,
            'Supplier' => $Supplier,
            'WeddingModel' => $WeddingModel,
            'LocationID' => $LocationID,
            'SupplierTypeID' => $SupplierTypeID,
            'SupplierID' => $SupplierID,
            'minprice' => $minprice,
            'maxprice' => $maxprice,
            'searchterms' => $searchterms,
            'Reg' => $Reg,
//            'dataProvider1' => $dataProvider1,
        ]);
//         return ['suss'=>'test'];
    }

    public function actionPublish()
    {
        $CouplePartnerID = 0;


        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }
        $WeddingID = 0;

        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }

        $ExistPublishedLink = new \app\models\WedsitePublishLink();
        $ExistPublishedLink = $ExistPublishedLink->find()->where('WEDDING_ID = ' . $WeddingID)->one();
        if ($ExistPublishedLink == null && $WeddingID != 0) {
            $hash = Yii::$app->getSecurity()->generatePasswordHash($WeddingID);
            $WedsieLink = new \app\models\WedsitePublishLink();
            $Link = 'http://192.168.1.78/yiiApp/basic/web/index.php?r=wedsite%2Findex&Code=' . $hash;
            $Time = time();
            Yii::error('Saving : 1 ' . $Time);
            $date = date("Y-m-d H:i:s", $Time);
            $WedsieLink->LINK = $Link;
            $WedsieLink->WEDDING_ID = $WeddingID;
            $WedsieLink->PUBLISHED_BY = $CouplePartnerID;
            $WedsieLink->LINK_PIN_CODE = $hash;
            $WedsieLink->PUBLISHED_ON = $date;
            if ($WedsieLink->save(false)) {

                $Invitees = \app\models\Invitees::find()->where('WEDDING_ID = ' . $WeddingID)->all();
                if ($Invitees != null && sizeof($Invitees) > 0) {
                    foreach ($Invitees as $Invitee) {
                        $Rand = rand();
                        $WedsitePublishLinkModel = new \app\models\WedsiteInviteePinCode();
                        $WedsitePublishLinkModel->INVITEE_EMAIL = $Invitee->INVITEE_EMAIL;
                        $WedsitePublishLinkModel->INVITEE_EMAIL = $Invitee->INVITEE_EMAIL;
                        $WedsitePublishLinkModel->INVITEE_ID = $Invitee->INVITEE_ID;
                        $WedsitePublishLinkModel->INVITEE_PIN_CODE = $Rand;
                        $WedsitePublishLinkModel->WEDDING_ID = $WeddingID;
                        $WedsitePublishLinkModel->HASHED_CODE = $hash;
                        $WedsitePublishLinkModel->save(false);
                        Yii::$app->mailer->compose()
                            ->setFrom('sabra331990@gmail.com')
                            ->setTo($Invitee->INVITEE_EMAIL)
                            ->setSubject('Wedsite Invitation')
                            ->setHtmlBody('Hello ' . $Invitee->FIRST_INVITEE_NAME . ', your are invited to Ahmad & Zeina wedsite. This is your pin  code : ' . $Rand . '<br><a href=\'' . $Link . '&Email=' . $Invitee->INVITEE_EMAIL . '\'>Ahmad & Zeina Wedsite</a>')
                            ->send();
                        Yii::error("testtttttttttttadasdsa 444");
                    }

                }

                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                    'success' => true,
                ];
            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                    'success' => false,
                ];
            }
        } else {

        }

        //Generate Link
    }

    public function actionCategories()
    {
        $Reg = 'R';
        $productID = 0;
        if (Yii::$app->request != null && Yii::$app->request->get('productID') != null) {
            $productID = Yii::$app->request->get('productID');
        }
        $this->LastProductID = $productID;
        Yii::error("Index Controller productID : " . $productID);

        $CouplePartnerID = 0;
        $WeddingID = 0;

        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }


//        $weddings $weddings0
//        $WeddingModel = new \app\models\Weddings();

        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        if (Yii::$app->user->identity == null) {
            $WeddingID = 1;
        }
        $CategoryOfItemsDataProvider = new ActiveDataProvider([
            'query' => CategoryOfItems::find()->where(['CATEGORY_FLAG' => $Reg]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        return $this->renderAjax('_categories', [

            'CategoryOfItemsDataProvider' => $CategoryOfItemsDataProvider,
//            'dataProvider1' => $dataProvider1,
        ]);
    }

    public function actionRsvpSave()
    {
        $data = Yii::$app->request->post()['Rsvp'];
        $rsvp = new Rsvp();
        $rsvp->load($data, '');
        $rsvp->RSVP_RESPONSE = $data['RSVP_RESPONSE'];
        $rsvp->SEATING_PREFERENCES_ID = $data['SEATING_PREFERENCES_ID'];
        $rsvp->save(false);

        return $this->redirect('index');
    }

}
