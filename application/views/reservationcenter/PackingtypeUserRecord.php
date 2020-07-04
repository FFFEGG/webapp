<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>钢瓶流转信息</title>
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

<style>
	.btn-success {
		background: blue;
		padding: 10px;
		color: #F2F2F2;
		border-radius: 3px;
		margin: 0 5px;
	}

	.btn-danger {
		background: red;
		padding: 10px;
		color: #F2F2F2;
		border-radius: 3px;
		margin: 0 5px;
	}
</style>

<div class="oapd">
	<div class="layui-form-item layui-form">
		<form action="" method="get">
			<div class="layui-inline">
				<input type="hidden" name="userid" value="<?php echo $_GET['userid'] ?>">
				<input type="hidden" name="name" value="<?php echo $_GET['name'] ?>">
				<input type="hidden" name="memberid" value="<?php echo $_GET['memberid'] ?>">

				<div class="layui-input-inline">
					<input type="text" name="memberid" value="<?= $this->input->get('memberid') ?>"
						   placeholder="卡号" autocomplete="off" class="layui-input">
				</div>
				<div class="layui-input-inline">
					<input type="text" name="code" value="<?= $this->input->get('code') ?>"
						   placeholder="钢瓶号" autocomplete="off" class="layui-input">
				</div>

				<button class="layui-btn submitsss" type="submit">查询</button>
				<button onclick="Win10_child.openUrl('/index.php/users/info?cardid=<?= $_GET['memberid'] ?>','用户详情')"
						class="layui-btn submitsss" type="button">用户信息
				</button>

				<button onclick="Win10_child.openUrl('/index.php/msg/AddPackingtypeCheakRecord?memberid=<?= $_GET['memberid'] ?>','添加未回空信息')"
						class="layui-btn submitsss" type="button">添加未回空信息
				</button>
			</div>
		</form>

	</div>
	<div class="layui-row layui-col-space15">
		<div class="layui-col-md6">
			<table class="layui-table" lay-size="sm" style="margin-bottom: 0">
				<tr style="background: #eee">
					<th>办理时间</th>
					<th>名称</th>
					<th>计费模式</th>
					<th>使用时间</th>

					<th>门店</th>

				</tr>
			</table>
			<div style="height: 150px;overflow-y: scroll">
				<table class="layui-table" lay-size="sm" style="margin-top: 0">
					<tbody>
					<?php foreach ($usercollateralwarehouse as $v) { ?>
						<tr>
							<td><?= substr($v->addtime, 0, 16) ?></td>
							<td><?= $v->name ?></td>
							<td><?= $v->billingmode ?></td>
							<td><?= substr($v->usetime, 0, 16) ?></td>


							<td><?= $v->department ?></td>

						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="layui-col-md6">
			<table class="layui-table" lay-size="sm" style="margin-bottom: 0">
				<tr style="background: #eee">
					<th style="width: 11.7%">钢瓶码</th>
					<th style="width: 12%">包装物详细</th>

					<th style="width: 10%">方式</th>
					<th style="width: 14%">添加时间</th>
					<th style="width: 12%">经手人</th>
					<th style="width: 12%">门店</th>

					<th>地址</th>

				</tr>
			</table>
			<div style="height: 150px;overflow-y: scroll">
				<table class="layui-table" lay-size="sm" style="margin-top: 0">
					<tbody>
					<?php foreach ($userpackingtyperecord as $v) { ?>
						<?php if ($v->state == 12) { ?>
							<tr style="color: red">
						<?php } else { ?>
							<tr>
						<?php } ?>
						<td style="width: 12%"><?= $v->code ?></td>
						<td style="width: 12%"><?= $v->packinginfo ?></td>

						<td style="width: 10%"><?= $v->mode ?></td>
						<td style="width: 14%"><?= substr($v->addtime, 0, 16) ?></td>
						<td style="width: 12%"><?= $v->brokerage ?></td>


						<td style="width: 12%"><?= $v->department ?></td>

						<td><?= $v->address ?></td>


						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="layui-form layui-row layui-col-space15">
		<div class="layui-col-lg6 layui-col-md6 layui-col-xs6 layui-col-sm6">
			<table class="layui-table" lay-size="sm">
				<thead>
				<tr>
					<th>添加时间</th>
					<th>类型</th>
					<th>门店</th>
					<th>经手人</th>

					<th>钢瓶号</th>
					<th>地址</th>
					<th>操作</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($userrecordinfo as $v) { ?>
					<tr>

						<td><?= substr($v->addtime, 0, 16) ?></td>
						<td><?= $v->mode ?></td>
						<td><?= $v->department ?></td>
						<td><?= $v->brokerage ?></td>


						<td><?= $v->code ?></td>
						<td><?= $v->address ?></td>
						<td>
							<button onclick="Win10_child.openUrl('/index.php/user/AddPackingtypeCheakRecord?data=<?= Myencode($v) ?>&code=<?= $this->input->get('code') ?>','添加包装物判断信息')"
									class="layui-btn-sm layui-btn">修改
							</button>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
		<div class="layui-col-lg6 layui-col-md6 layui-col-xs6 layui-col-sm6">
			<table class="layui-table" lay-size="sm">
				<thead>
				<tr>
					<th>添加时间</th>
					<th>类型</th>
					<th>门店</th>
					<th>经手人</th>

					<th>钢瓶号</th>
					<th>卡号</th>
					<th>地址</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($packingtypeorderinfo as $v) { ?>
					<tr>

						<td><?= substr($v->addtime, 0, 16) ?></td>
						<td><?= $v->mode ?></td>
						<td><?= $v->department ?></td>
						<td><?= $v->brokerage ?></td>

						<td><?= $v->code ?></td>
						<td><?= $v->memberid ?></td>
						<td><?= $v->address ?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
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

	function FeedbackArrears(data) {
		swal({
			title: '确定还款操作？',
			text: '',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: '确定',
			cancelButtonText: '取消',
			confirmButtonClass: 'btn btn-success',
			cancelButtonClass: 'btn btn-danger',
			buttonsStyling: false
		}).then(function (dismiss) {
			if (dismiss.value) {
				$.ajax({
					url: '/index.php/api/FeedbackArrears',
					method: 'post',
					data: {
						info: data
					},
					dataType: 'json',
					success: function (rew) {
						if (rew.code == 200) {
							swal(
									'成功！',
									'还款操作成功',
									'success'
							);
						} else {
							swal(
									'失败！',
									'',
									'error'
							);
						}
						setTimeout(function () {
							$('.submitsss').submit()
						}, 1000)
					}
				})
			}
		})
	}
</script>

</html>
