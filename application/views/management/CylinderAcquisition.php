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
	<title>Document</title>
</head>
<body>
<div class="p-6" id="app">
	<div class="grid grid-cols-4">
		<div class="flex">
			<p class="p-2  w-3/6 ml-6">包装物类型</p>
			<select v-model="packingtype" class="p-2 border-2  rounded w-3/6" name="" id="">
				<option v-if="k<=2" v-for="(v,k) in initData.Packingtype.info" :value="v.name">{{v.name}}</option>
			</select>
		</div>
		<div class="flex">
			<p class="p-2  w-3/6 ml-6">生产日期</p>
			<select v-model="sctime" class="p-2 border-2  rounded w-3/6" name="" id="">
				<option value="2010">2010</option>
				<option value="2011">2011</option>
				<option value="2012">2012</option>
				<option value="2013">2013</option>
				<option value="2014">2014</option>
				<option value="2015">2015</option>
				<option value="2016">2016</option>
				<option value="2017">2017</option>
				<option value="2018">2018</option>
				<option value="2019">2019</option>
				<option value="2020">2020</option>
			</select>
		</div>
		<div class="flex">
			<p class="p-2  w-3/6 ml-6">检测日期</p>
			<select v-model="jctime" class="p-2 border-2 rounded w-3/6" name="" id="">
				<option v-if="sctime<2014" value="2014">2014</option>
				<option v-if="sctime<2015" value="2015">2015</option>
				<option v-if="sctime<2016" value="2016">2016</option>
				<option v-if="sctime<2017" value="2017">2017</option>
				<option v-if="sctime<2018" value="2018">2018</option>
				<option v-if="sctime<2019" value="2019">2019</option>
				<option v-if="sctime<2020" value="2020">2020</option>
				<option value="无">无</option>
			</select>
		</div>

		<div class="flex">
			<p class="p-2  w-3/6 ml-6">是否报废</p>
			<select v-model="isbf" class="p-2 border-2 rounded w-3/6" name="" id="">
				<option value="是">是</option>
				<option value="否">否</option>
			</select>
		</div>
	</div>

	<div class="grid grid-cols-4 mt-4">
		<div class="flex">
			<p class="p-2  w-3/6 ml-6">收购价格</p>
			<input v-model="price" type="number" class="p-2 border-2 rounded w-3/6">
		</div>
		<div class="flex">
			<p class="p-2  w-3/6 ml-6">门店</p>
			<input type="text" disabled value="<?= get_cookie('department')?>" class="p-2 border-2 rounded w-3/6">
		</div>
		<div class="flex">
			<p class="p-2  w-3/6 ml-6">经手人</p>
			<select v-model="brokerage" class="p-2 border-2 rounded w-3/6" name="" id="">
				<option value="">选择经手人</option>
				<option v-for="v in AreaDeliverymanList" :value="v.name">{{v.name}}</option>
			</select>
		</div>
		<div class="flex">
			<p class="p-2  w-3/6 ml-6">备注</p>
			<input v-model="remarks" type="text" class="p-2 border-2 rounded w-3/6">
		</div>

	</div>
	<div class="grid grid-cols-4 mt-4">
		<div class="p-6">
			<button @click="submit" class="bg-teal-500 text-white rounded p-3">
				确认办理
			</button>
		</div>
	</div>
</div>
</body>
<script>
	new Vue({
		el: '#app',
		data() {
			return {
				initData: '',
				packingtype: '',
				remarks: '',
				userid: '',
				memberid: '',
				brokerage: '',
				sctime: '2010',
				jctime: '2014',
				isbf: '否',
				AreaDeliverymanList: []
			}
		},
		watch : {
			sctime (val) {
				if (val >= this.jctime) {
					this.jctime = Number(val) + 1
				}
				if (val == 2020) {
					this.jctime = '无'
				}
			}
		},
		computed: {
			price() {
				if (this.isbf == '是') {
					if (this.packingtype == 'YSP12型钢瓶') {
						return 0;
					} else {
						return 10;
					}
				} else {
					var price = 0
					let arr = this.initData.BuyPackingtypeParameter.info
					for (let i = 0; i < arr.length; i++) {
						if (this.packingtype == arr[i].packingtype && this.sctime == arr[i].productionyears && this.jctime == arr[i].inspectionperiod) {
							return Number(arr[i].price)
						}
					}
					return price
				}
			}
		},
		methods: {
			submit() {
				axios.post('/index.php/api/CylinderAcquisition', {
					packingtype: this.packingtype,
					remarks: this.remarks + '(生' + this.sctime + '-检' + this.jctime + '-' + this.isbf+')',
					brokerage: this.brokerage,
					price: this.price,
					userid: this.userid,
					memberid: this.memberid,
				}).then(rew => {
					if (rew.data.code == 200) {
						swal('办理成功')
						var data = rew.data.printinfo
						if (data.type == '收购钢瓶单') {

							var jsonp = {
								title: "南宁三燃公司收购钢瓶单",
								time: data.topinfo,
								memberid: "来源  " + data.memberid,
								name: data.department + "办理",
								Memo1: '',
								Memo2: '',
								Memo3: '钢瓶: ' + data.goods,
								Memo4: '收购价格: ' + data.pay_cash + "元",
								Memo5: '营业员: ' + data.operator,
								Memo6: '配送员签字：',
								Memo7: '用户签字：',
							}
							var data_infop = {
								PrintData: jsonp,
								Print: true
							}
							axios.get('http://127.0.0.1:8000/api/print/order/9/?data=' + JSON.stringify(data_infop)).then(rew => {
								console.log(rew)
							})
						}


					} else {
						swal('办理失败')
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
		},
		created() {
			this.userid = this.getQueryVariable('userid')
			this.memberid = this.getQueryVariable('memberid')
			axios.post('/index.php/api/getInitData').then(rew => {
				this.initData = rew.data.data
				this.AreaDeliverymanList = rew.data.AreaDeliverymanList
				this.packingtype = this.initData.Packingtype.info[0].name
			})
		}
	})
</script>
</html>
