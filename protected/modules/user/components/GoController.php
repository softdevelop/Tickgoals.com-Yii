<?php

class GoController extends Controller {

	
	public function init() {
		parent::init();
		Yii::app()->theme="go";
		
	}
	/**
	 * @return array - List of filters
	 */
	public function filters()
	{
		return array();
	}
	



}
