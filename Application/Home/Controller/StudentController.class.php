<?php
namespace Home\Controller;
use Think\Controller;
class StudentController extends BaseController {


    public function index(){


    }
    public function sign()
    {
       // $this->unsetSession();
        // I('act_id') == '' ? $act_id = session('act_id') : I('act_id');
        // I('stu_id') == '' ? $stu_id = session('stu_id') : I('stu_id');
        // session('act_id',$act_id);
        // session('stu_id',$stu_id);
        //var_dump(I('stu_id'));
        if(session('act_id') && session('stu_id') && session('openid')){
            $act_id = session('act_id');
            $stu_id = session('stu_id');
            $openid = session('openid');
        }else{
            $act_id = I('act_id');
            $stu_id = I('stu_id');
            $openid = I('openid');
            session('act_id',$act_id);
            session('stu_id',$stu_id);
            session('openid',$openid);
        }
        $stu = M('stu_info')->where(array('stu_id'=>$stu_id))->find();
        $res = M('activity_res')->where(array('act_id' => $act_id,'stu_id'=>$stu['id']))->find();
        var_dump($act_id);
        var_dump(session('act_id'));

        if($res){
             session('res_id',$res['id']); 
            if($res['sign_status']== -1){
                $data=array(
                    'sign_status'=>0,
                    'code_status'=>0,
                    'local_status'=>0,
                    'face_status'=>0,
                    'answer_status'=>0
                    );
                M('activity_res')->where(array('res_id'=>$res['id']))->save($data); 
                $this->redirect('signRoute');
            }elseif ($res['sign_status']==1) {
                $this->unsetSession();
               // $this->error('你已签到成功，请勿重复签到','signTrack');
                $this->redirect('result',array('title'=>'你已签到成功，请勿重复签到','msg'=>"你已签到成功，接下来请认真听课哟0.0",'status'=>0));
            }else{
                 $this->redirect('signRoute');
            }  
            
        }else{
            $data = array(
                'act_id' => $act_id,
                'stu_id' => $stu['id'],
                'student_name' => $stu['realname'],
            );
            if($res_id=M('activity_res')->add($data)){
                session('res_id',$res_id);
                //var_dump($res_id);
                $this->redirect('signRoute');
            }else{
                $this->error('创建签到结果失败0');
            }
        }

    }

    public function unsetSession(){
        session(null);
    }

    public function signRoute()
    {
        $act_id=session('act_id');
        $res_id=session('res_id');
        $tec_id=M('activity')->where(array('id'=>$act_id))->getField('tec_id');
        $res = M('activity_res')->where(array('id'=>$res_id))->find();
        $way = M('activity_way')->where(array('tec_id' => $tec_id))->find();
        var_dump($res);
        if($way){
            if($way['code_status'] == 1 && $res['code_status'] == 0){
                $this->redirect('codeView');
            }elseif ($way['local_status'] == 1 && $res['local_status'] == 0) {
                $this->redirect('localHandler');
            }elseif ($way['face_status'] == 1 && $res['face_status'] == 0) {
                $this->redirect('faceHandler');
            }elseif ($way['answer_status'] == 1 && $res['answer_status'] == 0) {
                $this->redirect('answerView');
            }elseif ($res['face_status'] == 1 && $res['code_status'] == 1 && $res['answer_status'] == 1 && $res['local_status'] == 1){
                M('activity_res')->where(array('id'=>$res_id))->setField('sign_status',1);
                $this->redirect('result',array('title'=>'签到成功','msg'=>'你已签到成功，接下来请认真听课哟0.0','status'=>1));
            }else{
               M('activity_res')->where(array('id'=>$res_id))->setField('sign_status',-1);
               $this->redirect('result', array('title'=>'签到失败','msg'=>'童鞋×_×请重新签到','status'=>0));
            }
        }else{
            $this->unsetSession();
            $this->error('创建签到结果失败1');
        }

    }

