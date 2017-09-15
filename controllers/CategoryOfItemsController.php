<?php

namespace app\controllers;

use Yii;
use app\models\AgendaPeriodes;
use \app\models\WeddingTentativePeriodes;
use yii\data\ActiveDataProvider;
use app\models\WeddingEvent;
use app\models\CategoryOfItems;
use \app\models\Items;
use yii\web\Response;
use \app\models\Suppliers;
use \app\models\Products;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\Sort;
class CategoryOfItemsController extends \yii\web\Controller {
    
    
    
    
    public $LastProductID=0;
    
    
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
                        
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','itembyproduct','itembysupplier','itembyproductid','itemsorting','sub-categories'],
                        'roles' => ['?'],
                    ],
                ],
            ],
            ];
            
        
    }
    
    
    public function actionIndex() {
        $Reg = '';
        if (Yii::$app->request != null && Yii::$app->request->get('Reg') != null) {
            $Reg = Yii::$app->request->get('Reg');
        }
       
        $session = Yii::$app->session;
        if($Reg!=''){
//        $session = Yii::$app->session;
        $session['Reg'] = $Reg;
        }else{
            $Reg=$session['Reg'];
        }
        $productID = 0;
        if (Yii::$app->request != null && Yii::$app->request->get('productID') != null) {
            $productID = Yii::$app->request->get('productID');
        }
        $this->LastProductID=$productID;
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
//        $TransModel=  \app\models\AgendaPeriodeTranslation();
//        $TransModel->
        $CouplePartnerModel = new \app\models\CouplePartner();
        $WeddingEvents = new \app\models\WeddingEvent();
        $WeddingTentativePeriods = new \app\models\WeddingTentativePeriodes();

        $CategoryOfItemss = new CategoryOfItems();
        $CategoryOfItemsDataProvider = new ActiveDataProvider([
            'query' => CategoryOfItems::find()->where(['CATEGORY_FLAG' => $Reg]),
            'sort' => [
                'defaultOrder' => [
            'CATEGORY_PRIORITY' => SORT_ASC,
                 
        ]
    ],
            'pagination' =>false,
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
        
         $LangCode=Yii::$app->language;
      $LangModel= \app\models\Languages::find()->where(['LANGUAGE_NAME' =>$LangCode])->one();
      $LanguageID=1;
      if($LangModel!=null){
        $LanguageID=  $LangModel->LANGUAGE_ID;
      }
      Yii::$app->view->params['SelectedLan'] = $LanguageID;
        $dataSubCategoriesOfItems = new ActiveDataProvider([
            'query' => \app\models\SubCategoriesTrans::find()
                ->innerJoin('sub_categories_of_items',' sub_categories_trans.SUB_CATEGORY_ID=sub_categories_of_items.SUB_CATEGORY_ID')
                ->innerJoin('category_of_items',' category_of_items.CATEGORY_OF_ITEM_ID=sub_categories_of_items.CATEGORY_OF_ITEM_ID ')
                ->where('category_of_items.CATEGORY_FLAG = \'C\' AND sub_categories_trans.SHOW_HIDE_FLAG = \'Y\'  AND LANGUAGE_ID = '.Yii::$app->view->params['SelectedLan'] ),
            'pagination' =>false,
        ]);

        if (isset($dataSubCategoriesOfItems)) {
            $dataSubCategoriesOfItems = $dataSubCategoriesOfItems->getModels();
        }
        
        $p=0;
 $ProductValue="";
$dataFeaturedProviderItems=null;
   if($dataProviderItems!=null){
       $ProductsIDArray=[];
       $getCategories=$dataProviderItems->getModels();
       if($getCategories!=null && sizeof($getCategories)>0){
           foreach($getCategories as $categories){
           $SubCategoriesForSpecifcCategory= $categories->sUBCATEGORY->cATEGORYOFITEM->subCategoriesOfItems ;
           if($SubCategoriesForSpecifcCategory!=null && sizeof($SubCategoriesForSpecifcCategory)>0){
               foreach($SubCategoriesForSpecifcCategory as $SubCat){
                   $ProductList= $SubCat->products;
                   if($ProductList!=null && sizeof($ProductList)>0){
                       foreach($ProductList as $Prod){
                       if(!in_array($Prod->PRODUCT_ID, $ProductsIDArray)){
                           $ProductsIDArray[$p]=$Prod->PRODUCT_ID;
                           $p++;
                       }
                   }
                   }
               }
           }
           }
       }
      
       $p=0;
       if($ProductsIDArray!=null && sizeof($ProductsIDArray)>0){
           foreach($ProductsIDArray as $ProductIDFromArray){
           if($p==sizeof($ProductsIDArray)-1){
              $ProductValue=$ProductValue.$ProductIDFromArray.""; 
           }else{
              $ProductValue=$ProductValue.$ProductIDFromArray.","; 
           }
           $p++;
           }
       }
       if($ProductValue!=""){
             Yii::error("Index ProductValue :  ".$ProductValue);
      $dataFeaturedProviderItems = new ActiveDataProvider([
                'query' => Products::find()->innerJoin('products_trans', 'products_trans.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items', 'items.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items_supplieirs II', 'items.ITEM_ID=II.ITEM_ID')->innerJoin('suppliers', 'II.SUPPLIER_ID=suppliers.SUPPLIER_ID')->innerJoin('items_trans', 'items_trans.ITEM_ID=items.ITEM_ID')->where(' products.PRODUCT_ID IN ('.$ProductValue.')'),
                    'pagination' =>false,
  
            ]);   
       }else{
         $dataFeaturedProviderItems = new ActiveDataProvider([
                'query' => Products::find()->innerJoin('products_trans', 'products_trans.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items', 'items.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items_supplieirs II', 'items.ITEM_ID=II.ITEM_ID')->innerJoin('suppliers', 'II.SUPPLIER_ID=suppliers.SUPPLIER_ID')->innerJoin('items_trans', 'items_trans.ITEM_ID=items.ITEM_ID'),
                    'pagination' =>false,
  
            ]);     
       }
   }
        return $this->render('index', [
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
                    'dataSupplierType' => $dataSupplierType,
                    'dataSupplier' => $dataSupplier,
                    'dataCity' => $dataCity,
                    'Supplier' => $Supplier,
                    'WeddingModel' => $WeddingModel,
                    'SubCategory'=>$dataSubCategoriesOfItems,
                    'dataFeaturedProviderItems'=>$dataFeaturedProviderItems,
//            'dataProvider1' => $dataProvider1,
        ]);
    }
   public function actionItembysupplier() {
//        $session = Yii::$app->session;
//        session_start();
//        $searchModel = new StatusSearch();
//         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 $SupplierID = '';
        if (Yii::$app->request != null && Yii::$app->request->get('RSupplierID') != null) {
            $SupplierID = Yii::$app->request->get('RSupplierID');
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
//        if (Yii::$app->request != null && Yii::$app->request->get('Location') != null && Yii::$app->request->get('Location') != '') {
//            $LocationID = Yii::$app->request->get('Location');
//        }
        $SupplierTypeID=0;
//        $SupplierID = 0;
//        if (Yii::$app->request != null && Yii::$app->request->get('SupplierName') != null && Yii::$app->request->get('SupplierName') != '') {
//            $SupplierID = Yii::$app->request->get('SupplierName');
//        }
        $searchterms = '';
//        if (Yii::$app->request != null && Yii::$app->request->get('searchterms') != null && Yii::$app->request->get('searchterms') != '') {
//            $searchterms = Yii::$app->request->get('searchterms');
//        }
        $minprice = '';
//        if (Yii::$app->request != null && Yii::$app->request->get('min-price') != null && Yii::$app->request->get('min-price') != '') {
//            $minprice = Yii::$app->request->get('min-price');
//        }
        $maxprice = '';
//        if (Yii::$app->request != null && Yii::$app->request->get('max-price') != null && Yii::$app->request->get('max-price') != '') {
//            $maxprice = Yii::$app->request->get('max-price');
//        }
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
//        $TransModel=  \app\models\AgendaPeriodeTranslation();
//        $TransModel->
        $CouplePartnerModel = new \app\models\CouplePartner();
        $WeddingEvents = new \app\models\WeddingEvent();
        $WeddingTentativePeriods = new \app\models\WeddingTentativePeriodes();

        $CategoryOfItemss = new CategoryOfItems();
        $CategoryOfItemsDataProvider = new ActiveDataProvider([
            'query' => CategoryOfItems::find()->where(['CATEGORY_FLAG' => 'C']),
            'sort' => [
                'defaultOrder' => [
            'CATEGORY_PRIORITY' => SORT_ASC,
                 
        ]
    ],
            'pagination' =>false,
            
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
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'dataProvider1' => $dataProvider1,
                    'CategoryOfItems' => $CategoryOfItemss,
                    'CategoryOfItemsDataProvider' => $CategoryOfItemsDataProvider,
                    'WeddingEvents' => $WeddingEvents,
                    'WeddingTentativePeriods' => $WeddingTentativePeriods,
                    'WeddingEventDataProvider' => $WeddingEventDataProvider,
                    'dataProviderForWeddingDate1' => $dataProviderForWeddingDate1,
                    'CouplePartnerModel' => $CouplePartnerModel,
                   
                    'dataProviderSuplliers' => $dataProviderSuplliers,
                    'dataSupplierType' => $dataSupplierType,
                    'dataSupplier' => $dataSupplier,
                    'dataCity' => $dataCity,
                    'Supplier' => $Supplier,
                    'WeddingModel' => $WeddingModel,
                    'LocationID' =>$LocationID,
                    'SupplierTypeID' => $SupplierTypeID,
                    'SupplierID' => $SupplierID,
                    'minprice' => $minprice,
                    'maxprice' => $maxprice,
                    'searchterms' => $searchterms,
                    'Reg'=>$Reg,
//            'dataProvider1' => $dataProvider1,
        ]);
//         return ['suss'=>'test'];
    }
     public function actionItembyproduct() {
//        $session = Yii::$app->session;
//        session_start();
//        $searchModel = new StatusSearch();
//         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$sorting='ASC';
        
        if (Yii::$app->request != null && Yii::$app->request->get('sorting') != null) {
            $sorting = Yii::$app->request->get('sorting');
        }
        $SortingBy='Price';
        if (Yii::$app->request != null && Yii::$app->request->get('sortingby') != null) {
            $SortingBy = Yii::$app->request->get('sortingby');
        }
        
       $cookies = Yii::$app->response->cookies;
       
         $cookies->remove('PriceSorting');
         $cookies->remove('supplierName');
         $cookies->remove('sortingDate');
         unset($cookies['PriceSorting']);
         unset($cookies['supplierName']);
         unset($cookies['sortingDate']);
         if($SortingBy=='Price'){
       $cookies->add(new \yii\web\Cookie([
                'name' => 'PriceSorting',
                'value' => $sorting,
            ]));
         }
         
         if($SortingBy=='Date'){
       $cookies->add(new \yii\web\Cookie([
                'name' => 'sortingDate',
                'value' => $sorting,
            ]));
         }
         if($SortingBy=='Name'){
       $cookies->add(new \yii\web\Cookie([
                'name' => 'supplierName',
                'value' => $sorting,
            ]));
         }
       
        $SubCategoryID = 0;
        if (Yii::$app->request != null && Yii::$app->request->get('SubCategoryID') != null && Yii::$app->request->get('SubCategoryID') != '') {
            $SubCategoryID = Yii::$app->request->get('SubCategoryID');
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
        if (Yii::$app->request != null && Yii::$app->request->get('ProductID') != null) {
            $productID = Yii::$app->request->get('ProductID');
        }
        
        $LocationID = 0;
        if (Yii::$app->request != null && Yii::$app->request->get('Location') != null && Yii::$app->request->get('Location') != '') {
            $LocationID = Yii::$app->request->get('Location');
        }
        $SupplierTypeID = 0;
        if (Yii::$app->request != null && Yii::$app->request->get('SupplierType') != null && Yii::$app->request->get('SupplierType') != '') {
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
        
       
        
       
        $dataProviderItems = new ActiveDataProvider([
                'query' => Products::find(),
                
            ]); 
        Yii::error("Index Controller productID : " . $productID);
        Yii::error("Index Controller LocationID : " . $LocationID);
        Yii::error("Index Controller SupplierID : " . $SupplierID);
        Yii::error("Index Controller SupplierTypeID : " . $SupplierTypeID);
        Yii::error("Index Controller SubCate : " . $SubCategoryID);
        
        if ($productID != 0 && $LocationID==0 && $SupplierID==0 && $SupplierTypeID==0) {
        Yii::error("Index Controller SubCategoryID : " . $SubCategoryID);
            if($SubCategoryID!=0){
               $dataProviderItems = new ActiveDataProvider([
                'query' => Products::find()->where(['PRODUCT_ID' => $productID,'SUB_CATEGORY_ID'=>$SubCategoryID]),
                
            ]); 
            }else{
               $dataProviderItems = new ActiveDataProvider([
                'query' => Products::find()->where(['PRODUCT_ID' => $productID]),
                
            ]); 
            }
            
            
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
            if ($SubCategoryID != 0) {
                $Cond['products.SUB_CATEGORY_ID'] = $SubCategoryID;
            }
            Yii::error( "min hon SubCate : " . $SubCategoryID);
//            searchterms='+searchterms+'&minprice='+minprice+'&maxprice='+maxprice

            if (($Cond != null && $Cond != '' && sizeof($Cond > 0))) {
                 Yii::error( "min hon SubCate 1asdas : " . $SubCategoryID);

//                    $Cond['items_trans.ITEM_NAME'] = '%' . $searchterms . '%';
//                    Yii::error("Index Controller productID helloooo   : " . $Cond['items_supplieirs.SUPPLIER_ID']);
                    $dataProviderItems = new ActiveDataProvider([
//            'query' => Suppliers::find()->where($Cond),
                        'query' => Products::find()->innerJoin('products_trans', 'products_trans.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items', 'items.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items_supplieirs', 'items.ITEM_ID=items_supplieirs.ITEM_ID')->innerJoin('suppliers', 'items_supplieirs.SUPPLIER_ID=suppliers.SUPPLIER_ID')->innerJoin('items_trans', 'items_trans.ITEM_ID=items.ITEM_ID')->where($Cond)->andWhere('(products_trans.PRODUCT_NAME LIKE \'%'.$searchterms.'%\' OR suppliers.SUPPLIER_NAME LIKE \'%'.$searchterms.'%\' )'),
                    ]);
                
                
                
            } 
            else {
         
                if ($SubCategoryID != 0) {
                $dataProviderItems = new ActiveDataProvider([

                    'query' => Products::find()->innerJoin('products_trans', 'products_trans.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items', 'items.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items_supplieirs II', 'items.ITEM_ID=II.ITEM_ID')->innerJoin('suppliers', 'II.SUPPLIER_ID=suppliers.SUPPLIER_ID')->innerJoin('items_trans', 'items_trans.ITEM_ID=items.ITEM_ID')->where($Cond)->andWhere('  (products_trans.PRODUCT_NAME LIKE \'%'.$searchterms.'%\' OR suppliers.SUPPLIER_NAME LIKE \'%'.$searchterms.'%\' ) AND products.SUB_CATEGORY_ID='.$SubCategoryID),
                    'pagination' =>false,
  
                    ]);
            }else{
              $dataProviderItems = new ActiveDataProvider([

                    'query' => Products::find()->innerJoin('products_trans', 'products_trans.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items', 'items.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items_supplieirs II', 'items.ITEM_ID=II.ITEM_ID')->innerJoin('suppliers', 'II.SUPPLIER_ID=suppliers.SUPPLIER_ID')->innerJoin('items_trans', 'items_trans.ITEM_ID=items.ITEM_ID')->where($Cond)->andWhere('(products_trans.PRODUCT_NAME LIKE \'%'.$searchterms.'%\' OR suppliers.SUPPLIER_NAME LIKE \'%'.$searchterms.'%\' )'),
                    'pagination' =>false,
  
                    ]);  
            }
                
                
            }
        }

        $p=0;
 $ProductValue="";
$dataFeaturedProviderItems=null;
   if($dataProviderItems!=null){
       $ProductsIDArray=[];
       $getCategories=$dataProviderItems->getModels();
       if($getCategories!=null && sizeof($getCategories)>0){
           foreach($getCategories as $categories){
           $SubCategoriesForSpecifcCategory= $categories->sUBCATEGORY->cATEGORYOFITEM->subCategoriesOfItems ;
           if($SubCategoriesForSpecifcCategory!=null && sizeof($SubCategoriesForSpecifcCategory)>0){
               foreach($SubCategoriesForSpecifcCategory as $SubCat){
                   $ProductList= $SubCat->products;
                   if($ProductList!=null && sizeof($ProductList)>0){
                       foreach($ProductList as $Prod){
                       if(!in_array($Prod->PRODUCT_ID, $ProductsIDArray)){
                           $ProductsIDArray[$p]=$Prod->PRODUCT_ID;
                           $p++;
                       }
                   }
                   }
               }
           }
           }
       }
      
       $p=0;
       if($ProductsIDArray!=null && sizeof($ProductsIDArray)>0){
           foreach($ProductsIDArray as $ProductIDFromArray){
           if($p==sizeof($ProductsIDArray)-1){
              $ProductValue=$ProductValue.$ProductIDFromArray.""; 
           }else{
              $ProductValue=$ProductValue.$ProductIDFromArray.","; 
           }
           $p++;
           }
       }
       if($ProductValue!=""){
             Yii::error("Index ProductValue :  ".$ProductValue);
      $dataFeaturedProviderItems = new ActiveDataProvider([
                'query' => Products::find()->innerJoin('products_trans', 'products_trans.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items', 'items.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items_supplieirs II', 'items.ITEM_ID=II.ITEM_ID')->innerJoin('suppliers', 'II.SUPPLIER_ID=suppliers.SUPPLIER_ID')->innerJoin('items_trans', 'items_trans.ITEM_ID=items.ITEM_ID')->where(' products.PRODUCT_ID IN ('.$ProductValue.')'),
                    'pagination' =>false,
  
            ]);   
       }else{
         $dataFeaturedProviderItems = new ActiveDataProvider([
                'query' => Products::find()->innerJoin('products_trans', 'products_trans.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items', 'items.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items_supplieirs II', 'items.ITEM_ID=II.ITEM_ID')->innerJoin('suppliers', 'II.SUPPLIER_ID=suppliers.SUPPLIER_ID')->innerJoin('items_trans', 'items_trans.ITEM_ID=items.ITEM_ID'),
                    'pagination' =>false,
  
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
//        $TransModel=  \app\models\AgendaPeriodeTranslation();
//        $TransModel->
        $CouplePartnerModel = new \app\models\CouplePartner();
        $WeddingEvents = new \app\models\WeddingEvent();
        $WeddingTentativePeriods = new \app\models\WeddingTentativePeriodes();

        $CategoryOfItemss = new CategoryOfItems();
        $CategoryOfItemsDataProvider = new ActiveDataProvider([
            'query' => CategoryOfItems::find()->where(['CATEGORY_FLAG' => 'C']),
            'sort' => [
                'defaultOrder' => [
            'CATEGORY_PRIORITY' => SORT_ASC,
                
        ]
    ],
             'pagination' =>false,
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
 
        


      
        $dataSupplier = new ActiveDataProvider([
            'query' => Suppliers::find()->where('COUNTRY_ID = 1'),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        
        
        $Supplier = new \app\models\Suppliers();
 
//Yii::$app->response->format = Response::FORMAT_JSON;
        return $this->renderAjax('_search', [
                    
                    'CategoryOfItems' => $CategoryOfItemss,
                    'CategoryOfItemsDataProvider' => $CategoryOfItemsDataProvider,
                    'WeddingEvents' => $WeddingEvents,
                    'WeddingTentativePeriods' => $WeddingTentativePeriods,
                   
                    'CouplePartnerModel' => $CouplePartnerModel,
                    'dataProviderItems' => $dataProviderItems,
                    'dataProviderSuplliers' => $dataProviderSuplliers,
                 
                    'dataSupplier' => $dataSupplier,
                   
                    'Supplier' => $Supplier,
                    'WeddingModel' => $WeddingModel,
                    'LocationID' =>$LocationID,
                    'SupplierTypeID' => $SupplierTypeID,
                    'SupplierID' => $SupplierID,
                    'minprice' => $minprice,
                    'maxprice' => $maxprice,
                    'searchterms' => $searchterms,
                    'Reg'=>$Reg,
                    'dataFeaturedProviderItems'=>$dataFeaturedProviderItems,
                    'ProductValue'=>$ProductValue,
                  
//            'dataProvider1' => $dataProvider1,
        ]);
//         return ['suss'=>'test'];
    }
    public function actionItembyproductid() {
//        $session = Yii::$app->session;
//        session_start();
//        $searchModel = new StatusSearch();
//         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$sorting='ASC';
        
        if (Yii::$app->request != null && Yii::$app->request->get('sorting') != null) {
            $sorting = Yii::$app->request->get('sorting');
        }
       $cookies = Yii::$app->response->cookies;
       
         $cookies->remove('sortingg');
         unset($cookies['sortingg']);
       $cookies->add(new \yii\web\Cookie([
                'name' => 'sortingg',
                'value' => $sorting,
            ]));
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
        $SubCategoryID = "";
        if (Yii::$app->request != null && Yii::$app->request->get('SubCategoryID') != null) {
            $SubCategoryID = Yii::$app->request->get('SubCategoryID');
        }
        $minprice = '';
        if (Yii::$app->request != null && Yii::$app->request->get('min-price') != null && Yii::$app->request->get('min-price') != '') {
            $minprice = Yii::$app->request->get('min-price');
        }
        $maxprice = '';
        if (Yii::$app->request != null && Yii::$app->request->get('max-price') != null && Yii::$app->request->get('max-price') != '') {
            $maxprice = Yii::$app->request->get('max-price');
        }
        

        $CouplePartnerID = 0;
        $WeddingID = 0;

        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }
        $dataProviderSuplliers = new ActiveDataProvider([
            'query' => Suppliers::find(),
        ]);
        $dataProviderItems = null;
        if ($productID != 0 && $LocationID==0 && $SupplierID==0 && $SupplierTypeID==0) {
            
            
         if($SubCategoryID!=0){
               $dataProviderItems = new ActiveDataProvider([
                'query' => Products::find()->where(['PRODUCT_ID' => $productID,'SUB_CATEGORY_ID'=>$SubCategoryID])->orderBy(['cast(items_supplieirs.PRICE as unsigned)'=>SORT_DESC]),
                
            ]); 
            }else{
               $dataProviderItems = new ActiveDataProvider([
                'query' => Products::find()->where(['PRODUCT_ID' => $productID])->orderBy(['cast(items_supplieirs.PRICE as unsigned)'=>SORT_DESC]),
                
            ]); 
            }

//    $dataProvider->sort->attributes['ItemName'] = [
//        'asc' => ['items_trans.ITEM_NAME' => SORT_ASC],
//        'desc' => ['items_trans.ITEM_NAME' => SORT_DESC]
//    ];
//     $dataProvider->sort->attributes['counter'] = [
//        'asc' => ['NumberCounter' => SORT_ASC],
//        'desc' => ['NumberCounter' => SORT_DESC]
//    ];
//            
//            $dataProviderItems = new ActiveDataProvider([
//                'query' => Products::find()->where(['PRODUCT_ID' => $productID]),
//                
//            ]);
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
//                    $dataProviderItems = new ActiveDataProvider([
////            'query' => Suppliers::find()->where($Cond),
//                        'query' => Products::find()->innerJoin('products_trans', 'products_trans.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items', 'items.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items_supplieirs', 'items.ITEM_ID=items_supplieirs.ITEM_ID')->innerJoin('suppliers', 'items_supplieirs.SUPPLIER_ID=suppliers.SUPPLIER_ID')->innerJoin('items_trans', 'items_trans.ITEM_ID=items.ITEM_ID')->where($Cond)->andWhere('(products_trans.PRODUCT_NAME LIKE \'%'.$searchterms.'%\' OR suppliers.SUPPLIER_NAME LIKE \'%'.$searchterms.'%\' )'),
//                    ]);
                 $query = Products::find()->select([
                    'products.PRODUCT_ID',
                    'items_supplieirs.ITEM_SUPPLIER_ID',
                    'items_supplieirs.PRICE'
                    ])->innerJoin('products_trans', 'products_trans.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items', 'items.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items_supplieirs', 'items.ITEM_ID=items_supplieirs.ITEM_ID')->innerJoin('suppliers', 'items_supplieirs.SUPPLIER_ID=suppliers.SUPPLIER_ID')->innerJoin('items_trans', 'items_trans.ITEM_ID=items.ITEM_ID')->where($Cond)->andWhere('(products_trans.PRODUCT_NAME LIKE \'%'.$searchterms.'%\' OR suppliers.SUPPLIER_NAME LIKE \'%'.$searchterms.'%\' )');

    $dataProviderItems = new ActiveDataProvider([
        'query' => $query,
       
        'pagination' => false,
    ]);
                
                
            } else {
                $dataProviderItems = new ActiveDataProvider([
//            'query' => Suppliers::find()->where($Cond),
                        'query' => Products::find()->innerJoin('products_trans', 'products_trans.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items', 'items.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items_supplieirs', 'items.ITEM_ID=items_supplieirs.ITEM_ID')->innerJoin('suppliers', 'items_supplieirs.SUPPLIER_ID=suppliers.SUPPLIER_ID')->innerJoin('items_trans', 'items_trans.ITEM_ID=items.ITEM_ID')->where('(products_trans.PRODUCT_NAME LIKE \'%'.$searchterms.'%\' OR suppliers.SUPPLIER_NAME LIKE \'%'.$searchterms.'%\' )'),
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
//        $TransModel=  \app\models\AgendaPeriodeTranslation();
//        $TransModel->
        $CouplePartnerModel = new \app\models\CouplePartner();
        $WeddingEvents = new \app\models\WeddingEvent();
        $WeddingTentativePeriods = new \app\models\WeddingTentativePeriodes();

        $CategoryOfItemss = new CategoryOfItems();
        $CategoryOfItemsDataProvider = new ActiveDataProvider([
            'query' => CategoryOfItems::find()->where(['CATEGORY_FLAG' => 'C']),
            'sort' => [
                'defaultOrder' => [
            'CATEGORY_PRIORITY' => SORT_ASC,
                 
        ]
    ],
            'pagination' =>false,
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
        return $this->render('index', [
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
                    'LocationID' =>$LocationID,
                    'SupplierTypeID' => $SupplierTypeID,
                    'SupplierID' => $SupplierID,
                    'minprice' => $minprice,
                    'maxprice' => $maxprice,
                    'searchterms' => $searchterms,
                    'Reg'=>$Reg,
//            'dataProvider1' => $dataProvider1,
        ]);
//         return ['suss'=>'test'];
    }

     public function actionItemsorting() {
 
//        $session = Yii::$app->session;
//        session_start();
//        $searchModel = new StatusSearch();
//         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$sorting='ASC';
        
        if (Yii::$app->request != null && Yii::$app->request->get('sorting') != null) {
            $sorting = Yii::$app->request->get('sorting');
        }
        $SortingBy='Price';
        if (Yii::$app->request != null && Yii::$app->request->get('sortingby') != null) {
            $SortingBy = Yii::$app->request->get('sortingby');
        }
        
       $cookies = Yii::$app->response->cookies;
       
         $cookies->remove('PriceSorting');
         $cookies->remove('supplierName');
         $cookies->remove('sortingDate');
         unset($cookies['PriceSorting']);
         unset($cookies['supplierName']);
         unset($cookies['sortingDate']);
         if($SortingBy=='Price'){
       $cookies->add(new \yii\web\Cookie([
                'name' => 'PriceSorting',
                'value' => $sorting,
            ]));
         }
         
         if($SortingBy=='Date'){
       $cookies->add(new \yii\web\Cookie([
                'name' => 'sortingDate',
                'value' => $sorting,
            ]));
         }
         if($SortingBy=='Name'){
       $cookies->add(new \yii\web\Cookie([
                'name' => 'supplierName',
                'value' => $sorting,
            ]));
         }
       
       
        $SubCategoryID = 0;
        if (Yii::$app->request != null && Yii::$app->request->get('SubCategoryID') != null && Yii::$app->request->get('SubCategoryID') != '') {
            $SubCategoryID = Yii::$app->request->get('SubCategoryID');
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
        if (Yii::$app->request != null && Yii::$app->request->get('SupplierType') != null && Yii::$app->request->get('SupplierType') != '') {
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
        $dataFeaturedProviderItems=null;
        $ProductValue="";
        if(strpos($productID, '(')!==false){
            $ProductValue=$productID;
            if($ProductValue!="()"){
             Yii::error("Index ProductValue :  ".$ProductValue);
      $dataFeaturedProviderItems = new ActiveDataProvider([
                'query' => Products::find()->innerJoin('products_trans', 'products_trans.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items', 'items.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items_supplieirs II', 'items.ITEM_ID=II.ITEM_ID')->innerJoin('suppliers', 'II.SUPPLIER_ID=suppliers.SUPPLIER_ID')->innerJoin('items_trans', 'items_trans.ITEM_ID=items.ITEM_ID')->where(' products.PRODUCT_ID IN '.$productID.''),
                    'pagination' =>false,
  
            ]);   
       }
        }else{
        Yii::error("Index Controller productID : " . $productID);
        Yii::error("Index Controller productID : " . $LocationID);
        Yii::error("Index Controller productID : " . $SupplierID);
        Yii::error("Index Controller productID : " . $SupplierTypeID);
        if ($productID != 0 && $LocationID==0 && $SupplierID==0 && $SupplierTypeID==0) {
        Yii::error("Index Controller SubCategoryID : " . $SubCategoryID);
            if($SubCategoryID!=0){
               $dataProviderItems = new ActiveDataProvider([
                'query' => Products::find()->where(['PRODUCT_ID' => $productID,'SUB_CATEGORY_ID'=>$SubCategoryID]),
                
            ]); 
            }else{
               $dataProviderItems = new ActiveDataProvider([
                'query' => Products::find()->where(['PRODUCT_ID' => $productID]),
                
            ]); 
            }
            
            
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
            if ($SubCategoryID != 0) {
                $Cond['products.SUB_CATEGORY_ID'] = $SubCategoryID;
            }
            
//            searchterms='+searchterms+'&minprice='+minprice+'&maxprice='+maxprice

            if (($Cond != null && $Cond != '' && sizeof($Cond > 0))) {
                

//                    $Cond['items_trans.ITEM_NAME'] = '%' . $searchterms . '%';
//                    Yii::error("Index Controller productID helloooo   : " . $Cond['items_supplieirs.SUPPLIER_ID']);
                    $dataProviderItems = new ActiveDataProvider([
//            'query' => Suppliers::find()->where($Cond),
                        'query' => Products::find()->innerJoin('products_trans', 'products_trans.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items', 'items.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items_supplieirs', 'items.ITEM_ID=items_supplieirs.ITEM_ID')->innerJoin('suppliers', 'items_supplieirs.SUPPLIER_ID=suppliers.SUPPLIER_ID')->innerJoin('items_trans', 'items_trans.ITEM_ID=items.ITEM_ID')->where($Cond)->andWhere('(products_trans.PRODUCT_NAME LIKE \'%'.$searchterms.'%\' OR suppliers.SUPPLIER_NAME LIKE \'%'.$searchterms.'%\' )'),
                    ]);
                
                
                
            } 
            else {
         
                if ($SubCategoryID != 0) {
                $dataProviderItems = new ActiveDataProvider([

                    'query' => Products::find()->innerJoin('products_trans', 'products_trans.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items', 'items.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items_supplieirs II', 'items.ITEM_ID=II.ITEM_ID')->innerJoin('suppliers', 'II.SUPPLIER_ID=suppliers.SUPPLIER_ID')->innerJoin('items_trans', 'items_trans.ITEM_ID=items.ITEM_ID')->where($Cond)->andWhere('  (products_trans.PRODUCT_NAME LIKE \'%'.$searchterms.'%\' OR suppliers.SUPPLIER_NAME LIKE \'%'.$searchterms.'%\' ) AND products.SUB_CATEGORY_ID='.$SubCategoryID),
                    'pagination' =>false,
  
                    ]);
            }else{
              $dataProviderItems = new ActiveDataProvider([

                    'query' => Products::find()->innerJoin('products_trans', 'products_trans.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items', 'items.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items_supplieirs II', 'items.ITEM_ID=II.ITEM_ID')->innerJoin('suppliers', 'II.SUPPLIER_ID=suppliers.SUPPLIER_ID')->innerJoin('items_trans', 'items_trans.ITEM_ID=items.ITEM_ID')->where($Cond)->andWhere('(products_trans.PRODUCT_NAME LIKE \'%'.$searchterms.'%\' OR suppliers.SUPPLIER_NAME LIKE \'%'.$searchterms.'%\' )'),
                    'pagination' =>false,
  
                    ]);  
            }
                
                
            }
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
//        $TransModel=  \app\models\AgendaPeriodeTranslation();
//        $TransModel->
        $CouplePartnerModel = new \app\models\CouplePartner();
        $WeddingEvents = new \app\models\WeddingEvent();
        $WeddingTentativePeriods = new \app\models\WeddingTentativePeriodes();

        $CategoryOfItemss = new CategoryOfItems();
        $CategoryOfItemsDataProvider = new ActiveDataProvider([
            'query' => CategoryOfItems::find()->where(['CATEGORY_FLAG' => 'C']),
            'sort' => [
                'defaultOrder' => [
            'CATEGORY_PRIORITY' => SORT_ASC,
                 
        ]
    ],
            'pagination' =>false,
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        



        
        
//Yii::$app->response->format = Response::FORMAT_JSON;
        return $this->renderAjax('_forsorting', [
                    
                    'CategoryOfItems' => $CategoryOfItemss,
                    'CategoryOfItemsDataProvider' => $CategoryOfItemsDataProvider,
                    'WeddingEvents' => $WeddingEvents,
                    'WeddingTentativePeriods' => $WeddingTentativePeriods,
                    
                    'CouplePartnerModel' => $CouplePartnerModel,
                    'dataProviderItems' => $dataProviderItems,
                    'dataProviderSuplliers' => $dataProviderSuplliers,
                  
                    'WeddingModel' => $WeddingModel,
                    'LocationID' =>$LocationID,
                    'SupplierTypeID' => $SupplierTypeID,
                    'SupplierID' => $SupplierID,
                    'minprice' => $minprice,
                    'maxprice' => $maxprice,
                    'searchterms' => $searchterms,
                    'Reg'=>$Reg,
                    'dataFeaturedProviderItems'=>$dataFeaturedProviderItems,
                    'ProductValue'=>$ProductValue,
                  
//            'dataProvider1' => $dataProvider1,
        ]);

    }
//    url: '/yiiApp/basic/web/index.php?r=category-of-items%2Fgenerate-coupon',
//            type: 'GET',
////           dataType: 'json',
////           contentType: 'application/json; charset=utf-8',
//            data: 'ItemID='$ItemSuppliers->ITEM_SUPPLIER_ID'&OptionID='$OptionIDD',
   public function actionGenerateCoupon(){
       
       $CouplePartnerID = 0;
        $WeddingID = 0;

        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }
        Yii::error("Index Controller ");
if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
     $ItemID = 0;
        if (Yii::$app->request != null && Yii::$app->request->get('ItemID') != null && Yii::$app->request->get('ItemID') != '') {
            $ItemID = Yii::$app->request->get('ItemID');
        } 
        $OptionID = 0;
        if (Yii::$app->request != null && Yii::$app->request->get('OptionID') != null && Yii::$app->request->get('OptionID') != '') {
            $OptionID = Yii::$app->request->get('OptionID');
        } 
        $dataItemSupplier = new ActiveDataProvider([
            'query' => \app\models\ItemsSupplieirs::find()->where('ITEM_SUPPLIER_ID = '.$ItemID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        if($dataItemSupplier!=null ){
            $dataItemSupplier=$dataItemSupplier->getModels();
        }
      
//       
        if($dataItemSupplier!=null && sizeof($dataItemSupplier)>0 && $WeddingID!=0){
           $ProductID =$dataItemSupplier[0]->iTEM->pRODUCT->PRODUCT_ID;
            $dataCounter = new ActiveDataProvider([
            'query' => \app\models\CouponCounter::find()->where('WEDDING_ID = '.$WeddingID .' AND PRODUCT_ID='.$ProductID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        if($dataCounter!=null ){
            $dataCounter=$dataCounter->getModels();
        }
        
        $dataCoupon = new ActiveDataProvider([
            'query' => \app\models\Coupons::find()->where('ITEM_ID = '.$ItemID .' AND OPTION_ID='.$OptionID.' AND WEDDING_ID = '.$WeddingID.' AND COUPON_FLAG = \'Y\' '),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        if($dataCoupon!=null ){
            $dataCoupon=$dataCoupon->getModels();
        }
        $Counter=0;
        if($dataCounter!=null){
           $Counter=$dataCounter[0]->COUPON_COUNTER_NUMBER; 
        }
        if($dataCoupon==null ){
        if($Counter<4){
            $SupplierID=$dataItemSupplier[0]->SUPPLIER_ID;
            $Description = $dataItemSupplier[0]->itemOptions[0]->itemOptionTrans[0]->OPTION_DESC;
            $Time=time();
            $date = date("Y-m-d H:i:s",$Time);
            $ExpireTime=time();
            $Expiredate = date("Y-m-d H:i:s",strtotime('+30 days',$ExpireTime));
         $Coupon=new \app\models\Coupons();  
         $Coupon->ITEM_ID=$ItemID;
         $Coupon->OPTION_ID= $OptionID;
         $Coupon->SUPPLIER_ID=$SupplierID;
         $Coupon->WEDDING_ID=$WeddingID;
         $Coupon->COUPON_GENERATED_DATE=$date;
         $Coupon->EXPIRED_DATE=$Expiredate;
         $Coupon->COUPON_FLAG='N';
         if($Coupon->save(false)){
             
             $where = \app\models\CouponCounter::find()->where('PRODUCT_ID = '.$ProductID.' AND WEDDING_ID='.$WeddingID)->one();
             if($where!=null){
              $where->COUPON_COUNTER_NUMBER =$Counter+1;  
              $where->save(false);
              Yii::$app->response->format = Response::FORMAT_JSON;
        return ['success' =>true];
             }else{
               $CouponCounter=new \app\models\CouponCounter();  
               $CouponCounter->COUPON_COUNTER_NUMBER =$Counter+1; 
               $CouponCounter->PRODUCT_ID=$ProductID;
             $CouponCounter->WEDDING_ID=$WeddingID;
             $CouponCounter->save(false);
             Yii::$app->response->format = Response::FORMAT_JSON;
        return ['success' =>true];
             }
             
              
        }
        }else{
          Yii::$app->response->format = Response::FORMAT_JSON;
        return ['msg' =>'number of coupon is more than 3'];  
        }
        }else{
          Yii::$app->response->format = Response::FORMAT_JSON;
        return ['msg' =>'you have already select this coupon'];    
        }
       
       
   }
   }
                        
   
   public function actionSubCategories(){
      $CouplePartnerModel = new \app\models\CouplePartner();
               $cr='i';
        if (Yii::$app->request != null && Yii::$app->request->get('cr') != null) {
            $cr = Yii::$app->request->get('cr');
        }
       $LangCode=Yii::$app->language;
      $LangModel= \app\models\Languages::find()->where(['LANGUAGE_NAME' =>$LangCode])->one();
      $LanguageID=1;
      if($LangModel!=null){
        $LanguageID=  $LangModel->LANGUAGE_ID;
      }
      Yii::$app->view->params['SelectedLan'] = $LanguageID;
        $dataSubCategoriesOfItems = new ActiveDataProvider([
            'query' => \app\models\SubCategoriesTrans::find()
                ->innerJoin('sub_categories_of_items',' sub_categories_trans.SUB_CATEGORY_ID=sub_categories_of_items.SUB_CATEGORY_ID')
                ->innerJoin('category_of_items',' category_of_items.CATEGORY_OF_ITEM_ID=sub_categories_of_items.CATEGORY_OF_ITEM_ID ')
                ->where('category_of_items.CATEGORY_FLAG = \'C\' AND sub_categories_trans.SHOW_HIDE_FLAG = \'Y\'  AND LANGUAGE_ID = '.Yii::$app->view->params['SelectedLan'] )
                ->orderBy($cr=='a'?'sub_categories_trans.SUB_CATEGORY_NAME ASC':'sub_categories_of_items.SUB_CATEGORY_IMPORTANCE ASC'),
            'pagination' =>false,
        ]);

        if (isset($dataSubCategoriesOfItems)) {
            $dataSubCategoriesOfItems = $dataSubCategoriesOfItems->getModels();
        }
        
      return $this->renderAjax('_subcategories', [
                               'SubCategory'=>$dataSubCategoriesOfItems, 
                                'CouplePartnerModel'=>$CouplePartnerModel,
                                ]);
   }
   
        }
