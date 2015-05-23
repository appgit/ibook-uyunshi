$(function(){

	/*大列表*/

	/*定时器为了增强用户体验
		如果出了过800ms<1000ms 再进不就又是一error?
		但这发生的概率很小很小，忽略不计的bug...
	*/
	var timer;
	var time_last = 200;/*鼠标停留时间*/
	$('.sd-items').mouseenter(function(event) {

			$that = $(this);

			/*停留100ms才显示*/
			timer = setTimeout(function(){

				/*停止并完成mouseleave动画--空动画*/
				$('.sd-items').stop(true,true);	
				$that.prev().find('.items-r1').addClass('items-r1-noborder');
				$that.addClass('on').children().slice(-2).show();

			},time_last);

	}).mouseleave(function(event) {

			/*清除定时的100ms*/
			clearTimeout(timer);

			/*空动画只是为了回调函数而设*/	
			try{

				$(this).animate({'':''},800,function(){

				$(this).prev().find('.items-r1').removeClass('items-r1-noborder');
					$(this).removeClass('on').children().slice(-2).hide();
			})
		}catch(e){
				/*360兼容模式(ie7)*/
				$(this).removeClass('on').children().slice(-2).hide();
		}
	});

	/*背景图奇偶边*/
	$('.main-content-wp:odd').find('.items-bg').css('float','left');
})