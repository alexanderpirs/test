<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "marital_status".
 *
 * @property integer $MARITAL_STATUS_ID
 * @property string $MARITAL_NAME
 * @property integer $LANGUAGE_ID
 *
 * @property CouplePartner[] $couplePartners
 * @property Languages $lANGUAGE
 */
class MaritalStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'marital_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LANGUAGE_ID'], 'integer'],
            [['MARITAL_NAME'], 'string', 'max' => 30],
            [['LANGUAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['LANGUAGE_ID' => 'LANGUAGE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'MARITAL_STATUS_ID' => Yii::t('app', 'Marital  Status  ID'),
            'MARITAL_NAME' => Yii::t('app', 'Marital  Name'),
            'LANGUAGE_ID' => Yii::t('app', 'Language  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCouplePartners()
    {
        return $this->hasMany(CouplePartner::className(), ['MARITAL_STATUS_ID' => 'MARITAL_STATUS_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLANGUAGE()
    {
        return $this->hasOne(Languages::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }
}
