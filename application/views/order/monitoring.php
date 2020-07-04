<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>订单监控</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<script src="<?php echo base_url(); ?>res/js/win10.child.js"></script>
	<script src="<?php echo base_url(); ?>res/js/vue.js" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>res/js/axios.js" charset="utf-8"></script>

	<link rel="stylesheet" href="<?php echo base_url(); ?>res/bootstrap/css/bootstrap.css">

	<script src="<?php echo base_url(); ?>res/js/sweetalert2.min.js"></script>
	<script src="<?php echo base_url(); ?>res/js/core.js"></script>
	<link href="<?php echo base_url(); ?>res/css/sweetalert2.min.css" rel="stylesheet">

</head>
<style>
	.menu_r {
		position: fixed;
		right: -10px;
		top: 0;
		width: 450px;
		height: 100%;
		border: 1px #ccc solid;
		z-index: 99999;
		background: #f2f2f2;
	}

	td {
		width: 1px;
		white-space: nowrap; /* 自适应宽度*/
		word-break: keep-all; /* 避免长单词截断，保持全部 */
	}

	.zz {
		position: fixed;
		z-index: 8;
		width: 100%;
		height: 100%;
		background: rgba(0, 0, 0, 0.3);
		top: 0;
		left: 0;
	}

	.zzbind {
		position: fixed;
		z-index: 8;
		width: 100%;
		height: 100%;
		background: rgba(0, 0, 0, 0.3);
		top: 0;
		left: 0;
	}


	.edit {
		position: fixed;
		z-index: 9;
		width: 500px;
		height: 400px;
		background: #FFF;
		top: 50%;
		margin-top: -200px;
		left: 50%;
		margin-left: -250px;
		border-radius: 10px;
	}

	.bind {
		position: fixed;
		z-index: 9;
		width: 1200px;
		background: #FFF;
		top: 4%;
		left: 50%;
		margin-left: -600px;
		border-radius: 10px;
	}

	.check {
		position: fixed;
		z-index: 9;
		width: 500px;
		background: #FFF;
		top: 4%;
		left: 50%;
		margin-left: -250px;
		border-radius: 10px;
	}

	td {
		font-size: 15px;
	}

</style>
<body>

