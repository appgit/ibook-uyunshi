/*--------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------*/
	;(function(){
		$.fn.fixCenter = function($dom){
		
			$win_w = window.innerWidth;
			$win_h = window.innerHeight;

			$d_w = $dom.outerWidth();
			$d_h = $dom.outerHeight();

				_left = ($win_w - $d_w)/2 +'px';
				_top = ($win_h - $d_h)/2 +'px';

				$dom.css({
					position:'relative',
					top: _top,
					left: _left,
				});

		}
			$.fn.mbox = function($dom) {	//模态盒子调用

				$_m = $('<div class="module-wrap"><div class="module-content"></div></div>');

				$domwp = $("<div class='dom-wrap clearfix'></div>").wrapInner($dom);

				$('<div class="clearfix m-head"><span class="m-close">×</span></div>').prependTo($domwp);

				$domwp.appendTo($_m.find('.module-content'));

				$_m.appendTo('body');

				m_fixcenter = function(){

					$win_w = window.innerWidth;
					$win_h = window.innerHeight;

					$d_w = $dom.outerWidth();
					$d_h = $dom.outerHeight();

					_left = ($win_w - $d_w)/2 +'px';
					_top = ($win_h - $d_h)/2 +'px';

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

					$('.module-wrap').fadeOut();
					$(window).off('.m_fixcenter');
				})

				$(window).on('resize.m_fixcenter',function(){
					$.fn.fixCenter($domwp);
				})
			}
	})()
/*======================================================================================*/
	$(function() {
            $('.slider').find('a').slice(-2).wrapAll('<div class="arraw-button"></div>');
            $('.ws_images').find('div').last().remove();
    });

/*=========================用户指南页面=========================================================*/
function change_bg(obj)//用于点击导航栏后改变字体颜色进行突出显示
{
    var a=document.getElementById("changebg").getElementsByTagName("a");
    for(var i=0;i<a.length;i++)
    {
        a[i].className="";
    }
    obj.className="guide-left-changebg";
}
