$(function(){

	var time = 500;

	var fade_time = 300;

	var hide_time;

	var pos_ok; //还没有定位

	var chosing = false;

	$type = $('.type-wrap');

	$chose = $('.type-choose');

	var chose_html = $chose.html();

	$('.type-choose').click(function() {

		$(this).addClass('active');

		choseHover();

		if($('input[name=isnew]').val()==0){

			typeShow(0);

		}else{

			typeShow(1);
		}
	})

	$('.type-wrap').hover(function() {

		choseHover();

	}, function() {

		typeHide();
	});

	function choseHover(){

		chosing = false;

		if(hide_time){

			clearTimeout(hide_time);
		}
	}

	function typeHide(){

		hide_time = setTimeout(function(){

			$type.fadeOut(fade_time);

			if(!chosing){

				$chose.removeClass('active');
			}

		},time);
	}

	function typeShow(isnew){

		/*布局定位*/
		if(!pos_ok){

			var top = $chose.position().top+$chose.outerHeight() + 'px';

			var left = $chose.position().left + 'px';

			$type.css({
				'top': top,
				'left': left
			});	
		}
		$type.show();

		/*显示新旧类别*/
		if(isnew == 0){

			$type.find('.menu>li.new-0').removeClass('hide');
			$type.find('.menu>li.new-1').addClass('hide');

		}else{

			$type.find('.menu>li.new-0').addClass('hide');
			$type.find('.menu>li.new-1').removeClass('hide');

		}
	}

	var $sptype = $('.sptype >.menu > li');

	// console.log($sptype);
	$sptype.hover(function() {

		$(this).children('div').show();

	}, function() {

		$(this).children('div').hide();

	});

/*新旧*/
	$('.isnew').click(function(){

		/*避免动画对数据改变造成的混乱*/
		$type.hide();

		$chose.html(chose_html).removeClass('active');

		$('.isnew').removeClass('active');

		$(this).addClass('active');

		$('input[name=stype]').val('');/*清空stype值*/

		if($(this).hasClass('false')){

			$('input[name=isnew]').val(0);

		}else{

			$('input[name=isnew]').val(1);
		}
	})

	/*选择类别*/
	$('.stype li').click(function(){

		$chose.html($(this).html());

		$('input[name=stype]').val($(this).html());

		chosing = true;

		$type.fadeOut(fade_time);
	})


	$('.info-title').click(function(){

		$(this).next().stop(1,0).slideToggle();
		
		if($(this).parents('.ct-user').find('.toolbar-wp')[0]){

			return;
		}

		var $this = $(this);

		var $text = $this.find('.isread');

		var $not_read_all = $('.sub-title-em > span');

		var $not_read_tips = $('.notread-tips');

		if($this.hasClass('hasread')){

			return;

		}else{

			var id = $(this).find('.notread-id').html();

			$.post(__C.controller+'/setHasread', {"id":id}, function(data, textStatus, xhr) {

				/*设为已读*/
				if(data.status == 1){

					$this.removeClass('notread').addClass('hasread');

					$text.text('已读');

					$not_read_all.html($not_read_all.text()-1);

					$not_read_tips.html($not_read_tips.html()-1);

					if($not_read_tips.html() == 0){

						$not_read_tips.remove();
					}

					$('<span class="delete-order right">&times;</span>').appendTo($this);

				}else{

					/*点击进入商品详细页后，按了后退后，不会显示为已读，需要刷新*/
					location.reload();

				}
			});
		}
	})

/*修改商品价格*/
	$('.modify').click(function(){

		var $input = $(this).parents('.opt').find('.price-gp');

		/*激活成为可用*/
		$input.addClass('active').attr('disabled',false);

		var modify_type = 0;/*现价*/

		if($input.hasClass('haspub-costprice')){

			modify_type = 1;/*原价*/
		}

		// console.dir($input);
		$input[0].focus();

		/*原来的值*/
		var value_ori = $input.val();

		$input.on('blur', function () {

			$(this).removeClass('active').attr('disabled', true);
			
			/*新的值*/
			var value_new = $(this).val();

			if(value_ori == value_new){

				$(this).off('blur');/*不关闭，会有多个blur事件存在*/

				return;
			}

			// alert(value)
			// return;
			var thisid = $(this).parents('li').find('.info-title').find('.goodsid').html();
			// console.log('this id:'+thisid);
			var opts = {
				id:thisid,
				newprice:value_new,
				type:modify_type
			}
			$.post(__C.controller+'/modifyPrice', opts,function(data, textStatus, xhr) {
				// console.log('data:'+data);
				if(data == 0){

					$input.val(value_ori);
				}
			});
			$(this).off('blur');
		});
	})

	/*删除商品*/
	$('.deletepros').click(function(){

		var $li = $(this).parents('li');

		var id = $(this).parents('li').find('.goodsid').html();

		if(confirm('您确定要删除吗?')){

			$.post(__C.controller+'/delpros', {"id":id}, function(data, textStatus, xhr) {

				if(data.status){

					$li.hide(500, function() {

						$(this).remove();

					});
				}
			});
		}
	})

	/*删除订单*/

	$('.info-title').on('click','.delete-order',function(e){

		e.stopPropagation();

		var _id = $(this).parent().children().find('.notread-id').html();

		var $li = $(this).parents('li');

		var $all_order = $('.sub-title-all span');

		if(confirm('您确定要删除该订单吗吗?')){

			$.post(__C.controller+'/delorders', {"id":_id}, function(data, textStatus, xhr) {

				if(data.status){

					$li.hide(500, function() {

						$all_order.html($all_order.html()-1);

						$li.remove();
					});
				}
			});
		}
	})

	/*个人中心*/
	var $modify_myinfo = $('#modify-myinfo');

	var $submit_cancle = $('.submit-wp .cancle');

	var $info_input = $('.ct-myinfo form input:not(.modify-forbidden)').slice(0,-2);

	var $title  =$('.title-wp .title');

	var $title_html =$title.html();

	$modify_myinfo.click(function(event) {

		$('.submit-wp').show(200);

		$(this).hide(0);

		/*可编辑状态*/
		$info_input.attr('disabled',false);

		$info_input.addClass('active');

		$info_input.first()[0].focus();

		$title.html('修改个人信息');

	});

	$submit_cancle.click(function(event) {

		$(this).parent().hide(200);

		$modify_myinfo.show();

		$info_input.attr('disabled',true);

		$info_input.removeClass('active');

		$title.html($title_html);

	});

	$('#submit').click(function(event) {

		$(this).val('处理中...');

	});
	
		(function(){	/*重复提交*/

			var commited = false;

			$('input[type=submit]').click(function(event) {
				
				if(commited){

					alert('请勿重复提交！！！');

					return false;
				}
				commited = true;

			});
		})()

	/*修改头像*/
	////////
	// file域 onchang就长传，然后回调.Jcrop //
	// facebook_loader.gif显示上传中
	////////
	try{

		var modify_avator_left = $('.headicon-wp img').offset().left - $('.headicon-wp').offset().left;

		var $modify_avator = $('#modify-avator a');

		$modify_avator.css('left', modify_avator_left+'px');

	}catch(e){}

	$('#i-upload').change(function(event) {

		// console.log("log...");
	});

	/*下架处理*/
	$('.undercarriage').click(function(){

		var is_not_allow = $(this).parent().prev().children().hasClass('review_ing');


		if(!!is_not_allow){

			alert('亲，宝贝还在审核阶段，审核通过才能下架哦 ~');

			return false;
		}
	})

	
})



