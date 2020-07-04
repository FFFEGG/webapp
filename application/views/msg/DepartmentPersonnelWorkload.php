<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>员工工作量</title>
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
		用户<?= $this->input->get('memberid') ?> - <?php echo $name; ?> 员工工作量
	</blockquote>
	<div class="layui-form-item layui-form">
		<form action="" method="get">
			<div class="layui-inline">
				<input type="hidden" name="userid" value="<?php echo $_GET['userid'] ?>">
				<input type="hidden" name="name" value="<?php echo $_GET['name'] ?>">
				<input type="hidden" name="memberid" value="<?= $this->input->get('memberid') ?>">
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
				<div class="layui-input-inline" style="width: 250px">
					<label class="layui-form-label">配送员</label>
					<div class="layui-input-block" style="width: 100px">
						<select name="deliveryman" lay-filter="aihao">
							<option value="全部">全部</option>
							<?php foreach ($Operator as $v) { ?>
								<option <?php if ($v['name'] == $this->input->get('deliveryman')) {
									echo 'selected';
								} ?> value="<?= $v['name'] ?>"><?= $v['name'] ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="layui-input-inline" style="width: 250px">
					<label class="layui-form-label">商品</label>
					<div class="layui-input-block" style="width: 120px">
						<select name="goods" lay-filter="aihao">
							<option value="全部">全部</option>
							<?php foreach (object_array($_SESSION['initData']->Goods->info) as $v) { ?>
								<option <?php if ($v['name'] == $this->input->get('goods')) {
									echo 'selected';
								} ?> value="<?= $v['name'] ?>"><?= $v['name'] ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<button class="layui-btn" type="submit">查询</button>

			</div>
		</form>

	</div>
	<div class="layui-form" style="padding-bottom: 50px">
		<?php if ($this->input->get('goods') != '全部' && $this->input->get('goods') != '') { ?>
			<p style="font-size: 20px">合计：<?php
				$num = 0;
				foreach ($list as $v) {
					if ($v->goodsname == $this->input->get('goods')) {
						$num += $v->num;
					}
				}
				echo $num;
				?></p>
		<?php } ?>
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
				<?php if ($this->input->get('goods') == '全部') { ?>
					<tr>
						<?php foreach ($key as $vo) { ?>
							<?php if ($vo == 'state') { ?>
								<td><?= getstate($v->$vo) ?></td>
							<?php } else { ?>
								<td><?= $v->$vo ?></td>
							<?php } ?>
						<?php } ?>
					</tr>
				<?php } ?>
				<?php if ($v->goodsname == $this->input->get('goods')) { ?>
					<tr>
						<?php foreach ($key as $vo) { ?>
							<?php if ($vo == 'state') { ?>
								<td><?= getstate($v->$vo) ?></td>
							<?php } else { ?>
								<td><?= $v->$vo ?></td>
							<?php } ?>
						<?php } ?>
					</tr>
				<?php } ?>
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
