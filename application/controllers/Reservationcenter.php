<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reservationcenter extends HomeBase
{

	public function order()
	{
		$this->load->view('reservationcenter/order');
	}

	public function SimultaneousSegmentOrder()
	{
		$this->load->view('reservationcenter/SimultaneousSegmentOrder');
	}


	public function DepartmentPaymentRecord()
	{
		$this->load->view('reservationcenter/DepartmentPaymentRecord');
	}

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

		$this->load->view('reservationcenter/PackingtypeCirculationInfo', $data);
	}

	public function PackingtypeUserRecord()
	{

		$code = $this->input->get('code') ? $this->input->get('code') : '';
		$data['list'] = [];
		$data['key'] = [];
		$data['title'] = [];

		if ($code && $this->input->get('memberid')) {
			$res = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.PackingtypeUserRecord',
				'code' => trim($code),
				'memberid' => trim($this->input->get('memberid')),
				'department' => get_cookie('department'),
				'opeid' => $_SESSION['users']->opeid,
			));

			if ($res->data->msg == 'SUCCESS') {
				$data['userrecordinfo'] = (array)$res->data->userrecordinfo;
				$data['packingtypeorderinfo'] = (array)$res->data->packingtypeorderinfo;
				$data['usercollateralwarehouse'] = (array)$res->data->usercollateralwarehouse;
				$data['userpackingtyperecord'] = (array)$res->data->userpackingtyperecord;
			}
		}
		$this->load->view('reservationcenter/PackingtypeUserRecord', $data);
	}

	public function userManagement()
	{
		$this->load->view('reservationcenter/userManagement');
	}

	public function DepartmentRepairList()
	{

		$this->load->view('reservationcenter/DepartmentRepairList');
	}

	public function tables()
	{
		$this->load->view('reservationcenter/tables');
	}


	public function seeimg()
	{
		$this->load->view('reservationcenter/seeimg');
	}


	public function DepartmentReceivables()
	{
		$this->load->view('reservationcenter/DepartmentReceivables');
	}

	public function DepartmentGoodsStock()
	{
		$this->load->view('reservationcenter/DepartmentGoodsStock');
	}


	public function DepartmentGoodsSale()
	{
		$this->load->view('reservationcenter/DepartmentGoodsSale');
	}


}
