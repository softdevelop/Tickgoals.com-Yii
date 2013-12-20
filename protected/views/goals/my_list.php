<div class="p-20 ">
								<div class="theme-box">
									<div class="p-12">
										<a href="#myModalShare<?php echo $key;?>" role="button" uuid="<?php echo $uId;?>" name="<?php echo $list->name;?>" listid="<?php echo outStr($list->id);?>"  data-toggle="modal" class="btn pull-right" id="share-list">Share list</a>
										<!--<h5>
										<a href="<?php //echo Yii::app()->createUrl('/goals/list',array('listId'=>outStr($list->id)));?>">
										<?php //echo $list->name;?></h5>-->
										<h5 id="editNameList" listid="<?php echo outStr($list->id);?>" name="<?php echo $list->name;?>"><?php echo $list->name;?></h5>
										</a>
										
										
										
										
										
										
<div id="myModalShare<?php echo $key;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
		<h3 >Share your list</h3>
	</div>
	<div class="modal-body">
		<div class="p-20">
			<div class="theme-box">

				<div class="p-12" id="container-share" style="text-align:center">
				<ul class="way2blogging-social way2blogging-size32">
					<li >
						<a class='javascript:void(0)' id="sEmail" url="<?php echo $this->createAbsoluteUrl('/goals?uId='.$uId);?>" >
							<span style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;" class="stButton"><span class="stLarge" style="background-image: url(<?php echo Yii::app()->baseUrl;?>/images/email_32.png);"></span>
								<img src="http://w.sharethis.com/images/check-big.png" style="position: absolute; top: -7px; right: -7px; width: 19px; height: 19px; max-width: 19px; max-height: 19px; display: none;">
							</span>
						</a>				
					</li>
				</ul>
				


				<script type="text/javascript">var switchTo5x=true;</script>
				<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
				<script type="text/javascript">stLight.options({publisher: "55a97ade-d68f-4b04-ad48-b0569533210d"});</script>

				<?php
$this->widget('ext.sharebox.EShareBox', array(
    // url to share, required.
    'url' => $this->createAbsoluteUrl('/goals?uId='.$uId.'&listid='.outStr($list->id)),
 
    // A title to describe your link, required.
    // Some services will ignore this value.
    'title'=> 'My Awesome web site !!',
 
    // Size of the icons to display, in pixels.
    // Default is 24px, available sizes : 16, 24, 32, 48.
    'iconSize' => 32,
 
    // Whether to animate the links.
    // Default is true
    'animate' => false,
    
 
   // Social networks to include, excluding all others.
   // The exclude filter is still run.
   //'include' => array('technorati', 'digg'),
 
   // Social networks to exclude from display.
   // By default none are excluded.
   'exclude' => array('technorati','email', 'digg','reddit','linkedin','stumbleupon','google-plus','newsvine','delicious'),
 
   // Use your own icons! Note that you will need to have
   // a subfolder of the appropriate icons sizes.
   // ie: /myimages/social/16px /myimages/social/24px ...
   //'iconPath' => '/myimages/social',
 
   // HTML options for the UL element.
   //'ulHtmlOptions' => array('class' => 'myCustomUlClass'),
 
   // HTML options for all the LI elements.
   //'liHtmlOptions' => array('class' => 'myCustomLiClass'),
));
				?>

				</div>
				
			</div>
		</div>
	</div>
	<div class="modal-footer">
		
	</div>
</div>
										
										
										
										
										
										</a>
										<div id="lg<?php echo $key;?>">
										<?php
											if(!empty($list->goals)){
												foreach($list->goals as $k=>$goal){
													$this->renderPartial('//common/_goals',array(
														'goal'=>$goal,
														'uId'=>$uId,
														'listId'=>outStr($list->id),
													));
										
												}
											}
										?>	
										</div>
<a href="javascript:void(0)" id="removelist" ref="<?php echo Yii::app()->createUrl('/goals/removeList',array('listId'=>outStr($list->id)));?>"><i class="icon-remove-circle"></i></a>

									<button type="button" style="margin-top:10px;" class="btn btn-info pull-right" onclick="$('#frm-add-goals<?php echo $key;?>').fadeToggle(); $('#Goal_name').focus();">
										<i class="icon-plus icon-white"></i> Add Goals
									</button>
										
									<?php 
								
								$form = $this->beginWidget('CActiveForm', array(
									'id'=>'goal-form'.$key,
									'action'=>Yii::app()->createUrl('/goals/add',array('listId'=>outStr($list->id))),
									// 'enableAjaxValidation'=>true,
									// 'enableClientValidation'=>true,
									// 'clientOptions'=>array(
										// 'validateOnSubmit'=>true,
									// ),
									'focus'=>array($model,'name'),
									'htmlOptions'=>array(
										'style'=>"margin-bottom:0px;margin-top:30px; "
									)
								)); 
							?>
							<div class="theme-box m-bottom-15" style="display:none" id="frm-add-goals<?php echo $key;?>">
							
								<div class="p-12">
									

									
									<div class="edit-goals" id="edit-goals" style="min-height:20px">
										<?php echo $form->textField($model,'name',array('style'=>'width:98%','placeholder'=>'Name of Goal gets typed in here')); ?>
									</div>
									<div style="border-bottom: 1px dashed;height:1px;margin-top:10px;" id="dashedinput"></div>
									<div class="errorMessage" id="Goals_name_em_<?php echo $key;?>" style="display: none;"></div>
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
											'id'=>'publishDate'.$key,
											'placeholder'=>'Date completion'
										),
									));
									?>
									<?php echo $form->error($model,'reminder'); ?>
									<?php echo $form->error($model,'completion'); ?>
									<div class="errorMessage" id="Goals_reminder_em_<?php echo $key;?>" style="display: none;"></div>
									<div class="errorMessage" id="Goals_completion_em_<?php echo $key;?>" style="display: none;"></div>
									
								</div>
								<button type="button" onclick="saveGoals(this,'<?php echo $key;?>','<?php echo Yii::app()->createUrl('/goals/added',array('listId'=>outStr($list->id)));?>')" class="btn btn-success pull-right" style="margin-top:20px;">
									<i class="icon-ok icon-white"></i> Save
								</button>
							</div>
							<!--<a href="javascript:void(0)" id="removelist" ref="<?php echo Yii::app()->createUrl('/goals/removeList',array('listId'=>outStr($list->id),'ref'=>'redirect'));?>"><i class="icon-remove-circle"></i></a>-->
							
							<?php $this->endWidget(); ?>
										
										
										
										
										
										<?php
										//if(currentUser() && currentUser()->id==outBin($uId)){
										?>
										<!--<a href="<?php echo Yii::app()->createUrl('/goals/add',array('listId'=>outStr($list->id)));?>" class="btn btn-info pull-right margin-top-5"><i class="icon-plus icon-white"></i> Add Goal</a>-->
										<?php //} ?>
										<div class="clearfix"></div>
									</div>
									
								</div>
							</div>