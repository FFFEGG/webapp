<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>创建用户订单</title>
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
	.msg {
		background: rgba(0, 0, 0, 0.8);
		padding: 20px 30px;
		color: white;
		border-radius: 5px;
		position: fixed;
		top: 49%;
		left: 48%;
	}

	.scale-in-center {
		-webkit-animation: scale-in-center .2s cubic-bezier(.25, .46, .45, .94) both;
		animation: scale-in-center .2s cubic-bezier(.25, .46, .45, .94) both
	}

	@-webkit-keyframes scale-in-center {
		0% {
			-webkit-transform: scale(0);
			transform: scale(0);
			opacity: 1
		}
		100% {
			-webkit-transform: scale(1);
			transform: scale(1);
			opacity: 1
		}
	}

	@keyframes scale-in-center {
		0% {
			-webkit-transform: scale(0);
			transform: scale(0);
			opacity: 1
		}
		100% {
			-webkit-transform: scale(1);
			transform: scale(1);
			opacity: 1
		}
	}

	.input-group-text {
		width: 122px;
	}

	.nav-tabs .nav-link.active {
		background: #e9ecef;
		cursor: pointer;
		border: none;
	}

	.nav-tabs {
		border-bottom: 0px;
		background: #f2f2f2;
	}

	.t-price {
		color: #0C0C0C;

		text-align: right;
		letter-spacing: 2px;
		font-weight: normal;
		font-size: 15px;
	}
</style>
<body>
<div style="padding: 20px" id="app">
	<div class="form-inline">
		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text">搜索用户卡号</div>
			</div>
			<input type="text" v-model="cardid" v-on:keyup.enter="submit" class="form-control" placeholder="会员卡号">
		</div>
		<button type="button" @click="search" class="btn btn-primary mb-2">搜索</button>
		<a v-if="UserInfo.name" class="ml-5" style="color: blue;cursor: pointer" @click="findusers">用户查询</a>
	</div>
	<div class="form-inline">
		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text">姓名</div>
			</div>
			<input type="text" v-model="UserInfo.name" disabled class="form-control" placeholder="姓名">
		</div>
		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text">电话</div>
			</div>
			<input minlength="11" maxlength="11" disabled type="text" v-model="UserInfo.telephone" class="form-control"
				   placeholder="电话">
		</div>
		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text">类型</div>
			</div>
			<input disabled type="text" v-model="UserInfo.customertype" class="form-control" placeholder="类型">
		</div>
		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text">余额</div>
			</div>
			<input disabled type="text" style="color: red" v-model="UserInfo.balance" class="form-control"
				   placeholder="余额">
		</div>

		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text">状态</div>
			</div>
			<input disabled type="text" v-model="UserInfo.stateshow" class="form-control" placeholder="状态">
		</div>
		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text">单位</div>
			</div>
			<input disabled type="text" v-model="UserInfo.workplace" class="form-control" placeholder="单位">
		</div>
		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text">信用额度</div>
			</div>
			<input disabled type="text" style="color: red" v-model="UserInfo.quota" class="form-control"
				   placeholder="信用额度">
		</div>

		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text">开户时间</div>
			</div>
			<input disabled type="text" v-model="UserInfo.addtime" class="form-control" placeholder="开户时间">
		</div>


		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text">住所类型</div>
			</div>
			<input disabled type="text" v-model="UserInfo.housingproperty" class="form-control" placeholder="住所类型">
		</div>


		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text">用户等级</div>
			</div>
			<input disabled type="text" v-model="UserInfo.viplevel" class="form-control" placeholder="用户等级">
		</div>


		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text">归属部门</div>
			</div>
			<input disabled type="text" v-model="UserInfo.attributiondepartment" class="form-control"
				   placeholder="归属部门">
		</div>

		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text">业务员</div>
			</div>
			<input disabled type="text" v-model="UserInfo.salesman" class="form-control" placeholder="业务员">
		</div>
		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text">预约上门时间</div>
			</div>
			<input v-model="yysmtime" type="datetime-local" class="form-control" placeholder="预约上门时间">
			<input v-model="yysmtime" type="hidden" id="datetimes" value="<?php echo date('Y/m/d H:i:s', time()) ?>">
		</div>

		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text">支付方式</div>
			</div>
			<div class="form-control">
				<div class="form-check form-check-inline" style="margin-right: 3px;" @change="paymentchange">
					<input class="form-check-input" type="radio" name="payment" id="inlineRadio1" value="余额支付"
						   v-model='payment'>
					<label class="form-check-label" for="inlineRadio1">余额支付</label>
					<input class="form-check-input" type="radio" name="payment" id="inlineRadio2" value="现金支付"
						   v-model='payment'>
					<label class="form-check-label" for="inlineRadio2">现金支付</label>
				</div>
			</div>
		</div>
<!--		<div class="input-group mb-2 mr-sm-2">-->
<!--			<div class="input-group-prepend">-->
<!--				<div class="input-group-text">配送门店</div>-->
<!--			</div>-->
<!--			<select class="custom-select" v-model="departmentname" @change="orderlist = []">-->
<!--				<option v-for="v in Department" v-if="v.type=='业务门店'" :value="v.id">{{ v.name }}</option>-->
<!--			</select>-->
<!--			&nbsp;&nbsp;-->
<!--			<div class="form-group form-check">-->
<!--				<input type="checkbox" v-model="is_on" class="form-check-input" id="exampleCheck1">-->
<!--				<label class="form-check-label" for="exampleCheck1">该地址长期配送门店</label>-->
<!--			</div>-->
<!--		</div>-->
	</div>
	<div class="input-group mb-2 mr-sm-2">
		<div class="input-group-prepend">
			<div class="input-group-text">备注</div>
		</div>
		<input type="text" v-model="UserInforemarks" class="form-control" placeholder="备注">
	</div>
	<div class="input-group mb-2 mr-sm-2">
		<div class="input-group-prepend">
			<div class="input-group-text">内部备注</div>
		</div>
		<input type="text" v-model="UserInfo.ope_remarks" class="form-control" placeholder="备注">
	</div>
