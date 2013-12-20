<?php
/* @var $this ResultWarController */
/* @var $model ResultWar */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('teama')); ?>:</b>
	<?php echo CHtml::encode($data->teama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('teamb')); ?>:</b>
	<?php echo CHtml::encode($data->teamb); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rsa')); ?>:</b>
	<?php echo CHtml::encode($data->rsa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rsb')); ?>:</b>
	<?php echo CHtml::encode($data->rsb); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />


</div>