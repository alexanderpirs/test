<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wed_category_estimated_budget".
 *
 * @property integer $ESTIMATED_BUDGET_ID
 * @property string $ESTIMATED_BUDGET_VALUE
 * @property string $ESTIMATED_BUDGET_PERC
 * @property integer $CATEGORY_ID
 * @property integer $WEDDING_ID
 * @property integer $CURRENCY_ID
 * @property integer $WEDDING_EVENT_ID
 *
 * @property Weddings $wEDDING
 * @property CategoryOfItems $cATEGORY
 * @property Currencies $cURRENCY
 * @property WeddingEvent $wEDDINGEVENT
 */
class WedCategoryEstimatedBudget extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wed_category_estimated_budget';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CATEGORY_ID', 'ESTIMATED_BUDGET_VALUE', 'CURRENCY_ID'], 'required'],
            [['CATEGORY_ID', 'WEDDING_ID', 'CURRENCY_ID', 'WEDDING_EVENT_ID'], 'integer'],
            [['ESTIMATED_BUDGET_VALUE', 'ESTIMATED_BUDGET_PERC'], 'string', 'max' => 20],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
            [['CATEGORY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryOfItems::className(), 'targetAttribute' => ['CATEGORY_ID' => 'CATEGORY_OF_ITEM_ID']],
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
            'ESTIMATED_BUDGET_ID' => Yii::t('app', 'Estimated  Budget  ID'),
            'ESTIMATED_BUDGET_VALUE' => Yii::t('app', 'Estimated  Budget  Value'),
            'ESTIMATED_BUDGET_PERC' => Yii::t('app', 'Estimated  Budget  Perc'),
            'CATEGORY_ID' => Yii::t('app', 'Category  ID'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
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
    public function getCATEGORY()
    {
        return $this->hasOne(CategoryOfItems::className(), ['CATEGORY_OF_ITEM_ID' => 'CATEGORY_ID']);
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
