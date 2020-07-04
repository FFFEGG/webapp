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
	<title>Document</title>
</head>
<body>
<div id="app" class=" p-3">
	<div class="flex">
		<div class="p-2">开始时间</div>
		<input v-model="startime" class="border mx-3 p-2" type="date">
		<div class="p-2">结束时间</div>
		<input v-model="endtime" class="border mx-3 p-2" type="date">
		<button @click="submit" class="p-2 bg-teal-500 text-white px-4">查询</button>
	</div>
	<table class="table-auto mt-6 w-full text-xs">
		<thead>
		<tr>
			<th class=" border">日期</th>


			<th class=" border">USERID</th>
			<th class=" border">会员号</th>

			<th class=" border">地址</th>
			<th class=" border">用户类型</th>
			<th class=" border">处理部门</th>
			<th class=" border">维修员</th>
			<th class=" border">预约备注</th>
			<th class=" border">反馈备注</th>
			<th class=" border">状态</th>
			<th class=" border">操作</th>
		</tr>
		</thead>
		<tbody>
		<template v-for="v in list">
			<tr>
				<td class="border ">{{v.addtime}}</td>
				<td class="border ">{{v.userid}}</td>
				<td class="border ">{{v.memberid}}</td>
				<td class="border ">{{v.address}}</td>
				<td class="border ">{{v.customertype}}</td>
				<td class="border ">{{v.department}}</td>
				<td class="border ">{{v.maintenanceman}}</td>
				<td class="border ">{{v.appointmentremarks}}</td>
				<td class="border ">{{v.remarks}}</td>
				<td class="border ">{{v.state}}</td>
				<td class="border ">

					<button @click="cancle(v)" class="text-white bg-teal-500 p-2 px-4">取消</button>
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
				startime: '',
				endtime: '',
				list: []
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
				axios.post('/index.php/api/getGPxiulou', {
					startime: this.startime,
					endtime: this.endtime,
				}).then(rew => {
					this.list = rew.data.list
				})
			},
			cancle(data) {
				if (data.state != '正常') {
					swal('该状态无法取消');
					return false
				}
				let that = this;
				swal({
					title: '确定取消吗？',
					text: '填写取消备注！',
					input: 'text',
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: '确定',
					cancelButtonText: '取消',
				}).then(function (diss) {

					if (diss.dismiss != 'cancel') {
						axios.post('/index.php/api/CancelUserDepartmentRepair', {
							order: data,
							remarks: diss.value
						}).then(rew => {
							if (rew.data.code == 200) {
								swal(
										'取消成功！',
										'订单已取消。',
										'success'
								)
							} else {
								swal(
										'取消失败！',
										'',
										'error'
								)
							}
							that.submit()
						})
					}
				})
			}
		},
		created() {
			this.endtime = this.getQueryVariable('endtime')
			this.startime = this.getQueryVariable('endtime')
		}
	})
</script>
</html>
