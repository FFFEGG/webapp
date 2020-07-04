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
	<title>运输公司物资流转录入</title>
</head>
<body>
<div id="app" class="p-6">
	<div class="flex">
		<div class="w-1/2 mr-10">
			<div class="text-2xl mb-3">运输公司物资流转录入</div>
			<div class="lg:flex">
				<div class="flex">
					<p class="p-2 border-2 border-r-0 rounded-l">方式</p>
					<select class="p-2 border-2 rounded-r" name="" id="" v-model="mode">
						<option value="新购调入">新购调入</option>
						<option value="调出容检">调出容检</option>
					</select>
				</div>

				<div class="flex">
					<p class="p-2 border-2 border-r-0 rounded-l lg:ml-3">包装物类型</p>
					<select class="p-2 border-2 rounded-r" name="" id="" v-model="packingtype">
						<option value="">选择包装物类型</option>
						<option v-for="v in initData.Packingtype.info" :value="v.name">{{v.name}}</option>
					</select>

				</div>

				<input type="num" class="p-2 border-2 rounded lg:ml-3" v-model="num" placeholder="数量">
			</div>
			<input class="p-2 border-2 rounded mt-3 w-full" type="text" v-model="remarks" placeholder="备注">
			<button @click="TransportationMaterial" class="p-2 rounded mt-6 px-8 bg-teal-500 text-white">录入</button>
		</div>
		<div class="w-1/2 ">
			<div class="text-2xl mb-3">容检物资流转录入（运输公司代录）</div>
			<div class="lg:flex">
				<div class="flex">
					<p class="p-2 border-2 border-r-0 rounded-l">方式</p>
					<select class="p-2 border-2 rounded-r" name="" id="" v-model="dmode">
						<option value="调出运输公司">调出运输公司</option>
						<option value="报废处理">报废处理</option>
						<option value="北通公司调入">北通公司调入</option>
						<option value="其它调入">其它调入</option>
					</select>
				</div>

				<div class="flex">
					<p class="p-2 border-2 border-r-0 rounded-l lg:ml-3">包装物类型</p>
					<select class="p-2 border-2 rounded-r" name="" id="" v-model="dpackingtype">
						<option value="">选择包装物类型</option>
						<option v-for="v in initData.Packingtype.info" :value="v.name">{{v.name}}</option>
					</select>

				</div>

				<input type="num" class="p-2 border-2 rounded lg:ml-3" v-model="dnum" placeholder="数量">
			</div>
			<input class="p-2 border-2 rounded mt-3 w-full" type="text" v-model="dremarks" placeholder="备注">
			<button  @click="InspectionStationMaterial"  class="p-2 rounded mt-6 px-8 bg-teal-500 text-white">录入</button>

		</div>
	</div>

</div>
</body>
<script>
	new Vue({
		el: '#app',
		data() {
			return {
				initData: '',
				mode: '新购调入',
				dmode: '调出运输公司',
				packingtype: '',
				dpackingtype: '',
				num: '',
				dnum: '',
				remarks: '',
				dremarks: '',
			}
		},
		methods: {
			TransportationMaterial() {
				if (this.packingtype == '') {
					swal('请选择包装物')
					return false
				}
				axios.post('/index.php/api/TransportationMaterial', {
					mode: this.mode,
					packingtype: this.packingtype,
					num: this.num,
					remarks: this.remarks,
				}).then(rew => {
					if (rew.data.code == 200) {
						swal('录入成功')

						this.packingtype = ''
						this.num = ''
						this.remarks = ''
					} else {
						swal('录入失败')
					}
				})
			},
			InspectionStationMaterial() {
				if (this.dpackingtype == '') {
					swal('请选择包装物')
					return false
				}
				axios.post('/index.php/api/InspectionStationMaterial', {
					mode: this.dmode,
					packingtype: this.dpackingtype,
					num: this.dnum,
					remarks: this.dremarks,
				}).then(rew => {
					if (rew.data.code == 200) {
						swal('录入成功')

						this.dpackingtype = ''
						this.dnum = ''
						this.dremarks = ''
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
