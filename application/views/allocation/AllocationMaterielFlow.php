<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>上传物资</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>

</head>
<body>
<div class="oapd">

	<form class="layui-form" action="" method="get">
		<div class="layui-form-item">
			<div class="layui-inline">
				<label class="layui-form-label">开始时间</label>
				<div class="layui-input-inline">
					<input type="text"
						   value="<?= $this->input->get('begintime') ? $this->input->get('begintime') : date('Y-m-d') ?>"
						   name="begintime" id="date1"
						   placeholder="yyyy-MM-dd" autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">结束时间</label>
				<div class="layui-input-inline">
					<input type="text" name="endtime"
						   value="<?= $this->input->get('endtime') ? $this->input->get('endtime') : date('Y-m-d') ?>"
						   id="date2"
						   placeholder="yyyy-MM-dd" autocomplete="off" class="layui-input">
				</div>
			</div>

			<div class="layui-inline">
				<div class="layui-input-inline">
					<div class="layui-input-inline">
						<input type="radio" name="mode" value="调入"
							   title="调入" <?php if ($this->input->get('mode') == '调入' || $this->input->get('receiving') == '') {
							echo 'checked=""';
						} ?> >
						<input type="radio" name="mode" value="调出"
							   title="调出" <?php if ($this->input->get('mode') == '调出') {
							echo 'checked=""';
						} ?> >
					</div>
				</div>
			</div>
			<button class="layui-btn" type="submit"> 搜索</button>
			<button onclick="Win10_child.openUrl('/index.php/allocation/sfuploadmaterial','调出钢瓶')" class="layui-btn"
					type="button"> 调出钢瓶
			</button>

			<button onclick="Win10_child.openUrl('/index.php/allocation/folduploadmaterial','调入钢瓶')" class="layui-btn"
					type="button"> 调入钢瓶
			</button>

			<?php if (get_cookie('department') == '运输公司') { ?>
				<button onclick="Win10_child.openUrl('/index.php/transportpage/OpeStock?department=<?= get_cookie('department') ?>','员工库存')"
						class="layui-btn" type="button"> 员工库存
				</button>
			<?php } else { ?>
				<button onclick="Win10_child.openUrl('/index.php/msg/OpeStock?department=<?= get_cookie('department') ?>','员工库存')"
						class="layui-btn" type="button"> 员工库存
				</button>

			<?php } ?>
		</div>

	</form>
	<div class="layui-form">
		<table class="layui-table">
			<thead>
			<tr>
				<th>时间</th>
				<th>来源</th>
				<th>录入人</th>
				<th>车号</th>
				<th>经手人</th>
				<th>方式</th>
				<th>商品名称</th>
				<th>包装物</th>
				<th>单位</th>
				<th>容量单位</th>
				<th>类型</th>
				<th>数量</th>
				<th>确认数量</th>
				<th>业务部门</th>
				<th>操作员</th>
				<th>状态</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($list as $v) { ?>
				<tr class="dbxx_item" onclick="ap('<?= Myencode($v) ?>')">
					<td><?= $v['addtime'] ?></td>
					<td><?= $v['source'] ?></td>
					<td><?= $v['originator'] ?></td>
					<td><?= $v['car_no'] ?></td>
					<td><?= $v['brokerage'] ?></td>
					<td><?= $v['mode'] ?></td>
					<td><?= $v['goodsname'] ?></td>
					<td><?= $v['packingtype'] ?></td>
					<td><?= $v['unit'] ?></td>
					<td><?= $v['capacityunit'] ?></td>
					<td><?= $v['suttle'] > 0 ? '重' : '空' ?></td>
					<td><?= $v['num'] ?></td>
					<td><?= $v['confirm_num'] ?></td>
					<td><?= $v['department'] ?></td>
					<td><?= $v['operator'] ?></td>
					<td><?= getstate($v['state']) ?></td>
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
				, $ = layui.$; //重点处

		laydate.render({
			elem: '#date1'
		});
		laydate.render({
			elem: '#date2'
		});

	});

	function ap(data) {
		Win10_child.openUrl('/index.php/allocation/uploadmaterial?data=' + data, '上传物资信息');
		return false
	}
</script>
<?php if (get_cookie('dbxx')) { ?>
	<script>
		layui.use(['jquery', 'form', 'layedit', 'laydate', 'element'], function () {
			var form = layui.form
					, layer = layui.layer
					, layedit = layui.layedit
					, laydate = layui.laydate
					, element = layui.element
					, $ = layui.$; //重点处
			layer.msg('办理成功！');
			return false;
		});
	</script>
<?php } ?>

</html>
