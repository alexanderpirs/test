<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invitee_guests".
 *
 * @property integer $GUEST_ID
 * @property string $GUEST_NAME
 * @property integer $PLACE_WITH
 * @property integer $CIRLE_ID
 * @property integer $INVITEE_ID
 *
 * @property InviteesCircle $cIRLE
 * @property Invitees $iNVITEE
 * @property InviteesPlaceWith $pLACEWITH
 */
class InviteeGuests extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invitee_guests';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PLACE_WITH', 'CIRLE_ID', 'INVITEE_ID'], 'integer'],
            [['GUEST_NAME'], 'string', 'max' => 100],
            [['CIRLE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => InviteesCircle::className(), 'targetAttribute' => ['CIRLE_ID' => 'INVITEE_CIRLE_ID']],
            [['INVITEE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Invitees::className(), 'targetAttribute' => ['INVITEE_ID' => 'INVITEE_ID']],
            [['PLACE_WITH'], 'exist', 'skipOnError' => true, 'targetClass' => InviteesPlaceWith::className(), 'targetAttribute' => ['PLACE_WITH' => 'INVITEE_PLACE_WITH_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'GUEST_ID' => Yii::t('app', 'Guest  ID'),
            'GUEST_NAME' => Yii::t('app', 'Guest  Name'),
            'PLACE_WITH' => Yii::t('app', 'Place  With'),
            'CIRLE_ID' => Yii::t('app', 'Cirle  ID'),
            'INVITEE_ID' => Yii::t('app', 'Invitee  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCIRLE()
    {
        return $this->hasOne(InviteesCircle::className(), ['INVITEE_CIRLE_ID' => 'CIRLE_ID']);
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
    public function getPLACEWITH()
    {
        return $this->hasOne(InviteesPlaceWith::className(), ['INVITEE_PLACE_WITH_ID' => 'PLACE_WITH']);
    }
}
