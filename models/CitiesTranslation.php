<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cities_translation".
 *
 * @property integer $CITY_ID
 * @property string $CITY_TRANSLATION
 * @property integer $LANGUAGE_ID
 *
 * @property Cities $cITY
 * @property Languages $lANGUAGE
 */
class CitiesTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cities_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CITY_ID', 'LANGUAGE_ID'], 'integer'],
            [['CITY_TRANSLATION'], 'string', 'max' => 100],
            [['CITY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['CITY_ID' => 'CITY_ID']],
            [['LANGUAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['LANGUAGE_ID' => 'LANGUAGE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CITY_ID' => Yii::t('app', 'City  ID'),
            'CITY_TRANSLATION' => Yii::t('app', 'City  Translation'),
            'LANGUAGE_ID' => Yii::t('app', 'Language  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCITY()
    {
        return $this->hasOne(Cities::className(), ['CITY_ID' => 'CITY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLANGUAGE()
    {
        return $this->hasOne(Languages::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }
}
