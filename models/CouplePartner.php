<?php

namespace app\models;

use Yii;
use codeonyii\yii2validators\AtLeastValidator;
/**
 * This is the model class for table "couple_partner".
 *
 * @property integer $COUPLE_PARTNER_ID
 * @property string $COUPLE_PARTNER_FIRST_NAME
 * @property string $COUPLE_PARTNER_MIDDLE_NAME
 * @property string $COUPLE_PARTNER_LAST_NAME
 * @property string $COUPLE_PARTNER_EMAIL
 * @property string $COUPLE_PARTNER_PASSWORD
 * @property string $COUPLE_PARTNER_MOBILE_NUMBER
 * @property string $COUPLE_PARTNER_ADDRESS
 * @property integer $GENDER_ID
 * @property string $BIRTHDAY
 * @property integer $SUPPLIER_ID 
 * @property integer $MARITAL_STATUS_ID
 * @property string $PIN
 * @property string $FACEBOOK_EMAIL
 * @property string $FACEBOOK_ID
 * @property integer $COUNTRY_ID
 * @property integer $CITY_ID
 * @property string $ZIP_CODE
 * @property string $USER_PROFILE_PIC
 * @property string $authKey
 *
 * @property AgendaNote[] $agendaNotes
 * @property Agenda[] $tASKs
 * @property ContactsDefaultInviteBy[] $contactsDefaultInviteBies
 * @property MaritalStatus $mARITALSTATUS
 * @property Suppliers $sUPPLIER 
 * @property Invitees[] $invitees
 * @property Invitees[] $invitees0
 * @property ItemOptions[] $itemOptions
 * @property ItemRatingComment[] $itemRatingComments
 * @property Items[] $items
 * @property PersonalContribution[] $personalContributions
 * @property PrivateSponsor[] $privateSponsors
 * @property PrivateTasks[] $privateTasks
 * @property SupportChat[] $supportChats
 * @property UserGroup[] $userGroups
 * @property WeddingAgendaTasks[] $weddingAgendaTasks
 * @property WeddingTentativePeriodes[] $weddingTentativePeriodes
 * @property WeddingTentativePeriodes[] $weddingTentativePeriodes0
 * @property Weddings[] $weddings
 * @property Weddings[] $weddings0
 */
class CouplePartner extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface {
public $password_repeat;
public $Country;
public $Gender;
public $reCaptcha;
public $City;
public $First_Name;
public $Last_Name;
public $imageFile;
public $TechPassword;
Public $TechRepeatPassword;
public $TechEmail;
public $TechPhone;
public $SecondEmail;
public $SecondPhoneNumber;
private $_addOtherOneOfTwoValidationError = true;
private $email;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'couple_partner';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['GENDER_ID', 'MARITAL_STATUS_ID', 'COUNTRY_ID', 'CITY_ID','SUPPLIER_ID','COUPLE_PARTNER_MOBILE_NUMBER'], 'integer'],
            [['BIRTHDAY'], 'safe'],
            [['COUPLE_PARTNER_EMAIL','SecondEmail','TechEmail'], 'email'],
            [['COUPLE_PARTNER_FIRST_NAME','COUPLE_PARTNER_MIDDLE_NAME','First_Name','Last_Name', 'COUPLE_PARTNER_LAST_NAME'], 'string', 'max' => 30],
            [['COUPLE_PARTNER_FIRST_NAME','COUPLE_PARTNER_LAST_NAME','First_Name','Last_Name','COUPLE_PARTNER_PASSWORD','GENDER_ID','COUNTRY_ID'], 'required'],
            [['COUPLE_PARTNER_EMAIL', 'COUPLE_PARTNER_MOBILE_NUMBER'], AtLeastValidator::className(), 'in' => ['COUPLE_PARTNER_EMAIL', 'COUPLE_PARTNER_MOBILE_NUMBER'], 'min' => 1],
            [['SecondEmail', 'SecondPhoneNumber'], AtLeastValidator::className(), 'in' => ['SecondEmail', 'SecondPhoneNumber'], 'min' => 1],
            [['TechEmail', 'TechPhone'], AtLeastValidator::className(), 'in' => ['TechEmail', 'TechPhone'], 'min' => 1],
            [['COUPLE_PARTNER_EMAIL'], 'string', 'max' => 70],
            [['TechEmail'], 'string', 'max' => 70],
