<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wed_sub_category_estimated_budget".
 *
 * @property integer $SUB_CATEGORY_ESTIMATED_ID
 * @property integer $SUB_CATEGORY_ID
 * @property string $ESTIMATED_VALUE
 * @property integer $CURRENCY_ID
 * @property integer $WEDDING_ID
 * @property integer $WEDDING_EVENT_ID
 * @property integer $CATEGORY_ID
 *
 * @property SubCategoriesOfItems $sUBCATEGORY
 * @property Currencies $cURRENCY
 * @property Weddings $wEDDING
 * @property WeddingEvent $wEDDINGEVENT
 * @property CategoryOfItems $cATEGORY
 */
class WedSubCategoryEstimatedBudget extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wed_sub_category_estimated_budget';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SUB_CATEGORY_ID', 'CURRENCY_ID', 'ESTIMATED_VALUE',], 'required'],
            [['SUB_CATEGORY_ID', 'CURRENCY_ID', 'WEDDING_ID', 'WEDDING_EVENT_ID', 'CATEGORY_ID'], 'integer'],
            [['ESTIMATED_VALUE'], 'string', 'max' => 45],
            [['SUB_CATEGORY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SubCategoriesOfItems::className(), 'targetAttribute' => ['SUB_CATEGORY_ID' => 'SUB_CATEGORY_ID']],
            [['CURRENCY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Currencies::className(), 'targetAttribute' => ['CURRENCY_ID' => 'CURRENCY_ID']],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
            [['WEDDING_EVENT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => WeddingEvent::className(), 'targetAttribute' => ['WEDDING_EVENT_ID' => 'WEDDING_EVENT_ID']],
            [['CATEGORY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryOfItems::className(), 'targetAttribute' => ['CATEGORY_ID' => 'CATEGORY_OF_ITEM_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SUB_CATEGORY_ESTIMATED_ID' => Yii::t('app', 'Sub  Category  Estimated  ID'),
            'SUB_CATEGORY_ID' => Yii::t('app', 'Sub  Category  ID'),
            'ESTIMATED_VALUE' => Yii::t('app', 'Estimated  Value'),
            'CURRENCY_ID' => Yii::t('app', 'Currency  ID'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
            'WEDDING_EVENT_ID' => Yii::t('app', 'Wedding  Event  ID'),
            'CATEGORY_ID' => Yii::t('app', 'Category  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSUBCATEGORY()
    {
        return $this->hasOne(SubCategoriesOfItems::className(), ['SUB_CATEGORY_ID' => 'SUB_CATEGORY_ID']);
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
    public function getWEDDING()
    {
        return $this->hasOne(Weddings::className(), ['WEDDING_ID' => 'WEDDING_ID']);
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
    public function getCATEGORY()
    {
        return $this->hasOne(CategoryOfItems::className(), ['CATEGORY_OF_ITEM_ID' => 'CATEGORY_ID']);
    }
}
