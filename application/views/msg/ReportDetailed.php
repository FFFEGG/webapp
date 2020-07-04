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
	<title>运输公司库存报表</title>
</head>
<body>
<div id="app" class="p-6">
	<div class="flex">
		<p class="p-2 border-2 border-r-0 rounded-l">开始时间</p>
		<input class="p-2 border-2 rounded-r" type="date" v-model="begintime">
		<p class="p-2 border-2 border-r-0 rounded-l ml-3">结束时间</p>
		<input class="p-2 border-2 rounded-r" type="date" v-model="endtime">
		<button @click="submit" class="p-1 px-5 mx-5 bg-teal-500 text-white rounded">搜索</button>
	</div>

	<table class="table-auto mt-6 w-full text-xs">
		<thead>
		<tr>
			<th class=" border-2">订单号</th>

			<th class=" border-2">录入时间</th>
			<th class=" border-2">钢瓶类型</th>
			<th class=" border-2">登记号</th>
			<th class=" border-2">条形码内容</th>
			<th class=" border-2">出厂日期</th>
			<th class=" border-2">检测日期</th>
			<th class=" border-2">下检日期</th>
			<th class=" border-2">录入部门</th>
			<th class=" border-2">录入人</th>
			<th class=" border-2">打印次数</th>
			<th class=" border-2">操作</th>
		</tr>
		</thead>
		<tbody>

		<tr class="text-center" v-for="v in list">
			<td class="border-2 ">{{ v.serial}}</td>
			<td class="border-2 ">{{ v.addtime}}</td>
			<td class="border-2 ">{{ v.bottletype}}</td>
			<td class="border-2 ">{{ v.regnumber}}</td>
			<td class="border-2 ">{{ v.code}}</td>
			<td class="border-2 ">{{ v.date4manufacture}}</td>
			<td class="border-2 ">{{ v.date4testing}}</td>
			<td class="border-2 ">{{ v.date4nexttesting}}</td>
			<td class="border-2 ">{{ v.department}}</td>
			<td class="border-2 ">{{ v.operator}}</td>
			<td class="border-2 ">{{ v.printnum}}</td>
			<td class="border-2 ">
				<button @click="cancle(v)" class="p-2 bg-teal-500 text-white">取消</button>
			</td>
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
				type: '',
				project: '',
				packingtype: ''
			}
		},
		methods: {
			submit() {
				axios.post('/index.php/api/ReprintCodeRecord', {
					begintime: this.begintime,
					endtime: this.endtime,
				}).then(rew => {
					console.log(rew.data)
				})
			},

		},
		created() {
			var data = JSON.parse(localStorage.getItem('ReportDetailed'))

			axios.post('/index.php/api/ReportDetailed', {
				type: data.type,
				project: data.project,
				packingtype: data.packingtype
			}).then(rew => {
				this.list = rew.data.list
			})


		}
	})
</script>
</html>
