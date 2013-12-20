<?php
/* @var $this BeveragesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Beverages',
);

$this->menu=array(
	array('label'=>'Create Beverages', 'url'=>array('create')),
	array('label'=>'Manage Beverages', 'url'=>array('admin')),
);
?>

<h1>Beverages</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
