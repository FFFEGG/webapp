<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
	<title>NNGAS</title>
	<link rel='Shortcut Icon' type='image/x-icon' href=''>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
	<link href="<?php echo base_url(); ?>/res/css/animate.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/component/layer-v3.0.3/layer/layer.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/component/font-awesome-4.7.0/css/font-awesome.min.css">
	<link href="<?php echo base_url(); ?>/res/css/default.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/win10.js"></script>
	<style>
		* {
			font-family: "Microsoft YaHei", 微软雅黑, "MicrosoftJhengHei", 华文细黑, STHeiti, MingLiu
		}

		/*磁贴自定义样式*/
		.win10-block-content-text {
			line-height: 44px;
			text-align: center;
			font-size: 16px;
		}

		.oper {
			position: fixed;
			bottom: 60px;
			right: 10px;
			background: white;
			background: rgba(255, 255, 255, 0.4);
			border-radius: 3px;
			z-index: 88;
			padding: 20px;
			font-weight: bold;
			border: 3px dashed white;
			box-shadow: 1px 1px 2px #333;
		}

		.layui-row {
			display: flex;
			padding: 5px 0;

		}

		.layui-col-lg6 {
			opacity: 1;
			color: white;
			min-width: 100px;
			text-align: left;
			padding-bottom: 5px;
			text-shadow: 0px 0px 1px black;
		}

		.fbgg {
			position: fixed;
			right: 10px;
			top: 380px;
			background: rgba(255, 109, 46, 0.88);
			border-radius: 3px;
			text-align: justify;
			padding: 10px 30px;
			font-size: 20px;
			font-weight: bold;
			color: #b3d7ff;
			box-shadow: 1px 1px 1px white;
			z-index: 100;
		}

		.sxgg {
			position: fixed;
			right: 170px;
			top: 380px;
			background: rgba(217, 108, 255, 0.88);
			border-radius: 3px;
			text-align: justify;
			padding: 10px 30px;
			font-size: 20px;
			font-weight: bold;
			color: #b3d7ff;
			box-shadow: 1px 1px 1px white;
			z-index: 100;
		}

		.slide-in-bottom {
			-webkit-animation: slide-in-bottom 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
			animation: slide-in-bottom 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
		}

		@-webkit-keyframes slide-in-bottom {
			0% {
				-webkit-transform: translateY(1000px);
				transform: translateY(1000px);
				opacity: 0;
			}
			100% {
				-webkit-transform: translateY(0);
				transform: translateY(0);
				opacity: 1;
			}
		}

		@keyframes slide-in-bottom {
			0% {
				-webkit-transform: translateY(1000px);
				transform: translateY(1000px);
				opacity: 0;
			}
			100% {
				-webkit-transform: translateY(0);
				transform: translateY(0);
				opacity: 1;
			}
		}

		.msg {
			position: fixed;
			background: white;
			bottom: 100px;
			right: 10px;
			z-index: 9999999999999;
			width: 200px;
			height: 150px;
			padding: 40px
		}

		.hidden {
			display: none;
		}
	</style>
	<script>
      Win10.onReady(function () {

        //设置壁纸
        Win10.setBgUrl({
          main: '<?php echo base_url();?>/res/img/wallpapers/main.jpg',
          mobile: '<?php echo base_url();?>/res/img/wallpapers/mobile.jpg',
        })

        Win10.setAnimated([
          'animated flip',
          'animated bounceIn',
        ], 0.01)
      })
	</script>
