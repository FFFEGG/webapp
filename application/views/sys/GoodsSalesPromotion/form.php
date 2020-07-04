<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>商品促销方案</title>
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
			<label class="layui-form-label">部门ID</label>
			<div class="layui-input-block">
				<select name="departmentid" id="">
					<?php foreach ($_SESSION['initData']->Department->info as $v) {?>
					<option <?php if ($info['departmentid'] == $v->id ) {echo 'selected';}?> value="<?= $v->id ?>"><?= $v->name ?></option>
					<?php } ?>
				</select>

			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">商品ID</label>
			<div class="layui-input-block">
				<select name="goodsid" id="">
					<?php foreach ($_SESSION['initData']->Goods->info as $v) {?>
					<option <?php if ($info['goodsid'] == $v->id ) {echo 'selected';}?>  value="<?= $v->id ?>"><?= $v->name ?></option>
					<?php } ?>
				</select>

			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">开始时间</label>
			<div class="layui-input-inline">
				<input type="text" name="strattime" id="date1"  value="<?= $info['strattime'] ?>" lay-verify="date" placeholder="开始时间" autocomplete="off" class="layui-input">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">结束时间</label>
			<div class="layui-input-inline">
				<input type="text" name="endtime" id="date2"   value="<?= $info['endtime'] ?>" lay-verify="date" placeholder="结束时间" autocomplete="off" class="layui-input">
			</div>
		</div>



		<div class="layui-form-item">
			<label class="layui-form-label">销售方式</label>
			<div class="layui-input-block">
				<input type="text" name="salestype" required value="<?= $info['salestype'] ?>" autocomplete="off"
					   placeholder="销售方式" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">金额</label>
			<div class="layui-input-block">
				<input type="text" name="price" required value="<?= $info['price'] ?>" autocomplete="off"
					   placeholder="金额" class="layui-input">
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
			elem: '#date1',
			type: 'datetime'
		});
		laydate.render({
			elem: '#date2'
			,type: 'datetime'
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
