<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "genders".
 *
 * @property integer $GENDER_ID
 * @property string $GENDER_NAME
 * @property integer $LANGUAGE_ID
 * @property integer $GENDER_GROUP
 *
 * @property GenderTranslation[] $genderTranslations
 * @property Languages $lANGUAGE
 */
class genders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'genders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LANGUAGE_ID', 'GENDER_GROUP'], 'integer'],
            [['GENDER_NAME'], 'string', 'max' => 20],
            [['LANGUAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['LANGUAGE_ID' => 'LANGUAGE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'GENDER_ID' => 'Gender  ID',
            'GENDER_NAME' => 'Gender  Name',
            'LANGUAGE_ID' => 'Language  ID',
            'GENDER_GROUP' => 'Gender  Group',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenderTranslations()
    {
        return $this->hasMany(GenderTranslation::className(), ['GENDER_ID' => 'GENDER_ID'])->where(' LANGUAGE_ID = 1');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLANGUAGE()
    {
        return $this->hasOne(Languages::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }
}
