<?php
/* @var $this TeamMappingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Team Mappings',
);

$this->menu=array(
	array('label'=>'Create TeamMapping', 'url'=>array('create')),
	array('label'=>'Manage TeamMapping', 'url'=>array('admin')),
);
?>

<h1>Team Mappings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
