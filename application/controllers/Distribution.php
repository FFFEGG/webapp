<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Distribution extends HomeBase
{
	public function AddMaterielFlowNoScanGP()
	{
		$data['drivers'] = $this->getCardriver();

		if (IS_POST) {
			$post = $this->input->post();

			foreach ($post['goodsid'] as $k => $v) {
				$json['mode'] = $post['mode'];
				$json['packingtype'] = $v;
				$json['num'] = $post['num'][$k];
				$arr[] = $json;
			}

			$heards = $this->getHeards();
			$heards['service'] = 'Srproject.Web_OperationalData.AddMaterielFlowNoScanGP';
			$heards['id'] = $post['id'];
			$heards['car_no'] = $post['car_no'];
			$heards['brokerage'] = $post['brokerage'];
			$heards['receiver'] = $post['receiver'];
			$heards['goodsjson'] = json_encode($arr);
			$heards['type'] =  !empty($post['type']) ? '重' : '空';

			$rew = $this->mypost($this->config->item('api_url'), $heards);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('AddMaterielFlowNoScanGP', '1', 2);
				redirect('ywpage/AddMaterielFlowNoScanGP');
			} else {
				set_cookie('errorAddMaterielFlowNoScanGP', '1', 2);
				redirect('ywpage/AddMaterielFlowNoScanGP');
			}
		}

		$this->load->view('ywpage/AddMaterielFlowNoScanGP',$data);
	}


	
	public function DepartmentPaymentRecord()
	{
		$this->load->view('ywpage/DepartmentPaymentRecord');
	}


	public function ReprintCodeRecord()
	{
		$this->load->view('ywpage/ReprintCodeRecord');
	}

	public function DepartmentQualitySpotCheck()
	{
		$this->load->view('ywpage/DepartmentQualitySpotCheck');
	}

	public function ReprintCodeEntry()
	{
		$this->load->view('ywpage/ReprintCodeEntry');
	}


	public function DepartmentQualitySpotCheckRecord()
	{
		$this->load->view('ywpage/DepartmentQualitySpotCheckRecord');
	}


	public function AddDepartmentPayment()
	{
		$this->load->view('ywpage/AddDepartmentPayment');
	}
	public function DepartmentApplyeDeliverymanSubsidyRecord()
	{
		$this->load->view('ywpage/DepartmentApplyeDeliverymanSubsidyRecord');
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
		$num = $this->input->get('num')?$this->input->get('num'):10;
		$code= $this->input->get('code')?$this->input->get('code'):'';
		$begintime = $this->input->get('begintime');
		$endtime = $this->input->get('endtime');
		$state = $this->input->get('state')?$this->input->get('state'):'全部';
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
				$data['list'] = (array) $res->data->info;
				$data['title'] = (array) $res->data->title;
				$data['key'] = (array) $res->data->key;
			}
		}

		$this->load->view('ywpage/PackingtypeCirculationInfo',$data);
	}

	public function userManagement()
	{
		$this->load->view('ywpage/userManagement');
	}

	public function DepartmentRepairList()
	{

		$this->load->view('ywpage/DepartmentRepairList');
	}

	public function tables()
	{
		$this->load->view('ywpage/tables');
	}


	public function DepartmentReceivables()
	{
		$this->load->view('ywpage/DepartmentReceivables');
	}
	public function DepartmentGoodsStock()
	{
		$this->load->view('ywpage/DepartmentGoodsStock');
	}


	public function DepartmentGoodsSale()
	{
		$this->load->view('ywpage/DepartmentGoodsSale');
	}
}
