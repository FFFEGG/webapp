<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>用户仓库商品使用记录</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script src="<?php echo base_url(); ?>res/js/sweetalert2.min.js"></script>
	<script src="<?php echo base_url(); ?>res/js/core.js"></script>
	<link href="<?php echo base_url(); ?>res/css/sweetalert2.min.css" rel="stylesheet">
</head>
<body>
<style>
	.btn-success {
		background: blue;
		padding: 10px;
		color: #F2F2F2;
		border-radius: 3px;
		margin: 0 5px;
	}

	.btn-danger {
		background: red;
		padding: 10px;
		color: #F2F2F2;
		border-radius: 3px;
		margin: 0 5px;
	}
</style>
<div class="oapd">
	<blockquote class="layui-elem-quote layui-text" style="font-weight: bold;font-size: 20px;color: #222;">
		用户仓库商品使用记录
	</blockquote>

	<div class="layui-form">
		<table class="layui-table">
			<thead>
			<tr>
				<?php foreach ($title as $v) { ?>
					<th><?= $v ?></th>
				<?php } ?>
				<th>价格</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($list as $v) { ?>
				<tr>
					<?php foreach ($key as $vo) { ?>
						<?php if ($vo == 'state') { ?>
							<td><?= getstate($v->$vo) ?></td>
						<?php } elseif ($vo == 'goodsid') { ?>
							<td><?= getoneGoodsById($v->$vo)['name'] ?></td>
						<?php } else { ?>
							<td><?= $v->$vo ?></td>
						<?php } ?>
					<?php } ?>
					<?php if ($v->state == 1) { ?>
						<td>
							<button onclick="FeedbackArrears('<?= Myencode($v) ?>')" class="layui-btn-sm layui-btn">还款
							</button>
						</td>
					<?php } ?>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>
</body>
<script src="<?php echo base_url(); ?>/res/layui/layui.js" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>res/js/axios.js" charset="utf-8"></script>
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

	function FeedbackArrears(data) {
		swal({
			title: '确定还款操作？',
			text: '',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: '确定',
			cancelButtonText: '取消',
			confirmButtonClass: 'btn btn-success',
			cancelButtonClass: 'btn btn-danger',
			buttonsStyling: false
		}).then(function (datas) {
			if (datas.value) {
			  axios.post('/index.php/api/FeedbackArrears',{
                info: data,
				total: datas.value
			  }).then(rew=>{
                if (rew.code == 200) {
                  swal(
                    '成功！',
                    '还款操作成功',
                    'success'
                  );
                } else {
                  swal(
                    '失败！',
                    '',
                    'error'
                  );
                }
                setTimeout(function () {
                  $('.submitsss').submit()
                }, 1000)
			  })
			}
		})
	}
</script>

</html>
