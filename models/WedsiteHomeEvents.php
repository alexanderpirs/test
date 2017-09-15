<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wedsite_home_events".
 *
 * @property integer $EVENT_ID
 * @property string $EVENT_DESCIPTION
 * @property integer $EVENT_DATE_TIME
 * @property integer $WEDDING_ID
 *
 * @property WeddingEvent $eVENT
 * @property Weddings $wEDDING
 */
class WedsiteHomeEvents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wedsite_home_events';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EVENT_ID', 'EVENT_DATE_TIME', 'WEDDING_ID'], 'integer'],
            [['EVENT_DESCIPTION'], 'string', 'max' => 1000],
            [['EVENT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => WeddingEvent::className(), 'targetAttribute' => ['EVENT_ID' => 'WEDDING_EVENT_ID']],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'EVENT_ID' => Yii::t('app', 'Event  ID'),
            'EVENT_DESCIPTION' => Yii::t('app', 'Event  Desciption'),
            'EVENT_DATE_TIME' => Yii::t('app', 'Event  Date  Time'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEVENT()
    {
        return $this->hasOne(WeddingEvent::className(), ['WEDDING_EVENT_ID' => 'EVENT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWEDDING()
    {
        return $this->hasOne(Weddings::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }
}
