<?php

namespace app\controllers;
use \app\models\ItemsSupplieirs;
use Yii;
use app\models\AgendaPeriodes;
use \app\models\WeddingTentativePeriodes;
use yii\data\ActiveDataProvider;
use app\models\WeddingEvent;
use app\models\CategoryOfItems;
use \app\models\ItemRatingComment;
use yii\web\Response;
class ItemViewController extends \yii\web\Controller
{
    public function actionIndex()
    {
         $ItemID = 0;
        if (Yii::$app->request != null && Yii::$app->request->get('productID') != null) {
            $ItemID = Yii::$app->request->get('productID');
        }
        $session = Yii::$app->session;
$Reg = "C";
if (isset($session['Reg'])) {
    $Reg = $session['Reg'];
}
        

        $CouplePartnerID = 0;
        $WeddingID = 0;

        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }

        $dataProviderItems = new ActiveDataProvider([
            'query' => ItemsSupplieirs::find()->where(['ITEM_SUPPLIER_ID' => $ItemID]),
        ]);
        
        $ItemInfo=null;
        if($dataProviderItems!=null){
            $ItemInfo=$dataProviderItems->getModels();
        }
if($ItemInfo!=null && sizeof($ItemInfo)>0){
$ItemViewNumber=new \app\models\ItemViewNumber();
$ItemViewNumber->ITEM_SUPPLIER_ID=$ItemID;
$Time=time();
$date = date("Y-m-d H:i:s",$Time);
$ItemViewNumber->VIEW_DATE=$date;
$ItemViewNumber->SUPPLIER_ID=$ItemInfo[0]->SUPPLIER_ID;   
if($CouplePartnerID!=null){
  $ItemViewNumber->COUPLE_PARTNER_ID=$CouplePartnerID; 
    }
$ItemViewNumber->save();
}

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
            'query' => CategoryOfItems::find()->where(['CATEGORY_FLAG' => $Reg]),
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
        $dataProviderFeaturedItems = new ActiveDataProvider([
            'query' => ItemsSupplieirs::find()->where('ITEM_SUPPLIER_ID =' . $ItemID ),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
        if($dataProviderFeaturedItems!=null){
            $dataProviderFeaturedItems=$dataProviderFeaturedItems->getModels();
             Yii::error("Index : ".$ItemID);
        }
        $Supplier = new \app\models\Suppliers();
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
                    'WeddingModel' => $WeddingModel,
                    'dataProviderFeaturedItems'=>$dataProviderFeaturedItems,
                    'Reg'=>$Reg,
                    
//                    'Supplier' => $Supplier,
//            'dataProvider1' => $dataProvider1,
        ]);
    }
