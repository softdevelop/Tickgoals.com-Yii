<?php
/* @var $this WageController */
/* @var $model Wages */

$this->breadcrumbs=array(
	'Wages'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Wages', 'url'=>array('index')),
	array('label'=>'Create Wages', 'url'=>array('create')),
	array('label'=>'Update Wages', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Wages', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Wages', 'url'=>array('admin')),
);
?>

<h1>View Wages #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'price',
	),
)); ?>
