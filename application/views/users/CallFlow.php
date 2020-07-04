<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>新增来电记录</title>
	<script src="<?php echo base_url(); ?>res/js/win10.child.js"></script>
	<script src="<?php echo base_url(); ?>res/js/vue.js" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>res/js/axios.js" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>res/bootstrap/js/bootstrap.js" charset="utf-8"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>res/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>res/css/table_index.css">
	<script src="<?php echo base_url(); ?>res/js/sweetalert2.min.js"></script>
	<script src="<?php echo base_url(); ?>res/js/core.js"></script>
	<link href="<?php echo base_url(); ?>res/css/sweetalert2.min.css" rel="stylesheet">
</head>
<body>
<div class="p-5" id="call" >
	<div v-if="initData.msg == 'SUCCESS' && allordershow">
		<div class="row pt-2">

			<label class="col-1 col-form-label text-right">姓名</label>
			<div class="col-2">
				<input type="text" class="form-control" v-model="user.name">
			</div>


			<label class="col-1  col-form-label text-right">电话</label>
			<div class="col-2 ">
				<input type="text" disabled class="form-control" v-model="user.telephone">
			</div>

			<label class="col-1  col-form-label text-right">用户类型</label>
			<div class="col-2 ">
				<input type="text" disabled class="form-control" v-model="user.customertype">
			</div>

		</div>
		<div class=" row pt-2">
			<label class="col-1  col-form-label text-right">处理部门</label>
			<div class="col-2 ">
				<select name="" id="" class="form-control" v-model="department">
					<template v-for="v in initData.Department.info">
						<option :value="v.name">{{ v.name}}</option>
					</template>
				</select>
			</div>

			<label class="col-1 col-form-label text-right">来电类型</label>
			<div class="col-2">
				<select name="" id="" class="form-control" @change="CallTypeChange" v-model="type">
					<option v-for="v in initData.CallType.info" :value="v.name">{{ v.name}}</option>
				</select>
			</div>


			<label class="col-1 col-form-label text-right">来电原因</label>
			<div class="col-2">
				<select name="" id="" class="form-control" v-model="reason">
					<template v-for="v in CallReason">
						<option :value="v.name">{{ v.name}}</option>
					</template>
				</select>
			</div>

		</div>
		<div class="row pt-2">
			<div class="col-1 text-right">
				备注
			</div>
			<div class="col-8 text-right">
				<input type="text" class="form-control" v-model="remarks">
			</div>
		</div>
		<div class="row  pt-2" v-if="list.length">
			<div class="col-1"></div>
			<div class="col-11">
				<table class="table table-bordered table-sm">
					<thead>
					<tr>
						<th scope="col">下单时间</th>
						<th scope="col">商品名称</th>
						<th scope="col">数量</th>
						<th scope="col">地址</th>
						<th scope="col">门店</th>
						<th scope="col">安排时间</th>
						<th scope="col">配送员</th>
					</tr>
					</thead>
					<tbody>
					<template v-for="(v,key) in list">
						<tr @click="chooseorder(v,key)" v-if="index === key" style="background: #a6a6a6;color: #F2F2F2">
							<th scope="row">{{ v.addtime }}</th>
							<td>{{ v.goodsname }}</td>
							<td>{{ v.num }}</td>
							<td>{{ v.mianaddress }}</td>
							<td>{{ v.department }}</td>
							<td>{{ v.mianappointmenttime }}</td>
							<td>{{ v.deliveryman }}</td>
						</tr>
						<tr @click="chooseorder(v,key)" v-else>
							<th scope="row">{{ v.addtime }}</th>
							<td>{{ v.goodsname }}</td>
							<td>{{ v.num }}</td>
							<td>{{ v.mianaddress }}</td>
							<td>{{ v.department }}</td>
							<td>{{ v.mianappointmenttime }}</td>
							<td>{{ v.deliveryman }}</td>
						</tr>
					</template>

					</tbody>
				</table>
			</div>
		</div>
		<div class="row pt-2">
			<div class="col-1"></div>
			<div class="col-3">
				<button @click="addcall" class="btn btn-primary">确认添加</button>
			</div>
		</div>

		<div class="p-5" v-if="user">
			来电记录
			<table class="table table-bordered table-sm">
				<thead>
				<tr>
					<th scope="col">时间</th>
					<th scope="col">归属部门</th>
					<th scope="col">会员号</th>
					<th scope="col">姓名</th>
					<th scope="col">电话</th>
					<th scope="col">业务员</th>
					<th scope="col">来电类型</th>
					<th scope="col">来电原因</th>
					<th scope="col">备注</th>
				</tr>
				</thead>
				<tbody>
				<tr v-for="v in calllist">
					<th scope="row">{{ v.addtime }}</th>
					<td>{{ v.attributiondepartment }}</td>
					<td>{{ v.memberid }}</td>
					<td>{{ v.name }}</td>
					<td>{{ v.telephone }}</td>
					<td>{{ v.salesman }}</td>
					<td>{{ v.type }}</td>
					<td>{{ v.reason }}</td>
					<td>{{ v.remarks }}</td>
				</tr>
				</tbody>
			</table>

		</div>
	</div>

	<div v-else>
		查找用户信息中...
	</div>
