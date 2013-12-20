<?php
/* @var $this MapPermissionController */
/* @var $model MapPermission */

$this->breadcrumbs=array(
	'Map Permissions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MapPermission', 'url'=>array('index')),
	array('label'=>'Manage MapPermission', 'url'=>array('admin')),
);
?>

<h1>Create MapPermission</h1>

<?php
	echo $this->renderPartial('_form', array('model'=>$model,'items'=>$items,
		'gId'=>$gId,
		'update'=>1,
	)); 
?>