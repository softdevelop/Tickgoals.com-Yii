<?php

class UnicomController extends Controller {

	
	public function init() {
		parent::init();
		Yii::app()->theme="unicorn";
		
	}
	/**
	 * @return array - List of filters
	 */
	public function filters()
	{
		return array();
	}
	



}
