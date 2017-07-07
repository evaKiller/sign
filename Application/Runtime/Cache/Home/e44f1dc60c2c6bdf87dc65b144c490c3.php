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

<div class="weui-cells__title">信息管理系统</div>
<form class="weui-cells weui-cells_form" name="add" method="post" action="<?php echo U('addQuesHandler',array('ques_id'=>$question['id']));?>">
   <div class="weui-cells">
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <input class="weui-input" type="text" name="title" value="<?php echo ($question['title']); ?>"/>
        </div>
    </div>
</div>


<div class="weui-cells weui-cells_form">
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <textarea class="weui-textarea" name="content" rows="3"><?php echo ($question['content']); ?></textarea>
            <div class="weui-textarea-counter"><span>0</span>/200</div>
        </div>
    </div>
</div>
<div class="weui-cells__title">选项设置</div>

<div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">A选项</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" name="optiona" value="<?php echo ($question['optiona']); ?>" />
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">B选项</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" name="optionb" value="<?php echo ($question['optionb']); ?>"/>
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">C选项</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" name="optionc" value="<?php echo ($question['optionc']); ?>"/>
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">D选项</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" name="optiond" value="<?php echo ($question['optiond']); ?>"/>
        </div>
    </div>

<div class="weui-cell weui-cell_select weui-cell_select-after">
        <div class="weui-cell__hd">
            <label for="" class="weui-label">正确选项</label>
        </div>
        <div class="weui-cell__bd">
            <select class="weui-select" name="option_right">
                <option value="a" <?php if('a'==$question['option_right']){echo "selected";} ?>>A</option>
                <option value="b" <?php if('b'==$question['option_right']){echo "selected";} ?>>B</option>
                <option value="c" <?php if('c'==$question['option_right']){echo "selected";} ?>>C</option>
                <option value="d" <?php if('d'==$question['option_right']){echo "selected";} ?>>D</option>
            </select>
        </div>
    </div>
<div class="weui-cell weui-cell_select weui-cell_select-after">
        <div class="weui-cell__hd">
            <label for="" class="weui-label">选择签到班级</label>
        </div>
        <div class="weui-cell__bd">
            <select class="weui-select" name="act_id">
                <?php if(is_array($list)): foreach($list as $key=>$vo): ?><option value="<?php echo ($vo['id']); ?>"  <?php if($vo['id']==$question['act_id']){echo "selected";} ?> ><?php echo ($vo['course_name']); ?> </option><?php endforeach; endif; ?>
            </select>
        </div>
    </div>



    <!-- 
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
 -->

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