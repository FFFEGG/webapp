<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SNS绑定列表</title>
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


	<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
		<ul class="layui-tab-title">
			<li class="layui-this">SNS绑定列表</li>
			<li>未支付订单</li>
		</ul>
		<div class="layui-tab-content" style="height: 100px;">
			<div class="layui-tab-item layui-show">
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
									   value="<?=$this->input->get('endtime')?$this->input->get('endtime'): date('Y-m-d', time()); ?>" placeholder="yyyy-MM-dd"
									   autocomplete="off"
									   class="layui-input">
							</div>
							<div class="layui-input-inline">
								<label class="layui-form-label" style="width: 30px">状态</label>
								<div class="layui-input-block" style="margin-left: 62px">
									<select name="state" lay-filter="aihao">
										<option <?php if($this->input->get('state') == '正常'){echo 'selected';}?> value="正常">正常</option>
										<option <?php if($this->input->get('state') == '待确认'){echo 'selected';}?> value="待确认">待确认</option>
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
									<?php if ($v->state != 1) { ?>
									<button onclick="Win10_child.openUrl('/index.php/user/bindsns?info=<?= Myencode($v) ?>&keytype=电话&keyword=<?= $v->telephone?>','绑定sns')"
											class="layui-btn layui-btn-sm">绑定
									</button>
									<?php } ?>
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>

			<div class="layui-tab-item">
				<table class="layui-table">
					<thead>
					<tr>

						<th>时间</th>
						<th>来源</th>
						<th>卡号</th>
						<th>姓名</th>
						<th>电话</th>
						<th>地址</th>
						<th>备注</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($UserUnpaidOrderRecord->info as $v) { ?>
						<tr>

							<td>
								<?= $v->addtime ?>
							</td>
							<td>
								<?= $v->source ?>
							</td>
							<td style="color: cadetblue;cursor: pointer" onclick="Win10_child.openUrl('/index.php/order/lists?cardid=<?= $v->memberid ?>','预约下单')">
								<?= $v->memberid ?>
							</td>

							<td>
								<?= $v->name ?>
							</td>
							<td>
								<?= $v->telephone ?>
							</td>
							<td>
								<?= $v->street ?><?= $v->housenumber ?><?= $v->address ?>
							</td>
							<td>
								<?= $v->remarks ?>
							</td>
						</tr>
						<tr>
							<td colspan="7">
								<?php foreach ($v->suborder as $vi) { ?>
									<p>    <?= $vi->goodsname ?> X <?= $vi->num ?> 状态：<?= getstate($vi->state) ?></p>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
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

	function bindsns(data) {
		$.ajax({
			url: '/index.php/api/bindsns',
			method: 'post',
			data: {
				info: data
			},
			dataType: 'json',
			success: function (res) {
				if (res.code == 200) {
					alert('绑定成功')
				} else {
					alert('绑定失败')
				}
				setTimeout(function () {
					window.location.reload()
				}, 1000)
			}
		})
	}
</script>

</html>
