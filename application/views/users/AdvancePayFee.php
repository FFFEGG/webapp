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
	<title>用户预缴抵押物使用产生费用</title>
</head>
<body>
<div id="app" class="p-6">

	<table class="table-auto mt-6 w-full text-xs">
		<thead>
		<tr>
			<th class=" border-2"></th>
			<th class=" border-2">办理时间</th>
			<th class=" border-2">计费方式</th>
			<th class=" border-2">物品名</th>
			<th class=" border-2">票据号</th>
			<th class=" border-2">单价</th>
			<th class=" border-2">数量</th>
			<th class=" border-2">使用时间</th>
			<th class=" border-2">计费时间</th>
			<th class=" border-2">包装物类型</th>
			<th class=" border-2">备注</th>
			<th class=" border-2">部门</th>
		</tr>
		</thead>
		<tbody>

		<tr class="text-center" v-for="(v,index) in warehouselist">
			<td class="border-2 ">
				<input v-model="warehouselistindex" type="radio" name="warehouselist" :value="index"
					   class="text-2xl p-6">
			</td>
			<td class="border-2 ">{{ v.addtime}}</td>
			<td class="border-2 ">{{ v.billingmode}}</td>
			<td class="border-2 ">{{ v.name}}</td>
			<td class="border-2 ">{{ v.billno}}</td>
			<td class="border-2 ">{{ v.price}}</td>
			<td class="border-2 ">{{ v.num}}</td>
			<td class="border-2 ">{{ v.usetime}}</td>
			<td class="border-2 ">{{ v.billingtime}}</td>
			<td class="border-2 ">{{ v.packingtype}}</td>
			<td class="border-2 ">{{ v.remarks}}</td>
			<td class="border-2 ">{{ v.department}}</td>
		</tr>
		</tbody>
	</table>

	<div class="flex mt-3">
		<p class="p-2 border-2 rounded border-r-0 rounded-r-none">费用优惠ID</p>
		<select name="" id="" class="p-2 border-2 rounded rounded-l-none" v-model="discountid">
			<option value="">选择优惠</option>
			<option v-if="v.project == warehouselist[warehouselistindex].billingmode" v-for="v in ChargeStandardDiscountlist" :value="v">{{ v.name }}</option>
		</select>
		<input type="text" class="p-2 border-2 rounded ml-3" placeholder="预缴金额" v-model="total">

		<button @click="AdvancePayFee" class="p-2 rounded bg-teal-500 text-white px-6 ml-3">确认</button>
	</div>

</div>
</body>
<script>
	new Vue({
		el: '#app',
		data() {
			return {
				warehouselistindex: 0,
				collateralid: '',
				collateralserial: '',
				userid: '<?= $this->input->get('userid')?>',
				warehouse: '<?= $this->input->get('userid')?>',
				discountid: '',
				total: '',
				warehouselist: [],
				ChargeStandardDiscountlist: [],
			}
		},
		watch : {
			discountid (val) {
				this.total = val.price
			}
		},
		methods: {
			AdvancePayFee() {
				if (this.discountid == '') {
					swal('请选择费用优惠ID')
					return false
				}
				if (this.total == '') {
					swal('请填写预缴金额')
					return false
				}
				axios.post('/index.php/api/AdvancePayFee', {
					collateralid: this.warehouselist[this.warehouselistindex].id,
					collateralserial: this.warehouselist[this.warehouselistindex].serial,
					userid: '<?= $this->input->get('userid')?>',
					memberid: '<?= $this->input->get('cardid')?>',
					discountid: this.discountid.id,
					total: this.total,
				}).then(rew => {
					if (rew.data.code == 200) {
						swal('办理成功')
						this.discountid = ''
						this.total = ''


						var data = rew.data.printinfo
						if (data.type == '预缴抵押物使用产生费') {
							var jsonp = {
								title: "南宁三燃公司预缴抵押物使用产生费单",
								time: data.topinfo,
								memberid: "卡号 " + data.memberid,
								name: "姓名 " + data.name,
								tel: "电话 " + data.telephone,
								address: "地址 " + data.address,
								department: data.department,
								Memo1: data.other,
								Memo2: '收现：￥'+ data.pay_cash,
								Memo3: '经办人: ' + data.operator,
								Memo4: '',
								Memo5: '',
							}
							var data_infop = {
								PrintData: jsonp,
								Print: true
							}
							axios.get('http://127.0.0.1:8000/api/print/order/16/?data=' + JSON.stringify(data_infop)).then(rew => {
								console.log(rew)
							})
						}



					} else {
						swal('办理失败，' + rew.data.msg)
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
			}
		},
		created() {
			axios.post('/index.php/api/warehouses', {
				userid: this.userid,
				warehouse: this.warehouse,
			}).then(rew => {
				this.warehouselist = rew.data.list
			})
			axios.post('/index.php/api/ChargeStandardDiscount', {
				state: '正常'
			}).then(rew => {
				this.ChargeStandardDiscountlist = rew.data.arr
			})
		}
	})
</script>
</html>
