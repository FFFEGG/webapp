<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends HomeBase
{

	public function login()
	{
		$post = object_array(json_decode(file_get_contents('php://input', 'r')));

		$client = $this->config->item('client');
//
		$rew = $this->mypost($this->config->item('api_url'), [
			'companyid' => 101,
			'client' => $client,
			'opeid' => $post['username'],
			'password' => md5($post['username'] . '_SR_' . $post['password']),
			'service' => 'Srproject.Web_GetInfo.OperatorLogin'
		]);

		if ($rew->data->msg == 'SUCCESS') {
			$res = $this->mypost($this->config->item('api_url'), [
				'companyid' => 101,
				'client' => $client,
				'opeid' => $post['username'],
				'service' => 'Srproject.Web_GetInfo.InitalData'
			]);
			exit(json_encode([
				'code' => 200,
				'data' => $rew->data,
				'initdata' => $res->data
			]));
		}
	}


	public function getgg()
	{

		$list = $this->mypost($this->config->item('api_url'), [
			'service' => 'Srproject.Web_GetSystemInfo.BulletinBoard',
			'state' => '正常',
			'opeid' => $_SESSION['users']->opeid,
			'operator' => $_SESSION['users']->name,
		]);
		$page = $this->input->post('page');
		exit(json_encode([
			'data' => object_array($list->data->info[$page])
		]));
	}

	public function getUserinfoByGui()
	{
		$post = object_array(json_decode(file_get_contents('php://input', 'r')));
		//用户详情
		$rew = $this->mypost($this->config->item('api_url'), array(
			'service' => 'Srproject.Web_GetInfo.UserBasicInfo',
			'companyid' => $post['companyid'],
			'memberid' => $post['memberid'],
			'client' => $this->config->item('client'),
			'opeid' => $post['opeid']
		));


		if ($rew->data->msg == 'SUCCESS') {
			$rew->data->info->stateshow = getstate($rew->data->info->state);

			$addlist = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.UserAddressInfo',
				'companyid' => $post['companyid'],
				'userid' => $rew->data->info->id,
				'state' => '正常',
				'client' => $this->config->item('client'),
				'opeid' => $post['opeid']
			));

			exit(json_encode([
				'code' => 200,
				'data' => object_array($rew->data->info),
				'addlist' => object_array($addlist->data->info),
			]));
		} else {
			exit(json_encode([
				'code' => 400
			]));
		}


	}


	public function getaddress()
	{
		$post = object_array(json_decode(file_get_contents('php://input', 'r')));
		//用户详情
		$rew = $this->mypost($this->config->item('api_url'), array(
			'service' => 'Srproject.Web_GetInfo.UserBasicInfo',
			'companyid' => $post['companyid'],
			'memberid' => $post['memberid'],
			'client' => $this->config->item('client'),
			'opeid' => $post['opeid']
		));


		$addlist = $this->mypost($this->config->item('api_url'), array(
			'service' => 'Srproject.Web_GetInfo.UserAddressInfo',
			'companyid' => $post['companyid'],
			'userid' => $rew->data->info->id,
			'state' => '正常',
			'client' => $this->config->item('client'),
			'opeid' => $post['opeid']
		));
		exit(json_encode([
			'code' => 200,
			'addlist' => object_array($addlist->data->info),
		]));

	}

	public function getmyinitdata()
	{
		$plan = $this->getPlans();
		exit(json_encode([
			'code' => 200,
			'data' => object_array($_SESSION['initData']),
			'plan' => $plan
		]));
	}


	public function saveadd()
	{
		$arr = object_array(json_decode(file_get_contents('php://input', 'r')));

		$arr['service'] = 'Srproject.Web_OperationalData.UserAddressInfo';
		$arr['action'] = 'UPDATE';
		$arr['client'] = $this->config->item('client');

		$rew = $this->mypost($this->config->item('api_url'), $arr);

		exit(json_encode([
			'code' => 200,
			'data' => object_array($rew)
		]));

	}

	public function getUserInfocheck()
	{
		$post = $this->input->post();
		$UserOrderCondition = $this->getUserOrderConditionMemberid($post['cardid']);
		exit(json_encode([
			'code' => 200,
			'data' => object_array($UserOrderCondition['info_basic']),
		]));
	}


	public function getUserAddress()
	{
		$post = $this->getpost();
		$UserOrderCondition = $this->getUserOrderConditionMemberid($post['cardid']);
		exit(json_encode([
			'code' => 200,
			'list' => object_array($UserOrderCondition['info_address']),
		]));
	}

	public function getUserInfos()
	{
		$post = json_decode(file_get_contents('php://input', 'r'));

//		$user = $this->getUserInfo($post->cardid);
//		echo '<pre>';
//		var_dump($user);
//		die;
//
//		if ($user['id'] == 0) {
//			exit(json_encode([
//				'code' => 400
//			]));
//		}

//		$UserOrderCondition = $this->getUserOrderCondition($user['id']);
		$UserOrderCondition = $this->getUserOrderConditionMemberid($post->cardid);
		$UserOrderCondition['info_basic']['stateshow'] = getstate($UserOrderCondition['info_basic']['sstate']);
		$addresses = $UserOrderCondition['info_address'];

		//商品促销方案
		$promotion = $UserOrderCondition['info_goodssales'];

		//库存提货
		$goodswarehouse = $UserOrderCondition['info_goodswarehouse'];


		$warehouse = [];
		foreach ($goodswarehouse as $v) {
			if ($v['goodsid'] != 0 && $v['num'] != 0) {
				$v['goods'] = $this->findGoodsById($v['goodsid']);
				$warehouse[] = $v;
			}
		}

		$arr = [];
		foreach ($promotion as $v) {
			$time = returnDate(time());

			if ($v['state'] == 5 && returnDate(strtotime($v['strattime'])) <= $time && returnDate(strtotime($v['endtime'])) >= $time) {
				$arr[] = $v;
			}
		}

		exit(json_encode([
			'code' => 200,
			'data' => object_array($UserOrderCondition['info_basic']),
			'addresses' => object_array($addresses),
			'promotion' => $promotion,
			'warehouse' => $warehouse,
			'charge' => $UserOrderCondition['info_chargelist'],
			'info_remind' => json_decode($UserOrderCondition['info_remind']),
			'chargeFK' => $UserOrderCondition['info_chargeFK']
		]));
	}


	public function createrorder()
	{
		$post = object_array(json_decode(file_get_contents('php://input', 'r')));

		$post['service'] = 'Srproject.Web_OperationalData.CreateUserOrder';

		$post['department'] = get_cookie('department');


		$post['goodsjson'] = json_encode($post['goodsjson']);

		$post['operator'] = $_SESSION['users']->name;

		$post['client'] = $this->config->item('client');

		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200
			]));
		} else {
			echo '<pre>';
			print_r($rew);
			die;
		}
	}

	public function DirectSales()
	{
		$post = object_array(json_decode(file_get_contents('php://input', 'r')));

		$post['service'] = 'Srproject.Web_OperationalData.DirectSales';

		$post['department'] = get_cookie('department');
		$post['total'] = $post['ordertotal'];


		$post['goodsjson'] = json_encode($post['goodsjson']);

		$post['operator'] = $_SESSION['users']->name;

		$post['client'] = $this->config->item('client');

		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'printinfo' => $rew->data->printinfo
			]));
		} else {
			echo '<pre>';
			print_r($rew);
			die;
		}
	}


	public function getOrderList()
	{

		$psy = $this->getPsyList();
		$post = object_array(json_decode(file_get_contents('php://input', 'r')));

		$rew = $this->mypost($this->config->item('api_url'), [
			'service' => 'Srproject.Web_GetInfo.OrderList',
			'companyid' => $this->input->cookie('companyid'),
			'departmentid' => $this->input->cookie('department'),
			'department' => $this->input->cookie('department'),
			'state' => $post['state'],
			'client' => $this->config->item('client'),
			'opeid' => $_SESSION['users']->opeid
		]);

//		$sublist = object_array($rew->data->info->suborderlist);
//		$manlist = object_array($rew->data->info->mainorderlist);
//
//		foreach ($sublist as $k => $v) {
//			foreach ($manlist as $vi) {
//				if ($v['serial'] == $vi['serial']) {
//					$sublist[$k]['main'] = $vi;
//					$sublist[$k]['mainmemberid'] = $vi['memberid'];
//					$sublist[$k]['mainname'] = $vi['name'];
//					$sublist[$k]['telephone'] = $vi['telephone'];
////					$sublist[$k]['mainaddress'] = $vi['province'].$vi['city'].$vi['area'].$vi['street'].$vi['town'].$vi['address'];
//					$sublist[$k]['mainaddress'] = $vi['address'];
//					$sublist[$k]['viplevel'] = $vi['viplevel'];
//					$sublist[$k]['customertype'] = $vi['customertype'];
//
//				}
//			}
//			$sublist[$k]['state'] = getstate($v['state']);
//		}

		$sublist = object_array($rew->data->info->info);

		foreach ($sublist as $k => $v) {
			$sublist[$k]['isshow'] = false;
			$sublist[$k]['ischeck'] = false;
			$sublist[$k]['showline'] = true;
			$sublist[$k]['gas'] = 0;
			$sublist[$k]['water'] = 0;
			$sublist[$k]['goods'] = 0;
			foreach ($sublist[$k]['suborder'] as $ki => $vi) {
				$sublist[$k]['suborder'] [$ki]['ischeck'] = false;
				$sublist[$k]['suborder'] [$ki]['stateshow'] = getstate($vi['state']);
				$sublist[$k]['suborder'] [$ki]['showline'] = true;
				if ($vi['goodstype'] == '液化气') {
					$sublist[$k]['gas'] += $vi['num'];
				}

				if ($vi['goodstype'] == '桶装水' || $vi['goodstype'] == '支装水') {
					$sublist[$k]['water'] += $vi['num'];
				}

				if ($vi['goodstype'] == '配件') {
					$sublist[$k]['goods'] += $vi['num'];
				}
			}

		}
//		$sublist[0]['isshow'] = true;
		exit(json_encode([
			'code' => 0,
			'message' => "",
			'count' => count($sublist),
			'data' => $sublist,
			'psy' => $_SESSION['AreaDeliverymanList']
		]));
	}

	public function getOrderListtransportpage()
	{

		$post = object_array(json_decode(file_get_contents('php://input', 'r')));

		$rew = $this->mypost($this->config->item('api_url'), [
			'service' => 'Srproject.Web_GetInfo.OrderList',
			'companyid' => $this->input->cookie('companyid'),
			'departmentid' => $this->input->cookie('department'),
			'department' => $this->input->cookie('department'),
			'state' => implode(',', $post['state']),
			'customertype' => $post['customertype'],
			'client' => $this->config->item('client'),
			'opeid' => $_SESSION['users']->opeid
		]);

		$sublist = object_array($rew->data->info->info);
		$arr = [];
		foreach ($sublist as $k => $v) {

			foreach ($sublist[$k]['suborder'] as $ki => $vi) {
				unset($v['suborder']);
				$v['fulladdress'] = $v['street'] . $v['town'] . $v['address'];
				$vi['mainmsg'] = $v;
				$vi['state'] = getstate($vi['state']);
				$arr [] = $vi;
			}

		}
		foreach ($arr as $k => $v) {
			$list[$v['state']][] = $v;
		}

		foreach ($list as $k => $v) {
			foreach ($v as $ki => $vi) {
				$zlist[$k][$vi['mainmsg']['regionalcode']][] = $vi;
			}
		}

		foreach ($zlist as $v) {
			foreach ($v as $vi) {
				foreach ($vi as $vii) {
					if ($vii['mainmsg']['appointmenttime'] > date('Y-m-d',time() + 86400)) {
						$vii['ismt'] = ($vii['state'] == '正常' ? true : false);
					} else {
						$vii['ismt'] = false;
					}
					$zlists[] = $vii;
				}
			}
		}

		exit(json_encode([
			'code' => 0,
			'message' => "",
			'count' => count($zlists),
			'data' => $zlists,
			'psy' => $_SESSION['AreaDeliverymanList']
		]));
	}


	public function getYYOrderList()
	{

		$wxy = $this->getWxy();
		$rew = $this->mypost($this->config->item('api_url'), [
			'service' => 'Srproject.Web_GetInfo.RepairList',
			'companyid' => $this->input->cookie('companyid'),
			'begintime' => '2010-01-01',
			'endtime' => date('Y-m-d H:i:s', time()),
			'departmentid' => $this->input->cookie('department'),
			'department' => $this->input->cookie('department'),
			'state' => '全部',
			'client' => $this->config->item('client'),
			'opeid' => $_SESSION['users']->opeid
		]);

		$list = object_array($rew->data->info);

		foreach ($list as $k => $v) {
			$list[$k]['state'] = getstate($v['state']);
			$list[$k]['address'] = $list[$k]['street'] . $list[$k]['housenumber'] . $list[$k]['address'];
		}

		exit(json_encode([
			'code' => 0,
			'message' => "",
			'count' => count($list),
			'data' => $list,
			'RepairPartsGoods' => $_SESSION['initData']->RepairPartsGoods->info,
			'wxy' => $wxy
		]));
	}


	public function creatorOrder()
	{
		$post = $this->getpost();
		$arr = [];
		foreach ($post['goods'] as $v) {
			$arr[] = [
				'code' => $v
			];
		}
		if (count($arr)) {
			$goodscode = json_encode($arr);
		} else {
			$goodscode = '';
		}


		$rew = $this->mypost($this->config->item('api_url'), [
			'service' => 'Srproject.Web_OperationalData.ArrangeOrder',
			'userid' => $post['order']['main']['userid'],
			'memberid' => $post['order']['main']['memberid'],
			'id' => $post['order']['id'],
			'serialpay' => $post['order']['serial_pay'],
			'distributionmode' => $post['distributionmode'],
			'deliveryman' => $post['deliveryman'],
			'goodscode' => $goodscode,
			'department' => get_cookie('department'),
			'companyid' => get_cookie('companyid'),
			'operator' => $_SESSION['users']->name,
			'opeid' => $_SESSION['users']->opeid,
			'client' => $this->config->item('client'),
		]);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew->data->msg
			]));
		}
	}


	public function creatorOrderPL()
	{

		$post = $this->getpost();


		$rew = $this->mypost($this->config->item('api_url'), [
			'service' => 'Srproject.Web_OperationalData.ArrangeOrderPL',
			'userid' => $post['userid'],
			'memberid' => $post['memberid'],
			'distributionmode' => $post['distributionmode'],
			'serial' => $post['serial'],
			'deliveryman' => $post['deliveryman'],
			'feieprint' => $post['feieprint'],
			'info' => json_encode($post['info']),
			'department' => get_cookie('department'),
			'companyid' => get_cookie('companyid'),
			'operator' => $_SESSION['users']->name,
			'opeid' => $_SESSION['users']->opeid,
			'client' => $this->config->item('client'),
		]);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'msg' => $rew
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}


	public function createWxOrder()
	{
		$post = $this->getpost();
		$posts = array_merge($post, $this->getHeards());
		$posts['list'] = json_encode($posts['list']);
		$posts['service'] = 'Srproject.Web_OperationalData.FeedbackUserRepair';


		$rew = $this->mypost($this->config->item('api_url'), $posts);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew->data->msg
			]));
		}


	}

	public function FeedbackOrder()
	{
		$post = $this->getpost();


		$post['department'] = get_cookie('department');
		$post['companyid'] = get_cookie('companyid');
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;
		$post['client'] = $this->config->item('client');
		$post['goodscode'] = json_encode($post['goodscode']);
		$post['service'] = 'Srproject.Web_OperationalData.FeedbackOrder';
		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function hzOrder()
	{

		$post = $this->getpost();

		$arr = [];
		foreach ($post['goods'] as $v) {
			if (strpos($v, '*') !== false || strpos($v, '-') !== false || strpos($v, '+') !== false || strpos($v, 'http') !== false) {
				$arr[] = [
					'type' => 'material',
					'code' => $v
				];
			} else {
				$arr[] = [
					'type' => 'bill',
					'code' => $v
				];
			}

		}


		if (count($arr)) {
			$goodscode = json_encode($arr);
		} else {
			$goodscode = '';
		}

		if (count($post['goodszd'])) {
			$expandrecovery = json_encode($post['goodszd']);
			$goodscode = '';
		} else {
			$expandrecovery = '';
		}


		$rew = $this->mypost($this->config->item('api_url'), [
			'service' => 'Srproject.Web_OperationalData.FeedbackOrder',
			'userid' => $post['order']['userid'],
			'memberid' => $post['order']['memberid'],
			'id' => $post['data']['id'],
			'serialpay' => $post['data']['serial_pay'],
			'distributionmode' => $post['distributionmode'],
			'deliveryman' => $post['deliveryman'],
			'temporaryarrears' => $post['selfmention'] ? '是' : '',
			'goodscode' => $goodscode,
			'expandrecovery' => $expandrecovery,
			'department' => get_cookie('department'),
			'companyid' => get_cookie('companyid'),
			'operator' => $_SESSION['users']->name,
			'opeid' => $_SESSION['users']->opeid,
			'client' => $this->config->item('client'),
		]);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}


	}

	public function updateaddress()
	{
		$post = $this->getpost();
		$arr = $post['address'];
		$arr['service'] = 'Srproject.Web_OperationalData.UserAddressInfo';
		$arr['action'] = 'UPDATE';
		$arr['department'] = get_cookie('department');
		$arr['departmentid'] = $post['md'];
		$arr['memberid'] = $post['memberid'];
		$arr['operator'] = $_SESSION['users']->name;
		$arr['client'] = $this->config->item('client');
		$arr['opeid'] = $_SESSION['users']->opeid;
		$rew = $this->mypost($this->config->item('api_url'), $arr);
		echo '<pre>';
		print_r($rew);
		die;
	}

	public function transportpagehzOrder()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_OperationalData.FeedbackOrder';
		$post['department'] = get_cookie('department');
		$post['operator'] = $_SESSION['users']->name;
		$post['client'] = $this->config->item('client');
		$post['opeid'] = $_SESSION['users']->opeid;
		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}


	public function creatPreferential()
	{

		if (IS_AJAX) {
			$post = $this->input->post();

			$post['service'] = 'Srproject.Web_OperationalData.ApplyeUserGoodsSalespromotion';
			$post['companyid'] = get_cookie('companyid');
			$post['authorized'] = getoneUserByOpeid($post['authorizedopeid'])['name'];
			$post['department'] = get_cookie('department');
			$post['operator'] = $_SESSION['users']->name;
			$post['opeid'] = $_SESSION['users']->opeid;
			$post['client'] = $this->config->item('client');
			$post['goodsname'] = $this->findGoodsById($post['goodsid'])['name'];

			$rew = $this->mypost($this->config->item('api_url'), $post);

			if ($rew->data->msg == 'SUCCESS') {
				exit(json_encode([
					'code' => 200
				]));
			} else {
				exit(json_encode([
					'code' => 400
				]));
			}
		}
	}


	public function recharge()
	{
		if (IS_AJAX) {
			$post = $this->input->post();

			$post['service'] = 'Srproject.Web_OperationalData.UserRecharge';
			$post['department'] = get_cookie('department');
			$post['companyid'] = get_cookie('companyid');
			$post['operator'] = $_SESSION['users']->name;
			$post['client'] = $this->config->item('client');
			$post['opeid'] = $_SESSION['users']->opeid;
			$rew = $this->mypost($this->config->item('api_url'), $post);

			if ($rew->data->msg == 'SUCCESS') {
				exit(json_encode([
					'code' => 200,
					'printinfo' => $rew->data->printinfo
				]));
			} else {
				exit(json_encode([
					'code' => 400
				]));
			}
		}
	}

	public function WxOrder()
	{
		$post = $this->getpost();
		foreach ($post['order'] as $v) {
			$arr['jsondata'][] = [
				'id' => $v['id'],
				'serial' => $v['serial']
			];
		}
		$arr['jsondata'] = json_encode($arr['jsondata']);
		$arr['maintenanceman'] = $post['wxyname'];
		$arr['feieprint'] = $post['feieprint'] ? '是' : '否';
		$arr['service'] = 'Srproject.Web_OperationalData.HandleUserRepair';
		$arr['department'] = get_cookie('department');
		$arr['companyid'] = get_cookie('companyid');
		$arr['operator'] = $_SESSION['users']->name;
		$arr['client'] = $this->config->item('client');
		$arr['opeid'] = $_SESSION['users']->opeid;
		$rew = $this->mypost($this->config->item('api_url'), $arr);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'printinfo' => $rew->data->PrintInfo
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'$rew' => $rew
			]));
		}
	}


	public function ApplyeUserCollateralSalespromotion()
	{
		if (IS_AJAX) {
			$post = $this->input->post();

			$post['service'] = 'Srproject.Web_OperationalData.ApplyeUserCollateralSalespromotion';
			$post['department'] = get_cookie('department');
			$post['goodsname'] = $this->findDyhById($post['goodsid'])['name'];
			$post['authorized'] = getoneUserByOpeid($post['authorizedopeid'])['name'];
			$post['companyid'] = get_cookie('companyid');
			$post['operator'] = $_SESSION['users']->name;
			$post['client'] = $this->config->item('client');
			$post['opeid'] = $_SESSION['users']->opeid;
			$rew = $this->mypost($this->config->item('api_url'), $post);
			if ($rew->data->msg == 'SUCCESS') {
				exit(json_encode([
					'code' => 200
				]));
			} else {
				exit(json_encode([
					'code' => 400
				]));
			}
		}
	}


	public function ApplyeUserCollateralChargeSalespromotion()
	{
		if (IS_AJAX) {
			$post = $this->input->post();

			$post['service'] = 'Srproject.Web_OperationalData.ApplyeUserCollateralChargeSalespromotion';
			$post['department'] = get_cookie('department');
			$post['companyid'] = get_cookie('companyid');
			$post['operator'] = $_SESSION['users']->name;
			$post['client'] = $this->config->item('client');
			$post['opeid'] = $_SESSION['users']->opeid;
			$post['authorized'] = getoneUserByOpeid($post['authorizedopeid'])['name'];
			$rew = $this->mypost($this->config->item('api_url'), $post);
			if ($rew->data->msg == 'SUCCESS') {
				exit(json_encode([
					'code' => 200
				]));
			} else {
				exit(json_encode([
					'code' => 400
				]));
			}
		}
	}


	/**
	 * 添加备注
	 * @return
	 */
	public function addremarks()
	{
		if (IS_AJAX) {
			$post = $this->input->post();

			$post['service'] = 'Srproject.Web_OperationalData.AddUserRemarks';
			$post['department'] = get_cookie('department');
			$post['companyid'] = get_cookie('companyid');
			$post['operator'] = $_SESSION['users']->name;
			$post['client'] = $this->config->item('client');
			$post['opeid'] = $_SESSION['users']->opeid;
			$post['userid'] = $post['snsuserid'];
			$rew = $this->mypost($this->config->item('api_url'), $post);

			if ($rew->data->msg == 'SUCCESS') {
				exit(json_encode([
					'code' => 200
				]));
			} else {
				exit(json_encode([
					'code' => 400
				]));
			}
		}
	}


	public function createRepairOrder()
	{
		$post = $this->getpost();

		$post['service'] = 'Srproject.Web_OperationalData.AppointmentUserRepair';
		$post['department'] = get_cookie('department');
		$post['operator'] = $_SESSION['users']->name;
		$post['client'] = $this->config->item('client');
		$post['opeid'] = $_SESSION['users']->opeid;
		$rew = $this->mypost($this->config->item('api_url'), $post);
		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function getuploadmaterinfo()
	{
		$post = $this->getpost();
		$order = Mydecode($post['info']);

		foreach ($_SESSION['initData']->Goods->info as $v) {
			$packingtype = explode(',', $order['packingtype']);
			if (count($packingtype) > 1) {
				if ($v->packingtype == $packingtype[0] || $v->packingtype == $packingtype[1]) {
					$order['isscan'] = $v->isscan;
				}
			} else {
				if ($v->packingtype == $order['packingtype']) {
					$order['isscan'] = $v->isscan;
				}
			}
			if ($order['packingtype'] == 'YSP28.6型钢瓶,YSP35.5型钢瓶' || $order['packingtype'] == 'YSP35.5型钢瓶,YSP28.6型钢瓶') {
				$order['isscan'] = 1;
			}

		}
		if ($order['isscan'] == '0') {
			for ($i = 0; $i < $order['num']; $i++) {
				$arr[] = [
					'code' => "000000",
					'packingtype' => '18.5升水桶',
					'type' => $order['suttle'] > 0 ? '重' : '空',
					'shownum' => '000000'
				];
			}
		}


		$order['goodsjson'] = $arr;
		exit(json_encode([
			'data' => $order,
			'initData' => object_array($_SESSION['initData'])
		]));
	}


	public function uploadmaterinfo()
	{
		$post = $this->getpost();
		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_OperationalData.HandoverMaterielInfo';
		$posts['serial'] = $post['order']['serial'];
		$posts['car_no'] = $post['order']['car_no'];
		$posts['receiver'] = $post['order']['department'];
		$posts['brokerage'] = $post['order']['brokerage'];
		$posts['receiver'] = $post['order']['source'];
		$posts['mode'] = $post['order']['source'] == get_cookie('department') ? '出库' : '入库';
		$posts['type'] = $post['type'];
		$posts['goodsjson'] = json_encode($post['goodsjson']);
		$rew = $this->mypost($this->config->item('api_url'), $posts);
		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200
			]));
		} else {
			exit(json_encode([
				'code' => 400
			]));
		}

		exit(json_encode([
			'data' => Mydecode($post['info']),
			'initData' => object_array($_SESSION['initData'])
		]));
	}


	public function ConfirmUserRaffinate()
	{
		$post = $this->input->post();
		$post = Mydecode($post['info']);


		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_OperationalData.ConfirmUserRaffinate';
		$posts['serial'] = $post['serial'];
		$posts['id'] = $post['id'];
		$posts['serial_sale'] = $post['serial_sale'];
		$posts['userid'] = $post['userid'];
		$posts['department'] = get_cookie('department');
		$rew = $this->mypost($this->config->item('api_url'), $posts);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200
			]));
		} else {
			exit(json_encode([
				'code' => 400
			]));
		}

	}

	public function ConfirmStaffRepayment()
	{
		$post = $this->input->post();
		$post = Mydecode($post['info']);


		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_OperationalData.ConfirmStaffRepayment';
		$posts['serial'] = $post['serial'];
		$posts['id'] = $post['id'];
		$posts['serial_sale'] = $post['serial_sale'];
		$posts['serial_pay'] = $post['serial_pay'];
		$posts['total'] = $post['total'];
		$posts['userid'] = $post['userid'];
		$posts['department'] = get_cookie('department');
		$rew = $this->mypost($this->config->item('api_url'), $posts);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200
			]));
		} else {
			exit(json_encode([
				'code' => 400
			]));
		}

	}

	public function getOrderMonitoring()
	{

	}


	public function gettree()
	{
		$department = object_array($_SESSION['initData']->Department->info);
		foreach ($department as $v) {

			$arr[] = [
				'title' => $v['name'],
				'id' => $v['id'],
				'field' => "",
				'type' => $v['type'],
				'checked' => false,
				'spread' => true,
				'isshow' => false,
				'children' => []
			];

			$children[] = [
				'title' => $v['name'],
				'id' => $v['id'],
				'field' => "",
				'type' => $v['type'],
				'checked' => false,
				'spread' => true,
				'isshow' => false
			];

		}
		foreach ($arr as $k => $v) {
			foreach ($children as $vi) {
				if ($v['id'] == $vi['fid']) {
					$arr[$k]['children'][] = [
						'title' => $vi['name'],
						'id' => $vi['id'],
						'field' => "",
						'type' => $vi['type'],
						'checked' => false,
						'spread' => true,
						'isshow' => false,
						'children' => []
					];
				}
			}
		}


		$cat = object_array($_SESSION['initData']->GoodsCat->info);
		$goods = object_array($_SESSION['initData']->Goods->info);
		foreach ($cat as $v) {
			$catarr[] = [
				'title' => $v['name'],
				'id' => $v['id'],
				'field' => "",
				'checked' => true,
				'spread' => true,
				'isshow' => false,
				'children' => []
			];
		}

		foreach ($catarr as $k => $v) {
			foreach ($goods as $vi) {
				if ($vi['catid'] == $v['id']) {
					$catarr[$k]['children'][] = [
						'title' => $vi['name'],
						'id' => $vi['id'],
						'field' => "",
						'checked' => true,
						'spread' => true,
						'isshow' => false,
						'children' => []
					];
				}
			}
		}

		$SecurityCheckType = object_array($_SESSION['initData']->SecurityCheckType->info);
		$SecurityCheckProject = object_array($_SESSION['initData']->SecurityCheckProject->info);

		foreach ($SecurityCheckType as $k => $v) {
			$SecurityCheckType[$k]['list'] = [];
			foreach ($SecurityCheckProject as $ki => $vi) {
				if ($vi['typeid'] == $v['id']) {
					$result = explode(',', $vi['result']);
					$arrr = [];
					foreach ($result as $v) {
						$arrr[] = [
							'ischeck' => false,
							'value' => $v
						];
					}
					$vi['result'] = $arrr;
					$SecurityCheckType[$k]['list'][] = $vi;
				}
			}
		}


		exit(json_encode([
			'data' => [
				'department' => $arr,
				'initData' => object_array($_SESSION['initData']),
				'admindepartment' => get_cookie('department'),
				'SecurityCheckType' => $SecurityCheckType,
				'goods' => $catarr
			]
		]));
	}

	public function getorderlistsearch()
	{

		$post = $this->getHeards();
		$post['begintime'] = $this->getpost()['begintime'];
		$post['endtime'] = $this->getpost()['endtime'];
		$post['deliverydepartment'] = (get_cookie('department') == '预约中心' || get_cookie('department') == '运营监督') ? json_encode($this->getpost()['deliverydepartment']) : get_cookie('department');
//		$post['goodsid'] = $this->getpost()['goodsid'] == [] ? '全部' : json_encode($this->getpost()['goodsid']);
		$post['goodsid'] = '全部';
		$post['state'] = '全部';
		$post['service'] = 'Srproject.Web_GetInfo.MonitorOrder';
		$rew = $this->mypost($this->config->item('api_url'), $post);

		$arr = [];
		foreach (object_array($rew->data->info->info) as $v) {
			foreach ($v['suborder'] as $vi) {
				$vi['mianid'] = $v['id'];
				$vi['miancompanyid'] = $v['companyid'];
				$vi['mianserial'] = $v['serial'];
				$vi['miansource'] = $v['source'];
				$vi['mianaddtime'] = $v['addtime'];
				$vi['mianuserid'] = $v['userid'];
				$vi['mianmemberid'] = $v['memberid'];
				$vi['mianaddressid'] = $v['addressid'];
				$vi['mianname'] = $v['name'];
				$vi['miantelephone'] = $v['telephone'];
				$vi['mianworkplace'] = $v['workplace'];
				$vi['mianregionalcode'] = $v['regionalcode'];
				$vi['mianprovince'] = $v['province'];
				$vi['miancity'] = $v['city'];
				$vi['mianarea'] = $v['area'];
				$vi['miantown'] = $v['town'];
				$vi['mianstreet'] = $v['street'];
				$vi['mianhousenumber'] = $v['housenumber'];
				$vi['mianaddress'] = $v['address'];
				$vi['mianhousingproperty'] = $v['housingproperty'];
				$vi['miancustomertype'] = $v['customertype'];
				$vi['mianlongitude'] = $v['longitude'];
				$vi['mianlatitude'] = $v['latitude'];
				$vi['mianremarks'] = $v['remarks'];
				$vi['mianope_remarks'] = $v['ope_remarks'];
				$vi['mianviplevel'] = $v['viplevel'];
				$vi['mianbalance'] = $v['balance'];
				$vi['mianspecialbalance'] = $v['specialbalance'];
				$vi['mianappointmenttime'] = $v['appointmenttime'];
				$vi['mianattributiondepartment'] = $v['attributiondepartment'];
				$vi['miansalesman'] = $v['salesman'];
				$vi['miandepartment'] = $v['department'];
				$vi['mianregistrar'] = $v['registrar'];
				$vi['mianordertotal'] = $v['ordertotal'];
				$vi['miansns'] = $v['sns'];
				$vi['miansnsuserid'] = $v['snsuserid'];
				$vi['mianpayment'] = $v['payment'];
				$vi['mianpayserial'] = $v['payserial'];
				$vi['mianpaytotal'] = $v['paytotal'];
				$vi['mianstate'] = $v['state'];
				$vi['stateshow'] = getstate($vi['state']);
				$vi['isshow'] = false;
				$arr[] = $vi;
			}
		}
		exit(json_encode([
			'code' => 0,
			'count' => count($arr),
			'data' => $arr
		]));

	}

	public function seeowen()
	{

		$post = $this->getHeards();
		$post['begintime'] = $this->getpost()['begintime'];
		$post['endtime'] = $this->getpost()['endtime'];
		$post['deliverydepartment'] = '全部';
		$post['goodsid'] = json_encode($this->getpost()['goodsid']);
		$post['state'] = '全部';
		$post['registrar'] = $_SESSION['users']->name;
		$post['service'] = 'Srproject.Web_GetInfo.MonitorOrder';
		$rew = $this->mypost($this->config->item('api_url'), $post);

		$arr = [];
		foreach (object_array($rew->data->info->info) as $v) {
			foreach ($v['suborder'] as $vi) {
				$vi['mianid'] = $v['id'];
				$vi['miancompanyid'] = $v['companyid'];
				$vi['mianserial'] = $v['serial'];
				$vi['miansource'] = $v['source'];
				$vi['mianaddtime'] = $v['addtime'];
				$vi['mianuserid'] = $v['userid'];
				$vi['mianmemberid'] = $v['memberid'];
				$vi['mianaddressid'] = $v['addressid'];
				$vi['mianname'] = $v['name'];
				$vi['miantelephone'] = $v['telephone'];
				$vi['mianworkplace'] = $v['workplace'];
				$vi['mianregionalcode'] = $v['regionalcode'];
				$vi['mianprovince'] = $v['province'];
				$vi['miancity'] = $v['city'];
				$vi['mianarea'] = $v['area'];
				$vi['miantown'] = $v['town'];
				$vi['mianstreet'] = $v['street'];
				$vi['mianhousenumber'] = $v['housenumber'];
				$vi['mianaddress'] = $v['address'];
				$vi['mianhousingproperty'] = $v['housingproperty'];
				$vi['miancustomertype'] = $v['customertype'];
				$vi['mianlongitude'] = $v['longitude'];
				$vi['mianlatitude'] = $v['latitude'];
				$vi['mianremarks'] = $v['remarks'];
				$vi['mianope_remarks'] = $v['ope_remarks'];
				$vi['mianviplevel'] = $v['viplevel'];
				$vi['mianbalance'] = $v['balance'];
				$vi['mianspecialbalance'] = $v['specialbalance'];
				$vi['mianappointmenttime'] = $v['appointmenttime'];
				$vi['mianattributiondepartment'] = $v['attributiondepartment'];
				$vi['miansalesman'] = $v['salesman'];
				$vi['miandepartment'] = $v['department'];
				$vi['mianregistrar'] = $v['registrar'];
				$vi['mianordertotal'] = $v['ordertotal'];
				$vi['miansns'] = $v['sns'];
				$vi['miansnsuserid'] = $v['snsuserid'];
				$vi['mianpayment'] = $v['payment'];
				$vi['mianpayserial'] = $v['payserial'];
				$vi['mianpaytotal'] = $v['paytotal'];
				$vi['mianstate'] = $v['state'];
				$vi['stateshow'] = getstate($vi['state']);
				$vi['isshow'] = false;
				$arr[] = $vi;
			}
		}
		exit(json_encode([
			'code' => 0,
			'count' => count($arr),
			'data' => $arr
		]));

	}

	public function watercode()
	{
		$post = $this->getHeards();

		$post = array_merge($post, $this->getpost());
		$post['service'] = 'Srproject.Web_OperationalData.WaterBillWriteoff';
		$post['userid'] = $post['mianuserid'];
		$post['memberid'] = $post['mianmemberid'];
		$post['billno'] = json_encode(explode('\r\n', $post['billno']));
		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200
			]));
		} else {
			exit(json_encode([
				'code' => 400
			]));
		}
	}


	public function getorderjk()
	{


		$post = $this->getHeards();
		$post['begintime'] = '2010-01-01';
		$post['endtime'] = date('Y-m-d', time());
		$post['deliverydepartment'] = get_cookie('department') == '预约中心' ? '全部' : get_cookie('department');
		$post['goodsid'] = '全部';
		$post['state'] = '全部';
		$post['service'] = 'Srproject.Web_GetInfo.MonitorOrder';
		$rew = $this->mypost($this->config->item('api_url'), $post);

		$arr = [];
		foreach (object_array($rew->data->info->info) as $v) {
			foreach ($v['suborder'] as $vi) {
				$vi['mianid'] = $v['id'];
				$vi['miancompanyid'] = $v['companyid'];
				$vi['mianserial'] = $v['serial'];
				$vi['miansource'] = $v['source'];
				$vi['mianaddtime'] = $v['addtime'];
				$vi['mianuserid'] = $v['userid'];
				$vi['mianmemberid'] = $v['memberid'];
				$vi['mianaddressid'] = $v['addressid'];
				$vi['mianname'] = $v['name'];
				$vi['miantelephone'] = $v['telephone'];
				$vi['mianworkplace'] = $v['workplace'];
				$vi['mianregionalcode'] = $v['regionalcode'];
				$vi['mianprovince'] = $v['province'];
				$vi['miancity'] = $v['city'];
				$vi['mianarea'] = $v['area'];
				$vi['miantown'] = $v['town'];
				$vi['mianstreet'] = $v['street'];
				$vi['mianhousenumber'] = $v['housenumber'];
				$vi['mianaddress'] = $v['address'];
				$vi['mianhousingproperty'] = $v['housingproperty'];
				$vi['miancustomertype'] = $v['customertype'];
				$vi['mianlongitude'] = $v['longitude'];
				$vi['mianlatitude'] = $v['latitude'];
				$vi['mianremarks'] = $v['remarks'];
				$vi['mianope_remarks'] = $v['ope_remarks'];
				$vi['mianviplevel'] = $v['viplevel'];
				$vi['mianbalance'] = $v['balance'];
				$vi['mianspecialbalance'] = $v['specialbalance'];
				$vi['mianappointmenttime'] = substr($v['appointmenttime'], 0, 16);
				$vi['mianattributiondepartment'] = $v['attributiondepartment'];
				$vi['miansalesman'] = $v['salesman'];
				$vi['miandepartment'] = $v['department'];
				$vi['mianregistrar'] = $v['registrar'];
				$vi['mianordertotal'] = $v['ordertotal'];
				$vi['miansns'] = $v['sns'];
				$vi['miansnsuserid'] = $v['snsuserid'];
				$vi['mianpayment'] = $v['payment'];
				$vi['mianpayserial'] = $v['payserial'];
				$vi['mianpaytotal'] = $v['paytotal'];
				$vi['mianstate'] = $v['state'];
				$vi['stateshow'] = getstate($vi['state']);
				$vi['isshow'] = false;
				$arr[] = $vi;
			}
		}
		exit(json_encode([
			'code' => 0,
			'count' => count($arr),
			'data' => $arr
		]));
	}

	public function delorder()
	{
		$posts = $this->getpost();
		$post = $this->getHeards();
		$post['service'] = 'Srproject.Web_OperationalData.CancelUserOrder';
		$post['id'] = $posts['id'];
		$post['serial_pay'] = $posts['serial_pay'];
		$post['state'] = $posts['stateshow'];
		$post['remarks'] = $posts['remarks'];
		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200
			]));
		} else {
			exit(json_encode([
				'code' => 400
			]));
		}
	}


	public function getchatdepartment()
	{
		$arr = [];
		$department = object_array($_SESSION['initData']->Operator->info);

		$list = [];
		foreach ($department as $k => $v) {
			$department[$k]['department'] = getDepartmentById($v['departmentid'])['name'];

		}

		foreach ($department as $k => $v) {

			$v['avatar'] = '/res/img/avatar.jpg';
			$v['id'] = $v['opeid'] * 100000;
			$v['sign'] = '电话-' . $v['telephone'];
			$v['status'] = 'online';
			$v['username'] = $v['name'];

			$arr[$v['department']][] = $v;

		}

		foreach ($arr as $k => $v) {

			$list[] = [
				"groupname" => $k,
				"id" => $v[0]['departmentid'],
				"online" => count($arr[$k]),
				"list" => $arr[$k][] = $v
			];

		}

		exit(json_encode([
			'list' => $list
		]));
	}

	public function logout()
	{
		$this->session->unset_userdata('users');
		$this->session->unset_userdata('initData');
		$this->session->unset_userdata('wskey');
		$this->session->unset_userdata('AreaDeliverymanList');
		$this->session->unset_userdata('bulletinboard');
		exit(json_encode([
			'code' => 200
		]));
	}

	public function editorder()
	{
		$posts = $this->getpost();
		$post = $this->getHeards();
		$post['service'] = 'Srproject.Web_OperationalData.UpdateUserOrderInfo';
		$arr = array_merge($posts, $post);
		$rew = $this->mypost($this->config->item('api_url'), $arr);
		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200
			]));
		} else {
			exit(json_encode([
				'code' => 400
			]));
		}


	}


	public function resetorder()
	{
		$post = $this->getHeards();
		$post['service'] = 'Srproject.Web_OperationalData.ResetOrderDeliveryman';
		$post['id'] = $this->getpost()['id'];
		$post['serial_pay'] = $this->getpost()['serial_pay'];
		$rew = $this->mypost($this->config->item('api_url'), $post);
		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function usersearch()
	{
		$post = $this->getHeards();
		$post['service'] = 'Srproject.Web_GetInfo.VagueQueryUserInfo';
		$post['keytype'] = $this->getpost()['tag'];
		$post['keyword'] = $this->getpost()['data'];
		$rew = $this->mypost($this->config->item('api_url'), $post);
		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'data' => object_array($rew->data->info)
			]));
		} else {
			exit(json_encode([
				'code' => 400
			]));
		}
	}


	public function OrderPackingtypeCodeList()
	{
		$post = $this->getHeards();
		$post = array_merge($post, $this->getpost());
		$post['service'] = 'Srproject.Web_GetInfo.OrderPackingtypeCodeList';
		$rew = $this->mypost($this->config->item('api_url'), $post);
		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'data' => object_array($rew->data->info)
			]));
		} else {
			exit(json_encode([
				'code' => 400
			]));
		}
	}

	public function ChangeOrderPackingtypeCode()
	{
		$post = $this->getHeards();
		$post = array_merge($post, $this->getpost());
		$post['service'] = 'Srproject.Web_OperationalData.ChangeOrderPackingtypeCode';
		$rew = $this->mypost($this->config->item('api_url'), $post);
		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'msg' => object_array($rew)
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => object_array($rew)
			]));
		}
	}


	public function bindid()
	{
		$heard = $this->getHeards();
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_OperationalData.BindingUserSns';
		$arr = array_merge($post, $heard);
		$rew = $this->mypost($this->config->item('api_url'), $arr);
		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'data' => object_array($rew->data->info)
			]));
		} else {
			exit(json_encode([
				'code' => 400
			]));
		}
	}


	public function updateorder()
	{
		$heard = $this->getHeards();
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_OperationalData.UpdateUserOrderNotice';
		$arr = array_merge($post, $heard);
		$rew = $this->mypost($this->config->item('api_url'), $arr);
		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'data' => object_array($rew->data->info)
			]));
		} else {
			exit(json_encode([
				'code' => 400
			]));
		}
	}

	public function ResetRepairOrder()
	{
		$heard = $this->getHeards();
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_OperationalData.ResetRepairOrder';
		$arr = array_merge($post, $heard);
		$rew = $this->mypost($this->config->item('api_url'), $arr);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,

			]));
		} else {
			exit(json_encode([
				'code' => 400
			]));
		}
	}

	public function CallRecord()
	{
		$post = $this->getpost();

		$rew = $this->mypost($this->config->item('api_url'), array(
			'service' => 'Srproject.Web_GetInfo.UserCallRecord',
			'companyid' => $this->input->cookie('companyid'),
			'begintime' => date('Y-m-d', time() - 7 * 24 * 3600),
			'endtime' => date('Y-m-d'),
			'userid' => 0,
			'telephone' => $post['telephone'],
			'client' => $this->config->item('client'),
			'department' => get_cookie('department'),
			'opeid' => $_SESSION['users']->opeid
		));

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'list' => object_array($rew->data->info)
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}

	public function getuserbyid()
	{
		$post = $this->getpost();
		$user = $this->getUserInfo($post['cardid']);

		exit(json_encode([
			'user' => $user,
			'cookdepartment' => get_cookie('department'),
			'initData' => $_SESSION['initData']
		]));
	}

	public function getorderlistbycardid()
	{

		$user = $this->getUserInfo($this->getpost()['cardid']);
		$res = $this->mypost($this->config->item('api_url'), array(
			'service' => 'Srproject.Web_GetInfo.UserOrderInfo',
			'companyid' => $this->input->cookie('companyid'),
			'begintime' => date('Y-m-d'),
			'endtime' => date('Y-m-d'),
			'userid' => $user['id'],
			'client' => $this->config->item('client'),
			'opeid' => $_SESSION['users']->opeid
		));

		$list = [];
		foreach (object_array($res->data->mainorderlist) as $v) {

			foreach (object_array($res->data->suborderlist) as $vi) {
				$vi['mianid'] = $v['id'];
				$vi['miancompanyid'] = $v['companyid'];
				$vi['mianserial'] = $v['serial'];
				$vi['miansource'] = $v['source'];
				$vi['mianaddtime'] = $v['addtime'];
				$vi['mianuserid'] = $v['userid'];
				$vi['mianmemberid'] = $v['memberid'];
				$vi['mianaddressid'] = $v['addressid'];
				$vi['mianname'] = $v['name'];
				$vi['miantelephone'] = $v['telephone'];
				$vi['mianworkplace'] = $v['workplace'];
				$vi['mianregionalcode'] = $v['regionalcode'];
				$vi['mianprovince'] = $v['province'];
				$vi['miancity'] = $v['city'];
				$vi['mianarea'] = $v['area'];
				$vi['miantown'] = $v['town'];
				$vi['mianstreet'] = $v['street'];
				$vi['mianhousenumber'] = $v['housenumber'];
				$vi['mianaddress'] = $v['address'];
				$vi['mianhousingproperty'] = $v['housingproperty'];
				$vi['miancustomertype'] = $v['customertype'];
				$vi['mianlongitude'] = $v['longitude'];
				$vi['mianlatitude'] = $v['latitude'];
				$vi['mianremarks'] = $v['remarks'];
				$vi['mianope_remarks'] = $v['ope_remarks'];
				$vi['mianviplevel'] = $v['viplevel'];
				$vi['mianbalance'] = $v['balance'];
				$vi['mianspecialbalance'] = $v['specialbalance'];
				$vi['mianappointmenttime'] = $v['appointmenttime'];
				$vi['mianattributiondepartment'] = $v['attributiondepartment'];
				$vi['miansalesman'] = $v['salesman'];
				$vi['miandepartment'] = $v['department'];
				$vi['mianregistrar'] = $v['registrar'];
				$vi['mianordertotal'] = $v['ordertotal'];
				$vi['miansns'] = $v['sns'];
				$vi['miansnsuserid'] = $v['snsuserid'];
				$vi['mianpayment'] = $v['payment'];
				$vi['mianpayserial'] = $v['payserial'];
				$vi['mianpaytotal'] = $v['paytotal'];
				$vi['mianstate'] = $v['state'];
				$vi['stateshow'] = getstate($vi['state']);
				$vi['isshow'] = false;
				$list[] = $vi;
			}
		}

		$arr = [];
		foreach ($list as $k => $v) {
			$arr[] = $v;
		}
		exit(json_encode([
			'data' => $arr
		]));
	}


	public function getAllOrder()
	{
		$post = $this->getHeards();
		$post['begintime'] = '2010-01-01';
		$post['endtime'] = date('Y-m-d', time());
		$post['deliverydepartment'] = '全部';
		$post['goodsid'] = '全部';
		$post['state'] = '全部';
		$post['service'] = 'Srproject.Web_GetInfo.MonitorOrder';
		$rew = $this->mypost($this->config->item('api_url'), $post);
		$arr = [];
		foreach (object_array($rew->data->info->info) as $v) {
			foreach ($v['suborder'] as $vi) {
				$vi['mianid'] = $v['id'];
				$vi['miancompanyid'] = $v['companyid'];
				$vi['mianserial'] = $v['serial'];
				$vi['miansource'] = $v['source'];
				$vi['mianaddtime'] = $v['addtime'];
				$vi['mianuserid'] = $v['userid'];
				$vi['mianmemberid'] = $v['memberid'];
				$vi['mianaddressid'] = $v['addressid'];
				$vi['mianname'] = $v['name'];
				$vi['miantelephone'] = $v['telephone'];
				$vi['mianworkplace'] = $v['workplace'];
				$vi['mianregionalcode'] = $v['regionalcode'];
				$vi['mianprovince'] = $v['province'];
				$vi['miancity'] = $v['city'];
				$vi['mianarea'] = $v['area'];
				$vi['miantown'] = $v['town'];
				$vi['mianstreet'] = $v['street'];
				$vi['mianhousenumber'] = $v['housenumber'];
				$vi['mianaddress'] = $v['address'];
				$vi['mianhousingproperty'] = $v['housingproperty'];
				$vi['miancustomertype'] = $v['customertype'];
				$vi['mianlongitude'] = $v['longitude'];
				$vi['mianlatitude'] = $v['latitude'];
				$vi['mianremarks'] = $v['remarks'];
				$vi['mianope_remarks'] = $v['ope_remarks'];
				$vi['mianviplevel'] = $v['viplevel'];
				$vi['mianbalance'] = $v['balance'];
				$vi['mianspecialbalance'] = $v['specialbalance'];
				$vi['mianappointmenttime'] = $v['appointmenttime'];
				$vi['mianattributiondepartment'] = $v['attributiondepartment'];
				$vi['miansalesman'] = $v['salesman'];
				$vi['miandepartment'] = $v['department'];
				$vi['mianregistrar'] = $v['registrar'];
				$vi['mianordertotal'] = $v['ordertotal'];
				$vi['miansns'] = $v['sns'];
				$vi['miansnsuserid'] = $v['snsuserid'];
				$vi['mianpayment'] = $v['payment'];
				$vi['mianpayserial'] = $v['payserial'];
				$vi['mianpaytotal'] = $v['paytotal'];
				$vi['mianstate'] = $v['state'];
				$vi['stateshow'] = getstate($vi['state']);
				$vi['isshow'] = false;
				$arr[] = $vi;
			}
		}
		return $arr;
	}

	public function addcallflow()
	{
		$heards = $this->getHeards();
		$post = $this->getpost();
		$post['salesman'] = $_SESSION['users']->name;
		$post['customertype'] = $post['customertype'] ? $post['customertype'] : '家庭用户';
		$post['service'] = 'Srproject.Web_OperationalData.AddUserCallFlow';
		$arr = array_merge($heards, $post);
		$rew = $this->mypost($this->config->item('api_url'), $arr);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'data' => object_array($rew->data->info)
			]));
		} else {
			exit(json_encode([
				'code' => 400
			]));
		}
	}

	public function AddUserSecurityCheck()
	{
		$heards = $this->getHeards();
		$post['serial'] = $this->getpost()['order']['mianserial'];
		$post['userid'] = $this->getpost()['order']['mianuserid'];
		$post['memberid'] = $this->getpost()['order']['mianmemberid'];
		$post['snsuserid'] = $this->getpost()['order']['miansnsuserid'];
		$post['name'] = $this->getpost()['order']['mianname'];
		$post['telephone'] = $this->getpost()['order']['miantelephone'];
		$post['workplace'] = $this->getpost()['order']['mianworkplace'];
		$post['regionalcode'] = $this->getpost()['order']['mianregionalcode'];
		$post['province'] = $this->getpost()['order']['mianprovince'];
		$post['city'] = $this->getpost()['order']['miancity'];
		$post['area'] = $this->getpost()['order']['mianarea'];
		$post['town'] = $this->getpost()['order']['miantown'];
		$post['street'] = $this->getpost()['order']['mianstreet'];
		$post['housenumber'] = $this->getpost()['order']['mianhousenumber'];
		$post['address'] = $this->getpost()['order']['mianaddress'];
		$post['addressid'] = $this->getpost()['order']['mianaddressid'];
		$post['housingproperty'] = $this->getpost()['order']['mianhousingproperty'];
		$post['customertype'] = $this->getpost()['order']['miancustomertype'];
		$post['attributiondepartment'] = $this->getpost()['order']['mianattributiondepartment'];
		$post['salesman'] = $this->getpost()['order']['miansalesman'];
		$post['viplevel'] = $this->getpost()['order']['mianviplevel'];
		$post['longitude'] = $this->getpost()['order']['mianlongitude'];
		$post['latitude'] = $this->getpost()['order']['mianlatitude'];
		$post['securityinspector'] = $this->getpost()['order']['deliveryman'];
		$post['remarks'] = $this->getpost()['order']['mianremarks'];

		$arr = [];
		foreach ($this->getpost()['securitychecklist'] as $v) {
			foreach ($v['list'] as $vi) {
				$result = '';
				foreach ($vi['result'] as $vii) {

					if ($vii['ischeck']) {
						$result .= $vii['value'] . ',';

					}
				}
				$arr[] = [
					'type' => $v['name'],
					'project' => $vi['name'],
					'result' => substr($result, 0, -1)
				];
			}
		}
		$post['securitychecklist'] = json_encode($arr);
		$post['service'] = 'Srproject.Web_OperationalData.AddUserSecurityCheck';
		$body = array_merge($post, $heards);
		$rew = $this->mypost($this->config->item('api_url'), $body);
		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'data' => object_array($rew->data->info)
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function RevokeBindingUserSns()
	{
		$info = Mydecode($this->input->post()['info']);

		$post = $this->getHeards();
		$post['service'] = 'Srproject.Web_OperationalData.RevokeBindingUserSns';
		$post['sns'] = $info['sns'];
		$post['snsuserid'] = $info['snsuserid'];
		$post['userid'] = $info['userid'];
		$rew = $this->mypost($this->config->item('api_url'), $post);
		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}


	public function bindsns()
	{
		$info = Mydecode($this->input->post()['info']);
		$user = Mydecode($this->input->post()['user']);
		$post = $this->getHeards();
		$post['service'] = 'Srproject.Web_OperationalData.BindingUserSns';
		$post['sns'] = $info['sns'];
		$post['snsuserid'] = $info['snsuserid'];
		$post['userid'] = $user['userid'];
		$post['memberid'] = $user['memberid'];
		$rew = $this->mypost($this->config->item('api_url'), $post);
		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'msg' => $rew
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}


	public function getuserinvoicelist()
	{
		$post = $this->getAllpost();
		$post['service'] = 'Srproject.Web_GetInfo.UserSaleInfoInvoice';
		$post['userid'] = $this->getUserInfo($post['cardid'])['id'];
		$rew = $this->mypost($this->config->item('api_url'), $post);
		if ($rew->data->msg == 'SUCCESS') {
			$list = object_array($rew->data->info);

			foreach ($list as $v) {
				if ($v['invoice'] == 2 || $v['invoice'] == 1) {
					$v['stateshow'] = getstate($v['state']);
					$v['ischeck'] = false;
					$arr[] = $v;
				}
			}
			exit(json_encode([
				'code' => 200,
				'list' => $arr,
				'msg' => $rew
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => [],
				'msg' => $rew
			]));
		}
	}

	public function adduserinvoice()
	{
		$post = $this->getpost();

		$post['userid'] = $this->getUserInfo($post['carid'])['id'];

		$post['info'] = json_encode($post['info']);
		$post['raffinateinfo'] = $post['raffinateinfo'] ? json_encode($post['raffinateinfo']) : '';
		$post['service'] = 'Srproject.Web_OperationalData.AddUserInvoiceRecord';
		$body = array_merge($this->getHeards(), $post);

		$rew = $this->mypost($this->config->item('api_url'), $body);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'msg' => $rew
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}


	public function CompleteSnsUserRepair()
	{
		$info = Mydecode($this->input->post()['info']);
		$post = $this->getHeards();
		$post['service'] = 'Srproject.Web_OperationalData.CompleteSnsUserRepair';
		$post['id'] = $info['id'];
		$post['serial'] = $info['serial'];
		$post['remarks'] = $info['remarks'];
		$rew = $this->mypost($this->config->item('api_url'), $post);
		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'msg' => $rew
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function FeedbackArrears()
	{
		$info = Mydecode($this->input->post()['info']);
		$post = $this->getHeards();
		$post['service'] = 'Srproject.Web_OperationalData.FeedbackArrears';
		$post['userid'] = $info['userid'];
		$post['memberid'] = $info['memberid'];
		$post['id'] = $info['id'];
		$post['serial'] = $info['serial'];
		$post['serialtransaction'] = $info['serial_transaction'];
		$post['total'] = $info['total'];
		$rew = $this->mypost($this->config->item('api_url'), $post);
		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'msg' => $rew
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}


	public function CancelUserRepair()
	{
		$order = $this->getpost()['order'];
		$post = $this->getHeards();
		$post['service'] = 'Srproject.Web_OperationalData.CancelUserRepair';
		$post['remarks'] = $this->getpost()['remarks'];
		$post['jsondata'] = json_encode([
			[
				'id' => $order['id'],
				'serial' => $order['serial'],
			]
		]);
		$rew = $this->mypost($this->config->item('api_url'), $post);
		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'msg' => $rew
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}


	public function getusergoodsprice()
	{

		$post = $this->getpost();

		$Goods = object_array($_SESSION['initData']->Goods->info);
		foreach ($Goods as $v) {
			if ($v['state'] == 1) {
				$InitGoods[] = $v;
			}
		}


		$departmensalesgoodss = object_array($_SESSION['initData']->GoodsSalesPromotion->info);
		foreach ($departmensalesgoodss as $v) {

			if ($v['departmentid'] == $post['departmentid']) {
				if ($v['state'] == 1 && $v['strattime'] <= date('Y-m-d') && $v['endtime'] >= date('Y-m-d')) {
					$departmensalesgoods[] = $v;
				}
			}

		}

		$UserOrderCondition = $post['UserOrderCondition'];

		$newGoods = array();
		foreach ($InitGoods as $key => $value) {

			$lastprice = $value['price'];
			$userprice = 0;
			foreach ($UserOrderCondition as $k => $v) {
				if ($v['goodsid'] == $value['goodsid']) {
					if ($v['salestype'] == '固定价格优惠') {
						$userprice = $lastprice - $v['price'];
					}
					if ($v['salestype'] == '市场价格优惠') {
						$userprice = $v['price'];
					}
				}
			}
			$departmentprice = 0;

			foreach ($departmensalesgoods as $k => $v) {


				if ($v['departmentid'] == $post['departmentid']) {
					if ($v['goodsid'] == $value['id']) {

						if ($v['salestype'] == '固定价格优惠') {
							$departmentprice = $lastprice - $v['price'];
						}
						if ($v['salestype'] == '市场价格优惠') {
							$departmentprice = $v['price'];
						}
					}
				}

			}

			$salesprice = ($userprice < $departmentprice) ? $departmentprice : $userprice;

			$lastprice = $lastprice - $salesprice;


			$temp = $value;
			$temp['price'] = $lastprice;
			$newGoods[] = $temp;

		}
		exit(json_encode([
			'list' => $newGoods
		]));
	}

	/**
	 * 退用户仓库商品库存
	 */
	public function RetirementInventory()
	{
		$post = $this->input->post();
		$post = Mydecode($post['info']);


		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_OperationalData.RetirementInventory';
		$posts['userid'] = $post['userid'];
		$posts['id'] = $post['id'];
		$posts['memberid'] = $this->input->post('memberid');
		$posts['department'] = get_cookie('department');

		$rew = $this->mypost($this->config->item('api_url'), $posts);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'printinfo' => $rew->data->printinfo
			]));
		} else {
			exit(json_encode([
				'code' => 400
			]));
		}

	}


	/**
	 * 拆分欠款
	 */
	public function SplitUserArrears()
	{
		$post = $this->input->post();
		$post = Mydecode($post['info']);


		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_OperationalData.SplitUserArrears';
		$posts['userid'] = $post['userid'];
		$posts['serial'] = $post['serial'];
		$posts['serial_transaction'] = $post['serial_transaction'];
		$posts['id'] = $post['id'];
		$posts['total'] = json_encode(explode("\n", $this->input->post('total')));
		$posts['department'] = get_cookie('department');
		$rew = $this->mypost($this->config->item('api_url'), $posts);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200
			]));
		} else {
			exit(json_encode([
				'code' => 400
			]));
		}

	}


	/**
	 *    收发钢瓶
	 */
	public function getuploadmaterinfosf()
	{
		exit(json_encode([
			'data' => [],
			'department' => get_cookie('department'),
			'initData' => object_array($_SESSION['initData'])
		]));
	}


	/**
	 *    收发钢瓶
	 */
	public function sfuploadmaterinfo()
	{
		$post = $this->getpost();
		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_OperationalData.HandoverMaterielInfo';
		$posts['serial'] = '';
		$posts['car_no'] = $post['jsr']['name'];
		$posts['receiver'] = $post['department'];
		$posts['brokerage'] = $post['jsr']['operator'] ? $post['jsr']['operator'] : $post['jsr']['name'];
//		$posts['mode'] = $post['department'] == get_cookie('department') ? '出库' : '入库';
		$posts['mode'] = $post['mode'];
		$posts['type'] = $post['type'];
		$posts['goodsjson'] = json_encode($post['goodsjson']);

		$rew = $this->mypost($this->config->item('api_url'), $posts);
		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}

		exit(json_encode([
			'data' => Mydecode($post['info']),
			'initData' => object_array($_SESSION['initData'])
		]));
	}

	/**
	 *    收发钢瓶
	 */
	public function LSHandoverMaterielInfo()
	{
		$post = $this->getpost();
		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_OperationalData.LSHandoverMaterielInfo';
		$posts['serial'] = '';
		$posts['car_no'] = $post['car_no'];
		$posts['receiver'] = $post['department'];
		$posts['brokerage'] = is_array($post['jsr']) ? $post['jsr']['name'] : $post['jsr'];
//		$posts['mode'] = $post['department'] == get_cookie('department') ? '出库' : '入库';
		$posts['mode'] = $post['mode'];
		$posts['type'] = $post['type'];
		$posts['goodsjson'] = json_encode($post['goodsjson']);

		$rew = $this->mypost($this->config->item('api_url'), $posts);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}

		exit(json_encode([
			'data' => Mydecode($post['info']),
			'initData' => object_array($_SESSION['initData'])
		]));
	}

	/**
	 *    预约用户维修业务 门店处理
	 */
	public function AppointmentUserDepartmentRepair()
	{
		$post = $this->getpost();
		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_OperationalData.AppointmentUserDepartmentRepair';
		$posts['userid'] = $post['user']['id'];
		$posts['memberid'] = $post['user']['memberid'];
		$posts['mode'] = $post['mode'];
		$posts['object'] = $post['object'];
		$posts['appointmenttime'] = $post['appointmenttime'];
		$posts['name'] = $post['user']['name'];
		$posts['province'] = $post['address']['province'];
		$posts['city'] = $post['address']['city'];
		$posts['area'] = $post['address']['area'];
		$posts['town'] = $post['address']['town'];
		$posts['street'] = $post['address']['street'];
		$posts['housenumber'] = $post['address']['housenumber'];
		$posts['address'] = $post['address']['address'];
		$posts['telephone'] = $post['address']['telephone'];
		$posts['housingproperty'] = $post['address']['housingproperty'];
		$posts['customertype'] = $post['user']['customertype'];
		$posts['longitude'] = 0;
		$posts['latitude'] = 0;
		$posts['appointmentremarks'] = $post['appointmentremarks'];
		$posts['attributiondepartment'] = $post['attributiondepartment'];
		$posts['repairdepartment'] = getDepartmentById($post['repairdepartment'])['name'];
		$posts['department'] = get_cookie('department');

		$rew = $this->mypost($this->config->item('api_url'), $posts);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'msg' => $rew
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	/**
	 *    获取初始化数据
	 */
	public function getInitData()
	{

		$wxy = [];
		$yyy = [];
		$ywy = [];
		foreach ($_SESSION['initData']->Operator->info as $v) {
			if ($v->quartersid == 6) {
				$wxy[] = $v;
			}
			if ($v->quartersid == 10) {
				$yyy[] = $v;
			}
			if ($v->quartersid == 3) {
				$v = object_array($v);
				$v['ischeck'] = true;
				$ywy[] = $v;
			}
		}
		exit(json_encode([
			'data' => $_SESSION['initData'],
			'wxy' => $wxy,
			'yyy' => $yyy,
			'ywy' => $ywy,
			'AreaDeliverymanList' => $_SESSION['AreaDeliverymanList'],
			'logindeparment' => get_cookie('department')
		]));
	}


	public function getXsYwy()
	{
		$yyw = [
			[
				'title' => '商用气开发一部',
				'list' => []
			],
			[
				'title' => '商用气开发二部',
				'list' => []
			],
			[
				'title' => '商用气维护部',
				'list' => []
			],

		];
		foreach ($_SESSION['initData']->Operator->info as $v) {
			if ($v->quartersid == 3 && $v->departmentid == 14) {
				$v = object_array($v);
				$v['ischeck'] = true;
				$ywy[0]['list'][] = $v;
			}
			if ($v->quartersid == 3 && $v->departmentid == 15) {
				$v = object_array($v);
				$v['ischeck'] = true;
				$ywy[1]['list'][] = $v;
			}
			if ($v->quartersid == 3 && $v->departmentid == 16) {
				$v = object_array($v);
				$v['ischeck'] = true;
				$ywy[2]['list'][] = $v;
			}
		}
	}

	/**
	 *    查询用户部门维修记录信息
	 */
	public function getUserDepartmentRepairInfo()
	{
		$post = $this->getpost();
		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_GetInfo.UserDepartmentRepairInfo';
		$posts['begintime'] = $post['startime'];
		$posts['endtime'] = $post['endtime'];

		$user = $this->getUserInfo($post['memberid']);
		$posts['userid'] = $user['id'];


		$rew = $this->mypost($this->config->item('api_url'), $posts);

		if ($rew->data->msg == 'SUCCESS') {
			$list = object_array($rew->data->info);
			foreach ($list as $k => $v) {
				$list[$k]['state'] = getstate($list[$k]['state']);
			}
			exit(json_encode([
				'code' => 200,
				'data' => $list
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'data' => []
			]));
		}
	}


	/**
	 *    查询维修列表
	 */
	public function getDepartmentRepairList()
	{
		$post = $this->getpost();
		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_GetInfo.DepartmentRepairList';
		$posts['begintime'] = $post['startime'];
		$posts['endtime'] = $post['endtime'];
		$posts['department'] = $post['department'];
		$rew = $this->mypost($this->config->item('api_url'), $posts);

		if ($rew->data->msg == 'SUCCESS') {
			$list = object_array($rew->data->info);
			foreach ($list as $k => $v) {
				$list[$k]['state'] = getstate($list[$k]['state']);
			}
			exit(json_encode([
				'code' => 200,
				'data' => $list
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'data' => []
			]));
		}
	}

	/**
	 * 取消用户部门维修业务
	 */
	public function CancelUserDepartmentRepair()
	{


		$post = $this->getpost();
		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_OperationalData.CancelUserDepartmentRepair';
		$posts['jsondata'] = json_encode([[
			'id' => $post['order']['id'],
			'serial' => $post['order']['serial']
		]]);
		$posts['remarks'] = $post['remarks'];

		$rew = $this->mypost($this->config->item('api_url'), $posts);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'$rew' => $rew,
			]));
		}
	}


	/**
	 * 取消用户部门维修业务
	 */
	public function UpdateUserRepair()
	{


		$post = $this->getpost();


		$post['service'] = 'Srproject.Web_OperationalData.UpdateUserRepair';

		$post['department'] = get_cookie('department');
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
			]));
		}
	}


	/**
	 * 安排用户部门维修业务
	 */
	public function HandleUserDepartmentRepair()
	{


		$post = $this->getpost();
		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_OperationalData.HandleUserDepartmentRepair';
		$posts['jsondata'] = json_encode([[
			'id' => $post['order']['id'],
			'serial' => $post['order']['serial']
		]]);
		$posts['maintenanceman'] = $post['maintenanceman'];
		$posts['department'] = get_cookie('department');

		$rew = $this->mypost($this->config->item('api_url'), $posts);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'printinfo' => $rew->data
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	/**
	 * 反馈用户部门维修业务
	 */
	public function FeedbackUserDepartmentRepair()
	{


		$post = $this->getpost();
		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_OperationalData.FeedbackUserDepartmentRepair';

		$posts['remarks'] = $post['remarks'];
		$posts['evaluate'] = $post['evaluate'];
		$posts['id'] = $post['order']['id'];
		$posts['serial'] = $post['order']['serial'];
		$posts['department'] = get_cookie('department');

		$rew = $this->mypost($this->config->item('api_url'), $posts);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}


	/**
	 * 钢瓶修漏
	 */
	public function getGPxiulou()
	{


		$post = $this->getpost();
		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_GetInfo.GPxiulou';

		$posts['begintime'] = $post['startime'];
		$posts['endtime'] = $post['endtime'];
		$rew = $this->mypost($this->config->item('api_url'), $posts);

		if ($rew->data->msg == 'SUCCESS') {
			$list = [];
			foreach ($rew->data->info as $v) {
				$v->state = getstate($v->state);
				$list[] = $v;
			}
			exit(json_encode([
				'code' => 200,
				'list' => $list
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}


	/**
	 * 员工登录记录
	 */
	public function OpeLoginRecord()
	{


		$post = $this->getpost();
		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_GetInfo.OpeLoginRecord';

		$posts['begintime'] = $post['startime'];
		$posts['endtime'] = $post['endtime'];
		$rew = $this->mypost($this->config->item('api_url'), $posts);

		if ($rew->data->msg == 'SUCCESS') {
			$list = [];
			foreach ($rew->data->info as $v) {
				$v->state = getstate($v->state);
				$v->departmentid = getDepartmentById($v->departmentid)['name'];
				$v->quartersid = getQuartersById($v->quartersid)['name'];
				$v->logintime = substr($v->logintime, 0, 16);
				$v->worktime = substr(substr($v->logintime, 0, 10) . ' ' . $v->worktime, 0, 16);
				if ($v->logintime <= $v->worktime) {
					$v->isLate = '未迟到';
				} else {
					$v->isLate = '迟到';
				}
				$list[] = $v;


			}
			exit(json_encode([
				'code' => 200,
				'list' => $list
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}

	/**
	 * 配送错误瓶信息
	 */
	public function getDeliveryError()
	{


		$post = $this->getpost();
		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_BusinessReport.DeliveryError';

		$posts['begintime'] = $post['startime'];
		$posts['endtime'] = $post['endtime'];
		$posts['department'] = $post['department'];
		$rew = $this->mypost($this->config->item('api_url'), $posts);

		if ($rew->data->msg == 'SUCCESS') {
			$list = [];
			foreach ($rew->data->info as $v) {
				$v->state = getstate($v->state);
				$list[] = $v;
			}
			exit(json_encode([
				'code' => 200,
				'list' => $list
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}

	/**
	 * 催气催水统计
	 */
	public function ReservationCenterCQCS()
	{


		$post = $this->getpost();
		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_BusinessReport.ReservationCenterCQCS';

		$posts['begintime'] = $post['startime'];
		$posts['endtime'] = $post['endtime'];

		$rew = $this->mypost($this->config->item('api_url'), $posts);

		if ($rew->data->msg == 'SUCCESS') {
			$list = [];
			foreach ($rew->data->info as $v) {

				$list[] = $v;
			}
			exit(json_encode([
				'code' => 200,
				'list' => $list
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}


	/**
	 * 员工电话工作量
	 */
	public function ReservationCenterCallWorkload()
	{


		$post = $this->getpost();
		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_BusinessReport.ReservationCenterCallWorkload';

		$posts['begintime'] = $post['startime'];
		$posts['endtime'] = $post['endtime'];
		$posts['operator'] = $post['operator'];

		$rew = $this->mypost($this->config->item('api_url'), $posts);

		if ($rew->data->msg == 'SUCCESS') {
			$list = [];
			foreach ($rew->data->info as $v) {

				$list[] = $v;
			}
			exit(json_encode([
				'code' => 200,
				'list' => $list
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}


	/**
	 * 员工工作量
	 */
	public function ReservationCenterWorkload()
	{


		$post = $this->getpost();
		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_BusinessReport.ReservationCenterWorkload';

		$posts['begintime'] = $post['startime'];
		$posts['endtime'] = $post['endtime'];
		$posts['operator'] = $post['operator'];

		$rew = $this->mypost($this->config->item('api_url'), $posts);

		if ($rew->data->msg == 'SUCCESS') {
			$list = [];
			foreach ($rew->data->info as $v) {

				$list[] = $v;
			}
			exit(json_encode([
				'code' => 200,
				'list' => $list
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}

	/**
	 * 用户退款
	 */
	public function UserRefund()
	{


		$post = $this->getpost();
		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_OperationalData.UserRefund';

		$posts['userid'] = $post['userid'];
		$posts['memberid'] = $post['memberid'];
		$posts['total'] = $post['total'];
		$rew = $this->mypost($this->config->item('api_url'), $posts);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
				'printinfo' => $rew->data->printinfo
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}


	/**
	 * 拓展部-- 销售统计
	 */
	public function ExpandManageSale()
	{


		$post = $this->getpost();
		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_BusinessReport.ExpandManageSale';

		$posts['begintime'] = $post['startime'];
		$posts['endtime'] = $post['endtime'];
		$posts['salesman'] = json_encode($post['salesman']);

		$rew = $this->mypost($this->config->item('api_url'), $posts);

		if ($rew->data->msg == 'SUCCESS') {
			$list = [];
			foreach ($rew->data->info as $v) {

				$list[] = $v;
			}
			exit(json_encode([
				'code' => 200,
				'list' => $list
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}


	/**
	 * 门店-- 水票核销报表
	 */
	public function DepartmentWaterBill()
	{


		$post = $this->getpost();
		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_BusinessReport.DepartmentWaterBill';

		$posts['begintime'] = $post['startime'];
		$posts['endtime'] = $post['endtime'];


		$rew = $this->mypost($this->config->item('api_url'), $posts);

		if ($rew->data->msg == 'SUCCESS') {
			$list = [];
			foreach ($rew->data->info as $v) {

				$list[] = $v;
			}
			exit(json_encode([
				'code' => 200,
				'list' => $list
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}


	/**
	 * 门店-- 收款报表
	 */
	public function DepartmentReceivables()
	{


		$post = $this->getpost();
		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_BusinessReport.DepartmentReceivables';

		$posts['begintime'] = $post['startime'];
		$posts['endtime'] = $post['endtime'];
		$posts['department'] = $post['department'];
		$posts['mode'] = $post['mode'];


		$rew = $this->mypost($this->config->item('api_url'), $posts);

		if ($rew->data->msg == 'SUCCESS') {
			$list = [];
			foreach ($rew->data->info as $v) {

				$list[] = $v;
			}
			exit(json_encode([
				'code' => 200,
				'list' => $list
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}


	/**
	 * 门店-- 商品物资库存报表
	 */
	public function DepartmentGoodsStock()
	{


		$post = $this->getpost();
		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_BusinessReport.DepartmentGoodsStock';

		$posts['begintime'] = $post['startime'];
		$posts['endtime'] = $post['endtime'];
		$posts['departmentid'] = $post['departmentid'];
		$posts['type'] = $post['type'];
		$posts['mode'] = $post['mode'];


		$rew = $this->mypost($this->config->item('api_url'), $posts);

		if ($rew->data->msg == 'SUCCESS') {
			$list = [];
			foreach ($rew->data->info as $v) {

				$list[] = $v;
			}
			exit(json_encode([
				'code' => 200,
				'list' => $list
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}


	public function CancelDepartmentQualitySpotCheck()
	{
		$info = $this->getpost()['info'];


		$post['service'] = 'Srproject.Web_OperationalData.CancelDepartmentQualitySpotCheck';
		$post['department'] = get_cookie('department');
		$post['id'] = $info['id'];
		$post['serial'] = $info['serial'];
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200
			]));
		} else {
			exit(json_encode([
				'code' => 400
			]));
		}

	}

	public function DepartmentQualitySpotCheckRecord()
	{


		$post = $this->getpost();


		$post['service'] = 'Srproject.Web_GetInfo.DepartmentQualitySpotCheckRecord';
		$post['department'] = get_cookie('department');


		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			$list = [];
			foreach ($rew->data->info as $v) {
				$v->state = getstate($v->state);
				$list[] = $v;
			}
			exit(json_encode([
				'code' => 200,
				'list' => $list
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}


	public function DepartmentQualitySpotCheck()
	{


		$post = $this->getpost();


		$post['service'] = 'Srproject.Web_OperationalData.DepartmentQualitySpotCheck';

		$post['department'] = get_cookie('department');
		$post['code'] = substr($post['code'], -6, 6);
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}


	/**
	 * 门店-- 商品物资销售报表
	 */
	public function DepartmentGoodsSale()
	{


		$post = $this->getpost();
		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_BusinessReport.DepartmentGoodsSale';

		$posts['begintime'] = $post['startime'];
		$posts['endtime'] = $post['endtime'];
		$posts['departmentid'] = $post['departmentid'];
		$posts['mode'] = $post['mode'];

		$rew = $this->mypost($this->config->item('api_url'), $posts);

		if ($rew->data->msg == 'SUCCESS') {
			$list = [];
			foreach ($rew->data->info as $v) {

				$list[] = $v;
			}
			exit(json_encode([
				'code' => 200,
				'list' => $list
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}


	/**
	 * 门店-- 商品物资销售报表
	 */
	public function CommercialManageSale()
	{


		$post = $this->getpost();
		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_BusinessReport.CommercialManageSale';

		$posts['begintime'] = $post['startime'];
		$posts['endtime'] = $post['endtime'];
		$posts['salesman'] = $post['salesman'];
		$posts['type'] = $post['type'];


		$rew = $this->mypost($this->config->item('api_url'), $posts);

		if ($rew->data->msg == 'SUCCESS') {
			$list = [];
			foreach ($rew->data->info as $v) {

				$list[] = $v;
			}
			exit(json_encode([
				'code' => 200,
				'list' => $list
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}


	/**
	 * 部门-- 管理新用户销售报表
	 */
	public function CommercialSalesmanNewUserSale()
	{


		$post = $this->getpost();
		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_BusinessReport.CommercialSalesmanNewUserSale';

		$posts['newuserbegintime'] = $post['newuserbegintime'];
		$posts['newuserendtime'] = $post['newuserendtime'];
		$posts['salebegintime'] = $post['salebegintime'];
		$posts['saleendtime'] = $post['saleendtime'];
		$posts['salesman'] = json_encode($post['salesman']);
		$posts['type'] = $post['type'];
		$rew = $this->mypost($this->config->item('api_url'), $posts);


		if ($rew->data->msg == 'SUCCESS') {
			$list = [];
			foreach ($rew->data->info as $v) {

				$list[] = $v;
			}
			exit(json_encode([
				'code' => 200,
				'list' => $list
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}


	/**
	 *    门店取消业务
	 */
	public function DepartmentCanCancelBusinessRecord()
	{


		$post = $this->getpost();
		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_GetInfo.DepartmentCanCancelBusinessRecord';

		$posts['type'] = $post['type'];
		$rew = $this->mypost($this->config->item('api_url'), $posts);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
				'list' => $rew->data
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}

	/**
	 *    修改备注
	 */
	public function UpdateUserDepartmentRepair()
	{


		$post = $this->getpost();


		$post['service'] = 'Srproject.Web_OperationalData.UpdateUserDepartmentRepair';

		$post['department'] = get_cookie('department');
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;
		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}


	/**
	 *    钢瓶档案列表
	 */
	public function ArchivesList()
	{


		$post = $this->getpost();
		$post['department'] = get_cookie('department');

		$post['service'] = 'Srproject.Web_BottleArchives.ArchivesList';

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
				'list' => $rew->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}

	/**
	 *    补贴
	 */
	public function DepartmentApplyeDeliverymanSubsidyRecord()
	{


		$post = $this->getpost();
		$post['department'] = get_cookie('department');

		$post['service'] = 'Srproject.Web_GetInfo.DepartmentApplyeDeliverymanSubsidyRecord';

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			foreach ($rew->data->info as $k => $v) {
				$rew->data->info[$k]->state = getstate($v->state);
			}
			exit(json_encode([
				'code' => 200,
				'list' => $rew->data
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}


	/**
	 *    补贴
	 */
	public function ReprintCodeRecord()
	{


		$post = $this->getpost();
		$post['department'] = get_cookie('department');

		$post['service'] = 'Srproject.Web_GetInfo.ReprintCodeRecord';

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			foreach ($rew->data->info as $k => $v) {
				$rew->data->info[$k]->state = getstate($v->state);
			}
			exit(json_encode([
				'code' => 200,
				'list' => $rew->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}

	/**
	 *    补贴
	 */
	public function TReprintCodeRecord()
	{


		$post = $this->getpost();


		$post['service'] = 'Srproject.Web_GetInfo.ReprintCodeRecord';

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			foreach ($rew->data->info as $k => $v) {
				$rew->data->info[$k]->state = getstate($v->state);
			}
			exit(json_encode([
				'code' => 200,
				'list' => $rew->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}

	/**
	 *    补贴
	 */
	public function ReprintCodeEntry()
	{


		$post = $this->getpost();
		$post['department'] = get_cookie('department');

		$post['service'] = 'Srproject.Web_OperationalData.ReprintCodeEntry';
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}


	public function CancelReprintCodeEntry()
	{


		$post = $this->getpost();
		$post['department'] = get_cookie('department');

		$post['service'] = 'Srproject.Web_OperationalData.CancelReprintCodeEntry';
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function EditUserFreight()
	{


		$post = $this->getpost();
		$post['department'] = get_cookie('department');

		$post['service'] = 'Srproject.Web_OperationalData.EditUserFreight';
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}


	public function TransportationMaterial()
	{


		$post = $this->getpost();
		$post['department'] = get_cookie('department');

		$post['service'] = 'Srproject.Web_OperationalData.TransportationMaterial';
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function InspectionStationMaterial()
	{


		$post = $this->getpost();
		$post['department'] = get_cookie('department');

		$post['service'] = 'Srproject.Web_OperationalData.InspectionStationMaterial';
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	/**
	 *    补贴
	 */
	public function DepartmentCanApplyeDeliverymanSubsidyRecord()
	{


		$post = $this->getpost();
		$post['department'] = get_cookie('department');

		$post['service'] = 'Srproject.Web_GetInfo.DepartmentCanApplyeDeliverymanSubsidyRecord';

		$rew = $this->mypost($this->config->item('api_url'), $post);
		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
				'list' => $rew->data
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => [],
				'$rew' => $rew
			]));
		}
	}


	/**
	 *    门店取消业务
	 */
	public function DepartmentCancelBusiness()
	{


		$post = $this->getpost();
		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_OperationalData.DepartmentCancelBusiness';
		$post['serialpay'] = $post['serial_pay'];

		$rew = $this->mypost($this->config->item('api_url'), array_merge($post, $posts));

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}


	public function UserFreight()
	{

		$post = $this->getpost();
		$post['department'] = get_cookie('department');

		$post['service'] = 'Srproject.Web_GetInfo.UserFreight';
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
				'list' => $rew->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	/**
	 *    门店取消业务
	 */
	public function AreaDeliverymanList()
	{


		$posts = $this->getHeards();

		$posts['service'] = 'Srproject.Web_GetInfo.AreaDeliverymanList';

		$rew = $this->mypost($this->config->item('api_url'), $posts);

		if ($rew->data->msg == 'SUCCESS') {
			$arr = [];
			foreach ($rew->data->info as $v) {
				if ($v->workdepartment == get_cookie('department')) {
					$arr[] = $v;
				}
			}
			$this->session->set_userdata('AreaDeliverymanList', $arr);
			exit(json_encode([
				'code' => 200,
				'list' => $rew->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function SubmissionWorkDeliverymanList()
	{
		$post = $this->getpost();
		$data['deliverylist'] = json_encode($post['deliverylist']);
		$data['department'] = get_cookie('department');
		$data['operator'] = $_SESSION['users']->name;
		$data['opeid'] = $_SESSION['users']->opeid;
		$data['service'] = 'Srproject.Web_OperationalData.SubmissionWorkDeliverymanList';
		$rew = $this->mypost($this->config->item('api_url'), $data);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function RecyclingMaterials()
	{
		$post = $this->getpost();

		$post['department'] = get_cookie('department');
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;
		$post['service'] = 'Srproject.Web_OperationalData.RecyclingMaterials';
		$rew = $this->mypost($this->config->item('api_url'), $post);
		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}


	public function UpdateArchives()
	{
		$post = $this->getpost();

		$post['department'] = get_cookie('department');
		$post['operator'] = $_SESSION['users']->name;
		$post['service'] = 'Srproject.Web_BottleArchives.UpdateArchives';
		$post['weight'] = round($post['weight'], 1);

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function GetArchives()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_BottleArchives.GetArchives';
		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			$rew->data->info[0]->state = getstate($rew->data->info[0]->state);
			exit(json_encode([
				'code' => 200,
				'data' => $rew->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function TransportationStock()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_BusinessReport.TransportationStock';
		$post['department'] = get_cookie('department');
		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'data' => $rew->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function InspectionStationStock()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_BusinessReport.InspectionStationStock';
		$post['department'] = get_cookie('department');
		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'data' => $rew->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}


	public function TransportationStockBookkeeping()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_OperationalData.TransportationStockBookkeeping';
		$post['goodsjson'] = json_encode($post['list']);
		$post['department'] = get_cookie('department');
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;
		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}


	public function InspectionStationStockBookkeeping()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_OperationalData.InspectionStationStockBookkeeping';
		$post['goodsjson'] = json_encode($post['list']);
		$post['department'] = get_cookie('department');
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;
		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}


	public function TransportationCancelStockBookkeeping()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_OperationalData.TransportationCancelStockBookkeeping';
		$post['goodsjson'] = json_encode($post['list']);
		$post['department'] = get_cookie('department');
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;
		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function InspectionStationCancelStockBookkeeping()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_OperationalData.InspectionStationCancelStockBookkeeping';
		$post['goodsjson'] = json_encode($post['list']);
		$post['department'] = get_cookie('department');
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;
		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function UserFreightList()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_GetInfo.UserFreightList';
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;
		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'list' => $rew->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function TransportationDriverCommissionAllocation()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_BusinessReport.TransportationDriverCommissionAllocation';

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'list' => $rew->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function TransportationDriverCommissionDirect()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_BusinessReport.TransportationDriverCommissionDirect';

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'list' => $rew->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function TransportationDriverCommissionConsignment()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_BusinessReport.TransportationDriverCommissionConsignment';

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'list' => $rew->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}


	public function ApplyeDeliverymanSubsidy()
	{
		$post = $this->getpost();
		$posts['service'] = 'Srproject.Web_OperationalData.ApplyeDeliverymanSubsidy';
		$posts['type'] = $post['type'];

		$posts['json'] = json_encode($this->getjson($posts['type'], $post['info']));

		$posts['department'] = get_cookie('department');
		$posts['operator'] = $_SESSION['users']->name;
		$posts['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $posts);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function getjson($type, $json)
	{
		switch ($type) {
			case '售后换重补贴':
				$requisite = array(
					'addtime' => $json['addtime'],
					'serial' => $json['serial'],
					'former_code' => $json['former_code'],
					'former_packingtype' => $json['former_packingtype'],
					'userid' => $json['userid'] ? $json['userid'] : '',
					'memberid' => $json['memberid'] ? $json['memberid'] : '',
					'code' => $json['code'],
					'packingtype' => $json['packingtype'],
					'address' => $json['address'],
					'remarks' => $json['remarks'] ? $json['remarks'] : '',
					'deliveryman' => $json['deliveryman'],
				);
				break;
			case '普通放空补贴':
				$requisite = array(
					'addtime' => $json['addtime'],
					'serial' => $json['serial'],
					'userid' => $json['userid'] ? $json['userid'] : '',
					'memberid' => $json['memberid'] ? $json['memberid'] : '',
					'goodsname' => $json['goodsname'],
					'num' => $json['num'],
					'address' => $json['address'],
					'remarks' => $json['remarks'],
					'deliveryman' => $json['deliveryman'],
				);
				break;
			case '安全放空补贴':
				$requisite = array(
					'addtime' => $json['addtime'],
					'serial' => $json['serial'],
					'userid' => $json['userid'] ? $json['userid'] : '',
					'memberid' => $json['memberid'] ? $json['memberid'] : '',
					'goodsname' => $json['goodsname'],
					'num' => $json['num'],
					'address' => $json['address'],
					'remarks' => $json['remarks'] ? $json['remarks'] : '',
					'deliveryman' => $json['deliveryman'],
				);
				break;
			case '应急补贴':
				$requisite = array(
					'addtime' => $json['addtime'],
					'serial' => $json['serial'],
					'userid' => $json['userid'] ? $json['userid'] : '',
					'memberid' => $json['memberid'] ? $json['memberid'] : '',
					'goodsname' => $json['goodsname'],
					'num' => $json['num'],
					'address' => $json['address'],
					'remarks' => $json['remarks'] ? $json['remarks'] : '',
					'deliveryman' => $json['deliveryman'],
				);
				break;
			case '超远费补贴':
				$requisite = array(
					'addtime' => $json['addtime'],
					'serial' => $json['serial'],
					'userid' => $json['userid'] ? $json['userid'] : '',
					'memberid' => $json['memberid'] ? $json['memberid'] : '',
					'goodsname' => $json['goodsname'],
					'num' => $json['num'],
					'address' => $json['address'],
					'remarks' => $json['remarks'] ? $json['remarks'] : '',
					'deliveryman' => $json['deliveryman'],
				);
				break;
			case '装卸费补贴':
				$requisite = array(
					'addtime' => $json['addtime'],
					'serial' => $json['serial'],
					'packingtype' => $json['packingtype'],
					'num' => $json['num'],
					'remarks' => $json['remarks'] ? $json['remarks'] : '',
					'deliveryman' => $json['deliveryman'],
				);
				break;
			case '安装胶管补贴':
				$requisite = array(
					'addtime' => $json['addtime'],
					'serial' => $json['serial'],
					'userid' => $json['userid'] ? $json['userid'] : '',
					'memberid' => $json['memberid'] ? $json['memberid'] : '',
					'goodsname' => $json['goodsname'],
					'num' => $json['num'],
					'address' => $json['address'],
					'remarks' => $json['remarks'] ? $json['remarks'] : '',
					'deliveryman' => $json['deliveryman'],
				);
				break;
			default:
				$requisite = array();
		}

		return $requisite;
	}

	public function AuthorizeDeliverymanSubsidy()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_OperationalData.AuthorizeDeliverymanSubsidy';
		$post['department'] = get_cookie('department');
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function CancelDeliverymanSubsidy()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_OperationalData.CancelDeliverymanSubsidy';
		$post['department'] = get_cookie('department');
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function DepartmentPaymentRecord()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_GetInfo.DepartmentPaymentRecord';
		$post['department'] = get_cookie('department');

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			foreach ($rew->data->info as $k => $v) {
				$rew->data->info[$k]->state = getstate($rew->data->info[$k]->state);
			}
			exit(json_encode([
				'code' => 200,
				'list' => $rew->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function UserGoodsWarehouse()
	{
		$post = $this->getpost();


		$post['service'] = 'Srproject.Web_GetInfo.UserGoodsWarehouse';
		$post['department'] = get_cookie('department');
		$post['opeid'] = $_SESSION['users']->opeid;
		$post['userid'] = $this->getUserInfo($post['memberid'])['id'];
		$post['state'] = '正常';
		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			$arr = [];
			$list = object_array($rew->data->info);
			foreach ($list as $k => $v) {
				if ($v['goodsid'] == 10 || $v['goodsid'] == 12 || $v['goodsid'] == 27 || $v['goodsid'] == 28 || $v['goodsid'] == 29 || $v['goodsid'] == 30 || $v['goodsid'] == 31 || $v['goodsid'] == 11) {
					$v['goodsname'] = getGoodsId($v['goodsid'])['name'];
					$v['state'] = getstate($v['state']);
					$arr[] = $v;
				}
			}
			exit(json_encode([
				'code' => 200,
				'list' => $arr
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}


	public function usercharge()
	{
		$post = $this->getpost();


		$post['service'] = 'Srproject.Web_GetInfo.UserCollateralCharge';
		$post['department'] = get_cookie('department');
		$post['opeid'] = $_SESSION['users']->opeid;
		$post['userid'] = $this->getUserInfo($post['memberid'])['id'];
		$post['state'] = '正常,撤销';
		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			$arr = [];
			$list = object_array($rew->data->info);
			foreach ($list as $k => $v) {
				$v['state'] = getstate($v['state']);
				$arr[] = $v;
			}
			exit(json_encode([
				'code' => 200,
				'list' => $arr
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function UpdateUserCallRecord()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_OperationalData.UpdateUserCallRecord';
		$post['userid'] = $post['userid'] ? $post['userid'] : 0;
		$post['department'] = get_cookie('department');
		$post['opeid'] = $_SESSION['users']->opeid;
		$post['operator'] = $_SESSION['users']->name;

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function warehouse()
	{
		$post = $this->getpost();


		$post['service'] = 'Srproject.Web_GetInfo.UserCollateralWarehouse';
		$post['department'] = get_cookie('department');
		$post['opeid'] = $_SESSION['users']->opeid;
		$post['userid'] = $this->getUserInfo($post['memberid'])['id'];
		$post['state'] = '全部';
		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			$arr = [];
			$list = object_array($rew->data->info);
			foreach ($list as $k => $v) {
				$v['state'] = getstate($v['state']);
				$arr[] = $v;
			}
			exit(json_encode([
				'code' => 200,
				'list' => $arr
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function SplitUserWarehouseGoods()
	{
		$post = $this->getpost();


		$post['service'] = 'Srproject.Web_OperationalData.SplitUserWarehouseGoods';
		$post['department'] = get_cookie('department');
		$post['opeid'] = $_SESSION['users']->opeid;
		$post['operator'] = $_SESSION['users']->name;
		$post['goodsjson'] = json_encode($post['goodsjson']);

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function UpdateOrderAreaCode()
	{
		$post = $this->getpost();


		$post['service'] = 'Srproject.Web_OperationalData.UpdateOrderAreaCode';
		$post['department'] = get_cookie('department');
		$post['opeid'] = $_SESSION['users']->opeid;
		$post['operator'] = $_SESSION['users']->name;
		$post['goodsjson'] = json_encode($post['goodsjson']);

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function OrderComparisonInformation()
	{
		$post = $this->getpost();


		$post['service'] = 'Srproject.Web_GetInfo.OrderComparisonInformation';
		$post['department'] = get_cookie('department');
		$post['opeid'] = $_SESSION['users']->opeid;
		$post['operator'] = $_SESSION['users']->name;
		$post['codelist'] = json_encode($post['codelist']);

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			foreach ($rew->data->info as $k => $v) {
				$rew->data->info[$k]->statecode = 0;
			}
			exit(json_encode([
				'code' => 200,
				'list' => $rew->data
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew,
				'list' => []
			]));
		}
	}


	public function SplitUserCollateral()
	{
		$post = $this->getpost();

		$post['service'] = 'Srproject.Web_OperationalData.SplitUserCollateral';
		$post['department'] = get_cookie('department');
		$post['opeid'] = $_SESSION['users']->opeid;
		$post['operator'] = $_SESSION['users']->name;
		$post['goodsjson'] = json_encode($post['goodsjson']);

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function AllocationPlanMonitor()
	{
		$post = $this->getpost();

		$post['service'] = 'Srproject.Web_GetInfo.AllocationPlanMonitor';
		$post['department'] = get_cookie('department');
		$post['opeid'] = $_SESSION['users']->opeid;
		$post['operator'] = $_SESSION['users']->name;


		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
				'list' => $rew->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew,
				'list' => []
			]));
		}
	}

	public function EditUserCollateral()
	{
		$post = $this->getpost();


		$post['service'] = 'Srproject.Web_OperationalData.EditUserCollateral';
		$post['department'] = get_cookie('department');
		$post['opeid'] = $_SESSION['users']->opeid;
		$post['operator'] = $_SESSION['users']->name;


		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function TransportationArrangeOrder()
	{
		$post = $this->getpost();


		$post['service'] = 'Srproject.Web_OperationalData.TransportationArrangeOrder';
		$post['department'] = get_cookie('department');
		$post['opeid'] = $_SESSION['users']->opeid;
		$post['operator'] = $_SESSION['users']->name;


		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
				'msg' => $rew
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function EditUserCollateralCharge()
	{
		$post = $this->getpost();


		$post['service'] = 'Srproject.Web_OperationalData.EditUserCollateralCharge';
		$post['department'] = get_cookie('department');
		$post['opeid'] = $_SESSION['users']->opeid;
		$post['operator'] = $_SESSION['users']->name;


		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function AdjustmentUserWarehouseGoods()
	{
		$post = $this->getpost();


		$post['service'] = 'Srproject.Web_OperationalData.AdjustmentUserWarehouseGoods';
		$post['department'] = get_cookie('department');
		$post['opeid'] = $_SESSION['users']->opeid;
		$post['operator'] = $_SESSION['users']->name;

		$rew = $this->mypost($this->config->item('api_url'), $post);
		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function AdjustmentUserCollateral()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_OperationalData.AdjustmentUserCollateral';
		$post['department'] = get_cookie('department');
		$post['opeid'] = $_SESSION['users']->opeid;
		$post['operator'] = $_SESSION['users']->name;

		$rew = $this->mypost($this->config->item('api_url'), $post);
		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}


	public function CancelUserOrderHZ()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_OperationalData.CancelUserOrderHZ';
		$post['department'] = get_cookie('department');
		$post['opeid'] = $_SESSION['users']->opeid;
		$post['operator'] = $_SESSION['users']->name;

		$rew = $this->mypost($this->config->item('api_url'), $post);
		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function CheckDepartmentPaymentRecord()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_GetInfo.CheckDepartmentPaymentRecord';
		$post['department'] = get_cookie('department');

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			foreach ($rew->data->info as $k => $v) {
				$rew->data->info[$k]->isshow = false;
			}
			exit(json_encode([
				'code' => 200,
				'list' => $rew->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function CancelPackingtypeCheakRecord()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_OperationalData.CancelPackingtypeCheakRecord';
		$post['department'] = get_cookie('department');
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}


	public function sale()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_GetInfo.UserSaleInfo';
		$post['department'] = get_cookie('department');
		$post['client'] = $this->config->item('client');
		$post['opeid'] = $_SESSION['users']->opeid;
		$post['companyid'] = $this->input->cookie('companyid');
		$post['begintime'] = date('Y-m-d', strtotime($post['time'][0]));
		$post['endtime'] = date('Y-m-d', strtotime($post['time'][1]));
		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			$list = [];
			$num = 0;
			$total = 0;
			foreach (object_array($rew->data->info) as $v) {
				$v['state'] = getstate($v['state']);
				if ($post['goods'] == '') {
					$list[] = $v;
				}
				if ($post['goods'] != '') {
					if ($v['goodsname'] == $post['goods']) {
						$list[] = $v;
						$num += $v['num'];
						$total += $v['price'];
					}
				}
			}

			exit(json_encode([
				'code' => 200,
				'list' => $list,
				'num' => $num,
				'total' => $total,

			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew,
				'list' => [],
				'num' => 0,
				'total' => 0,

			]));
		}
	}


	public function order()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_GetInfo.UserOrderInfo';
		$post['department'] = get_cookie('department');
		$post['client'] = $this->config->item('client');
		$post['opeid'] = $_SESSION['users']->opeid;
		$post['companyid'] = $this->input->cookie('companyid');
		$post['begintime'] = date('Y-m-d', strtotime($post['time'][0]));
		$post['endtime'] = date('Y-m-d', strtotime($post['time'][1]));
		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			$list = [];
			$data['list'] = (array)$rew->data->mainorderlist;
			foreach ($data['list'] as $k => $v) {
				foreach ($rew->data->suborderlist as $vi) {
					$vi->stateshow = getstate($vi->state);
					if ($v->serial == $vi->serial) {
						$data['list'][$k]->sub[] = $vi;
						if ($vi->state == 2) {
							$data['list'][$k]->state = 2;

						}
						$data['list'][$k]->stateshow = getstate($data['list'][$k]->state);
					}

				}
			}

			foreach (object_array($rew->data->info) as $v) {
				$v['state'] = getstate($v);
				$list[] = $v;

			}

			exit(json_encode([
				'code' => 200,
				'list' => $data['list'],

			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew,
				'list' => [],

			]));
		}
	}

	public function RealTimeDynamicOrder()
	{

		$post['service'] = 'Srproject.Web_BusinessReport.RealTimeDynamicOrder';

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			$arr = [];
			foreach ($rew->data->info as $k => $v) {
				$arr['xAxis'][] = $v->department;
				$arr['aggregateorder'][] = $v->aggregateorder;
				$arr['handle'][] = $v->aggregateorder - $v->nohandle;
				$arr['nohandle'][] = $v->nohandle;
				$arr['num'] += $v->aggregateorder;
				$arr['znohandle'] += $v->nohandle;
			}
			exit(json_encode([
				'code' => 200,
				'list' => $arr,
				'order' => $rew->data->info,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function SimultaneousSegmentOrder()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_BusinessReport.SimultaneousSegmentOrder';

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			$arr = [];
			foreach ($rew->data->info as $k => $v) {
				$arr['xAxis'][] = $v->date;
				$arr['aggregateorder'][] = $v->aggregateorder;
				$arr['handle'][] = $v->handlorder;
				$arr['nohandle'][] = ($v->aggregateorder - $v->handlorder);
				$arr['num'] += $v->aggregateorder;
				$arr['znohandle'] += ($v->aggregateorder - $v->handlorder);
			}
			exit(json_encode([
				'code' => 200,
				'list' => $arr,
				'order' => $rew->data->info,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function AddDepartmentPayment()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_OperationalData.AddDepartmentPayment';
		$post['department'] = get_cookie('department');
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function SettingChargeStandardDiscount()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_SystemSetting.SettingChargeStandardDiscount';
		$post['department'] = $post['department'] ? json_encode($post['department'], JSON_UNESCAPED_UNICODE) : '全部';
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}


	public function warehouses()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_GetInfo.UserCollateralWarehouse';
		$post['state'] = '正常,已使用';
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			$list = [];

//			foreach ($rew->data->info as $v) {
//				if (getstate($v->state) == '正常' || getstate($v->state) == '已使用') {
//					$list[] = $v;
//				}
//			}
			exit(json_encode([
				'code' => 200,
				'list' => $rew->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}


	public function AdvancePayFee()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_OperationalData.AdvancePayFee';
		$post['department'] = get_cookie('department');
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'printinfo' => $rew->data->printinfo
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew->data->tips
			]));
		}
	}

	public function ChargeStandardDiscount()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_GetSystemInfo.ChargeStandardDiscount';

		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			$list = [];
			foreach ($rew->data->info as $v) {
				if ($v->project == $post['project']) {
					$v->department = $v->department == '全部' ? '全部' : json_decode($v->department);
					$list[] = $v;
				}
			}
			exit(json_encode([
				'code' => 200,
				'list' => $list,
				'arr' => $rew->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}

	public function GiveUserWarehouseGoods()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_OperationalData.GiveUserWarehouseGoods';
		$post['department'] = get_cookie('department');
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function CommerciaUserInfoList()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_GetInfo.CommerciaUserInfoList';

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			foreach ($rew->data->info as $k => $v) {
				$rew->data->info[$k]->state = getstate($rew->data->info[$k]->state);
			}
			exit(json_encode([
				'code' => 200,
				'list' => $rew->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => [],
				'msg' => $rew
			]));
		}
	}

	public function AddCommerciaSalesmanTask()
	{
		$info = $this->getpost()['info'];
		$appointmentremarks = $this->getpost()['appointmentremarks'];
		$post = $this->getUserInfo($info['memberid']);

		$post['service'] = 'Srproject.Web_OperationalData.AddCommerciaSalesmanTask';
		$post['mode'] = '走访';
		$post['userid'] = $post['id'];
		$post['appointmentremarks'] = $appointmentremarks[0];
		$post['addressid'] = $appointmentremarks[1];
		$post['longitude'] = '';
		$post['latitude'] = '';
		$post['opeid'] = $_SESSION['users']->opeid;
		$post['appointmenttime'] = date('Y-m-d H:i:s', time());

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,

			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => [],
				'msg' => $rew
			]));
		}
	}

	public function CommerciaUserTaskRecord()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_GetInfo.CommerciaUserTaskRecord';
		$post['department'] = get_cookie('department');

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			foreach ($rew->data->info as $k => $v) {
				$rew->data->info[$k]->state = getstate($rew->data->info[$k]->state);
			}
			exit(json_encode([
				'code' => 200,
				'list' => $rew->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => [],
				'msg' => $rew
			]));
		}
	}

	public function CancelCommerciaSalesmanTaskRecord()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_OperationalData.CancelCommerciaSalesmanTaskRecord';
		$post['department'] = get_cookie('department');
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {


			exit(json_encode([
				'code' => 200
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => [],
				'msg' => $rew
			]));
		}
	}

	public function FeedbackCommerciaSalesmanTaskRecord()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_OperationalData.FeedbackCommerciaSalesmanTaskRecord';
		$post['department'] = get_cookie('department');
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => [],
				'msg' => $rew
			]));
		}
	}

	public function FileUrlList()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_GetInfo.FileUrlList';
		$post['department'] = get_cookie('department');
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
				'list' => $rew->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => [],
				'msg' => $rew
			]));
		}
	}

	public function CancelDepartmentPayment()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_OperationalData.CancelDepartmentPayment';
		$post['department'] = get_cookie('department');
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;
		$post['serial'] = $post['info']['serial'];
		$post['id'] = $post['info']['id'];

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function ReportDetailed()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_BusinessReport.ReportDetailed';

		$json = $post['info'];
		$json['payment'] = $post['payment'];
		$json['class'] = $post['classname'];
		$jsonarr = $this->getreporttype($post['reporttype'], $json);

		$post['json'] = json_encode($jsonarr, JSON_UNESCAPED_UNICODE);
		$post['department'] = get_cookie('department');
		unset($post['info']);

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'list' => $rew->data
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function getreporttype($reporttype, $json)
	{
		switch ($reporttype) {
			case '门店收款报表':
				$requisite = array(
					'project' => $json['project'],
					'type' => $json['type'],
					'payment' => $json['payment'],
				);
				break;
			case '门店商品库存报表':
				$requisite = array(
					'class' => $json['class'],
					'goodsname' => $json['goodsname'],
					'type' => $json['type'],
					'packingtype' => $json['packingtype'],
					'project' => $json['payment'],
				);
				break;
			case '门店商品物资销售报表':
				$requisite = array(
					'type' => $json['mode'],
					'brand' => $json['brand'],
					'goodstype' => $json['goodstype'],
					'goodsname' => $json['goodsname'],
					'payment' => $json['payment'],
				);
				break;
			case '运输公司库存报表':
				$requisite = array(
					'type' => $json['type'],
					'project' => $json['project'],
					'packingtype' => $json['packingtype'],
				);
				break;
			case '容检厂库存报表':
				$requisite = array(
					'type' => $json['type'],
					'project' => $json['project'],
					'packingtype' => $json['packingtype'],
				);
				break;
		}

		return $requisite;
	}

	public function CommerciaUserTaskRecordSummary()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_BusinessReport.CommerciaUserTaskRecordSummary';
		$post['salesman'] = $post['salesman'] == '全部' ? '全部' : implode(',', $post['salesman']);
		$post['department'] = get_cookie('department');

		$rew = $this->mypost($this->config->item('api_url'), $post);
		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'list' => $rew->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}

	public function CommerciaSalesmanTaskRecordSummary()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_BusinessReport.CommerciaSalesmanTaskRecordSummary';
		$post['salesman'] = $post['salesman'] == '全部' ? '全部' : implode(',', $post['salesman']);
		$post['department'] = get_cookie('department');

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'list' => $rew->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}

	public function CommerciaUserDiscountSummary()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_BusinessReport.CommerciaUserDiscountSummary';
		$post['salesman'] = $post['salesman'] == '全部' ? '全部' : implode(',', $post['salesman']);
		$post['department'] = get_cookie('department');

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'list' => $rew->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}

	public function CommerciaUserSecurityCheckSummary()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_BusinessReport.CommerciaUserSecurityCheckSummary';
		$post['salesman'] = $post['salesman'] == '全部' ? '全部' : implode(',', $post['salesman']);
		$post['department'] = get_cookie('department');

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			$lst = $rew->data->info;
			foreach ($lst as $k => $v) {
				$lst[$k]->state = getstate($v->state);
			}
			exit(json_encode([
				'code' => 200,
				'list' => $lst
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}

	public function CommerciaUserNoDealSummary()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_BusinessReport.CommerciaUserNoDealSummary';
		$post['salesman'] = $post['salesman'] == '全部' ? '全部' : implode(',', $post['salesman']);
		$post['department'] = get_cookie('department');

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			$lst = $rew->data->info;
			foreach ($lst as $k => $v) {
				$lst[$k]->state = getstate($v->state);
			}
			exit(json_encode([
				'code' => 200,
				'list' => $lst
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}

	public function CommerciaUserOweCollateralSummary()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_BusinessReport.CommerciaUserOweCollateralSummary';
		$post['salesman'] = $post['salesman'] == '全部' ? '全部' : implode(',', $post['salesman']);
		$post['department'] = get_cookie('department');

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			$lst = $rew->data->info;
			foreach ($lst as $k => $v) {
				$lst[$k]->state = getstate($v->state);
			}
			exit(json_encode([
				'code' => 200,
				'list' => $lst
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}

	public function CommerciaUserUserSaleDifferenceSummary()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_BusinessReport.CommerciaUserUserSaleDifferenceSummary';
		$post['salesman'] = $post['salesman'] == '全部' ? '全部' : implode(',', $post['salesman']);
		$post['department'] = get_cookie('department');

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			$lst = $rew->data->info;
			foreach ($lst as $k => $v) {
				$lst[$k]->state = getstate($v->state);
			}
			exit(json_encode([
				'code' => 200,
				'list' => $lst
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}

	public function CommerciaSalesmanUserSaleSummary()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_BusinessReport.CommerciaSalesmanUserSaleSummary';
		$post['salesman'] = $post['salesman'] == '全部' ? '全部' : implode(',', $post['salesman']);
		$post['department'] = get_cookie('department');

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			$lst = $rew->data->info;
			foreach ($lst as $k => $v) {
				$lst[$k]->state = getstate($v->state);
			}
			exit(json_encode([
				'code' => 200,
				'list' => $lst
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'list' => []
			]));
		}
	}

	public function DepartmentGoodsStockBookkeeping()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_OperationalData.DepartmentGoodsStockBookkeeping';
		foreach ($post['goodsjson'] as $k => $v) {
			$post['goodsjson'][$k]['mode'] = $post['goodsjson'][$k]['mode'] ? $post['goodsjson'][$k]['mode'] : 0;
			$post['goodsjson'][$k]['brand'] = $post['goodsjson'][$k]['brand'] ? $post['goodsjson'][$k]['brand'] : 0;
			$post['goodsjson'][$k]['goodstype'] = $post['goodsjson'][$k]['goodstype'] ? $post['goodsjson'][$k]['goodstype'] : 0;
			$post['goodsjson'][$k]['goodsname'] = $post['goodsjson'][$k]['goodsname'] ? $post['goodsjson'][$k]['goodsname'] : 0;
			$post['goodsjson'][$k]['num'] = $post['goodsjson'][$k]['num'] ? $post['goodsjson'][$k]['num'] : 0;
			$post['goodsjson'][$k]['pay_balance'] = $post['goodsjson'][$k]['pay_balance'] ? $post['goodsjson'][$k]['pay_balance'] : 0;
			$post['goodsjson'][$k]['pay_cash'] = $post['goodsjson'][$k]['pay_cash'] ? $post['goodsjson'][$k]['pay_cash'] : 0;
			$post['goodsjson'][$k]['pay_weixin'] = $post['goodsjson'][$k]['pay_weixin'] ? $post['goodsjson'][$k]['pay_weixin'] : 0;
			$post['goodsjson'][$k]['pay_alipay'] = $post['goodsjson'][$k]['pay_alipay'] ? $post['goodsjson'][$k]['pay_alipay'] : 0;
			$post['goodsjson'][$k]['pay_arrears'] = $post['goodsjson'][$k]['pay_arrears'] ? $post['goodsjson'][$k]['pay_arrears'] : 0;
			$post['goodsjson'][$k]['pay_blend'] = $post['goodsjson'][$k]['pay_blend'] ? $post['goodsjson'][$k]['pay_blend'] : 0;
			$post['goodsjson'][$k]['pay_stock'] = $post['goodsjson'][$k]['pay_stock'] ? $post['goodsjson'][$k]['pay_stock'] : 0;
			$post['goodsjson'][$k]['total'] = $post['goodsjson'][$k]['total'] ? $post['goodsjson'][$k]['total'] : 0;
		}
		$post['goodsjson'] = json_encode($post['goodsjson']);
		$post['departmentid'] = get_cookie('departmentid');
		$post['department'] = get_cookie('department');
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);
		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function DepartmentGoodsSaleBookkeeping()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_OperationalData.DepartmentGoodsSaleBookkeeping';
		foreach ($post['goodsjson'] as $k => $v) {
			$post['goodsjson'][$k]['goodsid'] = $post['goodsjson'][$k]['goodsid'] ? $post['goodsjson'][$k]['goodsid'] : 0;
			$post['goodsjson'][$k]['gooodsname'] = $post['goodsjson'][$k]['gooodsname'] ? $post['goodsjson'][$k]['gooodsname'] : 0;
			$post['goodsjson'][$k]['type'] = $post['goodsjson'][$k]['type'] ? $post['goodsjson'][$k]['type'] : 0;
			$post['goodsjson'][$k]['packingtype'] = $post['goodsjson'][$k]['packingtype'] ? $post['goodsjson'][$k]['packingtype'] : 0;
			$post['goodsjson'][$k]['beginstock'] = $post['goodsjson'][$k]['beginstock'] ? $post['goodsjson'][$k]['beginstock'] : 0;
			$post['goodsjson'][$k]['gsdr'] = $post['goodsjson'][$k]['gsdr'] ? $post['goodsjson'][$k]['gsdr'] : 0;
			$post['goodsjson'][$k]['gsdc'] = $post['goodsjson'][$k]['gsdc'] ? $post['goodsjson'][$k]['gsdc'] : 0;
			$post['goodsjson'][$k]['psydr'] = $post['goodsjson'][$k]['psydr'] ? $post['goodsjson'][$k]['psydr'] : 0;
			$post['goodsjson'][$k]['psydc'] = $post['goodsjson'][$k]['psydc'] ? $post['goodsjson'][$k]['psydc'] : 0;
			$post['goodsjson'][$k]['sale'] = $post['goodsjson'][$k]['sale'] ? $post['goodsjson'][$k]['sale'] : 0;
			$post['goodsjson'][$k]['consignment'] = $post['goodsjson'][$k]['consignment'] ? $post['goodsjson'][$k]['consignment'] : 0;
			$post['goodsjson'][$k]['returnempty'] = $post['goodsjson'][$k]['returnempty'] ? $post['goodsjson'][$k]['returnempty'] : 0;
			$post['goodsjson'][$k]['buy'] = $post['goodsjson'][$k]['buy'] ? $post['goodsjson'][$k]['buy'] : 0;
			$post['goodsjson'][$k]['bill'] = $post['goodsjson'][$k]['bill'] ? $post['goodsjson'][$k]['bill'] : 0;
			$post['goodsjson'][$k]['usertp'] = $post['goodsjson'][$k]['usertp'] ? $post['goodsjson'][$k]['usertp'] : 0;
			$post['goodsjson'][$k]['endstock'] = $post['goodsjson'][$k]['endstock'] ? $post['goodsjson'][$k]['endstock'] : 0;
			unset($post['goodsjson'][$k]['department']);
		}
		$post['goodsjson'] = json_encode($post['goodsjson']);
		$post['departmentid'] = get_cookie('departmentid');
		$post['department'] = get_cookie('department');
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);
		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function DepartmentReceivablesBookkeeping()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_OperationalData.DepartmentReceivablesBookkeeping';
		foreach ($post['goodsjson'] as $k => $v) {
			$post['goodsjson'][$k]['inandout'] = $post['goodsjson'][$k]['inandout'] ? $post['goodsjson'][$k]['inandout'] : 0;
			$post['goodsjson'][$k]['project'] = $post['goodsjson'][$k]['project'] ? $post['goodsjson'][$k]['project'] : 0;
			$post['goodsjson'][$k]['type'] = $post['goodsjson'][$k]['type'] ? $post['goodsjson'][$k]['type'] : 0;
			$post['goodsjson'][$k]['pay_balance'] = $post['goodsjson'][$k]['pay_balance'] ? $post['goodsjson'][$k]['pay_balance'] : 0;
			$post['goodsjson'][$k]['pay_cash'] = $post['goodsjson'][$k]['pay_cash'] ? $post['goodsjson'][$k]['pay_cash'] : 0;
			$post['goodsjson'][$k]['pay_weixin'] = $post['goodsjson'][$k]['pay_weixin'] ? $post['goodsjson'][$k]['pay_weixin'] : 0;
			$post['goodsjson'][$k]['pay_alipay'] = $post['goodsjson'][$k]['pay_alipay'] ? $post['goodsjson'][$k]['pay_alipay'] : 0;
			$post['goodsjson'][$k]['pay_arrears'] = $post['goodsjson'][$k]['pay_arrears'] ? $post['goodsjson'][$k]['pay_arrears'] : 0;
			$post['goodsjson'][$k]['pay_stock'] = $post['goodsjson'][$k]['pay_stock'] ? $post['goodsjson'][$k]['pay_stock'] : 0;
			$post['goodsjson'][$k]['total'] = $post['goodsjson'][$k]['total'] ? $post['goodsjson'][$k]['total'] : 0;

			unset($post['goodsjson'][$k]['department']);
		}
		$post['goodsjson'] = json_encode($post['goodsjson']);
		$post['departmentid'] = get_cookie('departmentid');
		$post['department'] = get_cookie('department');
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);
		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function DepartmentCancelGoodsStockBookkeeping()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_OperationalData.DepartmentCancelGoodsStockBookkeeping';

		$post['departmentid'] = get_cookie('departmentid');
		$post['department'] = get_cookie('department');
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);
		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function DepartmentCancelReceivablesBookkeeping()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_OperationalData.DepartmentCancelReceivablesBookkeeping';

		$post['departmentid'] = get_cookie('departmentid');
		$post['department'] = get_cookie('department');
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);
		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function DepartmentCancelGoodsSaleBookkeeping()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_OperationalData.DepartmentCancelGoodsSaleBookkeeping';

		$post['departmentid'] = get_cookie('departmentid');
		$post['department'] = get_cookie('department');
		$post['operator'] = $_SESSION['users']->name;
		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);
		if ($rew->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function CylinderAcquisition()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_OperationalData.HandleBuyUserMaterial';
		$post['companyid'] = $this->input->cookie('companyid');
		$post['department'] = $this->input->cookie('department');
		$post['operator'] = $_SESSION['users']->name;
		$post['client'] = $this->config->item('client');
		$post['opeid'] = $_SESSION['users']->opeid;

		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
				'printinfo' => $rew->data->printinfo
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}

	public function RetailLogisticsDeliverymanDalary()
	{
		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_BusinessReport.RetailLogisticsDeliverymanDalary';
		$post['departments'] = json_encode($post['departments']);
		$post['deliverymans'] = json_encode($post['deliverymans']);
		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {

			exit(json_encode([
				'code' => 200,
				'list' => $rew->data
			]));
		} else {
			exit(json_encode([
				'code' => 400,
				'msg' => $rew
			]));
		}
	}
}


