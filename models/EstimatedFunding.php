<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estimated_funding".
 *
 * @property integer $ESTIMATED_FUNDING_ID
 * @property string $ESTIMATED_VALUE
 * @property integer $CURRENCY_ID
 * @property integer $WEDDING_ID
 *
 * @property Currencies $cURRENCY
 * @property Weddings $wEDDING
 */
class EstimatedFunding extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estimated_funding';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CURRENCY_ID', 'ESTIMATED_VALUE'], 'required'],
            [['CURRENCY_ID', 'WEDDING_ID'], 'integer'],
            [['ESTIMATED_VALUE'], 'string', 'max' => 45],
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
            'ESTIMATED_FUNDING_ID' => Yii::t('app', 'Estimated  Funding  ID'),
            'ESTIMATED_VALUE' => Yii::t('app', 'Estimated  Value'),
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
