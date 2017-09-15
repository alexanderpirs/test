<?php

namespace app\controllers;

ini_set('display_errors', 1);

//$errorPath = ini_get('error_log');
//echo $errorPath;
// phpinfo();
error_reporting(E_ALL);

use yii\web\UploadedFile;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use \app\models\CouplePartner;
use app\models\LoginForm;
use yii\web\Response;
use \yii\base\Model;
use yii\widgets\ActiveForm;
use \app\models\Weddings;

class CouplePartnerController extends Controller {

    public function behaviors() {
        return [

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actions() {
        return [
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'oAuthSuccess'],
            ],
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() {
        $CouplePartnerID = 0;
        if (Yii::$app->request != null && Yii::$app->request->get('userID') != null) {
            $CouplePartnerID = Yii::$app->request->get('userID');
        }


        if ($CouplePartnerID == 0 && Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }
        $SecondCouplePartner = 0;
        $WeddingModel = new \app\models\Weddings();
        if ($CouplePartnerID != 0) {

            $where = new ActiveDataProvider([
                'query' => $WeddingModel->find()->where('FIRST_COUPLE_PARTNER_ID = ' . $CouplePartnerID . ' OR SECOND_COUPLE_PARTNER_ID=' . $CouplePartnerID . ' '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            if ($where != null && isset($where)) {
                $models1 = $where->getModels();
                if ($models1 != null && sizeof($models1) > 0 && $models1[0]->FIRST_COUPLE_PARTNER_ID != NULL && $models1[0]->FIRST_COUPLE_PARTNER_ID != $CouplePartnerID) {
                    $SecondCouplePartner = $models1[0]->FIRST_COUPLE_PARTNER_ID;
                } else {
                    if (sizeof($models1) > 0 && $models1[0]->SECOND_COUPLE_PARTNER_ID != NULL) {
                        $SecondCouplePartner = $models1[0]->SECOND_COUPLE_PARTNER_ID;
                    }
                }
            }
        }
        $dataGenders = new ActiveDataProvider([
            'query' => \app\models\GenderTranslation::find()->select(['gender_translation.GENDER_ID', 'gender_translation.GENDER_TRANS_VALUE'])->where(' LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $dataCountry = new ActiveDataProvider([
            'query' => \app\models\CountriesTrans::find()->select(['countries_trans.COUNTRY_ID', 'countries_trans.COUNTRY_TRANS_NAME'])->where(' LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        $dataWeddingType = new ActiveDataProvider([
            'query' => \app\models\WeddingTypeTranslation::find()->select(['wedding_type_translation.WEDDING_TYPE_ID', 'wedding_type_translation.WEDDING_TYPE_TRANSLATION'])->where(' LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        $dataWeddingCountry = new ActiveDataProvider([
            'query' => \app\models\CountriesTrans::find()->select(['countries_trans.COUNTRY_ID', 'countries_trans.COUNTRY_TRANS_NAME'])->where(' LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        if ($CouplePartnerID != 0) {
            $dataProvider = new ActiveDataProvider([
                'query' => CouplePartner::find()->where('COUPLE_PARTNER_ID = ' . $CouplePartnerID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);

            $models = $dataProvider->getModels();
            $CountryID = ($models != NULL && sizeof($models) > 0 && $models[0]->COUNTRY_ID != NULL ? $models[0]->COUNTRY_ID : "0");
            $dataCity = new ActiveDataProvider([
                'query' => \app\models\CitiesTranslation::findBySql('select t.CITY_ID, t.CITY_TRANSLATION from cities inner join cities_translation t on cities.CITY_ID=t.CITY_ID where cities.COUNTRY_ID = ' . $CountryID . ' AND t.LANGUAGE_ID=1 '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
//         $dataCity = \app\models\Cities::find()->select(['cities.CITY_ID', 'cities_translation.CITY_TRANSLATION'])->innerJoin('cities_translation' ,'cities.CITY_ID=cities_translation.CITY_ID')->where('cities.COUNTRY_ID = '.$CountryID.' ');
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
//        $dataCity = \app\models\Cities::find();

            $SecondPartnerDataProvider = null;
            $SeconddataCity = null;
            if ($SecondCouplePartner != 0) {
                $SecondPartnerDataProvider = new ActiveDataProvider([
                    'query' => CouplePartner::find()->where('COUPLE_PARTNER_ID = ' . $SecondCouplePartner),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
                ]);

                $Secondmodels = $SecondPartnerDataProvider->getModels();
                $SecondCountryID = ($Secondmodels != NULL && sizeof($Secondmodels) > 0 && $Secondmodels[0]->COUNTRY_ID != NULL ? $Secondmodels[0]->COUNTRY_ID : "0");
                $SeconddataCity = new ActiveDataProvider([
                    'query' => \app\models\CitiesTranslation::findBySql('select t.CITY_ID, t.CITY_TRANSLATION from cities inner join cities_translation t on cities.CITY_ID=t.CITY_ID where cities.COUNTRY_ID = ' . $SecondCountryID . ' AND t.LANGUAGE_ID=1 '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
                ]);
            }
//         $dataCity = \app\models\Cities::find()->select(['cities.CITY_ID', 'cities_translation.CITY_TRANSLATION'])->innerJoin('cities_translation' ,'cities.CITY_ID=cities_translation.CITY_ID')->where('cities.COUNTRY_ID = '.$CountryID.' ');
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
//        $dataCity = \app\models\Cities::find();

            $CouplePartnerModel = new CouplePartner();
            $SecCpuplePartnerModel = new CouplePartner();
            return $this->render('index', [
                        'dataProvider' => $dataProvider,
                        'CouplePartnerModel' => $CouplePartnerModel,
                        'SecCpuplePartnerModel' => $SecCpuplePartnerModel,
                        'dataGenders' => $dataGenders,
                        'dataCountry' => $dataCountry,
                        'dataCity' => $dataCity,
                        'SecondPartnerDataProvider' => $SecondPartnerDataProvider,
                        'SeconddataCity' => $SeconddataCity,
                        'dataWeddingType' => $dataWeddingType,
                        'dataWeddingCountry' => $dataWeddingCountry,
                        'WeddingModel' => $WeddingModel,
            ]);
        } else {
            $CouplePartnerModel = new CouplePartner();
            $SecCpuplePartnerModel = new CouplePartner();
            return $this->render('index', [
                        'CouplePartnerModel' => $CouplePartnerModel,
                        'SecCpuplePartnerModel' => $SecCpuplePartnerModel,
                        'dataGenders' => $dataGenders,
                        'dataCountry' => $dataCountry,
                        'dataWeddingType' => $dataWeddingType,
                        'dataWeddingCountry' => $dataWeddingCountry,
                        'WeddingModel' => $WeddingModel,
            ]);
        }

        return $this->render('index');
    }

    private $TechID = 0;

    public function actionConfirm() {

        $TechID = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->set('id', $TechID);
        $this->TechID = $TechID;
        $CouplePartnerModel = new CouplePartner();

        return $this->render('confirm', [
                    'CouplePartnerModel' => $CouplePartnerModel,
                    'TechID' => $TechID,
        ]);
    }

    public function actionNewIndex($NewCoupleID) {
        $CouplePartnerID = $NewCoupleID;
        Yii::error("testtttttttttttadasdsa actionNewIndex : " . $NewCoupleID);

        $SecondCouplePartner = 0;
        $WeddingModel = new \app\models\Weddings();
        if ($CouplePartnerID != 0) {

            $where = new ActiveDataProvider([
                'query' => $WeddingModel->find()->where('FIRST_COUPLE_PARTNER_ID = ' . $CouplePartnerID . ' OR SECOND_COUPLE_PARTNER_ID=' . $CouplePartnerID . ' '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            if ($where != null && isset($where)) {
                $models1 = $where->getModels();
                if ($models1 != null && sizeof($models1) > 0 && $models1[0]->FIRST_COUPLE_PARTNER_ID != NULL && $models1[0]->FIRST_COUPLE_PARTNER_ID != $CouplePartnerID) {
                    $SecondCouplePartner = $models1[0]->FIRST_COUPLE_PARTNER_ID;
                } else {
                    if (sizeof($models1) > 0 && $models1[0]->SECOND_COUPLE_PARTNER_ID != NULL) {
                        $SecondCouplePartner = $models1[0]->SECOND_COUPLE_PARTNER_ID;
                    }
                }
            }
        }
        $dataGenders = new ActiveDataProvider([
            'query' => \app\models\GenderTranslation::find()->select(['gender_translation.GENDER_ID', 'gender_translation.GENDER_TRANS_VALUE'])->where(' LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $dataCountry = new ActiveDataProvider([
            'query' => \app\models\CountriesTrans::find()->select(['countries_trans.COUNTRY_ID', 'countries_trans.COUNTRY_TRANS_NAME'])->where(' LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        $dataWeddingType = new ActiveDataProvider([
            'query' => \app\models\WeddingTypeTranslation::find()->select(['wedding_type_translation.WEDDING_TYPE_ID', 'wedding_type_translation.WEDDING_TYPE_TRANSLATION'])->where(' LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        $dataWeddingCountry = new ActiveDataProvider([
            'query' => \app\models\CountriesTrans::find()->select(['countries_trans.COUNTRY_ID', 'countries_trans.COUNTRY_TRANS_NAME'])->where(' LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        if ($CouplePartnerID != 0) {

            $dataProvider = new ActiveDataProvider([
                'query' => CouplePartner::find()->where('COUPLE_PARTNER_ID = ' . $CouplePartnerID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);

            $models = $dataProvider->getModels();
            $CountryID = ($models != NULL && sizeof($models) > 0 && $models[0]->COUNTRY_ID != NULL ? $models[0]->COUNTRY_ID : "0");
            $dataCity = new ActiveDataProvider([
                'query' => \app\models\CitiesTranslation::findBySql('select t.CITY_ID, t.CITY_TRANSLATION from cities inner join cities_translation t on cities.CITY_ID=t.CITY_ID where cities.COUNTRY_ID = ' . $CountryID . ' AND t.LANGUAGE_ID=1 '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
//         $dataCity = \app\models\Cities::find()->select(['cities.CITY_ID', 'cities_translation.CITY_TRANSLATION'])->innerJoin('cities_translation' ,'cities.CITY_ID=cities_translation.CITY_ID')->where('cities.COUNTRY_ID = '.$CountryID.' ');
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
//        $dataCity = \app\models\Cities::find();

            $SecondPartnerDataProvider = null;
            $SeconddataCity = null;
            if ($SecondCouplePartner != 0) {
                $SecondPartnerDataProvider = new ActiveDataProvider([
                    'query' => CouplePartner::find()->where('COUPLE_PARTNER_ID = ' . $SecondCouplePartner),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
                ]);

                $Secondmodels = $SecondPartnerDataProvider->getModels();
                $SecondCountryID = ($Secondmodels != NULL && sizeof($Secondmodels) > 0 && $Secondmodels[0]->COUNTRY_ID != NULL ? $Secondmodels[0]->COUNTRY_ID : "0");
                $SeconddataCity = new ActiveDataProvider([
                    'query' => \app\models\CitiesTranslation::findBySql('select t.CITY_ID, t.CITY_TRANSLATION from cities inner join cities_translation t on cities.CITY_ID=t.CITY_ID where cities.COUNTRY_ID = ' . $SecondCountryID . ' AND t.LANGUAGE_ID=1 '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
                ]);
            }
//         $dataCity = \app\models\Cities::find()->select(['cities.CITY_ID', 'cities_translation.CITY_TRANSLATION'])->innerJoin('cities_translation' ,'cities.CITY_ID=cities_translation.CITY_ID')->where('cities.COUNTRY_ID = '.$CountryID.' ');
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
//        $dataCity = \app\models\Cities::find();

            $CouplePartnerModel = new CouplePartner();
            $SecCpuplePartnerModel = new CouplePartner();

            Yii::error("testtttttttttttadasdsa Ni7na homnnnnnnnnnnnnnnnnnnnn : " . $NewCoupleID);
            return $this->render('index', [
                        'dataProvider' => $dataProvider,
                        'CouplePartnerModel' => $CouplePartnerModel,
                        'SecCpuplePartnerModel' => $SecCpuplePartnerModel,
                        'dataGenders' => $dataGenders,
                        'dataCountry' => $dataCountry,
                        'dataCity' => $dataCity,
                        'SecondPartnerDataProvider' => $SecondPartnerDataProvider,
                        'SeconddataCity' => $SeconddataCity,
                        'dataWeddingType' => $dataWeddingType,
                        'dataWeddingCountry' => $dataWeddingCountry,
                        'WeddingModel' => $WeddingModel,
            ]);
        } else {
            $CouplePartnerModel = new CouplePartner();
            $SecCpuplePartnerModel = new CouplePartner();
            return $this->render('index', [
                        'CouplePartnerModel' => $CouplePartnerModel,
                        'SecCpuplePartnerModel' => $SecCpuplePartnerModel,
                        'dataGenders' => $dataGenders,
                        'dataCountry' => $dataCountry,
                        'dataWeddingType' => $dataWeddingType,
                        'dataWeddingCountry' => $dataWeddingCountry,
                        'WeddingModel' => $WeddingModel,
            ]);
        }

        return $this->render('index');
    }

    public function actionConfirmpa() {
        $CouplePartnerModel = new CouplePartner();
        $session = Yii::$app->session;
        $ID = $session->get('id');
        $CouplePartnerModell = CouplePartner::findOne($ID);
        if ($CouplePartnerModel->load(Yii::$app->request->post())) {
            $CouplePartnerModel->COUPLE_PARTNER_ID = $ID;
            Yii::error("qqqqqqqqqqqqqqqqqqqqqq : " . $ID);
            $CouplePartnerModell->COUPLE_PARTNER_PASSWORD = $CouplePartnerModel->COUPLE_PARTNER_PASSWORD;
            $CouplePartnerModell->save(false);
        }
        return $this->redirect(['site/login']);
    }

    public function oAuthSuccess($client) {
        // get user data from client
        $userAttributes = $client->getUserAttributes();
        if ($userAttributes != NULL && sizeof($userAttributes) > 0 && $userAttributes['email'] != NULL) {
            $CouplePartnerModel = new CouplePartner();
            $model = new LoginForm();
            $loginFacebook = $model->loginFacebook($userAttributes['email']);
            if ($loginFacebook == false) {

                $dataGenders = new ActiveDataProvider([
                    'query' => \app\models\GenderTranslation::find()->select(['gender_translation.GENDER_ID', 'gender_translation.GENDER_TRANS_VALUE'])->where(' LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
                ]);
                $dataCountry = new ActiveDataProvider([
                    'query' => \app\models\CountriesTrans::find()->select(['countries_trans.COUNTRY_ID', 'countries_trans.COUNTRY_TRANS_NAME'])->where(' LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
                ]);

                $dataWeddingType = new ActiveDataProvider([
                    'query' => \app\models\WeddingTypeTranslation::find()->select(['wedding_type_translation.WEDDING_TYPE_ID', 'wedding_type_translation.WEDDING_TYPE_TRANSLATION'])->where(' LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
                ]);

                $dataWeddingCountry = new ActiveDataProvider([
                    'query' => \app\models\CountriesTrans::find()->select(['countries_trans.COUNTRY_ID', 'countries_trans.COUNTRY_TRANS_NAME'])->where(' LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
                ]);

                $CouplePartnerModel->FACEBOOK_EMAIL = $userAttributes['email'];
                $CouplePartnerModel->COUPLE_PARTNER_FIRST_NAME = $userAttributes['first_name'];
                $CouplePartnerModel->COUPLE_PARTNER_LAST_NAME = $userAttributes['last_name'];
                $save = $CouplePartnerModel->save(false);
                $primaryKey = $CouplePartnerModel->getPrimaryKey();
                $CouplePartnerModel->COUPLE_PARTNER_ID = $primaryKey;

                $WeddingModel = new \app\models\Weddings();
                $WeddingModel->FIRST_COUPLE_PARTNER_ID = $primaryKey;
                $WeddingModel->save(false);
                $where = new ActiveDataProvider([
                    'query' => $WeddingModel->find()->where('FIRST_COUPLE_PARTNER_ID = ' . $primaryKey . ' OR SECOND_COUPLE_PARTNER_ID=' . $primaryKey . ' '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
                ]);
               $this->oAuthSuccess($client);
//        ['name', 'email', 'first_name', 'last_name'],
//                return $this->render('index', [
//                            'CouplePartnerModel' => $CouplePartnerModel,
//                            'dataGenders' => $dataGenders,
//                            'dataCountry' => $dataCountry,
//                            'dataWeddingType' => $dataWeddingType,
//                            'dataWeddingCountry' => $dataWeddingCountry,
//                            'WeddingModel' => $WeddingModel,
//                ]);
            }
//    loginFacebook($SocialMediaEmail)
            // do some thing with user data. for example with $userAttributes['email']
        }
    }

    public function actionCitiesbycountry() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $countryID = $data['id'];
            $dataCity = new ActiveDataProvider([
                'query' => \app\models\CitiesTranslation::findBySql('select t.CITY_ID, t.CITY_TRANSLATION from cities inner join cities_translation t on cities.CITY_ID=t.CITY_ID where cities.COUNTRY_ID = ' . $countryID . ' AND t.LANGUAGE_ID=1 '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $models0 = $dataCity->getModels();
            $Re = '<option value=\'0\'>City...</option>';
            if (sizeof($models0) > 0) {
                foreach ($models0 as $option) {
                    $Re = $Re . '<option value=\'' . $option->CITY_ID . '\'>' . $option->CITY_TRANSLATION . '</option>';
                }
            }
            Yii::$app->response->format = Response::FORMAT_JSON;
        return ['response' => $Re];
        }
        
//      $CountryID =  ($models != NULL && sizeof($models) > 0 && $models[0]->COUNTRY_ID != NULL ? $models[0]->COUNTRY_ID : "0");
    }

    public function actionValidatecouplepartner() {
        $CouplePartnerModell = new CouplePartner();
        if (Yii::$app->request->isAjax && $CouplePartnerModell->load(Yii::$app->request->post())) {
            Yii::error("WeddingAgendaTaskIDs[] : Fitnaaaaaaaaaaaaaaaaaaa");
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($CouplePartnerModell);
        }
    }

    protected function actionperformAjaxValidation($model) {
        Yii::error("testtttttttttttadasdsa honnnnnnnnn");
        if (\Yii::$app->request->isAjax && $model->load(\Yii::$app->request->post())) {
            Yii::error("WeddingAgendaTaskIDs[] : Fitnaaaaaaaaaaaaaaaaaaa");
            \Yii::$app->response->format = Response::FORMAT_JSON;
            echo json_encode(ActiveForm::validate($model));
            return ActiveForm::validate($model);
//        \Yii::$app->end();
        }
    }

    public function actionFormSubmission() {
//    $security = new Security();
        $string = Yii::$app->request->post('string');
        $stringHash = '';
        if (!is_null($string)) {
            $stringHash = Yii::$app->getSecurity()->generatePasswordHash($string);
        }
        $CouplePartnerID = 0;
        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }
        $SecondCouplePartner = 0;
        $WeddingModel = new \app\models\Weddings();
        if ($CouplePartnerID != 0) {

            $where = new ActiveDataProvider([
                'query' => $WeddingModel->find()->where('FIRST_COUPLE_PARTNER_ID = ' . $CouplePartnerID . ' OR SECOND_COUPLE_PARTNER_ID=' . $CouplePartnerID . ' '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            if ($where != null && isset($where)) {
                $models1 = $where->getModels();
                if ($models1[0]->FIRST_COUPLE_PARTNER_ID != NULL && $models1[0]->FIRST_COUPLE_PARTNER_ID != $CouplePartnerID) {
                    $SecondCouplePartner = $models1[0]->FIRST_COUPLE_PARTNER_ID;
                } else {
                    if ($models1[0]->SECOND_COUPLE_PARTNER_ID != NULL) {
                        $SecondCouplePartner = $models1[0]->SECOND_COUPLE_PARTNER_ID;
                    }
                }
            }
        }
        $dataGenders = new ActiveDataProvider([
            'query' => \app\models\GenderTranslation::find()->select(['gender_translation.GENDER_ID', 'gender_translation.GENDER_TRANS_VALUE'])->where(' LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $dataCountry = new ActiveDataProvider([
            'query' => \app\models\CountriesTrans::find()->select(['countries_trans.COUNTRY_ID', 'countries_trans.COUNTRY_TRANS_NAME'])->where(' LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        $dataWeddingType = new ActiveDataProvider([
            'query' => \app\models\WeddingTypeTranslation::find()->select(['wedding_type_translation.WEDDING_TYPE_ID', 'wedding_type_translation.WEDDING_TYPE_TRANSLATION'])->where(' LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        $dataWeddingCountry = new ActiveDataProvider([
            'query' => \app\models\CountriesTrans::find()->select(['countries_trans.COUNTRY_ID', 'countries_trans.COUNTRY_TRANS_NAME'])->where(' LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        if ($CouplePartnerID != 0) {
            $dataProvider = new ActiveDataProvider([
                'query' => CouplePartner::find()->where('COUPLE_PARTNER_ID = ' . $CouplePartnerID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);

            $models = $dataProvider->getModels();
            $CountryID = ($models != NULL && sizeof($models) > 0 && $models[0]->COUNTRY_ID != NULL ? $models[0]->COUNTRY_ID : "0");
            $dataCity = new ActiveDataProvider([
                'query' => \app\models\CitiesTranslation::findBySql('select t.CITY_ID, t.CITY_TRANSLATION from cities inner join cities_translation t on cities.CITY_ID=t.CITY_ID where cities.COUNTRY_ID = ' . $CountryID . ' AND t.LANGUAGE_ID=1 '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
//         $dataCity = \app\models\Cities::find()->select(['cities.CITY_ID', 'cities_translation.CITY_TRANSLATION'])->innerJoin('cities_translation' ,'cities.CITY_ID=cities_translation.CITY_ID')->where('cities.COUNTRY_ID = '.$CountryID.' ');
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
//        $dataCity = \app\models\Cities::find();

            $SecondPartnerDataProvider = null;
            $SeconddataCity = null;
            if ($SecondCouplePartner != 0) {
                $SecondPartnerDataProvider = new ActiveDataProvider([
                    'query' => CouplePartner::find()->where('COUPLE_PARTNER_ID = ' . $SecondCouplePartner),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
                ]);

                $Secondmodels = $SecondPartnerDataProvider->getModels();
                $SecondCountryID = ($Secondmodels != NULL && sizeof($Secondmodels) > 0 && $Secondmodels[0]->COUNTRY_ID != NULL ? $Secondmodels[0]->COUNTRY_ID : "0");
                $SeconddataCity = new ActiveDataProvider([
                    'query' => \app\models\CitiesTranslation::findBySql('select t.CITY_ID, t.CITY_TRANSLATION from cities inner join cities_translation t on cities.CITY_ID=t.CITY_ID where cities.COUNTRY_ID = ' . $SecondCountryID . ' AND t.LANGUAGE_ID=1 '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
                ]);
            }
//         $dataCity = \app\models\Cities::find()->select(['cities.CITY_ID', 'cities_translation.CITY_TRANSLATION'])->innerJoin('cities_translation' ,'cities.CITY_ID=cities_translation.CITY_ID')->where('cities.COUNTRY_ID = '.$CountryID.' ');
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
//        $dataCity = \app\models\Cities::find();

            $CouplePartnerModel = new CouplePartner();
            $SecCpuplePartnerModel = new CouplePartner();
            return $this->render('index', [
                        'dataProvider' => $dataProvider,
                        'CouplePartnerModel' => $CouplePartnerModel,
                        'SecCpuplePartnerModel' => $SecCpuplePartnerModel,
                        'dataGenders' => $dataGenders,
                        'dataCountry' => $dataCountry,
                        'dataCity' => $dataCity,
                        'SecondPartnerDataProvider' => $SecondPartnerDataProvider,
                        'SeconddataCity' => $SeconddataCity,
                        'dataWeddingType' => $dataWeddingType,
                        'dataWeddingCountry' => $dataWeddingCountry,
                        'WeddingModel' => $WeddingModel,
                        'stringHash' => $stringHash,
            ]);
        } else {
            $CouplePartnerModel = new CouplePartner();
            $SecCpuplePartnerModel = new CouplePartner();
            return $this->render('index', [
                        'CouplePartnerModel' => $CouplePartnerModel,
                        'SecCpuplePartnerModel' => $SecCpuplePartnerModel,
                        'dataGenders' => $dataGenders,
                        'dataCountry' => $dataCountry,
                        'dataWeddingType' => $dataWeddingType,
                        'dataWeddingCountry' => $dataWeddingCountry,
                        'WeddingModel' => $WeddingModel,
                        'stringHash' => $stringHash,
            ]);
        }
        $actionIndex = $this->actionIndex();
//    $CouplePartnerModell =new  CouplePartner();
//    $SecCpuplePartnerModel=new  CouplePartner();
//    return $this->render('index');
    }

    public function actionSaveweddingprofileimg() {
        $model = new \app\models\Weddings();

//       Yii::error(" HELLLOOOO   testtttttttttttadasdsadddddddddddddddddddddddddddddddddddddd ");
        $WeddingID = 0;
        if (Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        if (Yii::$app->request->isPost) {

            $model->imageFile = UploadedFile::getInstanceByName('image');
            if ($model->validate(array('imageFile'))) {
                $upload = $model->upload();
                Yii::error("upload : " . $upload);
                if ($upload != null) {
                    $model = Weddings::findOne(['WEDDING_ID' => $WeddingID]);
                    // file is uploaded successfully
                    Yii::$app->response->format = Response::FORMAT_JSON;
//                Yii::error(" HELLLOOOO   uploaded ");
                    $model->COUPLE_IMG = $upload;
                    if ($model->save(false)) {
                        
                    }
                    return ['return' => Yii::getAlias('@web') . $upload];
                }
            }
        }
    }

    public function actionSaveprofileimg() {
        $model = new CouplePartner();
        $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID;
//       Yii::error(" HELLLOOOO   testtttttttttttadasdsadddddddddddddddddddddddddddddddddddddd ");

        if (Yii::$app->request->isPost) {

            $model->imageFile = UploadedFile::getInstanceByName('image');
            if ($model->validate(array('imageFile'))) {
                $upload = $model->upload();
                Yii::error($upload);
                if ($upload != null) {
                    $model = CouplePartner::findIdentity($CouplePartnerID);
                    // file is uploaded successfully
                    Yii::$app->response->format = Response::FORMAT_JSON;
//                Yii::error(" HELLLOOOO   uploaded ");
                    $model->USER_PROFILE_PIC = $upload;
                    if ($model->save(false)) {
                        
                    }
                    return ['return' => Yii::getAlias('@web') . $upload];
                }
            }
        }
    }

    public function actionSavecouplepartner() {


        $CouplePartnerModel = new CouplePartner();
        $SecCpuplePartnerModel = new CouplePartner();
//       $actionperformAjaxValidation = $this->actionperformAjaxValidation($CouplePartnerModel);

        Yii::error("testtttttttttttadasdsa ");
        $CouplePartnerID = 0;
        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }
 $WeddingID = 0;
        if (Yii::$app->user->identity != null) {
//            $weddings
// * @property Weddings[] $weddings0
            $WeddingID = Yii::$app->user->identity->weddings != NULL  && sizeof(Yii::$app->user->identity->weddings) >0 ? Yii::$app->user->identity->weddings[0]->WEDDING_ID : 0;
        }
        $CouplePartnerModel = CouplePartner::findIdentity($CouplePartnerID);
//        if($CouplePartnerModel===null)
//        {
//            $profile=new Profile;
//            $profile->user_id = Yii::app()->user->id;
//        }else{
//            
//        }
//        && $profile->load(Yii::$app->request->post())
        if ($CouplePartnerModel != null) {
            Yii::error("testtttttttttttadasdsa 1");
            if ($CouplePartnerModel->load(Yii::$app->request->post())) {
                Yii::error("testtttttttttttadasdsa 2" . $CouplePartnerModel->COUPLE_PARTNER_LAST_NAME);
                $hashedPassword = Yii::$app->getSecurity()->generatePasswordHash($CouplePartnerModel->COUPLE_PARTNER_PASSWORD);
//                $isValid = $CouplePartnerModel->validate();
                $isValid = true;
//            $isValid = $profile->validate() && $isValid;
                if ($isValid) {
                    $CouplePartnerModel->COUPLE_PARTNER_PASSWORD = $hashedPassword;
                    $CouplePartnerModel->save(false);
                    
                    
                    $WeddingModel = new \app\models\Weddings();
                if ($WeddingModel->load(Yii::$app->request->post()) && $WeddingID!=0) {
                  $WeddingModel->FIRST_COUPLE_PARTNER_ID = $firstPartnerID;
                $WeddingModel->SECOND_COUPLE_PARTNER_ID = $SecondPartnerID;
                $WeddingModel->WEDDING_ID=$WeddingID;
                $WeddingModel->save(false);  
                }
                    return $this->actionIndex();
//                $profile->save(false);
//                return $this->redirect(['user/view', 'id' => $id]);
                } else {
                    // validation failed: $errors is an array containing error messages
                    $errors = $CouplePartnerModel->errors;
                }
            }
        } else {
            $CouplePartnerModel = new CouplePartner();
            if ($CouplePartnerModel->load(Yii::$app->request->post())) {
//                $CouplePartnerModel
                $FirstEm=$CouplePartnerModel->COUPLE_PARTNER_EMAIL;
                $hashedPassword = Yii::$app->getSecurity()->generatePasswordHash($CouplePartnerModel->COUPLE_PARTNER_PASSWORD);
                $CouplePartnerModel->COUPLE_PARTNER_PASSWORD=$hashedPassword;
                $CouplePartnerModel->save(false);
                $SecCpuplePartnerModel->COUPLE_PARTNER_EMAIL = $CouplePartnerModel->SecondEmail;
                $SecCpuplePartnerModel->COUPLE_PARTNER_MOBILE_NUMBER = $CouplePartnerModel->SecondPhoneNumber;
                $SecCpuplePartnerModel->COUPLE_PARTNER_FIRST_NAME = $CouplePartnerModel->First_Name;
                $SecCpuplePartnerModel->COUPLE_PARTNER_LAST_NAME = $CouplePartnerModel->Last_Name;
                $SecCpuplePartnerModel->save(false);
                $firstPartnerID = $CouplePartnerModel->getPrimaryKey();
                $SecondPartnerID = $SecCpuplePartnerModel->getPrimaryKey();
                $WeddingModel = new \app\models\Weddings();
                if ($WeddingModel->load(Yii::$app->request->post())) {
                  $WeddingModel->FIRST_COUPLE_PARTNER_ID = $firstPartnerID;
                $WeddingModel->SECOND_COUPLE_PARTNER_ID = $SecondPartnerID;
                
                $WeddingModel->save(false);  
                }
                
//                $isValid = $CouplePartnerModel->validate();
////            $isValid = $profile->validate() && $isValid;
////                if ($isValid) {
//                $save1 = $CouplePartnerModel->save(false);
//                    $save0 = $SecCpuplePartnerModel->save(false);
                if($CouplePartnerModel->SecondEmail!=null && !empty($CouplePartnerModel->SecondEmail)){
                Yii::$app->mailer->compose()
                        ->setFrom('sabra331990@gmail.com')
                        ->setTo($CouplePartnerModel->SecondEmail)
                        ->setSubject('Wedding App Invitation')
                        ->setTextBody('Hello, your are invited to use this app. Please click on the link blow to continue your registration')
                        ->setHtmlBody('<a href=\'http://www.wedding-xperteam.com/index.php?r=couple-partner%2Findex&userID=' . $SecondPartnerID . '\'>http://www.wedding-xperteam.com</a>')
                        ->send();
                Yii::error("testtttttttttttadasdsa 444");
            }
            $session = Yii::$app->session;
            $session->set('em', $FirstEm);
             return $this->redirect(['site/login']);
//                return $this->actionNewIndex($firstPartnerID);
//                $profile->save(false);
//                }
            }
        }
//   $this->re
//
    }

    public function actionResetPassword() {
        $CouplePartnerID = 0;
        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }
        $CouplePartnerMod=new CouplePartner();
        $PasswordChangeMod=new \app\models\PasswordForm();
        $dataProvider = new ActiveDataProvider([
                'query' => CouplePartner::find()->where('COUPLE_PARTNER_ID = ' . $CouplePartnerID),
            ]);
        
      return $this->renderAjax('resetpassword', [
            'dataProvider' => $dataProvider,
            'CouplePartnerMod' => $CouplePartnerMod,
            'PasswordChangeMod' => $PasswordChangeMod,
                        
            ]);  
    }
public function actionChangepassword(){
        $model = new \app\models\PasswordForm();
        $modeluser = CouplePartner::find()->where([
            'COUPLE_PARTNER_ID'=>Yii::$app->user->identity->COUPLE_PARTNER_ID
        ])->one();
      if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) 
{
Yii::$app->response->format = Response::FORMAT_JSON;
return ActiveForm::validate($model);
}
        if( $model->load(Yii::$app->request->post())){
            if($model->validate()){
                try{
                    $hashedPassword = Yii::$app->getSecurity()->generatePasswordHash( $_POST['PasswordForm']['newpass']);
                    $modeluser->COUPLE_PARTNER_PASSWORD =$hashedPassword;
                    if($modeluser->save(false)){
                        Yii::$app->getSession()->setFlash(
                            'success','Password changed'
                        );
                        return $this->redirect(['index']);
                    }else{
                        Yii::$app->getSession()->setFlash(
                            'error','Password not changed'
                        );
                        return $this->redirect(['index']);
                    }
                }catch(Exception $e){
                    Yii::$app->getSession()->setFlash(
                        'error',"{$e->getMessage()}"
                    );
                    return $this->renderAjax('resetpassword',[
                        'PasswordChangeMod'=>$model
                    ]);
                }
            }else{
                
                
       
   
                $errors = $model->errors;
                return $this->render('resetpassword',[
                    'PasswordChangeMod'=>$model
                ]);
            }
        }else{
            return $this->renderAjax('resetpassword',[
                'PasswordChangeMod'=>$model
            ]);
        }
    }
}
