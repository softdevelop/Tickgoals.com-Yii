<?php
if(!empty($lists)){
	foreach($lists as $key=>$list){
		$this->renderPartial('my_list',array(
			'list'=>$list,
			'key'=>$key,
			'uId'=>$uId,
			'model'=>$model,
		));
	}
}
?>