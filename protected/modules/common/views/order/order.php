<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<!-- file upload-->
<script src="<?php echo Yii::app()->baseUrl;?>/js/jlbd.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/jlbd.dialog.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/jlbd.notify.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/ajaxupload.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.qtip-1.0.0-rc3.min.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl;?>/css/common.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl;?>/css/jlbd.notify.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl;?>/css/jlbd.notify.jquery.css" media="screen" />


<!-- end file upload-->

<script type="text/javascript">/*<![CDATA[*/
	var b_id = null;
	$(document).ready(function(){
		/* Example 1 */
		
		var buttonUpload = $('#buttonUpload');
		
		
		new AjaxUpload(buttonUpload, {
			action: '<?php echo Yii::app()->baseUrl;?>/common/order/upload', 
			name: 'file',
			onSubmit : function(file, ext){
			
				if (! (ext && /^(jpg|JPG|GIF|PDF|pdf|gif|png|jpeg|rar|zip)$/.test(ext))){
						alert('Please choose image type: jpg|JPG|GIF|PDF|pdf|gif|png|jpeg|rar|zip');
						return false;
					}	
								
				this.disable();
				
			},
			onComplete: function(file, response){
				this.enable();
				response = $.parseJSON(response);

				var options = {					
					message	: response.msg,
					autoHide : true,
					timeOut : 5,
					type:'success'
				}
				jlbd.dialog.notify(options);
				return false;
			}
		});
		$('.reflection a').qtip({
		   content: $(this).attr('title'),
		   show: 'mouseover',
		   hide: 'mouseout',
		   style: { name: 'dark', tip: true }
		});
	});/*]]>*/
	</script>	
<?php
// dump($users);

$colZ = Beverages::model()->findAllByAttributes(array('col'=>'0'));
$colN = Beverages::model()->findAllByAttributes(array('col'=>'1'));
?>
<h1 style="text-align:center; border:1px solid #488AC7; background:#659EC7; padding:10px; color:#fff">
Ún gì thì kéo đồ ún vào cái avatar của mình anh chị em nhé^^
</h1>
<div style="position: fixed;width: 320px;top:20%;left:50px; border:1px dashed green; padding:20px;">
	<div class="reflection imgSmall">
	<?php
	if(!empty($colZ)){
		foreach($colZ as $key=>$o){	
		$this->beginWidget('zii.widgets.jui.CJuiDraggable', array(
			// additional javascript options for the draggable plugin
			'options'=>array(
				'opacity'=>'.5',
				'revertDuration'=>'1000',
				'refreshPositions'=>true,
				'revert'=>true,
				'start'=>'js:function(event,ui){
					b_id= $(this).find("a").attr("ref");
				}'
			),
		));
	?>
		<a href='#' title="<?php echo $o->name;?> - <?php echo $o->price;?> ngàn" ref="<?php echo outStr($o->id);?>">
			<span class="image-wrap" style="position:relative; display:inline-block; background:url(<?php echo $o->avatar;?>) no-repeat center center; width: 90px; height: 90px;">
				<img src="<?php echo $o->avatar;?>" style="opacity: 0;">
			</span>
		</a>
	<?php
		$this->endWidget();
		}
	}
	?>
	</div>
</div>
<div style="position: fixed;width: 320px;top:20%;right:50px; border:1px dashed green; padding:20px;">
	<div class="reflection imgSmall">
	<?php
	if(!empty($colN)){
		foreach($colN as $key=>$o){	
		$this->beginWidget('zii.widgets.jui.CJuiDraggable', array(
			// additional javascript options for the draggable plugin
			'options'=>array(
				'revertDuration'=>'1000',
				'opacity'=>'.5',
				'revert'=>true,
				'refreshPositions'=>true,
				'start'=>'js:function(event,ui){
					b_id= $(this).find("a").attr("ref");

				}'

			),
		));
	?>
		<a href='#' title="<?php echo $o->name;?> - <?php echo $o->price;?> ngàn" ref="<?php echo outStr($o->id);?>">
			<span class="image-wrap" style="position:relative; display:inline-block; background:url(<?php echo $o->avatar;?>) no-repeat center center; width: 90px; height: 90px;">
				<img src="<?php echo $o->avatar;?>" style="opacity: 0;">
			</span>
		</a>
	<?php
		$this->endWidget();
		}
	}
	?>
	</div>
