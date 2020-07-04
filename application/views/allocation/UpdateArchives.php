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
	<title>Document</title>
</head>
<body>
<div id="app" class="p-6">
	<div class="flex">
		<div>
			<p>登记钢印号</p>
			<input @keyup="find" v-model="regnumber" maxlength="6" type="text" class="border rounded p-2 mr-4"
				   placeholder="登记钢印号">
		</div>

		<div>
			<p>制造单位</p>
			<input v-model="manufacturingunit" type="text" class="border rounded p-2 mr-4" placeholder="制造单位">
		</div>
		<div>
			<p>设备品种（焊接气瓶）</p>
			<input v-model="equipmentvariety" type="text" class="border rounded p-2 mr-4" placeholder="设备品种（焊接气瓶）">
		</div>
		<div>
			<p>材料（钢材）</p>
			<input v-model="material" type="text" class="border rounded p-2 mr-4" placeholder="材料（钢材）">
		</div>
		<div>
			<p>钢瓶类型</p>
			<select name="" id="" class="border rounded p-2 mr-4" v-model="bottletype">
				<option value="">钢瓶类型</option>
				<option v-for="v in initData.Packingtype.info" :value="v.name">{{v.name}}</option>
			</select>
		</div>
		<div>
			<p>充装介质（液化石油气）</p>
			<input v-model="fillingmedium" type="text" class="border rounded p-2 mr-4" placeholder="充装介质（液化石油气）">
		</div>
	</div>
	<div class="flex mt-4">
		<div>
			<p>出厂编码</p>
			<input v-model="productionnumber" type="text" class="border rounded p-2 mr-4" placeholder="出厂编码">
		</div>

		<div>
			<p>设计壁厚（mm）</p>
			<input v-model="wallthickness" type="text" class="border rounded p-2 mr-4" placeholder="设计壁厚（mm）">
		</div>
		<div>
			<p>公称压力(Mpa)</p>
			<input v-model="nominalpressure" type="text" class="border rounded p-2 mr-4" placeholder="公称压力(Mpa)">
		</div>
		<div>
			<p>钢瓶自重(KG)</p>
			<input v-model="weight" type="text" class="border rounded p-2 mr-4" placeholder="钢瓶自重(KG)">
		</div>
		<div>
			<p>备注</p>
			<input v-model="remarks" type="text" class="border rounded p-2 mr-4 w-full" placeholder="备注">
		</div>
	</div>

	<div class="flex mt-4">
		<div>
			<p>出厂日期</p>
			<input v-model="date4manufacture" type="date" class="border rounded p-2 mr-4" placeholder="出厂日期">
		</div>
		<div>
			<p>检测日期</p>
			<input v-model="date4testing" type="date" class="border rounded p-2 mr-4" placeholder="检测日期">
		</div>
		<div>
			<p>下次检测日期</p>
			<input v-model="date4nexttesting" type="date" class="border rounded p-2 mr-4" placeholder="下次检测日期">
		</div>
		<div>
			<p>产权单位</p>
			<input v-model="propertyunit" type="text" class="border rounded p-2 mr-4" placeholder="产权单位">
		</div>
		<div>
			<p>气体性质</p>

			<select name="" id="" class="border rounded p-2 mr-4" v-model="gasnature">
				<option value="气相">气相</option>
				<option value="液相">液相</option>

			</select>
		</div>
	</div>
	<button @click="submit" class="bg-teal-500 text-white py-2 px-4 rounded mt-4">确认录入</button>
