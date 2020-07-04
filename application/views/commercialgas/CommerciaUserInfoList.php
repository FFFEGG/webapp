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
	<title>商用气公司管理用户</title>
</head>
<body>
<div id="app" class="p-6">
	<div class="flex">
		<input type="text" v-model="memberid" class="p-2 border" placeholder="会员号选填">
		<p class="p-2">业务员</p>
		<select name="" id="" class="p-2 border">
			<option value="全部">全部</option>
			<option v-if="v.quartersid ==3" v-for="v in initData.Operator.info" :value="v.name">{{ v.name }}</option>
		</select>
		<p class="p-2">部门</p>
		<select name="" id="" class="p-2 border">
			<option value="全部">全部</option>
			<option v-if="v.type =='商用业务管理' || v.type =='商用业务'" v-for="v in initData.Department.info" :value="v.name">{{
				v.name }}
			</option>
		</select>
		<button @click="submit" class="bg-teal-500 text-white p-2 ml-2">搜索</button>
	</div>

	<table class="table-auto mt-6 w-full text-xs">
		<thead>
		<tr>
			<th class=" border">时间</th>
			<th class=" border">归属部门</th>
			<th class=" border">用户类型</th>
			<th class=" border">最近业务时间</th>
			<th class=" border">最近业务详情</th>
			<th class=" border">会员号</th>
			<th class=" border">姓名</th>
			<th class=" border">业务员</th>
			<th class=" border">电话</th>
			<th class=" border">状态</th>
			<th class=" border">操作</th>
		</tr>
		</thead>
		<tbody>

		<tr v-for="v in list">
			<td class="border ">
				{{ v.addtime }}
			</td>
			<td class="border ">
				{{ v.attributiondepartment }}
			</td>
			<td class="border ">
				{{ v.customertype }}
			</td>
			<td class="border ">
				{{ v.lasttransactiontime }}
			</td>
			<td class="border ">
				{{ v.lasttransactiondetails }}
			</td>
			<td class="border ">
				{{ v.memberid }}
			</td>
			<td class="border ">
				{{ v.name }}
			</td>
			<td class="border ">
				{{ v.salesman }}
			</td>
			<td class="border ">
				{{ v.telephone }}
			</td>
			<td class="border ">
				{{ v.state }}
			</td>

			<td class="border ">
				<button @click="addInterview(v)" class="p-2 bg-teal-500 text-white">添加走访</button>
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
				initData: '',
				memberid: '',
				salesman: '全部',
				attributiondepartment: '全部',
				list: []
			}
		},
		methods: {
			addInterview(data) {
				console.log(data)
				axios.post('/index.php/api/getUserAddress', {
					cardid: data.memberid
				}).then(res => {
					let list = res.data.list
					let str = ''
					for (let i = 0; i < list.length; i++) {
						str += '<option value="' + list[i].id + '">' + list[i].town + list[i].street + list[i].address + '</option>';
					}
					swal({
						title: '添加走访',
						html: '<input  id="swal-input1" class="swal2-input" placeholder="备注" required>' +
								'<select id="swal-input2" name="" id="" class="swal2-input" required>' +
								str +
								'</select>',
						focusConfirm: false,
						preConfirm: () => {
							return [
								document.getElementById('swal-input1').value,
								document.getElementById('swal-input2').value
							]
						},
						text: '填写走访备注',
						showCancelButton: true,
						confirmButtonText: '确认',
						cancelButtonText: '取消',
						confirmButtonClass: 'btn btn-success mr-3',
						cancelButtonClass: 'btn btn-danger',
						showLoaderOnConfirm: true,
						allowOutsideClick: false
					}).then(function (remarks) {
						if (remarks.value) {
							axios.post('/index.php/api/AddCommerciaSalesmanTask', {
								info: data,
								appointmentremarks: remarks.value
							}).then(rew => {
								if (rew.data.code == 200) {
									swal('成功')
								} else {
									swal('失败')
								}
							})
						}
					})
				})


			},
			submit() {
				axios.post('/index.php/api/CommerciaUserInfoList', {
					memberid: this.memberid,
					salesman: this.salesman,
					attributiondepartment: this.attributiondepartment,
				}).then(rew => {
					this.list = rew.data.list
				})
			}
		},
		created() {
			axios.post('/index.php/api/getInitData').then(rew => {
				this.initData = rew.data.data
			})
		}
	})
</script>
</html>
