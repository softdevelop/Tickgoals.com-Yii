<form name="frm" method="GET">
<?php
$obj_o ="";
if(!empty($_GET['object_0'])) $obj_o = $_GET['object_0'];

$obj_1 ="";
if(!empty($_GET['object_1'])) $obj_1 = $_GET['object_1'];

$z ="";
if(!empty($_GET['z'])) $z = $_GET['z'];

$n ="";
if(!empty($_GET['n'])) $n = $_GET['n'];


$list=CHtml::listData($teams,'id','name');
$lists = array();
if(!empty($list)){
	foreach($list as $key=>$value){
		$lists[outStr($key)] = $value;
	}
}
// dump($lists);
echo CHtml::dropDownList('object_0',$lists,$lists,array('empty'=>'',
				'options'=>array(
					$obj_o=>array('selected'=>'selected')
				)
			)); 
echo CHtml::dropDownList('object_1',$lists,$lists,array('empty'=>'',
				'options'=>array(
					$obj_1=>array('selected'=>'selected')
				)
			)); 
?>
<br>
<input type="text" name="z" value="<?php echo $z;?>">
<input type="text" name="n" value="<?php echo $n;?>">
<input type="submit">
</form>
<div style="border:1px dashed #d1d1d1; padding:20px;">
<?php
if(!empty($result)){
	foreach($result as $key=>$value){
		echo "<h2>";
		echo $value->name;
		echo " - ";
		echo $value->created;
		echo "</h2>";
	}
}
?>

</div>

