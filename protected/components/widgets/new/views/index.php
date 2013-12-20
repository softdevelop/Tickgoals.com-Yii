<?php
if(!empty($data)){
	echo '<div class="accordion">';
	foreach($data as $key=>$value){
		echo "<h3>{$value->title}</h3>";
		echo '<div class="content">';
		echo '<p>';
		echo CommonHelper::lessString($value->content,300);
		echo '</p>';
		echo '<p>';
		echo CHtml::link('Xem chi tiết',array('/new/new/view','id'=>outStr($value->id)));
		echo '</p>';
		echo '</div>';
	}
	echo '</div>';
}
?>
						
