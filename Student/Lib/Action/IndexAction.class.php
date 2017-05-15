<?php
class IndexAction extends Action {
    public function login(){
        $u = $_SESSION["user"];
        if($u)return $u;
        $u = I('post.user');
        if(!$u)$this->ajaxReturn(0,"登录信息无效,请重新登录!",0);
        $p = md5(I('post.pass'));
        $ret = M('student')->where('username="%s" and password="%s"',$u,$p)->getField('id');
        if(!$ret)$this->ajaxReturn(0,"用户名或密码错误!",0);
        $_SESSION["user"] = (int)$ret;
        $this->ajaxReturn((int)$ret,"登陆成功!",1);
    }
    public function logout(){
        session_destroy();
        $this->ajaxReturn(0,"注销成功!",1);
    }
    public function register(){
        $u = I('post.user');
        $p = md5(I('post.pass'));
        $ret = M('student')->add(array('username'=>"$u",'password'=>"$p"));
        if($ret)$this->ajaxReturn(0,"用户名已存在,请尝试找回密码!",0);
        $this->ajaxReturn((int)$ret,"注册成功!",1);
        
        //$_SESSION["user"] = (int)$ret; //注册后是否自动登陆
    }
    public function addCourse(){
        $id = $this->login();
        $courseId = (int)I('post.cid');
        if(!$courseId)$this->ajaxReturn(0,"课程ID不能为空",0);
        $ret = M('course')->find($courseId);
        if(!$ret)$this->ajaxReturn(0,"课程ID不能为空",0);
        $date = date('Y-m-d H:i:s');
        $ret = M('selected')->add(array('cid'=>"$ret[id]",'sid'=>"$id",'datetime'=>"$date"));
        if($ret)$this->ajaxReturn((int)$ret,"添加课程成功!",1);
        $this->ajaxReturn(0,"该课程已存在,请勿重复添加!",0);
    }
    public function getCourseList(){
        $id = $this->login();
        $ret = M('selected')->where('sid = %d',$id)
        ->join('LEFT JOIN __COURSE__ ON __SELECTED__.cid = __COURSE__.id')
        ->join('LEFT JOIN __TEACHER__ ON __COURSE__.tid = __TEACHER__.id')
        ->field('tsc_course.id,tsc_course.title,tsc_course.description,tsc_course.image,tsc_teacher.username as teacher')
        ->select();
        if($ret)$this->ajaxReturn($ret,"读取成功!",1);
        $this->ajaxReturn(null,"暂无相关内容!",0);
    }
    public function getAnsweredList(){
        $id = $this->login();
        $courseId = (int)I('post.cid');
        $related = (int)I('post.related');
        $questionId = (int)I('post.qid');
        $where = array();
        if($courseId)$where['tsc_answered.cid'] = "$cid";
        if($related)$where['tsc_answered.sid'] = "$id";
        if($questionId)$where['tsc_answered.id'] = "$questionId";
        $ret = M('answered')->where($where)
        ->join('LEFT JOIN __COURSE__ ON __ANSWERED__.cid = __COURSE__.id')
        ->join('LEFT JOIN __TEACHER__ ON __COURSE__.tid = __TEACHER__.id')
        ->join('LEFT JOIN __STUDENT__ ON __ANSWERED__.sid = __STUDENT__.id')
        ->field('tsc_answered.id,tsc_answered.question,tsc_answered.answer,tsc_course.title,tsc_course.id as cid,tsc_teacher.username as teacher,tsc_student.username as student')
        ->order('updatetime desc')
        ->limit(0,20)
        ->select();
        if($ret)$this->ajaxReturn($ret,"读取成功!",1);
        $this->ajaxReturn(null,"暂无相关内容!",0);
    }
    public function getNoticeList(){
        $id = $this->login();
        $ret = M('notice')->where('sid in (0,%d)',$id)
        ->join('LEFT JOIN __COURSE__ ON __NOTICE__.cid = __COURSE__.id')
        ->join('LEFT JOIN __TEACHER__ ON __COURSE__.tid = __TEACHER__.id')
        ->field('tsc_notice.id,tsc_notice.cid,tsc_course.title,tsc_notice.content,tsc_teacher.username as teacher,tsc_notice.datetime')
        ->order('datetime desc')->limit(0,20)->select();
        if($ret)$this->ajaxReturn($ret,"读取成功!",1);
        $this->ajaxReturn(null,"暂无相关内容!",0);
    }
}