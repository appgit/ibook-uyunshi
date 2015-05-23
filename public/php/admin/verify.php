<?php
use Think\Verify;
$config =    array(    'fontSize'    =>    30,    // 验证码字体大小    
'length'      =>    3,     // 验证码位数    
'useNoise'    =>    false, // 关闭验证码杂点
);
$Verify = new Verify($config);
$Verify->entry();
?>