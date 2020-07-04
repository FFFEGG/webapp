<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="<?php echo base_url(); ?>res/js/vue.js" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>res/js/axios.js" charset="utf-8"></script>

	<script src="<?php echo base_url(); ?>res/js/sweetalert2.min.js"></script>
	<script src="<?php echo base_url(); ?>res/js/core.js"></script>
	<script src="<?php echo base_url(); ?>res/js/win10.child.js"></script>
	<link href="<?php echo base_url(); ?>res/css/sweetalert2.min.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>res/js/vuetable-2.js"></script>

	<link rel="stylesheet" href="<?php echo base_url(); ?>res/css/index.css">
	<!-- 引入组件库 -->
	<script src="<?php echo base_url(); ?>res/js/index.js"></script>
	<link href="<?php echo base_url(); ?>/res/css/tailwind-ui.min.css" rel="stylesheet">
	<title></title>
</head>
<style>
	.yap {
		color: red;
	}

	.yjd {
		color: #ff780a;
	}
	.mt {
		color: green;
	}

	.ysd {
		color: #1da3ff;
	}

	.yhz {
		color: blue;
	}

	.qx {
		color: #ff86f2;
	}

	.black {
		color: black;
	}
	.el-table td, .el-table th {
		padding: 1px 0;
	}

