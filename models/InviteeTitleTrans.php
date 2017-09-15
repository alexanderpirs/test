<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invitee_title_trans".
 *
 * @property integer $INVITEE_TITLE_ID
 * @property string $INVITEE_TITLE_TRANS
 * @property integer $LANGUAGE_ID
 *
 * @property InviteesTitles $iNVITEETITLE
 * @property Languages $lANGUAGE
 */
class InviteeTitleTrans extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invitee_title_trans';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['INVITEE_TITLE_ID', 'LANGUAGE_ID'], 'integer'],
            [['INVITEE_TITLE_TRANS'], 'string', 'max' => 20],
            [['INVITEE_TITLE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => InviteesTitles::className(), 'targetAttribute' => ['INVITEE_TITLE_ID' => 'INVITEES_TITLES_ID']],
            [['LANGUAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['LANGUAGE_ID' => 'LANGUAGE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'INVITEE_TITLE_ID' => Yii::t('app', 'Invitee  Title  ID'),
            'INVITEE_TITLE_TRANS' => Yii::t('app', 'Invitee  Title  Trans'),
            'LANGUAGE_ID' => Yii::t('app', 'Language  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINVITEETITLE()
    {
        return $this->hasOne(InviteesTitles::className(), ['INVITEES_TITLES_ID' => 'INVITEE_TITLE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLANGUAGE()
    {
        return $this->hasOne(Languages::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }
}
