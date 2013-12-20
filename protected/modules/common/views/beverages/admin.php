<?php
/* @var $this BeveragesController */
/* @var $model Beverages */

$this->breadcrumbs=array(
	'Beverages'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Beverages', 'url'=>array('index')),
	array('label'=>'Create Beverages', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('beverages-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Beverages</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php
$data = Beverages::model()->findAll();
if(!empty($data)){
	$cnt = 0;
	foreach($data as $key=>$b){
		$cnt++;
		echo "<div style='wdith:100%; padding:10px; border-bottom:1px dashed #d1d1d1'>";
			echo $cnt;
			echo " - ";
			echo $b->name;
			echo " - ";
			echo $b->col;
			echo " [ ";
			echo CHtml::link('Edit',Yii::app()->createUrl('/common/beverages/update',array('id'=>outStr($b->id))));
			echo " - ";
			echo CHtml::link('Delete',Yii::app()->createUrl('/common/beverages/delete',array('id'=>outStr($b->id))));
			echo " ] ";
		echo "</div>";
	}
}
?>
