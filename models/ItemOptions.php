<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_options".
 *
 * @property integer $OPTION_ID
 * @property integer $ITEM_SUPPLIER_ID
 * @property string $COMMISSION
 * @property string $COMMISSION_FLAG
 * @property string $APPROVED_OR_NOT
 * @property string $APPROVED_DATE
 * @property integer $APPROVED_BY
 * @property string $CRITERIAS_VALUES
 * @property string $DISCOUNT
 * @property integer $QUANTITY
 * @property string $FROM_AMOUNT
 * @property string $TO_AMOUNT
 * @property string $RATE
 * @property string $DURATION
 * @property string $OPTION_PRICE
 * @property integer $CURRENCY_ID
 *
 * @property FinancialLoan[] $financialLoans
 * @property ItemOptionTrans[] $itemOptionTrans
 * @property CouplePartner $aPPROVEDBY
 * @property ItemsSupplieirs $iTEMSUPPLIER
 * @property OptionCriteria[] $optionCriterias 
 * @property Currencies $cURRENCY
 * @property ItemsCard[] $itemsCards
 * @property Saving[] $savings
 * @property WeddingAccount[] $weddingAccounts
 * @property WeddingRealBudget[] $weddingRealBudgets
 * @property WeddingsInsurance[] $weddingsInsurances
 */
class ItemOptions extends \yii\db\ActiveRecord
{
    
    public $Criterias;
    public $CriteriasValue;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_options';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ITEM_SUPPLIER_ID', 'APPROVED_BY', 'QUANTITY', 'CURRENCY_ID','OPTION_ID'], 'integer'],
            [['APPROVED_DATE','CriteriasValue','Criterias'], 'safe'],
            [['COMMISSION'], 'string', 'max' => 20],
            [['COMMISSION_FLAG', 'APPROVED_OR_NOT'], 'string', 'max' => 1],
            [['CRITERIAS_VALUES', 'FROM_AMOUNT', 'TO_AMOUNT', 'RATE', 'DURATION', 'OPTION_PRICE'], 'string', 'max' => 45],
            [['DISCOUNT'], 'string', 'max' => 2],
            [['APPROVED_BY'], 'exist', 'skipOnError' => true, 'targetClass' => CouplePartner::className(), 'targetAttribute' => ['APPROVED_BY' => 'COUPLE_PARTNER_ID']],
            [['ITEM_SUPPLIER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ItemsSupplieirs::className(), 'targetAttribute' => ['ITEM_SUPPLIER_ID' => 'ITEM_SUPPLIER_ID']],
            [['CURRENCY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Currencies::className(), 'targetAttribute' => ['CURRENCY_ID' => 'CURRENCY_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'OPTION_ID' => Yii::t('app', 'Option  ID'),
            'ITEM_SUPPLIER_ID' => Yii::t('app', 'Item  Supplier  ID'),
            'COMMISSION' => Yii::t('app', 'Commission'),
            'COMMISSION_FLAG' => Yii::t('app', 'Commission  Flag'),
            'APPROVED_OR_NOT' => Yii::t('app', 'Approved  Or  Not'),
            'APPROVED_DATE' => Yii::t('app', 'Approved  Date'),
            'APPROVED_BY' => Yii::t('app', 'Approved  By'),
            'CRITERIAS_VALUES' => Yii::t('app', 'Criterias  Values'),
            'DISCOUNT' => Yii::t('app', 'Discount'),
            'QUANTITY' => Yii::t('app', 'Quantity'),
            'FROM_AMOUNT' => Yii::t('app', 'From  Amount'),
            'TO_AMOUNT' => Yii::t('app', 'To  Amount'),
            'RATE' => Yii::t('app', 'Rate'),
            'DURATION' => Yii::t('app', 'Duration'),
            'OPTION_PRICE' => Yii::t('app', 'Option  Price'),
            'CURRENCY_ID' => Yii::t('app', 'Currency'),
        ];
    }

    
    
      /**
    * @return \yii\db\ActiveQuery
    */
   public function getOptionCriterias() 
   { 
       return $this->hasMany(OptionCriteria::className(), ['OPTION_ID' => 'OPTION_ID']); 
   } 
 
    /** 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getTransactions() 
   { 
       return $this->hasMany(Transactions::className(), ['ITEM_OPTION_ID' => 'OPTION_ID']); 
   }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinancialLoans()
    {
        return $this->hasMany(FinancialLoan::className(), ['OPTION_ID' => 'OPTION_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemOptionTrans()
    {
        return $this->hasMany(ItemOptionTrans::className(), ['OPTION_ID' => 'OPTION_ID']);
    }

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
    public function getITEMSUPPLIER()
    {
        return $this->hasOne(ItemsSupplieirs::className(), ['ITEM_SUPPLIER_ID' => 'ITEM_SUPPLIER_ID']);
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
    public function getItemsCards()
    {
        return $this->hasMany(ItemsCard::className(), ['OPTION_ID' => 'OPTION_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSavings()
    {
        return $this->hasMany(Saving::className(), ['OPTION_ID' => 'OPTION_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingAccounts()
    {
        return $this->hasMany(WeddingAccount::className(), ['OPTION_ID' => 'OPTION_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingRealBudgets()
    {
        return $this->hasMany(WeddingRealBudget::className(), ['OPTION_ID' => 'OPTION_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingsInsurances()
    {
        return $this->hasMany(WeddingsInsurance::className(), ['OPTION_ID' => 'OPTION_ID']);
    }
}
