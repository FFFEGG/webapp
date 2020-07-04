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
	<script src="<?php echo base_url(); ?>res/js/sweetalert2.min.js"></script>
	<script src="<?php echo base_url(); ?>res/js/core.js"></script>
	<link href="<?php echo base_url(); ?>res/css/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
<style>
	.ap {
		position: absolute;
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

	.ywc {
		color: blue;
	}

	.xq {
		color: #ff86f2;
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

	.dn {
		display: none;
	}

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

	.wxap {
		position: fixed;
		top: 10%;
		left: 20%;
		width: 800px;
		height: 400px;
		background: #FFF;
	}
</style>
<div id="yyapp">
	<div style="padding: 20px">
		<span>搜索:</span><input v-model="keywords" type="text" style="margin-left: 20px;padding: 5px">
		<span>日期</span>
		<input v-model="startime" type="date" style="padding: 5px">-<input v-model="endtime" type="date" style="padding: 5px">
	</div>

	<div :class="sx?'ft':'bodyft'" style="padding: 20px">
		<v-table
				is-vertical-resize
				style="width:100%;"
				is-horizontal-resize
				:vertical-resize-offset='200'
				column-width-drag
				:columns="columns"
				:table-data="orderlist"
				:select-all="selectALL"
				:select-change="selectChange"
				:select-group-change="selectGroupChange"
				:row-click="rowClick"
				:column-cell-class-name="columnCellClass"
				@on-custom-comp="customCompFunc"
				@submit="getlist"
		></v-table>
		<div class="pt-4">
			<div class="form-row align-items-center">

				<div class="col-auto">
					<label class="sr-only" for="inlineFormInputGroup">Username</label>
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<div class="input-group-text">维修员</div>
						</div>
						<select v-model="wxyname" class="custom-select" id="inputGroupSelect01">
							<option v-for="v in wxy">{{v.name}}</option>
						</select>
					</div>
				</div>
				<label style="margin-left: 20px" for="printed"><input v-model="printed" id="printed" type="checkbox"><span>打印机打印</span></label>
				<label style="margin-left: 20px" for="feie"><input v-model="feieprint" id="feie" type="checkbox"><span>飞鹅打印</span></label>
			</div>
			<button @click="submitorder" class="btn btn-primary">确认安排</button>
			<button @click="getlist" class="btn btn-primary">刷新</button>

		</div>

		<span style="z-index:9999" v-if="msgshow" class="msg scale-in-center">{{ altermsg }}</span>

		<div @click="wxcolse" v-if="wx"
			 style="position: fixed;width: 100%;height: 100%;background: rgba(0,0,0,0.3);top: 0"></div>
		<div v-if="wx" class="wxap row">

			<div class="card col-6 ">
				<ul class="list-group list-group-flush form-group mt-10">
					<li class="list-group-item">选择维修配件</li>
					<div class="p-1">
						<select @change="changewxlist" v-model="wxindex" name="" id=""
								style="height: 30px;line-height: 30px;float: left">
							<option :value="index" v-for="(v,index) in RepairPartsGoods">{{ v.name }}</option>
						</select>
						<div style="float: left;margin-left: 10px">单价<input style="width: 50px" type="text"
																			placeholder="单价"
																			v-model="price"></div>
						<div style="float: left;margin-left: 10px">数量<input style="width: 50px" type="text"
																			placeholder="数量"
																			v-model="num"></div>
					</div>
					<br>
					<button @click="add" class="btn btn-light">增加</button>
				</ul>
			</div>
			<div class="card col-6">
				<ul class="list-group list-group-flush">
					<li class="list-group-item">单据号: {{ order.serial }}</li>
					<li class="list-group-item">维修员: {{ wxyname }} <input type="text" v-model="evaluate"
																		  placeholder="评价">
					</li>
					<li class="list-group-item">备注:<input type="text" v-model="msg"/></li>
					<li class="list-group-item">维修或预算用料清单:</li>
					<li class="list-group-item" v-for="v in wxlist">{{v.data.name}}X {{v.num}} <span
								style="float: right">单价：{{v.price}}</span>
					</li>
					<li class="list-group-item">合计: {{ zprice }}</li>
				</ul>
				<button @click="submit" class="btn btn-primary">确认办理</button>
			</div>
		</div>
	</div>
</div>


<!-- 引入组件库 -->
<script src="<?php echo base_url(); ?>res/js/umd.js"></script>
<script>
	new Vue({
		el: '#yyapp',
		data: {
			tableData: [],
			RepairPartsGoods: [],
			wxy: [],
			num: 1,
			order: '',
			keywords: '',
			startime: '<?= date('Y-m-d')?>',
			endtime: '<?= date('Y-m-d')?>',
			evaluate: '',
			wxyname: '',
			price: 0,
			wxindex: 0,
			msg: '',
			msgshow: false,
			feieprint: true,
			printed: false,
			wx: false,
			sx: false,
			altermsg: '',
			columns: [
				{width: 60, titleAlign: 'center', columnAlign: 'center', type: 'selection'},
				{
					field: 'addtime',
					title: '预约时间',
					width: 150,
					titleAlign: 'center',
					columnAlign: 'center',
					isResize: true
				},
				{
					field: 'memberid',
					title: '会员号',
					width: 100,
					titleAlign: 'center',
					columnAlign: 'center',
					isResize: true
				},
				{
					field: 'appointmenttime',
					title: '预约上门时间',
					width: 150,
					titleAlign: 'center',
					columnAlign: 'center',
					isResize: true
				},
				{
					field: 'name',
					title: '姓名',
					width: 100,
					titleAlign: 'center',
					columnAlign: 'center',
					isResize: true
				},
				{
					field: 'address',
					title: '地址',
					width: 100,
					titleAlign: 'center',
					columnAlign: 'center',
					isResize: true
				},
				{
					field: 'object',
					title: '对象',
					width: 200,
					titleAlign: 'center',
					columnAlign: 'center',
					isResize: true
				},
				{
					field: 'telephone',
					title: '电话',
					width: 200,
					titleAlign: 'center',
					columnAlign: 'center',
					isResize: true
				},
				{
					field: 'appointmentremarks',
					title: '备注',
					width: 100,
					titleAlign: 'center',
					columnAlign: 'center',
					isResize: true
				},
				{
					field: 'mode',
					title: '模式',
					width: 100,
					titleAlign: 'center',
					columnAlign: 'center',
					isResize: true
				},
				{
					field: 'maintenanceman',
					title: '维修员',
					width: 100,
					titleAlign: 'center',
					columnAlign: 'center',
					isResize: true
				},
				{
					field: 'operator',
					title: '预约人员',
					width: 100,
					titleAlign: 'center',
					columnAlign: 'center',
					isResize: true
				},
				{
					field: 'revokeer',
					title: '取消人',
					width: 100,
					titleAlign: 'center',
					columnAlign: 'center',
					isResize: true
				},


				{
					field: 'inputperson',
					title: '门店',
					width: 100,
					titleAlign: 'center',
					columnAlign: 'center',
					isResize: true
				},
				{
					field: 'state',
					title: '状态',
					width: 100,
					titleAlign: 'center',
					columnAlign: 'center',
					isResize: true
				},
				{
					field: 'custome-adv',
					title: '操作',
					width: 200,
					titleAlign: 'center',
					columnAlign: 'center',
					componentName: 'table-operation',
					isResize: true
				}
			],
			jsondata: [],
			wxlist: []
		},
		computed: {
			orderlist() {
				var list = JSON.parse(JSON.stringify(this.tableData));
				if (this.keywords == '') {
					let arr = [];
					for (i in list) {
						if (list[i]['state'] != '正常') {
							list[i]['_disabled'] = true
						}

						if (new Date(list[i].addtime.substr(0,10))>= new Date(this.startime) && new Date(list[i].addtime.substr(0,10)) <= new Date(this.endtime)) {
							arr = arr.concat(list[i])
						}

					}
					return arr
				} else {
					let arr = [];
					for (i in list) {
						if (list[i]['state'] != '正常') {
							list[i]['_disabled'] = true
						}
						let str = JSON.stringify(list[i]).toString();
						if (str.indexOf(this.keywords) != -1) {
							if (new Date(list[i].addtime.substr(0,10))>= new Date(this.startime) && new Date(list[i].addtime.substr(0,10)) <= new Date(this.endtime)) {
								arr = arr.concat(list[i])
							}
						}
					}
					return arr
				}

			},
			zprice() {
				let price = 0;
				for (i in this.wxlist) {
					price += Number(this.wxlist[i].price) * Number(this.wxlist[i].num)
				}
				return price
			},
			list() {
				var arr = [];

				for (i in this.wxlist) {
					arr = arr.concat({
						material: this.wxlist[i].data.name,
						unit: this.wxlist[i].data.unit,
						price: this.wxlist[i].price,
						num: this.wxlist[i].num
					})
				}
				return arr
			}
		},
		methods: {
			wxcolse () {
				this.order = ''
				this.wxlist = []
				this.msg = ''
				this.evaluate = ''
				this.wx = false
				this.getlist()
			},
			customCompFunc(params) {
				//console.log(params);

				if (params.type === 'delete') { // do delete operation
					this.$delete(this.tableData, params.index)
				} else if (params.type === 'edit') { // do edit operation

				} else if (params.type === 'cancel') { // do edit operation

					let data = this.tableData[params.index];
					if (data.state == '已汇总' || data.state == '取消') {
						swal({
							title: '该状态订单无法取消',
							type: 'error'
						});
						return false
					}
					let that = this;
					swal({
						title: '确定删除吗？',
						text: '你将无法恢复它！',
						input: 'text',
						type: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: '确定',
						cancelButtonText: '取消',
					}).then(function (diss) {

						if (diss.dismiss != 'cancel') {
							axios.post('/index.php/api/CancelUserRepair', {
								order: data,
								remarks: diss.value
							}).then(rew => {
								if (rew.data.code == 200) {
									swal(
											'取消成功！',
											'订单已取消。',
											'success'
									)
								} else {
									swal(
											'取消失败！',
											'',
											'error'
									)
								}
								that.getlist()
							})
						}
					})
				}
			},
			changewxlist() {
				this.price = Number(this.RepairPartsGoods[this.wxindex].price)
			},
			columnCellClass(rowIndex, columnName, rowData) {

				if (rowData.state === '已安排') {

					return 'yap'
				}
				if (rowData.state === '正常') {

					return ''
				}
				if (rowData.state === '已汇总') {
					return 'yhz'
				}

				if (rowData.state === '已完成') {
					return 'ywc'
				}
				if (rowData.state === '取消') {
					return 'xq'
				}

				if (columnName == 'arrangetime') {
					return 'time'
				}
			},
			rowClick(index, data) {
				if (data.state == '正常') {
					this.order = data
				}

				if (data.state == '已完成') {
					this.wx = true;
					this.order = data
				}

			},
			getlist() {
				this.sx = true;
				axios.post('/index.php/api/getYYOrderList').then(rew => {
					this.tableData = rew.data.data;
					this.wxy = rew.data.wxy;
					this.RepairPartsGoods = rew.data.RepairPartsGoods;
					this.wxyname = rew.data.wxy[0]['name'];
					this.price = Number(rew.data.RepairPartsGoods[this.wxindex].price);
					this.sx = false
				})

			},
			selectALL(selection) {
				// console.log('select-aLL', selection);
				this.jsondata = selection
			},

			selectChange(selection, rowData) {
				// console.log('select-change', selection, rowData);
				this.jsondata = selection
			},

			selectGroupChange(selection) {
				// console.log('select-group-change',selection);
				this.jsondata = selection
			},
			myalert(msg, time) {
				let that = this;
				this.msgshow = true;
				that.altermsg = msg;
				setTimeout(function () {
					that.msgshow = false
				}, time)
			},
			submitorder() {
				if (this.jsondata.length <= 0) {
					alert('请选择订单');
					return false
				}
				let that = this
				for (let i = 0; i < this.jsondata.length; i++) {
					setTimeout(function () {
						axios.post('/index.php/api/WxOrder', {
							order: [that.jsondata[i]],
							feieprint: that.feieprint,
							wxyname: that.wxyname
						}).then(rew => {
							if (rew.data.code == 200) {
								that.myalert('安排成功一条记录', 1500);
								if (that.printed) {
									var data = rew.data.printinfo

									if (data.type == '客服中心订单') {

										var jsonp = {
											Memo1: "三燃公司安检安装回执单",
											Memo2: data.topinfo,
											Memo3: "服务人员："+ data.deliveryman,
											Memo4: "卡号：" + data.memberid,
											Memo5: "单位：" + data.workplace,
											Memo6: "业务：" + data.orderinfo,
											Memo7: "业务员：" + data.salesman,
											Memo8: "备注:" + data.remarks + '维修对象：' + data.userotherinfo,
											Memo9: "业务员电话：" + data.salesmantelephone,
											Memo10: "地址：" + data.address,
											Memo11: "电话：" + data.telephone,
											Memo12: "用户意见：1，满意 2，一般 3，差",
											Memo13: "用户签字：",

										}
										var data_infop = {
											PrintData: jsonp,
											Print: true
										}
										axios.get('http://127.0.0.1:8000/api/print/order/17/?data=' + JSON.stringify(data_infop)).then(rew => {
											console.log(rew)
										})
									}


								}
								that.getlist()
							} else {
								that.myalert('安排失败', 1500);
								that.getlist()
							}
						})
					},3000 * i)
				}


			},
			ishas(data) {
				for (i in this.wxlist) {
					if (this.wxlist[i]['data']['name'] == data.name) {
						return true
					}
				}
				return false
			},
			add() {
				let data = this.RepairPartsGoods[this.wxindex];
				if (this.ishas(data)) {
					for (i in this.wxlist) {
						if (this.wxlist[i]['data']['name'] == data.name) {
							this.wxlist[i].num += Number(this.num);
							this.wxlist[i].price = this.price
						}
					}
				} else {
					this.wxlist = this.wxlist.concat({
						data: this.RepairPartsGoods[this.wxindex],
						num: Number(this.num),
						price: this.price
					})
				}

			},
			submit() {

				if (this.zprice <= 0) {
					this.myalert('请添加维修配件', 1500);
					return false
				}
				axios.post('/index.php/api/createWxOrder', {
					id: this.order.id,
					serial: this.order.serial,
					maintenanceman: this.wxyname,
					list: this.list,
					evaluate: this.evaluate,
					remarks: this.msg,
				}).then(rew => {
					if (rew.data.code == 200) {
						this.wx = false;
						this.order = '';
						this.myalert('成功', 1500)
					} else {
						this.wx = false;
						this.order = '';
						this.myalert('失败', 1500)
					}
				})
			}

		},
		created() {
			this.getlist()
		}

	});
	// 自定义列组件
	Vue.component('table-operation', {
		template: `<span>
        <a title="取消订单" href="" @click.stop.prevent="update(rowData,index)">取消</a>
        <a title="用户查询" href="" @click.stop.prevent="usersee(rowData,index)">查询</a>
        <a title="修改备注" href="" @click.stop.prevent="editremarks(rowData,index)">修改</a>
        <a title="重置配送员" href="" @click.stop.prevent="ResetRepairOrder(rowData,index)">重置</a>
        </span>`,
		props: {
			rowData: {
				type: Object
			},
			field: {
				type: String
			},
			index: {
				type: Number
			}
		},
		methods: {
			usersee() {
				Win10_child.openUrl('/index.php/users/info?cardid=' + this.rowData.memberid, '用户查询')
			},
			ResetRepairOrder() {

				if (this.rowData.state == '已安排' || this.rowData.state == '已接单') {


					let that = this
					swal({
						title: '重置配送员订单',
						text: '确认操作？',
						showCancelButton: true,
						confirmButtonText: '确认',
						cancelButtonText: '取消',
						confirmButtonClass: 'btn btn-success mr-3',
						cancelButtonClass: 'btn btn-danger',
						showLoaderOnConfirm: true,
						allowOutsideClick: false
					}).then(function (remarks) {
						if (remarks.value) {
							axios.post('/index.php/api/ResetRepairOrder', {
								id: that.rowData.id,
								serial: that.rowData.serial,
								remarks: remarks.value,
							}).then(rew => {
								if (rew.data.code == 200) {
									swal('重置成功')
								} else {
									swal('重置失败')
								}
								that.submit()
							})
						}
					})
				} else {
					swal('已安排，已接单才可重置')
					return false
				}
			},
			editremarks() {
				let that = this
				swal({
					title: '修改备注',
					input: 'text',
					text: '填写备注',
					showCancelButton: true,
					confirmButtonText: '确认',
					cancelButtonText: '取消',
					confirmButtonClass: 'btn btn-success mr-3',
					cancelButtonClass: 'btn btn-danger',
					showLoaderOnConfirm: true,
					allowOutsideClick: false
				}).then(function (remarks) {
					if (remarks.value) {
						axios.post('/index.php/api/UpdateUserRepair', {
							id: that.rowData.id,
							serial: that.rowData.serial,
							remarks: remarks.value,
						}).then(rew => {
							if (rew.data.code == 200) {
								swal('修改成功')
							} else {
								swal('修改失败')
							}
							that.$emit('submit')
						})
					}
				})
			},
			update() {

				// 参数根据业务场景随意构造
				let params = {type: 'cancel', index: this.index, rowData: this.rowData};
				this.$emit('on-custom-comp', params)
			},

			deleteRow() {

				// 参数根据业务场景随意构造
				let params = {type: 'delete', index: this.index};
				this.$emit('on-custom-comp', params)

			}
		}
	})
</script>

</body>
</html>

