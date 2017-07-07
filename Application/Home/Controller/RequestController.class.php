<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 处理请求
 * Created by Lane.
 * User: lane
 * Date: 13-12-19
 * Time: 下午11:04
 * Mail: lixuan868686@163.com
 * Website: http://www.lanecn.com
 */

class RequestController extends BaseController{
    /**
     * @descrpition 分发请求
     * @param $request
     * @return array|string
     */
public function checkLogin($request)
{
        $fromusername=$request['fromusername'];
        $temp1 = M('stu_info')->where(array('openid'=>$fromusername))->find();
        $temp2 = M('tec_info')->where(array('openid'=>$fromusername))->find();
        if($temp1 !=false && $temp2 != false){
            exit;
           // if($temp2){
           //      if(time() - $temp2['logintime'] <60*60){
           //          return $this->relogin($request);
           //          //return $this->relogin($request);
           //      }else{
           //          return $this->switchType($request);
           //      }
           //  }
        }elseif($temp1 ==false && $temp2 == false){
           // A('Home/Responsepassive')
            //$request['content']="http://www.baidu.com?openid=$fromusername";
            $items =  A('Home/Responsepassive')->newsItem('用户注册','','__PUBLIC__/2017030218450978323.jpg',"http://www.lyzwnp.com/sign/index.php?c=account&a=add&openid=$fromusername");
            $items=array($items);
            return A('Home/Responsepassive')->news($request['fromusername'],$request['tousername'],$items);

        }else{ 
            if($temp1){
                if(time() - $temp1['logintime'] >60*60){
                    return $this->relogin($request);
                }else{
                    return $this->switchType($request);
                }
            }elseif($temp2){
                if(time() - $temp2['logintime'] >60*60){
                    return $this->relogin($request);
                }else{
                    return $this->switchType($request);
                }
            }else {
                return false;
            }
        }
}
public function relogin($request){
    $items =  A('Home/Responsepassive')->newsItem('重新登录','','__PUBLIC__/2017030218450978323.jpg',"http://www.lyzwnp.com/sign/index.php?c=account&openid={$request['fromusername']}&key={$request['eventkey']}");
            $items=array($items);
            return A('Home/Responsepassive')->news($request['fromusername'],$request['tousername'],$items);
}

    public static function switchType(&$request){
        
            // echo '111';
            switch ($request['msgtype']) {
            //事件
            case 'event':
                $request['event'] = strtolower($request['event']);
                switch ($request['event']) {
                    //关注
                    case 'subscribe':
                        //二维码关注
                        if(isset($request['eventkey']) && isset($request['ticket'])){
                            $data = self::eventQrsceneSubscribe($request);
                        //普通关注
                        }else{
                            $data = self::eventSubscribe($request);
                        }
                        break;
                    //扫描二维码
                    case 'scan':
                        $data = self::eventScan($request);
                        break;
                    //地理位置
                    case 'location':
                        $data = self::eventLocation($request);
                        break;
                    //自定义菜单 - 点击菜单拉取消息时的事件推送
                    case 'click':
                        $data = self::eventClick($request);
                        break;
                    //自定义菜单 - 点击菜单跳转链接时的事件推送
                    case 'view':
                        $data = self::eventView($request);
                        break;
                    //自定义菜单 - 扫码推事件的事件推送
                    case 'scancode_push':
                        $data = self::eventScancodePush($request);
                        break;
                    //自定义菜单 - 扫码推事件且弹出“消息接收中”提示框的事件推送
                    case 'scancode_waitmsg':
                        $data = self::eventScancodeWaitMsg($request);
                        break;
                    //自定义菜单 - 弹出系统拍照发图的事件推送
                    case 'pic_sysphoto':
                        $data = self::eventPicSysPhoto($request);
                        break;
                    //自定义菜单 - 弹出拍照或者相册发图的事件推送
                    case 'pic_photo_or_album':
                        $data = self::eventPicPhotoOrAlbum($request);
                        break;
                    //自定义菜单 - 弹出微信相册发图器的事件推送
                    case 'pic_weixin':
                        $data = self::eventPicWeixin($request);
                        break;
                    //自定义菜单 - 弹出地理位置选择器的事件推送
                    case 'location_select':
                        $data = self::eventLocationSelect($request);
                        break;
                    //取消关注
                    case 'unsubscribe':
                        $data = self::eventUnsubscribe($request);
                        break;
                    //群发接口完成后推送的结果
                    case 'masssendjobfinish':
                        $data = self::eventMassSendJobFinish($request);
                        break;
                    //模板消息完成后推送的结果
                    case 'templatesendjobfinish':
                        $data = self::eventTemplateSendJobFinish($request);
                        break;
             
                }
                break;
            //文本
            case 'text':
                $data = self::text($request);
                break;
            //图像
            case 'image':
                $data = self::image($request);
                break;
            //语音
            case 'voice':
                $data = self::voice($request);
                break;
            //视频
            case 'video':
                $data = self::video($request);
                break;
            //小视频
            case 'shortvideo':
                $data = self::shortvideo($request);
                break;
            //位置
            case 'location':
                $data = self::location($request);
                break;
            //链接
            case 'link':
                $data = self::link($request);
                break;
            default:
                return A('Home/Responsepassive')->text($request['fromusername'], $request['tousername'], '收到未知的消息，我不知道怎么处理');
                break;
            }
        return $data;
        
        
    }


