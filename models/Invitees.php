<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "invitees".
 *
 * @property integer $INVITEE_ID
 * @property integer $WEDDING_ID
 * @property integer $COUPLE_PARTNER_ID
 * @property integer $CONTACT_ID
 * @property integer $RELATION_TYPE_ID
 * @property string $FIRST_INVITEE_NAME
 * @property string $INVITEE_EMAIL
 * @property integer $FIRST_INVITEE_MSMRS_ID
 * @property string $PHONE
 * @property string $ADDRESS
 * @property string $SEND_CART_BY_ID
 * @property integer $INVITEE_CIRCLE_ID
 * @property integer $INVITEE_PLACE_WITH_ID
 * @property string $NOTE
 * @property string $FIRST_INVITEE_LAST_NAME 
 *
 * @property InviteeEvents[] $inviteeEvents
 * @property InviteeGuests[] $inviteeGuests
 * @property InviteeSendCartBy[] $inviteeSendCartBies
 * @property InviteesTitles $fIRSTINVITEEMSMRS
 * @property CouplePartner $cONTACT
 * @property CouplePartner $cOUPLEPARTNER
 * @property Weddings $wEDDING
 * @property InviteeRelationTypes $rELATIONTYPE
 * @property InviteesCircle $iNVITEECIRCLE
 * @property InviteesPlaceWith $iNVITEEPLACEWITH
 * @property PrivateSponsor[] $privateSponsors
 * @property WedsiteTopicComments[] $wedsiteTopicComments
 * 
 */
class Invitees extends \yii\db\ActiveRecord
{
    public $WEDDING_EVENT_ID;
    public $Circle,$placewith,$guestname;
    public $SEND_CART_BY_ID;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invitees';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
  
