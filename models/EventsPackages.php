<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "events_packages".
 *
 * @property integer $EVENT_ID
 * @property integer $PACKAGE_ID
 *
 * @property WeddingEvent $eVENT
 * @property Packages $pACKAGE
 */
class EventsPackages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'events_packages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EVENT_ID', 'PACKAGE_ID'], 'integer'],
            [['EVENT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => WeddingEvent::className(), 'targetAttribute' => ['EVENT_ID' => 'WEDDING_EVENT_ID']],
            [['PACKAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Packages::className(), 'targetAttribute' => ['PACKAGE_ID' => 'PACKAGE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'EVENT_ID' => Yii::t('app', 'Event  ID'),
            'PACKAGE_ID' => Yii::t('app', 'Package  ID'),
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
    public function getPACKAGE()
    {
        return $this->hasOne(Packages::className(), ['PACKAGE_ID' => 'PACKAGE_ID']);
    }
}
