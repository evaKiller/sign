<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>重置密码</title>
  <meta name="viewport" content="width=device-width,target-densitydpi=high-dpi,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

        
        <link rel="stylesheet" href="/sign/Public/weui.min.css"/>
  <title>登录邮箱找回密码</title>
 </head>
 <body>


  <form class="weui-cells weui-cells_form" method="post" action="<?php echo U('Email/findpwd');?>"">
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">邮箱地址：</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="email" name="email"/>
        </div>
    </div>
    <div class="weui-btn-area">
        <input class="weui-btn weui-btn_primary" type="submit" id="showTooltips" value="提交">
    </div>
</form>
 </body>
</html>