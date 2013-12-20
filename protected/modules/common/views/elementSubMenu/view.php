<?php
/* @var $this ElementSubMenuController */
/* @var $model ElementSubMenu */

$this->breadcrumbs=array(
	'Element Sub Menus'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ElementSubMenu', 'url'=>array('index')),
	array('label'=>'Create ElementSubMenu', 'url'=>array('create')),
	array('label'=>'Update ElementSubMenu', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ElementSubMenu', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ElementSubMenu', 'url'=>array('admin')),
);
?>

<h1>View ElementSubMenu #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'_id',
		'alias',
		'parent',
	),
)); ?>
