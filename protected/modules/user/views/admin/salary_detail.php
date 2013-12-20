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
	$price = 0;
	if(!empty($user)){
	
		echo "<p><b>Họ tên:</b> {$user->first_name} {$user->last_name}</p>";
		echo "<p><b>Lương thực lãnh:</b> <label>{$user->salary}</label></p>";
		echo "<p><b>Lương hiệu quả :</b><label> 0</label></p>";
		$price = $user->salary;
		if(!empty($settings)){
			foreach($settings as $key=>$setting){
				if($setting->key=="cong-doan"){
					$cd = $setting->value*$user->salary;
					echo "<p><b>Quỹ công đoàn:</b><label> {$cd}</label></p>";
					$price = $price-$cd;
				}else{
					echo "<p><b>{$setting->category}:</b><label> {$setting->value}</label></p>";
					$price = $price-$setting->value;
				}
				
			}
		}
	
	}
?>
	<p style="color:red">
		<b>
			Số tiền phải trả: <span id="total"><?php echo $price;?> VND</span>
			
		</b>
	</p>
</div>
<script>
$().ready(function(e){

});
</script>
