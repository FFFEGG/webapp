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
	<script src="<?php echo base_url(); ?>res/js/vuetable-2.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>res/css/index.css">
	<!-- 引入组件库 -->
	<script src="<?php echo base_url(); ?>res/js/index.js"></script>
	<title></title>
</head>
<body>
<div id="app">
	<table class="table-auto  w-full bg-white" style="position: fixed;top: 0">
		<thead>
		<tr>
			<th style="width: 10%" class=" border-2">门店</th>
			<th style="width: 10%" class=" border-2">规格</th>
			<th style="width: 10%" class=" border-2">期初库存</th>
			<th style="width: 10%" class=" border-2">计划</th>
			<th style="width: 10%" class=" border-2">已安排</th>
			<th style="width: 10%" class=" border-2">未安排</th>
			<th style="width: 10%" class=" border-2">昨日销量</th>
			<th style="width: 10%" class=" border-2">今日销量</th>
			<th style="width: 10%" class=" border-2">理论库存</th>
			<th style="width: 10%" class=" border-2">操作</th>
		</tr>
		</thead>
	</table>
	<table class="table-auto  w-full mt-6">
		<tbody>
		<template v-for="v in list">


		<tr class="text-center" v-for="(vi,index) in v.list">
			<td style="width: 10%" v-if="index==0" class="border-2 " :rowspan="v.list.length">{{ v.department}}</td>
			<td style="width: 10%" class="border-2 ">
				{{ vi.goodsname}}
			</td>
			<td style="width: 10%" class="border-2 ">
				{{ vi.stock}}
			</td>

			<td style="width: 10%" class="border-2 ">
				{{ vi.plan}}
			</td>

			<td style="width: 10%" class="border-2 ">
				{{ vi.arrange}}
			</td>

			<td style="width: 10%" class="border-2 ">
				{{ vi.noarrange}}
			</td>

			<td style="width: 10%" class="border-2 ">
				{{ vi.yesterdaysale}}
			</td>

			<td style="width: 10%" class="border-2 ">
				{{ vi.todaysale}}
			</td>

			<td style="width: 10%" class="border-2 ">
				{{ vi.theorystock}}
			</td>



			<td style="width: 10%" @click="ap(v)" v-if="index==0" class="border-2  text-lg font-bold cursor-pointer" :rowspan="v.list.length">
				安排
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
				options: <?= json_encode($_SESSION['initData']->Department->info)?>,
				department: '运输公司',
				list: [],
				tableData: [{
					date: '2016-05-03',
					name: '王小虎',
					province: '上海',
					city: '普陀区',
					address: '上海市普陀区金沙江路 1518 弄',
					zip: 200333
				}, {
					date: '2016-05-02',
					name: '王小虎',
					province: '上海',
					city: '普陀区',
					address: '上海市普陀区金沙江路 1518 弄',
					zip: 200333
				}, {
					date: '2016-05-04',
					name: '王小虎',
					province: '上海',
					city: '普陀区',
					address: '上海市普陀区金沙江路 1518 弄',
					zip: 200333
				}, {
					date: '2016-05-01',
					name: '王小虎',
					province: '上海',
					city: '普陀区',
					address: '上海市普陀区金沙江路 1518 弄',
					zip: 200333
				}, {
					date: '2016-05-08',
					name: '王小虎',
					province: '上海',
					city: '普陀区',
					address: '上海市普陀区金沙江路 1518 弄',
					zip: 200333
				}, {
					date: '2016-05-06',
					name: '王小虎',
					province: '上海',
					city: '普陀区',
					address: '上海市普陀区金沙江路 1518 弄',
					zip: 200333
				}, {
					date: '2016-05-07',
					name: '王小虎',
					province: '上海',
					city: '普陀区',
					address: '上海市普陀区金沙江路 1518 弄',
					zip: 200333
				}]
			}
		},
		computed : {
		},
		methods: {
			ap (v) {
				Win10_child.openUrl('/index.php/allocation/dispatchss?department='+ v.department,'物资调运')
			},
			submit () {
				axios.post('/index.php/api/AllocationPlanMonitor',{
					department: this.department?this.department:'全部'
				}).then(rew=>{
					this.list = rew.data.list
				})
			}
		},
		created() {
			this.submit()
		}
	})
</script>
</html>
