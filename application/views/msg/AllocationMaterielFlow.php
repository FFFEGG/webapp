
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>查询调拨物资信息</title>
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
					<label class="layui-form-label" style="width: 30px">方式</label>
					<div class="layui-input-block" style="margin-left: 62px">
						<select name="mode" lay-filter="aihao">
							<option <?php if ($this->input->get('mode') == '调入') { echo 'selected';}?> value="调入">调入</option>
							<option <?php if ($this->input->get('mode') == '调出') { echo 'selected';}?> value="调出">调出</option>
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
				<tr onclick="ap('<?= Myencode($v) ?>',<?= $v->state?>)">
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

    function ap(data,state) {

       /* if (state == 1) {
            Win10_child.openUrl('/index.php/allocation/uploadmaterial?data=' + data, '上传物资信息');
            return false
        }*/
    }
</script>

</html>
