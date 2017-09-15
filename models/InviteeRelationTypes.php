<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invitee_relation_types".
 *
 * @property integer $RELATION_TYPE_ID
 * @property string $RELATION_TYPE_NAME
 * @property integer $LANGUAGES_ID
 *
 * @property Languages $lANGUAGES
 * @property Invitees[] $invitees
 * @property InviteesRelationTypeTrans[] $inviteesRelationTypeTrans
 * @property PrivateSponsor[] $privateSponsors
 */
class InviteeRelationTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invitee_relation_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LANGUAGES_ID'], 'integer'],
            [['RELATION_TYPE_NAME'], 'string', 'max' => 40],
            [['LANGUAGES_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['LANGUAGES_ID' => 'LANGUAGE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'RELATION_TYPE_ID' => Yii::t('app', 'Relation  Type  ID'),
            'RELATION_TYPE_NAME' => Yii::t('app', 'Relation  Type  Name'),
            'LANGUAGES_ID' => Yii::t('app', 'Languages  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLANGUAGES()
    {
        return $this->hasOne(Languages::className(), ['LANGUAGE_ID' => 'LANGUAGES_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvitees()
    {
        return $this->hasMany(Invitees::className(), ['RELATION_TYPE_ID' => 'RELATION_TYPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInviteesRelationTypeTrans()
    {
        return $this->hasMany(InviteesRelationTypeTrans::className(), ['RELATION_TYPE_ID' => 'RELATION_TYPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrivateSponsors()
    {
        return $this->hasMany(PrivateSponsor::className(), ['RELATION_TYPE_ID' => 'RELATION_TYPE_ID']);
    }
}
