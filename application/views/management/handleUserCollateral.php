<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>办理抵押物</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script src="<?php echo base_url(); ?>res/js/axios.js" charset="utf-8"></script>
</head>
<body>

<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
	<legend>会员<?= $this->input->get('memberid') ?> - <?php echo $this->input->get('name'); ?>抵押物办理</legend>
</fieldset>
<div class="oapd">


	<?php echo form_open('', 'class="layui-form" id="dywform"'); ?>
	<input type="hidden" name="userid" value="<?= $this->input->get('userid') ?>">
	<input type="hidden" name="memberid" value="<?= $this->input->get('memberid') ?>">
	<input type="hidden" name="name" value="<?= $this->input->get('name') ?>">
	<input type="hidden" name="price" class="price_radio" value="">

	<div class="layui-form-item">
		<label class="layui-form-label">商品
		</label>
		<div class="layui-input-block">
			<table class="layui-table" lay-even="" lay-skin="row">
				<thead>
				<tr>
					<th>选择</th>
					<th>办理方式</th>
					<th>商品名称</th>
					<th>包装物</th>
					<th>优惠方式</th>
					<th>单价</th>
					<th>优惠价格</th>
					<th>实际价格</th>

				</tr>
				</thead>
				<tbody>
				<?php foreach ($goods as $v) { ?>
					<?php if ($v['mode'] == '抵押物押金') { ?>
						<tr style="background: #f2f2f2">
					<?php } else { ?>
						<tr style="background: white">
					<?php } ?>
					<td>
						<input id="dywgoods_<?= $v['id'] ?>" type="radio" name="goodsid"
							   value="<?= $v['id'] . '|' . $v['name'] . $v['packingtype'] . '|' . $v['mode'] . '|' . ($v['price'] - $v['yhprice']) ?>">
					</td>
					<td><?= $v['mode'] ?></td>
					<td><?= $v['name'] ?></td>
					<td><?= $v['packingtype'] ?></td>
					<td><?= $v['salestype'] ?></td>
					<td><?= number_format($v['price'], 2) ?></td>
					<td><?= number_format($v['yhprice'], 2) ?></td>
					<td style="color: red;font-weight: bold">￥<?= $v['price'] - $v['yhprice'] ?></td>

					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>


	<div class="layui-form-item">
		<label class="layui-form-label">票据号
		</label>
		<div class="layui-input-block">
			<input type="text" value="<?= date('mdHis') . rand(0, 99) ?>" name="billno" lay-verify="required"
				   autocomplete="off" placeholder="票据号"
				   class="layui-input">
		</div>
	</div>

	<!--	<div class="layui-form-item">-->
	<!--		<label class="layui-form-label">数量-->
	<!--		</label>-->
	<!--		<div class="layui-input-block">-->
	<!--			<input type="text" value="1" name="num" lay-verify="required" autocomplete="off" placeholder="数量"-->
	<!--				   class="layui-input">-->
	<!--		</div>-->
	<!--	</div>-->

	<div class="layui-form-item">
		<label class="layui-form-label">备注
		</label>
		<div class="layui-input-block">
			<input type="text" name="remarks" autocomplete="off" placeholder="备注(可选)"
				   class="layui-input">
		</div>
	</div>


	<div class="layui-form-item">
		<div class="layui-input-block">

			<button type="submit" class="layui-btn" lay-submit="" lay-filter="demo1">确认办理</button>
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
		form.on('submit(demo1)', function (data) {
			if (!data.field.goodsid) {
				layer.msg('请选择办理商品');
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
						'<h3>信息确认</h3>' +
						'<p>抵押物商品id:' + data.field.goodsid.split("|")[1] + '</p>' +
						'<p>票据号:' + data.field.billno + '</p>' +
						'<p>备注:' + data.field.remarks + '</p></div>'
				,
				yes: function () {
					$('#dywform').submit();
				}
				,
				btn2: function () {
					layer.closeAll();
				}

			});

			return false;
		});
		form.on('radio', function (data) {
			var arr = data.value.split("|");
			console.log(arr)
			$('.price_dyw').attr('value', arr[1]);
			$('.price_radio').attr('value', arr[3]);
		});

	});


