

function publishcheck(frm){
	//alert(frm.image.value);
	//var bookname = frm.bookname;
	//var idx = ; 
    //alert(frm.image.value.lastIndexOf("."));
	if(frm.bookname.value==null||frm.bookname.value==''){
		alert('请输入书名包括《》')
		return false;
	}
	if(frm.costprice.value==null||frm.costprice.value==''){
		alert('请输入原价')
		return false;
	}

	if(frm.publish.value==null||frm.publish.value==''){
		alert('请输入出版社')
		return false;
	}
	if(frm.author.value==null||frm.author.value==''){
		alert('请输入作者')
		return false;
	}
	if(frm.newlevel.value==null||frm.newlevel.value==''){
		alert('请选择几成新')
		return false;
	}
	if(frm.hasnote.value==null||frm.hasnote.value==''){
		alert('请选择是否有笔记')
		return false;
	}
	
	if(frm.bookclass.value==null||frm.bookclass.value==''){
		alert('请选择类别')
		return false;
	}
	if(frm.count.value==null||frm.count.value==''){
		alert('请输入库存')
		return false;
	}

	
	var ext,idx; 
	   if (frm.image.value == '') 
	    { 
	        alert("请添加图片"); 
	      return false; 
	    } else { 
	    
	        idx = frm.image.value.lastIndexOf("."); 
	       // alert(idx);
	        if (idx != -1) 
	        { 
	            ext = frm.image.value.substr(idx+1).toUpperCase(); 
	            ext = ext.toLowerCase( );
	          
	            
	         
	            if (ext!="jpeg"&&ext != "jpg") 
	            { 
	                alert("'."+ext+"'为非法上传文件格式，只能上传.jpg文件"); 
	                return false; 
	            } 
	         
	           
	        } else { 
	            alert("只能上传图片!"); 
	            return false; 
	        } 
	    } 
	   
	   
	    if( !getFileSize(frm.image)) return false;
	    
	    
	 
	    
	    //mdiv = document.getElementById("uploadid");
		//mdiv.innerHTML = "<font color='red'>文件正在上传，请耐心等候</font>";
	    
	    return true; 

	//return true;

}

function getFileSize(target)    
{  	
	var fileSize = 0; 

     fileSize = target.files[0].size; 

    var size = fileSize / 1024*1024; 
   if(size>209715) 
    { 
        alert("文件大小不能超过2M"); 
          return false;
    } 
return true;
}  


	