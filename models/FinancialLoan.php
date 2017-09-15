<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "financial_loan".
 *
 * @property integer $FINANCIAL_LOAN_ID
 * @property string $FINANCIAL_LOAN_SUPPLIER_NAME
 * @property string $LOAN_AMOUNT
 * @property integer $CURRENCY_ID
 * @property string $DURATION
 * @property string $RATE
 * @property integer $SUPPLIER_ID
 * @property integer $ITEM_ID
 * @property integer $OPTION_ID
 * @property integer $WEDDING_ID
 * @property string $TOTAL
 *
 * @property Currencies $cURRENCY
 * @property Suppliers $sUPPLIER
 * @property Items $iTEM
 * @property ItemOptions $oPTION
 * @property Weddings $wEDDING
 */
class FinancialLoan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'financial_loan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CURRENCY_ID', 'SUPPLIER_ID', 'ITEM_ID', 'OPTION_ID', 'WEDDING_ID'], 'integer'],
            [['FINANCIAL_LOAN_SUPPLIER_NAME'], 'string', 'max' => 50],
            [['LOAN_AMOUNT', 'DURATION', 'RATE', 'TOTAL'], 'string', 'max' => 20],
            [['CURRENCY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Currencies::className(), 'targetAttribute' => ['CURRENCY_ID' => 'CURRENCY_ID']],
            [['SUPPLIER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Suppliers::className(), 'targetAttribute' => ['SUPPLIER_ID' => 'SUPPLIER_ID']],
            [['ITEM_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['ITEM_ID' => 'ITEM_ID']],
            [['OPTION_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ItemOptions::className(), 'targetAttribute' => ['OPTION_ID' => 'OPTION_ID']],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'FINANCIAL_LOAN_ID' => Yii::t('app', 'Financial  Loan  ID'),
            'FINANCIAL_LOAN_SUPPLIER_NAME' => Yii::t('app', 'Financial  Loan  Supplier  Name'),
            'LOAN_AMOUNT' => Yii::t('app', 'Loan  Amount'),
            'CURRENCY_ID' => Yii::t('app', 'Currency  ID'),
            'DURATION' => Yii::t('app', 'Duration'),
            'RATE' => Yii::t('app', 'Rate'),
            'SUPPLIER_ID' => Yii::t('app', 'Supplier  ID'),
            'ITEM_ID' => Yii::t('app', 'Item  ID'),
            'OPTION_ID' => Yii::t('app', 'Option  ID'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
            'TOTAL' => Yii::t('app', 'Total'),
        ];
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
    public function getSUPPLIER()
    {
        return $this->hasOne(Suppliers::className(), ['SUPPLIER_ID' => 'SUPPLIER_ID']);
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
}
