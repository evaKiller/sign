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

<style type="text/css">
.weui_loading_leaf {
  position: absolute;
  top: -1px;
  opacity: 0.25;
}
.weui_loading_leaf:before {
  content: " ";
  position: absolute;
  width: 8.14px;
  height: 3.08px;
  background: #d1d1d5;
  box-shadow: rgba(0, 0, 0, 0.0980392) 0px 0px 1px;
  border-radius: 1px;
  -webkit-transform-origin: left 50% 0px;
          transform-origin: left 50% 0px;
}
.weui_loading_leaf_0 {
  -webkit-animation: opacity-60-25-0-12 1.25s linear infinite;
          animation: opacity-60-25-0-12 1.25s linear infinite;
}
.weui_loading_leaf_0:before {
  -webkit-transform: rotate(0deg) translate(7.92px, 0px);
          transform: rotate(0deg) translate(7.92px, 0px);
}
/* ... */
.weui_loading_leaf_11 {
  -webkit-animation: opacity-60-25-11-12 1.25s linear infinite;
          animation: opacity-60-25-11-12 1.25s linear infinite;
}
.weui_loading_leaf_11:before {
  -webkit-transform: rotate(330deg) translate(7.92px, 0px);
          transform: rotate(330deg) translate(7.92px, 0px);
}
@-webkit-keyframes opacity-60-25-0-12 {
  0% {
    opacity: 0.25;
  }
  0.01% {
    opacity: 0.25;
  }
  0.02% {
    opacity: 1;
  }
  60.01% {
    opacity: 0.25;
  }
  100% {
    opacity: 0.25;
  }
}
/* ... */
@-webkit-keyframes opacity-60-25-11-12 {
  0% {
    opacity: 0.895958333333333;
  }
  91.6767% {
    opacity: 0.25;
  }
  91.6867% {
    opacity: 1;
  }
  51.6767% {
    opacity: 0.25;
  }
  100% {
    opacity: 0.895958333333333;
  }
}

</style>
    </head>

    <body>
<div class="weui-msg">
    <div class="weui-msg__icon-area">
    <?php if(($status == 1)): ?><i class="weui-icon-success weui-icon_msg"></i>
      <?php else: ?>
      <i class="weui-icon-warn weui-icon_msg"></i><?php endif; ?>
    </div>
     
    <div class="weui-msg__text-area">
        <h2 class="weui-msg__title"><?php echo ($title); ?></h2>
        <p class="weui-msg__desc"><?php echo ($msg); ?>&nbsp&nbsp&nbsp<a href="<?php echo U('signTrack');?>">签到记录</a></p>
    </div>
    <div class="weui-msg__opr-area">
        <p class="weui-btn-area">
            <a href="javascript:history.back();" class="weui-btn weui-btn_primary">确定</a>
            <!-- <a href="javascript:history.back();" class="weui-btn weui-btn_default">辅助操作</a> -->
        </p>
    </div>
    <!-- <div class="weui-msg__extra-area">
        <div class="weui-footer">
            <p class="weui-footer__links">
                <a href="javascript:void(0);" class="weui-footer__link">底部链接文本</a>
            </p>
            <p class="weui-footer__text">Copyright &copy; 2008-2016 weui.io</p>
        </div>
    </div> -->
</div>

<div id="loadingToast" style="display:none;">
        <div class="weui-mask_transparent"></div>
        <div class="weui-toast">
            <i class="weui-loading weui-icon_toast"></i>
            <p class="weui-toast__content">数据加载中</p>
        </div>
    </div>
</div>
    </body>
    <script type="text/javascript">

 $(function(){
        var $loadingToast = $('#loadingToast');
        $('#showLoadingToast').on('click', function(){
            if ($loadingToast.css('display') != 'none') return;

            $loadingToast.fadeIn(100);
            setTimeout(function () {
                $loadingToast.fadeOut(100);
            }, 2000);
        });
    });
</script>
</html>