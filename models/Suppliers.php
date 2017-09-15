<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "suppliers".
 *
 * @property integer $SUPPLIER_ID
 * @property string $SUPPLIER_NAME
 * @property string $REGISTRATION_DATE
 * @property integer $SUPPLIER_TYPE_ID
 * @property string $SUPPLIER_DESC
 * @property string $SUPPLIER_ADDRESS
 * @property string $SUPPLIER_PHONE
 * @property string $SUPPLIER_WEB_SITE
 * @property integer $COUNTRY_ID
 * @property integer $CITY_ID
 * @property string $SUPPLIER_MOBILE_PHONE
 * @property string $SUPPLIER_STATUS
 * @property string $SUPPLIER_EMAIL
 * @property integer $RATE_VALUE
 * @property integer $COST_VALUE
 * @property string $COMMISSION
 * @property string $COMMISSION_FLAG
 * @property string $SUPPLIER_MAP_LOCATION
 * @property string $REGISTRATION_NUMBER
 * @property string $USER_NAME
 * @property string $PASSWORD
 * @property string $BRAND_NAME
 * @property string $TECH_NAME
 * @property string $TECH_EMAIL
 * @property string $TECH_PHONE
 * @property string $SUPPLIER_REAL_NAME
 * @property string $SIGN_UP_MESSAGE 
 * @property string $SUPPLIER_LOGO
 * 
 * @property Ads[] $ads
 * @property CouplePartner[] $couplePartners
 * @property FinancialLoan[] $financialLoans
 * @property ItemsSupplieirs[] $itemsSupplieirs
 * @property SupplierBusinessType $supplierBusinessType 
 * @property SupplierOfferedServices[] $supplierOfferedServices 
 * @property SupplierPartnerThru[] $supplierPartnerThrus 
 * @property SupplierPayment[] $supplierPayments 
 * @property Saving[] $savings
 * @property SupplierRateDuration[] $supplierRateDurations
 * @property Countries $cOUNTRY
 * @property SupplierTypes $sUPPLIERTYPE
 * @property SuppliersLocations $suppliersLocations 
 * 
 * @property UserGroup[] $userGroups
 * @property WeddingAccount[] $weddingAccounts
 * @property WeddingsInsurance[] $weddingsInsurances
 */
