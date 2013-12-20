<?php
/* @var $this ResultWarController */
/* @var $model ResultWar */

$this->breadcrumbs=array(
	'Result Wars'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ResultWar', 'url'=>array('index')),
	array('label'=>'Create ResultWar', 'url'=>array('create')),
	array('label'=>'View ResultWar', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ResultWar', 'url'=>array('admin')),
);
?>

<h1>Update ResultWar <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>