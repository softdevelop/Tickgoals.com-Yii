<div class="buttons attop">
	<ul class="breadcrumbGo">
		<li>
			<a href="<?php echo $this->createUrl('/');?>" class="fist_link">Trang chủ</a>
		</li>
		<li>
			<?php
				echo CHtml::link('Phòng ban ','#');
			?>
		</li>
		<li>
			<?php
				echo CHtml::link('Tạo phòng ban',array('/departments/departments/admin'),array('class'=>'fisnish_link'));
			?>
		</li>
	</ul>	
	<ul class="type_buttons">
		<li><a href="javascript:void(0)" class="back" onclick="history.back();">Trở về</a></li>
	</ul>
	
</div>
<?php
$this->renderPartial('//common/admin/admin',array(
	'model'=>$model,
	'title'=>'Danh sách phòng ban',
	'numberItem'=>2
));
?>


