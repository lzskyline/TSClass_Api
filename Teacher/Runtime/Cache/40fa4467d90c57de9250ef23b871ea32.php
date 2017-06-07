<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="cn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo ($title); ?> - <?php echo ($module_name); ?></title>
    <link rel="stylesheet" href="__PUBLIC__/css/bootstrap.css">
    <link rel="stylesheet" href="__PUBLIC__/css/dashboard.css">
    <style>
        td,
        th {
            text-align: center;
            vertical-align: middle!important;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false"
                    aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
                <a class="navbar-brand" href="#"><?php echo ($module_name); ?></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">欢迎您, <?php echo $_SESSION['username'];?></a></li>
                    <li><a href="<?php echo U('logout');?>">退出登录</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <ul class="nav nav-sidebar">
                    <li class="<?php echo ($m_courselist); ?>"><a href="<?php echo U('index');?>">课程管理</a></li>
                    <li class="<?php echo ($m_answered); ?>"><a href="<?php echo U('answered');?>">问答管理</a></li>
                    <li class="<?php echo ($m_courseware); ?>"><a href="<?php echo U('courseware');?>">课件作业</a></li>
                </ul>
            </div>
<style>
    #tree a{
        text-decoration: none;
    }
</style>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header pull-left">章节列表</h1>
    <div class="dropdown pull-left" style="margin-top:2px; margin-left:20px;">
        <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown">
            <span id="tips">选择课程</span><span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <?php if(is_array($courselist)): $i = 0; $__LIST__ = $courselist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$courselist): $mod = ($i % 2 );++$i;?><li><a href="javascript:switchCourse(<?php echo ($courselist["id"]); ?>,0,'<?php echo ($courselist["title"]); ?>');"><?php echo ($courselist["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    <button onclick="delChapter()" class="btn btn-danger pull-right" style="margin-top:2px; margin-left:20px;">删除章节</button>
    <button onclick="addChapter()" class="btn btn-primary pull-right" style="margin-top:2px; margin-left:20px;">添加章节</button>
    <button onclick="addHomework()" class="btn btn-success pull-right" style="margin-top:2px; margin-left:20px;">作业管理</button>
    <button onclick="addCourseware()" class="btn btn-success pull-right" style="margin-top:2px; margin-left:20px;">添加课件</button>
    <div class="clearfix"></div>

    <div id="tree" class="col-md-12 well"><h3>请先选择课程.</h3></div>
    <div id="myModal" class="modal fade" role="dialog" style="margin-top: 10%;">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="modalTitle">Loading data...</h4>
                </div>
                <div class="modal-body" id="modalBody">
                    <p>Loading data...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="saveBtn" class="btn btn-primary">提交</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
</div>
<script src="__PUBLIC__/js/jquery.min.js"></script>
<script src="__PUBLIC__/js/bootstrap.min.js"></script>
<script src="__PUBLIC__/js/bootstrap-treeview.js"></script>
<script>
    var scid = 0, sid = 0, stitle = "";
    function switchCourse(cid, id, ctitle) {
        scid = cid;
        sid = id;
        $("#tips").text(ctitle);
        $.get("<?php echo U('coursewareList');?>", {
            cid: cid,
            pid: id
        }, function (data) {
            $('#tree').treeview({
                data: data,
                levels: 1,
                enableLinks: true,
                onNodeSelected: function(event, node){
                    stitle = node.text;
                    eval(node.href);
                }
            });
        })
    }
    function addHomework(){
        if(!(scid&&sid)){
            alertMsg("请先选择课程及章节!");
            return;
        }
        $("#modalTitle").text("添加作业");
        $("#modalBody").load("<?php echo U('addHomework');?>?pid=" + sid + "&stitle=" + stitle + "&cid=" + scid, function () {
            $("#saveBtn").show();
            $("#myModal").modal("toggle");
        })
    }
    function addCourseware(){
        if(!(scid&&sid)){
            alertMsg("请先选择课程及章节!");
            return;
        }
        $("#modalTitle").text("添加课件");
        $("#modalBody").load("<?php echo U('addCourseware');?>?pid=" + sid + "&stitle=" + stitle + "&cid=" + scid, function () {
            $("#saveBtn").show();
            $("#myModal").modal("toggle");
        })
    }
    function addChapter(){
        if(!(scid)){
            alertMsg("请先选择课程!");
            return;
        }
        $("#modalTitle").text("添加章节");
        $("#modalBody").load("<?php echo U('addChapter');?>?cid=" + scid + "&pid=" + sid + "&ptitle=" + stitle, function () {
            $("#saveBtn").show();
            $("#myModal").modal("toggle");
        })
    }
    function delChapter(){
        if(!(scid&&sid)){
            alertMsg("请先选择课程及章节!");
            return;
        }
        $.get("<?php echo U('delChapter');?>",{cid:scid,id:sid},function(a){
            alertMsg(a.info);
            setTimeout(function(){
                location.reload();
            },2000);
        })
    }
    function switchChapter(cid,id){
        scid = cid;
        sid = id;
    }
    $("#saveBtn").click(function () {
        $("form").submit();
    })
    function alertMsg(text=""){
        $("#modalTitle").text("提示:");
        $("#modalBody").text(text);
        $("#saveBtn").hide();
        $("#myModal").modal("toggle");
    }
</script>
</body>

</html>