<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guiapi extends HomeBase
{
	private $post;

	public function addadd()
	{
		$post = $this->getpost();

		$post['service'] = 'Srproject.Web_OperationalData.UserAddressInfo';
		$post['action'] = 'ADD';
		$post['client'] = $this->config->item('client');

		$rew = $this->mypost($this->config->item('api_url'), $post);

		exit(json_encode([
			'code' => 200,
			'data' => object_array($rew)
		]));
	}

	public function getpost()
	{
		return  object_array(json_decode(file_get_contents('php://input', 'r')));
	}


	public function addremark()
	{
		$post = $this->getpost();


		$post['service'] = 'Srproject.Web_OperationalData.AddUserRemarks';
		$post['client'] = $this->config->item('client');

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


	public function getreceivables()
	{

		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_GetInfo.UserReceivablesInfo';
		$post['client'] = $this->config->item('client');
		$res = $this->mypost($this->config->item('api_url'), $post);
		if ($res->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'list' => $res->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 200,
				'list' => []
			]));
		}
	}

	public function getsale()
	{

		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_GetInfo.UserSaleInfo';
		$post['client'] = $this->config->item('client');
		$res = $this->mypost($this->config->item('api_url'), $post);
		if ($res->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'list' => $res->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 200,
				'list' => []
			]));
		}
	}
	public function getorder()
	{

		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_GetInfo.UserOrderInfo';
		$post['client'] = $this->config->item('client');
		$res = $this->mypost($this->config->item('api_url'), $post);

		if ($res->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'list' => $res->data
			]));
		} else {
			exit(json_encode([
				'code' => 200,
				'list' => []
			]));
		}
	}


	public function getcharge()
	{

		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_GetInfo.UserCollateralCharge';
		$post['client'] = $this->config->item('client');
		$res = $this->mypost($this->config->item('api_url'), $post);

		if ($res->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'list' => $res->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 200,
				'list' => []
			]));
		}
	}


	public function getchargeSalespromotion()
	{

		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_GetInfo.UserCollateralChargeSalespromotion';
		$post['client'] = $this->config->item('client');
		$res = $this->mypost($this->config->item('api_url'), $post);

		if ($res->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'list' => $res->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 200,
				'list' => []
			]));
		}
	}

	public function getsalespromotion()
	{

		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_GetInfo.UserCollateralSalespromotion';
		$post['client'] = $this->config->item('client');
		$res = $this->mypost($this->config->item('api_url'), $post);

		if ($res->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'list' => $res->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 200,
				'list' => []
			]));
		}
	}

	public function getwarehouse()
	{

		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_GetInfo.UserCollateralWarehouse';
		$post['client'] = $this->config->item('client');
		$res = $this->mypost($this->config->item('api_url'), $post);

		if ($res->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'list' => $res->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 200,
				'list' => []
			]));
		}
	}

	public function getgoodsSalespromotion()
	{

		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_GetInfo.UserGoodsSalespromotion';
		$post['client'] = $this->config->item('client');
		$res = $this->mypost($this->config->item('api_url'), $post);

		if ($res->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'list' => $res->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 200,
				'list' => []
			]));
		}
	}

	public function getgoodswarehouse()
	{

		$post = $this->getpost();
		$post['service'] = 'Srproject.Web_GetInfo.UserGoodsWarehouse';
		$post['client'] = $this->config->item('client');
		$res = $this->mypost($this->config->item('api_url'), $post);

		if ($res->data->msg == 'SUCCESS') {
			exit(json_encode([
				'code' => 200,
				'list' => $res->data->info
			]));
		} else {
			exit(json_encode([
				'code' => 200,
				'list' => []
			]));
		}
	}
}
