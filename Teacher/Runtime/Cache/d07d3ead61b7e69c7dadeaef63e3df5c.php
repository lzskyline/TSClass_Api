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
                    <li class="<?php echo ($m_courseware); ?>"><a href="<?php echo U('courseware');?>">课件管理</a></li>
                    <li class="<?php echo ($m_homework); ?>"><a href="<?php echo U('homework');?>">作业管理</a></li>
                </ul>
            </div>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header pull-left">待回复问题列表</h1>
    <div class="clearfix"></div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>编号</th>
                    <th>问题</th>
                    <th>学生</th>
                    <th>课程</th>
                    <th>时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td width="4%"><?php echo ($vo["id"]); ?></a></td>
                        <td width="32%"><?php echo (mb_strimwidth($vo["question"],0,33,"...")); ?></td>
                        <td width="14%"><?php echo ($vo["username"]); ?></td>
                        <td width="18%"><?php echo ($vo["title"]); ?></td>
                        <td width="16%"><?php echo ($vo["updatetime"]); ?></td>
                        <td width="16">
                            <button onclick="replyQuestion(<?php echo ($vo["id"]); ?>);" class="btn btn-primary btn-sm">回答问题</button>
                            <a href="<?php echo U('deleteQuestion');?>?id=<?php echo ($vo["id"]); ?>" class="btn btn-danger btn-sm">删除问题</a>
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
<script>
    function replyQuestion(id) {
        $("#modalTitle").text('查看问题');
        $("#modalBody").load("<?php echo U('replyQuestion');?>?id=" + id, function () {
            $("#saveBtn").show();
            $("#myModal").modal("toggle");
        })
    }
    $("#saveBtn").click(function () {
        $("form").submit();
    })
</script>
</body>

</html>