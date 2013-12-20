<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'groups-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Điền thông tin vào các trường có dấu <span class="required">*</span> </p>

	<div class="input text">
		<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>200)); ?>
	</div>

	<div class="input select">
		<label for="note">Số thư tự:</label>
		<input name="Groups[level]" value="<?php echo $model->level;?>">
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
