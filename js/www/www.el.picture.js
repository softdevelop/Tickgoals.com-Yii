;(function($, scope){	scope['ePicture'] = {		init : function(){		},		createZindex:function(full){			var zIndex = parseInt(arrayZIndex.max())+50;			arrayZIndex.push(zIndex);			if(full==1)	return "z-index:"+zIndex;			else return zIndex;		},		loadAttrElPicture:function(id,idEl,notAttribute){			id.css({zIndex:www.ePicture.createZindex(0)});			if(id.find('img').height()!=0)				www.ePicture.pool.maxHeightFramePicture = id.find('img').height();			else				www.ePicture.pool.maxHeightFramePicture = hid;						if(id.find('img').width()!=0){				www.ePicture.pool.maxWidthFramePicture = id.find('img').width();				if(notAttribute==true)	id.attr('wd',id.find('img').width()+"px");			}else{				www.ePicture.pool.maxWidthFramePicture = wid;				if(notAttribute==true)	id.attr('wd',wid+"px");			}			hiddenBorderAndToolBar();			/** Display toolbar for element **/			displayBorderAndToolBar(id);			www.el.loadSubMenu(www.ePicture.alias,idEl);		},		loadElementPicture:function(position){			var leftIframePicture = position.left-www.wh.leftContent;			var topIframePicture = position.top-www.wh.topContent;			if(leftIframePicture>$("#content").width()-wid) leftIframePicture = 30;						var idEl = generateSerial(10);			var picture = "<div name='picture' class='e-picture poisitonAbsolute' no_edited='"+urlDefaultPicture+"'  default='"+urlDefaultPicture+"' id='"+idEl+"' style='top:"+topIframePicture+"px;left:"+leftIframePicture+"px;'><img src='"+urlDefaultPicture+"'></div>";						$("#content").append(picture);			var ePicture = $('.e-picture');						var _idEl = $("#"+idEl);			www.el.pool.objectDiv.push([idEl,'picture']);									www.toolbarElement.trace.objLoadLast = _idEl;						www.ePicture.loadAttrElPicture(www.toolbarElement.trace.objLoadLast,idEl,true);			www.el.resize(www.toolbarElement.trace.objLoadLast);			www.el.drap(www.toolbarElement.trace.objLoadLast);		},		callbacks : {},		msg:{			maxWidthHeight:'This picture element default have max width & height'		},		pool : {			checkImgDefault:1,			maxWidthFramePicture:0,			maxHeightFramePicture:0		},		alias : "picture",		idPictureCrop:null					}})(jQuery, www);;(function($, scope){	scope['eVideo'] = {		loadAttrElVideo:function(id,idEl,notAttribute){			id.css({zIndex:www.ePicture.createZindex(0)});			if(id.find('object').height()!=0)				www.ePicture.pool.maxHeightFramePicture = id.find('object').height();			else				www.ePicture.pool.maxHeightFramePicture = hid;						if(id.find('object').width()!=0){				www.ePicture.pool.maxWidthFramePicture = id.find('object').width();				if(notAttribute==true)	id.attr('wd',id.find('object').width()+"px");			}else{				www.ePicture.pool.maxWidthFramePicture = wid;				if(notAttribute==true)	id.attr('wd',wid+"px");			}			hiddenBorderAndToolBar();			/** Display toolbar for element **/			displayBorderAndToolBar(id);			www.el.loadSubMenu('video',idEl);		},		loadElementPicture:function(position){			var leftIframePicture = position.left-www.wh.leftContent;			var topIframePicture = position.top-www.wh.topContent;									var idEl = generateSerial(10);			var urlDefaultVideo = "http://youtube.com/v/X2NHqSXftzU";						var video = '<div name="video" class="e-video poisitonAbsolute" default="'+urlDefaultVideo+'" id="'+idEl+'" style="top:'+topIframePicture+'px;left:'+leftIframePicture+'px;"><a class="media {width:450, height:380, type:\'swf\'}" href="'+urlDefaultVideo+'"></a></div>';						$("#content").append(video);									var _idEl = $("#"+idEl);			try{				_idEl.find('a.media').media();			}catch(e){				console.log(e);			}						www.el.pool.objectDiv.push([idEl,'video']);						www.toolbarElement.trace.objLoadLast = _idEl;						www.eVideo.loadAttrElVideo(www.toolbarElement.trace.objLoadLast,idEl,true);			www.eVideo.resizeVideo(www.toolbarElement.trace.objLoadLast);			www.el.drap(www.toolbarElement.trace.objLoadLast);					},		resizeVideo:function(id){			id.resizable({				handles: "n, e, s, w, ne, se, sw, nw" ,				minWidth:133,				minHeight:133,				create:function(event,ui){					$(this).removeClass('ui-resizable');				},				resize:function(event,ui){					$(this).find('object').attr('width',ui.size.width+"px");					$(this).find('object').attr('height',ui.size.height+"px");				},				start:function(event,ui){									},				stop:function(event,ui){					console.log("media {width:"+ui.size.width+", height:"+ui.size.height+", type:'swf'}");					console.log($(this).find('div.media').attr('class'));					console.log($(this))					$(this).find('div.media').remove();					$(this).append('<a href="'+$(this).attr('default')+'" class="media {width:'+ui.size.width+', height:'+ui.size.height+', type:\'swf\'}"></a>');										$(this).find('a.media').media();				}			});		},		alias : "video",	}})(jQuery, www);$(document).ready(function(e) {	$(".e-picture").live('click',function(e){		clickEl(www.ePicture.alias,e,$(this))	});	$(".e-video").live('click',function(e){		clickEl(www.eVideo.alias,e,$(this));	});	});function clickEl(_alias,e,_this){	www.el.loadSubMenu(_alias,_this.attr('id'));	var zi = www.ePicture.createZindex(0);	if(www.el.pool.checkDown==true) zi = 0;	_this.css({		zIndex:zi	});	www.el.pool.checkDown=false;	hiddenBorderAndToolBar();	displayBorderAndToolBar(_this);	e.stopPropagation();}