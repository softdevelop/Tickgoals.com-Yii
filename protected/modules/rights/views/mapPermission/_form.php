<?php
/* @var $this MapPermissionController */
/* @var $model MapPermission */
/* @var $form CActiveForm */
?>



<?php
$group = Groups::model()->findAll();
$list = CHtml::listData($group,'id', 'name');   
$listGroup = array();
foreach($list as $k=>$v){
	$listGroup[outStr($k)] = $v;
}

// $per = Permission::model()->findAll();
// $list = CHtml::listData($per,'id', 'name');   
// $listPermission = array();
// foreach($list as $k=>$v){
	// $listPermission[outStr($k)] = $v;
// }
?>


<script>
$().ready(function(e){
	$("#MapPermission_group_id").change(function(e){
		window.location.href = "<?php echo $this->createUrl('/rights/mapPermission/create');?>/gId/"+$(this).val();
	});
});
</script>

		<?php
			if(!empty($update)){
				$this->renderPartial('_action',array(
					'items'=>$items,
					'update'=>1,
					'model'=>$model,
					'gId'=>$gId,
					'listGroup'=>$listGroup,
				));			
			}else{
				$this->renderPartial('_action',array(
					'items'=>$items,
					'listGroup'=>$listGroup,
				));			
			}

		?>
