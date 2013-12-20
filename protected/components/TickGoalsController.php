<?php

class TickGoalsController extends Controller {

	public $des = null;
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
