<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>上传物资调运数据</title>
	<script src="<?php echo base_url(); ?>res/js/win10.child.js"></script>
	<script src="<?php echo base_url(); ?>res/js/vue.js" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>res/js/axios.js" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>res/mydatepick/mydate.js" charset="utf-8"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>res/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>res/mydatepick/mydate.css">


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

</style>
<body>


<div class="oapd" id="uploadApp" style="padding: 20px">
	<div class="form-inline">
		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text">来源部门</div>
			</div>
			<select name="" id="" v-model="department">
				<option value="">请选择门店</option>
				<option v-if="(v.type=='业务公司' || v.type=='业务门店') && v.name != thisdepartment"
						v-for="v in initData.Department.info">{{ v.name }}
				</option>
			</select>

		</div>
		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text">商品</div>
			</div>
			<input type="text" class="form-control" v-model="goodsname" disabled>
		</div>

		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text">经手人</div>
			</div>
			<select name="" id="" v-model="jsr">
				<option v-if="v.quartersid == 7" v-for="v in initData.Operator.info">{{ v.name }}</option>
			</select>
		</div>

		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text">车号</div>
			</div>
			<input type="text" v-model="car_no">
		</div>
		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text">方式</div>
			</div>
			<input type="text" v-model="mode" disabled class="form-control" placeholder="方式">
		</div>
		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text">类型</div>
			</div>
			<div class="form-control">
				<div class="form-group">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" v-model="type" name="type" id="inlineRadio1"
							   value="重">
						<label class="form-check-label" for="inlineRadio1">重</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" v-model="type" name="type" id="inlineRadio2"
							   value="空">
						<label class="form-check-label" for="inlineRadio2">空</label>
					</div>
					<input type="hidden" name="type" v-model="type">
				</div>
			</div>
		</div>
		<div class="input-group mb-2 mr-sm-2 col-3" style="padding: 0">
			<div class="input-group-prepend">
				<div class="input-group-text">包装物</div>
			</div>
			<div class="form-control">
				<select name="" id="" style="width: 10rem;border: none;" v-model="packingtype">
					<option v-for="v in initData.Packingtype.info" :value="v.name">{{ v.name }}</option>
				</select>
			</div>
		</div>
		<div class="input-group col-3  mb-2 mr-sm-2" style="padding: 0">
			<div class="input-group-prepend">
				<div class="input-group-text">商品编号</div>
			</div>
			<input type="text" v-model="goodsnum" class="form-control" placeholder="商品编号" @keyup.enter="scanning">
		</div>


	</div>
	<div class="row p-3" style="clear: both">
		<div class="col-3" style="overflow:auto;height: 500px">
			<div class="card  mt-1 mr-1">
				<ul class="list-group list-group-flush">
					<li v-for="(v,index) in goodsjson" class="list-group-item">{{ v.packingtype}} —— {{ v.shownum }}
					</li>
				</ul>
			</div>
		</div>
		<div class="col-3">
			<h3>总计扫码</h3>
			<p v-for="v in typelist">类型 -- <span style="color: #95b6ff">{{ v.packingtype }}</span> 共 <span
						style="color: #ff9290">{{v.num}}</span> 件</p>
		</div>
		<div class="col-3">
			<h3>操作</h3>
			<button @click="upload" class="btn btn-primary">确认上传</button>
		</div>

	</div>
	<span v-if="msgshow" class="msg scale-in-center">{{ altermsg }}</span>
</div>

</body>

