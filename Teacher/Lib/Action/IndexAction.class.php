<?php
class IndexAction extends Action {
    public function __construct(){
        parent::__construct();
        $this->module_name = "TSClass教师端";
    }
    public function index(){
        $u = $this->isLogin();
        $this->title = '课程管理';
        $this->m_courselist = 'active';
        $this->vo = M('course')->where('tid=%d',I('session.id'))->select();
        $this->empty = "<tr><td colspan=6 style='text-align:center'>暂无课程</td></tr>";
        $this->display();
    }
    public function courseware(){
        $u = $this->isLogin();
        $tid = (int)I('session.id');
        $this->title = '课件作业管理';
        $this->m_courseware = 'active';
        $this->courselist = M('course')->where('tid = %d',$tid)->select();
        $this->display();
    }
    public function addHomework(){
        $u = $this->isLogin();
        $arr['pid'] = I('param.pid');
        $arr['question'] = I('post.question');
        if($arr['question']){
            $arr['choices'] = I('post.choices');
            $arr['answer'] = I('post.answer');
            if((int)I('param.id'))
                $ret = M('homework')->where('pid = %d',$arr['pid'])->save($arr);
            else
                $ret = M('homework')->add($arr);
            $this->success("添加成功!");
            exit;
        }
        $ret = M('homework')->where("pid = %d",$arr['pid'])->select();
        $this->vo1 = $ret;
        $this->empty1 = "<tr><td colspan=5 style='text-align:center'>暂无题目</td></tr>";
        $ret = M('score')->where("pid = %d",$arr['pid'])
        ->join('LEFT JOIN __STUDENT__ ON __STUDENT__.id = __SCORE__.sid')
        ->order('score desc,datetime')->select();
        $this->vo2 = $ret;
        $this->empty2 = "<tr><td colspan=4 style='text-align:center'>暂无记录</td></tr>";
        $this->pid = $arr['pid'];
        $this->stitle = I('get.stitle');
        $this->display();
    }
    public function removeHomework(){
        $u = $this->isLogin();
        $pid = (int)I('get.pid');
        $id = (int)I('get.id');
        $ret = M('homework')
        ->where('pid = %d and id = %d',$pid,$id)->find();
        if(!$ret)$this->error("操作失败,在您的权限范围内找不到该作业!");
        $ret = M('homework')->where('id = %d',$ret['id'])->delete();
        if($ret)
        $this->success("删除成功!");
        else
            $this->error("操作失败,请刷新重试!");
    }
    public function addCourseware(){
        $u = $this->isLogin();
        $arr['pid'] = I('param.pid');
        $arr['title'] = I('post.title');
        if($arr['title']){
            $arr['url'] = I('post.url');
            if((int)I('param.id'))
            $ret = M('courseware')->where('pid = %d',$arr['pid'])->save($arr);
            else
                $ret = M('courseware')->add($arr);
            $this->success("更新成功!");
            exit;
        }
        $ret = M('courseware')->where("pid = %d",$arr['pid'])->find();
        $ret['pid'] = $arr['pid'];
        $this->ret = $ret;
        $this->stitle = I('get.stitle');
        $this->display();
    }
    public function delChapter(){
        $u = $this->isLogin();
        $id = I('get.id');
        $cid = I('get.cid');
        $ret = M('chapter')->where('id = %d and cid = %d',$id,$cid)->delete();
        if(!$ret)$this->error("操作失败,请刷新重试!");
        $this->success("删除成功!");
    }
    public function addChapter(){
        $u = $this->isLogin();
        $arr['cid'] = (int)I('param.cid');
        $arr['pid'] = (int)I('param.pid');
        $arr['title'] = I('post.title');
        if($arr['title']){
            $arr['rank'] = (int)I('post.rank');
            $ret = M('chapter')->add($arr);
            if(!$ret)$this->error("操作失败,请刷新重试!");
            $this->success("添加成功!");
            exit;
        }
        $this->pid = $arr['pid'];
        $this->ptitle = I('get.ptitle');
        $this->ret = M('course')->find($arr['cid']);
        $this->display();
    }
    public function coursewareList(){
        $u = $this->isLogin();
        $cid = I('get.cid');
        $pid = I('get.pid');
        $tree = $this->getChapter($cid,$pid);
        echo json_encode($tree);
    }
    protected function getChapter($courseId,$id=0){
        $ret = M("chapter")->where("cid=%d and pid=%d",$courseId,$id)->order('rank desc,id')->select();
        $tmp = array();
        if(empty($ret))return NULL;
        foreach($ret as $i){
            $tmp[] = array(
            "href" => "javascript:switchChapter($courseId,$i[id])",
            "text" => "$i[title]",
            "nodes" => $this->getChapter($courseId,$i["id"]),
            );
        }
        return $tmp;
    }
    public function answered(){
        $u = $this->isLogin();
        $tid = (int)I('session.id');
        $this->title = '问答管理';
        $this->m_answered = 'active';
        $ret = M('answered')
        ->join('LEFT JOIN __COURSE__ ON __COURSE__.id = __ANSWERED__.cid')
        ->join('LEFT JOIN __STUDENT__ ON __STUDENT__.id = __ANSWERED__.sid')
        ->where('tid = %d and answer = ""',$tid)->field('*,tsc_answered.id as id')
        ->order('updatetime desc')->select();
        $this->empty = "<tr><td colspan=6 style='text-align:center'>暂无问题</td></tr>";
        $this->vo = $ret;
        $this->display();
    }
    public function replyQuestion(){
        $u = $this->isLogin();
        $id = (int)I('post.id');
        $tid = (int)I('session.id');
        if($id){
            $arr['answer'] = I('post.answer');
            $arr['updatetime'] = date('Y-m-d H:i:s');
            $ret = M('answered')
            ->join('LEFT JOIN __COURSE__ ON __COURSE__.id = __ANSWERED__.cid')
            ->join('LEFT JOIN __STUDENT__ ON __STUDENT__.id = __ANSWERED__.sid')
            ->where('tid = %d and tsc_answered.id = %d and answer = ""',$tid,$id)->field('*,tsc_answered.id as id')->find();
            if(!$ret)$this->error("操作失败,在您的权限范围内找不到该问题!");
            $ret = M('answered')->where('id = %d',$ret['id'])->save($arr);
            if(!$ret)$this->error("操作失败,请刷新重试!");
            $this->success("回复成功!");
            exit;
        }
        $id = (int)I('get.id');
        if(!$id)$this->error('问题id不存在!');
        $tid = (int)I('session.id');
        $ret = M('answered')
        ->join('LEFT JOIN __COURSE__ ON __COURSE__.id = __ANSWERED__.cid')
        ->join('LEFT JOIN __STUDENT__ ON __STUDENT__.id = __ANSWERED__.sid')
        ->where('tid = %d and tsc_answered.id = %d and answer = ""',$tid,$id)->field('*,tsc_answered.id as id')->find();
        $this->ret = $ret;
        $this->display();
    }
    public function deleteQuestion(){
        $u = $this->isLogin();
        $id = (int)I('get.id');
        if(!$id)$this->error('问题id不存在!');
        $tid = (int)I('session.id');
        $ret = M('answered')
        ->join('LEFT JOIN __COURSE__ ON __COURSE__.id = __ANSWERED__.cid')
        ->join('LEFT JOIN __STUDENT__ ON __STUDENT__.id = __ANSWERED__.sid')
        ->where('tid = %d and tsc_answered.id = %d and answer = ""',$tid,$id)->field('*,tsc_answered.id as id')->find();
        if(!$ret)$this->error("操作失败,在您的权限范围内找不到该问题!");
        $ret = M('answered')->where('id = %d',$ret['id'])->delete();
        if(!$ret)$this->error("操作失败,请刷新重试!");
        $this->success("删除成功!");
        exit;
    }
    public function punchList(){
        $u = $this->isLogin();
        $tid = (int)I('session.id');
        $cid = (int)I('get.id');
        $ret = M('punch')
        ->join('LEFT JOIN __STUDENT__ ON __STUDENT__.id = __PUNCH__.sid')
        ->join('LEFT JOIN __COURSE__ ON __COURSE__.id = __PUNCH__.cid')
        ->where('cid = %d and tid = %d',$cid,$tid)->field('tsc_student.id,tsc_student.username,tsc_punch.datetime,tsc_course.title,date(datetime) as date')
        ->order('datetime desc')->select();
        $this->ret = json_encode($ret);
        $this->display();
    }
    public function studentList(){
        $u = $this->isLogin();
        $tid = (int)I('session.id');
        $id = (int)I('get.id');
        $ret = M('selected')
        ->join('LEFT JOIN __STUDENT__ ON __STUDENT__.id = __SELECTED__.sid')
        ->join('LEFT JOIN __COURSE__ ON __COURSE__.id = __SELECTED__.cid')
        ->where('cid = %d and tid = %d',$id,$tid)->select();
        $this->vo = $ret;
        $this->empty = "<tr><td colspan=5 style='text-align:center'>暂无学生</td></tr>";
        $this->display();
    }
    public function removeStudent(){
        $u = $this->isLogin();
        $tid = (int)I('session.id');
        $cid = (int)I('get.cid');
        $sid = (int)I('get.sid');
        $ret = M('selected')
        ->join('LEFT JOIN __STUDENT__ ON __STUDENT__.id = __SELECTED__.sid')
        ->join('LEFT JOIN __COURSE__ ON __COURSE__.id = __SELECTED__.cid')
        ->where('cid = %d and tid = %d and sid = %d',$cid,$tid,$sid)->field('tsc_selected.*')->find();
        if(!$ret)$this->error("操作失败,在您的权限范围内找不到该学生!");
        $ret = M('selected')->where('id = %d',$ret['id'])->delete();
        if($ret)
        $this->success("移除成功!");
        else
            $this->error("操作失败,请刷新重试!");
    }
    public function editCourse(){
        $u = $this->isLogin();
        $tid = (int)I('session.id');
        $arr['title'] = I('post.title');
        if($arr['title']){
            //save one
            if($_FILES['image']["size"]){
                import('ORG.Net.Image');
                import('ORG.Net.UploadFile');
                $configs = array(
                'maxSize'=>6000000,
                'savePath'=>'./images/',
                'allowExts'=>array('jpg', 'gif', 'png' , 'bmp'),
                'autoSub'=>false
                );
                $upload = new UploadFile($configs);
                $info=$upload->uploadOne($_FILES['image']);
                if(!$info) {// error
                    $this->error($upload->getErrorMsg());
                }else{// success
                    $arr['image']=$info[0]["savename"];
                }
            }
            $arr['description'] = I('post.description');
            $arr['tid'] = (int)I('session.id');
            $id = (int)I('post.id');
            if($id)
            $ret = M('course')->where('id=%d and tid=%d',$id,$tid)->save($arr);
            else
                $ret = M('course')->add($arr);
            if($ret)
            $this->success('课程信息已更新!');
            else
                $this->error('请检查名称或描述是否填写!');
            exit;
        }
        $id = (int)I('param.id');
        if($id){
            //edit one
            $ret = M('course')->where('id=%d and tid=%d',$id,$tid)->find();
            $this->ret = $ret;
        }
        //prepare to create one
        $this->display();
    }
    public function shareId(){
        $u = $this->isLogin();
        $ret['username'] = $u;
        $ret['title'] = I('get.title');
        $ret['id'] = (int)I('get.id');
        $this->ret = $ret;
        $this->display();
    }
    public function switchAllowed(){
        $u = $this->isLogin();
        $tid = (int)I('session.id');
        $id = (int)I('get.id');
        if(!$id)$this->error('课程id传入错误!');
        $allowed = (int)I('get.allowed');
        $ret = M('course')->where('id=%d and tid=%d',$id,$tid)->setField('allowed',(int)!$allowed);
        $this->success('签到状态更新成功!');
    }
    public function login(){
        $u = I('post.username');
        $p = I('post.password');
        if(I('post.register')==='1'){
            if(!($u && $p)){
                $this->error("用户名/密码不能为空!");
            }
            $p = md5($p);
            $ret = M('teacher')->add(array('username' => "$u",'password'=>"$p"));
            if(!$ret)$this->error("用户名已存在!");
            $_SESSION['username']="$u";
            $_SESSION['id']=(int)$ret;
            $this->success("注册成功!",U('index'));
            exit;
        }
        elseif(I('post.login')==='1'){
            if(!($u && $p)){
                $this->error("用户名/密码不能为空!");
            }
            $p = md5($p);
            $ret = M('teacher')->where('username = "%s" and password = "%s"',$u,$p)->find();
            if(!$ret)$this->error("用户名/密码错误!");
            $_SESSION['username']="$u";
            $_SESSION['id']=(int)$ret['id'];
            $this->success("登录成功!",U('index'));
            exit;
        }
        else{
            $this->display('login');
        }
    }
    public function register(){
        $this->login();
    }
    public function logout(){
        session_destroy();
        $this->success("注销成功!",U('login'));
        exit;
    }
    protected function isLogin(){
        $u = I('session.username');
        if($u)return $u;
        $this->error('请先登录!',U('login'),1);
    }
}