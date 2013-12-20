<?php
	$date = strtotime($goal->completion);
?>
<div class="theme-box m-bottom-15 m-top-25">
	<div class="p-12" ref="<?php echo Yii::app()->createUrl('/goals/editGoals',array('gId'=>outStr($goal->id),'listId'=>$listId));?>" name="<?php echo $goal->name;?>" reminder="<?php echo $goal->reminder;?>" completion="<?php echo date("Y-m-d",$date);;?>">
		<div class="edit-goals">
			<?php
			if(!empty($share)){
			?>
				<p style="color:black"><?php echo $goal->name;?></p>
			<?php
			}else{
			?>
				<p style="<?php  if($goal->status==0) echo "color:black;";else echo "color:green;";?>"><?php echo $goal->name;?></p>
			<?php
			}
			?>
			
		</div>
		<hr>
		<div class="m-d pull-left" id="container-reminder">
			<span ><?php echo $goal->reminder;?></span> |
			<span>
			<?php
			
			echo date("d M Y",$date);
			
			?>
			</span>
		</div>
		<div class="pull-right">
			<?php
			
			if(!isset($guest)){
			?>
			<a href="javascript:void(0)" id="edit-goals-list" ><i class="icon-edit"></i></a>
			<a href="#" id="removegoal" ref="<?php echo Yii::app()->createUrl('/goals/removeGoal',array('goalId'=>outStr($goal->id)));?>"><i class="icon-remove"></i></a>
			<?php
			}
			?>
			<!--<a href="#"><i class="icon-ok-circle"></i></a>-->
		</div>
		<div class="clearfix"></div>
	</div>
</div>