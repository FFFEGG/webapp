<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="<?php echo base_url(); ?>res/js/vue.js" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>res/js/axios.js" charset="utf-8"></script>
	<link href="<?php echo base_url(); ?>/res/css/tailwind-ui.min.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>res/js/sweetalert2.min.js"></script>
	<script src="<?php echo base_url(); ?>res/js/core.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/component/layer-v3.0.3/layer/layer.js"></script>
	<link href="<?php echo base_url(); ?>res/css/sweetalert2.min.css" rel="stylesheet">
	<title>物资管理</title>
</head>
<body>
	<div id="app" class="p-6">
		<div class="flex">
			<p onclick="Win10_child.openUrl('/index.php/allocation/planlist','门店计划调拨信息')" class="border shadow p-5 text-2xl px-8 cursor-pointer mr-10">门店计划调拨信息</p>
			<p onclick="Win10_child.openUrl('/index.php/allocation/materflow','物资流向')" class="border shadow p-5 text-2xl px-8 cursor-pointer mr-10">物资流向</p>
			<p onclick="Win10_child.openUrl('/index.php/allocation/dispatch','物资调运(液化气)')" class="border shadow p-5 text-2xl px-8 cursor-pointer mr-10">物资调运(液化气)</p>
			<p onclick="Win10_child.openUrl('/index.php/allocation/dispatchwater','物资调运')" class="border shadow p-5 text-2xl px-8 cursor-pointer mr-10">物资调运(桶装水)</p>
			<p onclick="Win10_child.openUrl('/index.php/allocation/dispatchwaterxs','普通销售品')" class="border shadow p-5 text-2xl px-8 cursor-pointer mr-10">物资调运(普通销售品)</p>
		</div>
		<div class="flex mt-5">
			<p onclick="Win10_child.openUrl('/index.php/ywpage/PackingtypeCirculationInfo','钢瓶流转信息')" class="border shadow p-5 text-2xl px-8 cursor-pointer mr-10">钢瓶流转信息</p>
			<p onclick="Win10_child.openUrl('/index.php/msg/AllocationMaterielFlow','查询调拨物资信息')" class="border shadow p-5 text-2xl px-8 cursor-pointer mr-10">查询调拨物资信息</p>
			<p onclick="Win10_child.openUrl('/index.php/msg/OpeStock?department=<?= get_cookie('department') ?>','查询部门员工商品包装物库存信息')" class="border shadow p-5 text-2xl px-8 cursor-pointer mr-10">查询部门员工商品包装物库存信息</p>
		</div>
	</div>
</body>
<script>
  new Vue({
      el: '#app'
  })
</script>
</html>
