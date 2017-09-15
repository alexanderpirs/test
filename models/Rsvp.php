<?php
namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class Rsvp
 * @package app\models
 *
 * @property integer $RSVP_ID
 * @property integer $RSVP_RESPONSE
 * @property integer $NUMBER_OF_ATTENDEES
 * @property integer $SEATING_PREFERENCES_ID
 * @property integer $INVITEE_ID
 * @property string  $DIETARY_RESTRICTIONS
 * @property string  $SPECIAL_PREFERENCES
 * @property string  $REPLY_DATE
 */
class Rsvp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rsvp';
    }

    /** @inheritdoc
     *
     */
    public function rules()
    {
        return [
            [['NUMBER_OF_ATTENDEES', 'INVITEE_ID'], 'integer'],
            [['DIETARY_RESTRICTIONS', 'SPECIAL_PREFERENCES'], 'string'],
            [['REPLY_DATE'], 'safe'],
            [['RSVP_RESPONSE'], 'required']
        ];
    }

    /** @inheritdoc
     *
     */
    public function attributeLabels()
    {
        return [
            'RSVP_RESPONSE'          => Yii::t('app', 'Response'),
            'NUMBER_OF_ATTENDEES'    => Yii::t('app', 'NUMBER OF ATTENDEES'),
            'SEATING_PREFERENCES_ID' => Yii::t('app', 'SEATING PREFERENCES ID'),
            'INVITEE_ID'             => Yii::t('app', 'INVITEE ID'),
            'DIETARY_RESTRICTIONS'   => Yii::t('app', 'DIETARY RESTRICTIONS'),
            'REPLY_DATE'             => Yii::t('app', 'REPLY DATE')
        ];
    }

    /** Method of getting ids from INVITES_CIRCLE table
     *
     * @return array
     */
    public function getInvitesCircleIds()
    {
        $invitesCircleIds = ArrayHelper::getColumn(InviteesCircle::find()->asArray()->all(), 'INVITEE_CIRLE_ID');
        $data = [];
        if ($invitesCircleIds) {
            foreach ($invitesCircleIds as $item) {
                $data[$item] = $item;
            }
        }

        return $data;
    }

    /** @inheritdoc */
    public function init()
    {
        return $this-> REPLY_DATE = date('Y-m-d H:i:s');
    }
}