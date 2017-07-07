<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">



<meta name="viewport" content="width=device-width,target-densitydpi=high-dpi,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

        <title>推送给学生信息</title>
        <link rel="stylesheet" href="/sign/Public/weui.min.css"/>
     

<script type="text/javascript" src="/sign/Public/weui.min.js"></script>
<script type="text/javascript" src="/sign/Public/jquery-1.8.3.min.js"></script>
    

<script type="text/javascript">
   // weui.alert('alert');
</script>
    </head>

    <body>

<form class="weui-cells weui-cells_form"  method="post" action="<?php echo U('pushToStudentHandler');?>">

<div class="weui-cells">
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <input class="weui-input" type="text" name="title" placeholder="请输入推送标题"/>
        </div>
    </div>
</div>


<div class="weui-cells weui-cells_form">
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <textarea class="weui-textarea" name="content" placeholder="请输入推送内容" rows="3"></textarea>
            <div class="weui-textarea-counter"><span>0</span>/200</div>
        </div>
    </div>
</div>
<div class="weui-cells__title">推送班级</div>
<div class="weui-cells weui-cells_checkbox">
    <?php if(is_array($class)): foreach($class as $key=>$vo): ?><label class="weui-cell weui-check__label" for="s1<?php echo ($key); ?>">
        <div class="weui-cell__hd">
            <input type="checkbox" class="weui-check" name="<?php echo ($vo['id']); ?>" id="s1<?php echo ($key); ?>" />
            <i class="weui-icon-checked"></i>
        </div>
        <div class="weui-cell__bd">
            <p><?php echo ($vo['grade']); ?>级<?php echo ($vo['major']); ?>专业<?php echo ($vo['num']); ?>班</p>
        </div>
    </label><?php endforeach; endif; ?>
    
</div>

 <div class="weui-btn-area">
        <input class="weui-btn weui-btn_primary" type="submit" id="showTooltips" value="提交">
    </div>
</form>

<!-- <div class="weui-dialog">
        <div class="weui-dialog__hd"><strong class="weui-dialog__title">错误</strong></div>
        <div class="weui-dialog__bd">两次密码输入不一致</div>
        <div class="weui-dialog__ft">
            <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_primary">确定</a>
        </div>
    </div> -->
    </body>
    <script type="text/javascript">
    var captcha_img = $('#verifycode');
var verifyimg = captcha_img.attr("src");  
captcha_img.attr('title', '点击刷新');  
$('.ver').click(function(){  
    if( verifyimg.indexOf('?')>0){  
        $(this).attr("src", verifyimg+'&random='+Math.random());  
    }else{  
        $(this).attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());  
    }  
});  

    $(document).ready(function(){
 
  $("#submit").click(function(){
    if($("#username").val()==""){
        weui.alert('用户名不能为空');    
        $('#username').focus();
        return false;
     }
    else if($("#pwd").val()==""){
        weui.alert('密码不能为空');    
        $('#pwd').focus();
        return false;
    }          
    else if($("#repwd").val()==""){
        weui.alert('密码不能为空');   
        $('#repwd').focus();
        return false;
    }
    else if($("#realname").val()==""){
        weui.alert('真实姓名');   
        $('#realname').focus();
        return false;
    }
    else if($("#code").val()==""){
        weui.alert('真实姓名');   
        $('#code').focus();
        return false;
    }
   
            else {$('form').submit();
           }    
   });
 });

function func(){
    var val = $('select option:selected').val();
    if(val == 'tec_'){
         $('#schoolnum').css('display','none');
    } else {
        $('#schoolnum').css('display','inline');
    }
}
</script>
</html>