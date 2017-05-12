<?php
class IndexAction extends Action {
    public function login(){
        $u = I('post.user');
        $p = md5(I('post.pass'));
        $ret = M('user')->where('username="%s" and password="%s"',$u,$p)->getField('id');
        if($ret){
            $this->ajaxReturn($ret,"登陆成功!",1);
        }
    }
}