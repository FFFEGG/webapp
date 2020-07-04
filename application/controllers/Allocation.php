<?php


class Allocation extends HomeBase
{
	public function plan()
	{

		if (IS_POST) {
			$post = $this->input->post();

			foreach ($post['goodsid'] as $k => $v) {
				$data['goodsid'] = $v;
				$data['goodsname'] = getoneGoodsById($v)['name'];
				$data['num'] = $post['num'][$k];
				$arr[] = $data;

			}

//			$goods = getoneGoodsById($post['goodsid']);
//
//
//			$post['cat'] = getCatId($goods['catid'])['name'];
//			$post['goodstype'] = getGoodsTypeId($goods['goodstypeid'])['name'];
//			$post['brand'] = getGoodsBrandId($goods['brandid'])['name'];


//			$post['goodsname'] = $goods['name'];
			$posts = $this->getHeards();
			$posts['service'] = 'Srproject.Web_OperationalData.ApplyeAllocationPlan';
			$posts['goodsjson'] = json_encode($arr);
			$posts['otherparty'] = $post['otherparty'];
			$posts['mode'] = $post['mode'];
			$rew = $this->mypost($this->config->item('api_url'), $posts);

			if ($rew->data->msg == 'SUCCESS') {

				set_cookie('plan', '1', 3);
				redirect('/allocation/plan');
			} else {
				set_cookie('errorplan', '1', 3);
				redirect('/allocation/plan');
			}

		}



		$arr['service'] = 'Srproject.Web_GetInfo.MaterialAllocationPlanList';
		$arr['begintime'] = date('Y-m-d',time() - 3600*24*3);
		$arr['endtime'] = date('Y-m-d');
		$arr['source'] = get_cookie('department');
		$arr['department'] = '全部';
		$arr['opeid'] = $_SESSION['users']->opeid;
		$rew = $this->mypost($this->config->item('api_url'), $arr);
		$data['list'] = [];

		if ($rew->data->msg == 'SUCCESS') {
			$data['list'] = arraysort(object_array($rew->data->info),'addtime','DESC');
		}

		$this->load->view('allocation/plan',$data);
	}

	public function planlist()
	{
		$post = $this->getHeards();
		$post['service'] = 'Srproject.Web_GetInfo.MaterialAllocationPlanList';
		$post['begintime'] = $this->input->get('begintime') ? $this->input->get('begintime') : date('Y-m-d');
		$post['endtime'] = $this->input->get('endtime') ? $this->input->get('endtime') : date('Y-m-d', time() + 24 * 60 * 60);
		$post['source'] = $this->input->get('source') ? $this->input->get('source') : '全部';
		$post['department'] = '运输公司';
		$rew = $this->mypost($this->config->item('api_url'), $post);
		if ($rew->data->msg == 'SUCCESS') {
			$data['list'] = object_array($rew->data->info);
		} else {
			$data['list'] = [];
		}
		$this->load->view('allocation/planlist', $data);
	}


	public function dispatchs()
	{
		$data['drivers'] = $this->getCardriver();
	
		if (IS_POST) {
			$datas['info'] = Mydecode($this->input->post('info'));
			$post = $this->input->post();

			foreach ($post['goodsid'] as $k => $v) {
				$json['goodsid'] = $v;
				$goods = $this->findGoodsById($v);
				$json['goodsname'] = $goods['name'];
				$json['packingtype'] = $goods['packingtype'];
				$json['num'] = $post['num'][$k];
				$arr[] = $json;
			}
			$heards = $this->getHeards();
			$heards['service'] = 'Srproject.Web_OperationalData.AddMaterielFlow';
			$heards['id'] = $post['id'];
			$heards['car_no'] = $post['car_no'];
			$heards['brokerage'] = $post['brokerage'];
			$heards['receiver'] = $post['receiver'];
			$heards['goodsjson'] = json_encode($arr);
			$heards['type'] =  $post['type'] == 1 ? '重' : '空';
			$rew = $this->mypost($this->config->item('api_url'), $heards);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('dispatch', '1', 3);
				set_cookie('printinfo', json_encode($rew->data->printinfo), 3);
				redirect('allocation/dispatchs?data=' . $this->input->post('info'), object_array($datas));
			} else {
				set_cookie('errordispatch', '1', 3);
				redirect('allocation/dispatchs?data=' . $this->input->post('info'), object_array($datas));
			}
		}
		$data['info'] = object_array(Mydecode($this->input->get('data')));

