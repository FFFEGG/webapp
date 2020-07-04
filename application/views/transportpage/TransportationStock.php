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
	<title></title>
</head>
<body>
<div id="app" class="p-6">
	<div class="lg:flex">
		<div class="flex">
			<p class="p-2 border-2 border-r-0 rounded-l">开始时间</p>
			<input class="p-2 border-2 rounded-r" type="date" v-model="begintime">
		</div>
		<div class="flex">
			<p class="p-2 border-2 border-r-0 rounded-l lg:ml-3">结束时间</p>
			<input class="p-2 border-2 rounded-r" type="date" v-model="endtime">
		</div>

		<div class="flex">
			<p class="p-2 border-2 border-r-0 rounded-l lg:ml-3">查询方式</p>

			<select name="" id="" class="p-2 border-2 rounded-r" v-model="mode">
				<option value="理论">理论</option>
				<option value="记账">记账</option>
			</select>
		</div>
		<button @click="submit" class="p-1 px-5 mx-5 bg-teal-500 text-white rounded">搜索</button>
		<button @click="TransportationStockBookkeeping" class="p-1 px-5 mx-5 bg-teal-500 text-white rounded">记账</button>
		<button @click="TransportationCancelStockBookkeeping" class="p-1 px-5 mx-5 bg-teal-500 text-white rounded">删除记账</button>
	</div>


	<table class="table-auto mt-6 w-full text-xs">
		<thead>
		<tr>
			<th class=" border-2" rowspan="2">规格</th>
			<th class=" border-2" rowspan="2">期初结存</th>
			<th class=" border-2" colspan="6">调入</th>
			<th class=" border-2" colspan="4">调出</th>
			<th class=" border-2"  rowspan="2">期末结存</th>
		</tr>
		<tr>
			<th class=" border-2">门店</th>
			<th class=" border-2">商业</th>
			<th class=" border-2">新购</th>
			<th class=" border-2">容检</th>
			<th class=" border-2">票据</th>
			<th class=" border-2">收购</th>
			<th class=" border-2">门店</th>
			<th class=" border-2">商业</th>
			<th class=" border-2">购瓶</th>
			<th class=" border-2">容检</th>

		</tr>
		</thead>
		<tbody>

		<tr class="text-center" v-for="v in list">
			<td class="border-2 ">{{ v.packingtype}}</td>
			<td class="border-2 ">{{ v.beginstock}}</td>

			<td class="border-2  cursor-pointer text-blue-500" @click="seedata('调入','门店',v.mddr,v.packingtype)">{{ v.mddr}}</td>
			<td class="border-2  cursor-pointer text-blue-500" @click="seedata('调入','商业',v.sydr,v.packingtype)">{{ v.sydr}}</td>
			<td class="border-2  cursor-pointer text-blue-500" @click="seedata('调入','新购',v.xgdr,v.packingtype)">{{ v.xgdr}}</td>
			<td class="border-2  cursor-pointer text-blue-500" @click="seedata('调入','容检',v.rjdr,v.packingtype)">{{ v.rjdr}}</td>

			<td class="border-2  cursor-pointer text-blue-500" @click="seedata('调入','票据',v.pjdr,v.packingtype)">{{ v.pjdr}}</td>

			<td class="border-2  cursor-pointer text-blue-500" @click="seedata('调入','收购',v.sgdr,v.packingtype)">{{ v.sgdr}}</td>

			<td class="border-2  cursor-pointer text-blue-500" @click="seedata('调出','门店',v.mddc,v.packingtype)">{{ v.mddc}}</td>
			<td class="border-2  cursor-pointer text-blue-500" @click="seedata('调出','商业',v.sydc,v.packingtype)">{{ v.sydc}}</td>
			<td class="border-2  cursor-pointer text-blue-500" @click="seedata('调出','购瓶',v.gpdc,v.packingtype)">{{ v.gpdc}}</td>
			<td class="border-2  cursor-pointer text-blue-500" @click="seedata('调出','容检',v.rjdc,v.packingtype)">{{ v.rjdc}}</td>
			<td class="border-2 ">{{ v.endstock}}</td>
		</tr>

		</tbody>
	</table>
</div>
</body>
<script>
	new Vue({
		el: '#app',
		data() {
			return {
				begintime: '',
				endtime: '',
				mode: '理论',
				list: []
			}
		},
		methods: {
			seedata (type,project,num,packingtype) {
				if (num <= 0) {
					return false
				}
				axios.post('/index.php/api/ReportDetailed', {
					info: {
						type: type,
						project: project,
						packingtype: packingtype,
					},
					type: '运输公司库存报表',
					reporttype: '运输公司库存报表',
					begintime: this.begintime,
					endtime: this.endtime,
				}).then(rew => {
					if (rew.data.code == 200) {
						localStorage.setItem('tabledata',JSON.stringify(rew.data.list))
						Win10_child.openUrl('/index.php/msg/tabledata','运输公司库存报表')
					}
				})
			},
			submit() {
				this.list = []
				axios.post('/index.php/api/TransportationStock', {
					begintime: this.begintime,
					endtime: this.endtime,
					mode: this.mode
				}).then(rew => {
					this.list = rew.data.data
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
			TransportationStockBookkeeping () {
				axios.post('/index.php/api/TransportationStockBookkeeping', {
					begintime: this.begintime,
					endtime: this.endtime,
					list: this.list
				}).then(rew => {
					if (rew.data.code == 200) {
						swal('记账成功')
					} else {
						swal('记账失败')
					}
					//this.list = rew.data.data
				})
			},	TransportationCancelStockBookkeeping () {
				axios.post('/index.php/api/TransportationCancelStockBookkeeping', {
					begintime: this.begintime,
					endtime: this.endtime,
					list: this.list
				}).then(rew => {
					if (rew.data.code == 200) {
						swal('删除成功')
					} else {
						swal('删除失败')
					}
					//this.list = rew.data.data
				})
			},
		},
		created() {
			this.begintime = this.getQueryVariable('endtime')
			this.endtime = this.getQueryVariable('endtime')
		}
	})
</script>
</html>
