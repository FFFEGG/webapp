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

	<title>设置收费标准(优惠)接口</title>
</head>
<body>
<div id="app" class="p-6">
	<div class="flex">

		<select name="" id="" v-model="state" class="border-2 p-2 rounded">
			<option value="正常">正常</option>
			<option value="取消">取消</option>
		</select>
		<button @click="submit" class="p-1 px-5 mx-5 bg-teal-500 text-white rounded">搜索</button>
		<button @click="add" class="p-1 px-5 mx-5 bg-teal-500 text-white rounded">新增</button>
	</div>

	<table class="table-auto mt-6 w-full text-xs">
		<thead>
		<tr>
			<th class=" border-2">开始时间</th>

			<th class=" border-2">结束时间</th>
			<th class=" border-2">方式名称</th>
			<th class=" border-2">收款项目</th>
			<th class=" border-2">单价</th>
			<th class=" border-2">备注</th>
			<th class=" border-2">可使用部门</th>
			<th class=" border-2">计费周期（天）</th>
			<th class=" border-2">状态</th>
			<th class=" border-2">操作</th>
		</tr>
		</thead>
		<tbody>

		<tr class="text-center" v-for="v in list">
			<td class="border-2 ">{{ v.starttime}}</td>
			<td class="border-2 ">{{ v.endtime}}</td>
			<td class="border-2 ">{{ v.name}}</td>
			<td class="border-2 ">{{ v.project}}</td>
			<td class="border-2 ">{{ v.price}}</td>
			<td class="border-2 ">{{ v.remarks}}</td>
			<td class="border-2 ">{{ v.department}}</td>
			<td class="border-2 ">{{ v.cycle}}</td>
			<td class="border-2 ">{{ v.state}}</td>
			<td class="border-2 ">
				<button @click="update(v)" class="p-1 bg-teal-500 text-white rounded">修改</button>
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
				state: '正常',
				project: '<?= $this->input->get('project')?>',
				list: []
			}
		},
		methods: {
			update (data) {
				localStorage.setItem('SettingChargeStandardDiscount',JSON.stringify(data))
				Win10_child.openUrl('/index.php/sys/SettingChargeStandardDiscount?action=UPDATE&project='+this.project+'&id='+data.id,'修改'+this.project+'收费标准')
			},
			add () {
			  	Win10_child.openUrl('/index.php/sys/SettingChargeStandardDiscount?action=ADD&project='+this.project+'&id=0','新增'+this.project+'收费标准')
			},
			submit() {
				axios.post('/index.php/api/ChargeStandardDiscount', {
					state: this.state,
					project: this.project
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
		}
	})
</script>
</html>
