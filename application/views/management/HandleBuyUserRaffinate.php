<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>残液收购</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>

</head>
<body>
<style>
	.layui-form-label {
		width: 100px;
	}

	.layui-input-block {
		margin-left: 137px;
	}
</style>
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
	<legend>会员<?= $this->input->get('memberid') ?> - <?php echo $this->input->get('name'); ?>残液收购</legend>
</fieldset>
<div class="oapd">

	<div class="layui-form-item">
		<label class="layui-form-label">订单信息

		</label>
		<div class="layui-input-block">

			<div class="layui-form">
				<table class="layui-table" lay-size="">
					<thead>
					<tr>
						<th>单据号</th>
						<th>交易时间</th>
						<th>商品名称</th>

						<th>数量</th>
						<th>净重</th>
						<th>小计</th>

					</tr>
					</thead>
					<tbody>
					<?php foreach ($list as $k => $v) if ($k <= 4) {
						{ ?>
							<tr class="order">
								<td><?= $v['serial'] ?></td>

								<td><?= $v['addtime'] ?></td>

								<td><?= $v['goodsname'] ?></td>

								<td><?= $v['num'] ?></td>
								<td><?= $v['suttle'] ?></td>
								<td><?= $v['total'] ?></td>

							</tr>
						<?php }
					} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>


	<?php echo form_open('', 'class="layui-form" id="cysg"'); ?>
	<input type="hidden" name="userid" value="<?= $this->input->get('userid') ?>">
	<input type="hidden" name="memberid" value="<?= $this->input->get('memberid') ?>">
	<input type="hidden" name="name" value="<?= $this->input->get('name') ?>">
	<input type="hidden" name="salesman" value="<?= $this->input->get('salesman') ?>">
	<input type="hidden" name="serialsale" value="">

	<div class="layui-form-item">
		<label class="layui-form-label">销售单据号</label>
		<div class="layui-input-block">
			<input type="text" name="serial" disabled autocomplete="off" placeholder="销售单据号"
				   class="layui-input">
		</div>
	</div>


	<div class="layui-form-item">
		<label class="layui-form-label">包装物类型</label>
		<div class="layui-input-block">
			<select name="packingtype" lay-filter="aihao" lay-verify="required" lay-search="">
				<option value=""></option>
				<?php foreach ($_SESSION['initData']->Packingtype->info as $v) { ?>
					<option
						value="<?= $v->name ?>"><?= $v->name ?></option>
				<?php } ?>

			</select>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">折公斤单价

		</label>
		<div class="layui-input-block">
			<input type="text" name="price"  lay-verify="required" autocomplete="off" placeholder="折公斤单价"
				   class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">折公斤重量

		</label>
		<div class="layui-input-block">
			<input type="text" name="num" lay-verify="required" autocomplete="off" placeholder="折公斤重量"
				   class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">钢瓶条码

		</label>
		<div class="layui-input-block">
			<input type="text" name="code" autocomplete="off" placeholder="钢瓶条码"
				   class="layui-input">
		</div>
	</div>


	<div class="layui-form-item">
		<label class="layui-form-label">经手人\业务员
		</label>
		<div class="layui-input-block">
			<input type="text" name="brokerage" value="<?= $_SESSION['users']->name ?>" autocomplete="off"
				   placeholder="经手人\业务员"
				   class="layui-input">
		</div>
	</div>


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

			<button type="submit" class="layui-btn" lay-submit="" lay-filter="cysgsubmit">确认办理</button>
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
		form.on('submit(cysgsubmit)', function (data) {
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
					'<h3>信息确认</h3>' +
					'<p>票据号:' + data.field.serialsale + '</p>' +
					'<p>包装物类型:' + data.field.packingtype + '</p>' +
					'<p>折公斤单价:' + data.field.price + '</p>' +
					'<p>折公斤重量:' + data.field.num + '</p>' +
					'<p>钢瓶条码:' + data.field.code + '</p>' +
					'<p>经手人\业务员:' + data.field.brokerage + '</p>' +
					'<p>备注:' + data.field.remarks + '</p></div>'
				,
				yes: function () {
					$('#cysg').submit();
				}
				,
				btn2: function () {
					layer.closeAll();
				}

			});

			return false;
		});
		$('.order').click(function () {
			$(this).css({background: 'grey', color: 'white'}).siblings().css({background: 'none', color: 'black'});
			$("input[name='serialsale']").val($(this).children()[0]['innerText']);
			$("input[name='serial']").val($(this).children()[0]['innerText']);
			$("input[name='price']").val((Number($(this).children()[5]['innerText']) / (Number($(this).children()[4]['innerText']) * Number($(this).children()[3]['innerText']))).toFixed(2))
			form.render()
		})
	});


</script>
<?php if (get_cookie('HandleBuyUserRaffinate')) { ?>
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
<?php if (get_cookie('errorHandleBuyUserRaffinate')) { ?>
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
