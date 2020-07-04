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
	<title>商用气公司管理用户</title>
</head>
<body>
<div id="app" class="p-6">
	<div class="flex">
		<p class="p-2">开始时间</p>
		<input type="date" class="p-2 border" v-model="begintime">
		<p class="p-2">结束时间</p>
		<input type="date" class="p-2 border" v-model="endtime">
		<input type="text" v-model="memberid" class="p-2 border ml-2" placeholder="会员号选填">
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

			<th class=" border">会员号</th>
			<th class=" border">姓名</th>
			<th class=" border">业务员</th>
			<th class=" border">电话</th>
			<th class=" border">地址</th>
			<th class=" border">备注</th>
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
				{{ v.address }}
			</td>
			<td class="border ">
				{{ v.appointmentremarks }}
			</td>
			<td class="border ">
				{{ v.state }}
			</td>

			<td class="border " v-if="v.state=='已完成'">

				<button @click="cancel(v)" class="p-2 bg-teal-500 text-white">取消</button>
				<button @click="seeimg(v)" class="p-2 bg-teal-500 text-white">反馈</button>
			</td>
			<td class="border " v-else>
				<button @click="cancel(v)" class="p-2 bg-teal-500 text-white">取消</button>
			</td>

		</tr>


		</tbody>
	</table>
	<div @click="closefeed" v-if="imglist.length" style="position: fixed;top: 0;width: 100%;height:100%;z-index: 3;background: rgba(0,0,0,0.5)">


	</div>
	<div v-if="imglist.length" class="p-6 z-50 bg-white rounded shadow " style="height:600px;margin-top:-300px;top:50%;margin-left:-400px;left: 50%;position: fixed;width: 800px">

		<div class="grid grid-cols-4">

			<img v-for="v in imglist"  class="w-40 cursor-pointer" :src="v.fileurl" alt="" @click="seeimgdata(v.fileurl)">


		</div>
		<button class="p-4 py-2 bg-teal-500 text-white mt-3" @click="feedback(data)">反馈</button>
	</div>
</div>
</body>
<script>
	new Vue({
		el: '#app',
		data() {
			return {
				initData: '',
				memberid: '',
				begintime: '',
				endtime: '',
				salesman: '全部',
				data: '',
				attributiondepartment: '全部',
				list: [],
				imglist : []
			}
		},
		methods: {
			closefeed () {
				this.data = ''
				this.imglist = []
			},
			seeimgdata (data) {
				Win10_child.openUrl(data,'图片浏览')
			},
			seeimg (data) {
				this.data = data
				axios.post('/index.php/api/FileUrlList', {
					userid: data.userid,
					serial: data.serial
				}).then(rew => {
					this.imglist = rew.data.list
				})
			},
			feedback() {
				let that = this
				swal({
					title: '反馈任务',
					input: 'text',
					text: '填写备注',
					showCancelButton: true,
					confirmButtonText: '确认',
					cancelButtonText: '取消',
					confirmButtonClass: 'btn btn-success mr-3',
					cancelButtonClass: 'btn btn-danger',
					showLoaderOnConfirm: true,
					allowOutsideClick: false
				}).then(function (remarks) {
					if (remarks.value) {
						axios.post('/index.php/api/FeedbackCommerciaSalesmanTaskRecord', {
							id: that.data.id,
							serial: that.data.serial,
							remarks: remarks.value,
						}).then(rew => {
							if (rew.data.code == 200) {
								swal('反馈成功')
							} else {
								swal('反馈成功')
							}
							that.data = ''
							that.imglist = []
							that.submit()
						})
					}
				})
			},
			cancel(data) {
				let that = this
				swal({
					title: '取消任务',
					input: 'text',
					text: '填写备注',
					showCancelButton: true,
					confirmButtonText: '确认',
					cancelButtonText: '取消',
					confirmButtonClass: 'btn btn-success mr-3',
					cancelButtonClass: 'btn btn-danger',
					showLoaderOnConfirm: true,
					allowOutsideClick: false
				}).then(function (remarks) {
					if (remarks.value) {
						axios.post('/index.php/api/CancelCommerciaSalesmanTaskRecord', {
							id: data.id,
							serial: data.serial,
							remarks: remarks.value,
						}).then(rew => {
							if (rew.data.code == 200) {
								swal('取消成功')
							} else {
								swal('取消成功')
							}
							that.submit()
						})
					}
				})
			},
			submit() {
				axios.post('/index.php/api/CommerciaUserTaskRecord', {
					memberid: this.memberid,
					salesman: this.salesman,
					attributiondepartment: this.attributiondepartment,
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
			axios.post('/index.php/api/getInitData').then(rew => {
				this.initData = rew.data.data
			})
		}
	})
</script>
</html>
