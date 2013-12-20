<?php

$criteria	=	new CDbCriteria;
$result	=	$model->findAll($criteria);
$count		=	count($result);
$pages				=	new CPagination($count);
$pages->pageSize	=	20;
$pages->applyLimit($criteria);
$object =	$model->findAll($criteria);
?>

<?php if ($pages->pageCount>1) { ?>
<div class="paging-wrapper">
	<div class="paging">
	
	<?php
		$to		=	$pages->offset+1;
		$from	=	$pages->offset+$pages->limit;
		if($from >=$count)	$from = $count;
		$this->widget('application.components.CustomPagination', array(
			'cssFile'=> '',
			'pages' => $pages,
			'header' => " <span class='page'>Trang <strong>{$to}</strong>/{$from} - Tổng: <strong>{$count}</strong></span>",
			'footer' => '',
			'firstPageLabel' => 'Đầu trang',
			'prevPageLabel' => 'Lùi',
			'nextPageLabel' => 'Tới',
			'lastPageLabel' => 'Cuối trang',
			'cssFile'=>''
		));
	?>
	</div>
</div>
<?php
}
?>
<!-- table -->
<div class="table">
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
			<?php
			$tmpCnt = 0;
			foreach($model->attributes as $key=>$attributes){
				
				if(!empty($key)){
					if(stristr($key,'des')==false && stristr($key,'about')==false &&  stristr($key,'id')==false && stristr($key,'status')==false && stristr($key,'twitter')==false && stristr($key,'oauth')==false && stristr($key,'visit')==false &&  stristr($key,'key')==false && stristr($key,'super')==false){
						$arayCollum[] = $key;
						echo "<th>{$key}</th>";
						
						// $cnt++;
					}
				}
				$tmpCnt++;
				
			}
			
			?>

				<th>Chức năng</th>
			</tr>
		</thead>

	<tbody>
	<?php
	$data = array();
	if(!empty($object)){
		$cnt = 0;
		foreach($object as $key=>$o){
			$attributes = $o->attributes;
			if(!empty($attributes)){
				foreach($attributes as $k=>$v){
					if($k=="id") $data[$cnt][] = outStr($v);
					if(in_array($k,$arayCollum)){
						
						$data[$cnt][] = $v;
						
					}
				}
				$cnt++;
			}
			
		}
	}
	
	if(!empty($data)){
		$cnt = 0;
		foreach($data as $key=>$o){
			dump($o);
			$cnt++;
			$css = "";
			if($cnt%2==0)	$css = "odd";

	?>
		<tr class="<?php echo $css;?>" id="tr<?php echo $cnt;?>">
			<td class="center"><?php echo $cnt;?></td>
			
			<td><a href="#"><?php echo ucfirst($user->first_name);?> <?php echo ucfirst($user->last_name);?></a></td>
			<td class="center"><?php echo date("d-m-Y",strtotime($user->birth));?></td>
			<td class="center"><?php echo $user->phone ? $user->phone : 'Chưa cập nhập';?></td>
			<td class="center"><?php echo $user->email ? $user->email : 'Chưa cập nhập';?></td>
			<td class="center"><?php echo date("d-m-Y",strtotime($user->created));?></td>
			<td class="center">
				<?php
				if($user->is_closed==0){
				?>
				<img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icons/arrow-7.gif" alt="" />
				<?php
				}else{
				?>
				<img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icons/arrow-8.gif" alt="" />
				<?php				
				}
				?>
			</td>
			<td class="center">
				<b><?php echo $user->group ? $user->group->name : '';?>
				
				</b>
			</td>
			<td>
				<div class="functions">
					<div class="header"><h4>Chức năng</h4></div>
					<ul>
						<li><a href="<?php echo $this->createUrl('/user/admin/salaryDetail',array('id'=>outStr($user->id)));?>" class="detail">Lương</a></li>
						<li><a href="<?php echo $this->createUrl('/user/register/update',array('id'=>outStr($user->id)));?>" class="edit">Chỉnh sửa</a></li>
						<li><a href="javascript:void(0)" row="tr<?php echo $cnt;?>" ref="<?php echo $this->createUrl('/user/admin/delete',array('id'=>outStr($user->id)));?>" class="delete">Xóa</a></li>
					</ul>
				</div>
			</td>
		</tr>
	<?php
		}
	}else{
	?>
		<tr>
			<td colspan=9 style="color:red">
				Danh sách thành viên không xác định
			</td>
		</tr>
	<?php
	}
	?>
	</tbody>
	</table>
</div>
<script>
$().ready(function(e){
	$(".delete").live('click',function(e){
		var _this = $(this);
		var row =  $("#"+_this.attr('row'));

		$.ajax({
			type:"GET",
			url : _this.attr('ref'),
			success:function(res){
				if(res.error==false){
					var options = {					
						message	: res.msg,
						autoHide : true,
						timeOut : 5,
						type:'success'
					}
					row.remove();
				}else{
					var options = {					
						message	: res.msg,
						autoHide : true,
						timeOut : 5,
						type:'error'
					}
				}
				jlbd.dialog.notify(options);
				return false;			
			},
			error:function(res){
				var options = {					
					message	: 'Xóa user không thành công',
					autoHide : true,
					timeOut : 5,
					type:'error'
				}
				jlbd.dialog.notify(options);
				return false;
			}
		});
	
	

	});
});
</script>