</style>
<body>
<div id="app" class="p-6">
	<el-table
			v-loading="loading"
			element-loading-text="刷新数据中"
			element-loading-spinner="el-icon-loading"
			element-loading-background="rgba(0, 0, 0, 0.8)"
			ref="multipleTable"
			:data="tableData"
			tooltip-effect="dark"
			border
			highlight-current-row
			@row-click="handleCurrentChange"
			:row-class-name="tableRowClassName"
			default-expand-all
			style="width: 100%;margin-bottom: 20px"
			height="650"
			@selection-change="handleSelectionChange">
		<el-table-column
				type="selection"
				width="55"
				:selectable="checkboxT"
				prop="state"
		>
		</el-table-column>

		<el-table-column
				label="卡号"
				sortable
				prop="mainmsg.memberid"
				width="100">
			<template slot-scope="scope">
				<input type="text" class="w-full" disabled :value="scope.row.mainmsg.memberid">
			</template>
		</el-table-column>
		<el-table-column
				label="送气日期"
				sortable
				prop="mainmsg.appointmenttime"
				width="120">
			<template slot-scope="scope">
				<input type="text" class="w-full" disabled :value="scope.row.mainmsg.appointmenttime.substr(0,10)">
			</template>
		</el-table-column>
		<el-table-column
				label="时间"
				sortable
				prop="mainmsg.appointmenttime"
				width="100">
			<template slot-scope="scope">
				<input type="text" class="w-full" disabled :value="scope.row.mainmsg.appointmenttime.substr(11,5)">
			</template>
		</el-table-column>
		<el-table-column
				label="规格"
				prop="goodsname"
				width="100">
			<template slot-scope="scope">
				<input type="text" class="w-full" disabled :value="scope.row.goodsname">
			</template>
		</el-table-column>
		<el-table-column
				label="数量"
				prop="num"
				width="50">
		</el-table-column>
		<el-table-column
				label="姓名"
				sortable
				prop="mainmsg.name"
				width="100">
			<template slot-scope="scope">
				<input type="text" class="w-full" disabled :value="scope.row.mainmsg.name">
			</template>
		</el-table-column>
		<el-table-column
				label="差额补现"
				prop="pay_cash"
				sortable
				width="120">
			<template slot-scope="scope">
				<input type="text" class="w-full" disabled :value="'￥'+parseFloat(scope.row.pay_cash).toFixed(2)">
			</template>

		</el-table-column>

		<el-table-column
				label="单位名称"
				prop="workplace"
				sortable
				width="120">
			<template slot-scope="scope">
				<input type="text" class="w-full" disabled :value="scope.row.mainmsg.workplace">
			</template>

		</el-table-column>



		<el-table-column
				label="地址"
				sortable
				prop="mainmsg.fulladdress"
				width="100">
			<template slot-scope="scope">
				<input type="text" class="w-full" disabled :value="scope.row.mainmsg.fulladdress">
			</template>

		</el-table-column>


		<el-table-column
				label="送气备注"
				prop="mainmsg.remarks"
				width="100">
			<template slot-scope="scope">
				<input type="text" class="w-full" disabled :value="scope.row.mainmsg.remarks">
			</template>
		</el-table-column>

		<el-table-column
				label="业务员备注"
				prop="mainmsg.ope_remarks"
				width="100">
			<template slot-scope="scope">
				<input type="text" class="w-full" disabled :value="scope.row.mainmsg.ope_remarks">
			</template>
		</el-table-column>

		<el-table-column
				label="区域"
				sortable
				prop="mainmsg.regionalcode"
				width="80">
			<template slot-scope="scope">

				<input type="text" class="w-full" @keydown.enter="UpdateOrderAreaCode(scope.row)" v-model="scope.row.mainmsg.regionalcode">
			</template>
		</el-table-column>




		<el-table-column
				label="司机"
				sortable
				prop="deliveryman"
				width="100">
		</el-table-column>
		<el-table-column
				label="状态"
				sortable
				prop="state"
				width="100">
		</el-table-column>



		<el-table-column
				label="预约员"
				sortable
				prop="mainmsg.registrar"
				width="100">
			<template slot-scope="scope">
				<input type="text" class="w-full" disabled :value="scope.row.mainmsg.registrar">
			</template>
		</el-table-column>



		<el-table-column
				label="类型"
				prop="mainmsg.source"
				width="100">
			<template slot-scope="scope">
				<input type="text" class="w-full" disabled :value="scope.row.mainmsg.source">
			</template>
		</el-table-column>


		<el-table-column
				label="安排方式"
				prop="distributionmode"
				width="100">
		</el-table-column>

		<el-table-column
				label="取消原因"
				prop="revokeremarks"
				width="100">
			<template slot-scope="scope">
				<input type="text" class="w-full" disabled :value="scope.row.revokeremarks">
			</template>
		</el-table-column>





	</el-table>

	<el-checkbox-group v-model="checkList">
		<el-checkbox label="正常"></el-checkbox>
		<el-checkbox label="已安排"></el-checkbox>
		<el-checkbox label="已汇总"></el-checkbox>
		<el-checkbox label="取消"></el-checkbox>
		<el-checkbox label="已送达"></el-checkbox>
		<el-checkbox label="已接单"></el-checkbox>
	</el-checkbox-group>
	<div class="mt-3">
		<el-radio-group v-model="typeList">
			<el-radio label="全部"></el-radio>
			<el-radio label="商业用户"></el-radio>
			<el-radio label="代销用户"></el-radio>
		</el-radio-group>

	</div>

	<el-button class="mt-3" size="small" type="primary" @click="getlist">刷新</el-button>
	<el-button class="mt-3" size="small" type="primary" @click="ap">安排订单</el-button>
	<el-button class="mt-3" size="small" type="danger" @click="plupdate">批量修改司机</el-button>
	<el-dialog
			title="订单安排"
			:visible.sync="apordershow"
			width="50%"
			:before-close="apordershowClose">
		<div>

			<el-collapse v-model="activeNames" @change="handleChange">
				<template v-for="(v,index) in multipleSelection">
					<el-collapse-item
							:title="v.goodsname + ' 数量:'+ v.num+ ' 单价:'+ parseFloat(v.price)+ ' 小计:'+ parseFloat(v.total)"
							:name="index">
						<div>会员号：{{ v.mainmsg.memberid }}</div>
						<div>姓名：{{ v.mainmsg.name }} 电话：{{ v.mainmsg.telephone }}</div>
						<div>地址：{{ v.mainmsg.fulladdress }}</div>
						<div>备注：{{ v.mainmsg.remarks }}</div>
						<div>内部备注：{{ v.mainmsg.ope_remarks }}</div>
						<div v-if="v.state=='正常'">状态：待安排</div>
						<div v-else class="text-red-500">状态：安排成功！</div>
					</el-collapse-item>
				</template>

			</el-collapse>

		</div>
		<div class="mt-2 flex">
			<el-select v-model="driver" filterable placeholder="请选择司机">
				<el-option
						v-for="item in psy"
						:key="item.name"
						:label="item.name"
						:value="item.name">
				</el-option>
			</el-select>

			<div class="ml-3">
				<el-checkbox v-model="checked1" label="打印机打印" border></el-checkbox>

			</div>
			<div class="ml-3">
				<el-checkbox v-model="checked2" label="飞鹅打印" border></el-checkbox>

			</div>
		</div>
		<span slot="footer" class="dialog-footer">
			<el-button @click="apordershow = false">取 消</el-button>
			<el-button type="primary" @click="aporder">确认安排</el-button>
		  </span>
	</el-dialog>

	<el-dialog
			title="确认汇总"
			:visible.sync="hzorder"
			width="30%"
			:before-close="hzorderClose">
		<p class="mb-3 text-large">{{order.goodsname}} 数量：{{ order.num }} 司机： {{ order.deliveryman }}</p>
		<span><el-checkbox v-model="temporaryarrears" label="临时欠款" border></el-checkbox></span>
		<span slot="footer" class="dialog-footer">
		<el-button @click="hzorder = false">取 消</el-button>
		<el-button type="primary" @click="comfirmhz">确 定</el-button>
	  </span>
	</el-dialog>




	<el-dialog
			title="修改司机"
			:visible="updateordershow"
			@close="updateordershowClose"
			width="50%"
			:before-close="updateordershowClose">
		<div>

			<el-collapse v-model="activeNames" @change="handleChange">
				<template v-for="(v,index) in multipleSelection">
					<el-collapse-item
							:title="v.goodsname + ' 数量:'+ v.num+ ' 单价:'+ parseFloat(v.price)+ ' 小计:'+ parseFloat(v.total)"
							:name="index">
						<div>会员号：{{ v.mainmsg.memberid }}</div>
						<div>姓名：{{ v.mainmsg.name }} 电话：{{ v.mainmsg.telephone }}</div>
						<div>地址：{{ v.mainmsg.fulladdress }}</div>
						<div>备注：{{ v.mainmsg.remarks }}</div>
						<div>内部备注：{{ v.mainmsg.ope_remarks }}</div>
						<div>状态：{{ v.state }}</div>
					</el-collapse-item>
				</template>

			</el-collapse>

		</div>
		<div class="mt-2 flex">
			<el-select v-model="driver" filterable placeholder="请选择司机">
				<el-option
						v-for="item in psy"
						:key="item.name"
						:label="item.name"
						:value="item.name">
				</el-option>
			</el-select>

			<div class="ml-3">
				<el-checkbox v-model="checked1" label="打印机打印" border></el-checkbox>

			</div>
			<div class="ml-3">
				<el-checkbox v-model="checked2" label="飞鹅打印" border></el-checkbox>

			</div>
		</div>
		<span slot="footer" class="dialog-footer">
			<el-button @click="updateordershow = false">取 消</el-button>
			<el-button type="danger" @click="updateordercomfire">确认修改</el-button>
		  </span>
	</el-dialog>



