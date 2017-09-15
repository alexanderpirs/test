<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invitees_place_with".
 *
 * @property integer $INVITEE_PLACE_WITH_ID
 *
 * @property Invitees[] $invitees
 * @property InviteesPlaceWithTrans[] $inviteesPlaceWithTrans
 */
class InviteesPlaceWith extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invitees_place_with';
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
            'INVITEE_PLACE_WITH_ID' => Yii::t('app', 'Invitee  Place  With  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvitees()
    {
        return $this->hasMany(Invitees::className(), ['INVITEE_PLACE_WITH_ID' => 'INVITEE_PLACE_WITH_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInviteesPlaceWithTrans()
    {
        return $this->hasMany(InviteesPlaceWithTrans::className(), ['INVITEE_PLACE_WITH_ID' => 'INVITEE_PLACE_WITH_ID']);
    }
}
