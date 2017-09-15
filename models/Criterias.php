<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "criterias".
 *
 * @property integer $CRITERIA_ID
 * @property string $CRITERIA_NAME
 *
 * @property CriteriaValues[] $criteriaValues
 */
class Criterias extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'criterias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CRITERIA_NAME'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CRITERIA_ID' => Yii::t('app', 'Criteria  ID'),
            'CRITERIA_NAME' => Yii::t('app', 'Criteria  Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCriteriaValues()
    {
        return $this->hasMany(CriteriaValues::className(), ['CRITERIA_ID' => 'CRITERIA_ID']);
    }
}
