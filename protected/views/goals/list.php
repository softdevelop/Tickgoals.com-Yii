<script>
var name;
var listid;
var textSave = "Save";
$().ready(function(e){
	$("#inputNameList").live('focusout',function(e){
		var t = $(this).val();
		var _this = $(this);
		$.ajax({
			type:"POST",
			url:"<?php echo Yii::app()->baseUrl;?>/site/updateList",
			data:{listid:listid,name:t},
			success:function(res){
				_this.parent().html('<h5 id="editNameList" listid="'+listid+'" name="'+t+'">'+t+'</h5>');
			}
		});
	});
	
	$("#editNameList").live('click',function(e){
		name = $(this).attr('name');
		listid = $(this).attr('listid');
		$(this).html('<input style="width:110%"  name="name" id="inputNameList" type="text" maxlength="255" value="'+name+'">');
		$(this).find('input').focus();
	});
	$("#edit-goals-list").live('click',function(e){
		var parent = $(this).parent().parent();
		var ng = parent.attr('name');
		var completion = parent.attr('completion');
		var reminder = parent.attr('reminder');
		
		parent.find('div.edit-goals p').html('<input name="name" id="inputNameGoals" type="text" maxlength="255" value="'+ng+'">');
		parent.find('div.edit-goals p').find('input').focus();
		if(reminder=="Daily") parent.find('div#container-reminder').html('<select class="span3" name="Goal[reminder]" id="Goal_reminder"><option value="">Reminders</option><option value="Daily" selected="selected">Daily</option><option value="Weekly">Weekly</option><option value="Monthly">Monthly</option></select><input style="height:20px;margin-left:15px;" placeholder="Date completion" id="Goal_completion" name="Goal[completion]" type="text" value="'+completion+'"><button style="margin-left:10px" type="submit" class="btn btn-success pull-right" value="" onclick="editGoal(this)">'+textSave+'</button>');
		else if(reminder=="Weekly") parent.find('div#container-reminder').html('<select class="span3" name="Goal[reminder]" id="Goal_reminder"><option value="">Reminders</option><option value="Daily" >Daily</option><option selected="selected" value="Weekly">Weekly</option><option value="Monthly">Monthly</option></select><input style="height:20px;margin-left:15px;" placeholder="Date completion" id="Goal_completion" name="Goal[completion]" type="text" value="'+completion+'"><button style="margin-left:10px" type="submit" class="btn btn-success pull-right" value="" onclick="editGoal(this)">'+textSave+'</button>');
		else if(reminder=="Monthly") parent.find('div#container-reminder').html('<select class="span3" name="Goal[reminder]" id="Goal_reminder"><option value="">Reminders</option><option value="Daily" >Daily</option><option  value="Weekly">Weekly</option><option value="Monthly" selected="selected">Monthly</option></select><input style="height:20px;margin-left:15px;" placeholder="Date completion" id="Goal_completion" name="Goal[completion]" type="text" value="'+completion+'"><button style="margin-left:10px" type="submit" class="btn btn-success pull-right" value="" onclick="editGoal(this)">'+textSave+'</button>');
		
		$('#Goal_completion').datepicker({'showAnim':'fold','dateFormat':'yy-mm-dd'});
		
		




	});
});
function editGoal(obj){
	var _this = $(obj);
	var parent = _this.parent().parent();
	var ng = parent.find('div.edit-goals p').find('input').val();
	var reminder = parent.find('div#container-reminder').find('select').val();
	var completion = parent.find('div#container-reminder').find('input').val();
	$.ajax({
		type:"POST",
		url:parent.attr('ref'),
		data:{name:ng,reminder:reminder,completion:completion},
		success:function(res){
			console.log(res)
			if(!res.data.error){
				parent.find('div.edit-goals p').html(res.data.name);
				parent.attr('name',res.data.name);
				parent.attr('completion',res.data.completion);
				parent.attr('reminder',res.data.reminder);
				parent.find('div#container-reminder').html('<span >'+res.data.reminder+'</span> | <span>'+res.data.time+'</span>');
				_this.remove();
			}
		}
	});
	
}
</script>
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker',array(
    'name'=>'publishDate',
    // additional javascript options for the date picker plugin
    'options'=>array(
        'showAnim'=>'fold',
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;display:none'
    ),
));
?>
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

					
						<div class="p-12">
								<h5 id="editNameList" listid="<?php echo outStr($list->id);?>" name="<?php echo $list->name;?>"><?php echo $list->name;?></h5>
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
							
							
									<button type="button" class="btn btn-info pull-right" onclick="$('#frm-add-goals').fadeToggle(); $('#Goal_name').focus();">
										<i class="icon-plus icon-white"></i> Add Goals
									</button>
							
							
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
										'style'=>"margin-bottom:0px;margin-top:50px; "
									)
								)); 
							?>
							<div class="theme-box m-bottom-15" style="display:none" id="frm-add-goals">
							
								<div class="p-12">
									

									
									<div class="edit-goals" id="edit-goals" style="min-height:20px">
										<?php echo $form->textField($model,'name',array('style'=>'width:98%','placeholder'=>'Name of Goal gets typed in here')); ?>
									</div>
									<div style="border-bottom: 1px dashed;height:1px;margin-top:10px;" id="dashedinput"></div>
									
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
								<button type="submit" class="btn btn-success pull-right" style="margin-top:20px;">
									<i class="icon-ok icon-white"></i> Save
								</button>
							</div>
							<!--<a href="javascript:void(0)" id="removelist" ref="<?php echo Yii::app()->createUrl('/goals/removeList',array('listId'=>outStr($list->id),'ref'=>'redirect'));?>"><i class="icon-remove-circle"></i></a>-->
							
							<?php $this->endWidget(); ?>
							<div class="clearfix"></div>
							
						</div>
						
					</div>
					
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