class Suppliers extends \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'suppliers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SUPPLIER_NAME','COUNTRY_ID','SUPPLIER_TYPE_ID','CITY_ID','SUPPLIER_REAL_NAME'], 'required'],
            [['REGISTRATION_DATE'], 'safe'],
            [['SUPPLIER_TYPE_ID', 'COUNTRY_ID', 'CITY_ID', 'RATE_VALUE', 'COST_VALUE','SUPPLIER_MOBILE_PHONE'], 'integer'],
            [['SUPPLIER_NAME'], 'string', 'max' => 40],
            [['SUPPLIER_DESC'], 'string', 'max' => 200],
            [['SUPPLIER_ADDRESS'], 'string', 'max' => 300],
            [['SUPPLIER_PHONE'], 'string', 'max' => 15],
            [['SIGN_UP_MESSAGE'], 'string', 'max' => 4000], 
            [['SUPPLIER_WEB_SITE', 'BRAND_NAME', 'TECH_EMAIL'], 'string', 'max' => 100],
            [['SUPPLIER_MOBILE_PHONE', 'COMMISSION'], 'string', 'max' => 20],
            [['SUPPLIER_STATUS', 'COMMISSION_FLAG'], 'string', 'max' => 1],
            [['SUPPLIER_EMAIL'], 'string', 'max' => 70],
            [['SUPPLIER_MAP_LOCATION'], 'string', 'max' => 3000],
            [['REGISTRATION_NUMBER', 'PASSWORD', 'TECH_NAME', 'TECH_PHONE', 'SUPPLIER_REAL_NAME'], 'string', 'max' => 45],
            [['USER_NAME'], 'string', 'max' => 60],
            [['COUNTRY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['COUNTRY_ID' => 'COUNTRY_ID']],
            [['SUPPLIER_TYPE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SupplierTypes::className(), 'targetAttribute' => ['SUPPLIER_TYPE_ID' => 'SUPPLIER_TYPE_ID']],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SUPPLIER_ID' => Yii::t('app', 'Supplier  ID'),
            'SUPPLIER_NAME' => Yii::t('app', 'Partner Business  Name'),
            'REGISTRATION_DATE' => Yii::t('app', 'Registration  Date'),
            'SUPPLIER_TYPE_ID' => Yii::t('app', 'Supplier  Type  '),
            'SUPPLIER_DESC' => Yii::t('app', 'Supplier  Desc'),
            'SUPPLIER_ADDRESS' => Yii::t('app', 'Location'),
            'SUPPLIER_PHONE' => Yii::t('app', 'Supplier  Phone'),
            'SUPPLIER_WEB_SITE' => Yii::t('app', 'URL Web  Site'),
            'COUNTRY_ID' => Yii::t('app', 'Country'),
            'CITY_ID' => Yii::t('app', 'City '),
            'SUPPLIER_MOBILE_PHONE' => Yii::t('app', 'Contact  Mobile'),
            'SUPPLIER_STATUS' => Yii::t('app', 'Supplier  Status'),
            'SUPPLIER_EMAIL' => Yii::t('app', 'Contact  Email'),
            'RATE_VALUE' => Yii::t('app', 'Rate  Value'),
            'COST_VALUE' => Yii::t('app', 'Cost  Value'),
            'COMMISSION' => Yii::t('app', 'Commission'),
            'COMMISSION_FLAG' => Yii::t('app', 'Commission  Flag'),
            'SUPPLIER_MAP_LOCATION' => Yii::t('app', 'Supplier  Map  Location'),
            'REGISTRATION_NUMBER' => Yii::t('app', 'R.C. Number'),
            'USER_NAME' => Yii::t('app', 'User  Name'),
            'PASSWORD' => Yii::t('app', 'Password'),
            'BRAND_NAME' => Yii::t('app', 'Brand  Name'),
            'TECH_NAME' => Yii::t('app', 'Technical  Contact Name'),
            'TECH_EMAIL' => Yii::t('app', 'Technical  Contact  Email'),
            'TECH_PHONE' => Yii::t('app', 'Technical  Contact  Phone'),
            'SUPPLIER_REAL_NAME' => Yii::t('app', 'Contact Person'),
            'SIGN_UP_MESSAGE' => Yii::t('app', 'Sign Up Message:'),
            'SUPPLIER_LOGO' =>Yii::t('app', 'logo'),
        ];
    }

    public function upload()
    {
//    Yii::error("imagessssssssss  : ".$this->imageFile);
//            echo $this->imageFile;
            Yii::error( Yii::$app->basePath.'/SupplierLogos/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            
//        if ($this->validate()) {
            $this->imageFile->saveAs(Yii::$app->basePath.'/web/SupplierLogos/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return '/SupplierLogos/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
//        } else {
//            return false;
//        }
    }
    
    
    	   public function getSupplierBusinessType() 
   { 
       return $this->hasOne(SupplierBusinessType::className(), ['SUPPLIER_ID' => 'SUPPLIER_ID']); 
   } 
 
   /** 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getSupplierOfferedServices() 
   { 
       return $this->hasMany(SupplierOfferedServices::className(), ['SUPPLIER_ID' => 'SUPPLIER_ID']); 
   } 
 
   
   	   /** 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getSupplierPartnerThrus() 
   { 
       return $this->hasMany(SupplierPartnerThru::className(), ['SUPPLIER_ID' => 'SUPPLIER_ID']); 
   } 
 
   /** 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getSupplierPayments() 
   { 
       return $this->hasMany(SupplierPayment::className(), ['SUPPLIER_ID' => 'SUPPLIER_ID']); 
   }
   
   /** 
    * @return \yii\db\ActiveQuery 
    */ 
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAds()
    {
        return $this->hasMany(Ads::className(), ['SUPPLIER_ID' => 'SUPPLIER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCouplePartners()
    {
        return $this->hasMany(CouplePartner::className(), ['SUPPLIER_ID' => 'SUPPLIER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinancialLoans()
    {
        return $this->hasMany(FinancialLoan::className(), ['SUPPLIER_ID' => 'SUPPLIER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsSupplieirs()
    {
        return $this->hasMany(ItemsSupplieirs::className(), ['SUPPLIER_ID' => 'SUPPLIER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSavings()
    {
        return $this->hasMany(Saving::className(), ['SUPPLIER_ID' => 'SUPPLIER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplierRateDurations()
    {
        return $this->hasMany(SupplierRateDuration::className(), ['SUPPLIER_ID' => 'SUPPLIER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCOUNTRY()
    {
        return $this->hasOne(Countries::className(), ['COUNTRY_ID' => 'COUNTRY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSUPPLIERTYPE()
    {
        return $this->hasOne(SupplierTypes::className(), ['SUPPLIER_TYPE_ID' => 'SUPPLIER_TYPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserGroups()
    {
        return $this->hasMany(UserGroup::className(), ['SUPPLIER_ID' => 'SUPPLIER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingAccounts()
    {
        return $this->hasMany(WeddingAccount::className(), ['SUPPLIER_ID' => 'SUPPLIER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingsInsurances()
    {
        return $this->hasMany(WeddingsInsurance::className(), ['SUPPLIER_ID' => 'SUPPLIER_ID']);
    }
    
       public function getSuppliersLocations() 
   { 
       return $this->hasOne(SuppliersLocations::className(), ['SUPPLIER_ID' => 'SUPPLIER_ID']); 
   } 
 
   /** 
    * @return \yii\db\ActiveQuery 
    */
}
