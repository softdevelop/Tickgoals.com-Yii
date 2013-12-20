<?php 
if(!empty($items)){
	$controller = array();
	$modules = array();
	$cnt = 0;
	foreach($items as $key=>$item){
		foreach($item as $k=>$i){
			switch($key){
				case "controllers":
					$controller[] = $i;
				break;
				case "modules":
					$modules[$k] = $i;
					$cnt++;
				break;
			}
		}

	}
	$role = array();
	if(!empty($update)){
		$role = Role::model()->findAllByAttributes(array(
			'group_id'=>outBin($gId)
		));
	}
	echo '<div class="widget-box">';
		echo '<div class="widget-title">';
			echo '<span class="icon"><i class="icon-th"></i></span><h5>Controllers</h5>';
		echo '</div>';
		echo '<div class="widget-content nopadding">';
			echo '<table class="table table-bordered table-striped">';

	if(!empty($controller)){
		foreach($controller as $key=>$item){
			echo '<thead>';
				echo '<tr>';
					echo '<th>#</th>';
					echo '<th>Controller</th>';
					echo '<th>Action</th>';
					echo '<th>#</th>';
				echo '</tr>';
			echo '</thead>';
			echo '<tbody>';
			if(!empty($item['actions']))
			{
				$cnt = 0;
				foreach($item['actions'] as $k=>$i){
					echo '<tr>';
					$check = "";
					if(!empty($role)){
						foreach($role as $kr =>$ro){
							if($ro['controller']==$item['name'] && $ro['view']==$i['name']){
								$check = "checked='checked'";
							}
						}
					}

					echo '<td>';
						echo "<input type='checkbox' name='s[{$item['name']}][{$cnt}][check]' {$check}>&nbsp;";
					echo '</td>';
					if(!empty($item['name'])){
						echo '<td>';
							echo "<input  value='{$item['name']}' name='s[{$item['name']}][{$cnt}][controller]' type='hidden'>";
							echo $item['name'];
						echo '</td>';
					}
					if(!empty($i['name'])){
						echo '<td>';
							echo "&nbsp;<input  value='{$i['name']}' name='s[{$item['name']}][{$cnt}][name]' type='hidden'>";
							echo $i['name'];
						echo '</td>';
					}
					echo '<td>';
						echo CHtml::link('<i class="icon-share icon-white"></i> Assign All Groups','javascript:void(0)',array('class'=>'btn btn-inverse  btn-mini','id'=>'groupAll','module'=>'','controller'=>$item['name'],'view'=>$i['name']));
						echo '&nbsp;';
						echo CHtml::link('<i class="icon-remove icon-white"></i> UnAssign All Groups','javascript:void(0)',array('class'=>'btn btn-inverse  btn-mini','id'=>'ungroupAll','module'=>'','controller'=>$item['name'],'view'=>$i['name']));
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td colspan="4">';
					
					if(!empty($listGroup)){
						foreach($listGroup as $l=>$g){
							$roleListGroup = Role::model()->findAllByAttributes(array(
								'group_id'=>outBin($l),
								'controller'=>$item['name'],
								'view'=>$i['name'],
							));
							if(!empty($roleListGroup)){
								echo CHtml::link($g,'javascript:void(0)',array('class'=>'btn btn-success btn-mini','onclick'=>'unassign("'.$l.'","","'.$item['name'].'","'.$i['name'].'")'));
								echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';							
							}else{
								echo CHtml::link($g,'javascript:void(0)',array('class'=>'btn btn-danger btn-mini','onclick'=>'assign("'.$l.'","","'.$item['name'].'","'.$i['name'].'")'));
								echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';							
							}

						}
					}
						echo '</td>';
					echo '</tr>';
					
					$cnt++;
				}
			}
			echo '</tbody>';
			

		}
	}
			echo '</table>';
		echo '</div>';
	echo '</div>';
	
	echo '<div class="widget-box">';
	echo '<div class="widget-title"><span class="icon"><i class="icon-th"></i></span><h5>Modules</h5></div>';
		echo '<div class="widget-content nopadding">';
			echo '<table class="table table-bordered table-striped">';
	if(!empty($modules)){
		foreach($modules as $key=>$module){
			echo '<thead>';
				echo '<tr>';
					echo '<th>#</th>';
					echo '<th>Module</th>';
					echo '<th>Controller</th>';
					echo '<th>Action</th>';
					echo '<th>#</th>';
				echo '</tr>';
			echo '</thead>';
			echo '<tbody>';
			if(!empty($module['controllers'])){
				foreach($module['controllers'] as $k=>$m){
					if(!empty($m['actions']))
					{
						$cnt = 0;
						foreach($m['actions'] as $kk=>$i){
							$check = "";
							if(!empty($role)){
								foreach($role as $kr =>$ro){
									if($ro['controller']==$m['name'] && $ro['view']==$i['name'] && $ro['module']==$key){
										$check = "checked='checked'";
									}
								}
							}
							echo '<tr>';
							echo '<td>';
								echo "<input type='checkbox' name='s[{$m['name']}][{$cnt}][check]' {$check}>&nbsp;";
							echo '</td>';
							echo '<td>';
								echo $key;
							
								echo "<input  value='{$key}' name='s[{$m['name']}][{$cnt}][module]' type='hidden'>&nbsp;";
							echo '</td>';
							if(!empty($m['name'])){
								echo '<td>';
									echo $m['name'] ;
									echo "<input  value='{$m['name']}' name='s[{$m['name']}][{$cnt}][controller]' type='hidden'>";
								echo '</td>';
							}
							
							if(!empty($i['name'])){
								echo '<td>';
									echo $i['name'];
									echo "&nbsp;<input  value='{$i['name']}' name='s[{$m['name']}][{$cnt}][name]' type='hidden'>";
								echo '</td>';
							}
							echo '<td>';
								echo CHtml::link('<i class="icon-share icon-white"></i>  Assign All Groups','javascript:void(0)',array('class'=>'btn btn-inverse  btn-mini','id'=>'groupAll','module'=>$key,'controller'=>$m['name'],'view'=>$i['name']));
								echo ' &nbsp; ';
								echo CHtml::link('<i class="icon-remove icon-white"></i> UnAssign All Groups','javascript:void(0)',array('class'=>'btn btn-inverse  btn-mini','id'=>'ungroupAll','module'=>$key,'controller'=>$m['name'],'view'=>$i['name']));
								
							echo '</td>';
							echo '</tr>';
							echo '<tr>';
							echo '<td colspan="5">';
							
							if(!empty($listGroup)){
								foreach($listGroup as $l=>$g){
									$roleListGroup = Role::model()->findAllByAttributes(array(
										'group_id'=>outBin($l),
										'controller'=>$m['name'],
										'view'=>$i['name'],
										'module'=>$key,
									));
									if(!empty($roleListGroup)){
										echo CHtml::link($g,'javascript:void(0)',array('class'=>'btn btn-success btn-mini','onclick'=>'unassign("'.$l.'","'.$key.'","'.$m['name'].'","'.$i['name'].'")'));
										echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';							
									}else{
										echo CHtml::link($g,'javascript:void(0)',array('class'=>'btn btn-danger btn-mini','onclick'=>'assign("'.$l.'","'.$key.'","'.$m['name'].'","'.$i['name'].'")'));
										echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';							
									}

								}
							}
							echo '</td>';
							echo '</tr>';
							$cnt++;
						}
					}
					echo '</tbody>';

				}
			}
		}
	}
			echo '</table>';
		echo '</div>';
	echo '</div>';
}
?>
<script>
function unassign(g,m,c,v){
	$.ajax({
		type:"GET",
		url:"<?php echo $this->createUrl('/rights/mapPermission/rassign');?>",
		data:"m="+m+"&c="+c+"&v="+v+"&g="+g,
		success:function(data){
			window.location.href = window.location.href;
		}
	});
}
function assign(g,m,c,v){
	$.ajax({
		type:"GET",
		url:"<?php echo $this->createUrl('/rights/mapPermission/assign');?>",
		data:"m="+m+"&c="+c+"&v="+v+"&g="+g,
		success:function(data){
			window.location.href = window.location.href;
		}
	});
}
$().ready(function(e){
	$("#groupAll").live('click',function(e){
		var m = $(this).attr('module');
		var c = $(this).attr('controller');
		var v = $(this).attr('view');
		$.ajax({
			type:"GET",
			url:"<?php echo $this->createUrl('/rights/mapPermission/all');?>",
			data:"m="+m+"&c="+c+"&v="+v,
			success:function(data){
				window.location.href = window.location.href;
			}
		});
	});
	$("#ungroupAll").live('click',function(e){
		var m = $(this).attr('module');
		var c = $(this).attr('controller');
		var v = $(this).attr('view');
		$.ajax({
			type:"GET",
			url:"<?php echo $this->createUrl('/rights/mapPermission/remove');?>",
			data:"m="+m+"&c="+c+"&v="+v,
			success:function(data){
				window.location.href = window.location.href;
			}
		});
	});
});
</script>