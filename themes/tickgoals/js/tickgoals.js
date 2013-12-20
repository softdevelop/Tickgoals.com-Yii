$().ready(function(e){
	$(document).resize(function() {
		var w = $(document).width();
		
		if(w<770){
			$("#loginindex").show();
			
		}else{
			$("#loginindex").hide();
		}
		if(w<820){
			$("#setting-goal,#logout-goal").attr('style','display: block;margin-bottom: 10px;');
		}else{
			$("#setting-goal,#logout-goal").attr('style','display: none;margin-bottom: 10px;');
		}
	});
	if($(document).width()<770){
			$("#loginindex").show();
	}else{
		$("#loginindex").hide();
		
	}
	if($(document).width()<820){
			$("#setting-goal,#logout-goal").attr('style','display: block;margin-bottom: 10px;');
		}else{
			$("#setting-goal,#logout-goal").attr('style','display: none;margin-bottom: 10px;');
		}
	// $("#loginindex").attr('style','display:block');
	$("#goals_name_text").live('focusout',function(e){
		
		
		$('#edit-goals').html($(this).val());
		if($.trim($(this).val())!="Name of Goal gets typed in here" && $.trim($(this).val())!="")
		{
				$("#Goal_name").val($(this).val());
		}
		
	});
	$('#edit-goals').live('click',function(e){
		var html = $(this).html();
		var obj = $(this).find('input');
		if(obj.length==0){
			$(this).html('<input type="text" value="'+html+'" id="goals_name_text">');
			$(this).find('input').focus();
		}
	});
	$("#removegoal").live('click',function(e){
		var _this = $(this);
		var r=confirm("Are you sure remove to goal?")
		if (r==true)
		{
				$.ajax({
					type:"GET",
					url:_this.attr('ref'),
					success:function(res){
						_this.parent().parent().parent().fadeToggle('slow');
					},error:function(xhr){
						var responseText = $.parseJSON(xhr.responseText);
						alert(responseText.message);
					}
				});
		}
	});
	$("#removelist").live('click',function(e){
		var _this = $(this);
		var r=confirm("Are you sure remove to list?")
		if (r==true)
		{
				$.ajax({
					type:"GET",
					url:_this.attr('ref'),
					success:function(res){
						_this.parent().parent().parent().fadeToggle('slow');
					},error:function(xhr){
						var responseText = $.parseJSON(xhr.responseText);
						alert(responseText.message);
					}
				});
		}
	});
});