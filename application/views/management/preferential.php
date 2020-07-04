<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>办理抵押物</title>

	<script src="<?php echo base_url(); ?>/res/layui/layui.js" charset="utf-8"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>

</head>
<body>

<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
	<legend>会员<?php echo $this->input->get('memberid'); ?> - <?php echo $this->input->get('name'); ?>申请优惠</legend>
</fieldset>
<div style="padding: 10px">

	<div class="layui-tab layui-tab-brief">
		<ul class="layui-tab-title">
			<li class="layui-this">门店申请用户商品优惠</li>
			<li>门店申请用户抵押物优惠（押金购瓶,带瓶）</li>
			<li>门店申请用户抵押物收费优惠（钢瓶费用）</li>

		</ul>
		<div class="layui-tab-content" style="height: 100px;">
			<div class="layui-tab-item layui-show">


				<form class="layui-form layui-form-pane" action="" lay-filter="goodsyh">

					<input type="hidden" name="userid" value="<?= $this->input->get('userid') ?>">
					<input type="hidden" name="memberid" value="<?= $this->input->get('memberid') ?>">
					<div class="layui-form-item">
						<div class="layui-inline">
							<label class="layui-form-label">起始时间</label>
							<div class="layui-input-block">
								<input type="text" name="strattime" value="<?= date('Y-m-d', time()) ?>"
									   id="date1" autocomplete="off" class="layui-input"
									   lay-verify="required">
							</div>
						</div>
						<div class="layui-inline">
							<label class="layui-form-label">结束时间</label>
							<div class="layui-input-block">
								<input type="text" name="endtime"
									   value="<?= date('Y-m-d', time() + 30 * 24 * 60 * 60) ?>" id="date2"
									   autocomplete="off" class="layui-input"
									   lay-verify="required">
							</div>
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">选择商品</label>
						<div class="layui-input-block">
							<select name="goodsid" lay-filter="aihao" lay-verify="required" lay-search="">
								<option value=""></option>
								<?php foreach ($_SESSION['initData']->Goods->info as $v) { ?>
									<option
										value="<?= $v->id ?>"><?= $v->name . '-' . $v->packingtype . '-单价' . $v->price ?></option>
								<?php } ?>

							</select>
						</div>
					</div>

					<div class="layui-form-item">
						<label class="layui-form-label">优惠方式</label>
						<div class="layui-input-block">
							<select name="salestype" lay-filter="aihao" lay-verify="required">
								<option value="市场价格优惠">市场价格优惠</option>
<!--								<option value="固定价格优惠">固定价格优惠</option>-->
							</select>
						</div>
					</div>

					<div class="layui-form-item">
						<label class="layui-form-label">优惠价格</label>
						<div class="layui-input-block">
							<input type="text" name="price" lay-verify="required" autocomplete="off"
								   placeholder="请输入优惠价格" class="layui-input">
						</div>
					</div>


					<div class="layui-form-item">
						<label class="layui-form-label">支付方式</label>
						<div class="layui-input-block">
							<select name="payment" lay-filter="aihao" lay-verify="required">
								<option value="余额支付">余额支付</option>
								<option value="现金支付">现金支付</option>
								<option value="月结支付">月结支付</option>
							</select>
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">申请人</label>
						<div class="layui-input-block">
							<input type="text" lay-verify="required" name="applicant"
								   value="<?= $_SESSION['users']->name ?>" autocomplete="off" placeholder="请输入申请人"
								   class="layui-input">
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">授权人</label>
						<div class="layui-input-block">
							<select name="authorizedopeid" lay-filter="aihao" lay-verify="required">
								<option value=""></option>
								<?php foreach ($admin as $v) { ?>
									<option
										value="<?= $v['opeid'] ?>"><?= $v['name'] ?></option>
								<?php } ?>

							</select>
						</div>
					</div>
					<div class="layui-form-item">
						<button class="layui-btn" lay-submit="" lay-filter="goods">确认提交</button>
					</div>
				</form>
			</div>


			<div class="layui-tab-item">
				<form class="layui-form layui-form-pane" action="" lay-filter="ApplyeUserCollateralSalespromotion">

					<input type="hidden" name="userid" value="<?= $this->input->get('userid') ?>">
					<input type="hidden" name="memberid" value="<?= $this->input->get('memberid') ?>">
					<div class="layui-form-item">
						<div class="layui-inline">
							<label class="layui-form-label">起始时间</label>
							<div class="layui-input-block">
								<input type="text" name="strattime" value="<?= date('Y-m-d', time()) ?>"
									   id="date5" autocomplete="off" class="layui-input"
									   lay-verify="required">
							</div>
						</div>
						<div class="layui-inline">
							<label class="layui-form-label">结束时间</label>
							<div class="layui-input-block">
								<input type="text" name="endtime"
									   value="<?= date('Y-m-d', time() + 30 * 24 * 60 * 60) ?>" id="date6"
									   autocomplete="off" class="layui-input"
									   lay-verify="required">
							</div>
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">选择商品</label>
						<div class="layui-input-block">
							<select name="goodsid" lay-filter="aihao" lay-verify="required">
								<option value=""></option>
								<?php foreach ($_SESSION['initData']->NoSalesGoods->info as $v) { ?>
									<option
										value="<?= $v->id ?>"><?= $v->name . '-' . $v->packingtype . '-单价' . $v->price . '-模式' .$v->mode?></option>
								<?php } ?>

							</select>
						</div>
					</div>

					<div class="layui-form-item">
						<label class="layui-form-label">优惠方式</label>
						<div class="layui-input-block">
							<select name="salestype" lay-filter="aihao" lay-verify="required">
								<option value="市场价格优惠">市场价格优惠</option>
