
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SNS绑定信息</title>
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
	<blockquote class="layui-elem-quote layui-text" style="font-weight: bold;font-size: 20px;color: #222;">
		用户<?= $this->input->get('memberid') ?>-  <?php echo $name; ?> SNS绑定信息
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
					<label class="layui-form-label" style="width: 30px">状态</label>
					<div class="layui-input-block" style="margin-left: 62px">
						<select name="state" lay-filter="aihao">
							<option value="正常">正常</option>
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

					<th>申请时间</th>
					<th>绑定时间</th>
					<th>SNS</th>
					<th>姓名</th>
					<th>电话</th>
					<th>地址</th>
					<th>部门</th>
					<th>操作员</th>
					<th>撤销时间</th>
					<th>撤销部门</th>
					<th>撤销人</th>
					<th>状态</th>

				<th>操作</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($list as $v) {?>
				<tr>
					<td><?= substr($v->addtime,0,16)?></td>
					<td><?= substr($v->bindingtime,0,16)?></td>
					<td><?= $v->sns?></td>
					<td><?= $v->name?></td>
					<td><?= $v->telephone?></td>
					<td><?= $v->address?></td>
					<td><?= $v->department?></td>
					<td><?= $v->operator?></td>
					<td><?= substr($v->revoketime,0,16)?></td>
					<td><?= $v->revokedepartment?></td>
					<td><?= $v->revokeoperator?></td>

					<td><?= getstate($v->state)?></td>
					<?php if ($v->state == 1) {?>
					<td><button class="layui-btn-sm layui-btn" onclick="RevokeBindingUserSns('<?= Myencode($v) ?>')">解绑</button></td>
						<?php }else{?>
						<td></td>
					<?php }?>
				</tr>
			<?php }?>
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
	function RevokeBindingUserSns (data) {
		if (confirm('确认解绑')) {
			$.ajax({
				url: '/index.php/api/RevokeBindingUserSns',
				method: 'post',
				data: {
					info: data
				},
				dataType: 'json',
				success: function (res) {
					if (res.code == 200) {
						alert('解绑成功')
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
