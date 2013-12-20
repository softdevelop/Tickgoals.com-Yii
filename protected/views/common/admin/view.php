
<?php
$className = get_class($model);
	$arayCollum = array();

	foreach($model->attributes as $key=>$attributes){
		if(!empty($key)){
			if(stristr($key,'id')==false){
				$arayCollum[] = $key;
			}
		}
		
		
	}
?>
<div style="width:960px; margin:0 auto;">

	<div style=" float:left; width:700px;">

<h1>View <?php echo $className;?> </h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>$arayCollum,
)); ?>


	</div>
	<div style=" float:left; width:250px; margin-left:10px;">
		<?php $this->widget('ext.bootstrap.widgets.BootMenu', array(
			'type'=>'list', // '', 'tabs', 'pills' (or 'list')
			'stacked'=>false, // whether this is a stacked menu
			'items'=>array(
	array('label'=>'List '.$className,'url'=>array('index')),
	array('label'=>'Create '.$className,'url'=>array('create')),
	array('label'=>'Update '.$className,'url'=>array('update','id'=>IDHelper::uuidFromBinary($model->id))),
	array('label'=>'Delete '.$className,'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>IDHelper::uuidFromBinary($model->id)),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage '.$className,'url'=>array('admin')),
			),
		)); ?>
	</div>
</div>