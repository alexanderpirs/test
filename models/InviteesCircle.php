<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invitees_circle".
 *
 * @property integer $INVITEE_CIRLE_ID
 *
 * @property Invitees[] $invitees
 * @property InviteesCirclesTrans[] $inviteesCirclesTrans
 */
class InviteesCircle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invitees_circle';
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
            'INVITEE_CIRLE_ID' => Yii::t('app', 'Invitee  Cirle  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvitees()
    {
        return $this->hasMany(Invitees::className(), ['INVITEE_CIRCLE_ID' => 'INVITEE_CIRLE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInviteesCirclesTrans()
    {
        return $this->hasMany(InviteesCirclesTrans::className(), ['INVITEE_CIRCLE_ID' => 'INVITEE_CIRLE_ID']);
    }
}
