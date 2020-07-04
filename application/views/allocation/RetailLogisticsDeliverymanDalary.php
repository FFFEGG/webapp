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
	<link href="<?php echo base_url(); ?>res/css/sweetalert2.min.css" rel="stylesheet">
	<title>零售后勤 配送员薪酬</title>
</head>
<body>
<div id="app" class="p-6">
	<div class="flex">
		<div class="w-8/12 mr-2">
			<div class="lg:flex">
				<p class="p-2">开始时间</p>
				<input class="p-2 border" type="date" v-model="begintime">
				<p class="p-2">结束时间</p>
				<input class="p-2 border" type="date" v-model="endtime">
				<p class="p-2">薪酬方式</p>
				<select name="" id="" v-model="type" class="p-2 border">
					<option value="配送工资">配送工资</option>
					<option value="各项补贴">各项补贴</option>
					<option value="有效开户补贴">有效开户补贴</option>
					<option value="开户换气提成">开户换气提成</option>
				</select>
				<button @click="submit" class="ml-3 p-2 px-4 bg-teal-500 text-white">搜索</button>
				<button @click="exportexcel('table1',type+'表')" class="ml-3 p-2 px-4 bg-teal-500 text-white">导出</button>
			</div>
			<table id="table1" class="table-auto mt-6 w-full text-xs">
				<thead>

				<tr>
					<th :colspan="list.title?list.title.length:1" class=" border">{{begintime}}至{{endtime}}
						{{type}}
					</th>
				</tr>
				<tr>
					<th v-for="v in list.title" class=" border">{{v}}</th>
				</tr>
				</thead>
				<tbody>
				<template v-for="v in list.info">


					<tr class="text-center">
						<td v-for="vi in list.key" class="border ">{{v[vi]}}</td>
					</tr>

				</template>
				</tbody>
			</table>

		</div>

		<div class="w-2/12">
			<p>业务门店</p>
			<label class="flex items-center text-xl" v-if="v.type=='业务门店'" v-for="v in initData.Department.info"
				   :for="v.id"><input @change="departmentchange(v)" :id="v.id" v-model="v.ischeck" type="checkbox">
				<p>{{v.name}}</p></label>
		</div>
		<div class="w-2/12">
			<p>配送员</p>
			<label class="flex items-center text-xl" v-if="v.quartersid==2" v-for="v in initData.Operator.info"
				   :for="'quartersid_'+v.id"><input v-model="v.ischeck" :id="'quartersid_'+v.id" type="checkbox">
				<p>{{v.name}}</p></label>
		</div>
	</div>
</div>
</body>
<script>
	new Vue({
		el: '#app',
		data() {
			return {
				begintime: '',
				endtime: '',
				type: '配送工资',
				initData: '',
				list: ''
			}
		},
		computed: {

			departments() {
				var arr = [];
				for (let i = 0; i < this.initData.Department.info.length; i++) {
					if (this.initData.Department.info[i].ischeck == true && this.initData.Department.info[i].type == '业务门店') {
						arr = arr.concat(this.initData.Department.info[i].name)
					}
				}
				return arr

			},
			deliverymans() {
				var arr = [];
				for (let i = 0; i < this.initData.Operator.info.length; i++) {
					if (this.initData.Operator.info[i].ischeck == true && this.initData.Operator.info[i].quartersid == 2) {
						arr = arr.concat(this.initData.Operator.info[i].name)
					}
				}
				return arr
			}
		},
		methods: {
			base64(content) {
				return window.btoa(unescape(encodeURIComponent(content)));
			},
			exportexcel(tableID, fileName) {
				var excelContent = document.getElementById(tableID).innerHTML
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
			submit() {
				axios.post('/index.php/api/RetailLogisticsDeliverymanDalary', {
					begintime: this.begintime,
					endtime: this.endtime,
					departments: this.departments,
					deliverymans: this.deliverymans,
					type: this.type
				}).then(rew => {
					this.list = rew.data.list
				})
			},
			departmentchange(data) {
				for (let i = 0; i < this.initData.Operator.info.length; i++) {
					if (this.initData.Operator.info[i].departmentid == data.id) {
						this.initData.Operator.info[i].ischeck = data.ischeck
					}
				}
				this.$forceUpdate()
			},
			getQueryVariable(variable) {
				var query = window.location.search.substring(1);
				var vars = query.split('&');
				for (var i = 0; i < vars.length; i++) {
					var pair = vars[i].split('=');
					if (pair[0] == variable) {
						return pair[1]
					}
				}
				return ''
			},
		},
		created() {
			this.begintime = this.getQueryVariable('endtime')
			this.endtime = this.getQueryVariable('endtime')
			axios.post('/index.php/api/getInitData').then(rew => {
				this.initData = rew.data.data

				for (let i = 0; i < this.initData.Department.info.length; i++) {
					this.initData.Department.info[i].ischeck = true
				}

				for (let i = 0; i < this.initData.Operator.info.length; i++) {
					this.initData.Operator.info[i].ischeck = true
				}
			})
		}
	})
</script>
</html>