    public function codeView()
    {
         $stu_id = session('stu_id');
         $openid = session('openid');
         var_dump($openid);
         var_dump($stu_id);
         var_dump(session('res_id'));
        $url="http://www.lyzwnp.com/sign/index.php?m=Home&c=Student&a=codeView";
        $this->signature = $this->getsignature($openid,$url);

        $this->timestamp = time();
        $this->openid = $openid;
        $this->display();
    }

    public function checkCodeUrl()
    {
        //var_dump($codeUrl);
        $codeUrl = I('codeUrl');
        $act_id = session('act_id');
        $res_id = session('res_id');

        $originUrl = M('activity')->where(array('id'=>$act_id))->getField('code_url');
        // var_dump($originUrl);
        // var_dump($codeUrl);
        // var_dump($codeUrl);
        // var_dump($originUrl);
        if($codeUrl == $originUrl){
            $flag1 = M('activity_res')->where(array('id'=>$res_id))->setField('code_status',1);
            if($flag1){

                exit(json_encode(array('msg'=>'ok','code'=>1)));
            }
            
        }else{
            $flag2 = M('activity_res')->where(array('id'=>$res_id))->setField('code_status',-1);
            if($flag2){
                $this->unsetSession();
                 M('activity_res')->where(array('id'=>$res_id))->setField('sign_status',-1);
                exit(json_encode(array('msg'=>'验证失败','code'=>0)));
            }
           
        }
    }

    // public function codeHandler()
    // {
    //     $act_id = session('act_id');
    //     $stu_id = session('stu_id');
    //     $openid=M('stu_info')->where(array('stu_id'=>$stu_id))->getField('openid');
    //     $res = M('activity_res')->where(array('act_id'=>$act_id,'stu_id'=>$stu_id))->setField('code_status',1);
    //     if($res){
    //         $this->redirect('Student/sign');
    //     }else{
    //         $this->error('wrong');
    //     }
    // }



    public function localHandler()
    {
        $act_id = session('act_id');
        $stu_id = session('stu_id');
        $tec_id = M('tec_info')->where(array('act_id'=>$act_id))->getField('id');
        $stu_latitude = M('stu_info')->where(array('id'=>$stu_id))->getField('latitude');
        $stu_longitude = M('stu_info')->where(array('id'=>$stu_id))->getField('longitude');
        $tec_longitude = M('tec_info')->where(array('id'=>$tec_id))->getField('longitude');
        $tec_latitude = M('tec_info')->where(array('id'=>$tec_id))->getField('latitude');

        $url = "http://apis.map.qq.com/ws/distance/v1/?mode=walking";
        $key = 'FABBZ-25IR3-4663M-3XGIO-C62M5-KQFXU';
        $from = $stu_latitude.','.$stu_longitude;
        $to = $tec_latitude.','.$tec_longitude;
        $request_url= $url .'&from='.$from.'&to='.$to.'&key='.$key;
        $res = A('Home/Curl')->callWebServer($request_url);
        var_dump($stu_id);
        var_dump($from);
        var_dump($tec_id);
        var_dump($request_url);
        var_dump($res);
        // var_dump($res);
        if($res){        
            $distance = $res['result']['elements'][0]['distance'];
            if($distance<400){
                $flag1= M('activity_res')->where(array('act_id'=>$act_id,'stu_id'=>$stu_id))->setField('local_status',1);
                if($flag1){
                    $this->redirect('localView',array('status'=>1));
                }else{
                    $this->unsetSession();
                    $this->redirect('localView',array('status'=>2));
                }
                
            }else{
                $flag2= M('activity_res')->where(array('act_id'=>$act_id,'stu_id'=>$stu_id))->setField('local_status',-1);
                if($flag2){
                    M('activity_res')->where(array('id'=>$res_id))->setField('sign_status',-1);
                    $this->unsetSession();
                    $this->redirect('localView',array('status'=>0));
                }else{
                    $this->unsetSession();
                  $this->redirect('localView',array('status'=>2));
                }
                

            }
            
        }

     }