		$this->load->view('allocation/dispatchs', $data);
	}

	public function dispatchss()
	{
		$data['drivers'] = $this->getCardriver();

		if (IS_POST) {
			$datas['info'] = Mydecode($this->input->post('info'));
			$post = $this->input->post();

			foreach ($post['goodsid'] as $k => $v) {
				$json['goodsid'] = $v;
				$goods = $this->findGoodsById($v);
				$json['goodsname'] = $goods['name'];
				$json['packingtype'] = $goods['packingtype'];
				$json['num'] = $post['num'][$k];
				$arr[] = $json;
			}
			$heards = $this->getHeards();
			$heards['service'] = 'Srproject.Web_OperationalData.AddMaterielFlow';
			$heards['id'] = $post['id'];
			$heards['car_no'] = $post['car_no'];
			$heards['brokerage'] = $post['brokerage'];
			$heards['receiver'] = $post['receiver'];
			$heards['goodsjson'] = json_encode($arr);
			$heards['type'] =  $post['type'] == 1 ? '重' : '空';
			$rew = $this->mypost($this->config->item('api_url'), $heards);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('dispatch', '1', 3);
				set_cookie('printinfo', json_encode($rew->data->printinfo), 3);
				redirect('allocation/dispatchss?data=' . $this->input->post('info'), object_array($datas));
			} else {
				set_cookie('errordispatch', '1', 3);
				redirect('allocation/dispatchss?data=' . $this->input->post('info'), object_array($datas));
			}
		}
		$data['info'] = object_array(Mydecode($this->input->get('data')));

		$this->load->view('allocation/dispatchss', $data);
	}


	public function dispatch()
	{
		$data['drivers'] = $this->getCardriver();
	 
		if (IS_POST) {

			$post = $this->input->post();
			foreach ($post['goodsid'] as $k => $v) {
				$json['goodsid'] = $v;
				$goods = $this->findGoodsById($v);
				$json['goodsname'] = $goods['name'];
				$json['packingtype'] = $goods['packingtype'];
				$json['num'] = $post['num'][$k];
				$arr[] = $json;
			}
			$heards = $this->getHeards();
			$heards['service'] = 'Srproject.Web_OperationalData.AddMaterielFlow';
			$heards['id'] = $post['id'];
			$heards['car_no'] = $post['car_no'];
			$heards['brokerage'] = $post['brokerage'];
			$heards['receiver'] = $post['receiver'];
			$heards['goodsjson'] = json_encode($arr);
			$heards['type'] =  $post['type'] == 1 ? '重' : '空';
			$rew = $this->mypost($this->config->item('api_url'), $heards);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('dispatch', '1', 2);
				redirect('allocation/dispatch');
			} else {
				set_cookie('errordispatch', '1', 2);
				redirect('allocation/dispatch');
			}
		}

		$this->load->view('allocation/dispatch',$data);
	}


	public function dispatchwater()
	{
		$data['drivers'] = $this->getCardriver();

		if (IS_POST) {
			$post = $this->input->post();

			foreach ($post['goodsid'] as $k => $v) {
				$goods = $this->findGoodsById($v);
				$datas['mode'] = $post['mode'];
				$datas['goodsid'] = $v;
				$datas['goodsname'] = $goods['name'];
				$datas['unit'] = $goods['unit'];
				$datas['capacityunit'] = $goods['capacityunit'];
				$datas['suttle'] = empty($post['type'][$k]) ? 0 : $goods['suttle'];
				$datas['packingtype'] = $goods['packingtype'];
				$datas['num'] = $post['num'][$k];
				$arr[] = $datas;
			}
			$heards = $this->getHeards();
			$heards['service'] = 'Srproject.Web_OperationalData.AddMaterielFlowNoScan';
			$heards['car_no'] = $post['car_no'];
			$heards['id'] = 0;
			$heards['brokerage'] = $post['brokerage'];
			$heards['receiver'] = $post['receiver'];
			$heards['goodsjson'] = json_encode($arr);

			$rew = $this->mypost($this->config->item('api_url'), $heards);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('dispatchwater', '1', 2);
				redirect('allocation/dispatchwater');
			} else {
				set_cookie('errordispatchwater', '1', 2);
				redirect('allocation/dispatchwater');
			}
		}

		$this->load->view('allocation/dispatchwater',$data);
	}


	public function dispatchwaterxs()
	{
		$data['drivers'] = $this->getCardriver();

		if (IS_POST) {
			$post = $this->input->post();
			foreach ($post['goodsid'] as $k => $v) {
				$datas['goodsid'] = $v;
				$goods = $this->findGoodsById($v);
				$datas['mode'] = $post['mode'];
				$datas['goodsname'] = $goods['name'];
				$datas['unit'] = $goods['unit'];
				$datas['capacityunit'] = $goods['capacityunit'];
				$datas['suttle'] = empty($post['type'][$k]) ? 0 : $goods['suttle'];
				$datas['packingtype'] = $goods['packingtype'];
				$datas['num'] = $post['num'][$k];
				$arr[] = $datas;
			}
			$heards = $this->getHeards();
			$heards['service'] = 'Srproject.Web_OperationalData.AddMaterielFlowSale';
			$heards['car_no'] = $post['car_no'];
			$heards['id'] = 0;
			$heards['brokerage'] = $post['brokerage'];
			$heards['receiver'] = $post['receiver'];
			$heards['goodsjson'] = json_encode($arr);

			$rew = $this->mypost($this->config->item('api_url'), $heards);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('dispatchwater', '1', 2);
				redirect('allocation/dispatchwaterxs');
			} else {
				set_cookie('errordispatchwater', '1', 2);
				redirect('allocation/dispatchwaterxs');
			}
		}

		$this->load->view('allocation/dispatchwaterxs',$data);
	}

	public function materflow()
	{

		$post = $this->getHeards();
//		$post['service'] = 'Srproject.Web_GetInfo.MaterielFlow';
		$post['service'] = 'Srproject.Web_GetInfo.MaterielFlow';
		$post['begintime'] = $this->input->get('begintime') ? $this->input->get('begintime') : date('Y-m-d');
		$post['endtime'] = $this->input->get('endtime') ? $this->input->get('endtime') : date('Y-m-d', time() + 24 * 60 * 60);
		$post['mode'] = $this->input->get('mode') ? $this->input->get('mode') : '调拨';
		$post['receiving'] = $this->input->get('receiving') ? $this->input->get('receiving') : '调入';
		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			$data['list'] = object_array($rew->data->info);
		} else {
			$data['list'] = [];
		}
		$this->load->view('allocation/materflow', $data);
	}

	public function AllocationMaterielFlow()
	{

		$post = $this->getHeards();
		$post['service'] = 'Srproject.Web_GetInfo.AllocationMaterielFlow';
		$post['begintime'] = $this->input->get('begintime') ? $this->input->get('begintime') : '2010-01-01';
		$post['endtime'] = $this->input->get('endtime') ? $this->input->get('endtime') : date('Y-m-d', time() + 24 * 60 * 60);
		$post['mode'] = $this->input->get('mode') ? $this->input->get('mode') : '调入';
		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			$data['list'] = object_array($rew->data->info);
		} else {
			$data['list'] = [];
		}
		$this->load->view('allocation/AllocationMaterielFlow', $data);
	}


	public function newAllocationMaterielFlow()
	{

		$post = $this->getHeards();
		$post['service'] = 'Srproject.Web_GetInfo.AllocationMaterielFlow';
		$post['begintime'] = $this->input->get('begintime') ? $this->input->get('begintime') : '2010-01-01';
		$post['endtime'] = $this->input->get('endtime') ? $this->input->get('endtime') : date('Y-m-d', time() + 24 * 60 * 60);
		$post['mode'] = $this->input->get('mode') ? $this->input->get('mode') : '调入';
		$rew = $this->mypost($this->config->item('api_url'), $post);

		if ($rew->data->msg == 'SUCCESS') {
			$data['list'] = object_array($rew->data->info);
		} else {
			$data['list'] = [];
		}
		$this->load->view('allocation/newAllocationMaterielFlow', $data);
	}



	public function uploadmaterial()
	{
		if (IS_POST) {
			$datas['info'] = Mydecode($this->input->post('info'));
			$post = $this->input->post();
			foreach ($post['goodsid'] as $k => $v) {
				$data['goodsid'] = $v;
				$goods = $this->findGoodsById($v);

				$data['mode'] = "调拨";
				$data['goodsname'] = $goods['name'];
				$data['unit'] = $goods['unit'];
				$data['suttle'] = empty($post['type'][$k]) ? 0 : $goods['suttle'];
				$data['packingtype'] = $goods['packingtype'];
				$data['capacityunit'] = $goods['capacityunit'];
				$data['num'] = $post['num'][$k];
				$arr[] = $data;
			}
			$heards = $this->getHeards();
			$heards['service'] = 'Srproject.Web_OperationalData.AddMaterielFlow';
			$heards['id'] = $post['id'];
			$heards['car_no'] = $post['car_no'];
			$heards['brokerage'] = $post['brokerage'];
			$heards['receiver'] = $post['receiver'];
			$heards['goodsjson'] = json_encode($arr);
			$rew = $this->mypost($this->config->item('api_url'), $heards);

			if ($rew->data->msg == 'SUCCESS') {
				set_cookie('dispatch', '1', 3);
				redirect('allocation/uploadmaterial?data=' . $this->input->post('info'), object_array($datas));
			} else {
				set_cookie('errordispatch', '1', 3);
				redirect('allocation/uploadmaterial?data=' . $this->input->post('info'), object_array($datas));
			}
		}
		$data['info'] = object_array(Mydecode($this->input->get('data')));


		$this->load->view('allocation/uploadmaterial',$data);
	}

	/**
	 *	收发钢瓶
	 */
	public function sfuploadmaterial()
	{

		$this->load->view('allocation/inuploadmaterial');
	}

	/**
	 *	收发钢瓶
	 */
	public function newsfuploadmaterial()
	{

		$this->load->view('allocation/newinuploadmaterial');
	}

	/**
	 *	收发钢瓶
	 */
	public function folduploadmaterial()
	{

		$this->load->view('allocation/folduploadmaterial');
	}

	/**
	 *	收发钢瓶
	 */
	public function newfolduploadmaterial()
	{

		$this->load->view('allocation/newfolduploadmaterial');
	}


	/**
	 *	收发钢瓶
	 */
	public function AppointmentUserDepartmentRepair()
	{

		$this->load->view('allocation/AppointmentUserDepartmentRepair');
	}

	/**
	 *	查询用户部门维修记录信息
	 */
	public function UserDepartmentRepairInfo()
	{

		$this->load->view('allocation/UserDepartmentRepairInfo');
	}

	/**
	 *	查询部门维修记录信息
	 */
	public function DepartmentRepairList()
	{

		$this->load->view('allocation/DepartmentRepairList');
	}

	/**
	 *	用户退款
	 */
	public function UserRefund()
	{

		$this->load->view('allocation/UserRefund');
	}

	/**
	 *	更新钢瓶档案
	 */
	public function UpdateArchives()
	{

		$this->load->view('allocation/UpdateArchives');
	}

	/**
	 *	零售后勤 配送员薪酬
	 */
	public function RetailLogisticsDeliverymanDalary()
	{

		$this->load->view('allocation/RetailLogisticsDeliverymanDalary');
	}
}
