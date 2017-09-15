<?php 
    namespace app\models;
    
    use Yii;
    use yii\base\Model;

    
    class ResetForm extends Model{
        
        public $Email;
        public function rules(){
            return [
                [['Email'],'required'],
                ['Email','findemail'],
                [['Email'],'email'],
               
                ];
        }
        
        public function findemail($attribute, $params){
            $user = CouplePartner::findOne(['COUPLE_PARTNER_EMAIL'=>$this->Email]);
            if($user!=null && sizeof($user)>0){
                
            }else{
                $this->addError($attribute,'Email Don\'t Exist');
            }
            
        }
        
        public function attributeLabels(){
            return [
                
                'Email'=>'Email',
            ];
        }
    }