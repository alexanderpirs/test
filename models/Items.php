<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "items".
 *
 * @property integer $ITEM_ID
 * @property integer $PRODUCT_ID
 * @property integer $ECOM_ITEM_ID
 * @property integer $CATEGORY_ID
 * @property string $ITEM_FLAG
 * @property string $COMMISSION
 * @property string $COMMISSION_FLAG
 * @property string $ITEM_PRICE
 * @property integer $CURRENCY_ID
 * @property string $APPROVED_OR_NO
 * @property string $APPROVED_DATE
 * @property integer $APPROVED_BY
 *  @property string $ITEM_VALUE 
* @property integer $WEDDING_ID 
 *
 * @property FinancialLoan[] $financialLoans
 * @property ItemRatingComment[] $itemRatingComments
 * @property CategoryOfItems $cATEGORY
 * @property Currencies $cURRENCY
 * @property CouplePartner $aPPROVEDBY
 * @property Products $pRODUCT
 * @property ItemsAgenda[] $itemsAgendas
 *  @property Weddings $wEDDING 
 * @property ItemsCard[] $itemsCards
 * @property ItemsCountries[] $itemsCountries
 * @property ItemsSupplieirs[] $itemsSupplieirs
 * @property ItemsTrans[] $itemsTrans
 * @property ItemsWeddingType[] $itemsWeddingTypes
 * @property Saving[] $savings
 * @property WeddingAccount[] $weddingAccounts
 * @property WeddingRealBudget[] $weddingRealBudgets
 * @property WeddingsInsurance[] $weddingsInsurances
 */
class Items extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PRODUCT_ID', 'ECOM_ITEM_ID', 'CATEGORY_ID', 'CURRENCY_ID', 'APPROVED_BY','WEDDING_ID'], 'integer'],
            [['APPROVED_DATE'], 'safe'],
            [['ITEM_FLAG', 'COMMISSION_FLAG', 'APPROVED_OR_NO'], 'string', 'max' => 1],
            [['COMMISSION', 'ITEM_PRICE'], 'string', 'max' => 20],
            [['ITEM_VALUE'], 'string', 'max' => 100], 
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']], 
            [['CATEGORY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryOfItems::className(), 'targetAttribute' => ['CATEGORY_ID' => 'CATEGORY_OF_ITEM_ID']],
            [['CURRENCY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Currencies::className(), 'targetAttribute' => ['CURRENCY_ID' => 'CURRENCY_ID']],
            [['APPROVED_BY'], 'exist', 'skipOnError' => true, 'targetClass' => CouplePartner::className(), 'targetAttribute' => ['APPROVED_BY' => 'COUPLE_PARTNER_ID']],
            [['PRODUCT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['PRODUCT_ID' => 'PRODUCT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ITEM_ID' => Yii::t('app', 'Item  ID'),
            'PRODUCT_ID' => Yii::t('app', 'Product  ID'),
            'ECOM_ITEM_ID' => Yii::t('app', 'Ecom  Item  ID'),
            'CATEGORY_ID' => Yii::t('app', 'Category  ID'),
            'ITEM_FLAG' => Yii::t('app', 'Item  Flag'),
            'COMMISSION' => Yii::t('app', 'Commission'),
            'COMMISSION_FLAG' => Yii::t('app', 'Commission  Flag'),
            'ITEM_PRICE' => Yii::t('app', 'Item  Price'),
            'CURRENCY_ID' => Yii::t('app', 'Currency  ID'),
            'APPROVED_OR_NO' => Yii::t('app', 'Approved  Or  No'),
            'APPROVED_DATE' => Yii::t('app', 'Approved  Date'),
            'APPROVED_BY' => Yii::t('app', 'Approved  By'),
            'ITEM_VALUE' => Yii::t('app', 'Item Value'), 
           'WEDDING_ID' => Yii::t('app', 'Wedding ID'), 
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinancialLoans()
    {
        return $this->hasMany(FinancialLoan::className(), ['ITEM_ID' => 'ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemRatingComments()
    {
        return $this->hasMany(ItemRatingComment::className(), ['ITEM_ID' => 'ITEM_ID']);
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
    public function getCURRENCY()
    {
        return $this->hasOne(Currencies::className(), ['CURRENCY_ID' => 'CURRENCY_ID']);
    }

    
       public function getWEDDING() 
   { 
       return $this->hasOne(Weddings::className(), ['WEDDING_ID' => 'WEDDING_ID']); 
   } 
 
   /** 
    * @return \yii\db\ActiveQuery 
    */ 
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAPPROVEDBY()
    {
        return $this->hasOne(CouplePartner::className(), ['COUPLE_PARTNER_ID' => 'APPROVED_BY']);
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
    public function getItemsAgendas()
    {
        return $this->hasMany(ItemsAgenda::className(), ['ITEM_ID' => 'ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsCards()
    {
        return $this->hasMany(ItemsCard::className(), ['ITEM_ID' => 'ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsCountries()
    {
        return $this->hasMany(ItemsCountries::className(), ['ITEM_ID' => 'ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsSupplieirs()
    {
        
         return $this->hasMany(ItemsSupplieirs::className(), ['ITEM_ID' => 'ITEM_ID']);   
       }
           
              
//         }
          
       
       
//       if($sortMethod=='' || $sortMethod=='DESC'){
//        
//           return $this->hasMany(ItemsSupplieirs::className(), ['ITEM_ID' => 'ITEM_ID'])->orderBy([' CAST(PRICE as signed)'=>(SORT_DESC)]);
//       
//       }
        
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsTrans()
    {
        return $this->hasMany(ItemsTrans::className(), ['ITEM_ID' => 'ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsWeddingTypes()
    {
        return $this->hasMany(ItemsWeddingType::className(), ['ITEM_ID' => 'ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSavings()
    {
        return $this->hasMany(Saving::className(), ['ITEM_ID' => 'ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingAccounts()
    {
        return $this->hasMany(WeddingAccount::className(), ['ITEM_ID' => 'ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingRealBudgets()
    {
        return $this->hasMany(WeddingRealBudget::className(), ['ITEM_ID' => 'ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingsInsurances()
    {
        return $this->hasMany(WeddingsInsurance::className(), ['ITEM_ID' => 'ITEM_ID']);
    }
}
