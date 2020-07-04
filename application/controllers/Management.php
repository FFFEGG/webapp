<?php

class Management extends HomeBase
{

	/**
	 *    办理抵押物
	 */
	public function handleUserCollateral()
	{
		if (IS_POST) {
			$rew = $this->mypost($this->config->item('api_url'), [
				'service' => 'Srproject.Web_OperationalData.HandleUserCollateral',
				'companyid' => $this->input->cookie('companyid'),
				'mode' => explode('|', $this->input->post('goodsid', TRUE))[2],
				'billno' => $this->input->post('billno', TRUE),
				'userid' => $this->input->post('userid', TRUE),
				'memberid' => $this->input->post('memberid', TRUE),
				'goodsid' => explode('|', $this->input->post('goodsid', TRUE))[0],
				'remarks' => $this->input->post('remarks', TRUE),
				'department' => $this->input->cookie('department'),
				'num' => 1,
				'operator' => $_SESSION['users']->name,
				'client' => $this->config->item('client'),
				'price' => $this->input->post('price', TRUE),
				'opeid' => $_SESSION['users']->opeid,
			]);

			if ($rew->data->msg == 'SUCCESS') {


				set_cookie('success', '1', 3);
				set_cookie('printinfo', json_encode($rew->data->printinfo), 3);
				redirect('/management/handleUserCollateral?userid=' . $this->input->post('userid', TRUE) . '&name=' . $this->input->post('name', TRUE) . '&memberid=' . $this->input->post('memberid', TRUE));
			} else {
				set_cookie('error', '1', 3);
				set_cookie('tips', $rew->data->tips, 3);
				redirect('/management/handleUserCollateral?userid=' . $this->input->post('userid', TRUE) . '&name=' . $this->input->post('name', TRUE) . '&memberid=' . $this->input->post('memberid', TRUE));
			}
		}
		//优惠信息
		$res = $this->mypost($this->config->item('api_url'), array(
			'service' => 'Srproject.Web_GetInfo.UserCollateralSalespromotion',
			'companyid' => $this->input->cookie('companyid'),
			'userid' => $this->input->get('userid', TRUE),
			'state' => '已授权',
			'client' => $this->config->item('client'),
			'opeid' => $_SESSION['users']->opeid
		));


		if ($res->data->msg == 'SUCCESS') {
			$salespromotion = object_array($res->data->info);
		} else {
			$salespromotion = [];
		}


		$data['goods'] = object_array($_SESSION['initData']->NoSalesGoods->info);

		foreach ($data['goods'] as $k => $v) {
			$data['goods'][$k]['salestype'] = '无优惠';
			$data['goods'][$k]['yhprice'] = 0;

			foreach ($salespromotion as $vi) {

				if ($v['id'] == $vi['goodsid']) {
					if ($vi['salestype'] == '市场价格优惠' && substr($vi['strattime'], 0, -4) <= date('Y-m-d H:i:s', time()) && substr($vi['endtime'], 0, -4) >= date('Y-m-d H:i:s', time())) {
						$data['goods'][$k]['salestype'] = '市场价格优惠';
						$data['goods'][$k]['yhprice'] = $vi['price'];
						break;
					}

					if ($vi['salestype'] == '固定价格优惠') {
						$data['goods'][$k]['salestype'] = '固定价格优惠';
						$data['goods'][$k]['yhprice'] = 0;
						break;
					}
				}
			}
		}

		$data['url'] = '/msg/warehouse?userid=' . $this->input->get('userid', TRUE) . '&name=' . $this->input->get('name', TRUE) . '&begintime=2010-10-10&endtime=' . date('Y-m-d', time()) . '&memberid=' . $this->input->get('memberid', TRUE);

		$this->load->view('management/handleUserCollateral', $data);
	}


	public function preferential()
	{

		$data['admin'] = $this->getSqr(get_cookie('departmentid'));

		$this->load->view('management/preferential', $data);
	}

	/**
	 *    钢瓶收购
	 */
	public function Cylindercquisition()
	{

		if (IS_POST) {
			$post = $this->input->post();
			$post['service'] = 'Srproject.Web_OperationalData.HandleBuyUserMaterial';
			$post['companyid'] = $this->input->cookie('companyid');
			$post['department'] = $this->input->cookie('department');
			$post['operator'] = $_SESSION['users']->name;
			$post['client'] = $this->config->item('client');
			$post['opeid'] = $_SESSION['users']->opeid;

			$rew = $this->mypost($this->config->item('api_url'), $post);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('Cylindercquisition', '1', 3);
				set_cookie('printinfo', json_encode($rew->data->printinfo), 3);
				redirect('/management/Cylindercquisition?userid=' . $this->input->post('userid') . '&name=' . $this->input->post('name') . '&memberid=' . $this->input->post('memberid'));
			}
		}

