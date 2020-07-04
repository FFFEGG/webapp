<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>订单打印列表</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script src="<?php echo base_url(); ?>res/js/sweetalert2.min.js"></script>
	<script src="<?php echo base_url(); ?>res/js/core.js"></script>
	<link href="<?php echo base_url(); ?>res/css/sweetalert2.min.css" rel="stylesheet">
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
					<input type="text" name="begintime" id="begintime" lay-verify="date" value="2010-01-01"
						   placeholder="yyyy-MM-dd" autocomplete="off" class="layui-input">
				</div>
				<div class="layui-form-mid">-</div>
				<div class="layui-input-inline">
					<input type="text" name="endtime" id="endtime" lay-verify="date"
						   value="<?php echo date('Y-m-d', time()); ?>" placeholder="yyyy-MM-dd" autocomplete="off"
						   class="layui-input">
				</div>
				<div class="layui-input-inline">
					<input type="text" name="memberid" value="<?= $this->input->get('memberid') ?>"
						   placeholder="卡号" autocomplete="off" class="layui-input">
				</div>
				<div class="layui-input-inline">
					<label class="layui-form-label" style="width: 30px">状态</label>
					<div class="layui-input-block" style="margin-left: 62px">
						<select name="state" lay-filter="aihao">
							<option value="正常">正常</option>
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
				<th>打印时间</th>
				<th>类型</th>
				<th>会员信息</th>
				<th>部门人员信息</th>
				<th>付款信息</th>
				<th>商品信息</th>
				<th>备注</th>
				<th>剩余信息</th>
				<th>操作</th>
			</tr>
			</thead>
			<tbody>

			<?php foreach (object_array($list) as $v) { ?>
				<tr>
					<td><?= substr($v['addtime'], 0, 16) ?></td>
					<td><?= $v['type'] ?></td>
					<td>
						<p>卡号: <span style="font-weight: bold;color: black"><?= $v['memberid'] ?></span>姓名: <span
									style="font-weight: bold;color: black"><?= $v['name'] ?></span></p>
						<p>电话:<?= $v['telephone'] ?></p>
						<p>单位:<?= $v['workplace'] ?></p>
						<p>地址:<?= $v['address'] ?></p>
					</td>
					<td>
						<p>门店:<?= $v['department'] ?></p>
						<p>配送员: <span style="color: rgba(255,95,244,0.88)"><?= $v['deliveryman'] ?></span></p>
						<p>操作员:<?= $v['operator'] ?></p>
					</td>
					<td>
						账户余额: <?= round($v['balance'], 2) ?>
						<p><?php if ((float)$v['pay_balance'] > 0) {
								echo '余额支付:<span>' . round($v['pay_balance'], 2) . '</span>';
							} ?></p>
						<p><?php if ((float)$v['pay_cash'] > 0) {
								echo '现金支付:<span style="font-weight: bold;color: red;font-size: 15px">' . round($v['pay_cash'], 2) . '</span>';
							} ?></p>
						<p><?php if ((float)$v['pay_weixin'] > 0) {
								echo '微信支付:<span >' . round($v['pay_weixin'], 2) . '</span>';
							} ?></p>
						<p><?php if ((float)$v['pay_alipay'] > 0) {
								echo '支付宝支付:<span>' . round($v['pay_alipay'], 2) . '</span>';
							} ?></p>
						<p><?php if ((float)$v['pay_balance'] > 0) {
								echo '月结支付:<span>' . round($v['pay_balance'], 2) . '</span>';
							} ?></p>
					</td>
					<td>

						<?php foreach (object_array(json_decode($v['goods'])) as $vs) { ?>
							<div style="margin: 3px;border: 1px solid #ccc;padding: 3px;border-radius: 3px">
								<p>模式: <span style="color: rgba(255,24,17,0.88)"><?= $vs['mode'] ?></span>商品名称: <span
											style="color: rgba(24,133,255,0.88)"><?= $vs['goodsname'] ?></span>规格: <?= $vs['spec'] ?>
								</p>
								<p>市场价: <?= $vs['marketprice'] ?><span
											style="color: rgba(19,117,255,0.88)">数量: <?= $vs['num'] ?></span>优惠: <?= $vs['discount'] ?>
									合计: <?= $vs['total'] ?></p>
							</div>
						<?php } ?>

					</td>
					<td><?= $v['remarks'] ?></td>
					<td><?= $v['userotherinfo'] ?></td>
					<td>
						<button class="layui-btn layui-btn-sm" onclick="print_order('<?= Myencode($v) ?>')">
							打印
						</button>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>
</body>
<script src="<?php echo base_url(); ?>/res/layui/layui.js" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>res/js/base64.js"></script>
<script src="<?php echo base_url(); ?>res/js/axios.js" charset="utf-8"></script>
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

	function print_order(value) {

		var data = JSON.parse(Base64.decode(value))
		
		if (data.type == '送气安检一体单') {

			paystr = '';
			if (data.pay_balance > 0) {
				paystr += '余额支付:' + data.pay_balance + '元，';
			}
			if (data.pay_weixin > 0) {
				paystr += '微信支付:' + data.pay_weixin + '元，';
			}
			if (data.pay_alipay > 0) {
				paystr += '支付宝支付:' + data.pay_alipay + '元，';
			}
			if (data.pay_arrears > 0) {
				paystr += '月结支付:' + data.pay_arrears + '元，';
			}
			if (data.pay_coupon > 0) {
				paystr += '优惠券:' + data.pay_coupon + '元，';
			}
			paystr += "账户余额:" + parseFloat(data.balance).toFixed(2) + "元"
			let goodsdata = JSON.parse(data.goods)
			var json = {
				time: data.topinfo,
				memeberid: data.memberid,
				name: data.name,
				department: data.department,
				tel: data.telephone,
				delivery: data.deliveryman,
				address: ((data.address).replace(/#/g, "")).replace(/\[/g,""),
				work: ((data.workplace).replace(/#/g, "")).replace(/\[/g,""),
				goodsname1: goodsdata[0] ? goodsdata[0]['goodsname'] : '',
				goodsname2: goodsdata[1] ? goodsdata[1]['goodsname'] : '',
				goodsname3: goodsdata[2] ? goodsdata[2]['goodsname'] : '',
				goodstype1: goodsdata[0] ? goodsdata[0]['spec'] : '',
				goodstype2: goodsdata[1] ? goodsdata[1]['spec'] : '',
				goodstype3: goodsdata[2] ? goodsdata[2]['spec'] : '',
				goodsprice1: goodsdata[0] ? goodsdata[0]['marketprice'] : '',
				goodsprice2: goodsdata[1] ? goodsdata[1]['marketprice'] : '',
				goodsprice3: goodsdata[2] ? goodsdata[2]['marketprice'] : '',
				goodsnum1: goodsdata[0] ? goodsdata[0]['num'] : '',
				goodsnum2: goodsdata[1] ? goodsdata[1]['num'] : '',
				goodsnum3: goodsdata[2] ? goodsdata[2]['num'] : '',
				goodsyh1: goodsdata[0] ? goodsdata[0]['discount'] : '',
				goodsyh2: goodsdata[1] ? goodsdata[1]['discount'] : '',
				goodsyh3: goodsdata[2] ? goodsdata[2]['discount'] : '',
				goodstotle1: goodsdata[0] ? goodsdata[0]['total'] : '',
				goodstotle2: goodsdata[1] ? goodsdata[1]['total'] : '',
				goodstotle3: goodsdata[2] ? goodsdata[2]['total'] : '',
				info: paystr,
				zprice: parseFloat(data.pay_cash.toString()).toFixed(2),
				zcode: '',
				kcode: ((data.kcode.replace(/@/g, ""))).replace(/&/g, ""),
				rmarks: data.remarks,
				bottominfo: data.other
			}
			console.log(json)
			var data_info = {
				PrintData: json,
				Print: true
			}
			axios.get('http://127.0.0.1:8000/api/print/order/1/?data=' + JSON.stringify(data_info)).then(rew => {
				console.log(rew)
			})
		}
		if (data.type == '普通订单-备注') {
			let goodsdata = JSON.parse(data.goods)
			var jsonp = {
				title: "预约换水单(补打)-(送水电话：2622222)",
				time: data.topinfo,
				memberid: "卡号 " + data.memberid,
				name: "姓名 " + data.name,
				tel: "电话 " + data.telephone,
				address: "地址" + data.address,
				department: data.department,
				type1: goodsdata[0] ? goodsdata[0]['mode'] : '',
				type2: goodsdata[1] ? goodsdata[1]['mode'] : '',
				type3: goodsdata[2] ? goodsdata[2]['mode'] : '',
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
				price: Number(data.balance).toFixed(2),
				cash: "合计收现 " + Number(data.pay_cash).toFixed(2),
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
				Memo12: "---------------------------------------------------------------------------",
				Memo25: data.other
			}
			var data_infop = {
				PrintData: jsonp,
				Print: true
			}
			console.log(data_infop)
			axios.get('http://127.0.0.1:8000/api/print/order/2/?data=' + JSON.stringify(data_infop)).then(rew => {
				console.log(rew)
			})
		}
		if (data.type == '普通订单') {
			let goodsdata = JSON.parse(data.goods)
			console.log('-----------------------------')
			console.log(data)
			console.log('-----------------------------')
			var jsonp = {
				title: "三燃燃气商品销售单（补打）",
				time: data.topinfo,
				memberid: "卡号 " + data.memberid,
				name: "姓名 " + data.name,
				tel: "电话 " + data.telephone,
				address: "地址:" + data.address.replace('#',''),
				department: data.department,
				type1: goodsdata[0] ? goodsdata[0]['mode'] : '',
				type2: goodsdata[1] ? goodsdata[1]['mode'] : '',
				type3: goodsdata[2] ? goodsdata[2]['mode'] : '',
				band1: goodsdata[0] ? goodsdata[0]['goodsname'] : '',
				band2: goodsdata[1] ? goodsdata[1]['goodsname'] : '',
				band3: goodsdata[2] ? goodsdata[2]['goodsname'] : '',
				num1: goodsdata[0] ?  goodsdata[0]['num'] + goodsdata[0]['spec']: '',
				num2: goodsdata[1] ?   goodsdata[1]['num'] + goodsdata[1]['spec'] : '',
				num3: goodsdata[2] ?   goodsdata[2]['num'] + goodsdata[2]['spec'] : '',
				price1: goodsdata[0] ? '单价 ' + parseFloat(goodsdata[0]['total']).toFixed(2) : '',
				price2: goodsdata[1] ? '单价 ' + parseFloat(goodsdata[1]['total']).toFixed(2) : '',
				price3: goodsdata[2] ? '单价 ' + parseFloat(goodsdata[2]['total']).toFixed(2) : '',
				jfcate: "",
				residualindex: parseFloat(data.pay_weixin)>0?'微信付款：'+data.pay_weixin+'元':data.userotherinfo,
				yck: "预存款",
				price: parseFloat(data.balance).toFixed(2),
				cash: "合计收现 " + parseFloat(data.pay_cash).toFixed(0),
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
		if (data.type == '商品混搭方案办理单') {

			let goodsdata = JSON.parse(data.goods)
			console.log(data)
			var jsonp = {
				title: "三燃商品混搭方案办理单(补打)",
				time: data.topinfo,
				memberid: "卡号 " + data.memberid,
				name: "姓名 " + data.name,
				tel: "电话 " + data.telephone,
				address: "地址 " + data.address,
				department: data.department,
				type1: '',
				type2: '',
				type3: '',
				band1: goodsdata[0] ? goodsdata[0]['goodsname'] : '',
				band2: goodsdata[1] ? goodsdata[1]['goodsname'] : '',
				band3: goodsdata[2] ? goodsdata[2]['goodsname'] : '',
				num1: goodsdata[0] ? '数量' + goodsdata[0]['num'] : '',
				num2: goodsdata[1] ? '数量' + goodsdata[1]['num'] : '',
				num3: goodsdata[2] ? '数量' + goodsdata[2]['num'] : '',
				price1: goodsdata[0] ? '单价 ' + parseFloat(goodsdata[0]['total']).toFixed(2) : '',
				price2: goodsdata[1] ? '单价 ' + parseFloat(goodsdata[1]['total']).toFixed(2) : '',
				price3: goodsdata[2] ? '单价 ' + parseFloat(goodsdata[2]['total']).toFixed(2) : '',
				jfcate: "",
				residualindex: data.userotherinfo,
				yck: "预存款",
				price: parseFloat(data.balance).toFixed(2),
				cash: "合计收现 " + parseFloat(data.pay_cash).toFixed(0),
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
		if (data.type == '办理抵押物业务单' && '<?= get_cookie('department') ?>' == '发卡室') {

			var jsonp = {
				Memo1: "南宁三燃燃气有限责任公司钢瓶办理单据(补打)",
				Memo2: data.topinfo,
				Memo4: "卡号 " + data.memberid,
				Memo5: "姓名 " + data.name,
				Memo6: "电话 " + data.telephone,
				Memo7: "站点名称  发卡室",
				Memo8: data.goods + data.zcode + '  实付款' +data.pay_cash,
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
				title: "南宁三燃燃气有限责任公司钢瓶办理单据(补打)",
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

		if (data.type == '退抵押物物资单') {

			var jsonp = {
				title: "南宁三燃公司退抵押物物资单",
				time: data.topinfo,
				memberid: "卡号 " + data.memberid,
				name: "姓名 " + data.name,
				tel: "电话 " + data.telephone,
				address: "地址 " + data.address,
				department: data.department,
				Memo1: data.zcode + data.other,
				Memo2: '注，本单据自填制日起两个月内有效。',
				Memo3: '经办人: ' + data.operator,
				Memo4: '',
				Memo5: '',
			}
			var data_infop = {
				PrintData: jsonp,
				Print: true
			}
			axios.get('http://127.0.0.1:8000/api/print/order/5/?data=' + JSON.stringify(data_infop)).then(rew => {
				console.log(rew)
			})
		}

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

		if (data.type == '抵押物退款单' && '<?= get_cookie('department')?>' != '发卡室') {

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

		if (data.type == '会员充值订单') {
			var jsonp = {
				title: '南宁三燃公司会员充值订单',
				time: data.topinfo,
				memberid: '卡号 ' + data.memberid,
				name: '姓名 ' + data.name,
				Memo1: '原存款：' + (Number(data.balance) - Number(data.pay_cash)),
				Memo2: '充值：' + Number(data.pay_cash),
				Memo3: '账户余额：' + Number(data.balance),
				Memo4: '操作员: ' + data.operator,
				Memo5: '用户签名：'
			}
			var data_infop = {
				PrintData: jsonp,
				Print: true
			}
			axios.get('http://127.0.0.1:8000/api/print/order/7/?data=' + JSON.stringify(data_infop)).then(rew => {
				console.log(rew)
			})
		}
		if (data.type == '会员退指标订单') {
			var jsonp = {
				title: '南宁三燃公司会员退指标订单',
				time: data.topinfo,
				memberid: '卡号 ' + data.memberid,
				name: '姓名 ' + data.name,
				Memo1: '退指标款：' + Number(data.pay_cash),
				Memo2: data.goods,
				Memo3: '账户余额：' + Number(data.balance),
				Memo4: '操作员: ' + data.operator,
				Memo5: '用户签名：'
			}
			var data_infop = {
				PrintData: jsonp,
				Print: true
			}
			axios.get('http://127.0.0.1:8000/api/print/order/8/?data=' + JSON.stringify(data_infop)).then(rew => {
				console.log(rew)
			})
		}


		if (data.type == '会员退预存款订单') {
			var jsonp = {
				title: '南宁三燃公司会员退预存款订单',
				time: data.topinfo,
				memberid: '卡号 ' + data.memberid,
				name: '姓名 ' + data.name,
				Memo1: '原存款：' + (Number(data.balance) - Number(data.pay_cash)),
				Memo2: '退款：' + Number(data.pay_cash),
				Memo3: '账户余额：' + Number(data.balance),
				Memo4: '操作员: ' + data.operator,
				Memo5: '用户签名：'
			}
			var data_infop = {
				PrintData: jsonp,
				Print: true
			}
			axios.get('http://127.0.0.1:8000/api/print/order/7/?data=' + JSON.stringify(data_infop)).then(rew => {
				console.log(rew)
			})
		}

		if (data.type == '收购钢瓶单') {

			var jsonp = {
				title: "南宁三燃公司收购钢瓶单",
				time: data.topinfo,
				memberid: "来源  " + data.memberid,
				name: data.department + "办理",
				Memo1: '',
				Memo2: '',
				Memo3: '钢瓶: ' + data.goods,
				Memo4: '收购价格: ' + data.pay_cash + "元",
				Memo5: '营业员: ' + data.operator,
				Memo6: '配送员签字：',
				Memo7: '用户签字：',
			}
			var data_infop = {
				PrintData: jsonp,
				Print: true
			}
			axios.get('http://127.0.0.1:8000/api/print/order/9/?data=' + JSON.stringify(data_infop)).then(rew => {
				console.log(rew)
			})
		}

		if (data.type == '门店业务') {

			var jsonp = {
				title: "南宁三燃公司门店业务",
				time: data.topinfo,
				Memo1: '姓名：' + data.name,
				Memo2: data.telephone,
				Memo3: '会员号: ' + data.memberid,
				Memo4: '地址: ' + data.address,
				Memo5: data.other,
				Memo6: '处理人：' + data.deliveryman,
				Memo7: '用户签字：',
				Memo8: data.department,
			}
			var data_infop = {
				PrintData: jsonp,
				Print: true
			}
			axios.get('http://127.0.0.1:8000/api/print/order/10/?data=' + JSON.stringify(data_infop)).then(rew => {
				console.log(rew)
			})
		}

		if (data.type == '商品直售单') {
			var str = '';

			var goods = JSON.parse(data.goods)


			for (let i = 0; i < goods.length; i++) {
				str += goods[i].goodsname + '                       ' + goods[i].num + goods[i].unit + '      ' + goods[i].total + '\r\n'
			}

			var remarks = data.remarks
			if (data.pay_balance) {
				remarks += ',余额支付：' + data.pay_balance + '元'
			}

			if (data.pay_cash) {
				remarks += ',现金支付：' + data.pay_cash + '元'
			}

			var jsonp = {
				title: "南宁三燃公司商品直售单据",
				time: data.topinfo,
				Memo3: "会员号 " + data.memberid,
				Memo1: "姓名 " + data.name,
				Memo2: data.telephone,
				Memo8: data.department,
				Memo5: str,
				Memo4: remarks,
				Memo6: '收款员:' + data.operator,
				Memo7: '用户签名：_______________________________',
			}
			var data_infop = {
				PrintData: jsonp,
				Print: true
			}
			axios.get('http://127.0.0.1:8000/api/print/order/11/?data=' + JSON.stringify(data_infop)).then(rew => {
				console.log(rew)
			})
		}
		if (data.type == '钢瓶收发货单据') {
			let goods = JSON.parse(data.goods)
			var jsonp = {
				Memo2: "南宁三燃公司钢瓶收发货单据(补打)",
				Memo1: data.topinfo,
				Memo4: '发货地：   ' + data.department,
				Memo5: '收货地：   ' + data.address,
				Memo6: '司机：   ' + data.deliveryman,
				Memo7: '车号：   ' + data.remarks,
				Memo27: goods[0] ? goods[0].goodsname : '',
				Memo28: goods[1] ? goods[1].goodsname : '',
				Memo29: goods[2] ? goods[2].goodsname : '',
				Memo30: goods[0] ? goods[0].num : '',
				Memo31: goods[1] ? goods[1].num : '',
				Memo32: goods[2] ? goods[2].num : '',
				Memo69: '重瓶发货人：' + data.operator,
				Memo74: '补打时间：<?= date('Y-m-d H:i:s', time())?>',//补打时间：2020-5-21 11:37:51
				Memo8: '铅封编号',
				Memo9: '出厂（后门）',
				Memo10: '（边门）',
				Memo11: '门店（后门）',
				Memo12: '（边门）',
				Memo13: '规格',
				Memo17: '重瓶发货',
				Memo21: '本年原',
				Memo14: '本年检',
				Memo15: '混装',
				Memo16: '重瓶实收',
				Memo18: '本司空',
				Memo19: '非本司空',
				Memo20: '收购',
				Memo22: '补差',
				Memo23: '带瓶',
				Memo24: '其他',
				Memo25: '返空总数',
				Memo26: '退重数量',
				Memo33: '',
				Memo34: '',
				Memo35: '',
				Memo36: '',
				Memo37: '',
				Memo38: '',
				Memo39: '',
				Memo40: '',
				Memo41: '',
				Memo42: '',
				Memo43: '',
				Memo44: '',
				Memo45: '',
				Memo46: '',
				Memo47: '',
				Memo48: '',
				Memo49: '',
				Memo50: '',
				Memo51: '',
				Memo52: '',
				Memo53: '',
				Memo54: '',
				Memo55: '',
				Memo56: '',
				Memo57: '',
				Memo58: '',
				Memo59: '',
				Memo60: '',
				Memo61: '',
				Memo62: '',
				Memo63: '',
				Memo64: '',
				Memo65: '',
				Memo66: '',
				Memo67: '',
				Memo68: '',
				Memo70: '    重瓶收货人：',
				Memo71: '   返空发货人：',
				Memo72: '   返空收货人：',
				Memo73: '',
			}
			var data_infop = {
				PrintData: jsonp,
				Print: true
			}
			axios.get('http://127.0.0.1:8000/api/print/order/13/?data=' + JSON.stringify(data_infop)).then(rew => {
				console.log(rew)
			})
		}

		if (data.type == '代销发货单据' && data.department == '运输公司') {
			var str = '';
			console.log(data)
			var goods = JSON.parse(data.goods)


			var jsonp = {
				Memo2: "南宁三燃公司代销发货单据",
				Memo1: data.topinfo,
				Memo11: "收货人：  " + data.name,
				Memo12: data.name + '     ' + data.telephone,
				Memo13: '司机：',
				Memo14: '拉瓶：',
				Memo15: '规格',
				Memo16: '重瓶发货数',
				Memo17: '重瓶实收数',
				Memo18: '总金额',
				Memo19: '空瓶实收数',
				Memo20: '退重数量',
				Memo21: '返重原因',
				Memo22: '返重实收数',
				Memo4: '',
				Memo5: '',
				Memo6: '',
				Memo7: '',
				Memo8: '',
				Memo10: '',
				Memo23: goods[0] ? goods[0].goodsname : '',
				Memo24: goods[0] ? goods[0].num : '',
				Memo25: '',
				Memo26: goods[0] ? goods[0].total : '',
				Memo27: '',
				Memo28: '',
				Memo29: '',
				Memo30: '',
				Memo31: goods[1] ? goods[1].goodsname : '',
				Memo32: goods[1] ? goods[1].num : '',
				Memo33: '',
				Memo34: goods[1] ? goods[1].total : '',
				Memo35: '',
				Memo36: '',
				Memo37: '',
				Memo38: '',
				Memo39: goods[2] ? goods[2].goodsname : '',
				Memo40: goods[2] ? goods[2].num : '',
				Memo41: '',
				Memo42: goods[2] ? goods[2].total : '',
				Memo43: '',
				Memo44: '',
				Memo45: '',
				Memo46: '',
				Memo47: '运费：' + data.freighttotal,
				Memo48: '气款：' + data.goodstotal,
				Memo49: '合计总金额：' + data.total,
				Memo50: '发货人：' + data.deliveryman,
				Memo51: '收货人签名：',
				Memo52: '',
				Memo53: '用户备注：',
				Memo54: data.salesman + '/' + data.salesmantelephone,
				Memo55: '打单时间：<?= date('Y-m-d H:i:s', time())?>',
			}
			var data_infop = {
				PrintData: jsonp,
				Print: true
			}
			axios.get('http://127.0.0.1:8000/api/print/order/12/?data=' + JSON.stringify(data_infop)).then(rew => {
				console.log(rew)
			})
			return false
		}
		if (data.type == '代销发货单据') {
			var str = '';

			var goods = JSON.parse(data.goods)


			var jsonp = {
				title: "南宁三燃公司商品直售单据",
				time: data.topinfo,
				Memo3: "会员号 " + data.memberid,
				Memo1: "姓名 " + data.name,
				Memo2: data.telephone,
				Memo8: data.department,
				Memo5: str,
				Memo4: remarks,
				Memo6: '收款员:' + data.operator,
				Memo7: '用户签名：_______________________________',
			}
			var data_infop = {
				PrintData: jsonp,
				Print: true
			}
			axios.get('http://127.0.0.1:8000/api/print/order/11/?data=' + JSON.stringify(data_infop)).then(rew => {
				console.log(rew)
			})
		}
		if (data.type == '运输公司送气单') {
			console.log(data)
			let goodsdata = JSON.parse(data.goods);
			let str = ''

			for (let i = 0; i < goodsdata.length; i++) {
				str += '规格：' + goodsdata[i].goodsname + '   数量：' + goodsdata[i].num + '     '
			}
			let orderinfo = JSON.parse(data.orderinfo);
			var json = {
				Memo1: '司机：    ' + data.deliveryman,
				Memo2: '付款方式（' + (parseFloat(data.pay_cash)>0 ? '现金' : '月结') + '）',
				Memo3: '',
				Memo4: '储罐厂 NO：' + data.printserial,
				Memo5: '南宁三燃液化气有限公司IC卡送气单（大户气，请及时送气）-预',
				Memo6: '日期：' + orderinfo.time.substr(0, 10),
				Memo7: '送气时间：' + orderinfo.time.substr(11, 5),
				Memo8: '卡号：' + data.memberid,
				Memo9: '姓名：' + data.name,
				Memo10: '电话：' + data.telephone,
				Memo11: '打印时间：<?= date('H:i', time())?>',
				Memo13: str,
				Memo12: '地址：' + data.address,

				Memo16: '气价：' + Number(data.goodstotal),

				Memo18: '扣卡：' + (Number(data.pay_balance) + Number(data.pay_arrears)),
				Memo19: '应收金额：' + Number(data.pay_cash),
				Memo20: '单位：' + data.workplace,
				Memo21: '卡剩余额：' + data.balance,
				Memo22: '回空数量：',
				Memo23: '退重数量：',
				Memo24: '备注：' + data.remarks,

				Memo25: '移动支付：________',
				Memo26: '   实收现金：__________',
				Memo27: '',
				Memo28: '评价：□ 满意  □ 不满意',

				Memo30: '复核：',
				Memo31: '操作员' + data.operator,
				Memo32: '商用气：' + data.salesman,
				Memo33: data.salesmantelephone,
				Memo34: '',
				Memo35: '客户安装',
				Memo36: '',
				Memo37: '司机安装：本次安装重瓶数为________瓶，已进行试漏，无漏气。',
				Memo38: '用户签字：_________________',
				Memo39: '',
				Memo40: '出厂重瓶（kg）',
				Memo41: '回空瓶（kg）',
				Memo42: '瓶号',
				Memo43: '钢瓶自重',
				Memo44: '发出重量',
				Memo45: '司机安装（√）',
				Memo46: '客户安装（√）',
				Memo47: '瓶号',
				Memo48: '钢瓶自重',
				Memo49: '发出重量',
				Memo50: '余气量',
				Memo51: '',
				Memo52: '',
				Memo53: '',
				Memo54: '',
				Memo55: '',
				Memo56: '',
				Memo57: '',
				Memo58: '',
				Memo59: '',

			};
			var data_info = {
				PrintData: json,
				Print: true
			};
			axios.get('http://127.0.0.1:8000/api/print/order/14/?data=' + JSON.stringify(data_info)).then(rew => {
				console.log(rew)
			})
		}

		if (data.type == '预缴抵押物使用产生费') {
			var jsonp = {
				title: "南宁三燃公司预缴抵押物使用产生费单（补打）",
				time: data.topinfo,
				memberid: "卡号 " + data.memberid,
				name: "姓名 " + data.name,
				tel: "电话 " + data.telephone,
				address: "地址 " + data.address,
				department: data.department,
				Memo1: data.other,
				Memo2: '收现：￥' + data.pay_cash,
				Memo3: '经办人: ' + data.operator,
				Memo4: '',
				Memo5: '',
			}
			var data_infop = {
				PrintData: jsonp,
				Print: true
			}
			axios.get('http://127.0.0.1:8000/api/print/order/16/?data=' + JSON.stringify(data_infop)).then(rew => {
				console.log(rew)
			})
		}

		if (data.type == '客服中心订单') {

			var jsonp = {
				Memo1: "三燃公司安检安装回执单(补打)",
				Memo2: data.topinfo,
				Memo3: "服务人员：" + data.deliveryman,
				Memo4: "卡号：" + data.memberid,
				Memo5: "单位：" + data.workplace,
				Memo6: "业务：" + data.orderinfo,
				Memo7: "业务员：" + data.salesman,
				Memo8: "备注:" + data.remarks + '维修对象：' + data.userotherinfo,
				Memo9: "业务员电话：" + data.salesmantelephone,
				Memo10: "地址：" + data.address,
				Memo11: "电话：" + data.telephone,
				Memo12: "用户意见：1，满意 2，一般 3，差",
				Memo13: "用户签字：",

			}
			var data_infop = {
				PrintData: jsonp,
				Print: true
			}
			axios.get('http://127.0.0.1:8000/api/print/order/17/?data=' + JSON.stringify(data_infop)).then(rew => {
				console.log(rew)
			})
		}
	}
</script>

</html>
