<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>门店报表</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
</head>
<body>
<div style="padding: 20px; background-color: #F2F2F2;min-height: 600px">
	<div class="layui-row layui-col-space15">
		<div class="layui-col-md4">
			<div class="layui-card" style="padding: 30px;text-align: center" onclick="Win10_child.openUrl('/index.php/table/mdStoreReport','门店库存报表')">
				<h2>门店库存报表</h2>
			</div>
		</div>

		<div class="layui-col-md4">
			<div class="layui-card" style="padding: 30px;text-align: center" onclick="Win10_child.openUrl('/index.php/table/mdsaletable','门店商品销售报表')">
				<h2>门店商品销售报表</h2>
			</div>
		</div>

		<div class="layui-col-md4">
			<div class="layui-card" style="padding: 30px;text-align: center" onclick="Win10_child.openUrl('/index.php/table/mssktable','门店收款报表')">
				<h2>门店收款报表</h2>
			</div>
		</div>


		<div class="layui-col-md4">
			<div class="layui-card" style="padding: 30px;text-align: center" onclick="Win10_child.openUrl('/index.php/table/waterkc','桶装水库存')">
				<h2>桶装水库存</h2>
			</div>
		</div>

		<div class="layui-col-md4">
			<div class="layui-card" style="padding: 30px;text-align: center" onclick="Win10_child.openUrl('/index.php/table/salekc','销售品库存')">
				<h2>销售品库存</h2>
			</div>
		</div>


		<div class="layui-col-md4">
			<div class="layui-card" style="padding: 30px;text-align: center" onclick="Win10_child.openUrl('/index.php/table/DepartmentWaterBill','水票核销报表')">
				<h2>水票核销报表</h2>
			</div>
		</div>
	</div>
</div>
</body>
</html>