<!--								<option value="固定价格优惠">固定价格优惠</option>-->
							</select>
						</div>
					</div>

					<div class="layui-form-item">
						<label class="layui-form-label">优惠价格</label>
						<div class="layui-input-block">
							<input type="text" name="price" lay-verify="required" autocomplete="off"
								   placeholder="请输入优惠价格" class="layui-input">
						</div>
					</div>

					<div class="layui-form-item">
						<label class="layui-form-label">申请人</label>
						<div class="layui-input-block">
							<input type="text" lay-verify="required" name="applicant"
								   value="<?= $_SESSION['users']->name ?>" autocomplete="off" placeholder="请输入申请人"
								   class="layui-input">
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">授权人</label>
						<div class="layui-input-block">
							<select name="authorizedopeid" lay-filter="aihao" lay-verify="required">
								<option value=""></option>
								<?php foreach ($admin as $v) { ?>
									<option
										value="<?= $v['opeid'] ?>"><?= $v['name'] ?></option>
								<?php } ?>

							</select>
						</div>
					</div>
					<div class="layui-form-item">
						<button class="layui-btn" lay-submit="" lay-filter="dywgoods">确认提交</button>
					</div>
				</form>
			</div>
			<div class="layui-tab-item">

				<form class="layui-form layui-form-pane" action="" lay-filter="Salespromotion">

					<input type="hidden" name="userid" value="<?= $this->input->get('userid') ?>">
					<input type="hidden" name="memberid" value="<?= $this->input->get('memberid') ?>">
					<div class="layui-form-item">
						<div class="layui-inline">
							<label class="layui-form-label">起始时间</label>
							<div class="layui-input-block">
								<input type="text" name="strattime" value="<?= date('Y-m-d', time()) ?>"
									   id="date3" autocomplete="off" class="layui-input"
									   lay-verify="required"></div>
						</div>
						<div class="layui-inline">
							<label class="layui-form-label">结束时间</label>
							<div class="layui-input-block">
								<input type="text" name="endtime"
									   value="<?= date('Y-m-d', time() + 30 * 24 * 60 * 60) ?>" id="date4"
									   autocomplete="off" class="layui-input"
									   lay-verify="required">
							</div>
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">包装物类型</label>
						<div class="layui-input-block">
							<select name="packingtype" lay-filter="aihao" lay-verify="required">
								<option value=""></option>
								<?php foreach ($_SESSION['initData']->Packingtype->info as $v) { ?>
									<option
										value="<?= $v->name ?>"><?= $v->name ?></option>
								<?php } ?>

							</select>
						</div>
					</div>


					<div class="layui-form-item">
						<label class="layui-form-label">费用折扣</label>
						<div class="layui-input-block">
							<input type="text" name="discount" lay-verify="required" autocomplete="off"
								   placeholder="请输入费用折扣" class="layui-input">
						</div>
					</div>


					<div class="layui-form-item">
						<label class="layui-form-label">申请人</label>
						<div class="layui-input-block">
							<input type="text" lay-verify="required" name="applicant"
								   value="<?= $_SESSION['users']->name ?>" autocomplete="off" placeholder="请输入申请人"
								   class="layui-input">
						</div>
					</div>

					<div class="layui-form-item">
						<label class="layui-form-label">授权人</label>
						<div class="layui-input-block">
							<select name="authorizedopeid" lay-filter="aihao" lay-verify="required">
								<option value=""></option>
								<?php foreach ($admin as $v) { ?>
									<option
										value="<?= $v['opeid'] ?>"><?= $v['name'] ?></option>
								<?php } ?>

							</select>
						</div>
					</div>

					<div class="layui-form-item">
						<button class="layui-btn" lay-submit="" lay-filter="ApplyeUserCollateralChargeSalespromotion">
							确认提交
						</button>
					</div>
				</form>

			</div>

		</div>
	</div>
