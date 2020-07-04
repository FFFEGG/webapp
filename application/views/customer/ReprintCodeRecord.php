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
	<title>获取门店录入条码补打记录</title>
</head>
<body>
<div id="app" class="p-6">
	<div class="flex">
		<p class="p-2 border-2 border-r-0 rounded-l">开始时间</p>
		<input class="p-2 border-2 rounded-r" type="date" v-model="begintime">
		<p class="p-2 border-2 border-r-0 rounded-l ml-3">结束时间</p>
		<input class="p-2 border-2 rounded-r" type="date" v-model="endtime">
		<button @click="submit" class="p-1 px-5 mx-5 bg-teal-500 text-white rounded">搜索</button>
		<button @click="ReprintCodeEntry" class="p-1 px-5  bg-teal-500 text-white rounded">补打条码录入</button>
	</div>

	<table class="table-auto mt-6 w-full text-xs">
		<thead>
		<tr>
<!--			<th class=" border-2">订单号</th>-->
			<th class=" border-2">录入时间</th>
			<th class=" border-2">钢瓶类型</th>
			<th class=" border-2">登记号</th>
			<th class=" border-2">条形码内容</th>
			<th class=" border-2">出厂日期</th>
			<th class=" border-2">检测日期</th>
			<th class=" border-2">下检日期</th>
			<th class=" border-2">录入部门</th>
			<th class=" border-2">录入人</th>
			<th class=" border-2">打印次数</th>
			<th class=" border-2">重量</th>
			<th class=" border-2">操作</th>
		</tr>
		</thead>
		<tbody>
			<tr class="text-center" v-for="v in list">
<!--				<td class="border-2 ">{{ v.serial}}</td>-->
				<td class="border-2 ">{{ v.addtime.substr(0,10)}}</td>
				<td class="border-2 ">{{ v.bottletype}}</td>
				<td class="border-2 ">{{ v.regnumber}}</td>
				<td class="border-2 ">{{ v.code}}</td>
				<td class="border-2 ">{{ v.date4manufacture}}</td>
				<td class="border-2 ">{{ v.date4testing}}</td>
				<td class="border-2 ">{{ v.date4nexttesting}}</td>
				<td class="border-2 ">{{ v.department}}</td>
				<td class="border-2 ">{{ v.operator}}</td>
				<td class="border-2 ">{{ v.printnum}}</td>
				<td class="border-2 ">{{ v.weight}}</td>
				<td class="border-2 ">
					<button @click="cancle(v)" class="p-2 bg-teal-500 text-white">取消</button>
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
				list: []
			}
		},
		methods: {
			submit() {
				axios.post('/index.php/api/ReprintCodeRecord', {
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
			ReprintCodeEntry() {
				//Win10_child.openUrl('/index.php/ywpage/ReprintCodeEntry','门店需补打条码录入')
				let that = this
				swal({
					title: '门店录入条码补打信息',
					input: 'text',
					text: '填写钢瓶号',
					maxlength: 6,
					showCancelButton: true,
					confirmButtonText: '确认',
					cancelButtonText: '取消',
					confirmButtonClass: 'btn btn-success mr-3',
					cancelButtonClass: 'btn btn-danger',
					showLoaderOnConfirm: true,
					allowOutsideClick: false
				}).then(function (remarks) {
					if (remarks.value) {

						axios.post('/index.php/api/ReprintCodeEntry', {
							code: remarks.value,
						}).then(rew => {
							if (rew.data.code == 200) {
								swal('录入成功')
							} else {
								swal('录入失败')
							}
							that.submit()
						})
					}
				})
			},
			cancle(data) {
				let that = this
				swal({
					title: '取消操作',
					text: '确认取消',
					showCancelButton: true,
					confirmButtonText: '确认',
					cancelButtonText: '取消',
					confirmButtonClass: 'btn btn-success mr-3',
					cancelButtonClass: 'btn btn-danger',
					showLoaderOnConfirm: true,
					allowOutsideClick: false
				}).then(function (remarks) {
					if (remarks.value) {
						axios.post('/index.php/api/CancelReprintCodeEntry',{
							id: data.id,
							serial: data.serial
						}).then(rew=>{
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
			this.begintime = this.getQueryVariable('endtime')
			this.endtime = this.getQueryVariable('endtime')
		}
	})
</script>
</html>
