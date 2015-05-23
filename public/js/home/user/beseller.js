$(function(){

			var _bspage = false;
					
			$('#pubpros').on('click',function(e){
				
				if(_bspage){

					$('.module-beseller-wrap').fadeIn();
					
					return false;
				}	

				$.post(__C.controller+'/pubpros', {beseller:true}, function(data, textStatus, xhr) {

					if(textStatus =="success"){

						_bspage = true;

						$(data).appendTo('body').fadeOut(0).fadeIn();
					}
					// console.dir(arguments);

				});
				e.preventDefault();
			})
		})