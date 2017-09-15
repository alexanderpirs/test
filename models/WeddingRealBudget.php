<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wedding_real_budget".
 *
 * @property integer $WEDDING_ID
 * @property integer $CATEGORY_OF_ITEM_ID
 * @property integer $PRODUCT_ID
 * @property integer $ITEM_ID
 * @property string $ESTIMATION_BUDGET
 * @property string $ACTUAL_PRICE
 * @property string $ACTUAL_VS_BUDGET_EST
 * @property string $PAID
 * @property string $REMAINING
 * @property integer $PERCENTAGE
 * @property integer $BUDGET_ID
 * @property integer $OPTION_ID
 * @property integer $QUANTITY
 * @property string $PRODUCT_NAME
 * @property integer $SUB_CATEGORY_ID
 * @property integer $CURRENCY_ID
 * @property integer $WEDDING_EVENT_ID
 *@property integer $PACKAGE_ID
 * 
 * @property ItemOptions $oPTION
 * @property Weddings $wEDDING
 * @property CategoryOfItems $cATEGORYOFITEM
 * @property Products $pRODUCT
 * @property Packages $pACKAGE 
 * @property Items $iTEM
 * @property SubCategoriesOfItems $sUBCATEGORY
 * @property Currencies $cURRENCY
 * @property WeddingEvent $wEDDINGEVENT
 */
class WeddingRealBudget extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wedding_real_budget';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ITEM_ID', 'CURRENCY_ID', 'ACTUAL_PRICE', 'PAID', 'REMAINING'], 'required'],
            [['WEDDING_ID', 'CATEGORY_OF_ITEM_ID', 'PRODUCT_ID', 'ITEM_ID', 'PERCENTAGE', 'OPTION_ID', 'QUANTITY', 'SUB_CATEGORY_ID', 'CURRENCY_ID', 'WEDDING_EVENT_ID'], 'integer'],
            [['ESTIMATION_BUDGET', 'ACTUAL_PRICE', 'ACTUAL_VS_BUDGET_EST', 'PAID', 'REMAINING'], 'string', 'max' => 30],
            [['PRODUCT_NAME'], 'string', 'max' => 45],
            [['OPTION_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ItemOptions::className(), 'targetAttribute' => ['OPTION_ID' => 'OPTION_ID']],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
            [['CATEGORY_OF_ITEM_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryOfItems::className(), 'targetAttribute' => ['CATEGORY_OF_ITEM_ID' => 'CATEGORY_OF_ITEM_ID']],
            [['PRODUCT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['PRODUCT_ID' => 'PRODUCT_ID']],
            [['PACKAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Packages::className(), 'targetAttribute' => ['PACKAGE_ID' => 'PACKAGE_ID']], 
            [['ITEM_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['ITEM_ID' => 'ITEM_ID']],
            [['SUB_CATEGORY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SubCategoriesOfItems::className(), 'targetAttribute' => ['SUB_CATEGORY_ID' => 'SUB_CATEGORY_ID']],
            [['CURRENCY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Currencies::className(), 'targetAttribute' => ['CURRENCY_ID' => 'CURRENCY_ID']],
            [['WEDDING_EVENT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => WeddingEvent::className(), 'targetAttribute' => ['WEDDING_EVENT_ID' => 'WEDDING_EVENT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
            'CATEGORY_OF_ITEM_ID' => Yii::t('app', 'Category  Of  Item  ID'),
            'PRODUCT_ID' => Yii::t('app', 'Product  ID'),
            'ITEM_ID' => Yii::t('app', 'Item  ID'),
            'ESTIMATION_BUDGET' => Yii::t('app', 'Estimation  Budget'),
            'ACTUAL_PRICE' => Yii::t('app', 'Actual  Price'),
            'ACTUAL_VS_BUDGET_EST' => Yii::t('app', 'Actual  Vs  Budget  Est'),
            'PAID' => Yii::t('app', 'Paid'),
            'REMAINING' => Yii::t('app', 'Remaining'),
            'PERCENTAGE' => Yii::t('app', 'Percentage'),
            'BUDGET_ID' => Yii::t('app', 'Budget  ID'),
            'OPTION_ID' => Yii::t('app', 'Option  ID'),
            'QUANTITY' => Yii::t('app', 'Quantity'),
            'PRODUCT_NAME' => Yii::t('app', 'Product  Name'),
            'SUB_CATEGORY_ID' => Yii::t('app', 'Sub  Category  ID'),
            'CURRENCY_ID' => Yii::t('app', 'Currency  ID'),
            'WEDDING_EVENT_ID' => Yii::t('app', 'Wedding  Event  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOPTION()
    {
        return $this->hasOne(ItemOptions::className(), ['OPTION_ID' => 'OPTION_ID']);
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
   public function getPACKAGE() 
   { 
       return $this->hasOne(Packages::className(), ['PACKAGE_ID' => 'PACKAGE_ID']); 
   }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCATEGORYOFITEM()
    {
        return $this->hasOne(CategoryOfItems::className(), ['CATEGORY_OF_ITEM_ID' => 'CATEGORY_OF_ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPRODUCT()
    {
        return $this->hasOne(Products::className(), ['PRODUCT_ID' => 'PRODUCT_ID']);
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
    public function getSUBCATEGORY()
    {
        return $this->hasOne(SubCategoriesOfItems::className(), ['SUB_CATEGORY_ID' => 'SUB_CATEGORY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCURRENCY()
    {
        return $this->hasOne(Currencies::className(), ['CURRENCY_ID' => 'CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWEDDINGEVENT()
    {
        return $this->hasOne(WeddingEvent::className(), ['WEDDING_EVENT_ID' => 'WEDDING_EVENT_ID']);
    }
}
