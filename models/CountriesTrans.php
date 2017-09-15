<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "countries_trans".
 *
 * @property integer $COUNTRY_ID
 * @property string $COUNTRY_TRANS_NAME
 * @property integer $LANGUAGE_ID
 *
 * @property Countries $cOUNTRY
 * @property Languages $lANGUAGE
 */
class CountriesTrans extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'countries_trans';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['COUNTRY_ID', 'LANGUAGE_ID'], 'integer'],
            [['COUNTRY_TRANS_NAME'], 'string', 'max' => 60],
            [['COUNTRY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['COUNTRY_ID' => 'COUNTRY_ID']],
            [['LANGUAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['LANGUAGE_ID' => 'LANGUAGE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'COUNTRY_ID' => Yii::t('app', 'Country  ID'),
            'COUNTRY_TRANS_NAME' => Yii::t('app', 'Country  Trans  Name'),
            'LANGUAGE_ID' => Yii::t('app', 'Language  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCOUNTRY()
    {
        return $this->hasOne(Countries::className(), ['COUNTRY_ID' => 'COUNTRY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLANGUAGE()
    {
        return $this->hasOne(Languages::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }
}
