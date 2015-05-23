$(function(){

    $('#set-username').keyup(function(event) {

        var $that = $(this);

        var $val = $that.val();

        $that.parent().find('.isregister').remove();

        var reg_name = /^([\u4E00-\uFA29]|[\uE7C7-\uE7F3]|[a-zA-Z0-9_]){3,16}$/g;

        if($val===''){

            $that.parent().append('<span class="info-error isregister">请输入用户名</span>');

            return;

        }else if($val.length < 3 ){

            $that.parent().append('<span class="info-error isregister">用户名长度低于3位</span>');

            return;
            
        }else if( $val.length > 16 ){

            $that.parent().append('<span class="info-error isregister">用户名长度超过16位</span>');

            return;

        }else if($val.match(reg_name)==null){

            $that.parent().append('<span class="info-error isregister">用户名中含有不支持符号</span>');

            return;

        }else{}


         $.post(__C.module+'/Register/checkUser' ,{"username":$(this).val()}, function(data, textStatus, xhr) {
            
            $that.parent().find('.isregister').remove();

            if(!data.status){

                $that.parent().append('<span class="info-error isregister">已注册</span>');

            }else{

                $that.parent().append('<span class="info-ok isregister"></span>');

            }
        });
    });

/*blur 处理函数*/
function do_blur($that) {

        $that.parent().find('.isregister').remove();

        var reg_mail =/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/ ;

        if($that.val()==''){

            $that.parent().append('<span class="info-error isregister">邮箱不能为空</span>');

            return;

        }else if( $that.val()!=='' && !$that.val().match(reg_mail)  ){

            $that.parent().append('<span class="info-error isregister">邮箱格式不正确</span>');

            return;
        }
        
        $.post(__C.module+'/Register/checkEmail' ,{"email":$that.val()}, function(data, textStatus, xhr) {

            if(!data.status){

                $that.parent().append('<span class="info-error isregister">已注册</span>');
                
            }else{

                $that.parent().append('<span class="info-ok isregister"></span>');
            }
        });
    }

    $('#set-email').blur(function(e){

        do_blur($(this));

    });

    $('#qq-userinfo').click(function (e) {

        var $that = $(this);

        $that.attr('disabled',true);

        e.preventDefault();

        /*发送ajax请求，所以下面设定一个定时器*/
        do_blur($('#set-email'));

        setTimeout(function(){
            
            if(!!$('.reg-form').find('.info-error')[0]){

                $that.removeAttr('disabled');

                return false;

             }else{

                $('.reg-form').submit();
             }


        },200);

    });
})