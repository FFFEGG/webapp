<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>订单详情</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
</head>
<body>
<blockquote class="layui-elem-quote layui-text" style="font-weight: bold;font-size: 20px;color: #222;">
	用户<?= $this->input->get('memberid') ?>- <?php echo $this->input->get('name'); ?> 订单详情
</blockquote>
<div class="oapd">
	<table class="layui-table" lay-even="" lay-skin="row" lay-size="sm">
		<thead>
		<tr>
			<th>商品</th>
			<th>费用及详情</th>


			<th>服务部门</th>
			<th>配送员</th>
			<th>时间</th>
			<th>状态</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($list as $v) { ?>
			<tr>
				<td>
					<p>
						方式：<?= $v->mode ?>
						分类：<?= $v->cat ?>
						类型：<?= $v->goodstype ?>
						品牌：<?= $v->brand ?>
						单位：<?= $v->unit ?>
						容量单位：<?= $v->capacityunit ?>

					</p>
					<p style="color: black;font-size: 14px">名称：<?= $v->goodsname ?></p>
					<p style="color: black;font-size: 14px">：<?= $v->packingtype ?></p>
				</td>
				<td style="font-size: 14px">
					<p>净重:<?= $v->suttle ?>  &nbsp;&nbsp;  数量:<?= $v->num ?></p>
					<p>市场价:<?= $v->marketprice ?>   &nbsp;&nbsp; 交易单价:<?= $v->price ?></p>
					<p>小计金额:<?= $v->total ?></p>
					<?php if ((float)$v->pay_balance > 0) { ?>
						<p>余额支付:<?= $v->pay_balance ?></p>
					<?php } ?>
					<?php if ((float)$v->pay_cash > 0) { ?>
						<p>现金支付:<?= $v->pay_cash ?></p>
					<?php } ?>
					<?php if ((float)$v->pay_weixin > 0) { ?>
						<p>微信支付:<?= $v->pay_weixin ?></p>
					<?php } ?>
					<?php if ((float)$v->pay_alipay > 0) { ?>
						<p>支付宝支付:<?= $v->pay_alipay ?></p>
					<?php } ?>
					<?php if ((float)$v->pay_arrears > 0) { ?>
						<p>月结支付:<?= $v->pay_arrears ?></p>
					<?php } ?>
				</td>

				<td>
					<?= $v->department ?>
				</td>
				<td><?= $v->deliveryman ?></td>
				<td>
					<p>安排时间:<?= $v->arrangetime ?></p>
					<p>接收时间:<?= $v->accepttime ?></p>
					<p>送达时间:<?= $v->arrivetime ?></p>
					<p>汇总时间:<?= $v->feedbacktime ?></p>
				</td>

				<td><?= getstate($v->state) ?></td>
			</tr>
			<?php if (getstate($v->state)  == '取消') { ?>
			<tr>
				<td colspan="25" style="color: red;font-size: 15px">
					部门: <?= $v->revoke_department ?>，取消人: <?= $v->revokeer ?>，取消备注: <?= $v->revokeremarks ?>
					，取消时间: <?= $v->revoketime ?>
				</td>
			</tr>
			<?php } ?>

		<?php } ?>
		</tbody>
	</table>
</div>
</body>
</html>
