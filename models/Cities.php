<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cities".
 *
 * @property integer $CITY_ID
 * @property integer $COUNTRY_ID
 *
 * @property Countries $cOUNTRY
 * @property CitiesTranslation[] $citiesTranslations
 */
class Cities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['COUNTRY_ID'], 'integer'],
            [['COUNTRY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['COUNTRY_ID' => 'COUNTRY_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CITY_ID' => Yii::t('app', 'City  ID'),
            'COUNTRY_ID' => Yii::t('app', 'Country  ID'),
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
    public function getCitiesTranslations()
    {
        return $this->hasMany(CitiesTranslation::className(), ['CITY_ID' => 'CITY_ID'])->where('LANGUAGE_ID =1');
    }
}
