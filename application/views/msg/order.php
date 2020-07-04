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
	<link href="<?php echo base_url(); ?>/res/css/tailwind-ui.min.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>res/js/core.js"></script>
	<script src="<?php echo base_url(); ?>res/js/win10.child.js"></script>
	<link href="<?php echo base_url(); ?>res/css/sweetalert2.min.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>res/js/vuetable-2.js"></script>

	<link rel="stylesheet" href="<?php echo base_url(); ?>res/css/index.css">
	<!-- 引入组件库 -->
	<script src="<?php echo base_url(); ?>res/js/index.js"></script>
	<title></title>
</head>
<style>
	.el-date-editor .el-range-separator {
		padding: 0 5px;
		line-height: 32px;
		width: 9%;
		color: #303133;
	}

	.el-table {
		overflow: visible !important;
	}

	.cell {
		color: black !important;
	}

	.el-table .warning-row {
		background: pink;
	}

	.el-table .success-row {
		background: #f0f9eb;
	}
	.el-table td, .el-table th {
		padding: 1px;
	}
</style>
<body>
<div id="app" class="p-6">
	<p class="text-2xl mb-3">
		用户<?= $this->input->get('memberid') ?>- <?php echo $name; ?> 订单信息
	</p>

	<div class="block">
		<el-button>选择查询时间</el-button>
		<el-date-picker
				v-model="value2"
				type="daterange"
				align="right"
				unlink-panels
				range-separator="至"
				start-placeholder="开始日期"
				end-placeholder="结束日期"
				:picker-options="pickerOptions">
		</el-date-picker>

		<el-button @click="submit" type="primary">确认查询</el-button>
	</div>

	<el-table class="mt-3"
			  :data="list"
			  height="600"
			  border
			  :row-class-name="tableRowClassName"
			  style="width: 100%">
		<el-table-column type="expand">
			<template slot-scope="props">

				<table class="table-auto" style="width: 2500px">
					<thead>
					<tr>
						<th class=" border text-center ">方式</th>
						<th class=" border text-center ">分类</th>
						<th class=" border text-center ">类型</th>
						<th class=" border text-center ">品牌</th>
						<th class=" border text-center ">单位</th>
						<th class=" border text-center ">容量单位</th>
						<th class=" border text-center ">名称</th>
						<th class=" border text-center ">包装物</th>

						<th class=" border text-center">费用及详情</th>
						<th class=" border text-center">服务部门</th>
						<th class=" border text-center">配送员</th>
						<th class=" border text-center">时间</th>
						<th class=" border text-center">状态</th>
						<th class=" border text-center">取消原因</th>
					</tr>
					</thead>
					<tbody>

					<tr class="text-center" v-for="vi in props.row.sub">
						<td class="border ">
							{{vi.mode}}
						</td>
						<td class="border ">
							{{vi.cat}}
						</td>
						<td class="border ">
							{{vi.goodstype}}
						</td>
						<td class="border ">
							{{vi.brand}}
						</td>
						<td class="border ">
							{{vi.unit}}
						</td>
						<td class="border ">
							{{vi.capacityunit}}
						</td>
						<td class="border ">
							{{vi.goodsname}}
						</td>
						<td class="border ">
							{{vi.packingtype}}
						</td>

						<td class="border ">
							<span>净重: {{vi.suttle}} &nbsp;&nbsp; 数量:{{vi.num}} 市场价:{{vi.marketprice}} &nbsp;&nbsp; 交易单价:{{vi.price}} 小计金额:{{vi.total}}</span>
							<span v-if="Number(vi.pay_balance)">余额支付:{{vi.pay_balance}}</span>
							<span v-if="Number(vi.pay_cash)">现金支付:{{vi.pay_cash}}</span>
							<span v-if="Number(vi.pay_weixin)">微信支付:{{vi.pay_weixin}}</span>
							<span v-if="Number(vi.pay_alipay)">支付宝支付:{{vi.pay_alipay}}</span>
							<span v-if="Number(vi.pay_arrears)">月结支付:{{vi.pay_arrears}}</span>
						</td>
						<td class="border ">{{ vi.department}}</td>
						<td class="border ">{{ vi.deliveryman}}</td>
						<td class="border ">
							<p>安排时间:{{vi.arrangetime}} 接收时间:{{vi.accepttime}} 送达时间:{{vi.arrivetime}}
								汇总时间:{{vi.feedbacktime}}</p>
						</td>
						<td class="border ">{{ vi.stateshow}}</td>
						<td colspan="25" style="color: red;font-size: 15px">
								<span v-if="vi.stateshow == '取消'">
									部门: {{vi.revoke_department}}，取消人: {{vi.revokeer}}，取消备注: {{vi.revokeremarks}}，取消时间: {{vi.revoketime}}
								</span>
						</td>
					</tr>

					</tbody>
				</table>

			</template>
		</el-table-column>
		<el-table-column
				prop="addtime"
				label="交易时间"
				width="200">
		</el-table-column>
		<el-table-column
				prop="appointmenttime"
				label="预约时间"
				width="200"
		>
		</el-table-column>

		<el-table-column
				prop="customertype"
				label="用户类型">
		</el-table-column>

		<el-table-column
				prop="name"
				width="100"
				label="姓名">
		</el-table-column>

		<el-table-column
				prop="telephone"
				width="159"
				label="电话">
		</el-table-column>

		<el-table-column
				prop="address"
				label="地址"
				width="150">
		</el-table-column>

		<el-table-column
				prop="viplevel"
				label="用户等级">
		</el-table-column>

		<el-table-column
				prop="remarks"
				label="备注">
		</el-table-column>

		<el-table-column
				prop="attributiondepartment"
				label="归属部门">
		</el-table-column>

		<el-table-column
				prop="salesman"
				label="业务员"
		>
		</el-table-column>

		<el-table-column
				prop="department"
				label="业务部门"
				width="159"
		>
		</el-table-column>
		<el-table-column
				prop="registrar"
				label="预约员"
				sum-text>
		</el-table-column>


		<el-table-column
				prop="ordertotal"
				label="订单总额"
				sum-text>
		</el-table-column>

		<el-table-column
				prop="payment"
				label="支付方式">
		</el-table-column>
		<el-table-column
				prop="payserial"
				width="200"
				label="支付单据号">
		</el-table-column>

		<el-table-column
				prop="paytotal"
				label="支付总额">
		</el-table-column>


		<el-table-column
				prop="stateshow"
				label="状态">
		</el-table-column>


	</el-table>
