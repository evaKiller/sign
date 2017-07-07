<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">



<meta name="viewport" content="width=device-width,target-densitydpi=high-dpi,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

        <title>WeUI</title>
        <link rel="stylesheet" href="/sign/Public/weui.min.css"/>
     

<script type="text/javascript" src="/sign/Public/weui.min.js"></script>
<script type="text/javascript" src="/sign/Public/jquery-1.8.3.min.js"></script>
    

<div class="weui-tab">
    <div class="weui-navbar">
        <div class="weui-navbar__item weui-bar__item_on">
            <a id="tab1">我的信息</a>
        </div>
        <div class="weui-navbar__item">
            <a id="tab2">签到记录</a>
        </div>
        <div class="weui-navbar__item">
            <a id="tab3">功能与设置</a>
        </div>
    </div>
    <div class="weui-tab__panel">
 <div id="detail1" class="weui_tab_bd_item">
                            问医生内容.......
                        </div>
                        <!--tab2  我的面板-->
                        <div id="detail2" style="display:none" class="weui_tab_bd_item">
                            我的........
                        </div>
                         <div id="detail3" style="display:none" class="weui_tab_bd_item">
                        3333
                        </div>
    </div>
</div>


    </body>
    <script type="text/javascript">
    //weui.alert('alert');
    $('#tab1').click(function(){
        $('#detail1').css('display','block');
        $('#detail2').css('display','none');
        $('#detail3').css('display','none');
    });
    $('#tab2').click(function(){
        $('#detail2').css('display','block');
        $('#detail1').css('display','none');
        $('#detail3').css('display','none');
    });
    $('#tab3').click(function(){
        $('#detail3').css('display','block');
        $('#detail1').css('display','none');
        $('#detail2').css('display','none');
    });
</script>
</html>