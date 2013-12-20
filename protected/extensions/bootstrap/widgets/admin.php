<?php
	$className = get_class($model);
	$arayCollum = array();
	$cnt = 0;
	
	foreach($model->attributes as $key=>$attributes){
		if(!empty($key)){
			if(stristr($key,'des')==false && stristr($key,'about')==false &&  stristr($key,'id')==false && stristr($key,'status')==false && stristr($key,'twitter')==false && stristr($key,'oauth')==false && stristr($key,'visit')==false &&  stristr($key,'key')==false && stristr($key,'super')==false){
				$arayCollum[$cnt]['name'] = $key;
				if(!isset($_GET[$className])){
					$arayCollum[$cnt]['value'] = $attributes;
				}
				
				$cnt++;
			}
		}
		
		
	}
	$arayCollum[$cnt] = 		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template' => '{view} {update} {delete}',
			'buttons' => array(
				'view' => array(									
					'url' => 'array("view","id"=>IDHelper::uuidFromBinary($data->id))',
				),
				'update' => array(
					'url' => 'array("update","id"=>IDHelper::uuidFromBinary($data->id))',
				),
				'delete' => array(
					'url' => 'array("delete","id"=>IDHelper::uuidFromBinary($data->id))',
				),
			),
	);
	if(!empty($numberItem) && is_numeric($numberItem)){
		switch($numberItem){
			case 2:
				$arayCollum[$cnt] = 		array(
						'class'=>'bootstrap.widgets.TbButtonColumn',


				);
			break;
			case 3:
				$arayCollum[$cnt] = 		array(
						'class'=>'bootstrap.widgets.TbButtonColumn',
						'template' => '{view} {update} {delete}',
						'buttons' => array(
							'view' => array(									
								'url' => 'array("view","id"=>IDHelper::uuidFromBinary($data->id))',
							),
							'update' => array(
								'url' => 'array("update","id"=>IDHelper::uuidFromBinary($data->id))',
							),
							'delete' => array(
								'url' => 'array("delete","id"=>IDHelper::uuidFromBinary($data->id))',
							),
						),
				);
			break;
			case 1:
				$arayCollum[$cnt] = 		array(
						'class'=>'bootstrap.widgets.TbButtonColumn',
						'template' => '{delete}',
						'buttons' => array(
							'delete' => array(
								'url' => 'array("delete","id"=>IDHelper::uuidFromBinary($data->id))',
							),
						),
				);
			break;
		}
	}
	

?>


	<div style=" float:left; width:950px">
	
	<?php
	if(!empty($title)){
	?>
	<h1><?php echo $title;?></h1>
	<?php
	}else{
	?>
	<h1>Manage <?php echo $className;?></h1>
	<?php
	}
	?>
	

	<?php 
	//d($arayCollum);
	$this->widget('bootstrap.widgets.TbGridView',
		array(
			'id'=>'adv-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			//'columns'=>$arayCollum
		)
	);
	?>




	</div>




