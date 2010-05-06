<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	public $username;
	
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		// TODO: check users-table in database
		
		$record = User::model()->findByAttributes(array('username' => $this->username));
		
		if($record === null) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		} else if($record->password_hash !== md5($this->password)) {
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		} else {
			//$this->name = $record->username;
			//$this->name = $record->username;
			Yii::app()->user->setId($record->id);
			
			$this->errorCode = self::ERROR_NONE;
		}
		return !$this->errorCode;
		
/*		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;*/
	}
}