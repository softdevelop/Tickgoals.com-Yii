
<div class="container m-top-25 m-bottom-30">
	<div class="row">
		<div class="span12">
		<?php $this->widget('bootstrap.widgets.TbAlert', array(
			'block'=>true, // display a larger alert block?
			'fade'=>true, // use transitions?
			'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
			'alerts'=>array( // configurations per alert type
				'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
			),
		)); ?>
		</div>
		<div class="span12">
			<div class="theme-box outer-box">
				<div class="theme-box-head">
					
					
					<a href="#myModalCreateList" role="button" class="btn btn-success pull-right" data-toggle="modal" id="btn-login">Create List</a>
					<h4>Goals</h4>
				</div>
				
				<?php
				if(!empty($list)){
				?>

				<div class="p-20">
					<div class="theme-box">
					<?php 
						
						$form = $this->beginWidget('CActiveForm', array(
							'id'=>'goal-form',
							'action'=>Yii::app()->createUrl('/goals/add',array('listId'=>outStr($list->id))),
							'enableAjaxValidation'=>true,
							'enableClientValidation'=>true,
							'clientOptions'=>array(
								'validateOnSubmit'=>true,
							),
							'focus'=>array($model,'name'),
							'htmlOptions'=>array(
								'style'=>"margin-bottom:0px"
							)
						)); 
					?>
					
						<div class="p-12">
								<h5><?php echo $list->name;?></h5>
										<?php
											if(!empty($dataGoals)){
												foreach($dataGoals as $k=>$goal){
													$this->renderPartial('//common/_goals',array(
														'goal'=>$goal,
														'listId'=>outStr($list->id),
													));
										
												}
											}
										?>
							
							<div class="theme-box m-bottom-15">
							
								<div class="p-12">
									

									
									<div class="edit-goals" id="edit-goals" style="min-height:20px"><?php if($model->name=="") echo "Name of Goal gets typed in here";else echo $model->name;?></div>
									<div style="border-bottom: 1px dashed;height:1px;margin-top:10px;" id="dashedinput"></div>
									<?php echo $form->hiddenField($model,'name',array('style'=>'width:98%','placeholder'=>'Name')); ?>
									<?php echo $form->error($model,'name'); ?>
									<hr>
									
									
									<?php
									$data = array(
										''=>'Reminders',
										'Daily'=>'Daily',
										'Weekly'=>'Weekly',
										'Monthly'=>'Monthly',
									);
									echo $form->dropDownList($model,'reminder',  $data,array('class'=>'span3'));
									$this->widget('zii.widgets.jui.CJuiDatePicker',array(
										'model'=>$model,
										'attribute'=>'completion',
										// additional javascript options for the date picker plugin
										'options'=>array(
											'showAnim'=>'fold',
											'dateFormat'=>'yy-mm-dd',
										),
										'htmlOptions'=>array(
											'style'=>'height:20px;margin-left:15px;',
											'placeholder'=>'Date completion'
										),
									));
									?>
									<?php echo $form->error($model,'reminder'); ?>
									<?php echo $form->error($model,'completion'); ?>
									
								</div>
							</div>
							<a href="javascript:void(0)" id="removelist" ref="<?php echo Yii::app()->createUrl('/goals/removeList',array('listId'=>outStr($list->id),'ref'=>'redirect'));?>"><i class="icon-remove-circle"></i></a>
							<button type="submit" class="btn btn-info pull-right" value>
								<i class="icon-plus icon-white"></i> Add Goal
							</button>
							
							<div class="clearfix"></div>
						</div>
						
					</div>
					<?php $this->endWidget(); ?>
				</div>
				<?php
				}
				?>
				
				
			</div>
		</div>
	</div>
</div>
<?php if(currentUser()) : ?>
<div id="myModalCreateList" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Create new list</h3>
	</div>
	<?php 
	$model = new Lists;
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'lists-form',
		'action'=>Yii::app()->createUrl('/goals/createList'),
		'enableAjaxValidation'=>true,
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
		'focus'=>array($model,'name'),
		'htmlOptions'=>array(
			'style'=>"margin-bottom:0px"
		)
	)); 
	?>
	
	<div class="modal-body">
		<div class="p-20">
			<div class="theme-box">
				
				<div class="p-12">
						<fieldset>
							<?php echo $form->labelEx($model,'name'); ?>
							<?php echo $form->textField($model,'name',array('style'=>'width:98%','placeholder'=>'Name')); ?>
							<?php echo $form->error($model,'name'); ?>
							<div class="clearfix"></div>
							

						</fieldset>
					
				</div>
				
			</div>
		</div>
	</div>
	<div class="modal-footer">
		
		<button type="submit" class="btn btn-info">Create</button>
	</div>
	<?php $this->endWidget(); ?>
</div>
<?php endif;?>