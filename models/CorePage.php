<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "core_page".
 *
 * @property integer $CORE_PAGE_ID
 * @property integer $FIRST_FAMILY_TITLE_ID
 * @property string $FIRST_PART_FAMILY_NAME
 * @property integer $SECOND_FAMILY_TITLE_ID
 * @property string $SECOND_PART_FAMILY_NAME
 * @property integer $WEDDING_ID
 * @property integer $INVITATION_FIRST_WORD
 * @property integer $INVITATION_SECOND_WORD
 * @property integer $INVITATION_THIRD_WORD
 * @property integer $INVITATION_FORTH_WORD
 * @property integer $TITLE_FIRST_PART_ID
 * @property string $FIRST_PART_NAME
 * @property integer $TITLE_SECOND_PART_ID
 * @property string $SECOND_PART_NAME
 * @property string $PLACE
 * @property string $DATE_TIME
 * @property string $ADDITIONAL_LINE
 * @property string $LOGO_PATH
 * @property string $QUOTE
 * @property integer $SHAPE_ID
 * @property string $RESPONSE_DATE
 * @property string $PHONE_NUMBER_FIRST
 * @property string $PHONE_NUMBER_SECOND
 * @property string $RSVP_DEATACHED_PAPER
 * @property string $REGISTRY_DEATACHED_PAPER
 * @property resource $REGISTRY_TEXT
 *
 * @property Weddings $wEDDING
 * @property InviteesTitles $fIRSTFAMILYTITLE
 * @property InviteesTitles $sECONDFAMILYTITLE
 * @property InviteesTitles $tITLEFIRSTPART
 * @property InviteesTitles $tITLESECONDPART
 * @property CorePageWords $iNVITATIONFIRSTWORD
 * @property CorePageWords $iNVITATIONSECONDWORD
 * @property CorePageWords $iNVITATIONTHIRDWORD
 * @property CorePageWords $iNVITATIONFORTHWORD
 * @property RegistryProvider[] $registryProviders
 */
