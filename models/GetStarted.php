<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "get_started".
 *
 * @property integer $GET_STARTED_ID
 * @property integer $WEDDING_ID
 * @property integer $INVITEE_NUMBER
 * @property string $FUNDING_ESTIMATED_VALUE
 *
 * @property Weddings $wEDDING
 */
class GetStarted extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'get_started';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['WEDDING_ID', 'INVITEE_NUMBER'], 'integer'],
            [['FUNDING_ESTIMATED_VALUE'], 'string', 'max' => 45],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'GET_STARTED_ID' => Yii::t('app', 'Get  Started  ID'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
            'INVITEE_NUMBER' => Yii::t('app', 'Invitee  Number'),
            'FUNDING_ESTIMATED_VALUE' => Yii::t('app', 'Funding  Estimated  Value'),
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