    public function localView()
    {
        var_dump(session('stu_id'));
        $this->status=I('status');
        $this->display();
    }

    public function faceHandler()
    {
        $stu_id = session('stu_id');
        $openid=session('openid');
        $url="http://www.lyzwnp.com/sign/index.php?m=Home&c=Student&a=faceHandler";
        $this->signature = $this->getsignature($openid,$url);

        $this->timestamp = time();
        $this->openid = $openid;
        $this->display();
    }

    public function uploadToWx()
    {
        $media_id = I('serverId');
        $openid=I('openid');
        $act_id=session('act_id');
        $stu_id=session('stu_id');
        $res_id=session('res_id');

       $path = '/var/www/html/sign/Public/signface/'.$media_id.'.jpg';
        if($this->wxDownImg($media_id,$path)){
            $confidence=$this->compareFace($media_id,$openid);
            if(!empty($confidence) && $confidence>80){
                $res = M('activity_res')->where(array('act_id'=>$act_id,'stu_id'=>$stu_id))->setField('face_status',1);
                if($res){
                    exit(json_encode(array('msg'=>'ok','code'=>1)));
                }else{
                    $this->unsetSession();
                    exit(json_encode(array('msg'=>'wrong','code'=>2)));
                }
                
            }else{
                 M('activity_res')->where(array('id'=>$res_id))->setField('sign_status',-1);
                $this->unsetSession();
                exit(json_encode(array('msg'=>'检测不到人脸或人脸不匹配','code'=>-1)));
            }
          
        }else{
            $this->unsetSession();
            exit(json_encode(array('msg'=>'wrong','code'=>2)));
        }
    }

    public function faceInput()
    {
        $openid = I('openid');
       // $openid = I('openid');
        $url="http://www.lyzwnp.com/sign/index.php?c=student&a=faceInput&openid={$openid}";
        $this->signature = $this->getsignature($openid,$url);
        $this->timestamp = time();
        $this->openid = $openid;
        $this->display();
    }

    public function addFaceInfo()
    {

        $openid = I('openid');
        
        $media_id = I('serverId');
       $path = '/var/www/html/sign/Public/userface/'.$openid.'.jpg';
        if(file_exists($path)){
             exit(json_encode(array('msg'=>'你已上传过脸部信息，请不要重复上传','code'=>2)));
        }elseif($this->wxDownImg($media_id,$path)){
          exit(json_encode(array('msg'=>'ok','code'=>1)));
        }else{
            exit(json_encode(array('msg'=>'wrong','code'=>0)));
        }
    }
//public function compareFace($media_id,$openid)
    public function compareFace($media_id,$openid)
    {

        // $media_id="rCU_tyo51TuuSyq9hNeZYScx3fHFn60RJm1rpA9H1-2jZLrA2PSzPiwWW5HhVx1Y";
        // $openid="ofyn8wkleMfMRTCsLMzKNVMD6Joo";
        $request_url = "https://api-cn.faceplusplus.com/facepp/v3/compare";
        $method = "POST";
        $param=array();
        $param['image_url1'] = "http://www.lyzwnp.com/sign/Public/signface/".$media_id.".jpg";
        $param['image_url2'] = "http://www.lyzwnp.com/sign/Public/userface/".$openid.".jpg";
        $param['api_key'] = "Ow1wVOlJSaPSBGyIGg7Psy4Fm_u9gmP8";
        $param['api_secret'] = "EK00O9UNpMC8Gd7CAeDrND5SD_Tonlrh";
         $res = $this->http_post($request_url,$param);
         $arr = $this->object2array(json_decode($res));
        return $arr['confidence'];
    // }
}
function object2array(&$object) {
             $object =  json_decode( json_encode( $object),true);
             return  $object;
    }
// public function detectFace()
// {
//     $param=array();
       
//         // $param['image_url'] = "http://lyzwnp.com/sign/Public/userface/ofyn8wkleMfMRTCsLMzKNVMD6Joo.jpg";
//         $param['api_key'] = "Ow1wVOlJSaPSBGyIGg7Psy4Fm_u9gmP8";
//         $param['api_secret'] = "EK00O9UNpMC8Gd7CAeDrND5SD_Tonlrh";
//         $param['image_url'] = "http://www.lyzwnp.com/sign/Public/signface/rCU_tyo51TuuSyq9hNeZYScx3fHFn60RJm1rpA9H1-2jZLrA2PSzPiwWW5HhVx1Y.jpg";
//        // $param['image_file'] = file_get_contents("@/var/www/html/sign/Public/userface/ofyn8wkleMfMRTCsLMzKNVMD6Joo.jpg");
//     $request_url = "https://api-cn.faceplusplus.com/facepp/v3/detect";
//     $Curl=A('Curl');
//     // $flag = $Curl->addFile("http://lyzwnp.com/sign/Public/userface/ofyn8wkleMfMRTCsLMzKNVMD6Joo.jpg");
//     // $res = $Curl->callWebServer($request_url, $param, 'POST', $is_json=true, $is_urlcode=true);
//     //$res = $this->sendStreamFile($request_url,"/var/www/html/sign/Public/userface/ofyn8wkleMfMRTCsLMzKNVMD6Joo.jpg");
//     $res = $this->http_post($request_url,$param);
//     var_dump($res);
//     var_dump($param['image_file']);
    
// }

