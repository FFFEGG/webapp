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
	<title>赠送桶装水</title>
</head>
<body>
<div id="app" class="p-6 flex">
	<div class=" w-1/2">
		<div class="flex">
			<p class="p-2 border-2 border-r-0 rounded-l">会员号</p>
			<input class="p-2 border-2 rounded-r" @keyup="submit" type="text" v-model="memberid">
		</div>

		<div class="flex mt-3">
			<p class="p-2 border-2 border-r-0 rounded-l">商品</p>
			<select class="p-2 border-2 rounded-r" name="" id="" v-model="goodsid">
				<option value="">请选择商品</option>
				<option v-if="v.stocktype == '桶装水'" v-for="v in initData.Goods.info" :value="v.id">{{v.name}}</option>
			</select>

		</div>
		<div class="flex mt-3">
			<p class="p-2 border-2 border-r-0 rounded-l">数量</p>
			<input v-if="caninput" class="p-2 border-2 rounded-r" type="text" v-model="num" placeholder="请输入数量">
			<input v-else disabled class="p-2 border-2 rounded-r" type="text" v-model="num" placeholder="未查到用户无法输入">
		</div>
		<div class="flex mt-3">
			<p class="p-2 border-2 border-r-0 rounded-l">备注</p>
			<input v-if="caninput" class="p-2 border-2 rounded-r" type="text" v-model="remarks" placeholder="请输入备注">
			<input v-else disabled class="p-2 border-2 rounded-r" type="text" v-model="remarks" placeholder="未查到用户无法输入">
		</div>

		<button @click="confirm" class="bg-teal-500 text-white p-3 px-5 rounded mt-3">
			确认办理
		</button>
	</div>
	<div class=" w-1/2">
		<p>姓名：{{ user.name }}</p>
		<p>电话：{{ user.telephone }}</p>
	</div>


</div>
</body>
<script>
	new Vue({
		el: '#app',
		data() {
			return {
				memberid: '',
				goodsid: '',
				num: '',
				user: '',
				remarks: '',
				caninput: false,
				initData: ''
			}
		},
		methods: {
			submit() {
				axios.post('/index.php/api/getuserbyid', {
					cardid: this.memberid
				}).then(rew => {
					if (rew.data.user.id != 0) {
						this.user = rew.data.user
						this.caninput = true
					} else {
						this.user = ''
						this.caninput = false
					}
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
			},
			confirm() {
				if (this.memberid == '') {
					swal('请输入会员号')
					return false
				}
				if (this.goodsid == '') {
					swal('请选择商品')
					return false
				}
				if (this.num == '') {
					swal('请填写数量')
					return false
				}
				axios.post('/index.php/api/GiveUserWarehouseGoods', {
					userid: this.user.id,
					memberid: this.memberid,
					goodsid: this.goodsid,
					num: this.num,
					remarks: this.remarks,
				}).then(rew => {
					if (rew.data.code == 200) {
						swal('办理成功')
						this.user = ''
						this.memberid = ''
						this.num = ''
						this.caninput = false
						this.goodsid = ''
						this.remarks = ''
					} else {
						swal('办理失败')
					}

				})
			}
		},
		created() {
			this.begintime = this.getQueryVariable('endtime')
			this.endtime = this.getQueryVariable('endtime')
			axios.post('/index.php/api/getInitData').then(rew => {
				this.initData = rew.data.data
			})
		},
		 
	})
</script>
</html>
