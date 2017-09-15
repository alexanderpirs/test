<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "option_criteria".
 *
 * @property integer $OPTION_CRITERIA_ID
 * @property integer $OPTION_ID
 * @property integer $CRITERIA_VALUE_ID
 * @property integer $CRITERIA_ID
 *
 * @property ItemOptions $oPTION
 * @property CriteriaValues $cRITERIAVALUE
 * @property Criterias $cRITERIA
 */
class OptionCriteria extends \yii\db\ActiveRecord
{
    
    public $hidden;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'option_criteria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OPTION_ID', 'CRITERIA_VALUE_ID', 'CRITERIA_ID'], 'integer'],
            [['OPTION_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ItemOptions::className(), 'targetAttribute' => ['OPTION_ID' => 'OPTION_ID']],
            [['CRITERIA_VALUE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CriteriaValues::className(), 'targetAttribute' => ['CRITERIA_VALUE_ID' => 'CRITERIA_VALUE_ID']],
            [['CRITERIA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Criterias::className(), 'targetAttribute' => ['CRITERIA_ID' => 'CRITERIA_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'OPTION_CRITERIA_ID' => Yii::t('app', 'Option  Criteria  ID'),
            'OPTION_ID' => Yii::t('app', 'Option  ID'),
            'CRITERIA_VALUE_ID' => Yii::t('app', 'Criteria  Value  ID'),
            'CRITERIA_ID' => Yii::t('app', 'Criteria  ID'),
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
    public function getCRITERIAVALUE()
    {
        return $this->hasOne(CriteriaValues::className(), ['CRITERIA_VALUE_ID' => 'CRITERIA_VALUE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCRITERIA()
    {
        return $this->hasOne(Criterias::className(), ['CRITERIA_ID' => 'CRITERIA_ID']);
    }
}
