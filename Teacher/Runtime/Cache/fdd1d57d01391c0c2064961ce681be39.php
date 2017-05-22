<?php if (!defined('THINK_PATH')) exit();?><ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#add">添加作业</a></li>
    <li><a data-toggle="tab" href="#list">作业列表</a></li>
    <li><a data-toggle="tab" href="#score">成绩列表</a></li>
</ul>

<div class="tab-content">
    <div id="add" style="padding:10px;" class="tab-pane fade in active">
        <form method="post" action="<?php echo U('addHomework');?>">
            <div class="form-group">
                <label>小节名称: <?php echo ($stitle); ?></label>
                <input type="hidden" class="form-control" id="pid" name="pid" value="<?php echo ($pid); ?>" required>
            </div>
            <div class="form-group">
                <label for="question">作业问题:</label>
                <input type="text" class="form-control" id="question" name="question" placeholder="在此键入作业问题" value="<?php echo ($ret["question"]); ?>" required>
            </div>
            <div class="form-group">
                <label for="choices">选项列表:</label>
                <textarea type="text" class="form-control" id="choices" name="choices" placeholder="" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="answer">正确选项:</label>
                <input type="number" class="form-control" id="answer" name="answer" placeholder="在此键入正确答案(0为第一行,即A.依次例推)" value="<?php echo ($ret["answer"]); ?>"
                    required>
            </div>
        </form>
    </div>
    <div id="list" style="padding:10px;" class="tab-pane fade">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="6%">#</th>
                        <th width="35%">问题</th>
                        <th width="30%">选项</th>
                        <th width="10%">答案</th>
                        <th width="15%">操作</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="table-responsive" style="max-height:400px;overflow-y:scroll;">
            <table class="table table-hover">
                <tbody>
                    <?php if(is_array($vo1)): $i = 0; $__LIST__ = $vo1;if( count($__LIST__)==0 ) : echo "$empty1" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><tr>
                            <td width="6%"><?php echo ($vo1["id"]); ?></td>
                            <td width="40%" style="text-align: left;"><?php echo ($vo1["question"]); ?></td>
                            <td width="30%"><?php echo (nl2br($vo1["choices"])); ?></td>
                            <td width="14%"><?php echo ($vo1["answer"]); ?></td>
                            <td width="10%">
                                <a href="<?php echo U('removeHomework');?>?id=<?php echo ($vo1["id"]); ?>&pid=<?php echo ($vo1["pid"]); ?>" class="btn btn-danger btn-sm">删除</a>
                            </td>
                        </tr><?php endforeach; endif; else: echo "$empty1" ;endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="score" style="padding:10px;" class="tab-pane fade">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="6%">#</th>
                        <th width="40%">姓名</th>
                        <th width="14%">时间</th>
                        <th width="40%">分数</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="table-responsive" style="max-height:400px;overflow-y:scroll;">
            <table class="table table-hover">
                <tbody>
                    <?php if(is_array($vo2)): $i = 0; $__LIST__ = $vo2;if( count($__LIST__)==0 ) : echo "$empty2" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><tr>
                            <td width="6%"><?php echo ($vo2["id"]); ?></td>
                            <td width="40%" style="text-align: left;"><?php echo ($vo2["username"]); ?></td>
                            <td width="14%"><?php echo ($vo2["score"]); ?></td>
                            <td width="40%"><?php echo ($vo2["datetime"]); ?></td>
                        </tr><?php endforeach; endif; else: echo "$empty2" ;endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $("#choices").attr('placeholder', "在此键入选项A\n在此键入选项B\n在此键入选项C\n...");
</script>