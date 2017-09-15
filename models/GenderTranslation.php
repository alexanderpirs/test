<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gender_translation".
 *
 * @property integer $GENDER_ID
 * @property string $GENDER_TRANS_VALUE
 * @property integer $LANGUAGE_ID
 *
 * @property Genders $gENDER
 * @property Languages $lANGUAGE
 */
class GenderTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gender_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['GENDER_ID', 'LANGUAGE_ID'], 'integer'],
            [['GENDER_TRANS_VALUE'], 'string', 'max' => 20],
            [['GENDER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Genders::className(), 'targetAttribute' => ['GENDER_ID' => 'GENDER_ID']],
            [['LANGUAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['LANGUAGE_ID' => 'LANGUAGE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'GENDER_ID' => Yii::t('app', 'Gender  ID'),
            'GENDER_TRANS_VALUE' => Yii::t('app', 'Gender  Trans  Value'),
            'LANGUAGE_ID' => Yii::t('app', 'Language  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGENDER()
    {
        return $this->hasOne(Genders::className(), ['GENDER_ID' => 'GENDER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLANGUAGE()
    {
        return $this->hasOne(Languages::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }
}
