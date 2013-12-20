<?php
/* @var $this MapPermissionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Map Permissions',
);

$this->menu=array(
	array('label'=>'Create MapPermission', 'url'=>array('create')),
	array('label'=>'Manage MapPermission', 'url'=>array('admin')),
);
?>

<h1>Map Permissions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
