<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\base\Model;
/**
 * This is the model class for table "items_supplieirs".
 *
 * @property integer $ITEM_ID
 * @property integer $SUPPLIER_ID
 * @property integer $ITEM_SUPPLIER_ID
 * @property string $PRICE
 * @property integer $CURRENCY_ID
 * @property string $COMMISSION
 * @property string $COMMISSION_FLAG
 * @property string $DISCOUNT
 * @property string $POSTING_DATE 
 * @property string $FEATURE_FLAG 
 * 
 * @property CriteriaValues[] $criteriaValues
 * @property ItemOptions[] $itemOptions
 * @property Coupons[] $coupons 
 * @property ItemRatingComment[] $itemRatingComments
 * @property ItemSupplierTranslation[] $itemSupplierTranslations
 * @property ItemsImgs[] $itemsImgs
 * @property Items $iTEM
 * @property Suppliers $sUPPLIER
 * @property ItemViewNumber[] $itemViewNumbers 
 * @property Currencies $cURRENCY
 * @property PackageDescriptions[] $packageDescriptions 
 * @property RegistrySelectedItems[] $registrySelectedItems 
 * @property Transactions[] $transactions 
 */
class ItemsSupplieirs extends \yii\db\ActiveRecord
{
    
    public $PRODUCT_ID;
    public $CATEGORY_ID;
    public $SUB_CATEGORY;
    public $ItemName;
    public $price;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'items_supplieirs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ItemName','PRICE','price'], 'safe'],
            [['CURRENCY_ID','PRICE'], 'required'],
            
            [['ITEM_ID', 'SUPPLIER_ID', 'CURRENCY_ID','PRICE','ITEM_SUPPLIER_ID'], 'integer'],
            [['PRICE', 'COMMISSION'], 'string', 'max' => 45],
            [['COMMISSION_FLAG'], 'string', 'max' => 1],
            [['DISCOUNT'], 'string', 'max' => 2],
            [['ITEM_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['ITEM_ID' => 'ITEM_ID']],
            [['SUPPLIER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Suppliers::className(), 'targetAttribute' => ['SUPPLIER_ID' => 'SUPPLIER_ID']],
            [['CURRENCY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Currencies::className(), 'targetAttribute' => ['CURRENCY_ID' => 'CURRENCY_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ITEM_ID' => Yii::t('app', 'Item  ID'),
            'SUPPLIER_ID' => Yii::t('app', 'Supplier  ID'),
            'ITEM_SUPPLIER_ID' => Yii::t('app', 'Item  Supplier  ID'),
            'PRICE' => Yii::t('app', 'Price'),
            'CURRENCY_ID' => Yii::t('app', 'Currency  ID'),
            'COMMISSION' => Yii::t('app', 'Commission'),
            'COMMISSION_FLAG' => Yii::t('app', 'Commission  Flag'),
            'DISCOUNT' => Yii::t('app', 'Discount'),
            'PRODUCT_ID' => Yii::t('app', 'Products'),   
            'ItemName' =>Yii::t('app', 'Item Name'),   
        ];
    }

    
    
    	 
   /** 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getCoupons() 
   { 
       return $this->hasMany(Coupons::className(), ['ITEM_ID' => 'ITEM_SUPPLIER_ID']); 
   }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCriteriaValues()
    {
        return $this->hasMany(CriteriaValues::className(), ['ITEM_SUPPLIER_ID' => 'ITEM_SUPPLIER_ID']);
    }

    	   public function getItemViewNumbers() 
   { 
       return $this->hasMany(ItemViewNumber::className(), ['ITEM_SUPPLIER_ID' => 'ITEM_SUPPLIER_ID']); 
   } 
 

   /** 
    * @return \yii\db\ActiveQuery 
    */ 
    
    
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemOptions()
    {
        return $this->hasMany(ItemOptions::className(), ['ITEM_SUPPLIER_ID' => 'ITEM_SUPPLIER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemRatingComments()
    {
        return $this->hasMany(ItemRatingComment::className(), ['ITEM_SUPPLIER_ID' => 'ITEM_SUPPLIER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemSupplierTranslations()
    {
        return $this->hasMany(ItemSupplierTranslation::className(), ['ITEM_SUPPLIER_ID' => 'ITEM_SUPPLIER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsImgs()
    {
        return $this->hasMany(ItemsImgs::className(), ['ITEM_SUPPLIER_ID' => 'ITEM_SUPPLIER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getITEM()
    {
        return $this->hasOne(Items::className(), ['ITEM_ID' => 'ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSUPPLIER()
    {
        return $this->hasOne(Suppliers::className(), ['SUPPLIER_ID' => 'SUPPLIER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCURRENCY()
    {
        return $this->hasOne(Currencies::className(), ['CURRENCY_ID' => 'CURRENCY_ID']);
    }
    
     /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    
    public function search($params)
{               
    $query = ItemsSupplieirs::find()
         ->innerJoin('items','items.ITEM_ID=items_supplieirs.ITEM_ID')->innerJoin('items_trans','items.ITEM_ID=items_trans.ITEM_ID');

    $this->load($params);                                                               



    if(!empty($this->ItemName)){
        Yii::error("this->ItemName : " .$this->ItemName);
        $query->filterWhere(['like','items_trans.ITEM_NAME',$this->ItemName]);
                
    }

    $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' => false,
    ]);

    $dataProvider->sort->attributes['ItemName'] = [
        'asc' => ['items_trans.ITEM_NAME' => SORT_ASC],
        'desc' => ['items_trans.ITEM_NAME' => SORT_DESC]
    ];



    return $dataProvider;
}




//    public function search($params)
//    {
//        $query = ItemsSupplieirs::find()
//         ->joinWith('items','items_trans');
//                
//        // add conditions that should always apply here
//        $query->where('PRICE LIKE '. $this->PRICE);
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//            'sort' => ['attributes' => ['ItemName']]
//        ]);
//        $dataProvider->sort->attributes['ItemName'] = [
//            'asc' => ['ItemName' => SORT_ASC],
//            'desc' => ['ItemName' => SORT_DESC],
//            'label' => $this->getAttributeLabel('ItemName'),
//        ];
//        $this->load($params);
////
////        if (!$this->validate()) {
////            // uncomment the following line if you do not want to return any records when validation fails
////            // $query->where('0=1');
////            return $dataProvider;
////        }
//
//        // grid filtering conditions
//       
////        $query->andFilterWhere([
////            'ITEM_ID' => $this->ITEM_ID,
////            'SUPPLIER_ID' => $this->SUPPLIER_ID,
////            'ITEM_SUPPLIER_ID' => $this->ITEM_SUPPLIER_ID,
////            'CURRENCY_ID' => $this->CURRENCY_ID,
////            'items_trans.LANGUAGE_ID' => '1',
////        ]);
//                
////            ->andFilterWhere(['like', 'COMMISSION', $this->COMMISSION])
////            ->andFilterWhere(['like', 'COMMISSION_FLAG', $this->COMMISSION_FLAG])
////            ->andFilterWhere(['like', 'DISCOUNT', $this->DISCOUNT])
////             ->andFilterWhere(['like', 'items_trans.ITEM_NAME', $this->PRICE]);
//Yii::error("this->ItemName" .$this->ItemName);
////        $query
////        ->andFilterWhere(['like', 'DISCOUNT', $this->DISCOUNT]);
////            'items_trans.ITEM_NAME'=>$this->ItemName,
//
////        $models = $dataProvider->getModels();
////        if($models!=null && sizeof($models)>0){
////           Yii::error("sizeof(models) : " .sizeof($models)); 
////        }
//        return $dataProvider;
//    }
}
