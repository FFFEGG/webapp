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
	<title>部门缴款记录</title>
</head>
<body>
<div id="app" class="p-3">
	<div class="flex">
		<div class="p-2">开始时间</div>
		<input v-model="startime" class="border mx-3 p-2" type="date">
		<div class="p-2">结束时间</div>
		<input v-model="endtime" class="border mx-3 p-2" type="date">

		<button @click="submit" class="p-2 bg-teal-500 text-white px-4 rounded">查询</button>
	</div>
	<div class="flex">
		<table class="table-auto mt-6 w-4/12 text-xs rounded">
			<thead>
			<tr>

				<th class=" border">收款时间</th>
				<th class=" border">门店</th>
				<th class=" border">报表金额</th>
				<th class=" border">缴款单金额</th>


			</tr>
			</thead>
			<tbody>
			<template v-for="v in list">


				<tr class="cursor-pointer" @click="showdata(v.detailed)">
					<td class="border ">{{v.receivablestime}}</td>
					<td class="border ">{{v.department}}</td>

					<td class="border ">{{v.total}}</td>
					<td class="border ">{{v.inputtotal}}</td>
					<!--				 -->
					<!--					<td class="border ">-->
					<!--						<button @click="cancle(v)" class="bg-teal-500 text-white p-2">取消</button>-->
					<!--					</td>-->
				</tr>

			</template>
			</tbody>
		</table>

		<table class="table-auto w-full w-4/12 mt-6 text-xs ml-6">
			<thead>
			<tr>

				<th class=" border">添加时间</th>
				<th class=" border">门店</th>
				<th class=" border">操作员</th>
				<th class=" border">交款时间</th>
				<th class=" border">项目</th>
				<th class=" border">收款时间</th>
				<th class=" border">单据号</th>
				<th class=" border">金额</th>


			</tr>
			</thead>
			<tbody>
			<template v-for="v in detailed">


				<tr>
					<td class="border ">{{v.addtime}}</td>
					<td class="border ">{{v.department}}</td>

					<td class="border ">{{v.operator}}</td>
					<td class="border ">{{v.paymentyime}}</td>
					<td class="border ">{{v.project}}</td>
					<td class="border ">{{v.receivablestime}}</td>
					<td class="border ">{{v.serial}}</td>
					<td class="border ">{{v.total}}</td>

				</tr>

			</template>
			</tbody>
		</table>
	</div>

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
				timetype: '录入时间',
				startime: '2010-01-01',
				detailed: []
			}
		},
		methods: {
			showdata(detailed) {
				this.detailed = detailed
			},
			cancle(data) {
				let that = this;
				swal({
					title: '确定取消？',
					text: '',
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: '确定',
					cancelButtonText: '取消',
					confirmButtonClass: 'btn btn-success',
					cancelButtonClass: 'btn btn-danger',
				}).then(function (dismiss) {
					if (dismiss.value) {
						axios.post('/index.php/api/CancelDepartmentPayment', {
							info: data
						}).then(rew => {
							if (rew.data.code == 200) {
								swal('取消成功')
							} else {
								swal('取消失败')
							}
							that.submit()
						})
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
				axios.post('/index.php/api/CheckDepartmentPaymentRecord', {
					begintime: this.startime,
					endtime: this.endtime,
					timetype: this.timetype,
				}).then(rew => {
					this.list = rew.data.list
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