<!--	<div class="form-inline">-->
<!--		<div class="input-group col-md-7 p-0">-->
<!--			<div class="input-group-prepend">-->
<!--				<div class="input-group-text">地址</div>-->
<!--			</div>-->
<!--			<select class="custom-select" v-on:change="changeadd">-->
<!--				<template v-for="(v,key) in addresses" :value="key">-->
<!--					<option v-if="v.defaultoption == '1'" selected>{{ v.city }}{{ v.area }}{{ v.town }}{{ v.street }}{{-->
<!--						v.housenumber }}{{ v.address }} ({{v.remarks}})-->
<!--					</option>-->
<!--					<option v-else>{{ v.city }}{{ v.area }}{{ v.town }}{{ v.street }}{{-->
<!--						v.housenumber }}{{ v.address }} ({{v.remarks}})-->
<!--					</option>-->
<!--				</template>-->
<!---->
<!--				<input type="text" v-model="addtel">-->
<!--			</select>-->
<!--		</div>-->
<!--		<button @click="updateadd" class="btn btn-primary ml-2"> 修改地址</button>-->
<!--	</div>-->

	<!--订单业务-->


	<div class="row pt-2">
		<div class="col-6 ">
			<nav>
				<div class="nav nav-tabs" id="nav-tab" role="tablist">
					<a @click="tab(0)" :class="active==0?'nav-item nav-link  active':'nav-item nav-link '"
					   id="nav-home-tab" data-toggle="tab" role="tab" aria-controls="nav-home"
					   aria-selected="true">商品直售</a>
				</div>
			</nav>
			<div class="tab-content" id="nav-tabContent">
				<div :class="active==0?'tab-pane fade active show':'tab-pane fade'" id="nav-home" role="tabpanel"
					 aria-labelledby="nav-home-tab">

					<table v-if="!catsshow" class="table">
						<tbody>
						<tr>
							<th scope="row">品牌</th>
							<td>
								<div v-for="v in GoodsBrand" class="form-check form-check-inline"
								>
									<input v-model="GoodsBrandId" :id="'goodsbrand' + v.id" class="form-check-input"
										   type="radio" name="goodsbrand" :value="v.id">
									<label class="form-check-label" :for="'goodsbrand' + v.id">{{ v.name }}</label>
								</div>
							</td>
							<td>
								<button @click="clearGoodsBrandId" class="btn-dark">重置</button>
							</td>
						</tr>
						</tbody>
					</table>
					<table class="table table-bordered">
						<thead>
						<tr>
							<th scope="col">商品名</th>
							<th scope="col">商品单价</th>
							<th scope="col">支付方式</th>
							<th scope="col">操作</th>
						</tr>
						</thead>
						<tbody>
						<tr v-for="v in Goods" v-if="v.stocktype == '销售品'">
							<th scope="row">{{v.name}}</th>
							<td>{{ Math.round(v.price * 100) / 100 }}</td>
							<td>{{v.payment?v.payment:payment}}</td>
							<td>
								<button @click="addcar(v)" class="btn btn-dark">添加购物车</button>
							</td>
						</tr>
						</tbody>
					</table>
				</div>
				<div :class="active==1?'tab-pane fade active show':'tab-pane fade'" id="nav-profile" role="tabpanel"
					 aria-labelledby="nav-profile-tab">
					<table class="table table-bordered">
						<thead>
						<tr>
							<th scope="col">商品名</th>
							<th scope="col">商品单价</th>
							<th scope="col">支付方式</th>
							<th scope="col">数量</th>
							<th scope="col">支付状态</th>
							<th scope="col">办理方式</th>
							<th scope="col">优惠方式</th>
							<th scope="col">操作</th>
						</tr>
						</thead>
						<tbody>
						<tr v-for="v in KCTHLIST">
							<th scope="row">{{v.goods.name}}</th>
							<td>{{Math.round(v.price * 100) / 100}}</td>
							<td>{{ payment }}</td>
							<td>{{ v.num }}</td>
							<td>{{ v.paymentstatus }}</td>
							<td>{{ v.mode }}</td>
							<td>{{ v.salestype }}</td>
							<td>
								<button @click="addcarth(v)" class="btn btn-dark">添加购物车</button>
							</td>
						</tr>

						</tbody>
					</table>
				</div>
				<div :class="active==2?'tab-pane fade active show':'tab-pane fade'" id="nav-contact" role="tabpanel"
					 aria-labelledby="nav-contact-tab">
					<input type="text" placeholder="搜索" class="col-12 mb-2" v-model="searchwords">
					<table class="table table-bordered">
						<thead>
						<tr>
							<th scope="col">套餐名称</th>
							<th scope="col">小计</th>
							<th scope="col">支付方式</th>
							<th scope="col">操作</th>
						</tr>
						</thead>
						<tbody v-for="v in cplan" style="margin-bottom: 10px">
						<tr>
							<th scope="row">{{v.name}}</th>
							<td>{{v.price}}</td>
							<td>{{ payment }}</td>

							<td>
								<button @click="addcarplan(v)" class="btn btn-dark">添加购物车</button>
							</td>
						</tr>
						<tr>
							<th colspan="4">
								<div v-for="vi in v.list" class="row" style="font-weight: normal">
									<div class="col-4">{{ vi.goods.name }}</div>
									<div class="col-4">数量 {{ vi.num }}</div>
									<div class="col-4">单价 {{Math.round(vi.price * 100) / 100 }}</div>
								</div>
							</th>

						</tr>
						</tbody>
					</table>
				</div>
				<div :class="active==3?'tab-pane fade active show':'tab-pane fade'" id="nav-contact" role="tabpanel">
					<table class="table table-bordered">
						<thead>
						<tr>
							<th scope="col">商品</th>
							<th scope="col">办理方式</th>
							<th scope="col">办理时间</th>
							<th scope="col">最后计费时间</th>
							<th scope="col">收费模式</th>
							<th scope="col">办理单价</th>
						</tr>
						</thead>
						<tbody v-for="(v,index) in chargeFK" :style="(index % 2 == 0)?'background:#ccc':''">

						<tr>
							<th>{{ v.name}}</th>
							<th>{{ v.mode }}</th>
							<td>{{ v.addtime.slice(0,10) }}</td>
							<td>{{ v.billingtime.slice(0,10) }}</td>
							<td>{{ v.billingmode }}</td>
							<td>{{ Math.round(v.price * 100) / 100 }}</td>
						</tr>
						<tr>
							<th colspan="6">
								<div v-for="vi in v.chargelist" class="row" style="font-weight: normal">
									<div class="col-2">编号: {{ vi.id }}</div>
									<div class="col-3">收费项目: {{ vi.project }}</div>
									<div class="col-3">收费金额: {{ Math.round(vi.total * 100) / 100 }}</div>
									<div class="col-4">备注: {{ vi.remarks }}</div>
								</div>
							</th>
						</tr>
						</tbody>
					</table>
				</div>
				<div :class="active==4?'tab-pane fade active show':'tab-pane fade'" id="nav-contact" role="tabpanel">
					<div class="row p-3">
						<table class="table table-bordered">
							<thead>
							<tr>
								<th scope="col">
									<div class="form-group">
										<label for="exampleFormControlSelect1">模式</label>
										<div class="form-control">
											<div class="form-check form-check-inline"
												 v-for="v in initData.RepairType.info">
												<input v-if="v.state == 1" class="form-check-input" :id="'mdoe_'+v.id"
													   v-model="yymodel"
													   type="radio" name="mode" :value="v.name">
												<label class="form-check-label" :for="'mdoe_'+v.id">{{v.name}}</label>
											</div>
										</div>
									</div>
								</th>
								<th scope="col">
									<div class="form-group">
										<label for="exampleFormControlSelect1">对象</label>
										<select class="form-control" id="duixiang" v-model="obj">
											<option v-for="v in initData.RepairObject.info">{{ v.name }}</option>
										</select>
									</div>
								</th>

							</tr>
							</thead>
							<tbody>
							<tr>
								<th colspan="2">
									<div class="form-group">
										<label for="exampleFormControlSelect1">备注</label>
										<input v-model="yyremarks" class="form-control" type="text">
									</div>
								</th>
							</tr>
							<tr>
								<th colspan="2" style="text-align: right">
									<button @click="yysubmit" class="btn btn-primary">确认维修下单</button>
								</th>
							</tr>
							</tbody>
						</table>
					</div>
				</div>

				<div :class="active==5?'tab-pane fade active show':'tab-pane fade'" id="nav-contact" role="tabpanel">
					<div class="row p-3">
						<div class="row">
							<div class="input-group mb-3 col">
								<div class="input-group-prepend">
									<label class="input-group-text" for="inputGroupSelect01">方式</label>
								</div>
								<select class="custom-select" v-model="mode" id="inputGroupSelect01">
									<option value="钢瓶修漏">钢瓶修漏</option>
									<option value="安全检查">安全检查</option>
									<option value="清洗饮水机">清洗饮水机</option>
									<option value="上门收瓶">上门收瓶</option>
									<option value="上门收桶">上门收桶</option>
								</select>
							</div>

							<div class="input-group mb-3 col">
								<div class="input-group-prepend">
									<label class="input-group-text" for="inputGroupSelect01">对象</label>
								</div>
								<select class="custom-select" v-model="object" id="inputGroupSelect01">
									<option value="钢瓶">钢瓶</option>
									<option value="用气环境">用气环境</option>
									<option value="饮水机">饮水机</option>
								</select>
							</div>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text" for="inputGroupSelect01">备注</label>
							</div>
							<input v-model="appointmentremarks" type="text" class="form-control" maxlength="25">
						</div>
						<button @click="mdsubmit" class="btn btn-primary">确认门店业务</button>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div>
				<div class="alert alert-secondary" role="alert" style="padding: 0.48rem 1.25rem;">
					订单列表
				</div>
				<table class="table table-bordered">
					<thead>
					<tr>

						<th scope="col">商品名称</th>
						<th scope="col">数量</th>
						<th scope="col">小计</th>
						<th scope="col">支付方式</th>
						<th scope="col">模式</th>
						<th scope="col">操作</th>
					</tr>
					</thead>
					<tbody>
					<tr v-for="(v,key) in orderlist" v-if="v.goodstype != ''">

						<td>{{ v.goodsname }}</td>
						<td>
							<input v-if="v.mode != '库存提货'" type="number" @keyup="changenum(key)" max="99" min="1"
								   maxlength="2" v-model="v.num" style="width: 50px">
							<span v-else>{{ v.num}}</span>
						</td>
						<td>{{ v.price * v.num }}</td>
						<td>{{ v.paymentshow }} <span @click="jiesuo(key)" style="color: blue;cursor: pointer"
													  v-if="v.paymentshow == '月结支付'">解锁</span></td>
						<td>{{ v.mode }}</td>
						<td>
							<button @click="delorderlist(key)" class="btn-danger">删除</button>
						</td>
					</tr>
					<tr v-for="(v,key) in orderlist" v-if="v.goodstype == ''">

						<td>{{ v.goodsname }}_编号({{v.goodsid}})</td>
						<td>
							<input v-if="v.mode != '库存提货'" type="number" @keyup="changenum(key)" max="99" min="1"
								   maxlength="2" v-model="v.num" style="width: 50px">
							<span v-else>{{ v.num}}</span>
						</td>
						<td>{{ v.price * v.num }}</td>
						<td>{{ v.paymentshow }} <span @click="jiesuo(key)" style="color: blue;cursor: pointer"
													  v-if="v.paymentshow == '月结支付'">解锁</span></td>
						<td>{{ v.mode }}</td>
						<td>
							<button @click="delorderlist(key)" class="btn-danger">删除</button>
						</td>
					</tr>
					</tbody>
				</table>
			</div>
			<div class="row">
				<div class="col-12" v-if="orderlist.length">
					<span style="color: red;font-weight: bold;font-size: 16px" class=""><span
								class="t-price">总金额:</span><span
								class="font-italic">￥{{ zprice.zprice }}</span></span>
					<span style="color: red;font-weight: bold;font-size: 16px" class=""><span
								class="t-price">现金:</span><span class="font-italic">￥{{ zprice.xj }}</span></span>
					<span v-if="zprice.kk - UserInfo.balance <= 0" style="color: red;font-weight: bold;font-size: 16px"
						  class=""><span class="t-price">卡扣:</span><span class="font-italic">￥{{ zprice.kk }}</span>
					</span>
					<span v-else style="color: red;font-weight: bold;font-size: 16px" class=""><span
								class="t-price">卡扣:</span><span class="font-italic">￥{{ zprice.kk }}(包含信用额度：{{ zprice.kk - UserInfo.balance }})</span>
					</span>
					<span style="color: red;font-weight: bold;font-size: 16px" class=""><span
								class="t-price">下单后余额:</span><span
								class="font-italic">￥{{ UserInfo.balance - zprice.kk  }}</span></span>
				</div>

			</div>
			<div class="col-12" style="text-align: right">

				<button @click="qrxd" class="btn btn-primary">确认下单</button>
			</div>
		</div>
	</div>


	<span v-if="msgshow" class="msg scale-in-center">{{ altermsg }}</span>
	<!--	<span v-if="successmsg" class="msg scale-in-center">下单成功</span>-->

	<div v-if="successmsg" class="modal-content scale-in-center"
		 style="position: fixed;top: 39%;left: 50%;margin-left:-250px;width: 500px">
		<div class="modal-header">
			<h5 class="modal-title">操作成功</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="successmsg = false">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<p>下单成功！</p>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal" @click="successmsg = false">关闭</button>
			<button type="button" class="btn btn-primary" @click="saveclose">更新用户信息</button>
		</div>
	</div>

