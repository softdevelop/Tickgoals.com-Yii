<?php
/* @var $this MapPermissionController */
/* @var $model MapPermission */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode(outStr($data->id)), array('update', 'id'=>outStr($data->id))); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('group_id')); ?>:</b>
	<?php echo CHtml::encode($data->group->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('permission_id')); ?>:</b>
	<?php echo CHtml::encode($data->per->name); ?>
	<br />


</div>