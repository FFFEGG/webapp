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
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
	<title>门店-- 收款报表</title>
</head>
<body>
<div id="app" class=" p-3">
	<div class="flex">
		<div class="p-2">开始时间</div>
		<input v-model="startime" class="border mx-3 p-2" type="date">
		<div class="p-2">结束时间</div>
		<input v-model="endtime" class="border mx-3 p-2" type="date">

		<div class="p-2">查询方式</div>
		<select name="" id="" class="border mx-3 p-2" v-model="mode">
			<option value="理论">理论</option>
			<option value="记账">记账</option>
		</select>
		<button @click="submit" class="p-2 bg-teal-500 text-white px-4">查询</button>
		<button @click="DepartmentCancelReceivablesBookkeeping" class="p-2 bg-teal-500 text-white px-4 ml-3">删除记账</button>
		<button @click="tableToExcel('div1','门店收款报表')" class="p-2 bg-teal-500 text-white px-4 ml-3">导出表格</button>
	</div>

	<table id="div1"  class="table-auto mt-6 w-full text-xs">
		<thead>
		<tr>
			<th class=" border">门店</th>

			<th class=" border">收支</th>

			<th class=" border">项目</th>
			<th class=" border">类型</th>
			<th class=" border">余额支付</th>
			<th class=" border">现金支付</th>
			<th class=" border">微信支付</th>
			<th class=" border">支付宝支付</th>
			<th class=" border">月结支付</th>
			<th class=" border">库存款支付</th>
			<th class=" border">小计</th>
		</tr>
		</thead>
		<tbody>
		<template v-for="v in list">


			<tr>
				<td class="border ">{{v.department}}</td>
				<td class="border ">{{v.inandout}}</td>
				<td class="border ">{{v.project}}</td>

				<td class="border  cursor-pointer text-blue-500" @click="seedata(v,'')">{{v.type}}</td>
				<td class="border  cursor-pointer text-blue-500" @click="seedata(v,'余额支付')">{{v.pay_balance}}</td>
				<td class="border  cursor-pointer text-blue-500" @click="seedata(v,'现金支付')">{{v.pay_cash}}</td>
				<td class="border  cursor-pointer text-blue-500" @click="seedata(v,'微信支付')">{{v.pay_weixin}}</td>
				<td class="border  cursor-pointer text-blue-500" @click="seedata(v,'支付宝支付')">{{v.pay_alipay}}</td>
				<td class="border  cursor-pointer text-blue-500" @click="seedata(v,'月结支付')">{{v.pay_arrears}}</td>
				<td class="border  cursor-pointer text-blue-500" @click="seedata(v,'库存款支付')">{{v.pay_stock}}</td>
				<td class="border  cursor-pointer text-blue-500" @click="seedata(v,'')">{{v.total}}</td>
			</tr>

		</template>
		</tbody>
	</table>
<!---->
<!--	<div class="mt-3">-->
<!--		<div class="font-bold text-xl">收合计：{{ shou }} 元 | 支合计: {{ zhi }} 元 | 余额：{{ shou - zhi }} 元</div>-->
<!--		<button @click="DepartmentReceivablesBookkeeping" class="p-2 bg-teal-500 text-white px-4 mt-3 rounded">记账</button>-->
<!--	</div>-->
</div>
</body>
<script>

	new Vue({
		el: '#app',
		data() {
			return {
				list: [],
				initData: '',
				endtime: '',
				mode: '理论',
				department: '<?= get_cookie('department')?>',
				startime: '2010-01-01',
				jzbegintime: '',
				jzendtime: '',
			}
		},
		computed: {
			shou() {
				var sum = 0

				for (let i = 0; i < this.list.length; i++) {
					if (this.list[i].inandout == '收') {
						sum += Number(this.list[i].total)
					}
				}
				return sum
			},
			zhi() {
				var sum = 0

				for (let i = 0; i < this.list.length; i++) {
					if (this.list[i].inandout == '支') {
						sum += Number(this.list[i].total)
					}
				}
				return sum
			}
		},
		methods: {
			DepartmentReceivablesBookkeeping () {
				axios.post('/index.php/api/DepartmentReceivablesBookkeeping', {
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
			DepartmentCancelReceivablesBookkeeping () {
				axios.post('/index.php/api/DepartmentCancelReceivablesBookkeeping', {
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
			seedata(data, payment) {
				axios.post('/index.php/api/ReportDetailed', {
					info: data,
					payment: payment,
					reporttype: '门店收款报表',
					begintime: this.startime,
					endtime: this.endtime,
				}).then(rew => {
					if (rew.data.code == 200) {
						localStorage.setItem('tabledata',JSON.stringify(rew.data.list))
						Win10_child.openUrl('/index.php/msg/tabledata','门店收款报表明细')
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
				axios.post('/index.php/api/DepartmentReceivables', {
					startime: this.startime,
					endtime: this.endtime,
					department: this.department,
					mode: this.mode,
				}).then(rew => {
					this.list = rew.data.list
					this.jzbegintime = this.startime
					this.jzendtime = this.endtime
				})
			},
			tableToExcel(tableID, fileName) {
				if (this.list.length <=0) {
					swal('请先查询数据')
					return false
				}
				var excelContent = $("#" + tableID).html();
				// 		alert(excelContent);
				var excelFile = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:x='urn:schemas-microsoft-com:office:excel' xmlns='http://www.w3.org/TR/REC-html40'><meta charset='UTF-8'>";
				excelFile += "<head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head>";
				excelFile += "<body><table width='10%'  border='1'>";
				excelFile += excelContent;
				excelFile += "</table></body>";
				excelFile += "</html>";
				var link = "data:application/vnd.ms-excel;base64," + this.base64(excelFile);
				var a = document.createElement("a");
				a.download = fileName + ".xls";
				a.href = link;
				a.click();
			},
			base64(content) {
				return window.btoa(unescape(encodeURIComponent(content)));
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
