<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wedding_event_translation".
 *
 * @property integer $wedding_event_id
 * @property string $wedding_event_VALUE
 * @property integer $LANGUAGE_ID
 *
 * @property WeddingEvent $weddingEvent
 * @property Languages $lANGUAGE
 */
class WeddingEventTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wedding_event_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wedding_event_id', 'LANGUAGE_ID'], 'integer'],
            [['wedding_event_VALUE'], 'string', 'max' => 100],
            [['wedding_event_id'], 'exist', 'skipOnError' => true, 'targetClass' => WeddingEvent::className(), 'targetAttribute' => ['wedding_event_id' => 'WEDDING_EVENT_ID']],
            [['LANGUAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['LANGUAGE_ID' => 'LANGUAGE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'wedding_event_id' => Yii::t('app', 'Wedding Event ID'),
            'wedding_event_VALUE' => Yii::t('app', 'Wedding Event  Value'),
            'LANGUAGE_ID' => Yii::t('app', 'Language  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingEvent()
    {
        return $this->hasOne(WeddingEvent::className(), ['WEDDING_EVENT_ID' => 'wedding_event_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLANGUAGE()
    {
        return $this->hasOne(Languages::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }
}