//            ['COUPLE_PARTNER_EMAIL', 'unique','className'=>'CouplePartner','attributeName'=>'COUPLE_PARTNER_EMAIL','message'=>"Username already exists"],
//            ['SecondEmail', 'unique','className'=>'CouplePartner','attributeName'=>'COUPLE_PARTNER_EMAIL','message'=>"Username already exists"],
//            ['TechEmail', 'unique','className'=>'CouplePartner','attributeName'=>'COUPLE_PARTNER_EMAIL','message'=>"Username already exists"],
            ['COUPLE_PARTNER_EMAIL','uniqueEmail'],
            ['SecondEmail','SecondPArtneruniqueEmail'],
            ['TechEmail','TechUniqueEmail'],
            [['COUPLE_PARTNER_PASSWORD', 'authKey'], 'string', 'max' => 50],
            [['TechRepeatPassword', 'authKey'], 'string', 'max' => 50],
            ['password_repeat', 'compare', 'compareAttribute'=>'COUPLE_PARTNER_PASSWORD', 'skipOnEmpty' => false, 'message'=>"Passwords don't match"],
            ['TechRepeatPassword', 'compare', 'compareAttribute'=>'TechPassword', 'skipOnEmpty' => false, 'message'=>"Passwords don't matchhhh"],
            [['COUPLE_PARTNER_MOBILE_NUMBER'], 'string', 'max' => 15],
            [['COUPLE_PARTNER_ADDRESS'], 'string', 'max' => 2000],
            [['PIN'], 'string', 'max' => 20],
            [['authKey'], 'unique'], 
            
            [['FACEBOOK_EMAIL'], 'string', 'max' => 100],
            [['FACEBOOK_ID'], 'string', 'max' => 40],
            [['ZIP_CODE'], 'string', 'max' => 300],
            [['USER_PROFILE_PIC'], 'string', 'max' => 200],
            [['MARITAL_STATUS_ID'], 'exist', 'skipOnError' => true, 'targetClass' => MaritalStatus::className(), 'targetAttribute' => ['MARITAL_STATUS_ID' => 'MARITAL_STATUS_ID']],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['SUPPLIER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Suppliers::className(), 'targetAttribute' => ['SUPPLIER_ID' => 'SUPPLIER_ID']],
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => '6LcySRMUAAAAAB_EsBmj8lmQhZdZ1hs8knZq4mRy']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'COUPLE_PARTNER_ID' => Yii::t('app', 'Couple  Partner  ID'),
            'COUPLE_PARTNER_FIRST_NAME' => Yii::t('app', 'First  Name'),
            'COUPLE_PARTNER_MIDDLE_NAME' => Yii::t('app', 'Middle Name'),
            'COUPLE_PARTNER_LAST_NAME' => Yii::t('app', 'Last Name'),
            'COUPLE_PARTNER_EMAIL' => Yii::t('app', 'Email'),
            'COUPLE_PARTNER_PASSWORD' => Yii::t('app', 'Password'),
            'password_repeat' => Yii::t('app', 'Confirm password'),
            'COUPLE_PARTNER_MOBILE_NUMBER' => Yii::t('app', 'Mobile Number'),
            'COUPLE_PARTNER_ADDRESS' => Yii::t('app', 'Address'),
            'GENDER_ID' => Yii::t('app', 'Gender'),
            'BIRTHDAY' => Yii::t('app', 'Birthday'),
            'MARITAL_STATUS_ID' => Yii::t('app', 'Marital Status'),
            'PIN' => Yii::t('app', 'Pin'),
            'FACEBOOK_EMAIL' => Yii::t('app', 'Facebook  Email'),
            'FACEBOOK_ID' => Yii::t('app', 'Facebook  ID'),
            'COUNTRY_ID' => Yii::t('app', 'Country of Residance'),
            'Country'=> Yii::t('app', 'Country of Residance'),
            'CITY_ID' => Yii::t('app', 'City'),
            'ZIP_CODE' => Yii::t('app', 'Zip  Code'),
            'USER_PROFILE_PIC' => Yii::t('app', 'User  Profile  Pic'),
            'authKey' => Yii::t('app', 'Auth Key'),
            'SUPPLIER_ID' => Yii::t('app', 'Supplier ID'), 
        ];
    }
    
    public function uniqueEmail($attribute, $params)
    {
        if(Yii::$app->user->identity==null || Yii::$app->user->identity->COUPLE_PARTNER_ID==null || Yii::$app->user->identity->SUPPLIER_ID==null){
        $findByUsername = CouplePartner::findAll(['COUPLE_PARTNER_EMAIL'=>$this->COUPLE_PARTNER_EMAIL]);
//        $findByUsername = CouplePartner::findByUser($this->COUPLE_PARTNER_EMAIL);
        if($findByUsername!=null && sizeof($findByUsername)>0 ){
          $this->addError($attribute, 'Email already exists!');
        }
        }
    }
    public function SecondPArtneruniqueEmail($attribute, $params)
    {
        if(Yii::$app->user->identity==null || Yii::$app->user->identity->COUPLE_PARTNER_ID==null || Yii::$app->user->identity->SUPPLIER_ID==null){
        $findByUsername = CouplePartner::findAll(['COUPLE_PARTNER_EMAIL'=>$this->SecondEmail]);
        if($findByUsername!=null && sizeof($findByUsername)>0 ){
          $this->addError($attribute, 'Email already exists!');
        }
        }
    }
    
    public function TechUniqueEmail($attribute, $params)
    {
        if(Yii::$app->user->identity==null || Yii::$app->user->identity->COUPLE_PARTNER_ID==null || Yii::$app->user->identity->SUPPLIER_ID==null){
        $findByUsername = CouplePartner::findAll(['COUPLE_PARTNER_EMAIL'=>$this->TechEmail]);
//        $findByUsername = CouplePartner::findByUser($this->TechEmail);
        if($findByUsername!=null && sizeof($findByUsername)>0 ){
          $this->addError($attribute, 'Email already exists!');
        }
        }
    }
