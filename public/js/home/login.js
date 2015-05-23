$(function(){
	if(_T.fl){	//标记
	    $('body').css({
	        position: 'relative',
	        'overflow-x':'hidden',
	        left: '-1000px'
	    }).animate({left:0},800,"easeOutBack");
	    /*easeOutBounce*/
	    /*.effect('bounce',{times:2,direction:'left',distance:40},1000)*/
	}

	$('#submit').click(function(e){
		$(this).next('img').addClass('process').show();
		$(this).hide();
	})

})