</div>
<div class="main users">
	<div class="reflection">
		<?php
			if(!empty($users)){
				foreach($users as $key=>$user){
					if(currentUser()->superuser==1){
						if($user->superuser==0){
						$this->beginWidget('zii.widgets.jui.CJuiDroppable', array(
							// additional javascript options for the droppable plugin
							'options'=>array('drop'=>'js:function(event,ui){
	
								assign(b_id,$(this).find("a").attr("ref"));
							}'),
						));
				?>
				<a href='#'  title="<?php echo $user->first_name." ".$user->last_name;?>" ref="<?php echo outStr($user->id);?>">
					<span class="image-wrap" style="position:relative; display:inline-block; background:url(<?php echo Yii::app()->baseUrl;?>/upload/user/fill/94-84/<?php echo $user->avatar;?>) no-repeat center center; width: 90px; height: 90px;">
						<img src="<?php echo Yii::app()->baseUrl;?>/upload/user/fill/94-84/<?php echo $user->avatar;?>" style="opacity: 0;">
					</span>
				</a>
	
				<?php
						$this->endWidget();
						}
					}else{
						if($user->superuser==0 && currentUser()->id==$user->id){
							$this->beginWidget('zii.widgets.jui.CJuiDroppable', array(
								// additional javascript options for the droppable plugin
								'options'=>array('drop'=>'js:function(event,ui){
		
									assign(b_id,$(this).find("a").attr("ref"));
								}'),
							));
							?>
							<a href='#'  title="<?php echo $user->first_name." ".$user->last_name;?>" ref="<?php echo outStr($user->id);?>">
								<span class="image-wrap" style="position:relative; display:inline-block; background:url(<?php echo Yii::app()->baseUrl;?>/upload/user/fill/94-84/<?php echo $user->avatar;?>) no-repeat center center; width: 90px; height: 90px;">
									<img src="<?php echo Yii::app()->baseUrl;?>/upload/user/fill/94-84/<?php echo $user->avatar;?>" style="opacity: 0;">
								</span>
							</a>
				
							<?php
							$this->endWidget();
						}
					}
				}
			}
		?>
	</div>
<div>
<div id="">
	<a href="<?php echo Yii::app()->baseUrl;?>/user/logout" class="stylish-orange logout">Logout</a>
</div>
<div id="buttonUpload">
	<a href="javascript:void(0)" class="stylish upload-avatar">Upload Avatar</a>
</div>
<div id="">
	<a href="javascript:clog()" class="stylish upload-avatar" style="left:10%;border:4px double #347C17;background:#4AA02C;color:#fafafa;text-shadow:0 1px 0 #333">Orders</a>
