<?php
define('IS_POST', strtolower($_SERVER["REQUEST_METHOD"]) == 'post');//判断是否是post方法
define('IS_GET', strtolower($_SERVER["REQUEST_METHOD"]) == 'get');//判断是否是get方法
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');//判断是否是ajax请求


class MY_Controller extends CI_Controller
{
	function __construct()
	{

		parent::__construct();
	}
}


class HomeBase extends MY_Controller
{
	function __construct()
	{

		parent::__construct();

		if (isset($_GET['companyid'])) {
			$this->input->set_cookie("companyid", $_GET['companyid'], 60 * 60 * 24 * 30);
		}

		if (isset($_GET['seatno'])) {
			$this->input->set_cookie("seatno", $_GET['seatno'], 60 * 60 * 24 * 30);
		}
		if (isset($_GET['admin'])) {
			$this->input->set_cookie("admin", $_GET['admin'], 60 * 60 * 24 * 30);
		}

		if (isset($_GET['store'])) {
			$this->input->set_cookie("department", $_GET['store'], 60 * 60 * 24 * 30);
		}

		$this->load->helper(['url', 'state', 'cookie', 'form']);
		$this->load->library('session');
		$this->curl = new Curl\Curl();

		if (!$this->get_php_file('token.php')) {
			$this->gettoken();
		}
		if ( $this->uri->segment(1) != 'api' && $this->uri->segment(1) != 'guiapi') {
			if (!isset($_SESSION['users']) && $this->uri->segment(1) != 'login') {
				redirect("/login");
			}
		}
	}

