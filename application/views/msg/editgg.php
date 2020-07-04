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
	<script src="<?php echo base_url(); ?>res/js/win10.child.js"></script>
	<link href="<?php echo base_url(); ?>res/css/sweetalert2.min.css" rel="stylesheet">
	<title>Document</title>
</head>
<body>
	<div class="p-6" >
		<button onclick="Win10_child.openUrl('/index.php/msg/gg','发布公告')" class="bg-teal-500 text-white py-2 px-3 mb-3">发布公告</button>
		<table class="table-auto w-full text-sm">
			<thead>
			<tr>
				<th class=" border">时间</th>
				<th class=" border">公布时间</th>
				<th class=" border">结束时间</th>
				<th class=" border">标题</th>
				<th class=" border">发布人</th>
				<th class=" border">排序</th>
				<th class=" border">状态</th>
				<th class=" border">编辑员工号</th>
				<th class=" border">编辑人</th>
				<th class=" border">操作</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($list as $v) {?>
			<tr class="text-center">
				<td class="border "><?= substr($v['addtime'],5,5)?></td>
				<td class="border "><?=  substr($v['begintime'],5,5)?></td>
				<td class="border "><?=  substr($v['endtime'],5,5)?></td>
				<td class="border "><?= $v['title']?></td>
				<td class="border "><?= $v['issuer']?></td>
				<td class="border "><?= $v['sort']?></td>
				<td class="border "><?= getstate($v['state'])?></td>
				<td class="border "><?= ($v['opeid'])?></td>
				<td class="border "><?= ($v['operator'])?></td>
				<td class="border ">
					<button onclick="Win10_child.openUrl('/index.php/msg/ggedit?info=<?= Myencode($v)?>','修改')" class="bg-teal-500 text-white p-1">修改</button>
				</td>
			</tr>
			<?php }?>
			</tbody>
		</table>
	</div>
</body>
<script>
  new Vue({
      el: '#app'
  })
</script>
</html>
