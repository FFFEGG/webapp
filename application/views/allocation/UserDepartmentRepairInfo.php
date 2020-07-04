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
	<title>查询用户部门维修记录信息</title>
</head>
<body>
<div id="app" class="p-3">
	<div class="flex">
		<div class="p-2">开始时间</div>
		<input v-model="startime" class="border mx-3 p-2" type="date">
		<div class="p-2">结束时间</div>
		<input v-model="endtime" class="border mx-3 p-2" type="date">
		<input @keyup.enter="submit" v-model="memberid" class="border mx-3 p-2" type="text" placeholder="用户卡号">
		<button @click="submit" class="p-2 bg-teal-500 text-white px-4">查询</button>
	</div>

	<table class="table-auto mt-6 w-full text-xs">
		<thead>
		<tr>
			<th class=" border">下单时间</th>


			<th class=" border">录入人</th>
			<th class=" border">方式</th>

			<th class=" border">维修项目</th>
			<th class=" border">维修员</th>
			<th class=" border">上门时间</th>
			<th class=" border">地址</th>
			<th class=" border">备注</th>
			<th class=" border">业务部门</th>
			<th class=" border">操作员</th>
			<th class=" border">取消人</th>
			<th class=" border">取消时间</th>
			<th class=" border">取消备注</th>
			<th class=" border">状态</th>

		</tr>
		</thead>
		<tbody>
		<tr v-for="v in list">
			<td class="border ">{{v.addtime.substr(0,16)}}</td>
			<!--			<td class="border ">{{v.serial}}</td>-->

			<td class="border ">{{v.registrar}}</td>
			<td class="border ">{{v.mode}}</td>

			<td class="border ">{{v.object}}</td>
			<td class="border ">{{v.maintenanceman}}</td>
			<td class="border ">{{v.appointmenttime.substr(0,16)}}</td>
			<td class="border ">{{v.city}}{{v.area}}{{v.town}}{{v.street}}{{v.housenumber}}{{v.address}}</td>
			<td class="border ">{{v.remarks}}</td>
			<td class="border ">{{v.department}}</td>
			<td class="border ">{{v.operator}}</td>
			<td class="border ">{{v.revokeer}}</td>
			<td class="border ">{{v.revoketime?v.revoketime.substr(0,16):''}}</td>
			<td class="border ">{{v.revokeremarks}}</td>
			<td class="border ">{{v.state}}</td>

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
				startime: '',
				endtime: '',
				memberid: '<?= $this->input->get('memberid')?>',
				list: [],
			}
		},
		methods: {

			getQueryVariable(variable) {
				var query = window.location.search.substring(1);
				var vars = query.split("&");
				for (var i = 0; i < vars.length; i++) {
					var pair = vars[i].split("=");
					if (pair[0] == variable) {
						return pair[1];
					}
				}
				return '';
			},
			submit() {
				axios.post('/index.php/api/getUserDepartmentRepairInfo', {
					startime: this.startime,
					endtime: this.endtime,
					memberid: this.memberid
				}).then(rew => {
					if (rew.data.code == 200) {
						this.list = rew.data.data
					} else {
						this.list = []
					}
				})
			}
		},
		created() {
			this.endtime = this.getQueryVariable('endtime')
			this.startime = this.getQueryVariable('endtime')
		}
	})
</script>
</html>
