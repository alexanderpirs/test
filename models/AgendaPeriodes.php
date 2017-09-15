<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "agenda_periodes".
 *
 * @property integer $AGENDA_PERIODE_ID
 * @property integer $FROM_PERIOD
 * @property integer $TO_PERIOD
 * @property string $PERIOD_FLAG
 * @property integer $SEQUENCE_NUMBER
 *
 * @property Agenda[] $agendas
 * @property AgendaPeriodeTranslation[] $agendaPeriodeTranslations
 * @property PrivateTasks[] $privateTasks
 */
class AgendaPeriodes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agenda_periodes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FROM_PERIOD', 'TO_PERIOD', 'SEQUENCE_NUMBER'], 'integer'],
            [['PERIOD_FLAG'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AGENDA_PERIODE_ID' => Yii::t('app', 'Agenda  Periode  ID'),
            'FROM_PERIOD' => Yii::t('app', 'From  Period'),
            'TO_PERIOD' => Yii::t('app', 'To  Period'),
            'PERIOD_FLAG' => Yii::t('app', 'Period  Flag'),
            'SEQUENCE_NUMBER' => Yii::t('app', 'Sequence  Number'),
            'agenda_periode_translation.AGENDA_PERIODE_TRANS_NAME' => Yii::t('app', 'Period Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgendas()
    {
        $WeddingID=0;
        if(Yii::$app->user->identity!=null &&Yii::$app->user->identity->weddings0!=null && sizeof(Yii::$app->user->identity->weddings0)>0){
 $WeddingID=  Yii::$app->user->identity->weddings0[0]->WEDDING_ID; 
}else if(Yii::$app->user->identity!=null &&Yii::$app->user->identity->weddings!=null && sizeof(Yii::$app->user->identity->weddings)>0){
 $WeddingID=  Yii::$app->user->identity->weddings[0]->WEDDING_ID;    
}
$Condition="WEDDING_ID IS NULL OR WEDDING_ID =".$WeddingID;
if($WeddingID==0){
 $Condition="WEDDING_ID IS NULL AND PUBLIC_PRIVATE_FLAG = 'P'";   
}
        return $this->hasMany(Agenda::className(), ['AGENDA_PERIODE_ID' => 'AGENDA_PERIODE_ID'])->andWhere($Condition);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgendaPeriodeTranslations()
    {
        return $this->hasMany(AgendaPeriodeTranslation::className(), ['AGENDA_PERIOD_ID' => 'AGENDA_PERIODE_ID'])->where('LANGUAGE_ID = 1');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrivateTasks()
    {
        return $this->hasMany(PrivateTasks::className(), ['AGENDA_PERIOD_ID' => 'AGENDA_PERIODE_ID'])->where('PUBLIC_PRIVATE_FLAG=P');
    }
}
