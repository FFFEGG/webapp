<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>三方平台用户维修信息</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script src="<?php echo base_url(); ?>res/js/sweetalert2.min.js"></script>
	<script src="<?php echo base_url(); ?>res/js/core.js"></script>
	<link href="<?php echo base_url(); ?>res/css/sweetalert2.min.css" rel="stylesheet">
</head>
<body>
<div class="oapd">
	<div class="layui-form-item layui-form">
		<form action="" method="get">
			<div class="layui-inline">
				<input type="hidden" name="userid" value="<?php echo $_GET['userid'] ?>">
				<input type="hidden" name="name" value="<?php echo $_GET['name'] ?>">
				<input type="hidden" name="memberid" value="<?php echo $_GET['memberid'] ?>">
				<label class="layui-form-label" style="padding: 9px 0;text-align: left">查询日期</label>
				<div class="layui-input-inline">
					<input type="text" name="begintime" id="begintime" lay-verify="date" value="2010-01-01"
						   placeholder="yyyy-MM-dd" autocomplete="off" class="layui-input">
				</div>
				<div class="layui-form-mid">-</div>
				<div class="layui-input-inline">
					<input type="text" name="endtime" id="endtime" lay-verify="date"
						   value="<?php echo date('Y-m-d', time()); ?>" placeholder="yyyy-MM-dd" autocomplete="off"
						   class="layui-input">
				</div>
				<div class="layui-input-inline">
					<label class="layui-form-label" style="width: 30px">状态</label>
					<div class="layui-input-block" style="margin-left: 62px">
						<select name="state" lay-filter="aihao">
							<option value="正常">正常</option>
							<option value="已完成">已完成</option>
						</select>
					</div>
				</div>
				<button class="layui-btn" type="submit">查询</button>
			</div>
		</form>

	</div>
	<div class="layui-form">
		<table class="layui-table" lay-size="sm">
			<thead>
			<tr>

				<th>来源</th>
				<th>发生时间</th>
				<th>姓名</th>
				<th>电话</th>
				<th>地址</th>
				<th>维修对象</th>
				<th>预约上门时间</th>
				<th>备注（故障描述）</th>
				<th>状态</th>

				<th>操作</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($list as $v) { ?>
				<tr>
					<td><?= $v->source ?></td>
					<td><?= substr($v->addtime, 0, 16) ?></td>
					<td><?= $v->name ?></td>
					<td><?= $v->telephone ?></td>
					<td><?= $v->city . $v->area . $v->town . $v->street . $v->housenumber . $v->address ?></td>
					<td><?= $v->object ?></td>
					<td><?= substr($v->appointmenttime, 0, 16) ?></td>
					<td style="max-width: 200px"><?= $v->remarks ?></td>
					<td><?= getstate($v->state) ?></td>
					<td>
						<?php if (getstate($v->state) == '正常') { ?>
							<button class="layui-btn layui-btn-sm" onclick="submit('<?= Myencode($v) ?>')">完成SNS用户报修
							</button>
						<?php } ?>
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

	function submit(data) {
		if (confirm('确认操作？')) {
			$.ajax({
				url: '/index.php/api/CompleteSnsUserRepair',
				data: {
					info: data
				},
				method: 'post',
				dataType: 'json',
				success: function (rew) {
					if (rew.code == 200) {
						swal('成功')
					} else {
						swal('失败')
					}
					setTimeout(function () {
						window.location.reload()
					}, 1000)
				}
			})
		}
	}
</script>

</html>
