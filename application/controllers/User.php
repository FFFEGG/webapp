<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends HomeBase
{
	public function management()
	{
		$this->load->view('users/management');
	}

	/**
	 *    模糊查询
	 */
	public function likeslink()
	{

		$data['list'] = [];
		$data['key'] = [];
		$data['title'] = [];
		$keyword = $this->input->get('keyword');
		$keytype = $this->input->get('keytype');

		if ($keyword && $keytype) {
			$res = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.VagueQueryUserInfo',
				'companyid' => $this->input->cookie('companyid'),
				'keytype' => $keytype,
				'keyword' => $keyword,
				'client' => $this->config->item('client'),
				'opeid' => $_SESSION['users']->opeid
			));

			if ($res->data->msg == 'SUCCESS') {
				$data['list'] = (array)$res->data->info;
				$data['title'] = (array)$res->data->title;
				$data['key'] = (array)$res->data->key;
			}

		}


		$this->load->view('users/likeslink', $data);


	}

	/**
	 *    模糊查询
	 */
	public function bindsns()
	{

		$data['list'] = [];
		$data['key'] = [];
		$data['title'] = [];
		$keyword = $this->input->get('keyword');
		$keytype = $this->input->get('keytype');

		if ($keyword && $keytype) {
			$res = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.VagueQueryUserInfo',
				'companyid' => $this->input->cookie('companyid'),
				'keytype' => $keytype,
				'keyword' => $keyword,
				'client' => $this->config->item('client'),
				'opeid' => $_SESSION['users']->opeid
			));

			if ($res->data->msg == 'SUCCESS') {
				$data['list'] = (array)$res->data->info;
				$data['title'] = (array)$res->data->title;
				$data['key'] = (array)$res->data->key;
			}

		}


		$this->load->view('users/bindsns', $data);


	}


	/**
	 * 地址列表
	 */
	public function address()
	{
		$data['addresses'] = [];

		if ($this->input->get('cardid')) {
			$data['addresses'] = $this->getAddress($this->getUserInfo($this->input->get('cardid'))['id'],$this->input->get('state'));
		}

		$this->load->view('users/address', $data);
	}

	/**
	 * 地址列表
	 */
	public function updateaddress()
	{

		if (IS_POST) {
			$arr = $this->input->post();
			$arr['service'] = 'Srproject.Web_OperationalData.UserAddressInfo';
			$arr['action'] = 'UPDATE';
			$arr['department'] = get_cookie('department');
			$arr['operator'] = $_SESSION['users']->name;
			$arr['client'] = $this->config->item('client');
			$arr['opeid'] = $_SESSION['users']->opeid;

			$rew = $this->mypost($this->config->item('api_url'), $arr);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 3);
				redirect('/user/updateaddress?info=' . Myencode($arr) . '&memberid=' . $arr['memberid']);
			}
		}


		$data['city'] = getCity();
		$data['area'] = getArea();
		$data['twon'] = getStreet();
		$data['info'] = Mydecode($this->input->get('info'));

		foreach ($data['area'] as $v) {
			if ($data['info']['area'] == $v['name']) {
				$cityCode = $v['cityCode'];
				foreach ($data['area'] as $vi) {
					if ($vi['cityCode'] == $cityCode) {
						$data['select_area'][] = $vi;
					}
				}
				break;
			}
		}


		foreach ($data['twon'] as $v) {
			if ($data['info']['town'] == $v['name']) {

				$areaCode = $v['areaCode'];
				foreach ($data['twon'] as $vi) {
					if ($vi['areaCode'] == $areaCode) {
						$data['select_twon'][] = $vi;
					}
				}
				break;
			}
		}


		$this->load->view('users/updateaddress', $data);
	}


	/**
	 * 新增地址
	 */
	public function addaddress()
	{

		if (IS_POST) {
			$arr = $this->input->post();
			$arr['service'] = 'Srproject.Web_OperationalData.UserAddressInfo';
			$arr['action'] = 'ADD';
			$arr['state'] = '正常';
			$arr['id'] = 0;
			$arr['department'] = get_cookie('department');
			$arr['operator'] = $_SESSION['users']->name;
			$arr['client'] = $this->config->item('client');
			$arr['companyid'] = get_cookie('companyid');
			$arr['opeid'] = $_SESSION['users']->opeid;
			$rew = $this->mypost($this->config->item('api_url'), $arr);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 3);
				redirect('/user/addaddress?info=' . Myencode($arr) . '&cardid=' . $arr['memberid']);
			}
		}


		$data['city'] = getCity();
		$data['area'] = getArea();
		$data['twon'] = getStreet();
		$data['userinfo'] = $this->getUserInfo($this->input->get('cardid'));

		$this->load->view('users/addaddress', $data);
	}

	public function getarea()
	{

		$city = getCity();
		$data['area'] = getArea();
		$data['twon'] = getStreet();


		foreach ($city as $v) {
			if ($this->input->get('city') == $v['name']) {
				$cityCode = $v['code'];
				foreach ($data['area'] as $vi) {
					if ($vi['cityCode'] == $cityCode) {
						$data['select_area'][] = $vi;
					}
				}
				break;
			}
		}

		foreach ($data['twon'] as $v) {
			if ($v['areaCode'] == $data['select_area'][0]['code']) {
				$data['select_twon'][] = $v;
			}
		}


		exit(json_encode([
			'code' => 200,
			'select_area' => $data['select_area'],
			'select_twon' => $data['select_twon']
		]));
	}


	public function getTwon()
	{


		$data['area'] = getArea();
		$data['twon'] = getStreet();


		foreach ($data['area'] as $v) {
			if ($this->input->get('city') == $v['name']) {
				$cityCode = $v['code'];
				foreach ($data['twon'] as $vi) {
					if ($vi['areaCode'] == $cityCode) {
						$data['select_twon'][] = $vi;
					}
				}
				break;
			}
		}


		exit(json_encode([
			'code' => 200,
			'select_twon' => $data['select_twon']
		]));
	}


	public function updateuser()
	{
		$data['info'] =  Mydecode($this->input->get('info'));
		if (IS_POST) {
			 
			$arr = $this->input->post();
			$arr['service'] = 'Srproject.Web_OperationalData.UserBasicInfo';
			$arr['action'] = 'UPDATE';
			$arr['companyid'] = get_cookie('companyid');
			$arr['state'] = '正常';
			$arr['department'] = get_cookie('department');
			$arr['operator'] = $_SESSION['users']->name;
			$arr['client'] = $this->config->item('client');
			$arr['opeid'] = $_SESSION['users']->opeid;
			$rew = $this->mypost($this->config->item('api_url'),$arr);
		 
			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 3);
				redirect('/user/updateuser');
			}
		}
		$this->load->view('users/updateuser', $data);
	}


	public function open_account()
	{
		$data['salesman'] = $this->getSalesman();

		$data['city'] = getCity();
		$data['area'] = getArea();
		$data['twon'] = getStreet();

		if (IS_POST) {
			$arr = $this->input->post();
			$arr['service'] = 'Srproject.Web_OperationalData.UserBasicInfo';
			$arr['action'] = 'ADD';
			$arr['companyid'] = get_cookie('companyid');
			$arr['state'] = '正常';
			$arr['department'] = get_cookie('department');
			$arr['operator'] = $_SESSION['users']->name;
			$arr['client'] = $this->config->item('client');
			$arr['opeid'] = $_SESSION['users']->opeid;
			$rew = $this->mypost($this->config->item('api_url'),$arr);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 3);
				redirect('/user/open_account');
			}
		}

		$this->load->view('users/open_account', $data);
	}


	public function recharge()
	{
		$cardid = $this->input->get('cardid');
		$data['info'] = array(
			'name' => '',
			'id' => '',
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
			'department' => '',
		);
		$data['addresses'] = [];
		if (!isset($cardid)) {
			$this->load->view('users/recharge',$data);
			return false;
		}
		$res = $this->mypost($this->config->item('api_url'),array(
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
			$list = $this->mypost($this->config->item('api_url'),array(
				'service' => 'Srproject.Web_GetInfo.UserAddressInfo',
				'companyid' => $this->input->cookie('companyid'),
				'userid' => $data['info']['id'],
				'state' => '正常',
				'client' => $this->config->item('client'),
				'opeid' => $_SESSION['users']->opeid
			));
			if ($list->data->msg == 'SUCCESS') {
				$data['addresses'] = (array)$list->data->info;
			}
		}


		if (IS_POST) {
			echo '<pre>';
			print_r($this->getpost());
			die;
		}


		$this->load->vars($data);
		$this->load->view('users/recharge');
	}


	public function CallFlow()
	{
		$user = $this->getUserInfo($this->input->get('cardid'));
		$data['user'] = $user;
		$this->load->view('users/CallFlow',$data);
	}


	public function UserFreight()
	{

		$this->load->view('users/UserFreight');
	}

	public function AdvancePayFee()
	{

		$this->load->view('users/AdvancePayFee');
	}


	public function CallRecord()
	{
		$heard = $this->getHeards();

		$post['service'] = 'Srproject.Web_GetInfo.UserCallRecord';
		$post['begintime'] = $this->input->get('begintime') ? $this->input->get('begintime') : '2010-01-01';
		$post['endtime'] = $this->input->get('endtime') ? $this->input->get('endtime') : date('Y-m-d',time());
		$post['userid'] = 0;
		$post['telephone'] = $this->input->get('telephone') ? $this->input->get('telephone') : '';
		$post['type'] = $this->input->get('type') ? $this->input->get('type') : '';
		$post['reason'] = $this->input->get('reason') ? $this->input->get('reason') : '';
		$arr = array_merge($heard,$post);
		$rew = $this->mypost($this->config->item('api_url'),$arr);

		if ($rew->data->msg == 'SUCCESS') {
			$data['list'] = (array) $rew->data->info;
			$data['title'] = (array) $rew->data->title;
			$data['key'] = (array) $rew->data->key;
		}
		$this->load->view('users/CallRecord',$data);
	}


	public function getFileUrlList($post)
	{
		$post['service'] = 'Srproject.Web_GetInfo.FileUrlList';


		$rew = $this->mypost($this->config->item('api_url'),$post);
		if ($rew->data->msg == 'SUCCESS') {
			return object_array($rew->data->info);
		} else {
			return [];
		}
	}

	public function CompleteUserSecurityCheck()
	{

		$data['info'] = object_array(Mydecode($this->input->get('data')));

		//
		$file['userid'] = $data['info']['userid'];
		$file['serial'] = $data['info']['serial'];
		$file['department'] = get_cookie('department');
		$file['opeid'] = $_SESSION['users']->opeid;
		$filelist = $this->getFileUrlList($file);

		$data['filelist'] = $filelist;

		foreach ($data['info']['projectlist'] as $v) {
			$arr[$v['type']][] = $v;
		}
		$data['list'] = $arr;

		if (IS_POST) {
			$heard = $this->getHeards();
			$post = $this->input->post();
			$post['service'] = 'Srproject.Web_OperationalData.CompleteUserSecurityCheck';
			$arr = array_merge($post,$heard);
			$rew = $this->mypost($this->config->item('api_url'),$arr);
			if ($rew->data->msg == 'SUCCESS') {

				set_cookie('success', '1', 3);
				redirect('user/CompleteUserSecurityCheck?data=' . $this->input->post('data'));
			} else {
				set_cookie('error', '1', 3);
				redirect('user/CompleteUserSecurityCheck?data=' . $this->input->post('data'));
			}
		}
		$this->load->view('users/CompleteUserSecurityCheck',$data);
	}


	public function AddPackingtypeCheakRecord()
	{

		$data['info'] = object_array(Mydecode($this->input->get('data')));
		foreach ($data['info']['projectlist'] as $v) {
			$arr[$v['type']][] = $v;
		}
		$data['list'] = $arr;

		if (IS_POST) {
			$heard = $this->getHeards();
			$post = $this->input->post();
			$post['service'] = 'Srproject.Web_OperationalData.AddPackingtypeCheakRecord';
			$arr = array_merge($heard,$post);
			$rew = $this->mypost($this->config->item('api_url'),$arr);

			if ($rew->data->msg == 'SUCCESS') {

				set_cookie('success', '1', 3);
				redirect('user/AddPackingtypeCheakRecord?data=' . $this->input->post('data'));
			} else {
				set_cookie('error', '1', 3);
				redirect('user/AddPackingtypeCheakRecord?data=' . $this->input->post('data'));
			}
		}
		$this->load->view('users/AddPackingtypeCheakRecord',$data);
	}


	public function UserInvoiceRecord()
	{

		$this->load->view('users/UserInvoiceRecord');
	}

	public function info2()
	{

		$this->load->view('users/info2');
	}

	public function editpassword()
	{
		if (IS_POST) {
			$heard = $this->getHeards();
			$post = $this->input->post();
			$post['oldpassword'] = md5($_SESSION['users']->opeid.'_SR_'.$this->input->post('oldpassword'));
			$post['newpassword'] = md5($_SESSION['users']->opeid.'_SR_'.$this->input->post('newpassword'));
			$post['service'] = 'Srproject.Web_OperationalData.OperatorPassWord';
			$arr = array_merge($post,$heard);

			$rew = $this->mypost($this->config->item('api_url'),$arr);

			if ($rew->data->msg == 'SUCCESS') {

				set_cookie('success', '1', 3);
				redirect('user/editpassword');
			} else {
				set_cookie('error', '1', 3);
				redirect('user/editpassword');
			}
		}
		$this->load->view('users/editpassword');
	}

	public function usermanagement()
	{
		$cardid = $this->input->get('cardid');

		$data['info'] = array(
			'name' => '',
			'id' => '',
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
			'department' => '',
		);
		$data['addresses'] = [];
		if (!isset($cardid)) {
			$this->load->view('users/usermanagment',$data);
			return false;
		}
		$res = $this->mypost($this->config->item('api_url'),array(
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

			$list = $this->mypost($this->config->item('api_url'),array(
				'service' => 'Srproject.Web_GetInfo.UserAddressInfo',
				'companyid' => $this->input->cookie('companyid'),
				'userid' => $data['info']['id'],
				'state' => '正常',
				'client' => $this->config->item('client'),
				'opeid' => $_SESSION['users']->opeid
			));
			if ($list->data->msg == 'SUCCESS') {
				$data['addresses'] = (array)$list->data->info;
			}
		}

		$this->load->view('users/usermanagment',$data);
	}
}