</script>
<?php if (get_cookie('success')) { ?>
	<script>
		layui.use(['jquery', 'form', 'layedit', 'laydate', 'element'], function () {
			var form = layui.form
					, layer = layui.layer
					, layedit = layui.layedit
					, laydate = layui.laydate
					, element = layui.element
					, $ = layui.$; //重点处
			layer.open({
				type: 1
				,
				title: false //不显示标题栏
				,
				closeBtn: false
				,
				area: '300px;'
				,
				shade: 0.8
				,
				id: 'LAY_layuipro_2' //设定一个id，防止重复弹出
				,
				btn: ['打印票据', '关闭窗口']
				,
				btnAlign: 'c'
				,
				moveType: 1 //拖拽模式，0或者1
				,
				content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">办理成功</div>'
				,
				yes: function () {
					Win10_child.openUrl('/index.php/<?php echo $url;?>', '抵押物库存信息')
				}
				,
				btn2: function () {
					layer.closeAll();
				}
			});

		});
	</script>
<?php } ?>



<?php if (get_cookie('error')) { ?>
	<script>
		layui.use(['jquery', 'form', 'layedit', 'laydate', 'element'], function () {
			var form = layui.form
					, layer = layui.layer
					, layedit = layui.layedit
					, laydate = layui.laydate
					, element = layui.element
					, $ = layui.$; //重点处
			layer.msg('办理失败' + '<?= get_cookie('tips')?>')
		});
	</script>
<?php } ?>




<?php if (get_cookie('printinfo')) { ?>
	<script>
		const data = <?= get_cookie('printinfo') ?>;
		console.log(data)
		if (data.type == '办理抵押物业务单' && '<?= get_cookie('department') ?>' == '发卡室') {

			var jsonp = {
				Memo1: "南宁三燃燃气有限责任公司钢瓶办理单据",
				Memo2: data.topinfo,
				Memo4: "卡号 " + data.memberid,
				Memo5: "姓名 " + data.name,
				Memo6: "电话 " + data.telephone,
				Memo7: "站点名称  发卡室",
				Memo8: data.goods + data.zcode + '  实付款' + data.pay_cash,
				Memo9: "",
				Memo10: "注：本单据自填制日起两个月内有效.",
				Memo11: "经办人：" + data.operator,
			}
			var data_infop = {
				PrintData: jsonp,
				Print: true
			}
			axios.get('http://127.0.0.1:8000/api/print/order/18/?data=' + JSON.stringify(data_infop)).then(rew => {
				console.log(rew)
			})

		}

		if (data.type == '办理抵押物业务单' && '<?= get_cookie('department') ?>' != '发卡室') {
			var str = ''
			var other = JSON.parse(data.other)
			for (let i = 0; i < other.length; i++) {
				str += other[i] + '\n'
			}
			var jsonp = {
				title: "南宁三燃公司钢瓶办理单据",
				time: data.topinfo,
				memberid: "卡号 " + data.memberid,
				name: "姓名 " + data.name,
				tel: "电话 " + data.telephone,
				address: data.remarks,
				department: data.department,
				Memo2: '钢瓶资料',
				Memo1: data.goods + '  ' + data.zcode + ' 实付款' + data.pay_cash + '元',
				Memo3: '收款员:' + data.operator,
				Memo4: '用户签名：_______________________________',
				Memo5: str
			}
			var data_infop = {
				PrintData: jsonp,
				Print: true
			}
			axios.get('http://127.0.0.1:8000/api/print/order/4/?data=' + JSON.stringify(data_infop)).then(rew => {
				console.log(rew)
			})
		}
	</script>
<?php } ?>

</html>
