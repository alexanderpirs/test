<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "total_estimated_budget".
 *
 * @property integer $TOTAL_ESTIMATEG_BUDGET_ID
 * @property string $TOTAL_ESTIMATEG_BUDGET_VALUE
 * @property integer $CURRENCY_ID
 * @property integer $WEDDING_ID
 *
 * @property Currencies $cURRENCY
 * @property Weddings $wEDDING
 */
class TotalEstimatedBudget extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'total_estimated_budget';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CURRENCY_ID', 'TOTAL_ESTIMATEG_BUDGET_VALUE'], 'required'],
            [['CURRENCY_ID', 'WEDDING_ID'], 'integer'],
            [['TOTAL_ESTIMATEG_BUDGET_VALUE'], 'string', 'max' => 45],
            [['CURRENCY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Currencies::className(), 'targetAttribute' => ['CURRENCY_ID' => 'CURRENCY_ID']],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TOTAL_ESTIMATEG_BUDGET_ID' => Yii::t('app', 'Total  Estimateg  Budget  ID'),
            'TOTAL_ESTIMATEG_BUDGET_VALUE' => Yii::t('app', 'Total  Estimateg  Budget  Value'),
            'CURRENCY_ID' => Yii::t('app', 'Currency  ID'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
        ];
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
}
