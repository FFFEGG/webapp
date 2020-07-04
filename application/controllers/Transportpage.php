<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transportpage extends HomeBase
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

		$this->load->view('transportpage/PackingtypeCirculationInfo', $data);
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
		$this->load->view('transportpage/OpeStock', $data);
	}

	public function userManagement()
	{
		$this->load->view('transportpage/userManagement');
	}
	public function TransportationDriverCommissionAllocation()
	{
		$this->load->view('transportpage/TransportationDriverCommissionAllocation');
	}


	public function TransportationDriverCommissionDirect()
	{
		$this->load->view('transportpage/TransportationDriverCommissionDirect');
	}

	public function TransportationDriverCommissionConsignment()
	{
		$this->load->view('transportpage/TransportationDriverCommissionConsignment');
	}

	public function AllocationPlanMonitor()
	{
		$this->load->view('transportpage/AllocationPlanMonitor');
	}
	public function schedule()
	{
		$this->load->view('transportpage/schedule');
	}

	public function TransportationMaterial()
	{
		$this->load->view('transportpage/TransportationMaterial');
	}

	public function ReprintCodeRecord()
	{
		$this->load->view('transportpage/ReprintCodeRecord');
	}

	public function InspectionStationMaterial()
	{
		$this->load->view('transportpage/InspectionStationMaterial');
	}

	public function TransportationStock()
	{
		$this->load->view('transportpage/TransportationStock');
	}

	public function InspectionStationStock()
	{
		$this->load->view('transportpage/InspectionStationStock');
	}

	public function DepartmentRepairList()
	{

		$this->load->view('transportpage/DepartmentRepairList');
	}

	public function tables()
	{
		$this->load->view('transportpage/tables');
	}


	public function DepartmentReceivables()
	{
		$this->load->view('transportpage/DepartmentReceivables');
	}

	public function DepartmentGoodsStock()
	{
		$this->load->view('transportpage/DepartmentGoodsStock');
	}


	public function DepartmentGoodsSale()
	{
		$this->load->view('transportpage/DepartmentGoodsSale');
	}

	public function wzgl()
	{
		$this->load->view('transportpage/wzgl');
	}
}