    private function http_post($url,$param){ 
    $oCurl = curl_init(); 
    if(stripos($url,"https://")!==FALSE){ 
      curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE); 
      curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false); 
    } 
    if (is_string($param)) { 
      $strPOST = $param; 
    } else { 
      $aPOST = array(); 
      foreach($param as $key=>$val){ 
        $aPOST[] = $key."=".urlencode($val); 
      } 
      $strPOST = join("&", $aPOST); 
    } 
    curl_setopt($oCurl, CURLOPT_URL, $url); 
    curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 ); 
    curl_setopt($oCurl, CURLOPT_POST,true); 
    curl_setopt($oCurl, CURLOPT_POSTFIELDS,$strPOST); 
    $sContent = curl_exec($oCurl); 
    $aStatus = curl_getinfo($oCurl); 
    curl_close($oCurl); 
    return $sContent;
    // if(intval($aStatus["http_code"])==200){ 
    //   return $sContent; 
    // }else{ 
    //   return false; 
    // } 
  }  
//public function wxDownImg($media_id, $path) {
     public function wxDownImg($media_id,$path) {
             //调用 多媒体文件下载接口
        // $media_id='atj3dR9ErSEhlml0f8-89AvbK6D524mutp-4O1cqlvbLpg41KWid3FbPQ8Keo8_z';
       // $path = '/var/www/html/sign/Public/signface/'.$media_id.'.jpg';
             $url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token={$this->getToken()}&media_id=$media_id";
             //用curl请求，返回文件资源和curl句柄的信息
             $info = $this->curl_request($url);
             //文件类型
             $types = array('image/bmp'=>'.bmp', 'image/gif'=>'.gif', 'image/jpeg'=>'.jpg', 'image/png'=>'.png');
             //判断响应首部里的的content-type的值是否是这四种图片类型
             // var_dump($url);
             // var_dump($info);
             if (!isset($types[$info[1]['content_type']])) {
                 //文件的uri
                return false;
             }
            
             //将资源写入文件里
             if ($this->saveFile($path, $info[0])) {
                //将文件保存在本地目录
                
                 return $path;
             }else{
                return false;
             }
 
             
 
         }

    private function curl_request($url = '') {
            if ($url == '') return;
            $ch = curl_init();
         //这里返回响应报文时，只要body的内容，其他的都不要
            curl_setopt($ch,CURLOPT_URL,$url);  
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_NOBODY, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
             curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $package = curl_exec($ch);
           //获取curl连接句柄的信息
           $httpInfo = curl_getinfo($ch);
            curl_close($ch);
           // var_dump($package);
           $info = array_merge(array($package), array($httpInfo));
           return $info;

       }

    private function saveFile($path, $fileContent) {
       // var_dump($path);
            $fp = fopen($path, 'w');
            if (false !== $fp) {
               if (false !== fwrite($fp, $fileContent)) {
                  fclose($fp);
                  return true;
              }
             }
             return false;
        }

    public function answerView()
    {
        $act_id = session('act_id');
        //$act_id = 67;
        $question = M('question')->where(array('act_id'=>$act_id))->find();
        $this->question=$question;
        $this->display();
    }

    public function answerHandler()
    {
        $option_select=I('option_select');
        $act_id = session('act_id');
        $stu_id = session('stu_id');
        $res_id = session('res_id');
        $act_id = 67;
        $stu_id = 2;
        $option_right = M('question')->where(array('act_id'=>$act_id))->getField('option_right');
        //exit(json_encode(array('status'=>$option_select)));
        if($option_select == $option_right){
            
           $res = M('activity_res')->where(array('act_id'=>$act_id,'stu_id'=>$stu_id))->save(array('answer_status'=>1));

           if($res){
            exit(json_encode(array('status'=>1)));
           }else{
            $this->unsetSession();
            exit(json_encode(array('status'=>2)));
           }
        } else {
           $res = M('activity_res')->where(array('act_id'=>$act_id,'stu_id'=>$stu_id))->save(array('answer_status'=>-1));
           if($res){
             M('activity_res')->where(array('id'=>$res_id))->setField('sign_status',-1);
            $this->unsetSession();
            exit(json_encode(array('status'=>-1)));
           }else{
            $this->unsetSession();
            exit(json_encode(array('status'=>2)));
           }
        }
        
    }

    public function result(){
        $this->msg = I('msg');
        $this->title=I('title');
        $this->status=I('status');
        var_dump(I('status'));
        $this->display();
    }
    
    public function signTrack()
    {
          $openid =I('get.openid');
        session('openid',$openid);
        $stu_id = M('stu_info')->where(array('openid'=>$openid))->getField('id');
        $list = M('activity')->where(array('stu_id' => $stu_id,'week_status' =>1))->order('id desc')->select();
        foreach ($list as $key => $value) {
            if($value['time_start']>time()){
                unset($list[$key]);
            }
            $list[$key]['sign_status'] = M('activity_res')->where(array('act_id'=>$value['id'],'stu_id'=>$stu_id))->getField('sign_status');
            
        }
        foreach ($list as $key => $value) {
            if($list[$key]['sign_status'] == 1){
                $list[$key]['sign_status']= '签到成功';
            } elseif($list[$key]['sign_status'] == 0){
                $list[$key]['sign_status'] = '未签到';
            }elseif($list[$key]['sign_status'] == -1){
                $list[$key]['sign_status'] = '签到失败';
            }
        }
        $this->list = $list;
        $this->display();
    }
    public function signTrackDetail()
    {

        $act_id =I('id');
        $detail= M('activity_res')->where(array('act_id'=>$act_id))->select();
        $count = M('activity_res')->where(array('act_id'=>$act_id,'sign_status'=>1))->count();
        foreach ($detail as $key => $value) {
            if($value['sign_status'] == 1){
                $value['sign_status']= '签到成功';
            } elseif($value['sign_status'] == 1){
                $value['sign_status'] = '签到失败';
            }elseif($value['sign_status'] == 0){
                $value['sign_status'] = '未签到';
            }
            $stu_info=M('stu_info')->where(array('stu_id'=>$value['stu_id']))->find();
            $detail[$key]['stu_info']=$stu_info;
        }
         
        $this->detail = $detail;
        $this->count = $count;
        $this->display();
    }



}