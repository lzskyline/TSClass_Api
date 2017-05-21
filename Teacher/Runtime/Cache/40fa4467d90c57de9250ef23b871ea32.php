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
    <h1 class="page-header pull-left">课件列表</h1>
    <div class="dropdown pull-left" style="margin-top:2px; margin-left:20px;">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
            选择课程<span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <?php if(is_array($courselist)): $i = 0; $__LIST__ = $courselist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$courselist): $mod = ($i % 2 );++$i;?><li><a href="#<?php echo ($courselist["id"]); ?>"><?php echo ($courselist["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    <div class="clearfix"></div>

    <div id="tree"></div>

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
    var tree = [
  {
    text: "Parent 1",
    nodes: [
      {
        text: "Child 1",
        nodes: [
          {
            text: "Grandchild 1"
          },
          {
            text: "Grandchild 2"
          }
        ]
      },
      {
        text: "Child 2"
      }
    ]
  },
  {
    text: "Parent 2"
  },
  {
    text: "Parent 3"
  },
  {
    text: "Parent 4"
  },
  {
    text: "Parent 5"
  }
];
    $('#tree').treeview({
      data: tree,
      showTags: true,
      levels: 1,
      enableLinks: false
    });
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