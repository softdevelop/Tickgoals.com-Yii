<?php
$this->breadcrumbs=array(
	'Groups'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Groups','url'=>array('index')),
	array('label'=>'Create Groups','url'=>array('create')),
	array('label'=>'Update Groups','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Groups','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Groups','url'=>array('admin')),
);
?>

<h1>View Groups #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'level',
	),
)); ?>