</div>
</body>
<script>
	new Vue({
		el: '#app',
		data() {
			return {
				value: '',
				pickerOptions: {
					shortcuts: [{
						text: '最近一周',
						onClick(picker) {
							const end = new Date();
							const start = new Date();
							start.setTime(start.getTime() - 3600 * 1000 * 24 * 7);
							picker.$emit('pick', [start, end]);
						}
					}, {
						text: '最近一个月',
						onClick(picker) {
							const end = new Date();
							const start = new Date();
							start.setTime(start.getTime() - 3600 * 1000 * 24 * 30);
							picker.$emit('pick', [start, end]);
						}
					}, {
						text: '最近三个月',
						onClick(picker) {
							const end = new Date();
							const start = new Date();
							start.setTime(start.getTime() - 3600 * 1000 * 24 * 90);
							picker.$emit('pick', [start, end]);
						}
					}]
				},
				value1: '',
				value2: '',
				list: [],
				num: 0,
				total: 0
			}
		},
		methods: {
			tableRowClassName({row, rowIndex}) {
				if (row.state == 2) {
					return 'warning-row';
				}
				return '';
			},
			submit() {
				axios.post('/index.php/api/order', {
					time: this.value2,
					userid: '<?= $this->input->get('userid')?>'
				}).then(rew => {
					this.list = rew.data.list
					this.num = rew.data.num
					this.total = rew.data.total
				})
			},
			getSummaries(param) {
				const {columns, data} = param;
				const sums = [];
				columns.forEach((column, index) => {
					if (index === 0) {
						sums[index] = '合计';
						return;
					}
					const values = data.map(item => Number(item[column.property]));
					if (column.property == 'num' || column.property == 'total') {
						sums[index] = values.reduce((prev, curr) => {
							const value = Number(curr);
							if (!isNaN(value)) {
								return prev + curr;
							} else {
								return prev;
							}
						}, 0);
						sums[index];
					}
				});

				return sums;
			}
		},
		created() {
			const end = new Date();
			const start = new Date();
			start.setTime(start.getTime() - 3600 * 1000 * 24 * 90);
			this.value2 = [start, end]
		}
	})
</script>
</html>
