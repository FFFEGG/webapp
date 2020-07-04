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
	<title>用户运费列表</title>
</head>
<body>
<div id="app" class="p-6">
	<div class="flex">
		<select name="" id="" class="p-2 border rounded" v-model="department">
			<option value="全部">全部</option>
			<?php foreach ($_SESSION['initData']->Department->info as $v) { ?>
					<option value="<?= $v->name ?>"><?= $v->name ?></option>

			<?php } ?>
		</select>
		<button @click="submit" class="p-2 px-5 mx-5 bg-teal-500 text-white rounded">搜索</button>
	</div>

	<table class="table-auto mt-6 w-full text-xs">
		<thead>
		<tr>
			<th class=" border-2">USERID</th>
			<th class=" border-2">会员号</th>
			<th class=" border-2">客户名称</th>
			<th class=" border-2">代销运费模式</th>
			<th class=" border-2">15/12KG单瓶运费</th>
			<th class=" border-2">4KG单瓶运费</th>
			<th class=" border-2">45KG单瓶运费</th>
			<th class=" border-2">部门</th>
			<th class=" border-2">操作员</th>
			<th class=" border-2">更新时间</th>
			<th class=" border-2">操作</th>
		</tr>
		</thead>
		<tbody>

		<tr class="text-center" v-for="v in list">
			<td class="border-2 ">{{ v.userid}}</td>
			<td class="border-2 ">{{ v.memberid}}</td>
			<td class="border-2 ">{{ v.name}}</td>
			<td class="border-2 ">{{ v.mode}}</td>
			<td class="border-2 ">{{ v.h12price}}</td>
			<td class="border-2 ">{{ v.h4price}}</td>
			<td class="border-2 ">{{ v.h45price}}</td>
			<td class="border-2 ">{{ v.department}}</td>
			<td class="border-2 ">{{ v.operator}}</td>
			<td class="border-2 ">{{ v.updatetime}}</td>
			<td class="border-2 "><button @click="save(v)" class="bg-teal-500 text-white p-1">编辑</button></td>
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
				department: '全部',
				list: []
			}
		},
		methods: {
			save (v) {
				Win10_child.openUrl('/index.php/user/UserFreight?userid='+ v.userid +'&cardid='+ v.memberid,'用户运费')
			},
			submit() {

				axios.post('/index.php/api/UserFreightList', {
					department: this.department,
				}).then(rew => {
					this.list = rew.data.list
				})
			}
		},
		created() {

		}
	})
</script>
</html>
