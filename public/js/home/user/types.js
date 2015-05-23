$(function(){
	var btype = stype = t_ok = {};

	var $comitpage = $('.proinfo').remove();

	/*--- 种类 ---*/
	$('.pro-choice').click(function(e){

		$(this).addClass('active').siblings().removeClass('active');

		if($(this).hasClass('cho2')){
			btype = {'new':'true'};
		}else{
			btype = {'new':'false'};
		}
		$('.confirm-isnew').slideDown(500);
	})

	$('.confirm-isnew').click(function(){

		$.post(__C.controller+'/gettype',btype, function(data, textStatus, xhr) {

			var opts = {};

			opts.data = jQuery.parseJSON(data); 
			opts.toclass = '.btype';
			opts.c_prefix = 'b-';
			opts.c_suffix = ' _bt';
			opts.c_group = '._bt';
			opts.hideclass= '.isnew';
			type_callback(opts);

		});
	})
/*--- end of 种类 ---*/
	

/*--- 大类 ---*/
	$('.pubpros').click(function(e){

		if($(e.target).hasClass('_bt')){

			stype = {id:e.target.className.charAt(2)};
			$(e.target).parents('.btype').children('._t-g').children('._bt').removeClass('active');
			$(e.target).addClass('active');
			$('.confirm-btype').slideDown(500);

		}
		else if($(e.target).hasClass('_st')){

			t_ok = {sid:e.target.className.charAt(2)};
			$(e.target).parents('.stype').children('._t-g').children('._st').removeClass('active');
			$(e.target).addClass('active');
			$('.confirm-stype').slideDown(500);
		}
	})

	$('.confirm-btype').click(function(){

		$.post(__C.controller+'/gettype',stype, function(data, textStatus, xhr) {

			var opts = {};

			opts.data = jQuery.parseJSON(data); 
			opts.toclass = '.stype';
			opts.c_prefix = 's-';
			opts.c_suffix = ' _st';
			opts.c_group = '._st';
			opts.hideclass= '.btype';
			type_callback(opts);

		});
	})
/*--- end of 大类 ---*/

	$('.confirm-stype').click(function(){

		$.post(__C.controller+'/gettype',t_ok, function(data, textStatus, xhr) {

			if(textStatus == "success" && data === true){
				$('.stype').remove();
				$comitpage.appendTo('.pubpros');
				$('.proinfo').show(0);

				/*--- verify and submit ---*/
				function changeVerify(){

								var $verify = $('#verify');

								console.log($verify[0])

								// if(!$verify[0]){
								// 	return;
								// }

								var src = $verify[0].src;

								$verify.click(function(event) {

									$verify[0].src = src+'?'+Math.ceil(Math.random()*999);
								});
								
							}
							changeVerify();

								var commited = false;

								$('input[type=submit]').click(function(event) {

									$(this).val('处理中...');
									
									if(commited){
										alert('请勿重复提交！！！');
										return false;
									}
									commited = true;

								});

				/*--- end of Go > 回调 ---*/
			}
			
		});
	})

/*--- Go > 回调 ---*/
var type_callback = function(opts){

	var data = opts.data;
	var length = 0;
	$.each(data, function(i, val) {
		length += 1;

		$('<a>').addClass(opts.c_prefix + i + opts.c_suffix).text(val).appendTo(opts.toclass);
	});
	var step = 3;

	for(var i =0; i < Math.ceil(length/step); i++){

		// console.log($('._bt').slice(i*step,(i+1)*step))
		$(opts.c_group).slice(i*step,(i+1)*step).wrapAll('<div class="left _t-g"></div>');
	}
		$(opts.hideclass).hide();
		$(opts.toclass).show();

}


/*--- 确定 ---*/
// $('.confirm-stype')



})