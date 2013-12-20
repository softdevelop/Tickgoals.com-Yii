<div class="buttons attop">
	<ul class="breadcrumb">
		<li>
			<a href="<?php echo $this->createUrl('/');?>" class="fist_link">Trang chủ</a>
		</li>
		<li>
			<?php
				echo CHtml::link('Nước giải khát','#');
			?>
		</li>
		<li>
			<?php
				echo CHtml::link('Tạo ',array('/common/beverages/create'),array('class'=>'fisnish_link'));
			?>
		</li>
	</ul>	
	<ul class="type_buttons">
		<li><a href="javascript:void(0)" class="back" onclick="history.back();">Trở về</a></li>
	</ul>
	
</div>
<!-- paging -->
<div class="tabs">
	<ul class="items">
		<li><a href="#section-1">Tạo </a></li>
	</ul>
	<div class="panel">
		<div id="section-1">
			<fieldset class="form">
				<h3>Tạo </h3>
					<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
			</fieldset>
		</div>
	</div>
</div>

