<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>报表</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
</head>
<body>
<div style="padding: 20px; background-color: #F2F2F2;min-height: 600px">
	<div class="layui-row layui-col-space15">
		<div class="layui-col-md4">
			<div class="layui-card" style="padding: 30px;text-align: center" onclick="Win10_child.openUrl('/index.php/table/StoreReport','门店报表')">
				<h2>门店报表</h2>
			</div>
		</div>

		<div class="layui-col-md4">
			<div class="layui-card" style="padding: 30px;text-align: center" onclick="Win10_child.openUrl('/index.php/table/emptybottle','商店空瓶汇总表')">
				<h2>商店空瓶汇总表</h2>
			</div>
		</div>

		<div class="layui-col-md4">
			<div class="layui-card" style="padding: 30px;text-align: center" onclick="Win10_child.openUrl('/index.php/table/Unpaid','大户气未收款表')">
				<h2>大户气未收款表</h2>
			</div>
		</div>

		<div class="layui-col-md4">
			<div class="layui-card" style="padding: 30px;text-align: center" onclick="Win10_child.openUrl('/index.php/table/Salessummary','门店销量汇总表')">
				<h2>门店销量汇总表</h2>
			</div>
		</div>

		<div class="layui-col-md4">
			<div class="layui-card" style="padding: 30px;text-align: center" onclick="Win10_child.openUrl('/index.php/table/Heavygas','商店重瓶液化气汇总表')">
				<h2>商店重瓶液化气汇总表</h2>
			</div>
		</div>
		<div class="layui-col-md4">
			<div class="layui-card" style="padding: 30px;text-align: center" onclick="Win10_child.openUrl('/index.php/table/opening','销量，开户统计表')">
				<h2>销量，开户统计表</h2>
			</div>
		</div>
		<div class="layui-col-md4">
			<div class="layui-card" style="padding: 30px;text-align: center" onclick="Win10_child.openUrl('/index.php/table/Borrow','用户借瓶情况汇总表')">
				<h2>用户借瓶情况汇总表</h2>
			</div>
		</div>
	</div>
</div>
</body>
</html>
