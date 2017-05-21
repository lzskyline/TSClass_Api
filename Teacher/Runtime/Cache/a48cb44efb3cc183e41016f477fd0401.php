<?php if (!defined('THINK_PATH')) exit();?><ul id="pul" class="nav nav-tabs">
</ul>

<div id="pdiv" class="tab-content">
</div>
<script>
        var arr = <?php echo ($ret); ?>;
        var map = {};
        arr.forEach(function(e) {
            var key = e.date;
            map[key] = map[key] || (map[key] = []);
            map[key].push(e);
        }, this);
        var i = 0;
        for (var e in map) {
            if (map.hasOwnProperty(e)) {
                ++i;
                $("ul#pul").append('<li' + (i==1?' class="active"':'') + '><a data-toggle="tab" href="#menu' + i + '">' + e + '</a></li>');
                var content = '<table class="table table-hover">';
                content += '<tr><th width="10%">#</th><th width="20%">学生姓名</th><th width="30%">课程名称</th><th width="40%">签到时间</th></tr>';
                content += '</table>';
                content += '<div style="max-height:400px;overflow-y:scroll">';
                content += '<table class="table table-hover">';
                map[e].forEach(function(e){
                    content += '<tr><td width="10%">' + e.id + '</td><td width="20%">' + e.username + '</td><td width="30%">' + e.title + '</td><td width="40%">' + e.datetime + '</td></tr>';
                })
                content += '</table></div>';
                $("div#pdiv").append('<div id="menu' + i + '" class="tab-pane fade' + (i==1?' in active':'') + '">' + content + '</div>');
            }
        }
</script>