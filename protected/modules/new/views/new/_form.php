<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'news-form',
	'enableAjaxValidation'=>false,
)); ?>

	
	

	<div class="input text">
		<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>200)); ?>
	</div>

	<div class="input textarea">
		<?php //echo $form->textAreaRow($model,'content',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
		<?php
			$this->widget('ext.VinceEditor.widgets.redactorjs.Redactor', 
				array(
					'model' => $model, 
					'attribute' => 'content' ,
					'value' => $model->content
				)
			);
		?>
	</div>
	
	<?php
	$list = CHtml::listData(Categories::model()->findAll(),'alias', 'name');
	
	?>
	<div class="input text">
		<?php 
		if(!empty($model->category)){
			echo $form->dropDownListRow($model,'category_id',$list,array('empty'=>'',
				'options'=>array(
					$model->category->alias=>array('selected'=>'selected')
				)
			)); 
		}else{
			echo $form->dropDownListRow($model,'category_id',$list,array('empty'=>'')); 		
		}
		?>
		
	</div>
	<div class="submit">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Đăng bài' : 'Lưu',
			'htmlOptions'=>array('class'=>'button')
		)); ?>
	</div>

<?php $this->endWidget(); ?>
