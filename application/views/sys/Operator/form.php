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
	<?php echo form_open('', 'class="layui-form layui-form-pane" enctype="multipart/form-data"'); ?>

	<input type="hidden" name="action" value="<?= $this->input->get('action') ?>">
	<input type="hidden" name="id" value="<?= $info['id'] ?>">

	<div class="layui-form-item">
		<label class="layui-form-label">操作员工号</label>
		<div class="layui-input-block">
			<input type="text" name="nopeid" required value="<?= $info['opeid'] ?>" autocomplete="off"
				   placeholder="操作员工号" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">操作员姓名</label>
		<div class="layui-input-block">
			<input type="text" name="name" required value="<?= $info['name'] ?>" autocomplete="off"
				   placeholder="操作员姓名" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">电话号码</label>
		<div class="layui-input-block">
			<input type="text" name="telephone" required value="<?= $info['telephone'] ?>" autocomplete="off"
				   placeholder="电话号码" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">部门ID</label>
		<div class="layui-input-block">
			<select name="departmentid" id="">
				<?php foreach ($_SESSION['initData']->Department->info as $v) { ?>
					<option <?php if ($info['departmentid'] == $v->id || $this->input->get('departmentid') == $v->id ) {
						echo 'selected';
					} ?> value="<?= $v->id ?>"><?= $v->name ?></option>
				<?php } ?>
			</select>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">岗位ID</label>
		<div class="layui-input-block">
			<select name="quartersid" id="">
				<?php foreach ($_SESSION['initData']->Quarters->info as $v) { ?>
					<option <?php if ($info['quartersid'] == $v->id) {
						echo 'selected';
					} ?> value="<?= $v->id ?>"><?= $v->name ?></option>
				<?php } ?>
			</select>
		</div>
		
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">相片</label>
		<img src="<?= $info['photo']?>" alt="">
		<div class="layui-input-block">
			<input type="file" name="userfile" class="layui-input">
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
