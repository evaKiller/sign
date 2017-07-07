<?php
namespace Home\Controller;
use Think\Controller;
class TeacherController extends BaseController {
    public function index(){
      
    }

    public function createActivity()
    {

    }

    public function modifyActivity()
    {

    }
    public function deleteActivity()
    {

    }

    public function setSignWay()
    {

    }

    public function setSchedule()
    {
        
    }

   // public function
   
    public function pushToStudent()
    {
        $class = array();
        session('openid',I('openid'));
        $classids = M('tec_info')->where(array('openid'=>I('openid')))->getField('classids');
         
        $class =$this->getClassInfo($classids);
        $this->class = $class;
        var_dump($class);
        $this->display();
    }

    public function pushToStudentHandler()
    {
        $openid=session('openid');
        $title = I('title');
        $content = I('content');
        $classids = array_keys($_POST,'on');
        $openids = array();
        foreach ($classids as $key => $value) {
            $temp =M('stu_info')->where(array('classid'=>$value))->getField('openid',true);
            $temp == false ?$temp = array():$temp =$temp;
            $openids=array_merge($openids,$temp);
        }
        $tec_name = M('tec_info')->where(array('openid'=>$openid))->getField('realname');
        $content = $tec_name.'老师通知你...'.$title.':'.$content;
        $res = $this->pushByClassid($content,$openids);
        var_dump($res);
        if($res['errcode']===0){
            $this->success();
        }
        //var_dump($res);

    }

    public function pushByTime()
{

    
    $map['time_start']=array('LT',time()-60*5);
    $res = M('activity')->where($map)->select();
    $openids=array();
    foreach ($res as $key => $value) {
        $classids = unserialize($value['classids']);
        $openids_temp = array();
        foreach ($classids as $k => $v) {
            $openid_temp = M('tec_info')->where(array('classid'=>$v))->getField('openid');
            $openids_temp=array_merge($openids_temp,$openid_temp);
        }
        $openids =array_merge($openids,$openids_temp);
    }
    $content = "你即将有需要签到的课程哟，";
    $flag = $this->pushByClassid($content,$openids);
    // if($flag['errcode'!==0]){
    //     $this->success();
    // }
   
}

    public function bindClass()
    {   
        $openid = I('openid');
        var_dump($openid);

        $classids =M('tec_info')->where(array('openid'=>$openid))->getField('classids');

        $classids=unserialize($classids);

        $list =array();
        foreach ($classids as $key => $value) {
            $class= M('info_class')->where(array('id'=>$value))->find();
            //var_dump($class);
            $list=array_merge($list,array($class));

        }
        var_dump($classids);
        var_dump($list);
        $this->list=$list;
       $this->openid =$openid;
       session('openid',$openid);
       

        $this->display();


 }
    public function addClass()
    {
        
        $openid = session('openid');
        $data=array(
            'grade'=>I('grade'),
            'major'=>I('major'),
            'num'=>I('num')
        );

        $class_id = M('info_class')->where($data)->getField('id');
var_dump($class_id);
var_dump(json_encode(array($class_id)));
        if($class_id){
            $classids=M('tec_info')->where(array('openid'=>$openid))->getField('classids');
            var_dump($classids);
            if($classids == null){
                $res = M('tec_info')->where(array('openid'=>$openid))->setField('classids',serialize(array($class_id)));
            }else{
                if(in_array($class_id, unserialize($classids))){
                    $this->error('你已添加过改班级请勿重复添加');
                }
                $temp = array_merge(unserialize($classids),array($class_id));
                $newClassids = serialize($temp);
                $res = M('tec_info')->where(array('openid'=>$openid))->setField('classids',$newClassids);
            }
            
            if($res){
              $this->success('增加成功',U('bindClass'));  
          }else{
            $this->error('增加失败1');
          }
            
        }else{
            $this->error('增加失败2');
        }
    }

    public function classDetail()
    {
        $classid = I('id');
        $students = M('stu_info')->where(array('classid'=>$classid))->select();
        $this->students=$students;
       // var_dump($students);
        $this->display();
    }

    public function stuInfo()
    {
        $id = I('id');
        $info = M('stu_info')->where(array('id'=>$id))->find();
        var_dump($info);
        $this->info = $info;
        $this->display();
    }
    public function deleteClass()
    {
        $classid =I('classid');
        $openid=session('openid');
        $classids=M('tec_info')->where(array('openid'=>$openid))->getField('classids');

        if(in_array($classid, $classids)){
            $newClassids = array_merge(array_diff($classids, array($classid)));
            $res = M('tec_info')->where(array('openid'=>$openid))->setField('classids',$newClassids);
            if($res){
                return json_encode(array('status'=>0,'msg'=>'ok'));
            }else{
                return json_encode(array('status'=>1,'msg'=>'database handle wrong'));
            }
        }else{
            return json_encode(array('status'=>1,'msg'=>'wrong classid'));
        }
    }

