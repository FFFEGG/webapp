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
	<title>部门维修列表</title>
</head>
<body>
<div id="app" class=" p-3">
	<div class="flex">
		<div class="p-2">开始时间</div>
		<input v-model="startime" class="border-2 mx-3 p-2" type="date">
		<div class="p-2">结束时间</div>
		<input v-model="endtime" class="border-2 mx-3 p-2" type="date">
		<div class="p-2">部门</div>
		<select name="" id="" class="border-2 mx-3 p-2" v-model="department">
			<option value="全部">全部</option>
			<option v-for="v in initData.Department.info" :value="v.name">{{v.name}}</option>
		</select>
		<input type="text" class="border-2 mx-3 p-2" placeholder="用户卡号" v-model="memberid">
		<button @click="submit" class="p-2 bg-teal-500 text-white px-4">查询</button>
	</div>

	<table class="table-auto mt-6 w-full text-xs">
		<thead>
		<tr>
			<th class=" border-2">时间-订单号</th>


			<th class=" border-2">卡号</th>
			<th class=" border-2">预约人</th>
			<th class=" border-2">用户电话</th>
			<th class=" border-2">录入站点</th>
			<th class=" border-2">方式</th>

			<th class=" border-2">维修项目</th>
			<th class=" border-2">维修员</th>

			<th class=" border-2">地址</th>
			<th class=" border-2">备注</th>
			<th class=" border-2">业务部门</th>
			<th class=" border-2">操作员</th>
			<th class=" border-2">状态</th>
			<th class=" border-2">操作</th>
		</tr>
		</thead>
		<tbody>
		<template v-for="v in listorder">


			<tr v-if="v.state=='取消'" style="color: #ff86f2" class="text-center">
				<td class="border-2  text-left">
					<p>添加时间：{{v.addtime}}</p>
					<p>上门时间：{{v.appointmenttime}}</p>
					<p>订单号：{{v.serial}}</p>
				</td>
				<td class="border-2 ">{{v.memberid}}</td>
				<td class="border-2 ">{{v.registrar}}</td>
				<td class="border-2 ">{{v.telephone}}</td>
				<td class="border-2 ">{{v.inputperson}}</td>
				<td class="border-2 ">{{v.mode}}</td>

				<td class="border-2 ">{{v.object}}</td>
				<td class="border-2 ">{{v.maintenanceman}}</td>

				<td class="border-2 ">{{v.city}}{{v.area}}{{v.town}}{{v.street}}{{v.housenumber}}{{v.address}}
				</td>
				<td class="border-2 ">{{v.appointmentremarks}}</td>
				<td class="border-2 ">{{v.department}}</td>
				<td class="border-2 ">{{v.operator}}</td>
				<td class="border-2 ">{{v.state}}</td>
				<td class="border-2 ">

				</td>
			</tr>
			<tr v-else-if="v.state=='已安排'" style="color: red" class="text-center">
				<td class="border-2 ">
					<p>添加时间：{{v.addtime}}</p>
					<p>上门时间：{{v.appointmenttime}}</p>
					<p>订单号：{{v.serial}}</p>
				</td>
				<td class="border-2 ">{{v.memberid}}</td>
				<td class="border-2 ">{{v.registrar}}</td>
				<td class="border-2 ">{{v.telephone}}</td>
				<td class="border-2 ">{{v.inputperson}}</td>
				<td class="border-2 ">{{v.mode}}</td>

				<td class="border-2 ">{{v.object}}</td>
				<td class="border-2 ">{{v.maintenanceman}}</td>

				<td class="border-2 ">{{v.city}}{{v.area}}{{v.town}}{{v.street}}{{v.housenumber}}{{v.address}}
				</td>
				<td class="border-2 ">{{v.appointmentremarks}}</td>
				<td class="border-2 ">{{v.department}}</td>
				<td class="border-2 ">{{v.operator}}</td>
				<td class="border-2 ">{{v.state}}</td>
				<td class="border-2 ">
					<!--					<button @click="fk(v)" class="bg-teal-500 text-white p-1">反馈</button>-->
				</td>
			</tr>
			<tr v-else-if="v.state=='已汇总'" style="color: blue" class="text-center">
				<td class="border-2 ">
					<p>添加时间：{{v.addtime}}</p>
					<p>上门时间：{{v.appointmenttime}}</p>
					<p>订单号：{{v.serial}}</p>
				</td>
				<td class="border-2 ">{{v.memberid}}</td>
				<td class="border-2 ">{{v.registrar}}</td>
				<td class="border-2 ">{{v.telephone}}</td>
				<td class="border-2 ">{{v.inputperson}}</td>
				<td class="border-2 ">{{v.mode}}</td>

				<td class="border-2 ">{{v.object}}</td>
				<td class="border-2 ">{{v.maintenanceman}}</td>

				<td class="border-2 ">{{v.city}}{{v.area}}{{v.town}}{{v.street}}{{v.housenumber}}{{v.address}}
				</td>
				<td class="border-2 ">{{v.appointmentremarks}}</td>
				<td class="border-2 ">{{v.department}}</td>
				<td class="border-2 ">{{v.operator}}</td>
				<td class="border-2 ">{{v.state}}</td>
				<td class="border-2 ">
				</td>
			</tr>
			<tr v-else class="text-center">
				<td class="border-2 ">
					<p>添加时间：{{v.addtime}}</p>
					<p>上门时间：{{v.appointmenttime}}</p>
					<p>订单号：{{v.serial}}</p>
				</td>
				<td class="border-2 ">{{v.memberid}}</td>
				<td class="border-2 ">{{v.registrar}}</td>
				<td class="border-2 ">{{v.telephone}}</td>
				<td class="border-2 ">{{v.inputperson}}</td>
				<td class="border-2 ">{{v.mode}}</td>

				<td class="border-2 ">{{v.object}}</td>
				<td class="border-2 ">{{v.maintenanceman}}</td>

				<td class="border-2 ">{{v.city}}{{v.area}}{{v.town}}{{v.street}}{{v.housenumber}}{{v.address}}
				</td>
				<td class="border-2 ">{{v.appointmentremarks}}</td>
				<td class="border-2 ">{{v.department}}</td>
				<td class="border-2 ">{{v.operator}}</td>
				<td class="border-2 ">{{v.state}}</td>
				<td class="border-2 ">
					<button @click="cancle(v)" class="bg-teal-500 text-white p-1">取消</button>
					<button @click="updatedepartment(v)" class="bg-teal-500 text-white p-1">修改</button>
				</td>
			</tr>
		</template>
		</tbody>
	</table>


	<div v-if="apshow" class="fixed px-4 w-64 h-64 py-3 bg-gray-400" style="top: 20%;left: 40%">
		<p class="my-3">安排维修业务</p>
		<p class="my-3">选择维修员</p>
		<select v-model="maintenanceman" name="" id="" class="my-3 w-full p-1">
			<option value="">选择</option>
			<option v-for="v in wxy" :value="v.name">{{ v.name }}</option>
		</select>
		<button @click="HandleUserDepartmentRepair" class="bg-teal-500 my-3  p-2 text-white block">确认安排</button>
		<div @click="close" class="absolute top-0 text-white cursor-pointer text-lg" style="right: 10px">X</div>
	</div>

	<div v-if="fkshow" class="fixed px-4 w-7/12  py-3 bg-gray-400" style="top: 20%;left: 15%;">
		<p class="my-3">反馈维修业务</p>
		<p class="my-3">备注</p>
		<input v-model="remarks" class="border-2 p-2 w-8/12" type="text" placeholder="选填">
		<p class="my-3">评价</p>
		<input v-model="evaluate" class="border-2 p-2 w-8/12" type="text" placeholder="选填">
		<button @click="FeedbackUserDepartmentRepair" class="bg-teal-500 my-3  p-2 text-white block">确认反馈</button>
		<div @click="close" class="absolute top-0 text-white cursor-pointer text-lg" style="right: 10px">X</div>
	</div>
