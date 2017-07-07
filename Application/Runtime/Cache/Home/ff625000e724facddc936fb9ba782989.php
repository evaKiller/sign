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
   // weui.alert('alert');
</script>
    </head>

    <body>

<form class="weui-cells weui-cells_form"  method="post" action="<?php echo U('addQuesHandler');?>">

<div class="weui-cells">
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <input class="weui-input" type="text" name="title" placeholder="请输入问题标题"/>
        </div>
    </div>
</div>


<div class="weui-cells weui-cells_form">
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <textarea class="weui-textarea" name="content" placeholder="请输入问题正文" rows="3"></textarea>
            <div class="weui-textarea-counter"><span>0</span>/200</div>
        </div>
    </div>
</div>
<div class="weui-cells__title">选项设置</div>

<div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">A选项</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" name="optiona" />
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">B选项</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" name="optionb"/>
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">C选项</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" name="optionc"/>
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">D选项</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" name="optiond"/>
        </div>
    </div>

<div class="weui-cell weui-cell_select weui-cell_select-after">
        <div class="weui-cell__hd">
            <label for="" class="weui-label">正确选项</label>
        </div>
        <div class="weui-cell__bd">
            <select class="weui-select" name="option_right">
                <option value="a">A</option>
                <option value="b">B</option>
                <option value="c">C</option>
                <option value="d">D</option>
            </select>
        </div>
    </div>
<div class="weui-cell weui-cell_select weui-cell_select-after">
        <div class="weui-cell__hd">
            <label for="" class="weui-label">选择签到班级</label>
        </div>
        <div class="weui-cell__bd">
            <select class="weui-select" name="act_id">
                <?php if(is_array($list)): foreach($list as $key=>$vo): ?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['course_name']); ?></option><?php endforeach; endif; ?>
            </select>
        </div>
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

</script>
</html>