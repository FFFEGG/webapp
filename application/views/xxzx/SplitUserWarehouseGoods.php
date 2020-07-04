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
	<title>拆分用户库存商品</title>
</head>
<body>
<div id="app" class="p-6">
	<div class="flex">
		<input class="p-2 border-2 rounded-r" @keyup.enter="submit" type="text" v-model="memberid" placeholder="会员号">
		<p class="p-2 border-2 border-r-0 rounded-l ml-3">开始时间</p>
		<input class="p-2 border-2 rounded-r" type="date" v-model="begintime">
		<p class="p-2 border-2 border-r-0 rounded-l ml-3">结束时间</p>
		<input class="p-2 border-2 rounded-r" type="date" v-model="endtime">
		<button @click="submit" class="p-1 px-5 mx-5 bg-teal-500 text-white rounded">搜索</button>
	</div>

	<table class="table-auto mt-6 w-full text-xs">
		<thead>
		<tr>
			<th class=" border-2">办理时间</th>

			<th class=" border-2">办理方式</th>
			<th class=" border-2">办理商品</th>
			<th class=" border-2">办理数量</th>
			<th class=" border-2">剩余数量</th>
			<th class=" border-2">状态</th>
			<th class=" border-2">备注</th>
			<th class=" border-2">操作</th>

		</tr>
		</thead>
		<tbody>

		<tr class="text-center" v-for="v in list">
			<td class="border-2 ">{{ v.addtime}}</td>
			<td class="border-2 ">{{ v.mode}}</td>
			<td class="border-2 ">{{ v.goodsname}}</td>
			<td class="border-2 ">{{ v.initial_num}}</td>
			<td class="border-2 ">{{ v.num}}</td>

			<td class="border-2 ">{{ v.state}}</td>
			<td class="border-2 ">{{ v.remarks}}</td>
			<td class="border-2 ">
				<button @click="splitshow(v)" class="p-2 bg-teal-500 text-white">拆分</button>
				<button @click="AdjustmentUserWarehouseGoods(v)" class="p-2 bg-teal-500 text-white ml-3">转卡</button>
			</td>
		</tr>

		</tbody>
	</table>

	<div v-if="show" class="fixed p-6 rounded shadow bg-white"
		 style="z-index:99999;top: 20%;width: 500px;left: 50%;margin-left: -250px;">
		<div class="flex justify-between">
			<p>{{ data.goodsname }} 剩余数量：{{ data.num }}</p>
			<div>
				<button @click="SplitUserWarehouseGoods" class="bg-teal-500 text-white rounded p-1 px-3">确认</button>
				<button @click="cancle" class="bg-teal-500 text-white rounded p-1 px-3 ml-3">取消</button>
			</div>

		</div>

		<div class="w-full mb-2 flex items-center" v-for="(v,k) in num">
			<input v-model="v.num" type="number" class="rounded p-2 border" placeholder="填写数量">
			<div @click="add" v-if="k==1" class="rounded-full h-6 w-6 bg-teal-500 text-white text-center ml-4">+</div>
			<div @click="del(k)" v-if="k>1" class="rounded-full h-6 w-6 bg-orange-500 text-white text-center ml-4">-
			</div>
		</div>
	</div>
</div>
</body>
<script>
	new Vue({
		el: '#app',
		data() {
			return {
				begintime: '',
				endtime: '',
				department: '',
				list: [],
				memberid: '',
				data: '',
				show: false,
				num: [
					{
						num: 0
					},
					{
						num: 0
					}
				],
			}
		},
		computed: {
			goodsjson() {
				let arr = []
				for (let i = 0; i < this.num.length; i++) {
					arr = arr.concat({
						goodsid: this.data ? this.data.goodsid : 0,
						num: this.num[i].num
					})
				}
				return arr
			}
		},
		methods: {
			AdjustmentUserWarehouseGoods(data) {
				let that = this
				swal({
					title: '调整用户仓库商品',
					input: 'text',
					text: '填写转入会员号',
					showCancelButton: true,
					confirmButtonText: '确认',
					cancelButtonText: '取消',
					confirmButtonClass: 'btn btn-success mr-3',
					cancelButtonClass: 'btn btn-danger',
					showLoaderOnConfirm: true,
					allowOutsideClick: false
				}).then(function (remarks) {
					if (remarks.value) {
						axios.post('/index.php/api/AdjustmentUserWarehouseGoods', {
							userid: data.userid,
							serial: data.serial,
							memberid: that.memberid,
							id: data.id,
							nmemberid: remarks.value,
						}).then(rew => {
							if (rew.data.code == 200) {
								swal('转出成功')
							} else {
								swal('转出失败')
							}
							that.submit()
						})
					}
				})
			},
			SplitUserWarehouseGoods() {
				var num = 0

				for (let i = 0; i < this.num.length; i++) {
					num += Number(this.num[i].num)
				}
				if (num != this.data.num) {
					swal('拆分数量不正确')
					return false
				}

				axios.post('/index.php/api/SplitUserWarehouseGoods', {
					id: this.data.id,
					serial: this.data.serial,
					userid: this.data.userid,
					num: this.data.num,
					goodsjson: this.goodsjson,
				}).then(rew => {
					if (rew.data.code == 200) {
						swal('拆分成功')
					} else {
						swal('拆分失败')
					}
					this.cancle()
					this.submit()
				})
			},
			cancle() {
				this.num = [
					{
						num: 0
					},
					{
						num: 0
					}
				]
				this.data = ''
				this.show = false
			},
			del(index) {
				this.num.splice(index, 1)
			},
			add() {
				this.num = this.num.concat({num: 0})
			},
			splitshow(v) {
				if (v.num < 2) {
					swal('数量必须大于2')
					return false
				}
				this.data = v
				this.show = true
			},
			submit() {
				axios.post('/index.php/api/UserGoodsWarehouse', {
					begintime: this.begintime,
					endtime: this.endtime,
					memberid: this.memberid,
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
