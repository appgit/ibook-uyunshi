
/*======================================================================================*/
    $(function() {

            /*图片地址*/
            var img_src = _IMG_SRC;

            var link_src = ['#','#','http://www.uyunshi.com/index.php/home/Detail/index/seller/小东东潮鞋店/id/46','#'];
                        //  [
                        //     'http://localhost/ershoushu/ibook/Public/slider/data1/images/1.jpg',
                        //     'http://localhost/ershoushu/ibook/Public/slider/data1/images/2.jpg',
                        //     'http://localhost/ershoushu/ibook/Public/slider/data1/images/3.jpg',
                        //     'http://localhost/ershoushu/ibook/Public/slider/data1/images/4.jpg'
                        // ];
                        
            /*图片预加载*/
            $.imgpreloader({paths:img_src})
                    .always(function($allImages){

                            $('.myslider').removeClass('loading').children('img').remove();

                            $('.myslider').img_slideBar({
                                "imgsrc":img_src,
                                "linksrc":link_src,
                                "button_color":'rgba(255,255,255,0)',
                                "effect_time":500,
                                "slide_type":"fade"
                            })

                            $('.myslider').children('ul').hide(0).fadeIn(500);

                            $('.arrow-wp').children().hover(function() {

                                $(this).addClass('on');

                            }, function() {

                                $(this).removeClass('on');
                            });
                        });
            
    });

/*热卖滚轮*/
    $(function() {

        /*效果时间*/
        var effect_time = 1000;

        /*中心的宽高*/
        var img_w = 60;
        var img_h = 60;

        var big_margin = 300; //大距离

        var margin = 100; //小距离

        /*非中心的宽高*/

        var img_oriw = $('.items').first().find('img').outerWidth()||40;
        var img_orih = $('.items').first().find('img').outerHeight()||40;

        var len = $('.items').length;

        var ori_left;/*原来自身的left位置*/

        /*初始化*/
        var $items_li = $('.items');

        $items_li.eq(3).addClass('item-center');

        $items_li.slice(2,5).find('img').css({
            "width":(img_oriw+img_w)/2+'px',
            "height":(img_orih+img_h)/2+'px'
        });

        $('.tab-body').find('li').hide();

        $('.tab-body').find('li').eq(3).show();


        /*事件*/
                var $items = $('.items img');

                $items.click(function(){

                    var $this = $(this).parents('.items');
                    // console.log($this)

                    if($this.is(":animated")){

                        return;
                    }

                    if($this.hasClass('item-center')){

                        return;
                    }

                    /*显示对应的tab*/
                    $('.tab-body li').hide();

                    $('.tab-body li').eq($this.index()).show();//fadeIn(500);


                    /*最中心的那个*/
                    var $center = $(".item-center").removeClass('item-center');

                    var center_index = $center.index();
                    // alert(center_index);

                    var this_index = $this.index();
                    // alert(this_index);
                    var go_step;

                    if(this_index -center_index < -2 ){

                        go_step = (this_index+len - center_index)%len;
                    }
                    else if(this_index - center_index > 2){

                        go_step = (this_index - len - center_index)%len;

                    }else{

                        go_step = this_index -center_index;
                    }
                    // console.log(go_step)

                    /*方向*/
                    var go_dir = go_step > 0 ? -1 : 1;

                    /*偏移中心量*/
                    var offsetx = $this[0].offsetLeft - $center[0].offsetLeft;

                    /*同辈*/
                    $sib = $this.siblings('li');

                    $this.addClass('item-center');

                        $this.animate({
                            "left": $center[0].offsetLeft
                        }, effect_time,"swing");

                        // $(this).find('img').animate(
                        //  {
                        //  "width":img_w+'px',
                        //  "height":img_h+'px'
                        //  }, effect_time);

                        change_img_size($this,1)

                        var lefter = righter = 0;

                        /*获得最左和最右*/
                        $.each($('.items'), function(index, val) {

                            if(this.offsetLeft<lefter){

                                lefter = this.offsetLeft;
                            }
                            if(this.offsetLeft>righter){

                                righter = this.offsetLeft;
                            }

                        });


                    // console.log('最右边'+righter);
                    // console.log('最左边'+lefter);

                    /*排好位置*/
                    $.each($sib, function(index, val) {
                         
                         ori_left = this.offsetLeft;

                        /*整体向右*/
                        if(go_dir>0){

                            if(ori_left>800){

                                $(this).css('left',lefter+ori_left-righter-margin);
                            }

                        }else{/*整体向左*/

                            if(ori_left<0){

                                $(this).css('left', righter+ori_left-lefter+margin);
                            }
                        }
                    });

                    
                    /*整体位置的改变*/
                    $.each($sib, function(index, val) {

                        ori_left = this.offsetLeft;

                        if($(this).index()===center_index){

                            $(this).animate({"left":ori_left-offsetx}, effect_time,"swing");

                            if(go_step==1||go_step==-1){

                                change_img_size($(this),1);/*中圆*/

                            }else{

                                change_img_size($(this),0);/*小圆*/
                            }
                            return;
                        }
                        /*隔两步的中间那个*/
                        if((go_step==2 && $(this).index()==(this_index+len-1)%len) || (go_step==-2 && $(this).index()==(this_index+1)%len)){

                                $(this).animate({"left":ori_left+(big_margin*go_step*(-1))}, effect_time,"swing");

                                //change_img_size($(this),2);   /*先变大后变小*/
                                change_img_size($(this),1);

                                return;
                        }

                            $(this).animate({"left":ori_left+(margin*go_step*(-1))}, effect_time,"swing");

                            if($(this).index()==(this_index+1)%len || $(this).index()==(this_index+len-1)%len){

                                change_img_size($(this),1);

                            }else{

                                change_img_size($(this),0);
                            }
                            return;
                    });


                    function change_img_size(dom,step){

                        dom.find('img').removeClass('img-border');

                        if(step == 2){/*先变大后变小*/

                            dom.find('img').animate(
                            {
                            "width":img_w+'px',
                            "height":img_h+'px'
                            }, effect_time/2).animate(
                                {
                                "width":(img_oriw+img_w)/2+'px',
                                "height":(img_orih+img_h)/2+'px'
                                }, effect_time/2
                            )
                        }else if(step==1){

                            dom.find('img').animate(
                                {
                                "width":(img_oriw+img_w)/2+'px',
                                "height":(img_orih+img_h)/2+'px'
                                }, effect_time
                            )
                        }
                        else{ 

                            dom.find('img').animate(
                            {
                            "width":img_oriw+'px',
                            "height":img_orih+'px'
                            }, effect_time,function(){
                                dom.find('img').addClass('img-border');
                            })
                        }
                    }
                });

                $('.ar').click(function(event) {

                    var index = ($('.item-center').index()+1)%len;

                    $('.items').eq(index).find('img').trigger('click');

                });

                $('.al').click(function(event) {

                    var index = ($('.item-center').index()+len-1)%len;

                    $('.items').eq(index).find('img').trigger('click');
                });

        /*自动播放热卖产品*/
                (function(){

                    var _time = 2000000;

                    setInterval(function(){

                        $('.tab-arraw.ar').trigger('click');

                    },_time);

                }())

                /*查看求助*/
                seeHelpInfo($('.helptitle'));

});