<div class="oapd p-2" id="orderapp">
	<div class="form-row align-items-center">
		<div class="col-auto">
			<label class="sr-only">开始时间</label>
			<div class="input-group mb-2">
				<div class="input-group-prepend">
					<div class="input-group-text">开始时间</div>
				</div>
				<input type="date" class="form-control" v-model="begintime" placeholder="开始时间">
			</div>
		</div>
		<div class="col-auto">
			<label class="sr-only">结束时间</label>
			<div class="input-group mb-2">
				<div class="input-group-prepend">
					<div class="input-group-text">结束时间</div>
				</div>
				<input type="date" class="form-control" v-model="endtime" placeholder="结束时间">
			</div>
		</div>
		<div class="col-auto">
			<label class="sr-only">卡号</label>
			<div class="input-group mb-2">
				<div class="input-group-prepend">
					<div class="input-group-text">卡号</div>
				</div>
				<input type="text" class="form-control" v-model="cardid" placeholder="卡号">
			</div>
		</div>
		<div class="col-auto">
			<label class="input-group-prepend">
				<button class="btn btn-primary" @click="getlist">搜索</button>
				<button class="btn btn-primary ml-3" @click="seeowen">本人预约</button>
			</label>
		</div>
		<div class="p-1" style="height: 500px;width: 98%;overflow: auto;padding-bottom: 100px;">
			<table class="table table-bordered table-sm" style="width: 3000px">
				<thead>
				<tr style="top: 100px;z-index: 1;">
					<th scope="col">下单时间</th>
					<th scope="col">姓名</th>
					<th scope="col">门店</th>
					<th scope="col">商品</th>
					<th scope="col">数量</th>
					<th scope="col">电话</th>
					<th scope="col">会员号</th>
					<th scope="col">地址</th>
					<th scope="col">备注</th>
					<th scope="col" >配送日期</th>
					<th scope="col">安排方式</th>
					<th scope="col">配送员</th>
					<th scope="col">安排时间</th>
					<th scope="col">预约员</th>
					<th scope="col">状态</th>
				</tr>
				</thead>
				<tbody v-for="(v,index) in zlist">
				<tr v-if="Number(v.notice) == 1 && Number(v.state) == 1 && state5" @dblclick="choosedata(index)"
					:class="v.isshow?'bg-info':''" style="cursor: pointer;color: green">
					<td title="下单时间">{{ v.addtime }}</td>
					<td title="姓名">{{ v.mianname }}</td>
					<td title="门店">{{ v.department}}</td>
					<td title="商品">{{ v.goodsname}}</td>
					<td title="数量">{{ v.num}}</td>
					<td title="电话">{{ v.miantelephone}}</td>
					<td title="会员号">{{ v.mianmemberid}}</td>
					<td title="地址">{{ v.mianarea}}{{ v.miantown}}{{ v.mianstreet}}{{ v.mianaddress}}</td>
					<td title="备注">{{ v.mianremarks}}</td>
					<td title="配送日期">{{ v.mianappointmenttime}}</td>
					<td title="安排方式">{{ v.distributionmode}}</td>
					<td title="配送员">{{ v.deliveryman}}</td>
					<td title="安排时间">{{ v.arrangetime}}</td>
					<td title="预约员">{{ v.mianregistrar}}</td>
					<td title="状态">{{ v.stateshow}}</td>
				</tr>
				<!--取消-->
				<tr v-else-if="Number(v.state) == 2 && state1" @dblclick="choosedata(index)"
					:class="v.isshow?'bg-info':''"
					style="cursor: pointer;color: #ff86f2">
					<td title="下单时间">{{ v.addtime }}</td>
					<td title="姓名">{{ v.mianname }}</td>
					<td title="门店">{{ v.department}}</td>
					<td title="商品">{{ v.goodsname}}</td>
					<td title="数量">{{ v.num}}</td>
					<td title="电话">{{ v.miantelephone}}</td>
					<td title="会员号">{{ v.mianmemberid}}</td>
					<td title="地址">{{ v.mianaddress}}</td>
					<td title="备注">{{ v.mianremarks}}</td>
					<td title="配送日期">{{ v.mianappointmenttime}}</td>
					<td title="安排方式">{{ v.distributionmode}}</td>
					<td title="配送员">{{ v.deliveryman}}</td>
					<td title="安排时间">{{ v.arrangetime}}</td>

					<td title="预约员">{{ v.mianregistrar}}</td>
					<td title="状态">{{ v.stateshow}}</td>
				</tr>
				<!--已安排-->
				<tr v-else-if="v.stateshow == '已安排' && state2" @dblclick="choosedata(index)"
					:class="v.isshow?'bg-info':''"
					style="cursor: pointer;color: red">
					<td title="下单时间">{{ v.addtime }}</td>
					<td title="姓名">{{ v.mianname }}</td>
					<td title="门店">{{ v.department}}</td>
					<td title="商品">{{ v.goodsname}}</td>
					<td title="数量">{{ v.num}}</td>
					<td title="电话">{{ v.miantelephone}}</td>
					<td title="会员号">{{ v.mianmemberid}}</td>
					<td title="地址">{{ v.mianaddress}}</td>
					<td title="备注">{{ v.mianremarks}}</td>
					<td title="配送日期">{{ v.mianappointmenttime}}</td>
					<td title="安排方式">{{ v.distributionmode}}</td>
					<td title="配送员">{{ v.deliveryman}}</td>
					<td title="安排时间">{{ v.arrangetime}}</td>

					<td title="预约员">{{ v.mianregistrar}}</td>
					<td title="状态">{{ v.stateshow}}</td>
				</tr>
				<!--已汇总-->
				<tr v-else-if="v.stateshow == '已汇总' && state3" @dblclick="choosedata(index)"
					:class="v.isshow?'bg-info':''"
					style="cursor: pointer;color: blue">
					<td title="下单时间">{{ v.addtime }}</td>
					<td title="姓名">{{ v.mianname }}</td>
					<td title="门店">{{ v.department}}</td>
					<td title="商品">{{ v.goodsname}}</td>
					<td title="数量">{{ v.num}}</td>
					<td title="电话">{{ v.miantelephone}}</td>
					<td title="会员号">{{ v.mianmemberid}}</td>
					<td title="地址">{{ v.mianaddress}}</td>
					<td title="备注">{{ v.mianremarks}}</td>
					<td title="配送日期">{{ v.mianappointmenttime}}</td>
					<td title="安排方式">{{ v.distributionmode}}</td>
					<td title="配送员">{{ v.deliveryman}}</td>
					<td title="安排时间">{{ v.arrangetime}}</td>

					<td title="预约员">{{ v.mianregistrar}}</td>
					<td title="状态">{{ v.stateshow}}</td>
				</tr>
				<tr v-else-if="state4 && v.stateshow == '正常'" @dblclick="choosedata(index)"
					:class="v.isshow?'bg-info':''" style="cursor: pointer;">
					<td title="下单时间">{{ v.addtime }}</td>
					<td title="姓名">{{ v.mianname }}</td>
					<td title="门店">{{ v.department}}</td>
					<td title="商品">{{ v.goodsname}}</td>
					<td title="数量">{{ v.num}}</td>
					<td title="电话">{{ v.miantelephone}}</td>
					<td title="会员号">{{ v.mianmemberid}}</td>
					<td title="地址">{{ v.mianaddress}}</td>
					<td title="备注">{{ v.mianremarks}}</td>
					<td title="配送日期">{{ v.mianappointmenttime}}</td>
					<td title="安排方式">{{ v.distributionmode}}</td>
					<td title="配送员">{{ v.deliveryman}}</td>
					<td title="安排时间">{{ v.arrangetime}}</td>
					<td title="预约员">{{ v.mianregistrar}}</td>
					<td title="状态">{{ v.stateshow}}</td>
				</tr>
				<tr v-if="v.isshow">
					<td colspan="15">
						<div class="p-3">
							<p>用户类型：{{ v.miancustomertype }} &nbsp; 用户等级：{{ v.mianviplevel }}&nbsp; 方式：{{ v.mode }}
								&nbsp; ID：{{ v.id }} &nbsp; 备注：{{ v.mianremarks }}&nbsp; 单价：{{ v.price }}&nbsp; 合计：{{
								v.mianordertotal }}
								<span v-if="v.revokeremarks" style="color: red;padding-left: 10px"> 取消备注：{{ v.revokeremarks }}</span>
								<span v-if="v.revokeer"
									  style="color: red;padding-left: 10px"> 取消人：{{ v.revokeer }}</span>
								<span v-if="v.revoke_department" style="color: red;padding-left: 10px"> 取消部门：{{ v.revoke_department }}</span>
							</p>
							<h6>操作</h6>
							<button @click="del" class="btn btn-primary btn-sm" lay-event="del">取消订单</button>
							<button @click="edit" class="btn btn-primary btn-sm" lay-event="edit">更改订单部门</button>
							<button @click="reset" class="btn btn-primary btn-sm" lay-event="Reset">重置订单配送员</button>
							<button @click="bindid" v-if="!Number(v.mianuserid)"  class="btn btn-primary btn-sm"
									lay-event="band">用户ID绑定
							</button>
							<button @click="update" class="btn btn-primary btn-sm" lay-event="band">更新订单通知</button>
							<button @click="addcheck" v-if="v.stateshow == '已汇总'" class="btn btn-primary btn-sm"
									lay-event="band">添加安检记录
							</button>
							<button @click="changecode" class="btn btn-primary btn-sm" lay-event="band">修改钢瓶号</button>
							<button v-if="data.state == 104 && data.goodstype == '桶装水'" @click="watercode"
									class="btn btn-primary btn-sm" lay-event="band">水票核销
							</button>
						</div>
					</td>
				</tr>

				</tbody>
			</table>
		</div>
		<div style="clear: both;margin-top: 15px;width: 100%;"></div>
		<span style="background: #ff86f2;width: 20px;height: 20px"></span><span>取消</span><input type="checkbox"
																								v-model="state1">&nbsp;&nbsp;
		<span style="background: red;width: 20px;height: 20px"></span><span>已安排</span><input type="checkbox"
																							 v-model="state2">&nbsp;&nbsp;
		<span style="background: blue;width: 20px;height: 20px"></span><span>已汇总</span><input type="checkbox"
																							  v-model="state3">&nbsp;&nbsp;
		<span style="background: black;width: 20px;height: 20px"></span><span>正常</span><input type="checkbox"
																							  v-model="state4">&nbsp;&nbsp;
		<span style="background: green;width: 20px;height: 20px"></span><span>已通知</span><input type="checkbox"
																							   v-model="state5">&nbsp;&nbsp;

	</div>
	<div v-if="isshow" @click="isshow = !isshow" style="z-index:9999999;position: fixed;top: 10px;right: 30%;font-size: 40px;padding: 20px;background: red;color: white;cursor: pointer">
		X
	</div>
	<div v-if="admindepartment== '预约中心' || admindepartment== '运营监督'">
		<div class="menu_r row" v-if="isshow" style="overflow-y: scroll">
			<div class="col-1" style="text-align: center;margin-top: 50%;cursor: pointer" @click="isshow = !isshow">
				关闭菜单
			</div>
			<div class="col-5">
				<h5>选择门店</h5>
				<div><label for="xq"><input v-model="xq" id="xq" type="checkbox">全选</label></div>
				<div v-for="(v,index) in department">
				<span class="pr-1" @click="v.isshow = !v.isshow">
					<svg v-if="!v.isshow" t="1577087131679" class="icon" viewBox="0 0 1024 1024" version="1.1"
						 xmlns="http://www.w3.org/2000/svg" p-id="2605" width="16" height="16">
						<path
								d="M937.12896 893.51168c-2.78528 55.19872-70.66112 43.33056-108.40064 43.33056H181.12c-35.74784 0-83.62496 4.33664-83.62496-46.976v-128.70144-476.09856-138.11712c0-49.13664 40.20736-49.75616 76.53376-49.75616H819.37408c34.36032 0 92.06784-10.94144 112.93184 23.3984 6.81472 11.21792 4.82304 28.07808 4.82304 40.83712V893.51168c0 33.01376 51.2 33.01376 51.2 0V159.63648c0-15.89248 0.0256-30.70464-4.01408-46.40768-10.53696-40.97536-52.06528-67.23072-92.73344-67.23072H149.51936c-61.05088 0-103.2192 42.16832-103.2192 103.2192v742.07744c0 43.8528 26.88512 77.97248 67.23072 92.73344 14.34624 5.25312 31.24736 4.01408 46.40768 4.01408H893.7984c53.30944 0 91.93984-43.24864 94.53056-94.53056 1.664-33.01888-49.54112-32.85504-51.2 0z"
								p-id="2606"></path><path
								d="M491.71456 230.29248v573.44c0 33.01376 51.19488 33.01376 51.19488 0v-573.44c0-33.01376-51.19488-33.01376-51.19488 0z"
								p-id="2607"></path><path
								d="M230.59456 542.61248h573.43488c33.01376 0 33.01376-51.2 0-51.2H230.59456c-33.01888 0-33.01888 51.2 0 51.2z"
								p-id="2608">
						</path>
					</svg>
					<svg v-else t="1577087738514" class="icon" viewBox="0 0 1024 1024" version="1.1"
						 xmlns="http://www.w3.org/2000/svg" p-id="3649" width="16" height="16"><path
								d="M904 64c30.9 0 56 25.1 56 56v784c0 30.9-25.1 56-56 56H120c-30.9 0-56-25.1-56-56V120c0-30.9 25.1-56 56-56h784m0-64H120C53.7 0 0 53.7 0 120v784c0 66.3 53.7 120 120 120h784c66.3 0 120-53.7 120-120V120c0-66.3-53.7-120-120-120z"
								fill="" p-id="3650"></path><path
								d="M736 480H288c-17.7 0-32 14.3-32 32s14.3 32 32 32h448c17.7 0 32-14.3 32-32s-14.3-32-32-32z"
								fill="" p-id="3651"></path></svg>
				</span>
					<label @click="departmentchange(index)" :for="'di_'+v.id"><input v-model="v.checked" type="checkbox"
																					 :id="'di_'+v.id"><span
								class="pl-1">{{v.title}}</span></label>
					<div v-if="!v.isshow" v-for="vi in v.children">
						&nbsp;&nbsp;|---<label :for="'d_'+vi.id"><input v-model="vi.checked" type="checkbox"
																		:id="'d_'+vi.id"><span
									class="pl-1">{{ vi.title}}</span></label>
					</div>
				</div>
			</div>
			<div class="col-6">
				<h5>选择商品</h5>
				<div v-for="(v,index) in goods">
				<span class="pr-1" @click="v.isshow = !v.isshow">
					<svg v-if="!v.isshow" t="1577087131679" class="icon" viewBox="0 0 1024 1024" version="1.1"
						 xmlns="http://www.w3.org/2000/svg" p-id="2605" width="16" height="16">
						<path
								d="M937.12896 893.51168c-2.78528 55.19872-70.66112 43.33056-108.40064 43.33056H181.12c-35.74784 0-83.62496 4.33664-83.62496-46.976v-128.70144-476.09856-138.11712c0-49.13664 40.20736-49.75616 76.53376-49.75616H819.37408c34.36032 0 92.06784-10.94144 112.93184 23.3984 6.81472 11.21792 4.82304 28.07808 4.82304 40.83712V893.51168c0 33.01376 51.2 33.01376 51.2 0V159.63648c0-15.89248 0.0256-30.70464-4.01408-46.40768-10.53696-40.97536-52.06528-67.23072-92.73344-67.23072H149.51936c-61.05088 0-103.2192 42.16832-103.2192 103.2192v742.07744c0 43.8528 26.88512 77.97248 67.23072 92.73344 14.34624 5.25312 31.24736 4.01408 46.40768 4.01408H893.7984c53.30944 0 91.93984-43.24864 94.53056-94.53056 1.664-33.01888-49.54112-32.85504-51.2 0z"
								p-id="2606"></path><path
								d="M491.71456 230.29248v573.44c0 33.01376 51.19488 33.01376 51.19488 0v-573.44c0-33.01376-51.19488-33.01376-51.19488 0z"
								p-id="2607"></path><path
								d="M230.59456 542.61248h573.43488c33.01376 0 33.01376-51.2 0-51.2H230.59456c-33.01888 0-33.01888 51.2 0 51.2z"
								p-id="2608">
						</path>
					</svg>
					<svg v-else t="1577087738514" class="icon" viewBox="0 0 1024 1024" version="1.1"
						 xmlns="http://www.w3.org/2000/svg" p-id="3649" width="16" height="16"><path
								d="M904 64c30.9 0 56 25.1 56 56v784c0 30.9-25.1 56-56 56H120c-30.9 0-56-25.1-56-56V120c0-30.9 25.1-56 56-56h784m0-64H120C53.7 0 0 53.7 0 120v784c0 66.3 53.7 120 120 120h784c66.3 0 120-53.7 120-120V120c0-66.3-53.7-120-120-120z"
								fill="" p-id="3650"></path><path
								d="M736 480H288c-17.7 0-32 14.3-32 32s14.3 32 32 32h448c17.7 0 32-14.3 32-32s-14.3-32-32-32z"
								fill="" p-id="3651"></path></svg>
				</span>
					<label :for="'g_'+v.id" @click="goodschange(index)"><input v-model="v.checked" type="checkbox"
																			   :id="'g_'+v.id"><span class="pl-1">{{v.title}}</span></label>
					<div v-if="!v.isshow" v-for="vi in v.children">
						&nbsp;&nbsp;|---<label :for="'g_'+vi.id"><input v-model="vi.checked" type="checkbox"
																		:id="'g_'+vi.id"><span
									class="pl-1">{{ vi.title}}</span></label>
					</div>
				</div>
			</div>
		</div>
		<div v-else
			 style="position: fixed;right: 0;top: 0;z-index: 9999;font-weight: bold;width: 35px;padding-top: 15%;background: rgba(155,155,155,0.3);height: 100%;padding-left: 10px"
			 @click="isshow = !isshow">
			选择门店商品
		</div>
	</div>


	<div class="zz" v-if="editshow" @click="closeedit"></div>
	<div class="edit p-5" v-if="editshow">
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">预约上门时间</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" v-model="data.mianappointmenttime" class="col-4">


			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-4 col-form-label">新部门</label>
			<div class="col-sm-8">

				<select name="" id="" v-model="newdepartment" class="form-control">
					<option value="">选择新部门</option>
					<option v-if="v.type=='业务门店' || v.type=='业务公司'" v-for="(v,index) in initData.Department.info"
							:value="v.name">{{ v.name }}
					</option>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">部门</label>
			<div class="col-sm-8">
				<input type="text" v-model="data.department" disabled class="form-control">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">备注</label>
			<div class="col-sm-8">
				<input type="text" v-model="data.remarks" class="form-control">
			</div>
		</div>
		<button @click="comfimedit" class="btn btn-primary">确认修改</button>
	</div>


	<div class="zzbind" v-if="bindshow" @click="bindclose"></div>
	<div class="bind p-5 bg-white form" v-if="bindshow">
		<div class="form-row align-items-center">

			<div class="col-auto">
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text">姓名</div>
					</div>
					<input type="text" v-model="name" class="form-control">
				</div>
			</div>
			<div class="col-auto">
				<button type="submit" @click="namesearch" class="btn btn-primary mb-2">搜索</button>
			</div>
			<div class="col-auto">
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text">电话</div>
					</div>
					<input type="text" v-model="tel" class="form-control">
				</div>
			</div>
			<div class="col-auto">
				<button type="submit" @click="telsearch" class="btn btn-primary mb-2">搜索</button>
			</div>

			<div class="col-auto">
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text">地址</div>
					</div>
					<input type="text" v-model="address" class="form-control">
				</div>
			</div>
			<div class="col-auto">
				<button type="submit" @click="addsearch" class="btn btn-primary mb-2">搜索</button>
			</div>
			<div class="col-auto">
				<button type="submit" @click="newcard" class="btn btn-primary mb-2">开卡</button>
			</div>
		</div>
		<div style="width: 100%;max-height: 472px;overflow: auto;">
			<table class="table table-bordered table-sm">
				<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">会员卡</th>
					<th scope="col">姓名</th>
					<th scope="col">电话</th>
					<th scope="col">地址</th>
					<th scope="col">单位</th>
					<th scope="col">操作</th>

				</tr>
				</thead>
				<tbody>
				<tr v-for="v in userlist">
					<td>{{ v.userid }}</td>
					<td>{{ v.memberid }}</td>
					<td>{{ v.name }}</td>
					<td>{{ v.telephone }}</td>
					<td>{{ v.address }}</td>
					<td>{{ v.workplace }}</td>
					<td>
						<button @click="bindidcom(v)" class="btn btn-primary">绑定用户ID</button>
					</td>
				</tr>
				</tbody>
			</table>
		</div>

	</div>


	<div class="zzbind" v-if="checkshow" @click="checkclose"></div>
	<div class="check p-5 bg-white" style="max-height: 500px;overflow: auto" v-if="checkshow">
		<div v-for="(v,k) in SecurityCheckType" class="pb-5">
			<h4>{{k+1}}, <span class="pl-1">{{ v.name }}</span></h4>
			<template v-for="(vi,ki) in v.list">
				<h5><span class="badge badge-pill badge-warning"> {{ vi.name }} </span></h5>
				<label v-for="vii in vi.result" :for="vii.id" class="pr-3"><input :id="vii.id" type="checkbox"
																				  v-model="vii.ischeck"><span
							class="badge badge-pill badge-info ml-1">{{
						vii.value }}</span></label>
			</template>
		</div>
		<button @click="comaddcall" class="btn btn-primary">确认添加</button>
	</div>

	<div class="zzbind" v-if="changecodeshow" @click="codeclose"></div>
	<div class="check p-5 bg-white" style="max-height: 500px;overflow: auto" v-if="changecodeshow">
		<table class="table table-bordered table-sm">
			<thead>
			<tr>
				<th scope="col">钢瓶号码</th>
				<th scope="col">包装物</th>
				<th scope="col">操作</th>

			</tr>
			</thead>
			<tbody>
			<tr v-for="v in codelist">
				<td>{{ v.code }}</td>
				<td>{{ v.packingtype }}</td>
				<td>
					<button class="btn btn-sm btn-primary" @click="choosecode(v)">选择</button>
				</td>
			</tr>
			</tbody>
		</table>
		<p>订单号： {{ data.serial_pay }}</p>
		<p>原钢瓶号 ： {{ former_code }}</p>
		<p>原包装物 ： {{ former_packingtype }}</p>
		<p>钢瓶号 ： <input type="text" v-model="code"></p>
		<p>包装物 ： <select name="packingtype" id="" v-model="packingtype">
				<option :value="v.name" v-for="v in initData.Packingtype.info">{{ v.name }}</option>
			</select></p>
		<button @click="editcode">确认修改</button>


	</div>
