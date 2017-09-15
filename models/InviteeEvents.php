<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invitee_events".
 *
 * @property integer $INVITEE_ID
 * @property integer $EVENT_ID
 *
 * @property Invitees $iNVITEE
 * @property WeddingEvent $eVENT
 */
class InviteeEvents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invitee_events';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['INVITEE_ID', 'EVENT_ID'], 'integer'],
            [['INVITEE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Invitees::className(), 'targetAttribute' => ['INVITEE_ID' => 'INVITEE_ID']],
            [['EVENT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => WeddingEvent::className(), 'targetAttribute' => ['EVENT_ID' => 'WEDDING_EVENT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'INVITEE_ID' => Yii::t('app', 'Invitee  ID'),
            'EVENT_ID' => Yii::t('app', 'Event  ID'),
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
    public function getEVENT()
    {
        return $this->hasOne(WeddingEvent::className(), ['WEDDING_EVENT_ID' => 'EVENT_ID']);
    }
}