    /**
     * @descrpition 文本
     * @param $request
     * @return array
     */
    public static function text(&$request){
        $res =A('Home/Responsepassive');
        $content = '收到文本消息';
        return $res->text($request['fromusername'], $request['tousername'],$request['fromusername']);
    }

    /**
     * @descrpition 图像
     * @param $request
     * @return array
     */
    public static function image(&$request){
        $content = '收到图片';
        return A('Home/Responsepassive')->text($request['fromusername'], $request['tousername'], $content);
    }

    /**
     * @descrpition 语音
     * @param $request
     * @return array
     */
    public static function voice(&$request){
        if(!isset($request['recognition'])){
            $content = '收到语音';
            return A('Home/Responsepassive')->text($request['fromusername'], $request['tousername'], $content);
        }else{
            $content = '收到语音识别消息，语音识别结果为：'.$request['recognition'];
            return A('Home/Responsepassive')->text($request['fromusername'], $request['tousername'], $content);
        }
    }

    /**
     * @descrpition 视频
     * @param $request
     * @return array
     */
    public static function video(&$request){
        $content = '收到视频';
        return A('Home/Responsepassive')->text($request['fromusername'], $request['tousername'], $content);
    }

    /**
     * @descrpition 视频
     * @param $request
     * @return array
     */
    public static function shortvideo(&$request){
        $content = '收到小视频';
        return A('Home/Responsepassive')->text($request['fromusername'], $request['tousername'], $content);
    }

    /**
     * @descrpition 地理
     * @param $request
     * @return array
     */
    public static function location(&$request){
        $content = '收到上报的地理位置';
        return A('Home/Responsepassive')->text($request['fromusername'], $request['tousername'], $content);
    }

    /**
     * @descrpition 链接
     * @param $request
     * @return array
     */
    public static function link(&$request){
        $content = '收到连接';
        return A('Home/Responsepassive')->text($request['fromusername'], $request['tousername'], $content);
    }

    /**
     * @descrpition 关注
     * @param $request
     * @return array
     */
    public static function eventSubscribe(&$request){
        $content = '欢迎您关注我们的微信，将为您竭诚服务.';
        return A('Home/Responsepassive')->text($request['fromusername'], $request['tousername'], $content);
    }

    /**
     * @descrpition 取消关注
     * @param $request
     * @return array
     */
    public static function eventUnsubscribe(&$request){
        $content = '为什么不理我了？';
        return A('Home/Responsepassive')->text($request['fromusername'], $request['tousername'], $content);
    }

    /**
     * @descrpition 扫描二维码关注（未关注时）
     * @param $request
     * @return array
     */
    public static function eventQrsceneSubscribe(&$request){
        /*
        *用户扫描带参数二维码进行自动分组
        *此处添加此代码是大多数需求是在扫描完带参数二维码之后对用户自动分组
        */
        $sceneid = str_replace("qrscene_","",$request['eventkey']);
        //移动用户到相应分组中去,此处的$sceneid依赖于之前创建时带的参数
        if(!empty($sceneid)){
            UserManage::editUserGroup($request['fromusername'], $sceneid);
            $result=UserManage::getGroupByOpenId($request['fromusername']);
            //方便开发人员调试时查看参数正确性
            $content = '欢迎您关注我们的微信，将为您竭诚服务。二维码Id:'.$result['groupid'];
        }else
            $content = '欢迎您关注我们的微信，将为您竭诚服务。';
        return A('Home/Responsepassive')->text($request['fromusername'], $request['tousername'], $content);
    }

