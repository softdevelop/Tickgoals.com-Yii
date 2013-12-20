
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'users-form',
	'htmlOptions'=>array('class'=>'form-horizontal'),
	'enableAjaxValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>false,
	)
)); ?>

	

	
	<div class="control-group">
		<?php echo $form->textFieldRow($model,'first_name',array('class'=>'span5','maxlength'=>200)); ?>
	</div>
	<div class="control-group">
		<?php echo $form->textFieldRow($model,'last_name',array('class'=>'span5','maxlength'=>200)); ?>
	</div>
	<div class="control-group">
		<?php echo $form->textFieldRow($model,'birth',array('class'=>'span5','id'=>'birthday')); ?>
		
	</div>
	<div class="control-group">
		<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>200)); ?>
	</div>
	<?php
	if(empty($update)){
	?>
	<div class="control-group">
		<?php echo $form->passwordFieldRow($model,'password',array('class'=>'span5','type'=>'password')); ?>
	</div>
	<?php
	}
	?>
	<div class="control-group">
	<?php echo $form->radioButtonListRow($model, 'gender', array(
			'Nam',
			'Nữ',
		),array('value'=>$model->gender)); ?>
	</div>
	<div class="control-group">
		<?php echo $form->textFieldRow($model,'phone',array('class'=>'span5')); ?>
	</div>
	<div class="control-group">
		<?php echo $form->textFieldRow($model,'identity_card',array('class'=>'span5')); ?>
	</div>
	<?php
		$group = Groups::model()->findAll();
	?>
	<div class="control-group">
		<label>
			Position
		</label>
		<select name="Users[group_id]">
			<?php
			if(!empty($group)){
				foreach($group as $k=>$g){
					$selected = "";
					$uuid = IDHelper::uuidFromBinary($g->id);
					if($g->id==$model->group_id) $selected = 'selected=selected';
					echo "<option value='{$uuid}' {$selected}>{$g->name}</option>";
				}
			}
			?>
		</select>
	</div>
	<?php
		$wages = Wages::model()->findAll();
	?>
	<div class="control-group">
		<label>
			Salary
		</label>
		<select name="Users[salary]">
			<?php
			if(!empty($wages)){
				foreach($wages as $k=>$g){
					$selected = "";
					$uuid = IDHelper::uuidFromBinary($g->id);
					if($g->price==$model->salary) $selected = 'selected=selected';
					echo "<option value='{$g->price}' {$selected}>{$g->name}</option>";
				}
			}
			?>
		</select>
	</div>
	<?php
	$departmentPost = "";
	if(isset($_POST['Departments']['id'])){
		$departmentPost = $_POST['Departments']['id'];
	}else{
		if(!empty($model->map_class[0])){
			$departmentPost = outStr($model->map_class[0]->department_id);
		}
	}
	?>
	<div class="control-group">
		<label>
			Departments
		</label>
		<select name="Departments[id]">
			
		<?php
		$departments = Departments::model()->get();
		if(!empty($departments)){
			foreach($departments as $key=>$department){
				$strDepartmentID = outStr($department->id);
				$selected = "";
				if($departmentPost==$strDepartmentID) $selected = "selected='selected'";
				echo "<option value='{$strDepartmentID}' {$selected}>{$department->name}</option>";
			}
		}
		?>
		</select>
	</div>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Add User' : 'Update User',
			'htmlOptions'=>array('class'=>'button')
		)); ?>
		
	</div>
<?php $this->endWidget(); ?>
