<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends HomeBase
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 *        http://example.com/index.php/welcome
	 *    - or -
	 *        http://example.com/index.php/welcome/index
	 *    - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$list = $this->mypost($this->config->item('api_url'), [
			'service' => 'Srproject.Web_GetSystemInfo.BulletinBoard',
			'state' => '正常',
			'opeid' => $_SESSION['users']->opeid,
			'operator' => $_SESSION['users']->name,
		]);

		$data['gg'] = object_array($list->data->info[0]);
		$data['page'] = 0;
		$data['count'] = count(object_array($list->data->info));

		if ($_SESSION['users']->logindepartmenttype == '业务门店') {

			$this->load->view('ywpage/index', $data);

		} elseif ($_SESSION['users']->logindepartmenttype == '配送部') {
		 
			$this->load->view('distribution/index', $data);

		}  elseif ($_SESSION['users']->logindepartmenttype == '发卡室') {

			$this->load->view('ywpage/index', $data);

		} elseif ($_SESSION['users']->logindepartmenttype == '业务公司') {

			$this->load->view('transportpage/index', $data);

		} elseif ($_SESSION['users']->logindepartmenttype == '预约中心') {

			$this->load->view('reservationcenter/index', $data);

		} elseif ($_SESSION['users']->logindepartmenttype == '商用业务') {

			$this->load->view('commercialgas/index', $data);

		} elseif ($_SESSION['users']->logindepartmenttype == '商用业务管理') {

			$this->load->view('commercial/index', $data);

		}elseif ($_SESSION['users']->logindepartmenttype == '信息中心') {

			$this->load->view('welcome_message', $data);

		}elseif ($_SESSION['users']->logindepartmenttype == '运营监督') {

			$this->load->view('operation/index', $data);

		} elseif ($_SESSION['users']->logindepartmenttype == '客服中心') {

			$this->load->view('customer/index', $data);

		}elseif ($_SESSION['users']->logindepartmenttype == '拓展部') {

			$this->load->view('development/index', $data);

		} else {

			$this->load->view('ywpage/index', $data);

		}
	}

	public function userinfo()
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
			$this->load->view('users/info', $data);
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
			$data['info'] = (array)$res->data->info;
			$data['info']['cardid'] = $cardid;
			$data['info']['state'] = $this->getstate($data['info']['state']);
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
				$data['addresses'] = (array)$list->data->info;
			}
		}
		$this->load->vars($data);
		$this->load->view('users/info');
	}


	public function getstate($val)
	{
		switch ($val) {
			case 1:
				$state = '正常';
				break;
			case 2:
				$state = '取消';
				break;
			case 3:
				$state = '数据异常';
				break;
			case 4:
				$state = '撤销';
				break;
			case 5:
				$state = '已授权';
				break;
			case 6:
				$state = '待收取';
				break;
			case 7:
				$state = '已收取';
				break;
			case 8:
				$state = '已使用';
				break;
			case 9:
				$state = '已退物资';
				break;
			case 10:
				$state = '已退款';
				break;
			case 11:
				$state = '已还款';
				break;
			case 12:
				$state = '已收回';
				break;
			case 13:
				$state = '未支付';
				break;
			case 14:
				$state = '待确认收货';
				break;
			case 15:
				$state = '待确认发货';
				break;
			case 16:
				$state = '已确认发货';
				break;
			case 101:
				$state = '已安排';
				break;
			case 102:
				$state = '已接单';
				break;
			case 103:
				$state = '已送达';
				break;
			case 104:
				$state = '已汇总';
				break;
			default:
				$state = '正常';
		}
		return $state;
	}
}
