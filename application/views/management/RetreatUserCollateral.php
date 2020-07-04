<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>退款</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>

</head>
<body>

<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
	<legend>会员<?= $this->input->get('memberid') ?> - <?php echo $this->input->get('name'); ?>退抵押物退款</legend>
</fieldset>
<div class="oapd">


	<?php echo form_open('', 'class="layui-form" id="tdywform"'); ?>
	<input type="hidden" name="userid" value="<?= $this->input->get('userid') ?>">
	<input type="hidden" name="memberid" value="<?= $this->input->get('memberid') ?>">
	<input type="hidden" name="name" value="<?= $this->input->get('name') ?>">

	<div class="layui-form-item">
		<label class="layui-form-label">抵押物记录</label>
		<div class="layui-input-block">
			<table class="layui-table" lay-even="" lay-skin="row">
				<thead>
				<tr>
					<th>选择</th>
					<th>商品名称</th>
					<th>包装物</th>
					<th>价格</th>
					<th>票据号</th>
					<th>办理方式</th>
					<th>状态</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($warehouse as $v) {
					if ($v['state'] == 9 && $v['mode'] == '抵押物押金') { ?>

						<tr>
							<td>
								<input id="dywgoods_<?= $v['id'] ?>" type="radio" name="id"
									   value="<?= Myencode($v) ?>">
							</td>

							<td><?= $v['name'] ?></td>
							<td><?= $v['packingtype'] ?></td>
							<td><?= $v['price'] ?></td>
							<td><?= $v['billno'] ?></td>
							<td><?= $v['mode'] ?></td>
							<td><?= getstate($v['state']) ?></td>
						</tr>
						<?php foreach ($v['chargelist'] as $vi) { ?>
							<tr>
								<td colspan="7" style="font-weight: bold;padding-left: 10rem">
									<?= $vi['project'] ?>:<?= $vi['total'] ?> 时间<?= $vi['remarks'] ?>
								</td>
							</tr>
						<?php } ?>
					<?php }
				} ?>
				</tbody>
			</table>


		</div>
	</div>


	<div class="layui-form-item">
		<div class="layui-input-block">

			<button type="submit" class="layui-btn" lay-submit="" lay-filter="gpsg">确认办理</button>
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
		form.on('submit(gpsg)', function (data) {

			if (!data.field.id) {
				layer.msg('请选择抵押物');
				return false;
			}

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
						'<p>正在进行退抵押物退款操作！！</p>' +
						'</div>'
				,
				yes: function () {
					$('#tdywform').submit();
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
<?php if (get_cookie('RetreatUserCollateral')) { ?>
	<script>
		layui.use(['jquery', 'form', 'layedit', 'laydate', 'element'], function () {
			var form = layui.form
					, layer = layui.layer
					, layedit = layui.layedit
					, laydate = layui.laydate
					, element = layui.element
					, $ = layui.$; //重点处
			layer.msg('退抵押物退款成功！');
			return false
		});
	</script>
<?php } ?>
<?php if (get_cookie('errorRetreatUserCollateral')) { ?>
	<script>
		layui.use(['jquery', 'form', 'layedit', 'laydate', 'element'], function () {
			var form = layui.form
					, layer = layui.layer
					, layedit = layui.layedit
					, laydate = layui.laydate
					, element = layui.element
					, $ = layui.$; //重点处
			layer.msg('退款失败！');
			return false
		});
	</script>
<?php } ?>


<?php if (get_cookie('printinfo')) { ?>
	<script src="<?php echo base_url(); ?>res/js/axios.js" charset="utf-8"></script>
	<script>
		const data = <?= get_cookie('printinfo') ?>;
		console.log(data)
		if (data.type == '抵押物退款单' && '<?= get_cookie('department')?>' == '发卡室') {

			var jsonp = {
				Memo1: "南宁三燃燃气有限责任公司退款单",
				Memo2: data.topinfo,
				Memo4: "卡号 " + data.memberid,
				Memo5: "姓名 " + data.name,
				Memo6: "电话 " + data.telephone,
				Memo7: "部门 发卡室",
				Memo8: "退瓶数量：1" + data.other,
				Memo9: "",
				Memo10: "用户签名:",
				Memo11: '',
			}
			var data_infop = {
				PrintData: jsonp,
				Print: true
			}
			axios.get('http://127.0.0.1:8000/api/print/order/20/?data=' + JSON.stringify(data_infop)).then(rew => {
				console.log(rew)
			})
		}

		if (data.type == '抵押物退款单' != '<?= get_cookie('department')?>' != '发卡室') {

			var jsonp = {
				title: "南宁三燃公司退抵押物退款单",
				time: data.topinfo,
				memberid: "卡号 " + data.memberid,
				name: "姓名 " + data.name,
				tel: "电话 " + data.telephone,
				address: "地址 " + data.address,
				department: data.department,
				Memo1: '退瓶数量：1',
				Memo2: data.other,
				Memo4: '操作员: ' + data.operator,
				Memo5: '用户签名：'
			}
			var data_infop = {
				PrintData: jsonp,
				Print: true
			}
			axios.get('http://127.0.0.1:8000/api/print/order/6/?data=' + JSON.stringify(data_infop)).then(rew => {
				console.log(rew)
			})
		}
	</script>
<?php } ?>

</html>