    /**
     * @descrpition 扫描二维码（已关注时）
     * @param $request
     * @return array
     */
    public static function eventScan(&$request){
       
        $act_id = $request['eventkey'];
        $stu_id = M('stu_info')->where(array('openid' => $request['fromusername']))->getField('id');
        // $res = M('activity_res')->where(array('act_id'=>$act_id,'stu_id'=>$stu_id))->setField('code_status',1);
        // if($res){
        //     $this->redirect('Student/sign');
        // }else{
            //return A('Home/Responsepassive')->text($request['fromusername'], $request['tousername'], $act_id);
        // }
        // if($act_id){
        //      $this->redirect('Student/sign',array('act_id'=>$act_id,'stu_id'=>$stu_id));
        //  }else{
        //     $this->error('no eventkey');
        // }
return A('Home/Responsepassive')->text($request['fromusername'], $request['tousername'], $act_id);
    }

    /**
     * @descrpition 上报地理位置
     * @param $request
     * @return array
     */
    public static function eventLocation(&$request){
        $content ='纬度'.$request['event'].$request['latitude'] .'经度' .$request['longitude'] ;
        $data =array('latitude'=>$request['latitude'],'longitude'=>$request['longitude']);
        $res1 = M('stu_info')->where(array('openid'=>$request['fromusername']))->save($data);
        $res2 = M('tec_info')->where(array('openid'=>$request['fromusername']))->save($data);
       //return A('Home/Responsepassive')->text($request['fromusername'], $request['tousername'], $res1.$content);
        if($res1 || $res2){
            // return A('Home/Responsepassive')->text($request['fromusername'], $request['tousername'], $content);
        }
        
    }

    /**
     * @descrpition 自定义菜单 - 点击菜单拉取消息时的事件推送
     * @param $request
     * @return array
     */
    public static function eventClick(&$request){
        //获取该分类的信息
        $eventKey = $request['eventkey'];
        //return A('Home/Responsepassive')->text($request['fromusername'], $request['tousername'], $eventKey);
        // $content = '收到点击菜单事件，您设置的key是' . $eventKey;
        // return A('Home/Responsepassive')->text($request['fromusername'], $request['tousername'], $content);
        $fromusername=$request['fromusername'];
        switch ($eventKey) {
            case 'tec_pushToStudent':
                $items =  A('Home/Responsepassive')->newsItem('推送消息给学生','','www.lyzwnp.com/Public/2017030218450978323.jpg',"http://www.lyzwnp.com/sign/index.php?c=teacher&a=pushToStudent&openid=$fromusername");
                $items=array($items);
                return A('Home/Responsepassive')->news($request['fromusername'],$request['tousername'],$items);
                break;
            case 'tec_bindClass':
                $items =  A('Home/Responsepassive')->newsItem('绑定班级','','__PUBLIC__/2017030218450978323.jpg',"http://www.lyzwnp.com/sign/index.php?c=teacher&a=bindClass&openid=$fromusername");
                $items=array($items);
                return A('Home/Responsepassive')->news($request['fromusername'],$request['tousername'],$items);
                break;
            case 'tec_signWay':
                $items =  A('Home/Responsepassive')->newsItem('签到方式','','__PUBLIC__/2017030218450978323.jpg',"http://www.lyzwnp.com/sign/index.php?c=teacher&a=signWay&openid=$fromusername");
                $items=array($items);
                return A('Home/Responsepassive')->news($request['fromusername'],$request['tousername'],$items);
                break;
            case 'tec_tempActList':
                $item1 =  A('Home/Responsepassive')->newsItem('临时签到活动列表','','__PUBLIC__/2017030218450978323.jpg',"http://www.lyzwnp.com/sign/index.php?c=activity&a=tempActList&openid=$fromusername");
                $item2 =  A('Home/Responsepassive')->newsItem('日常签到活动列表','','__PUBLIC__/2017030218450978323.jpg',"http://www.lyzwnp.com/sign/index.php?c=activity&a=dailyActList&openid=$fromusername");
                $items=array($item1,$item2);
                return A('Home/Responsepassive')->news($request['fromusername'],$request['tousername'],$items);
                break; 
            case 'tec_signTrack':
                $items =  A('Home/Responsepassive')->newsItem('签到记录','','__PUBLIC__/2017030218450978323.jpg',"http://www.lyzwnp.com/sign/index.php?c=teacher&a=signTrack&openid=$fromusername");
                $items=array($items);
                return A('Home/Responsepassive')->news($request['fromusername'],$request['tousername'],$items);
                break;  
            case 'stu_signTrack':
                $items =  A('Home/Responsepassive')->newsItem('签到记录','','__PUBLIC__/2017030218450978323.jpg',"http://www.lyzwnp.com/sign/index.php?c=student&a=signTrack&openid=$fromusername");
                $items=array($items);
                return A('Home/Responsepassive')->news($request['fromusername'],$request['tousername'],$items);
           // return A('Home/Responsepassive')->text($request['fromusername'], $request['tousername'], '111');
                break;     
            case 'stu_face':
                $items =  A('Home/Responsepassive')->newsItem('点击录入人脸信息','','__PUBLIC__/2017030218450978323.jpg',"http://www.lyzwnp.com/sign/index.php?c=student&a=faceInput&openid=$fromusername");
                $items=array($items);
                return A('Home/Responsepassive')->news($request['fromusername'],$request['tousername'],$items);
                break;
            case 'stu_sign':

                $act_id = 67;
               $stu_id = M('stu_info')->where(array('openid'=>$fromusername))->getField('id');
               // $classid = M('stu_info')->where(array('openid'=>$fromusername))->getField('classid');
               // $map['time_start'] = array('GT',time());
               // $map['time_end'] = array('LT',time());
               //  $acts = M('activity')->where($map)->select();
               //  foreach ($acts as $key => $value) {
               //      if(in_array($classid, unserialize($value['classids']))){
               //          $act_id = $value['id'];
               //      }
               //  }

              
                $items =  A('Home/Responsepassive')->newsItem('须签到的课堂','','__PUBLIC__/2017030218450978323.jpg',"http://www.lyzwnp.com/sign/index.php?c=student&a=sign&openid=$fromusername&act_id=$act_id&stu_id=$stu_id");
                $items=array($items);
                return A('Home/Responsepassive')->news($request['fromusername'],$request['tousername'],$items);
                //return A('Home/Responsepassive')->text($request['fromusername'], $request['tousername'], $stu_id);
                break;    
            default:
                # code...
                break;
        }
    }