</div>

</body>

<script>
	layui.use(['jquery', 'form', 'layedit', 'laydate', 'element'], function () {
		var form = layui.form
			, layer = layui.layer
			, layedit = layui.layedit
			, laydate = layui.laydate
			, element = layui.element
			, $ = layui.$; //重点处

		laydate.render({
			elem: '#date2'
		});
		laydate.render({
			elem: '#date1'
		});

		laydate.render({
			elem: '#date3'
		});
		laydate.render({
			elem: '#date4'
		});

		laydate.render({
			elem: '#date5'
		});
		laydate.render({
			elem: '#date6'
		});

		form.on('submit(goods)', function (data) {

			$.ajax({
				url: '/index.php/api/creatPreferential',
				type: "POST",//方法类型
				dataType: "json",//预期服务器返回的数据类型
				data: data.field,
				success: function (res) {
					if (res.code == 200) {
						layer.msg('办理成功');
						form.val("goodsyh", {
							"goodsid": ""
							, "price": ""
							, "payment": "余额支付"
							, "authorizedopeid": ""
						});
						setTimeout(function () {
							Win10_child.openUrl('/index.php/msg/goodsSalespromotion?userid=<?= $this->input->get('userid')?>&name=<?=  $this->input->get('name') ?>&begintime=2010-10-10&endtime=<?= date('Y-m-d H:i:s', time())?>&memberid=<?= $this->input->get('memberid')?>', '用户优惠申请记录')
						}, 1000)
					}
				}
			});
			return false;
		});
		form.on('submit(ApplyeUserCollateralChargeSalespromotion)', function (data) {
			$.ajax({
				url: '/index.php/api/ApplyeUserCollateralChargeSalespromotion',
				type: "POST",//方法类型
				dataType: "json",//预期服务器返回的数据类型
				data: data.field,
				success: function (res) {
					if (res.code == 200) {
						layer.msg('办理成功');
						form.val("Salespromotion", {
							"packingtype": ""
							, "discount": ""

						});
						setTimeout(function () {
							Win10_child.openUrl('/index.php/msg/chargeSalespromotion?userid=<?= $this->input->get('userid')?>&name=<?=  $this->input->get('name') ?>&begintime=2010-10-10&endtime=<?= date('Y-m-d H:i:s', time())?>&memberid=<?= $this->input->get('memberid')?>', '抵押物收费优惠信息')
						}, 1000)
					}
				}
			});
			return false;
		});


		form.on('submit(dywgoods)', function (data) {
			$.ajax({
				url: '/index.php/api/ApplyeUserCollateralSalespromotion',
				type: "POST",//方法类型
				dataType: "json",//预期服务器返回的数据类型
				data: data.field,
				success: function (res) {
					if (res.code == 200) {
						layer.msg('办理成功');
						form.val("ApplyeUserCollateralSalespromotion", {
							"goodsid": ""
							, "price": ""
							, "authorizedopeid": ""
							, "authorizedopeid": ""

						});
						setTimeout(function () {
							Win10_child.openUrl('/index.php/msg/salespromotion?userid=<?= $this->input->get('userid')?>&name=<?=  $this->input->get('name') ?>&begintime=2010-10-10&endtime=<?= date('Y-m-d H:i:s', time())?>&memberid=<?= $this->input->get('memberid')?>', '抵押物优惠信息')
						}, 1000)
					}
				}
			});
			return false;
		});
	});
	//日期


</script>


</html>
