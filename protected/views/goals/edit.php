
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
					
               <?php echo CHtml::link('Go Back',array('/goals?uId='.outStr(currentUser()->id)), array("role"=>"button", "class"=>"btn btn-info pull-right", "data-toggle"=>"modal", "id"=>"btn-login"));?> 
					<h4>Edit Goals</h4>
				</div>
				
				<?php
				// if(!empty($list)){
				?>

				<div class="p-20">
					<div class="theme-box">
					<?php 
						
						$form = $this->beginWidget('CActiveForm', array(
							'id'=>'goal-form',
							'action'=>Yii::app()->createUrl('/goals/edit',array('gId'=>outStr($model->id))),
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
								
										<?php
											// if(!empty($dataGoals)){
												// foreach($dataGoals as $k=>$goal){
													// $this->renderPartial('//common/_goals',array(
														// 'goal'=>$goal
													// ));
										
												// }
											// }
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
							
							<button type="submit" class="btn btn-info pull-right" value>
								<i class="icon-edit icon-white"></i> Edit Goal
							</button>
							
							<div class="clearfix"></div>
						</div>
						
					</div>
					<?php $this->endWidget(); ?>
				</div>
				<?php
				// }
				?>
				
				
			</div>
		</div>
	</div>
</div>