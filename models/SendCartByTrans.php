<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "send_cart_by_trans".
 *
 * @property integer $SEND_CART_BY_ID
 * @property string $SEND_CART_BY_NAME
 * @property integer $LANGUAGE_ID
 *
 * @property SendCartBy $sENDCARTBY
 * @property Languages $lANGUAGE
 */
class SendCartByTrans extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'send_cart_by_trans';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SEND_CART_BY_ID', 'LANGUAGE_ID'], 'integer'],
            [['SEND_CART_BY_NAME'], 'string', 'max' => 50],
            [['SEND_CART_BY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SendCartBy::className(), 'targetAttribute' => ['SEND_CART_BY_ID' => 'SEND_CART_BY_ID']],
            [['LANGUAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['LANGUAGE_ID' => 'LANGUAGE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SEND_CART_BY_ID' => Yii::t('app', 'Send  Cart  By  ID'),
            'SEND_CART_BY_NAME' => Yii::t('app', 'Send  Cart  By  Name'),
            'LANGUAGE_ID' => Yii::t('app', 'Language  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSENDCARTBY()
    {
        return $this->hasOne(SendCartBy::className(), ['SEND_CART_BY_ID' => 'SEND_CART_BY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLANGUAGE()
    {
        return $this->hasOne(Languages::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }
}
