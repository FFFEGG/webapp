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
	<title>获取档案列表</title>
</head>
<body>
<div id="app" class=" p-3">
	<div class="flex">
		<div class="p-2">开始时间</div>
		<input v-model="begintime" class="border mx-3 p-2" type="date">
		<div class="p-2">结束时间</div>
		<input v-model="endtime" class="border mx-3 p-2" type="date">
		<button @click="submit" class="p-2 bg-teal-500 text-white px-4">查询</button>
	</div>

	<table class="table-auto mt-6 w-full text-xs">
		<thead>
		<tr>
			<th class=" border">录入时间</th>
			<th class=" border">制造单位</th>
			<th class=" border">设备品种</th>
			<th class=" border">材料</th>
			<th class=" border">气瓶类型</th>
			<th class=" border">充装介质</th>
			<th class=" border">出厂码</th>
			<th class=" border">容积(L)</th>
			<th class=" border">设计壁厚(mm)</th>
			<th class=" border">公称压力(Mpa)</th>
			<th class=" border">重量(KG)</th>
			<th class=" border">备注</th>
			<th class=" border">出厂日期</th>
			<th class=" border">产权单位</th>
			<th class=" border">登记码(钢印号)</th>
			<th class=" border">检测日期</th>
			<th class=" border">下检日期</th>
			<th class=" border">识别码</th>
			<th class=" border">部门</th>
			<th class=" border">操作员</th>
			<th class=" border">操作</th>


		</tr>
		</thead>
		<tbody>
		<template v-for="v in list">
			<tr>
				<td class="border ">{{v.addtime}}</td>
				<td class="border ">{{v.manufacturingunit}}</td>
				<td class="border ">{{v.equipmentvariety}}</td>
				<td class="border ">{{v.material}}</td>
				<td class="border ">{{v.bottletype}}</td>
				<td class="border ">{{v.fillingmedium}}</td>
				<td class="border ">{{v.productionnumber}}</td>
				<td class="border ">{{v.volume}}</td>
				<td class="border ">{{v.wallthickness}}</td>
				<td class="border ">{{v.nominalpressure}}</td>
				<td class="border ">{{v.weight}}</td>
				<td class="border ">{{v.remarks}}</td>
				<td class="border ">{{v.date4manufacture}}</td>
				<td class="border ">{{v.propertyunit}}</td>
				<td class="border ">{{v.regnumber}}</td>
				<td class="border ">{{v.date4testing}}</td>
				<td class="border ">{{v.date4nexttesting}}</td>
				<td class="border ">{{v.code}}</td>
				<td class="border ">{{v.department}}</td>
				<td class="border ">{{v.operator}}</td>
				<td class="border ">
					<button @click="TPrint(v)" class="bg-teal-500 text-white p-1">打印</button>
				</td>
			</tr>

		</template>
		</tbody>
	</table>
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
				begintime: '2010-01-01'
			}
		},
		computed: {
			deliverylist() {
				var arr = []
				for (let i = 0; i < this.list.length; i++) {
					if (this.list[i].ischeck == true) {
						arr = arr.concat(this.list[i].name)
					}
				}
				return arr
			}
		},
		methods: {
			TPrint(data) {
				let info = {
					"PrintData": {
						"code": data.code,
						"weight": data.weight,
						"date4nexttesting": data.date4nexttesting,
						"inputtext": data.inputtext
					}, "Print": true
				}
				axios.get('http://127.0.0.1:8000/print/order/9/?data=' + JSON.stringify(info)).then(rew => {
					console.log(rew)
				})
			},
			submit() {
				axios.post('/index.php/api/ArchivesList', {
					begintime: this.begintime,
					endtime: this.endtime
				}).then(rew => {
					this.list = rew.data.list
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
		},
		created() {
			this.endtime = this.getQueryVariable('endtime')
		}
	})
</script>
</html>
