<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sub_categories_of_items".
 *
 * @property integer $SUB_CATEGORY_ID
 * @property integer $CATEGORY_OF_ITEM_ID
 * @property integer $ECOM_SUB_CATEGORY_ID
 * @property integer $WEDDING_ID
 * @property string $SUB_CATEGORY_VALUE
 * 
 * @property CategoryOfItems $cATEGORYOFITEM 
 * @property Products[] $products
 * @property CategoryOfItems $cATEGORYOFITEM 
 * @property Weddings $wEDDING 
 * @property WedProductEstimation[] $wedProductEstimations 
 * @property WedSubCategoryEstimatedBudget[] $wedSubCategoryEstimatedBudgets 
 * @property SubCategoriesCountries[] $subCategoriesCountries
 * @property SubCategoriesTrans[] $subCategoriesTrans
 * @property SubCategoriesWeddingType[] $subCategoriesWeddingTypes
 * @property WeddingRealBudget[] $weddingRealBudgets
 */
class SubCategoriesOfItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sub_categories_of_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CATEGORY_OF_ITEM_ID', 'ECOM_SUB_CATEGORY_ID'], 'integer'],
            [['CATEGORY_OF_ITEM_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryOfItems::className(), 'targetAttribute' => ['CATEGORY_OF_ITEM_ID' => 'CATEGORY_OF_ITEM_ID']], 
            [['CATEGORY_OF_ITEM_ID', 'ECOM_SUB_CATEGORY_ID', 'WEDDING_ID'], 'integer'],
            [['SUB_CATEGORY_VALUE'], 'string', 'max' => 100],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SUB_CATEGORY_ID' => Yii::t('app', 'Sub  Category  ID'),
            'CATEGORY_OF_ITEM_ID' => Yii::t('app', 'Category  Of  Item  ID'),
            'ECOM_SUB_CATEGORY_ID' => Yii::t('app', 'Ecom  Sub  Category  ID'),
        ];
    }
   public function getCATEGORYOFITEM() 
   { 
       return $this->hasOne(CategoryOfItems::className(), ['CATEGORY_OF_ITEM_ID' => 'CATEGORY_OF_ITEM_ID']); 
   } 
 
   /** 
    * @return \yii\db\ActiveQuery 
    */ 
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['SUB_CATEGORY_ID' => 'SUB_CATEGORY_ID']);
    }
    
       /**
    * @return \yii\db\ActiveQuery
    */
   public function getWedProductEstimations() 
   { 
       return $this->hasMany(WedProductEstimation::className(), ['SUB_CATEGORY_ID' => 'SUB_CATEGORY_ID']); 
   } 
 
   /** 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getWedSubCategoryEstimatedBudgets() 
   { 
       return $this->hasMany(WedSubCategoryEstimatedBudget::className(), ['SUB_CATEGORY_ID' => 'SUB_CATEGORY_ID']); 
   } 

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategoriesCountries()
    {
        return $this->hasMany(SubCategoriesCountries::className(), ['SUB_CATEGORY_ID' => 'SUB_CATEGORY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategoriesTrans()
    {
        
//        Yii::$app->language
        return $this->hasMany(SubCategoriesTrans::className(), ['SUB_CATEGORY_ID' => 'SUB_CATEGORY_ID'])->where(['LANGUAGE_ID'=> '1']);
    }

     
 
   /** 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getWEDDING() 
   { 
       return $this->hasOne(Weddings::className(), ['WEDDING_ID' => 'WEDDING_ID']); 
   } 
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategoriesWeddingTypes()
    {
        return $this->hasMany(SubCategoriesWeddingType::className(), ['SUB_CATEGORY_ID' => 'SUB_CATEGORY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingRealBudgets()
    {
        return $this->hasMany(WeddingRealBudget::className(), ['SUB_CATEGORY_ID' => 'SUB_CATEGORY_ID']);
    }
}
