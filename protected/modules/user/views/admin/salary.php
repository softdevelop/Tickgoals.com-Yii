<div class="buttons attop">
	<ul class="breadcrumbGo">
		<li>
			<a href="<?php echo $this->createUrl('/');?>" class="fist_link">Trang chủ</a>
		</li>
		<li>
			<?php
				echo CHtml::link('Thành viên','#');
			?>
		</li>
		<li>
			<?php
				echo CHtml::link('Danh sách User',array('/user/admin'),array('class'=>'fisnish_link'));
			?>
		</li>
	</ul>	
	<ul class="type_buttons">
		<li><a href="javascript:void(0)" class="back" onclick="history.back();">Trở về</a></li>
	</ul>
	
</div>

<style>
.table p{margin:10px 0;}
</style>
<!-- table -->
<div class="table">
<?php
	$total = 0;
	$price = 0;
	if(!empty($user)){
		foreach($user as $k=>$u){
			if(!empty($settings)){
				foreach($settings as $key=>$setting){
					if($setting->key=="cong-doan"){
						$cd = $setting->value*$u->salary;
						$price = $price-$cd;
					}else{
						$price = $price-$setting->value;
					}
					
				}
			}
			$price = $price + $u->salary;
			$total = $total + $price;
		}
		
	
	}
?>
	<p style="color:red; font-size:40px;">
		<b>
			Tổng lương cty phải trả: <span id="total"><?php echo Yii::app()->format->formatNumber($total);?> VND</span>
			
		</b>
	</p>
</div>
<script>
$().ready(function(e){

});
</script>