    public function signWay()
    {
        session('openid',I('openid'));
        $tec_id = $this->getIdByOpenid(I('openid'));
        $way = M('activity_way')->where(array('tec_id'=>$tec_id))->find();
       
        $way['code_status'] == 0? $way['code_status'] ="":$way['code_status']='checked';
        $way['face_status'] == 0? $way['face_status'] ="":$way['face_status']='checked';
        $way['answer_status'] == 0? $way['answer_status'] =false:$way['answer_status']='checked';
        $way['local_status'] == 0? $way['local_status'] ="":$way['local_status']='checked'; 
        $this->way=$way;

        $this->display();
    }

    public function saveSignWay()
    {
        $changeWay=I('way');
        $openid = session('openid');
        $tec_id = $this->getIdByOpenid($openid);
        $temp = M('activity_way')->where(array('tec_id'=>$tec_id))->getField($changeWay.'_status');
        $temp == 0 ? $temp = 1 :$temp = 0;
        $res = M('activity_way')->where(array('tec_id'=>$tec_id))->setField($changeWay.'_status',$temp);
        if($res){
             $this->ajaxReturn(array('status'=>1));
        }
       
    }

    public function getIdByOpenid($openid)
    {
        $res = M('tec_info')->where(array('openid'=>$openid))->getField('id');
        return $res;
    }

    public function signTrack()
    {
          $openid =I('get.openid');
        session('openid',$openid);
        $tec_id = M('tec_info')->where(array('openid'=>$openid))->getField('id');
        $list = M('activity')->where(array('tec_id' => $tec_id,'week_status' =>1))->order('id desc')->select();

        $this->list = $list;
        var_dump($list);
        $this->display();
    }

    public function addQues()
    {   

        $tec_id=session('tec_id');
        $list = M('activity')->where(array('tec_id' => $tec_id,'week_status' =>1))->order('id desc')->select();
        $this->list = $list;

        $this->display();
    }

    public function quesList()
    {
        $openid = I('openid');
        $tec_id = M('tec_info')->where(array('openid'=>$openid))->getField('id');
        session('tec_id',$tec_id);
        
        $list = M('question')->where(array('tec_id'=>$tec_id))->select();
        $this->list = $list;
        $this->display();
    }

    public function addQuesHandler()
    {
       // var_dump($_POST);
        $tec_id = session('tec_id');
        $data['title'] = I('title');
        $data['act_id']=I('act_id');
        $data['content']=I('content');
        $data['optiona']=I('optiona');
        $data['optionb']=I('optionb');
        $data['optionc']=I('optionc');
        $data['optiond']=I('optiond');
        $data['option_right']=I('option_right');
        if(I('get.ques_id')){
            $res = M('question')->where(array('id'=>I('get.ques_id')))->save($data);
        }else{
             $res = M('question')->add($data);
        }
        var_dump(I('get.ques_id'));
       //var_dump($res);
        if($res){
            $this->success('操作成功');
        }else{
            $this->error('出错了');
        }
    }

    public function quesDetail()
    {
        $ques_id=I('id');
        $tec_id = session('tec_id');
        var_dump($tec_id);
        $question=M('question')->where(array('id'=>$ques_id))->find();
          $list = M('activity')->where(array('tec_id' => $tec_id,'week_status' =>1))->order('id desc')->select();
        $this->list = $list;
        $this->question=$question;
        var_dump($question);

        $this->display();
    }

    public function signTrackDetail()
    {

        $act_id =I('id');
        $detail= M('activity_res')->where(array('act_id'=>$act_id))->select();
        $count = M('activity_res')->where(array('act_id'=>$act_id,'sign_status'=>1))->count();
        foreach ($detail as $key => $value) {
            if($value['sign_status'] == 1){
                $detail[$key]['sign_status']= '签到成功';
            } elseif($value['sign_status'] == 1){
                $detail[$key]['sign_status'] = '签到失败';
            }elseif($value['sign_status'] == 0){
                $detail[$key]['sign_status'] = '未签到';
            }
            $stu_info=M('stu_info')->where(array('stu_id'=>$value['stu_id']))->find();
            $detail[$key]['stu_info']=$stu_info;
        }
         
        $this->detail = $detail;
        $this->count = $count;
        var_dump($detail);
        $this->display();
    }

}