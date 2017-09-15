<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "agenda_translation".
 *
 * @property integer $TASK_ID
 * @property string $TASK_NAME
 * @property integer $LANGUAGE_ID
 *
 * @property Agenda $tASK
 * @property Languages $lANGUAGE
 */
class AgendaTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agenda_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TASK_ID', 'LANGUAGE_ID'], 'integer'],
            [['TASK_NAME'], 'string', 'max' => 50],
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
            'TASK_NAME' => Yii::t('app', 'Task  Name'),
            'LANGUAGE_ID' => Yii::t('app', 'Language  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTASK()
    {
        return $this->hasOne(Agenda::className(), ['TASK_ID' => 'TASK_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLANGUAGE()
    {
        return $this->hasOne(Languages::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }
}
