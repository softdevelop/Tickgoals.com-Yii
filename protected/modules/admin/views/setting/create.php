<div id="content-header">
	<h1>Created setting</h1>

</div>
<div id="breadcrumb">
	<a href="<?php echo $this->createUrl('/');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Dashboard</a>
	<a href="<?php echo $this->createUrl('/admin/setting/admin');?>" class="current">Created Setting</a>
</div>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
		</div>
	</div>
</div>

