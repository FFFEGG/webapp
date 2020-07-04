<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>调拨信息</title>
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
						   value="<?= $this->input->get('begintime') ? $this->input->get('begintime') : date('Y-m-d', (time() - 3600 * 24)) ?>"
						   name="begintime" id="date1"
						   placeholder="yyyy-MM-dd" autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">结束时间</label>
				<div class="layui-input-inline">
					<input type="text" name="endtime"
						   value="<?= $this->input->get('endtime') ? $this->input->get('endtime') : date('Y-m-d', (time() - 3600 * 24)) ?>"
						   id="date2"
						   placeholder="yyyy-MM-dd" autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">来源部门</label>
				<div class="layui-input-inline">
					<select name="source">
						<option value="全部">全部</option>
						<?php foreach ($_SESSION['initData']->Department->info as $v) {
							if ($v->type == '业务门店') { ?>
								<option <?php if ($v->name == $this->input->get('source')) {
									echo 'selected';
								}
							} ?> value="<?= $v->name ?>"><?= $v->name ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<button class="layui-btn" type="submit"> 搜索</button>
		</div>

	</form>
	<div class="layui-form">
		<table class="layui-table">
			<thead>
			<tr>
				<th>时间</th>
				<th>来源</th>
				<th>方式</th>
				<th>商品</th>
				<th>备注</th>
				<th>状态</th>
				<th>操作</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($list as $v) { ?>
				<tr>
					<td><?= $v['addtime'] ?></td>
					<td><?= $v['source'] ?></td>
					<td><?= $v['mode'] ?></td>
					<td><?php foreach ($v['goodslist'] as $vi) { ?> <p><?= $vi['goodsname'] ?>
							X <?= $vi['num'] ?></p><?php } ?></td>
					<td><?= $v['remarks'] ?></td>
					<td><?= getstate($v['state']) ?></td>
					<?php if ($v['state'] == 101) { ?>
						<td>
							<button class="layui-btn layui-btn-disabled">已安排
							</button>
						</td>
					<?php } else { ?>
						<td>
							<button
								onclick="Win10_child.openUrl('/index.php/allocation/dispatchs?data=<?= Myencode($v) ?>','物资调运')"
								class="layui-btn">安排
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


</script>
<?php if (get_cookie('plan')) { ?>
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
