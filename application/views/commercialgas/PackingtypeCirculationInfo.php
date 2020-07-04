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
	<blockquote class="layui-elem-quote layui-text" style="font-weight: bold;font-size: 20px;color: #222;">
		用户<?= $this->input->get('memberid') ?>- <?php echo $name; ?> 钢瓶流转信息
	</blockquote>
	<div class="layui-form-item layui-form">
		<form action="" method="get">
			<div class="layui-inline">
				<input type="hidden" name="userid" value="<?php echo $_GET['userid'] ?>">
				<input type="hidden" name="name" value="<?php echo $_GET['name'] ?>">
				<input type="hidden" name="memberid" value="<?php echo $_GET['memberid'] ?>">
				<label class="layui-form-label" style="padding: 9px 0;text-align: left">查询日期</label>
				<div class="layui-input-inline">
					<input type="text" name="begintime" id="begintime" lay-verify="date" value="<?= $this->input->get('begintime')?$this->input->get('begintime'):date('Y-m-d')?>"
						   placeholder="yyyy-MM-dd" autocomplete="off" class="layui-input">
				</div>
				<div class="layui-form-mid">-</div>
				<div class="layui-input-inline">
					<input type="text" name="endtime" id="endtime" lay-verify="date"
						   value="<?= $this->input->get('endtime')?$this->input->get('endtime'):date('Y-m-d')?>" placeholder="yyyy-MM-dd" autocomplete="off"
						   class="layui-input">
				</div>
				<div class="layui-input-inline">
					<input type="text" name="memberid" value="<?= $this->input->get('memberid') ?>"
						   placeholder="卡号" autocomplete="off" class="layui-input">
				</div>
				<div class="layui-input-inline">
					<input type="text" name="code" value="<?= $this->input->get('code') ?>"
						   placeholder="钢瓶号" autocomplete="off" class="layui-input">
				</div>

				<div class="layui-input-inline">
					<input type="text" name="num" value="<?= $this->input->get('num') ?>"
						   placeholder="数量" autocomplete="off" class="layui-input">
				</div>

				<div class="layui-input-inline">
					<label class="layui-form-label" style="width: 30px">状态</label>
					<div class="layui-input-block" style="margin-left: 62px">
						<select name="state" lay-filter="aihao">
							<option value="">全部</option>
							<option value="正常">正常</option>
						</select>
					</div>
				</div>
				<button class="layui-btn submitsss" type="submit">查询</button>
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

			</tr>
			</thead>
			<tbody>
			<?php foreach ($list as $v) { ?>
				<tr>
					<?php foreach ($key as $vo) { ?>
						<?php if ($vo == 'state') { ?>
							<td><?= getstate($v->$vo) ?></td>
						<?php } elseif ($vo == 'goodsid') { ?>
							<td><?= getoneGoodsById($v->$vo)['name'] ?></td>
						<?php } else { ?>
							<td><?= $v->$vo ?></td>
						<?php } ?>
					<?php } ?>
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
