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
    //weui.alert('alert');
</script>
    </head>

    <body>


 <div class="weui-cells__title">我的班级</div>
<?php if(is_array($list)): foreach($list as $key=>$vo): ?><div class="weui-cell weui-cell_access">
                <div class="weui-cell__bd">
                    <span style="vertical-align: middle"><?php echo ($vo['grade']); ?>级<?php echo ($vo['major']); echo ($vo['num']); ?>班</span>
                    
                </div>
                <a href="<?php echo U('classDetail',array('id'=>$vo['id']));?>"><div class="weui-cell__ft">详细信息</div></a>
            </div><?php endforeach; endif; ?>
 <div class="weui-cells__title">添加班级</div>
<form class="weui-cells weui-cells_form" name="add" method="post" action="<?php echo U('addClass');?>">

   
    <div class="weui-cells weui-cells_radio">

         <div class="weui-cell weui-cell_select weui-cell_select-after">
        <div class="weui-cell__hd">
            <label for="" class="weui-label">年级</label>
        </div>
        <div class="weui-cell__bd">
            <select class="weui-select" name="grade">
                <option value="13">13级</option>
                <option value="14">14级</option>
                <option value="15">15级</option>
                <option value="16">16级</option>
                <!--<option value="3">校方</option>-->
            </select>
        </div>
        </div>
       
         <div class="weui-cell weui-cell_select weui-cell_select-after">
        <div class="weui-cell__hd">
            <label for="" class="weui-label">专业</label>
        </div>
        <div class="weui-cell__bd">
            <select class="weui-select" name="major">
                <option value="计算机科学与技术">计算机科学与技术</option>
                <option value="信息安全">信息安全</option>
                <option value="网络工程">网络工程</option>
                <option value="通信工程">通信工程</option>
                <option value="电子信息工程">电子信息工程</option>
                <option value="数学与应用数学">数学与应用数学</option>
                <option value="信息与计算科学">信息与计算科学</option>
                <option value="软件工程">软件工程</option>

                     
                <!--<option value="3">校方</option>-->
            </select>
        </div>
        </div>
         <div class="weui-cell weui-cell_select weui-cell_select-after">
        <div class="weui-cell__hd">
            <label for="" class="weui-label">班级</label>
        </div>
        <div class="weui-cell__bd">
            <select class="weui-select" name="num">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <!--<option value="3">校方</option>-->
            </select>
        </div>

      
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