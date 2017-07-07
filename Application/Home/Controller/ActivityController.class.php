<?php
namespace Home\Controller;
use Think\Controller;
class ActivityController extends BaseController {


    public function index(){
        // $uid = I('post.uid');
        // $cart= I('post.cart');
        session('openid',I('openid'));
        $this->display();
        // $username = I('post.username');
        // $pwd = I('post.pwd');
        // I('post.cart')=='student'?$cart='student':$cart='teacher';

    }

    public function dailyActList()
    {
        $openid =I('openid');
        $list = M('activity')->where(array('openid' => $openid,'week_status' =>0))->select();


        $this->list = $list;
        $this->display(); 
    }

    
    public function tempActList()
    {
        $openid =I('get.openid');
        session('openid',$openid);
        $tec_id = M('tec_info')->where(array('openid'=>$openid))->getField('id');
        $list = M('activity')->where(array('tec_id' => $tec_id,'week_status' =>1))->order('id desc')->select();
        var_dump($openid);
        $this->list = $list;

        $this->display(); 
    }

    public function dailyActDetail()
    {
        $detail = M('activity') ->where(array('id'=>I('id')))->find();
        $this->detail=$detail;
        $this->display();   
    }

  
    public function tempActDetail()
    {   
        $id =I('get.id');
        $detail = M('activity') ->where(array('id'=>I('id')))->find();
        $codeUrl = '/sign/Public/qrcode/'."{$id}".'.jpg';

        $openid=session('openid');
        $classids = M('tec_info')->where(array('openid'=>$openid))->getField('classids');
        $class =$this->getClassInfo($classids);
        

        $select_classids=M('activity')->where(array('id'=>$id))->getField('classids');
        $select_class =$this->getClassInfo($select_classids);

        foreach ($select_class as $key => $value) {
            foreach ($class as $m=> $n) {
                if($value['id'] == $n['id']){
                    $class[$m]['check']='checked';
                }
            }
        }
        var_dump($class);
        $time=$this->getTime($detail['time_start'],$detail['time_end']);
        var_dump($detail);
        $this->time = $time;
        $this->select_class = $select_class;
        $this->class = $class;
        $this->detail=$detail;
        $this->codeUrl=$codeUrl;
        $this->display();
    }

    public function getTime($start,$end)
    {
        $time = array();
        $time['month'] = $this->removeFirst(date('m',$start));
       
        $time['day'] = $this->removeFirst(date('d',$start));
          $time['h_start']=$this->removeFirst(date('H',$start));
        $time['m_start']=$this->removeFirst(date('i',$start));
        $time['h_end']=$this->removeFirst(date('H',$end));
        $time['m_end']=$this->removeFirst(date('i',$end));
        return $time;
    }
    public function removeFirst($str)
    {
        if(substr($str, 0,1) == '0'){
            $str=substr($str, 1);
        }
        return $str;
    }

    public function addActView()
    {
        $this->display();
    }
    public function addAct()
    {
        $openid=session('openid');
    $classids = M('tec_info')->where(array('openid'=>$openid))->getField('classids');

        $class =$this->getClassInfo($classids);
        $this->class = $class;
        $this->display();
    }

    public function doAddAct()
    {
        $openid = session('openid');
        $week_status = I('week_status',1);
        $tec_id = M('tec_info')->where(array('openid' => $openid))->getField('id');
        $tec_name = M('tec_info')->where(array('openid' => $openid))->getField('realname');
        $classids = serialize(array_keys($_POST,'on'));

        var_dump($_POST);
        $start_time = mktime(I('h_start'), I('m_start'), 0, I('month'), I('day') ,2017);
        $end_time = mktime(I('h_end'), I('m_end'), 0, I('month'), I('day') ,2017);
        $data = array(
            'classids' => $classids,
            'time_start' => $start_time,
            'time_end'=>  $end_time,
            'tec_id' => $tec_id,
            'tec_name'=>$tec_name,
            'classroom'=>I('classroom'),
            'course_name'=>I('course_name'),
        );
        var_dump($data);
        if($week_status === 1){
            $data = array_merge($data,array('week_status'=>$week_status,'week_num' => I('week_num'),'week_day'=>I('week_day')));
        }
        $act_id =M('activity')->add($data);
        if($act_id){
            $ticket = A('Pop')->createTicket(2,100000,$act_id);
            $flag1 = A('Pop')->getQrcode($ticket['ticket'],$act_id);
           // $str = str_replace(array("",),"",$ticket['url']);
            $flag2 = M('activity')->where(array('id'=>$act_id))->save(array('code_url'=>$ticket['url']));

            if($flag1 && $flag2){
                $this->success('添加成功',U('tempActDetail',array('id'=>$act_id)),40);
            }else{
                $this->error('保存二维码失败');
            }
        }else{
            $this->error('添加失败');
        }
    }

    public function modifyAct()
    {
        $classids = serialize(array_keys($_POST,'on'));
        $week_status = I('week_status');
        $id = I('get.id');
        $start_time = mktime(I('h_start'), I('m_start'), 0, I('month'), I('day') ,2017);

        $end_time = mktime(I('h_end'), I('m_end'), 0, I('month'), I('day') ,2017);

        $data = array(
            'classids' => $classids,
            'time_start' => $start_time,
            'time_end'=> $end_time,
            'classroom'=>I('classroom'),
            'course_name'=>I('course_name'),
        );

        $res = M('activity')->where(array('id' =>$id))->save($data);
      
        if($res){
            $this->success('修改成功',U('tempActDetail',array('id'=>$id)));
        }else{
            $this->error('修改失败',U('tempActDetail',array('id'=>$id)));
        }
    }
    public function deleteAct()
    {
        $id = I('id');
        $openid = session('openid');

        $res = M('activity')->where(array('id'=>$id))->delete();

        if($res){
            $this->success('删除成功',U('tempActList'));
        }else{
            $this->error('删除失败');
        }
    }


    

}