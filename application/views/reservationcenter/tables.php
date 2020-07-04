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
	<title>报表</title>
</head>
<body>
	<div id="app" class="p-6">
		<div class="flex">
			<p onclick="Win10_child.openUrl('/index.php/ywpage/DepartmentReceivables?endtime=<?= date('Y-m-d') ?>','  门店收款报表')" class="border shadow p-5 text-2xl px-8 cursor-pointer mr-10">门店收款报表</p>
			<p onclick="Win10_child.openUrl('/index.php/ywpage/DepartmentGoodsStock?endtime=<?= date('Y-m-d') ?>','  门店商品物资库存报表')" class="border shadow p-5 text-2xl px-8 cursor-pointer mr-10">门店商品物资库存报表</p>
			<p onclick="Win10_child.openUrl('/index.php/ywpage/DepartmentGoodsSale?endtime=<?= date('Y-m-d') ?>','  门店商品物资销售报表')" class="border shadow p-5 text-2xl px-8 cursor-pointer mr-10">门店商品物资销售报表</p>
		</div>


	</div>
</body>
<script>
  new Vue({
      el: '#app'
  })
</script>
</html>
