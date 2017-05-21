<?php if (!defined('THINK_PATH')) exit();?><form method="post" action="<?php echo U('replyQuestion');?>" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">问题ID: <?php echo ($ret["id"]); ?></label>
        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo ($ret["id"]); ?>" required>
    </div>
    <div class="form-group">
        <label for="title">问题内容:</label>
        <label><?php echo (nl2br($ret["question"])); ?></label>
    </div>
    <div class="form-group">
        <label for="answer">教师回复:</label>
        <textarea class="form-control" rows="5" id="answer" name="answer" placeholder="在此键入您的回复" required><?php echo ($ret["answer"]); ?></textarea>
    </div>
</form>