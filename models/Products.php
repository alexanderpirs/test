<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "products".
 *
 * @property integer $PRODUCT_ID
 * @property string $PRODUCT_NAME
 * @property integer $SUB_CATEGORY_ID
 * @property integer $LANGUAGE_ID
 * @property integer $ECOM_PRODUCT_ID
 * @property integer $CATEGORY_ID
 * @property integer $WEDDING_ID 
 *
 * @property Items[] $items
 * @property ProductSupplierTye[] $productSupplierTyes
 * @property ProductWeddingType[] $productWeddingTypes
 * @property CategoryOfItems $cATEGORY
 * @property SubCategoriesOfItems $sUBCATEGORY
 * @property Languages $lANGUAGE
 * @property Weddings $wEDDING 
 * @property WedProductEstimation[] $wedProductEstimations 
 * @property ProductsCountries[] $productsCountries
 * @property ProductsTrans[] $productsTrans
 * @property WeddingRealBudget[] $weddingRealBudgets
 */
class Products extends \yii\db\ActiveRecord
{
    
    public $price;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SUB_CATEGORY_ID', 'LANGUAGE_ID', 'ECOM_PRODUCT_ID', 'CATEGORY_ID','WEDDING_ID'], 'integer'],
            [['price'], 'safe'],
            [['PRODUCT_NAME'], 'string', 'max' => 30],
            [['CATEGORY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryOfItems::className(), 'targetAttribute' => ['CATEGORY_ID' => 'CATEGORY_OF_ITEM_ID']],
            [['SUB_CATEGORY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SubCategoriesOfItems::className(), 'targetAttribute' => ['SUB_CATEGORY_ID' => 'SUB_CATEGORY_ID']],
            [['LANGUAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['LANGUAGE_ID' => 'LANGUAGE_ID']],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']], 
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PRODUCT_ID' => Yii::t('app', 'Product  ID'),
            'PRODUCT_NAME' => Yii::t('app', 'Product  Name'),
            'SUB_CATEGORY_ID' => Yii::t('app', 'Sub  Category  ID'),
            'LANGUAGE_ID' => Yii::t('app', 'Language  ID'),
            'ECOM_PRODUCT_ID' => Yii::t('app', 'Ecom  Product  ID'),
            'CATEGORY_ID' => Yii::t('app', 'Category  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        
        $cookies = Yii::$app->response->cookies;
       
      $sortMethod= $cookies->getValue('PriceSorting', '0');
      $SupplierName= $cookies->getValue('supplierName', '0');
      $SortingDate= $cookies->getValue('sortingDate', '0');
      
      
       
      
      
//       if($sortMethod=='ASC'){
//           Yii::error("SESSION['sortMethod'] : " . $sortMethod);
//           return $this->hasMany(ItemsSupplieirs::className(), ['ITEM_ID' => 'ITEM_ID'])->orderBy(['items_supplieirs.CURRENCY_ID'=>SORT_ASC]); 
//       }else{
           Yii::error("SESSION['sortMethod'] : " . $sortMethod);
      Yii::error("SESSION['SupplierName'] : " . $SupplierName);
      Yii::error("SESSION['SortingDate'] : " . $SortingDate);
      $Value=null;
      if($SortingDate==0 && $SupplierName==0 && $sortMethod==0){
           $Value = $this->hasMany(Items::className(), ['PRODUCT_ID' => 'PRODUCT_ID'])->joinWith('itemsSupplieirs', true, 'INNER JOIN')->addOrderBy(['cast(items_supplieirs.PRICE as signed)'=> SORT_ASC]);
      }
      if($SortingDate!=0){
       if($SortingDate=='DESC'){
         $Value = $this->hasMany(Items::className(), ['PRODUCT_ID' => 'PRODUCT_ID'])->joinWith('itemsSupplieirs', true, 'INNER JOIN')->addOrderBy(['POSTING_DATE'=> SORT_DESC]);
       }else{
         $Value = $this->hasMany(Items::className(), ['PRODUCT_ID' => 'PRODUCT_ID'])->joinWith('itemsSupplieirs', true, 'INNER JOIN')->addOrderBy(['POSTING_DATE'=> SORT_ASC]);
          
       }   
      }
      if($SupplierName!=0){
       if($SupplierName=='DESC'){
        $Value = $this->hasMany(Items::className(), ['PRODUCT_ID' => 'PRODUCT_ID'])->joinWith('itemsSupplieirs', true, 'INNER JOIN')->joinWith('suppliers', true, 'INNER JOIN')->addOrderBy(['suppliers.SUPPLIER_NAME'=> SORT_DESC]);
       }else{
        $Value = $this->hasMany(Items::className(), ['PRODUCT_ID' => 'PRODUCT_ID'])->joinWith('itemsSupplieirs', true, 'INNER JOIN')->joinWith('suppliers', true, 'INNER JOIN')->addOrderBy(['suppliers.SUPPLIER_NAME'=> SORT_ASC]);  
       }   
      }
      if($sortMethod=='ASC' || $sortMethod=='DESC'){
          Yii::error("SESSION['sortMethod'] jpouwaaaaaa: " . $sortMethod);
       if($sortMethod=='DESC'){
        $Value = $this->hasMany(Items::className(), ['PRODUCT_ID' => 'PRODUCT_ID'])->joinWith('itemsSupplieirs', true, 'INNER JOIN')->addOrderBy(['cast(items_supplieirs.PRICE as signed)'=> SORT_DESC]);
       }else{
         $Value = $this->hasMany(Items::className(), ['PRODUCT_ID' => 'PRODUCT_ID'])->joinWith('itemsSupplieirs', true, 'INNER JOIN')->addOrderBy(['cast(items_supplieirs.PRICE as signed)'=> SORT_ASC]);
          
      }
      
       }
        return $Value;
       }

    
       public function getWEDDING() 
   { 
       return $this->hasOne(Weddings::className(), ['WEDDING_ID' => 'WEDDING_ID']); 
   } 
 
   
   	   public function getWedProductEstimations() 
   { 
       return $this->hasMany(WedProductEstimation::className(), ['PRODUCT_ID' => 'PRODUCT_ID']); 
   } 
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductSupplierTyes()
    {
        return $this->hasMany(ProductSupplierTye::className(), ['PRODUCT_ID' => 'PRODUCT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductWeddingTypes()
    {
        return $this->hasMany(ProductWeddingType::className(), ['PRODUCT_ID' => 'PRODUCT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCATEGORY()
    {
        return $this->hasOne(CategoryOfItems::className(), ['CATEGORY_OF_ITEM_ID' => 'CATEGORY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSUBCATEGORY()
    {
        return $this->hasOne(SubCategoriesOfItems::className(), ['SUB_CATEGORY_ID' => 'SUB_CATEGORY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLANGUAGE()
    {
        return $this->hasOne(Languages::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsCountries()
    {
        return $this->hasMany(ProductsCountries::className(), ['PRODUCT_ID' => 'PRODUCT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsTrans()
    {
        return $this->hasMany(ProductsTrans::className(), ['PRODUCT_ID' => 'PRODUCT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingRealBudgets()
    {
        return $this->hasMany(WeddingRealBudget::className(), ['PRODUCT_ID' => 'PRODUCT_ID']);
    }
    
    
    public function search(){
        $query = Products::find([
                    'products.PRODUCT_ID',
                    'items_supplieirs.ITEM_SUPPLIER_ID',
                    'items_supplieirs.PRICE'
                    ])->innerJoin('products_trans', 'products_trans.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items', 'items.PRODUCT_ID=products.PRODUCT_ID')->innerJoin('items_supplieirs', 'items.ITEM_ID=items_supplieirs.ITEM_ID')->innerJoin('suppliers', 'items_supplieirs.SUPPLIER_ID=suppliers.SUPPLIER_ID')->innerJoin('items_trans', 'items_trans.ITEM_ID=items.ITEM_ID')->orderBy('cast(items_supplieirs.PRICE as signed) ASC');

    $dataProviderItems = new ActiveDataProvider([
        'query' => $query,
        
//        'sort' => [
//        'defaultOrder' => [
//            'items_supplieirs.PRICE' => SORT_ASC,
//            
//        ]
//    ],
        'pagination' => false,
    ]);
//    $dataProviderItems->setSort([
//        'defaultOrder' => ['items_supplieirs.PRICE'=>SORT_ASC],]);
    return $dataProviderItems;
    }
}
