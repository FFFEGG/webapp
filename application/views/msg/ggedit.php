<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>公告</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
</head>
<body>
<div class="oapd">
	<?php echo form_open('', 'class="layui-form layui-form-pane"'); ?>
	<input type="hidden" name="id" value="<?= $info['id']?>">
	<div class="layui-form-item">
		<label class="layui-form-label">开始时间</label>
		<div class="layui-input-block">
		<input type="text" name="begintime" id="begintime" lay-verify="date" value="<?= $info['begintime'] ?>"
			   placeholder="yyyy-MM-dd" autocomplete="off" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">结束时间</label>
		<div class="layui-input-block">
			<input type="text" name="endtime" id="endtime" lay-verify="date" value="<?= $info['endtime'] ?>"
				   placeholder="yyyy-MM-dd" autocomplete="off" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">标题</label>
		<div class="layui-input-block">
			<input type="text" name="title" value="<?= $info['title']?>" required autocomplete="off"
				   placeholder="标题" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">公告内容</label>
		<div class="layui-input-block">
			<textarea style="width: 100%;min-height: 200px" name="content"><?= $info['content']?></textarea>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">排序</label>
		<div class="layui-input-block">
			<input type="number" name="sort" required  autocomplete="off"
				   placeholder="排序" value="<?= $info['sort']?>" class="layui-input">
		</div>
	</div>




	<div class="layui-form-item">
		<div class="layui-input-block">
			<button class="layui-btn" type="submit">确认修改</button>
		</div>
	</div>

	</form>
</div>
</body>
<script src="<?php echo base_url(); ?>/res/layui/layui.js" charset="utf-8"></script>
<script>
  layui.use(['jquery', 'form', 'layedit', 'laydate', 'element'], function () {
    var form = layui.form
        , layer = layui.layer
        , layedit = layui.layedit
        , laydate = layui.laydate
        , element = layui.element
        , $ = layui.$;
    //日期
    laydate.render({
      elem: '#begintime'
    });
    laydate.render({
      elem: '#endtime'
    });

  });
</script>
<?php if (get_cookie('success')) { ?>
	<script>
      layui.use(['jquery', 'form', 'layedit', 'laydate', 'element'], function () {
        var form = layui.form
            , layer = layui.layer
            , layedit = layui.layedit
            , laydate = layui.laydate
            , element = layui.element
            , $ = layui.$; //重点处
        layer.msg('成功！');
        setTimeout(function () {
          Win10_child.close()
        }, 1000);
        return false
      });
	</script>
<?php } ?>
<?php if (get_cookie('error')) { ?>
	<script>
      layui.use(['jquery', 'form', 'layedit', 'laydate', 'element'], function () {
        var form = layui.form
            , layer = layui.layer
            , layedit = layui.layedit
            , laydate = layui.laydate
            , element = layui.element
            , $ = layui.$; //重点处
        layer.msg('失败！');
        setTimeout(function () {
          Win10_child.close()
        }, 1000);
        return false
      });
	</script>
<?php } ?>
</html>
