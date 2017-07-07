<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">



<meta name="viewport" content="width=device-width,target-densitydpi=high-dpi,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

        <title>学生信息</title>
        <link rel="stylesheet" href="/sign/Public/weui.min.css"/>
     

<script type="text/javascript" src="/sign/Public/weui.min.js"></script>
<script type="text/javascript" src="/sign/Public/jquery-1.8.3.min.js"></script>
    

<script type="text/javascript">
   // weui.alert('alert');
</script>
    </head>

    <body>

<div class="weui-cells__title">学生信息</div>

    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">用户名</label></div>
        <div class="weui-cell__bd">
            <?php echo ($info['username']); ?>
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">邮箱</label></div>
        <div class="weui-cell__bd">
            <?php echo ($info['email']); ?>
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">姓名</label></div>
        <div class="weui-cell__bd">
            <?php echo ($info['realname']); ?>
        </div>
    </div>
     <div class="weui-cell" id="schoolnum">
      <div class="weui-cell__hd"><label class="weui-label">学号</label></div>
        <div class="weui-cell__bd">
            <?php echo ($info['schoolnum']); ?>
        </div>
    </div>
 



</div>

    </body>
    <script type="text/javascript">

</script>
</html>