</div>

</body>
<script>
	new Vue({
		el: '#call',
		data: {
			cardid: '',
			initData: [],
			cookdepartment: '',
			department: '',
			type: '',
			datas: '',
			reason: '',
			remarks: '',
			allorder: [],
			calllist: [],
			allordershow: false,
			user: '',
			index: ''
		},
		computed: {
			list() {
				if (this.type == '催气') {
					return this.allorder
				} else {
					this.index = ''
					return []
				}
			},
			CallReason() {
				var arr = []
				if (this.initData) {

				var list = this.initData.CallReason.info

					for (let i = 0; i < list.length; i++) {
						if (list[i].calltypeid == this.datas.id) {
							arr = arr.concat(list[i])
						}
					}
				}

				return arr
			}
		},
		methods: {
			CallTypeChange(data) {
				var index = data.target.selectedIndex
				this.datas = this.initData.CallType.info[index]
				this.reason = this.CallReason[0] ? this.CallReason[0].name : ''
			},
			chooseorder(data, index) {
				this.index = index
				this.remarks = data.goodsname + '-' + data.mianaddress
				this.department = data.department
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
			getorderlist() {
				axios.post('/index.php/api/getorderlistbycardid', {
					cardid: this.cardid
				}).then(rew => {
					this.allorder = rew.data.data
					this.allordershow = true
				})
			},
			addcall() {
				if (this.remarks == '') {
					swal('请填写备注！')
					return false
				}
				axios.post('/index.php/api/addcallflow', {
					userid: this.user.id,
					memberid: this.user.memberid ? this.user.memberid : '',
					name: this.user.name ? this.user.name : '',
					telephone: this.user.telephone ? this.user.telephone : '',
					customertype: this.user.customertype ? this.user.customertype : '',
					attributiondepartment: this.user.attributiondepartment ? this.user.attributiondepartment : '',
					handledepartment: this.department,
					type: this.type,
					reason: this.reason,
					remarks: this.remarks,
				}).then(rew => {
					if (rew.data.code == '200') {
						swal('成功')
						this.remarks = ''
					} else {
						swal('失败')
					}
				})
			},
			CallRecord () {
				axios.post('/index.php/api/CallRecord',{
					telephone: this.user.telephone
				}).then(rew=>{
					this.calllist = rew.data.list
				})
			}
		},
		created() {
			this.cardid = this.getQueryVariable('cardid')
			axios.post('/index.php/api/getuserbyid', {
				cardid: this.cardid
			}).then(rew => {
				this.user = rew.data.user
				this.initData = rew.data.initData
				this.cookdepartment = rew.data.cookdepartment
				this.department = this.cookdepartment
				this.type = this.initData.CallType.info[0].name
				this.reason = this.initData.CallReason.info[0].name
				this.datas = this.initData.CallType.info[0]
				if (this.user.id == 0) {
					this.user.telephone = this.getQueryVariable('tel')
				}
				this.CallRecord()
			})
			this.getorderlist()

		}
	})
</script>
</html>
