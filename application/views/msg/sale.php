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
	.el-table{
		overflow:visible !important;
	}
	.cell {
		color: black !important;
	}
	.el-table .warning-row {
		background: pink !important;
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
		用户<?= $this->input->get('memberid') ?>- <?php echo $name; ?> 销售信息
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
		<el-select clearable v-model="value" placeholder="全部商品">
			<el-option
					v-for="item in options"
					:key="item.name"
					:label="item.name"
					:value="item.name">
			</el-option>
		</el-select>
		<el-button @click="submit" type="primary">确认查询</el-button>
	</div>

	<el-table class="mt-3"
			  :data="list"
			  height="500"
			  border
			  show-summary
			  :summary-method="getSummaries"
			  :row-class-name="tableRowClassName"
			  style="width: 100%;color: black">
		<el-table-column
				prop="mode"
				label="方式"
				width="150">
		</el-table-column>
		<el-table-column
				prop="addtime"
				label="交易时间"
				width="220"
		>
		</el-table-column>

		<el-table-column
				prop="cat"
				width="100"
				label="商品分类">
		</el-table-column>

		<el-table-column
				prop="goodstype"
				width="100"
				label="商品类型">
		</el-table-column>

		<el-table-column
				prop="brand"
				label="品牌">
		</el-table-column>

		<el-table-column
				prop="goodsname"
				label="商品名称"
				width="300">
		</el-table-column>

		<el-table-column
				prop="unit"
				label="单位">
		</el-table-column>

		<el-table-column
				prop="capacityunit"
				label="容量单位">
		</el-table-column>

		<el-table-column
				prop="suttle"
				label="净重">
		</el-table-column>

		<el-table-column
				prop="marketprice"
				width="100"
				label="市场价"
				>
		</el-table-column>

		<el-table-column
				prop="price"
				width="100"
				label="交易价"
				>
		</el-table-column>
		<el-table-column
				prop="num"
				label="数量"
				sum-text>
		</el-table-column>


		<el-table-column
				prop="total"
				label="小计"
				width="100"
				sum-text>
		</el-table-column>

		<el-table-column
				prop="coupon"
				label="优惠券">
		</el-table-column>
		<el-table-column
				prop="payment"
				label="支付方式">
		</el-table-column>

		<el-table-column
				prop="memberid"
				label="会员号">
		</el-table-column>


		<el-table-column
				prop="attributiondepartment"
				label="归属部门">
		</el-table-column>


		<el-table-column
				prop="customertype"
				label="用户类型">
		</el-table-column>

		<el-table-column
				prop="salesman"
				label="业务员">
		</el-table-column>


		<el-table-column
				prop="department"
				width="150"
				label="业务部门">
		</el-table-column>


		<el-table-column
				prop="operator"
				label="操作员">
		</el-table-column>


		<el-table-column
				prop="state"
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
				options: <?= json_encode($_SESSION['initData']->Goods->info) ?>,
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
				if (row.state == '取消') {
					return 'warning-row';
				}
				return '';
			},
			submit() {
				axios.post('/index.php/api/sale', {
					time: this.value2,
					goods: this.value,
					userid: '<?= $this->input->get('userid')?>'
				}).then(rew => {
					this.list = rew.data.list
					this.num = rew.data.num
					this.total = rew.data.total
				})
			},
			getSummaries(param) {
				const { columns, data } = param;
				const sums = [];
				columns.forEach((column, index) => {
					if (index === 0) {
						sums[index] = '合计';
						return;
					}
					const values = data.map(item => Number(item[column.property]));
					if (column.property == 'num' ||column.property =='total' ) {
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
			this.value2 = [start,end]
		}
	})
</script>
</html>
