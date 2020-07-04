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
	<title>部门缴款记录</title>
</head>
<body>
<div id="app" class=" p-3">
	<div class="flex mb-3 w-5/6 ">
		<p class="p-2 w-1/6">单据号码</p>
		<input type="text" class="border-2 p-2 w-3/6 " v-model="serial">
	</div>

	<div class="flex mb-3 w-5/6 ">
		<p class="p-2 w-1/6">收款时间</p>
		<input type="date" class="border-2 p-2 w-3/6" v-model="receivablestime">
	</div>

	<div class="flex mb-3 w-5/6 ">
		<p class="p-2 w-1/6">缴款时间</p>
		<input type="date" class="border-2 p-2 w-3/6" v-model="paymentyime">
	</div>

	<div class="flex mb-3 w-5/6 ">
		<p class="p-2 w-1/6">缴款项目</p>
		<select name="" id="" class="border-2 p-2 w-3/6" v-model="project">
			<option value="液化气款">液化气款</option>
			<option value="桶装水款">桶装水款</option>
			<option value="配件款">配件款</option>
		</select>
	</div>

	<div class="flex mb-3 w-5/6 ">
		<p class="p-2 w-1/6">缴款金额</p>
		<input type="number" class="border-2 p-2 w-3/6" v-model="total">
	</div>

	<div class="flex mb-3 w-5/6 ">
		<p class="p-2 w-1/6">缴款银行</p>
		<input type="text" class="border-2 p-2 w-3/6" v-model="bank">
	</div>
	<button @click="submit" class="px-3 py-3 bg-teal-500 text-white mt-10">确认录入</button>
</div>
</body>
<script>

	new Vue({
		el: '#app',
		data() {
			return {
				serial: '',
				receivablestime: '',
				paymentyime: '',
				project: '液化气款',
				total: '',
				bank: '',
			}
		},
		methods: {
			getQueryVariable(variable) {
				var query = window.location.search.substring(1);
				var vars = query.split('&');
				for (var i = 0; i < vars.length; i++) {
					var pair = vars[i].split('=');
					if (pair[0] == variable) {
						return pair[1]
					}
				}
				return ''
			},
			submit() {
				let that = this;
				swal({
					title: '确定录入？',
					text: '',
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: '确定',
					cancelButtonText: '取消',
					confirmButtonClass: 'btn btn-success',
					cancelButtonClass: 'btn btn-danger',
				}).then(function (dismiss) {
					if (dismiss.value) {
						axios.post('/index.php/api/AddDepartmentPayment', {
							serial: that.serial,
							receivablestime: that.receivablestime,
							paymentyime: that.paymentyime,
							project: that.project,
							total: that.total,
							bank: that.bank,
						}).then(rew => {
							if (rew.data.code == 200) {
								swal('录入成功')
							} else {
								swal('录入失败')
							}
						})
					}
				})
			}
		}
	})
</script>
</html>
