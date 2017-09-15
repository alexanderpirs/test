<?php

namespace app\controllers;

use Yii;
use \app\models\Suppliers;
use app\models\ItemViewNumber;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use \app\models\CouplePartner;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\models\SuppliersLocations;
use app\models\SupplierBusinessType;
use app\models\Model;
//use yii\base\M
use app\models\SupplierOfferedServices;
use \app\models\SupplierPartnerThru;
use app\models\SupplierPayment;
use app\models\ItemsSupplieirs;
use app\models\ItemSupplierTranslation;
use app\models\ItemOptionTrans;
use app\models\ItemOptions;

class SupplierController extends \yii\web\Controller {

    public function actionIndex() {
        $Supplier = new Suppliers();

        $CouplePartnerID = 0;
        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }
        $CityTransMod = new \app\models\CitiesTranslation();
        $SupplierLocationModel = new \app\models\SuppliersLocations();
        $dataSupplierLocationModels = [new \app\models\SuppliersLocations];
//        $dataSupplierLocationModels=[new \app\models\SuppliersLocations];
//        $dataSupplierLocation = new ActiveDataProvider([
//            'query' => \app\models\SuppliersLocations::find(),
////                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
//        ]);
        $dataSupplierType = new ActiveDataProvider([
            'query' => \app\models\SuplierTypeTrans::find()->select(['suplier_type_trans.SUPLIER_TYPE_ID', 'suplier_type_trans.SUPLIER_TYPE_NAME'])->where(' LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $dataPartnerThru = new ActiveDataProvider([
            'query' => \app\models\PartnerThrough::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $SupplierPaymentModel = new \app\models\SupplierPayment();
        $dataPayments = new ActiveDataProvider([
            'query' => \app\models\Payment::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $dataCountry = new ActiveDataProvider([
            'query' => \app\models\CountriesTrans::find()->select(['countries_trans.COUNTRY_ID', 'countries_trans.COUNTRY_TRANS_NAME'])->where(' LANGUAGE_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $dataBusinessType = new ActiveDataProvider([
            'query' => \app\models\BusinessType::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $dataCategories = new ActiveDataProvider([
            'query' => \app\models\CategoryOfItems::find(),
            'pagination' => false,
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        $BankModel = new \app\models\Bank();
        $dataBank = new ActiveDataProvider([
            'query' => \app\models\Bank::findBySql('select BANK_ID ,BANK_NAME from bank '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        if ($CouplePartnerID != 0) {
//            $SupplierID=0;
            $dataProvider = new ActiveDataProvider([
                'query' => CouplePartner::find()->where('COUPLE_PARTNER_ID = ' . $CouplePartnerID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);

            $models = $dataProvider->getModels();
            $SupplierID = ($models != NULL && sizeof($models) > 0 && $models[0]->SUPPLIER_ID != NULL ? $models[0]->SUPPLIER_ID : "0");

            if ($SupplierID != "0") {

//                 = \app\models\SuppliersLocations::find(['SUPPLIER_ID'=>$SupplierID])->asArray();
                $dataSupplierLocationModels = new ActiveDataProvider([
                    'query' => \app\models\SuppliersLocations::find()->where('SUPPLIER_ID = ' . $SupplierID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
                ]);
                $SupplierBusinessTypeModel = new SupplierBusinessType();
                $dataSupplierBusinessType = new ActiveDataProvider([
                    'query' => SupplierBusinessType::find()->where('SUPPLIER_ID = ' . $SupplierID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
                ]);
                $SupplierOfferedServicesModel = new SupplierOfferedServices();
                $dataSupplierOfferedServices = new ActiveDataProvider([
                    'query' => SupplierOfferedServices::find()->where('SUPPLIER_ID = ' . $SupplierID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
                ]);
                $dataSupplier = new ActiveDataProvider([
                    'query' => Suppliers::find()->where('SUPPLIER_ID = ' . $SupplierID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
                ]);


                $Suppliermodels = $dataSupplier->getModels();
                $CountryID = ($Suppliermodels != NULL && sizeof($Suppliermodels) > 0 && $Suppliermodels[0]->COUNTRY_ID != NULL ? $Suppliermodels[0]->COUNTRY_ID : "0");
                $dataCity = new ActiveDataProvider([
                    'query' => \app\models\CitiesTranslation::findBySql('select t.CITY_ID, t.CITY_TRANSLATION from cities inner join cities_translation t on cities.CITY_ID=t.CITY_ID where cities.COUNTRY_ID = ' . $CountryID . ' AND t.LANGUAGE_ID=1 '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
                ]);
                $SupplerTypeID = ($Suppliermodels != NULL && sizeof($Suppliermodels) > 0 && $Suppliermodels[0]->SUPPLIER_TYPE_ID != NULL ? $Suppliermodels[0]->SUPPLIER_TYPE_ID : "0");
                $dataSupplierTypeBusinessType = new ActiveDataProvider([
                    'query' => \app\models\SupplierTypeBusinessType::find()->where(['SUPPLIER_TYPE_ID' => $SupplerTypeID]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
                ]);
                $CouplePartnerModel = new CouplePartner();

                return $this->render('index', [
                            'dataProvider' => $dataProvider,
                            'CouplePartnerModel' => $CouplePartnerModel,
                            'dataSupplier' => $dataSupplier,
                            'dataCountry' => $dataCountry,
                            'dataCity' => $dataCity,
                            'Supplier' => $Supplier,
                            'dataSupplierType' => $dataSupplierType,
                            'dataBusinessType' => $dataBusinessType,
                            'dataCategories' => $dataCategories,
                            'SupplierLocationModel' => $SupplierLocationModel,
//                            'dataSupplierLocation' => $dataSupplierLocation,
                            'dataSupplierLocation' => $dataSupplierLocationModels,
                            'SupplierBusinessTypeModel' => $SupplierBusinessTypeModel,
                            'dataSupplierBusinessType' => $dataSupplierBusinessType,
                            'SupplierOfferedServicesModel' => $SupplierOfferedServicesModel,
                            'dataSupplierOfferedServices' => $dataSupplierOfferedServices,
                            'CityTransMod' => $CityTransMod,
                            'dataPayments' => $dataPayments,
                            'dataPartnerThru' => $dataPartnerThru,
                            'dataBank' => $dataBank,
                            'BankModel' => $BankModel,
                            'SupplierPaymentModel' => $SupplierPaymentModel,
                            'dataSupplierTypeBusinessType' => $dataSupplierTypeBusinessType,
                ]);
            } else {
                $CouplePartnerModel = new CouplePartner();

                return $this->render('index', [
                            'CouplePartnerModel' => $CouplePartnerModel,
                            'Supplier' => $Supplier,
                            'dataCountry' => $dataCountry,
                            'dataSupplierType' => $dataSupplierType,
                            'dataBusinessType' => $dataBusinessType,
                            'dataCategories' => $dataCategories,
                            'SupplierLocationModel' => $SupplierLocationModel,
//                            'dataSupplierLocation' => $dataSupplierLocation,
                            'dataSupplierLocation' => [new \app\models\SuppliersLocations],
                            'dataPayments' => $dataPayments,
                            'dataPartnerThru' => $dataPartnerThru,
                            'dataBank' => $dataBank,
                            'BankModel' => $BankModel,
                            'SupplierPaymentModel' => $SupplierPaymentModel,
                ]);
            }
        } else {
            $CouplePartnerModel = new CouplePartner();

            return $this->render('index', [
                        'CouplePartnerModel' => $CouplePartnerModel,
                        'Supplier' => $Supplier,
                        'dataCountry' => $dataCountry,
                        'dataSupplierType' => $dataSupplierType,
                        'dataBusinessType' => $dataBusinessType,
                        'dataCategories' => $dataCategories,
                        'SupplierLocationModel' => $SupplierLocationModel,
//                        'dataSupplierLocation' => $dataSupplierLocation,
                        'dataSupplierLocation' => [new \app\models\SuppliersLocations],
                        'dataPayments' => $dataPayments,
                        'dataPartnerThru' => $dataPartnerThru,
                        'dataBank' => $dataBank,
                        'BankModel' => $BankModel,
                        'SupplierPaymentModel' => $SupplierPaymentModel,
            ]);
        }

        return $this->render('index');
    }

    protected function actionperformAjaxValidation($model) {
        Yii::error("testtttttttttttadasdsa honnnnnnnnn");
        if (\Yii::$app->request->isAjax && $model->load(\Yii::$app->request->post())) {
            Yii::error("WeddingAgendaTaskIDs[] : Fitnaaaaaaaaaaaaaaaaaaa");
            \Yii::$app->response->format = Response::FORMAT_JSON;
            echo json_encode(ActiveForm::validate($model));
            \Yii::$app->end();
        }
    }

    public function actionSavesuppliers() {


        $CouplePartnerModel = new CouplePartner();
        $CouplePartnerModell = new CouplePartner();
        $SupplierModel = new Suppliers();
        $actionperformAjaxValidation = $this->actionperformAjaxValidation($CouplePartnerModel);
        $this->actionperformAjaxValidation($SupplierModel);
        Yii::error("testtttttttttttadasdsa " . $actionperformAjaxValidation);
        $CouplePartnerID = 0;
        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }
        $SupplierID = 0;
        if (Yii::$app->user->identity != null) {
            $SupplierID = Yii::$app->user->identity->SUPPLIER_ID != NULL ? Yii::$app->user->identity->SUPPLIER_ID : 0;
        }
        $CouplePartnerModel = CouplePartner::findIdentity($CouplePartnerID);
        $SupplierModel = Suppliers::findOne($SupplierID);

//                SuppliersLocations;
//use app\models\SupplierBusinessType;
//use app\models\SupplierOfferedServices;
//        if($CouplePartnerModel===null)
//        {
//            $profile=new Profile;
//            $profile->user_id = Yii::app()->user->id;
//        }else{
//            
//        }
//        && $profile->load(Yii::$app->request->post())
        if ($CouplePartnerModel != null && $SupplierModel != null) {
            if ($CouplePartnerModell->load(Yii::$app->request->post()) && $SupplierModel->load(Yii::$app->request->post())) {
                $isValid = true;
//                $CouplePartnerModel->validate();
//                Valid = $SupplierModel->validate() && $isValid;
                if ($isValid) {
                    $SuppliersLocationsModel = new SuppliersLocations();

                    $SupplierOfferedServicesModel = new SupplierOfferedServices();
                    $SupplierBusinessTypeModel = new SupplierBusinessType();
                    $SupplierPartnerThruModel = new SupplierPartnerThru();
                    $SupplierPaymentModel = new SupplierPayment();

                    if ($SupplierID != 0) {
                        $SuppliersLocationsModel = SuppliersLocations::deleteAll('SUPPLIER_ID = ' . $SupplierID);
                        $SupplierBusinessTypeModel = SupplierBusinessType::deleteAll('SUPPLIER_ID = ' . $SupplierID);
                        $SupplierOfferedServicesModel = SupplierOfferedServices::deleteAll('SUPPLIER_ID = ' . $SupplierID);
                        $SupplierPartnerThruModel = SupplierPartnerThru::deleteAll('SUPPLIER_ID = ' . $SupplierID);
                        $SupplierPaymentModel = SupplierPayment::deleteAll('SUPPLIER_ID = ' . $SupplierID);
                    }
                    $TechEm = $CouplePartnerModell->TechEmail;
                    $TechPh = $CouplePartnerModell->TechPhone;
                    $TechPas = $CouplePartnerModell->TechPassword;
                    $SupplierModel->TECH_EMAIL = $CouplePartnerModell->TechEmail;
                    $SupplierModel->TECH_PHONE = $CouplePartnerModell->TechPhone;

                    $SupplierModel->save(false);
                    if ($SupplierID != 0) {
                        
                    } else {
                        $SupplierID = $SupplierModel->getPrimaryKey();
                       
                    }
                    
                     
                    $SuppliersLocationsModel = Model::createMultiple(SuppliersLocations::classname());
                    Model::loadMultiple($SuppliersLocationsModel, Yii::$app->request->post());

                    Yii::error("SuppliersLocationsModel  : " . sizeof($SuppliersLocationsModel));
                    foreach ($SuppliersLocationsModel as $Model) {
                        $Model->SUPPLIER_ID = $SupplierID;
                        Yii::error("Model->CITY_ID " . $Model->CITY_ID);
                        Yii::error("Model->COUNTRY_ID " . $Model->COUNTRY_ID);
                        $Model->save(false);
                    }
                    $CheckedOrNo = Yii::$app->request->post('CheckedOrNo');
                    $SupplierOfferedServicesModel = Model::createMultiple(SupplierOfferedServices::classname());
                    Model::loadMultiple($SupplierOfferedServicesModel, Yii::$app->request->post());
                    $p = 0;
                    foreach ($SupplierOfferedServicesModel as $Model) {
                        if ($CheckedOrNo[$p] == 'true') {
                            $Model->SUPPLIER_ID = $SupplierID;
                            $Model->save(false);
                        }
                        $p++;
                    }

                    $CheckedOrNoT = Yii::$app->request->post('CheckedOrNoT');
                    $SupplierBusinessTypeModel = Model::createMultiple(SupplierBusinessType::classname());
                    Model::loadMultiple($SupplierBusinessTypeModel, Yii::$app->request->post());
                    $p = 0;
                    foreach ($SupplierBusinessTypeModel as $Model) {
                        if ($CheckedOrNoT[$p] == 'true') {
                            $Model->SUPPLIER_ID = $SupplierID;
                            $Model->save(false);
                        }
                        $p++;
                    }


                    $CheckedOrNoP = Yii::$app->request->post('CheckedOrNoP');
                    $SupplierPartnerThruModel = Model::createMultiple(SupplierPartnerThru::classname());
                    Model::loadMultiple($SupplierPartnerThruModel, Yii::$app->request->post());
                    $p = 0;
                    foreach ($SupplierPartnerThruModel as $Model) {
                        if ($CheckedOrNoP[$p] == 'true') {
                            $Model->SUPPLIER_ID = $SupplierID;
                            $Model->save(false);
                        }
                        $p++;
                    }

                    $CheckedOrNoPa = Yii::$app->request->post('CheckedOrNoPa');
                    $SupplierPaymentModel = Model::createMultiple(SupplierPayment::classname());
                    Model::loadMultiple($SupplierPaymentModel, Yii::$app->request->post());
                    $p = 0;
                    foreach ($SupplierPaymentModel as $Model) {
                        if ($CheckedOrNoPa[$p] == 'true') {
                            $Model->SUPPLIER_ID = $SupplierID;
                            $Model->save(false);
                        }
                        $p++;
                    }
                    $hashedPassword = Yii::$app->getSecurity()->generatePasswordHash($CouplePartnerModell->COUPLE_PARTNER_PASSWORD);
//                    $SupplierOfferedServicesModel
                    $CouplePartnerModel->COUPLE_PARTNER_EMAIL = $CouplePartnerModell->COUPLE_PARTNER_EMAIL;
                    $CouplePartnerModel->COUPLE_PARTNER_PASSWORD=$hashedPassword;
                    $CouplePartnerModel->SUPPLIER_ID = $SupplierID;
                    $CouplePartnerModel->save(false);
                    $CouplePartnerModel->COUPLE_PARTNER_EMAIL = $TechEm;
                    $CouplePartnerModel->COUPLE_PARTNER_MOBILE_NUMBER = $TechPh;
                    $CouplePartnerModel->SUPPLIER_ID = $SupplierID;

                    $CouplePartnerModel->save(false);
                    $pgetPrimaryKey = $CouplePartnerModel->getPrimaryKey();
                    Yii::$app->mailer->compose()
                            ->setFrom('sabra331990@gmail.com')
                            ->setTo($TechEm)
                            ->setSubject('New Supplier')
//    ->setTextBody($SupplierModel->SIGN_UP_MESSAGE)
                            ->setHtmlBody('<p>Hello ' . $SupplierModel->TECH_NAME . ',</p><p>Please Activate Your Account,Click on this link :</p><br><p><a href="http://localhost/yiiApp/basic/web/index.php?r=couple-partner%2Fconfirm&id=' . $pgetPrimaryKey . '">http://localhost/yiiApp/basic/web/index.php?r=couple-partner%2Fconfirm&id=' . $pgetPrimaryKey . '</a></p>')
                            ->send();
                    Yii::$app->mailer->compose()
                            ->setFrom('sabra331990@gmail.com')
                            ->setTo('sabra331990@gmail.com')
                            ->setSubject('New Supplier')
//    ->setTextBody($SupplierModel->SIGN_UP_MESSAGE)
                            ->setHtmlBody('<p>Hello Admin,</p><p>I\'m ' . $SupplierModel->SUPPLIER_NAME . '</p><p>' . $SupplierModel->SIGN_UP_MESSAGE . '</p><br>')
                            ->send();
//                $profile->save(false);
//                return $this->redirect(['user/view', 'id' => $id]);
                } else {
                    // validation failed: $errors is an array containing error messages
                    $errors = $SupplierModel->errors;
                }
            }
            return $this->redirect(['supplier/index']);
//          return  $this->actionIndex();
        } else {
            $SuppliersLocationsModel = new SuppliersLocations();
            $CouplePartnerModel = new CouplePartner();
            $SupplierModel = new Suppliers();
            if ($CouplePartnerModel->load(Yii::$app->request->post()) && $SupplierModel->load(Yii::$app->request->post())) {
                $isValid = true;
//                $CouplePartnerModel->validate();
//            $isValid = $SupplierModel->validate() && $isValid;
                if ($isValid) {
                    $TechEm = $CouplePartnerModel->TechEmail;
                    $TechPh = $CouplePartnerModel->TechPhone;
                    $TechPas = $CouplePartnerModel->TechPassword;
                    $SupplierModel->TECH_EMAIL = $CouplePartnerModel->TechEmail;
                    $SupplierModel->TECH_PHONE = $CouplePartnerModel->TechPhone;
                    $SupplierModel->save(false);
                    $primaryKey = $SupplierModel->getPrimaryKey();
                    if ($primaryKey != null) {
                        
//                        $SupplierModel->imageFile = $_FILES['Suppliers']['name']['SUPPLIER_LOGO'];
        $file = \yii\web\UploadedFile::getInstance($SupplierModel, 'imageFile');
        if($file->name!=null){
        var_dump($file);
      if (!is_dir('SupplierLogos/SupLo'.$primaryKey)) {
    mkdir('SupplierLogos/SupLo'.$primaryKey, 0777, true);
    
                        }
        $file->saveAs('SupplierLogos/SupLo'.$primaryKey.'/'.$file->name);
        }
         Yii::error("image Saved : " );
        
                        $SupplierID = $primaryKey;
                        if($file->name!=null){
                         $SupplierModel = Suppliers::findOne($SupplierID);
                         $SupplierModel->SUPPLIER_LOGO='/SupplierLogos/SupLo'.$primaryKey.'/'.$file->name;
                         $SupplierModel->save();
                        }
                         $SuppliersLocationsModel = Model::createMultiple(SuppliersLocations::classname());
                        Model::loadMultiple($SuppliersLocationsModel, Yii::$app->request->post());

                        Yii::error("SuppliersLocationsModel  : " . sizeof($SuppliersLocationsModel));
                        foreach ($SuppliersLocationsModel as $Model) {
                            $Model->SUPPLIER_ID = $SupplierID;
                            Yii::error("Model->CITY_ID " . $Model->CITY_ID);
                            Yii::error("Model->COUNTRY_ID " . $Model->COUNTRY_ID);
                            $Model->save(false);
                        }
                        $CheckedOrNo = Yii::$app->request->post('CheckedOrNo');
                        $SupplierOfferedServicesModel = Model::createMultiple(SupplierOfferedServices::classname());
                        Model::loadMultiple($SupplierOfferedServicesModel, Yii::$app->request->post());
                        $p = 0;
                        foreach ($SupplierOfferedServicesModel as $Model) {
                            if ($CheckedOrNo[$p] == 'true') {
                                $Model->SUPPLIER_ID = $SupplierID;
                                $Model->save(false);
                            }
                            $p++;
                        }

                        $CheckedOrNoT = Yii::$app->request->post('CheckedOrNoT');
                        $SupplierBusinessTypeModel = Model::createMultiple(SupplierBusinessType::classname());
                        Model::loadMultiple($SupplierBusinessTypeModel, Yii::$app->request->post());
                        $p = 0;
                        foreach ($SupplierBusinessTypeModel as $Model) {
                            if ($CheckedOrNoT[$p] == 'true') {
                                $Model->SUPPLIER_ID = $SupplierID;
                                $Model->save(false);
                            }
                            $p++;
                        }
                        $hashedPassword = Yii::$app->getSecurity()->generatePasswordHash($CouplePartnerModel->COUPLE_PARTNER_PASSWORD);
//                    $SupplierOfferedServicesModel
                        $CouplePartnerModel->COUPLE_PARTNER_PASSWORD=$hashedPassword;
                        $CouplePartnerModel->SUPPLIER_ID = $primaryKey;
                        $CouplePartnerModel->save(false);
                        $CouplePartnerModel->COUPLE_PARTNER_EMAIL = $TechEm;
                        $CouplePartnerModel->COUPLE_PARTNER_MOBILE_NUMBER = $TechPh;
                        $CouplePartnerModel->SUPPLIER_ID = $primaryKey;
                        $CouplePartnerModel->save(false);
//                       $CouplePartnerModel->SUPPLIER_ID = $primaryKey;
//                        $CouplePartnerModel->save(false);

                        Yii::$app->mailer->compose()
                                ->setFrom('sabra331990@gmail.com')
                                ->setTo($TechEm)
                                ->setSubject('New Supplier')
//    ->setTextBody($SupplierModel->SIGN_UP_MESSAGE)
                                ->setHtmlBody('<p>Hello Admin,</p><br><p>I\'m ' . $SupplierModel->SUPPLIER_NAME . '</p><br><p>' . $SupplierModel->SIGN_UP_MESSAGE . '</p><br>')
                                ->send();
                    }
//                $profile->save(false);
//                return $this->redirect(['user/view', 'id' => $id]);
                } else {
                    // validation failed: $errors is an array containing error messages
                    $errors = $SupplierModel->errors;
                }
            }

            return Yii::$app->runAction('site/login');
        }
//   $this->re
//
    }

    public function actionSaveSuppliersItems() {




        Yii::error("testtttttttttttadasdsa ");
        $ItemsSupplieirsModel = new ItemsSupplieirs();
        $ItemsSupplieirsImgsModel = new \app\models\ItemsImgs();
        $ItemsSupplieirsModel1 = new ItemsSupplieirs();
        $ItemSupplierTranslationModel = new ItemSupplierTranslation();
        $ItemOptionTransModel = new ItemOptionTrans();
        $ItemOptionsModel = new ItemOptions();
        $actionperformAjaxValidation = $this->actionperformAjaxValidation($ItemsSupplieirsModel);
        $CouplePartnerID = 0;
        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }
        $SupplierID = 0;
        if (Yii::$app->user->identity != null) {
            $SupplierID = Yii::$app->user->identity->SUPPLIER_ID != NULL ? Yii::$app->user->identity->SUPPLIER_ID : 0;
        }





//echo "<pre>";
//print_r($models1);
//foreach
//        
//        $ItemsImgsMod = new \app\models\ItemsImgs();
//        $ItemsImgsMod = Model::createMultiple(\app\models\ItemsImgs::classname());
//            Model::loadMultiple($ItemsImgsMod, Yii::$app->request->post('ItemsImgs'));
//            foreach ($ItemsImgsMod as $indexr => $ItemsImgsMo) {
//        
//            $ItemsImgsMod->file = UploadedFile::getInstances($ItemsImgsMo, "[{$indexr}]file");
////            foreach ($ItemsImgsMod->file as $key => $file) {
////
////                $file->saveAs('/testingImg/'. $file->baseName . '.' . $file->extension);//Upload files to server
//////                $model->urls .= 'uploads/' . $file->baseName . '.' . $file->extension.'**';//Save file names in database- '**' is for separating images
////            }
//            $ItemsImgsMod->save(false);
//        
//        
//    }


        $ItemSupplierTranslationModel = Model::createMultiple(ItemSupplierTranslation::classname());
        Model::loadMultiple($ItemSupplierTranslationModel, Yii::$app->request->post());
        $ItemsSupplieirsModel = Model::createMultiple(ItemsSupplieirs::classname());
        Model::loadMultiple($ItemsSupplieirsModel, Yii::$app->request->post());
        $modelsOptions = [[new ItemOptions]];
        $modelsTransOption = [[new ItemOptionTrans]];
        $modelsOptionCriteria= [[new \app\models\OptionCriteria ]];
        $i = 0;
        
        foreach ($_POST['ItemOptions'] as $ItemOps) {
            $j = 0;
            $ItemOps=array_values($ItemOps);
//            Yii::error("var_dump(ItemOps): " .print_r($ItemOps,true));
            foreach ($ItemOps as $ItemOp) {
                $data['ItemOptions'] = $ItemOp;
                $modelOption = new ItemOptions;
                $modelOption->load($data);
                $modelsOptions[0][$j] = $modelOption;
                $j++;
            }
            $i++;
        }

        $i = 0;
        foreach ($_POST['ItemOptionTrans'] as $ItemOpsTrans) {
            $j = 0;
             $ItemOpsTrans=array_values($ItemOpsTrans);
            foreach ($ItemOpsTrans as $ItemOpTrans) {
                $data['ItemOptionTrans'] = $ItemOpTrans;
                $modelTransOption = new ItemOptionTrans;
                $modelTransOption->load($data);
                $modelsTransOption[0][$j] = $modelTransOption;
                $j++;
            }
            $i++;
        }
        
        
       $OptionCriterias= isset($_POST['OptionCriteria'])?$_POST['OptionCriteria']:null;
        $ItemOptionsModel->load(Yii::$app->request->post('ItemOptions'));
        $p = 0;
        $ItemSupplierID = 0;
        foreach ($ItemsSupplieirsModel as $Model) {
            Yii::error("asdaasdc  asdasdas Model->ITEM_SUPPLIER_ID! : " . $Model['ITEM_SUPPLIER_ID']);
            $ItemsSupplieirsModel1 = ItemsSupplieirs::findOne(['ITEM_SUPPLIER_ID' => $Model->ITEM_SUPPLIER_ID, 'SUPPLIER_ID' => $SupplierID]);
            Yii::error("asdaasdc  asdasdas ItemsSupplieirsModel1: " . print_r($ItemsSupplieirsModel1));

//            if($ItemsSupplieirsModel1!=null){
//              if ($ItemsSupplieirsModel1->load(Yii::$app->request->post())  ) {
//                 $Model->SUPPLIER_ID = $SupplierID;
//              $ItemSupplierID = $Model->ITEM_SUPPLIER_ID;  
//              $Model->upsave(false); 
//              }  
//            }else{
//                
//            }
            if ($ItemsSupplieirsModel1 != null && sizeof($ItemsSupplieirsModel1) > 0) {
                $ItemSupplierID = $Model->ITEM_SUPPLIER_ID;
                $data = $Model->attributes;
                $ItemsSupplieirsModel1->setAttributes($data);
                Yii::error("fetit 3al update : " . print_r($ItemsSupplieirsModel1->getAttributes()));
                $ItemsSupplieirsModel1->SUPPLIER_ID = $SupplierID;
                $ItemsSupplieirsModel1->update();
            } else {
                $Model->SUPPLIER_ID = $SupplierID;
                $Model->save(false);
                $ItemSupplierID = $Model->getPrimaryKey();
            }

            if ($ItemSupplierID != 0) {
//                \app\models\ItemsImgs::deleteAll('ITEM_SUPPLIER_ID = '.$ItemSupplierID);
                $array_values = array_values($_FILES['ItemsImgs']['name']);
                $stepImg = $array_values[0]['file'];
                $ArrayTemp = array_values($_FILES['ItemsImgs']['tmp_name']);

                $sizeof = sizeof($stepImg);
                Yii::error(" sizeof : " .$sizeof);
                for ($cnt = 0; $cnt < $sizeof; $cnt++) {
                    /*                     * ** Save step recipe image **** */
                    $SelectedstepImg = $stepImg[$cnt];
                    $tmpImg = $ArrayTemp[0]['file'][$cnt];
                    if (!is_dir('testingImg/SupplierImg' . $SupplierID)) {
                        mkdir('testingImg/SupplierImg' . $SupplierID, 0777, true);
                        if (!is_dir('testingImg/SupplierImg' . $SupplierID . '/SupplierItem' . $ItemSupplierID)) {
                            mkdir('testingImg/SupplierImg' . $SupplierID . '/SupplierItem' . $ItemSupplierID, 0777, true);
                        }
                    } else {
                        if (!is_dir('testingImg/SupplierImg' . $SupplierID . '/SupplierItem' . $ItemSupplierID)) {
                            mkdir('testingImg/SupplierImg' . $SupplierID . '/SupplierItem' . $ItemSupplierID, 0777, true);
                        }
                    }
                    $ItemsSupplieirsImgsModel = new \app\models\ItemsImgs();
                    if ($SelectedstepImg != '') {

                        if (move_uploaded_file($tmpImg, 'testingImg/SupplierImg' . $SupplierID . '/SupplierItem' . $ItemSupplierID . '/' . $SelectedstepImg)) {
                            $ItemsSupplieirsImgsModel->ITEM_SUPPLIER_ID = $ItemSupplierID;
                            $ItemsSupplieirsImgsModel->IMG_PATH = 'testingImg/SupplierImg' . $SupplierID . '/SupplierItem' . $ItemSupplierID . '/' . $SelectedstepImg;
                            Yii::error("testingImg/SupplierImg : " . 'testingImg/SupplierImg' . $SupplierID . '/SupplierItem' . $ItemSupplierID . '/' . $SelectedstepImg);
                            $ItemsSupplieirsImgsModel->save(false);
                        } else {
                            Yii::$app->getSession()->setFlash('error', 'Error saving recipe images, Please enter valid images');
                        }
                    }  //if img        
                }

               
            }
            $ItemSupplierTranslationModel[$p]->ITEM_SUPPLIER_ID = $ItemSupplierID;
            $ItemSupplierTranslationModel[$p]->save(false);
            $i = 0;
            Yii::error("modelsOptionCriteria " .print_r($modelsOptionCriteria,true));
            foreach ($modelsOptions[$p] as $OptionModel) {
                $OptionID = 0;
                Yii::error("asdaasdc  asdasdas OptionModel->OPTION_ID : " . $OptionModel->OPTION_ID);
                $ItemsOptionssModel1 = ItemOptions::findOne($OptionModel->OPTION_ID);
                if ($ItemsOptionssModel1 != null && sizeof($ItemsOptionssModel1) > 0) {
                    $OptionID = $OptionModel->OPTION_ID;
                    $data = $OptionModel->attributes;
                    $ItemsOptionssModel1->setAttributes($data);
                    $ItemsOptionssModel1->ITEM_SUPPLIER_ID = $ItemSupplierID;

                    $ItemsOptionssModel1->update(true);
                } else {
                    $OptionModel->ITEM_SUPPLIER_ID = $ItemSupplierID;
                    $OptionModel->save(false);
                    $OptionID = $OptionModel->getPrimaryKey();
                }
                \app\models\OptionCriteria::deleteAll(['OPTION_ID' => $OptionID]);
                 Yii::error("asdaasdc  p : " . $p);
                if($OptionCriterias!=null && $OptionCriterias[$p]!=null && sizeof($OptionCriterias[$p])>0){
                    for($r=0;$r<sizeof($OptionCriterias[$p][$i]['hidden']);$r++){
                        $OptionCrt = new  \app\models\OptionCriteria();
                        if($OptionCriterias[$p][$i]['hidden'][$r]==='true'){
                         $OptionCrt->OPTION_ID=$OptionCriterias[$p][$i]['OPTION_ID'][$r];
                         $OptionCrt->CRITERIA_ID=$OptionCriterias[$p][$i]['CRITERIA_ID'][$r];
                         $OptionCrt->CRITERIA_VALUE_ID=$OptionCriterias[$p][$i]['CRITERIA_VALUE_ID'][$r];
                         $OptionCrt->save(false);
                        }
                    }
                }

                $modelsTransOption[$p][$i]->OPTION_ID = $OptionID;
                $modelsTransOption[$p][$i]->save(false);
                $i++;
            }


            $p++;
        }

        return $this->redirect(['supplier/listitems']);
    }

    public function actionSupitems() {

        $SearchTrasaction = new \app\models\Transactions;
        $dataProvider = $SearchTrasaction->search(Yii::$app->request->getQueryParams());
        $SupplierID = 0;
        if (Yii::$app->user->identity != null) {
            $SupplierID = Yii::$app->user->identity->SUPPLIER_ID != NULL ? Yii::$app->user->identity->SUPPLIER_ID : 0;
        }

        if ($SupplierID != 0) {
            Yii::error(" SupplierID :  " . $SupplierID);
            $dataSupplierInfo = new ActiveDataProvider([
                'query' => Suppliers::find()->where(['SUPPLIER_ID' => $SupplierID]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            if (isset($dataSupplierInfo) && $dataSupplierInfo != null) {
                $dataSupplierInfo = $dataSupplierInfo->getModels();
            }
            $dataSupplierServicess = new ActiveDataProvider([
                'query' => \app\models\CategoryOfItemsTrans::findBySql('select category_of_items_trans.CATEGORY_OF_ITEM_ID, category_of_items_trans.CATEGORY_OF_ITEM_TRANS from supplier_offered_services inner join category_of_items t on supplier_offered_services.CATEGORY_ID=t.CATEGORY_OF_ITEM_ID inner join category_of_items_trans on category_of_items_trans.CATEGORY_OF_ITEM_ID=t.CATEGORY_OF_ITEM_ID where supplier_offered_services.SUPPLIER_ID = ' . $SupplierID . ' AND  category_of_items_trans.LANGUAGE_ID =  ' . $dataSupplierInfo[0]->SUPPLIER_DEFAULT_LANG),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $dataProducts = new ActiveDataProvider([
                'query' => \app\models\ProductsTrans::findBySql('select t.PRODUCT_ID, t.PRODUCT_NAME from products inner join products_trans t on products.PRODUCT_ID=t.PRODUCT_ID where t.LANGUAGE_ID=1 '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);

            $ItemOpMod = new \app\models\ItemOptions();
            $ItemSupMod = new \app\models\ItemsSupplieirs();
            $ItemImgsMod = new \app\models\ItemsImgs();
            $ItemOptionTransMod = new \app\models\ItemOptionTrans();
            $ItemSupplierTrans = new \app\models\ItemSupplierTranslation();
            $dataLanguages = new ActiveDataProvider([
                'query' => \app\models\Languages::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $dataCurrencies = new ActiveDataProvider([
                'query' => \app\models\Currencies::find(['CURRENCY_ID', 'CURRENCY_CODE']),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $dataItemSupplier = new ActiveDataProvider([
                'query' => \app\models\ItemsSupplieirs::find()->where('SUPPLIER_ID = ' . $SupplierID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);

            return $this->render('supitems', [
                        'dataItemSupplier' => $dataItemSupplier,
                        'ItemOpMod' => $ItemOpMod,
                        'ItemSupMod' => $ItemSupMod,
                        'ItemOptionModel' => [new \app\models\ItemOptions],
                        'ItemSupplierMModel' => [new \app\models\ItemsSupplieirs],
                        'dataProducts' => $dataProducts->getModels(),
                        'dataCurrencies' => $dataCurrencies->getModels(),
                        'ItemSupplierTrans' => $ItemSupplierTrans,
                        'dataLanguages' => $dataLanguages->getModels(),
                        'dataSupplierServicess' => $dataSupplierServicess->getModels(),
                        'dataSupplierInfo' => $dataSupplierInfo,
                        'ItemOptionTransMod' => $ItemOptionTransMod,
                        'ItemImgsMod' => $ItemImgsMod,
                        'dataProvider' => $dataProvider,
                        'searchModel' => $SearchTrasaction,
            ]);
        }
    }

    public function actionModalac() {

        $SearchTrasaction = new \app\models\Transactions;
        $dataProvider = $SearchTrasaction->search(Yii::$app->request->getQueryParams());
        $SupplierID = 0;
        if (Yii::$app->user->identity != null) {
            $SupplierID = Yii::$app->user->identity->SUPPLIER_ID != NULL ? Yii::$app->user->identity->SUPPLIER_ID : 0;
        }

        if ($SupplierID != 0) {
            $CriteriaValueMod = new \app\models\CriteriaValues();
            Yii::error(" SupplierID :  " . $SupplierID);
            $dataSupplierInfo = new ActiveDataProvider([
                'query' => Suppliers::find()->where(['SUPPLIER_ID' => $SupplierID]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            if (isset($dataSupplierInfo) && $dataSupplierInfo != null) {
                $dataSupplierInfo = $dataSupplierInfo->getModels();
            }
            $dataSupplierServicess = new ActiveDataProvider([
                'query' => \app\models\CategoryOfItemsTrans::findBySql('select category_of_items_trans.CATEGORY_OF_ITEM_ID, category_of_items_trans.CATEGORY_OF_ITEM_TRANS from supplier_offered_services inner join category_of_items t on supplier_offered_services.CATEGORY_ID=t.CATEGORY_OF_ITEM_ID inner join category_of_items_trans on category_of_items_trans.CATEGORY_OF_ITEM_ID=t.CATEGORY_OF_ITEM_ID where supplier_offered_services.SUPPLIER_ID = ' . $SupplierID . ' AND  category_of_items_trans.LANGUAGE_ID =  ' . $dataSupplierInfo[0]->SUPPLIER_DEFAULT_LANG),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $dataProducts = new ActiveDataProvider([
                'query' => \app\models\ProductsTrans::findBySql('select t.PRODUCT_ID, t.PRODUCT_NAME from products inner join products_trans t on products.PRODUCT_ID=t.PRODUCT_ID where t.LANGUAGE_ID=1 '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);

            $ItemOpMod = new \app\models\ItemOptions();
            $ItemSupMod = new \app\models\ItemsSupplieirs();
            $ItemImgsMod = new \app\models\ItemsImgs();
            $ItemOptionTransMod = new \app\models\ItemOptionTrans();
            $ItemSupplierTrans = new \app\models\ItemSupplierTranslation();
            $dataLanguages = new ActiveDataProvider([
                'query' => \app\models\Languages::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $dataCurrencies = new ActiveDataProvider([
                'query' => \app\models\Currencies::find(['CURRENCY_ID', 'CURRENCY_CODE']),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $dataCriteras = new ActiveDataProvider([
                'query' => \app\models\Criterias::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $OptionCriteriaMod=new \app\models\OptionCriteria();
            $OptionCreteriaEmptyArr=[new \app\models\OptionCriteria];
            
            $HidNewButton = "true";
            return $this->renderAjax('newitem', [
//                        'dataItemSupplier' => [new \app\models\ItemsSupplieirs],
                        'ItemOpMod' => $ItemOpMod,
                        'ItemSupMod' => $ItemSupMod,
                        'ItemOptionModel' => [new \app\models\ItemOptions],
                        'ItemSupplierMModel' => [new \app\models\ItemsSupplieirs],
                        'dataProducts' => $dataProducts->getModels(),
                        'dataCurrencies' => $dataCurrencies->getModels(),
                        'ItemSupplierTrans' => $ItemSupplierTrans,
                        'dataLanguages' => $dataLanguages->getModels(),
                        'dataSupplierServicess' => $dataSupplierServicess->getModels(),
                        'dataSupplierInfo' => $dataSupplierInfo,
                        'ItemOptionTransMod' => $ItemOptionTransMod,
                        'ItemImgsMod' => $ItemImgsMod,
                        'dataProvider' => $dataProvider,
                        'searchModel' => $SearchTrasaction,
                        'HidNewButton' => $HidNewButton,
                        'index' => 0,
                        'dataCriteras' => $dataCriteras,
                        'CriteriaValueMod'=>$CriteriaValueMod,
                        'OptionCriteriaMod'=>$OptionCriteriaMod,
                        'OptionCreteriaEmptyArr'=>$OptionCreteriaEmptyArr,
                
            ]);
        }
    }
    public function actionListitems() {

        $SearchItemsSupplieirs = new \app\models\ItemsSupplieirs;
        $SearchItemsSupplieirs->load(Yii::$app->request->get('ItemsSupplieirs'));
        $dataProvider = $SearchItemsSupplieirs->search(Yii::$app->request->getQueryParams('ItemsSupplieirs'));
        $SupplierID = 0;
        if (Yii::$app->user->identity != null) {
            $SupplierID = Yii::$app->user->identity->SUPPLIER_ID != NULL ? Yii::$app->user->identity->SUPPLIER_ID : 0;
        }

        if ($SupplierID != 0) {
            $CriteriaValueMod = new \app\models\CriteriaValues();
            Yii::error(" SupplierID :  " . $SupplierID);
            $dataSupplierInfo = new ActiveDataProvider([
                'query' => Suppliers::find()->where(['SUPPLIER_ID' => $SupplierID]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            if (isset($dataSupplierInfo) && $dataSupplierInfo != null) {
                $dataSupplierInfo = $dataSupplierInfo->getModels();
            }
            $dataSupplierServicess = new ActiveDataProvider([
                'query' => \app\models\CategoryOfItemsTrans::findBySql('select category_of_items_trans.CATEGORY_OF_ITEM_ID, category_of_items_trans.CATEGORY_OF_ITEM_TRANS from supplier_offered_services inner join category_of_items t on supplier_offered_services.CATEGORY_ID=t.CATEGORY_OF_ITEM_ID inner join category_of_items_trans on category_of_items_trans.CATEGORY_OF_ITEM_ID=t.CATEGORY_OF_ITEM_ID where supplier_offered_services.SUPPLIER_ID = ' . $SupplierID . ' AND  category_of_items_trans.LANGUAGE_ID =  ' . $dataSupplierInfo[0]->SUPPLIER_DEFAULT_LANG),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $dataCriteras = new ActiveDataProvider([
                'query' => \app\models\Criterias::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $dataProducts = new ActiveDataProvider([
                'query' => \app\models\ProductsTrans::findBySql('select t.PRODUCT_ID, t.PRODUCT_NAME from products inner join products_trans t on products.PRODUCT_ID=t.PRODUCT_ID where t.LANGUAGE_ID=1 '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);

            $ItemOpMod = new \app\models\ItemOptions();
            $ItemSupMod = new \app\models\ItemsSupplieirs();
            $ItemImgsMod = new \app\models\ItemsImgs();
            $ItemOptionTransMod = new \app\models\ItemOptionTrans();
            $ItemSupplierTrans = new \app\models\ItemSupplierTranslation();
            $dataLanguages = new ActiveDataProvider([
                'query' => \app\models\Languages::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $dataCurrencies = new ActiveDataProvider([
                'query' => \app\models\Currencies::find(['CURRENCY_ID', 'CURRENCY_CODE']),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $dataItemSupplier = new ActiveDataProvider([
                'query' => \app\models\ItemsSupplieirs::find()->where('SUPPLIER_ID = ' . $SupplierID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
$OptionCriteriaMod=new \app\models\OptionCriteria();
            $OptionCreteriaEmptyArr=[new \app\models\OptionCriteria];
            return $this->render('listitems', [
                        'dataItemSupplier' => $dataItemSupplier,
                        'ItemOpMod' => $ItemOpMod,
                        'ItemSupMod' => $ItemSupMod,
                        'ItemOptionModel' => [new \app\models\ItemOptions],
                        'ItemSupplierMModel' => [new \app\models\ItemsSupplieirs],
                        'dataProducts' => $dataProducts->getModels(),
                        'dataCurrencies' => $dataCurrencies->getModels(),
                        'ItemSupplierTrans' => $ItemSupplierTrans,
                        'dataLanguages' => $dataLanguages->getModels(),
                        'dataSupplierServicess' => $dataSupplierServicess->getModels(),
                        'dataSupplierInfo' => $dataSupplierInfo,
                        'ItemOptionTransMod' => $ItemOptionTransMod,
                        'ItemImgsMod' => $ItemImgsMod,
                        'dataProvider' => $dataProvider,
                        'searchModel' => $SearchItemsSupplieirs,
                        'dataCriteras' => $dataCriteras,
                        'CriteriaValueMod' =>$CriteriaValueMod,
                        'OptionCriteriaMod'=>$OptionCriteriaMod,
                        'OptionCreteriaEmptyArr'=>$OptionCreteriaEmptyArr,
            ]);
        }
    }
    public function actionDashboard() {

        $SearchItemViewNumber = new \app\models\ItemViewNumber();
        $SearchItemViewNumber->load(Yii::$app->request->get('ItemsSupplieirs'));
        $dataProvider = $SearchItemViewNumber->search(Yii::$app->request->getQueryParams('ItemsSupplieirs'));
        $SupplierID = 0;
        if (Yii::$app->user->identity != null) {
            $SupplierID = Yii::$app->user->identity->SUPPLIER_ID != NULL ? Yii::$app->user->identity->SUPPLIER_ID : 0;
        }
        $SupplierID=44;
        if ($SupplierID != 0) {
            $CriteriaValueMod = new \app\models\CriteriaValues();
            Yii::error(" SupplierID :  " . $SupplierID);
            $dataSupplierInfo = new ActiveDataProvider([
                'query' => Suppliers::find()->where(['SUPPLIER_ID' => $SupplierID]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            if (isset($dataSupplierInfo) && $dataSupplierInfo != null) {
                $dataSupplierInfo = $dataSupplierInfo->getModels();
            }
            $dataSupplierServicess = new ActiveDataProvider([
                'query' => \app\models\CategoryOfItemsTrans::findBySql('select category_of_items_trans.CATEGORY_OF_ITEM_ID, category_of_items_trans.CATEGORY_OF_ITEM_TRANS from supplier_offered_services inner join category_of_items t on supplier_offered_services.CATEGORY_ID=t.CATEGORY_OF_ITEM_ID inner join category_of_items_trans on category_of_items_trans.CATEGORY_OF_ITEM_ID=t.CATEGORY_OF_ITEM_ID where supplier_offered_services.SUPPLIER_ID = ' . $SupplierID . ' AND  category_of_items_trans.LANGUAGE_ID =  ' . $dataSupplierInfo[0]->SUPPLIER_DEFAULT_LANG),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $dataCriteras = new ActiveDataProvider([
                'query' => \app\models\Criterias::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $dataProducts = new ActiveDataProvider([
                'query' => \app\models\ProductsTrans::findBySql('select t.PRODUCT_ID, t.PRODUCT_NAME from products inner join products_trans t on products.PRODUCT_ID=t.PRODUCT_ID where t.LANGUAGE_ID=1 '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);

            $ItemOpMod = new \app\models\ItemOptions();
            $ItemSupMod = new \app\models\ItemsSupplieirs();
            $ItemImgsMod = new \app\models\ItemsImgs();
            $ItemOptionTransMod = new \app\models\ItemOptionTrans();
            $ItemSupplierTrans = new \app\models\ItemSupplierTranslation();
            $dataLanguages = new ActiveDataProvider([
                'query' => \app\models\Languages::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $dataCurrencies = new ActiveDataProvider([
                'query' => \app\models\Currencies::find(['CURRENCY_ID', 'CURRENCY_CODE']),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $dataItemSupplier = new ActiveDataProvider([
                'query' => \app\models\ItemsSupplieirs::find()->where('SUPPLIER_ID = ' . $SupplierID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
$OptionCriteriaMod=new \app\models\OptionCriteria();
            $OptionCreteriaEmptyArr=[new \app\models\OptionCriteria];
            return $this->render('_dashboard', [
                        'dataItemSupplier' => $dataItemSupplier,
                        'ItemOpMod' => $ItemOpMod,
                        'ItemSupMod' => $ItemSupMod,
                        'ItemOptionModel' => [new \app\models\ItemOptions],
                        'ItemSupplierMModel' => [new \app\models\ItemsSupplieirs],
                        'dataProducts' => $dataProducts->getModels(),
                        'dataCurrencies' => $dataCurrencies->getModels(),
                        'ItemSupplierTrans' => $ItemSupplierTrans,
                        'dataLanguages' => $dataLanguages->getModels(),
                        'dataSupplierServicess' => $dataSupplierServicess->getModels(),
//                        'dataSupplierInfo' => $dataSupplierInfo,
                        'ItemOptionTransMod' => $ItemOptionTransMod,
                        'ItemImgsMod' => $ItemImgsMod,
                        'dataProvider' => $dataProvider,
                        'searchModel' => $SearchItemViewNumber,
                        'dataCriteras' => $dataCriteras,
                        'CriteriaValueMod' =>$CriteriaValueMod,
                        'OptionCriteriaMod'=>$OptionCriteriaMod,
                        'OptionCreteriaEmptyArr'=>$OptionCreteriaEmptyArr,
            ]);
        }
    }

    public function actionSub($ItemSupplierID, $index) {
        $SupplierID = 0;
        if (Yii::$app->user->identity != null) {
            $SupplierID = Yii::$app->user->identity->SUPPLIER_ID != NULL ? Yii::$app->user->identity->SUPPLIER_ID : 0;
        }

        if ($SupplierID != 0) {
            $CriteriaValueMod = new \app\models\CriteriaValues();
            Yii::error(" SupplierID :  " . $SupplierID);
            $dataSupplierInfo = new ActiveDataProvider([
                'query' => \app\models\Suppliers::find()->where(['SUPPLIER_ID' => $SupplierID]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            if (isset($dataSupplierInfo) && $dataSupplierInfo != null) {
                $dataSupplierInfo = $dataSupplierInfo->getModels();
            }
            $dataSupplierServicess = new ActiveDataProvider([
                'query' => \app\models\CategoryOfItemsTrans::findBySql('select category_of_items_trans.CATEGORY_OF_ITEM_ID, category_of_items_trans.CATEGORY_OF_ITEM_TRANS from supplier_offered_services inner join category_of_items t on supplier_offered_services.CATEGORY_ID=t.CATEGORY_OF_ITEM_ID inner join category_of_items_trans on category_of_items_trans.CATEGORY_OF_ITEM_ID=t.CATEGORY_OF_ITEM_ID where supplier_offered_services.SUPPLIER_ID = ' . $SupplierID . ' AND  category_of_items_trans.LANGUAGE_ID =  ' . $dataSupplierInfo[0]->SUPPLIER_DEFAULT_LANG),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $dataProducts = new ActiveDataProvider([
                'query' => \app\models\ProductsTrans::findBySql('select t.PRODUCT_ID, t.PRODUCT_NAME from products inner join products_trans t on products.PRODUCT_ID=t.PRODUCT_ID where t.LANGUAGE_ID=1 '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);

            $ItemOpMod = new \app\models\ItemOptions();
            $ItemSupMod = new \app\models\ItemsSupplieirs();
            $ItemImgsMod = new \app\models\ItemsImgs();
            $ItemOptionTransMod = new \app\models\ItemOptionTrans();
            $ItemSupplierTrans = new \app\models\ItemSupplierTranslation();
            
            $dataLanguages = new ActiveDataProvider([
                'query' => \app\models\Languages::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $dataCurrencies = new ActiveDataProvider([
                'query' => \app\models\Currencies::find(['CURRENCY_ID', 'CURRENCY_CODE']),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $dataItemSupplier = new ActiveDataProvider([
                'query' => \app\models\ItemsSupplieirs::find()->where('SUPPLIER_ID = ' . $SupplierID . ' AND ITEM_SUPPLIER_ID = ' . $ItemSupplierID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $CriteriaValues = [[[]]];

            $models1 = $dataItemSupplier->getModels();
            foreach ($models1 as $mm) {
                if ($mm != null && $mm->itemOptions != null && sizeof($mm->itemOptions) > 0) {
                    $op = 0;
                    foreach ($mm->itemOptions as $opti) {

                        if ($opti->CRITERIAS_VALUES != null) {
                            $explode = explode(",", $opti->CRITERIAS_VALUES);
                            if ($explode != null && sizeof($explode) > 0) {

                                for ($pp = 0; $pp < sizeof($explode); $pp++) {

                                    $CriteriaValues[$op][$pp]['CRITERIA_VALUE'] = $explode[$pp];
                                    $find = \app\models\CriteriaValues::findOne(['CRITERIA_VALUE_ID' => $explode[$pp]]);
                                    $CriteriaValues[$op][$pp]['CRITERIA'] = "";
                                    if ($find != null) {
                                        $CriteriaValues[$op][$pp]['CRITERIA'] = $find->CRITERIA_ID;
                                    }
                                }
                            }
                        }

                        $op++;
                    }
                }
            }

//        Array ( [0] => Array ( [0] => Array ( [CRITERIA_VALUE] => 1 ) [1] => Array ( [CRITERIA_VALUE] => 4 ) ) )
            Yii::error("  print_r(CriteriaValues); :  " . print_r($CriteriaValues));

            $dataCriteras = new ActiveDataProvider([
                'query' => \app\models\Criterias::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            
//            $dataOptionCriteras = new ActiveDataProvider([
//                'query' => \app\models\Criterias::find(),
////                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
//            ]);
            $OptionCriteriaMod=new \app\models\OptionCriteria();
            $OptionCreteriaEmptyArr=[new \app\models\OptionCriteria];
            
            return [
                'dataItemSupplier' => $dataItemSupplier,
                'ItemOpMod' => $ItemOpMod,
                'ItemSupMod' => $ItemSupMod,
                'ItemOptionModel' => [new \app\models\ItemOptions],
                'ItemSupplierMModel' => [new \app\models\ItemsSupplieirs],
                'dataProducts' => $dataProducts->getModels(),
                'dataCurrencies' => $dataCurrencies->getModels(),
                'ItemSupplierTrans' => $ItemSupplierTrans,
                'dataLanguages' => $dataLanguages->getModels(),
                'dataSupplierServicess' => $dataSupplierServicess->getModels(),
                'dataSupplierInfo' => $dataSupplierInfo,
                'ItemOptionTransMod' => $ItemOptionTransMod,
                'ItemImgsMod' => $ItemImgsMod,
                'index' => $index,
                'dataCriteras' => $dataCriteras,
                'CriteriaValues' => $CriteriaValues,
                'CriteriaValueMod' => $CriteriaValueMod,
                'ItemSupplierID' => $ItemSupplierID,
                'OptionCriteriaMod' => $OptionCriteriaMod,
               
                'OptionCreteriaEmptyArr' => $OptionCreteriaEmptyArr,    
            ];
        }
    }
    public function actionOptionCriteria($OptionID){
        $OptionCriteriaMod=new \app\models\OptionCriteria();
        $dataOptionCriteria = new ActiveDataProvider([
                'query' => \app\models\OptionCriteria::find()->where('OPTION_ID = '.$OptionID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
        return [
                'OptionCriteriaMod' => $OptionCriteriaMod,
                'dataOptionCriteria' => $dataOptionCriteria,
            ];
    }
    public function actionImgDelete() {
        $model = new \app\models\ItemsImgs();

        $file_key = (int) \Yii::$app->request->post('key');
        Yii::error(" file_key :  " . $file_key);
        // your method del
        $delete = $model->deleteAll('ITEM_SUPPLIER_IMAGE_ID = ' . $file_key);
        return '{}';
    }

    public function actionSavelogoimg() {
        
        Yii::error('Upload ');
        $model = new Suppliers();
        $SupplierID = 0;
        if (Yii::$app->user->identity != null && Yii::$app->user->identity->SUPPLIER_ID!=null) {
           $SupplierID = Yii::$app->user->identity->SUPPLIER_ID;
        } 
        if ($SupplierID != 0) {
            $imagetypes = array(
                'image/png' => '.png',
                'image/gif' => '.gif',
                'image/jpeg' => '.jpg',
                'image/bmp' => '.bmp');
            $ext = $imagetypes[$_FILES['image']['type']];
            $findOne = Suppliers::findOne(['SUPPLIER_ID' => $SupplierID]);
            $tmpImg = $_FILES['image']['tmp_name'];
            $SizeofImg = $_FILES['image']['size'];
            if (!is_dir('uploads/supplierLogo' . $SupplierID)) {
                mkdir('uploads/supplierLogo' . $SupplierID, 0777, true);
            }
            $RandN=rand();
//        /PartnerImg'.$SizeofImg.rand()
            if (move_uploaded_file($tmpImg, 'uploads/supplierLogo' . $SupplierID . '/SupplierLogo' . $SizeofImg .$RandN . $ext)) {

                if ($findOne != null) {
                    $findOne->SUPPLIER_LOGO = 'uploads/supplierLogo' . $SupplierID . '/SupplierLogo' . $SizeofImg .$RandN . $ext;
                    $findOne->save(false);
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ['response' => 'uploads/supplierLogo' . $SupplierID . '/SupplierLogo' . $SizeofImg . $RandN . $ext];
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

//   public function actionGs($supplierid) {
//    
//       $Supplier = new Suppliers();
//        
//        
//        $SupplierLocationModel = new \app\models\SuppliersLocations();
//        $dataSupplierLocationModels=[new \app\models\SuppliersLocations]; 
////        $dataSupplierLocation = new ActiveDataProvider([
////            'query' => \app\models\SuppliersLocations::find(),
//////                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
////        ]);
//        $dataSupplierType = new ActiveDataProvider([
//            'query' => \app\models\SuplierTypeTrans::find()->select(['suplier_type_trans.SUPLIER_TYPE_ID', 'suplier_type_trans.SUPLIER_TYPE_NAME'])->where(' LANGUAGE_ID = 1'),
////                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
//        ]);
//        $dataCountry = new ActiveDataProvider([
//            'query' => \app\models\CountriesTrans::find()->select(['countries_trans.COUNTRY_ID', 'countries_trans.COUNTRY_TRANS_NAME'])->where(' LANGUAGE_ID = 1'),
////                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
//        ]);
//        $dataBusinessType = new ActiveDataProvider([
//            'query' => \app\models\BusinessType::find(),
////                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
//        ]);
//        $dataCategories = new ActiveDataProvider([
//            'query' => \app\models\CategoryOfItems::find(),
//            'pagination' => false,
////                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
//        ]);
//        
//
//                $dataSupplier = new ActiveDataProvider([
//                    'query' => Suppliers::find()->where('SUPPLIER_ID = ' . $supplierid),
////                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
//                ]);
//                $Suppliermodels = $dataSupplier->getModels();
//                $CountryID = ($Suppliermodels != NULL && sizeof($Suppliermodels) > 0 && $Suppliermodels[0]->COUNTRY_ID != NULL ? $Suppliermodels[0]->COUNTRY_ID : "0");
//                $dataCity = new ActiveDataProvider([
//                    'query' => \app\models\CitiesTranslation::findBySql('select t.CITY_ID, t.CITY_TRANSLATION from cities inner join cities_translation t on cities.CITY_ID=t.CITY_ID where cities.COUNTRY_ID = ' . $CountryID . ' AND t.LANGUAGE_ID=1 '),
////                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
//                ]);
//                $CouplePartnerModel = new CouplePartner();
//                
//                return $this->render('index', [
//                            
//                            'CouplePartnerModel' => $CouplePartnerModel,
//                            'dataSupplier' => $dataSupplier,
//                            'dataCountry' => $dataCountry,
//                            'dataCity' => $dataCity,
//                            'Supplier' => $Supplier,
//                            'dataSupplierType' => $dataSupplierType,
//                            'dataBusinessType' => $dataBusinessType,
//                            'dataCategories' => $dataCategories,
//                            'SupplierLocationModel' => $SupplierLocationModel,
////                            'dataSupplierLocation' => $dataSupplierLocation,
//                            'dataSupplierLocationModels'=>[new \app\models\SuppliersLocations],
//                ]);   
//    }
    public function GetCitiesByCountry($countryID) {
        $dataCity = new ActiveDataProvider([
            'query' => \app\models\CitiesTranslation::findBySql('select t.CITY_ID, t.CITY_TRANSLATION from cities inner join cities_translation t on cities.CITY_ID=t.CITY_ID where cities.COUNTRY_ID = ' . $countryID . ' AND t.LANGUAGE_ID=1 '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        if (isset($dataCity)) {
            $dataCity = $dataCity->getModels();
        }
        return $dataCity;
    }

    public function GetPartnerThruByIDAndSupplierID($PartnerThruID, $SupplierID) {
        $dataPartnerThruByID = new ActiveDataProvider([
            'query' => \app\models\SupplierPartnerThru::find()->where(['SUPPLIER_ID' => $SupplierID, 'PARTNER_THRU_ID' => $PartnerThruID]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        if (isset($dataPartnerThruByID)) {
            $dataPartnerThruByID = $dataPartnerThruByID->getModels();
        }
        return $dataPartnerThruByID;
    }

    public function GetPaymentByIDAndSupplierID($PaymentID, $SupplierID) {
        $dataPaymentByID = new ActiveDataProvider([
            'query' => SupplierPayment::find()->where(['SUPPLIER_ID' => $SupplierID, 'PAYMENT_ID' => $PaymentID]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        if (isset($dataPaymentByID)) {
            $dataPaymentByID = $dataPaymentByID->getModels();
        }
        return $dataPaymentByID;
    }

    public function GetItemSupplierTransByLanguageAndItemSupplierID($ItemSupplierID, $LanguageID) {
        $dataItemSupplierTrans = new ActiveDataProvider([
            'query' => \app\models\ItemSupplierTranslation::find()->where(['ITEM_SUPPLIER_ID' => $ItemSupplierID, 'LANGUAGE_ID' => $LanguageID]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        if (isset($dataItemSupplierTrans)) {
            $dataItemSupplierTrans = $dataItemSupplierTrans->getModels();
        }
        return $dataItemSupplierTrans;
    }

    public function GetItemIDsByProductID($ProductID) {
        $dataItemsByProduct = new ActiveDataProvider([
            'query' => \app\models\Items::findBySql('select items_trans.ITEM_ID ,items_trans.ITEM_NAME from items inner join items_trans on items.ITEM_ID=items_trans.ITEM_ID where items.PRODUCT_ID = ' . $ProductID . ' AND LANGUAGE_ID = 1 '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        if (isset($dataItemsByProduct)) {
            $dataItemsByProduct = $dataItemsByProduct->getModels();
        }
        return $dataItemsByProduct;
    }

//   @property integer $SUPPLIER_TYPE_ID
// * @property integer $BUSINESS_TYPE_ID
// *
// * @property SupplierTypes $sUPPLIERTYPE
// * @property BusinessType $bUSINESSTYPE
    public function actionBusinessTypeAndCategoriesBySupplierType() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $SupplierTypeID = $data['id'];
            $dataSupplierTypeBusinessType = new ActiveDataProvider([
                'query' => \app\models\SupplierTypeBusinessType::find()->where(['SUPPLIER_TYPE_ID' => $SupplierTypeID]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $ColumnWidth = 0;
            $dataSupplierTypeBusinessType = $dataSupplierTypeBusinessType->getModels();
            $BussinetypeFoem = '';
            $ii = 0;
            if ($dataSupplierTypeBusinessType != null && sizeof($dataSupplierTypeBusinessType) > 0) {
                foreach ($dataSupplierTypeBusinessType as $dataSupplierTypeBusinessTypeModel) {

                    $BusinessTypemodel = $dataSupplierTypeBusinessTypeModel->bUSINESSTYPE;
                    if ($BusinessTypemodel != null && sizeof($BusinessTypemodel) > 0) {
                        Yii::error(" sizeof(dataSupplierTypeBusinessType) " . sizeof($dataSupplierTypeBusinessType));
                        $ColumnWidth = 100 / sizeof($dataSupplierTypeBusinessType);

                        $Resu = null;




                        if ($ii == 0) {
                            if ($Resu != null && sizeof($Resu) > 0) {

                                $BussinetypeFoem = $BussinetypeFoem . '<th width="' . ($ColumnWidth + 0.4) . '%">
                                                                <input type="hidden" name="SupplierBusinessType[' . $ii . '][BUSINESS_TYPE_ID]" value="' . $BusinessTypemodel->BUSINESS_TYPE_ID . '">
                                                                <input type="hidden" name="CheckedOrNoT[' . $ii . ']" id="CheckedOrNoT' . $BusinessTypemodel->BUSINESS_TYPE_ID . '" value="true">
                                                                <input type="checkbox" checked="" id=\'CheckedOrNoTID' . $ii . '\' onclick="SelectAll(this, \'CheckedOrNoClass' . $ii . '\',\'CheckedOrNo' . $ii . '\');">' . ($BusinessTypemodel != null && $BusinessTypemodel->businessTypeTranslations != null && sizeof($BusinessTypemodel->businessTypeTranslations) > 0 ? $BusinessTypemodel->businessTypeTranslations[0]->BUSINESS_TYPE_VALUE : "") . ' 
                                                            </th>';
                            } else {

                                $BussinetypeFoem = $BussinetypeFoem . '<th width="' . ($ColumnWidth + 0.4) . '%">
                                                                <input type="hidden" name="SupplierBusinessType[' . $ii . '][BUSINESS_TYPE_ID]" value="' . $BusinessTypemodel->BUSINESS_TYPE_ID . '">
                                                                <input type="hidden" name="CheckedOrNoT[' . $ii . ']" id="CheckedOrNoT' . $BusinessTypemodel->BUSINESS_TYPE_ID . '" value="true">
                                                                <input type="checkbox" id=\'CheckedOrNoTID' . $ii . '\' onclick="SelectAll(this, \'CheckedOrNoClass' . $ii . '\',\'CheckedOrNo' . $ii . '\');">' . ($BusinessTypemodel != null && $BusinessTypemodel->businessTypeTranslations != null && sizeof($BusinessTypemodel->businessTypeTranslations) > 0 ? $BusinessTypemodel->businessTypeTranslations[0]->BUSINESS_TYPE_VALUE : "") . ' 
                                                            </th>';
                            }
                        } else {

                            if ($Resu != null && sizeof($Resu) > 0) {

                                $BussinetypeFoem = $BussinetypeFoem . '<th width="' . ($ColumnWidth) . '%">
                                                                <input type="hidden" name="SupplierBusinessType[' . $ii . '][BUSINESS_TYPE_ID]" value="' . $BusinessTypemodel->BUSINESS_TYPE_ID . '">
                                                                <input type="hidden" name="CheckedOrNoT[' . $ii . ']" id="CheckedOrNoT' . $BusinessTypemodel->BUSINESS_TYPE_ID . '" value="true">
                                                                <input type="checkbox" checked="" id=\'CheckedOrNoTID' . $ii . '\' onclick="SelectAll(this, \'CheckedOrNoClass' . $ii . '\',\'CheckedOrNo' . $ii . '\');">' . ($BusinessTypemodel != null && $BusinessTypemodel->businessTypeTranslations != null && sizeof($BusinessTypemodel->businessTypeTranslations) > 0 ? $BusinessTypemodel->businessTypeTranslations[0]->BUSINESS_TYPE_VALUE : "") . ' 
                                                            </th>';
                            } else {

                                $BussinetypeFoem = $BussinetypeFoem . '<th width="' . ($ColumnWidth) . '%">
                                                                <input type="hidden" name="SupplierBusinessType[' . $ii . '][BUSINESS_TYPE_ID]" value="' . $BusinessTypemodel->BUSINESS_TYPE_ID . '">
                                                                <input type="hidden" name="CheckedOrNoT[' . $ii . ']" id="CheckedOrNoT' . $BusinessTypemodel->BUSINESS_TYPE_ID . '" value="true">
                                                                <input type="checkbox" id=\'CheckedOrNoTID' . $ii . '\' onclick="SelectAll(this, \'CheckedOrNoClass' . $ii . '\',\'CheckedOrNo' . $ii . '\');">' . ($BusinessTypemodel != null && $BusinessTypemodel->businessTypeTranslations != null && sizeof($BusinessTypemodel->businessTypeTranslations) > 0 ? $BusinessTypemodel->businessTypeTranslations[0]->BUSINESS_TYPE_VALUE : "") . ' 
                                                            </th>';
                            }
                        }
                    }
                    $ii++;
                }
            }
            $BussinetypeFoem = $BussinetypeFoem . ' <th>&nbsp;&nbsp;</th>';


            $Form = '<tr>';


//            $ColumnWidth="";
            $dataCategories = new ActiveDataProvider([
                'query' => \app\models\CategoryOfItems::find(),
                'pagination' => false,
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $Categoriesmodels = null;
            if (isset($dataCategories)) {
                $Categoriesmodels = $dataCategories->getModels();
            }
            $ij = 0;
            $ii = 0;
            if ($dataSupplierTypeBusinessType != null && sizeof($dataSupplierTypeBusinessType) > 0) {
                foreach ($dataSupplierTypeBusinessType as $dataSupplierTypeBusinessTypeModel) {
                    $Resu = null;
                    $Display = "";


                    $Form = $Form . '<td width="' . $ColumnWidth . '%">';


                    if ($Categoriesmodels != null && sizeof($Categoriesmodels) > 0) {
//                echo 'sizeof($Categoriesmodels) : '. sizeof($Categoriesmodels);

                        foreach ($Categoriesmodels as $Categoriesmodel) {
                            if ($dataSupplierTypeBusinessTypeModel->BUSINESS_TYPE_ID == $Categoriesmodel->BUSINESS_TYPE_ID) {
                                $Resu = null;


                                if ($Resu != null && sizeof($Resu) > 0) {

                                    $Form = $Form . ' <input type="hidden" name="SupplierOfferedServices[' . $ij . '][CATEGORY_ID]" value="' . $Categoriesmodel->CATEGORY_OF_ITEM_ID . '">
                                                                                <input type="hidden" class="CheckedOrNo' . $ii . '" name="CheckedOrNo[' . $ij . ']" id="CheckedOrNo' . $Categoriesmodel->CATEGORY_OF_ITEM_ID . '" value="true">
                                                                                <input type="checkbox" checked="" class="CheckedOrNoClass' . $ii . '" onclick="SetChecked(this, \'CheckedOrNo' . $Categoriesmodel->CATEGORY_OF_ITEM_ID . '\')CheckIfAllChecked(\'CheckedOrNoClass' . $ii . '\',\'CheckedOrNoTID' . $ii . '\');">' . ($Categoriesmodel != null && sizeof($Categoriesmodel) > 0 && $Categoriesmodel->categoryOfItemsTrans != null && sizeof($Categoriesmodel->categoryOfItemsTrans) > 0 ? $Categoriesmodel->categoryOfItemsTrans[0]->CATEGORY_OF_ITEM_TRANS : "empty") . '<hr style="margin-top: 0px;margin-bottom: 0px;border-top: 1px solid lightsteelblue;width : 25%;">';
                                } else {

                                    $Form = $Form . ' <input type="hidden" name="SupplierOfferedServices[' . $ij . '][CATEGORY_ID]" value="' . $Categoriesmodel->CATEGORY_OF_ITEM_ID . '">
                                                                                <input type="hidden" class="CheckedOrNo' . $ii . '" name="CheckedOrNo[' . $ij . ']" id="CheckedOrNo' . $Categoriesmodel->CATEGORY_OF_ITEM_ID . '" value="false">
                                                                                <input type="checkbox" class="CheckedOrNoClass' . $ii . '" onclick="SetChecked(this, \'CheckedOrNo' . $Categoriesmodel->CATEGORY_OF_ITEM_ID . '\');CheckIfAllChecked(\'CheckedOrNoClass' . $ii . '\',\'CheckedOrNoTID' . $ii . '\');">' . ($Categoriesmodel != null && sizeof($Categoriesmodel) > 0 && $Categoriesmodel->categoryOfItemsTrans != null && sizeof($Categoriesmodel->categoryOfItemsTrans) > 0 ? $Categoriesmodel->categoryOfItemsTrans[0]->CATEGORY_OF_ITEM_TRANS : "empty" ) . '<hr style="margin-top: 0px;margin-bottom: 0px;border-top: 1px solid lightsteelblue;">';
                                }



                                $ij++;
                            }
                        }
                    }

                    $Form = $Form . '</td> ';
                    $ii++;
                }
            }

            $Form = $Form . '</tr>';
        }
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['BussineTypeForm' => $BussinetypeFoem,
            'Form' => $Form,
        ];
//      $CountryID =  ($models != NULL && sizeof($models) > 0 && $models[0]->COUNTRY_ID != NULL ? $models[0]->COUNTRY_ID : "0");
    }

// 

    public function actionItemsByProductId() {
        $Re = '<option value=\'0\'>Item...</option>';
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $ProductID = $data['id'];
            $dataItems = new ActiveDataProvider([
                'query' => \app\models\ItemsTrans::findBySql('select t.ITEM_ID, t.ITEM_NAME from items inner join items_trans t on items.ITEM_ID=t.ITEM_ID where items.PRODUCT_ID = ' . $ProductID . ' AND t.LANGUAGE_ID=1 '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $models0 = $dataItems->getModels();

            if (sizeof($models0) > 0) {
                foreach ($models0 as $option) {
                    $Re = $Re . '<option value=\'' . $option->ITEM_ID . '\'>' . $option->ITEM_NAME . '</option>';
                }
            }
        }
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['response' => $Re];
    }

    public function actionProductsBySubCategoryId() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $SubCategoryID = $data['id'];
            $dataProducts = new ActiveDataProvider([
                'query' => \app\models\ProductsTrans::findBySql('select t.PRODUCT_ID, t.PRODUCT_NAME from products inner join products_trans t on products.PRODUCT_ID=t.PRODUCT_ID where products.SUB_CATEGORY_ID = ' . $SubCategoryID . ' AND t.LANGUAGE_ID=1 '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $models0 = $dataProducts->getModels();
            $Re = '<option value=\'0\'>Product...</option>';
            if (sizeof($models0) > 0) {
                foreach ($models0 as $option) {
                    $Re = $Re . '<option value=\'' . $option->PRODUCT_ID . '\'>' . $option->PRODUCT_NAME . '</option>';
                }
            }
        }
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['response' => $Re];
    }

    public function actionSubCategoryByCategoryId() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $CategoryID = $data['id'];
            $dataCategory = new ActiveDataProvider([
                'query' => \app\models\SubCategoriesTrans::findBySql('select t.SUB_CATEGORY_ID, t.SUB_CATEGORY_NAME from sub_categories_of_items inner join sub_categories_trans t on sub_categories_of_items.SUB_CATEGORY_ID=t.SUB_CATEGORY_ID where sub_categories_of_items.CATEGORY_OF_ITEM_ID = ' . $CategoryID . ' AND t.LANGUAGE_ID=1 '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $models0 = $dataCategory->getModels();
            $Re = '<option value=\'0\'>Sub-Category...</option>';
            if (sizeof($models0) > 0) {
                foreach ($models0 as $option) {
                    $Re = $Re . '<option value=\'' . $option->SUB_CATEGORY_ID . '\'>' . $option->SUB_CATEGORY_NAME . '</option>';
                }
            }
        }
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['response' => $Re];
    }

    public function GetSubCAtegoryByCategoryID($CategoryID) {
        $dataCategory = new ActiveDataProvider([
            'query' => \app\models\SubCategoriesTrans::findBySql('select t.SUB_CATEGORY_ID, t.SUB_CATEGORY_NAME from sub_categories_of_items inner join sub_categories_trans t on sub_categories_of_items.SUB_CATEGORY_ID=t.SUB_CATEGORY_ID where sub_categories_of_items.CATEGORY_OF_ITEM_ID = ' . $CategoryID . ' AND t.LANGUAGE_ID=1 '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        if (isset($dataCategory)) {
            $dataCategory = $dataCategory->getModels();
        }
        return $dataCategory;
    }

    public function GetProductBySubCategoryID($SubCategoryID) {
        $dataProducts = new ActiveDataProvider([
            'query' => \app\models\ProductsTrans::findBySql('select t.PRODUCT_ID, t.PRODUCT_NAME from products inner join products_trans t on products.PRODUCT_ID=t.PRODUCT_ID where products.SUB_CATEGORY_ID = ' . $SubCategoryID . ' AND t.LANGUAGE_ID=1 '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        if (isset($dataProducts)) {
            $dataProducts = $dataProducts->getModels();
        }
        return $dataProducts;
    }

    public function GetItemsByProdutID($ProductID) {
        $dataItems = new ActiveDataProvider([
            'query' => \app\models\ItemsTrans::findBySql('select t.ITEM_ID, t.ITEM_NAME from items inner join items_trans t on items.ITEM_ID=t.ITEM_ID where items.PRODUCT_ID = ' . $ProductID . ' AND t.LANGUAGE_ID=1 '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        if (isset($dataItems)) {
            $dataItems = $dataItems->getModels();
        }
        return $dataItems;
    }
    public function GetCriteriasValueByOptions($OptionID,$CrtieriaID) {
        $dataOptionCriteriaValues = new ActiveDataProvider([
            'query' => \app\models\OptionCriteria::find()->where(['OPTION_ID' =>$OptionID,'CRITERIA_ID'=> $CrtieriaID]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        if (isset($dataOptionCriteriaValues)) {
            $dataOptionCriteriaValues = $dataOptionCriteriaValues->getModels();
        }
        return $dataOptionCriteriaValues;
    }
    public function GetCriteriasValueByCriteriaID($CritiriaID) {
        $dataCriteriaValues = new ActiveDataProvider([
            'query' => \app\models\CriteriaValues::findBySql('select criteria_values.CRITERIA_VALUE_ID, criteria_values.CRITERIA_VALUE from criteria_values where criteria_values.CRITERIA_ID = ' . $CritiriaID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        if (isset($dataCriteriaValues)) {
            $dataCriteriaValues = $dataCriteriaValues->getModels();
        }
        return $dataCriteriaValues;
    }

    
    public function actionAddcriteria() {
        if (Yii::$app->request->isAjax) {
            $Criterias = new \app\models\Criterias();
            $data = Yii::$app->request->post();
            $CriteriaValue = $data['CriteriaValue'];
            $Index=$data['Index'];
            if($CriteriaValue!==""){
                $Criterias->CRITERIA_NAME=$CriteriaValue;
                if($Criterias->save(false)){
                $CriteriaID = $Criterias->getPrimaryKey();
                $Form='
                                                            <td>
                                                                                                                                <input name="CheckBoxxx[0][0][]" type="checkbox">
                                                           <input type="hidden" id="optioncriteria-0-'.$Index.'-option_id" name="OptionCriteria[0]['.$Index.'][OPTION_ID][]" value="241">
                                                           <input type="hidden" id="optioncriteria-0-'.$Index.'-criteria_id" name="OptionCriteria[0]['.$Index.'][CRITERIA_ID][]" value="'.$CriteriaID.'">     
                                                                <label>'.$CriteriaValue.'</label>         

                           
                                                            </td> 
                                                            <td>
                                                                                                                         <div class="form-group field-optioncriteria-0-'.$Index.'-criteria_value_id has-success">

<select id="optioncriteria-0-'.$Index.'-criteria_value_id" class="form-control" name="OptionCriteria[0]['.$Index.'][CRITERIA_VALUE_ID][]" onchange="">
<option value="">Citeria Value...</option>
<option value="-1">Other Value...</option>
</select>

<div class="help-block"></div>
</div> 
                            
                                                            </td> ';
                Yii::$app->response->format = Response::FORMAT_JSON;
                    return ['response' =>$Form];
                }
            }
           
        }
    }
    public function actionAddNewProduct() {
        if (Yii::$app->request->isAjax) {
            $Product = new \app\models\Products();
            $ProductsTrans = new \app\models\ProductsTrans();
            $data = Yii::$app->request->post();
            $SupplierID = 0;
            if (Yii::$app->user->identity != null) {
                $SupplierID = Yii::$app->user->identity->SUPPLIER_ID != NULL ? Yii::$app->user->identity->SUPPLIER_ID : 0;
            }
//        SubCategory : $(SubCategoryID).val(),
//                           ProductValue :  ProductName.value  
            $SubCategoryID = $data['SubCategory'];
            $ProductValue = $data['ProductValue'];

            $dataSupplierInfo = new ActiveDataProvider([
                'query' => Suppliers::find()->where(['SUPPLIER_ID' => $SupplierID]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $LanguageID = 0;
            if (isset($dataSupplierInfo) && $dataSupplierInfo != null) {
                $dataSupplierInfo = $dataSupplierInfo->getModels();
                $LanguageID = $dataSupplierInfo[0]->SUPPLIER_DEFAULT_LANG != null ? $dataSupplierInfo[0]->SUPPLIER_DEFAULT_LANG : 0;
            }
            if ($SubCategoryID != "" && $ProductValue != "" && $LanguageID != 0) {
                $Product->SUB_CATEGORY_ID = $SubCategoryID;
                $Product->save(false);
                $primaryKey0 = $Product->getPrimaryKey();
                if ($primaryKey0 != null) {
                    $ProductsTrans->PRODUCT_ID = $primaryKey0;
                    $ProductsTrans->PRODUCT_NAME = $ProductValue;
                    $ProductsTrans->LANGUAGE_ID = $LanguageID;
                    $ProductsTrans->save(false);
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ['response' => '<option selected value="' . $primaryKey0 . '">' . $ProductValue . '</option>', 'productID' => $primaryKey0];
                }
            }
        }
    }

    public function actionAddNewItem() {
        if (Yii::$app->request->isAjax) {
            $Item = new \app\models\Items();
            $ItemTrans = new \app\models\ItemsTrans();
            $data = Yii::$app->request->post();
            $SupplierID = 0;
            if (Yii::$app->user->identity != null) {
                $SupplierID = Yii::$app->user->identity->SUPPLIER_ID != NULL ? Yii::$app->user->identity->SUPPLIER_ID : 0;
            }
            $ProductID = $data['ProductID'];
            $ItemValue = $data['ItemValue'];

            $dataSupplierInfo = new ActiveDataProvider([
                'query' => Suppliers::find()->where(['SUPPLIER_ID' => $SupplierID]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]);
            $LanguageID = 0;
            if (isset($dataSupplierInfo) && $dataSupplierInfo != null) {
                $dataSupplierInfo = $dataSupplierInfo->getModels();
                $LanguageID = $dataSupplierInfo[0]->SUPPLIER_DEFAULT_LANG != null ? $dataSupplierInfo[0]->SUPPLIER_DEFAULT_LANG : 0;
            }
            if ($ProductID != "" && $ItemValue != "" && $LanguageID != 0) {
                $Item->PRODUCT_ID = $ProductID;
                $Item->save(false);
                $primaryKey0 = $Item->getPrimaryKey();
                if ($primaryKey0 != null) {
                    $ItemTrans->ITEM_ID = $primaryKey0;
                    $ItemTrans->ITEM_NAME = $ItemValue;
                    $ItemTrans->LANGUAGE_ID = $LanguageID;
                    $ItemTrans->save(false);
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ['response' => '<option selected value="' . $primaryKey0 . '">' . $ItemValue . '</option>'];
                }
            }
        }
    }

    public function actionNewCriteriaForm() {
        if (Yii::$app->request->isAjax) {

            $data = Yii::$app->request->post();
            $OptionID = $data['OptionID'];
            $form = '<div class="row">
                            <div class="col-lg-5">

                                <div class="form-group field-criteriavalues-0-0-criteria_id">
<label class="control-label" for="criteriavalues-0-0-criteria_id">Criteria  ID</label>
<select id="criteriavalues-0-0-criteria_id" class="form-control CriteriaClass' . $OptionID . '" name="CriteriaValues[0][0][][CRITERIA_ID]" onchange="">
<option value="">Citerias...</option>

</select>

<div class="help-block"></div>
</div> 

                            </div>
                            <div class="col-lg-5">
                                                                <div class="form-group field-criteriavalues-0-0-criteria_value_id">
<label class="control-label" for="criteriavalues-0-0-criteria_value_id">Criteria  Value  ID</label>
<select id="criteriavalues-0-0-criteria_value_id" class="form-control" name="CriteriaValues[0][0][][CRITERIA_VALUE_ID]" onchange="">
<option value="">Citeria Value...</option>

</select>

<div class="help-block"></div>
</div> 

                            </div>
                            <div class="col-lg-2">
                                <button type="button" class="remove-criteria btn btn-danger btn-xs"><span class="glyphicon glyphicon-minus"></span></button>

                            </div>
                        </div>';
        }
    }

    public function actionUploadExcelFile() {
        
        ini_set('max_execution_time', 3000);
        $dataa = \moonland\phpexcel\Excel::widget([
                    'mode' => 'import',
                    'fileName' => 'D:\RoyVersion\categories-img\Categories & Subcategories (1).xlsx',
                    'setFirstRecordAsKeys' => true, // if you want to set the keys of record column with first record, if it not set, the header with use the alphabet column on excel. 
                    'setIndexSheetByName' => true, // set this if your excel data with multiple worksheet, the index of array will be set with the sheet name. If this not set, the index will use numeric. 
                    'getOnlySheet' => 'Honeymoon', // you can set this property if you want to get the specified sheet from the excel data with multiple worksheet.
        ]);

        print_r($dataa);
        $TemCategory = "";
        $WeddingType = new ActiveDataProvider([
                        'query' => \app\models\WeddingType::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
                    ]);
        if ($WeddingType != null && sizeof($WeddingType) > 0) {
                        $WeddingType = $WeddingType->getModels();
        }
        $Countries = new ActiveDataProvider([
                        'query' => \app\models\Countries::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
                    ]);
        if ($Countries != null && sizeof($Countries) > 0) {
        $Countries = $Countries->getModels();
        
        }
        if ($dataa != null && sizeof($dataa) > 0) {
            for ($i = 0; $i < sizeof($dataa); $i++) {
                $CategoryValue = $dataa[$i]['Category'];
                if ($CategoryValue != null && $CategoryValue != "") {
                    $TemCategory = $CategoryValue;
                }
                echo ' ' . $TemCategory . ' --- ' . $dataa[$i]['Sub-Category'] . ' <br>';


                $SubCategoryValue = $dataa[$i]['Sub-Category'];
                $CategoryMo = new \app\models\CategoryOfItems();
                $CategoryMoTrans = new \app\models\CategoryOfItemsTrans();
                $SubCategory = new \app\models\SubCategoriesOfItems();
                $SubCategoryTrans = new \app\models\SubCategoriesTrans();
                $CategoryWeddingTye = new \app\models\CategoriesWeddingType();
                $CategoruCountry=new \app\models\CategoriesCountries();
                $SubCategoryWeddingTye = new \app\models\SubCategoriesWeddingType();
                $SubCategoryCountries=new \app\models\SubCategoriesCountries();
                $where = \app\models\CategoryOfItemsTrans::findOne(['CATEGORY_OF_ITEM_TRANS' => $TemCategory, 'LANGUAGE_ID' => 1]);
                if ($where != null && sizeof($where) > 0) {
                    
                   
                    if ($WeddingType != null && sizeof($WeddingType) > 0) {
                        
                        foreach ($WeddingType as $WeddingTy) {
                            $findOne = \app\models\CategoriesWeddingType::findOne(['CATEGORY_ID' => $where->CATEGORY_OF_ITEM_ID, 'WEDDING_TYPE_ID' => $WeddingTy->WEDDING_TYPE_ID]);
                            if ($findOne != null && sizeof($findOne) > 0) {
                                
                            } else {
                                $CategoryWeddingTye->CATEGORY_ID = $where->CATEGORY_OF_ITEM_ID;
                                $CategoryWeddingTye->WEDDING_TYPE_ID = $WeddingTy->WEDDING_TYPE_ID;
                                $CategoryWeddingTye->save(false);
                            }
                        }
                    } // Category Wedding Type for existing Categories
                    
                    if ($Countries != null && sizeof($Countries) > 0) {
//                        $Countries = $Countries->getModels();
                        foreach ($Countries as $CountriesM) {
                            $findOne = \app\models\CategoriesCountries::findOne(['CATEGORY_ID' => $where->CATEGORY_OF_ITEM_ID, 'COUNTRY_ID' => $CountriesM->COUNTRY_ID]);
                            if ($findOne != null && sizeof($findOne) > 0) {
                                
                            } else {
                                $CategoruCountry->CATEGORY_ID = $where->CATEGORY_OF_ITEM_ID;
                                $CategoruCountry->COUNTRY_ID = $CountriesM->COUNTRY_ID;
                                $CategoruCountry->save(false);
                            }
                        }
                    } // CAtegory Countries for Existing Categories
                    
                    $where0 = \app\models\SubCategoriesTrans::findOne(['SUB_CATEGORY_NAME' => $SubCategoryValue, 'LANGUAGE_ID' => 1]);
                    if ($where0 != null && sizeof($where0) > 0) {
                        if ($WeddingType != null && sizeof($WeddingType) > 0) {
//                                $find0 = $find0->getModels();
                                foreach ($WeddingType as $WeddingTy) {
                                    $findOne = \app\models\SubCategoriesWeddingType::findOne(['SUB_CATEGORY_ID' => $where0->SUB_CATEGORY_ID, 'WEDDING_TYPE_ID' => $WeddingTy->WEDDING_TYPE_ID]);
                                    if ($findOne != null && sizeof($findOne) > 0) {
                                        
                                    } else {
                                        $SubCategoryWeddingTye->SUB_CATEGORY_ID = $where0->SUB_CATEGORY_ID;
                                        $SubCategoryWeddingTye->WEDDING_TYPE_ID = $WeddingTy->WEDDING_TYPE_ID;
                                        $SubCategoryWeddingTye->save(false);
                                    }
                                }
                            }
                            
                            
                            if ($Countries != null && sizeof($Countries) > 0) {
//                        $Countries = $Countries->getModels();
                        foreach ($Countries as $CountriesM) {
                            $findOne = \app\models\SubCategoriesCountries::findOne(['SUB_CATEGORY_ID' => $where0->SUB_CATEGORY_ID, 'COUNTRY_ID' => $CountriesM->COUNTRY_ID]);
                            if ($findOne != null && sizeof($findOne) > 0) {
                                
                            } else {
                                $SubCategoryCountries->SUB_CATEGORY_ID = $where0->SUB_CATEGORY_ID;
                                $SubCategoryCountries->COUNTRY_ID = $CountriesM->COUNTRY_ID;
                                $SubCategoryCountries->save(false);
                            }
                        }
                    }
                    } else {
                        $CategoryID = $where->CATEGORY_OF_ITEM_ID;
                        $SubCategory->CATEGORY_OF_ITEM_ID = $CategoryID;
                        if ($SubCategory->save(false)) {
                            $SubCategoryID = $SubCategory->getPrimaryKey();
                            $SubCategoryTrans->LANGUAGE_ID = 1;
                            $SubCategoryTrans->SUB_CATEGORY_ID = $SubCategoryID;
                            $SubCategoryTrans->SUB_CATEGORY_NAME = $SubCategoryValue;
                            $SubCategoryTrans->save(false);

                            if ($WeddingType != null && sizeof($WeddingType) > 0) {
//                                $find0 = $find0->getModels();
                                foreach ($WeddingType as $WeddingTy) {
                                    $findOne = \app\models\SubCategoriesWeddingType::findOne(['SUB_CATEGORY_ID' => $SubCategoryID, 'WEDDING_TYPE_ID' => $WeddingTy->WEDDING_TYPE_ID]);
                                    if ($findOne != null && sizeof($findOne) > 0) {
                                        
                                    } else {
                                        $SubCategoryWeddingTye->SUB_CATEGORY_ID = $SubCategoryID;
                                        $SubCategoryWeddingTye->WEDDING_TYPE_ID = $WeddingTy->WEDDING_TYPE_ID;
                                        $SubCategoryWeddingTye->save(false);
                                    }
                                }
                            }
                            
                            
                            if ($Countries != null && sizeof($Countries) > 0) {
//                        $Countries = $Countries->getModels();
                        foreach ($Countries as $CountriesM) {
                            $findOne = \app\models\SubCategoriesCountries::findOne(['SUB_CATEGORY_ID' => $SubCategoryID, 'COUNTRY_ID' => $CountriesM->COUNTRY_ID]);
                            if ($findOne != null && sizeof($findOne) > 0) {
                                
                            } else {
                                $SubCategoryCountries->SUB_CATEGORY_ID = $SubCategoryID;
                                $SubCategoryCountries->COUNTRY_ID = $CountriesM->COUNTRY_ID;
                                $SubCategoryCountries->save(false);
                            }
                        }
                    }
                        }
                    }
                } else {
                    $CategoryMo->CATEGORY_FLAG = 'H';
                    $CategoryMo->BUSINESS_TYPE_ID =3;
                    if ($CategoryMo->save(false)) {
                        $CAtegoryID = $CategoryMo->getPrimaryKey();
                        $CategoryMoTrans->CATEGORY_OF_ITEM_ID = $CAtegoryID;
                        $CategoryMoTrans->CATEGORY_OF_ITEM_TRANS = $TemCategory;
                        $CategoryMoTrans->LANGUAGE_ID = 1;
                        $CategoryMoTrans->save(false);

                        
                        if ($WeddingType != null && sizeof($WeddingType) > 0) {
//                            $find0 = $find0->getModels();
                            foreach ($WeddingType as $WeddingTy) {
                                $findOne = \app\models\CategoriesWeddingType::findOne(['CATEGORY_ID' => $CAtegoryID, 'WEDDING_TYPE_ID' => $WeddingTy->WEDDING_TYPE_ID]);
                                if ($findOne != null && sizeof($findOne) > 0) {
                                    
                                } else {
                                    $CategoryWeddingTye->CATEGORY_ID = $CAtegoryID;
                                    $CategoryWeddingTye->WEDDING_TYPE_ID = $WeddingTy->WEDDING_TYPE_ID;
                                    $CategoryWeddingTye->save(false);
                                }
                            }
                        } // Wedding Type For New CAtegories
                         if ($Countries != null && sizeof($Countries) > 0) {
//                        $Countries = $Countries->getModels();
                        foreach ($Countries as $CountriesM) {
                            $findOne = \app\models\CategoriesCountries::findOne(['CATEGORY_ID' => $CAtegoryID, 'COUNTRY_ID' => $CountriesM->COUNTRY_ID]);
                            if ($findOne != null && sizeof($findOne) > 0) {
                                
                            } else {
                                $CategoruCountry->CATEGORY_ID = $CAtegoryID;
                                $CategoruCountry->COUNTRY_ID = $CountriesM->COUNTRY_ID;
                                $CategoruCountry->save(false);
                            }
                        }
                    } // CAtegory Countries for New Categories

//            $CategoryID=$where->CATEGORY_OF_ITEM_ID;
                        $SubCategory->CATEGORY_OF_ITEM_ID = $CAtegoryID;
                        if ($SubCategory->save(false)) {
                            $SubCategoryID = $SubCategory->getPrimaryKey();
                            $SubCategoryTrans->LANGUAGE_ID = 1;
                            $SubCategoryTrans->SUB_CATEGORY_ID = $SubCategoryID;
                            $SubCategoryTrans->SUB_CATEGORY_NAME = $SubCategoryValue;
                            $SubCategoryTrans->save(false);

                            if ($WeddingType != null && sizeof($WeddingType) > 0) {
//                                $find0 = $find0->getModels();
                                foreach ($WeddingType as $WeddingTy) {
                                    $findOne = \app\models\SubCategoriesWeddingType::findOne(['SUB_CATEGORY_ID' => $SubCategoryID, 'WEDDING_TYPE_ID' => $WeddingTy->WEDDING_TYPE_ID]);
                                    if ($findOne != null && sizeof($findOne) > 0) {
                                        
                                    } else {
                                        $SubCategoryWeddingTye->SUB_CATEGORY_ID = $SubCategoryID;
                                        $SubCategoryWeddingTye->WEDDING_TYPE_ID = $WeddingTy->WEDDING_TYPE_ID;
                                        $SubCategoryWeddingTye->save(false);
                                    }
                                }
                            } // Wedding Type For New Sub-CAtegories
                            if ($Countries != null && sizeof($Countries) > 0) {
//                        $Countries = $Countries->getModels();
                        foreach ($Countries as $CountriesM) {
                            $findOne = \app\models\SubCategoriesCountries::findOne(['SUB_CATEGORY_ID' => $SubCategoryID, 'COUNTRY_ID' => $CountriesM->COUNTRY_ID]);
                            if ($findOne != null && sizeof($findOne) > 0) {
                                
                            } else {
                                $SubCategoryCountries->SUB_CATEGORY_ID = $SubCategoryID;
                                $SubCategoryCountries->COUNTRY_ID = $CountriesM->COUNTRY_ID;
                                $SubCategoryCountries->save(false);
                            }
                        }
                    } // Countries For New Sub-CAtegories
                        }
                    }
                }
            }
        }
    }
public function actionUploadTaskExcelFile() {
        
        ini_set('max_execution_time', 3000);
        $dataa = \moonland\phpexcel\Excel::widget([
                    'mode' => 'import',
                    'fileName' => 'D:\Wedding countdown.xlsx',
                    'setFirstRecordAsKeys' => true, // if you want to set the keys of record column with first record, if it not set, the header with use the alphabet column on excel. 
                    'setIndexSheetByName' => true, // set this if your excel data with multiple worksheet, the index of array will be set with the sheet name. If this not set, the index will use numeric. 
                    'getOnlySheet' => 'Sheet1', // you can set this property if you want to get the specified sheet from the excel data with multiple worksheet.
        ]);

        print_r($dataa);
        
        if ($dataa != null && sizeof($dataa) > 0) {
            for ($i = 0; $i < sizeof($dataa); $i++) {
                if($dataa[$i]['Event']!=null && $dataa[$i]['Event']!="" && $dataa[$i]['AgendaPeriod']!=null && $dataa[$i]['AgendaPeriod']!=""){
                    $Agenda=new \app\models\Agenda();
                    $Agenda->PUBLIC_PRIVATE_FLAG='P';
                    $Agenda->AGENDA_PERIODE_ID=$dataa[$i]['AgendaPeriod'];
                    $Agenda->WEDDING_EVENT_ID=$dataa[$i]['Event'];
                    $Agenda->save(false);
                   $AgendaTask =  $Agenda->getPrimaryKey();
                   if($AgendaTask!=null){
                      $AgendaTrans=new \app\models\AgendaTranslation();
                      $AgendaTrans->TASK_ID=$AgendaTask;
                      $AgendaTrans->TASK_NAME=$dataa[$i]['Tasks'];
                      $AgendaTrans->LANGUAGE_ID=1;
                      $AgendaTrans->save(false);
                   }
                }
                
            }
        }
    }
}
