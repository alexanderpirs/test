<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wedding_agenda_tasks".
 *
 * @property integer $WEDDING_ID
 * @property integer $AGENDA_TASKS_ID
 * @property integer $POSTED_BY
 * @property string $NEED_TO_BE_APPROVED
 * @property string $ACTION
 * @property integer $WEDDING_AGENDA_TASK_ID
 * @property integer $POSTING_DATE
 *
 * @property Weddings $wEDDING
 * @property CouplePartner $pOSTEDBY
 * @property Agenda $aGENDATASKS
 */
class WeddingAgendaTasks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wedding_agenda_tasks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['WEDDING_ID', 'AGENDA_TASKS_ID', 'POSTED_BY'], 'integer'],
            [['AGENDA_TASKS_ID'], 'each', 'rule' => ['integer']],
            [['NEED_TO_BE_APPROVED', 'ACTION'], 'string', 'max' => 1],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
            [['POSTED_BY'], 'exist', 'skipOnError' => true, 'targetClass' => CouplePartner::className(), 'targetAttribute' => ['POSTED_BY' => 'COUPLE_PARTNER_ID']],
            [['AGENDA_TASKS_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Agenda::className(), 'targetAttribute' => ['AGENDA_TASKS_ID' => 'TASK_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
            'AGENDA_TASKS_ID' => Yii::t('app', 'Agenda  Tasks  ID'),
            'POSTED_BY' => Yii::t('app', 'Posted  By'),
            'NEED_TO_BE_APPROVED' => Yii::t('app', 'Need  To  Be  Approved'),
            'ACTION' => Yii::t('app', 'Action'),
            'WEDDING_AGENDA_TASK_ID' => Yii::t('app', 'Wedding  Agenda  Task  ID'),
            'POSTING_DATE' =>Yii::t('app', 'Posting Date')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWEDDING()
    {
        return $this->hasOne(Weddings::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPOSTEDBY()
    {
        return $this->hasOne(CouplePartner::className(), ['COUPLE_PARTNER_ID' => 'POSTED_BY']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAGENDATASKS()
    {
        return $this->hasOne(Agenda::className(), ['TASK_ID' => 'AGENDA_TASKS_ID']);
    }
}
