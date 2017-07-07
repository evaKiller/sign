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
        <div class="weui-cell_hd">问题标题</div>
         <div class="weui-cell_bd"><?php echo ($question['title']); ?></div>
    </div>
</div>


<div class="weui-cells weui-cells_form">
    <div class="weui-cell">
    <div class="weui-cell_hd">问题内容</div>
        <div class="weui-cell__bd">
            <textarea class="weui-textarea" name="content"  rows="3"><?php echo ($question['content']); ?></textarea>
        </div>
    </div>
</div>
<div class="weui-cells__title">选项</div>
<div class="weui-cells weui-cells_radio">
    <label class="weui-cell weui-check__label" for="x11">
        <div class="weui-cell__bd">
            <p>A.<?php echo ($question['optiona']); ?></p>
        </div>
        <div class="weui-cell__ft">
            <input type="radio" class="weui-check" name="radio1" id="x11" value="a">
            <span class="weui-icon-checked"></span>
        </div>
    </label>
    <label class="weui-cell weui-check__label" for="x12">

        <div class="weui-cell__bd">
             <p>B.<?php echo ($question['optionb']); ?></p>
        </div>
        <div class="weui-cell__ft">
            <input type="radio" name="radio1" class="weui-check" id="x12" value="b">
            <span class="weui-icon-checked"></span>
        </div>
    </label>
    <label class="weui-cell weui-check__label" for="x13">

        <div class="weui-cell__bd">
             <p>C.<?php echo ($question['optionc']); ?></p>
        </div>
        <div class="weui-cell__ft">
            <input type="radio" name="radio1" class="weui-check" id="x13" value="c">
            <span class="weui-icon-checked"></span>
        </div>
    </label>
    <label class="weui-cell weui-check__label" for="x14">

        <div class="weui-cell__bd">
             <p>D.<?php echo ($question['optiond']); ?></p>
        </div>
        <div class="weui-cell__ft">
            <input type="radio" name="radio1" class="weui-check" id="x14" value="d">
            <span class="weui-icon-checked"></span>
        </div>
    </label>
   
</div>


 <div class="weui-btn-area">
        <input class="weui-btn weui-btn_primary" onclick="verify()" value="提交">
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

function verify(){
    var option_select=$("input[type='radio'][name='radio1']:checked").val();
//alert(option_select[0]);
   $.ajax({

type:"get",

url:"<?php echo U('Home/Student/answerHandler');?>",

data:"option_select="+option_select,

success:function(data){
alert(data)
// weui.alert('success');
 var data = JSON.parse(data);

if (data.status == 1) {
            //alert(data.msg);
            weui.alert('回答正确');
            var url ="<?php echo U('sign');?>";
    window.location.href=url;
       } else if(data.status == -1){
            weui.alert('回答错误');
            WeixinJSBridge.invoke('closeWindow',{},function(res){
            });
        }else{
            weui.alert('出错了');
            WeixinJSBridge.invoke('closeWindow',{},function(res){
            });
        }
}

});
}



</script>
</html>