/*
*@
*@ public plugins- 公共JS插件类
*@
*/

/*插件-created by zhan*/
;(function($){
	$.fn.extend({

		fixCenter : function($dom){
		
			$win_w = $(window).width();
			$win_h = $(window).height();

			$d_w = $dom.outerWidth();
			$d_h = $dom.outerHeight();

			_left = ($win_w - $d_w)/2 +'px';
			_top = ($win_h - $d_h)/2 +'px';

			$dom.css({
				position:'relative',
				top: _top,
				left: _left
			});
		},

		mbox : function($dom,time,$dom_head) {	//模态盒子调用

			/*参数要是jquery dom对象*/


			//没有颜色的话，默认设置一个红色!
			alert(2)
			if($dom.css('color')==""){

				$dom.css('color','red');
			}

			if($dom.css('border')==""){

				$dom.css('border','1px solid yellow');
			}
			
			// alert($dom.css('width'));	
			if(parseInt($dom.css('width'))==0){

				$dom.css('width','800px');
			}




			$_m = $('<div class="module-wrap" style="display:none;"></div>');

			$domwp = $("<div class='dom-wrap clearfix'></div>").wrapInner($dom);

			$domhead = $('<div class="clearfix m-head"><span class="m-close">×</span></div>');
			if($dom_head){
				
				$dom_head.prependTo($domhead);
			}
			$domhead.prependTo($domwp);

			$domwp.appendTo($_m);

			$_m.appendTo('body').fadeIn(time||500);

			var m_fixcenter = function(){

				$win_w = $(window).width();
				$win_h = $(window).height();

				$d_w = $dom.outerWidth();
				$d_h = $dom.outerHeight();

				_left = ($win_w - $d_w)/2 +'px';
				_top = ($win_h - $d_h)/2 +'px';

				// alert($win_w);

				$domwp.css({
					position:'relative',
					top: _top,
					left: _left,
					width:$d_w,
					display:'inline-block'
				});
			}

			m_fixcenter();

			$('.m-close').click(function(){

				$('.module-wrap').fadeOut(time||500);
				$(window).off('.m_fixcenter');
			});

			$(window).on('resize.m_fixcenter',function(){
				$.fn.fixCenter($domwp);
			});

			return $_m;

		},


		circleBtn : function(opts){

			opts =$.extend({
				name: 'button',
				width: 40,
				height: 110,
				backgroundcolor: '#ffffff',
				fontcolor:'#9297a0'
			},opts);
			

				var $button =$('<div>'+opts.name+'</div>');

				$button.addClass('my-button-radious').css({

					'height': opts.height +'px',
					'width': opts.width + 'px',
					'line-height': opts.height+'px',
					'font-height': opts.height/3+'px',
					'background-color': opts.backgroundcolor,
					'color': opts.fontcolor				
					
				}).on('mousedown',function  () {
					
					$(this).addClass('my-button-radious-active')
					.css({
						'-moz-user-select': 'none',
						'-webkit-user-select': 'none',
						'-ms-user-select': 'none',
						'user-select': 'none'
					});

				}).on('mouseup',function(){

					$(this).removeClass('my-button-radious-active')
					.css({
						'-moz-user-select': 'text',
						'-webkit-user-select': 'text',
						'-ms-user-select': 'text',
						'user-select': 'text'
					});

				});
				
				//when mouseup and the mouse move out from the button
				$('body').on('mouseup',function(){

					$('body').find($('.my-button-radious')).removeClass('my-button-radious-active');

				})


				$button.hover(function  () {

					$(this).addClass('my-button-radious-hover')

				},function  () {

					$(this).removeClass('my-button-radious-hover')
				})

				this.append($button);

				return this ;
			},

		img_slideBar: function  (opts) {

			/*opts= {
			"imgsrc":[],
			"linksrc":[],
			"effect_time":500,
			"timer":4000,
			"button_color":"rgba(118, 131, 141,0)",
			"slide_type":"slide"
			}*/

			var slide_type = opts.slide_type||'fade';

			var timer =opts.timer||4000;/*自动效果时间*/

			var mytimer;/*定时器*/

			var time = opts.effect_time||500

			var width = this.outerWidth()||500;

			var height = this.outerHeight()||300;

			var imgsrc = opts.imgsrc;

			var linksrc = opts.linksrc;

			var len = imgsrc.length;

			/*按钮列表*/
			var buttons_reset ={	
				name:'',
				width: 11,
				height: 11,
				backgroundcolor: opts.button_color||'rgba(118, 131, 141,0)'
			};
			
			var $ul = $('<ul class="clearfix slider-wp"></ul>').css({
				width: width+'px',
				height: height+'px'
			});

			var $btn = $('<div class="btn-wp clearfix"></div>');

			var $li = $('<li></li>');

			for (var i = len - 1; i >= 0; i--) {

				$btn.circleBtn(buttons_reset);	

				var temp_img = $("<a href='"+linksrc[i]+"'><img src='"+imgsrc[i]+"' alt='' /></a>");

				temp_img.find('img').css({
					"width":width+'px',
					"height":height+'px'
				})
				/*使第一个按钮的z-index最大*/
				$li.clone().css('z-index',(i+len-1)%len).append(temp_img).prependTo($ul);
			};

			// $btn.children().addClass('left');

			var max_zindex = len-1;

			var $next = $btn.children().slice(1);/*第二个元素*/

			var $prev = $btn.children().last();

			$btn.children().first().addClass('active-btn');

			$btn.children().click(function(){

				$to_li = $($ul.children().get($(this).index()));/*对应的li*/

				if($ul.children().is(":animated")){/*还在动画则返回*/

					return;
				}

				if($to_li.css('z-index') == max_zindex){

					return;
				}

				clearInterval(mytimer);

				/*前一次激活按钮的索引*/
				var prev_active_index = $(this).siblings('.active-btn').index();

				$(this).addClass('active-btn').siblings().removeClass('active-btn');/*激活时的颜色*/

				/*下一个按钮*/
				$next = $($btn.children().get(($(this).index()+1)%len));

				/*上一个按钮*/
				$prev = $($btn.children().get( ($(this).index()+len-1)%len));


				if(slide_type === 'slide'){	/*滑动效果*/

					// console.log('this:'+$(this).index());
					// console.log('prev:'+prev_active_index);

					/*方向自右向左,注意最后一个跳到第一个情况,和第一个跳到最后一个情况*/
					if(($(this).index()>prev_active_index||($(this).index()==0&&prev_active_index==len-1)) && (!($(this).index()==len-1 && prev_active_index==0)) ){

							$to_li.css('z-index',++max_zindex).css('left', '100%').animate({"left":'0'}, time);

					}else{/*方向自左向右*/

						$to_li.css('z-index',++max_zindex).css('left', '-100%').animate({"left":'0'}, time);
					}

				}else{	/*淡入效果*/

					$to_li.css('z-index',++max_zindex).hide().fadeIn(time);
				}

				mytimer = setInterval(autoTrigger,timer);
			})

			var $arrow_wrap = $('<div class="arrow-wp"></div>');

			var $next_btn = $('<div class="next-pic"></div>');

			var $prev_btn = $('<div class="prev-pic"></div>');

			$next_btn.click(function(){

				$next.trigger('click');
			})
			$prev_btn.click(function(){
				$prev.trigger('click');
			})

			$next_btn.appendTo($arrow_wrap);

			$prev_btn.appendTo($arrow_wrap);

			$arrow_wrap.appendTo($ul);

			$ul.appendTo(this);

			$btn.appendTo(this);

			//after append($html), then set autotrigger .
			function autoTrigger () {

				$next_btn.trigger('click');
			}

			mytimer = setInterval(autoTrigger,timer);

			return this; 
		}

	})

})(jQuery)
/*end of plugins*/


	$(function(){

		//切换验证码
		(function changeVerify(){

			$v_btn = $('#verify-btn');

			var $verify = $('#verify');

			if(!$verify[0]){

				return;
			}

			var src = $verify[0].src;

			$v_btn.click(function(e) {

				$verify[0].src = src+'?'+Math.ceil(Math.random()*999);

				e.preventDefault();
			});
		})()


		/*用户名*/
		// $('.userhome-wp').on('mouseover', function () {
			
		// 	$(this).find('.r-arrow').addClass('hover');
		// 	$(this).children('ul').show();

		// }).on('mouseout',function(event){

		// 	$(this).find('.r-arrow').removeClass('hover');
		// 	$(this).children('ul').hide();
		// });


		/*ie <= 9.0*/
		/*body的第一个元素加一个class=top-colume就行*/
		var ieflag = false;

		if(navigator.userAgent.indexOf("MSIE")>0){

			if(navigator.userAgent.indexOf("MSIE 6.0")>0){

				ieflag = true;
			}
			if(navigator.userAgent.indexOf("MSIE 7.0")>0){

				ieflag = true;
			}
			if(navigator.userAgent.indexOf("MSIE 8.0")>0){

				ieflag = true;
			}
		}
		if(ieflag){

			$('<div class="bye-ie"><p>oops，您使用的浏览器太老了,为了获得完整的体验，推荐您<a href="https://www.google.com/intl/zh-cn/chrome/browser/" target=_blank>chrome</a>、<a href="http://firefox.com.cn/download/" target=_blank>firefox</a>、<a href="http://www.microsoft.com/zh-cn/download/internet-explorer-9-details.aspx" target=_blank>ie9或更高</a> 或 <a href="http://chrome.360.cn/" target=_blank>360极速浏览器(高速模式)</a> , <a href="http://www.maxthon.cn/" target=_blank>遨游</a> , <a href="http://ie.sogou.com/" target=_blank>搜狗浏览器(高速模式)</a> 等国内浏览器。</p><a class="bye-ie-close" href="javascript:;">x</a></div>').prependTo('body');

			$('.top-colume').addClass('ie-wrap');

			$('.bye-ie-close').click(function(){

				$(this).parent().hide();

				$('.top-colume').removeClass('ie-wrap');
			})
		}
		/*end of ie<=9.0*/

		/*搜索*/
		var search_flag = false;

		var $search_error;

		$('#pro-search').click(function(e){


			if($(this).prev().val() == ''){

				if(search_flag){

					$search_error.fadeIn(200);

					setTimeout(function(){

						$search_error.fadeOut('200');

					},1500);

				}else{

					search_flag = true;

					var $dom = $("<span>请输入关键字</span>").css({
						'font-size': '2em',
						'display': 'inline-block',
						'color': '#20C974',
						'padding': '10px 50px',
						'background-color':'#fff',
						'border-top':'1px solid #e7e7e7'
					});

					var $dom_head = $('<span style="font-size: 2em;line-height: 60px;padding-left: 10px;">温馨提示</span>');

					$search_error = $('body').mbox($dom,200,$dom_head);

					setTimeout(function(){

						$search_error.fadeOut('200');

					},1500);
				}

				return false;
			}
		})


		/*返回顶部*/
		if(!!$('.go-top')[0]){

			$(window).on('scroll', function () {

				if($(window)[0].scrollY>200){

					$('.go-top').fadeIn(300);
				}else{
					$('.go-top').fadeOut(300);
					
				}
			});

			$('.go-top').click(function (e) {

				$('body').animate({"scrollTop":0}, 300);
			});
		}

		/*我要约谈*/
		$('.ichat').click(function(){

			var seller = $(this).parent().siblings('.username_').val();

			var id = $(this).parent().siblings('.id_').val();
			
			$.post(__C.module+'/Detail/chat', {"seller":seller,"id":id}, function(data, textStatus, xhr) {

				// console.log(data);return;
				if(!data){

					return;
				}
				$ichat = $('body').mbox($(data),300,$('<div class="chat-big"><div class="cartoon icon"></div><i class="icon icon_chat"></i><span>我要约谈</span></div>'));

				$('.m-close').click(function(){

					$('.module-wrap').remove();
				})

				$('.send-really').click(function(){

					$(this).next('img').show(0);

					$(this).hide();

					var sellerinfo = $(this).attr('id').toString().split('--');

					var id = sellerinfo[0].slice(3);

					var sellerid = sellerinfo[1].slice(7);

					var desc = $(this).parents('.mail-wp').find('.desc').val();

					var $that = $(this);

					var $ichat_title = $that.parents('.dom-wrap').find('.chat-big span');

					var $ichat = $that.parents('.ichat-body');

					var str = '';

					$.post(__C.module+'/Detail/doSent', {"id":id,"seller":sellerid,"desc":desc}, function(data, textStatus, xhr) {

						$ichat_title.html('处理结果');

						str = data.message;

						$ichat.html(str);

						$(window).trigger('resize');
					});
				})
			});
		})

/*查看求助*/
	window.seeHelpInfo = function($helptitle){

		$helptitle.click(function(){

			var $helptitle_parent = $(this).parent();

			/*更新浏览量*/
            var id = $helptitle_parent.attr('class').split('-')[1];

            $.post(__C.module+'/Askhelp/updateView', {'id':id}, function(data, textStatus, xhr) {

                $('#myModal .modal-body>h4').html(data.name);

                $('#myModal .modal-body>.helpdesc').html("描述: "+data.description);

                var $email = $('#myModal .modal-body>.info span').first();

                var $tel = $('#myModal .modal-body>.info span').last();

                $email.html('电子邮箱: '+data.email);

                if(data.tel == undefined){

                    data.tel = "未公开";

                }
                $tel.html('联系电话: '+data.tel);

            });
		})
	}

		
		// $("body").mbox($('<span>妮妮</span>')) 

})