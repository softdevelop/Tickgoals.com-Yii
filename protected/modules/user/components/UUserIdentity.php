<?php


class UUserIdentity extends CUserIdentity
{

	private $_id;
	
	/**
	 * Phương thức authenticate() dùng để xác thực username và password của User có đúng không
	 *  
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$record = Users::model()->findByAttributes(array('email'=>$this->username));
		if($record === null){
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		}else if($record->password !== sha1(md5($this->password))){
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		}else
		{
			$this->_id = $record->id;
			$this->errorCode = self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
	
	
	
	/**
	 * Phương thức getId() trả về ID của User
	 *  
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
		return $this->_id;
	}
	
	public function setAuthenticate($info) {
		$this->_id = $info->id;
		$this->errorCode = self::ERROR_NONE;
	}
	
	public static function processAuth($hexUserID) {
		$info = Users::model()->find("id=x'{$hexUserID}'");
		
		$identity = new UUserIdentity($info->email, $info->password);
		$identity->setAuthenticate($info);
		return $identity;
	}
}
