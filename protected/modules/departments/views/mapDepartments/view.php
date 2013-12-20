<?php
/* @var $this MapDepartmentsController */
/* @var $model MapDepartments */

$this->breadcrumbs=array(
	'Map Departments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MapDepartments', 'url'=>array('index')),
	array('label'=>'Create MapDepartments', 'url'=>array('create')),
	array('label'=>'Update MapDepartments', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MapDepartments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MapDepartments', 'url'=>array('admin')),
);
?>

<h1>View MapDepartments #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'department_id',
	),
)); ?>
