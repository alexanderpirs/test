<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property integer $PAYMENT_ID
 *
 * @property PaymentTranslation[] $paymentTranslations
 * @property SupplierPayment[] $supplierPayments
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PAYMENT_ID' => Yii::t('app', 'Payment  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentTranslations()
    {
        return $this->hasMany(PaymentTranslation::className(), ['PAYMENT_ID' => 'PAYMENT_ID'])->where('LANGUAGE_ID = 1');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplierPayments()
    {
        return $this->hasMany(SupplierPayment::className(), ['PAYMENT_ID' => 'PAYMENT_ID']);
    }
}
