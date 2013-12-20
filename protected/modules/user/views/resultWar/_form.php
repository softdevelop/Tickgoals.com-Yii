<?php
/* @var $this ResultWarController */
/* @var $model ResultWar */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'result-war-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'teama'); ?>
		<?php echo $form->textField($model,'teama',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'teama'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'teamb'); ?>
		<?php echo $form->textField($model,'teamb',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'teamb'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rsa'); ?>
		<?php echo $form->textField($model,'rsa'); ?>
		<?php echo $form->error($model,'rsa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rsb'); ?>
		<?php echo $form->textField($model,'rsb'); ?>
		<?php echo $form->error($model,'rsb'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->