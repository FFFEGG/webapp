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
<style>
	.layui-form-pane .layui-form-label {
		width: 200px;
		padding: 8px 15px;
		height: 38px;
		line-height: 20px;
		border-width: 1px;
		border-style: solid;
		border-radius: 2px 0 0 2px;
		text-align: center;
		background-color: #FBFBFB;
		overflow: hidden;
		box-sizing: border-box;
	}

	.layui-form-pane .layui-input-block {
		margin-left: 200px;
		left: -1px;
	}
</style>
<div class="oapd">
	<?php echo form_open('', 'class="layui-form layui-form-pane"'); ?>
	<input type="hidden" name="action" value="<?= $this->input->get('action') ?>">
	<input type="hidden" name="id" value="<?= $info['id'] ?>">
	<div class="layui-form-item">
		<label class="layui-form-label">补贴项目</label>
		<div class="layui-input-block">
			<input type="text" name="mode" required value="<?= $info['mode'] ?>" autocomplete="off"
				   placeholder="补贴项目" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">出发点</label>
		<div class="layui-input-block">
			<input type="text" name="departureplace" required value="<?= $info['departureplace'] ?>" autocomplete="off"
				   placeholder="出发点" class="layui-input">
		</div>
	</div>


	<div class="layui-form-item">
		<label class="layui-form-label">距离</label>
		<div class="layui-input-block">
			<input type="text" name="distance" required value="<?= $info['distance'] ?>" autocomplete="off"
				   placeholder="距离" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">最大数量</label>
		<div class="layui-input-block">
			<input type="text" name="maxnum" required value="<?= $info['maxnum'] ?>" autocomplete="off"
				   placeholder="最大数量" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">最小数量</label>
		<div class="layui-input-block">
			<input type="text" name="minnum" required value="<?= $info['minnum'] ?>" autocomplete="off"
				   placeholder="最小数量" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">45KG单价</label>
		<div class="layui-input-block">
			<input type="text" name="kg45price" required value="<?= $info['kg45price'] ?>" autocomplete="off"
				   placeholder="45KG单价" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">12KG单价</label>
		<div class="layui-input-block">
			<input type="text" name="kg12price" required value="<?= $info['kg12price'] ?>" autocomplete="off"
				   placeholder="45KG单价" class="layui-input">
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
