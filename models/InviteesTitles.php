<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invitees_titles".
 *
 * @property integer $INVITEES_TITLES_ID
 *
 * @property InviteeTitleTrans[] $inviteeTitleTrans
 * @property Invitees[] $invitees
 * @property Invitees[] $invitees0
 */
class InviteesTitles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invitees_titles';
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
            'INVITEES_TITLES_ID' => Yii::t('app', 'Invitees  Titles  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInviteeTitleTrans()
    {
        return $this->hasMany(InviteeTitleTrans::className(), ['INVITEE_TITLE_ID' => 'INVITEES_TITLES_ID'])->where('LANGUAGE_ID = 1');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvitees()
    {
        return $this->hasMany(Invitees::className(), ['FIRST_INVITEE_MSMRS_ID' => 'INVITEES_TITLES_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvitees0()
    {
        return $this->hasMany(Invitees::className(), ['SECOND_INVITEE_MSMRS_ID' => 'INVITEES_TITLES_ID']);
    }
}
