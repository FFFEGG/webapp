<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Appointment extends HomeBase
{
	public function repair()
	{

		$cardid = $this->input->get('cardid');
		$data['info'] = array(
			'name'                  => '',
			'id'                    => '',
			'telephone'             => '',
			'customertype'          => '',
			'attributiondepartment' => '',
			'cardid'                => '',
			'quota'                 => 0,
			'state'                 => '正常',
			'workplace'             => '',
			'addtime'               => '',
			'balance'               => '',
			'remarks'               => '',
			'housingproperty'       => '',
			'viplevel'              => '',
			'salesman'              => '',
			'operator'              => '',
			'billingtime'           => '',
			'department'            => '',
		);
		$data['addresses'] = [];
		if (!isset($cardid)) {
			$this->load->view('appointment/repair', $data);
			return false;
		}
		$res = $this->mypost($this->config->item('api_url'), array(
			'service' => 'Srproject.Web_GetInfo.UserBasicInfo',
			'companyid' => $this->input->cookie('companyid'),
			'memberid' => $cardid,
			'client' => $this->config->item('client'),
			'opeid' => $_SESSION['users']->opeid
		));

		if ($res->data->msg == 'SUCCESS') {
			$data['info'] = (array) $res->data->info;
			$data['info']['cardid'] = $cardid;
			$data['info']['state'] = getstate($data['info']['state']);
			//查询地址
			$list = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.UserAddressInfo',
				'companyid' => $this->input->cookie('companyid'),
				'userid' => $data['info']['id'],
				'state' => '正常',
				'client' => $this->config->item('client'),
				'opeid' => $_SESSION['users']->opeid
			));
			if ($list->data->msg == 'SUCCESS') {
				$data['addresses'] = (array) $list->data->info;
			}
		}

		$this->load->vars($data);
		$this->load->view('appointment/repair');
	}


	public function test()
	{
		$this->load->view('appointment/test');
	}
	public function GiveUserWarehouseGoods()
	{
		$this->load->view('appointment/GiveUserWarehouseGoods');
	}
}
