<?php
/* @var $this TeamMappingController */
/* @var $model TeamMapping */

$this->breadcrumbs=array(
	'Team Mappings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TeamMapping', 'url'=>array('index')),
	array('label'=>'Manage TeamMapping', 'url'=>array('admin')),
);
?>

<h1>Create TeamMapping</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>