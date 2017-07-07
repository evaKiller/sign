<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">



<meta name="viewport" content="width=device-width,target-densitydpi=high-dpi,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

        <title>二维码验证</title>
        <link rel="stylesheet" href="/sign/Public/weui.min.css"/>
     

<script type="text/javascript" src="/sign/Public/weui.min.js"></script>
<script type="text/javascript" src="/sign/Public/jquery-1.8.3.min.js"></script>

 <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>     
<script type="text/javascript">

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
<button id="checkJsApi">2323</button> 

</body>


<script>

 $(function(){
        var $loadingToast = $('#loadingToast');
        
            if ($loadingToast.css('display') != 'none') return;

            $loadingToast.fadeIn(100);
            setTimeout(function () {
                $loadingToast.fadeOut(100);
            }, 2000);
       
    });
wx.config({
    debug: false,
    appId: 'wx3454c4f2d313a1fb',
    timestamp: <?php echo ($timestamp); ?>,
    nonceStr: 'shunfengz',
    signature: "<?php echo ($signature); ?>",
    jsApiList: [
        
        'scanQRCode'
    ]
});
 wx.error(function(){alert(location.href.split('#')[0])});
 
wx.ready(function(){


wx.scanQRCode({
    needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
    scanType: ["qrCode"], // 可以指定扫二维码还是一维码，默认二者都有
    success: function (res) {
    var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
    alert(result);
       $.ajax({

type:"get",

url:"<?php echo U('Home/Student/checkCodeUrl');?>",

data:"codeUrl="+result,

success:function(data){


 var data = JSON.parse(data);

if (data.code == 1) {
            //alert(data.msg);
            // weui.alert(data.msg);
var url ="<?php echo U('sign');?>";

// var url="www.baidu.com"+"?id="+10000*Math.random();;

    alert('二维码验证成功!即将进入下一个验证');
window.location.href=url;
          //refer();

            // if(confirm('hahahhhahahaha')){
            //   window.location.href("<?php echo U('sign');?>");
            // }
            
       } else {
         
            
alert('二维码验证失败，请重试');
WeixinJSBridge.invoke('closeWindow',{},function(res){

    

});

        }
}

});

}
});

});

// alert('111');
   // $('#checkJsApi').click(function(){
   //  alert('aaaa');
   // });
  


// document.querySelector('#checkJsApi').onclick = function () {
//       //weui.alert('11');
//     wx.checkJsApi({
//       jsApiList: [
//         'getNetworkType',
//         'previewImage'
//       ],
//       success: function (res) {
//         alert(JSON.stringify(res));
//       }
//     });
//   }
//  document.querySelector('#ww').onclick = function () {
//     weui.alert('11');
//     wx.chooseImage({
//     count: 1, // 默认9
//     sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
//     sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
//     success: function (res) {
//         var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
//     }
// });
// }


</script>

</html>