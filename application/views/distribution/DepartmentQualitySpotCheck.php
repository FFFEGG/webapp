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
	<title>门店商品质量抽查</title>
</head>
<body>
<div id="app" class=" p-3">
	<div class="grid-cols-3 grid">
		<div class="flex mb-3">
			<p class="p-2 w-32 border  rounded-l border-r-0">钢瓶号</p>
			<input type="text" v-model="code" class="p-2 w-64 border  rounded-r" placeholder="请输入钢瓶号">
		</div>
		<div class="flex mb-3">
			<p class="p-2 w-32 border  rounded-l border-r-0">充装编号</p>
			<input type="text" v-model="fillno" class="p-2 w-64 border  rounded-r" placeholder="请输入充装编号">
		</div>
		<div class="flex mb-3">
			<p class="p-2 w-32 border  rounded-l border-r-0">重瓶重量</p>
			<input type="text" v-model="commodityweight" class="p-2 w-64 border  rounded-r" placeholder="请输入重瓶重量">
		</div>
		<div class="flex mb-3">
			<p class="p-2 w-32 border  rounded-l border-r-0">钢瓶自重</p>
			<input type="text" v-model="emptyweight" class="p-2 w-64 border  rounded-r" placeholder="请输入钢瓶自重">
		</div>

		<div class="flex mb-3">
			<p class="p-2 w-32 border  rounded-l border-r-0">包装物类型</p>
			<select v-model="packingtype" name="" id="" class="p-2 w-64 border  rounded-r ">
				<option value="">请选择包装物类型</option>
				<option v-for="v in initData.Packingtype.info" :value="v.name">{{ v.name }}</option>
			</select>
		</div>
	</div>

	<button @click="sunmit" class="p-3 text-white bg-teal-500 rounded">确认录入</button>

</div>
</body>
<script>

	new Vue({
		el: '#app',
		data() {
			return {
				initData: '',
				code: '',
				fillno: '',
				commodityweight: '',
				emptyweight: '',
				packingtype: '',
			}
		},
		methods: {
			sunmit() {
				if (!this.code || !this.fillno || !this.commodityweight || !this.emptyweight || !this.packingtype) {
					swal('请填写完整参数')
					return false
				}
				axios.post('/index.php/api/DepartmentQualitySpotCheck', {
					code: this.code,
					fillno: this.fillno,
					commodityweight: this.commodityweight,
					emptyweight: this.emptyweight,
					packingtype: this.packingtype,
				}).then(rew => {
					if (rew.data.code == 200) {
						swal('录入成功')
						this.code = ''
						this.fillno = ''
						this.commodityweight = ''
						this.emptyweight = ''
						this.packingtype = ''
					} else {
						swal('录入失败')
					}
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
