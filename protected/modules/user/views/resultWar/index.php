<?php
/* @var $this ResultWarController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Result Wars',
);

$this->menu=array(
	array('label'=>'Create ResultWar', 'url'=>array('create')),
	array('label'=>'Manage ResultWar', 'url'=>array('admin')),
);
?>

<h1>Result Wars</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
