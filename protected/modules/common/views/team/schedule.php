<form name="frm" method="POST">
<?php
$list=CHtml::listData($teams,'id','name');
$lists = array();
if(!empty($list)){
	foreach($list as $key=>$value){
		$lists[outStr($key)] = $value;
	}
}
// dump($lists);
echo CHtml::dropDownList('object_0',$lists,$lists);
echo CHtml::dropDownList('object_1',$lists,$lists);
?>
<input type="text" name="order">
<input type="submit">
</form>


<?php
if(!empty($modelSchedule))
{
	foreach($modelSchedule as $key=>$value){
		?>
		<form name="frm" method="POST" action="<?php echo Yii::app()->baseUrl;?>/common/team/updateSchedule">
		<?php
		$zero = Team::model()->findByPk($value->object_o_id);
		echo $zero->name;
		$number = Team::model()->findByPk($value->object_n_id);
		echo " - ";
		echo $number->name;
		?>
		<input type="text" name="order" value="<?php echo $value->filter;?>">
		<input type="hidden" name="zero" value="<?php echo outStr($value->object_o_id);?>">
		<input type="hidden" name="number" value="<?php echo outStr($value->object_n_id);?>">
		<input type="hidden" name="id" value="<?php echo outStr($value->id);?>">
		<input type="submit">
		</form>
		<?php
		echo " <br> ";
	}
}
?>

