<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">



<meta name="viewport" content="width=device-width,target-densitydpi=high-dpi,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

        <title>人脸验证</title>
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
    debug: false,
    appId: 'wx3454c4f2d313a1fb',
    timestamp: <?php echo ($timestamp); ?>,
    nonceStr: 'shunfengz',
    signature: "<?php echo ($signature); ?>",
    jsApiList: [
        'chooseImage',
        'uploadImage'
    ]
});
 wx.error(function(){alert(location.href.split('#')[0])});
 
wx.ready(function(){
    

   // alert('aaaa');
      wx.chooseImage({
    count: 1, // 默认9
    sizeType: ['original'], // 可以指定是原图还是压缩图，默认二者都有
    sourceType: ['camera'], // 可以指定来源是相册还是相机，默认二者都有
    success: function (res) {

        //var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
        var localId = res.localIds;
        //images.serverId = [];
        
        function upload() {
                        //调用上传图片接口
                       
                       wx.uploadImage({

                           localId:''+localId, // 需要上传的图片的本地ID，由chooseImage接口获得
                           isShowProcess: 1,   // 默认为1，显示进度提示
                            success: function(res) {

                                //返回图片的服务器端ID res.serverId,然后调用wxImgCallback函数进行下载图片操作
                                wxImgCallback(res.serverId);
                             },
                           fail: function(res) {
                                alert('上传失败');
                             }
                        });
                     }
                    
                     upload();

    }
});

});
function wxImgCallback(serverId) {
    //将serverId传给wx_upload.php的upload方法
    //alert('xixi');
    var url = 'http://lyzwnp.com/sign/index.php?c=student&a=uploadToWx';
    alert(url);
    //alert(url);
   $.ajax({

type:"get",

url:"<?php echo U('Home/Student/uploadToWx');?>",

data:"serverId="+serverId+"&openid="+"<?php echo ($openid); ?>",

success:function(data){

// weui.alert('success');
 var data = JSON.parse(data);
alert(data.code);
if (data.code == 1) {
            //alert(data.msg);
            alert('人脸验证成功!即将进入下一个验证.');
    var url ="<?php echo U('sign');?>";
    window.location.href=url;
       } else {
            weui.alert(data.msg);
            WeixinJSBridge.invoke('closeWindow',{},function(res){
            });
        }
}

});
 }
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