</head>
<body>
<div id="win10">
	<div class="fbgg" onclick="Win10.openUrl('/index.php/msg/gg','发布公告')">
		发布公告
	</div>
	<div class="sxgg" onclick="window.location.reload()">刷新公告</div>
	<div class="desktop">
		<div id="win10-shortcuts" class="shortcuts-hidden">
			<div class="shortcut" onclick="Win10.openUrl('/index.php/users/info','用户基本信息')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/users.png"/>
				<div class="title">用户查询</div>
			</div>

			<div class="shortcut" onclick="Win10.openUrl('/index.php/user/usermanagement','用户业务办理')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/users.png"/>
				<div class="title">用户业务办理</div>
			</div>

			<div class="shortcut" onclick="Win10.openUrl('/index.php/user/likeslink','模糊查询')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/userinfo.png"/>
				<div class="title">模糊查询</div>
			</div>

			<div class="shortcut" onclick="Win10.openUrl('/index.php/order/lists','订单业务','max')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/msgicon%20(2).png"/>
				<div class="title">订单业务</div>
			</div>

			<div class="shortcut" onclick="Win10.openUrl('/index.php/user/address','用户地址')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/addresses.png"/>
				<div class="title">用户地址</div>
			</div>

			<div class="shortcut" onclick="Win10.openUrl('/index.php/order/schedule','安排订单','max')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/suorder.png"/>
				<div class="title">安排订单</div>
			</div>


			<div class="shortcut" onclick="Win10.openUrl('/index.php/user/open_account','开户办卡')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/opencard.png"/>
				<div class="title">开户办卡</div>
			</div>

			<div class="shortcut" onclick="Win10.openUrl('/index.php/user/recharge','会员充值')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/chongzhi.png"/>
				<div class="title">会员充值</div>
			</div>

			<div class="shortcut" onclick="Win10.openUrl('/index.php/appointment/repair','维修列表')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/wx.png"/>
				<div class="title">维修列表</div>
			</div>


			<div class="shortcut" onclick="Win10.openUrl('/index.php/allocation/plan','调拨计划')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db1.png"/>
				<div class="title">调拨计划(液化气)</div>
			</div>


			<div class="shortcut" onclick="Win10.openUrl('/index.php/allocation/planlist','调拨信息')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db2.png"/>
				<div class="title">调拨信息(液化气)</div>
			</div>

			<div class="shortcut" onclick="Win10.openUrl('/index.php/allocation/AllocationMaterielFlow','上传钢瓶')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db3.png"/>
				<div class="title">收发钢瓶</div>
			</div>

			<div class="shortcut" onclick="Win10.openUrl('/index.php/allocation/materflow','物资流向')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db3.png"/>
				<div class="title">物资流向</div>
			</div>

			<div class="shortcut" onclick="Win10.openUrl('/index.php/allocation/dispatch','物资调运')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db4.png"/>
				<div class="title">物资调运(液化气)</div>
			</div>


			<div class="shortcut" onclick="Win10.openUrl('/index.php/allocation/dispatchwater','物资调运')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">物资调运(桶装水)</div>
			</div>

			<div class="shortcut" onclick="Win10.openUrl('/index.php/allocation/dispatchwaterxs','普通销售品')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">物资调运(普通销售品)</div>
			</div>


			<div class="shortcut" onclick="Win10.openUrl('/index.php/sys/index','系统参数设置')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">系统参数设置</div>
			</div>


			<div class="shortcut" onclick="Win10.openUrl('/index.php/order/monitoring','订单监控')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">订单监控</div>
			</div>


			<div class="shortcut" onclick="Win10.openUrl('/index.php/user/CallRecord','用户来电信息')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">用户来电信息</div>
			</div>


			<div class="shortcut" onclick="Win10.openUrl('/index.php/msg/snslist','SNS绑定列表')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">SNS绑定列表</div>
			</div>

			<div class="shortcut" onclick="Win10.openUrl('/index.php/msg/DepartmentSecurityCheckRecord','部门安检记录')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">部门安检记录</div>
			</div>


			<div class="shortcut" onclick="Win10.openUrl('/index.php/user/UserInvoiceRecord','开票')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">开票</div>
			</div>


			<div class="shortcut" onclick="Win10.openUrl('/index.php/msg/SnsUserRepairList','三方平台用户维修信息')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">三方平台用户维修信息</div>
			</div>


			<div class="shortcut" onclick="Win10.openUrl('/index.php/msg/UserGoodsArrearsRecord','用户欠款信息')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">用户欠款信息</div>
			</div>


			<div class="shortcut" onclick="Win10.openUrl('/index.php/msg/PackingtypeCirculationInfo','钢瓶流转信息')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">钢瓶流转信息</div>
			</div>


			<div class="shortcut" onclick="Win10.openUrl('/index.php/msg/OrderPrintList','订单打印列表')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">订单打印列表</div>
			</div>


			<div class="shortcut" onclick="Win10.openUrl('/index.php/msg/AllocationMaterielFlow','查询调拨物资信息')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">查询调拨物资信息</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/msg/OpeStock?department=<?= get_cookie('department') ?>','查询部门员工商品包装物库存信息')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">查询部门员工商品包装物库存信息</div>
			</div>


			<div class="shortcut" onclick="Win10.openUrl('/index.php/msg/tables','财务报表')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">财务报表</div>
			</div>

			<div class="shortcut" onclick="Win10.openUrl('/index.php/msg/DepartmentRaffinateInfo','部门残液信息')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">部门残液信息</div>
			</div>


			<div class="shortcut" onclick="Win10.openUrl('/index.php/msg/StaffArrearsRecord','员工欠款记录')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">员工欠款记录</div>
			</div>

			<div class="shortcut" onclick="Win10.openUrl('/index.php/msg/DepartmentPersonnelWorkload','员工工作量')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">员工工作量</div>
			</div>
			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/allocation/AppointmentUserDepartmentRepair','预约用户维修业务')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">预约用户维修业务</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/allocation/UserDepartmentRepairInfo?endtime=<?= date('Y-m-d') ?>','用户部门维修记录')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">用户部门维修记录</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/allocation/DepartmentRepairList?endtime=<?= date('Y-m-d') ?>','部门维修列表')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">部门维修列表</div>
			</div>


			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/msg/GPxiulou?endtime=<?= date('Y-m-d') ?>','钢瓶修漏查询')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">钢瓶修漏查询</div>
			</div>
			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/msg/OpeLoginRecord?endtime=<?= date('Y-m-d') ?>','员工登录记录')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">员工登录记录</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/allocation/UserRefund?endtime=<?= date('Y-m-d') ?>','用户退款')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">用户退款</div>
			</div>


			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/msg/DeliveryError?endtime=<?= date('Y-m-d') ?>','配送错误瓶信息')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">配送错误瓶信息</div>
			</div>


			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/msg/ReservationCenterCQCS?endtime=<?= date('Y-m-d') ?>',' 催气催水统计')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title"> 催气催水统计</div>
			</div>


			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/msg/ReservationCenterCallWorkload?endtime=<?= date('Y-m-d') ?>',' 员工电话工作量')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">员工电话工作量</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/msg/ReservationCenterWorkload?endtime=<?= date('Y-m-d') ?>','  员工工作量')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">预约中心员工工作量</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/msg/ExpandManageSale?endtime=<?= date('Y-m-d') ?>','  拓展部销售统计')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">拓展部销售统计</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/msg/DepartmentWaterBill?endtime=<?= date('Y-m-d') ?>','  水票核销报表')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">水票核销报表</div>
			</div>
			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/msg/DepartmentReceivables?endtime=<?= date('Y-m-d') ?>','  门店收款报表')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">门店收款报表</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/msg/DepartmentGoodsStock?endtime=<?= date('Y-m-d') ?>','  门店商品物资库存报表')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">门店商品物资库存报表</div>
			</div>
			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/msg/DepartmentGoodsSale?endtime=<?= date('Y-m-d') ?>','  门店商品物资销售报表')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">门店商品物资销售报表</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/msg/CommercialManageSale?endtime=<?= date('Y-m-d') ?>','  部门管理用户销售报表')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">部门管理用户销售报表</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/msg/CommercialSalesmanNewUserSale?endtime=<?= date('Y-m-d') ?>','  部门管理新用户销售报表')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">部门管理新用户销售报表</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/msg/DepartmentCanCancelBusinessRecord?endtime=<?= date('Y-m-d') ?>','  门店可取消记录')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">门店可取消记录</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/msg/RecyclingMaterials?endtime=<?= date('Y-m-d') ?>','  门店收回用户钢瓶物资')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">门店收回用户钢瓶物资</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/allocation/UpdateArchives?endtime=<?= date('Y-m-d') ?>','  更新钢瓶档案')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">更新钢瓶档案</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/msg/GetArchives','  获取钢瓶档案信息')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">获取钢瓶档案信息</div>
			</div>
			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/msg/ArchivesList?endtime=<?= date('Y-m-d') ?>','  钢瓶档案列表')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">钢瓶档案列表</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/msg/DepartmentApplyeDeliverymanSubsidyRecord?endtime=<?= date('Y-m-d') ?>','配送员补贴记录')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">配送员补贴记录</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/msg/DepartmentCanApplyeDeliverymanSubsidyRecord?endtime=<?= date('Y-m-d') ?>','可申请配送员补贴记录')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">可申请配送员补贴记录</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/ywpage/DepartmentQualitySpotCheckRecord?endtime=<?= date('Y-m-d') ?>','门店钢瓶质量抽查记录')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">门店钢瓶质量抽查记录</div>
			</div>


			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/allocation/RetailLogisticsDeliverymanDalary?endtime=<?= date('Y-m-d') ?>','零售后勤配送员薪酬')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">零售后勤配送员薪酬</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/allocation/RetailLogisticsDeliverymanDalary?endtime=<?= date('Y-m-d') ?>','零售后勤配送员薪酬')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">零售后勤配送员薪酬</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/commercialgas/CommerciaUserInfoList?endtime=<?= date('Y-m-d') ?>','添加走访任务')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">添加走访任务</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/commercialgas/CommerciaUserTaskRecord?endtime=<?= date('Y-m-d') ?>','商用气用户任务记录')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">商用气用户任务记录</div>
			</div>


			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/map/index?endtime=<?= date('Y-m-d') ?>','地图')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">地图</div>
			</div>


			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/appointment/test?endtime=<?= date('Y-m-d') ?>','测试')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">测试</div>
			</div>


			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/ywpage/ReprintCodeRecord?endtime=<?= date('Y-m-d') ?>','门店录入条码补打记录')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">门店录入条码补打记录</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/transportpage/TransportationMaterial?endtime=<?= date('Y-m-d') ?>','物资流转录入')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">物资流转录入</div>
			</div>


			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/transportpage/TransportationStock?endtime=<?= date('Y-m-d') ?>','运输公司库存管理查询')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">运输公司库存管理查询</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/transportpage/InspectionStationStock?endtime=<?= date('Y-m-d') ?>','容检厂库存管理查询')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">容检厂库存管理查询</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/xxzx/SplitUserWarehouseGoods?endtime=<?= date('Y-m-d') ?>','拆分用户库存商品')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">拆分用户库存商品</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/appointment/GiveUserWarehouseGoods?endtime=<?= date('Y-m-d') ?>','赠送桶装水')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">赠送桶装水</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/xxzx/EditUserCollateralCharge?endtime=<?= date('Y-m-d') ?>','编辑抵押物费用')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">编辑抵押物费用</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/xxzx/EditUserCollateral?endtime=<?= date('Y-m-d') ?>','编辑用户抵押物')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">编辑用户抵押物</div>
			</div>


			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/xxzx/UserFreightList?endtime=<?= date('Y-m-d') ?>','用户运费列表')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">用户运费列表</div>
			</div>


			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/transportpage/TransportationDriverCommissionAllocation?endtime=<?= date('Y-m-d') ?>','运输公司司机调拨运费装卸费')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">运输公司司机调拨运费装卸费</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/transportpage/TransportationDriverCommissionDirect?endtime=<?= date('Y-m-d') ?>','运输公司司机直送运费装卸费')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">运输公司司机直送运费装卸费</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/transportpage/TransportationDriverCommissionConsignment?endtime=<?= date('Y-m-d') ?>','运输公司司机代销运费装卸费')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">运输公司司机代销运费装卸费</div>
			</div>


			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/commercialgas/CommerciaUserTaskRecordSummary?endtime=<?= date('Y-m-d') ?>','商用气公司用户汇总任务记录(表一)')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">商用气公司用户汇总任务记录(表一)</div>
			</div>


			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/commercialgas/CommerciaSalesmanTaskRecordSummary?endtime=<?= date('Y-m-d') ?>','商用气公司业务员汇总任务记录(表二)')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">商用气公司业务员汇总任务记录(表二)</div>
			</div>


			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/commercialgas/CommerciaUserDiscountSummary?endtime=<?= date('Y-m-d') ?>','商用气公司业务员汇总任务记录(表三)')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">商用气公司业务员汇总任务记录(表三)</div>
			</div>


			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/commercialgas/CommerciaUserSecurityCheckSummary?endtime=<?= date('Y-m-d') ?>','商用气公司业务员汇总任务记录(表五)')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">商用气公司业务员汇总任务记录(表五)</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/commercialgas/CommerciaUserNoDealSummary?endtime=<?= date('Y-m-d') ?>','商用气公司业务员汇总任务记录(表八)')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">商用气公司业务员汇总任务记录(表八)</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/commercialgas/CommerciaUserOweCollateralSummary?endtime=<?= date('Y-m-d') ?>','商用气公司业务员汇总任务记录(表十)')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">商用气公司业务员汇总任务记录(表十)</div>
			</div>


			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/commercialgas/CommerciaUserUserSaleDifferenceSummary?endtime=<?= date('Y-m-d') ?>','商用气公司业务员汇总任务记录(表十二)')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">商用气公司业务员汇总任务记录(表十二)</div>
			</div>

			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/commercialgas/CommerciaSalesmanUserSaleSummary?endtime=<?= date('Y-m-d') ?>','商用气公司业务员汇总任务记录(表十四)')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">商用气公司业务员汇总任务记录(表十四)</div>
			</div>




			<div class="shortcut" onclick="Win10.openUrl('/index.php/order/DirectSales','门店直售','max')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/msgicon%20(2).png"/>
				<div class="title">门店直售</div>
			</div>


			<a onclick="logout()" class="shortcut">
				<svg t="1586848384998" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1801" width="200" height="200"><path d="M173 873.3c-11 0-20-9-20-20V173.9c0-11 9-20 20-20h320.7c11 0 20-9 20-20v-15c0-11-9-20-20-20H153h-35c-11 0-20 9-20 20v809.3h395.7c11 0 20-9 20-20v-15c0-11-9-20-20-20H173z" fill="#2680F0" p-id="1802"></path><path d="M609.3 273.3c-7.8-7.8-7.8-20.5 0-28.3l10.6-10.6c7.8-7.8 20.5-7.8 28.3 0l264.9 264.9c7.8 7.8 7.8 20.5 0 28.3L648.4 792.8c-7.8 7.8-20.5 7.8-28.3 0l-10.6-10.6c-7.8-7.8-7.8-20.5 0-28.3l199-199c7.8-7.8 5.1-14.1-5.9-14.1H326.1c-11 0-20-9-20-20v-15c0-11 9-20 20-20h475.7c11 0 13.6-6.4 5.9-14.1L609.3 273.3z" fill="#2680F0" p-id="1803"></path></svg>
				<div class="title">退出登录</div>
			</a>


			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/msg/AreaDeliverymanList','配送员名单')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">配送员名单<div>
			</div>
		</div>
		<div id="win10-desktop-scene"></div>
	</div>

	<div id="win10-menu" class="hidden">
		<div class="list win10-menu-hidden animated animated-slideOutLeft">
			<div class="item"
				 onclick="window.location.href='<?php echo base_url(); ?>/res/hiprint%2064bit%20Setup%201.0.0.exe'">
				<i class="black icon fa fa-download"></i><span class="title">下载打印插件</span>
			</div>

			<div class="item"
				 onclick="Win10.openUrl('/index.php/user/editpassword','修改密码')">
				<i class="black icon fa fa-assistive-listening-systems"></i><span class="title">修改密码</span>
			</div>

		</div>

		<div id="win10-menu-switcher"></div>
	</div>
	<div id="win10_command_center" class="hidden_right">
		<div class="title">
			<h4 style="float: left">来电记录 </h4>
			<span id="win10_btn_command_center_clean_all">全部清除</span>
		</div>
		<div class="msgs" id="telmsgs">

		</div>
	</div>
	<div id="win10_task_bar">
		<div id="win10_btn_group_left" class="btn_group">
			<div id="win10_btn_win" class="btn"><span class="fa fa-windows"></span></div>
			<div class="btn" id="win10-btn-browser"><span class="fa fa-internet-explorer"></span></div>
		</div>
		<div id="win10_btn_group_middle" class="btn_group"></div>
		<div id="win10_btn_group_right" class="btn_group">
			<div class="btn" id="win10_btn_time"></div>
			<div class="btn" id="win10_btn_command"><span id="win10-msg-nof" class="fa fa-comment-o"></span></div>
			<div class="btn" id="win10_btn_show_desktop"></div>
		</div>
	</div>
	<div
		style="width: 300px;height: 300px;position: fixed;right: 10px;top: 10px;background: rgba(255,255,255,0.8);border-radius: 3px">
		<p style="background: black;color: white;margin: 0;padding: 5px"><i class="fa fa-newspaper-o icon red"></i> 最新公告
		</p>
		<div class="ggcontent" style="padding: 3px 15px;font-size: 13px">
			<p><?= $gg['title'] ?></p>
			<p style="font-size: 12px;font-weight: bold">

				<?= $gg['content'] ?>
			</p>
			<p><?= $gg['addtime'] ?></p>
			<p><?= $gg['issuer'] ?>发布</p>
		</div>

	</div>
	<div
		style="width: 300px;height: 50px;position: fixed;right: 10px;top: 320px;background: rgba(255,255,255,0.8);border-radius: 3px">
		<button class="s" style="width: 49%;height: 50px;background: none">上一页</button>
		<button class="x" style="width: 49%;height: 50px;background: none">下一页</button>
	</div>


	<div class="oper">
		<div class="layui-row" style="margin-left: 15px">
			<div class="layui-col-lg6">所属公司:</div>
			<div class="layui-col-lg6"><?= $_SESSION['company']['name'] ?></div>
		</div>

		<div class="layui-row" style="margin-left: 15px">
			<div class="layui-col-lg6">部门:</div>
			<div class="layui-col-lg6"><?= get_cookie('department') ?></div>
		</div>
		<div class="layui-row" style="margin-left: 15px">
			<div class="layui-col-lg6">工号:</div>
			<div class="layui-col-lg6"><?= $_SESSION['users']->opeid ?></div>
		</div>
		<div class="layui-row" style="margin-left: 15px">
			<div class="layui-col-lg6">姓名:</div>
			<div class="layui-col-lg6"><?= $_SESSION['users']->name ?></div>
		</div>
		<?php if (get_cookie('seatno')) { ?>
			<div class="layui-row" style="margin-left: 15px">
				<div class="layui-col-lg6">坐席号:</div>
				<div class="layui-col-lg6"><?= get_cookie('seatno') ?></div>
			</div>
		<?php } ?>

	</div>
