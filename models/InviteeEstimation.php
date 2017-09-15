<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invitee_estimation".
 *
 * @property integer $INVITEE_ESTIMATED_ID
 * @property string $INVITEE_NUMBER
 * @property integer $WEDDING_ID
 *
 * @property Weddings $wEDDING
 */
class InviteeEstimation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invitee_estimation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['WEDDING_ID'], 'integer'],
            [['INVITEE_NUMBER'], 'string', 'max' => 45],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'INVITEE_ESTIMATED_ID' => Yii::t('app', 'Invitee  Estimated  ID'),
            'INVITEE_NUMBER' => Yii::t('app', 'Invitee  Number'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWEDDING()
    {
        return $this->hasOne(Weddings::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }
}
