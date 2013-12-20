<?php

class AdController extends Controller {

	
	public function init() {
		parent::init();
		Yii::app()->theme="tickgoals";
		
	}
	/**
	 * @return array - List of filters
	 */
	public function filters()
	{
		return array();
	}
	



}
