<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>创建用户订单</title>
	<script src="<?php echo base_url(); ?>res/js/win10.child.js"></script>
	<script src="<?php echo base_url(); ?>res/js/vue.js" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>res/js/axios.js" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>res/bootstrap/js/bootstrap.js" charset="utf-8"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>res/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>res/css/table_index.css">
</head>

<body>
<style>
	.ap {
		position:absolute;
		background: #f1f1f1;
		padding: 30px;
		top: 10%;
		left: 25%;
		z-index: 999;
	}

	.scale-up-center {
		-webkit-animation: scale-up-center .4s cubic-bezier(.39, .575, .565, 1.000) both;
		animation: scale-up-center .4s cubic-bezier(.39, .575, .565, 1.000) both
	}

	@-webkit-keyframes scale-up-center {
		0% {
			-webkit-transform: scale(.5);
			transform: scale(.5)
		}
		100% {
			-webkit-transform: scale(1);
			transform: scale(1)
		}
	}

	@keyframes scale-up-center {
		0% {
			-webkit-transform: scale(.5);
			transform: scale(.5)
		}
		100% {
			-webkit-transform: scale(1);
			transform: scale(1)
		}
	}

	.scale-out-center {
		-webkit-animation: scale-out-center .5s cubic-bezier(.55, .085, .68, .53) both;
		animation: scale-out-center .5s cubic-bezier(.55, .085, .68, .53) both
	}

	@-webkit-keyframes scale-out-center {
		0% {
			-webkit-transform: scale(1);
			transform: scale(1);
			opacity: 1
		}
		100% {
			-webkit-transform: scale(0);
			transform: scale(0);
			opacity: 1
		}
	}

	@keyframes scale-out-center {
		0% {
			-webkit-transform: scale(1);
			transform: scale(1);
			opacity: 1
		}
		100% {
			-webkit-transform: scale(0);
			transform: scale(0);
			opacity: 1
		}
	}

	.zz {
		position: fixed;
		width: 100%;
		height: 100%;
		background: rgba(0, 0, 0, 0.1);
		z-index: 99;
		top: 0;
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
		background: rgba(0,0,0,0.5);
		position: fixed;
		top: 0;
	}
	.dn {
		display: none;
	}

