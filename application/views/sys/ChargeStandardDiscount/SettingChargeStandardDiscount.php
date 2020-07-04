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
	<script src="<?php echo base_url(); ?>res/js/vue-select.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>res/css/vue-select.css">
	<title></title>
</head>
<body>
<div id="app" class="p-6">
	<div class="flex">
		<p class="p-2 border-2 border-r-0 rounded-l w-40">开始时间</p>
		<input class="p-2 border-2 rounded-r w-1/2" type="date" v-model="starttime">
	</div>
	<div class="flex mt-3">
		<p class="p-2 border-2 border-r-0 rounded-l w-40">结束时间</p>
		<input class="p-2 border-2 rounded-r w-1/2" type="date" v-model="endtime">
	</div>
	<div class="flex mt-3">
		<p class="p-2 border-2 border-r-0 rounded-l w-40">方式名称</p>
		<input class="p-2 border-2 rounded-r w-1/2" type="text" v-model="name">
	</div>
	<div class="flex mt-3">
		<p class="p-2 border-2 border-r-0 rounded-l w-40">收款项目</p>
		<input class="p-2 border-2 rounded-r w-1/2" type="text" v-model="project" disabled>
	</div>
	<div class="flex mt-3">
		<p class="p-2 border-2 border-r-0 rounded-l w-40">单价</p>
		<input class="p-2 border-2 rounded-r w-1/2" type="text" v-model="price">
	</div>
	<div class="flex mt-3">
		<p class="p-2 border-2 border-r-0 rounded-l w-40">备注</p>
		<input class="p-2 border-2 rounded-r w-1/2" type="text" v-model="remarks">
	</div>
	<div class="flex mt-3">
		<p class="p-2 border-2 border-r-0 rounded-l w-40">计费周期（天）</p>
		<input class="p-2 border-2 rounded-r w-1/2" type="text" v-model="cycle">
	</div>
	<div class="flex mt-3">
		<p class="p-2 border-2 border-r-0 rounded-l w-40">可使用部门</p>
		<div class="p-2 border-2 w-1/2">
			<v-select class=" w-full" placeholder="选择部门" multiple :value="ids"  :options="zs" label="text" @input="afn"></v-select>
		</div>

	</div>
	<div class="flex mt-3">
		<p class="p-2 border-2 border-r-0 rounded-l w-40">状态</p>
		<select name="" id="" v-model="state" class="p-2 border-2 rounded-r w-1/2">
			<option value="正常">正常</option>
			<option value="取消">取消</option>
		</select>
	</div>
	<button @click="submit" class="bg-teal-500 text-white p-3 px-6 rounded mt-3">确认</button>
</div>
</body>
<script>
	Vue.component('v-select', VueSelect.VueSelect);
	new Vue({
		el: '#app',
		data() {
			return {
				zs: [],
				ids: [],
				id: '<?= $this->input->get('id')?>',
				cycle:'',
				price: '',
				remarks: '',
				project: '<?= $this->input->get('project')?>',
				action: '<?= $this->input->get('action')?>',
				starttime: '<?= date('Y-m-d')?>',
				endtime: '<?= date('Y-m-d')?>',
				name: '',
				department: '',
				state: '正常',
			}
		},
		methods: {
			afn: function(values){
				this.ids =values.map(function(obj){
					return obj
				})
			},
			submit() {
				axios.post('/index.php/api/SettingChargeStandardDiscount', {
					action: this.action,
					id: this.id,
					starttime: this.starttime,
					endtime: this.endtime,
					name: this.name,
					project: this.project,
					price: this.price,
					remarks: this.remarks,
					cycle: this.cycle,
					department: this.ids,
					state: this.state,
				}).then(rew => {
					if (rew.data.code == 200) {
						swal('添加成功')
						setTimeout(function () {
							Win10_child.close()
						}, 1000)
					} else {
						swal('添加失败')
					}
				})
			}
		},
		created() {

			axios.post('/index.php/api/getInitData').then(rew=>{
				let department = rew.data.data.Department.info
				for (let i = 0; i < department.length; i++) {
					if (department[i].type =='业务门店' ||department[i].type =='业务公司') {
						this.zs = this.zs.concat(department[i].name)
					}
				}
			})
			if (localStorage.getItem('SettingChargeStandardDiscount') && this.action == 'UPDATE') {
				let data = JSON.parse(localStorage.getItem('SettingChargeStandardDiscount'))
				this.starttime = data.starttime.substr(0,10)
				this.endtime = data.endtime.substr(0,10)
				this.name = data.name
				this.price = data.price
				this.remarks = data.remarks

				this.cycle = data.cycle
				this.state = data.state ==1?'正常':'取消'
 				this.ids= data.department
			}
		}
	})
</script>
</html>
