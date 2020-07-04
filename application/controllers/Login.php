<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends HomeBase {
	public function index()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required',  array('required' => '用户名不能为空'));
		$this->form_validation->set_rules('password', 'Password', 'required',  array('required' => '密码不能为空'));
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('login');
		}
		else
		{
			$companyid = $this->input->cookie('companyid');
			$username = $this->input->post('username',TRUE);
			$password = $this->input->post('password',TRUE);
			$client = $this->config->item('client');
			$rew = $this->mypost($this->config->item('api_url'),[
				'companyid' => $companyid,
				'client' => $client,
				'opeid' => $username,
				'department' =>  get_cookie('department'),
				'seatno' => $this->input->cookie('seatno')?$this->input->cookie('seatno'):'AAA',
				'password' => md5($username . '_SR_' . $password),
				'service' => 'Srproject.Web_GetInfo.OperatorLogin'
			]);
			if ($rew->data->msg == 'SUCCESS') {
				$res = $this->mypost($this->config->item('api_url'),[
					'companyid' => $companyid,
					'client' => $client,
					'opeid' => $username,
					'service' => 'Srproject.Web_GetInfo.InitalData'
				]);

				foreach ($res->data->Department->info as $v) {
					if ($v->name == get_cookie('department')) {
						set_cookie('departmentid',$v->id,60 * 60 * 24 * 30);
					}
				}
			 	foreach (object_array($res->data->company->info) as $v) {
			 		if ($v['companyid'] = $rew->data->opeinfo->companyid) {
						$this->session->set_userdata('company', $v);
					}
				}
				$this->session->set_userdata('users', $rew->data->opeinfo);
				$this->session->set_userdata('initData', $res->data);
				$this->session->set_userdata('wskey', $rew->data->wskey);
				$this->session->set_userdata('AreaDeliverymanList', $rew->data->AreaDeliverymanList);
				$this->session->set_userdata('bulletinboard', $rew->data->bulletinboard);
				redirect("/");
			} else {
				$this->form_validation->set_rules('error', 'error', 'required',  array('required' => '账号密码错误'));
				$this->form_validation->run();
				$this->load->view('login');
			}

		}

		$this->load->view('login');
	}
}
