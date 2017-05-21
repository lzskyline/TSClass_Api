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
        $this->title = '课件管理';
        $this->m_courseware = 'active';
        $this->courselist = M('course')->where('tid = %d',$tid)->select();
        /*
        $tmp[] = array(
        "text"=>"$i[title]",
        "tags"=>["添加小节"],
        "href"=>"javascript:getChapter('$i[id]');",
        "nodes"=>$this->getChapter($courseId,$i["id"])
        );
        */
        $this->display();
    }
    public function homework(){
        $u = $this->isLogin();
        $this->title = '作业管理';
        $this->m_homework = 'active';
        $this->display();
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