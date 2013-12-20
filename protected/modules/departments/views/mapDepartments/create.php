<?php
/* @var $this MapDepartmentsController */
/* @var $model MapDepartments */

$this->breadcrumbs=array(
	'Map Departments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MapDepartments', 'url'=>array('index')),
	array('label'=>'Manage MapDepartments', 'url'=>array('admin')),
);
?>

<h1>Create MapDepartments</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>