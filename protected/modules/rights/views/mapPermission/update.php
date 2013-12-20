<?php
/* @var $this MapPermissionController */
/* @var $model MapPermission */

$this->breadcrumbs=array(
	'Map Permissions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MapPermission', 'url'=>array('index')),
	array('label'=>'Create MapPermission', 'url'=>array('create')),
	array('label'=>'View MapPermission', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MapPermission', 'url'=>array('admin')),
);
?>

<h1>Update MapPermission [ <?php echo $model->group->name; ?> - <?php echo $model->per->name; ?> ]</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'items'=>$items,'update'=>1)); ?>