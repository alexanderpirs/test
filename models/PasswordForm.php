<?php 
    namespace app\models;
    
    use Yii;
    use yii\base\Model;

    
    class PasswordForm extends Model{
        public $oldpass;
        public $newpass;
        public $repeatnewpass;
        public $Email;
        public function rules(){
            return [
                [['oldpass','newpass','repeatnewpass','Email'],'required'],
                ['oldpass','findpasswords'],
                [['Email'],'email'],
                ['repeatnewpass','compare','compareAttribute'=>'newpass'],
            ];
        }
        
        public function findpasswords($attribute, $params){
            $user = CouplePartner::findOne(['COUPLE_PARTNER_ID'=>Yii::$app->user->identity->COUPLE_PARTNER_ID]);
            $password = $user->COUPLE_PARTNER_PASSWORD;
             $hashedPassword = Yii::$app->getSecurity()->generatePasswordHash($this->oldpass);
            if( $password!=$hashedPassword){
                Yii::error(" hashedPassword :  " . $hashedPassword);
                 $this->addError($attribute,'Old password is incorrect');
            }
        }
        
        public function attributeLabels(){
            return [
                'oldpass'=>'Old Password',
                'newpass'=>'New Password',
                'repeatnewpass'=>'Repeat New Password',
            ];
        }
    }