</style>
<div :class="sx?'ft':'bodyft'" style="padding: 20px" id="suapp">
	<v-table
		is-vertical-resize
		style="width:100%;"
		is-horizontal-resize
		:vertical-resize-offset='200'
		column-width-drag
		:columns="columns"
		:table-data="tableData"
		:row-click="rowClick"
		:column-cell-class-name="columnCellClass"
	></v-table>
	<!--	安排-->
	<div class="zz" v-if="ordershow"></div>
	<div :class="ordershow?'ap scale-up-center':'ap scale-out-center'" v-if="ordershow">
		<div class="row">

			<div :class="Number(order.isscan)? 'col-md-6':'col-md-12'">
				<h4 class="mb-3">订单信息</h4>
				<form class="needs-validation" novalidate>
					<ul class="list-group mb-3">
						<li class="list-group-item d-flex justify-content-between lh-condensed">
							<div>
								<h6 class="my-0">姓名: {{ order.main.name }}</h6>
							</div>

						</li>
						<li class="list-group-item d-flex justify-content-between lh-condensed">
							<div>
								<h6 class="my-0">电话: {{ order.main.telephone }}</h6>
							</div>
						</li>
						<li class="list-group-item d-flex justify-content-between lh-condensed">
							<div>
								<h6 class="my-0">地址: {{ order.mainaddress }}</h6>
							</div>
						</li>
						<li class="list-group-item d-flex justify-content-between bg-light">
							<div>
								<h6 class="my-0">商品名称: {{ order.goodsname }}</h6>
							</div>
						</li>
						<li class="list-group-item d-flex justify-content-between bg-light">
							<div>
								<h6 class="my-0">数量: {{ order.num }} &nbsp;&nbsp;&nbsp; 单价:{{ order.price }} &nbsp;&nbsp;&nbsp;
									小计: {{ order.num * order.price }}</h6>
							</div>
						</li>
						<li class="list-group-item d-flex justify-content-between bg-light">
							<div>
								<h6 class="my-0">内部备注: {{ order.main.ope_remarks }}</h6>
							</div>
						</li>
						<li class="list-group-item d-flex justify-content-between bg-light">
							<div>
								<h6 class="my-0">备注: {{ order.main.remarks }}</h6>
							</div>
						</li>
					</ul>

					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="country">配送方式 </label>
							<select v-model="distributionmode" class="custom-select d-block w-100" required>
								<option value="营业员安排">营业员安排</option>
								<option value="配送员接单">配送员接单</option>
							</select>
						</div>
						<div class="col-md-6 mb-3">
							<label for="country">配送员姓名 </label>
							<select v-model="deliveryman" class="custom-select d-block w-100" required>
								<option v-for="v in psy" :value="v.name">{{ v.name }}</option>
							</select>
						</div>
					</div>

					<button @click="submit" class="btn btn-light btn-lg btn-block" type="button">确认安排</button>
					<button v-if="!Number(order.isscan)" @click="close"
							class="btn btn-secondary btn-lg btn-block" type="button">返回
					</button>
				</form>
			</div>


			<div class="col-md-6" v-if="order.isscan != '0'">
				<h4 class="d-flex justify-content-between align-items-center mb-3">
					<span class="text-muted">编号</span>
					<span class="badge badge-secondary badge-pill">{{ num }}</span>
					<a href="#"><span  @click="goods=[]" class="badge badge-danger badge-pill">清空</span></a>
				</h4>
				<ul class="list-group mb-3">
					<input style="margin-bottom: 10px" type="tel" v-model="goodsnum" @keyup.enter="scanning"
						   class="form-control" placeholder="输入编号" rows="2">
					<li v-for="v in goods" class="list-group-item d-flex justify-content-between lh-condensed">
						<div>
							<h6 class="my-0">{{ v }}</h6>
						</div>
					</li>
				</ul>
				<button @click="close" class="btn btn-secondary btn-lg btn-block" type="button">返回</button>
			</div>
		</div>

	</div>


	<!-- 汇总 -->
	<div class="zz" v-if="hzshow"></div>
	<div :class="hzshow?'ap scale-up-center':'ap scale-out-center'" v-if="hzshow">
		<div class="row">

			<div :class="(Number(order.isscan)|| Number(order.isrecovery))? 'col-md-6':'col-md-12'">
				<h4 class="mb-3">订单信息</h4>
				<form class="needs-validation" novalidate>
					<ul class="list-group mb-2">
						<li class="list-group-item d-flex justify-content-between lh-condensed">
							<div>
								<h6 class="my-0">姓名: {{ order.main.name }}</h6>
							</div>

						</li>
						<li class="list-group-item d-flex justify-content-between lh-condensed">
							<div>
								<h6 class="my-0">电话: {{ order.main.telephone }}</h6>
							</div>
						</li>
						<li class="list-group-item d-flex justify-content-between lh-condensed">
							<div>
								<h6 class="my-0">地址: {{ order.mainaddress }}</h6>
							</div>
						</li>
						<li class="list-group-item d-flex justify-content-between bg-light">
							<div>
								<h6 class="my-0">商品名称: {{ order.goodsname }}</h6>
							</div>
						</li>
						<li class="list-group-item d-flex justify-content-between bg-light">
							<div>
								<h6 class="my-0">数量: {{ order.num }} &nbsp;&nbsp;&nbsp; 单价:{{ Number(order.price) }} &nbsp;&nbsp;&nbsp;
									小计: {{ order.num * order.price }}</h6>
							</div>
						</li>
						<li class="list-group-item d-flex justify-content-between bg-light">
							<div>
								<h6 class="my-0">内部备注: {{ order.main.ope_remarks }}</h6>
							</div>
						</li>
						<li class="list-group-item d-flex justify-content-between bg-light">
							<div>
								<h6 class="my-0">备注: {{ order.main.remarks }}</h6>
							</div>
						</li>
						<li class="list-group-item d-flex justify-content-between bg-light">
							<div>
								<h6 class="my-0">配送方式: {{ order.distributionmode }}</h6>
							</div>
						</li>
						<li class="list-group-item d-flex justify-content-between bg-light">
							<div>
								<h6 class="my-0">配送员姓名: {{ order.deliveryman }}</h6>
							</div>
						</li>

						<li  v-if="Number(order.pay_alipay)" class="list-group-item d-flex justify-content-between bg-light">
							<div>
								<h6 class="my-0">支付宝支付: {{ order.pay_alipay }}</h6>
							</div>
						</li>
						<li  v-if="Number(order.pay_arrears)"  class="list-group-item d-flex justify-content-between bg-light">
							<div>
								<h6 class="my-0">月结支付: {{ order.pay_arrears }}</h6>
							</div>
						</li>

						<li  v-if="Number(order.pay_balance)"  class="list-group-item d-flex justify-content-between bg-light">
							<div>
								<h6 class="my-0">余额支付: {{ order.pay_balance }}</h6>
							</div>
						</li>
						<li  v-if="Number(order.pay_cash)"  class="list-group-item d-flex justify-content-between bg-light">
							<div>
								<h6 class="my-0">现金支付: {{ order.pay_cash }}</h6>
							</div>
						</li>
						<li  v-if="Number(order.pay_weixin)"  class="list-group-item d-flex justify-content-between bg-light">
							<div>
								<h6 class="my-0">微信支付: {{ order.pay_weixin }}</h6>
							</div>
						</li>
					</ul>


					<button @click="hzsubmit" class="btn btn-light btn-lg btn-block" type="button">确认汇总</button>
					<button v-if="!Number(order.isscan)" @click="hzclose"
							class="btn btn-secondary btn-lg btn-block" type="button">返回
					</button>
				</form>
			</div>


			<div class="col-md-6" v-if="(Number(order.isscan) || Number(order.isrecovery))">
				<h4 class="d-flex justify-content-between align-items-center mb-3">
					<span class="text-muted">编号</span>
					<span class="badge badge-secondary badge-pill">{{ num }}</span>
					<a href="#"><span  @click="goods=[]" class="badge badge-danger badge-pill">清空</span></a>
				</h4>
				<ul class="list-group mb-3">
					<input style="margin-bottom: 10px" type="tel" v-model="goodsnum" @keyup.enter="scanning"
						   class="form-control" placeholder="输入编号" rows="2">
					<li v-for="v in goods" class="list-group-item d-flex justify-content-between lh-condensed">
						<div>
							<h6 class="my-0">{{ v }}</h6>
						</div>
					</li>
				</ul>
				<button @click="hzclose" class="btn btn-secondary btn-lg btn-block" type="button">返回</button>
			</div>
		</div>

	</div>

	<div v-if="successmsg" class="modal-content scale-in-center"
		 style="position: fixed;top: 39%;left: 50%;margin-left:-150px;width: 300px">
		<div class="modal-header">
			<h5 class="modal-title">操作成功</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="successmsg = false">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<p>{{ msg }}！</p>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal" @click="successmsg = false">关闭</button>
			<button type="button" class="btn btn-primary" @click="refreshs">更新订单列表</button>
		</div>
	</div>

	<!--	刷新-->
	<div style="padding: 20px 0">
		<button @click="shauxin()" class="btn-primary btn">刷新</button>
		<div class="form-check form-check-inline text-xl">
			<input class="form-check-input" type="checkbox" v-model="state1" id="state1" value="option1">
			<label class="form-check-label" for="state1">正常</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox"   v-model="state2"  id="state2" value="option2">
			<label class="form-check-label" for="state2">已安排</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox"  v-model="state3"  id="state3"  value="option2">
			<label class="form-check-label" for="state3">已汇总</label>
		</div>

	</div>
