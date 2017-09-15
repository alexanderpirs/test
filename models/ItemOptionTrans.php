<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_option_trans".
 *
 * @property integer $OPTION_ID
 * @property string $OPTION_NAME
 * @property string $OPTION_PRICE
 * @property integer $CURRENCY_ID
 * @property integer $LANGUAGE_ID
 * @property integer $QUANTITY_NUMBER
 * @property string $FROM_AMOUNT
 * @property string $TO_AMOUNT
 * @property string $RATE
 * @property string $DURATION
 * @property string $OPTION_DESC
 *
 * @property ItemOptions $oPTION
 * @property Currencies $cURRENCY
 */
class ItemOptionTrans extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_option_trans';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OPTION_ID', 'CURRENCY_ID', 'LANGUAGE_ID', 'QUANTITY_NUMBER'], 'integer'],
            [['OPTION_DESC'], 'string'],
            [['OPTION_NAME'], 'string', 'max' => 50],
            [['OPTION_PRICE', 'FROM_AMOUNT', 'TO_AMOUNT', 'RATE', 'DURATION'], 'string', 'max' => 20],
            [['OPTION_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ItemOptions::className(), 'targetAttribute' => ['OPTION_ID' => 'OPTION_ID']],
            [['CURRENCY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Currencies::className(), 'targetAttribute' => ['CURRENCY_ID' => 'CURRENCY_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'OPTION_ID' => Yii::t('app', 'Option  ID'),
            'OPTION_NAME' => Yii::t('app', 'Option  Name'),
            'OPTION_PRICE' => Yii::t('app', 'Option  Price'),
            'CURRENCY_ID' => Yii::t('app', 'Currency  ID'),
            'LANGUAGE_ID' => Yii::t('app', 'Language  ID'),
            'QUANTITY_NUMBER' => Yii::t('app', 'Quantity  Number'),
            'FROM_AMOUNT' => Yii::t('app', 'From  Amount'),
            'TO_AMOUNT' => Yii::t('app', 'To  Amount'),
            'RATE' => Yii::t('app', 'Rate'),
            'DURATION' => Yii::t('app', 'Duration'),
            'OPTION_DESC' => Yii::t('app', 'Option  Desc'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOPTION()
    {
        return $this->hasOne(ItemOptions::className(), ['OPTION_ID' => 'OPTION_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCURRENCY()
    {
        return $this->hasOne(Currencies::className(), ['CURRENCY_ID' => 'CURRENCY_ID']);
    }
}