</div>
</body>
<script>
	new Vue({
		el: '#app',
		data() {
			return {
				initData: '',
				date4manufacture: '',
				date4testing: '',
				date4nexttesting: '',
				manufacturingunit: '',
				propertyunit: '',
				wallthickness: '2-3',
				regnumber: '',
				equipmentvariety: '焊接气瓶',
				nominalpressure: '2.1Mpa',
				material: '钢材',
				remarks: '',
				productionnumber: '',
				bottletype: '',
				fillingmedium: '液化石油气',
				weight: '',
				gasnature: '气相',
			}
		},
		watch : {
			date4manufacture (val) {
				this.date4testing = val
			},
			date4testing (val) {
				this.date4nexttesting = val.substr(0,3) + 4 + '-' + val.substr(5,10)
			}
		},
		computed: {
			volume () {
				if (this.bottletype == 'YSP35.5型钢瓶') {
					return '35.5L'
				}
				if (this.bottletype == 'YSP28.6型钢瓶') {
					return '28.6L'
				}
				if (this.bottletype == 'YSP118型钢瓶/') {
					return '118L'
				}
				if (this.bottletype == 'YSP12型钢瓶') {
					return '12L'
				}
			}
		},
		methods: {
			find() {
				if (this.regnumber.length != 6) {
					return false
				}
				axios.post('/index.php/api/GetArchives', {
					regnumber: this.regnumber
				}).then(rew => {
					if (rew.data.data[0].date4manufacture) {
						this.date4manufacture = rew.data.data[0].date4manufacture.substring(0, 10);
						this.date4testing = rew.data.data[0].date4testing.substring(0, 10);
						this.date4nexttesting = rew.data.data[0].date4nexttesting.substring(0, 10);
						this.manufacturingunit = rew.data.data[0].manufacturingunit;
						this.propertyunit = rew.data.data[0].propertyunit;
						this.wallthickness = rew.data.data[0].wallthickness;
						this.regnumber = rew.data.data[0].regnumber;
						this.equipmentvariety = rew.data.data[0].equipmentvariety;
						this.nominalpressure = rew.data.data[0].nominalpressure;
						this.material = rew.data.data[0].material;
						this.remarks = rew.data.data[0].remarks;
						this.volume = rew.data.data[0].volume;
						this.productionnumber = rew.data.data[0].productionnumber;
						this.bottletype = rew.data.data[0].bottletype;
						this.fillingmedium = rew.data.data[0].fillingmedium;
						this.weight = rew.data.data[0].weight
						this.gasnature = rew.data.data[0].gasnature
					}
				})
			},
			submit() {
				if (!this.date4manufacture || !this.manufacturingunit || !this.equipmentvariety || !this.material || !this.bottletype || !this.fillingmedium || !this.productionnumber || !this.volume || !this.wallthickness || !this.nominalpressure || !this.weight || !this.remarks || !this.date4testing || !this.propertyunit || !this.regnumber || !this.date4nexttesting) {
					swal('请填写完整参数');
					return false
				}
				if (confirm('确认录入？')) {
					axios.post('/index.php/api/UpdateArchives', {
						manufacturingunit: this.manufacturingunit,
						equipmentvariety: this.equipmentvariety,
						material: this.material,
						bottletype: this.bottletype,
						fillingmedium: this.fillingmedium,
						productionnumber: this.productionnumber,
						volume: this.volume,
						wallthickness: this.wallthickness,
						nominalpressure: this.nominalpressure,
						weight: this.weight,
						remarks: this.remarks,
						date4manufacture: this.date4manufacture,
						propertyunit: this.propertyunit,
						regnumber: this.regnumber,
						date4testing: this.date4testing,
						date4nexttesting: this.date4nexttesting,
						gasnature: this.gasnature,
					}).then(rew => {
						if (rew.data.code == 200) {
							swal('录入成功');
							this.manufacturingunit = '';
							this.equipmentvariety = '';
							this.material = '';
							this.bottletype = '';
							this.fillingmedium = '';
							this.productionnumber = '';
							this.volume = '';
							this.wallthickness = '';
							this.nominalpressure = '';
							this.weight = '';
							this.remarks = '';
							this.date4manufacture = '';
							this.propertyunit = '';
							this.regnumber = '';
							this.date4testing = '';
							this.date4nexttesting = ''
						} else {
							swal('录入失败')
						}
					})
				}

			}
		},
		mounted() {
			axios.post('/index.php/api/getInitData').then(rew => {
				this.initData = rew.data.data
			})
		}
	})
</script>
</html>
