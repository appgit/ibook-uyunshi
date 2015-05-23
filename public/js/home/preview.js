$(document).ready(function(e) {
  //判断浏览器是否有FileReader接口
  if(typeof FileReader =='undefined'){
     $("#uploadimg").css({'background':'none'}).html('<div class="not-support">oops~,亲，您的浏览器暂不支持图片预览,请更新浏览器以获得最好体验 </div>');
  }
  else
  {
       $("#imgUpload").change(function(e){ 
              fileChange($(this)[0]);
              var file = e.target.files[0];

              if(!!file){
                //实例化FileReader API
                var freader = new FileReader();
                freader.readAsDataURL(file);
                freader.onload=function(e){
                 var img = '<img src="'+e.target.result+'" class="imgpreview" width="200px"    height="200px"/>';
                  $("#uploadimg").empty().append(img);
                }
               }else{
                  var img = '<img src="'+__C.root+'/Public/images/home/proimg.png" class="imgpreview" />';
                  $("#uploadimg").empty().append(img);
              }

         });

  }
/*约束*/
var isIE = /msie/i.test(navigator.userAgent) && !window.opera; 
var _ietry_again=false;
function fileChange(target,id) { 
// return;
// alert(_ietry_again)
  if(_ietry_again==true&&target.value==""){
    _ietry_again = false;
    return;
  }
  $('.warning-tip').html("");
  
  var fileSize = 0; 
  var filetypes =[".jpg",".png",".jpeg",".JPG",".Jpg",".PNG",".JPEG"]; 
  var filepath = target.value; 
  var filemaxsize = 2048;//2M 

  if(filepath){ 
    var isnext = false; 
    var fileend = filepath.substring(filepath.indexOf(".")); 
    if(filetypes && filetypes.length>0){ 
      for(var i =0; i<filetypes.length;i++){ 
        if(filetypes[i]==fileend){ 
          isnext = true; 
          break; 
        } 
      } 
    } 
    // alert(isnext)
    if(!isnext){ 
      $('.warning-tip').html("只能上传jpeg、jpg和png格式！"); 
      _ietry_again = true;
      target.value =""; /*ie会又触发一遍change*/
      return false; 
    } 
  }else{ 
    return false; 
  } 
if (isIE && !target.files) { 
  var filePath = target.value;
  var file = fileSystem.GetFile (filePath);
  fileSize = file.Size;
} else { 
  fileSize = target.files[0].size; 
} 

var size = fileSize / 1024; 
// console.log(size)
if(size>filemaxsize){ 
  $('.warning-tip').html("上传图片大小不能大于"+filemaxsize/1024+"M！"); 
  _ietry_again = true;
  target.value =""; 
  return false; 
} 
if(size<=0){ 
  $('.warning-tip').html("上传图片大小不能为0M！"); 
  _ietry_again = true;
  target.value =""; 
  return false; 
} 
} 
});