<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">



<meta name="viewport" content="width=device-width,target-densitydpi=high-dpi,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

        <title>签到记录详情</title>
        <link rel="stylesheet" href="/sign/Public/weui.min.css"/>
     

<script type="text/javascript" src="/sign/Public/weui.min.js"></script>
<script type="text/javascript" src="/sign/Public/jquery-1.8.3.min.js"></script>
    

<script type="text/javascript">
    //weui.alert('alert');
</script>
    </head>

    <body>
    <div class="weui-cells__title">目前有<?php echo ($count); ?>位同学已签到.</div>
    <div class="weui-cells__title">签到列表</div>


<?php if(is_array($detail)): foreach($detail as $key=>$vo): ?><div class="weui-cell weui-cell_access">
                <div class="weui-cell__bd">
                    <span style="vertical-align: middle"><?php echo ($vo['stu_info']['realname']); ?>&emsp;&emsp;<?php echo ($vo['stu_info']['school']); ?>&emsp;&emsp;</span>
                    
                </div>
               <div class="weui-cell__ft"><?php echo ($vo['sign_status']); ?></div>
            </div><?php endforeach; endif; ?>


    </body>
    <script type="text/javascript">
  

</script>
</html>