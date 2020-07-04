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
	<script src="<?php echo base_url(); ?>res/js/jquery-2.2.4.min.js"></script>
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
		-webkit-animation: scale-up-center 0.4s cubic-bezier(.39, .575, .565, 1.000) both;
		animation: scale-up-center 0.4s cubic-bezier(.39, .575, .565, 1.000) both
	}
	.table th, .table td {
		padding: 1px !important;
	}
	@-webkit-keyframes scale-up-center {
		0% {
			-webkit-transform: scale(0.5);
			transform: scale(0.5)
		}
		100% {
			-webkit-transform: scale(1);
			transform: scale(1)
		}
	}

	@keyframes scale-up-center {
		0% {
			-webkit-transform: scale(0.5);
			transform: scale(0.5)
		}
		100% {
			-webkit-transform: scale(1);
			transform: scale(1)
		}
	}

	.scale-out-center {
		-webkit-animation: scale-out-center 0.5s cubic-bezier(.55, .085, .68, .53) both;
		animation: scale-out-center 0.5s cubic-bezier(.55, .085, .68, .53) both
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
		background: rgba(0, 0, 0, 0.5);
		position: fixed;
		top: 0;
	}

	.qx {
		color: #ff86f2;
	}

	.dn {
		display: none;
	}

	.table th, .table td {
		padding: 5px;
	}

	.scale-up-ver-top {
		-webkit-animation: scale-up-ver-top 0.4s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
		animation: scale-up-ver-top 0.4s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
	}

	@-webkit-keyframes scale-up-ver-top {
		0% {
			-webkit-transform: scaleY(.4);
			transform: scaleY(.4);
			-webkit-transform-origin: 100% 0;
			transform-origin: 100% 0
		}
		100% {
			-webkit-transform: scaleY(1);
			transform: scaleY(1);
			-webkit-transform-origin: 100% 0;
			transform-origin: 100% 0
		}
	}

	@keyframes scale-up-ver-top {
		0% {
			-webkit-transform: scaleY(.4);
			transform: scaleY(.4);
			-webkit-transform-origin: 100% 0;
			transform-origin: 100% 0
		}
		100% {
			-webkit-transform: scaleY(1);
			transform: scaleY(1);
			-webkit-transform-origin: 100% 0;
			transform-origin: 100% 0
		}
	}

	.heallshow {
		top: 100px;
		left: 50%;
		width: 600px;
		margin-left: -250px;
		padding: 20px;
		border-radius: 5px;
	}
