<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">



<meta name="viewport" content="width=device-width,target-densitydpi=high-dpi,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

        <title>WeUI</title>
        <link rel="stylesheet" href="/sign/Public/weui.min.css"/>
     

<script type="text/javascript" src="/sign/Public/weui.min.js"></script>
<script type="text/javascript" src="/sign/Public/jquery-1.8.3.min.js"></script>
    

<script type="text/javascript">
    weui.alert('alert');
</script>
    </head>

    <body>

<div class="weui-cells__title">信息管理系统</div>
<form class="weui-cells weui-cells_form" name="add" method="post" action="<?php echo U('Account/doadd');?>">
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">用户名</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="text" name="username" placeholder="请输入用户名"/>
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">邮箱</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="mail" name="email" placeholder="请输入邮箱"/>
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">姓名</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="text" name="realname" placeholder="请输入姓名"/>
        </div>
    </div>

    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">密码</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="password" name="pwd" placeholder="请输入密码"/>
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">重新输入密码</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="password" name="repwd" placeholder="请重新输入密码"/>
        </div>
    </div>
       
   
    <div class="weui-cells weui-cells_radio">

    <div class="weui-cell weui-cell_select weui-cell_select-after">
        <div class="weui-cell__hd">
            <label for="" class="weui-label">身份</label>
        </div>
        <div class="weui-cell__bd">
            <select class="weui-select" onchange="func()" name="cart">
                <option value="stu_">学生</option>
                <option value="tec_">教师</option>
                <!--<option value="3">校方</option>-->
            </select>
        </div>

      
    </div>


</div>
    <input name="openid" value="<?php echo ($openid); ?>" type="hidden">
     <div class="weui-cell" id="schoolnum">
      <div class="weui-cell__hd"><label class="weui-label">学号</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="text" name="schoolnum"  placeholder="请输入学号"/>
        </div>
    </div>
    <div class="weui-cell weui-cell_vcode">
        <div class="weui-cell__hd"><label class="weui-label">验证码</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="text" name="verifyCode" placeholder="请输入验证码"/>
        </div>
        <div class="weui-cell__ft">
           <img src="<?php echo U('Home/Account/verify_c','','');?>" style="cursor:pointer" id="verifycode" class="ver"/>
        </div>
    </div>
   <div class="weui-btn-area">
        <input class="weui-btn weui-btn_primary" type="submit" id="showTooltips" value="提交">
    </div>
</form>


</div>





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