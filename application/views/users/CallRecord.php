<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>用户来电信息</title>
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
					<input type="text" name="begintime" id="begintime" lay-verify="date" value="2010-01-01"
						   placeholder="yyyy-MM-dd" autocomplete="off" class="layui-input">
				</div>
				<div class="layui-form-mid">-</div>
				<div class="layui-input-inline">
					<input type="text" name="endtime" id="endtime" lay-verify="date"
						   value="<?php echo date('Y-m-d', time()); ?>" placeholder="yyyy-MM-dd" autocomplete="off"
						   class="layui-input">
				</div>

				<label class="layui-form-label">电话号码</label>
				<div class="layui-input-inline" style="margin-left: 62px">
					<input type="text" name="telephone" class="layui-input">
				</div>

				<div class="layui-input-inline">
					<label class="layui-form-label" style="width: 30px">类型</label>
					<div class="layui-input-block" style="margin-left: 62px">
						<select name="type" lay-filter="aihao">
							<option value="全部">全部</option>
							<?php foreach ($_SESSION['initData']->CallType->info as $v) { ?>
								<option value="<?= $v->name ?>"><?= $v->name ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="layui-input-inline">
					<label class="layui-form-label" style="width: 30px">原因</label>
					<div class="layui-input-block" style="margin-left: 62px">
						<select name="reason" lay-filter="aihao">
							<option value="全部">全部</option>
							<?php foreach ($_SESSION['initData']->CallReason->info as $v) { ?>
								<option value="<?= $v->name ?>"><?= $v->name ?></option>
							<?php } ?>
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
					<td>
						<button onclick="UpdateUserCallRecord('<?= $v->id ?>','<?= $v->serial ?>','<?= $v->userid ?>','<?= $v->type ?>','<?= $v->reason ?>','<?= $v->remarks ?>','<?= $v->handledepartment ?>','<?= $v->state ?>')"
								class="layui-btn-sm layui-btn">修改
						</button>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>
</body>
<script src="<?php echo base_url(); ?>res/js/axios.js" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>res/js/sweetalert2.min.js"></script>
<script src="<?php echo base_url(); ?>res/js/core.js"></script>
<script src="<?php echo base_url(); ?>res/js/win10.child.js"></script>
<link href="<?php echo base_url(); ?>res/css/sweetalert2.min.css" rel="stylesheet">
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

	function UpdateUserCallRecord(id, serial, userid, type, reason, remarks, handledepartment, state) {
		var typestr = ''
		var CallType = JSON.parse('<?= json_encode($_SESSION['initData']->CallType->info) ?>')
		var reasonstr = ''
		var CallReason = JSON.parse('<?= json_encode($_SESSION['initData']->CallReason->info) ?>')
		reasonstr += '<option selected value=""></option>'
		for (let i = 0; i < CallType.length; i++) {
			if (CallType[i].name == type) {
				typestr += '<option selected value="' + CallType[i].name + '">' + CallType[i].name + '</option>'
			} else {
				typestr += '<option value="' + CallType[i].name + '">' + CallType[i].name + '</option>'
			}

		}
		for (let i = 0; i < CallReason.length; i++) {
			if (CallReason[i].name == reason) {
				reasonstr += '<option selected value="' + CallReason[i].name + '">' + CallReason[i].name + '</option>'
			} else {
				reasonstr += '<option value="' + CallReason[i].name + '">' + CallReason[i].name + '</option>'
			}

		}


		swal({
			title: '修改用户来电信息',
			html: '<p style="text-align: left">类型</p>' +
					'<select id="swal-input1" class="swal2-input">' + typestr + '</select>' +
					'<p style="text-align: left">原因</p>' +
					'<select id="swal-input2" class="swal2-input">' + reasonstr + '</select>' +
					'<p style="text-align: left">备注</p>' +
					'<input  id="swal-input3" type="text" class="swal2-input" value="' + remarks + '">' +
					'<p style="text-align: left">处理部门</p>' +
					'<input  id="swal-input4" type="text" class="swal2-input" value="' + handledepartment + '">' +
					'<p style="text-align: left">状态</p>' +
					'<select id="swal-input5" class="swal2-input" id="">' +
					'<option selected value="正常">正常</option>' +
					'<option value="取消">取消</option>' +
					'</select>',
			focusConfirm: false,
			preConfirm: () => {
				return [
					document.getElementById('swal-input1').value,
					document.getElementById('swal-input2').value,
					document.getElementById('swal-input3').value,
					document.getElementById('swal-input4').value,
					document.getElementById('swal-input5').value
				]
			},
			showCancelButton: true,
			confirmButtonText: '确认',
			cancelButtonText: '取消',
			confirmButtonClass: 'btn btn-success mr-3',
			cancelButtonClass: 'btn btn-danger',
			showLoaderOnConfirm: true,
			allowOutsideClick: false
		}).then(function (remarks) {
			if (remarks.value) {
				axios.post('/index.php/api/UpdateUserCallRecord', {
					id: id,
					serial: serial,
					userid: userid,
					type: remarks.value[0],
					reason: remarks.value[1],
					remarks: remarks.value[2],
					handledepartment: remarks.value[3],
					state: remarks.value[4],
				}).then(rew => {
					if (rew.data.code == 200) {
						swal('修改成功')
					} else {
						swal('修改失败')
					}
				})
			}
		})
	}
</script>

</html>
