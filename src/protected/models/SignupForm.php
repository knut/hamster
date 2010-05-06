<?php

class SignupForm extends CFormModel {
	
	public $username;
	public $email;
	public $display_name;
	public $password;
	public $password_confirmation;
	public $verify_code;
	
	public function rules() {
		return array(
			array('username, email, password', 'required'),
			array('username', 'length', 'min' => 3, 'max' => 12),
			array('username', 'valid_username'),
			array('password', 'length', 'min' => 5),
			array('password', 'compare', 'compareAttribute' => 'password_confirmation'),
			array('verify_code', 'captcha', 'allowEmpty' => !extension_loaded('gd')),
			array('display_name, password_confirmation', 'safe'),
		);
	}
	
	public function attributeLabels() {
		return array(
			'username' => Yii::t('messages', 'Desired login name'),
			'email' => Yii::t('messages', 'Your email address'),
			'display_name' => Yii::t('messages', 'Display Name (optional)'),
			'password' => Yii::t('messages', 'Password (must be at least 5 characters)'),
			'password_confirmation' => Yii::t('messages', 'Enter your password again'),
			'openid_url' => Yii::t('messages', 'Identity Url'),
			'verify_code' => Yii::t('messages', 'Verification Code'),
		);
	}

	public function valid_username() {
		if($this->username) {
			$users = User::model()->find("username = :username", array(':username' => $this->username));
			if($users !== null) {
				$this->addError('username', Yii::t('messages', 'That username is already taken. Please try another one.'));
			}
		}
	}

}

?>