</div>
<div class="slide-in-bottom msg hidden">
	<span onclick="closemsg()" style="position: fixed;right: 12px;bottom: 200px;cursor: pointer">X</span>
	<div>
		消息提醒
		<p class="msgtitle"></p>
	</div>
	<a href="#" onclick="myopen()">立即查看>></a>
</div>
<input type="hidden" value="<?= $page ?>" class="page">
<input type="hidden" value="<?= $count ?>" class="count">
</body>


<script>

  tellist()//电话列表
  var ws = new WebSocket('<?= $this->config->item('ws_url')?>')
  //心跳检测
  var heartCheck = {
    timeout: 30000, //9分钟发一次心跳
    timeoutObj: null,
    serverTimeoutObj: null,
    reset: function () {
      clearTimeout(this.timeoutObj)
      clearTimeout(this.serverTimeoutObj)
      return this
    },
    start: function () {
      var self = this
      this.timeoutObj = setTimeout(function () {
        //这里发送一个心跳，后端收到后，返回一个心跳消息，
        //onmessage拿到返回的心跳就说明连接正常
        ws.send('ping')
        console.log('ping!')
        self.serverTimeoutObj = setTimeout(function () { //如果超过一定时间还没重置，说明后端主动断开了
          console.log('try=close')
          ws.close() //这里为什么要在send检测消息后，倒计时执行这个代码呢，因为这个代码的目的时为了触发onclose方法，这样才能实现onclose里面的重连方法
          //所以这个代码也很重要，没有这个方法，有些时候发了定时检测消息给后端，后端超时（我们自己设定的时间）后，不会自动触发onclose方法。我们只有执行ws.close()代码，让ws触发onclose方法
          //的执行。如果没有这个代码，连接没有断线的情况下而后端没有正常检测响应，那么浏览器时不会自动超时关闭的（比如谷歌浏览器）,谷歌浏览器会自动触发onclose
          //是在断网的情况下，在没有断线的情况下，也就是后端响应不正常的情况下，浏览器不会自动触发onclose，所以需要我们自己设定超时自动触发onclose，这也是这个代码的
          //的作用。

        }, self.timeout)
      }, this.timeout)
    }
  }

  //申请一个WebSocket对象，参数是服务端地址，同http协议使用http://开头一样，WebSocket协议的url使用ws://开头，另外安全的WebSocket协议使用wss://开头
  ws.onopen = function () {
    //当WebSocket创建成功时，触发onopen事件
    ws.send(JSON.stringify({Type: '请求绑定', Code: "<?= $_SESSION['wskey']?>"})) //将消息发送到服务端
    heartCheck.reset().start() //心跳检测重置
  }
  ws.onmessage = function (e) {
    heartCheck.reset().start() //拿到任何消息都说明当前连接是正常的
    //当客户端收到服务端发来的消息时，触发onmessage事件，参数e.data包含server传递过来的数据
    let data = JSON.parse(e.data)
    console.log(data)
    if (data.Type && data.Type == '电话提醒' && '<?= get_cookie('department')?>' == '预约中心') {
      var lasttel = JSON.parse(localStorage.getItem('lasttel'))
      if (lasttel && ((Date.parse(new Date()) - lasttel.time) <= 5000)) {
        return false
      }
      data.time = Date.parse(new Date())
      Win10.openUrl('/index.php/user/likeslink?keytype=电话&keyword=' + data.TelePhone, '用户查询')
      let arr = localStorage.getItem('telmsgs') ? JSON.parse(localStorage.getItem('telmsgs')) : []
      arr = arr.concat(data)
      localStorage.setItem('lasttel', JSON.stringify(data))
      localStorage.setItem('telmsgs', JSON.stringify(arr))
      tellist()
    }

    if (data.Type == '推送消息' && data.title) {
      document.getElementsByClassName("msg")[0].classList.remove("hidden")
      document.getElementsByClassName("msgtitle")[0].innerHTML = data.title
      localStorage.setItem('msgtitle',data.title);
    }
  }
  ws.onclose = function (e) {
    //当客户端收到服务端发送的关闭连接请求时，触发onclose事件
    console.log('close')
    alert('连接断开，F5刷新尝试重新连接')
    window.location.href = '/index.php/login'
  }
  ws.onerror = function (e) {
    //如果出现连接、处理、接收、发送数据失败的时候触发onerror事件
    console.log('error' + error)
    alert('连接断开，F5刷新尝试重新连接')
    window.location.href = '/index.php/login'
  }

  function timetrans (date) {
    var date = new Date(date)//如果date为13位不需要乘1000
    var Y = date.getFullYear() + '-'
    var M = (date.getMonth() + 1 < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1) + '-'
    var D = (date.getDate() < 10 ? '0' + (date.getDate()) : date.getDate()) + ' '
    var h = (date.getHours() < 10 ? '0' + date.getHours() : date.getHours()) + ':'
    var m = (date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes()) + ':'
    var s = (date.getSeconds() < 10 ? '0' + date.getSeconds() : date.getSeconds())
    return Y + M + D + h + m + s
  }

  function userinfo (tel) {
    Win10.openUrl('/index.php/user/likeslink?keytype=电话&keyword=' + tel, '用户查询')
  }

  function tellist () {
    var list = JSON.parse(localStorage.getItem('telmsgs')) ? JSON.parse(localStorage.getItem('telmsgs')) : []
    var str = ''
    var listreverse = list.reverse()
    for (let i = 0; i < listreverse.length; i++) {
      str += '<div onclick="userinfo(' + listreverse[i].TelePhone + ')" style="padding: 10px;background: #555;margin-bottom: 3px">'
      str += ' <text>电话：' + listreverse[i].TelePhone + '</text>'
      str += '<br>'
      str += '<text>时间：' + timetrans(listreverse[i].time) + '</text>'
      str += ' </div>'
    }

    var div = document.getElementById('telmsgs')
    div.innerHTML = str

    if (list.length > 200) {
      list.slice(199, list.length - 200)
      localStorage.setItem('telmsgs', JSON.stringify(list))
    }
  }
  function closemsg () {
    document.getElementsByClassName("msg")[0].classList.add("hidden")
  }

  function myopen () {
	var title = localStorage.getItem("msgtitle")

	if (title == '用户请求绑定提醒') {
      Win10.openUrl('/index.php/msg/snslist','SNS绑定列表')
	}
    if (title == '门店新维修订单提醒') {
      Win10.openUrl('/index.php/allocation/DepartmentRepairList?endtime=<?= date('Y-m-d')?>','门店新维修订单提醒')
    }
    if (title == '订单未知门店提醒') {
      Win10.openUrl('/index.php/order/monitoring','订单监控')
    }
    closemsg()
  }
