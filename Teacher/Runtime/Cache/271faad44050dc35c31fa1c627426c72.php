<?php if (!defined('THINK_PATH')) exit();?><div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th width="6%">#</th>
                <th width="14%">学生姓名</th>
                <th width="30%">课程名称</th>
                <th width="30%">选课时间</th>
                <th width="20%">管理操作</th>
            </tr>
        </thead>
    </table>
</div>
<div class="table-responsive" style="max-height:400px;overflow-y:scroll;">
    <table class="table table-hover">
        <tbody>
            <?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td width="6%"><?php echo ($vo["sid"]); ?></td>
                    <td width="14%"><?php echo ($vo["username"]); ?></td>
                    <td width="30%"><?php echo ($vo["title"]); ?></td>
                    <td width="30%"><?php echo ($vo["datetime"]); ?></td>
                    <td width="20%">
                        <a href="<?php echo U('removeStudent');?>?sid=<?php echo ($vo["sid"]); ?>&cid=<?php echo ($vo["cid"]); ?>" class="btn btn-danger btn-sm">移出课程</a>
                    </td>
                </tr><?php endforeach; endif; else: echo "$empty" ;endif; ?>
        </tbody>
    </table>
</div>