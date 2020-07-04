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
	<title>Document</title>
</head>
<body>
<div id="app" class="p-6">
	<div class="flex">
		<p class="p-2">开始时间</p>
		<input v-model="begintime" type="date" class="p-2 border">
		<p class="p-2">结束时间</p>
		<input v-model="endtime" type="date" class="p-2 border">
		<button @click="submit" class="bg-teal-500 text-white p-2 ml-3 px-3">搜索</button>
		<button onclick="Win10_child.openUrl('/index.php/ywpage/DepartmentQualitySpotCheck','门店商品质量抽查')" class="bg-teal-500 text-white p-2 ml-3 px-3">添加抽查记录</button>
	</div>


	<div class="mt-6">
		<table class="table-auto mt-6 w-full text-xs">
			<thead>
			<tr>
				<th class=" border">ID</th>

				<th class=" border">录入时间</th>

				<th class=" border">门店</th>
				<th class=" border">操作员</th>
				<th class=" border">包装物类型</th>
				<th class=" border">钢瓶号</th>
				<th class=" border">充装编号</th>
				<th class=" border">重瓶重量</th>
				<th class=" border">空瓶重量</th>
				<th class=" border">备注</th>
				<th class=" border">状态</th>
				<th class=" border">操作</th>
			</tr>
			</thead>
			<tbody>
			<template v-for="v in list" >


				<tr class="text-center">
					<td class="border  ">{{v.id}}</td>
					<td class="border  ">{{v.addtime}}</td>
					<td class="border  ">{{v.department}}</td>
					<td class="border  ">{{v.operator}}</td>
					<td class="border  ">{{v.packingtype}}</td>
					<td class="border  ">{{v.code}}</td>
					<td class="border  ">{{v.fillno}}</td>
					<td class="border  ">{{v.commodityweight}}</td>
					<td class="border  ">{{v.emptyweight}}</td>
					<td class="border  ">{{v.remarks}}</td>
					<td class="border  ">{{v.state}}</td>
					<td class="border  ">
						<button v-if="v.state == '正常'" @click="CancelDepartmentQualitySpotCheck(v)" class="p-1 text-white bg-teal-500">取消</button>
					</td>
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
				begintime: '',
				endtime: '',
				list: []
			}
		},
		methods: {
			CancelDepartmentQualitySpotCheck (data) {
				axios.post('/index.php/api/CancelDepartmentQualitySpotCheck', {
					info: data,
				}).then(rew => {
					if (rew.data.code == 200) {
						swal('取消成功')
					} else {
						swal('取消失败')
					}
					this.submit()
 				})
			},
			submit() {
				axios.post('/index.php/api/DepartmentQualitySpotCheckRecord', {
					begintime: this.begintime,
					endtime: this.endtime,
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
			this.begintime = this.getQueryVariable('endtime')
			this.endtime = this.getQueryVariable('endtime')
		}
	})
</script>
</html>
