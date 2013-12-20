<?php
/* @var $this PermissionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Permissions',
);

$this->menu=array(
	array('label'=>'Create Permission', 'url'=>array('create')),
	array('label'=>'Manage Permission', 'url'=>array('admin')),
);
?>

<h1>Permissions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
