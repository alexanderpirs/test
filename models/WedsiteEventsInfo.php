<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wedsite_events_info".
 *
 * @property integer $WEDSITE_EVENTS_INFO_ID
 * @property integer $WEDDING_ID
 * @property resource $EVENT_PLACE_NAME
 * @property resource $EVENT_DESCRIPTION
 * @property integer $WEDDING_EVENT_ID
 * @property string $EVENT_IMG
 * @property string $EVNET_DATE
 * @property string $EVENT_ATTIRE
 * @property resource $EVENT_ADDRESS
 * @property string $TRANSPORT
 *
 * @property WeddingEvent $wEDDINGEVENT
 * @property Weddings $wEDDING
 */
class WedsiteEventsInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wedsite_events_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['WEDDING_ID', 'WEDDING_EVENT_ID'], 'integer'],
            [['EVENT_PLACE_NAME', 'EVENT_DESCRIPTION', 'EVENT_ADDRESS'], 'string'],
            [['EVENT_IMG', 'TRANSPORT'], 'string', 'max' => 1000],
            [['EVNET_DATE', 'EVENT_ATTIRE'], 'string', 'max' => 100],
            [['WEDDING_EVENT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => WeddingEvent::className(), 'targetAttribute' => ['WEDDING_EVENT_ID' => 'WEDDING_EVENT_ID']],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'WEDSITE_EVENTS_INFO_ID' => Yii::t('app', 'Wedsite  Events  Info  ID'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
            'EVENT_PLACE_NAME' => Yii::t('app', 'Event  Place  Name'),
            'EVENT_DESCRIPTION' => Yii::t('app', 'Event  Description'),
            'WEDDING_EVENT_ID' => Yii::t('app', 'Wedding  Event  ID'),
            'EVENT_IMG' => Yii::t('app', 'Event  Img'),
            'EVNET_DATE' => Yii::t('app', 'Evnet  Date'),
            'EVENT_ATTIRE' => Yii::t('app', 'Event  Attire'),
            'EVENT_ADDRESS' => Yii::t('app', 'Event  Address'),
            'TRANSPORT' => Yii::t('app', 'Transport'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWEDDINGEVENT()
    {
        return $this->hasOne(WeddingEvent::className(), ['WEDDING_EVENT_ID' => 'WEDDING_EVENT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWEDDING()
    {
        return $this->hasOne(Weddings::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }
}
