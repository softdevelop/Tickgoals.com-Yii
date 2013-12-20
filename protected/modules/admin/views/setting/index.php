<div id="content-header">
	<h1>Settings</h1>
	<div class="btn-group">
		<a class="btn btn-large tip-bottom" title="Add setting" href="<?php echo Yii::app()->createUrl('/admin/setting/create');?>"><i class="icon-plus"></i></a>
	</div>
</div>
<div id="breadcrumb">
	<a href="<?php echo $this->createUrl('/');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Dashboard</a>
	<a href="<?php echo $this->createUrl('/site/goals');?>" class="current">Settings</a>
</div>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="widget-box" style="overflow:hidden">
				<div class="widget-title" >
					<span class="icon">
						<i class="icon icon-th"></i>
					</span>
					<h5>Settings</h5>
					<div class="widget-content nopadding">
					<?php
					$this->widget('ext.bootstrap.widgets.TbGridView', array(
								'dataProvider'	=> $model,
								'type'			=> 'striped bordered condensed',
								'columns'		=> array(
									array(
										'header'=>'Category',
										'value'=>'$data->category'
									),
									
									
									array(
										'header'=>'Action',
										'class'=>'ext.bootstrap.widgets.TbButtonColumn',
										'template'=>'{update}{delete}',
										'buttons' => array(
											'update' => array(
												'label'=>'Update',
												'url' => 'Yii::app()->createUrl("/user/register/update", array("id"=>outStr($data->id)))',
											),
											'delete' => array(
												'label'=>'Delete',
												'url' => 'Yii::app()->createUrl("/user/users/delete", array("id"=>outStr($data->id)))',
											)
										),

									),
								),
							));
					?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>