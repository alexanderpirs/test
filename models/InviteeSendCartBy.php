<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invitee_send_cart_by".
 *
 * @property integer $INVITEE_ID
 * @property integer $SEND_CART_BY_ID
 *
 * @property Invitees $iNVITEE
 * @property SendCartBy $sENDCARTBY
 */
class InviteeSendCartBy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invitee_send_cart_by';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['INVITEE_ID', 'SEND_CART_BY_ID'], 'integer'],
            [['INVITEE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Invitees::className(), 'targetAttribute' => ['INVITEE_ID' => 'INVITEE_ID']],
            [['SEND_CART_BY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SendCartBy::className(), 'targetAttribute' => ['SEND_CART_BY_ID' => 'SEND_CART_BY_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'INVITEE_ID' => Yii::t('app', 'Invitee  ID'),
            'SEND_CART_BY_ID' => Yii::t('app', 'Send  Cart  By  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINVITEE()
    {
        return $this->hasOne(Invitees::className(), ['INVITEE_ID' => 'INVITEE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSENDCARTBY()
    {
        return $this->hasOne(SendCartBy::className(), ['SEND_CART_BY_ID' => 'SEND_CART_BY_ID']);
    }
}
