<?php
/* @var $this MapDepartmentsController */
/* @var $model MapDepartments */

$this->breadcrumbs=array(
	'Map Departments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MapDepartments', 'url'=>array('index')),
	array('label'=>'Create MapDepartments', 'url'=>array('create')),
	array('label'=>'View MapDepartments', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MapDepartments', 'url'=>array('admin')),
);
?>

<h1>Update MapDepartments <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>