</div>
</body>
<script>
	new Vue({
		el: '#app',
		data() {
			return {
				checkList: ['正常', '已安排'],
				typeList:'全部',
				tableData: [],
				multipleSelection: [],
				psy: [],
				yjdpsylist: [],
				driver: '',
				loading: false,
				apordershow: false,
				updateordershow: false,
				temporaryarrears: false,
				activeNames: [0],
				checked1: true,
				checked2: false,
				hzorder: false,
				updateorder: false,
				order: '',
			}
		},
		watch: {
			checkList(val) {
				this.getlist()
			},
			typeList (val) {
				this.getlist()
			}
		},
		methods: {
			comfirmhz() {
				axios.post('/index.php/api/transportpagehzOrder', {
					userid: this.order.mainmsg.userid,
					id: this.order.id,
					serialpay: this.order.serial_pay,
					memberid: this.order.mainmsg.memberid,
					temporaryarrears: this.temporaryarrears ? '是' : '否',
				}).then(rew => {
					if (rew.data.code == 200) {
						this.$message({
							message: '汇总成功！',
							type: 'success'
						});
						this.hzorderClose()
						this.getlist()
					} else {
						this.$message.error('汇总失败！' + rew.data.msg.msg);
					}
				})
			},
			hzorderClose() {
				this.hzorder = false
				this.temporaryarrears = false
				this.order = ''
				this.activeNames = [0]
			},
			updateordershowClose() {
				this.activeNames = [0]
				this.updateorder = false
				this.updateordershow = false
				this.temporaryarrears = false
				this.order = ''
			},
			handleCurrentChange(val) {
				if (val.state == '已送达') {
					this.hzorder = true
					this.order = val
				}
				if (val.state == '已汇总') {
					this.$confirm('取消汇总？', '提示', {
						confirmButtonText: '确定',
						cancelButtonText: '取消',
						type: 'warning'
					}).then(() => {
						axios.post('/index.php/api/CancelUserOrderHZ',{
							userid: val.mainmsg.userid,
							serialpay: val.serial_pay,
						}).then(rew=>{
							if (rew.data.code == 200) {
								this.$message({
									message: '成功！',
									type: 'success'
								});
							} else {
								this.$message.error('取消汇总失败！' + rew.data.msg.data.info);
							}
							this.getlist()
						})
					}).catch(() => {

					});
				}
			},
			updateordercomfire () {
				let that = this
				if (!this.driver) {
					this.$notify.error({
						title: '安排失败',
						message: '请选择司机',
						duration: 2000
					});
					return false
				}
				for (let i = 0; i < that.multipleSelection.length; i++) {
					(function (i) {
						setTimeout(function () {
							axios.post('/index.php/api/TransportationArrangeOrder', {
								serialpay: that.multipleSelection[i].serial_pay,
								id: that.multipleSelection[i].id,
								deliveryman: that.driver,
								feieprint: that.checked2?'是':'否',
							}).then(rew => {
								if (rew.data.code == 200) {
									if (that.checked1) {
										that.myprint(rew.data.msg.data.printinfo)
									}
									that.$message({
										message: '成功修改一条订单',
										type: 'success'
									});
									that.activeNames = [i + 1]
									if (i + 1 === that.multipleSelection.length) {
										setTimeout(function () {
											that.$message({
												message: '修改完毕',
												type: 'success'
											});
											that.updateordershow = false
											that.getlist()
											that.checked1 = true
										}, 500)
									}
								} else {
									that.$message({
										message: '修改失败'+rew.data.msg.data.tips,
										type: 'error'
									});
								}

							})
						}, 2500    * i);
					})(i);
				}
			},
			UpdateOrderAreaCode (data) {
				this.$confirm('确认修改订单区域', '提示', {
					confirmButtonText: '确定',
					cancelButtonText: '取消',
					type: 'warning'
				}).then(() => {
					axios.post('/index.php/api/UpdateOrderAreaCode',{
						userid: data.mainmsg.userid,
						serial: data.mainmsg.serial,
						addressid: data.mainmsg.addressid,
						regionalcode: data.mainmsg.regionalcode,
					}).then(rew=>{
						if (rew.data.code == 200) {
							this.$message({
								message: '修改区域成功',
								type: 'success'
							});
						} else {
							this.$message({
								message: '修改区域失败',
								type: 'error'
							});
						}
					})
				})


			},
			aporder() {
				let that = this
				if (!this.driver) {
					this.$notify.error({
						title: '安排失败',
						message: '请选择司机',
						duration: 2000
					});
					return false
				}
				for (let i = 0; i < that.multipleSelection.length; i++) {
					(function (i) {
					setTimeout(function () {
						axios.post('/index.php/api/creatorOrderPL', {
							info: [
								{
									goodscode: [],
									id: that.multipleSelection[i].id,
									serial_pay: that.multipleSelection[i].serial_pay,
									type: that.multipleSelection[i].type,
								}
							],
							userid: that.multipleSelection[i].mainmsg.userid,
							memberid: that.multipleSelection[i].mainmsg.memberid,
							serial: that.multipleSelection[i].mainmsg.serial,
							distributionmode: '配送员接单',
							deliveryman: that.driver,
							feieprint: that.checked2?'是':'否',
						}).then(rew => {
							if (rew.data.code == 200) {
								if (that.checked1) {
									that.myprint(rew.data.msg.data.printinfo)
								}
								that.$message({
									message: '成功安排一条订单',
									type: 'success'
								});
								that.activeNames = [i + 1]
								if (i + 1 === that.multipleSelection.length) {
									setTimeout(function () {
										that.$message({
											message: '安排完毕',
											type: 'success'
										});
										that.apordershow = false
										that.getlist()
										that.checked1 = true
									}, 500)
								}
							} else {
								that.$message({
									message: '安排失败'+rew.data.msg.data.tips,
									type: 'error'
								});
							}

						})
					},2500 * i)
					})(i);
				}
			},
			handleChange(val) {
				console.log(val);
			},
			apordershowClose(done) {
				this.$confirm('确认关闭？')
						.then(_ => {
							done();
						})
						.catch(_ => {
						});
			},
			ap() {
				if (!this.multipleSelection.length) {

					this.$notify.error({
						title: '安排失败',
						message: '请勾选要安排的订单'
					});
					return false
				}
				this.apordershow = true
			},
			checkboxT(row) {
				if (row.state == '已汇总' || row.state == '取消' || row.state == '已送达') {
					return false
				} else {
					return true
				}
			},
			tableRowClassName({row}) {
				if (row.state == '已安排') {
					return 'yap';
				} else if (row.state == '已汇总') {
					return 'yhz';
				} else if (row.state == '已接单') {
					return 'yjd';
				} else if (row.state == '已送达') {
					return 'ysd';
				} else if (row.state == '取消') {
					return 'qx';
				}

				if (row.ismt) {
					return 'mt';
				}
				return 'black';
			},
			getlist() {
				this.loading = true
				axios.post('/index.php/api/getOrderListtransportpage', {
					state: this.checkList,
					customertype: this.typeList
				}).then(rew => {

					this.tableData = rew.data.data;


					this.psy = rew.data.psy;
					this.loading = false
				})
			},
			handleSelectionChange(val) {

				this.multipleSelection = val;
			},
			plupdate () {
				this.updateordershow = true
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
						address: ((data.address).replace(/#/g, "")).replace(/\[/g,""),
						work: ((data.workplace).replace(/#/g, "")).replace(/\[/g,""),
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
						zprice: data.pay_cash.toString(),
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
						price: Number(data.balance).toFixed(2),
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
						residualindex: parseFloat(data.pay_weixin)>0?'微信付款：'+data.pay_weixin+'元':data.userotherinfo,
						yck: "预存款",
						price: Number(data.balance).toFixed(2),
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
						Memo2: '付款方式（' + (parseFloat(data.pay_cash)>0 ? '现金' : '月结') + '）',
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
			this.getlist()
		}
	})
</script>
</html>
