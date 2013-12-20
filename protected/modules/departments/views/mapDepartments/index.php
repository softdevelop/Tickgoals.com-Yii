<?php
/* @var $this MapDepartmentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Map Departments',
);

$this->menu=array(
	array('label'=>'Create MapDepartments', 'url'=>array('create')),
	array('label'=>'Manage MapDepartments', 'url'=>array('admin')),
);
?>

<h1>Map Departments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
