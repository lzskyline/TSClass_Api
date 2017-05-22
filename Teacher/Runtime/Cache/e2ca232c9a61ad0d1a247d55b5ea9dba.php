<?php if (!defined('THINK_PATH')) exit();?><form method="post" action="<?php echo U('addChapter');?>">
    <div class="form-group">
        <label>课程ID: <?php echo (sprintf("%06s",$ret['id'])); ?></label>
        <input type="hidden" class="form-control" id="cid" name="cid" value="<?php echo ($ret["id"]); ?>" required>
    </div>
    <div class="form-group">
        <label>课程名称: <?php echo ($ret["title"]); ?></label>
    </div>
    <div class="form-group">
        <label for="title">章节名称:</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="在此键入章节名称" required>
    </div>
    <div class="form-group">
        <label for="type">设置类型:</label>
        <?php if((int)$pid == 0): ?><label class="radio-inline">
            <input type="radio" name="pid" id="pid1" value="0" checked> 新建章
        </label>
        <?php else: ?>
        <label class="radio-inline">
            <input type="radio" name="pid" id="pid1" value="0"> 新建章
        </label>
        <label class="radio-inline">
            <input type="radio" name="pid" id="pid2" value="<?php echo ($pid); ?>" checked> 新建节(属于:<?php echo ($ptitle); ?>)
        </label><?php endif; ?>
    </div>
    <div class="form-group">
        <label for="rank">优先级(可不填):</label>
        <input type="text" class="form-control" id="rank" name="rank" placeholder="在此键入优先级" value=0>
    </div>
</form>