<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\data\ActiveDataProvider;
use app\models\genders;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\models\CouplePartner;
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [

            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                    'language' => ['post', 'get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
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

    public function oAuthSuccess($client) {
        // get user data from client
        $userAttributes = $client->getUserAttributes();
        if ($userAttributes != NULL && sizeof($userAttributes) > 0 && $userAttributes['email'] != NULL) {
            $model = new LoginForm();
            $model->loginFacebook($userAttributes['email']);
//    loginFacebook($SocialMediaEmail)
            // do some thing with user data. for example with $userAttributes['email']
        }
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {

        
        
        $CategorydataProvider = new ActiveDataProvider([
            'query' => \app\models\CategoryOfItems::find()->where(['CATEGORY_PUBLIC' => 'P']),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);


        $model = new LoginForm();

        $Range = \app\models\GetStartedRange::find()->where(['CURRENCY_ID' => 1])->all();
        $cookies = Yii::$app->response->cookies;
//        $EstimatedFunding = null;
//        $EstimatedBudget = null;
            $where0 = null;
                $EstimatedFunding = $cookies->getValue('EstimatedFunding', '0');
              $EstimatedBudget=$cookies->getValue('estimatedbudget', '0');
              $InviteeNumber=$cookies->getValue('InviteeNumber', '0');
              $DateRangePicker=$cookies->getValue('DateRangePicker', '0');
              $PreferedDays=$cookies->getValue('preferedDays', '0');
       
   
                         $CounCode="0"; 
                          if (isset($cookies['countryCode'])) {
                            $CounCode = $cookies['countryCode']->value;
                      }
                      $CountryID=0;
                      if($CounCode!='0'){
                         $CountryData = new ActiveDataProvider([
                'query' => \app\models\Countries::find()->where(['COUNTRY_CODE'=>$CounCode]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]); 
                         if($CountryData!=null ){
                             $CountryData=$CountryData->getModels();
                             if(sizeof($CountryData)>0){
                                 $CountryID=$CountryData[0]->COUNTRY_ID;
                             }
                         }
                      }
                  if($CountryID!=0){
                     $Videos = new ActiveDataProvider([
                'query' => \app\models\HomePageVideos::find()->innerJoin('home_page_video_countries','home_page_videos.VIDEO_ID=home_page_video_countries.HOME_PAGE_VIDEO_ID')->where('home_page_video_countries.COUNTRY_ID = '.$CountryID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]); 
                  }else{
                   $Videos = new ActiveDataProvider([
                'query' => \app\models\HomePageVideos::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);   
                  }  
            if ($Videos != null) {
                $Videos = $Videos->getModels();
            }
        $this->view->params['loginformmodel'] = $model;
        return $this->render('home', [
                    'CategorydataProvider' => $CategorydataProvider,
                    'model' => $model,
                    
                    'Range' => $Range,
                    'Videos'=>$Videos
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionValidate() {
        $model = new \app\models\LoginForm();
        Yii::error('Validating : ');

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->runAction('wedding-estimated-budget/save-estimated-budget');
            $SupplierID = 0;
            if (Yii::$app->user->identity != null) {
                $SupplierID = Yii::$app->user->identity->SUPPLIER_ID != NULL ? Yii::$app->user->identity->SUPPLIER_ID : 0;
            }
            if ($SupplierID != 0) {
                Yii::$app->user->loginUrl = ['supplier/listitems'];
                return $this->goHome(['supplier/listitems']);
            } else {
                Yii::$app->user->loginUrl = ['wedding-estimated-budget/index'];
            }

            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login() && $model->validate()) {
            Yii::$app->runAction('wedding-estimated-budget/save-estimated-budget');
            $SupplierID = 0;

            if (Yii::$app->user->identity != null) {
                $SupplierID = Yii::$app->user->identity->SUPPLIER_ID != NULL ? Yii::$app->user->identity->SUPPLIER_ID : 0;
            }
            if ($SupplierID != 0) {

                return $this->redirect(['supplier/listitems']);
            } else {
                Yii::$app->user->loginUrl = ['wedding-estimated-budget/index'];
            }
            return $this->goBack();
        }
        
         $CouplePartnerID = 0;
        
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

            $CouplePartnerModel = new app\models\CouplePartner();
            $SecCpuplePartnerModel = new CouplePartner();
            return $this->renderAjax('logina', [
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
                        'model' => $model,
            ]);
        } else {
            $CouplePartnerModel = new CouplePartner();
            $SecCpuplePartnerModel = new CouplePartner();
            return $this->renderAjax('logina', [
                        'CouplePartnerModel' => $CouplePartnerModel,
                        'SecCpuplePartnerModel' => $SecCpuplePartnerModel,
                        'dataGenders' => $dataGenders,
                        'dataCountry' => $dataCountry,
                        'dataWeddingType' => $dataWeddingType,
                        'dataWeddingCountry' => $dataWeddingCountry,
                        'WeddingModel' => $WeddingModel,
                        'model' => $model,
            ]);
        }

        
        
    }

    public function actionLoginAfterError() {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->runAction('wedding-estimated-budget/save-estimated-budget');
            $SupplierID = 0;
            if (Yii::$app->user->identity != null) {
                $SupplierID = Yii::$app->user->identity->SUPPLIER_ID != NULL ? Yii::$app->user->identity->SUPPLIER_ID : 0;
            }
            if ($SupplierID != 0) {
                Yii::$app->user->loginUrl = ['supplier/listitems'];
                return $this->goHome(['supplier/listitems']);
            } else {
                Yii::$app->user->loginUrl = ['wedding-estimated-budget/index'];
            }

            return $this->goHome();
        }

        $model = new LoginForm();
         $CouplePartnerModel = new \app\models\CouplePartner();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->runAction('wedding-estimated-budget/save-estimated-budget');
            $SupplierID = 0;

            if (Yii::$app->user->identity != null) {
                $SupplierID = Yii::$app->user->identity->SUPPLIER_ID != NULL ? Yii::$app->user->identity->SUPPLIER_ID : 0;
            }
            if ($SupplierID != 0) {

                return $this->redirect(['supplier/listitems']);
            } else {
                Yii::$app->user->loginUrl = ['wedding-estimated-budget/index'];
            }
            return $this->goBack();
        }
        return $this->render('logina', [
                    'model' => $model,
                    'CouplePartnerModel'=>$CouplePartnerModel,
        ]);
    }

    public function actionLanguage() {
        if (Yii::$app->request->post('_lang') !== NULL && array_key_exists(Yii::$app->request->post('_lang'), Yii::$app->params['LanguagesToSelectFrom'])) {
            Yii::$app->language = Yii::$app->request->post('_lang');
            $cookie = new yii\web\Cookie([
                'name' => '_lang',
                'value' => Yii::$app->request->post('_lang'),
            ]);
            Yii::$app->getResponse()->getCookies()->add($cookie);
        }
        Yii::$app->end();
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout() {
        return $this->render('about');
    }

    public function actionHome() {
        $CategorydataProvider = new ActiveDataProvider([
            'query' => \app\models\CategoryOfItems::find()->where(['CATEGORY_PUBLIC' => 'P']),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        if (!Yii::$app->user->isGuest) {
            $SupplierID = 0;
            if (Yii::$app->user->identity != null) {
                $SupplierID = Yii::$app->user->identity->SUPPLIER_ID != NULL ? Yii::$app->user->identity->SUPPLIER_ID : 0;
            }
            if ($SupplierID != 0) {
                Yii::$app->user->loginUrl = ['supplier/listitems'];
                return $this->goHome(['supplier/listitems']);
            } else {
                Yii::$app->user->loginUrl = ['wedding-estimated-budget/index'];
            }

            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $SupplierID = 0;

            if (Yii::$app->user->identity != null) {
                $SupplierID = Yii::$app->user->identity->SUPPLIER_ID != NULL ? Yii::$app->user->identity->SUPPLIER_ID : 0;
            }
            if ($SupplierID != 0) {

                return $this->redirect(['supplier/listitems']);
            } else {
                Yii::$app->user->loginUrl = ['wedding-estimated-budget/index'];
            }
            return $this->goBack();
        }
        $where0 = null;
        $Range = \app\models\GetStartedRange::find()->where(['CURRENCY_ID' => 1])->all();
        
         $cookies = Yii::$app->request->cookies;
                         $CounCode="0"; 
                          if (isset($cookies['countryCode'])) {
                            $CounCode = $cookies['countryCode']->value;
                      }
                      $CountryID=0;
                      if($CounCode!='0'){
                         $CountryData = new ActiveDataProvider([
                'query' => \app\models\Countries::find()->where(['COUNTRY_CODE'=>$CounCode]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]); 
                         if($CountryData!=null ){
                             $CountryData=$CountryData->getModels();
                             if(sizeof($CountryData)>0){
                                 $CountryID=$CountryData[0]->COUNTRY_ID;
                             }
                         }
                      }
                  if($CountryID!=0){
                     $Videos = new ActiveDataProvider([
                'query' => \app\models\HomePageVideos::find()->innerJoin('home_page_video_countries','home_page_videos.VIDEO_ID=home_page_video_countries.HOME_PAGE_VIDEO_ID')->where('home_page_video_countries.COUNTRY_ID = '.$CountryID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]); 
                  }else{
                   $Videos = new ActiveDataProvider([
                'query' => \app\models\HomePageVideos::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);   
                  }    
        
            if ($Videos != null) {
                $Videos = $Videos->getModels();
            }
        return $this->render('home', [
                    'CategorydataProvider' => $CategorydataProvider,
                    'model' => $model,
                    
                    'Range' => $Range,
                    
                    'Videos'=>$Videos
        ]);
    }

    public function actionDashboard() {
        return $this->render('dashboard');
    }

//    public function actionGenders()
//    {
//        $model = new genders();
//        return $this->render('genders',array('model'=>$model));
//    }

    public function getToken($Token) {
        $model = \app\models\CouplePartner::findIdentityByAccessToken($Token);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionVerToken() {
        $ReceivedToken = "";
        if (Yii::$app->request != null && Yii::$app->request->get('T') != null) {
            $ReceivedToken = Yii::$app->request->get('T');
        }
        if ($ReceivedToken != "") {
            $model = $this->getToken($ReceivedToken);

            if ($model->TOKEN == $ReceivedToken) {
                $session = Yii::$app->session;
                $session->set('token', $ReceivedToken);
                $model = new \app\models\PasswordForm();
                return $this->render('resetpassword', [
                            'PasswordChangeMod' => $model,
                ]);
            } else {
                $CategorydataProvider = new ActiveDataProvider([
                    'query' => \app\models\CategoryOfItems::find()->where(['CATEGORY_PUBLIC' => 'P']),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
                ]);
                if (!Yii::$app->user->isGuest) {
                    $SupplierID = 0;
                    if (Yii::$app->user->identity != null) {
                        $SupplierID = Yii::$app->user->identity->SUPPLIER_ID != NULL ? Yii::$app->user->identity->SUPPLIER_ID : 0;
                    }
                    if ($SupplierID != 0) {
                        Yii::$app->user->loginUrl = ['supplier/listitems'];
                        return $this->goHome(['supplier/listitems']);
                    } else {
                        Yii::$app->user->loginUrl = ['wedding-estimated-budget/index'];
                    }

                    return $this->goHome();
                }

                $model = new LoginForm();
                if ($model->load(Yii::$app->request->post()) && $model->login()) {
                    $SupplierID = 0;

                    if (Yii::$app->user->identity != null) {
                        $SupplierID = Yii::$app->user->identity->SUPPLIER_ID != NULL ? Yii::$app->user->identity->SUPPLIER_ID : 0;
                    }
                    if ($SupplierID != 0) {

                        return $this->redirect(['supplier/listitems']);
                    } else {
                        Yii::$app->user->loginUrl = ['wedding-estimated-budget/index'];
                    }
                    return $this->goBack();
                }
                return $this->render('home', [
                            'CategorydataProvider' => $CategorydataProvider,
                            'model' => $model
                ]);
            }
        }
    }

    public function actionNewPassword() {
        $session = Yii::$app->session;
        $Token = $session->get('token');
        Yii::error("testtttttttttttadasdsa honnnnnnnnn : " . $Token);
        $model = new \app\models\PasswordForm();
        $modeluser = \app\models\CouplePartner::findOne(['TOKEN' => $Token]);
        if ($modeluser != null) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate(['newpass', 'repeatnewpass'])) {
                    Yii::error("testtttttttttttadasdsa honnnnnnnnn 1: " . $Token);
                    try {
                        Yii::error("testtttttttttttadasdsa honnnnnnnnn2 : " . $Token);
                        $hashedPassword = Yii::$app->getSecurity()->generatePasswordHash($model->newpass);
                        $modeluser->COUPLE_PARTNER_PASSWORD = $hashedPassword;
                        if ($modeluser->save(false)) {
                            Yii::error("testtttttttttttadasdsa honnnnnnnnn 3: " . $Token);
                            Yii::$app->getSession()->setFlash(
                                    'success', 'Password changed'
                            );
                            return $this->redirect(['login']);
                        } else {
                            Yii::$app->getSession()->setFlash(
                                    'error', 'Password not changed'
                            );
                            return $this->redirect(['login']);
                        }
                    } catch (Exception $e) {
                        Yii::$app->getSession()->setFlash(
                                'error', "{$e->getMessage()}"
                        );
                        return $this->renderAjax('resetpassword', [
                                    'PasswordChangeMod' => $model
                        ]);
                    }
                } else {




                    $errors = $model->errors;
                    return $this->render('resetpassword', [
                                'PasswordChangeMod' => $model
                    ]);
                }
            } else {
                return $this->renderAjax('resetpassword', [
                            'PasswordChangeMod' => $model
                ]);
            }
        } else {
            return $this->renderAjax('resetpassword', [
                        'PasswordChangeMod' => $model
            ]);
        }
    }

    public function actionForgotPassword() {


        $ResetFormMod = new \app\models\ResetForm();


        return $this->renderAjax('forgotpassword', [

                    'ResetFormMod' => $ResetFormMod,
        ]);
    }

    public function actionForgot() {
        $model = new \app\models\ResetForm();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        Yii::error("testtttttttttttadasdsa honnnnnnnnn");
        if ($model->load(Yii::$app->request->post())) {
            Yii::error("testtttttttttttadasdsa honnnnnnnnn 1");
            if ($model->validate()) {
                Yii::error("testtttttttttttadasdsa honnnnnnnnn 2");
                Yii::error("testtttttttttttadasdsa honnnnnnnnn 3 " . $model->Email);
                $CouplePartner = \app\models\CouplePartner::findOne(['COUPLE_PARTNER_EMAIL' => $model->Email]);
                if ($CouplePartner != null && sizeof($CouplePartner) > 0) {
                    Yii::error("testtttttttttttadasdsa honnnnnnnnn 4 " . $model->Email);
                    $getToken = rand(0, 99999);
                    $getTime = date("H:i:s");
                    $md5 = md5($getToken . $getTime);
                    $CouplePartner->TOKEN = md5($getToken . $getTime);

                    Yii::$app->mailer->compose()
                            ->setFrom('sabra331990@gmail.com')
                            ->setTo($model->Email)
                            ->setSubject('Reset Password')
//    ->setTextBody($SupplierModel->SIGN_UP_MESSAGE)
                            ->setHtmlBody('<p>Hello ,</p><p>For Reset Password,Click on this link :</p><br><p><a href="http://localhost/yiiApp/basic/web/index.php?r=site%2Fver-token&T=' . $md5 . '">Click Here</a></p>')
                            ->send();
                    $CouplePartner->save(false);
                    return $this->redirect(['login']);
                }
                return $this->redirect(['login']);
            }
        }
        return $this->redirect(['login']);
    }

    public function actionGlobalSearch($q = null) {

        $Data = ['Pages' => [
            ['id' => 'index.php', 'text' => 'Home'],
            ['id' => 'test', 'text' => 'PPPP']
            ]
            ];


        if (!is_null($q)) {
            $Categories = new ActiveDataProvider([
                'query' => \app\models\CategoryOfItems::find()->innerJoin('category_of_items_trans', 'category_of_items_trans.CATEGORY_OF_ITEM_ID=category_of_items.CATEGORY_OF_ITEM_ID')->where('category_of_items_trans.CATEGORY_OF_ITEM_TRANS LIKE \'%' . $q . '%\'  AND LANGUAGE_ID=1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            if ($Categories != null) {
                $Categories = $Categories->getModels();
                $i = 2;
                if ($Categories != null && sizeof($Categories) > 0) {
                    foreach ($Categories as $Category) {

//                     $CATEGORY_OF_ITEM_TRANS
// * @property integer $LANGUAGE_ID
                        $Data['Pages'][$i] = ['id' => 'index.php?r=category-of-items%2Findex&Reg=C&CategoryID=' . $Category->CATEGORY_OF_ITEM_ID,'text' => $Category->categoryOfItemsTrans[0]->CATEGORY_OF_ITEM_TRANS];

//                        $Data['Pages'][$i] = [];
                        $i++;
                    }
                }
            }

//        $query = new Query;
//        $query->select('id, name AS text')
//            ->from('city')
//            ->where(['like', 'name', $q])
//            ->limit(20);
//        $command = $query->createCommand();
//        $data = $command->queryAll();
//        $out['results'] = array_values($data);
        }
        Yii::error(print_r($Data, true));
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['results' => $Data];
    }

}