</style>
<div :class="sx?'ft':'bodyft'" style="padding: 20px;font-weight: 100" id="suapp" @keyup.down="keydown()" @keyup.up="keyups()">
	<div id="textarea" style="max-height: 600px;overflow: auto;">
		<table class="table table-bordered">
			<thead>
			<tr>
				<th scope="col">下单时间</th>
				<th scope="col">会员号</th>
				<th scope="col">联系人</th>
				<th scope="col">联系电话</th>
				<th scope="col">地址 <label for="xs"><input type="checkbox" id="xs" v-model="xs">显示</label></th>
				<th scope="col">用户等级</th>
				<th scope="col">用户类型</th>
				<th scope="col">备注</th>
			</tr>
			</thead>
			<tbody v-for="(v,index) in zlist">
			<tr style="background: #ccc" v-if="v.showline">
				<th><span @click="show(index)">{{v.addtime}}</span>
					<svg @click="show(index)" t="1576638639858" class="icon" viewBox="0 0 1024 1024" version="1.1"
						 xmlns="http://www.w3.org/2000/svg" p-id="1106" width="16" height="16">
						<path
								d="M511.99011254 141.21142578c10.23376465 0 18.95471191 3.60900903 26.2122798 10.81713891 7.27262451 7.20812988 10.86657691 15.96862769 10.86657763 26.2666626v577.89129615l196.1619873-196.43884254c7.099365-7.00543237 15.90435815-10.61444068 26.34082031-10.61444139 10.61938477 0 19.43426538 3.50518822 26.51385474 10.51062059 7.04498291 7.10430908 10.54522705 15.96862769 10.54522706 26.57318092 0 10.40679908-3.54473877 19.16235352-10.69354248 26.37542748l-259.55694604 259.48278761C531.23156714 879.28833008 522.44635033 882.78857422 512.00988746 882.78857422c-10.45623779 0-19.24145531-3.50024414-26.3704834-10.71331811l-259.55200195-259.48278761C218.94848656 605.37939453 215.36914062 596.62384009 215.36914062 586.21704102c0-10.60949731 3.52496314-19.46887183 10.56994606-26.57318092C232.99395776 552.63842773 241.82861328 549.12829614 272.44799805 549.12829614c10.42163062 0 19.2167356 3.60900903 26.36553931 10.61444068l196.1125493 196.43884253V178.29522729c0-10.30297828 3.60900903-19.05853271 10.88635255-26.2666626C493.05517555 144.81549073 501.80084272 141.21142578 512.02966309 141.21142578h-0.03955055z"
								p-id="1107" fill="#1f29f8"></path>
					</svg>
					<a @click="checkd(index,v.ischeck)" v-if="v.ischeck" style="color: blue;cursor: pointer">反选</a>
					<a @click="checkd(index,v.ischeck)" v-else style="color: blue;cursor: pointer">全选</a>
					<span style="font-size: 10px;color: red">{{v.num}}条订单</span>
					<span v-if="v.gas">
						<svg t="1593152104612" class="icon" viewBox="0 0 1024 1024" version="1.1"
							 xmlns="http://www.w3.org/2000/svg" p-id="3397" width="30" height="30"><path
									d="M471.4 387.3v-33.5c0-4.2 3.4-7.7 7.7-7.7h98.1c4.2 0 7.7 3.4 7.7 7.7v33.5"
									fill="#FEBD47" p-id="3398"></path><path
									d="M503.4 349.5V316c0-4.2 3.4-7.7 7.7-7.7h34.1c4.2 0 7.7 3.4 7.7 7.7v33.5M411.7 721v64c0 5.1 4.2 9.3 9.3 9.3h214.4c5.1 0 9.3-4.2 9.3-9.3v-64.2h-233v0.2z"
									fill="#FEBD47" p-id="3399"></path><path
									d="M700.5 528.5h-11.9v-69.4c0-40.2-32.6-72.8-72.8-72.8H440.3c-40.2 0-72.8 32.6-72.8 72.8v69.4h-11.9c-10.2 0-18.5 8.3-18.5 18.5v42c0 10.2 8.3 18.5 18.5 18.5h11.9V677c0 40.2 32.6 72.8 72.8 72.8h175.6c40.2 0 72.8-32.6 72.8-72.8v-69.4h11.9c10.2 0 18.5-8.3 18.5-18.5V547c-0.1-10.2-8.4-18.5-18.6-18.5z"
									fill="#FF931E" p-id="3400"></path><path
									d="M763 711.8c-9.9 0-18-8.1-18-18s8.1-18 18-18 18 8.1 18 18-8 18-18 18z m0-28c-5.5 0-10 4.5-10 10s4.5 10 10 10 10-4.5 10-10-4.5-10-10-10zM274 339.8c-16 0-29-13-29-29s13-29 29-29 29 13 29 29-13 29-29 29z m0-45.1c-8.9 0-16.1 7.2-16.1 16.1s7.2 16.1 16.1 16.1 16.1-7.2 16.1-16.1c-0.1-8.9-7.2-16.1-16.1-16.1zM774.5 256.4h-11.3c-7.1 0-12.8-5.7-12.8-12.8v-11.3c0-1.4-1.1-2.6-2.6-2.6h-7.6c-1.4 0-2.6 1.1-2.6 2.6v11.3c0 7.1-5.7 12.8-12.8 12.8h-11.3c-1.4 0-2.6 1.1-2.6 2.6v7.6c0 1.4 1.1 2.6 2.6 2.6h11.3c7.1 0 12.8 5.7 12.8 12.8v11.3c0 1.4 1.1 2.6 2.6 2.6h7.6c1.4 0 2.6-1.1 2.6-2.6V282c0-7.1 5.7-12.8 12.8-12.8h11.3c1.4 0 2.6-1.1 2.6-2.6V259c-0.1-1.4-1.1-2.6-2.6-2.6zM735.5 407.2H729c-4.1 0-7.4-3.3-7.4-7.4v-6.5c0-0.8-0.7-1.5-1.5-1.5h-4.4c-0.8 0-1.5 0.7-1.5 1.5v6.5c0 4.1-3.3 7.4-7.4 7.4h-6.5c-0.8 0-1.5 0.7-1.5 1.5v4.4c0 0.8 0.7 1.5 1.5 1.5h6.5c4.1 0 7.4 3.3 7.4 7.4v6.5c0 0.8 0.7 1.5 1.5 1.5h4.4c0.8 0 1.5-0.7 1.5-1.5V422c0-4.1 3.3-7.4 7.4-7.4h6.5c0.8 0 1.5-0.7 1.5-1.5v-4.4c0-0.9-0.5-1.5-1.5-1.5z"
									fill="#050505" p-id="3401"></path><path
									d="M254 522.8m-11 0a11 11 0 1 0 22 0 11 11 0 1 0-22 0Z" fill="#050505"
									p-id="3402"></path><path d="M304 732.8m-17 0a17 17 0 1 0 34 0 17 17 0 1 0-34 0Z"
															 fill="#050505" p-id="3403"></path><path
									d="M594.4 743.6h-23.5v-16.4h23.5c35.6 0 64.6-29 64.6-64.5V585h20.1c5.7 0 10.3-4.6 10.3-10.3v-42.1c0-5.7-4.6-10.3-10.3-10.3h-20.2v-77.6c0-35.6-29-64.5-64.6-64.5H418.6c-35.6 0-64.6 29-64.6 64.5v77.6h-20c-5.7 0-10.3 4.6-10.3 10.3v42.1c0 5.7 4.6 10.3 10.3 10.3h20v77.6c0 35.6 29 64.5 64.6 64.5h60.2v16.4h-60.2c-44.6 0-81-36.3-81-81v-61.2H334c-14.7 0-26.7-12-26.7-26.7v-42.1c0-14.7 12-26.7 26.7-26.7h3.7v-61.2c0-44.6 36.3-81 81-81h175.6c44.6 0 81 36.3 81 81v61.2h3.7c14.7 0 26.7 12 26.7 26.7v42.1c0 14.7-12 26.7-26.7 26.7h-3.7v61.2c-0.1 44.8-36.3 81.1-80.9 81.1z"
									fill="" p-id="3404"></path><path
									d="M639.7 487.4h-16.4v-30.3c0-19.2-16.5-34.9-36.8-34.9v-16.4c29.4 0 53.3 23 53.3 51.3v30.3h-0.1zM622.9 623.2h16.4v44.7h-16.4zM503.3 727.2h39.6v16.4h-39.6zM341.3 585h171.3v16.4H341.3zM341.3 505.9h171.3v16.4H341.3zM623.9 585h54.3v16.4h-54.3zM623.9 505.9h54.3v16.4h-54.3z"
									fill="" p-id="3405"></path><path
									d="M613.7 788.1H399.2c-9.6 0-17.5-7.8-17.5-17.5v-37.2h16.4v37.2c0 0.6 0.5 1.1 1.1 1.1h214.5c0.6 0 1.1-0.5 1.1-1.1v-37.2h16.4v37.2c0 9.7-7.8 17.5-17.5 17.5zM571.5 372.9H555v-33h-97v33h-16.4v-33.5c0-8.8 7.1-15.9 15.9-15.9h98.1c8.8 0 15.9 7.1 15.9 15.9v33.5z"
									fill="" p-id="3406"></path><path
									d="M539.5 335.1H523v-33h-33v33h-16.4v-33.5c0-8.8 7.1-15.9 15.9-15.9h34.1c8.8 0 15.9 7.1 15.9 15.9v33.5zM422 369.3h-16.4v-98.8c0-9.9 8-17.9 17.9-17.9H454V269h-30.4c-0.8 0-1.5 0.7-1.5 1.5v98.8zM607.4 369.3H591v-98.8c0-0.8-0.7-1.5-1.5-1.5h-30.4v-16.4h30.4c9.9 0 17.9 8 17.9 17.9v98.8z"
									fill="" p-id="3407"></path></svg>
					</span>
					<span v-if="v.water">
						<svg t="1593151896185" class="icon" viewBox="0 0 1024 1024" version="1.1"
							 xmlns="http://www.w3.org/2000/svg" p-id="2914" width="16" height="16"><path
									d="M833.37728 357.44256 833.37728 300.8256c0-29.62432-22.38464-53.63712-49.9968-53.63712l-44.00128 0c-25.66656-24.4736-74.82368-43.97568-136.0896-53.90848l0-58.47552c8.31488-4.81792 13.1072-10.4192 13.1072-16.40448l-0.00512-43.33568c0.00512-17.9456-42.86464-32.50176-95.74912-32.50176l-10.63936 0c-52.87936 0-95.74912 14.55104-95.744 32.50176l-0.00512 43.33056c0.00512 5.9904 4.79232 11.58656 13.1072 16.4096l-0.00512 57.0624c-65.55648 9.4208-118.4 29.62944-145.34656 55.3216l-34.7392 0c-27.61728 0-50.00192 24.0128-49.9968 53.63712l-0.00512 56.61184c0 16.1792 6.71232 30.65856 17.27488 40.49408l-0.00512 58.69056c-10.56256 9.83552-17.27488 24.30976-17.26976 40.49408l0 56.61184c0 16.1792 6.71232 30.65856 17.28 40.49408l0 232.59648c-13.22496 9.6512-21.90336 25.91744-21.90336 44.35968l0 56.61184c0 29.62432 22.38976 53.64224 49.9968 53.63712l536.09984 0c27.61216 0 50.00192-24.0128 49.9968-53.63712l0-56.61184c0.00512-13.66528-4.80256-26.09664-12.6464-35.56864l0-241.39776c10.56256-9.8304 17.27488-24.30464 17.27488-40.48896l0-56.61184c0-16.18432-6.7072-30.65856-17.27488-40.48896l0-58.69568C826.67008 388.096 833.37728 373.62176 833.37728 357.44256zM741.54496 482.41664c-6.07232-25.6-106.24512-76.8-201.86624-5.12s-258.0224 17.06496-258.0224-27.30496c0 0-1.51552-104.10496-1.51552-133.12 7.58784-25.6 94.1568-81.94048 236.91776-80.21504 142.76096 1.72544 224.4864 68.26496 224.4864 92.16C741.54496 352.70656 741.54496 431.21664 741.54496 482.41664z"
									p-id="2915" fill="#1296db"></path></svg>
					</span>
					<span v-if="v.goods">
