<?php
/* @var $this TeamMappingController */
/* @var $model TeamMapping */

$this->breadcrumbs=array(
	'Team Mappings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TeamMapping', 'url'=>array('index')),
	array('label'=>'Create TeamMapping', 'url'=>array('create')),
	array('label'=>'Update TeamMapping', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TeamMapping', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TeamMapping', 'url'=>array('admin')),
);
?>

<h1>View TeamMapping #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'team_id',
		'note',
	),
)); ?>
