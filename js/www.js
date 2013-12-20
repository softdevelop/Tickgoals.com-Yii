var oElement = $("#element");
var oPages = $("#pages");
var oSettings = $("#settings");

var objCurentDrap;
var arrayZIndex = [1100];
var toastObject = null;

var jcrop_api, boundx, boundy;
$().ready(function(e){
	$().toastmessage({
		stayTime : 5000,
	});
	
	$(".i-delete").click(function(e){
		$(this).parent().parent().fadeToggle('hide');
		$('.content-background').html('');
		e.stopPropagation();
	});
	$("#closeSubMenu").click(function(e){
		var rmi = $(".row-menu-item");

		if($.trim(rmi.html())!=""){
			
			rmi.show();
			
		}else{
			toastObject = $().toastmessage('showWarningToast',"Please choose an element");
		}	
		e.stopPropagation();
	});
	$(".row-menu-item").click(function(e){
		e.stopPropagation();
	});
	
	
	$("#eHeader").find('li').live('click',function(e){
		var alias = $(this).attr('alias');
		switch(alias){
			case "pages":
				$("#pages").slideToggle();
				$("#element").hide();
				$("#settings").hide();
			break;
			case "element":
				$("#element").slideToggle();
				$("#pages").hide();
				$("#settings").hide();
			break;
			case "settings":
				$("#settings").slideToggle();
				$("#pages").hide();
				$("#element").hide();
			break;
			case "save":
				www.el.save();
			break;
		}
		e.stopPropagation();
	});
	
	
	$(".header-items").find('li').draggable({
		helper: "clone",
		containment: "document",
		cursor: "move",
		distance: 10,
		handle: "h2",
		iframeFix: true,
		opacity: 0.35,
		scope: "tasks",
		drag:function( event, ui ) {
			
		},
		start:function( event, ui ) {
			objCurentDrap = $(this);
		},
		stop:function( event, ui ) {
			var alias = $(objCurentDrap).attr('alias');
			switch(alias){
				case "picture":
					www.ePicture.loadElementPicture(ui.position);
					www.toolbarElement.init('picture');
				break;
				case "video":
					www.eVideo.loadElementPicture(ui.position);
					www.toolbarElement.init('video');
				break;
			}
			
		},
	});
	
	$( "#content" ).resizable({
		handles: "s" ,
		create:function(event,ui){
			$(this).removeClass('ui-resizable');
		},
		start:function(event,ui){
		
		},
		stop:function(event,ui){
		
		}
	});
	
	$("#upload_pic").uploadify({
		height        : 30,
		swf           : homeURL+'/img/uploadify.swf',
		uploader      : homeURL+'/www/elements/uploadify',
		fileExt		  : '*.jpg;*.gif;*.jpeg;*.JPG;*.GIF;*.PNG;*.png',
		width         : 130,
		onUploadError:function(file, errorCode, errorMsg, errorString) {
            
        },
		onUploadSuccess : function(file, data, res) {
			if(data=="failer"){
			
			}else{
				data = $.parseJSON(data);
				var receive = $("#idreveice").val();
				var ePicture = $("#"+receive);
				ePicture.find('img').attr('src',homeURL+"/upload/elements/"+data.name);
				ePicture.css({width:data.pathinfo[0]+"px",height:data.pathinfo[1]+"px"});
				ePicture.attr('wd',data.pathinfo[0]+"px");
				ePicture.attr('default',homeURL+"/upload/elements/"+data.name);
				ePicture.attr('no_edited',homeURL+"/upload/elements/"+data.name);
				displayBorderAndToolBar(ePicture);
				www.ePicture.pool.checkImgDefault = 0;
				
				www.ePicture.pool.maxHeightFramePicture = data.pathinfo[1];
				www.ePicture.pool.maxWidthFramePicture = data.pathinfo[0];
				
				$("#closePopup").trigger('click');
			}
			
            
        }
	});
	
});
Array.prototype.max = function() {
	var max = this[0];
	var len = this.length;
	for (var i = 1; i < len; i++) if (this[i] > max) max = this[i];
	return max;
}
Array.prototype.min = function() {
	var min = this[0];
	var len = this.length;
	for (var i = 1; i < len; i++) if (this[i] < min) min = this[i];
	return min;
}
function loading(){
	if(toastObject!=null) $().toastmessage('removeToast', toastObject);
	$(".loading").removeClass('hidden');
}
function deLoading(){
	$(".loading").addClass('hidden');
}
function generateSerial(len) {
    var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
    var string_length = 10;
    var randomstring = '';

    for (var x=0;x<string_length;x++) {

        var letterOrNumber = Math.floor(Math.random() * 2);
        if (letterOrNumber == 0) {
            var newNum = Math.floor(Math.random() * 9);
            randomstring += newNum;
        } else {
            var rnum = Math.floor(Math.random() * chars.length);
            randomstring += chars.substring(rnum,rnum+1);
        }

    }
    return randomstring;
}

function showCoords(c)
{
	var receive = www.ePicture.idPictureCrop.attr('receive');
	var img = www.ePicture.idPictureCrop.attr('src');
	$.ajax({
		type:"POST",
		url:homeURL+"/www/elements/crop",
		data:{x:c.x,y:c.y,x2:c.x2,y2:c.y2,w:c.w,h:c.h,img:img},
		success:function(res){
			if(!res.error){
				var ePicture = $("#"+receive);
				$("#"+receive).find('img').attr('src',homeURL+"/upload/elements/"+res.namefile);
				$("#"+receive).css({width:c.w,height:c.h});
				$("#"+receive).attr('default',homeURL+"/upload/elements/"+res.namefile);
				displayBorderAndToolBar($("#"+receive));
				www.ePicture.pool.checkImgDefault = 0;
				
				www.ePicture.pool.maxHeightFramePicture = ePicture.find('img').height();
				www.ePicture.pool.maxWidthFramePicture = ePicture.find('img').width();
				
				$(".modals").fadeToggle('hide');
				$(".content-background").html('');
			}else{
				toastObject =  $().toastmessage('showErrorToast',res.msg);
			}
		},error:function(xhr,textXHR){
			toastObject =  $().toastmessage('showErrorToast',xhr.status+" "+xhr.statusText);
			
		}
	});

};

function clearCoords()
{
  
}
function hidePartElement(){
	$("#element").hide();
	$("#pages").hide();
	$("#settings").hide();
}