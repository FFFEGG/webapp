<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="<?php echo base_url(); ?>res/js/vue.js" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>res/js/axios.js" charset="utf-8"></script>
	<link href="<?php echo base_url(); ?>/res/css/tailwind-ui.min.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>res/js/sweetalert2.min.js"></script>
	<script src="<?php echo base_url(); ?>res/js/core.js"></script>
	<script src="<?php echo base_url(); ?>res/js/win10.child.js"></script>
	<link href="<?php echo base_url(); ?>res/css/sweetalert2.min.css" rel="stylesheet">
	<title>门店-- 商品物资销售报表</title>
</head>
<body>
<div id="app" class=" p-3">
	<div class="flex">
		<div class="p-2">开始时间</div>
		<input v-model="startime" class="border mx-3 p-2" type="date">
		<div class="p-2">结束时间</div>
		<input v-model="endtime" class="border mx-3 p-2" type="date">
		<div class="p-2">部门</div>
		<div class="p-2">查询方式</div>
		<select name="" id="" class="border mx-3 p-2" v-model="mode">
			<option value="理论">理论</option>
			<option value="记账">记账</option>
		</select>

		<button @click="submit" class="p-2 bg-teal-500 text-white px-4">查询</button>
		<button @click="DepartmentGoodsSaleBookkeeping" class="p-2 bg-teal-500 text-white px-4 ml-3">记账</button>
		<button @click="DepartmentCancelGoodsSaleBookkeeping"  class="p-2 bg-teal-500 text-white px-4 ml-3">删除记账</button>
	</div>

	<table class="table-auto mt-6 w-full text-xs">
		<thead>
		<tr>
			<th class=" border">门店</th>
			<th class=" border">方式</th>

			<th class=" border">品牌</th>

			<th class=" border">商品类型</th>
			<th class=" border">商品名称</th>
			<th class=" border">数量</th>
			<th class=" border">余额支付</th>
			<th class=" border">现金支付</th>
			<th class=" border">微信支付</th>
			<th class=" border">支付宝支付</th>
			<th class=" border">月结支付</th>
			<th class=" border">混合支付</th>
			<th class=" border">库存款支付</th>
			<th class=" border">小计</th>

		</tr>
		</thead>
		<tbody>
		<template v-for="v in list">


			<tr>
				<td class="border ">{{v.department}}</td>
				<td class="border ">{{v.mode}}</td>
				<td class="border ">{{v.brand}}</td>
				<td class="border ">{{v.goodstype}}</td>
				<td class="border ">{{v.goodsname}}</td>
				<td class="border  text-blue-500 cursor-pointer" @click="seedata(v,'',v.num)">{{v.num}}</td>
				<td class="border  text-blue-500 cursor-pointer" @click="seedata(v,'余额支付',v.pay_balance)">{{v.pay_balance}}
				</td>
				<td class="border  text-blue-500 cursor-pointer" @click="seedata(v,'现金支付',v.pay_cash)">{{v.pay_cash}}</td>
				<td class="border  text-blue-500 cursor-pointer" @click="seedata(v,'微信支付',v.pay_weixin)">{{v.pay_weixin}}
				</td>
				<td class="border  text-blue-500 cursor-pointer" @click="seedata(v,'支付宝支付',v.pay_alipay)">{{v.pay_alipay}}
				</td>
				<td class="border  text-blue-500 cursor-pointer" @click="seedata(v,'月结支付',v.pay_arrears)">{{v.pay_arrears}}
				</td>
				<td class="border  text-blue-500 cursor-pointer" @click="seedata(v,'混合支付',v.pay_blend)">{{v.pay_blend}}
				</td>
				<td class="border  text-blue-500 cursor-pointer" @click="seedata(v,'库存款支付',v.pay_stock)">{{v.pay_stock}}
				</td>
				<td class="border  text-blue-500 cursor-pointer" @click="seedata(v,'',v.total)">{{v.total}}</td>

			</tr>

		</template>
		</tbody>
	</table>

<!--	<p class="text-2xl mt-6">合计{{zprice}}</p>-->
</div>
</body>
<script>

	new Vue({
		el: '#app',
		computed: {
			zprice() {
				var sum = 0

				for (let i = 0; i < this.list.length; i++) {
					sum += Number(this.list[i].total)
				}
				return sum
			}
		},
		data() {
			return {
				list: [],
				initData: '',
				endtime: '',
				mode: '理论',
				departmentid: '<?= $_SESSION['users']->logindepartmentid?>',
				startime: '2010-01-01',
				jzstartime: '',
				jzendtime: '',
			}
		},
		methods: {
			DepartmentGoodsSaleBookkeeping () {
				axios.post('/index.php/api/DepartmentGoodsSaleBookkeeping', {
					begintime: this.jzbegintime,
					endtime: this.jzendtime,
					date: this.type,
					goodsjson: this.list,
				}).then(rew => {
					if (rew.data.code == 200) {
						swal('记账成功')
					} else {
						swal('记账失败，' + rew.data.msg.data.tips)
					}
				})
			},
			DepartmentCancelGoodsSaleBookkeeping () {
				axios.post('/index.php/api/DepartmentCancelGoodsSaleBookkeeping', {
					begintime: this.jzbegintime,
					endtime: this.jzendtime,
					date: this.type,
				}).then(rew => {
					if (rew.data.code == 200) {
						swal('删除记账成功')
					} else {
						swal('删除记账失败，' + rew.data.msg.data.tips)
					}
				})
			},
			seedata(data, payment,num) {
				if (num == 0) {
					return false
				}
				axios.post('/index.php/api/ReportDetailed', {
					info: data,
					payment: payment,
					reporttype: '门店商品物资销售报表',
					begintime: this.startime,
					endtime: this.endtime,
				}).then(rew => {
					if (rew.data.code == 200) {
						localStorage.setItem('tabledata', JSON.stringify(rew.data.list))
						Win10_child.openUrl('/index.php/msg/tabledata', '门店商品物资销售报表')
					}
				})
			},
			getQueryVariable(variable) {
				var query = window.location.search.substring(1)
				var vars = query.split('&')
				for (var i = 0; i < vars.length; i++) {
					var pair = vars[i].split('=')
					if (pair[0] == variable) {
						return pair[1]
					}
				}
				return ''
			},
			submit() {
				axios.post('/index.php/api/DepartmentGoodsSale', {
					startime: this.startime,
					endtime: this.endtime,
					departmentid: this.departmentid,
					mode: this.mode,
				}).then(rew => {
					this.list = rew.data.list
					this.jzbegintime = this.startime
					this.jzendtime = this.endtime
				})
			}
		},
		created() {
			this.endtime = this.getQueryVariable('endtime')
			this.startime = this.getQueryVariable('endtime')
			axios.post('/index.php/api/getInitData').then(rew => {
				this.initData = rew.data.data
			})
		}
	})
</script>
</html>
