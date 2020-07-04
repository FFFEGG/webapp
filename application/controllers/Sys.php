<?php

class Sys extends HomeBase
{

	public function index()
	{
		$this->load->view('sys/index');
	}




	public function carinfo()
	{

		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.CarInfo';
		$rew = $this->mypost($this->config->item('api_url'),$body);
		$data['info'] = object_array($rew);
		$this->load->view('sys/carInfo/index',$data);
	}




	public function carinfo_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => '',
				'operator' => '',
				'billingmode' => '',
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingCarInfo';

			$rew = $this->mypost($this->config->item('api_url'),$post);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/carinfo_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/carinfo_form',$data);
			}
		}

		$this->load->view('sys/carInfo/form',$data);
	}




	public function CarCost()
	{

		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.CarCost';
		$rew = $this->mypost($this->config->item('api_url'),$body);
		$data['info'] = object_array($rew);
		$this->load->view('sys/CarCost/index',$data);
	}




	public function CarCost_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => '',
				'operator' => '',
				'billingmode' => '',
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingCarCost';

			$rew = $this->mypost($this->config->item('api_url'),$post);
			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/CarCost_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/CarCost_form',$data);
			}
		}

		$this->load->view('sys/CarCost/form',$data);
	}



	public function ExpandFreight()
	{

		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.ExpandFreight';
		$rew = $this->mypost($this->config->item('api_url'),$body);
		$data['info'] = object_array($rew);
		$this->load->view('sys/ExpandFreight/index',$data);
	}




	public function ExpandFreight_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => '',
				'operator' => '',
				'billingmode' => '',
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingExpandFreight';

			$rew = $this->mypost($this->config->item('api_url'),$post);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/ExpandFreight_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/ExpandFreight_form',$data);
			}
		}

		$this->load->view('sys/ExpandFreight/form',$data);
	}



	public function CompanyCarFreight()
	{

		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.CompanyCarFreight';
		$rew = $this->mypost($this->config->item('api_url'),$body);
		$data['info'] = object_array($rew);
		$this->load->view('sys/CompanyCarFreight/index',$data);
	}




	public function CompanyCarFreight_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => '',
				'operator' => '',
				'billingmode' => '',
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingCompanyCarFreight';

			$rew = $this->mypost($this->config->item('api_url'),$post);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/CompanyCarFreight_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/CompanyCarFreight_form',$data);
			}
		}

		$this->load->view('sys/CompanyCarFreight/form',$data);
	}


	public function CompanyCarBasicFreight()
	{

		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.CompanyCarBasicFreight';
		$rew = $this->mypost($this->config->item('api_url'),$body);
		$data['info'] = object_array($rew);
		$this->load->view('sys/CompanyCarBasicFreight/index',$data);
	}




	public function CompanyCarBasicFreight_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => '',
				'operator' => '',
				'billingmode' => '',
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingCompanyCarBasicFreight';

			$rew = $this->mypost($this->config->item('api_url'),$post);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/CompanyCarBasicFreight_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/CompanyCarBasicFreight_form',$data);
			}
		}

		$this->load->view('sys/CompanyCarBasicFreight/form',$data);
	}


	public function CouponTypeParameter()
	{

		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.CouponTypeParameter';
		$rew = $this->mypost($this->config->item('api_url'),$body);
		$data['info'] = object_array($rew);
		$this->load->view('sys/CouponTypeParameter/index',$data);
	}




	public function CouponTypeParameter_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => '',
				'operator' => '',
				'billingmode' => '',
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingCouponTypeParameter';

			$rew = $this->mypost($this->config->item('api_url'),$post);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/CouponTypeParameter_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/CouponTypeParameter_form',$data);
			}
		}

		$this->load->view('sys/CouponTypeParameter/form',$data);
	}

	public function BuyPackingtypeParameter()
	{

		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.BuyPackingtypeParameter';
		$rew = $this->mypost($this->config->item('api_url'),$body);
		$data['info'] = object_array($rew);
		$this->load->view('sys/BuyPackingtypeParameter/index',$data);
  	}




	public function BuyPackingtypeParameter_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => '',
				'operator' => '',
				'billingmode' => '',
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingBuyPackingtypeParameter';
	
			$rew = $this->mypost($this->config->item('api_url'),$post);
		
			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/BuyPackingtypeParameter_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/BuyPackingtypeParameter_form',$data);
			}
		}

		$this->load->view('sys/BuyPackingtypeParameter/form',$data);
  	}


	public function ChargeStandard()
	{
		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.ChargeStandard';
		$rew = $this->mypost($this->config->item('api_url'),$body);
		$data['info'] = object_array($rew);
		$this->load->view('sys/ChargeStandard/index',$data);
	}



	public function ChargeStandard_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => ''
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingChargeStandard';

			$rew = $this->mypost($this->config->item('api_url'),$post);
			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/ChargeStandard_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/ChargeStandard_form',$data);
			}
		}

		$this->load->view('sys/ChargeStandard/form',$data);
	}

	public function Department()
	{
		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.Department';
		$rew = $this->mypost($this->config->item('api_url'),$body);
		$data['info'] = object_array($rew);
		$this->load->view('sys/Department/index',$data);
	}



	public function Department_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => ''
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingDepartment';

			$rew = $this->mypost($this->config->item('api_url'),$post);
			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/Department_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/Department_form',$data);
			}
		}

		$this->load->view('sys/Department/form',$data);
	}

	public function Goods()
	{
		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.Goods';
		$rew = $this->mypost($this->config->item('api_url'),$body);
		$data['info'] = object_array($rew);
		$this->load->view('sys/Goods/index',$data);
	}



	public function Goods_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => ''
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingGoods';

			$rew = $this->mypost($this->config->item('api_url'),$post);
			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/Goods_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/Goods_form',$data);
			}
		}

		$this->load->view('sys/Goods/form',$data);
	}


	public function GoodsBrand()
	{
		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.GoodsBrand';
		$rew = $this->mypost($this->config->item('api_url'),$body);
		$data['info'] = object_array($rew);
		$this->load->view('sys/GoodsBrand/index',$data);
	}



	public function GoodsBrand_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => ''
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingGoodsBrand';

			$rew = $this->mypost($this->config->item('api_url'),$post);
			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/GoodsBrand_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/GoodsBrand_form',$data);
			}
		}

		$this->load->view('sys/GoodsBrand/form',$data);
	}

	public function GoodsCat()
	{
		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.GoodsCat';
		$rew = $this->mypost($this->config->item('api_url'),$body);
		$data['info'] = object_array($rew);
		$this->load->view('sys/GoodsCat/index',$data);
	}



	public function GoodsCat_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => ''
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingGoodsCat';

			$rew = $this->mypost($this->config->item('api_url'),$post);
			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/GoodsCat_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/GoodsCat_form',$data);
			}
		}

		$this->load->view('sys/GoodsCat/form',$data);
	}

	public function GoodsSalesPromotion()
	{
		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.GoodsSalesPromotion';
		$rew = $this->mypost($this->config->item('api_url'),$body);
		$data['info'] = object_array($rew);
		$this->load->view('sys/GoodsSalesPromotion/index',$data);
	}



	public function GoodsSalesPromotion_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => ''
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($this->getHeards(),$post);

			$post['service'] = 'Srproject.Web_SystemSetting.SettingGoodsSalesPromotion';

			$rew = $this->mypost($this->config->item('api_url'),$post);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/GoodsSalesPromotion_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/GoodsSalesPromotion_form',$data);
			}
		}

		$this->load->view('sys/GoodsSalesPromotion/form',$data);
	}


	public function GoodsType()
	{
		$body = $this->getHeards();
		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.GoodsType';
		$rew = $this->mypost($this->config->item('api_url'),$body);
		$data['info'] = object_array($rew);
		$this->load->view('sys/GoodsType/index',$data);
	}



	public function GoodsType_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => ''
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingGoodsType';

			$rew = $this->mypost($this->config->item('api_url'),$post);
			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/GoodsType_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/GoodsType_form',$data);
			}
		}

		$this->load->view('sys/GoodsType/form',$data);
	}


	public function MachineCode()
	{
		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.MachineCode';
		$rew = $this->mypost($this->config->item('api_url'),$body);
		$data['info'] = object_array($rew);
		$this->load->view('sys/MachineCode/index',$data);
	}



	public function MachineCode_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => ''
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingMachineCode';
			$rew = $this->mypost($this->config->item('api_url'),$post);
			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/MachineCode_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/MachineCode_form',$data);
			}
		}

		$this->load->view('sys/MachineCode/form',$data);
	}


	public function NoSalesGoods()
	{
		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.NoSalesGoods';
		$rew = $this->mypost($this->config->item('api_url'),$body);
		$data['info'] = object_array($rew);
		$this->load->view('sys/NoSalesGoods/index',$data);
	}



	public function NoSalesGoods_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => ''
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingNoSalesGoods';
			$rew = $this->mypost($this->config->item('api_url'),$post);
			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/NoSalesGoods_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/NoSalesGoods_form',$data);
			}
		}

		$this->load->view('sys/NoSalesGoods/form',$data);
	}

	public function Operator()
	{
		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.Operator';
		$rew = $this->mypost($this->config->item('api_url'),$body);

		$data['info'] = object_array($rew);


		$info = $data['info']['data']['info'];

		foreach ($info as $v) {
			$v['quarter'] = getQuartersById($v['quartersid'])['name'];
			$arr[getDepartmentById($v['departmentid'])['name']][] = $v;
		}
		$data['list'] = $arr;

		$this->load->view('sys/Operator/index',$data);
	}



	public function Operator_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => ''
			];
		}
		if (IS_POST) {
			$this->load->helper(array('form', 'url'));
			$config['upload_path']      = './uploads/';
			$config['allowed_types']    = 'gif|jpg|png';
			$config['max_size']     = 100;
			$config['max_width']        = 1024;
			$config['max_height']       = 768;
			$config['file_name'] = md5(time());

			$this->load->library('upload', $config);
			$this->upload->do_upload('userfile');
			$post = $this->input->post();
			$post = array_merge($this->getHeards(),$post);
			$post['photo'] = $this->config->item('base_url').'/uploads/'.$config['file_name'].strstr($_FILES['userfile']['name'],'.');
			$post['service'] = 'Srproject.Web_SystemSetting.SettingOperator';

			$rew = $this->mypost($this->config->item('api_url'),$post);
			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/Operator_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/Operator_form',$data);
			}
		}

		$this->load->view('sys/Operator/form',$data);
	}


	protected function upload_file($fileInfo,$imagesExt = ['png', 'jpg'])
	{

		if ($fileInfo['error'] === 0) {
			$ext = strtolower(pathinfo($fileInfo['name'], PATHINFO_EXTENSION));

			if (!in_array($ext, $imagesExt)) {

				return "文件非法类型";

			}

			$uploadFolder= date("Ymd");
			if (!is_dir($uploadFolder)) {

				mkdir($uploadFolder, 0777, true);

			}

			//$fileName = md5(uniqid(microtime(true), true)) . "." . $ext;
			$fileName = md5(time()).$ext;


			$imgPath = $uploadFolder . "/" . $fileName;

			if (!move_uploaded_file($fileInfo['tmp_name'], $imgPath)) {

				return "ERROR";

			}

			return $imgPath;
		}

	}

	public function Packingtype()
	{
		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.Packingtype';
		$rew = $this->mypost($this->config->item('api_url'),$body);
		$data['info'] = object_array($rew);
		$this->load->view('sys/Packingtype/index',$data);
	}



	public function Packingtype_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => ''
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingPackingtype';
			$rew = $this->mypost($this->config->item('api_url'),$post);
			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/Packingtype_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/Packingtype_form',$data);
			}
		}

		$this->load->view('sys/Packingtype/form',$data);
	}

	public function Quarters()
	{
		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.Quarters';
		$rew = $this->mypost($this->config->item('api_url'),$body);
		$data['info'] = object_array($rew);
		$this->load->view('sys/Quarters/index',$data);
	}



	public function Quarters_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => ''
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingQuarters';
			$rew = $this->mypost($this->config->item('api_url'),$post);
			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/Quarters_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/Quarters_form',$data);
			}
		}

		$this->load->view('sys/Quarters/form',$data);
	}

	public function RepairObject()
	{
		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.RepairObject';
		$rew = $this->mypost($this->config->item('api_url'),$body);
		$data['info'] = object_array($rew);
		$this->load->view('sys/RepairObject/index',$data);
	}



	public function RepairObject_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => ''
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingRepairObject';
			$rew = $this->mypost($this->config->item('api_url'),$post);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/RepairObject_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/RepairObject_form',$data);
			}
		}

		$this->load->view('sys/RepairObject/form',$data);
	}

	public function RepairPartsGoods()
	{
		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.RepairPartsGoods';
		$rew = $this->mypost($this->config->item('api_url'),$body);
		$data['info'] = object_array($rew);
		$this->load->view('sys/RepairPartsGoods/index',$data);
	}



	public function RepairPartsGoods_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => ''
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingRepairPartsGoods';
			$rew = $this->mypost($this->config->item('api_url'),$post);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/RepairPartsGoods_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/RepairPartsGoods_form',$data);
			}
		}

		$this->load->view('sys/RepairPartsGoods/form',$data);
	}



	public function RepairType()
	{
		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.RepairType';
		$rew = $this->mypost($this->config->item('api_url'),$body);
		$data['info'] = object_array($rew);
		$this->load->view('sys/RepairType/index',$data);
	}



	public function RepairType_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => ''
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingRepairType';
			$rew = $this->mypost($this->config->item('api_url'),$post);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/RepairType_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/RepairType_form',$data);
			}
		}

		$this->load->view('sys/RepairType/form',$data);
	}


	public function SalesMashup()
	{
		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.SalesMashup';
		$rew = $this->mypost($this->config->item('api_url'),$body);
		$data['info'] = object_array($rew);
		$this->load->view('sys/SalesMashup/index',$data);
	}



	public function SalesMashup_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => ''
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingSalesMashup';
			$rew = $this->mypost($this->config->item('api_url'),$post);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/SalesMashup_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/SalesMashup_form',$data);
			}
		}

		$this->load->view('sys/SalesMashup/form',$data);
	}

	public function SalesMashupGoods()
	{
		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.SalesMashupGoods';
		$rew = $this->mypost($this->config->item('api_url'),$body);
		$info = object_array($rew);
		foreach ($info['data']['info'] as $k => $v) {
			$arr[$v['fid']]['list'][] = $v;
			$arr[$v['fid']]['title'] = getSalesMashupId($v['fid'])['name'];
		}

		foreach ($arr as $k =>$v) {
			$price = 0;
			foreach ($v['list'] as $vi) {
				$price += $vi['num']*$vi['price'];
			}
			$arr[$k]['zprice'] = $price;
		}
		$data['info'] = $arr;
		$this->load->view('sys/SalesMashupGoods/index',$data);
	}



	public function SalesMashupGoods_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => ''
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingSalesMashupGoods';
			$rew = $this->mypost($this->config->item('api_url'),$post);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/SalesMashupGoods_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/SalesMashupGoods_form',$data);
			}
		}

		$this->load->view('sys/SalesMashupGoods/form',$data);
	}

	public function SecurityCheckProject()
	{
		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.SecurityCheckProject';
		$rew = $this->mypost($this->config->item('api_url'),$body);
		$data['info'] = object_array($rew);
		$this->load->view('sys/SecurityCheckProject/index',$data);
	}



	public function SecurityCheckProject_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => ''
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingSecurityCheckProject';
			$rew = $this->mypost($this->config->item('api_url'),$post);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/SecurityCheckProject_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/SecurityCheckProject_form',$data);
			}
		}

		$this->load->view('sys/SecurityCheckProject/form',$data);
	}


	public function SecurityCheckType()
	{
		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.SecurityCheckType';
		$rew = $this->mypost($this->config->item('api_url'),$body);
		$data['info'] = object_array($rew);
		$this->load->view('sys/SecurityCheckType/index',$data);
	}



	public function SecurityCheckType_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => ''
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingSecurityCheckType';
			$rew = $this->mypost($this->config->item('api_url'),$post);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/SecurityCheckType_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/SecurityCheckType_form',$data);
			}
		}

		$this->load->view('sys/SecurityCheckType/form',$data);
	}
	public function CallType()
	{
		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.CallType';
		$rew = $this->mypost($this->config->item('api_url'),$body);
		$data['info'] = object_array($rew);
		$this->load->view('sys/CallType/index',$data);
	}



	public function CallType_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => ''
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingCallType';
			$rew = $this->mypost($this->config->item('api_url'),$post);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/CallType_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/CallType_form',$data);
			}
		}

		$this->load->view('sys/CallType/form',$data);
	}


	public function CompanyCarSubsidyFreight()
	{
		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.CompanyCarSubsidyFreight';
		$rew = $this->mypost($this->config->item('api_url'),$body);
		$data['info'] = object_array($rew);
		$this->load->view('sys/CompanyCarSubsidyFreight/index',$data);
	}



	public function CompanyCarSubsidyFreight_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => ''
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingCompanyCarSubsidyFreight';
			$rew = $this->mypost($this->config->item('api_url'),$post);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/CompanyCarSubsidyFreight_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/CompanyCarSubsidyFreight_form',$data);
			}
		}

		$this->load->view('sys/CompanyCarSubsidyFreight/form',$data);
	}
	
	public function CallReason()
	{
		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.CallReason';
		$rew = $this->mypost($this->config->item('api_url'),$body);
		$data['info'] = object_array($rew);
		$this->load->view('sys/CallReason/index',$data);
	}

	public function TwohundredType()
	{
		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.TwohundredType';
		$rew = $this->mypost($this->config->item('api_url'),$body);

		$data['info'] = object_array($rew);
		$this->load->view('sys/TwohundredType/index',$data);
	}



	public function TwohundredType_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => ''
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingTwoHundredType';
			$rew = $this->mypost($this->config->item('api_url'),$post);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/TwohundredType_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/TwohundredType_form',$data);
			}
		}

		$this->load->view('sys/TwohundredType/form',$data);
	}


	public function TwohundredItem()
	{
		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.TwohundredItem';
		$rew = $this->mypost($this->config->item('api_url'),$body);

		$data['info'] = object_array($rew);
		$this->load->view('sys/TwohundredItem/index',$data);
	}

	public function ChargeStandardDiscount()
	{

		$this->load->view('sys/ChargeStandardDiscount/index');
	}

	public function SettingChargeStandardDiscount()
	{

		$this->load->view('sys/ChargeStandardDiscount/SettingChargeStandardDiscount');
	}



	public function TwohundredItem_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => ''
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingTwohundredItem';
			$rew = $this->mypost($this->config->item('api_url'),$post);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/TwohundredItem_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/TwohundredItem_form',$data);
			}
		}

		$this->load->view('sys/TwohundredItem/form',$data);
	}


	public function CallReason_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => ''
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingCallReason';
			$rew = $this->mypost($this->config->item('api_url'),$post);
			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/CallReason_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/CallReason_form',$data);
			}
		}

		$this->load->view('sys/CallReason/form',$data);
	}



	public function FeiePrint()
	{
		$body = $this->getHeards();

		$body['state'] = $this->input->get('state')?$this->input->get('state'):'全部';
		$body['service'] = 'Srproject.Web_GetSystemInfo.FeiePrintList';
		$rew = $this->mypost($this->config->item('api_url'),$body);

		$data['info'] = object_array($rew);

		$this->load->view('sys/FeiePrint/index',$data);
	}



	public function FeiePrint_form()
	{
		if ($this->input->get('id')) {
			$data['info'] = Mydecode($this->input->get('id'));

		} else {
			$data['info'] = [
				'id' => 0,
				'name' => ''
			];
		}
		if (IS_POST) {
			$post = $this->input->post();
			$post = array_merge($post,$this->getHeards());
			$post['service'] = 'Srproject.Web_SystemSetting.SettingFeiePrint';
			$rew = $this->mypost($this->config->item('api_url'),$post);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('success', '1', 1);
				redirect('sys/FeiePrint_form',$data);
			} else {
				set_cookie('error', '1', 1);
				redirect('sys/FeiePrint_form',$data);
			}
		}

		$this->load->view('sys/FeiePrint/form',$data);
	}



}
