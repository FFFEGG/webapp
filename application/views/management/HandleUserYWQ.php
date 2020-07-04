<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>办理业务气</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>

</head>
<body>

<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
	<legend>会员<?= $this->input->get('memberid') ?> - <?php echo $this->input->get('name'); ?>办理业务气</legend>
</fieldset>
<div class="oapd">


	<div class="layui-form-item">
		<label class="layui-form-label">办理记录
		</label>
		<div class="layui-input-block">
			<table class="layui-table" lay-size="">
				<thead>
				<tr>
					<th>办理时间</th>
					<th>办理方式</th>
					<th>商品ID</th>
					<th>售价方式</th>
					<th>单价</th>
					<th>办理数量</th>
					<th>剩余数量</th>
					<th>支付状态</th>
					<th>部门</th>
					<th>操作人</th>
					<th>状态</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($list as $v) {
					if ($v->remarks == '业务气') { ?>
						<tr>
						<?php foreach ($key as $vo) {
							if ($vo != 'id' && $vo != 'companyid' && $vo != 'serial' && $vo != 'userid' && $vo != 'remarks') { ?>

								<?php if ($vo == 'state') { ?>
									<td><?= getstate($v->$vo) ?></td>
								<?php } elseif ($vo == 'goodsid') { ?>
									<td><?= getoneGoodsById($v->$vo)['name'] ?></td>
								<?php } else { ?>
									<td><?= $v->$vo ?></td>
								<?php } ?>
							<?php }
						}
					} ?>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

	<?php echo form_open('', 'class="layui-form" id="ywq"'); ?>
	<input type="hidden" name="userid" value="<?= $this->input->get('userid') ?>">
	<input type="hidden" name="memberid" value="<?= $this->input->get('memberid') ?>">
	<input type="hidden" name="name" value="<?= $this->input->get('name') ?>">


	<div class="layui-form-item">
		<label class="layui-form-label">备注
		</label>
		<div class="layui-input-block">
			<input type="text" name="remarks" autocomplete="off" placeholder="备注"
				   class="layui-input">
		</div>
	</div>


	<div class="layui-form-item">
		<div class="layui-input-block">

			<button type="submit" class="layui-btn" lay-submit="" lay-filter="gpsgywq">确认办理</button>
		</div>
	</div>
	</form>

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
		//监听提交
		form.on('submit(gpsgywq)', function (data) {

			layer.open({
				type: 1
				,
				title: false //不显示标题栏
				,
				closeBtn: false
				,
				area: '400px;'
				,
				shade: 0.8
				,
				id: 'LAY_layuipro' //设定一个id，防止重复弹出
				,
				btn: ['确认', '取消']
				,
				btnAlign: 'c'
				,
				moveType: 1 //拖拽模式，0或者1
				,
				content: '<div  style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">' +
					'<h3>提示</h3>' +
					'<p>正在进行办理业务气操作！！</p>' +
					'</div>'
				,
				yes: function () {
					$('#ywq').submit();
				}
				,
				btn2: function () {
					layer.closeAll();
				}

			});

			return false;
		});
	});


</script>
<?php if (get_cookie('HandleUserYWQ')) { ?>
	<script>
		layui.use(['jquery', 'form', 'layedit', 'laydate', 'element'], function () {
			var form = layui.form
				, layer = layui.layer
				, layedit = layui.layedit
				, laydate = layui.laydate
				, element = layui.element
				, $ = layui.$; //重点处
			layer.msg('办理成功！');
			return false
		});
	</script>
<?php } ?>
<?php if (get_cookie('errorHandleUserYWQ')) { ?>
	<script>
		layui.use(['jquery', 'form', 'layedit', 'laydate', 'element'], function () {
			var form = layui.form
				, layer = layui.layer
				, layedit = layui.layedit
				, laydate = layui.laydate
				, element = layui.element
				, $ = layui.$; //重点处
			layer.msg('办理失败！');
			return false
		});
	</script>
<?php } ?>
</html>
