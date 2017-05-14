<?php
class IndexAction extends Action {
    public function login(){
        $u = $_SESSION["user"];
        if($u){
            return $u;
        }
        else{
            $u = I('post.user');
            if($u){
                $p = md5(I('post.pass'));
                $ret = M('student')->where('username="%s" and password="%s"',$u,$p)->getField('id');
                if($ret){
                    $_SESSION["user"] = (int)$ret;
                    $this->ajaxReturn((int)$ret,"登陆成功!",1);
                }
                $this->ajaxReturn(null,"用户名或密码错误!",0);
            }
            else{
                $this->ajaxReturn(null,"登录信息无效,请重新登录!",0);
            }
        }
    }
    public function logout(){
        session_destroy();
        $this->ajaxReturn(null,"注销成功!",1);
    }
    public function register(){
        $u = I('post.user');
        $p = md5(I('post.pass'));
        $ret = M('student')->where('username="%s"',$u)->getField('id');
        if($ret){
            $this->ajaxReturn(null,"用户名已存在!",0);
        }
        $ret = M('student')->add(array('username'=>"$u",'password'=>"$p"));
        $this->ajaxReturn((int)$ret,"注册成功!",1);
        
        //$_SESSION["user"] = (int)$ret; //注册后是否自动登陆
    }
    public function getCourseList(){
        $id = $this->login();
        if(!$id)exit;
        $ret = M('selected')->where('sid = %d',$id)
        ->join('LEFT JOIN __COURSE__ ON __SELECTED__.cid = __COURSE__.id')
        ->join('LEFT JOIN __TEACHER__ ON __COURSE__.tid = __TEACHER__.id')
        ->field('tsc_course.id,tsc_course.title,tsc_course.description,tsc_course.image,tsc_teacher.username')
        ->select();
        $this->ajaxReturn($ret,"读取成功!",1);
    }
}