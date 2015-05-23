$(function(){
	$('.icon-grid').click(function (e) {

		$.post(__C.controller+'/grid',{"url":window.location.href}, function(data, textStatus, xhr) {
			/*optional stuff to do after success */

		});
	});
})	