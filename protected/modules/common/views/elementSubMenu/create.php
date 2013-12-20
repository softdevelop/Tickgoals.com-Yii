<?php
/* @var $this ElementSubMenuController */
/* @var $model ElementSubMenu */

$this->breadcrumbs=array(
	'Element Sub Menus'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ElementSubMenu', 'url'=>array('index')),
	array('label'=>'Manage ElementSubMenu', 'url'=>array('admin')),
);
?>

<h1>Create ElementSubMenu</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>