	public function gettoken()
	{

		$atime = (int)time();

		$nonce_str = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 32);
		$user = array(
			'username' => 'SRWEB001',
			'nonce_str' => $nonce_str,
			'timestamp' => $atime,
			'password' => strtoupper(md5('a6KBCnOPgVJ0qM1peXQzclifjxrT'))
		);
		ksort($user);
		$str = '';
		foreach ($user as $key => $val) {
			$str .= "$key=$val&";
		}
		$str .= "key=" . $this->config->item('signkey');
		$sign= strtoupper(md5($str));
		$data = array(
			'username' => 'SRWEB001',
			'sign' => $sign,
			'nonce_str' => $nonce_str,
			'timestamp' => $atime
		);
		$rew = $this->https_request($this->config->item('api_url') . '?service=Srproject.Web_Auth.GetToken', $data);
		if ($rew->data->msg == 'SUCCESS') {
			$this->set_php_file('token.php', $rew->data->info->token);
			$this->set_php_file('refresh_token.php', $rew->data->info->refresh_token);

		} else {
			echo '系统繁忙，请联系维护人员';
			die;
		}

	}
	private function get_php_file($filename)
	{
		return trim(substr(file_get_contents($filename),15));
	}


	private function set_php_file($filename,$content)
	{
		$fp=fopen($filename, "w");
		fwrite($fp, "<?php exit();?>".$content);
		fclose($fp);
	}

	 function https_request($url,$data = NULL){

		$timestamp=(int) time();

		$o = "";
		foreach ( $data as $k => $v )
		{
			$o.= "$k=" . urlencode( $v ). "&" ;
		}

		$data = substr($o,0,-1);

		$curlPost = $data;
		//echo  var_dump($curlPost);
		$ch = curl_init();//初始化curl
		curl_setopt($ch, CURLOPT_URL,$url);//抓取指定网页
		curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
		curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
		//curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
		$rs = curl_exec($ch);//运行curl
		curl_close($ch);
		return json_decode($rs);
	}

	public function getPackingtype()
	{
		$rew = $this->curl->post($this->config->item('api_url'), [
			'service' => 'Srproject.GetSystemInfo.Packingtype',
			'companyid' => $this->input->cookie('companyid'),
			'state' => '正常',
			'client' => $this->config->item('client'),
			'opeid' => $_SESSION['users']->opeid,
			'operator' => $_SESSION['users']->name
		]);

		return $rew;
	}

	public function getgionalCode()
	{
		$rew = $this->curl->post($this->config->item('api_url'), [
			'service' => 'Srproject.GetSystemInfo.GegionalCode',
			'companyid' => $this->input->cookie('companyid'),
			'state' => '正常',
			'client' => $this->config->item('client'),
			'opeid' => $_SESSION['users']->opeid,
			'operator' => $_SESSION['users']->name
		]);

		return $rew->data->info[0]->regionalcode;
	}

	/**
	 * 查询地址
	 * @param $userid
	 * @return array
	 */
	public function getAddress($userid,$state = '正常')
	{
		if (!$userid) {
			return [];
		}
		$list = $this->mypost($this->config->item('api_url'), array(
			'service' => 'Srproject.Web_GetInfo.UserAddressInfo',
			'companyid' => $this->input->cookie('companyid'),
			'userid' => $userid,
			'state' => $state,
			'client' => $this->config->item('client'),
			'opeid' => $_SESSION['users']->opeid
		));

		if ($list->data->msg == 'SUCCESS') {
			return object_array($list->data->info);
		}
	}

	public function mypost($url, $array)
	{
		$nonce_str = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 32);
		$data = [
			'nonce_str' => $nonce_str,
			'timestamp' => time(),
			'token' => $this->get_php_file('token.php')
		];
		$newdata = array_merge($array, $data);
		ksort($newdata);
		$str = '';
		foreach ($newdata as $key => $val) {
			$str .= "$key=$val&";
		}
		$str .= "key=" . $this->config->item('signkey');

		$sign = strtoupper(md5($str));

		$newdata['sign'] = $sign;

		$rew = $this->curl->post($url, $newdata);

		if ($rew->ret == '402') {
			echo '非法请求402';
			return false;
		}
		//token 过期
		if ($rew->ret == '403') {
			$this->gettoken();
			$this->mypost($url, $array);
		}

		if ($rew->ret == '404') {
			$this->gettoken();
			$this->mypost($url, $array);
		}
		return $rew;
	}

	public function getUserInfo($cardid)
	{
		//用户详情
		$rew = $this->mypost($this->config->item('api_url'), array(
			'service' => 'Srproject.Web_GetInfo.UserBasicInfo',
			'companyid' => $this->input->cookie('companyid'),
			'memberid' => $cardid,
			'client' => $this->config->item('client'),
			'opeid' => $_SESSION['users']->opeid
		));

		if ($rew->data->msg == 'SUCCESS') {
			$rew->data->info->stateshow = getstate($rew->data->info->state);
			return object_array($rew->data->info);
		} else {
			return ['id' => 0];
		}
	}


	public function getGoodsSalesPromotion($userid)
	{
		$res = $this->mypost($this->config->item('api_url'), array(
			'service' => 'Srproject.Web_GetInfo.UserGoodsSalespromotion',
			'companyid' => $this->input->cookie('companyid'),
			'userid' => $userid,
			'state' => '已授权',
			'client' => $this->config->item('client'),
			'opeid' => $_SESSION['users']->opeid
		));

		if ($res->data->msg == 'SUCCESS') {
			return object_array($res->data->info);
		} else {
			return [];
		}
	}


	public function getGoodswarehouse($userid)
	{
		$res = $this->mypost($this->config->item('api_url'), array(
			'service' => 'Srproject.Web_GetInfo.UserGoodsWarehouse',
			'companyid' => $this->input->cookie('companyid'),
			'userid' => $userid,
			'state' => '正常',
			'client' => $this->config->item('client'),
			'opeid' => $_SESSION['users']->opeid
		));
		if ($res->data->msg == 'SUCCESS') {
			return object_array($res->data->info);
		} else {
			return [];
		}
	}

	public function getUserOrderCondition($userid)
	{
		$res = $this->mypost($this->config->item('api_url'), array(
			'service' => 'Srproject.Web_GetInfo.UserOrderCondition',
			'userid' => $userid
		));

		if ($res->data->msg == 'SUCCESS') {
			return object_array($res->data);
		} else {
			return [];
		}
	}


	public function getUserOrderConditionMemberid($cardid)
	{
		$res = $this->mypost($this->config->item('api_url'), array(
			'service' => 'Srproject.Web_GetInfo.UserOrderConditionMemberid',
			'memberid' => $cardid
		));

		if ($res->data->msg == 'SUCCESS') {
			return object_array($res->data);
		} else {
			return [];
		}
	}

	public function getHeards () {
		return [
			'companyid' => get_cookie('companyid'),
			'departmentid' => get_cookie('departmentid'),
			'department' => get_cookie('department'),
			'client' => $this->config->item('client'),
			'opeid' => $_SESSION['users']->opeid,
			'operator' => $_SESSION['users']->name
		];
	}

	public function findDyhById($id)
	{
		foreach ($_SESSION['initData']->NoSalesGoods->info as $v) {
			if ($v->id == $id) {
				return object_array($v);
			}
		}
		return [];
	}

	public function getPlans()
	{
		$SalesMashup = $this->mypost($this->config->item('api_url'), array(
			'service' => 'Srproject.Web_GetSystemInfo.SalesMashup',
			'companyid' => $this->input->cookie('companyid'),
			'state' => '正常',
			'client' => $this->config->item('client'),
			'opeid' => $_SESSION['users']->opeid,
			'operator' => 000
		));
		$SalesMashupGoods = $this->mypost($this->config->item('api_url'), array(
			'service' => 'Srproject.Web_GetSystemInfo.SalesMashupGoods',
			'companyid' => $this->input->cookie('companyid'),
			'state' => '正常',
			'client' => $this->config->item('client'),
			'opeid' => $_SESSION['users']->opeid,
			'operator' => 000
		));

		$plan = object_array($SalesMashup->data->info);
		$goods = object_array($SalesMashupGoods->data->info);

		foreach ($plan as $k => $v) {
			$price = 0;
			foreach ($goods as $vi) {
				if ($vi['fid'] == $v['id']) {
					$vi['goods'] = $this->findGoodsById($vi['goodsid']);
					$price += $vi['num'] * $vi['price'];

					$plan[$k]['list'][] = $vi;

				}
			}
			$plan[$k]['price'] = $price;
		}

		return $plan;
	}

	public function findGoodsById($id)
	{
		foreach ($_SESSION['initData']->Goods->info as $v) {
			if ($v->id == $id) {
				return object_array($v);
			}
		}
		return [];
	}

	public function getPsyList()
	{
		$rew = $this->Quarters();
		$psy = [];
		foreach ($rew as $v) {
			if ($v['name'] == '配送员') {
				$psy = $v;
				break;
			}
		}
		$arr = [];
		$oper = $this->getOperator();
		foreach ($oper as $v) {
			if ($v['departmentid'] == get_cookie('departmentid') && $v['quartersid'] == $psy['id']) {
				$arr[] = $v;
			}
		}

		return $arr;
	}

	public function Quarters()
	{

		$rew = $this->mypost($this->config->item('api_url'), [
			'service' => 'Srproject.Web_GetSystemInfo.Quarters',
			'state' => '正常',
			'client' => $this->config->item('client'),
			'opeid' => $_SESSION['users']->opeid,
			'companyid' => $_SESSION['users']->companyid,
			'operator' => $_SESSION['users']->name
		]);
		return object_array($rew->data->info);
	}

	public function getOperator()
	{
		$rew = $this->mypost($this->config->item('api_url'), [
			'service' => 'Srproject.Web_GetSystemInfo.Operator',
			'state' => '正常',
			'client' => $this->config->item('client'),
			'opeid' => $_SESSION['users']->opeid,
			'companyid' => $_SESSION['users']->companyid,
			'operator' => $_SESSION['users']->name
		]);

		return object_array($rew->data->info);
	}

	public function getSalesman()
	{
		$rew = $this->Quarters();
		$ywy = [];
		foreach ($rew as $v) {
			if ($v['name'] == '业务员') {
				$ywy = $v;
				break;
			}
		}
		$arr = [];
		$oper = $this->getOperator();

		foreach ($oper as $v) {
			if ($v['quartersid'] == $ywy['id']) {
				$arr[] = $v;
			}
		}

		return $arr;
	}


	public function getpost()
	{
		return object_array(json_decode(file_get_contents('php://input', 'r')));
	}

	public function getAllpost()
	{
		return array_merge($this->getHeards(),object_array(json_decode(file_get_contents('php://input', 'r'))));
	}


	public function getMyDyw($userid)
	{
		$rew = $this->mypost($this->config->item('api_url'), array(
			'service' => 'Srproject.Web_GetInfo.UserCollateralWarehouse',
			'companyid' => $this->input->cookie('companyid'),
			'begintime' => '2010-01-01',
			'endtime' => date('Y-m-d',time()),
			'userid' => $userid,
			'state' => '全部',
			'client' => $this->config->item('client'),
			'opeid' => $_SESSION['users']->opeid
		));
		return object_array($rew->data->info);
	}


	/**
	 * 获取授权人
	 * @return
	 */
	public function getSqr($departmentid)
	{

		$arr = [];
		$fdepartment = '';
		$department = object_array($_SESSION['initData']->Department->info);
		foreach ($department as $v) {

			if ($v['id'] == $departmentid) {

				$fid = $v['fid'];
				foreach ($department as $vi) {
					if ($vi['id'] = $fid) {
						$fdepartment = $vi;
					}
				}
			}
		}

		//查找管理人员
		$rew = $this->Quarters();
		$admin = [];
		foreach ($rew as $v) {
			if ($v['name'] == '管理人员') {
				$admin = $v;
				break;
			}
		}

		$Operator = object_array($_SESSION['initData']->Operator->info);

		foreach ($Operator as $v) {

			if (($v['departmentid'] == $fdepartment['id'] && $v['quartersid'] == $admin['id']) || ($v['departmentid'] == $departmentid && $v['quartersid'] == $admin['id'])) {
				$arr[] = $v;
			}
		}
		return $arr;
	}

	/**
	 * 获取维修员
	 * @return
	 */
	public function getWxy()
	{

		//查找管理人员
		$rew = $this->Quarters();

		$admin = [];
		foreach ($rew as $v) {
			if ($v['name'] == '维修员') {
				$admin = $v;
				break;
			}
		}
		$arr = [];

		$Operator = object_array($_SESSION['initData']->Operator->info);

		foreach ($Operator as $v) {

			if ($v['quartersid'] == $admin['id']) {
				$arr[] = $v;
			}
		}
		return $arr;
	}

	public function getYSGS()
	{
		foreach (object_array($_SESSION['initData']->Department->info) as $v) {
			if ($v['name'] == '运输公司') {
				return $v;
			}
		}
	}


	/**
	 * 获取司机
	 * @return
	 */
	public function getCardriver()
	{
		$ysDepartment = $this->getYSGS();

		//查找管理人员
		$rew = $this->Quarters();
		$admin = [];
		foreach ($rew as $v) {
			if ($v['name'] == '司机') {
				$admin = $v;
				break;
			}
		}
		$arr = [];

		$Operator = object_array($_SESSION['initData']->Operator->info);



		foreach ($Operator as $v) {

			if ($v['departmentid'] == $ysDepartment['id'] && $v['quartersid'] == $admin['id']) {
				$arr[] = $v;
			}
		}
		return $arr;
	}


	public function getMyHandleBuyUserRaffinate($userid)
	{
		$res = $this->mypost($this->config->item('api_url'), array(
			'service' => 'Srproject.Web_GetInfo.UserSaleInfo',
			'companyid' => $this->input->cookie('companyid'),
			'begintime' => '2010-01-01',
			'endtime' => date('Y-m-d H:i:s',time()),
			'userid' => $userid,
			'client' => $this->config->item('client'),
			'opeid' => $_SESSION['users']->opeid
		));
		$arrs = [];
		foreach (object_array($res->data->info) as $v) {
			if ($v['cat'] == '能源类' && $v['goodstype'] == '液化气') {
				$arrs[] = $v;
			}
		}
		return object_array($arrs);
	}

	public function getCharge($userid)
	{
		$userid = $userid;

		$begintime = '2010';
		$endtime = date('Y-m-d',time());
		if ($begintime && $endtime) {
			$rew = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.UserCollateralCharge',
				'companyid' => $this->input->cookie('companyid'),
				'begintime' => $begintime,
				'endtime' => $endtime,
				'userid' => $userid,
				'state' => '正常',
				'client' => $this->config->item('client'),
				'opeid' => $_SESSION['users']->opeid
			));
		}
		if ($rew->data->msg == 'SUCCESS') {
			return object_array($rew->data->info);
		} else {
			return [];
		}

	}


	public function getChargeFK($userid)
	{
		$begintime = '2010';
		$endtime = date('Y-m-d',time());
		if ($begintime && $endtime) {
			$rew = $this->mypost($this->config->item('api_url'), array(
				'service' => 'Srproject.Web_GetInfo.UserCollateralChargeFK',
				'companyid' => $this->input->cookie('companyid'),
				'begintime' => $begintime,
				'endtime' => $endtime,
				'userid' => $userid,
				'state' => '正常',
				'client' => $this->config->item('client'),
				'opeid' => $_SESSION['users']->opeid
			));
		}
		if ($rew->data->msg == 'SUCCESS') {
			return object_array($rew->data->info);
		} else {
			return [];
		}
	}
}



