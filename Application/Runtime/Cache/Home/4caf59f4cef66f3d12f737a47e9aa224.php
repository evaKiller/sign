<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">



<meta name="viewport" content="width=device-width,target-densitydpi=high-dpi,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

        <title>WeUI</title>
        <link rel="stylesheet" href="/sign/Public/weui.min.css"/>
     

<script type="text/javascript" src="/sign/Public/weui.min.js"></script>
<script type="text/javascript" src="/sign/Public/jquery-1.8.3.min.js"></script>

 <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>     
<script type="text/javascript">

</script>

    </head>

    <body>
<button id="checkJsApi">2323</button> 

</body>


<script>
var status = <?php echo ($status); ?>;
alert(status);
if(status){
    alert('地址验证成功!即将进入下一个验证.');
    var url ="<?php echo U('sign');?>";
    window.location.href=url;
} else {
weui.alert('您与教室的距离大于50米');

WeixinJSBridge.invoke('closeWindow',{},function(res){
});
}


</script>

</html>