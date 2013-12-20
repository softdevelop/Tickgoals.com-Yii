<div id="content-header">
	<h1>Change password</h1>

</div>
<div id="breadcrumb">
	<a href="<?php echo $this->createUrl('/');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Dashboard</a>
	<a href="<?php echo $this->createUrl('/user/changePassword');?>" class="current">Change password</a>
</div>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<?php if(Yii::app()->user->hasFlash('success')):?>
				<div class="alert alert-success">
					<button class="close" data-dismiss="alert">×</button>
					<strong>Success!</strong> 
					<?php echo Yii::app()->user->getFlash('success'); ?>
				</div>
			<?php endif; ?>

			<div class="widget-box">
				<div class="widget-title">
					<span class="icon">
						<i class="icon-align-justify"></i>									
					</span>
					<h5>Change Password</h5>
				</div>
				<div class="widget-content nopadding">
						<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
							'id'=>'changepass',
							'htmlOptions'=>array('class'=>'form-horizontal'),
							'enableAjaxValidation'=>true,
							'enableClientValidation'=>true,
							'focus'=>array($model,'oldPassword'),
						));
						?>

							<div class="control-group">
								<?php echo $form->labelEx($model,'oldPassword'); ?>
								<?php echo $form->passwordField($model,'oldPassword',array('class'=>'span4','type'=>'password')); ?>
								<?php echo $form->error($model,'oldPassword'); ?>
							</div>
							<div class="control-group">
								<?php echo $form->labelEx($model,'password'); ?>
								<?php echo $form->passwordField($model,'password',array('class'=>'span4','type'=>'password')); ?>
								<?php echo $form->error($model,'password'); ?>
							</div>
							
							<div class="control-group">
								<?php echo $form->labelEx($model,'verifyPassword'); ?>
								<?php echo $form->passwordField($model,'verifyPassword',array('class'=>'span4','type'=>'password')); ?>
								<?php echo $form->error($model,'verifyPassword'); ?>
							</div>
							<div class="form-actions">
								<?php $this->widget('bootstrap.widgets.TbButton', array(
									'buttonType'=>'submit',
									'type'=>'success',
									'label'=>'Change',
									'htmlOptions'=>array('class'=>'button')
								)); ?>
								
							</div>
						<?php $this->endWidget(); ?>

				</div>
				
			</div>
		
		</div>
	</div>
</div>

