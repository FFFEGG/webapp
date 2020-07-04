<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="<?php echo base_url(); ?>res/js/win10.child.js"></script>
	<script src="<?php echo base_url(); ?>res/js/vue.js" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>res/js/axios.js" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>res/mydatepick/mydate.js" charset="utf-8"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>res/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>res/mydatepick/mydate.css">
	<script src="<?php echo base_url(); ?>res/js/sweetalert2.min.js"></script>
	<script src="<?php echo base_url(); ?>res/js/core.js"></script>
	<link href="<?php echo base_url(); ?>res/css/sweetalert2.min.css" rel="stylesheet">
</head>
<style>
	.form-control {
		font-size: 12px;
	}
</style>
<body>
<div class="row p-2" id="userinvoice">
	<div class="col-6">
		<h6>销售信息列表</h6>
		<div class="row">
			<div class="col-sm-3">
				<input type="date" class="form-control" v-model="starttime" placeholder="开始时间">
			</div>
			<div class="col-sm-3">
				<input type="date" class="form-control" v-model="endtime" placeholder="结束时间">
			</div>
			<div class="col-sm-3">
				<input type="text" @keyup.enter="search" class="form-control" v-model="cardid" placeholder="卡号">
			</div>
			<div class="col-sm-3">
				<button @click="search" class="btn-primary btn">搜索</button>
			</div>
		</div>
		<div class="row p-3" style="height: 500px;overflow: scroll;font-size: 12px">
			<table class="table table-bordered table-sm table-stateshow">
				<thead>
				<tr>
					<th scope="col">时间</th>
					<th scope="col">商品名称</th>
					<th scope="col">数量</th>
					<th scope="col">单价</th>
					<th scope="col">合计</th>
					<th scope="col">税率</th>
					<th scope="col">门店</th>
					<th scope="col">支付方式</th>
					<th scope="col">状态</th>
					<th scope="col">操作</th>

				</tr>
				</thead>
				<tbody>
				<template v-for="(v,index) in list">
					<tr v-if="v.stateshow == '正常'">
						<td>{{ v.addtime }}</td>
						<td>{{ v.goodsname }}</td>
						<td>{{ v.num }}</td>
						<td>{{ v.price }}</td>
						<td>{{ v.total }}</td>
						<td>{{ v.taxrate }}</td>
						<td>{{ v.department }}</td>
						<td>{{ v.payment }}</td>
						<td>{{ v.stateshow }}</td>
						<td>
							<button v-if="!v.ischeck && v.invoice != '1'" class="btn-sm btn-primary"
									@click="add(index)">添加
							</button>
							<button v-else class="btn-sm btn-disabled">已开票</button>
						</td>
					</tr>
				</template>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-6">

		<h6 class="mt-4">开票</h6>
		<div class="row pb-0 pl-3 pr-3 pt-4" style="max-height: 500px;overflow: hidden;font-size: 12px">
			<table class="table table-bordered table-sm table-stateshow">
				<thead>
				<tr>

					<th scope="col">商品名称</th>
					<th scope="col">数量</th>
					<th scope="col">单价</th>
					<th scope="col">金额</th>


					<th scope="col">操作</th>

				</tr>
				</thead>
				<tbody>
				<template v-for="(v,index) in order">
					<tr>
						<td>{{ v.goodsname }}</td>
						<td>{{ v.num }}</td>
						<td>{{ v.price }}</td>
						<td>{{ v.total }}</td>

						<td>
							<button class="btn-sm btn-danger" @click="del(v.index)">删除</button>
						</td>
					</tr>
				</template>
				</tbody>
			</table>
		</div>
		<div class="col-auto" style="padding: 0">
			<label class="sr-only" for="inlineFormInputGroup" style="font-size: 12px;padding: 0">备注</label>
			<div class="input-group mb-2">
				<div class="input-group-prepend">
					<div class="input-group-text"
						 style="font-size: 12px;padding: 0;padding-left: 5px;padding-right: 5px">备注
					</div>
				</div>
				<input type="text" class="form-control" id="inlineFormInputGroup" v-model="remarks">
			</div>
		</div>
		<div v-if="HJ" class="row">
			<div class="col-6">价税合计：{{ HJ }}</div>
			<button class="btn btn-primary btn-sm" @click="adduserinvoice">开票</button>
		</div>
	</div>
</div>
</body>
<script>
	new Vue({
		el: '#userinvoice',
		computed: {
			HJ() {
				let total = 0;
				for (i in this.order) {
					if (this.order[i].goodsname == '残液') {
						total -= Number(this.order[i].total)
					} else {
						total += Number(this.order[i].total)
					}

				}
				return total
			},
			order() {
				let list = JSON.parse(JSON.stringify(this.list));
				let arr = []
				for (i in list) {
					if (list[i].ischeck == true) {
						list[i].index = i
						arr = arr.concat(list[i])
					}
				}
				return arr
			},
			info () {
				let arr = []
				for (i in this.order) {
					if (this.order[i].goodsname !== '残液') {
						arr = arr.concat({
							id: this.order[i].id,
							serial_pay: this.order[i].serial_pay,
						})
					}
				}

				return arr
			},
			raffinateinfo () {
				let arr = []
				for (i in this.order) {
					if (this.order[i].goodsname == '残液') {
						arr = arr.concat({
							id: this.order[i].id,
							serial_pay: this.order[i].serial_pay,
						})
					}
				}

				return arr
			}
		},
		data: {
			starttime: '2010-01-01',
			endtime: '',
			cardid: '',
			remarks: '',
			list: []
		},
		methods: {
			del(index) {
				this.list[index].ischeck = false
			},
			add(index) {
				this.list[index].ischeck = true
			},
			search() {
				if (!this.cardid) {
					swal('请输入卡号')
					return false
				}
				axios.post('/index.php/api/getuserinvoicelist', {
					cardid: this.cardid,
					begintime: this.starttime,
					endtime: this.endtime
				}).then(rew => {
					this.list = rew.data.list
				})
			},
			adduserinvoice() {

				axios.post('/index.php/api/adduserinvoice', {
					carid: this.cardid,
					remarks: this.remarks,
					info: this.info,
					raffinateinfo: this.raffinateinfo,
					total: this.HJ,
				}).then(rew => {
					if (rew.data.code == 200) {
						swal(rew.data.msg.data.info)
					} else {
						swal(rew.data.msg.data.info)
					}
					this.remarks = ''
					this.search()
				})
			}
		},
		created() {
			this.endtime = new Date().getFullYear() + '-' + ((new Date().getMonth() + 1) < 10 ? '0' + (new Date().getMonth() + 1) : (new Date().getMonth() + 1)) + '-' + (new Date().getDate() < 10 ? '0' + new Date().getDate() : new Date().getDate());
		}

	})
</script>
</html>