<svg t="1593152136597" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3995"
	 width="12" height="12"><path
			d="M221.287127 268.535649L0.554239 489.329977a515.480311 515.480311 0 0 0 4.510708 94.648083l265.814376-265.911655-49.592196-49.530756zM127.110082 174.302284C74.056775 234.713013 37.515426 304.314119 17.578196 377.780816L174.183245 221.278167l-47.073163-46.975883zM849.299637 127.101122c-192.828958-169.466456-482.164555-169.466456-675.085673 0l337.560757 337.591476 337.524916-337.591476zM414.909683 462.101885l-331.283652 331.442371c12.861408 19.425231 27.678651 37.918625 43.453331 55.838581l337.494197-337.524917-49.663876-49.756035zM318.080485 365.272687L21.832905 661.550986c7.423981 24.319939 17.023957 48.06132 28.15993 71.290702l317.684966-317.777126-49.597316-49.791875zM896.531519 174.302284L174.311244 896.578879c201.210377 176.890438 507.697931 169.758296 699.91249-22.364105 192.09168-192.15312 199.254542-498.640673 22.307785-699.91249z m-101.145347 431.666121l-161.699436 161.694316c23.372742 45.721486 15.94876 103.121662-22.307784 141.383326-38.271904 38.271904-95.677201 45.690766-141.393567 22.323145l105.082617-105.077498-52.996987-52.996987-105.077497 105.077497c-23.367622-45.721486-15.94364-103.126782 22.318024-141.388446s95.666961-45.685646 141.383326-22.318025l161.694316-161.689195c-23.362502-45.721486-15.94364-103.126782 22.318024-141.388447 38.271904-38.266784 95.672081-45.690766 141.388447-22.318024L801.023277 494.347564l52.986748 52.996988 105.082617-105.077498c23.367622 45.721486 15.93852 103.121662-22.318024 141.383327-38.266784 38.261664-95.672081 45.685646-141.388446 22.318024z"
			fill="" p-id="3996"></path></svg>
					</span>
					<span style="font-size:14px">预约人（{{v.registrar}}）</span>
				</th>
				<th>{{v.memberid}}</th>
				<th>{{v.name}}</th>
				<th>{{v.telephone}}</th>
				<th v-if="xs">{{v.street}}{{v.housenumber}}{{v.address}}</th>
				<th v-else>
					{{(v.street+v.housenumber+v.address).substr(0,(v.street+v.housenumber+v.address).length-4)}}
				</th>
				<th>{{v.viplevel}}</th>
				<th>{{v.customertype}}</th>
				<th>{{v.remarks}}</th>

			</tr>
			<tr v-if="v.isshow" class="scale-up-ver-top">
				<th colspan="7">
					<table class="table" style="font-weight: normal" v-if="v.showline">
						<tr>
							<th scope="col">选择</th>
							<th scope="col">商品</th>
							<th scope="col">数量</th>
							<th scope="col">方式</th>
							<th scope="col">安排方式</th>
							<th scope="col">配送员</th>
							<th scope="col">安排时间</th>
							<th scope="col">预约上门时间</th>
							<th scope="col">送达时间</th>
							<th scope="col">汇总时间</th>
							<th scope="col">状态</th>

							<th v-for="vi in v.suborder" v-if="vi.showline && vi.stateshow == '已汇总'" scope="col">操作</th>
						</tr>
						<tr v-for="(vi,ki) in v.suborder" v-if="vi.showline && vi.stateshow == '正常'">
							<td v-if="vi.stateshow == '正常'"><input type="checkbox" @click="checksuborder(index,ki)"
																   v-model="vi.ischeck"></td>
							<td v-else><input type="checkbox" disabled></td>
							<td>{{ vi.goodsname }}</td>
							<td>{{ vi.num }}</td>
							<td>{{ vi.mode }}</td>
							<td>{{ vi.distributionmode }}</td>
							<td>{{ vi.deliveryman }}</td>
							<td>{{ vi.arrangetime }}</td>
							<td>{{ v.appointmenttime }}</td>
							<td>{{ vi.arrivetime }}</td>
							<td>{{ vi.feedbacktime }}</td>
							<td>{{ vi.stateshow }}</td>
						</tr>
						<tr v-for="vi in v.suborder"
							v-if="vi.showline && vi.stateshow == '已安排'"
							class="yap">
							<td v-if="vi.stateshow == '正常'"><input type="checkbox" v-model="vi.ischeck"></td>
							<td v-else><input type="checkbox" disabled></td>
							<td @click="hzorder(vi,v,index)">{{ vi.goodsname }}</td>
							<td @click="hzorder(vi,v,index)">{{ vi.num }}</td>
							<td @click="hzorder(vi,v,index)">{{ vi.mode }}</td>
							<td @click="hzorder(vi,v,index)">{{ vi.distributionmode }}</td>
							<td @click="hzall(vi)" v-if="vi.deliveryman == '自提'">{{ vi.deliveryman }}</td>
							<td v-else @click="hzall(vi)">
								<span style="text-shadow: 1px 1px 1px #000;cursor: pointer">{{ vi.deliveryman }}</span><span style="font-size: 10px;color: black">批量汇总</span>
							</td>
							<td @click="hzorder(vi,v,index)">{{ vi.arrangetime }}</td>
							<td @click="hzorder(vi,v,index)">{{ v.appointmenttime }}</td>
							<td @click="hzorder(vi,v,index)">{{ vi.arrivetime }}</td>
							<td @click="hzorder(vi,v,index)">{{ vi.feedbacktime }}</td>
							<td @click="hzorder(vi,v,index)">{{ vi.stateshow }}</td>
						</tr>
						<tr v-for="vi in v.suborder" v-if="vi.showline && vi.stateshow == '已汇总'" class="yhz">
							<td v-if="vi.stateshow == '正常'"><input type="checkbox" v-model="vi.ischeck"></td>
							<td v-else><input type="checkbox" disabled></td>
							<td>{{ vi.goodsname }}</td>
							<td>{{ vi.num }}</td>
							<td>{{ vi.mode }}</td>
							<td>{{ vi.distributionmode }}</td>
							<td>{{ vi.deliveryman }}</td>
							<td>{{ vi.arrangetime }}</td>
							<td>{{ v.appointmenttime }}</td>
							<td>{{ vi.arrivetime }}</td>
							<td>{{ vi.feedbacktime }}</td>
							<td>{{ vi.stateshow }}</td>
							<td>
								<button class="btn btn-primary btn-sm" @click="CancelUserOrderHZ(v,vi)">取消汇总</button>
							</td>
						</tr>
						<tr v-for="vi in v.suborder" v-if="vi.showline && vi.stateshow == '取消'" class="qx">
							<td v-if="vi.stateshow == '正常'"><input type="checkbox" v-model="vi.ischeck"></td>
							<td v-else><input type="checkbox" disabled></td>
							<td>{{ vi.goodsname }}</td>
							<td>{{ vi.num }}</td>
							<td>{{ vi.mode }}</td>
							<td>{{ vi.distributionmode }}</td>
							<td>{{ vi.deliveryman }}</td>
							<td>{{ vi.arrangetime }}</td>
							<td>{{ v.appointmenttime }}</td>
							<td>{{ vi.arrivetime }}</td>
							<td>{{ vi.feedbacktime }}</td>
							<td>{{ vi.stateshow }}</td>
						</tr>
						<tr @click="hzorder(vi,v,index)" v-for="vi in v.suborder"
							v-if="vi.showline && vi.stateshow == '已送达'" class="yap">
							<td v-if="vi.stateshow == '正常'"><input type="checkbox" v-model="vi.ischeck"></td>
							<td v-else><input type="checkbox" disabled></td>
							<td>{{ vi.goodsname }}</td>
							<td>{{ vi.num }}</td>
							<td>{{ vi.mode }}</td>
							<td>{{ vi.distributionmode }}</td>
							<td>{{ vi.deliveryman }}</td>
							<td>{{ vi.arrangetime }}</td>
							<td>{{ v.appointmenttime }}</td>
							<td>{{ vi.arrivetime }}</td>
							<td>{{ vi.feedbacktime }}</td>
							<td>{{ vi.stateshow }}</td>
						</tr>
						<tr v-for="vi in v.suborder" v-if="vi.showline && vi.stateshow == '已接单'" class="yap">
							<td v-if="vi.stateshow == '正常'"><input type="checkbox" v-model="vi.ischeck"></td>
							<td v-else><input type="checkbox" disabled></td>
							<td>{{ vi.goodsname }}</td>
							<td>{{ vi.num }}</td>
							<td>{{ vi.mode }}</td>
							<td>{{ vi.distributionmode }}</td>
							<td>{{ vi.deliveryman }}</td>
							<td>{{ vi.arrangetime }}</td>
							<td>{{ v.appointmenttime }}</td>
							<td>{{ vi.arrivetime }}</td>
							<td>{{ vi.feedbacktime }}</td>
							<td>{{ vi.stateshow }}</td>
						</tr>
					</table>
				</th>
			</tr>
			</tbody>
		</table>
	</div>
	<!--	<v-table-->
	<!--		is-vertical-resize-->
	<!--		style="width:100%;"-->
	<!--		is-horizontal-resize-->
	<!--		:vertical-resize-offset='200'-->
	<!--		column-width-drag-->
	<!--		:columns="columns"-->
	<!--		:table-data="tableData"-->
	<!--		:row-click="rowClick"-->
	<!--		:column-cell-class-name="columnCellClass"-->
	<!--	></v-table>-->
	<!--	安排-->
	<div class="zz" v-if="ordershow"></div>
	<div :class="ordershow ? 'ap' : 'ap'" v-if="ordershow">
		<div class="row">

			<div :class="isscan ? 'col-md-6':'col-md-12'">
				<h4 class="mb-3">订单信息</h4>
				<form class="needs-validation" novalidate>
					<li class="list-group-item d-flex justify-content-between lh-condensed">
						<div>
							<h6 class="my-0">姓名: {{ mianorder.name }}</h6>
						</div>

					</li>
					<li class="list-group-item d-flex justify-content-between l¢ h-condensed">
						<div>
							<h6 class="my-0">电话: {{ mianorder.telephone }}</h6>
						</div>
					</li>
					<li class="list-group-item d-flex justify-content-between lh-condensed">
						<div>
							<h6 class="my-0">地址: {{ mianorder.address }}</h6>
						</div>
					</li>
					<li class="list-group-item d-flex justify-content-between bg-light">
						<div>
							<h6 class="my-0">内部备注: {{ mianorder.ope_remarks }}</h6>
						</div>
					</li>
					<li class="list-group-item d-flex justify-content-between bg-light">
						<div>
							<h6 class="my-0">备注: {{ mianorder.remarks }}</h6>
						</div>
					</li>
					<ul class="list-group mb-3" v-for="(v,index) in orderdata">

						<li class="list-group-item d-flex justify-content-between bg-light">
							<div>
								<h6 class="my-0">商品名称: {{ v.goodsname }}
									<svg
											v-if="goodsjson.length && goodsjson[index].goodscode.length == v.num && v.cat =='能源类'"
											t="1576725145886" class="icon" viewBox="0 0 1024 1024" version="1.1"
											xmlns="http://www.w3.org/2000/svg" p-id="2422" width="16" height="16">
										<path
												d="M997.888 70.144C686.592 261.12 460.8 502.272 358.912 623.104L110.08 428.032 0 516.608l429.568 437.248C503.296 764.416 737.792 394.24 1024 131.072l-26.112-60.928m0 0z"
												p-id="2423" fill="#198ceb"></path>
									</svg>
								</h6>
							</div>
						</li>
						<li class="list-group-item d-flex justify-content-between bg-light">
							<div>
								<h6 class="my-0">数量: {{ v.num }} &nbsp;&nbsp;&nbsp; 单价:{{ v.price }} &nbsp;&nbsp;&nbsp;
									小计: {{ v.num * v.price }}</h6>
							</div>
						</li>
					</ul>


					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="country">配送方式 </label>
							<select v-model="distributionmode" class="custom-select d-block w-100" required>
								<option value="营业员安排">营业员安排</option>
								<?php if (get_cookie('department') == '新塘桥店') { ?>
									<option value="配送员接单">配送员接单</option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-6 mb-3">
							<label for="country">配送员姓名 </label>

							<select v-if="!zt" v-model="deliveryman" class="custom-select d-block w-100" required>
								<option v-if="v.isshow" v-for="v in psylist" :value="v.name">{{ v.name }}</option>
							</select>
							<select v-else v-model="deliveryman" class="custom-select d-block w-100" required>
								<option selected value="自提">自提</option>
							</select>
						</div>
					</div>
					<button @click="submit" class="btn btn-light btn-lg btn-block" type="button">确认安排</button>
					<button v-if="!Number(order.isscan)" @click="close"
							class="btn btn-secondary btn-lg btn-block" type="button">返回
					</button>
				</form>
			</div>


			<div class="col-md-6" v-if="isscan">
				<h4 class="d-flex justify-content-between align-items-center mb-3">
					<span class="text-muted">编号</span>
					<span class="badge badge-secondary badge-pill">{{ num }}</span>
					<a href="#"><span @click="goods=[]" class="badge badge-danger badge-pill">清空</span></a>
				</h4>
				<ul class="list-group mb-3">
					<input style="margin-bottom: 10px" type="tel" v-model="goodsnum" @keyup.enter="scanning"
						   class="form-control" placeholder="输入编号" rows="2">
					<li v-for="v in goods" class="list-group-item d-flex justify-content-between lh-condensed">
						<div>
							<h6 class="my-0">{{ v.type }} : {{v.code.substring(v.code.length-6)}}</h6>
						</div>
					</li>
				</ul>
				<button @click="close" class="btn btn-secondary btn-lg btn-block" type="button">返回</button>
			</div>
		</div>

	</div>


	<!-- 汇总 -->
	<div class="zz" v-if="hzshow"></div>
	<div :class="hzshow?'ap':'ap scale-out-center'" v-if="hzshow">
		<div class="row">

			<div :class=" hzscan || hzrecovery || dx ? 'col-md-6':'col-md-12'">
				<h4 class="mb-3">订单信息</h4>
				<form class="needs-validation" novalidate>
					<ul class="list-group mb-2">
						<li class="list-group-item d-flex justify-content-between lh-condensed">
							<div>
								<h6 class="my-0">姓名: {{ hzmaindata.name }}</h6>
							</div>

						</li>
						<li class="list-group-item d-flex justify-content-between lh-condensed">
							<div>
								<h6 class="my-0">电话: {{ hzmaindata.telephone }}</h6>
							</div>
						</li>
						<li class="list-group-item d-flex justify-content-between lh-condensed">
							<div>
								<h6 class="my-0">地址: {{ hzmaindata.address }}</h6>
							</div>
						</li>
						<li class="list-group-item d-flex justify-content-between bg-light">
							<div>
								<h6 class="my-0">商品名称: {{ hzdata.goodsname }}</h6>
							</div>
						</li>
						<li class="list-group-item d-flex justify-content-between bg-light">
							<div>
								<h6 class="my-0">数量: {{ hzdata.num }} &nbsp;&nbsp;&nbsp; 单价:{{ Number(hzdata.price) }}
									&nbsp;&nbsp;&nbsp;
									小计: {{ hzdata.num * hzdata.price }}</h6>
							</div>
						</li>
						<li class="list-group-item d-flex justify-content-between bg-light">
							<div>
								<h6 class="my-0">内部备注: {{ hzmaindata.ope_remarks }}</h6>
							</div>
						</li>
						<li class="list-group-item d-flex justify-content-between bg-light">
							<div>
								<h6 class="my-0">备注: {{ hzmaindata.remarks }}</h6>
							</div>
						</li>
						<li class="list-group-item d-flex justify-content-between bg-light">
							<div>
								<h6 class="my-0">配送方式: {{ hzdata.distributionmode }}</h6>
							</div>
						</li>
						<li class="list-group-item d-flex justify-content-between bg-light">
							<div>
								<h6 class="my-0">配送员姓名: {{ hzdata.deliveryman }}</h6>
							</div>
						</li>

						<li v-if="Number(hzdata.pay_alipay)"
							class="list-group-item d-flex justify-content-between bg-light">
							<div>
								<h6 class="my-0">支付宝支付: {{ hzdata.pay_alipay }}</h6>
							</div>
						</li>
						<li v-if="Number(hzdata.pay_arrears)"
							class="list-group-item d-flex justify-content-between bg-light">
							<div>
								<h6 class="my-0">月结支付: {{ hzdata.pay_arrears }}</h6>
							</div>
						</li>

						<li v-if="Number(hzdata.pay_balance)"
							class="list-group-item d-flex justify-content-between bg-light">
							<div>
								<h6 class="my-0">余额支付: {{ hzdata.pay_balance }}</h6>
							</div>
						</li>
						<li v-if="Number(hzdata.pay_cash)"
							class="list-group-item d-flex justify-content-between bg-light">
							<div>
								<h6 class="my-0">现金支付: {{ hzdata.pay_cash }}</h6>
							</div>
						</li>
						<li v-if="Number(hzdata.pay_weixin)"
							class="list-group-item d-flex justify-content-between bg-light">
							<div>
								<h6 class="my-0">微信支付: {{ hzdata.pay_weixin }}</h6>
							</div>
						</li>
					</ul>

					<label for="qk"><input v-model="selfmention" type="checkbox"> 临时欠款</label>
					<button @click="hzsubmit" class="btn btn-light btn-lg btn-block" type="button">确认汇总</button>
					<button v-if="!hzscan" @click="hzclose"
							class="btn btn-secondary btn-lg btn-block" type="button">返回
					</button>
				</form>
			</div>


			<div class="col-md-6" v-if="hzscan || hzrecovery ">
				<h4 class="d-flex justify-content-between align-items-center mb-3">
					<span class="text-muted">编号</span>
					<span class="badge badge-secondary badge-pill">{{ hznum }}</span>
					<a href="#"><span @click="hzgoods=[]" class="badge badge-danger badge-pill">清空</span></a>
				</h4>
				<ul class="list-group mb-3">
					<input style="margin-bottom: 10px" type="tel" v-model="hzgoodsnum" @keyup.enter="hzscanning"
						   class="form-control" placeholder="输入编号" rows="2">
					<li v-for="v in hzgoods" class="list-group-item d-flex justify-content-between lh-condensed">
						<div>
							<h6 class="my-0">{{ v.substring(v.length-6) }}</h6>
						</div>
					</li>
				</ul>
				<button @click="hzclose" class="btn btn-secondary btn-lg btn-block" type="button">返回</button>
			</div>

			<div class="col-md-6" v-if="dx">
				<h4 class="d-flex justify-content-between align-items-center mb-3">
					<span class="text-muted">数量</span>
					<span class="badge badge-secondary badge-pill">{{ hzgoodszd.length }}</span>
					<a href="#"><span @click="hzgoodszd=[]" class="badge badge-danger badge-pill">清空</span></a>
				</h4>
				<ul class="list-group mb-3">
					<select style="margin-bottom: 10px" v-model="packingtype" name="" id="" class="form-control">
						<?php foreach ($_SESSION['initData']->Packingtype->info as $v) { ?>
							<option value="<?= $v->name ?>"><?= $v->name ?></option>
						<?php } ?>
					</select>
					<input style="margin-bottom: 10px" type="tel" v-model="hzgoodsnumzd" @keyup.enter="hzscanningzd"
						   class="form-control" placeholder="输入数量" rows="2">
					<li v-for="v in hzgoodszd" class="list-group-item d-flex justify-content-between lh-condensed">
						<div>
							<h6 class="my-0">{{v.packingtype}}:数量{{ v.num }}</h6>
						</div>
					</li>
				</ul>
				<button @click="hzclose" class="btn btn-secondary btn-lg btn-block" type="button">返回</button>
			</div>
		</div>

	</div>
	<div class="zz" v-if="hzallshow">

	</div>
	<div v-if="hzallshow" class=" p-6 bg-white position-fixed heallshow" style="z-index:99">
		<div class="row ml-3">
			<select class="form-control col-4" name="" id="" v-model="alltype">
				<option value="票据号">票据号</option>
				<option value="钢瓶码">钢瓶码</option>
			</select>
			<input @keyup.enter="allscan" v-model="allcode" type="text" class="form-control col-7 ml-1"
				   placeholder="票号或条码">
		</div>
		<div class="row ml-3 mt-3" style="min-height: 200px;">
			<table class="table table-hover table-sm" v-if="!canhz">
				<thead>
				<tr>
					<th scope="col">类型</th>
					<th scope="col">编码</th>
					<th scope="col">状态</th>
					<th scope="col">操作</th>
				</tr>
				</thead>
				<tbody>
				<tr v-for="(v,index) in allgoods">
					<td>{{v.type == 'bill'?'票据号':'钢瓶码'}}</td>
					<td>{{v.code.substring(v.code.length-6)}}</td>
					<td v-if="v.state==0">待验证</td>
					<td v-else-if="v.state==1" class="success">验证成功</td>
					<td v-else-if="v.state==2" class="danger">验证失败</td>
					<td>
						<button v-if="v.state==0" class="btn btn-sm btn-danger" @click="alldel(index)">删除</button>
					</td>
				</tr>

				</tbody>
			</table>
			<table class="table table-hover table-sm" v-else>
				<thead>
				<tr>
					<th scope="col">会员号</th>
					<th scope="col">商品名称</th>

					<th scope="col">数量</th>
					<th scope="col">现金收款</th>
					<th scope="col">状态</th>
					<th scope="col">欠款</th>
				</tr>
				</thead>
				<tbody>
				<tr v-for="(v,index) in canhzgoods">
					<td>{{v.memberid}}</td>
					<td>{{v.goodsname}}</td>

					<td>{{v.num}}</td>
					<td>{{v.pay_cash}}</td>
					<td v-if="v.statecode ==1" style="color: green" class="success">汇总成功！</td>
					<td v-else style="color: green" class="success">验证成功</td>
					<td>
						<label :for="'code' + v.id"><input type="checkbox" :id="'code' + v.id"
														   v-model="v.temporaryarrears">暂欠款</label>
					</td>
				</tr>

				<tr v-for="(v,index) in firehzgoods">
					<td v-if="v.type == 'material'">钢瓶码：</td>
					<td v-else>票据号：</td>
					<td>{{v.code}}</td>
					<td>{{v.num}}</td>
					<td>{{v.pay_cash}}</td>
					<td style="color: red" class="danger">验证失败</td>
					<td>

					</td>
				</tr>

				</tbody>
			</table>
		</div>
		<div class="row ml-3 mt-3">
			<button v-if="!canhz" @click="OrderComparisonInformation" class="btn-primary btn">验证</button>
			<button @click="allgoodshz" v-if="canhz" class="btn-primary btn">确认汇总</button>
			<span class="p-2">配送员: {{ alldeliveryman }}</span>
			<span class="ml-3" v-if="allhzprice">合计： <span style="font-size: 30px;font-weight: bold;color: red">{{ allhzprice }} </span></span>
			<span class="p-2" v-if="!canhz">数量：{{ allgoods.length }}</span>
		</div>
		<div class="row ml-3 mt-3">
			<button class="btn btn-disabled" @click="closeallhz">关闭</button>
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
			<input class="form-check-input" type="checkbox" v-model="state2" id="state2" value="option2">
			<label class="form-check-label" for="state2">已安排</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" v-model="state3" id="state3" value="option2">
			<label class="form-check-label" for="state3">已汇总</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" v-model="state4" id="state4" value="option2">
			<label class="form-check-label" for="state4">取消</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" v-model="state5" id="state5" value="option2">
			<label class="form-check-label" for="state5">已送达</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" v-model="state6" id="state6" value="option2">
			<label class="form-check-label" for="state6">已接单</label>
		</div>

		<div style="clear: both"></div>
		<br>
		<button @click="aporder" class="btn-primary btn" type="button">安排订单</button>
		<span class="pl-5" v-if="yjdpsylist.length">完成配送: <span @click="clearstorage(v.name)" v-for="v in yjdpsylist"
																class="badge badge-pill badge-info p-2 m-1"
																style="cursor: pointer">{{ v.name }}</span></span>
	</div>
	<p><a href="#" onclick="Win10_child.openUrl('/index.php/order/schedule2','安排订单新版')">新版入口</a></p>
</div>
<!-- 引入组件库 -->
<script src="<?php echo base_url(); ?>res/js/umd.js"></script>
<script src="<?php echo base_url(); ?>res/js/base64.js"></script>
<script>
	new Vue({
		el: '#suapp',
		data: {
			checkindex: 0,
			showindex: 0,
			ischeck: false,
			order: '',
			hzdata: '',
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
			state1(val) {
				this.getlist()
			},
			state2(val) {
				this.getlist()
			},
			state3(val) {
				this.getlist()
			},
			state4(val) {
				this.getlist()
			},
			state5(val) {
				this.getlist()
			},
			state6(val) {
				this.getlist()
			},
			ordershow(val) {
				if (!val) {
					this.zt = false;
					this.deliveryman = ''
				}
			},
			goods(data) {
				if (data.length == 0) {
					this.initgoodsjson()
				}
			},
			ppsynum(data) {
				var arr = [];
				var list = JSON.parse(JSON.stringify(this.psy));
				for (i in list) {
					var key = list[i].name;
					var val = localStorage.getItem(key);
					if (val) {
						if (((new Date()).valueOf() / 1000) - (val / 1000 + 10 * 60) > 0) {
							arr = arr.concat(list[i])
						}
					}
				}
				this.yjdpsylist = arr
			}
		},
		computed: {
			allhzprice() {
				var price = 0
				for (let i = 0; i < this.canhzgoods.length; i++) {
					price += Number(this.canhzgoods[i].pay_cash)
				}
				return price
			},
			psylist() {
				var num = this.ppsynum;
				var list = JSON.parse(JSON.stringify(this.psy));
				var arr = [];

				for (i in list) {
					var key = list[i].name;
					var val = localStorage.getItem(key);
					if (!val) {
						this.deliveryman = list[i]['name'];
						list[i]['isshow'] = true;
						arr = arr.concat(list[i]);
						continue
					}
					if (((new Date()).valueOf() / 1000) - (val / 1000 + 10 * 60) > 0) {
						list[i]['isshow'] = false;
						arr = arr.concat(list[i])
					} else {
						this.deliveryman = list[i]['name'];
						list[i]['isshow'] = true;
						arr = arr.concat(list[i])
					}
				}
				return arr;
			},
			scanlists() {
				var list = JSON.parse(JSON.stringify(this.goods));
				var scangodos = JSON.parse(JSON.stringify(this.scangodos));
				for (i in list) {
					for (j in scangodos) {
						if (list[i].type == scangodos[j].type) {
							scangodos[j].num++
						}
					}
				}
				return scangodos
			},
			num() {
				return this.goods.length
			},
			hznum() {
				return this.hzgoods.length
			},
			getstate() {
				return (this.state1 ? '正常,' : '') + (this.state2 ? '已安排,' : '') + (this.state3 ? '已汇总,' : '') + (this.state4 ? '取消,' : '') + (this.state5 ? '已送达,' : '') + (this.state6 ? '已接单' : '')
			},
			zc() {
				return this.state1 ? '正常' : ''
			},
			yap() {
				return this.state2 ? '已安排' : ''
			},
			yhz() {
				return this.state3 ? '已汇总' : ''
			},
			zlist() {
				var list = JSON.parse(JSON.stringify(this.tableData));

				//主订单显示影藏
				for (i in list) {
					var zlen = list[i].suborder.length;
					var num = 0;
					for (j in list[i].suborder) {
						if (list[i].suborder[j].showline) {
							num += 1
						}
					}
					list[i].num = num;
					if (num > 0) {
						list[i].showline = true
					} else {
						list[i].showline = false
					}
				}
				return list
			},
			mianorder() {
				var list = '';
				for (i in this.zlist) {
					for (j in this.zlist[i].suborder) {
						if (this.zlist[i].suborder[j].ischeck) {
							list = this.zlist[i]
						}
					}
				}
				return list
			},
			orderdata() {
				var list = [];
				var scangodos = [];
				for (i in this.zlist) {
					for (j in this.zlist[i].suborder) {
						if (this.zlist[i].suborder[j].ischeck && this.zlist[i].suborder[j].stateshow == '正常') {
							list = list.concat(this.zlist[i].suborder[j]);
							if (this.zlist[i].suborder[j].cat == '能源类') {
								scangodos = scangodos.concat({
									type: this.zlist[i].suborder[j].packingtype,
									num: 0
								})
							} else {
								scangodos = scangodos.concat({
									type: '未知',
									num: 0
								})
							}
						}
					}
				}
				this.scangodos = scangodos;
				return list
			},
			isscan() {
				for (i in this.orderdata) {
					if (this.orderdata[i].isscan == '1') {
						return true
					}
				}
				return false
			},

			hzscan() {
				if (this.hzdata.isscan == '1' && this.hzdata.distributionmode != '配送员接单') {
					return true
				}
				return false
			},
			hzrecovery() {
				if (this.hzdata.isrecovery == '1' && this.hzdata.distributionmode != '配送员接单') {
					return true
				}
				return false
			},
			dx() {
				if (this.hzdata.goodsid == 18 || this.hzdata.goodsid == 19 || this.hzdata.goodsid == 22) {
					return true
				}
				return false
			},
			scanlist() {
				var num = 0, typenum = 0, package = '';
				for (i in this.orderdata) {
					if (this.orderdata[i].cat == '能源类') {
						num += Number(this.orderdata[i].num);
						typenum++;
						package = this.orderdata[i].packingtype
					}

				}
				return {
					num: num,
					typenum: typenum,
					package: package
				}
			}

		},
		methods: {
			closeallhz() {
				this.hzallshow = false
				this.allgoods = []
				this.canhz = false
				this.alltype = '钢瓶码'
				this.canhzgoods = []
				this.firehzgoods = []
			},
			allgoodshz() {
				let that = this
				for (let i = 0; i < this.canhzgoods.length; i++) {
					setTimeout(function () {
						axios.post('/index.php/api/FeedbackOrder', {
							userid: that.canhzgoods[i].userid,
							memberid: that.canhzgoods[i].memberid,
							id: that.canhzgoods[i].id,
							serialpay: that.canhzgoods[i].serialpay,
							goodscode: that.canhzgoods[i].goodscode,
							temporaryarrears: that.canhzgoods[i].temporaryarrears ? '是' : '否',
						}).then(rew => {
							if (rew.data.code == 200) {
								that.canhzgoods[i].statecode = 1
								console.log(that.canhzgoods)
								if ((i + 1) == that.canhzgoods.length) {
									setTimeout(function () {
										swal('汇总完毕')
										that.closeallhz()
										that.getlist()
									}, 500)
								}
							} else {
								if ((i + 1) == that.canhzgoods.length) {
									setTimeout(function () {
										swal('汇总失败')
										that.closeallhz()
										that.getlist()
									}, 500)
								}
							}

						})
					}, 500 * i)
				}
			},
			hzall(data) {
				this.hzallshow = true
				this.alldeliveryman = data.deliveryman
				console.log(data)
			},
			CancelUserOrderHZ(mainorder, data) {

				let that = this;
				swal({
					title: '取消订单汇总状态',
					text: '',
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: '确定',
					cancelButtonText: '取消',
				}).then(function (dismiss) {
					if (dismiss.value) {
						axios.post('/index.php/api/CancelUserOrderHZ', {
							userid: mainorder.userid,
							serialpay: data.serial_pay,
						}).then(rew => {
							if (rew.data.code == 200) {
								swal('取消汇总成功')
							} else {
								swal('取消汇总失败')
							}
							that.getlist()
						})
					}
				})
			},
			clearstorage(name) {
				let that = this;
				swal({
					title: '确认操作',
					text: '',
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: '确定',
					cancelButtonText: '取消',
				}).then(function (dismiss) {
					if (dismiss.value) {
						localStorage.removeItem(name);
						that.ppsynum++
					}
				})
			},
			hzorder(data, idata, index) {
				if (data.distributionmode == '配送员接单' && data.stateshow == '已安排') {
					return false
				}
				this.hzshow = true;
				this.hzdata = data;
				this.hzmaindata = idata;
				this.showindex = index;
			},
			checksuborder(k, ki) {
				this.tableData[k].suborder[ki].ischeck = !this.tableData[k].suborder[ki].ischeck;
				for (i in this.tableData) {
					if (i != k) {
						this.tableData[i].ischeck = false;
						for (j in this.tableData[i].suborder) {
							this.tableData[i].suborder[j].ischeck = false
						}
					}
				}
			},
			aporder() {
				this.ppsynum++;
				if (!this.orderdata.length) {
					alert('请勾选订单');
					return false
				}
				this.initgoodsjson();
				this.ordershow = true;
				if (this.orderdata[0].deliveryman == '自提') {
					this.zt = true;
					this.deliveryman = '自提'
				}
			},
			initgoodsjson() {
				var json = [];
				var order = JSON.parse(JSON.stringify(this.orderdata));
				for (i in order) {
					var goods = [];
					for (j in this.goods) {
						if (order[i].packingtype.indexOf(this.goods[j].type) != -1 && goods.length != order[i].num) {
							goods = goods.concat({
								code: this.goods[j].code
							})
						}
					}
					json = json.concat({
						id: order[i].id,
						serial_pay: order[i].serial_pay,
						type: order[i].packingtype,
						goodscode: []
					})
				}
				this.goodsjson = json;
			},
			checkd(index, ischeck) {
				this.show(index);
				for (i in this.tableData) {
					if (i == index) {
						this.tableData[i].ischeck = !this.tableData[i].ischeck;
						for (j in this.tableData[i].suborder) {
							this.tableData[i].suborder[j].ischeck = this.tableData[i].ischeck
						}
					} else {
						this.tableData[i].ischeck = false;
						for (j in this.tableData[i].suborder) {
							this.tableData[i].suborder[j].ischeck = false
						}
					}

				}
				this.checkindex = index + 1;
				this.showindex = index;
				this.ischeck = !ischeck
			},
			show(index) {
				for (i in this.tableData) {
					this.tableData[i].isshow = false
				}
				this.tableData[index].isshow = true
			},
			scanning() {
				//去掉回车空格
				var num = (this.goodsnum.replace(/[\r\n]/g, "")).replace(/\ +/g, "");
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
			addgoodsjson(data) {
				for (i in this.goodsjson) {
					if (this.goodsjson[i].type.indexOf(data.type) != -1 && this.goodsjson[i].goodscode.length != this.orderdata[i].num) {
						this.goodsjson[i].goodscode = this.goodsjson[i].goodscode.concat({code: data.code});
						break
					}
				}
			},
			hzscanning() {
				//去掉回车空格
				var num = (this.hzgoodsnum.replace(/[\r\n]/g, "")).replace(/\ +/g, "");
				if (num) {
					if (!this.isHasHz(num)) {
						this.hzgoods = this.hzgoods.concat(num);
						this.hzgoodsnum = ''
					} else {
						this.hzgoodsnum = ''
					}
				}

			},
			hzscanningzd() {
				//去掉回车空格
				var num = (this.hzgoodsnumzd.replace(/[\r\n]/g, "")).replace(/\ +/g, "");
				if (num) {
					if (!this.isHasHz(num)) {
						this.hzgoodszd = this.hzgoodszd.concat({
							packingtype: this.packingtype,
							num: num,
						});
						this.hzgoodsnumzd = ''
					} else {
						this.hzgoodsnumzd = ''
					}
				}

			},
			allscan() {
				//去掉回车空格
				var num = (this.allcode.replace(/[\r\n]/g, "")).replace(/\ +/g, "");
				if (num) {
					if (!this.isHasallHz(num)) {
						if (this.alltype == '钢瓶码') {
							this.allgoods = this.allgoods.concat({
								type: 'material',
								material: num,
								code: num,
								state: 0
							});
						} else {
							this.allgoods = this.allgoods.concat({
								type: 'bill',
								bill: num,
								code: num,
								state: 0
							});
						}
						this.allcode = ''
					} else {
						this.allcode = ''
					}
				}

			},
			alldel(index) {
				this.allgoods.splice(index, 1)
			},
			OrderComparisonInformation() {
				axios.post('/index.php/api/OrderComparisonInformation', {
					codelist: this.allgoods,
					distributionmode: '营业员安排',
					deliveryman: this.alldeliveryman
				}).then(rew => {
					if (rew.data.code == 200) {
						this.canhz = true
						this.canhzgoods = rew.data.list.info
						this.firehzgoods = rew.data.list.errorinfo
					}
				})
			},
			close() {
				this.order = '';
				this.goodsnum = '';
				this.goods = [];
				this.ordershow = false;
				this.goodsjson = [];
				for (i in this.scangodos) {
					this.scangodos[i].num = 0
				}
			},
			hzclose() {
				this.hzdata = '';
				this.hzmaindata = '';
				this.hzgoodsnum = '';
				this.hzgoodsnumzd = '';
				this.hzgoods = [];
				this.hzgoodszd = [];
				this.hzshow = false
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
			submit() {
				var deliveryman = this.deliveryman;
				axios.post('/index.php/api/creatorOrderPL', {
					info: this.goodsjson,
					userid: this.mianorder.userid,
					memberid: this.mianorder.memberid,
					serial: this.mianorder.serial,
					distributionmode: this.distributionmode,
					deliveryman: deliveryman,
				}).then(rew => {
					if (rew.data.code == 200) {
						let that = this;
						this.close();
						this.getlist();
						setTimeout(function () {
							that.msg = '安排成功';
							that.successmsg = true;
							localStorage.setItem(deliveryman, (new Date()).valueOf());
							that.ppsynum++;
							if (that.distributionmode == "营业员安排") {
								that.myprint(rew.data.msg.data.printinfo)
							}
						}, 1000)
					} else {
						this.close();
						this.getlist();
						let that = this;
						setTimeout(function () {
							that.msg = '安排失败';
							that.successmsg = true
						}, 1000)
					}
				})
			},
			hzsubmit() {
				axios.post('/index.php/api/hzOrder', {
					order: this.hzmaindata,
					data: this.hzdata,
					goods: this.hzgoods,
					selfmention: this.selfmention,
					distributionmode: this.distributionmode,
					deliveryman: this.deliveryman,
					goodszd: this.hzgoodszd,
				}).then(rew => {
					if (rew.data.code == 200) {
						let that = this;
						this.hzclose();
						this.getlist();
						this.selfmention = false;
						setTimeout(function () {
							that.msg = '汇总成功';
							that.successmsg = true
						}, 1000)
					} else {
						this.hzclose();
						this.getlist();
						this.selfmention = false;
						let that = this;
						setTimeout(function () {
							that.msg = '汇总失败';
							that.successmsg = true
						}, 1000)
					}
				})
			},
			getlist() {
				this.sx = true;
				axios.post('/index.php/api/getOrderList', {
					state: this.getstate
				}).then(rew => {
					this.tableData = rew.data.data;
					this.psy = rew.data.psy;
					this.deliveryman = this.psy[0]['name'];
					this.sx = false;
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
			refreshs() {
				this.getlist();
				this.successmsg = false
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
						residualindex: parseFloat(data.pay_weixin)>0?'微信付款：'+data.pay_weixin+'元':data.userotherinfo,
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
			setString(str, len) {
				var strlen = 0;
				var s = "";
				for (var i = 0; i < str.length; i++) {
					if (str.charCodeAt(i) > 128) {
						strlen += 2;
					} else {
						strlen++;
					}
					s += str.charAt(i);
					if (strlen >= len) {
						return s;
					}
				}
				return s;
			},
			keydown () {
				if (this.checkindex < this.zlist.length) {
					document.getElementById('textarea').scrollTop =  100 + this.checkindex * 30
					this.checkd(this.checkindex++,this.ischeck)
				}

			},

		},
		created() {
			// console.log(Base64.encode(JSON.stringify({id:1})))
			this.getlist()
		}

	})
</script>

</body>
</html>