<script>
	new Vue({
		el: '#uploadApp',
		computed: {
			rows() {
				return Math.ceil(this.goods.length / 10)
			},
			typelist() {
				var type = []
				var arr = []
				for (i in this.goodsjson) {
					if (type.indexOf(this.goodsjson[i]['packingtype']) == -1) {
						type = type.concat(this.goodsjson[i]['packingtype'])
					}
				}
				for (i in type) {
					arr = arr.concat({
						packingtype: type[i],
						num: 0
					})
				}
				for (i in this.goodsjson) {
					for (j in arr) {
						if (arr[j]['packingtype'] == this.goodsjson[i]['packingtype']) {
							arr[j]['num']++
						}
					}
				}
				return arr
			},
			goodsname() {
				return this.packingtype
			}
		},
		data: {
			info: '',
			order: '',
			type: '重',
			initData: '',
			car_no: '',
			jsr: '',
			packingtype: '',
			thisdepartment: '<?= get_cookie('department')?>',
			goods: [],
			goodsjson: [],
			msgshow: false,
			altermsg: '',
			department: '运输公司',
			zlist: [],
			mode: '入库',
			goodsnum: ''
		},
		methods: {
			carchange(data) {
				this.jsr = this.initData.CarInfo.info[data.target.selectedIndex]
			},
			return_packingtype($value) {
				$result = '未知'
				if ($value.length == 9) {
					$spec = -1
				} else {
					$spec = $value.slice(-14, -13)
				}
				switch ($spec) {
					case '0':
						$result = 'YSP35.5型钢瓶'
						break
					case '6':
						$result = 'YSP35.5型钢瓶'
						break
					case '1':
						$result = 'YSP12型钢瓶'
						break
					case '7':
						$result = 'YSP12型钢瓶'
						break
					case '2':
						$result = 'YSP118型钢瓶'
						break
					case '8':
						$result = 'YSP118型钢瓶'
						break
					case '3':
						$result = 'YSP28.6型钢瓶'
						break
					case '9':
						$result = 'YSP28.6型钢瓶'
						break
					default:
						$result = '未知'
				}

				return $result
			},
			isHas(str) {
				for (i in this.goods) {
					if (this.goods[i] == str) {
						return true
					}
				}
				return false
			},
			isScan(str) {
				if (str.indexOf('http') != -1 || str.indexOf('+') != -1) {
					return true
				}
				return false
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
			scanning() {
				var num = (this.goodsnum.replace(/[\r\n]/g, '')).replace(/\ +/g, '')
				var tnum = num
				num = num.substr(0, num.indexOf(','))

				if (num) {
					if (!this.isHas(num)) {
						this.goods = this.goods.concat(num)
						var package = ''
						if (this.isScan(num)) {
							this.goodsjson = this.goodsjson.concat({
								packingtype: this.return_packingtype(num),
								code: num,
								type: this.type,
								shownum: num.slice(-7, num.length)
							})
							package = this.return_packingtype(num)
						} else {
							this.goodsjson = this.goodsjson.concat({
								packingtype: this.packingtype,
								code: num,
								type: this.type,
								shownum: num
							})
							package = this.packingtype
						}
						//统计扫码商品
						if (this.zlist.length == 0) {
							this.zlist = this.zlist.concat({
								package: package,
								num: 1
							})
						} else {
							for (i in this.zlist) {
								if (this.zlist[i]['package'] == package) {
									this.zlist[i]['num']++
								}
							}
						}
						this.goodsnum = ''
					} else {
						this.goodsnum = ''
					}
				} else {
					if (!this.isHas(tnum)) {
						this.goods = this.goods.concat(tnum)
						var package = ''
						if (this.isScan(tnum)) {
							this.goodsjson = this.goodsjson.concat({
								packingtype: this.return_packingtype(tnum),
								code: tnum,
								type: this.type,
								shownum: tnum.slice(-7, tnum.length)
							})
							package = this.return_packingtype(tnum)
						} else {
							this.goodsjson = this.goodsjson.concat({
								packingtype: this.packingtype,
								code: tnum,
								type: this.type,
								shownum: tnum
							})
							package = this.packingtype
						}
						//统计扫码商品
						if (this.zlist.length == 0) {
							this.zlist = this.zlist.concat({
								package: package,
								num: 1
							})
						} else {
							for (i in this.zlist) {
								if (this.zlist[i]['package'] == package) {
									this.zlist[i]['num']++
								}
							}
						}
						this.goodsnum = ''
					} else {
						this.goodsnum = ''
					}
				}

			},
			upload() {
				if (confirm('请确认上传信息，调入' + this.type + '瓶操作')) {
					if (this.goodsjson.length <= 0) {
						alert('请先添加商品')
						return false
					}

					if (!this.car_no) {
						alert('请输入车号')
						return false
					}

					if (this.department == '') {
						alert('请选择门店')
						return false
					}
					axios.post('/index.php/api/LSHandoverMaterielInfo', {
						goodsjson: this.goodsjson,
						type: this.type,
						mode: this.mode,
						department: this.department,
						jsr: this.jsr,
						car_no: this.car_no,
					}).then(rew => {
						if (rew.data.code == 200) {
							this.myalert('上传成功', 1500)
							setTimeout(function () {
								Win10_child.close()
							}, 1500)

						}
					})
				}
			},
			myalert(msg, time) {
				let that = this
				this.msgshow = true
				that.altermsg = msg
				setTimeout(function () {
					that.msgshow = false
				}, time)
			},
		},
		created() {
			this.info = this.getQueryVariable('data')
			axios.post('/index.php/api/getuploadmaterinfosf', {
				info: this.info
			}).then(rew => {
				this.order = rew.data.data

				this.initData = rew.data.initData
				this.packingtype = this.initData.Packingtype.info[0].name
				this.jsr = this.initData.CarInfo.info[0]
			})
		}
	})
</script>
</html>
