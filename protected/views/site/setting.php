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
					
					
					<h4> Setting</h4>
					
				</div>
									
				
				
				
				<div class="p-20 ">
								<div class="theme-box">
									<div class="p-12">
										
										<h5>User profile</h5>
										
										<?php 
										
										$form = $this->beginWidget('CActiveForm', array(
											'id'=>'register-form',
											'action'=>Yii::app()->createUrl('/site/setting'),
											
											'focus'=>array($model,'first_name'),
											'htmlOptions'=>array(
												'style'=>"margin-bottom:0px"
											)
										)); 
										?>
										
											<fieldset>
												<label for="Users_name">First Name <span class="required">*</span></label>
												<?php echo $form->textField($model,'first_name',array('class'=>'span3','placeholder'=>'First name')); ?>
												
												
												<?php echo $form->error($model,'first_name'); ?>
												<div class="clearfix"></div>
												<label for="Users_name">Last Name <span class="required">*</span></label>
												<?php echo $form->textField($model,'last_name',array('class'=>'span3','placeholder'=>'Last name')); ?>
												
												
												<?php echo $form->error($model,'last_name'); ?>
												<div class="clearfix"></div>
												<label for="Users_name">Email <span class="required">*</span></label>
												<?php echo $form->textField($model,'email',array('class'=>'span3','placeholder'=>'Email')); ?>
												
												
												<?php echo $form->error($model,'email'); ?>
												<div class="clearfix"></div>
												<label for="Users_name">Current Password <span class="required">*</span></label>
												<?php echo $form->passwordField($model,'oldPassword',array('class'=>'span3','placeholder'=>'Password')); ?>
												
												
												<?php echo $form->error($model,'oldPassword'); ?>
												<div class="clearfix"></div>
												
												<label for="Users_name">Set reminder time<span class="required">*</span></label>
												<?php echo $form->textField($model,'hour',array('class'=>'span3','placeholder'=>'Reminder','style'=>'width:20px;')); ?>
												<?php echo $form->textField($model,'minute',array('class'=>'span3','placeholder'=>'Reminder','style'=>'width:20px;')); ?>
												

												
												<?php echo $form->error($model,'hour'); ?>
												<?php echo $form->error($model,'minute'); ?>
												<div class="clearfix"></div>
												
											</fieldset>
										
										
										
										
										
											<button type="submit" class="btn btn-info">Edit</button>
										
										<?php $this->endWidget(); ?>
										<div class="clearfix"></div>
									
									
								</div>
							</div>
				
				
			</div>
			
			
		</div>
	</div>
</div>
