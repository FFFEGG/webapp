<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>修改订单部门表</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
</head>
<body style="padding: 10px">

	<?php echo form_open('', 'class="layui-form layui-form-pane"'); ?>
	<div class="layui-form-item">
		<label class="layui-form-label">订单原部门</label>
		<div class="layui-input-block">
			<input type="text" lay-verify="title" autocomplete="off" disabled
				   value="<?= $this->input->get('department') ?>" class="layui-input">
			<input type="hidden" name="department" value="<?= $this->input->get('department') ?>">
			<input type="hidden" name="id" value="<?= $this->input->get('id') ?>">
			<input type="hidden" name="serial_pay" value="<?= $this->input->get('serial_pay') ?>">
			<input type="hidden" name="state" value="<?= $this->input->get('state') ?>">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">新部门</label>
		<div class="layui-input-block">
			<select name="newdepartment" lay-filter="aihao">
				<?php foreach ($_SESSION['initData']->Department->info as $v) { ?>
					<option value="<?= $v->name ?>"> <?= $v->name ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="layui-form-item">
		<div class="layui-input-block">
			<button class="layui-btn">确认修改</button>
		</div>
	</div>
</form>
</body>
<script src="<?php echo base_url(); ?>/res/layui/layui.js" charset="utf-8"></script>
<script>
	layui.use(['jquery', 'form', 'layedit', 'laydate', 'element', 'tree', 'util', 'table'], function () {
		var form = layui.form
			, layer = layui.layer
			, layedit = layui.layedit
			, laydate = layui.laydate
			, table = layui.table
			, element = layui.element
			, $ = layui.$;
	})
</script>
</html>
