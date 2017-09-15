<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invitees_place_with_trans".
 *
 * @property integer $INVITEE_PLACE_WITH_ID
 * @property string $INVITEE_PALCE_WITH_VALUE
 * @property integer $LANGUAGE_ID
 *
 * @property InviteesPlaceWith $iNVITEEPLACEWITH
 * @property Languages $lANGUAGE
 */
class InviteesPlaceWithTrans extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invitees_place_with_trans';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['INVITEE_PLACE_WITH_ID', 'LANGUAGE_ID'], 'integer'],
            [['INVITEE_PALCE_WITH_VALUE'], 'string', 'max' => 105],
            [['INVITEE_PLACE_WITH_ID'], 'exist', 'skipOnError' => true, 'targetClass' => InviteesPlaceWith::className(), 'targetAttribute' => ['INVITEE_PLACE_WITH_ID' => 'INVITEE_PLACE_WITH_ID']],
            [['LANGUAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['LANGUAGE_ID' => 'LANGUAGE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'INVITEE_PLACE_WITH_ID' => Yii::t('app', 'Invitee  Place  With  ID'),
            'INVITEE_PALCE_WITH_VALUE' => Yii::t('app', 'Invitee  Palce  With  Value'),
            'LANGUAGE_ID' => Yii::t('app', 'Language  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINVITEEPLACEWITH()
    {
        return $this->hasOne(InviteesPlaceWith::className(), ['INVITEE_PLACE_WITH_ID' => 'INVITEE_PLACE_WITH_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLANGUAGE()
    {
        return $this->hasOne(Languages::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }
}
