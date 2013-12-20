<?php
/* @var $this ResultWarController */
/* @var $model ResultWar */

$this->breadcrumbs=array(
	'Result Wars'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ResultWar', 'url'=>array('index')),
	array('label'=>'Manage ResultWar', 'url'=>array('admin')),
);
?>

<h1>Create ResultWar</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>