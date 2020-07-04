<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>部门配置</title>
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
		<input type="hidden" name="action" value="<?= $this->input->get('action') ?>">
		<input type="hidden" name="id" value="<?= $info['id'] ?>">
		<div class="layui-form-item">
			<label class="layui-form-label">FID</label>
			<div class="layui-input-block">
				<input type="text" name="fid" required value="<?= $info['fid'] ?>" autocomplete="off"
					   placeholder="FID" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">部门名称</label>
			<div class="layui-input-block">
				<input type="text" name="name" required value="<?= $info['name'] ?>" autocomplete="off"
					   placeholder="部门名称" class="layui-input">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">类型</label>
			<div class="layui-input-block">
				<input type="text" name="type" required value="<?= $info['type'] ?>" autocomplete="off"
					   placeholder="类型" class="layui-input">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">电话</label>
			<div class="layui-input-block">
				<input type="text" name="telephone" required value="<?= $info['telephone'] ?>" autocomplete="off"
					   placeholder="电话" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">等待时间</label>
			<div class="layui-input-block">
				<input type="text" name="waittime" required value="<?= $info['waittime'] ?>" autocomplete="off"
					   placeholder="等待时间" class="layui-input">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">公里数</label>
			<div class="layui-input-block">
				<input type="text" name="distance" required value="<?= $info['distance'] ?>" autocomplete="off"
					   placeholder="公里数" class="layui-input">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">上班时间</label>
			<div class="layui-input-block">
				<input type="text" name="worktime" value="<?= $info['worktime'] ?>" class="layui-input" id="test4" placeholder="上班时间">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">片区</label>
			<div class="layui-input-block">
				<input type="text" name="area" value="<?= $info['area'] ?>"  class="layui-input"  placeholder="片区">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">状态</label>
			<div class="layui-input-block">

				<input type="radio" name="state" value="正常" title="正常" <?php if ($info['state'] == 1) { echo 'checked=""';}?>>
				<input type="radio" name="state" value="取消" title="取消" <?php if ($info['state'] == 2) { echo 'checked=""';}?>>
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-input-block">
				<button class="layui-btn" type="submit">确认添加</button>
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
      //时间选择器
      laydate.render({
        elem: '#test4'
        ,type: 'time'
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
			},1000)
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
			},1000)
			return false
		});
	</script>
<?php } ?>
</html>
