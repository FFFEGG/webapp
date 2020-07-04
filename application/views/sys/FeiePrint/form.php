<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>员工</title>
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
		<label class="layui-form-label">打印机名称</label>
		<div class="layui-input-block">
			<input type="text" name="printname" required value="<?= $info['printname'] ?>" autocomplete="off"
				   placeholder="打印机名称" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">sn</label>
		<div class="layui-input-block">
			<input type="text" name="sn" required value="<?= $info['sn'] ?>" autocomplete="off"
				   placeholder="sn" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">ukey</label>
		<div class="layui-input-block">
			<input type="text" name="ukey" required value="<?= $info['ukey'] ?>" autocomplete="off"
				   placeholder="ukey" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">计费时间</label>
		<div class="layui-input-block">
			<input type="text" name="outlaytime" required value="<?= $info['outlaytime'] ?>" autocomplete="off"
				   placeholder="计费时间" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">使用人</label>
		<div class="layui-input-block">
			<input type="text" name="username"  value="<?= $info['username'] ?>" autocomplete="off"
				   placeholder="使用人" class="layui-input">
		</div>
	</div>



	<div class="layui-form-item">
		<label class="layui-form-label">状态</label>
		<div class="layui-input-block">

			<input type="radio" name="state" value="正常" title="正常" <?php if ($info['state'] == 1) {
				echo 'checked=""';
			} ?>>
			<input type="radio" name="state" value="取消" title="取消" <?php if ($info['state'] == 2) {
				echo 'checked=""';
			} ?>>
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