</script>


<script>
  $('.s').click(function () {
    var page = $('.page').val()
    var count = $('.count').val()
    if (page == 0) {
      alert('第一页')
      return false
    }

    $.ajax({
      url: '/index.php/api/getgg',
      method: 'POST',
      dataType: 'json',
      data: {
        page: Number(page) - 1
      },
      success: function (rew) {
        adddata(rew.data)
        $('.page').val(Number(page) - 1)
      }
    })
  })

  $('.x').click(function () {
    var page = $('.page').val()
    var count = $('.count').val()
    if (count - page == 1) {
      alert('最后一页')
      return false
    }

    $.ajax({
      url: '/index.php/api/getgg',
      method: 'POST',
      dataType: 'json',
      data: {
        page: Number(page) + 1
      },
      success: function (rew) {
        adddata(rew.data)
        $('.page').val(Number(page) + 1)
      }
    })
  })

  function adddata (data) {
    var str = ''
    str += '<p>' + data.title + '</p>'
    str += '<p style="font-size: 12px;font-weight: bold">' + data.content + '</p>'
    str += '<p>' + data.addtime + '</p>'
    str += '<p>' + data.issuer + '发布</p>'
    $('.ggcontent').html(str)
  }

  function logout() {
	  $.ajax({
		  url: '/index.php/api/logout',
		  method: 'post',
		  success: function (rew) {
			  window.location.reload()
		  }
	  })
  }
</script>
</html>
