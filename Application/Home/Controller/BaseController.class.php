<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller {
    const PushUrl = 'https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=ACCESS_TOKEN';

    const CLASSNAME = "计算机科学与技术 信息安全 网络工程 通信工程 电子信息工程 数学与应用数学 信息与计算科学 软件工程";
    public function index(){
      $this->display();
    }
    public function getRemoteToken(){

        $APPSECRET='4a14c4d011179e8edb4c204460e45b50';
        $APPID='wx3454c4f2d313a1fb';

        $token_access_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $APPID . "&secret=" . $APPSECRET;
        $res = file_get_contents($token_access_url); //获取文件内容或获取网络请求的内容
//echo $res;
        $result = json_decode($res, true); //接受一个 JSON 格式的字符串并且把它转换为 PHP 变量
        return $result['access_token'];
    
    }
    public function getToken(){
        $token=S('token');
        if($token){
            return $token;
        }else{
            $token_new=$this->getRemoteToken();
            S('token',$token_new,60*110);
            return $token_new;
        }
     

    }


        public function verify_c(){
        
    $Verify =    new \Think\Verify();  
    $Verify->fontSize = 18;  
    $Verify->length   = 2;  
    $Verify->useNoise = false;  
    $Verify->codeSet = '0123456789';  
    $Verify->imageW = 130;  
    $Verify->imageH = 30; 
    ob_clean();
    $Verify->entry();

 

}
function check_verify($code, $id = '')
{
    $verify = new \Think\Verify();    
    return $verify->check($code, $id);
}

public function checkCart($openid)
{
    $temp1 = M('stu_info')->where(array('openid'=>$openid))->find();
    $temp2 = M('tec_info')->where(array('openid'=>$openid))->find();
    if($temp1 == false && $temp2 !=false){
        return 'tec_';
    }elseif($temp1 != false && $temp2 ==false){
        return 'stu_';
    }else{
        return false;
    }
}



public function pushByClassid($content,$openids)
{   
    $queryUrl = 'https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=';
    $token = $this->getToken();
    $action = 'post';
    $template = array(
            'touser'=>$openids,
            'msgtype'=>'text',
            'text'=>array(
                'content'=>$content,
            ),
        );
    $template = json_encode($template,JSON_UNESCAPED_UNICODE); 
    return A('Home/Curl')->callWebServer($queryUrl.$token, $template, $action);
}
public function getClassInfo($classids)
    {
        $classids = unserialize($classids);
        $class =array();
        foreach ($classids as $key => $value) {
            $res =M('info_class')->where(array('id'=>$value))->find();
            if($res){
                $class =array_merge($class,array($key=>$res));
            }
        }
        return $class;
    }


       // 获取jsticket 两小时有效
    private function getjsticket(){ // 只允许本类调用，继承的都不可以调用，公开调用就更不可以了
        $access_token = $this->getToken();
        //var_dump($access_token);
        $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$access_token."&type=jsapi"; // 两小时有效
        $rurl = file_get_contents($url);
        $rurl = json_decode($rurl,true);
        if($rurl['errcode'] != 0){
            return false;
        }else{
            $jsticket = $rurl['ticket'];
            return $jsticket;
        }

    }

    // 获取 signature
    public function getsignature($openid,$url){
        $noncestr = 'shunfengz';
        $jsapi_ticket = $this->getjsticket();
        $timestamp = time();
        // $url = "http://www.lyzwnp.com/sign/index.php?c=student&a=faceHandler&stu_id=2";
        $string1 = 'jsapi_ticket='.$jsapi_ticket.'&noncestr='.$noncestr.'&timestamp='.$timestamp.'&url='.$url;
        $signature = sha1($string1);
        // var_dump($url);
        // var_dump($jsapi_ticket);
        // var_dump(time());
        // var_dump($signature);
        return $signature;
    }


}
