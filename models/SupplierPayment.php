<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supplier_payment".
 *
 * @property integer $SUPPLIER_ID
 * @property integer $PAYMENT_ID
 * @property integer $BANK_ID
 * @property string $ACCOUNT_NUMBER
 *
 * @property Suppliers $sUPPLIER
 * @property Payment $pAYMENT
 * @property Bank $bANK
 */
class SupplierPayment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'supplier_payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SUPPLIER_ID', 'PAYMENT_ID', 'BANK_ID','ACCOUNT_NUMBER'], 'integer'],
            [['ACCOUNT_NUMBER'], 'string', 'max' => 100],
            [['SUPPLIER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Suppliers::className(), 'targetAttribute' => ['SUPPLIER_ID' => 'SUPPLIER_ID']],
            [['PAYMENT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Payment::className(), 'targetAttribute' => ['PAYMENT_ID' => 'PAYMENT_ID']],
            [['BANK_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Bank::className(), 'targetAttribute' => ['BANK_ID' => 'BANK_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SUPPLIER_ID' => Yii::t('app', 'Supplier  ID'),
            'PAYMENT_ID' => Yii::t('app', 'Payment  ID'),
            'BANK_ID' => Yii::t('app', 'Bank  ID'),
            'ACCOUNT_NUMBER' => Yii::t('app', 'Account  Number'),
        ];
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
    public function getPAYMENT()
    {
        return $this->hasOne(Payment::className(), ['PAYMENT_ID' => 'PAYMENT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBANK()
    {
        return $this->hasOne(Bank::className(), ['BANK_ID' => 'BANK_ID']);
    }
}
