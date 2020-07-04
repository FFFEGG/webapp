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
	<!-- or point to a specific vue-select release -->
	<script src="<?php echo base_url(); ?>res/js/vue-select.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>res/css/vue-select.css">
	<title>商用气公司用户汇总任务记录(表3)</title>
</head>
<body>
<div id="app" class="p-6">
	<div class="flex">
		<v-select class="w-full border-2 p-2 mb-3" placeholder="选择业务员" multiple :options="zs" label="text" @input="afn"></v-select>
	</div>
	<div class="flex">
		<p class="p-2 border-2 border-r-0 rounded-l">会员号</p>
		<input type="text" class="p-2 border-2 rounded-r mr-3" v-model="memberid" placeholder="可选">

		<p class="p-2 border-2 border-r-0 rounded-l">单位</p>
		<input type="text" class="p-2 border-2 rounded-r mr-3" v-model="workplace" placeholder="可选">

		<p class="p-2 border-2 border-r-0 rounded-l">归属部门</p>

		<select name="" id="" class="p-2 border-2 rounded-r" v-model="attributiondepartment">
			<option value="全部">全部</option>
			<option value="商用气公司">商用气公司</option>
			<option value="商用气开发一部">商用气开发一部</option>
			<option value="商用气开发二部">商用气开发二部</option>
			<option value="商用气维护部">商用气维护部</option>
		</select>
		<button @click="submit" class="p-1 px-5 mx-5 bg-teal-500 text-white rounded">搜索</button>
	</div>

	<table class="table-auto mt-6 w-full text-xs">
		<thead>
		<tr>
			<th class=" border-2">会员号</th>
			<th class=" border-2">姓名</th>
			<th class=" border-2">单位</th>
			<th class=" border-2">地址</th>
			<th class=" border-2">星级</th>
			<th class=" border-2">归属部门</th>
			<th class=" border-2">业务员</th>
			<th class=" border-2">45KG优惠</th>
			<th class=" border-2">12KG优惠</th>
			<th class=" border-2">4KG优惠</th>
			<th class=" border-2">上月45KG优惠</th>
			<th class=" border-2">上月12KG优惠</th>
			<th class=" border-2">上月4KG优惠</th>



		</tr>
		</thead>
		<tbody>

		<tr class="text-center" v-for="v in list">
			<td class="border-2 ">{{ v.memberid}}</td>
			<td class="border-2 ">{{ v.name}}</td>
			<td class="border-2 ">{{ v.workplace}}</td>
			<td class="border-2 ">{{ v.address}}</td>
			<td class="border-2 ">{{ v.viplevel}}</td>
			<td class="border-2 ">{{ v.attributiondepartment}}</td>
			<td class="border-2 ">{{ v.salesman}}</td>
			<td class="border-2 ">{{ v.KG45D}}</td>
			<td class="border-2 ">{{ v.KG12D}}</td>
			<td class="border-2 ">{{ v.KG4D}}</td>
			<td class="border-2 ">{{ v.KG45}}</td>
			<td class="border-2 ">{{ v.KG12}}</td>
			<td class="border-2 ">{{ v.KG4}}</td>
		</tr>

		</tbody>
	</table>
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
				salesman: [],
				attributiondepartment: '全部',
				list: [],
				department: '',
				memberid: '',
				workplace: '',
				initData: '',
				begintime: '<?= date('Y-m-d')?>',
				endtime: '<?= date('Y-m-d')?>',
			}
		},
		methods: {
			submit() {
				axios.post('/index.php/api/CommerciaUserDiscountSummary', {
					salesman: this.ids.length == 0?'全部':this.ids,
					attributiondepartment: this.attributiondepartment,
					memberid: this.memberid,
					workplace: this.workplace,
				}).then(rew => {
					this.list = rew.data.list
				})
			},
			afn: function(values){
				this.ids =values.map(function(obj){
					return obj
				})
			}
		},
		created() {
			axios.post('/index.php/api/getInitData').then(rew=>{
				this.initData = rew.data.data
				let Operator = this.initData.Operator.info
				for (let i = 0; i < Operator.length; i++) {
					if (Operator[i].quartersid == 3) {
						if (Operator[i].departmentid == 13 ||Operator[i].departmentid == 14 || Operator[i].departmentid == 15 || Operator[i].departmentid == 16) {
							this.zs = this.zs.concat(Operator[i].name)
						}
					}
				}
			})
		}
	})
</script>
</html>
