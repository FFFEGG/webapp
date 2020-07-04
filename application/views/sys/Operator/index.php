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
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
</head>
<body>
<div class="oapd">

	<div class="layui-form-item layui-form">
		<form action="" method="get" class="">
			<div class="layui-inline">

				<select name="state" id="" class="layui-input-inline">
					<option <?php if ($this->input->get('state') == '全部') { echo 'selected';}?> value="全部">全部</option>
					<option <?php if ($this->input->get('state') == '正常') { echo 'selected';}?> value="正常">正常</option>
					<option <?php if ($this->input->get('state') == '取消') { echo 'selected';}?> value="取消">取消</option>
				</select>
			</div>
			<div class="layui-inline">
				<button class="layui-btn " type="submit">筛选</button>
			</div>
		</form>
		<div class="layui-inline">
			<button class="layui-btn" type="button"
					onclick="Win10_child.openUrl('/index.php/sys/Operator_form?action=ADD','员工')">新增
			</button>
		</div>
	</div>
	<div class="layui-form">
		<div class="layui-collapse" lay-filter="test">
			<?php foreach ($list as $k => $v) { ?>
				<div class="layui-colla-item">
					<h2 class="layui-colla-title"><?= $k ?></h2>
					<div class="layui-colla-content layui-show">
						<?php foreach ($list[$k] as $vi) { ?>
							<p class="layui-row" style="margin-bottom: 2px">

								<span class="layui-col-lg2">账号：<?= $vi['opeid'] ?></span>
								<span class="layui-col-lg2">姓名：<?= $vi['name'] ?></span>
								<span class="layui-col-lg2">电话：<?= $vi['telephone'] ?> </span>
								<span class="layui-col-lg2">岗位：<?= $vi['quarter'] ?></span>
								<span class="layui-col-lg2">状态：<?= getstate($vi['state']) ?></span>
								<span class="layui-col-lg2"><button class="layui-btn-sm layui-btn" onclick="Win10_child.openUrl('/index.php/sys/Operator_form?action=UPDATE&id=<?= Myencode($vi) ?>','员工')">修改</button></span>
							</p>
						<?php } ?>
						<button class="layui-btn layui-btn-sm layui-btn-primary" onclick="Win10_child.openUrl('/index.php/sys/Operator_form?action=ADD&departmentid=<?= $vi['departmentid'] ?>','员工')">添加更多</button>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
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

</html>
