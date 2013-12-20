<div class="container m-top-25 m-bottom-30">
	<div class="row">
		<div class="span12">
			<div class="theme-box outer-box">
				<div class="theme-box-head">
					
					<h4>Forgot Password</h4>
				</div>
				
				<div class="p-20">

					<div class="theme-box">
						
						<div class="p-12">
								<?php 
								$model = new ForgotPass;
								$form = $this->beginWidget('CActiveForm', array(
									'id'=>'forgot-form',
									'action'=>Yii::app()->createUrl('/user/forgot'),
									'enableAjaxValidation'=>true,
									'enableClientValidation'=>true,
									'clientOptions'=>array(
										'validateOnSubmit'=>true,
									),
									'focus'=>array($model,'email'),
									'htmlOptions'=>array(
										'style'=>"margin-bottom:0px"
									)
								)); 
								?>
								<fieldset>
									<?php echo $form->labelEx($model,'email'); ?>
									<?php echo $form->textField($model,'email',array('style'=>'width:98%','placeholder'=>'Email')); ?>
									<?php echo $form->error($model,'email'); ?>
									<div class="clearfix"></div>
									
									
									<button type="submit" class="btn btn-info">Submit</button>
								<?php $this->endWidget(); ?>
							</form>
						</div>
						
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>