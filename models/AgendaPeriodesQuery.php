<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AgendaPeriodes]].
 *
 * @see AgendaPeriodes
 */
class AgendaPeriodesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return AgendaPeriodes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }
public static function getAllAgendaPeriods(){
    $query=new Query;
        $provider=new ArrayDataProvider(['allModels'=>$query
                ->select('A.AGENDA_PERIODE_ID,T.AGENDA_PERIODE_TRANS_NAME')
                ->from('agenda_periodes A')->innerJoin('agenda_periode_translation T','A.AGENDA_PERIODE_ID=T.AGENDA_PERIOD_ID')
                ->where('T.LANGUAGE_ID= :LANGUAGE_ID',array(':LANGUAGE_ID'=>1))->orderBy('A.SEQUENCE_NUMBER')->all() ,]);
        return $provider;
        
}

public static function getTaskByAgendaPeriodID($AgendaPeriodID){
    $query=new Query;
        $provider=new ArrayDataProvider(['allModels'=>$query
                ->select('A.TASK_ID,T.TASK_NAME')
                ->from('agenda A')->innerJoin('agenda_translation T','A.TASK_ID=T.TASK_ID')
                ->where('T.LANGUAGE_ID= :LANGUAGE_ID',array(':LANGUAGE_ID'=>1))->all() ,]);
        return $provider;
        
}
    /**
     * @inheritdoc
     * @return AgendaPeriodes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
