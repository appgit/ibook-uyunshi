$(function () {

            var crop;

            //选择图片文件之后立即上传表单
            var _patt = [/\.jpg$/i,/\.jpeg$/i,/\.png$/i] ;/*模式*/

            var _not_allow = false;

            $('#imgUpload').change(function () {

                _not_allow = false;

                for(var i=0; i<_patt.length;i++){

                    if($(this).val().toUpperCase().match(_patt[i])){

                        _not_allow = true; 

                        break;
                    }
                }

                if(_not_allow == false){
                    
                    alert('格式不允许');

                    return;
                }

                
                $('#avatar_form').submit();

            });

            $('#avatar_form').submit(function (e) {

                e.preventDefault();

                $('.uploading').show();

                $.ajax(this.action, {
                    
                    files: $(":file", this),

                    iframe: true,

                    processData: false

                }).complete(function (data) {

                    $('.uploading').hide();

                    var json = data.responseJSON;
                    console.log(json);

                    $('#avatar_form').trigger('onJson', [json]);
                });
            });

            //头像上传后显示图片内容
            $('#avatar_form').bind('onJson', function (e, json) {

                //如果发生错误，则显示错误信息

                if (!json.success) {

                    $('#upload_tip').text(json.message);return;
                }

                //隐藏图片上传表单
                $('#avatar_form').hide(0);

                //显示图片内容
                $('#uploaded_image').attr('src', json.image);

                    
                    $('#uploaded_image_div').show()

                //图片加载完之后 开启图片切割
                $('#uploaded_image').load(function () {

                    $('#uploaded_image').Jcrop({

                        aspectRatio: 1,

                        onSelect: updateCoordinate

                    });
                })
            });
            function updateCoordinate(c) {

                crop = c;
            }

            //点击选择文件按钮之后显示选择文件对话框
            $('#select_file_button').click(function () {

                $('[name=image]').trigger('click');

            });

            //点击保存头像后
            function showAvatarTip(text) {

                $('#save_avatar_tip').text(text);
            }

            $('#save_avatar_button').click(function () {

                //检查是否已经裁剪过
                
                if (crop == undefined || crop.w == 0 || crop.w == undefined || $($('img.thumbnails')[1]).css('opacity') == "1") {

                    showAvatarTip('请先选出图片中需要的部分');

                    return;
                }

                //显示正在保存
                $(this).text('正在保存');

                $(this).addClass('disabled');

                //隐藏错误消息
                showAvatarTip('');

                //提交到服务器
                var url = $(this).attr('data-url');

                var imageWidth = $('.jcrop-holder img').width();

                var imageHeight = $('.jcrop-holder img').height();

                var crop2 = crop.x / imageWidth + ',' + crop.y / imageHeight + ',' + crop.w / imageWidth + ',' + crop.h / imageHeight;

                // console.dir(crop2);
                $.post(url, {crop: crop2}, function (a) {

                    // console.dir(a);
                    if (a.status) {

                        location.href = "changeavatar";
                        // location.reload();
                    } else {

                        showAvatarTip(a.info);

                        //恢复按钮
                        $('#save_avatar_button').text('保存头像');

                        $('#save_avatar_button').removeClass('disabled');
                    }
                });
            })
        })