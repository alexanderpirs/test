<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wedding_estimated_budget".
 *
 * @property integer $WEDDING_ID
 * @property string $ESTIMATED_BUDGET
 * @property integer $CURRENCY_ID
 * @property integer $WEDDING_EVENT_ID
 *
 * @property Weddings $wEDDING
 * @property Currencies $cURRENCY
 * @property WeddingEvent $wEDDINGEVENT
 */
class WeddingEstimatedBudget extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wedding_estimated_budget';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ESTIMATED_BUDGET', 'CURRENCY_ID', 'WEDDING_EVENT_ID'], 'required'],
            [['WEDDING_ID', 'CURRENCY_ID', 'WEDDING_EVENT_ID'], 'integer'],
            [['ESTIMATED_BUDGET'], 'string', 'max' => 50],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
            [['CURRENCY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Currencies::className(), 'targetAttribute' => ['CURRENCY_ID' => 'CURRENCY_ID']],
            [['WEDDING_EVENT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => WeddingEvent::className(), 'targetAttribute' => ['WEDDING_EVENT_ID' => 'WEDDING_EVENT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
            'ESTIMATED_BUDGET' => Yii::t('app', 'Estimated  Budget'),
            'CURRENCY_ID' => Yii::t('app', 'Currency  ID'),
            'WEDDING_EVENT_ID' => Yii::t('app', 'Wedding  Event  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWEDDING()
    {
        return $this->hasOne(Weddings::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCURRENCY()
    {
        return $this->hasOne(Currencies::className(), ['CURRENCY_ID' => 'CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWEDDINGEVENT()
    {
        return $this->hasOne(WeddingEvent::className(), ['WEDDING_EVENT_ID' => 'WEDDING_EVENT_ID']);
    }
}
