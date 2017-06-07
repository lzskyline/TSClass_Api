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
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header pull-left">课程列表</h1><button onclick="editCourse(0);" class="btn btn-primary pull-right">添加课程</button>
    <div class="clearfix"></div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>课程编号</th>
                    <th>课程图片</th>
                    <th>课程名称</th>
                    <th>课程简介</th>
                    <th>允许签到</th>
                    <th>课程管理</th>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td width="8%"><a href="javascript:shareId('<?php echo ($vo["title"]); ?>','<?php echo ($vo["id"]); ?>');" title="分享此课程"><?php echo (sprintf("%06d",$vo["id"])); ?></a></td>
                        <td width="10%"><img src="../../images/<?php echo ($vo["image"]); ?>" alt="<?php echo ($vo["image"]); ?>" class="img-responsive"></td>
                        <td width="20%"><?php echo ($vo["title"]); ?></td>
                        <td width="30%"><?php echo (mb_strimwidth($vo["description"],0,33,"...")); ?></td>
                        <td width="8%"><?php echo ($vo['allowed']?'<span style="color:green;">是</span>':'<span style="color:red;">否</span>'); ?></td>
                        <td width="16">
                            <a href="<?php echo U('switchAllowed');?>?id=<?php echo ($vo["id"]); ?>&allowed=<?php echo ($vo["allowed"]); ?>" class="btn btn-sm btn-<?php echo ($vo['allowed']?'danger">关闭':'success">开启'); ?>签到</a>
                            <button onclick="editCourse(<?php echo ($vo["id"]); ?>);" class="btn btn-warning btn-sm">修改课程</button>
                            <br><br>
                            <button onclick="studentList(<?php echo ($vo["id"]); ?>);" class="btn btn-default btn-sm">学生列表</button>
                            <button onclick="punchList(<?php echo ($vo["id"]); ?>);" class="btn btn-default btn-sm">签到列表</button>
                        </td>
                    </tr><?php endforeach; endif; else: echo "$empty" ;endif; ?>
            </tbody>
        </table>
    </div>

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
                    <button type="button" id="saveBtn" class="btn btn-primary">保存</button>
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
<script>
    function editCourse(id) {
        $("#modalTitle").text(id ? "修改" : "添加" + "课程");
        $("#modalBody").load("<?php echo U('editCourse');?>?id=" + id, function () {
            $("#saveBtn").show();
            $("#myModal").modal("toggle");
        })
    }

    function shareId(title, id) {
        $("#modalTitle").text('分享课程ID');
        $("#modalBody").load("<?php echo U('shareId');?>?title=" + title + "&id=" + id, function () {
            $("#saveBtn").hide();
            $("#myModal").modal("toggle");
        })
    }

    function studentList(id) {
        $("#modalTitle").text('上课学生列表');
        $("#modalBody").load("<?php echo U('studentList');?>?id=" + id, function () {
            $("#saveBtn").hide();
            $("#myModal").modal("toggle");
        })
    }

    function punchList(id) {
        $("#modalTitle").text('上课签到列表');
        $("#modalBody").load("<?php echo U('punchList');?>?id=" + id, function () {
            $("#saveBtn").hide();
            $("#myModal").modal("toggle");
        })
    }
    $("#saveBtn").click(function () {
        $("form").submit();
    })
</script>
</body>

</html>