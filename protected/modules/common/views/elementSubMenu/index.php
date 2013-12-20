<?php
/* @var $this ElementSubMenuController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Element Sub Menus',
);

$this->menu=array(
	array('label'=>'Create ElementSubMenu', 'url'=>array('create')),
	array('label'=>'Manage ElementSubMenu', 'url'=>array('admin')),
);
?>

<h1>Element Sub Menus</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
