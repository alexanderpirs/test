<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category_of_items".
 *
 * @property integer $CATEGORY_OF_ITEM_ID
 * @property integer $ECOM_CATEGORY_ID
 * @property string $CATEGORY_FLAG
 * @property string $CATEGORY_IMG_PATH 
 * @property string $CATEGORY_PUBLIC
 * @property integer $BUSINESS_TYPE_ID
 * 
 * @property BudgetAvarage[] $budgetAvarages
 * @property CategoriesCountries[] $categoriesCountries
 * @property CategoriesWeddingType[] $categoriesWeddingTypes
 * @property CategoryOfItemCtryWedType[] $categoryOfItemCtryWedTypes
 * @property BusinessType $bUSINESSTYPE
 * @property SubCategoriesOfItems[] $subCategoriesOfItems 
 * @property CategoryOfItemsTrans[] $categoryOfItemsTrans
 * @property CategoryPackageCategory[] $categoryPackageCategories
 * @property Items[] $items
 * @property Products[] $products
 * @property SubCategoriesOfItems[] $subCategoriesOfItems 
 * @property SupplierOfferedServices[] $supplierOfferedServices 
 * @property WedCategoryEstimatedBudget $wedCategoryEstimatedBudget
 * @property WeddingRealBudget[] $weddingRealBudgets
 */
class CategoryOfItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_of_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ECOM_CATEGORY_ID'], 'integer'],
            [['CATEGORY_FLAG'], 'string', 'max' => 1],
            [['CATEGORY_IMG_PATH'], 'string', 'max' => 1000], 
            [['ECOM_CATEGORY_ID', 'BUSINESS_TYPE_ID'], 'integer'],
            [['CATEGORY_FLAG', 'CATEGORY_PUBLIC'], 'string', 'max' => 1],
            [['CATEGORY_IMG_PATH'], 'string', 'max' => 1000],
            [['BUSINESS_TYPE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => BusinessType::className(), 'targetAttribute' => ['BUSINESS_TYPE_ID' => 'BUSINESS_TYPE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CATEGORY_OF_ITEM_ID' => Yii::t('app', 'Category  Of  Item  ID'),
            'ECOM_CATEGORY_ID' => Yii::t('app', 'Ecom  Category  ID'),
            'CATEGORY_FLAG' => Yii::t('app', 'Category  Flag'),
            'CATEGORY_IMG_PATH' => Yii::t('app', 'Category Img Path'), 
            'CATEGORY_PUBLIC' => Yii::t('app', 'Category Public'),
           'BUSINESS_TYPE_ID' => Yii::t('app', 'Business Type ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBudgetAvarages()
    {
        return $this->hasMany(BudgetAvarage::className(), ['CATEGORY_ID' => 'CATEGORY_OF_ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriesCountries()
    {
        return $this->hasMany(CategoriesCountries::className(), ['CATEGORY_ID' => 'CATEGORY_OF_ITEM_ID'])->where(['COUNTRY_ID' => '1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriesWeddingTypes()
    {
        return $this->hasMany(CategoriesWeddingType::className(), ['CATEGORY_ID' => 'CATEGORY_OF_ITEM_ID'])->where(['WEDDING_TYPE_ID' => '1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
//    public function getCategoryOfItemCtryWedTypes()
//    {
//        return $this->hasMany(CategoryOfItemCtryWedType::className(), ['CATEGORY_OF_ITEM_ID' => 'CATEGORY_OF_ITEM_ID']);
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryOfItemsTrans()
    {
        return $this->hasMany(CategoryOfItemsTrans::className(), ['CATEGORY_OF_ITEM_ID' => 'CATEGORY_OF_ITEM_ID'])->where(['LANGUAGE_ID' => '1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryPackageCategories()
    {
        return $this->hasMany(CategoryPackageCategory::className(), ['CATEGORY_ID' => 'CATEGORY_OF_ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Items::className(), ['CATEGORY_ID' => 'CATEGORY_OF_ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['CATEGORY_ID' => 'CATEGORY_OF_ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWedCategoryEstimatedBudget()
    {
        return $this->hasOne(WedCategoryEstimatedBudget::className(), ['ESTIMATED_BUDGET_ID' => 'CATEGORY_OF_ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingRealBudgets()
    {
        return $this->hasMany(WeddingRealBudget::className(), ['CATEGORY_OF_ITEM_ID' => 'CATEGORY_OF_ITEM_ID']);
    }
    
    	   public function getSubCategoriesOfItems() 
   { 
       return $this->hasMany(SubCategoriesOfItems::className(), ['CATEGORY_OF_ITEM_ID' => 'CATEGORY_OF_ITEM_ID']); 
   } 
 
   /** 
    * @return \yii\db\ActiveQuery 
    */
   
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getBUSINESSTYPE()
   {
       return $this->hasOne(BusinessType::className(), ['BUSINESS_TYPE_ID' => 'BUSINESS_TYPE_ID']);
   }
   
 
 
   /** 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getSupplierOfferedServices() 
   { 
       return $this->hasMany(SupplierOfferedServices::className(), ['CATEGORY_ID' => 'CATEGORY_OF_ITEM_ID']); 
   } 
 
   /** 
    * @return \yii\db\ActiveQuery 
    */ 
}
