<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "agenda_tips_trans".
 *
 * @property integer $TASK_ID
 * @property string $TIPS_VALUE
 * @property integer $LANGUAGE_ID
 *
 * @property Agenda $tASK
 * @property Languages $lANGUAGE
 */
class AgendaTipsTrans extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agenda_tips_trans';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TASK_ID', 'LANGUAGE_ID'], 'integer'],
            [['TIPS_VALUE'], 'string', 'max' => 3999],
            [['TASK_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Agenda::className(), 'targetAttribute' => ['TASK_ID' => 'TASK_ID']],
            [['LANGUAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['LANGUAGE_ID' => 'LANGUAGE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TASK_ID' => Yii::t('app', 'Task  ID'),
            'TIPS_VALUE' => Yii::t('app', 'Tips  Value'),
            'LANGUAGE_ID' => Yii::t('app', 'Language  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTASK()
    {
        return $this->hasOne(Agenda::className(), ['TASK_ID' => 'TASK_ID'])->where('LANGUAGE_ID = 1');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLANGUAGE()
    {
        return $this->hasOne(Languages::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }
}
