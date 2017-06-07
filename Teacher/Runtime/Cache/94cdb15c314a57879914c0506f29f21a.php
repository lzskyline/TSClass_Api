<?php if (!defined('THINK_PATH')) exit();?><form method="post" action="<?php echo U('addCourseware');?>">
    <div class="form-group">
        <label>课件ID: <?php echo ($ret['id']?$ret['id']:"待添加"); ?></label>
        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo ($ret["id"]); ?>" required>
        <input type="hidden" class="form-control" id="cid" name="cid" value="<?php echo ($cid); ?>" required>
    </div>
    <div class="form-group">
        <label>小节名称: <?php echo ($stitle); ?></label>
        <input type="hidden" class="form-control" id="pid" name="pid" value="<?php echo ($ret["pid"]); ?>" required>
    </div>
    <div class="form-group">
        <label for="title">课件名称:</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="在此键入课件名称" value="<?php echo ($ret["title"]); ?>" required>
    </div>
    <div class="form-group">
        <label for="url">课件地址:</label>
        <input type="text" class="form-control" id="url" name="url" placeholder="在此键入课件链接" value="<?php echo ($ret["url"]); ?>" required>
    </div>
</form>