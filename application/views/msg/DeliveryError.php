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
	<title>配送错误瓶信息</title>
</head>
<body>
<div id="app" class=" p-3">
	<div class="flex">
		<div class="p-2">开始时间</div>
		<input v-model="startime" class="border mx-3 p-2" type="date">
		<div class="p-2">结束时间</div>
		<input v-model="endtime" class="border mx-3 p-2" type="date">
		<div class="p-2">部门</div>
		<select name="" id="" class="border mx-3 p-2" v-model="department">
			<option value="全部">全部</option>
			<option v-for="v in initData.Department.info" :value="v.name">{{v.name}}</option>
		</select>
		<button @click="submit" class="p-2 bg-teal-500 text-white px-4">查询</button>
	</div>

	<table class="table-auto mt-6 w-full text-xs">
		<thead>
		<tr>
			<th class=" border">发现时间</th>
			<th class=" border">备注</th>
			<th class=" border">钢瓶号</th>
			<th class=" border">部门</th>

			<th class=" border">配送员</th>
			<th class=" border">状态</th>
			<th class=" border">操作</th>


		</tr>
		</thead>
		<tbody>
		<template v-for="v in list">


			<tr>
				<td class="border ">
					{{v.raddtime}}
				</td>
				<td class="border ">{{v.remarks}}</td>
				<td class="border ">{{v.code}}</td>

				<td class="border ">{{v.department}}</td>
				<td class="border ">{{v.brokerage}}</td>
				<td class="border ">{{v.state}}</td>
				<td class="border ">
					<button v-if="v.state != '取消'" @click="cancel(v)" class="bg-teal-500 text-white p-2">取消</button>
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
				department: '全部',
				startime: '2010-01-01'
			}
		},
		methods: {
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
				axios.post('/index.php/api/getDeliveryError', {
					startime: this.startime,
					endtime: this.endtime,
					department: this.department,
				}).then(rew => {
					this.list = rew.data.list
				})
			},
			cancel(data) {
				let that = this
				swal({
					title: '确认取消',
					showCancelButton: true,
					confirmButtonText: '确认',
					cancelButtonText: '取消',
					confirmButtonClass: 'btn btn-success mr-3',
					cancelButtonClass: 'btn btn-danger',
					showLoaderOnConfirm: true,
					allowOutsideClick: false
				}).then(function (remarks) {
					if (remarks.value) {

						axios.post('/index.php/api/CancelPackingtypeCheakRecord', {
							serial: data.serial,
							rserial: data.rserial,
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
			}
		},
		created() {
			this.endtime = this.getQueryVariable('endtime')
			axios.post('/index.php/api/getInitData').then(rew => {
				this.initData = rew.data.data
				this.wxy = rew.data.wxy
			})
		}
	})
</script>
</html>
