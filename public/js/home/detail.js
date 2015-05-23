$(function(){
	var $text = $('.pro-description').find('pre>p');
	var w_ori = $text.width();
	var $calc_width_temp = $('<p></p>').html($text.html())
	.css({'display':'inline-block','visibility':'hidden','white-space':'pre'})
	.appendTo('body');
	var w = $calc_width_temp.width();
	if(w_ori < w){
		$text.css('white-space', 'normal');
	}
	$calc_width_temp.remove();
})