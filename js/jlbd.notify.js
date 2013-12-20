;(function($, scope){
	scope['notifyCation'] = {
		Libs : {
			/**Khởi tạo các giá trị mặc định cho jlbd.dialog.notify
			*/
			defaults : {
				autoHide	: false,
				timeOut		: 5,
				fadeSpeed	: 'slow',
				slideSpeed	: 'slow',
				background	: '#ffc',
				color		: '#191919',
				message		: 'This is my notify of system Justlook.vn',
				top			: 30,
				callback	: false,
				type		: 'message'	/**Type notify : message | success | info | error **/,
				title		: ' ',
				titleError	: 'Error!',
				titleMessage : 'Message!',
				titleSuccess : 'Success!',
				titleInfo	: 'Information!'
			},
			JLNotifyCation : function(options) {
				var self = this, TO = typeof options;
				var libs = jlbd.notifyCation.Libs.defaults;
				
				if(TO=="undefined" || TO==null) {
					var options = {};
				}	
				
				/**Nội dung hiển thị của jlbd.dialog.notify
				*/				
				this.container = $('<div class="notify-container"></div>');
				this.icoThumbnail = $('<div class="jlbd-ico-title"></div>');
				this.icoImg = $('<div class="jlbd-ico-thumb"></div>');
				this.title = $('<h2 class="jlbd-title-mess"></h2>');
				this.message = $('<p class="notify-message"></p>');
				this.closeButton = $('<a href="#" class="notify-close" title="Close">x</a>');
				
				this.classError = 'error-container';
				this.classSuccess = 'success-container';
				this.classInfo = 'info-container';
				this.classMessage = 'message-container';
				this.icoError = 'error-ico-thumb';
				this.icoMessage = 'message-ico-thumb';
				this.icoInfo = 'info-ico-thumb';
				this.icoSuccess = 'success-ico-thumb';
				
				/**Giá trị default của Libs jlbd.dialog.notify
				*/	
				this.timeOut = libs.timeOut;
				this.fadeSpeed = libs.fadeSpeed;
				this.slideSpeed = libs.slideSpeed;
				this.autoHide = libs.autoHide;
				
				// ------ HuyTBT them chuc nang callback -------
				if (typeof options.callback=="undefined" || options.callback=='' || options.callback==null)
					this.callback = libs.callback;
				else 
					this.callback = options.callback;
				// ------ HuyTBT them chuc nang callback -------
				
				/**Append nội dung của jlbd.dialog.notify vào body
				*/
				$('body').find('.notify-container').remove();
				$('body').append(this.container.hide());

				this.icoThumbnail.append(this.icoImg);
				this.container.append(this.icoThumbnail);
				this.container.append(this.message);
				this.container.append(this.closeButton);
				
				/**Kiểm tra các điều kiện của options input / Khởi tạo các options mặc định 
				*/
				if (typeof options.message=="undefined" || options.message=='' || options.message==null) {
					options.message = libs.message;
				}
				
				/** Add value default for content **/
				
				this.content = options.message;
				
				/**Add message for content **/
				
				this.message.append(this.content);
				
				if (typeof options.timeOut == "undefined" || options.timeOut=='' || options.timeOut==null) {
					options.timeOut = libs.timeOut;
				}	
				this.timeOut = options.timeOut;
								
				if(typeof options.top == "undefined" ||options.top == '' || options.top == null) {
					options.top = libs.top;
				}				
				if(typeof options.left == "undefined" ||options.left == '' || options.left == null) {
					options.left = ($(window).width()/2	- this.container.innerWidth()/2);
				}

				/** Add type for notify **/
				
				if(typeof options.type== "undefined" ||options.type == '' || options.type == null) {
					options.type = libs.type;
				}
				if(typeof options.title== "undefined" ||options.title == '' || options.title == null) {
					options.title = libs.title;
				}
				/**
				 * Khoi tao cac gia tri cho Notify
				 * 	- Class hien thi
				 *  - Title
				 *  - Ico cho notify
				 */
				var _classMessage;
				var _icoMessage;
				switch (options.type) {
					case "message":
						_classMessage = this.classMessage;
						_icoMessage = this.icoMessage;
						break;
					
					case "success":
						_classMessage = this.classSuccess;
						_icoMessage = this.icoSuccess;
						options.title = libs.titleSuccess;
						break;
					
					case "info":
						_classMessage = this.classInfo;
						_icoMessage = this.icoInfo;
						options.title = libs.titleInfo;
						break;
					
					case "error":
						_classMessage = this.classError;
						_icoMessage = this.icoError;
						options.title = libs.titleError;
						break;
					
					default: 
						_classMessage = this.classMessage;
						_icoMessage = this.icoMessage;
						break;
				}
				this.container.addClass(_classMessage);
				this.icoImg.addClass(_icoMessage);
				
				if(typeof options.autoHide == "undefined" ||options.autoHide == '' || options.autoHide == null) {
					options.autoHide = true;
				} else {
					options.autoHide = false;
				}
				
				this.title.append(options.title);
				this.icoThumbnail.append(this.title);
				this.autoHide = options.autoHide;

				var _topIco = this.container.innerHeight()/2 - 27;
				/**Gán các giá trị cho current object jlbd.dialog.notify.
				*/				
				this.icoThumbnail.css({
					top : _topIco
				});
				
				/**Add style vào current object.
				*/
				this.container.offset({
					top : options.top,
					left : options.left
				});
				/**Show nội dung của jlbd.dialog.notify
				*/
				this.show = function() {
					this.closeButton.click(function() {
						self.close();
						return false;
					});
					/*this.container.click(function() {
						self.close();
					});*/
					/*this.container.hover(
						function() {
							self.closeButton.addClass('notify-close-02');
						},
						function() {
							self.closeButton.removeClass('notify-close-02');
						}
					);*/
					
					// HuyTBT: Neu khong set autoHide thi khong cho phep close	
					if(!self.autoHide) {
						this.container.hover(
							function() {
								//self.closeButton.addClass('notify-close-02');
								clearTimeout(self.timeout); // HuyTBT bo sung: khi user hover chuot vao notify thi no se ko bi bien mat
							},
							function() {
								//self.closeButton.removeClass('notify-close-02');
								// HuyTBT bo sung: khi user hover chuot vao notify thi no se ko bi bien mat
								self.timeout = setTimeout(function() { self.container.fadeOut(self.slideSpeed, function() {self.container.remove();}); }, self.timeOut * 1000);
							}
						);
					}
					if (this.callback !== false) this.callback(); // HuyTBT them chuc nang callback
					
					if(!this.autoHide) {
						this.showOverLay();
					} else {				
						this.showDefault();
					}
				}
				
				/**Show nội dung của jlbd.dialog.notify : Trường hợp có xác định time out (qua thuộc tính delay) 
				*/
				this.showOverLay = function() {
					/*
					 this.container
						.hide()
						.fadeIn(self.fadeSpeed)
						.delay(self.timeOut * 1000)
						.fadeOut(self.slideSpeed, function() {
							self.container.remove();
						});
						*/
					// HuyTBT sua lai phan nay de ho tro: khi user hover chuot vao notify thi no se ko bi bien mat
					this.container.hide().fadeIn(self.fadeSpeed);
					this.timeout = setTimeout(function() { self.container.fadeOut(self.slideSpeed, function() {self.container.remove();}); }, self.timeOut * 1000);
				}
				
				/**Show nội dung của jlbd.dialog.notify : Trường hợp không xác định time out.
				*/
				this.showDefault = function() {
					 this.container.hide().fadeIn(self.fadeSpeed);
				}
				
				/**Đóng cửa sổ nội dung jlbd.dialog.notify.
				*/
				this.close = function() {
					if ($.browser.msie && parseInt($.browser.version) <= 8) {
						//this.container.remove();
						this.container.stop(true,true).animate({opacity:0 }, self.slideSpeed,	function(){
							self.container.remove();
						});
					} else {
						this.container.stop(true,true).animate({opacity:0 }, self.slideSpeed,	function(){
							self.container.remove();
						});
					}
				}
			},
			Destroy : function() {
				this.close = function() {
					$('body').find('.notify-container').animate({opacity:0 }, 'slow',	function(){
						$(this).remove();
					});
				}
			}
		}
	}
})(jQuery, jlbd);