public function actionOptionValues(){
    $Criterias = "";
        if (Yii::$app->request != null && Yii::$app->request->get('SelectedCrite') != null) {
            $Criterias = Yii::$app->request->get('SelectedCrite');
        }
    $ItemID  =0;  
        if (Yii::$app->request != null && Yii::$app->request->get('ItemID') != null) {
            $ItemID = Yii::$app->request->get('ItemID');
        }
        $Reg = "C";
if (isset($session['Reg'])) {
    $Reg = $session['Reg'];
}
       
Yii::error('$ItemID : '.$ItemID);
        $dataProviderOption = new ActiveDataProvider([
            'query' => \app\models\ItemOptions::find()->where(['ITEM_SUPPLIER_ID' => $ItemID,'CRITERIAS_VALUES' =>$Criterias]),
        ]);
        $ItemOptionModel=null;
        if(isset($dataProviderOption)){
           $ItemOptionModel= $dataProviderOption->getModels();
        }
        $OptionID=0;
        if($ItemOptionModel!=null && sizeof($ItemOptionModel)>0){
           $OptionID=$ItemOptionModel[0]->OPTION_ID;
           
           $PriceForm="";
               if ($ItemOptionModel[0]->DISCOUNT != null) {
                            $PriceForm='<span class="old-price"><del>'. number_format($ItemOptionModel[0]->OPTION_PRICE != null ? $ItemOptionModel[0]->OPTION_PRICE : "") . ' ' . ($ItemOptionModel[0]->OPTION_PRICE!=null? $ItemOptionModel[0]->cURRENCY->CURRENCY_CODE : "").'</del></span>
                            <span class="new-price">'. number_format(($ItemOptionModel[0]->OPTION_PRICE - ($ItemOptionModel[0]->OPTION_PRICE * $ItemOptionModel[0]->DISCOUNT) / 100)) . ' ' . $ItemOptionModel[0]->cURRENCY->CURRENCY_CODE .'</span>';
   } else { 

                           $PriceForm=' <span class="old-price">'. number_format($ItemOptionModel[0]->OPTION_PRICE!=null ? $ItemOptionModel[0]->OPTION_PRICE : "") . ' ' . ($ItemOptionModel[0]->OPTION_PRICE != null  ? $ItemOptionModel[0]->cURRENCY->CURRENCY_CODE : "").'</span>';

     }
           $optionCurSymb=$ItemOptionModel[0]->OPTION_PRICE!=null ?$ItemOptionModel[0]->cURRENCY->CURRENCY_CODE:"USDD";
           $ItemOptionDesc=$ItemOptionModel[0]->itemOptionTrans!=null && sizeof($ItemOptionModel[0]->itemOptionTrans)>0?$ItemOptionModel[0]->itemOptionTrans[0]->OPTION_DESC:"";
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'OptionID' =>$OptionID,
                'PriceForm' =>$PriceForm,
                'OptionCurSymb' =>$optionCurSymb,
                'ItemOptionDesc' =>$ItemOptionDesc,
                    ]; 
        }
//       Yii::error('sizeof($dataProviderOption->getModels()) '.sizeof($dataProviderOption->getModels()));
       
      
}

public function actionNewComment(){
    $Comment = "";
        if (Yii::$app->request != null && Yii::$app->request->get('NewReview') != null) {
            $Comment = Yii::$app->request->get('NewReview');
        }
        $ItemID = "";
        if (Yii::$app->request != null && Yii::$app->request->get('ItemID') != null) {
            $ItemID = Yii::$app->request->get('ItemID');
        }
        Yii::error("Index Controller ");
        $CouplePartnerID = 0;
        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }
        $ItemRatingCommentModel=new ItemRatingComment();
        $PrimaryKey=0;
        if($Comment!="" && $CouplePartnerID!=0){
           $ItemRatingCommentModel->COUPLE_PARTNER_ID =$CouplePartnerID;
           $ItemRatingCommentModel->ITEM_COMMENT=$Comment;
           $ItemRatingCommentModel->ITEM_SUPPLIER_ID=$ItemID;
           if($ItemRatingCommentModel->save(false)){
           $PrimaryKey = $ItemRatingCommentModel->getPrimaryKey();
           }
        }
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['success' =>$PrimaryKey];
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
public function GetCriteriaIDAndValueByCriteriaValueID($CritiriaValueID) {
        $dataCriteriaValues = new ActiveDataProvider([
            'query' => \app\models\CriteriaValues::find()->where('CRITERIA_VALUE_ID = '.$CritiriaValueID),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);

        if (isset($dataCriteriaValues)) {
            $dataCriteriaValues = $dataCriteriaValues->getModels();
        }
        return $dataCriteriaValues;
    }
    
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
        Yii::error("Index Controller ".$ItemID);
        Yii::error("Index Controller ".$OptionID);
        Yii::error("Index Controller ".$WeddingID);
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
          Yii::error("Index Controller 1 ");
        if($dataCoupon==null ){
            Yii::error("Index Controller 1 ");
        if($Counter<4){
            Yii::error("Index Controller 2 ");
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
}
