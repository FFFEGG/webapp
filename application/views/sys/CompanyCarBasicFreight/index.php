<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>公司车辆基础运费</title>
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
					<option <?php if ($this->input->get('state') == '全部') {
						echo 'selected';
					} ?> value="全部">全部
					</option>
					<option <?php if ($this->input->get('state') == '正常') {
						echo 'selected';
					} ?> value="正常">正常
					</option>
					<option <?php if ($this->input->get('state') == '取消') {
						echo 'selected';
					} ?> value="取消">取消
					</option>
				</select>


			</div>
			<div class="layui-inline">
				<button class="layui-btn " type="submit">筛选</button>
			</div>
		</form>
		<div class="layui-inline">
			<button class="layui-btn" type="button"
					onclick="Win10_child.openUrl('/index.php/sys/CompanyCarBasicFreight_form?action=ADD','公司车辆基础运费')">新增
			</button>
		</div>
	</div>
	<div class="layui-form">
		<table class="layui-table">
			<thead>
			<tr>
				<?php foreach ($info['data']['title'] as $v) { ?>
					<th><?= $v ?></th>
				<?php } ?>
				<th>操作</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($info['data']['info'] as $v) { ?>
				<tr>
					<?php foreach ($info['data']['key'] as $vo) { ?>
						<?php if ($vo == 'state') { ?>
							<td><?= getstate($v[$vo]) ?></td>
						<?php } elseif ($vo == 'fid') { ?>

							<td><?= getSalesMashupId($v[$vo])['name'] ?></td>
						<?php } elseif ($vo == 'calltypeid') { ?>

							<td><?= getCalltypeId($v[$vo])['name'] ?></td>
						<?php } elseif ($vo == 'goodsid') { ?>

							<td><?= getGoodsId($v[$vo])['name'] ?></td>

						<?php } else { ?>

							<td><?= $v[$vo] ?></td>
						<?php } ?>
					<?php } ?>
					<td>
						<button
							onclick="Win10_child.openUrl('/index.php/sys/CompanyCarBasicFreight_form?action=UPDATE&id=<?= Myencode($v) ?>','公司车辆基础运费')"
							class="layui-btn">修改
						</button>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
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
