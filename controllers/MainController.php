<?php

namespace app\controllers;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Response;
class MainController extends \yii\web\Controller
{
 
    
    public function actionSaveCountryToCookies(){
//     Code   
        
        
        $Code = 0;
        if (Yii::$app->request != null && Yii::$app->request->post('Code') != null) {
            $Code = Yii::$app->request->post('Code');
        }
        
         $CountryID=0;
                      if($Code!='0'){
                         $CountryData = new ActiveDataProvider([
                'query' => \app\models\Countries::find()->where(['COUNTRY_CODE'=>$Code]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
            ]); 
                         if($CountryData!=null ){
                             $CountryData=$CountryData->getModels();
                             if(sizeof($CountryData)>0){
                                 $CountryID=$CountryData[0]->COUNTRY_ID;
                             }
                         }
                      }
        
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
        if($WeddingID !=0){
            $WeddingModel =  \app\models\Weddings::findOne($WeddingID);
            if($WeddingModel!=null){
                $WeddingModel->WEDDING_COUNTRY_ID=$CountryID;
                $WeddingModel->save(false);
            }
        }
        
        $cookies = Yii::$app->response->cookies;
         
        $cookies->remove('countryCode');
        unset($cookies['countryCode']);
        $cookies->add(new \yii\web\Cookie([
                'name' => 'countryCode',
                'value' => $Code,
            ]));
        
         Yii::$app->response->format = Response::FORMAT_JSON;
         return ['success' => 'Y'];
        
    }
   public static function GetAllSubCategories() {
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
        return $dataSubCategoriesOfItems;
    } 
  public static function GetAllCountries() {
      $LangCode=Yii::$app->language;
      $LangModel= \app\models\Languages::find()->where(['LANGUAGE_NAME' =>$LangCode])->one();
      $LanguageID=1;
      if($LangModel!=null){
        $LanguageID=  $LangModel->LANGUAGE_ID;
      }
      Yii::$app->view->params['SelectedLan'] = $LanguageID;
        $dataCountries = new ActiveDataProvider([
            'query' => \app\models\CountriesTrans::find()
                ->where(' LANGUAGE_ID = '.Yii::$app->view->params['SelectedLan'] )->orderBy('COUNTRY_TRANS_NAME ASC'),
            'pagination' =>false,
        ]);

        if (isset($dataCountries)) {
            $dataCountries = $dataCountries->getModels();
        }
        return $dataCountries;
    }
}
