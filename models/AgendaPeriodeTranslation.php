<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "agenda_periode_translation".
 *
 * @property integer $AGENDA_PERIOD_ID
 * @property string $AGENDA_PERIODE_TRANS_NAME
 * @property integer $LANGUAGE_ID
 *
 * @property AgendaPeriodes $aGENDAPERIOD
 * @property Languages $lANGUAGE
 */
class AgendaPeriodeTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agenda_periode_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AGENDA_PERIOD_ID', 'LANGUAGE_ID'], 'integer'],
            [['AGENDA_PERIODE_TRANS_NAME'], 'string', 'max' => 100],
            [['AGENDA_PERIOD_ID'], 'exist', 'skipOnError' => true, 'targetClass' => AgendaPeriodes::className(), 'targetAttribute' => ['AGENDA_PERIOD_ID' => 'AGENDA_PERIODE_ID']],
            [['LANGUAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['LANGUAGE_ID' => 'LANGUAGE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AGENDA_PERIOD_ID' => Yii::t('app', 'Agenda  Period  ID'),
            'AGENDA_PERIODE_TRANS_NAME' => Yii::t('app', 'Agenda  Periode  Trans  Name'),
            'LANGUAGE_ID' => Yii::t('app', 'Language  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAGENDAPERIOD()
    {
        return $this->hasOne(AgendaPeriodes::className(), ['AGENDA_PERIODE_ID' => 'AGENDA_PERIOD_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLANGUAGE()
    {
        return $this->hasOne(Languages::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }
}
