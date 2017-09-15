<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "agenda".
 *
 * @property integer $TASK_ID
 * @property string $TASK_NAME
 * @property integer $LANGUAGE_ID
 * @property string $PATH
 * @property string $PUBLIC_PRIVATE_FLAG
 * @property integer $WEDDING_TYPE_ID
 * @property integer $COUNTRY_ID
 * @property integer $AGENDA_PERIODE_ID
 * @property integer $WEDDING_EVENT_ID
 * @property string $TASK_LINK_TO_PAGE
 * @property integer $WEDDING_ID 
 *
 * @property Countries $cOUNTRY
 * @property WeddingType $wEDDINGTYPE
 * @property Languages $lANGUAGE
 * @property AgendaPeriodes $aGENDAPERIODE
 * @property WeddingEvent $wEDDINGEVENT
 * @property AgendaCountries[] $agendaCountries
 * @property AgendaNote[] $agendaNotes
 * @property Weddings $wEDDING 
 * @property CouplePartner[] $cOUPLEPARTNERs 
 * @property AgendaTipsTrans[] $agendaTipsTrans
 * @property AgendaTranslation[] $agendaTranslations
 * @property AgendaWeddingType[] $agendaWeddingTypes
 * @property ItemsAgenda[] $itemsAgendas
 * @property WeddingAgendaTasks[] $weddingAgendaTasks
 */
class Agenda extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agenda';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LANGUAGE_ID', 'WEDDING_TYPE_ID', 'COUNTRY_ID', 'AGENDA_PERIODE_ID', 'WEDDING_EVENT_ID','WEDDING_ID'], 'integer'],
            [['TASK_NAME', 'PATH'], 'string', 'max' => 100],
            [['PUBLIC_PRIVATE_FLAG'], 'string', 'max' => 1],
            [['TASK_LINK_TO_PAGE'], 'string', 'max' => 1000],
            [['COUNTRY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['COUNTRY_ID' => 'COUNTRY_ID']],
            [['WEDDING_TYPE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => WeddingType::className(), 'targetAttribute' => ['WEDDING_TYPE_ID' => 'WEDDING_TYPE_ID']],
            [['LANGUAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['LANGUAGE_ID' => 'LANGUAGE_ID']],
            [['AGENDA_PERIODE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => AgendaPeriodes::className(), 'targetAttribute' => ['AGENDA_PERIODE_ID' => 'AGENDA_PERIODE_ID']],
            [['WEDDING_EVENT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => WeddingEvent::className(), 'targetAttribute' => ['WEDDING_EVENT_ID' => 'WEDDING_EVENT_ID']],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']], 
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
            'PATH' => Yii::t('app', 'Path'),
            'PUBLIC_PRIVATE_FLAG' => Yii::t('app', 'Public  Private  Flag'),
            'WEDDING_TYPE_ID' => Yii::t('app', 'Wedding  Type  ID'),
            'COUNTRY_ID' => Yii::t('app', 'Country  ID'),
            'AGENDA_PERIODE_ID' => Yii::t('app', 'Agenda  Periode  ID'),
            'WEDDING_EVENT_ID' => Yii::t('app', 'Wedding  Event  ID'),
            'TASK_LINK_TO_PAGE' => Yii::t('app', 'Task  Link  To  Page'),
            'WEDDING_ID' => Yii::t('app', 'Wedding ID'), 
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCOUNTRY()
    {
        return $this->hasOne(Countries::className(), ['COUNTRY_ID' => 'COUNTRY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWEDDINGTYPE()
    {
        return $this->hasOne(WeddingType::className(), ['WEDDING_TYPE_ID' => 'WEDDING_TYPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLANGUAGE()
    {
        return $this->hasOne(Languages::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAGENDAPERIODE()
    {
        return $this->hasOne(AgendaPeriodes::className(), ['AGENDA_PERIODE_ID' => 'AGENDA_PERIODE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWEDDINGEVENT()
    {
        return $this->hasOne(WeddingEvent::className(), ['WEDDING_EVENT_ID' => 'WEDDING_EVENT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgendaCountries()
    {
        return $this->hasMany(AgendaCountries::className(), ['TASK_ID' => 'TASK_ID'])->where('COUNTRY_ID = 1');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgendaNotes()
    {
         $CouplePartnerID = 0;

if (Yii::$app->user->identity!=null ) {
    $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID;
   
} 
        return $this->hasMany(AgendaNote::className(), ['TASK_ID' => 'TASK_ID'])->where('COUPLE_PARTNER_ID = '.$CouplePartnerID);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgendaTipsTrans()
    {
        return $this->hasMany(AgendaTipsTrans::className(), ['TASK_ID' => 'TASK_ID'])->where('LANGUAGE_ID = 1');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgendaTranslations()
    {
        return $this->hasMany(AgendaTranslation::className(), ['TASK_ID' => 'TASK_ID'])->where('LANGUAGE_ID=1');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgendaWeddingTypes()
    {
        return $this->hasMany(AgendaWeddingType::className(), ['TASK_ID' => 'TASK_ID'])->where('WEDDING_TYPE_ID=1');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsAgendas()
    {
        return $this->hasMany(ItemsAgenda::className(), ['TASK_ID' => 'TASK_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingAgendaTasks()
    {
        $WeddingID = 0;

if (Yii::$app->user->identity!=null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
    $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
   
} else if (Yii::$app->user->identity!=null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
    $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
    
}
        return $this->hasMany(WeddingAgendaTasks::className(), ['AGENDA_TASKS_ID' => 'TASK_ID'])->where('WEDDING_ID='.$WeddingID);
    }
    
     public function getWEDDING() 
   { 
       return $this->hasOne(Weddings::className(), ['WEDDING_ID' => 'WEDDING_ID']); 
   } 
 
}
