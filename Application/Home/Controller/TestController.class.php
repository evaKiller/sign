<?php
namespace Home\Controller;
use Think\Controller;
class TestController extends BaseController {
  // const CLASSNAME = "计算机科学与技术 信息安全 网络工程 通信工程 电子信息工程 数学与应用数学 信息与计算科学 软件工程";
  // $grades =array(13,14,15,16);
  // $num = array(1,2,3,4,5);
    public function index(){

      $data='{
 "button":[
 {
       "name":"学生签到",
       "sub_button":[
        {
           "type":"click",
           "name":"我要签到",
           "key":"stu_sign"
        },
        {
           "type":"click",
           "name":"签到记录",
           "key":"stu_signTrack"
        },
        {
           "type":"click",
           "name":"人脸信息录入",
           "key":"stu_face"
        }]
  },
  {
       "name":"教师中心",
       "sub_button":[
        {
           "type":"click",
           "name":"签到活动列表",
           "key":"tec_tempActList"
        },
        {
           "type":"click",
           "name":"签到方式",
           "key":"tec_signWay"
        },
        {
           "type":"click",
           "name":"我的班级",
           "key":"tec_bindClass"
        },
        {
           "type":"click",
           "name":"推送消息",
           "key":"tec_pushToStudent"
        },
        {
           "type":"click",
           "name":"签到记录",
           "key":"tec_signTrack"
        }]
   }]
}';

// ,
//    {
//        "name":"帐号相关",
//        "sub_button":[
//         {
//            "type":"view",
//            "name":"用户注册",
//            "url":"http://www.lyzwnp.com/sign/index.php?c=account&a=add"
//         },
 

//         {
//            "type":"view",
//            "name":"用户登录",
//            "url":"http://www.lyzwnp.com/sign/index.php?c=account"
//         },
//         {
//            "type":"view",
//            "name":"重置密码",
//            "url":"http://www.lyzwnp.com/sign/index.php?c=email"
//         }]
//    }
      $token=$this->getToken();
      $MENU_URL="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$token;

$ch = curl_init(); 

curl_setopt($ch, CURLOPT_URL, $MENU_URL); 
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_AUTOREFERER, 1); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

$info = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Errno'.curl_error($ch);
}

curl_close($ch);

var_dump($info);
    }

  public function test()
  {
  //   $major=array('计算机科学与技术','信息安全' ,'网络工程', '通信工程', '电子信息工程', '数学与应用数学' ,'信息与计算科学', '软件工程');
  // $grades =array(13,14,15,16);
  // $num = array(1,2,3,4,5);
  //   foreach ($grades as $key => $value) {
  //     foreach ($major as $ke => $va) {
  //       foreach ($num as $k => $v) {
  //         $data = array('grade' => $value,'major' => $va, 'num' =>$v);
  //         $res = M('info_class')->add($data);
  //         if($res){
  //           echo 'haha';
  //         }
  //       }
  //     }
  //   }
    $this->display();
   
  }
}
