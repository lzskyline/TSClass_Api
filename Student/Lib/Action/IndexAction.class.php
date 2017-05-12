<?php
class IndexAction extends Action {
    public function login(){
        $u = I('post.user');
        $p = md5(I('post.pass'));
        $ret = M('user')->where('username="%s" and password="%s"',$u,$p)->getField('id');
        if($ret){
            $this->ajaxReturn((int)$ret,"登陆成功!",1);
        }
        $this->ajaxReturn(null,"用户名或密码错误!",0);
    }
    public function register(){
        $u = I('post.user');
        $p = md5(I('post.pass'));
        $ret = M('user')->where('username="%s"',$u)->getField('id');
        if($ret){
            $this->ajaxReturn(null,"用户名已存在!",0);
        }
        $ret = M('user')->add(array('username'=>"$u",'password'=>"$p"));
        $this->ajaxReturn((int)$ret,"注册成功!",1);
    }
}