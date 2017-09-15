<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payment_translation".
 *
 * @property integer $PAYMENT_ID
 * @property string $PAYMENT_VALUE
 * @property integer $LANGUAGE_ID
 *
 * @property Payment $pAYMENT
 * @property Languages $lANGUAGE
 */
class PaymentTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PAYMENT_ID', 'LANGUAGE_ID'], 'integer'],
            [['PAYMENT_VALUE'], 'string', 'max' => 45],
            [['PAYMENT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Payment::className(), 'targetAttribute' => ['PAYMENT_ID' => 'PAYMENT_ID']],
            [['LANGUAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['LANGUAGE_ID' => 'LANGUAGE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PAYMENT_ID' => Yii::t('app', 'Payment  ID'),
            'PAYMENT_VALUE' => Yii::t('app', 'Payment  Value'),
            'LANGUAGE_ID' => Yii::t('app', 'Language  ID'),
        ];
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
    public function getLANGUAGE()
    {
        return $this->hasOne(Languages::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }
}
