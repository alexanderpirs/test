<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }
public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Email'),
            'rememberMe' => Yii::t('app', 'Remember me'),
            'password' => Yii::t('app', 'Password'),
            
        ];
    }
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
//            Yii::error("testtttttttttttadasdsa honnnnnnnnn 2 " . $user->COUPLE_PARTNER_PASSWORD);
            
            if (!$user ||  !Yii::$app->getSecurity()->validatePassword( $this->password, $user->COUPLE_PARTNER_PASSWORD)) {
                return $this->addError($attribute, 'Incorrect username or password.');
//                Yii::error("testtttttttttttadasdsa honnnnnnnnn 2 " . $user->COUPLE_PARTNER_PASSWORD);
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function ValidateEmail($SocialMediaEmail){
      
            $this->_user = CouplePartner::findByFacebookEmail($SocialMediaEmail);
            return $this->_user;  
    }
    public function loginFacebook($SocialMediaEmail)
    {
        if ($this->ValidateEmail($SocialMediaEmail)) {
            return Yii::$app->user->login(CouplePartner::findByFacebookEmail($SocialMediaEmail), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = CouplePartner::findByUsername($this->username);
        }

        return $this->_user;
    }
}
