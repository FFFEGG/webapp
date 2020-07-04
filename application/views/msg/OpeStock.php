
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>查询部门员工商品包装物库存信息</title>
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
		<form action="" method="get">
			<div class="layui-inline">
				<input type="hidden" name="userid" value="<?php echo $_GET['userid'] ?>">
				<input type="hidden" name="name" value="<?php echo $_GET['name'] ?>">
				<input type="hidden" name="memberid" value="<?php echo $_GET['memberid'] ?>">
				<label class="layui-form-label" style="padding: 9px 0;text-align: left">查询日期</label>
				<div class="layui-input-inline">
					<input type="text" name="begintime" id="begintime" lay-verify="date" value="<?= $this->input->get('begintime')?$this->input->get('begintime'):date('Y-m-d')?>"
						   placeholder="yyyy-MM-dd" autocomplete="off" class="layui-input">
				</div>
				<div class="layui-form-mid">-</div>
				<div class="layui-input-inline">
					<input type="text" name="endtime" id="endtime" lay-verify="date"
						   value="<?= $this->input->get('endtime')?$this->input->get('endtime'):date('Y-m-d')?>" placeholder="yyyy-MM-dd" autocomplete="off"
						   class="layui-input">
				</div>
				<div class="layui-input-inline">
					<select name="opename" id="">
						<?php foreach ($Operator as $v) {?>
							<?php foreach ($v as $vi) {?>
								<?php if($vi['quartersid'] == 7) { ?>
									<option <?php if ($this->input->get('opename') == $vi['name']) { echo 'selected';}?>  value="<?= $vi['name']?>"><?= $vi['name']?></option>
								<?php }?>
							<?php }?>

						<?php }?>


						<?php foreach ($_SESSION['AreaDeliverymanList'] as $vi) {?>
							<option <?php if ($this->input->get('opename') == $vi->name) { echo 'selected';}?>  value="<?= $vi->name?>"><?= $vi->name?></option>

						<?php }?>
					</select>
				</div>
				<div class="layui-input-inline">
					<select name="department" id="">
						<?php foreach ($department as $v) {?>
							<option <?php if ($this->input->get('department') == $v['name']) { echo 'selected';}?>   value="<?= $v['name']?>"><?= $v['name']?></option>
						<?php }?>
					</select>
				</div>

				<div class="layui-input-inline">
					<label class="layui-form-label" style="width: 30px">状态</label>
					<div class="layui-input-block" style="margin-left: 62px">
						<select name="state" lay-filter="aihao">
							<option <?php if ($this->input->get('state') == '全部') { echo 'selected';}?> value="全部">全部</option>
							<option <?php if ($this->input->get('state') == '正常') { echo 'selected';}?> value="正常">正常</option>
							<option <?php if ($this->input->get('state') == '待确认入库') { echo 'selected';}?> value="待确认入库">待确认入库</option>
							<option <?php if ($this->input->get('state') == '待确认出库') { echo 'selected';}?> value="待确认出库">待确认出库</option>
							<option <?php if ($this->input->get('state') == '已确认出库') { echo 'selected';}?> value="已确认出库">已确认出库</option>
						</select>
					</div>
				</div>
				<button class="layui-btn" type="submit">查询</button>
			</div>
		</form>

	</div>
	<div class="layui-form">
		<table class="layui-table" lay-size="sm">
			<thead>
			<tr>
				<?php foreach ($title as $v) {?>
					<th><?= $v ?></th>
				<?php }?>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($list as $v) {?>
				<tr>
					<?php foreach ($key as $vo) {?>
						<?php if ($vo == 'state') {?>
							<td><?= getstate($v->$vo) ?></td>
						<?php }else{?>
							<td><?= $v->$vo?></td>
						<?php }?>
					<?php }?>
				</tr>
			<?php }?>
			</tbody>

		</table>
		<div style="font-size: 15px;font-weight: bold">
			合计:
			<?php foreach ($typelist as $k=>$v) {?>
				<?= $k ?> : <?=count( $typelist[$k] )?> 个 &nbsp;&nbsp;&nbsp;
			<?php }?>
		</div>
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
