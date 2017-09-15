<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wedding_event".
 *
 * @property integer $WEDDING_EVENT_ID
 * @property integer $WEDDING_ID
 * @property integer $EVENT_SEQUENCE_NUMBER
 * @property string $WEDDING_EVENT_VALUE
 * @property string $PUBLIC_PRIVATE
 *
 * @property Agenda[] $agendas
 * @property Weddings $wEDDING
 * @property WeddingEventTranslation[] $weddingEventTranslations
 * @property WeddingTentativePeriodes[] $weddingTentativePeriodes
 * @property InviteeEvents[] $inviteeEvents 
 * @property Invitees[] $invitees 
 * @property WedCategoryEstimatedBudget[] $wedCategoryEstimatedBudgets 
 * @property WedProductEstimation[] $wedProductEstimations 
 * @property WedSubCategoryEstimatedBudget[] $wedSubCategoryEstimatedBudgets 
 * @property WeddingEstimatedBudget[] $weddingEstimatedBudgets 
 * @property WedsiteHomeEvents[] $wedsiteHomeEvents 
 * @property WedsiteEventsInfo[] $wedsiteEventsInfos
 */
class WeddingEvent extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'wedding_event';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['WEDDING_ID', 'EVENT_SEQUENCE_NUMBER'], 'integer'],
            [['WEDDING_EVENT_VALUE'], 'required'],
            [['WEDDING_EVENT_VALUE'], 'string', 'max' => 100],
            [['PUBLIC_PRIVATE'], 'string', 'max' => 1],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'WEDDING_EVENT_ID' => Yii::t('app', 'Wedding  Event  ID'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
            'EVENT_SEQUENCE_NUMBER' => Yii::t('app', 'Event  Sequence  Number'),
            'WEDDING_EVENT_VALUE' => Yii::t('app', 'Wedding  Event  Value'),
            'PUBLIC_PRIVATE' => Yii::t('app', 'Public Private'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery 
     */
    public function getInviteeEvents() {
        return $this->hasMany(InviteeEvents::className(), ['EVENT_ID' => 'WEDDING_EVENT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery 
     */
    public function getInvitees() {
        return $this->hasMany(Invitees::className(), ['WEDDING_EVENT_ID' => 'WEDDING_EVENT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery 
     */
    public function getWedCategoryEstimatedBudgets() {
        return $this->hasMany(WedCategoryEstimatedBudget::className(), ['WEDDING_EVENT_ID' => 'WEDDING_EVENT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery 
     */
    public function getWedProductEstimations() {
        return $this->hasMany(WedProductEstimation::className(), ['WEDDING_EVENT_ID' => 'WEDDING_EVENT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery 
     */
    public function getWedSubCategoryEstimatedBudgets() {
        return $this->hasMany(WedSubCategoryEstimatedBudget::className(), ['WEDDING_EVENT_ID' => 'WEDDING_EVENT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery 
     */
    public function getWeddingEstimatedBudgets() {
        return $this->hasMany(WeddingEstimatedBudget::className(), ['WEDDING_EVENT_ID' => 'WEDDING_EVENT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgendas() {
        return $this->hasMany(Agenda::className(), ['WEDDING_EVENT_ID' => 'WEDDING_EVENT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWEDDING() {
        return $this->hasOne(Weddings::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingEventTranslations() {
        return $this->hasMany(WeddingEventTranslation::className(), ['wedding_event_id' => 'WEDDING_EVENT_ID'])->where(' LANGUAGE_ID = 1');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingTentativePeriodes() {

        $WeddingID = 0;

        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        return $this->hasMany(WeddingTentativePeriodes::className(), ['WEDDING_EVENT_ID' => 'WEDDING_EVENT_ID'])->where('WEDDING_ID = ' . $WeddingID);
    }

    public function getWedsiteHomeEvents() {

        $WeddingID = 0;

        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        return $this->hasMany(WedsiteHomeEvents::className(), ['EVENT_ID' => 'WEDDING_EVENT_ID'])->where('WEDDING_ID = ' . $WeddingID);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWedsiteEventsInfos() {
        $WeddingID = 0;

        if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        return $this->hasMany(WedsiteEventsInfo::className(), ['WEDDING_EVENT_ID' => 'WEDDING_EVENT_ID'])->where('WEDDING_ID = ' . $WeddingID);
    }

}