    /**
     * @descrpition 自定义菜单 - 点击菜单跳转链接时的事件推送
     * @param $request
     * @return array
     */
    public static function eventView(&$request){
        //获取该分类的信息
        $eventKey = $request['eventkey'];
        $content = '收到跳转链接事件，您设置的key是' . $eventKey;
        return A('Home/Responsepassive')->text($request['fromusername'], $request['tousername'], $content);
    }

    /**
     * @descrpition 自定义菜单 - 扫码推事件的事件推送
     * @param $request
     * @return array
     */
    public static function eventScancodePush(&$request){
        //获取该分类的信息
        $eventKey = $request['eventkey'];
        $content = '收到扫码推事件的事件，您设置的key是' . $eventKey;
        $content .= '。扫描信息：'.$request['scancodeinfo'];
        $content .= '。扫描类型(一般是qrcode)：'.$request['scantype'];
        $content .= '。扫描结果(二维码对应的字符串信息)：'.$request['scanresult'];
        return A('Home/Responsepassive')->text($request['fromusername'], $request['tousername'], $content);
    }

    /**
     * @descrpition 自定义菜单 - 扫码推事件且弹出“消息接收中”提示框的事件推送
     * @param $request
     * @return array
     */
    public static function eventScancodeWaitMsg(&$request){
        //获取该分类的信息
        $eventKey = $request['eventkey'];
        $content = '收到扫码推事件且弹出“消息接收中”提示框的事件，您设置的key是' . $eventKey;
        $content .= '。扫描信息：'.$request['scancodeinfo'];
        $content .= '。扫描类型(一般是qrcode)：'.$request['scantype'];
        $content .= '。扫描结果(二维码对应的字符串信息)：'.$request['scanresult'];
        return A('Home/Responsepassive')->text($request['fromusername'], $request['tousername'], $content);
    }

    /**
     * @descrpition 自定义菜单 - 弹出系统拍照发图的事件推送
     * @param $request
     * @return array
     */
    public static function eventPicSysPhoto(&$request){
        //获取该分类的信息
        $eventKey = $request['eventkey'];
        $content = '收到弹出系统拍照发图的事件，您设置的key是' . $eventKey;
        $content .= '。发送的图片信息：'.$request['sendpicsinfo'];
        $content .= '。发送的图片数量：'.$request['count'];
        $content .= '。图片列表：'.$request['piclist'];
        $content .= '。图片的MD5值，开发者若需要，可用于验证接收到图片：'.$request['picmd5sum'];
        return A('Home/Responsepassive')->text($request['fromusername'], $request['tousername'], $content);
    }

