<?php
/* @var $this MapPermissionController */
/* @var $model MapPermission */

$this->breadcrumbs=array(
	'Map Permissions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MapPermission', 'url'=>array('index')),
	array('label'=>'Create MapPermission', 'url'=>array('create')),
	array('label'=>'Update MapPermission', 'url'=>array('update', 'id'=>outStr($model->id))),
	array('label'=>'Delete MapPermission', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>outStr($model->id)),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MapPermission', 'url'=>array('admin')),
);
?>

<h1>View MapPermission #<?php echo $model->group->name; ?></h1>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'group_id'=>array(
			'value'=>"{$model->group->name}",
			'label'=>'Group'
		),
		'permission_id'=>array(
			'value'=>"{$model->per->name}",
			'label'=>'Permission'
		)

	),
)); ?>
