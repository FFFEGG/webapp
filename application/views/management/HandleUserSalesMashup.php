<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>办理用户混搭方案</title>
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
	<legend>会员<?= $this->input->get('memberid') ?> - <?php echo $this->input->get('name'); ?>办理用户混搭方案</legend>
</fieldset>
<div class="oapd">


	<?php echo form_open('', 'class="layui-form" id="hdfa"'); ?>
	<input type="hidden" name="userid" value="<?= $this->input->get('userid') ?>">
	<input type="hidden" name="memberid" value="<?= $this->input->get('memberid') ?>">
	<input type="hidden" name="name" value="<?= $this->input->get('name') ?>">
	<input type="hidden" name="serialsale" value="">
	<div class="layui-form-item">
		<label class="layui-form-label">商品混搭方案
		</label>
		<div class="layui-input-block">
			<table class="layui-table" lay-even="" lay-skin="row">
				<thead>
				<tr>
					<th>选择</th>
					<th>商品名称</th>
					<th>详情</th>
					<th>合计</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach (object_array($plan) as $v) { ?>
					<tr>
						<td>
							<input type="radio" name="id"
								   value="<?= $v['id'] ?>">
						</td>

						<td><?= $v['name'] ?></td>
						<td>
							<?php foreach ($v['list'] as $vi) { ?>
								<div class="layui-row">
									<div class="layui-col-lg4"><?= $vi['goods']['name'] ?></div>
									<div class="layui-col-lg4">数量 <?= $vi['num'] ?></div>
									<div class="layui-col-lg4">单价 <?= $vi['price'] ?></div>
								</div>
							<?php } ?>
						</td>
						<td>
							<?php
							$num = 0;
							foreach ($v['list'] as $vi) {
								$num += $vi['num'] * $vi['price'];
							}
							echo $num;
							?>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>


	<div class="layui-form-item">
		<label class="layui-form-label">数量
		</label>
		<div class="layui-input-block">
			<input type="text" name="num" lay-verify="required" autocomplete="off" placeholder="数量"
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

			<button type="submit" class="layui-btn" lay-submit="" lay-filter="hdfasubmit">确认办理</button>
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
		form.on('submit(hdfasubmit)', function (data) {
			if (!data.field.id) {
				layer.msg('请选择混搭方案')
				return false
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
						'<p>正在进行办理用户混搭方案操作</p>'
				,
				yes: function () {
					$('#hdfa').submit();
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
<?php if (get_cookie('HandleUserSalesMashup')) { ?>
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
<?php if (get_cookie('errorHandleUserSalesMashup')) { ?>
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


<?php if (get_cookie('printinfo')) { ?>
	<script src="<?php echo base_url(); ?>res/js/axios.js" charset="utf-8"></script>
	<script>
		const data = <?= get_cookie('printinfo') ?>;

		if (data.type == '商品混搭方案办理单') {

			let goodsdata = JSON.parse(data.goods)

			var jsonp = {
				title: "三燃商品混搭方案办理单",
				time: data.topinfo,
				memberid: "卡号 " + data.memberid,
				name: "姓名 " + data.name,
				tel: "电话 " + data.telephone,
				address: "地址 " + data.address,
				department: data.department,
				type1:  '',
				type2: '',
				type3:  '',
				band1: goodsdata[0] ? goodsdata[0]['goodsname'] : '',
				band2: goodsdata[1] ? goodsdata[1]['goodsname'] : '',
				band3: goodsdata[2] ? goodsdata[2]['goodsname'] : '',
				num1: goodsdata[0] ? '数量' + goodsdata[0]['num'] : '',
				num2: goodsdata[1] ? '数量' + goodsdata[1]['num'] : '',
				num3: goodsdata[2] ? '数量' + goodsdata[2]['num'] : '',
				price1: goodsdata[0] ? '单价 ' + Number(goodsdata[0]['total']).toFixed(2) : '',
				price2: goodsdata[1] ? '单价 ' + Number(goodsdata[1]['total']).toFixed(2) : '',
				price3: goodsdata[2] ? '单价 ' + Number(goodsdata[2]['total']).toFixed(2) : '',
				jfcate: "",
				residualindex: data.userotherinfo,
				yck: "预存款",
				price: parseFloat(data.balance).toFixed(2),
				cash: "合计收现 " + parseFloat(data.pay_cash).toFixed(2),
				delivery: "配送员：" + data.deliveryman,
				operator: "操作员：" + data.operator,
				tsinfo: "温馨提示：1，桶装水开封后建议两周内饮用完为宜\n" +
						"2，饮水机2-6个月应清洗消毒一次（可有偿上门服务）",
				Memo18: "戴一次性手套安装",
				Memo19: "使用镊子安装",
				Memo20: "用户意见",
				Memo21: "【】是  【】 否",
				Memo22: "【】是  【】 否",
				Memo23: "【】满意【】 一般【】差",
				Memo24: "用户签字",
				Memo12: "---------------------------------------------------------------------------"
			}
			var data_infop = {
				PrintData: jsonp,
				Print: true
			}
			console.log(data_infop)
			axios.get('http://127.0.0.1:8000/api/print/order/3/?data=' + JSON.stringify(data_infop)).then(rew => {
				console.log(rew)
			})
		}
	</script>
<?php } ?>
</html>
