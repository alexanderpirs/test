<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "items_trans".
 *
 * @property integer $ITEM_ID
 * @property string $ITEM_NAME
 * @property string $ITEM_DESC
 * @property string $ITEM_PRICE
 * @property integer $CURRENCY_ID
 * @property integer $LANGUAGE_ID
 *
 * @property Items $iTEM
 * @property Currencies $cURRENCY
 * @property Languages $lANGUAGE
 */
class ItemsTrans extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'items_trans';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ITEM_ID', 'CURRENCY_ID', 'LANGUAGE_ID'], 'integer'],
            [['ITEM_NAME'], 'string', 'max' => 100],
            [['ITEM_DESC'], 'string', 'max' => 3000],
            [['ITEM_PRICE'], 'string', 'max' => 20],
            [['ITEM_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['ITEM_ID' => 'ITEM_ID']],
            [['CURRENCY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Currencies::className(), 'targetAttribute' => ['CURRENCY_ID' => 'CURRENCY_ID']],
            [['LANGUAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['LANGUAGE_ID' => 'LANGUAGE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ITEM_ID' => Yii::t('app', 'Item  ID'),
            'ITEM_NAME' => Yii::t('app', 'Item  Name'),
            'ITEM_DESC' => Yii::t('app', 'Item  Desc'),
            'ITEM_PRICE' => Yii::t('app', 'Item  Price'),
            'CURRENCY_ID' => Yii::t('app', 'Currency  ID'),
            'LANGUAGE_ID' => Yii::t('app', 'Language  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getITEM()
    {
        return $this->hasOne(Items::className(), ['ITEM_ID' => 'ITEM_ID']);
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
    public function getLANGUAGE()
    {
        return $this->hasOne(Languages::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }
}