        return [
            [['Event','Invitation','Circles','PlaceWith','WEDDING_EVENT_ID','SEND_CART_BY_ID'],'safe'],
            [['FIRST_INVITEE_NAME'],'required'],
            [['WEDDING_ID', 'COUPLE_PARTNER_ID', 'CONTACT_ID', 'RELATION_TYPE_ID', 'FIRST_INVITEE_MSMRS_ID', 'INVITEE_CIRCLE_ID', 'INVITEE_PLACE_WITH_ID'], 'integer'],
            [['FIRST_INVITEE_NAME', 'INVITEE_EMAIL'], 'string', 'max' => 50],
            [['PHONE'], 'string', 'max' => 20],
            [['ADDRESS'], 'string', 'max' => 500],
            [[ 'FIRST_INVITEE_LAST_NAME'], 'string', 'max' => 100],
            [['NOTE'], 'string', 'max' => 4000],
            [['FIRST_INVITEE_MSMRS_ID'], 'exist', 'skipOnError' => true, 'targetClass' => InviteesTitles::className(), 'targetAttribute' => ['FIRST_INVITEE_MSMRS_ID' => 'INVITEES_TITLES_ID']],
            [['CONTACT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CouplePartner::className(), 'targetAttribute' => ['CONTACT_ID' => 'COUPLE_PARTNER_ID']],
            [['COUPLE_PARTNER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CouplePartner::className(), 'targetAttribute' => ['COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
            [['RELATION_TYPE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => InviteeRelationTypes::className(), 'targetAttribute' => ['RELATION_TYPE_ID' => 'RELATION_TYPE_ID']],
            [['INVITEE_CIRCLE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => InviteesCircle::className(), 'targetAttribute' => ['INVITEE_CIRCLE_ID' => 'INVITEE_CIRLE_ID']],
            [['INVITEE_PLACE_WITH_ID'], 'exist', 'skipOnError' => true, 'targetClass' => InviteesPlaceWith::className(), 'targetAttribute' => ['INVITEE_PLACE_WITH_ID' => 'INVITEE_PLACE_WITH_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'INVITEE_ID' => Yii::t('app', 'Invitee  ID'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
            'COUPLE_PARTNER_ID' => Yii::t('app', 'Couple  Partner  ID'),
            'CONTACT_ID' => Yii::t('app', 'Contact  ID'),
            'RELATION_TYPE_ID' => Yii::t('app', 'Relation  Type  ID'),
            'FIRST_INVITEE_NAME' => Yii::t('app', 'First  Invitee  Name'),
            'INVITEE_EMAIL' => Yii::t('app', 'Invitee  Email'),
            'FIRST_INVITEE_MSMRS_ID' => Yii::t('app', 'First  Invitee  Msmrs  ID'),
            'PHONE' => Yii::t('app', 'Phone'),
            'ADDRESS' => Yii::t('app', 'Address'),
            'SEND_CART_BY_ID' => Yii::t('app', 'Send  Cart  By  ID'),
            'INVITEE_CIRCLE_ID' => Yii::t('app', 'Invitee  Circle  ID'),
            'INVITEE_PLACE_WITH_ID' => Yii::t('app', 'Invitee  Place  With  ID'),
            'NOTE' => Yii::t('app', 'Note'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInviteeEvents()
    {
        return $this->hasMany(InviteeEvents::className(), ['INVITEE_ID' => 'INVITEE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInviteeGuests()
    {
        return $this->hasMany(InviteeGuests::className(), ['INVITEE_ID' => 'INVITEE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInviteeSendCartBies()
    {
        return $this->hasMany(InviteeSendCartBy::className(), ['INVITEE_ID' => 'INVITEE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFIRSTINVITEEMSMRS()
    {
        return $this->hasOne(InviteesTitles::className(), ['INVITEES_TITLES_ID' => 'FIRST_INVITEE_MSMRS_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCONTACT()
    {
        return $this->hasOne(CouplePartner::className(), ['COUPLE_PARTNER_ID' => 'CONTACT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCOUPLEPARTNER()
    {
        return $this->hasOne(CouplePartner::className(), ['COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']);
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
    public function getRELATIONTYPE()
    {
        return $this->hasOne(InviteeRelationTypes::className(), ['RELATION_TYPE_ID' => 'RELATION_TYPE_ID']);
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
    public function getINVITEEPLACEWITH()
    {
        return $this->hasOne(InviteesPlaceWith::className(), ['INVITEE_PLACE_WITH_ID' => 'INVITEE_PLACE_WITH_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrivateSponsors()
    {
        return $this->hasMany(PrivateSponsor::className(), ['INVITEE_ID' => 'INVITEE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWedsiteTopicComments()
    {
        return $this->hasMany(WedsiteTopicComments::className(), ['INVITEE_ID' => 'INVITEE_ID']);
    }
    
                    public function search($params)
{               
    $query = Invitees::find()
         ->innerJoin('invitee_events','invitees.INVITEE_ID=invitee_events.INVITEE_ID')
         ->innerJoin('invitee_send_cart_by','invitees.INVITEE_ID=invitee_send_cart_by.INVITEE_ID');

//    $this->load($params);  
$WeddingID=0;                                                             ;
if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
    $Invita="";
    $InvitationArray="";
    if(isset($params['Invitation']) ){
        if($params['Invitation']!="" ){
            $p=0;
            $InvitationArray = explode(",",substr($params['Invitation'], 0, -1) );
           foreach($InvitationArray as $inv){
               
               if($p==sizeof($InvitationArray)-1){
                 $Invita=$Invita.$inv;  
               }else{
                 $Invita=$Invita.$inv.',';    
               }
               $p++;
           } 
        }
    }
    Yii::error('Invita : '.print_r($params,true));
    $PlaceW="";
    $PlaceWithArray=null;
    if(isset($params['PlaceWith']) ){
        if($params['PlaceWith']!="" ){
            $p=0;
            $PlaceWithArray = explode(",", substr($params['PlaceWith'], 0, -1));
           foreach( $PlaceWithArray as $PlaceWith){
               
               if($p==sizeof($PlaceWithArray)-1){
                 $PlaceW=$PlaceW.$PlaceWith;  
               }else{
                 $PlaceW=$PlaceW.$PlaceWith.',';    
               }
               $p++;
           } 
        }
    }
    
    $Circ="";
    $Circles=null;
    if(isset($params['Circles']) ){
        if($params['Circles']!="" ){
          $p=0;
            $Circles = explode(",",substr($params['Circles'], 0, -1) );//7atayta kirmel 3am te5od 2e5ir ',' lamma 2a3mil split. 
           foreach( $Circles as $Ev){
               
               if($p==sizeof($Circles)-1){
                 $Circ=$Circ.$Ev;  
               }else{
                 $Circ=$Circ.$Ev.',';    
               }
               $p++;
           } 
        }
    }
    
    $Eventsss="";
    $Event=null;
     Yii::error('Event Params : '.print_r($params['Event'],true));
    if(isset($params['Event']) ){
        if($params['Event']!=""){
            $p=0;
            $Event = explode(",",substr($params['Event'], 0, -1) );
           foreach( $Event as $Ev){
               
               if($p==sizeof($Event)-1){
                 $Eventsss=$Eventsss.$Ev;  
               }else{
                 $Eventsss=$Eventsss.$Ev.',';    
               }
               $p++;
           } 
        }
    }
   
//        Yii::error("this->ItemName : " .$this->ItemName);
        $query->filterWhere(['like','invitees.FIRST_INVITEE_NAME','']);
          $query->andFilterWhere(['=','invitees.WEDDING_ID',$WeddingID]);      
    
     Yii::error('Eventsss : '.$Eventsss);
    if(!empty($Eventsss)){
        Yii::error("this->ItemName : " .$Eventsss);
        $query->andFilterWhere(['in','invitee_events.EVENT_ID',$Event]);
                
    }

    if(!empty($Circ)){
//        Yii::error("this->ItemName : " .$this->ItemName);
        $query->andFilterWhere(['in','Invitees.INVITEE_CIRCLE_ID',$Circ]);
                
    }
    
    if(!empty($PlaceW)){
//        Yii::error("this->ItemName : " .$this->ItemName);
        $query->andFilterWhere(['in','Invitees.INVITEE_PLACE_WITH_ID',$PlaceW]);
                
    }
    
    if(!empty($Invita)){
//        Yii::error("this->ItemName : " .$this->ItemName);
        $query->andFilterWhere(['in','invitee_send_cart_by.SEND_CART_BY_ID',$Invita]);
                
    }
    Yii::error('Query : '.$query->createCommand()->getRawSql());
    
    $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' => false,
    ]);

//    $dataProvider->sort->attributes['ItemName'] = [
//        'asc' => ['items_trans.ITEM_NAME' => SORT_ASC],
//        'desc' => ['items_trans.ITEM_NAME' => SORT_DESC]
//    ];

if($dataProvider!=null){
//    Yii::error('dataProvider : '.print_r($dataProvider->getModels(),true));
//    $dataProvider=$dataProvider->getModels();
}

    return $dataProvider;
}
}
