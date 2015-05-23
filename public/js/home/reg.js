$(function(){

		var $form = $('.reg-form');

		(function validate($reg_form){

			//条目写入jquery data,一旦有false则不提交
			function item_ok(itemname,istrue){

				$reg_form.data(itemname,istrue);
			}

			//将验证的结果显示
			function show_error($this,$error){

                if(!$error.text()==''){         //input的错误提示

                    $this.addClass("input-error");
                }else{
                    
                    $this.removeClass("input-error");
                }

				if($this.nextAll('.error-info')[0]){

					$this.nextAll('.error-info').remove();
				}
					$error.appendTo($this.parent());
			}

	        $('input').slice(0,-2).blur(function(event) {

                var $error = $('<span class="error-info"></span>');

                var $this = $(this);

                var name = $this.attr('name');

                var $val = $this.val();

                item_ok(name,false);

/*
                if( name == 'number' ){

                    var reg_mail =/^[a-zA-Z0-9]{3,16}$/g ;

                    if($this.val()==''){

                        $error.html('学号不能为空');
                    }
                   else if( $this.val()!=='' && !$this.val().match(reg_mail)  ){

                        $error.html('学号中不能有字母和数字外其他的字符');
                    }
                    else{
                       
                        $error.html('<span class="info-ok"></span>');
                        item_ok(name,true);
                    }
                }
           */    
                if( name == 'email' ){

                    var reg_mail =/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/ ;

                    if($val==''){

                        $error.html('邮箱地址不能为空');
                    }
                   else if( $val!=='' && !$val.match(reg_mail)  ){

                        $error.html('请输入合法的邮箱地址');
                    }
                    else{

                        $.post(__C.controller+'/checkEmail' ,{"email":$val}, function(data, textStatus, xhr) {

                            if(!data.status){
                                $error.html('该邮箱已被注册');
                            }else{

                                $error.html('<span class="info-ok"></span>');
                                item_ok(name,true);
                            }
                        });
                       
                    }
                }
/*
                if( name == 'truename' ){

                    var reg_name = /^([\u4E00-\uFA29]|[\uE7C7-\uE7F3]|[a-zA-Z])*\s*$/g;

                    if($val===''){
                       $error.html('请输入你的真实姓名')

                    }
                    else if($val.length>10||$val.length<2||($val.match(reg_name)==null)){

                        $error.html('姓名不合法');
                    }else{

                        $error.html('<span class="info-ok"></span>');
                    	item_ok(name,true);
                    }
                }
*/
                if( name == 'username' ){


                    var reg_name = /^([\u4E00-\uFA29]|[\uE7C7-\uE7F3]|[a-zA-Z0-9_]){3,16}$/g;

                    if($val===''){
                       $error.html('请输入用户名')

                    }else if($val.length < 3 ){
                        $error.html('用户名长度低于3位');
                        
                    }else if( $val.length > 16 ){
                        $error.html('用户名长度超过16位');

                    }else if($val.match(reg_name)==null){

                        $error.html('用户名中含有不支持符号');
                    }else{

                            $.post(__C.controller+'/checkUser' ,{"username":$val}, function(data, textStatus, xhr) {

                            if(!data.status){
                                $error.html('该用户名已被注册');
                            }else{

                                $error.html('<span class="info-ok"></span>');
                                item_ok(name,true);
                            }
                        });
                    }
                }

                if(name=='passwd'){
                     
                    if($val.length<6){

                        $error.html('密码长度至少为6位');
                    }else{

                    	$error.html('<span class="info-ok"></span>');
                    	item_ok(name,true);
                    }
                }

                if(name=='repasswd'){

                	if($val==''){

                        $error.html('密码长度至少为6位');
                    }else if(($this.val() !== $("input[name='passwd']").val())){

                        $error.html('确认密码不一致!');
                    }else{

                    	$error.html('<span class="info-ok"></span>');
	                   	item_ok(name,true);
                    }
                }

                if(name=='addr'){
                     
                    if($this.val()==""){

                        $error.html('地址不能为空');
                    }else{

                    	$error.html('<span class="info-ok"></span>');
                    	item_ok(name,true);
                    }
                }

                if(name=='code'){
                     
                    if($this.val()==""){

                        $error.html('请输入验证码');
                    }else{

                        // $error.html('<span class="info-ok"></span>');
                    	$error.html('');

                    	item_ok(name,true);
                    }
                }


                if( name == 'tel' ){

                    var reg_name = /^[0-9]{6,11}$/g;

                    if($this.val()===''){
                       $error.html('请输入联系电话');

                    }
                    else if($this.val().match(reg_name)==null){

                        $error.html('请输入合法的电话号码');
                    }else{

                        $error.html('<span class="info-ok"></span>');
                    	item_ok(name,true);
                    }
                }
				
				show_error($this,$error);
             });

		})($form);

		function checksubmit($obj){

				var tag = true;
				$.each($obj, function(index, val) {

                    if(val === false){
                        tag = false;
                    }
                });
					return tag;
			}

    var commited = false;

    var timer = false;  /*延时表单提交的一个tag*/
    
    $('#submit').click(function(e){
        //未同意条款
        if(!$('.agree')[0].checked){    
            return false;
        }
        if(timer){
            return true;    /*定时器的提交*/
        }
        if(commited){
            // alert('请勿重复提交！！！');
            return false;
        }


        var $this = $(this);
        
        commited = true;    /*防止重复提交*/


        $form.find('input').trigger('blur');
        
        /*设置一个延时，为了使得input触发blur事件后的form.data()数据正确*/
        setTimeout(function(){

            //验证不通过
            if(!checksubmit($form.data())){
            
                commited = false;
                return false;
            }else{

                timer = true;
                $this.val('注册中...');
                // $(this).addClass('process');
                $('#submit').trigger('click');
            }
        },100)

        return false;
        
	})

})
