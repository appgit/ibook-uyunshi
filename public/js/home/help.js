$(function(){
	$('.tel em').click(function(){
			$input = $(this).nextAll('input');
		if($(this).hasClass('noopen')){
			$input.val("0");
			$(this).prevAll('input').addClass('active');
		}else{
			$(this).prevAll('input').removeClass('active');
			$input.val("1");
		}
		if(!$(this).hasClass('active')){
			$(this).addClass("active").siblings('em').removeClass('active');
		}
	})

		$('#submit').click(function(event) {
			$(this).val('处理中...');
		});
		
		(function(){	/*重复提交*/

			var commited = false;

			$('input[type=submit]').click(function(event) {
				
				if(commited){
					// alert('请勿重复提交！！！');
					return false;
				}
				commited = true;

			});
		})()

		/*查看求助*/
		 seeHelpInfo($('.helptitle>a'));
})