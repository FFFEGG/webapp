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
	<title>编辑用户抵押物费用</title>
</head>
<body>
<div id="app" class="p-6">
	<div class="flex">
		<input class="p-2 border-2 rounded-r" @keyup.enter="submit" type="text" v-model="memberid" placeholder="会员号">
		<p class="p-2 border-2 border-r-0 rounded-l ml-3">开始时间</p>
		<input class="p-2 border-2 rounded-r" type="date" v-model="begintime">
		<p class="p-2 border-2 border-r-0 rounded-l ml-3">结束时间</p>
		<input class="p-2 border-2 rounded-r" type="date" v-model="endtime">
		<button @click="submit" class="p-1 px-5 mx-5 bg-teal-500 text-white rounded">搜索</button>
	</div>

	<table class="table-auto mt-6 w-full text-xs">
		<thead>
		<tr>
			<th class=" border-2">录入时间</th>

			<th class=" border-2">抵押物订单号</th>
			<th class=" border-2">包装物类型</th>
			<th class=" border-2">项目</th>
			<th class=" border-2">金额</th>
			<th class=" border-2">收取订单号</th>
			<th class=" border-2">状态</th>
			<th class=" border-2">备注</th>
			<th class=" border-2">操作</th>

		</tr>
		</thead>
		<tbody>

		<tr class="text-center" v-for="v in list" v-if="v.state=='正常' || v.state =='撤销'">
			<td class="border-2 ">{{ v.addtime}}</td>
			<td class="border-2 ">{{ v.serial_collateral}}</td>
			<td class="border-2 ">{{ v.packingtype}}</td>
			<td class="border-2 ">{{ v.project}}</td>
			<td class="border-2 ">{{ v.total}}</td>

			<td class="border-2 ">{{ v.serial_collect}}</td>
			<td class="border-2 ">{{ v.state}}</td>
			<td class="border-2 ">{{ v.remarks}}</td>
			<td class="border-2 ">
				<button @click="EditUserCollateralCharge(v)" class="p-2 bg-teal-500 text-white">编辑</button>
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
				begintime: '',
				endtime: '',
				department: '',
				list: [],
				memberid: '',
				data: '',
			}
		},
		computed: {},
		methods: {
			EditUserCollateralCharge(data) {
				let that = this
				swal({
					title: '编辑用户抵押物费用',
					html: '<input  id="swal-input1" class="swal2-input" value="' + Number(data.total) + '" placeholder="金额" required>' +
							'<select id="swal-input2" name="" id="" class="swal2-input" required>' +
							'<option  value="撤销">撤销</option>' +
							'<option selected value="正常">正常</option>' +
							'</select>',
					focusConfirm: false,
					preConfirm: () => {
						return [
							document.getElementById('swal-input1').value,
							document.getElementById('swal-input2').value
						]
					},
					showCancelButton: true,
					confirmButtonText: '确认',
					cancelButtonText: '取消',
					confirmButtonClass: 'btn btn-success mr-3',
					cancelButtonClass: 'btn btn-danger',
					showLoaderOnConfirm: true,
					allowOutsideClick: false
				}).then(function (remarks) {
					if (remarks.value) {
						axios.post('/index.php/api/EditUserCollateralCharge', {
							userid: data.userid,
							id: data.id,
							serial: data.serial,
							price: remarks.value[0],
							state: remarks.value[1],
						}).then(rew => {
							if (rew.data.code == 200) {
								swal('成功')
							} else {
								swal('失败')
							}
							that.submit()
						})
					}
				})
			},
			submit() {
				axios.post('/index.php/api/usercharge', {
					begintime: this.begintime,
					endtime: this.endtime,
					memberid: this.memberid,
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
			}
		},
		created() {
			this.begintime = this.getQueryVariable('endtime')
			this.endtime = this.getQueryVariable('endtime')
		}
	})
</script>
</html>
