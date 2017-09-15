<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bank".
 *
 * @property integer $BANK_ID
 * @property string $BANK_NAME
 * @property integer $BANK_LOAN_RATE
 * @property integer $BANK_SAVING_RATE
 *
 * @property SupplierPayment[] $supplierPayments
 */
class Bank extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bank';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BANK_LOAN_RATE', 'BANK_SAVING_RATE'], 'integer'],
            [['BANK_NAME'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'BANK_ID' => Yii::t('app', 'Bank  ID'),
            'BANK_NAME' => Yii::t('app', 'Bank  Name'),
            'BANK_LOAN_RATE' => Yii::t('app', 'Bank  Loan  Rate'),
            'BANK_SAVING_RATE' => Yii::t('app', 'Bank  Saving  Rate'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplierPayments()
    {
        return $this->hasMany(SupplierPayment::className(), ['BANK_ID' => 'BANK_ID']);
    }
}
