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
	<title>运输公司司机代销运费装卸费</title>
</head>
<body>
<div id="app" class="p-6">
	<div class="flex">
		<p class="p-2 border-2 border-r-0 rounded-l">开始时间</p>
		<input class="p-2 border-2 rounded-r" type="date" v-model="begintime">
		<p class="p-2 border-2 border-r-0 rounded-l ml-3">结束时间</p>
		<input class="p-2 border-2 rounded-r" type="date" v-model="endtime">
		<p class="p-2 border-2 border-r-0 rounded-l ml-3">部门</p>
		<select name="" id="" v-model="department" class="p-2 border-2 rounded-r">
			<option value="全部">全部</option>
			<option v-if="v.type == '业务公司' || v.type == '业务门店'" v-for="v in initData.Department.info">{{ v.name }}
			</option>
		</select>
		<button @click="submit" class="p-1 px-5 mx-5 bg-teal-500 text-white rounded">搜索</button>
	</div>

	<table class="table-auto mt-6 w-full text-xs">
		<thead>
		<tr>
			<th class=" border-2">司机</th>
			<th class=" border-2">15/12KG重数量</th>
			<th class=" border-2">4KG重数量</th>
			<th class=" border-2">45KG重数量</th>
			<th class=" border-2">15/12KG空数量</th>
			<th class=" border-2">4KG空数量</th>
			<th class=" border-2">45KG空数量</th>
			<th class=" border-2">运费小计</th>
			<th class=" border-2">装卸费小计</th>
		</tr>
		</thead>
		<tbody>

		<tr class="text-center" v-for="v in list">
			<td class="border-2 ">{{ v.deliveryman}}</td>
			<td class="border-2 ">{{ v.hkg12}}</td>
			<td class="border-2 ">{{ v.hkg4}}</td>
			<td class="border-2 ">{{ v.hkg45}}</td>
			<td class="border-2 ">{{ v.ekg12}}</td>
			<td class="border-2 ">{{ v.ekg4}}</td>
			<td class="border-2 ">{{ v.ekg45}}</td>
			<td class="border-2 ">{{ v.total}}</td>
			<td class="border-2 ">{{ v.lautotal}}</td>
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
				department: '运输公司',
				initData: '',
				list: []
			}
		},
		methods: {
			submit() {
				axios.post('/index.php/api/TransportationDriverCommissionConsignment', {
					begintime: this.begintime,
					endtime: this.endtime,
					department: this.department,
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
			}
		},
		created() {
			this.begintime = this.getQueryVariable('endtime')
			this.endtime = this.getQueryVariable('endtime')
			this.initData = <?= json_encode($_SESSION['initData'])?>
		}
	})
</script>
</html>
