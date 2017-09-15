<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invitees_circles_trans".
 *
 * @property integer $INVITEE_CIRCLE_ID
 * @property string $INVITEE_CIRCLE_TRANS
 * @property integer $LANGUAGE_ID
 *
 * @property InviteesCircle $iNVITEECIRCLE
 * @property Languages $lANGUAGE
 */
class InviteesCirclesTrans extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invitees_circles_trans';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['INVITEE_CIRCLE_ID', 'LANGUAGE_ID'], 'integer'],
            [['INVITEE_CIRCLE_TRANS'], 'string', 'max' => 100],
            [['INVITEE_CIRCLE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => InviteesCircle::className(), 'targetAttribute' => ['INVITEE_CIRCLE_ID' => 'INVITEE_CIRLE_ID']],
            [['LANGUAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['LANGUAGE_ID' => 'LANGUAGE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'INVITEE_CIRCLE_ID' => Yii::t('app', 'Invitee  Circle  ID'),
            'INVITEE_CIRCLE_TRANS' => Yii::t('app', 'Invitee  Circle  Trans'),
            'LANGUAGE_ID' => Yii::t('app', 'Language  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINVITEECIRCLE()
    {
        return $this->hasOne(InviteesCircle::className(), ['INVITEE_CIRLE_ID' => 'INVITEE_CIRCLE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLANGUAGE()
    {
        return $this->hasOne(Languages::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }
}
