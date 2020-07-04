<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Commercial extends HomeBase
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

		$this->load->view('commercial/PackingtypeCirculationInfo', $data);
	}

	public function userManagement()
	{
		$this->load->view('commercial/userManagement');
	}

	public function DepartmentRepairList()
	{

		$this->load->view('commercial/DepartmentRepairList');
	}

	public function tables()
	{
		$this->load->view('commercial/tables');
	}


	public function DepartmentReceivables()
	{
		$this->load->view('commercial/DepartmentReceivables');
	}

	public function DepartmentGoodsStock()
	{
		$this->load->view('commercial/DepartmentGoodsStock');
	}


	public function DepartmentGoodsSale()
	{
		$this->load->view('commercial/DepartmentGoodsSale');
	}


}
