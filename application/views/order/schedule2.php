<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="<?php echo base_url(); ?>res/js/vue.js" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>res/js/axios.js" charset="utf-8"></script>

	<script src="<?php echo base_url(); ?>res/js/win10.child.js"></script>


	<!-- 引入样式 -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>res/css/index.css">
	<!-- 引入组件库 -->
	<script src="<?php echo base_url(); ?>res/js/index.js"></script>

	<link href="<?php echo base_url(); ?>/res/css/tailwind-ui.min.css" rel="stylesheet">

	<link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
	<!-- 引入组件库 -->
	<script src="https://unpkg.com/element-ui/lib/index.js"></script>
</head>
<style>

	.el-table__expanded-cell[class*=cell] {
		padding: 1px 50px;
	}
	.el-table td, .el-table th {
		padding: 1px 0;
	}
	.yap {
		color: red;
	}

	.yhz {
		color: blue;
	}

	.ft {
		font-size: 1.0rem;
	}

	.bodyft {
		font-size: 1.1rem;
	}

	.hz {
		width: 100%;
		height: 100%;
		background: rgba(0, 0, 0, 0.5);
		position: fixed;
		top: 0;
	}

	.qx {
		color: #ff86f2;
	}
</style>
<body>
<div id="suapp" class="p-6">
	<el-table
			border
			:data="tableData"
			element-loading-text="拼命加载中"
			element-loading-spinner="el-icon-loading"
			element-loading-background="rgba(0, 0, 0, 0.8)"
			v-loading="loading"
			height="600"
			style="width: 100%">
		<el-table-column type="expand">
			<template slot-scope="props">
				<el-table
						:row-class-name="tableRowClassName"
						border
						:data="props.row.suborder">
					<el-table-column
							width="55">
						<template slot-scope="propss">
							<input v-model="propss.row.ischeck" @click="selectorder(props.row,propss.row)" v-if="propss.row.stateshow == '正常'" type="checkbox">
						</template>
					</el-table-column>
					<el-table-column
							label="商品"
							prop="goodsname">
						<template slot-scope="propss">
							<input type="text" disabled :value="propss.row.goodsname">
						</template>
					</el-table-column>

					<el-table-column
							label="数量"
							prop="num">
						<template slot-scope="propss">
							<input type="text" disabled :value="propss.row.num">
						</template>
					</el-table-column>


					<el-table-column
							label="方式"
							prop="mode">
						<template slot-scope="propss">
							<input type="text" disabled :value="propss.row.mode">
						</template>
					</el-table-column>

					<el-table-column
							label="安排方式"
							prop="distributionmode">
						<template slot-scope="propss">
							<input type="text" disabled :value="propss.row.distributionmode">
						</template>
					</el-table-column>

					<el-table-column
							label="配送员"
							prop="deliveryman">
						<template slot-scope="propss">
							<input type="text" disabled :value="propss.row.deliveryman">
						</template>
					</el-table-column>

					<el-table-column
							label="安排时间"
							prop="arrangetime">
						<template slot-scope="propss">
							<input type="text" disabled :value="propss.row.arrangetime">
						</template>
					</el-table-column>

					<el-table-column
							label="送达时间"
							prop="arrangetime">
						<template slot-scope="propss">
							<input type="text" disabled :value="propss.row.arrivetime">
						</template>
					</el-table-column>

					</el-table-column>

					<el-table-column
							label="汇总时间"
							prop="feedbacktime">
						<template slot-scope="propss">
							<input type="text" disabled :value="propss.row.feedbacktime">
						</template>
					</el-table-column>

					<el-table-column
							label="状态"
							prop="stateshow">
						<template slot-scope="propss">
							<input type="text" disabled :value="propss.row.stateshow">
						</template>
					</el-table-column>


				</el-table>
			</template>
		</el-table-column>
		<el-table-column
				label="下单时间"
				prop="addtime">
			<template slot-scope="props">
				<input type="text" disabled :value="props.row.addtime">
			</template>
		</el-table-column>
		<el-table-column
				label="预约上门时间"
				prop="appointmenttime">
			<template slot-scope="props">
				<input type="text" disabled :value="props.row.appointmenttime">
			</template>
		</el-table-column>
		<el-table-column
				label="会员号"
				prop="memberid">
			<template slot-scope="props">
				<input type="text" disabled :value="props.row.memberid">
			</template>
		</el-table-column>
		<el-table-column
				label="联系人"
				prop="name">
			<template slot-scope="props">
				<input type="text" disabled :value="props.row.name">
			</template>
		</el-table-column>
		<el-table-column
				label="联系电话"
				prop="telephone">
			<template slot-scope="props">
				<input type="text" disabled :value="props.row.telephone">
			</template>
		</el-table-column>
		<el-table-column
				label="地址"
				prop="desc">
			<template slot-scope="props">
				<input type="text" disabled :value="props.row.street+props.row.housenumber+props.row.address">
			</template>
		</el-table-column>

		<el-table-column
				label="用户等级"
				prop="viplevel">
			<template slot-scope="props">
				<input type="text" disabled :value="props.row.viplevel">
			</template>
		</el-table-column>


		<el-table-column
				label="用户类型"
				prop="customertype">
			<template slot-scope="props">
				<input type="text" disabled :value="props.row.customertype">
			</template>
		</el-table-column>


		<el-table-column
				label="备注"
				prop="remarks">
			<template slot-scope="props">
				<input type="text" disabled :value="props.row.remarks">
			</template>
		</el-table-column>
	</el-table>

	<div  class="mt-3 flex">
		<el-button @click="shauxin()" type="primary">刷新</el-button>
		<el-checkbox-group class="ml-3 p-2" v-model="checkList">
			<el-checkbox label="正常"></el-checkbox>
			<el-checkbox label="已安排"></el-checkbox>
			<el-checkbox label="已汇总"></el-checkbox>
			<el-checkbox label="取消" ></el-checkbox>
			<el-checkbox label="已送达" ></el-checkbox>
			<el-checkbox label="已接单" ></el-checkbox>
		</el-checkbox-group>
	</div>
	<div  class="mt-3 flex">
		<el-button @click="aporder()" type="primary">安排订单</el-button>
	</div>

	<el-dialog
			v-if="isSaomiao"
			title="订单安排"
			:visible.sync="apordershow"
			width="60%"
			:before-close="apordershowClose">
		<div class="grid-cols-2 grid">

			<el-collapse v-model="activeNames" @change="handleChange">
				<template v-for="(v,index) in orderlist">
					<el-collapse-item
							:title="v.goodsname + ' 数量:'+ v.num+ ' 单价:'+ parseFloat(v.price)+ ' 小计:'+ parseFloat(v.total)"
							:name="index">
						<div>会员号：{{ v.mainmsg.memberid }}</div>
						<div>姓名：{{ v.mainmsg.name }} 电话：{{ v.mainmsg.telephone }}</div>
						<div>地址：{{ v.mainmsg.fulladdress }}</div>
						<div>备注：{{ v.mainmsg.remarks }}</div>
						<div>内部备注：{{ v.mainmsg.ope_remarks }}</div>
						<div v-if="v.stateshow=='正常'">状态：待安排</div>
						<div v-else class="text-red-500">状态：安排成功！</div>
					</el-collapse-item>
				</template>

			</el-collapse>
			<div>
				<div class="flex justify-between">
					<p class="font-bold p-2">合计数量</p>
					<p class="font-bold p-2 border rounded-full bg-gray-500 text-white">清空</p>
				</div>
				<input class="p-2 border rounded w-full" @keyup.enter="scanning" v-model="inputnum" placeholder="输入票据或钢瓶码" />
			</div>

		</div>
		<div class="mt-2 flex">
			<el-select v-model="deliveryman" filterable placeholder="请选择司机">
				<el-option
						v-for="item in psy"
						:key="item.name"
						:label="item.name"
						:value="item.name">
				</el-option>
			</el-select>

		</div>
		<span slot="footer" class="dialog-footer">
			<el-button @click="apordershow = false">取 消</el-button>
			<el-button type="primary" @click="aporder">确认安排</el-button>
		  </span>
	</el-dialog>
	<el-dialog
			v-else
			title="订单安排"
			:visible.sync="apordershow"
			width="50%"
			:before-close="apordershowClose">
		<div>
			<el-collapse v-model="activeNames" @change="handleChange">
				<template v-for="(v,index) in orderlist">
					<el-collapse-item
							:title="v.goodsname + ' 数量:'+ v.num+ ' 单价:'+ parseFloat(v.price)+ ' 小计:'+ parseFloat(v.total)"
							:name="index">
						<div>会员号：{{ v.mainmsg.memberid }}</div>
						<div>姓名：{{ v.mainmsg.name }} 电话：{{ v.mainmsg.telephone }}</div>
						<div>地址：{{ v.mainmsg.fulladdress }}</div>
						<div>备注：{{ v.mainmsg.remarks }}</div>
						<div>内部备注：{{ v.mainmsg.ope_remarks }}</div>
						<div v-if="v.stateshow=='正常'">状态：待安排</div>
						<div v-else class="text-red-500">状态：安排成功！</div>
					</el-collapse-item>
				</template>

			</el-collapse>
		</div>
		<div class="mt-2 flex">
			<el-select v-model="deliveryman" filterable placeholder="请选择司机">
				<el-option
						v-for="item in psy"
						:key="item.name"
						:label="item.name"
						:value="item.name">
				</el-option>
			</el-select>

		</div>
		<span slot="footer" class="dialog-footer">
			<el-button @click="apordershow = false">取 消</el-button>
			<el-button type="primary" @click="aporder">确认安排</el-button>
		  </span>
	</el-dialog>

