<?php
/* @var $this ResultWarController */
/* @var $model ResultWar */

$this->breadcrumbs=array(
	'Result Wars'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ResultWar', 'url'=>array('index')),
	array('label'=>'Create ResultWar', 'url'=>array('create')),
	array('label'=>'Update ResultWar', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ResultWar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ResultWar', 'url'=>array('admin')),
);
?>

<h1>View ResultWar #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'teama',
		'teamb',
		'rsa',
		'rsb',
		'created',
	),
)); ?>
