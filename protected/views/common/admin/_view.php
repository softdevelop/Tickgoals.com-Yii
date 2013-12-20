
<div class="view">
	<?php
	$attributes = $data->attributes;
	foreach($attributes as $k=>$v){
		if(stristr($k,"id")==false){
			$label = $data->getAttributeLabel($k);
			
	?>
	<b><?php echo CHtml::encode($label); ?>:</b>
	<?php echo $v; ?>
	<br />
	<?php
		}
	}
	?>



</div>