</div>

<script>
	new Vue({
		el: '#app',
		watch: {
			zt(val) {
				if (val) {
					for (let i = 0; i < this.orderlist.length; i++) {
						if (this.orderlist[i].mode == '商品销售') {
							this.orderlist[i].price = this.orderlist[i].priceshow - this.orderlist[i].selfmentiondiscount
						}
					}
				} else {
					for (let i = 0; i < this.orderlist.length; i++) {
						if (this.orderlist[i].mode == '商品销售') {
							this.orderlist[i].price = this.orderlist[i].priceshow
						}
					}
				}
			},
			orderlist(val) {
				if (val.length == 0) {
					this.zt = false
				}
			}
		},
		computed: {
			YYYIMT() {
				return this.yysmtime.replace('T', ' ')
			},
			KCTHLIST() {
				const goods = JSON.parse(JSON.stringify(this.warehouse))
				for (i in goods) {
					for (j in this.GoodsList) {
						if (this.GoodsList[j]['id'] == goods[i]['goodsid']) {
							if (goods[i]['salestype'] == '市场价格优惠') {
								goods[i]['price'] = Number(this.GoodsList[j]['price']) - Number(goods[i]['price'])
							}
							break
						}
					}
				}
				return goods
			},
			today() {
				var day2 = new Date();
				day2.setTime(day2.getTime());
				var s2 = day2.getFullYear() + "-" + ((day2.getMonth() + 1) > 10 ? (day2.getMonth() + 1) : ('0' + (day2.getMonth() + 1))) + "-" + (day2.getDate() > 10 ? day2.getDate() : ('0' + day2.getDate())) + " " + day2.getHours() + ":" + day2.getMinutes() + ":" + day2.getSeconds();
				return s2
			},
			Goods() {
				const goods = JSON.parse(JSON.stringify(this.GoodsList));
				if (goods.length > 0) {
					//优惠信息
					var md = this.initData.GoodsSalesPromotion.info;
					var mdgoods = [];

					for (var s in md) {
						if (((md[s].strattime).substr(0, 19)) <= this.today && ((md[s].endtime).substr(0, 19)) >= this.today) {
							mdgoods = mdgoods.concat(md[s])
						}
					}

					var yhgoods = this.YhGoods;
					//筛选分类
					if (this.GoodsCatId != 0) {
						for (var i = goods.length - 1; i >= 0; i--) {
							if (goods[i]['catid'] != this.GoodsCatId) {
								goods.splice(i, 1)
							}
						}
					}
					//筛选商品类型
					if (this.GoodsTypeId != 0) {
						for (var i = goods.length - 1; i >= 0; i--) {
							if (goods[i]['goodstypeid'] != this.GoodsTypeId) {
								goods.splice(i, 1)
							}
						}
					}
					//筛选品牌
					if (this.GoodsBrandId != 0) {
						for (var i = goods.length - 1; i >= 0; i--) {
							if (goods[i]['brandid'] != this.GoodsBrandId) {
								goods.splice(i, 1)
							}
						}
					}

					for (i in goods) {
						var mdprice = 0;
						var useryhprice = 0;
						var mdpayment = '';
						var userpayment = '';

						for (j in mdgoods) {
							if (this.departmentname == mdgoods[j]['departmentid'] && goods[i]['id'] == mdgoods[j]['goodsid']) {

								if (mdgoods[j]['salestype'] == '市场价格优惠') {
									mdprice = goods[i]['price'] - mdgoods[j]['price']
								} else {
									mdprice = mdgoods[j]['price']
								}
								break
							}
						}
						//
						for (k in yhgoods) {
							if (goods[i]['id'] == yhgoods[k]['goodsid']) {

								userpayment = yhgoods[k]['payment'];
								if (yhgoods[k]['salestype'] == '市场价格优惠') {
									useryhprice = goods[i]['price'] - yhgoods[k]['price']
								} else {
									useryhprice = yhgoods[k]['price']
								}
								break
							}

						}
						mdprice = mdprice == 0 ? goods[i]['price'] : mdprice;
						useryhprice = useryhprice == 0 ? goods[i]['price'] : useryhprice;


						if (Number(mdprice) > Number(useryhprice)) {
							goods[i]['price'] = useryhprice;
							goods[i]['payment'] = userpayment
						}
						//
						if (Number(mdprice) < Number(useryhprice)) {
							goods[i]['price'] = mdprice;
						}

						if (Number(mdprice) == Number(useryhprice)) {
							goods[i]['price'] = mdprice;
						}
					}
					return goods
				} else {
					return []
				}
			},
			zprice() {
				var zprice = 0;
				var mon = 0;
				var cash = 0;
				var buckle = 0;
				var kk = 0;
				var xj = 0;
				for (i in this.orderlist) {
					if (this.orderlist[i]['paymentshow'] != '已支付') {
						zprice += this.orderlist[i]['num'] * this.orderlist[i]['price'];
					}
					if (this.orderlist[i]['payment'] == '月结支付' && this.orderlist[i]['paymentshow'] != '已支付') {
						mon += this.orderlist[i]['num'] * this.orderlist[i]['price']
					}
					if (this.orderlist[i]['payment'] == '余额支付' && this.orderlist[i]['paymentshow'] != '已支付') {
						buckle += this.orderlist[i]['num'] * this.orderlist[i]['price']
					}
					if (this.orderlist[i]['payment'] == '现金支付' && this.orderlist[i]['paymentshow'] != '已支付') {
						cash += this.orderlist[i]['num'] * this.orderlist[i]['price']
					}
				}
				//卡扣 = 月结 + 余额
				//现金 =
				if (mon >= this.UserInfo.balance) {
					kk = mon;
					xj = buckle + cash
				} else {
					kk = (mon + buckle - this.UserInfo.balance) >= 0 ? this.UserInfo.balance : (mon + buckle);
					xj = (mon + buckle - this.UserInfo.balance) >= 0 ? (mon + buckle - this.UserInfo.balance + cash) : cash
				}

				return {
					zprice: Number(zprice).toFixed(2),
					mon: Number(mon).toFixed(2),
					cash: Number(cash).toFixed(2),
					buckle: Number(buckle).toFixed(2),
					xj: Number(xj).toFixed(2),
					kk: Number(kk).toFixed(2)
				}

			},
			cplan() {
				if (this.searchwords == '') {
					return this.plan
				}
				let arr = [];
				for (i in this.plan) {
					if (JSON.stringify(this.plan[i]).indexOf(this.searchwords) != -1) {
						arr = arr.concat(this.plan[i])
					}
				}
				return arr
			},
		},
		data: {
			yysmtime: '',
			UserInforemarks: '',
			zt: false,
			searchwords: '',
			obj: '',
			yyremarks: '',
			appointmentremarks: '',
			catsshow: false,
			yymodel: '维修',
			initData: [],
			GoodsCat: [],
			kuth: [],
			addtel: '',
			mode: '钢瓶修漏',
			object: '钢瓶',
			repairdepartment: '',
			GoodsType: [],
			GoodsBrand: [],
			Department: [],
			warehouse: [],
			addresses: [],
			charge: [],
			chargeFK: [],
			address: '',
			GoodsList: [],
			plan: [],
			orderlist: [],
			UserInfo: {
				name: ''
			},
			cardid: '',
			GoodsCatId: 0,
			GoodsTypeId: 0,
			GoodsBrandId: 0,
			YhGoods: [],
			altermsg: '',
			msgshow: false,
			successmsg: false,
			payment: '余额支付',
			appointmenttime: '',
			departmentname: '',
			active: 0,
			is_on: false,
			addressid: 0,
			addresskey: 0
		},
		methods: {
			changenum(k) {
				let str = '' + this.orderlist[k].num;
				if (str.indexOf('.') != -1) {
					let arr = str.split('');
					arr.splice(arr.length - 1);
					let str2 = arr.join('');
					this.orderlist[k].num = +str2;
				}

				this.orderlist[k].num = parseInt(this.orderlist[k].num)
				if (isNaN(this.orderlist[k].num)) {
					this.orderlist[k].num = 1
				}
				if (this.orderlist[k].num > 99) {
					this.orderlist[k].num = 99
				}

			},
			mdsubmit() {
				if (!this.UserInfo.memberid) {
					swal('请输入卡号')
					return false
				}
				var appointmenttime = document.getElementById('datetimes').value;

				if (!appointmenttime) {
					swal('请选择预约时间')
					return false
				}

				axios.post('/index.php/api/AppointmentUserDepartmentRepair', {
					user: this.UserInfo,
					address: this.addresses[this.addresskey],
					appointmentremarks: this.appointmentremarks,
					attributiondepartment: this.UserInfo.attributiondepartment,
					appointmenttime: this.YYYIMT,
					repairdepartment: this.departmentname,
					mode: this.mode,
					object: this.object,
				}).then(rew => {
					if (rew.data.code == 200) {
						swal('预约成功')
						this.user = ''
						this.memberid = ''
						this.address = []
					}
				})
			},
			checkzt() {
				if (this.zt) {
					for (let i = 0; i < this.orderlist.length; i++) {
						if (this.orderlist[i].mode == '商品销售') {
							this.orderlist[i].price = this.orderlist[i].priceshow - this.orderlist[i].selfmentiondiscount
						}
					}
				} else {
					for (let i = 0; i < this.orderlist.length; i++) {
						if (this.orderlist[i].mode == '商品销售') {
							this.orderlist[i].price = this.orderlist[i].priceshow
						}
					}
				}
			},
			findusers() {
				Win10_child.openUrl('/index.php/users/info?cardid=' + this.cardid, '用户查询')
			},
			saveclose() {
				this.submit();
				this.successmsg = false;
			},
			tab(active) {
				this.active = active
			},
			search() {
				this.is_on = false;
				if (!this.cardid) {
					this.myalert('请填写卡号', 1500);
					return false
				} else {
					this.submit()
				}
			},
			submit() {
				this.is_on = false;
				if (!this.cardid) {
					this.myalert('请填写卡号', 1500);
					return false
				} else {
					axios.post('/index.php/api/getUserInfos', {
						cardid: this.cardid
					}).then(rew => {
						this.orderlist = [];
						if (!rew.data.addresses) {
							window.location.reload()
						}
						if (rew.data.code == 400) {
							this.myalert('没有找有用户', 1500);
							this.cardid = '';
							this.UserInfo = {};
							this.addresses = [];
							return false
						}
						this.UserInfo = rew.data.data;

						this.addresses = rew.data.addresses;
						this.charge = rew.data.charge;
						this.chargeFK = rew.data.chargeFK;
						for (let i = 0; i < this.addresses.length; i++) {
							if (this.addresses[i]['defaultoption'] == 1) {
								this.address = this.addresses[i]['city'] + this.addresses[i]['area'] + this.addresses[i]['town'] + this.addresses[i]['street'] + this.addresses[i]['housenumber'] + this.addresses[i]['address'];
								this.addtel = this.addresses[i].telephone;
								this.UserInforemarks = this.UserInfo.remarks + this.addresses[i].remarks;
								this.UserInfo.ope_remarks =  this.addresses[i].ope_remarks;
							}
						}
						this.departmentname = this.addresses[0]['departmentid'];
						this.warehouse = rew.data.warehouse;
						this.YhGoods = rew.data.promotion;

						if (rew.data.info_remind) {
							//swal(rew.data.info_remind)
							if (rew.data.info_remind.length) {
								var srt = ''
								for (let i = 0; i < rew.data.info_remind.length; i++) {
									srt += '<div style="text-align: left">'
									srt += '<p>' + rew.data.info_remind[i] + '</p>';
									srt += '</div>'
								}
								swal({
									title: '',
									html: srt,
								})
							}

						}
					})
				}
			},
			refre_submit() {
				this.is_on = false;
				if (!this.cardid) {
					this.myalert('请填写卡号', 1500);
					return false
				} else {
					axios.post('/index.php/api/getUserInfos', {
						cardid: this.cardid
					}).then(rew => {
						this.orderlist = [];
						if (rew.data.code == 400) {
							this.myalert('没有找有用户', 1500);
							this.cardid = '';
							this.UserInfo = {};
							this.addresses = [];
							return false
						}
						this.UserInfo.balance = rew.data.data.balance;
						this.addresses = rew.data.addresses;
						this.charge = rew.data.charge;
						this.chargeFK = rew.data.chargeFK;
						for (let i = 0; i < this.addresses.length; i++) {
							if (this.addresses[i]['defaultoption'] == 1) {
								this.address = this.addresses[i]['city'] + this.addresses[i]['area'] + this.addresses[i]['town'] + this.addresses[i]['street'] + this.addresses[i]['housenumber'] + this.addresses[i]['address'];
								this.addtel = this.addresses[i].telephone;
							}
						}
						this.departmentname = this.addresses[0]['departmentid'];
						this.warehouse = rew.data.warehouse;
						this.YhGoods = rew.data.promotion;
					})
				}
			},
			changemdgoods() {

				this.PGoods = []
			},
			chooseGoodsCatId() {

			},
			myalert(msg, time) {
				let that = this;
				this.msgshow = true;
				that.altermsg = msg;
				setTimeout(function () {
					that.msgshow = false
				}, time)
			},
			changeadd(data) {
				this.orderlist = [];
				this.departmentname = this.addresses[data.target.selectedIndex].departmentid;
				this.addressid = this.addresses[data.target.selectedIndex].id;
				this.addtel = this.addresses[data.target.selectedIndex].telephone;
				this.addresskey = data.target.selectedIndex
				this.UserInforemarks = this.UserInfo.remarks + this.addresses[data.target.selectedIndex].remarks
				this.UserInfo.ope_remarks = this.addresses[data.target.selectedIndex].ope_remarks;
			},
			updateadd() {
				if (this.UserInfo.memberid) {
					Win10_child.openUrl('/index.php/user/address?cardid=' + this.UserInfo.memberid, '地址管理')
				} else {
					this.myalert('请输入卡号', 1500)
				}
			},

			changegoodslist() {
				const goods = JSON.parse(JSON.stringify(this.YhGoods));
				//筛选分类
				if (this.GoodsCatId != 0) {
					for (var i = goods.length - 1; i >= 0; i--) {
						if (goods[i]['catid'] != this.GoodsCatId) {
							goods.splice(i, 1)
						}
					}
				}

				//筛选商品类型
				if (this.GoodsTypeId != 0) {
					for (var i = goods.length - 1; i >= 0; i--) {
						if (goods[i]['goodstypeid'] != this.GoodsTypeId) {
							goods.splice(i, 1)
						}
					}
				}
				//筛选品牌
				if (this.GoodsBrandId != 0) {
					for (var i = goods.length - 1; i >= 0; i--) {
						if (goods[i]['brandid'] != this.GoodsBrandId) {
							goods.splice(i, 1)
						}
					}
				}
				this.Goods = [];
				this.Goods = goods

			},
			clearGoodsCatId() {
				this.GoodsCatId = 0;

			},
			clearGoodsTypeId() {
				this.GoodsTypeId = 0;

			},
			clearGoodsBrandId() {
				this.GoodsBrandId = 0;

			},
			promotion(arr) {
				//门店优惠
				var goods_arr = [];
				goods_arr = JSON.parse(JSON.stringify(this.GoodsList));

				for (var i in goods_arr) {
					for (var j in arr) {
						if (goods_arr[i]['id'] == arr[j]['goodsid']) {
							goods_arr[i]['payment'] = arr[j]['payment'];
							if (arr[j]['salestype'] == '市场价格优惠') {
								goods_arr[i]['price'] = goods_arr[i]['price'] - arr[j]['price']
							} else {
								goods_arr[i]['price'] = arr[j]['price']
							}
							break
						}
					}
				}
				this.Goods = goods_arr;
				this.YhGoods = goods_arr
			},
			addcar(data) {

				//判断是否能够预约
				if (data.payment == '月结支付') {
					var zprice = Number(this.UserInfo.quota) + Number(this.UserInfo.balance);
					for (i in this.orderlist) {
						if (this.orderlist[i]['payment'] == '月结支付') {
							zprice -= (this.orderlist[i]['price'] * this.orderlist[i]['num'])
						}
					}
					if (zprice - data['price'] < 0) {
						this.myalert('余额或信用额度不足', 2000);
						return false
					}
				}


				if (!this.cardid) {
					this.myalert('请填写卡号', 1500);
					return false
				}


				if (data.catid == 1) {
					for (i in this.charge) {
						var arrs = {
							brand: this.charge[i]['serial_collateral'],
							cat: '',
							department: this.getdepartmentname(this.departmentname),
							goodsid: this.charge[i].id,
							goodsname: this.charge[i].project,
							goodstype: "",
							packingtype: this.charge[i].project,
							mode: "缴纳费用",
							num: 1,
							payment: this.charge[i].payment ? this.charge[i].payment : this.payment,
							paymentshow: this.charge[i].payment ? this.charge[i].payment : this.payment,
							canchange: this.charge[i].payment ? 0 : 1,
							unit: "元",
							capacityunit: "元",
							suttle: 0,
							marketprice: this.charge[i].total,
							price: this.charge[i].total,
							relation: ""
						};
						if (!this.isHas(arrs)) {
							this.orderlist = this.orderlist.concat(arrs);
						}
					}
				}


				var arr = {
					brand: this.getbrand(data.brandid),
					cat: this.getcat(data.catid),
					department: this.getdepartmentname(this.departmentname),
					goodsid: data.id,
					goodsname: data.name,
					goodstype: this.gettype(data.goodstypeid),
					mode: "商品销售",
					selfmentiondiscount: Number(data.selfmentiondiscount),
					num: 1,
					payment: data.payment ? data.payment : this.payment,
					paymentshow: data.payment ? data.payment : this.payment,
					canchange: data.payment ? 0 : 1,
					price: data.price,
					priceshow: data.price,
					relation: 0
				};


				for (i in this.orderlist) {
					if (this.orderlist[i]['goodsid'] == arr['goodsid'] && this.orderlist[i]['mode'] == arr['mode'] && arr['goodstype'] != '') {
						this.orderlist[i]['num'] += 1;
						return false
					}
				}
				this.orderlist = this.orderlist.concat(arr);
				this.checkzt()
			},
			isHas(data) {
				for (i in this.orderlist) {
					if (data.goodsid == this.orderlist[i].goodsid && this.orderlist[i].goodstype == "") {
						return true
					}
				}
				return false
			},
			addcarth(data) {

				if (!this.cardid) {
					this.myalert('请填写卡号', 1500);
					return false
				}
				var arr = {
					id: data.id,
					brand: this.getbrand(data.goods.brandid),
					cat: this.getcat(data.goods.catid),
					department: this.getdepartmentname(this.departmentname),
					goodsid: data.goods.id,
					goodsname: data.goods.name,
					goodstype: this.gettype(data.goods.goodstypeid),
					mode: "库存提货",
					num: 1,
					payment: data.payment ? data.payment : this.payment,
					paymentshow: data.paymentstatus,
					canchange: data.paymentstatus == '已支付' ? 0 : 1,
					price: data.price,
					relation: data.id
				};
				for (i in this.orderlist) {
					if (this.orderlist[i]['id'] == arr['id']) {
						if (this.orderlist[i]['num'] >= data['num']) {
							this.myalert('无法添加，超出剩余数量', 1500);
							return false;
						}
						this.orderlist[i]['num'] += 1;
						return false
					}
				}
				this.orderlist = this.orderlist.concat(arr)
			},
			addcarplan(data) {

				if (!this.cardid) {
					this.myalert('请填写卡号', 1500);
					return false
				}
				var arr = {
					brand: "多品牌",
					cat: "促销方案",
					department: this.getdepartmentname(this.departmentname),
					goodsid: data.id,
					goodsname: data.name,
					goodstype: "促销方案",
					mode: "办理促销方案",
					num: 1,
					payment: data.payment ? data.payment : this.payment,
					paymentshow: data.payment ? data.payment : this.payment,
					canchange: 1,
					price: data.price,
					relation: 0
				};
				for (i in this.orderlist) {
					if (this.orderlist[i]['goodsid'] == arr['goodsid']) {
						if (this.orderlist[i]['num'] >= data['num']) {
							this.myalert('无法添加，超出剩余数量', 1500);
							return false;
						}
						this.orderlist[i]['num'] += 1;
						return false
					}
				}
				this.orderlist = this.orderlist.concat(arr)
			},
			delorderlist(index) {
				this.orderlist.splice(index, 1)
			},
			getbrand(id) {
				for (var i in this.GoodsBrand) {
					if (id == this.GoodsBrand[i]['id']) {
						return this.GoodsBrand[i]['name']
					}
				}
			},
			getcat(id) {
				for (var i in this.GoodsCat) {
					if (id == this.GoodsCat[i]['id']) {
						return this.GoodsCat[i]['name']
					}
				}
			},
			gettype(id) {
				for (var i in this.GoodsType) {
					if (id == this.GoodsType[i]['id']) {
						return this.GoodsType[i]['name']
					}
				}
			},
			getdepartmentname(id) {
				for (var i in this.Department) {
					if (id == this.Department[i]['id']) {
						return this.Department[i]['name']
					}
				}
			},
			paymentchange() {
				for (i in this.orderlist) {
					if (this.orderlist[i]['canchange']) {

						this.orderlist[i]['payment'] = this.payment;
						if (this.orderlist[i]['paymentshow'] != '已支付' && this.orderlist[i]['paymentshow'] != '未支付') {
							this.orderlist[i]['paymentshow'] = this.payment
						}

					}
				}
			},

			qrxd() {
				if (this.UserInfo.stateshow != '正常') {
					this.myalert('该用户无法下单', 2000);
					return false
				}
				var appointmenttime = document.getElementById('datetimes').value;
				// if (this.departmentname == '0') {
				// 	this.myalert('请选择配送门店', 2000);
				// 	return false
				// } else {
				// 	if (this.is_on) {
				// 		this.updateaddress()
				// 	}
				// }
				if (!appointmenttime) {
					this.myalert('请选择预约上门时间', 2000);
					return false
				}
				if (this.orderlist.length == 0) {
					this.myalert('请添加产品', 2000);
					return false
				}
				axios.post('/index.php/api/DirectSales', {
					companyid: this.UserInfo.companyid,
					userid: this.UserInfo.id,
					memberid: this.UserInfo.memberid,
					addressid: this.addressid,
					name: this.UserInfo.name,
					telephone: this.addtel,
					selfmention: this.zt ? '是' : '',
					regionalcode: '',
					workplace: this.UserInfo.workplace,
					province: this.addresses[this.addresskey]['province'],
					city: this.addresses[this.addresskey]['city'],
					area: this.addresses[this.addresskey]['area'],
					town: this.addresses[this.addresskey]['town'],
					street: this.addresses[this.addresskey]['street'],
					housenumber: this.addresses[this.addresskey]['housenumber'],
					address: this.addresses[this.addresskey]['address'],
					housingproperty: this.UserInfo.housingproperty,
					longitude: 0,
					latitude: 0,
					remarks: this.UserInforemarks,
					ope_remarks: this.UserInfo.ope_remarks ? this.UserInfo.ope_remarks : '',
					appointmenttime: this.YYYIMT,
					goodsjson: this.orderlist,
					payment: this.payment,
					ordertotal: this.zprice.zprice
				}).then(rew => {
					if (rew.data.code == 200) {
						this.successmsg = true;
						this.is_on = false;
						this.refre_submit();
						this.orderlist = []

						var data = rew.data.printinfo
						if (data.type == '商品直售单') {
							var str = '';

							var goods = JSON.parse(data.goods)


							for (let i = 0; i < goods.length; i++) {
								str += goods[i].goodsname + '                       ' + goods[i].num + goods[i].unit + '      ' + goods[i].total + '\r\n'
							}

							var remarks = data.remarks
							if (data.pay_balance) {
								remarks += ',余额支付：' + data.pay_balance + '元'
							}

							if (data.pay_cash) {
								remarks += ',现金支付：' + data.pay_cash + '元'
							}

							var jsonp = {
								title: "南宁三燃公司商品直售单据",
								time: data.topinfo,
								Memo3: "会员号 " + data.memberid,
								Memo1: "姓名 " + data.name,
								Memo2: data.telephone,
								Memo8: data.department,
								Memo5: str,
								Memo4: remarks  ,
								Memo6: '收款员:' + data.operator,
								Memo7: '用户签名：_______________________________',
							}
							var data_infop = {
								PrintData: jsonp,
								Print: true
							}
							axios.get('http://127.0.0.1:8000/api/print/order/11/?data=' + JSON.stringify(data_infop)).then(rew => {
								console.log(rew)
							})
						}

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
								Memo55: '打单时间：<?= date('Y-m-d H:i:s',time())?>',
							}
							var data_infop = {
								PrintData: jsonp,
								Print: true
							}
							axios.get('http://127.0.0.1:8000/api/print/order/12/?data=' + JSON.stringify(data_infop)).then(rew => {
								console.log(rew)
							})
						}
					}
				})

			},
			updateaddress() {
				axios.post('/index.php/api/updateaddress', {
					address: this.addresses[this.addresskey],
					md: this.departmentname,
					memberid: this.UserInfo.memberid,
				}).then(rew => {
					console.log(rew)
				})
			},
			getQueryVariable(variable) {
				var query = window.location.search.substring(1);
				var vars = query.split("&");
				for (var i = 0; i < vars.length; i++) {
					var pair = vars[i].split("=");
					if (pair[0] == variable) {
						return pair[1];
					}
				}
				return '';
			},
			jiesuo(index) {
				this.orderlist[index]['canchange'] = 1;
				this.orderlist[index]['payment'] = this.payment;
				this.orderlist[index]['paymentshow'] = this.payment
			},
			yysubmit() {
				var appointmenttime = document.getElementById('datetimes').value;
				if (!this.cardid) {
					this.myalert('请填写卡号', 1500);
					return false
				}
				if (!appointmenttime) {
					this.myalert('请选择预约上门时间', 2000);
					return false
				}

				axios.post('/index.php/api/createRepairOrder', {
					companyid: this.UserInfo.companyid,
					userid: this.UserInfo.id,
					name: this.UserInfo.name,
					memberid: this.UserInfo.memberid,
					mode: this.yymodel,
					object: this.obj,
					appointmenttime: this.YYYIMT,
					city: this.addresses[this.addresskey]['city'],
					area: this.addresses[this.addresskey]['area'],
					town: this.addresses[this.addresskey]['town'],
					street: this.addresses[this.addresskey]['street'],
					housenumber: this.addresses[this.addresskey]['housenumber'],
					address: this.addresses[this.addresskey]['address'],
					telephone: this.addtel,
					housingproperty: this.UserInfo.housingproperty,
					attributiondepartment: this.UserInfo.attributiondepartment,
					longitude: 0,
					latitude: 0,
					appointmentremarks: this.yyremarks,
					province: this.addresses[this.addresskey]['province'],
					customertype: this.UserInfo.customertype
				}).then(rew => {
					if (rew.data.code == 200) {
						this.myalert('预约维修成功！', 1500);
						this.yyremarks = ''
					} else {
						this.myalert('预约失败！', 1500);
						this.yyremarks = ''
					}
				})
			}
		},
		created() {
			this.yysmtime = '<?= date('Y-m-d')?>' + 'T' + '<?= date('h:i')?>'
			this.cardid = this.getQueryVariable('cardid');
			axios.post('/index.php/api/getmyinitdata').then(rew => {
				this.initData = rew.data.data;
				this.GoodsCat = rew.data.data.GoodsCat.info;
				this.GoodsType = rew.data.data.GoodsType.info;
				this.GoodsBrand = rew.data.data.GoodsBrand.info;
				let goods = [...rew.data.data.Goods.info] || [];
				this.GoodsList = goods;
				this.YhGoods = goods;
				this.MdGoods = goods;
				this.plan = rew.data.plan;
				this.Department = rew.data.data.Department.info;
				this.obj = this.initData.RepairObject.info[0].name
			});
			if (this.cardid) {
				this.submit()
			}
		}

	})
</script>
</body>
</html>
