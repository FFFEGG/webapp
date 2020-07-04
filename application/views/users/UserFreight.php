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
	<title>用户运费</title>
</head>
<body>
<div id="app" class="p-6">
	<div class="flex">
		<select name="" id="" class="p-2 border rounded" v-model="mode">
			<option value="">选择代销运费模式</option>
			<?php foreach ($_SESSION['initData']->CarCost->info as $v) { ?>
				<?php if ($v->type == '代销运费模式') { ?>
					<option value="<?= $v->mode ?>"><?= $v->mode ?></option>
				<?php } ?>
			<?php } ?>
		</select>
		<input type="text" placeholder="15/12KG单瓶运费" class="p-2 border rounded ml-5" v-model="h12price">
		<input type="text" placeholder="4KG单瓶运费" class="p-2 border rounded ml-5" v-model="h4price">
		<input type="text" placeholder="45KG单瓶运费" class="p-2 border rounded ml-5" v-model="h45price">
		<button @click="submit" class="p-2 px-5 mx-5 bg-teal-500 text-white rounded">添加用户运费</button>
	</div>

	<table class="table-auto mt-6 w-full text-xs">
		<thead>
		<tr>
			<th class=" border-2">模式</th>
			<th class=" border-2">15/12KG单瓶运费</th>
			<th class=" border-2">4KG单瓶运费</th>
			<th class=" border-2">45KG单瓶运费</th>
			<th class=" border-2">部门</th>
			<th class=" border-2">操作员</th>
			<th class=" border-2">更新时间</th>
		</tr>
		</thead>
		<tbody>

		<tr class="text-center" v-for="v in list">
			<td class="border-2 ">{{ v.mode}}</td>
			<td class="border-2 ">{{ v.h12price}}</td>
			<td class="border-2 ">{{ v.h4price}}</td>
			<td class="border-2 ">{{ v.h45price}}</td>
			<td class="border-2 ">{{ v.department}}</td>
			<td class="border-2 ">{{ v.operator}}</td>
			<td class="border-2 ">{{ v.updatetime}}</td>
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
				mode: '',
				h12price: '',
				h4price: '',
				h45price: '',
				userid: '<?= $this->input->get('userid')?>',
				list: []
			}
		},
		methods: {
			submit() {
				if (this.mode == '') {
					swal('请代销运费模式')
					return false
				}

				if (this.h12price == '' || this.h45price == '' || this.h4price == '') {
					swal('请填写运费')
					return false
				}

				axios.post('/index.php/api/EditUserFreight', {
					mode: this.mode,
					h12price: this.h12price,
					h4price: this.h4price,
					h45price: this.h45price,
					userid: this.userid,
				}).then(rew => {
					if (rew.data.code == 200) {
						swal('成功')
						this.goodsid = ''
						this.price = ''
						this.getlist()
					} else {
						swal('失败')
					}
				})
			},
			getlist() {
				axios.post('/index.php/api/UserFreight', {
					userid: this.userid
				}).then(rew => {
					this.list = rew.data.list
				})
			}
		},
		created() {
			this.getlist()
		}
	})
</script>
</html>
