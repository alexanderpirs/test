<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "agenda_note".
 *
 * @property integer $TASK_ID
 * @property integer $COUPLE_PARTNER_ID
 * @property string $NOTE
 *
 * @property Agenda $tASK
 * @property CouplePartner $cOUPLEPARTNER
 */
class AgendaNote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agenda_note';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TASK_ID', 'COUPLE_PARTNER_ID'], 'required'],
            [['TASK_ID', 'COUPLE_PARTNER_ID'], 'integer'],
            [['NOTE'], 'string', 'max' => 4000],
            [['TASK_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Agenda::className(), 'targetAttribute' => ['TASK_ID' => 'TASK_ID']],
            [['COUPLE_PARTNER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CouplePartner::className(), 'targetAttribute' => ['COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TASK_ID' => Yii::t('app', 'Task  ID'),
            'COUPLE_PARTNER_ID' => Yii::t('app', 'Couple  Partner  ID'),
            'NOTE' => Yii::t('app', 'Note'),
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
    public function getCOUPLEPARTNER()
    {
        return $this->hasOne(CouplePartner::className(), ['COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']);
    }
}
