<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "send_cart_by".
 *
 * @property integer $SEND_CART_BY_ID
 *
 * @property ContactsDefaultInviteBy[] $contactsDefaultInviteBies
 * @property Invitees[] $invitees
 * @property SendCartByTrans[] $sendCartByTrans
 */
class SendCartBy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'send_cart_by';
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
            'SEND_CART_BY_ID' => Yii::t('app', 'Send  Cart  By  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactsDefaultInviteBies()
    {
        return $this->hasMany(ContactsDefaultInviteBy::className(), ['SEND_CART_BY_ID' => 'SEND_CART_BY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvitees()
    {
        return $this->hasMany(Invitees::className(), ['SEND_CART_BY_ID' => 'SEND_CART_BY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSendCartByTrans()
    {
        return $this->hasMany(SendCartByTrans::className(), ['SEND_CART_BY_ID' => 'SEND_CART_BY_ID']);
    }
}
