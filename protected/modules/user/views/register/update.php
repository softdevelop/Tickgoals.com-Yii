<div id="content-header">
	<h1>Update User</h1>

</div>
<div id="breadcrumb">
	<a href="<?php echo $this->createUrl('/');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Dashboard</a>
	<a href="<?php echo $this->createUrl('/user/register');?>" class="current">Update User</a>
</div>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon">
						<i class="icon-align-justify"></i>									
					</span>
					<h5>Update User</h5>
				</div>
				<div class="widget-content nopadding">
					<?php echo $this->renderPartial('_form', array('model'=>$model,'update'=>'update')); ?>
				</div>
			</div>
		</div>
	</div>
</div>
