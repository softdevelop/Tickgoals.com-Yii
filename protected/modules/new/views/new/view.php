<div class="buttons attop">
	<ul class="breadcrumb">
		<li>
			<a href="<?php echo $this->createUrl('/');?>" class="fist_link">Trang chủ</a>
		</li>
		<li>
			<?php
				echo CHtml::link('Bài viết','#');
			?>
		</li>
		<li>
			<?php
				echo CHtml::link($model->title,'#',array('class'=>'fisnish_link'));
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
		<li><a href="#section-1">Bài viết</a></li>
	</ul>
	<div class="panel">
		<div id="section-1">
			<fieldset class="form">
				<h3><?php echo $model->title;?></h3>
				<p>
				<?php echo strip_tags($model->content,"<p><br>");?>
				</p>
				<p>
				<b>Thể loại: </b>
				<?php
					echo CHtml::link($model->category->name,'#');
				?>
				</p>
				<p>
				<b>Người viết: </b>
				<?php
					echo CHtml::link($model->user->first_name." ".$model->user->last_name,'#');
				?>
				</p>
			</fieldset>
		</div>
	</div>
</div>

