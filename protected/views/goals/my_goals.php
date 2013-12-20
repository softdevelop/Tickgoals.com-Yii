<script>
var name;
var listid;
var textSave = "Save";
function saveGoals(obj,strNumber,action){
	var data = $("#goal-form"+strNumber).serialize();
	$.ajax({
		type:"POST",
		url:action,
		data:data,
		success:function(res){
			// console.log(res)
			$("#Goals_name_em_"+strNumber).hide();
			$("#Goals_name_em_"+strNumber).html('');
			$("#Goals_reminder_em_"+strNumber).hide();
			$("#Goals_reminder_em_"+strNumber).html('');
			$("#Goals_completion_em_"+strNumber).hide();
			$("#Goals_completion_em_"+strNumber).html('');
			if(res.error==true){
				$.each(res.data,function(x,y){
					$("#Goals_"+x+"_em_"+strNumber).html(y[0]);
					$("#Goals_"+x+"_em_"+strNumber).show();
				});
			}else{
				var hm = '<div class="theme-box m-bottom-15 m-top-25"><div class="p-12" ref="<?php echo Yii::app()->baseUrl;?>/goals/editGoals?gId='+res.data.id+'&listId='+res.listId+'" name="'+res.data.name+'" reminder="'+res.data.reminder+'" completion="'+res.completion+'">'+
					'<div class="edit-goals">'+
						'<p>'+res.data.name+'</p>'+
					'</div>'+
					'<hr>'+
					'<div class="m-d pull-left" id="container-reminder">'+
						'<span>'+res.data.reminder+'</span> |'+
							'<span>'+res.data.completion+
							'</span>'+
					'</div>'+
					'<div class="pull-right">'+
						'<a href="javascript:void(0)" id="edit-goals-list"><i class="icon-edit"></i></a>'+
						'<a href="#" id="removegoal" ref="<?php echo Yii::app()->baseUrl;?>/goals/removeGoal?goalId='+res.data.id+'"><i class="icon-remove"></i></a>'+
					'</div>'+
					'<div class="clearfix"></div>'+
	'</div></div>';
				$("#lg"+strNumber).prepend(hm);
				$("#goal-form"+strNumber).find('#Goal_name').val('');
				$("#frm-add-goals"+strNumber).hide();
			}
		}
	});
}
$().ready(function(e){

	$("#notFound").live('click',function(e){
		$("#btn-login").trigger('click');
	});
	$("#inputNameList").live('focusout',function(e){
		var t = $(this).val();
		var _this = $(this);
		$.ajax({
			type:"POST",
			url:"<?php echo Yii::app()->createUrl("/site/updateList")?>",
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
	
	
	$("#addInputNameList").live('focusout',function(e){
		var t = $(this).val();
		var _this = $(this);
		$.ajax({
			type:"POST",
			url:"<?php echo $this->createUrl("/site/addList")?>",
			data:{name:t},
			success:function(res){
				// console.log(res)
				if(!res.error){
					_this.parent().html('<h5 id="editNameList" listid="'+res.model.id+'" name="'+t+'">'+t+'</h5>');
					
					$('.removelistnotfound').attr('ref',"<?php echo Yii::app()->baseUrl;?>/goals/removeList?listId="+res.model.id);
					$('.share-list-notfound').attr('listid',res.model.id);
					$('.share-list-notfound').attr('name',t);
					$('.removelistnotfound').show();
					$('.share-list-notfound').show();
					window.location.href = window.location.href;
					// $.ajax({
						// type:"GET",
						// url:"<?php echo Yii::app()->baseUrl;?>/goals/loadGoal?uId=<?php echo $uId;?>",
						// success:function(res){
							
							// $("#loadgoal").html(res);
						// }
					// });
					
				}else{
					console.log(res)
				}
			}
		});
	});
	
	
	$("#addNameList").live('click',function(e){
		name = $(this).attr('name');
		// listid = $(this).attr('listid');
		$(this).html('<input style="width:110%"  name="name" id="addInputNameList" type="text" maxlength="255" value="'+name+'">');
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
					
					<?php
					$us = Users::model()->findByPk(outBin($uId));
					$fn = "";
					// Yii::app()->name = 'custom page title';
					if(!empty($us)) $fn = $us->first_name;
					
					if(currentUser() && currentUser()->id==outBin($uId)){
						$fn = "";
					?>
					<a href="#myModalCreateList" role="button" class="btn btn-success pull-right created-new-list" data-toggle="modal" id="btn-login">Create List</a>
					<?php } ?>
					<h4><?php echo ucwords($fn);?> Goals</h4>
				</div>
				<div id = "form-created-new-list">
					
				</div>
				<div id="loadgoal">
				<?php
				if(!empty($lists)){
					foreach($lists as $key=>$list){
						$this->renderPartial('my_list',array(
							'list'=>$list,
							'key'=>$key,
							'uId'=>$uId,
							'model'=>$model,
						));
					}
				}else{
				?>
				
				<div class="p-20 p-bottom-none">
					<div class="theme-box">
						<div class="p-12">
							<a href="#myModalShare0" role="button" uuid="<?php echo outStr(currentUser()->id);?>" name="My goal list - double click here to change title" listid="" data-toggle="modal" class="btn pull-right" id="share-list" class='share-list-notfound' style="display:none">
								Share list
							</a>
							
							<h5 id="addNameList" name="My goal list - double click here to change title">
								My goal list - double click here to change title
							</h5>
							<a href="javascript:void(0)" class='removelistnotfound' id="removelist" ref="" style="display:none">
								<i class="icon-remove-circle"></i>
							</a>
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
</div>
<script>
var title = "";
var listid = "";
$().ready(function(e){
	$("#share-list").live('click',function(e){
		title = $(this).attr('name');
		listid = $(this).attr('listid');
	});
	$("#sEmail").live('click',function(e){
		window.location.href = "<?php echo Yii::app()->baseUrl;?>/site/shareMail?url="+$(this).attr('url')+"&listid="+listid+"&title="+title;
	});
	$(".created-new-list").live('click', function() {
		var innerHtml = '<div class="p-20 form-add-list"><div class="theme-box"><div class="p-12"><h5 id="addNameList" name="My goal list - double click here to change title">My goal list - double click here to change title</h5></div></div></div>';
		$("#form-created-new-list").find('.form-add-list').remove();
		$("#form-created-new-list").append(innerHtml);
	});
});
</script>

<style>
ul.way2blogging-social {
list-style: none;
margin: 5px 0;
display: inline-block;
}
ul.way2blogging-social li {
display: inline;
float: left;
background-repeat: no-repeat;
}
.stButton {
position: relative;
z-index: 1;
text-decoration: none;
color: #000;
display: inline-block;
cursor: pointer;
margin-right: 3px;
margin-left: 3px;
font-size: 11px;
line-height: 16px;
}
ul.way2blogging-size32 li a {
width: 32px;
height: 32px;
}

ul.way2blogging-social li a {
display: block;
padding-right: 5px;
position: relative;
text-decoration: none;
}
#sharethisfacebook strong{display:none}
#sharethistwitter strong{display:none}
</style>