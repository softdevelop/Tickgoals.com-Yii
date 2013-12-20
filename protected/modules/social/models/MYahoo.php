<?php


class Yahoo extends CFormModel
{
	
	/**
	 * password
	 */
	public $user;
	/**
	 * verifyPassword
	 */
	public $pass;
	
	
	public function attributeLabels()
	{
		return array(
			'user' => 'Email',
			'pass' => 'Password',

		);
	}
	public function rules() {
		return array(
			array('user,pass', 'required'),
			array('pass', 'length', 'max' => 255, 'min' => 6),
			
		);
	}
	public function getFriends($user=NULL,$pass=NULL){
		// require_once('class.GrabYahoo.php');
		// Initializing Class
		$yahoo  = new GrabYahoo;
		
		/* 
		Setting the desired Service 
		1. addressbook => Used to grab Yahoo! Address Book
		2. messenger => Used to grab Yahoo! Messenger List
		3. newmail => Used to grab number of new Yahoo! mails
		4. calendar => Used to grab Yahoo! Calendar entries 
		*/
		$yahoo->service = "addressbook";
		/*
		Set to true if HTTP proxy is required to browse net
		- Setting it to true will require to provide Proxy Host Name and Port number
		*/
		$yahoo->isUsingProxy = false;
		// Set the Proxy Host Name, isUsingProxy is set to true
		$yahoo->proxyHost = "";
		// Set the Proxy Port Number
		$yahoo->proxyPort = "";
		// Set the location to save the Cookie Jar File
		$yahoo->cookieJarPath = $_SERVER['DOCUMENT_ROOT'] . "/../../jlruntime";
		/* 
		Execute the Service 
		- Require to pass Yahoo! Account Username and Password
		*/
		
		$yahooList = $yahoo->execService($user, $pass);
		return $yahooList;
	}
	
}
