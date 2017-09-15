<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wedsite_events".
 *
 * @property integer $WEDSITE_EVENT_ID
 * @property integer $WEDDING_ID
 * @property resource $WEDSITE_EVENT_WELCOME
 *
 * @property Weddings $wEDDING
 */
class WedsiteEvents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wedsite_events';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['WEDDING_ID'], 'integer'],
            [['WEDSITE_EVENT_WELCOME'], 'string'],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'WEDSITE_EVENT_ID' => Yii::t('app', 'Wedsite  Event  ID'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
            'WEDSITE_EVENT_WELCOME' => Yii::t('app', 'Wedsite  Event  Welcome'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWEDDING()
    {
        return $this->hasOne(Weddings::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }
}
