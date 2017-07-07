<?php

/**
 *Author:duxingfeng;
 *Email:425100867@qq.com;
 *Opinion:邮箱找回密码
 *Date:2015-8-25  15:00;
 */
namespace Home\Controller;

use Think\Controller;

class EmailController extends Controller {
    public function index() {
        $this->display ();
    }
    public function findpwd() {

        $map ['email'] = $_POST ['email'];

        $info1 = M ('stu_info' )->where ( $map )->find ();
        $info2 = M ('tec_info' )->where ( $map )->find ();
        if($info1 == false){
            $info=$info2;
            $prex='tec_';
        }else{
            $info=$info1;
            $prex='stu_';
        }

        if ($info) {
            ////$this->success ( '发送成功...', U ( 'Email/email' ), 2 );
            $key = md5 ( $info ['username'] . '+' . $info ['pwd'] ); // MD5不可逆，验证$string中username，防止URL更改username
            $string = base64_encode ( $info ['username'] . '+' . $key ); // 加密，可解密
            $time = time ();
            $code=md5 ( 'mytime'.$time );
                                                                         
            // 生成URL
            
            $findpwd = $_SERVER ['HTTP_HOST'] . U ('Email/editpwd') . '&key=' . $key . '&info=' . $string . '&time='.$time.'&code=' .$code.'&prex='.$prex; // code是用来检验time是否有修改过
             // $findpwd = '<a>'.$_SERVER ['HTTP_HOST'] . U ('Email/editpwd') . '&key=' . $key . '&info=' . $string . '&time='.$time.'&code=' .$code.'&prex='.$prex.'</a>'; // code是用来检验time是否有修改过
                                                                                                                                                               
            // 调用发送邮件函数
            $username = $info ['username'];
            $title="找回密码";
            
            $content="<h3>亲爱的：$username 用户:请点击以下链接修改密码</h3>
            <br><br>http://$findpwd 
            <br><br><br><h4>有效期30分钟</h4>
            <br><br>
            <img src='http://www.huabian.com/uploadfile/2014/0716/20140716101245193.jpg'>";
            
            $from="15501849085@163.com"; //修改为你的发送邮箱
            $to=$info ['email'];
            
            $status = send_mail ( $title,$content,$from,$to );


            if($status==1){
                $this->success ( '发送邮件成功...', U ( 'Email/email' ), 2 );
            }else{
                $this->error ( '发送邮件失败...');
                exit ();
            }
            
        } else {
            $this->error ( '此邮箱未注册' );
            exit ();
        }
    }
    public function editpwd() {
        
            $_SESSION ['emailpwd'] = array (
                    'key'  => trim($_GET ['key']),
                    'info' => trim($_GET ['info']),
                    'code' => trim($_GET ['code']),
                    'time' => trim($_GET ['time']),
                    'prex' => trim($_GET ['prex'])
            );
            
        $this->display ('editpwd');
    }
    public function doeditpwd() {
     
  
        $str = base64_decode ( $_SESSION ['emailpwd'] ['info'] );
    
        $arr = explode ( '+', $str );
        $user ['username'] = $arr [0];
        $prex=$_SESSION ['emailpwd'] ['prex'];
        $reinfo = M ($prex.'info' )->where ( $user )->find ();
        
        // 判断是否在有效期，这里用时间戳判断，还可以用SESSION有效期判断,这里设置为30分钟
        $retime = time ();
        if (($_SESSION ['emailpwd'] ['code'] == md5 ( 'mytime' . $_SESSION ['emailpwd'] ['time'] )) && ((($_SESSION ['emailpwd'] ['time']) + (60 * 30)) >= $retime)) {
            
            if (md5 ( $reinfo ['username'] . '+' . $reinfo ['pwd'] ) == $_SESSION ['emailpwd'] ['key']) { // 判断URL传输中username是否更改
                
                $upid ['id'] = $reinfo ['id'];
                $username = $reinfo ['username'];
                
                if ($_POST ['user_password'] == $_POST ['reuser_password'] && $_POST ['user_password'] != '') {
                    
                    //$data ['salt'] = rand ( 10000, 99999 );
                    $data ['pwd'] = md5 ( trim ( $_POST ['reuser_password'] ) );
                    $edit = M ( $prex.'info' )->where ( $upid )->data ( $data )->save ();
                    if ($edit) {
                        
                        // session_destroy();
                        unset ( $_SESSION ['emailpwd'] );
                        $this->success ( '修改成功,请重新登录！！', U ( 'Email/success' ), 2 );
                    } else {
                        $this->error ( '修改失败！！' );
                    }
                } else {
                    $this->error ( '两次输入密码不一致，或者密码为空！' );
                    exit ();
                }
            } else {
                $this->error ( '链接出现错误或密码已经修改，请重试！！',U('Email/index'),3 );
            }
        } else {
            
            // session_destroy();
            unset ( $_SESSION ['emailpwd'] );
            $this->error ( '链接失效，请重新申请', U ( 'Email/index' ), 2 );
        }
        // $this->assign('username',$username);
    }
}

?>
