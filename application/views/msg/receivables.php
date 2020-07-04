<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>收款信息</title>
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
		用户<?= $this->input->get('memberid') ?>- <?php echo $name; ?> 收款信息
	</blockquote>
	<div class="layui-form-item layui-form">
		<form action="" method="get">
			<div class="layui-inline">
				<input type="hidden" name="userid" value="<?php echo $_GET['userid'] ?>">
				<input type="hidden" name="name" value="<?php echo $_GET['name'] ?>">
				<input type="hidden" name="memberid" value="<?php echo $_GET['memberid'] ?>">
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

				<div class="layui-input-inline" style="width: 400px">
					<label class="layui-form-label">项目</label>
					<div class="layui-input-block" style="width: 200px">
						<select name="project">
							<option <?php if ($this->input->get('project') == '全部') {
								echo 'selected';
							} ?> value="全部">全部
							</option>

							<option <?php if ($this->input->get('project') == '商品销售款') {
								echo 'selected';
							} ?> value="商品销售款">商品销售款
							</option>

							<option <?php if ($this->input->get('project') == '抵押物押金款') {
								echo 'selected';
							} ?> value="抵押物押金款">抵押物押金款
							</option>

							<option <?php if ($this->input->get('project') == '抵押物销售款') {
								echo 'selected';
							} ?> value="抵押物销售款">抵押物销售款
							</option>

							<option <?php if ($this->input->get('project') == '混搭方案销售款') {
								echo 'selected';
							} ?> value="混搭方案销售款">混搭方案销售款
							</option>

							<option <?php if ($this->input->get('project') == '会员充值款') {
								echo 'selected';
							} ?> value="会员充值款">会员充值款
							</option>
							<option <?php if ($this->input->get('project') == '月结回款') {
								echo 'selected';
							} ?> value="月结回款">月结回款
							</option>
							<option <?php if ($this->input->get('project') == '维修配件款') {
								echo 'selected';
							} ?> value="维修配件款">维修配件款
							</option>
							<option <?php if ($this->input->get('project') == '租赁费款') {
								echo 'selected';
							} ?> value="租赁费款">租赁费款
							</option>
							<option <?php if ($this->input->get('project') == '年检费款') {
								echo 'selected';
							} ?> value="年检费款">年检费款
							</option>
							<option <?php if ($this->input->get('project') == '维护费款') {
								echo 'selected';
							} ?> value="维护费款">维护费款
							</option>
							<option <?php if ($this->input->get('project') == '检测费款') {
								echo 'selected';
							} ?> value="检测费款">检测费款
							</option>
							<option <?php if ($this->input->get('project') == '欠现金回款') {
								echo 'selected';
							} ?> value="欠现金回款">欠现金回款
							</option>
							<option <?php if ($this->input->get('project') == '收购钢瓶款') {
								echo 'selected';
							} ?> value="收购钢瓶款">收购钢瓶款
							</option>
							<option <?php if ($this->input->get('project') == '收购残液款') {
								echo 'selected';
							} ?> value="收购残液款">收购残液款
							</option>
							<option <?php if ($this->input->get('project') == '退押金款') {
								echo 'selected';
							} ?> value="退押金款">退押金款
							</option>
							<option <?php if ($this->input->get('project') == '退指标款') {
								echo 'selected';
							} ?> value="退指标款">退指标款
							</option>
							<option <?php if ($this->input->get('project') == '退预存款') {
								echo 'selected';
							} ?> value="退预存款">退预存款
							</option>
						</select>
					</div>
				</div>
				<div class="layui-input-inline">
					<button class="layui-btn" type="submit">查询</button>
				</div>
			</div>

		</form>

	</div>
	<div class="layui-form">
		<table class="layui-table">
			<thead>
			<tr>
				<th>交易时间</th>

				<th>收支情况</th>

				<th>项目</th>
				<th>金额</th>


				<th>支付方式</th>
				<th>业务部门</th>
				<th>操作员</th>
				<th>状态</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($list as $v) { ?>
				<?php if (getstate($v->state)== '取消') { ?>
					<tr style="color: hotpink;">
				<?php } else { ?>
					<tr>
				<?php } ?>
				<td><?= substr($v->addtime, 0, 19) ?></td>

				<td style="font-weight: bold;"><?= $v->inandout ?></td>

				<td><?= $v->project ?></td>
				<td style="font-weight: bold;color: red;"><?= number_format($v->total, 2) ?></td>

				<td><?= $v->payment ?></td>
				<td><?= $v->department ?></td>
				<td><?= $v->operator ?></td>
				<td><?= getstate($v->state) ?></td>

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
