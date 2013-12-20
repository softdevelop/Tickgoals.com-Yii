<div id="home">
	<div class="rain">
		<div class="border start">
					<?php 
					$form = $this->beginWidget('CActiveForm', array(
						'id'=>'user-form',
						'enableAjaxValidation'=>true,
						'enableClientValidation'=>true,
						'focus'=>array($model,'email'),
					)); 
					?>


					<div class="input">
						<?php echo $form->labelEx($model,'email'); ?>
						<?php echo $form->textField($model,'email'); ?>
						<?php echo $form->error($model,'email'); ?>
					</div>
					<div class="input">
						<?php echo $form->labelEx($model,'password'); ?>
						<?php echo $form->passwordField($model,'password'); ?>
						<?php echo $form->error($model,'password'); ?>
					</div>


                    
                    <div class="forgot-password"><a href="#">Forgot your password?</a></div>
                    
                    <div class="submit">
                        <input type="submit" value="Login" />
                    </div>
					<?php $this->endWidget(); ?>
		</div>
	</div>
</div>