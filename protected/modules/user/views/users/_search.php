<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'first_name',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'last_name',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'actived',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'created',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'lastvisit',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		    'buttonType'=>'submit'
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
