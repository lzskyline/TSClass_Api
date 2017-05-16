<?php
class IndexAction extends Action {
    public function login(){
        $u = I('post.user');
        if(!$u){
            $u = $_SESSION["user"];
            if($u)return $u;
            $this->ajaxReturn(0,"登录信息无效,请重新登录!",0);
        }
        $p = md5(I('post.pass'));
        $ret = M('student')->where('username="%s" and password="%s"',$u,$p)->getField('id');
        if(!$ret)$this->ajaxReturn(0,"用户名或密码错误!",0);
        $_SESSION["user"] = (int)$ret;
        $this->ajaxReturn((int)$ret,"登录成功!",1);
    }
    public function logout(){
        session_destroy();
        $this->ajaxReturn(0,"注销成功!",1);
    }
    public function register(){
        $u = I('post.user');
        $p = I('post.pass');
        if(!($u&&$p))$this->ajaxReturn(0,"用户名或密码不能为空!",0);
        $p = md5($p);
        $ret = M('student')->add(array('username'=>"$u",'password'=>"$p"));
        if(!$ret)$this->ajaxReturn(0,"用户名已存在,请尝试找回密码!",0);
        $_SESSION["user"] = (int)$ret;
        $this->ajaxReturn((int)$ret,"注册成功!",1);
    }
    public function addCourse(){
        $id = $this->login();
        $courseId = (int)I('post.cid');
        if(!$courseId)$this->ajaxReturn(0,"课程ID不能为空!",0);
        $ret = M('course')->find($courseId);
        if(!$ret)$this->ajaxReturn(0,"课程ID不存在!",0);
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
    protected function getChapter($courseId,$id=0){
        $ret = M("chapter")->where("cid=%d and pid=%d",$courseId,$id)->select();
        $tmp = array();
        if(empty($ret))return NULL;
        foreach($ret as $i){
            /*
            $tmp[] = array(
                "text"=>"$i[title]",
                "tags"=>["添加小节"],
                "href"=>"javascript:getChapter('$i[id]');",
                "nodes"=>$this->getChapter($courseId,$i["id"])
                );
            */
            //<script src="__PUBLIC__/js/bootstrap-treeview.js"></script>
            //<div id="tree"></div>
            $tmp[] = array(
                "title" => "$i[title]",
                "nodes" => $this->getChapter($courseId,$i["id"])
            );
        }
        return $tmp;
    }
    public function getChapterList(){
        $id = $this->login();
        $courseId = (int)I('post.cid');
        if(!$courseId)$this->ajaxReturn(null,"课程ID不能为空!",0);
        $ret = $this->getChapter($courseId,0);
        if($ret)$this->ajaxReturn($ret,"读取成功!",1);
        $this->ajaxReturn(null,"暂无相关内容!",0);
    }
    public function getCourseware(){
        $id = $this->login();
        $pid = (int)I('post.pid');
        if(!$pid)$this->ajaxReturn(null,"章节ID不能为空!",0);
        $ret = M('courseware')->where('pid = %d',$pid)->select();
        if($ret)$this->ajaxReturn($ret,"读取成功!",1);
        $this->ajaxReturn(null,"暂无相关内容!",0);
    }
    public function getHomework(){
        $id = $this->login();
        $pid = (int)I('post.pid');
        if(!$pid)$this->ajaxReturn(null,"章节ID不能为空!",0);
        $ret = M('homework')->where('pid = %d',$pid)->select();
        if($ret)$this->ajaxReturn($ret,"读取成功!",1);
        $this->ajaxReturn(null,"暂无相关内容!",0);
    }
    public function getPunchList(){
        $id = $this->login();
        $courseId = (int)I('post.cid');
        if(!($courseId))$this->ajaxReturn(null,"课程id不能为空!",0);
        $ret = M('punch')->where('sid = %d and cid = %d',$id,$courseId)
        ->order('datetime desc')->select();
        if($ret)$this->ajaxReturn($ret,"读取成功!",1);
        $this->ajaxReturn(null,"暂无相关内容!",0);
    }
    public function punchCard(){
        $id = $this->login();
        $courseId = (int)I('post.cid');
        if(!($courseId))$this->ajaxReturn(0,"课程id不能为空!",0);
        $ret = M('course')->where('allowed = 1 and id = %d',$courseId)->select();
        if(!$ret)$this->ajaxReturn(0,"当前时间不允许签到!",0);
        $date = date('Y-m-d H:i:s');
        $ret = M('punch')->add(array('sid'=>"$id",'cid'=>"$courseId",'datetime'=>"$date"));
        if($ret)$this->ajaxReturn((int)$ret,"签到成功!",1);
        $this->ajaxReturn(0,"签到失败,请重试!",0);
    }
}