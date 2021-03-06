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
  //  weui.alert('alert');
</script>
    </head>

    <body>

<div class="weui-cells__title">签到活动详情</div>
<form class="weui-cells weui-cells_form" name="add" method="post" action="<?php echo U('modifyAct',array('id'=>$detail['id']));?>">
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">课程名</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="text" name="course_name" value="<?php echo ($detail['course_name']); ?>" />
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">教室</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="text" name="classroom" value="<?php echo ($detail['classroom']); ?>" />
        </div>
    </div>

       
    <div class="weui-flex">

        <div class="weui-flex__item">
             <label class="weui-label">设置签到时间</label>
             </div>
        <div class="weui-flex__item">
            <input class="weui-input" type="number"  name="month" pattern="[0-12]*" value="<?php echo ($time['month']); ?>" />
        </div>

        <div class="weui-flex__item">
             <label class="weui-label">月</label>
             </div>
      
        <div class="weui-flex__item">
            <input class="weui-input" type="number"  name="day" pattern="[0-31]*" value="<?php echo ($time['day']); ?>"/>
        </div>
        <div class="weui-flex__item">
            <label class="weui-label">日</label>
        </div>
        </div>
        <div class="weui-flex">
        <div class="weui-flex__item">
            <label class="weui-label">开始签到时间</label>
        </div>
        <div class="weui-flex__item">
            <input class="weui-input" type="number" name="h_start" pattern="[0-24]*" value="<?php echo ($time['h_start']); ?>"/>
        </div>
        <div class="weui-flex__item">
            <label class="weui-label">时</label>
        </div>
        <div class="weui-flex__item">
            <input class="weui-input" type="number" name="m_start" pattern="[0-60]*" value="<?php echo ($time['m_start']); ?>"/>
        </div>
        <div class="weui-flex__item">
            <label class="weui-label">分</label>
        </div>
        </div>
        <div class="weui-flex">
        <div class="weui-flex__item">
            <label class="weui-label">截止签到时间</label>
        </div>
        <div class="weui-flex__item">
            <input class="weui-input" type="number" name="h_end" pattern="[0-24]*" value="<?php echo ($time['h_end']); ?>"/>
        </div>
        <div class="weui-flex__item">
            <label class="weui-label">时</label>
        </div>
        <div class="weui-flex__item">
            <input class="weui-input" type="number" name="m_end" pattern="[0-60]*" value="<?php echo ($time['m_end']); ?>"/>
        </div>
        <div class="weui-flex__item">
            <label class="weui-label">分</label>
        </div>
       </div>
    
    <div class="weui-cells__title">选择签到班级(多选)</div>
<div class="weui-cells weui-cells_checkbox">
<?php if(is_array($class)): foreach($class as $key=>$vo): ?><label class="weui-cell weui-check__label" for="s1<?php echo ($key); ?>">
        <div class="weui-cell__hd">
            <input type="checkbox" class="weui-check" name="<?php echo ($vo['id']); ?>" id="s1<?php echo ($key); ?>" <?php echo ($vo['check']); ?> />
            <i class="weui-icon-checked"></i>
        </div>
        <div class="weui-cell__bd">
            <p><?php echo ($vo['grade']); ?>级<?php echo ($vo['major']); ?>专业<?php echo ($vo['num']); ?>班</p>
        </div>
    </label><?php endforeach; endif; ?>
    <div class="weui-cells__title">签到二维码</div>
    <a href="<?php echo ($codeUrl); ?>"><img src="<?php echo ($codeUrl); ?>" /></a>
    <a href="<?php echo U('Teacher/bindClass');?>" class="weui-cell weui-cell_link">
        <div class="weui-cell__bd">添加班级</div>
    </a>
</div>


   <div class="weui-btn-area">
        <input class="weui-btn weui-btn_primary" type="submit" id="showTooltips" value="提交修改">
    </div>
    <div class="weui-btn-area">
        <a href="<?php echo U('deleteAct',array('id'=>$detail['id']));?>"><input class="weui-btn weui-btn_warn" value="删除">
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

</script>
</html>