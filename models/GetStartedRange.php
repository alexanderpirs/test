<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "get_started_range".
 *
 * @property integer $RANGE_ID
 * @property string $FROM_AMOUNT
 * @property string $TO_AMOUNT
 * @property integer $CURRENCY_ID
 *
 * @property Currencies $cURRENCY
 */
class GetStartedRange extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'get_started_range';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CURRENCY_ID'], 'integer'],
            [['FROM_AMOUNT', 'TO_AMOUNT'], 'string', 'max' => 45],
            [['CURRENCY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Currencies::className(), 'targetAttribute' => ['CURRENCY_ID' => 'CURRENCY_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'RANGE_ID' => Yii::t('app', 'Range  ID'),
            'FROM_AMOUNT' => Yii::t('app', 'From  Amount'),
            'TO_AMOUNT' => Yii::t('app', 'To  Amount'),
            'CURRENCY_ID' => Yii::t('app', 'Currency  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCURRENCY()
    {
        return $this->hasOne(Currencies::className(), ['CURRENCY_ID' => 'CURRENCY_ID']);
    }
}
