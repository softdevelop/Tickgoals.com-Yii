<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'categories-form',
	'enableAjaxValidation'=>false,
)); ?>


	
	<div class="input text">
		<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>200)); ?>
	</div>
	<div class="input text">
		<?php echo $form->textFieldRow($model,'alias',array('class'=>'span5','maxlength'=>200)); ?>
	</div>
	<div class="submit">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Tạo mới' : 'Lưu',
			'htmlOptions'=>array('class'=>'button')
		)); ?>
	</div>

<?php $this->endWidget(); ?>
