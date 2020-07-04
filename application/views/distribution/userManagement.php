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
	<title>员工管理</title>
</head>
<body>
	<div id="app" class="p-6">
		<div class="flex">
			<p onclick="Win10_child.openUrl('/index.php/msg/StaffArrearsRecord','员工欠款记录')" class="border shadow p-5 text-2xl px-8 cursor-pointer mr-10">员工欠款记录</p>
			<p onclick="Win10_child.openUrl('/index.php/msg/DepartmentPersonnelWorkload','员工工作量')" class="border shadow p-5 text-2xl px-8 cursor-pointer mr-10">员工工作量</p>
			<p onclick="Win10_child.openUrl('/index.php/ywpage/DepartmentApplyeDeliverymanSubsidyRecord?endtime=<?= date('Y-m-d') ?>','配送员补贴记录')" class="border shadow p-5 text-2xl px-8 cursor-pointer mr-10">配送员补贴记录</p>
			<p onclick="Win10_child.openUrl('/index.php/msg/DepartmentCanApplyeDeliverymanSubsidyRecord?endtime=<?= date('Y-m-d') ?>','可申请配送员补贴记录')" class="border shadow p-5 text-2xl px-8 cursor-pointer mr-10">可申请配送员补贴记录</p>
			<p onclick="Win10_child.openUrl('/index.php/msg/AreaDeliverymanList','配送员名单')" class="border shadow p-5 text-2xl px-8 cursor-pointer mr-10">配送员名单</p>

		</div>


	</div>
</body>
<script>
  new Vue({
      el: '#app'
  })
</script>
</html>
