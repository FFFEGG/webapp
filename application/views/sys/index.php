<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>参数设置</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
</head>
<body>
<div style="padding: 20px; background-color: #F2F2F2;">
	<div class="layui-row layui-col-space15">
		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/carinfo','车辆信息')">
				<h1>车辆信息</h1>
			</div>
		</div>
		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/CompanyCarSubsidyFreight','车辆运输补贴单价')">
				<h1>车辆运输补贴单价</h1>
			</div>
		</div>

		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/CarCost','车辆运输费用')">
				<h1>车辆运输费用</h1>
			</div>
		</div>
		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/ChargeStandard','收费标准')">
				<h1>收费标准</h1>
			</div>
		</div>
		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center">
				<h1>客户端配置</h1>
			</div>
		</div>
		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/Department','部门配置')">
				<h1>部门配置</h1>
			</div>
		</div>
		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center">
				<h1>区域码信息</h1>
			</div>
		</div>
		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/CallType','来电类型')">
				<h1>来电类型</h1>
			</div>
		</div>
		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/CallReason','来电原因')">
				<h1>来电原因</h1>
			</div>
		</div>
		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/Goods','商品')">
				<h1>商品</h1>
			</div>
		</div>
		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/GoodsBrand','商品品牌')">
				<h1>商品品牌</h1>
			</div>
		</div>
		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/GoodsCat','商品分类')">
				<h1>商品分类</h1>
			</div>
		</div>
		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/GoodsSalesPromotion','商品促销方案')">
				<h1>商品促销方案</h1>
			</div>
		</div>
		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/GoodsType','商品类型')">
				<h1>商品类型</h1>
			</div>
		</div>
		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/MachineCode','设备码信息')">
				<h1>设备码信息</h1>
			</div>
		</div>
		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/NoSalesGoods','非单独销售商品')">
				<h1>非单独销售商品</h1>
			</div>
		</div>
		<div class="layui-col-md3" onclick="Win10_child.openUrl('/index.php/sys/Operator','员工')">
			<div class="layui-card" style="padding: 30px;text-align: center">
				<h1>员工</h1>
			</div>
		</div>
		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center">
				<h1>员工权限接</h1>
			</div>
		</div>
		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center">
				<h1>员工SNS信息</h1>
			</div>
		</div>

		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/Packingtype','包装物')">
				<h1>包装物</h1>
			</div>
		</div>

		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/Quarters','岗位配置')">
				<h1>岗位配置</h1>
			</div>
		</div>
		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/RepairObject','维修对象')">
				<h1>维修对象</h1>
			</div>
		</div>

		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/RepairPartsGoods','维修配件')">
				<h1>维修配件</h1>
			</div>
		</div>
		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/RepairType','维修类型')">
				<h1>维修类型</h1>
			</div>
		</div>

		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/SalesMashup','混搭方案')">
				<h1>混搭方案</h1>
			</div>
		</div>
		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/SalesMashupGoods','混搭方案商品')">
				<h1>混搭方案商品</h1>
			</div>
		</div>

		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/SecurityCheckProject','安检项目')">
				<h1>安检项目</h1>
			</div>
		</div>

		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/SecurityCheckType','安检类型')">
				<h1>安检类型</h1>
			</div>
		</div>
		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/TwohundredType','双百类型')">
				<h1>双百类型</h1>
			</div>
		</div>

		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/TwohundredItem','双百项目选项')">
				<h1>双百项目选项</h1>
			</div>
		</div>

		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/BuyPackingtypeParameter','收购包装物价格')">
				<h1>收购包装物价格</h1>
			</div>
		</div>
		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/FeiePrint','飞鹅打印机列表')">
				<h1>飞鹅打印机列表接口</h1>
			</div>
		</div>
		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/CouponTypeParameter','优惠券')">
				<h1>优惠券</h1>
			</div>
		</div>
		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/ExpandFreight','拓展运费参数列表')">
				<h1>拓展运费参数列表</h1>
			</div>
		</div>
		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/CompanyCarFreight','公司车辆运费参数')">
				<h1>公司车辆运费参数</h1>
			</div>
		</div>

		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center"
				 onclick="Win10_child.openUrl('/index.php/sys/CompanyCarBasicFreight','公司车辆基础运费')">
				<h1>公司车辆基础运费</h1>
			</div>
		</div>

		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center">
				<h1>权限</h1>
			</div>
		</div>
		<div class="layui-col-md3">
			<div class="layui-card" style="padding: 30px;text-align: center">
				<h1>权限模板</h1>
			</div>
		</div>

	</div>
</div>
</body>


</html>
