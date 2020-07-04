<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>车辆运输费用</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
</head>
<body>
<div class="oapd">

	<div class="layui-form-item layui-form">
		<form action="" method="get" class="">
			<div class="layui-inline">

				<select name="state" id="" class="layui-input-inline">
					<option <?php if ($this->input->get('state') == '全部') {
						echo 'selected';
					} ?> value="全部">全部
					</option>
					<option <?php if ($this->input->get('state') == '正常') {
						echo 'selected';
					} ?> value="正常">正常
					</option>
					<option <?php if ($this->input->get('state') == '取消') {
						echo 'selected';
					} ?> value="取消">取消
					</option>
				</select>

			</div>

			<div class="layui-inline">
				<select name="type" id="" class="layui-input-inline">
					<option value=""></option>
					<option <?php if ($this->input->get('mode') == '代销运费模式') {
						echo 'selected';
					} ?> value="代销运费模式">代销运费模式
					</option>
					<option <?php if ($this->input->get('mode') == '代销装卸费模式') {
						echo 'selected';
					} ?> value="代销装卸费模式">代销装卸费模式
					</option>
					<option <?php if ($this->input->get('mode') == '调拨装卸费模式') {
						echo 'selected';
					} ?> value="调拨装卸费模式">调拨装卸费模式
					</option>
					<option <?php if ($this->input->get('mode') == '直送运费模式') {
						echo 'selected';
					} ?> value="直送运费模式">直送运费模式
					</option>
					<option <?php if ($this->input->get('mode') == '直送装卸费模式') {
						echo 'selected';
					} ?> value="直送装卸费模式">直送装卸费模式
					</option>
				</select>

			</div>
			<div class="layui-inline">
				<select name="mode" id="" class="layui-input-inline">
					<option value=""></option>
					<option <?php if ($this->input->get('mode') == '安吉专线(非承包车)') {
						echo 'selected';
					} ?> value="安吉专线(非承包车)">安吉专线(非承包车)
					</option>
					<option <?php if ($this->input->get('mode') == '高新专线(承包车)') {
						echo 'selected';
					} ?> value="高新专线(承包车)">高新专线(承包车)
					</option>
					<option <?php if ($this->input->get('mode') == '明阳方向(非承包车)') {
						echo 'selected';
					} ?> value="明阳方向(非承包车)">明阳方向(非承包车)
					</option>
					<option <?php if ($this->input->get('mode') == '配送工商用气(承包车)') {
						echo 'selected';
					} ?> value="配送工商用气(承包车)">配送工商用气(承包车)
					</option>
					<option <?php if ($this->input->get('mode') == '配送门店(承包车)') {
						echo 'selected';
					} ?> value="配送门店(承包车)">配送门店(承包车)
					</option>
					<option <?php if ($this->input->get('mode') == '三塘方向(非承包车)') {
						echo 'selected';
					} ?> value="三塘方向(非承包车)">三塘方向(非承包车)
					</option>
					<option <?php if ($this->input->get('mode') == '三塘专线(承包车)') {
						echo 'selected';
					} ?> value="三塘专线(承包车)">三塘专线(承包车)
					</option>
					<option <?php if ($this->input->get('mode') == '沙井方向(非承包车)') {
						echo 'selected';
					} ?> value="沙井方向(非承包车)">沙井方向(非承包车)
					</option>
					<option <?php if ($this->input->get('mode') == '坛洛方向(非承包车)') {
						echo 'selected';
					} ?> value="坛洛方向(非承包车)">坛洛方向(非承包车)
					</option>
					<option <?php if ($this->input->get('mode') == '下午班(非承包车)') {
						echo 'selected';
					} ?> value="下午班(非承包车)">下午班(非承包车)
					</option>
					<option <?php if ($this->input->get('mode') == '移动A(非承包车)') {
						echo 'selected';
					} ?> value="移动A(非承包车)">移动A(非承包车)
					</option>
					<option <?php if ($this->input->get('mode') == '移动B(非承包车)') {
						echo 'selected';
					} ?> value="移动B(非承包车)">移动B(非承包车)
					</option>
				</select>


			</div>
			<div class="layui-inline">
				<button class="layui-btn " type="submit">筛选</button>
			</div>
		</form>
		<div class="layui-inline">
			<div class="layui-inline">
				<button class="layui-btn" type="button"
						onclick="Win10_child.openUrl('/index.php/sys/CarCost_form?action=ADD','车辆运输费用')">新增
				</button>
			</div>
		</div>
	</div>
	<div class="layui-form">
		<table class="layui-table">
			<thead>
			<tr>
				<?php foreach ($info['data']['title'] as $v) { ?>
					<th><?= $v ?></th>
				<?php } ?>
				<th>操作</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($info['data']['info'] as $v) { ?>
				<?php if (($v['type'] == $this->input->get('type') || $this->input->get('type') == '') && ($v['mode'] == $this->input->get('mode') || $this->input->get('mode') == '')) { ?>
					<tr>
						<?php foreach ($info['data']['key'] as $vo) { ?>
							<?php if ($vo == 'state') { ?>
								<td><?= getstate($v[$vo]) ?></td>
							<?php } else { ?>
								<td><?= $v[$vo] ?></td>
							<?php } ?>
						<?php } ?>
						<td>
							<button onclick="Win10_child.openUrl('/index.php/sys/CarCost_form?action=UPDATE&id=<?= Myencode($v) ?>','车辆运输费用')"
									class="layui-btn">修改
							</button>
						</td>
					</tr>
				<?php } ?>
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
				, $ = layui.$;
		//日期
		laydate.render({
			elem: '#begintime'
		});
		laydate.render({
			elem: '#endtime'
		});

	});
</script>

</html>
