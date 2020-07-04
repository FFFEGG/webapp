<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Commercialgas extends HomeBase
{
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

		$this->load->view('commercialgas/PackingtypeCirculationInfo', $data);
	}

	public function userManagement()
	{
		$this->load->view('commercialgas/userManagement');
	}

	public function DepartmentRepairList()
	{

		$this->load->view('commercialgas/DepartmentRepairList');
	}

	public function tables()
	{
		$this->load->view('commercialgas/tables');
	}


	public function CommerciaUserTaskRecordSummary()
	{
		$this->load->view('commercialgas/CommerciaUserTaskRecordSummary');
	}

	public function CommerciaSalesmanTaskRecordSummary()
	{
		$this->load->view('commercialgas/CommerciaSalesmanTaskRecordSummary');
	}

	public function CommerciaUserDiscountSummary()
	{
		$this->load->view('commercialgas/CommerciaUserDiscountSummary');
	}
	public function CommerciaUserOweCollateralSummary()
	{
		$this->load->view('commercialgas/CommerciaUserOweCollateralSummary');
	}
	public function CommerciaUserUserSaleDifferenceSummary()
	{
		$this->load->view('commercialgas/CommerciaUserUserSaleDifferenceSummary');
	}
	public function CommerciaSalesmanUserSaleSummary()
	{
		$this->load->view('commercialgas/CommerciaSalesmanUserSaleSummary');
	}

	public function CommerciaUserTaskRecord()
	{
		$this->load->view('commercialgas/CommerciaUserTaskRecord');
	}

	public function CommerciaUserNoDealSummary()
	{
		$this->load->view('commercialgas/CommerciaUserNoDealSummary');
	}

	public function CommerciaUserSecurityCheckSummary()
	{
		$this->load->view('commercialgas/CommerciaUserSecurityCheckSummary');
	}


	public function DepartmentReceivables()
	{
		$this->load->view('commercialgas/DepartmentReceivables');
	}

	public function DepartmentGoodsStock()
	{
		$this->load->view('commercialgas/DepartmentGoodsStock');
	}


	public function DepartmentGoodsSale()
	{
		$this->load->view('commercialgas/DepartmentGoodsSale');
	}

	public function CommerciaUserInfoList()
	{
		$this->load->view('commercialgas/CommerciaUserInfoList');
	}


}
