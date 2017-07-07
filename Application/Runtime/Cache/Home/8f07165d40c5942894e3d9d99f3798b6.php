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
wx.config({
    debug: true,
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
    needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
    scanType: ["qrCode"], // 可以指定扫二维码还是一维码，默认二者都有
    success: function (res) {
    var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
    alert($result);
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