public function upload()
    {
//    Yii::error("imagessssssssss  : ".$this->imageFile);
//            echo $this->imageFile;
            Yii::error( Yii::$app->basePath.'/uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            
//        if ($this->validate()) {
            $this->imageFile->saveAs(Yii::$app->basePath.'/web/uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return '/uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
//        } else {
//            return false;
//        }
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgendaNotes() {
        return $this->hasMany(AgendaNote::className(), ['COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTASKs() {
        return $this->hasMany(Agenda::className(), ['TASK_ID' => 'TASK_ID'])->viaTable('agenda_note', ['COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactsDefaultInviteBies() {
        return $this->hasMany(ContactsDefaultInviteBy::className(), ['COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMARITALSTATUS() {
        return $this->hasOne(MaritalStatus::className(), ['MARITAL_STATUS_ID' => 'MARITAL_STATUS_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvitees() {
        return $this->hasMany(Invitees::className(), ['COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']);
    }

    
     public function getSUPPLIER()
   {
       return $this->hasOne(Suppliers::className(), ['SUPPLIER_ID' => 'SUPPLIER_ID']);
   }
    /**
     * @return \yii\db\ActiveQuery
     */
//    public function getInvitees0() {
//        return $this->hasMany(Invitees::className(), ['COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']);
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemOptions() {
        return $this->hasMany(ItemOptions::className(), ['APPROVED_BY' => 'COUPLE_PARTNER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemRatingComments() {
        return $this->hasMany(ItemRatingComment::className(), ['COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems() {
        return $this->hasMany(Items::className(), ['APPROVED_BY' => 'COUPLE_PARTNER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalContributions() {
        return $this->hasMany(PersonalContribution::className(), ['RELATED_TO_ID' => 'COUPLE_PARTNER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrivateSponsors() {
        return $this->hasMany(PrivateSponsor::className(), ['RELATED_TO_ID' => 'COUPLE_PARTNER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrivateTasks() {
        return $this->hasMany(PrivateTasks::className(), ['COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupportChats() {
        return $this->hasMany(SupportChat::className(), ['COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserGroups() {
        return $this->hasMany(UserGroup::className(), ['COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingAgendaTasks() {
        return $this->hasMany(WeddingAgendaTasks::className(), ['POSTED_BY' => 'COUPLE_PARTNER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingTentativePeriodes() {
        return $this->hasMany(WeddingTentativePeriodes::className(), ['POSTED_BY' => 'COUPLE_PARTNER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingTentativePeriodes0() {
        return $this->hasMany(WeddingTentativePeriodes::className(), ['APPROVED_BY' => 'COUPLE_PARTNER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddings() {
        return $this->hasMany(Weddings::className(), ['SECOND_COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddings0() {
        return $this->hasMany(Weddings::className(), ['FIRST_COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']);
    }

    public function getAuthKey() {
        return $this->authKey;
    }

    public function getId() {
        return $this->COUPLE_PARTNER_ID;
    }

    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    public static function findIdentity($id) {
        return self::findOne($id);
    }
 public static function checkForSaveOrUpdate($id)
    {
        return self::model()->findByAttributes(array('COUPLE_PARTNER_ID'=>$id));
    }
    public static function findIdentityByAccessToken($token, $type = null) {
        return self::findOne(['TOKEN' => $token]);
    }
public  function findByUser($username) {
        return $this->findOne(['COUPLE_PARTNER_EMAIL' => $username]);
    }
    public static function findByUsername($username) {
        if(strpos($username, '@') !== false){
  return CouplePartner::findOne(['COUPLE_PARTNER_EMAIL'=> $username]);
}else{
   //Otherwise we search using the username
   return CouplePartner::findOne(['COUPLE_PARTNER_MOBILE_NUMBER'=>$username]);
}
//        return CouplePartner::find(['COUPLE_PARTNER_EMAIL' => $username]);
    }
    public static function findByFacebookEmail($FacebookEmail) {
        return self::findOne(['FACEBOOK_EMAIL' => $FacebookEmail]);
    }
    public function validatePassword($password) {
       
        return $this->COUPLE_PARTNER_PASSWORD === $password;
    }

}
