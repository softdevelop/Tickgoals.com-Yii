<div id="content-header">
	<h1>Manage User</h1>
	<div class="btn-group">
		<a class="btn btn-large tip-bottom" title="Export Excel" href="<?php echo $this->createUrl('/user/admin/export');?>"><i class="icon-share"></i></a>
		
	</div>
</div>
<div id="breadcrumb">
	<a href="<?php echo $this->createUrl('/');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Dashboard</a>
	<a href="<?php echo $this->createUrl('/user/admin');?>" class="current">Manage User</a>
</div>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'searchForm',
    'type'=>'search',
    'method'=>'get',
    'htmlOptions'=>array('class'=>'well',
	),
)); ?>
 
<div class="input-prepend"><span class="add-on"><i class="icon-search"></i></span><input class="input-medium" placeholder="Fullname or email" name="name" id="TestForm_textField" type="text" value="<?php echo $name;?>"></div>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Go')); ?>
 
<?php $this->endWidget(); ?>
			<?php if(Yii::app()->user->hasFlash('success')):?>
				<div class="alert alert-success">
					<button class="close" data-dismiss="alert">×</button>
					<strong>Success!</strong> 
					<?php echo Yii::app()->user->getFlash('success'); ?>
				</div>
			<?php endif; ?>
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon">
						<i class="icon-align-justify"></i>									
					</span>
					<h5>Manage Users</h5>
				</div>
				<div class="widget-content nopadding">
				<?php
				$this->widget('ext.bootstrap.widgets.TbGridView', array(
							'dataProvider'	=> $model,
							'type'			=> 'striped bordered condensed',
							'columns'		=> array(
								array(
									'header'=>'Fullname',
									'value'=>'$data->first_name." ".$data->last_name'
								),
								array(
									'header'=>'Birthday',
									'value'=>'date("d-m-Y",strtotime($data->birth))'
								),
								
								array(
									'header'=>'Email',
									'value'=>'$data->email ? $data->email : "<span class=\'label label-important\'>Not Update</span>"',
									'type'=>'raw'
								),

								
								array(
									'header'=>'Permission',
									'value'=>'$data->group ? $data->group->name : "<span class=\'label label-important\'>Not Group</span>"',
									'type'=>'raw'
								),
								
								array(
									'header'=>'Action',
									'class'=>'ext.bootstrap.widgets.TbButtonColumn',
									'template'=>'{update}{delete}',
									'buttons' => array(
										
										'delete' => array(
											'label'=>'Delete',
											'url' => 'Yii::app()->createUrl("/user/admin/delete", array("id"=>outStr($data->id)))',
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
<script>
function addTeam(obj){
	$("#modalAddTeam").trigger('click');
	$("#titleModal").html("Add "+$(obj).attr('name')+ " on team");
	$("#idUser").val($(obj).attr('refid'));
}
$().ready(function(e){
	$("#savechanges").click(function(e){
		$("#formRadio").submit();
	});
});
</script>

