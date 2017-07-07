<?php
namespace Home\Controller;
use Think\Controller;
class CronController {
    public function index()
{

    
    $map['time_start']=array('GT',time()-60*10);
    $res = M('activity')->where($map)->select();
    $openids=array();
    foreach ($res as $key => $value) {
        $classids = unserialize($value['classids']);
        $openids_temp = array();
        foreach ($classids as $k => $v) {
            $openid_temp = M('stu_info')->where(array('classid'=>$v))->getField('openid',true);
            $openids_temp=array_merge($openids_temp,array($openid_temp));
        }
        $openids =array_merge($openids,$openids_temp);
    }
    $content = "你即将有需要签到的课程哟，";
    $flag = A('Teacher')->pushByClassid($content,$openids);
    // var_dump($flag);
    // var_dump($openids);
    // var_dump($res);
    // if($flag['errcode'!==0]){
    //     $this->success();
    // }
   
}
    
}