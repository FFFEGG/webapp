<?php

class Msg extends HomeBase
{
	/**
	 *    收款信息
	 */
	public function Receivables()
	{

		$userid = $this->input->get('userid');
		$name = $this->input->get('name');
		$begintime = $this->input->get('begintime');
		$endtime = $this->input->get('endtime');
		$data['list'] = [];

		if ($begintime && $endtime) {

			$res = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.UserReceivablesInfo',
				'companyid' => $this->input->cookie('companyid'),
				'begintime' => $begintime,
				'endtime' => $endtime,
				'userid' => $userid,
				'project' => $this->input->get('project'),
				'client' => $this->config->item('client'),
				'opeid' => $_SESSION['users']->opeid
			));

			if ($res->data->msg == 'SUCCESS') {
				$data['list'] = (array)$res->data->info;
			}
		}

		$data['name'] = $name;

		$this->load->view('msg/receivables', $data);
	}

	/**
	 *    销售信息
	 */
	public function sale()
	{

		$userid = $this->input->get('userid');
		$name = $this->input->get('name');
		$begintime = $this->input->get('begintime');
		$endtime = $this->input->get('endtime');
		$data['list'] = [];
		if ($begintime && $endtime) {
			$res = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.UserSaleInfo',
				'companyid' => $this->input->cookie('companyid'),
				'begintime' => $begintime,
				'endtime' => $endtime,
				'userid' => $userid,
				'client' => $this->config->item('client'),
				'opeid' => $_SESSION['users']->opeid
			));

			if ($res->data->msg == 'SUCCESS') {
				$data['list'] = (array)$res->data->info;
			}

		}


		$data['name'] = $name;

		$this->load->view('msg/sale', $data);
	}

	/**
	 *
	 */
	public function tabledata()
	{

		$this->load->view('msg/tabledata');
	}

	/**
	 *
	 */
	public function ReportDetailed()
	{

		$this->load->view('msg/ReportDetailed');
	}

	/**
	 * 订单列表
	 */
	public function order()
	{

		$userid = $this->input->get('userid');
		$name = $this->input->get('name');
		$begintime = $this->input->get('begintime');
		$endtime = $this->input->get('endtime');
		$data['list'] = [];
		if ($begintime && $endtime) {
			$res = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.UserOrderInfo',
				'companyid' => $this->input->cookie('companyid'),
				'begintime' => $begintime,
				'endtime' => $endtime,
				'userid' => $userid,
				'client' => $this->config->item('client'),
				'opeid' => $_SESSION['users']->opeid
			));
			if ($res->data->msg == 'SUCCESS') {
				$data['list'] = (array)$res->data->mainorderlist;
			}

			foreach ($data['list'] as $k => $v) {
				foreach ($res->data->suborderlist as $vi) {
					if ($v->serial == $vi->serial) {
						$data['list'][$k]->sub[] = $vi;
						if ($vi->state == 2) {
							$data['list'][$k]->state = 2;
						}
					}

				}
			}
		}
		$data['name'] = $name;
		$this->load->view('msg/order', $data);
	}

	/**
	 * 子订单信息
	 */
	public function orderlist()
	{
		$data['list'] = json_decode(base64_decode($this->input->get('info')));
		$this->load->view('msg/orderlist', $data);
	}


	/**
	 *　抵押物收费信息
	 */
	public function charge()
	{

		$userid = $this->input->get('userid');
		$name = $this->input->get('name');
		$begintime = $this->input->get('begintime');
		$endtime = $this->input->get('endtime');
		$state = $this->input->get('state');
		$data['list'] = [];
		$data['name'] = $name;

		if ($begintime && $endtime) {
			$rew = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.UserCollateralCharge',
				'companyid' => $this->input->cookie('companyid'),
				'begintime' => $begintime,
				'endtime' => $endtime,
				'userid' => $userid,
				'state' => '全部',
				'client' => $this->config->item('client'),
				'opeid' => $_SESSION['users']->opeid
			));

			if ($rew->data->msg == 'SUCCESS') {

				$data['list'] = (array)$rew->data->info;
				$data['title'] = (array)$rew->data->title;
				$data['key'] = (array)$rew->data->key;
			}
		}

		$this->load->view('msg/charge', $data);
	}

	/**
	 *　抵押物费用优惠信息
	 */
	public function chargeSalespromotion()
	{

		$userid = $this->input->get('userid');
		$name = $this->input->get('name');
		$begintime = $this->input->get('begintime');
		$endtime = $this->input->get('endtime');
		$state = $this->input->get('state');
		$data['list'] = [];
		$data['key'] = [];
		$data['title'] = [];
		$data['name'] = $name;

		if ($begintime && $endtime) {
			$res = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.UserCollateralChargeSalespromotion',
				'companyid' => 101,
				'begintime' => $begintime,
				'endtime' => $endtime,
				'userid' => $userid,
				'state' => '全部',
				'client' => $this->config->item('client'),
				'opeid' => $_SESSION['users']->opeid
			));

			if ($res->data->msg == 'SUCCESS') {
				$data['list'] = (array)$res->data->info;
				$data['title'] = (array)$res->data->title;
				$data['key'] = (array)$res->data->key;
			}
		}
		$this->load->view('msg/chargeSalespromotion', $data);
	}

	/**
	 *　抵押物优惠信息
	 */
	public function salespromotion()
	{

		$userid = $this->input->get('userid');
		$name = $this->input->get('name');
		$begintime = $this->input->get('begintime');
		$endtime = $this->input->get('endtime');
		$state = $this->input->get('state');
		$data['list'] = [];
		$data['key'] = [];
		$data['title'] = [];
		$data['name'] = $name;

		if ($begintime && $endtime) {
			$res = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.UserCollateralSalespromotion',
				'companyid' => $this->input->cookie('companyid'),
				'begintime' => $begintime,
				'endtime' => $endtime,
				'userid' => $userid,
				'state' => '全部',
				'client' => $this->config->item('client'),
				'opeid' => $_SESSION['users']->opeid
			));

			if ($res->data->msg == 'SUCCESS') {
				$data['list'] = (array)$res->data->info;
				$data['title'] = (array)$res->data->title;
				$data['key'] = (array)$res->data->key;
			}
		}
		$this->load->view('msg/salespromotion', $data);
	}

	/**
	 *　抵押物库存信息
	 */
	public function warehouse()
	{

		$userid = $this->input->get('userid');
		$name = $this->input->get('name');
		$begintime = $this->input->get('begintime');
		$endtime = $this->input->get('endtime');
		$state = $this->input->get('state');
		$data['list'] = [];
		$data['key'] = [];
		$data['title'] = [];
		$data['name'] = $name;

		if ($begintime && $endtime) {
			$res = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.UserCollateralWarehouse',
				'companyid' => $this->input->cookie('companyid'),
				'begintime' => $begintime,
				'endtime' => $endtime,
				'userid' => $userid,
				'state' => '全部',
				'client' => $this->config->item('client'),
				'opeid' => $_SESSION['users']->opeid
			));

			if ($res->data->msg == 'SUCCESS') {
				$data['list'] = (array)$res->data->info;
				$data['title'] = (array)$res->data->title;
				$data['key'] = (array)$res->data->key;
			}
		}
		$this->load->view('msg/warehouse', $data);
	}

	/**
	 *　商品促销方案信息
	 */
	public function goodsSalespromotion()
	{

		$userid = $this->input->get('userid');
		$name = $this->input->get('name');
		$begintime = $this->input->get('begintime');
		$endtime = $this->input->get('endtime');
		$state = $this->input->get('state');
		$data['list'] = [];
		$data['key'] = [];
		$data['title'] = [];
		$data['name'] = $name;

		if ($begintime && $endtime) {
			$res = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.UserGoodsSalespromotion',
				'companyid' => $this->input->cookie('companyid'),
				'begintime' => $begintime,
				'endtime' => $endtime,
				'userid' => $userid,
				'state' => '全部',
				'client' => $this->config->item('client'),
				'opeid' => $_SESSION['users']->opeid
			));

			if ($res->data->msg == 'SUCCESS') {
				$data['list'] = (array)$res->data->info;
				$data['title'] = (array)$res->data->title;
				$data['key'] = (array)$res->data->key;
			}
		}
		$this->load->view('msg/goodsSalespromotion', $data);
	}

	/**
	 *　商品库存信息
	 */
	public function goodswarehouse()
	{

		$userid = $this->input->get('userid');
		$name = $this->input->get('name');
		$begintime = $this->input->get('begintime');
		$endtime = $this->input->get('endtime');
		$state = $this->input->get('state');
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
				'state' => '正常',
				'client' => $this->config->item('client'),
				'opeid' => $_SESSION['users']->opeid
			));

			if ($res->data->msg == 'SUCCESS') {
				$data['list'] = (array)$res->data->info;
				$data['title'] = (array)$res->data->title;
				$data['key'] = (array)$res->data->key;
			}
		}
		$this->load->view('msg/goodswarehouse', $data);
	}


	/**
	 *　残液信息
	 */
	public function raffinateInfo()
	{

		$userid = $this->input->get('userid');
		$name = $this->input->get('name');
		$begintime = $this->input->get('begintime');
		$endtime = $this->input->get('endtime');
		$state = $this->input->get('state');
		$data['list'] = [];
		$data['key'] = [];
		$data['title'] = [];
		$data['name'] = $name;

		if ($begintime && $endtime) {
			$res = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.UserRaffinateInfo',
				'companyid' => $this->input->cookie('companyid'),
				'begintime' => $begintime,
				'endtime' => $endtime,
				'userid' => $userid,
				'state' => '正常',
				'client' => $this->config->item('client'),
				'opeid' => $_SESSION['users']->opeid
			));

			if ($res->data->msg == 'SUCCESS') {
				$data['list'] = (array)$res->data->info;
				$data['title'] = (array)$res->data->title;
				$data['key'] = (array)$res->data->key;
			}
		}
		$this->load->view('msg/raffinateInfo', $data);
	}


	public function mdtable()
	{
		$this->load->view('msg/mdtable');
	}


	/**
	 *    员工欠款记录
	 */
	public function StaffArrearsRecord()
	{
		$Operator = groupByInitials(object_array($_SESSION['initData']->Operator->info));

		foreach ($Operator as $v) {
			foreach ($v as $vi) {
				if ($vi['departmentid'] == get_cookie('departmentid')) {
					$data['Operator'][] = $vi;
				}
			}

		}

		$begintime = $this->input->get('begintime');
		$endtime = $this->input->get('endtime');
		$state = $this->input->get('state');
		$staff = $this->input->get('staff');


		$data['list'] = [];
		$data['key'] = [];
		$data['title'] = [];


		if ($begintime && $endtime) {
			$res = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.StaffArrearsRecord',
				'companyid' => $this->input->cookie('companyid'),
				'begintime' => $begintime,
				'endtime' => $endtime,
				'state' => $state,
				'staff' => $staff,
				'department' => get_cookie('department'),
				'client' => $this->config->item('client'),
				'opeid' => $_SESSION['users']->opeid
			));

			if ($res->data->msg == 'SUCCESS') {
				$data['list'] = (array)$res->data->info;
				$data['title'] = (array)$res->data->title;
				$data['key'] = (array)$res->data->key;
			}
		}

		$this->load->view('msg/StaffArrearsRecord', $data);
	}

	/**
	 *　残液信息
	 */
	public function DepartmentRaffinateInfo()
	{


		$begintime = $this->input->get('begintime');
		$endtime = $this->input->get('endtime');


		$data['list'] = [];
		$data['key'] = [];
		$data['title'] = [];


		if ($begintime && $endtime) {
			$res = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.DepartmentRaffinateInfo',
				'companyid' => $this->input->cookie('companyid'),
				'begintime' => $begintime,
				'endtime' => $endtime,
				'department' => $this->input->get('department')?$this->input->get('department'):'',
				'attributiondepartment' => $this->input->get('attributiondepartment')?$this->input->get('attributiondepartment'):'',
				'client' => $this->config->item('client'),
				'opeid' => $_SESSION['users']->opeid
			));

			if ($res->data->msg == 'SUCCESS') {
				$data['list'] = (array)$res->data->info;
				$data['title'] = (array)$res->data->title;
				$data['key'] = (array)$res->data->key;
			}
		}
		$this->load->view('msg/DepartmentRaffinateInfo', $data);
	}


	/**
	 *　维修记录信息
	 */
	public function repairInfo()
	{

		$userid = $this->input->get('userid');
		$name = $this->input->get('name');
		$begintime = $this->input->get('begintime');
		$endtime = $this->input->get('endtime');
		$state = $this->input->get('state');
		$data['list'] = [];
		$data['key'] = [];
		$data['title'] = [];
		$data['name'] = $name;

		if ($begintime && $endtime) {
			$res = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.UserRepairInfo',
				'companyid' => $this->input->cookie('companyid'),
				'begintime' => $begintime,
				'endtime' => $endtime,
				'userid' => $userid,
				'state' => '正常',
				'client' => $this->config->item('client'),
				'opeid' => $_SESSION['users']->opeid
			));

			if ($res->data->msg == 'SUCCESS') {
				$data['list'] = (array)$res->data->info;
				$data['title'] = (array)$res->data->title;
				$data['key'] = (array)$res->data->key;
			}
		}

		$this->load->view('msg/repairInfo', $data);
	}


	/**
	 *　维修记录信息
	 */
	public function inforepair()
	{

		$userid = $this->input->get('userid');
		$name = $this->input->get('name');
		$begintime = $this->input->get('begintime');
		$endtime = $this->input->get('endtime');
		$state = $this->input->get('state');
		$data['list'] = [];
		$data['key'] = [];
		$data['title'] = [];
		$data['name'] = $name;

		if ($begintime && $endtime) {
			$res = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.UserRepairInfo',
				'companyid' => $this->input->cookie('companyid'),
				'begintime' => $begintime,
				'endtime' => $endtime,
				'userid' => $userid,
				'state' => '正常',
				'client' => $this->config->item('client'),
				'opeid' => $_SESSION['users']->opeid
			));

			if ($res->data->msg == 'SUCCESS') {
				$data['list'] = (array)$res->data->info;
				$data['title'] = (array)$res->data->title;
				$data['key'] = (array)$res->data->key;
			}
		}

		$this->load->view('msg/inforepair', $data);
	}

	/**
	 *　退瓶（物资）信息
	 */
	public function retreatCollateralInfo()
	{

		$userid = $this->input->get('userid');
		$name = $this->input->get('name');
		$begintime = $this->input->get('begintime');
		$endtime = $this->input->get('endtime');
		$state = $this->input->get('state');
		$data['list'] = [];
		$data['key'] = [];
		$data['title'] = [];
		$data['name'] = $name;

		if ($begintime && $endtime) {
			$res = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.UserRetreatCollateralInfo',
				'companyid' => $this->input->cookie('companyid'),
				'begintime' => $begintime,
				'endtime' => $endtime,
				'userid' => $userid,
				'state' => '全部',
				'client' => $this->config->item('client'),
				'opeid' => $_SESSION['users']->opeid
			));

			if ($res->data->msg == 'SUCCESS') {
				$data['list'] = (array)$res->data->info;
				$data['title'] = (array)$res->data->title;
				$data['key'] = (array)$res->data->key;
			}
		}
		$this->load->view('msg/retreatCollateralInfo', $data);
	}

	/**
	 *　案件记录
	 */
	public function UserSecurityCheckRecord()
	{

		$userid = $this->input->get('userid');
		$name = $this->input->get('name');
		$begintime = $this->input->get('begintime');
		$endtime = $this->input->get('endtime');
		$state = $this->input->get('state') ? $this->input->get('state') : '全部';
		$data['list'] = [];
		$data['key'] = [];
		$data['title'] = [];
		$data['name'] = $name;

		if ($begintime && $endtime) {
			$res = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.UserSecurityCheckRecord',
				'companyid' => $this->input->cookie('companyid'),
				'begintime' => $begintime,
				'endtime' => $endtime,
				'userid' => $userid,
				'state' => $state,
				'client' => $this->config->item('client'),
				'department' => get_cookie('department'),
				'opeid' => $_SESSION['users']->opeid
			));

			if ($res->data->msg == 'SUCCESS') {
				$data['list'] = (array)$res->data->info;
				$data['title'] = (array)$res->data->title;
				$data['key'] = (array)$res->data->key;
			}
		}
		$this->load->view('msg/UserSecurityCheckRecord', $data);
	}

	/**
	 *　案件记录
	 */
	public function UserSnsBindingInfo()
	{

		$userid = $this->input->get('userid');
		$name = $this->input->get('name');
		$data['list'] = [];
		$data['key'] = [];
		$data['title'] = [];
		$data['name'] = $name;

		$res = $this->mypost($this->config->item('api_url'), array(
			'service' => 'Srproject.Web_GetInfo.UserSnsBindingInfo',
			'userid' => $userid,
		));
		if ($res->data->msg == 'SUCCESS') {
			$data['list'] = (array)$res->data->info;
			$data['title'] = (array)$res->data->title;
			$data['key'] = (array)$res->data->key;
		}

		$this->load->view('msg/UserSnsBindingInfo', $data);
	}


	/**
	 *　案件记录
	 */
	public function snslist()
	{

		$userid = $this->input->get('userid');
		$name = $this->input->get('name');
		$data['list'] = [];
		$data['key'] = [];
		$data['title'] = [];
		$data['name'] = $name;

		$res = $this->mypost($this->config->item('api_url'), array(
			'service' => 'Srproject.Web_GetInfo.UserSnsBindingList',
			'begintime' => $this->input->get('begintime'),
			'endtime' => $this->input->get('endtime'),
			'state' => $this->input->get('state'),
		));

		if ($this->input->get('begintime')) {
			$rew = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.UserUnpaidOrderRecord',
				'begintime' => $this->input->get('begintime'),
				'endtime' => $this->input->get('endtime')
			));
		 
			$data['UserUnpaidOrderRecord'] = $rew->data->info;
		}



		if ($res->data->msg == 'SUCCESS') {
			$data['list'] = (array)$res->data->info;
			$data['title'] = (array)$res->data->title;
			$data['key'] = (array)$res->data->key;
		}

		$this->load->view('msg/snslist', $data);
	}


	/**
	 *　案件记录
	 */
	public function DepartmentSecurityCheckRecord()
	{

		$userid = $this->input->get('userid');
		$name = $this->input->get('name');
		$begintime = $this->input->get('begintime');
		$endtime = $this->input->get('endtime');
		$state = $this->input->get('state') ? $this->input->get('state') : '全部';
		$deliverydepartment = $this->input->get('securitycheckdepartment') ? $this->input->get('securitycheckdepartment') : '全部';
		$data['list'] = [];
		$data['key'] = [];
		$data['title'] = [];
		$data['name'] = $name;

		if ($begintime && $endtime) {
			$res = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.DepartmentSecurityCheckRecord',
				'begintime' => $begintime,
				'endtime' => $endtime,
				'state' => $state,
				'securitycheckdepartment' => $deliverydepartment,
				'memberid' =>  $this->input->get('memberid'),
				'department' => get_cookie('department'),
				'opeid' => $_SESSION['users']->opeid,
			));
			if ($res->data->msg == 'SUCCESS') {
				$data['list'] = (array)$res->data->info;
				$data['title'] = (array)$res->data->title;
				$data['key'] = (array)$res->data->key;
			}
		}
		if ($_SESSION['users']->logindepartmenttype == '业务门店') {
			$this->load->view('ywpage/DepartmentSecurityCheckRecord', $data);
		} else {
			$this->load->view('msg/DepartmentSecurityCheckRecord', $data);
		}

	}


	public function wzgl()
	{
		$this->load->view('ywpage/wzgl');
	}

	/**
	 *　案件记录
	 */
	public function UserGoodsArrearsRecord()
	{

		if ($this->input->get('memberid')) {
			$userid = $this->getUserInfo($this->input->get('memberid'))['id'];
		} else {
			$userid = $this->input->get('userid');
		}

		$salesman = $this->input->get('salesman');


		$name = $this->input->get('name');
		$begintime = $this->input->get('begintime');
		$endtime = $this->input->get('endtime');
		$state = $this->input->get('state') ? $this->input->get('state') : '全部';
		$data['list'] = [];
		$data['key'] = [];
		$data['title'] = [];
		$data['name'] = $name;

		if ($begintime && $endtime) {

			$res = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.UserGoodsArrearsRecord',
				'begintime' => $begintime,
				'endtime' => $endtime,
				'state' => $state,
				'userid' => $userid,
				'salesman' => $salesman,
				'goodstype' => $this->input->get('goodstype')?$this->input->get('goodstype'):'全部',
				'type' => $this->input->get('type')?$this->input->get('type'):'全部',
				'department' => $this->input->get('department'),
				'opeid' => $_SESSION['users']->opeid,
			));

			if ($res->data->msg == 'SUCCESS') {
				$data['list'] = (array)$res->data->info;
				$data['title'] = (array)$res->data->title;
				$data['key'] = (array)$res->data->key;
			}
		}

		$this->load->view('msg/UserGoodsArrearsRecord', $data);
	}

	/**
	 *　案件记录
	 */
	public function PackingtypeCirculationInfo()
	{

		if ($this->input->get('memberid')) {
			$userid = $this->getUserInfo($this->input->get('memberid'))['id'];
		} else {
			$userid = $this->input->get('userid');
		}

		$salesman = $this->input->get('salesman');


		$name = $this->input->get('name');
		$num = $this->input->get('num') ? $this->input->get('num') : 10;
		$code = $this->input->get('code') ? $this->input->get('code') : '';
		$begintime = $this->input->get('begintime');
		$endtime = $this->input->get('endtime');
		$state = $this->input->get('state') ? $this->input->get('state') : '全部';
		$data['list'] = [];
		$data['key'] = [];
		$data['title'] = [];
		$data['name'] = $name;

		if ($begintime && $endtime) {
			$res = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.PackingtypeCirculationInfo',
				'begintime' => $begintime,
				'endtime' => $endtime,
				'state' => $state,
				'num' => $num,
				'code' => $code,
				'memberid' => $this->input->get('memberid'),
				'department' => get_cookie('department'),
				'opeid' => $_SESSION['users']->opeid,
			));

			if ($res->data->msg == 'SUCCESS') {
				$data['list'] = (array)$res->data->info;
				$data['title'] = (array)$res->data->title;
				$data['key'] = (array)$res->data->key;
			}
		}

		$this->load->view('msg/PackingtypeCirculationInfo', $data);
	}


	public function SnsUserRepairList()
	{
		$begintime = $this->input->get('begintime');
		$endtime = $this->input->get('endtime');
		$state = $this->input->get('state') ? $this->input->get('state') : '全部';
		$data['list'] = [];
		$data['key'] = [];
		$data['title'] = [];


		if ($begintime && $endtime) {
			$res = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.SnsUserRepairList',
				'begintime' => $begintime,
				'endtime' => $endtime,
				'state' => $state,
				'department' => get_cookie('department'),
				'opeid' => $_SESSION['users']->opeid,
			));
			if ($res->data->msg == 'SUCCESS') {
				$data['list'] = (array)$res->data->info;
				$data['title'] = (array)$res->data->title;
				$data['key'] = (array)$res->data->key;
			}
		}
		$this->load->view('msg/SnsUserRepairList', $data);
	}

	public function AddPackingtypeCheakRecord()
	{

		if (IS_POST) {
			$heard = $this->getHeards();
			$post = $this->input->post();
			$post['service'] = 'Srproject.Web_OperationalData.AddPackingtypeCheakRecord';
			$arr = array_merge($heard,$post);
			$arr['serial'] = md5(time().rand(0.99999));
			$arr['userid'] = 0;
			$rew = $this->mypost($this->config->item('api_url'),$arr);

			if ($rew->data->msg == 'SUCCESS') {

				set_cookie('success', '1', 3);
				redirect('user/AddPackingtypeCheakRecord?data=' . $this->input->post('data'));
			} else {
				set_cookie('error', '1', 3);
				redirect('user/AddPackingtypeCheakRecord?data=' . $this->input->post('data'));
			}
		}
		$this->load->view('msg/AddPackingtypeCheakRecord');
	}


	public function OrderPrintList()
	{
		$begintime = $this->input->get('begintime');
		$endtime = $this->input->get('endtime');
		$state = $this->input->get('state') ? $this->input->get('state') : '全部';
		$data['list'] = [];
		$data['key'] = [];
		$data['title'] = [];


		if ($begintime && $endtime) {
			$res = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.OrderPrintList',
				'begintime' => $begintime,
				'endtime' => $endtime,
				'state' => '全部',
				'memberid' => $this->input->get('memberid'),
				'department' => get_cookie('department'),
				'opeid' => $_SESSION['users']->opeid,
			));
			
			if ($res->data->msg == 'SUCCESS') {
				$data['list'] = (array)$res->data->info;
				$data['title'] = (array)$res->data->title;
				$data['key'] = (array)$res->data->key;
			}
		}
		$this->load->view('msg/OrderPrintList', $data);
	}

	public function AllocationMaterielFlow()
	{
		$begintime = $this->input->get('begintime');
		$endtime = $this->input->get('endtime');
		$state = $this->input->get('state') ? $this->input->get('state') : '全部';
		$data['list'] = [];
		$data['key'] = [];
		$data['title'] = [];


		if ($begintime && $endtime) {
			$res = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.AllocationMaterielFlow',
				'begintime' => $begintime,
				'endtime' => $endtime,
				'mode' => $this->input->get('mode'),
				'department' => get_cookie('department'),
				'opeid' => $_SESSION['users']->opeid,
			));

			if ($res->data->msg == 'SUCCESS') {
				$data['list'] = (array)$res->data->info;
				$data['title'] = (array)$res->data->title;
				$data['key'] = (array)$res->data->key;
			}
		}
		$this->load->view('msg/AllocationMaterielFlow', $data);
	}

	public function OpeStock()
	{

		$data['Operator'] = groupByInitials(object_array($_SESSION['initData']->Operator->info));
		$data['department'] = object_array($_SESSION['initData']->Department->info);

		$begintime = $this->input->get('begintime');
		$endtime = $this->input->get('endtime');
		$state = $this->input->get('state') ? $this->input->get('state') : '全部';
		$data['list'] = [];
		$data['key'] = [];
		$data['title'] = [];


		if ($begintime && $endtime) {
			$res = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.OpeStock',
				'begintime' => $begintime,
				'endtime' => $endtime,
				'opename' => $this->input->get('opename'),
				'department' => $this->input->get('department'),
				'state' => $state,
				'opeid' => $_SESSION['users']->opeid,
			));

			if ($res->data->msg == 'SUCCESS') {
				$data['list'] = (array)$res->data->info;
				$data['title'] = (array)$res->data->title;
				$data['key'] = (array)$res->data->key;

				$list = object_array($data['list']);
				$arr = [];
				foreach ($list as $k => $v) {
					$arr[$v['packingtype']][] = $v;
				}
				$data['typelist'] = $arr;

			}
		}
		$this->load->view('msg/OpeStock', $data);
	}


	public function UserGoodsWarehouseUseRecord()
	{
		$res = $this->mypost($this->config->item('api_url'), array(
			'service' => 'Srproject.Web_GetInfo.UserGoodsWarehouseUseRecord',
			'warehouseid' => $this->input->get('id'),
		));

		if ($res->data->msg == 'SUCCESS') {
			$data['list'] = (array)$res->data->info;
			$data['title'] = (array)$res->data->title;
			$data['key'] = (array)$res->data->key;
		}

		$this->load->view('msg/UserGoodsWarehouseUseRecord', $data);
	}


	public function tables()
	{
		$this->load->view('msg/tables');
	}

	public function ggshow()
	{

		$info = Mydecode($this->input->get('info'));
		$data['info'] = $info;

		$this->load->view('msg/show', $data);
	}


	public function editgg()
	{
		$rew =  $this->mypost($this->config->item('api_url'), [
			'service' => 'Srproject.Web_GetSystemInfo.BulletinBoard',
			'departmentid' => get_cookie('departmentid'),
			'state' => '全部',
			'opeid' => $_SESSION['users']->opeid,
			'operator' => $_SESSION['users']->name,
		]);

		if ($rew->data->msg == 'SUCCESS') {
			$data['list'] = object_array($rew->data->info);
			$this->load->view('msg/editgg', $data);
		} else {
			$data['list'] = object_array($rew->data->info);
			$this->load->view('msg/editgg', $data);
		}


	}


	public function gg()
	{
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post, $this->getHeards());
			$post['action'] = 'ADD';
			$post['state'] = '正常';
			$post['issuer'] = $_SESSION['users']->name;

			$post['service'] = 'Srproject.Web_SystemSetting.SettingBulletinBoard';

			$rew = $this->mypost($this->config->item('api_url'), $post);
			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('msg/gg');
			} else {
				set_cookie('error', '1', 1);
				redirect('msg/gg');
			}
		}
		$this->load->view('msg/gg');
	}

	public function ggedit()
	{
		$data['info'] = Mydecode($this->input->get('info'));
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post, $this->getHeards());
			$post['action'] = 'UPDATE';
			$post['state'] = '正常';
			$post['issuer'] = $_SESSION['users']->name;
			$post['service'] = 'Srproject.Web_SystemSetting.SettingBulletinBoard';

			$rew = $this->mypost($this->config->item('api_url'), $post);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('msg/ggedit');
			} else {
				set_cookie('error', '1', 1);
				redirect('msg/ggedit');
			}
		}
		$this->load->view('msg/ggedit',$data);
	}

	/**
	 *    案件详情
	 */
	public function showproject()
	{
		$data['project'] = Mydecode($this->input->get('data'));

		$this->load->view('msg/showproject', $data);
	}


	/**
	 *    案件详情
	 */
	public function DepartmentPersonnelWorkload()
	{
		$data['Operator'] = [];

		foreach ($_SESSION['initData']->Operator->info as $v) {
			if ($v->quartersid == 2 && $v->departmentid == get_cookie('departmentid')) {
				$data['Operator'][] = object_array($v);
			}
		}
		$begintime = $this->input->get('begintime');
		$endtime = $this->input->get('endtime');
		$deliveryman = $this->input->get('deliveryman');

		$data['list'] = [];
		$data['key'] = [];
		$data['title'] = [];


		if ($begintime && $endtime) {
			$res = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_BusinessReport.DepartmentPersonnelWorkload',
				'begintime' => $begintime,
				'endtime' => $endtime,
				'opename' => $this->input->get('opename'),
				'department' => get_cookie('department'),
				'deliveryman' => $deliveryman,
				'opeid' => $_SESSION['users']->opeid,
			));

			if ($res->data->msg == 'SUCCESS') {
				$data['list'] = (array)$res->data->info;
				$data['title'] = (array)$res->data->title;
				$data['key'] = (array)$res->data->key;

				$list = object_array($data['list']);
				$arr = [];
				foreach ($list as $k => $v) {
					$arr[$v['packingtype']][] = $v;
				}
				$data['typelist'] = $arr;

			}
		}

		$this->load->view('msg/DepartmentPersonnelWorkload', $data);
	}


	/**
	 *    钢瓶修漏查询
	 */
	public function GPxiulou()
	{
		$this->load->view('msg/GPxiulou');
	}


	/**
	 *  员工登录记录
	 */
	public function OpeLoginRecord()
	{
		$this->load->view('msg/OpeLoginRecord');
	}

	/**
	 *    配送错误瓶信息
	 */
	public function DeliveryError()
	{
		$this->load->view('msg/DeliveryError');
	}


	/**
	 *    催气催水统计
	 */
	public function ReservationCenterCQCS()
	{
		$this->load->view('msg/ReservationCenterCQCS');
	}

	/**
	 *     员工电话工作量
	 */
	public function ReservationCenterCallWorkload()
	{
		$this->load->view('msg/ReservationCenterCallWorkload');
	}

	/**
	 *     员工工作量
	 */
	public function ReservationCenterWorkload()
	{
		$this->load->view('msg/ReservationCenterWorkload');
	}


	/**
	 *    销售部统计
	 */
	public function ExpandManageSale()
	{
		$this->load->view('msg/ExpandManageSale');
	}

	/**
	 *    水票核销报表
	 */
	public function DepartmentWaterBill()
	{
		$this->load->view('msg/DepartmentWaterBill');
	}


	/**
	 *    门店-- 收款报表
	 */
	public function DepartmentReceivables()
	{
		$this->load->view('msg/DepartmentReceivables');
	}

	/**
	 *    门店-- 商品物资库存报表
	 */
	public function DepartmentGoodsStock()
	{
		$this->load->view('msg/DepartmentGoodsStock');
	}

	/**
	 * 门店-- 商品物资销售报表
	 */
	public function DepartmentGoodsSale()
	{
		$this->load->view('msg/DepartmentGoodsSale');
	}

	/**
	 * 部门-- 管理用户销售报表
	 */
	public function CommercialManageSale()
	{
		$this->load->view('msg/CommercialManageSale');
	}


	/**
	 * 部门-- 管理新用户销售报表
	 */
	public function CommercialSalesmanNewUserSale()
	{
		$this->load->view('msg/CommercialSalesmanNewUserSale');
	}


	/**
	 * 门店可取消记录
	 */
	public function DepartmentCanCancelBusinessRecord()
	{
		$this->load->view('msg/DepartmentCanCancelBusinessRecord');
	}

	/**
	 * 同组区域
	 */
	public function AreaDeliverymanList()
	{
		$this->load->view('msg/AreaDeliverymanList');
	}

	/**
	 * 门店收回用户钢瓶物资
	 */
	public function RecyclingMaterials()
	{
		$this->load->view('msg/RecyclingMaterials');
	}

	/**
	 * 获取档案信息
	 */
	public function GetArchives()
	{
		$this->load->view('msg/GetArchives');
	}

	/**
	 * 获取档案信息
	 */
	public function ArchivesList()
	{
		$this->load->view('msg/ArchivesList');
	}

	/**
	 * 已申请配送员补贴记录
	 */
	public function DepartmentApplyeDeliverymanSubsidyRecord()
	{
		$this->load->view('msg/DepartmentApplyeDeliverymanSubsidyRecord');
	}

	/**
	 * 已申请配送员补贴记录
	 */
	public function DepartmentCanApplyeDeliverymanSubsidyRecord()
	{
		$this->load->view('msg/DepartmentCanApplyeDeliverymanSubsidyRecord');
	}


}
