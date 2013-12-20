<?php
/* @var $this SettingController */
/* @var $model Settings */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'settings-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="input text">
		<?php echo $form->labelEx($model,'category'); ?>
		<?php echo $form->textField($model,'category',array('rows'=>6, 'cols'=>50,'class'=>'span12')); ?>
		<?php echo $form->error($model,'category'); ?>
	</div>
	<div class="input text">
		<?php echo $form->labelEx($model,'key'); ?>
		<?php echo $form->textField($model,'key',array('rows'=>6, 'cols'=>50,'class'=>'span12')); ?>
		<?php echo $form->error($model,'key'); ?>
	</div>

	<div class="input text">
		<?php echo $form->labelEx($model,'value'); ?>
		<?php echo $form->textArea($model,'value',array('rows'=>6, 'cols'=>50,'class'=>'span12')); ?>
		<?php echo $form->error($model,'value'); ?>
	</div>

	<div class="input text submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->