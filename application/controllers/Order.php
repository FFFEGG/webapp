<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends HomeBase
{


	public function lists()
	{

		$data['addresses'] = [];
		$data['department'] = object_array($_SESSION['initData']->Department);
		$data['goodslist'] = object_array($_SESSION['initData']->Goods);
		$data['goodscat'] = object_array($_SESSION['initData']->GoodsCat);
		$data['goodsbrand'] = object_array($_SESSION['initData']->GoodsBrand);
		$data['goodstype'] = object_array($_SESSION['initData']->GoodsType);
		$data['departmentid'] = $this->input->get('department');

		$data['info'] = array(
			'name' => '',
			'id' => '',
			'memberid' => '',
			'telephone' => '',
			'customertype' => '',
			'attributiondepartment' => '',
			'cardid' => '',
			'quota' => 0,
			'state' => '正常',
			'workplace' => '',
			'addtime' => '',
			'balance' => '',
			'remarks' => '',
			'housingproperty' => '',
			'viplevel' => '',
			'salesman' => '',
			'operator' => '',
			'billingtime' => '',
			'longitude' => '',
			'latitude' => '',
			'department' => ''
		);
		if (!$this->input->get('cardid')) {
			$this->load->view('order/list', $data);
			return false;
		}

		//用户详情
		$rew = $this->mypost($this->config->item('api_url'), array(
			'service' => 'Srproject.Web_GetInfo.UserBasicInfo',
			'companyid' => $this->input->cookie('companyid'),
			'memberid' => $this->input->get('cardid'),
			'client' => $this->config->item('client'),
			'opeid' => $_SESSION['users']->opeid
		));


		if ($rew->data->msg == 'SUCCESS') {
			$data['info'] = object_array($rew->data->info);
			$data['addresses'] = object_array($this->getAddress($data['info']['id']));
			$data['departmentid'] = ($data['departmentid'] ? $data['departmentid'] : $data['addresses'][0]['id']);
		}


		$this->load->view('order/list', $data);
	}

	public function DirectSales()
	{

		$data['addresses'] = [];
		$data['department'] = object_array($_SESSION['initData']->Department);
		$data['goodslist'] = object_array($_SESSION['initData']->Goods);
		$data['goodscat'] = object_array($_SESSION['initData']->GoodsCat);
		$data['goodsbrand'] = object_array($_SESSION['initData']->GoodsBrand);
		$data['goodstype'] = object_array($_SESSION['initData']->GoodsType);
		$data['departmentid'] = $this->input->get('department');

		$data['info'] = array(
			'name' => '',
			'id' => '',
			'memberid' => '',
			'telephone' => '',
			'customertype' => '',
			'attributiondepartment' => '',
			'cardid' => '',
			'quota' => 0,
			'state' => '正常',
			'workplace' => '',
			'addtime' => '',
			'balance' => '',
			'remarks' => '',
			'housingproperty' => '',
			'viplevel' => '',
			'salesman' => '',
			'operator' => '',
			'billingtime' => '',
			'longitude' => '',
			'latitude' => '',
			'department' => ''
		);
		if (!$this->input->get('cardid')) {
			$this->load->view('order/DirectSales', $data);
			return false;
		}

		//用户详情
		$rew = $this->mypost($this->config->item('api_url'), array(
			'service' => 'Srproject.Web_GetInfo.UserBasicInfo',
			'companyid' => $this->input->cookie('companyid'),
			'memberid' => $this->input->get('cardid'),
			'client' => $this->config->item('client'),
			'opeid' => $_SESSION['users']->opeid
		));


		if ($rew->data->msg == 'SUCCESS') {
			$data['info'] = object_array($rew->data->info);
			$data['addresses'] = object_array($this->getAddress($data['info']['id']));
			$data['departmentid'] = ($data['departmentid'] ? $data['departmentid'] : $data['addresses'][0]['id']);
		}


		$this->load->view('order/DirectSales', $data);
	}


	public function getmyinitdata()
	{
		if (IS_POST) {
			exit([
				'code' => 200,
				'data' => json_encode(object_array($_SESSION['initData']))
			]);
		}
	}

	public function schedule()
	{
		$this->load->view('order/schedule');
	}

	public function schedule2()
	{
		$this->load->view('order/schedule2');
	}


	public function monitoring()
	{

		$post = $this->getHeards();
		$post['begintime'] = $this->input->get('begintime') ? $this->input->get('begintime') : '2010-01-01';
		$post['endtime'] = $this->input->get('endtime') ? $this->input->get('begintime') : date('Y-m-d', time());
		$post['endtime'] = $this->input->get('deliverydepartment') ? $this->input->get('deliverydepartment') : '全部';

		$this->load->view('order/monitoring');
	}

	public function edirdeparment()
	{

		if (IS_POST) {
			$post = $this->getHeards();
			$post['id'] = $this->input->post()['id'];
			$post['serial_pay'] = $this->input->post()['serial_pay'];
			$post['newdepartment'] = $this->input->post()['newdepartment'];
			$post['department'] = $this->input->post()['department'];
			$post['service'] = 'Srproject.Web_OperationalData.ChangeOrderDepartment';
			$rew = $this->mypost($this->config->item('api_url'),$post);
			if ($rew->data->msg == 'SUCCESS') {
				echo '修改成功';die;
			} else {
				echo '修改失败';die;
			}
		}
		$this->load->view('order/edirdeparment');
	}

}


