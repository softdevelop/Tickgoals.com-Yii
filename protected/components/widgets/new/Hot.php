<?php 

class Hot extends CWidget {
	
	public function init(){
		parent::init();

	}
	public function run(){
		$data = News::model()->getHot();
		$this->render('index',array('data'=>$data));
	}
}
?>