</div>
</body>
<!-- 引入组件库 -->
<script src="<?php echo base_url(); ?>res/js/umd.js"></script>
<script src="<?php echo base_url(); ?>res/js/base64.js"></script>
<script>
	new Vue({
		el: '#suapp',
		data: {
			activeNames: [0],
			checkList: ['正常','已安排'],
			checkindex: 0,
			showindex: 0,
			ischeck: false,
			apordershow: false,
			order: '',
			hzdata: '',
			inputnum: '',
			hzmaindata: '',
			msg: '',
			alltype: '钢瓶码',
			allcode: '',
			zt: false,
			ordershow: false,
			selfmention: false,
			canhz: false,
			xs: true,
			hzallshow: false,
			state1: true,
			state2: true,
			state3: false,
			state4: false,
			state5: false,
			state6: false,
			loading: true,
			successmsg: false,
			hzshow: false,
			sx: false,
			ppsynum: 0,
			tableData: [],
			yjdpsylist: [],
			goods: [],
			hzgoods: [],
			firehzgoods: [],
			canhzgoods: [],
			hzgoodszd: [],
			goodsnum: '',
			alldeliveryman: '',
			hzgoodsnum: '',
			hzgoodsnumzd: '',
			distributionmode: '营业员安排',
			deliveryman: '',
			psy: [],
			scangodos: [],
			allgoods: [],
			packingtype: 'YSP35.5型钢瓶',
			goodsjson: []
		},
		watch: {
			checkList () {
				this.getlist()
			},

		},
		computed: {


			orderlist () {
				let arr = []
				for (let i = 0; i < this.tableData.length; i++) {
					for (let j = 0; j < this.tableData[i].suborder.length; j++) {
						if (this.tableData[i].suborder[j].ischeck == true) {
							this.tableData[i].suborder[j]['mainmsg'] = this.tableData[i]
							arr = arr.concat(this.tableData[i].suborder[j])
						}
					}
				}
				return arr
			},
			isSaomiao () {
				for (let i = 0; i < this.orderlist.length; i++) {
					if (this.orderlist[i].isscan == 1) {
						return true
					}
				}
				return false
			}

		},
		methods: {
			handleChange(val) {
				console.log(val);
			},
			selectorder(main,row){
				for (let i = 0; i < this.tableData.length; i++) {
					for (let j = 0; j < this.tableData[i].suborder.length; j++) {
						if (this.tableData[i].suborder[j].serial != row.serial) {
							this.tableData[i].suborder[j].ischeck = false
						}
					}
				}
				this.$forceUpdate()
			},
			tableRowClassName ({row, rowIndex}) {
				if (row.stateshow == '已安排') {
					return 'yap'
				} else if (row.stateshow == '已汇总') {
					return 'yhz'
				} else if (row.stateshow == '取消') {
					return 'qx'
				}
			},

			apordershowClose () {

			},
			aporder() {

				if (!this.orderlist.length) {
					this.$message.error('请先勾选单据');
					return false
				}
				this.apordershow = true;
				if (this.orderlist[0].deliveryman == '自提') {
					this.deliveryman = '自提'
				}
			},

			scanning() {
				//去掉回车空格
				var num = (this.inputnum.replace(/[\r\n]/g, "")).replace(/\ +/g, "");

				if (num) {
					if (!this.isHas(num)) {
						var type = this.return_packingtype(num);

						if (type == '未知' && this.scanlist.typenum > 1) {
							this.goodsnum = '';
							return false
						}
						if (this.scanlist.typenum > 1) {
							var data = {
								type: type,
								code: num
							};
						} else {
							var data = {
								type: this.scanlist.package,
								code: num
							};
						}
						console.log(this.scanlist)
						if (this.goods.length == this.scanlist.num) {
							alert('无法录入更多产品');
							this.goodsnum = '';
							return false
						} else {
							this.addgoodsjson(data);
						}
						this.goods = this.goods.concat(data);

						this.goodsnum = ''
					} else {
						this.goodsnum = ''
					}
				}

			},

			isHasHz(str) {
				for (i in this.hzgoods) {
					if (this.hzgoods[i] == str) {
						return true
					}
				}
				return false
			},
			isHasallHz(str) {
				for (i in this.allgoods) {
					if (this.allgoods[i].code == str) {
						return true
					}
				}
				return false
			},
			isHas(str) {
				for (i in this.goods) {
					if (this.goods[i]['code'] == str) {
						return true
					}
				}
				return false
			},
			return_packingtype($value) {
				$result = '未知';
				if ($value.length == 9) {
					$spec = -1;
				} else {
					$spec = $value.slice(-14, -13);
				}
				switch ($spec) {
					case '0':
						$result = 'YSP35.5型钢瓶';
						break;
					case '6':
						$result = 'YSP35.5型钢瓶';
						break;
					case '1':
						$result = 'YSP12型钢瓶';
						break;
					case '7':
						$result = 'YSP12型钢瓶';
						break;
					case '2':
						$result = 'YSP118型钢瓶';
						break;
					case '8':
						$result = 'YSP118型钢瓶';
						break;
					case '3':
						$result = 'YSP28.6型钢瓶';
						break;
					case '9':
						$result = 'YSP28.6型钢瓶';
						break;
					default:
						$result = '未知';
				}

				return $result;
			},

			getlist() {
				this.loading = true;
				axios.post('/index.php/api/getOrderList', {
					state: this.checkList.toString()
				}).then(rew => {
					this.tableData = rew.data.data;
					this.psy = rew.data.psy;
					this.deliveryman = this.psy[0]['name'];
					this.loading = false;
					this.tableData[this.showindex].isshow = true;
					//配送员列队
					var arr = [];
					var list = JSON.parse(JSON.stringify(this.psy));
					for (i in list) {
						var key = list[i].name
						var val = localStorage.getItem(key);
						if (val) {
							if (((new Date()).valueOf() / 1000) - (val / 1000 + 10 * 60) > 0) {
								arr = arr.concat(list[i])
							}
						}
					}
					this.yjdpsylist = arr
				})
			},

			shauxin() {
				this.getlist()
			},
			myprint(data) {
				if (data.type == '代销发货单据' && data.department == '运输公司') {
					var str = '';

					var goods = JSON.parse(data.goods)


					var jsonp = {
						Memo2: "南宁三燃公司代销发货单据",
						Memo1: data.topinfo,
						Memo11: "收货人：  " + data.name,
						Memo12: data.name + '     ' + data.telephone,
						Memo13: '司机：',
						Memo14: '拉瓶：',
						Memo15: '规格',
						Memo16: '重瓶发货数',
						Memo17: '重瓶实收数',
						Memo18: '总金额',
						Memo19: '空瓶实收数',
						Memo20: '退重数量',
						Memo21: '返重原因',
						Memo22: '返重实收数',
						Memo4: '',
						Memo5: '',
						Memo6: '',
						Memo7: '',
						Memo8: '',
						Memo10: '',
						Memo23: goods[0] ? goods[0].goodsname : '',
						Memo24: goods[0] ? goods[0].num : '',
						Memo25: '',
						Memo26: goods[0] ? goods[0].total : '',
						Memo27: '',
						Memo28: '',
						Memo29: '',
						Memo30: '',
						Memo31: goods[1] ? goods[1].goodsname : '',
						Memo32: goods[1] ? goods[1].num : '',
						Memo33: '',
						Memo34: goods[1] ? goods[1].total : '',
						Memo35: '',
						Memo36: '',
						Memo37: '',
						Memo38: '',
						Memo39: goods[2] ? goods[2].goodsname : '',
						Memo40: goods[2] ? goods[2].num : '',
						Memo41: '',
						Memo42: goods[2] ? goods[2].total : '',
						Memo43: '',
						Memo44: '',
						Memo45: '',
						Memo46: '',
						Memo47: '运费：' + data.freighttotal,
						Memo48: '气款：' + data.goodstotal,
						Memo49: '合计总金额：' + data.total,
						Memo50: '发货人：' + data.deliveryman,
						Memo51: '收货人签名：',
						Memo52: '',
						Memo53: '用户备注：',
						Memo54: data.salesman + '/' + data.salesmantelephone,
						Memo55: '打单时间：<?= date('Y-m-d H:i:s', time())?>',
					}
					var data_infop = {
						PrintData: jsonp,
						Print: true
					}
					axios.get('http://127.0.0.1:8000/api/print/order/12/?data=' + JSON.stringify(data_infop)).then(rew => {
						console.log(rew)
					})
				}

				if (data.type == '送气安检一体单') {
					paystr = '';
					if (data.pay_balance > 0) {
						paystr += '余额支付:' + data.pay_balance + '元，';
					}
					if (data.pay_weixin > 0) {
						paystr += '微信支付:' + data.pay_weixin + '元，';
					}
					if (data.pay_alipay > 0) {
						paystr += '支付宝支付:' + data.pay_alipay + '元，';
					}
					if (data.pay_arrears > 0) {
						paystr += '月结支付:' + data.pay_arrears + '元，';
					}
					if (data.pay_coupon > 0) {
						paystr += '优惠券:' + data.pay_coupon + '元，';
					}
					paystr += "账户余额:" + parseFloat(data.balance).toFixed(2) + "元";
					let goodsdata = JSON.parse(data.goods);
					var json = {
						time: data.topinfo,
						memeberid: data.memberid,
						name: data.name,
						department: data.department,
						tel: data.telephone,
						delivery: data.deliveryman,
						address: ((data.address).replace(/#/g, "")).replace(/\[/g, ""),
						work: ((data.workplace).replace(/#/g, "")).replace(/\[/g, ""),
						goodsname1: goodsdata[0] ? goodsdata[0]['goodsname'] : '',
						goodsname2: goodsdata[1] ? goodsdata[1]['goodsname'] : '',
						goodsname3: goodsdata[2] ? goodsdata[2]['goodsname'] : '',
						goodstype1: goodsdata[0] ? goodsdata[0]['spec'] : '',
						goodstype2: goodsdata[1] ? goodsdata[1]['spec'] : '',
						goodstype3: goodsdata[2] ? goodsdata[2]['spec'] : '',
						goodsprice1: goodsdata[0] ? goodsdata[0]['marketprice'] : '',
						goodsprice2: goodsdata[1] ? goodsdata[1]['marketprice'] : '',
						goodsprice3: goodsdata[2] ? goodsdata[2]['marketprice'] : '',
						goodsnum1: goodsdata[0] ? goodsdata[0]['num'] : '',
						goodsnum2: goodsdata[1] ? goodsdata[1]['num'] : '',
						goodsnum3: goodsdata[2] ? goodsdata[2]['num'] : '',
						goodsyh1: goodsdata[0] ? goodsdata[0]['discount'] : '',
						goodsyh2: goodsdata[1] ? goodsdata[1]['discount'] : '',
						goodsyh3: goodsdata[2] ? goodsdata[2]['discount'] : '',
						goodstotle1: goodsdata[0] ? goodsdata[0]['total'] : '',
						goodstotle2: goodsdata[1] ? goodsdata[1]['total'] : '',
						goodstotle3: goodsdata[2] ? goodsdata[2]['total'] : '',
						info: paystr,
						zprice: parseFloat(data.pay_cash.toString()).toFixed(2),
						zcode: data.zcode,
						kcode: data.kcode,
						rmarks: data.remarks,
						bottominfo: data.other
					};
					var data_info = {
						PrintData: json,
						Print: true
					};
					axios.get('http://127.0.0.1:8000/api/print/order/1/?data=' + JSON.stringify(data_info)).then(rew => {
						console.log(rew)
					})
				}
				if (data.type == '普通订单-备注') {
					let goodsdata = JSON.parse(data.goods);
					var jsonp = {
						title: "预约换水单-(送水电话：2622222)",
						time: data.topinfo,
						memberid: "卡号 " + data.memberid,
						name: "姓名 " + data.name,
						tel: "电话 " + data.telephone,
						address: "地址 " + data.address,
						department: data.department,
						type1: goodsdata[0] ? goodsdata[0]['mode'] : '',
						type2: goodsdata[1] ? goodsdata[1]['mode'] : '',
						type3: goodsdata[2] ? goodsdata[2]['mode'] : '',
						band1: goodsdata[0] ? goodsdata[0]['goodsname'] : '',
						band2: goodsdata[1] ? goodsdata[1]['goodsname'] : '',
						band3: goodsdata[2] ? goodsdata[2]['goodsname'] : '',
						num1: goodsdata[0] ? '数量' + goodsdata[0]['num'] : '',
						num2: goodsdata[1] ? '数量' + goodsdata[1]['num'] : '',
						num3: goodsdata[2] ? '数量' + goodsdata[2]['num'] : '',
						price1: goodsdata[0] ? '单价 ' + Number(goodsdata[0]['total']).toFixed(2) : '',
						price2: goodsdata[1] ? '单价 ' + Number(goodsdata[1]['total']).toFixed(2) : '',
						price3: goodsdata[2] ? '单价 ' + Number(goodsdata[2]['total']).toFixed(2) : '',
						jfcate: "",
						residualindex: data.userotherinfo,
						yck: "预存款",
						price: data.balance,
						cash: "合计收现 " + Number(data.pay_cash).toFixed(2),
						delivery: "配送员：" + data.deliveryman,
						operator: "操作员：" + data.operator,
						tsinfo: "温馨提示：1，桶装水开封后建议两周内饮用完为宜\n" +
								"2，饮水机2-6个月应清洗消毒一次（可有偿上门服务）",
						Memo18: "戴一次性手套安装",
						Memo19: "使用镊子安装",
						Memo20: "用户意见",
						Memo21: "【】是  【】 否",
						Memo22: "【】是  【】 否",
						Memo23: "【】满意【】 一般【】差",
						Memo24: "用户签字",
						Memo12: "---------------------------------------------------------------------------",
						Memo25: data.other
					};
					var data_infop = {
						PrintData: jsonp,
						Print: true
					};
					console.log(data_infop);
					axios.get('http://127.0.0.1:8000/api/print/order/2/?data=' + JSON.stringify(data_infop)).then(rew => {
						console.log(rew)
					})
				}
				if (data.type == '普通订单') {
					let goodsdata = JSON.parse(data.goods);
					var jsonp = {
						title: "预约换水单-(送水电话：2622222)",
						time: data.topinfo,
						memberid: "卡号 " + data.memberid,
						name: "姓名 " + data.name,
						tel: "电话 " + data.telephone,
						address: "地址 " + data.address,
						department: data.department,
						type1: goodsdata[0] ? goodsdata[0]['mode'] : '',
						type2: goodsdata[1] ? goodsdata[1]['mode'] : '',
						type3: goodsdata[2] ? goodsdata[2]['mode'] : '',
						band1: goodsdata[0] ? goodsdata[0]['goodsname'] : '',
						band2: goodsdata[1] ? goodsdata[1]['goodsname'] : '',
						band3: goodsdata[2] ? goodsdata[2]['goodsname'] : '',
						num1: goodsdata[0] ? '数量' + goodsdata[0]['num'] : '',
						num2: goodsdata[1] ? '数量' + goodsdata[1]['num'] : '',
						num3: goodsdata[2] ? '数量' + goodsdata[2]['num'] : '',
						price1: goodsdata[0] ? '单价 ' + Number(goodsdata[0]['total']).toFixed(2) : '',
						price2: goodsdata[1] ? '单价 ' + Number(goodsdata[1]['total']).toFixed(2) : '',
						price3: goodsdata[2] ? '单价 ' + Number(goodsdata[2]['total']).toFixed(2) : '',
						jfcate: "",
						residualindex: parseFloat(data.pay_weixin) > 0 ? '微信付款：' + data.pay_weixin + '元' : data.userotherinfo,
						yck: "预存款",
						price: data.balance,
						cash: "合计收现 " + Number(data.pay_cash).toFixed(2),
						delivery: "配送员：" + data.deliveryman,
						operator: "操作员：" + data.operator,
						tsinfo: "温馨提示：1，桶装水开封后建议两周内饮用完为宜\n" +
								"2，饮水机2-6个月应清洗消毒一次（可有偿上门服务）",
						Memo18: "戴一次性手套安装",
						Memo19: "使用镊子安装",
						Memo20: "用户意见",
						Memo21: "【】是  【】 否",
						Memo22: "【】是  【】 否",
						Memo23: "【】满意【】 一般【】差",
						Memo24: "用户签字",
						Memo12: "---------------------------------------------------------------------------"
					};
					var data_infop = {
						PrintData: jsonp,
						Print: true
					};
					console.log(data_infop);
					axios.get('http://127.0.0.1:8000/api/print/order/3/?data=' + JSON.stringify(data_infop)).then(rew => {
						console.log(rew)
					})
				}

				if (data.type == '运输公司送气单') {

					let goodsdata = JSON.parse(data.goods);
					let str = ''

					for (let i = 0; i < goodsdata.length; i++) {
						str += '规格：' + goodsdata[i].goodsname + '   数量：' + goodsdata[i].num + '     '
					}
					let orderinfo = JSON.parse(data.orderinfo);
					var json = {
						Memo1: '司机：    ' + data.deliveryman,
						Memo2: '付款方式（' + (parseFloat(data.pay_cash) > 0 ? '现金' : '月结') + '）',
						Memo3: '',
						Memo4: '储罐厂 NO：' + data.printserial,
						Memo5: '南宁三燃液化气有限公司IC卡送气单（大户气，请及时送气）-预',
						Memo6: '日期：' + orderinfo.time.substr(0, 10),
						Memo7: '送气时间：' + orderinfo.time.substr(11, 5),
						Memo8: '卡号：' + data.memberid,
						Memo9: '姓名：' + data.name,
						Memo10: '电话：' + data.telephone,
						Memo11: '打印时间：<?= date('H:i', time())?>',
						Memo13: str,
						Memo12: '地址：' + data.address,

						Memo16: '气价：' + data.goodstotal,

						Memo18: '扣卡：' + (data.pay_balance + data.pay_arrears),
						Memo19: '应收金额：' + data.pay_cash,
						Memo20: '单位：' + data.workplace,
						Memo21: '卡剩余额：' + data.balance,
						Memo22: '回空数量：',
						Memo23: '退重数量：',
						Memo24: '备注：' + data.remarks,

						Memo25: '移动支付：________',
						Memo26: '   实收现金：__________',
						Memo27: '',
						Memo28: '评价：□ 满意  □ 不满意',

						Memo30: '复核：',
						Memo31: '操作员' + data.operator,
						Memo32: '商用气：' + data.salesman,
						Memo33: data.salesmantelephone,
						Memo34: '',
						Memo35: '客户安装',
						Memo36: '',
						Memo37: '司机安装：本次安装重瓶数为________瓶，已进行试漏，无漏气。',
						Memo38: '用户签字：_________________',
						Memo39: '',
						Memo40: '出厂重瓶（kg）',
						Memo41: '回空瓶（kg）',
						Memo42: '瓶号',
						Memo43: '钢瓶自重',
						Memo44: '发出重量',
						Memo45: '司机安装（√）',
						Memo46: '客户安装（√）',
						Memo47: '瓶号',
						Memo48: '钢瓶自重',
						Memo49: '发出重量',
						Memo50: '余气量',
						Memo51: '',
						Memo52: '',
						Memo53: '',
						Memo54: '',
						Memo55: '',
						Memo56: '',
						Memo57: '',
						Memo58: '',
						Memo59: '',

					};
					var data_info = {
						PrintData: json,
						Print: true
					};
					axios.get('http://127.0.0.1:8000/api/print/order/14/?data=' + JSON.stringify(data_info)).then(rew => {
						console.log(rew)
					})
				}

			},


		},
		created() {
			// console.log(Base64.encode(JSON.stringify({id:1})))
			this.getlist()
		}

	})
</script>
</html>
