<?php if (!defined('THINK_PATH')) exit();?><form method="post" action="<?php echo U('editCourse');?>" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">课程ID: <?php echo (sprintf("%06s",$ret['id']?$ret['id']:'待创建')); ?></label>
        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo ($ret["id"]); ?>" required>
    </div>
    <div class="form-group">
        <label for="title">课程名称:</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="在此键入课程名称" required value="<?php echo ($ret["title"]); ?>">
    </div>
    <div class="form-group">
        <label for="image">课程图片(留空则不修改):</label>
        <input type="file" accept="image/*" class="form-control" id="image" name="image" placeholder="在此上传课程图片">
    </div>
    <div class="form-group">
        <label for="description">课程描述:</label>
        <textarea class="form-control" rows="5" id="description" name="description" placeholder="在此键入课程描述" required><?php echo ($ret["description"]); ?></textarea>
    </div>
</form>