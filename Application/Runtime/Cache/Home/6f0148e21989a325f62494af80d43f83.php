<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">



<meta name="viewport" content="width=device-width,target-densitydpi=high-dpi,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

        <title>签到活动列表</title>
        <link rel="stylesheet" href="/sign/Public/weui.min.css"/>
     

<script type="text/javascript" src="/sign/Public/weui.min.js"></script>
<script type="text/javascript" src="/sign/Public/jquery-1.8.3.min.js"></script>
    

<script type="text/javascript">
    //weui.alert('alert');
</script>
    </head>

    <body>

<div class="weui-btn-area">
        <a href="<?php echo U('addAct',array('week_status'=>1));?>"><div class="weui-btn-area">
        <input class="weui-btn weui-btn_primary" id="showTooltips" value="添加签到活动">
    </div></a>
    </div>
 <div class="weui-cells__title">临时签到活动列表</div>
<?php if(is_array($list)): foreach($list as $key=>$vo): ?><div class="weui-cell weui-cell_access">
                <div class="weui-cell__bd">
                    <span style="vertical-align: middle"><?php echo ($vo['course_name']); echo date('Y年m月d日 H:i',$vo['time_start']) ?>到<?php echo date('Y年m月d日 H:i',$vo['time_end']) ?></span>
                    
                </div>
                <a href="<?php echo U('tempActDetail',array('week_status'=>1,'id'=>$vo['id']));?>"><div class="weui-cell__ft">详细信息</div></a>
            </div><?php endforeach; endif; ?>



    </body>
    <script type="text/javascript">
  

</script>
</html>