class CorePage extends \yii\db\ActiveRecord
{
    public $imageFile;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'core_page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FIRST_FAMILY_TITLE_ID', 'SECOND_FAMILY_TITLE_ID', 'WEDDING_ID', 'INVITATION_FIRST_WORD', 'INVITATION_SECOND_WORD', 'INVITATION_THIRD_WORD', 'INVITATION_FORTH_WORD', 'TITLE_FIRST_PART_ID', 'TITLE_SECOND_PART_ID', 'SHAPE_ID'], 'integer'],
            [['DATE_TIME', 'RESPONSE_DATE'], 'safe'],
            [['REGISTRY_TEXT'], 'string'],
            [['FIRST_PART_FAMILY_NAME', 'SECOND_PART_FAMILY_NAME', 'FIRST_PART_NAME', 'SECOND_PART_NAME'], 'string', 'max' => 100],
            [['PLACE', 'ADDITIONAL_LINE', 'LOGO_PATH', 'QUOTE'], 'string', 'max' => 1000],
            [['PHONE_NUMBER_FIRST', 'PHONE_NUMBER_SECOND'], 'string', 'max' => 45],
            [['RSVP_DEATACHED_PAPER', 'REGISTRY_DEATACHED_PAPER'], 'string', 'max' => 1],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
            [['FIRST_FAMILY_TITLE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => InviteesTitles::className(), 'targetAttribute' => ['FIRST_FAMILY_TITLE_ID' => 'INVITEES_TITLES_ID']],
            [['SECOND_FAMILY_TITLE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => InviteesTitles::className(), 'targetAttribute' => ['SECOND_FAMILY_TITLE_ID' => 'INVITEES_TITLES_ID']],
            [['TITLE_FIRST_PART_ID'], 'exist', 'skipOnError' => true, 'targetClass' => InviteesTitles::className(), 'targetAttribute' => ['TITLE_FIRST_PART_ID' => 'INVITEES_TITLES_ID']],
            [['TITLE_SECOND_PART_ID'], 'exist', 'skipOnError' => true, 'targetClass' => InviteesTitles::className(), 'targetAttribute' => ['TITLE_SECOND_PART_ID' => 'INVITEES_TITLES_ID']],
            [['INVITATION_FIRST_WORD'], 'exist', 'skipOnError' => true, 'targetClass' => CorePageWords::className(), 'targetAttribute' => ['INVITATION_FIRST_WORD' => 'CORE_PAGE_WORDS_ID']],
            [['INVITATION_SECOND_WORD'], 'exist', 'skipOnError' => true, 'targetClass' => CorePageWords::className(), 'targetAttribute' => ['INVITATION_SECOND_WORD' => 'CORE_PAGE_WORDS_ID']],
            [['INVITATION_THIRD_WORD'], 'exist', 'skipOnError' => true, 'targetClass' => CorePageWords::className(), 'targetAttribute' => ['INVITATION_THIRD_WORD' => 'CORE_PAGE_WORDS_ID']],
            [['INVITATION_FORTH_WORD'], 'exist', 'skipOnError' => true, 'targetClass' => CorePageWords::className(), 'targetAttribute' => ['INVITATION_FORTH_WORD' => 'CORE_PAGE_WORDS_ID']],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CORE_PAGE_ID' => Yii::t('app', 'Core  Page  ID'),
            'FIRST_FAMILY_TITLE_ID' => Yii::t('app', 'First  Family  Title  ID'),
            'FIRST_PART_FAMILY_NAME' => Yii::t('app', 'First  Part  Family  Name'),
            'SECOND_FAMILY_TITLE_ID' => Yii::t('app', 'Second  Family  Title  ID'),
            'SECOND_PART_FAMILY_NAME' => Yii::t('app', 'Second  Part  Family  Name'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
            'INVITATION_FIRST_WORD' => Yii::t('app', 'Invitation  First  Word'),
            'INVITATION_SECOND_WORD' => Yii::t('app', 'Invitation  Second  Word'),
            'INVITATION_THIRD_WORD' => Yii::t('app', 'Invitation  Third  Word'),
            'INVITATION_FORTH_WORD' => Yii::t('app', 'Invitation  Forth  Word'),
            'TITLE_FIRST_PART_ID' => Yii::t('app', 'Title  First  Part  ID'),
            'FIRST_PART_NAME' => Yii::t('app', 'First  Part  Name'),
            'TITLE_SECOND_PART_ID' => Yii::t('app', 'Title  Second  Part  ID'),
            'SECOND_PART_NAME' => Yii::t('app', 'Second  Part  Name'),
            'PLACE' => Yii::t('app', 'Place'),
            'DATE_TIME' => Yii::t('app', 'Date  Time'),
            'ADDITIONAL_LINE' => Yii::t('app', 'Additional  Line'),
            'LOGO_PATH' => Yii::t('app', 'Logo  Path'),
            'QUOTE' => Yii::t('app', 'Quote'),
            'SHAPE_ID' => Yii::t('app', 'Shape  ID'),
            'RESPONSE_DATE' => Yii::t('app', 'Response  Date'),
            'PHONE_NUMBER_FIRST' => Yii::t('app', 'Phone  Number  First'),
            'PHONE_NUMBER_SECOND' => Yii::t('app', 'Phone  Number  Second'),
            'RSVP_DEATACHED_PAPER' => Yii::t('app', 'Rsvp  Deatached  Paper'),
            'REGISTRY_DEATACHED_PAPER' => Yii::t('app', 'Registry  Deatached  Paper'),
            'REGISTRY_TEXT' => Yii::t('app', 'Registry  Text'),
        ];
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
    public function getFIRSTFAMILYTITLE()
    {
        return $this->hasOne(InviteesTitles::className(), ['INVITEES_TITLES_ID' => 'FIRST_FAMILY_TITLE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSECONDFAMILYTITLE()
    {
        return $this->hasOne(InviteesTitles::className(), ['INVITEES_TITLES_ID' => 'SECOND_FAMILY_TITLE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTITLEFIRSTPART()
    {
        return $this->hasOne(InviteesTitles::className(), ['INVITEES_TITLES_ID' => 'TITLE_FIRST_PART_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTITLESECONDPART()
    {
        return $this->hasOne(InviteesTitles::className(), ['INVITEES_TITLES_ID' => 'TITLE_SECOND_PART_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINVITATIONFIRSTWORD()
    {
        return $this->hasOne(CorePageWords::className(), ['CORE_PAGE_WORDS_ID' => 'INVITATION_FIRST_WORD']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINVITATIONSECONDWORD()
    {
        return $this->hasOne(CorePageWords::className(), ['CORE_PAGE_WORDS_ID' => 'INVITATION_SECOND_WORD']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINVITATIONTHIRDWORD()
    {
        return $this->hasOne(CorePageWords::className(), ['CORE_PAGE_WORDS_ID' => 'INVITATION_THIRD_WORD']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINVITATIONFORTHWORD()
    {
        return $this->hasOne(CorePageWords::className(), ['CORE_PAGE_WORDS_ID' => 'INVITATION_FORTH_WORD']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegistryProviders()
    {
        return $this->hasMany(RegistryProvider::className(), ['CORE_PAGE_ID' => 'CORE_PAGE_ID']);
    }
}
