<?php
/* @var $this ElementSubMenuController */
/* @var $model ElementSubMenu */

$this->breadcrumbs=array(
	'Element Sub Menus'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ElementSubMenu', 'url'=>array('index')),
	array('label'=>'Create ElementSubMenu', 'url'=>array('create')),
	array('label'=>'View ElementSubMenu', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ElementSubMenu', 'url'=>array('admin')),
);
?>

<h1>Update ElementSubMenu <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>