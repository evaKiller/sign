<?php
namespace Home\Controller;
use Think\Controller;
class AccountController extends BaseController {


    public function index(){
        // $uid = I('post.uid');
        // $cart= I('post.cart');
        $key = I('key','');
        $this->key=$key;
        session('openid',I('openid'));
        $this->display();
        // $username = I('post.username');
        // $pwd = I('post.pwd');
        // I('post.cart')=='student'?$cart='student':$cart='teacher';

    }

    
    /**
     * Match email.
     *
     * @param string $email Email.
     *
     * @return boolean
     */
    public static function isMail($email)
    {
        $pattern = "/([a-z0-9]*[-_\.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?/i";
        preg_match_all($pattern, $email, $emailArr);
        if (empty($emailArr[0][0])) {
            return false;
        }
        return true;
    }

    public function initBehavior(){

    }
    public function checkIsLogin($temp1,$temp2)
    {
       
        if($temp1){
            if(time() - $temp1['logintime'] <60*60){
                return 'relogin';
            }else{
                return true;
            }
        }elseif($temp2){
            if(time() - $temp2['logintime'] <60*60){
                return 'relogin';
            }else{
                return true;
            }
        }else {
            return false;
        }
    }
    public function login()
    {
        $code=I('verifyCode');
         $key = I('key');
        $route=explode('_', $key);

            //var_dump($controller);
       if(!$this->check_verify($code,''))
        {
            $this->error('验证码错误');
        }
        $username = I('post.username');
        $pwd = md5(I('post.pwd'));
        I('post.cart')=='student'?$cate='student':$cate='techer';
       
        $db_prex=substr($cate,0,3).'_';
        
        $condition['email'] = $username;
        $condition['username'] = $username;
        $condition['_logic'] = 'OR';
        $user=M($db_prex.'info');


        $res=$user->where($condition)->find();
        var_dump($res);
        if(!$res||$res['pwd']!=$pwd){
            $this->error('用户名或密码错误','',100);
        } else {
            session('id',$res['id'],3600);
            session('prex',$db_prex,3600);
            session('username',$data['username'],3600);
            session('realname',$data['realname'],3600);
            $this->loginTrack();
            if($route[0]=='stu'){
                $controller = 'Student';
            }elseif($route[0]=='tec_'){
                $controller= 'Teacher';
            }
            $action=$route[1];
            $this->redirect("Home/$controller/$action");
        }
    }
    public function add()
    {
        var_dump(I('openid'));
        $this->openid=I('openid');
        $this->display('add');
    }

    public function doAdd()
    {   
        $code=I('verifyCode');
        var_dump($code);
        if(!$this->check_verify($code,''))
        {
            $this->error('验证码错误');
        }
        $isMail=$this->isMail(I('email'));
        
        $data=array(
            'username'=>I('username'),
            'pwd'=>md5(I('pwd')),//md5(I(passowrd));
            'email'=>I('email'),
            'realname'=>I('realname'),
            'openid'=>session('openid'),
            'logintime'=>time()
        );
        
        $catePrex=I('cart');
        if($catePrex == 'stu_'){
            $data =array_merge($data,array('schoolnum'=>I('schoolnum')));
            $issetMail=M('stu_info')->where(array('email'=>I('email')))->find();
        }elseif($catePrex=='tec_'){
            $issetMail=M('tec_info')->where(array('email'=>I('email')))->find();
        }

        if(!$isMail){
            $this->error('邮箱格式不正确');
        }elseif($issetMail){
            $this->error('该邮箱已被注册');
        }
        $table=M($catePrex.'info');
        if($table->where(array('username'=>I('schoolnum')))->find())
        {
            $this->error('该用户名不可用')->display();
        } elseif (I('password')!=I('repassword')) {
            $this->error('密码不一致')->display();
        } elseif ($catePrex == 'stu_' && $table->where(array('schoolnum'=>I('schoolnum')))->find()) {
            $this->error('该学号已被注册，请联系任课教师');
        }
        
var_dump($data);
     $table->startTrans();
    if(!in_array('', $data)){
    if($id=$table->add($data))
    {   
        $table->commit();
        session('id',$data['id'],3600);
        session('prex',$catePrex,3600);
        session('username',$data['username']);
        session('realname',$data['realname']);
        $this->loginTrack();
        // if($catePrex == 'tec_'){
        //     $data=array('tec_id' => $id);
        //     $flag = M('tec_info')->add($data);
        // }
        if($catePrex == 'tec_'){
             $this->redirect('Home/Teacher/signWay',array('openid'=>session('openid')),3,'注册成功');
        }elseif($catePrex == 'stu_'){
            $this->redirect('Home/Student/faceInput',array('openid'=>session('openid')),3,'注册成功,请录入人脸信息');
        }
       
      
    }
    else{
        $table->rollback();
        $this->error('注册失败')->display();
       
    }
}else{
    $this->error('有空值')->display();
}
    }

    public function bindClass()
    {
        
    }

    public function resetAccount()
    {

    }
    public function deleletAccount()
    {

    }
    public function confirmStudent()
    {

    }
    public function loginTrack()
    {

    }

}