		$data['BuyPackingtypeParameter'] = object_array($_SESSION['initData']->BuyPackingtypeParameter->info);
		$data['url'] = '/msg/warehouse?userid=' . $this->input->get('userid', TRUE) . '&name=' . $this->input->get('name', TRUE) . '&begintime=2010-10-10&endtime=' . date('Y-m-d', time()) . '&memberid=' . $this->input->get('memberid', TRUE);

		$this->load->view('management/CylinderAcquisition', $data);
	}


	public function mortgagedgoods()
	{


		if (IS_POST) {
			$post = $this->input->post();
			$post['id'] = explode('|', $post['id']);
			$rew = $this->mypost($this->config->item('api_url'), [
				'service' => 'Srproject.Web_OperationalData.RetreatUserCollateralMaterial',
				'id' => $post['id'][0],
				'companyid' => get_cookie('companyid'),
				'userid' => $post['userid'],
				'memberid' => $post['memberid'],
				'packingtype' => $post['id'][1],
				'code' => $post['code'],
				'department' => get_cookie('department'),
				'operator' => $_SESSION['users']->name,
				'opeid' => $_SESSION['users']->opeid,
				'client' => $this->config->item('client')
			]);

			//查询已使用抵押物
			$data['warehouse'] = $this->getMyDyw($this->input->post('userid'));
			if ($rew->data->msg == 'SUCCESS') {


				set_cookie('mortgagedgoods', '1', 3);
				set_cookie('printinfo', json_encode($rew->data->printinfo), 3);
				redirect('/management/mortgagedgoods?userid=' . $this->input->post('userid') . '&name=' . $this->input->post('name') . '&memberid=' . $this->input->post('memberid'), $data);
			} else {
				set_cookie('errormortgagedgoods', '1', 3);
				redirect('/management/mortgagedgoods?userid=' . $this->input->post('userid') . '&name=' . $this->input->post('name') . '&memberid=' . $this->input->post('memberid'), $data);
			}
		}


		//查询已使用抵押物
		$data['warehouse'] = $this->getMyDyw($this->input->get('userid'));


		$this->load->view('management/mortgagedgoods', $data);
	}


	/**
	 *    抵押物退款
	 */
	public function RetreatUserCollateral()
	{


		if (IS_POST) {
			$post = $this->input->post();
			$user = $this->getUserInfo($post['memberid']);
			$info = Mydecode($this->input->post('id'));

			$rew = $this->mypost($this->config->item('api_url'), [
				'service' => 'Srproject.Web_OperationalData.RetreatUserCollateral',
				'id' => $info['id'],
				'companyid' => get_cookie('companyid'),
				'userid' => $post['userid'],
				'username' => $user['name'],
				'attributiondepartment' => $user['attributiondepartment'],
				'customertype' => $user['customertype'],
				'salesman' => $_SESSION['users']->name,
				'memberid' => $post['memberid'],
				'billno' => $info['billno'],
				'chargelist' => $info['chargelist'] ? json_encode($info['chargelist']) : '',
				'remarks' => '',
				'department' => get_cookie('department'),
				'operator' => $_SESSION['users']->name,
				'opeid' => $_SESSION['users']->opeid,
				'client' => $this->config->item('client')
			]);
			//查询已使用抵押物
			$data['warehouse'] = $this->getMyDyw($this->input->post('userid'));
			$fy = $this->getUserOrderConditionMemberid($this->input->get('memberid'))['info_chargelist'];
			foreach ($data['warehouse'] as $k => $v) {
				foreach ($fy as $ki => $vi) {
					if ($vi['serial_collateral'] == $v['serial']) {
						$data['warehouse'][$k]['chargelist'][] = $vi;
					}
				}
			}

			if ($rew->data->msg == 'SUCCESS') {


				set_cookie('RetreatUserCollateral', '1', 3);
				set_cookie('printinfo', json_encode($rew->data->printinfo), 3);
				redirect('/management/RetreatUserCollateral?userid=' . $this->input->post('userid') . '&name=' . $this->input->post('name') . '&memberid=' . $this->input->post('memberid'), $data);
			} else {
				set_cookie('errorRetreatUserCollateral', '1', 3);
				redirect('/management/RetreatUserCollateral?userid=' . $this->input->post('userid') . '&name=' . $this->input->post('name') . '&memberid=' . $this->input->post('memberid'), $data);
			}
		}


		//查询已使用抵押物
		$data['warehouse'] = $this->getMyDyw($this->input->get('userid'));
		$fy = $this->getUserOrderConditionMemberid($this->input->get('memberid'))['info_chargelist'];
		foreach ($data['warehouse'] as $k => $v) {
			foreach ($fy as $ki => $vi) {
				if ($vi['serial_collateral'] == $v['serial']) {
					$data['warehouse'][$k]['chargelist'][] = $vi;
				}
			}
		}

		$this->load->view('management/RetreatUserCollateral', $data);
	}


	/**
	 *    办理职工气
	 */
	public function HandleUserZGQ()
	{
		if (IS_POST) {
			$post = $this->input->post();
			$rew = $this->mypost($this->config->item('api_url'), [
				'service' => 'Srproject.Web_OperationalData.HandleUserZGQ',
				'companyid' => get_cookie('companyid'),
				'userid' => $post['userid'],
				'memberid' => $post['memberid'],
				'mode' => $post['mode'],
				'remarks' => '',
				'department' => get_cookie('department'),
				'operator' => $_SESSION['users']->name,
				'opeid' => $_SESSION['users']->opeid,
				'client' => $this->config->item('client')
			]);
			if ($rew->data->msg == 'SUCCESS') {

				set_cookie('HandleUserZGQ', '1', 3);
				redirect('/management/HandleUserZGQ?userid=' . $this->input->post('userid') . '&name=' . $this->input->post('name') . '&memberid=' . $this->input->post('memberid'), $data);
			} else {
				set_cookie('errorHandleUserZGQ', '1', 3);
				redirect('/management/HandleUserZGQ?userid=' . $this->input->post('userid') . '&name=' . $this->input->post('name') . '&memberid=' . $this->input->post('memberid'), $data);
			}
		}
		$res = $this->mypost($this->config->item('api_url'), array(
			'service' => 'Srproject.Web_GetInfo.UserGoodsWarehouse',
			'companyid' => $this->input->cookie('companyid'),
			'begintime' => '',
			'endtime' => '',
			'userid' => $this->input->get('userid'),
			'state' => '正常',
			'client' => $this->config->item('client'),
			'opeid' => $_SESSION['users']->opeid
		));

		if ($res->data->msg == 'SUCCESS') {
			$data['list'] = (array) $res->data->info;
			$data['title'] = (array) $res->data->title;
			$data['key'] = (array) $res->data->key;
		}

		$this->load->view('management/HandleUserZGQ', $data);
	}


	/**
	 *    办理业务气
	 */
	public function HandleUserYWQ()
	{
		if (IS_POST) {
			$post = $this->input->post();
			$rew = $this->mypost($this->config->item('api_url'), [
				'service' => 'Srproject.Web_OperationalData.HandleUserYWQ',
				'companyid' => get_cookie('companyid'),
				'userid' => $post['userid'],
				'memberid' => $post['memberid'],
				'remarks' => '',
				'department' => get_cookie('department'),
				'operator' => $_SESSION['users']->name,
				'opeid' => $_SESSION['users']->opeid,
				'client' => $this->config->item('client')
			]);
			if ($rew->data->msg == 'SUCCESS') {

				set_cookie('HandleUserYWQ', '1', 3);
				redirect('/management/HandleUserYWQ?userid=' . $this->input->post('userid') . '&name=' . $this->input->post('name') . '&memberid=' . $this->input->post('memberid'), $data);
			} else {
				set_cookie('errorHandleUserYWQ', '1', 3);
				redirect('/management/HandleUserYWQ?userid=' . $this->input->post('userid') . '&name=' . $this->input->post('name') . '&memberid=' . $this->input->post('memberid'), $data);
			}
		}

		$res = $this->mypost($this->config->item('api_url'), array(
			'service' => 'Srproject.Web_GetInfo.UserGoodsWarehouse',
			'companyid' => $this->input->cookie('companyid'),
			'begintime' => '',
			'endtime' => '',
			'userid' => $this->input->get('userid'),
			'state' => '正常',
			'client' => $this->config->item('client'),
			'opeid' => $_SESSION['users']->opeid
		));

		if ($res->data->msg == 'SUCCESS') {
			$data['list'] = (array) $res->data->info;
			$data['title'] = (array) $res->data->title;
			$data['key'] = (array) $res->data->key;
		}
		$this->load->view('management/HandleUserYWQ', $data);
	}

	/**
	 *    残液收购
	 */
	public function HandleBuyUserRaffinate()
	{


		if (IS_POST) {
			$post = $this->input->post();
			$user = $this->getUserInfo($post['memberid']);

			$rew = $this->mypost($this->config->item('api_url'), [
				'service' => 'Srproject.Web_OperationalData.HandleBuyUserRaffinate',
				'companyid' => get_cookie('companyid'),
				'userid' => $post['userid'],
				'serialsale' => $post['serialsale'],
				'customertype' => $user['customertype'],
				'attributiondepartment' => $user['attributiondepartment'],
				'packingtype' => $post['packingtype'],
				'price' => $post['price'],
				'num' => $post['num'],
				'code' => $post['code'],
				'memberid' => $post['memberid'],
				'remarks' => $post['remarks'],
				'brokerage' => $post['brokerage'],
				'salesman' => $post['salesman'],
				'department' => get_cookie('department'),
				'operator' => $_SESSION['users']->name,
				'opeid' => $_SESSION['users']->opeid,
				'client' => $this->config->item('client')
			]);
			if ($rew->data->msg == 'SUCCESS') {

				set_cookie('HandleBuyUserRaffinate', '1', 3);
				redirect('/management/HandleBuyUserRaffinate?userid=' . $this->input->post('userid') . '&name=' . $this->input->post('name') . '&memberid=' . $this->input->post('memberid'), $data);
			} else {
				set_cookie('errorHandleBuyUserRaffinate', '1', 3);
				redirect('/management/HandleBuyUserRaffinate?userid=' . $this->input->post('userid') . '&name=' . $this->input->post('name') . '&memberid=' . $this->input->post('memberid'), $data);
			}
		}
		//获取残叶订单

		$data['list'] = $this->getMyHandleBuyUserRaffinate($this->input->get('userid'));
		$this->load->view('management/HandleBuyUserRaffinate', $data);
	}

	/**
	 *    办理用户混搭方案
	 */
	public function HandleUserSalesMashup()
	{

		if (IS_POST) {
			$post = $this->input->post();

			$rew = $this->mypost($this->config->item('api_url'), [
				'service' => 'Srproject.Web_OperationalData.HandleUserSalesMashup',
				'companyid' => get_cookie('companyid'),
				'userid' => $post['userid'],
				'id' => $post['id'],
				'num' => $post['num'],
				'memberid' => $post['memberid'],
				'remarks' => $post['remarks'],
				'department' => get_cookie('department'),
				'operator' => $_SESSION['users']->name,
				'opeid' => $_SESSION['users']->opeid,
				'client' => $this->config->item('client')
			]);
 
			if ($rew->data->msg == 'SUCCESS') {

				set_cookie('HandleUserSalesMashup', '1', 3);
				set_cookie('printinfo', json_encode($rew->data->printinfo), 3);

				redirect('/management/HandleUserSalesMashup?userid=' . $this->input->post('userid') . '&name=' . $this->input->post('name') . '&memberid=' . $this->input->post('memberid'), $data);
			} else {
				set_cookie('errorHandleUserSalesMashup', '1', 3);
				redirect('/management/HandleUserSalesMashup?userid=' . $this->input->post('userid') . '&name=' . $this->input->post('name') . '&memberid=' . $this->input->post('memberid'), $data);
			}
		}
		$data['plan'] = $this->getPlans();
		$this->load->view('management/HandleUserSalesMashup', $data);
	}


	public function RetirementInventory()
	{

		$userid = $this->input->get('userid');
		$name = $this->input->get('name');
		$begintime = $this->input->get('begintime');
		$endtime = $this->input->get('endtime');

		$data['list'] = [];
		$data['key'] = [];
		$data['title'] = [];
		$data['name'] = $name;

		if ($begintime && $endtime) {
			$res = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.UserGoodsWarehouse',
				'companyid' => $this->input->cookie('companyid'),
				'begintime' => $begintime,
				'endtime' => $endtime,
				'userid' => $userid,
				'state' => '全部',
				'client' => $this->config->item('client'),
				'opeid' => $_SESSION['users']->opeid
			));

			if ($res->data->msg == 'SUCCESS') {
				$data['list'] = (array) $res->data->info;
				$data['title'] = (array) $res->data->title;
				$data['key'] = (array) $res->data->key;
			}
		}
		$this->load->view('management/RetirementInventory', $data);
	}
}
