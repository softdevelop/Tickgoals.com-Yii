<?php
/* @var $this BeveragesController */
/* @var $model Beverages */

$this->breadcrumbs=array(
	'Beverages'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Beverages', 'url'=>array('index')),
	array('label'=>'Create Beverages', 'url'=>array('create')),
	array('label'=>'Update Beverages', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Beverages', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Beverages', 'url'=>array('admin')),
);
?>

<h1>View Beverages #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'price',
	),
)); ?>
