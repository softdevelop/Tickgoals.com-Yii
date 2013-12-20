<?php

class Gmail extends CFormModel
{
	
	/**
	 * password
	 */
	public $user;
	/**
	 * verifyPassword
	 */
	public $pass;
	

	public function rules() {
		return array(
			array('user,pass', 'required'),
			array('pass', 'length', 'max' => 255, 'min' => 6),
		);
	}
	public function attributeLabels()
	{
		return array(
			'user' => 'Email',
			'pass' => 'Password',

		);
	}
	public function getFriends($user=NULL,$pass=NULL){
		$grabber = new GmailContact(1000, 1 );
		$emails = $grabber->get_contacts( $user , $pass );
		return $emails;
	}
}
