<?php


class FormLogin extends CFormModel
{

	/**
	 * email
	 */
	public $email;
	/**
	 * password
	 */
	public $password;
	/**
	 * rememberMe
	 */
	public $rememberMe;

	/**
	 * identity
	 */
	private $_identity;
	
	/**
	 * Phương thức dùng để thiết lập các quy tắc xác thực
	 */
	public function rules()
	{
		return array(
			// email and password are required
			array('email,password', 'required'),
			array('email', 'email'),
			array('password', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Phương thức dùng để khai báo các Label cho form
	 */
	public function attributeLabels()
	{
		return array();
	}

	/**
	 * Phương thức authenticate($attribute,$params) dùng để xác thực email và Password có đúng không
		 * @param $attribute
		 * @param $params
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UUserIdentity($this->email,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password', "Your email and password don't match!");
		}
	}

	/**
	 * Phương thức dùng để kiểm tra đăng nhập
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		
		if($this->_identity===null)
		{
			$this->_identity = new UUserIdentity($this->email, $this->password);
		
			$authenticate = $this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UUserIdentity::ERROR_NONE)
		{
			Users::forceLoginByEmail($this->email, $this->rememberMe);
			return true;
		}
		else
			return false;
	}
	



}