    /**
     * @descrpition 自定义菜单 - 弹出拍照或者相册发图的事件推送
     * @param $request
     * @return array
     */
    public static function eventPicPhotoOrAlbum(&$request){
        //获取该分类的信息
        $eventKey = $request['eventkey'];
        $content = '收到弹出拍照或者相册发图的事件，您设置的key是' . $eventKey;
        $content .= '。发送的图片信息：'.$request['sendpicsinfo'];
        $content .= '。发送的图片数量：'.$request['count'];
        $content .= '。图片列表：'.$request['piclist'];
        $content .= '。图片的MD5值，开发者若需要，可用于验证接收到图片：'.$request['picmd5sum'];
        return A('Home/Responsepassive')->text($request['fromusername'], $request['tousername'], $content);
    }

    /**
     * @descrpition 自定义菜单 - 弹出微信相册发图器的事件推送
     * @param $request
     * @return array
     */
    public static function eventPicWeixin(&$request){
        //获取该分类的信息
        $eventKey = $request['eventkey'];
        $content = '收到弹出微信相册发图器的事件，您设置的key是' . $eventKey;
        $content .= '。发送的图片信息：'.$request['sendpicsinfo'];
        $content .= '。发送的图片数量：'.$request['count'];
        $content .= '。图片列表：'.$request['piclist'];
        $content .= '。图片的MD5值，开发者若需要，可用于验证接收到图片：'.$request['picmd5sum'];
        return A('Home/Responsepassive')->text($request['fromusername'], $request['tousername'], $content);
    }

    /**
     * @descrpition 自定义菜单 - 弹出地理位置选择器的事件推送
     * @param $request
     * @return array
     */
    public static function eventLocationSelect(&$request){
        //获取该分类的信息
        $eventKey = $request['eventkey'];
        $content = '收到点击跳转事件，您设置的key是' . $eventKey;
        $content .= '。发送的位置信息：'.$request['sendlocationinfo'];
        $content .= '。X坐标信息：'.$request['location_x'];
        $content .= '。Y坐标信息：'.$request['location_y'];
        $content .= '。精度(可理解为精度或者比例尺、越精细的话 scale越高)：'.$request['scale'];
        $content .= '。地理位置的字符串信息：'.$request['label'];
        $content .= '。朋友圈POI的名字，可能为空：'.$request['poiname'];
        return A('Home/Responsepassive')->text($request['fromusername'], $request['tousername'], $content);
    }

    /**
     * 群发接口完成后推送的结果
     *
     * 本消息有公众号群发助手的微信号“mphelper”推送的消息
     * @param $request
     */
    public static function eventMassSendJobFinish(&$request){
        //发送状态，为“send success”或“send fail”或“err(num)”。但send success时，也有可能因用户拒收公众号的消息、系统错误等原因造成少量用户接收失败。err(num)是审核失败的具体原因，可能的情况如下：err(10001), //涉嫌广告 err(20001), //涉嫌政治 err(20004), //涉嫌社会 err(20002), //涉嫌色情 err(20006), //涉嫌违法犯罪 err(20008), //涉嫌欺诈 err(20013), //涉嫌版权 err(22000), //涉嫌互推(互相宣传) err(21000), //涉嫌其他
        $status = $request['status'];
        //计划发送的总粉丝数。group_id下粉丝数；或者openid_list中的粉丝数
        $totalCount = $request['totalcount'];
        //过滤（过滤是指特定地区、性别的过滤、用户设置拒收的过滤，用户接收已超4条的过滤）后，准备发送的粉丝数，原则上，FilterCount = SentCount + ErrorCount
        $filterCount = $request['filtercount'];
        //发送成功的粉丝数
        $sentCount = $request['sentcount'];
        //发送失败的粉丝数
        $errorCount = $request['errorcount'];
        $content = '发送完成，状态是'.$status.'。计划发送总粉丝数为'.$totalCount.'。发送成功'.$sentCount.'人，发送失败'.$errorCount.'人。';
        return A('Home/Responsepassive')->text($request['fromusername'], $request['tousername'], $content);
    }

    /**
     * 群发接口完成后推送的结果
     *
     * 本消息有公众号群发助手的微信号“mphelper”推送的消息
     * @param $request
     */
    public static function eventTemplateSendJobFinish(&$request){
        //发送状态，成功success，用户拒收failed:user block，其他原因发送失败failed: system failed
        $status = $request['status'];
        if($status == 'success'){
            //发送成功
        }else if($status == 'failed:user block'){
            //因为用户拒收而发送失败
        }else if($status == 'failed: system failed'){
            //其他原因发送失败
        }
        return true;
    }


    public function test(){
      return mkdir('/var/www/html/sign/aaa/');
    }

}
