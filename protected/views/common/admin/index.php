<?php

$className = get_class($dataProvider->model);
?>
<div style="width:960px; margin:0 auto;">

	<div style=" float:left; width:700px;">

<h1>List <?php echo $className;?></h1>
<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'application.views.common.admin._view',
)); ?>

	</div>
	<div style=" float:left; width:250px; margin-left:10px;">
		<?php $this->widget('ext.bootstrap.widgets.BootMenu', array(
			'type'=>'list', // '', 'tabs', 'pills' (or 'list')
			'stacked'=>false, // whether this is a stacked menu
			'items'=>array(
	array('label'=>"Create {$className}",'url'=>array('create')),
	array('label'=>"Manage {$className}",'url'=>array('admin')),
			),
		)); ?>
	</div>
</div>
