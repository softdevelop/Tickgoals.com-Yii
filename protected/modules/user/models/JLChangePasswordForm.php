<?php

/**
 * Form Model JLChangePasswordForm dùng để xử lý việc thay đổi mật khẩu của user
 * 
 * @author huytbt
 * @date 2011-06-03
 * @version 1.0
 */
class JLChangePasswordForm extends CFormModel
{
	/**
	 * oldPassword
	 */
	public $oldPassword;
	public $first_name;
	public $last_name;
	public $email;
	/**
	 * password
	 */
	// public $password;
	/**
	 * verifyPassword
	 */
	// public $verifyPassword;
	/**
	 * user
	 */
	private $__user;
	
	/**
	 * Thiết lập các quy tắc xác thực
	 */
	public function rules() {
		return array(
			array('oldPassword,first_name,last_name,email', 'required', 'on'=>'fullchange'),
			array('oldPassword', 'length', 'max'=>128, 'min' => 6,'message' => "Incorrect password (minimal length 6 symbols).", 'on'=>'fullchange'),
			array('oldPassword', 'checkOldPassword', 'on'=>'fullchange'),
			// array('password', 'required'),
			array('email', 'email'),
			// array('verifyPassword', 'required'),
			// array('password', 'length', 'max'=>128, 'min' => 6,'message' => "Incorrect password (minimal length 6 symbols)."),
			// array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => "Your enter password doesn't match with the retype one."),
		);
	}
	
	/**
	 * Phương thức checkOldPassword($attribute, $params) dùng để xác thực mật khẩu cũ của user
	 *
	 * @param type $attribute
	 * @param type $params 
	 */
	public function checkOldPassword($attribute, $params)
	{
		$this->__user = Users::model()->findByPk(currentUser()->id);
		$strOldPassword = $this->encryptPassword($this->oldPassword);
		// dump($strOldPassword,false);
		// dump($this->__user->password,false);
		if ($strOldPassword != $this->__user->password) {
			$this->addError('oldPassword', 'The password you gave is incorrect.');
		}
	}
	/**
	 * Phuong th?c createSalt() dùng d? t?o ra m?t mã Salt cho user
	 * 
	 * @param $intLength int Ð? dài chu?i Salt du?c sinh ra
	 * @return string Mã ng?u nhiên Salt
	 */
	public  function createSalt($intLength = 8)
	{
		return substr(uniqid(), 0, $intLength);
	}

	/**
	 * Phuong th?c encryptPassword($strPassword, $strSalt) tr? v? m?t kh?u du?c sinh t? $strPassword, $strSalt, Yii::app()->params['systemSalt']
	 * 
	 * @param string $strPassword M?t kh?u c?a user
	 * @param string $strSalt Salt c?a user
	 * @return string M?t kh?u dùng d? luu vào CSDL ho?c s? d?ng cho vi?c ki?m tra dang nh?p
	 */
	public  function encryptPassword($strPassword)
	{
		$strMD5 = md5($strPassword);
		$hash = $strMD5;
		$strEncrypt = sha1($hash);
		
		return $strEncrypt;
	}
	/**
	 * Phương thức setUser($user) dùng để set thuộc tính user
	 *
	 * @param type $user 
	 */
	public function setUser($user)
	{
		$this->__user = $user;
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'password' => "New password",
			'oldPassword' => "Current password",
			
		);
	}
}