</div>

<!-- 引入组件库 -->
<script src="<?php echo base_url(); ?>res/js/umd.js"></script>
<script>
	new Vue({
		el: '#suapp',
		data: {
			order: '',
			msg: '',
			ordershow: false,
			state1: true,
			state2: true,
			state3: true,
			successmsg: false,
			hzshow: false,
			sx: false,
			tableData: [],
			goods: [],
			goodsnum: '',
			distributionmode: '营业员安排',
			deliveryman: '',
			psy: [],
			columns: [
				{
					field: 'addtime',
					title: '下单时间',
					width: 100,
					titleAlign: 'center',
					columnAlign: 'center',
					isResize: true
				},
				{
					field: 'mainmemberid',
					title: '会员号',
					width: 100,
					titleAlign: 'center',
					columnAlign: 'center',
					isResize: true
				},
				{
					field: 'mainname',
					title: '联系人',
					width: 100,
					titleAlign: 'center',
					columnAlign: 'center',
					isResize: true
				},
				{
					field: 'telephone',
					title: '联系电话',
					width: 120,
					titleAlign: 'center',
					columnAlign: 'center',
					isResize: true
				},
				{
					field: 'mainaddress',
					title: '地址',
					width: 200,
					titleAlign: 'center',
					columnAlign: 'center',
					isResize: true
				},
				{
					field: 'viplevel',
					title: '用户等级',
					width: 100,
					titleAlign: 'center',
					columnAlign: 'center',
					isResize: true
				},
				{
					field: 'customertype',
					title: '用户类型',
					width: 100,
					titleAlign: 'center',
					columnAlign: 'center',
					isResize: true
				},
				{
					field: 'goodsname',
					title: '商品',
					width: 100,
					titleAlign: 'center',
					columnAlign: 'center',
					isResize: true
				},
				{field: 'num', title: '数量', width: 100, titleAlign: 'center', columnAlign: 'center', isResize: true},
				{field: 'mode', title: '方式', width: 100, titleAlign: 'center', columnAlign: 'center', isResize: true},
				{
					field: 'distributionmode',
					title: '安排方式',
					width: 100,
					titleAlign: 'center',
					columnAlign: 'center',
					isResize: true
				},
				{
					field: 'deliveryman',
					title: '配送员',
					width: 100,
					titleAlign: 'center',
					columnAlign: 'center',
					isResize: true
				},
				{
					field: 'arrangetime',
					title: '安排时间',
					width: 100,
					titleAlign: 'center',
					columnAlign: 'center',
					isResize: true
				},
				{
					field: 'accepttime',
					title: '接收时间',
					width: 100,
					titleAlign: 'center',
					columnAlign: 'center',
					isResize: true
				},
				{
					field: 'arrivetime',
					title: '送达时间',
					width: 100,
					titleAlign: 'center',
					columnAlign: 'center',
					isResize: true
				},
				{
					field: 'feedbacktime',
					title: '汇总时间',
					width: 100,
					titleAlign: 'center',
					columnAlign: 'center',
					isResize: true
				},
				{field: 'state', title: '状态', width: 100, titleAlign: 'center', columnAlign: 'center', isResize: true},
			]
		},
		computed: {
			num() {
				return this.goods.length
			},
			zc () {
				return this.state1 ? '正常' : ''
			},
			yap () {
				return this.state2 ? '已安排' : ''
			},
			yhz () {
				return this.state3 ? '已汇总' : ''
			}
		},
		methods: {
			columnCellClass (rowIndex,columnName,rowData) {

				if (rowData.state === '已安排'){

					return this.yap ? 'yap' : 'yap dn';
				}
				if (rowData.state === '正常'){

					return this.zc ? '' : 'dn';
				}
				if (rowData.state === '已汇总'){
					return this.yhz? 'yhz' : 'dn';
				}

				if (columnName == 'arrangetime') {
					return 'time'
				}
			},
			rowClick(index, data) {
				if (data.state == '正常') {
					this.order = data;
					this.ordershow = true
				}

				if (data.state == '已安排') {
					this.order = data;
					this.hzshow = true
				}

			},
			scanning() {
				//去掉回车空格
				var num = (this.goodsnum.replace(/[\r\n]/g, "")).replace(/\ +/g, "");
				if (num) {
					if (!this.isHas(num)) {
						this.goods = this.goods.concat(num);
						this.goodsnum = ''
					} else {
						this.goodsnum = ''
					}
				}

			},
			close() {
				this.order = '';
				this.goodsnum = '';
				this.goods = []
				this.ordershow = false
			},
			hzclose() {
				this.order = '';
				this.goodsnum = '';
				this.goods = []
				this.hzshow = false
			},
			isHas(str) {
				for (i in this.goods) {
					if (this.goods[i] == str) {
						return true
					}
				}
				return false
			},
			submit () {
				axios.post('/index.php/api/creatorOrder',{
					order: this.order,
					goods: this.goods,
					distributionmode: this.distributionmode,
					deliveryman: this.deliveryman,
				}).then(rew=> {
					if (rew.data.code == 200) {
						let that = this
						this.close()
						this.getlist()
						setTimeout(function () {
							that.msg = '安排成功'
							that.successmsg = true
						}, 1000)
					} else {
						this.close()
						this.getlist()
						let that = this
						setTimeout(function () {
							that.msg = '安排失败'
							that.successmsg = true
						}, 1000)
					}
				})
			},
			hzsubmit () {
				axios.post('/index.php/api/hzOrder',{
					order: this.order,
					goods: this.goods,
					distributionmode: this.distributionmode,
					deliveryman: this.deliveryman,
				}).then(rew=> {
					if (rew.data.code == 200) {
						let that = this
						this.hzclose()
						this.getlist()
						setTimeout(function () {
							that.msg = '汇总成功'
							that.successmsg = true
						}, 1000)
					} else {
						this.hzclose()
						this.getlist()
						let that = this
						setTimeout(function () {
							that.msg = '汇总失败'
							that.successmsg = true
						}, 1000)
					}
				})
			},
			getlist () {
				this.sx = true
				axios.post('/index.php/api/getOrderList').then(rew => {
					this.tableData = rew.data.data;
					this.psy = rew.data.psy
					this.deliveryman = this.psy[0]['name']
					this.sx = false
				})
			},
			refreshs () {
				this.getlist()
				this.successmsg = false
			},
			shauxin () {
				this.getlist()
			}
		},
		created() {
			this.getlist()
		}

	})
</script>

</body>
</html>

