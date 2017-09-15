<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "private_sponsor".
 *
 * @property integer $PRIVATE_SPONSOR_ID
 * @property string $PRIVATE_SPONSOR_NAME
 * @property string $AMOUNT
 * @property integer $CURRENCY_ID
 * @property integer $RELATED_TO_ID
 * @property integer $RELATION_TYPE_ID
 * @property integer $WEDDING_ID
 * @property integer $INVITEE_ID
 *
 * @property Currencies $cURRENCY
 * @property InviteeRelationTypes $rELATIONTYPE
 * @property CouplePartner $rELATEDTO
 * @property Weddings $wEDDING
 * @property Invitees $iNVITEE
 * @property SavingPrivateSponsor[] $savingPrivateSponsors
 */
class PrivateSponsor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'private_sponsor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CURRENCY_ID', 'RELATED_TO_ID', 'RELATION_TYPE_ID', 'WEDDING_ID', 'INVITEE_ID'], 'integer'],
            [['PRIVATE_SPONSOR_NAME'], 'string', 'max' => 50],
            [['AMOUNT'], 'string', 'max' => 20],
            [['CURRENCY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Currencies::className(), 'targetAttribute' => ['CURRENCY_ID' => 'CURRENCY_ID']],
            [['RELATION_TYPE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => InviteeRelationTypes::className(), 'targetAttribute' => ['RELATION_TYPE_ID' => 'RELATION_TYPE_ID']],
            [['RELATED_TO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CouplePartner::className(), 'targetAttribute' => ['RELATED_TO_ID' => 'COUPLE_PARTNER_ID']],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
            [['INVITEE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Invitees::className(), 'targetAttribute' => ['INVITEE_ID' => 'INVITEE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PRIVATE_SPONSOR_ID' => Yii::t('app', 'Private  Sponsor  ID'),
            'PRIVATE_SPONSOR_NAME' => Yii::t('app', 'Private  Sponsor  Name'),
            'AMOUNT' => Yii::t('app', 'Amount'),
            'CURRENCY_ID' => Yii::t('app', 'Currency  ID'),
            'RELATED_TO_ID' => Yii::t('app', 'Related  To  ID'),
            'RELATION_TYPE_ID' => Yii::t('app', 'Relation  Type  ID'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
            'INVITEE_ID' => Yii::t('app', 'Invitee  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCURRENCY()
    {
        return $this->hasOne(Currencies::className(), ['CURRENCY_ID' => 'CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRELATIONTYPE()
    {
        return $this->hasOne(InviteeRelationTypes::className(), ['RELATION_TYPE_ID' => 'RELATION_TYPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRELATEDTO()
    {
        return $this->hasOne(CouplePartner::className(), ['COUPLE_PARTNER_ID' => 'RELATED_TO_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWEDDING()
    {
        return $this->hasOne(Weddings::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINVITEE()
    {
        return $this->hasOne(Invitees::className(), ['INVITEE_ID' => 'INVITEE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSavingPrivateSponsors()
    {
        return $this->hasMany(SavingPrivateSponsor::className(), ['PRIVATE_SPONSOR_ID' => 'PRIVATE_SPONSOR_ID']);
    }
}
