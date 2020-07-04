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
	<title>可申请配送员补贴记录</title>
</head>
<body>
<div id="app" class=" p-3">
	<div class="flex">
		<div class="p-2">开始时间</div>
		<input v-model="begintime" class="border mx-3 p-2" type="date">
		<div class="p-2">结束时间</div>
		<input v-model="endtime" class="border mx-3 p-2" type="date">
		<select name="" id="" v-model="type" class="border mx-3 p-2">
			<option value="">申请类型</option>
			<option value="售后换重补贴">售后换重补贴</option>
			<option value="普通放空补贴">普通放空补贴</option>
			<option value="安全放空补贴">安全放空补贴</option>
			<option value="应急补贴">应急补贴</option>
			<option value="超远费补贴">超远费补贴</option>
			<option value="装卸费补贴">装卸费补贴</option>
			<option value="安装胶管补贴">安装胶管补贴</option>
<!--			<option value="看瓶不合格补贴">看瓶不合格补贴</option>-->
<!--			<option value="上门收瓶补贴">上门收瓶补贴</option>-->
		</select>


		<button @click="submit" class="p-2 bg-teal-500 text-white px-4">查询</button>
	</div>

	<table class="table-auto mt-6 w-full text-xs">
		<thead>
		<tr>

			<th v-for="v in list.title" class=" border">{{ v }}</th>
			<th class=" border">操作</th>
		</tr>
		</thead>
		<tbody>

		<tr v-for="v in list.info">
			<td v-for="vi in list.key" class="border ">{{ v[vi] }}</td>
			<td class="border ">
				<button @click="ap(v)" class="p-2 bg-teal-500 text-white">申请补贴</button>
			</td>
		</tr>

		</tbody>
	</table>
	<div v-if="show" @click="show = false" class="fixed w-full h-full" style="background: rgba(0,0,0,0.5);top:0"></div>
	<div v-if="show" class="fixed bg-white z-10 rounded text-center"
		 style="width: 400px;left: 50%;margin-left: -200px;height: 250px;top:50%;margin-top: -125px">
		<div class="p-6">
			<input type="text" v-model="code" class="border rounded p-2 w-full" placeholder="钢瓶码">
			<br>
			<select class="border rounded p-2 w-full mt-2" v-model="Packingtype" name="" id="">
				<option value="">类型</option>
				<option v-for="v in initData.Packingtype.info" :value="v.name">{{v.name}}</option>
			</select>
			<input type="text" v-model="remarks" class="border rounded p-2 w-full mt-2" placeholder="备注">
			<button @click="qrsq" class="p-2 bg-teal-500 text-white rounded w-full mt-2">申请补贴</button>
		</div>

	</div>
</div>
</body>
<script>

	new Vue({
		el: '#app',
		data() {
			return {
				list: [],
				data: '',
				initData: '',
				remarks: '',
				Packingtype: '',
				code: '',
				type: '',
				show: false,
				endtime: '',
				AreaDeliverymanList: [],
				begintime: '2010-01-01'
			}
		},
		methods: {
			ap(data) {
				this.data = data
				if (this.type == '售后换重补贴') {
					this.show = true
					return false
				}

				if (this.type == '装卸费补贴') {
					let that = this
					var str = ''
					for (let i = 0; i < this.AreaDeliverymanList.length; i++) {
						str += '<option value="' + this.AreaDeliverymanList[i].name + '">' + this.AreaDeliverymanList[i].name + '</option>'
					}
					swal({
						title: '填写数量',
						html: '<input  id="swal-input1" class="swal2-input" placeholder="数量" required>' +
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
							that.data.num = remarks.value[0]
							that.data.deliveryman = remarks.value[1]
							axios.post('/index.php/api/ApplyeDeliverymanSubsidy', {
								info: that.data,
								type: that.type
							}).then(rew => {
								if (rew.data.code == 200) {
									swal('申请成功')
								} else {
									swal(rew.data.msg.data.info)
								}
								that.data.packingtype = ''
								that.data.code = ''
								that.data.num= ''
								that.data.deliveryman = ''
								that.data.remarks = ''
								that.show = false
								that.submit()
							})
						}
					})
					return  false
				}
				this.comfir_ap()

			},
			comfir_ap() {
				axios.post('/index.php/api/ApplyeDeliverymanSubsidy', {
					info: this.data,
					type: this.type
				}).then(rew => {
					if (rew.data.code == 200) {
						swal('申请成功')
					} else {
						swal(rew.data.msg.data.info)
					}
					this.data.packingtype = ''
					this.data.code = ''
					this.data.remarks = ''
					this.show = false
					this.submit()
				})
			},
			qrsq() {
				if (!this.Packingtype || !this.code || !this.remarks) {
					swal('请填写完整参数')
					return false
				}
				this.data.packingtype = this.Packingtype
				this.data.code = this.code
				this.data.remarks = this.remarks
				axios.post('/index.php/api/ApplyeDeliverymanSubsidy', {
					info: this.data,
					type: this.type
				}).then(rew => {
					if (rew.data.code == 200) {
						swal('申请成功')
					} else {
						swal(rew.data.msg.data.info)
					}
					this.data.packingtype = ''
					this.data.code = ''
					this.data.remarks = ''
					this.show = false
					this.submit()
				})
			},
			submit() {
				axios.post('/index.php/api/DepartmentCanApplyeDeliverymanSubsidyRecord', {
					begintime: this.begintime,
					type: this.type,
					endtime: this.endtime
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
			this.endtime = this.getQueryVariable('endtime')
			this.begintime = this.getQueryVariable('endtime')
			axios.post('/index.php/api/getInitData').then(rew => {
				this.initData = rew.data.data
				this.AreaDeliverymanList = rew.data.AreaDeliverymanList
			})
		}
	})
</script>
</html>
