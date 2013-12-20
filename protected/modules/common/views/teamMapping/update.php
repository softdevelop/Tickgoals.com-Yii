<?php
/* @var $this TeamMappingController */
/* @var $model TeamMapping */

$this->breadcrumbs=array(
	'Team Mappings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TeamMapping', 'url'=>array('index')),
	array('label'=>'Create TeamMapping', 'url'=>array('create')),
	array('label'=>'View TeamMapping', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TeamMapping', 'url'=>array('admin')),
);
?>

<h1>Update TeamMapping <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>