<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>员工欠款记录</title>
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
		<form action="" method="get">
			<div class="layui-inline">
				<label class="layui-form-label" style="padding: 9px 0;text-align: left">查询日期</label>
				<div class="layui-input-inline">
					<input type="text" name="begintime" id="begintime" lay-verify="date"
						   value="<?= $this->input->get('begintime') ? $this->input->get('begintime') : date('Y-m-d') ?>"
						   placeholder="yyyy-MM-dd" autocomplete="off" class="layui-input">
				</div>
				<div class="layui-form-mid">-</div>
				<div class="layui-input-inline">
					<input type="text" name="endtime" id="endtime" lay-verify="date"
						   value="<?= $this->input->get('endtime') ? $this->input->get('endtime') : date('Y-m-d') ?>"
						   placeholder="yyyy-MM-dd" autocomplete="off"
						   class="layui-input">
				</div>
				<div class="layui-input-inline">
					<select name="staff" id="">
						<option value="">选择员工</option>
						<option <?php if ($this->input->get('staff') == '全部') {
							echo 'selected';
						} ?> value="全部">全部
						</option>
						<?php foreach ($Operator as $vi) { ?>
							<option <?php if ($this->input->get('staff') == $vi->name) {
								echo 'selected';
							} ?> value="<?= $vi['name'] ?>"><?= $vi['name'] ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="layui-input-inline">
					<select name="state" id="">
						<option <?php if ($this->input->get('state') == '正常') {
							echo 'selected';
						} ?> value="正常">正常
						</option>
						<option <?php if ($this->input->get('state') == '已还款') {
							echo 'selected';
						} ?> value="已还款">已还款
						</option>
					</select>
				</div>


				<button class="layui-btn" type="submit">查询</button>
			</div>
		</form>
	</div>
	<div class="layui-form">
		<table class="layui-table" lay-size="sm">
			<thead>
			<tr>
				<?php foreach ($title as $v) { ?>
					<th><?= $v ?></th>
				<?php } ?>
				<th>操作</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($list as $v) { ?>
				<tr>
					<?php foreach ($key as $vo) { ?>
						<?php if ($vo == 'state') { ?>
							<td><?= getstate($v->$vo) ?></td>
						<?php } else { ?>
							<td><?= $v->$vo ?></td>
						<?php } ?>
					<?php } ?>
					<th>
						<?php if ($v->state == 1) { ?>
							<button onclick="qr('<?= Myencode($v) ?>')" class="layui-btn layui-btn-sm">确认回款</button>
						<?php } ?>
					</th>
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

	function qr(data) {
		if (confirm('确认操作？')) {
			$.ajax({
				url: '/index.php/api/ConfirmStaffRepayment',
				method: 'post',
				dataType: 'json',
				data: {
					info: data
				},
				success: function (rew) {
					if (rew.code == 200) {
						alert('操作成功')
						$('form').submit()
					}
				}
			})
		}
	}
</script>
</html>