</div>
</body>
<script>

	new Vue({
		el: '#app',
		data() {
			return {
				list: [],
				wxy: [],
				initData: '',
				endtime: '',
				remarks: '',
				evaluate: '',
				memberid: '',
				apshow: false,
				fkshow: false,
				maintenanceman: '',
				department: '全部',
				order: '',
				startime: '2010-01-01'
			}
		},
		computed: {
			listorder () {
				if (this.memberid == '') {
					return this.list
				} else {
					let arr = []
					for (let i = 0; i < this.list.length; i++) {
						if (this.list[i].memberid == this.memberid) {
							arr = arr.concat(this.list[i])
						}
					}
					return arr
				}
			}
		},
		methods: {
			updatedepartment(data) {
				let that = this
				let str = '<option selected value="总公司">总公司</option>'
				var initData = JSON.parse('<?= json_encode($_SESSION['initData'])?>')
				for (let i = 0; i < initData.Department.info.length; i++) {
					if (initData.Department.info[i].type == '业务公司' || initData.Department.info[i].type == '业务门店') {
						if (data.department == initData.Department.info[i].name) {
							str += '<option selected value="' + initData.Department.info[i].name + '">' + initData.Department.info[i].name + '</option>'
						} else {
							str += '<option value="' + initData.Department.info[i].name + '">' + initData.Department.info[i].name + '</option>'
						}
					}
				}
				swal({
					title: '修改备注，门店',
					html: '<input  id="swal-input1" value="' + data.appointmentremarks + '" class="swal2-input" placeholder="备注" required>' +
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
					text: '填写配送员和数量',
					showCancelButton: true,
					confirmButtonText: '确认',
					cancelButtonText: '取消',
					confirmButtonClass: 'btn btn-success mr-3',
					cancelButtonClass: 'btn btn-danger',
					showLoaderOnConfirm: true,
					allowOutsideClick: false
				}).then(function (remarks) {
					if (remarks.value) {
						axios.post('/index.php/api/UpdateUserDepartmentRepair', {
							id: data.id,
							serial: data.serial,
							remarks: remarks.value[0],
							ndepartment: remarks.value[1]
						}).then(rew => {
							if (rew.data.code == 200) {
								swal('修改成功')
							} else {
								swal('修改失败')
							}
							that.submit()
						})
					}
				})
			},
			close() {
				this.apshow = false
				this.fkshow = false
				this.maintenanceman = ''
				this.remarks = ''
				this.evaluate = ''
				this.order = ''
			},
			HandleUserDepartmentRepair() {
				if (this.maintenanceman == '') {
					swal('请选择维修人员')
					return false
				}
				axios.post('/index.php/api/HandleUserDepartmentRepair', {
					order: this.order,
					maintenanceman: this.maintenanceman
				}).then(rew => {
					if (rew.data.code == 200) {
						swal('安排成功')
						this.close()
						this.submit()
					} else {
						swal('安排失败' + JSON.stringify(rew.data.msg))
					}
				})
			},
			FeedbackUserDepartmentRepair() {
				axios.post('/index.php/api/FeedbackUserDepartmentRepair', {
					order: this.order,
					remarks: this.remarks,
					evaluate: this.evaluate,
				}).then(rew => {
					if (rew.data.code == 200) {
						swal('反馈成功')
						this.close()
						this.submit()
					} else {
						swal('安排失败' + JSON.stringify(rew.data.msg))
					}
				})
			},
			ap(data) {
				if (data.state != '正常') {
					swal('该订单无法安排')
					return false
				}
				this.order = data
				this.apshow = true
			},
			fk(data) {
				if (data.state != '已安排') {
					swal('该订单无法反馈')
					return false
				}
				this.order = data
				this.fkshow = true
			},
			cancle(data) {
				if (data.state != '正常') {
					swal('该状态无法取消')
					return false
				}
				let that = this
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
				axios.post('/index.php/api/getDepartmentRepairList', {
					startime: this.startime,
					endtime: this.endtime,
					department: this.department,
				}).then(rew => {
					this.list = rew.data.data
				})
			}
		},
		created() {
			this.endtime = this.getQueryVariable('endtime')
			this.startime = this.getQueryVariable('endtime')
			axios.post('/index.php/api/getInitData').then(rew => {
				this.initData = rew.data.data
				this.wxy = rew.data.AreaDeliverymanList
			})
		}
	})
</script>
</html>
