<!-- 成功页 -->
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>优云网提示</title>
<style>
body { font-family: 'Microsoft YaHei'; background-color: #fff; min-width: 1024px; font-size: 16px; }
/* clear float
 --------------------------------------*/
.clearfix:after { content: "."; display: block; height: 0; clear: both; visibility: hidden; }
.clearfix { display: inline-block; }
/* Hides from IE-mac \*/ * html .clearfix { height: 1%; }
.clearfix { display: block; }
.left { float: left; }
.right { float: right; }
/* End hide from IE-mac */
.c-wrap { width: 1024px; margin: 0 auto; }
.top{ padding: 40px 0 25px; border-bottom: 1px solid #e7e7e7; }
.sub .c-wrap{ padding: 60px 0 30px 195px; }
.content{
    margin-left: 70px;
	margin-top: 20px;
}
.content h1{
    margin-bottom: 60px;
    color:#c25d29;
}
.content *{
    color:#4e412e;
}
#wait{
    font-weight: 1.1em;
}
.footer{
    text-align: center;
    color: #707070;
    margin-top: 20px;
}
.error-img{
	margin-left: -80px;
}
</style>
    </head>
    <body>
        <div class="top">
           <div class="c-wrap">
               <a href="__MODULE__/Index">
               	<img src="__PUBLIC__/images/home/biglogo.png" alt="优云网">
               </a>
           </div>
       </div>
       <div class="sub">
           <div class="c-wrap clearfix">
                <present name="message">
               <img src="__PUBLIC__/images/home/success.png" class="left" alt="优云网">
               <div class="left content">
                <h1 class="success"><?php echo($message); ?></h1>
                <else/>
                <img src="__PUBLIC__/images/home/error.png" class="left error-img" alt="优云网">
               <div class="left content">
                <h1 class="error"><?php echo($error); ?></h1>
                </present>
                <p>
                亲！请稍等片刻，<b id="wait"> <?php echo($waitSecond); ?></b> 秒后将自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转 </a>...
                </p>
               </div>
           </div>
       </div>
        <div class="c-wrap">
	        <div class="footer">
	            <p class="copyright">Copyright (c) 2014 www.uyunshi.com. All rights reserved.优云网</p>
	        </div>
        </div>
		<script type="text/javascript">
			(function(){
				var wait = document.getElementById('wait'),href = document.getElementById('href').href;
				var interval = setInterval(function(){
					var time = --wait.innerHTML;
					if(time <= 0) {
					    location.href = href;
					    clearInterval(interval);
					};
				}, 1000);
			})();
		</script>
    </body>
</html>