</div>
<?php
if(currentUser()->superuser==1){
?>
<div id="">
	<a href="javascript:logth()" class="stylish upload-avatar" style="left:20%;border:4px double #347C17;background:#4AA02C;color:#fafafa;text-shadow:0 1px 0 #333">Log</a>
</div>
<?php	
}
?>
<div id="modal"></div>
<div id="modalContent"></div>
<script>
var htmlLoading = '<div style="position:absolute; left:46%; top:50%"><img src="<?php echo Yii::app()->baseUrl;?>/images/ajax-loader.gif" /></div>';
function clog(){
	$("#modal").show();
	$("#modal").html(htmlLoading);
	$.ajax({
		type:"GET",
		url:"<?php echo Yii::app()->baseUrl;?>/site/clog",
		success:function(res){
			$("#modal").html('');
			$("#modal").hide();
			$("#modalContent").html(res);
			$("#modalContent").slideToggle("slow");
		},
		error:function(xhr,status){
			alert(status);
			$("#modal").html('');
			$("#modal").hide();
		}
	});
}
function logth(){
	$("#modal").show();
	$("#modal").html(htmlLoading);
	$.ajax({
		type:"GET",
		url:"<?php echo Yii::app()->baseUrl;?>/site/logth",
		success:function(res){
			$("#modal").html('');
			$("#modal").hide();
			$("#modalContent").html(res);
			$("#modalContent").slideToggle("slow");
		},
		error:function(xhr,status){
			alert(status);
			$("#modal").html('');
			$("#modal").hide();
		}
	});
}
function assign(bID,uID){

	$.ajax({
		type:"POST",
		url:"<?php echo Yii::app()->baseUrl;?>/site/assign",
		data:"uID="+uID+"&bID="+bID,
		success:function(response){
			var options = {					
				message	: response.msg,
				autoHide : true,
				timeOut : 5,
				type:'success'
			}
			jlbd.dialog.notify(options);
			return false;			
		},
		error:function(xhr,status){
			var options = {					
				message	: 'Vì host cùi nên nhiều lúc sẽ mất kết nối, thử lại nhé.',
				autoHide : true,
				timeOut : 5,
				type:'warning'
			}
			jlbd.dialog.notify(options);
			return false;	
		}
	});

}
$("a.boxclose").live('click',function(e){
	$("#modalContent").slideToggle("slow");
	$("#modalContent").html("");
	$("#modal").hide();
});
var clickTmp = 0;
$("#tt").live('click',function(e){
	clickTmp++;
	var filter = "tr";
	if(clickTmp%2==0) filter = "ct";
	$.ajax({
		type:"GET",
		url:"<?php echo Yii::app()->baseUrl;?>/site/clogList?name="+$("#ht").val()+"&hour="+$("#nd").val()+"&filter="+filter,
		success:function(res){
			$("#trRow").html(res);

		},
		error:function(xhr,status){
			var options = {					
				message	: 'Vì host cùi nên nhiều lúc sẽ mất kết nối, thử lại nhé.',
				autoHide : true,
				timeOut : 5,
				type:'warning'
			}
			jlbd.dialog.notify(options);
			return false;	
		}
	});
});
$("#ct").live('click',function(e){
	var id = $(this).attr('ref');
	var _this = $(this);
	$.ajax({
		type:"POST",
		url:"<?php echo Yii::app()->baseUrl;?>/site/updateStatus?id="+id,
		data:"a=b",
		success:function(response){
			if(response.error==false){
				_this.parent().html('Đã thanh toán');	
			}
			var options = {					
				message	: response.msg,
				autoHide : true,
				timeOut : 5,
				type:'success'
			}
			jlbd.dialog.notify(options);
			return false;			
		},
		error:function(xhr,status){
			var options = {					
				message	: 'Vì host cùi nên nhiều lúc sẽ mất kết nối, thử lại nhé.',
				autoHide : true,
				timeOut : 5,
				type:'warning'
			}
			jlbd.dialog.notify(options);
			return false;	
		}
	});
});
$("#xxxx").live('click',function(e){
	var id = $(this).attr('ref');
	var _this = $(this);
	$.ajax({
		type:"POST",
		url:"<?php echo Yii::app()->baseUrl;?>/site/removeB?id="+id,
		data:"a=b",
		success:function(response){
			if(response.error==false){
				_this.parent().parent().remove();	
			}
			var options = {					
				message	: response.msg,
				autoHide : true,
				timeOut : 5,
				type:'success'
			}
			jlbd.dialog.notify(options);
			return false;			
		},
		error:function(xhr,status){
			var options = {					
				message	: 'Vì host cùi nên nhiều lúc sẽ mất kết nối, thử lại nhé.',
				autoHide : true,
				timeOut : 5,
				type:'warning'
			}
			jlbd.dialog.notify(options);
			return false;	
		}
	});
});
$("#ht").live('change',function(e){
	var val = $(this).val();
	var options = {					
		message	: 'Loading...',
		autoHide : true,
		timeOut : 4,
		type:'info'
	}
	jlbd.dialog.notify(options);
	$.ajax({
		type:"GET",
		url:"<?php echo Yii::app()->baseUrl;?>/site/clogList?name="+val+"&hour="+$("#nd").val(),
		success:function(res){
			$("#trRow").html(res);

		},
		error:function(xhr,status){
			var options = {					
				message	: 'Vì host cùi nên nhiều lúc sẽ mất kết nối, thử lại nhé.',
				autoHide : true,
				timeOut : 5,
				type:'warning'
			}
			jlbd.dialog.notify(options);
			return false;		
		}
	});
});
$("#nd").live('change',function(e){
	var val = $(this).val();
	var options = {					
		message	: 'Loading...',
		autoHide : true,
		timeOut : 4,
		type:'info'
	}
	jlbd.dialog.notify(options);
	$.ajax({
		type:"GET",
		url:"<?php echo Yii::app()->baseUrl;?>/site/clogList?name="+$("#ht").val()+"&hour="+val,
		success:function(res){
			$("#trRow").html(res);

		},
		error:function(xhr,status){
			var options = {					
				message	: 'Vì host cùi nên nhiều lúc sẽ mất kết nối, thử lại nhé.',
				autoHide : true,
				timeOut : 5,
				type:'warning'
			}
			jlbd.dialog.notify(options);
			return false;	
		}
	});

});
$("#btMuaHang").live('click',function(e){
	var options = {					
		message	: 'Loading...',
		autoHide : true,
		timeOut : 4,
		type:'info'
	}
	jlbd.dialog.notify(options);
	$.ajax({
		type:"POST",
		url:"<?php echo Yii::app()->baseUrl;?>/site/saveLog",
		data:$("#muahang").serialize(),
		success:function(res){
			var options = {					
				message	: res.msg,
				autoHide : true,
				timeOut : 5,
				type:'success'
			}
			jlbd.dialog.notify(options);
			return false;
		},
		error:function(xhr,status){
			var options = {					
				message	: 'Vì host cùi nên nhiều lúc sẽ mất kết nối, thử lại nhé.',
				autoHide : true,
				timeOut : 5,
				type:'warning'
			}
			jlbd.dialog.notify(options);
			return false;	
		}
	});
});
$("#btTienGui").live('click',function(e){
	var options = {					
		message	: 'Loading...',
		autoHide : true,
		timeOut : 4,
		type:'info'
	}
	jlbd.dialog.notify(options);
	$.ajax({
		type:"POST",
		url:"<?php echo Yii::app()->baseUrl;?>/site/saveLog",
		data:$("#tiengui").serialize(),
		success:function(res){
			var options = {					
				message	: res.msg,
				autoHide : true,
				timeOut : 5,
				type:'success'
			}
			jlbd.dialog.notify(options);
			return false;
		},
		error:function(xhr,status){
			var options = {					
				message	: 'Vì host cùi nên nhiều lúc sẽ mất kết nối, thử lại nhé.',
				autoHide : true,
				timeOut : 5,
				type:'warning'
			}
			jlbd.dialog.notify(options);
			return false;	
		}
	});
});

$("#btThuHang").live('click',function(e){
	var options = {					
		message	: 'Loading...',
		autoHide : true,
		timeOut : 4,
		type:'info'
	}
	jlbd.dialog.notify(options);
	$.ajax({
		type:"POST",
		url:"<?php echo Yii::app()->baseUrl;?>/site/autoThuTien",
		data:$("#thuvao").serialize(),
		success:function(res){
			var options = {					
				message	: res.msg,
				autoHide : true,
				timeOut : 5,
				type:'success'
			}
			jlbd.dialog.notify(options);
			return false;
		},
		error:function(xhr,status){
			var options = {					
				message	: 'Vì host cùi nên nhiều lúc sẽ mất kết nối, thử lại nhé.',
				autoHide : true,
				timeOut : 5,
				type:'warning'
			}
			jlbd.dialog.notify(options);
			return false;	
		}
	});
});

</script>