</div>


</body>

<script>
	new Vue({
		el: '#orderapp',
		watch : {
			xq(val) {
				for (let i = 0; i < this.department.length; i++) {
					this.department[i].checked = val
				}
				//this.$forceUpdate()
			}
		},
		computed: {
			deliverydepartment() {
				var goods = JSON.parse(JSON.stringify(this.department));
				let arr = [];
				for (i in goods) {
					if (goods[i].checked) {
						arr = arr.concat(goods[i].title)
					}
					for (j in goods[i].children) {
						if (goods[i].children[j].checked) {
							arr = arr.concat(goods[i].children[j].title)
						}
					}

				}
				return arr
			},
			goodsid() {
				var goods = JSON.parse(JSON.stringify(this.goods));
				let arr = [];
				for (i in goods) {
					if (goods[i].checked) {
						arr = arr.concat(goods[i].id)
					}
					for (j in goods[i].children) {
						if (goods[i].children[j].checked) {
							arr = arr.concat(goods[i].children[j].id)
						}
					}

				}
				return arr
			},
			zlist() {
				var list = JSON.parse(JSON.stringify(this.list));

				var arr = [];

				for (i in list) {
					if (list[i].mianmemberid.indexOf(this.cardid) != -1) {
						arr = arr.concat(list[i])
					}
				}
				if (arr.length && arr.length >= this.list_index) {
					arr[this.list_index].isshow = !arr[this.list_index].isshow;
					this.data = arr[this.list_index];
					this.$forceUpdate();
				}
				return arr
			}
		},
		data: {
			department: [],
			goods: [],
			list: [],
			xq: false,
			userlist: [],
			codelist: [],
			SecurityCheckType: [],
			begintime: '<?= date('Y-m-d')?>',
			endtime: '<?= date('Y-m-d')?>',
			former_code: '',
			former_packingtype: '',
			code: '',
			packingtype: '',
			isshow: false,
			editshow: false,
			bindshow: false,
			changecodeshow: false,
			checkshow: false,
			cardid: '',
			data: '',
			name: '',
			tel: '',
			user: '',
			address: '',
			state1: true,
			state2: true,
			state3: true,
			state4: true,
			state5: true,
			admindepartment: '',
			newdepartment: '',
			list_index: 0,
			initData: []
		},
		methods: {
			newcard () {
				Win10_child.openUrl('/index.php/user/open_account?name='+this.data.mianname+'&telephone='+this.data.miantelephone+'&city='+this.data.miancity+'&area='+this.data.mianarea+'&town='+this.data.miantown+'&street='+this.data.mianstreet+'&address='+this.data.mianaddress+'&housingproperty='+this.data.mianhousingproperty+'&customertype='+this.data.miancustomertype+'&attributiondepartment='+this.data.mianattributiondepartment+'&department='+this.data.miandepartment,'开户办卡')
				console.log(this.data)
			},
			watercode() {
				let that = this;
				swal({
					title: '水票核销',
					input: 'textarea',
					text: '请填写水票,多张水票回车分割',
					showCancelButton: true,
					confirmButtonText: '确认',
					cancelButtonText: '取消',
					confirmButtonClass: 'btn btn-success mr-3',
					cancelButtonClass: 'btn btn-danger',
					showLoaderOnConfirm: true,
					allowOutsideClick: false
				}).then(function (data) {
					if (data.value) {
						that.data.billno = data.value;
						axios.post('/index.php/api/watercode', that.data).then(rew => {
							if (rew.data.code == 200) {
								swal({
									type: 'success',
									title: '核销成功！'
								});
								that.getlist()
							} else {
								swal('失败,水票数量超出')
							}
						})
					}
				})
			},
			editcode() {
				if (this.former_code == '' || this.former_packingtype == '') {
					swal('请选择要修改的钢瓶');
					return false
				}
				if (this.code == '') {
					swal('请填写钢瓶号');
					return false
				}
				if (this.packingtype == '') {
					swal('请选择包装物');
					return false
				}
				let that = this;
				axios.post('/index.php/api/ChangeOrderPackingtypeCode', {
					serialpay: this.data.serial_pay,
					former_code: this.former_code,
					former_packingtype: this.former_packingtype,
					code: this.code,
					packingtype: this.packingtype,
				}).then(rew => {
					if (rew.data.code == 200) {
						swal('修改成功')
					} else {
						swal('修改失败')
					}
					setTimeout(function () {
						that.former_code = '';
						that.former_packingtype = '';
						that.packingtype = '';
						that.code = '';
						that.codeclose()
					}, 1000)
				})
			},
			choosecode(data) {
				this.former_code = data.code;
				this.former_packingtype = data.packingtype;
				this.packingtype = data.packingtype
			},
			codeclose() {
				this.changecodeshow = false;
				this.former_code = '';
				this.former_packingtype = '';
				this.packingtype = '';
				this.code = ''
			},
			changecode() {
				if (this.data.stateshow == '已汇总' || this.data.stateshow == '已安排') {

					if (this.data.department != this.admindepartment || this.data.distributionmode != '营业员安排' || this.data.goodstype != '液化气') {
						swal('订单状态无法修改');
						return false
					}
					axios.post('/index.php/api/OrderPackingtypeCodeList', {
						serialpay: this.data.serial_pay,
						department: this.data.department
					}).then(rew => {
						this.codelist = rew.data.data
					});
					this.changecodeshow = true
				}
			},
			comaddcall() {
				axios.post('/index.php/api/AddUserSecurityCheck', {
					order: this.data,
					securitychecklist: this.SecurityCheckType
				}).then(rew => {
					if (rew.data.code == 200) {
						let that = this;
						swal('成功！');
						setTimeout(function () {
							that.checkclose()
						}, 1000)
					} else {
						let that = this;
						swal('失败！');
						setTimeout(function () {
							that.checkclose()
						}, 1000)
					}
				})
			},
			resetSecurityCheckType() {
				for (i in this.SecurityCheckType) {
					for (j in this.SecurityCheckType[i].list) {
						if (this.SecurityCheckType[i].list[j].result) {
							for (k in this.SecurityCheckType[i].list[j].result) {
								this.SecurityCheckType[i].list[j].result[k].ischeck = false
							}
						}
					}
				}
			},
			checkclose() {
				this.checkshow = !this.checkshow;
				this.resetSecurityCheckType()
			},
			addcheck() {
				this.checkshow = !this.checkshow
			},
			bindclose() {
				this.bindshow = !this.bindshow;
				this.userlist = []
			},
			namesearch() {
				axios.post('/index.php/api/usersearch', {
					tag: '姓名',
					data: this.name
				}).then(rew => {
					if (rew.data.code == 200) {
						this.userlist = rew.data.data
					} else {
						this.userlist = []
					}

				})
			},
			telsearch() {
				axios.post('/index.php/api/usersearch', {
					tag: '电话',
					data: this.tel
				}).then(rew => {
					if (rew.data.code == 200) {
						this.userlist = rew.data.data
					} else {
						this.userlist = []
					}
				})
			},
			addsearch() {
				axios.post('/index.php/api/usersearch', {
					tag: '地址',
					data: this.address
				}).then(rew => {
					if (rew.data.code == 200) {
						this.userlist = rew.data.data
					} else {
						this.userlist = []
					}

				})
			},
			closeedit() {
				this.editshow = !this.editshow
			},
			del() {
				if (this.admindepartment == '预约中心') {
					if (this.data.stateshow != '正常') {
						swal('订单状态无法修改');
						return false
					}
				} else {
					if (this.data.miansource == 'iosapp' || this.data.miansource == 'wechat' || this.data.miansource == 'androidapp') {
						swal('订单状态无法修改');
						return false
					}
					if (this.admindepartment != this.data.department) {
						swal('订单状态无法修改');
						return false
					}
				}
				let that = this;
				swal({
					title: '确定取消订单吗',
					input: 'text',
					text: '请填写备注',
					showCancelButton: true,
					confirmButtonText: '确认',
					cancelButtonText: '取消',
					confirmButtonClass: 'btn btn-success mr-3',
					cancelButtonClass: 'btn btn-danger',
					showLoaderOnConfirm: true,
					allowOutsideClick: false
				}).then(function (data) {
					if (data.value) {
						if (data.value.length > 25) {
							swal('备注不能超出25个字符');
							return false
						}
						that.data.remarks = data.value;
						axios.post('/index.php/api/delorder', that.data).then(rew => {
							if (rew.data.code == 200) {
								swal({
									type: 'success',
									title: '取消成功！'
								});
								that.getlist()
							} else {
								swal('失败')
							}
						})
					}
				})
			},
			update() {
				let that = this;
				swal({
					title: '确定更新通知吗？',
					text: '',
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: '确定',
					cancelButtonText: '取消',
					confirmButtonClass: 'btn btn-success mr-3',
					cancelButtonClass: 'btn btn-danger',
					buttonsStyling: false
				}).then(function (dismiss) {
					if (dismiss.value) {
						axios.post('/index.php/api/updateorder', {
							id: that.data.id,
							serial_pay: that.data.serial_pay
						}).then(rew => {
							if (rew.data.code == 200) {
								swal('成功');
								that.getlist()
							} else {
								swal('失败')
							}
						})
					}
				})
			},
			comfimedit() {
				if (this.newdepartment == '') {
					swal('请选择新部门');
					return false
				}
				if (this.data.remarks && this.data.remarks.length > 25) {
					swal('备注不能超出25个字符');
					return false
				}
				let that = this;
				swal({
					title: '确定修改订单信息吗？',
					text: '',
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: '确定',
					cancelButtonText: '取消',
				}).then(function (dismiss) {
					if (dismiss.value) {
						axios.post('/index.php/api/editorder', {
							id: that.data.id,
							serial: that.data.mianserial,
							serial_pay: that.data.serial_pay,
							appointmenttime: that.data.mianappointmenttime,
							remarks: that.data.remarks,
							newdepartment: that.newdepartment,
							department: that.data.department,
						}).then(rew => {
							if (rew.data.code == 200) {
								swal('成功')
							} else {
								swal('失败')
							}
							setTimeout(function () {
								that.getlist();
								that.editshow = false
							}, 1000)
						})
					}
				})
			},
			bindidcom(data) {
				this.user = data;
				let that = this;
				swal({
					title: '确定绑定用户ID？',
					text: '',
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: '确定',
					cancelButtonText: '取消',
				}).then(function (dismiss) {
					if (dismiss.value) {
						axios.post('/index.php/api/bindid', {
							ordertype: '销售订单',
							id: that.data.mianid,
							userid: that.user.userid,
							memberid: that.user.memberid,
							sns: that.data.miansns,
							snsuserid: that.data.miansnsuserid,
							serial: that.data.mianserial
						}).then(rew => {
							if (rew.data.code == 200) {
								swal('绑定成功')
							} else {
								swal('绑定失败')
							}
							setTimeout(function () {
								that.getlist()
							}, 1000)
						})
					}
				})
			},
			bindid() {
				this.bindshow = !this.bindshow;
				this.name = this.data.mianname;
				this.tel = this.data.miantelephone;
				this.address = this.data.mianaddress
			},
			reset() {
				if (!(this.data.stateshow == '已安排' || this.data.stateshow == '已接单')) {
					swal('订单状态无法修改');
					return false
				}
				if (this.admindepartment != '预约中心' && this.admindepartment != this.data.department) {
					swal('无法重置其他部门配送员');
					return false
				}
				let that = this;
				swal({
					title: '确定重置配送员吗？',
					text: '',
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: '确定',
					cancelButtonText: '取消',
				}).then(function (dismiss) {
					if (dismiss.value) {
						axios.post('/index.php/api/resetorder', that.data).then(rew => {
							if (rew.data.code == 200) {
								swal('成功')
								if ('<?= get_cookie('department')?>' == '运输公司') {
									Win10_child.openUrl('/index.php/transportpage/schedule', '安排订单')
								} else {
									Win10_child.openUrl('/index.php/order/schedule', '安排订单')
								}

							} else {
								swal('失败')
							}
							setTimeout(function () {
								that.getlist()
							}, 1000)
						})
					}
				})
			},
			edit() {
				if (this.data.department == '未知' && this.data.mianuserid == 0) {
					swal('请先绑卡');
					return false
				}

				if (this.data.department != '未知') {
					this.newdepartment = this.data.department
				}

				if (this.data.stateshow != '正常') {
					swal('订单状态无法修改');
					return false
				}
				if (this.admindepartment != '预约中心' && this.admindepartment != this.data.department) {
					swal('无法修改其他部门订单');
					return false
				}
				this.editshow = true
			},
			choosedata(index) {
				this.list_index = index;
				this.data = this.zlist[index];
				// this.list[index].isshow = !this.list[index].isshow;
				// for (i in this.list) {
				//   if (i != index) {
				//     this.list[i].isshow = false
				//   }
				// }
			},
			departmentchange(index) {
				this.department[index].checked = !this.department[index].checked;
				for (i in this.department[index].children) {
					this.department[index].children[i].checked = this.department[index].checked
				}
			},
			goodschange(index) {
				this.goods[index].checked = !this.goods[index].checked;
				for (i in this.goods[index].children) {
					this.goods[index].children[i].checked = this.goods[index].checked
				}
			},
			getlist() {
				axios.post('/index.php/api/getorderlistsearch', {
					cardid: this.cardid,
					begintime: this.begintime,
					endtime: this.endtime,
					deliverydepartment: this.deliverydepartment,
					goodsid: this.goodsid,
					state: '全部',
				}).then(rew => {
					this.list = rew.data.data
				})
			},
			seeowen() {
				axios.post('/index.php/api/seeowen', {
					cardid: this.cardid,
					begintime: this.begintime,
					endtime: this.endtime,
					deliverydepartment: this.deliverydepartment,
					goodsid: this.goodsid,
					state: '全部',
				}).then(rew => {
					this.list = rew.data.data
				})
			}
		},
		created() {
			axios.post('/index.php/api/gettree').then(rew => {
				var department = rew.data.data.department;
				console.log(department)
				var arr = [];
				for (let i = 0; i < department.length; i++) {
					if (department[i].type == '业务门店' || department[i].type == '业务公司') {
						arr = arr.concat(department[i]);
					}
				}
				arr = arr.concat({
					checked: false,
					children: [],
					field: "",
					id: "0",
					isshow: false,
					spread: true,
					title: "未知"
				})
				this.department = arr
				this.goods = rew.data.data.goods;
				this.admindepartment = rew.data.data.admindepartment;
				this.initData = rew.data.data.initData;
				this.SecurityCheckType = rew.data.data.SecurityCheckType
			});
			// axios.post('/index.php/api/getorderjk').then(rew => {
			//   this.list = rew.data.data
			// })
		}

	})
</script>
</html>

