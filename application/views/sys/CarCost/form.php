<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>车辆信息</title>
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
	<div class="layui-form-item">
		<label class="layui-form-label">类型</label>
		<div class="layui-input-block">
			<select name="type" id="">
				<option <?php if ($info['type'] == '直送运费模式') {echo 'selected';} ?> value="直送运费模式">直送运费模式</option>
				<option <?php if ($info['type'] == '代销运费模式') {echo 'selected';} ?> value="代销运费模式">代销运费模式</option>
				<option <?php if ($info['type'] == '调拨装卸费模式') {echo 'selected';} ?> value="调拨装卸费模式">调拨装卸费模式</option>
				<option <?php if ($info['type'] == '直送装卸费模式') {echo 'selected';} ?> value="直送装卸费模式">直送装卸费模式</option>
				<option <?php if ($info['type'] == '代销装卸费模式') {echo 'selected';} ?> value="代销装卸费模式">代销装卸费模式</option>
			</select>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">方式</label>
		<div class="layui-input-block">
			<input type="text" name="mode" required value="<?= $info['mode'] ?>" autocomplete="off"
				   placeholder="方式" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">15/12KG重</label>
		<div class="layui-input-block">
			<input type="text" name="hkg12" required value="<?= $info['hkg12'] ?>" autocomplete="off"
				   placeholder="15/12KG重" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">4KG重</label>
		<div class="layui-input-block">
			<input type="text" name="hkg4" required value="<?= $info['hkg4'] ?>" autocomplete="off"
				   placeholder="4KG重" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">45KG重</label>
		<div class="layui-input-block">
			<input type="text" name="hkg45" required value="<?= $info['hkg45'] ?>" autocomplete="off"
				   placeholder="45KG重" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">2KG重</label>
		<div class="layui-input-block">
			<input type="text" name="hkg2" required value="<?= $info['hkg2'] ?>" autocomplete="off"
				   placeholder="2KG重" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">15/12KG空</label>
		<div class="layui-input-block">
			<input type="text" name="ekg12" required value="<?= $info['ekg12'] ?>" autocomplete="off"
				   placeholder="15/12KG空" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">4KG空</label>
		<div class="layui-input-block">
			<input type="text" name="ekg4" required value="<?= $info['ekg4'] ?>" autocomplete="off"
				   placeholder="4KG空" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">45KG空</label>
		<div class="layui-input-block">
			<input type="text" name="ekg45" required value="<?= $info['ekg45'] ?>" autocomplete="off"
				   placeholder="45KG空" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">2KG空</label>
		<div class="layui-input-block">
			<input type="text" name="ekg2" required value="<?= $info['ekg2'] ?>" autocomplete="off"
				   placeholder="2KG空" class="layui-input">
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
			}, 1000)
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
			}, 1000)
			return false
		});
	</script>
<?php } ?>
</html>
