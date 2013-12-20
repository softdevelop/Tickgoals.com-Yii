<?php


class ShareEmail extends CFormModel
{

	/**
	 * email
	 */
	public $email;

	/**
	 * Phương thức dùng để thiết lập các quy tắc xác thực
	 */
	public function rules()
	{
		return array(
			// email and password are required
			array('email', 'required'),
			array('email', 'email'),
			
		);
	}

	/**
	 * Phương thức dùng để khai báo các Label cho form
	 */
	public function attributeLabels()
	{
		return array();
	}

	
	



}
