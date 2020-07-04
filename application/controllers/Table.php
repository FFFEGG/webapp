<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table extends HomeBase
{

	public function StoreReport()
	{

		$this->load->view('table/StoreReport');
	}

	public function mdStoreReport()
	{
		$gets = $this->getHeards();
		$gets['service'] = 'Srproject.Web_BusinessReport.DepartmentGoodsStock';
		$gets['begintime'] = $this->input->get('begintime') ? $this->input->get('begintime') : '2010-01-01';
		$gets['endtime'] = $this->input->get('endtime') ? $this->input->get('endtime') : date('Y-m-d');
		$gets['type'] = $this->input->get('type') ? $this->input->get('type') : '液化气钢瓶';
		$rew = $this->mypost($this->config->item('api_url'), $gets);
		$this->load->view('table/mdStoreReport');
	}

	public function mdsaletable()
	{
		$this->load->view('table/mdsaletable');
	}

	public function waterkc()
	{
		$this->load->view('table/waterkc');
	}

	public function salekc()
	{
		$this->load->view('table/salekc');
	}

	/**
	 * 门店收款报表
	 */
	public function mssktable()
	{
		$this->load->view('table/mssktable');
	}

	public function emptybottle()
	{

		$this->load->view('table/emptybottle');
	}


	public function Unpaid()
	{

		$this->load->view('table/Unpaid');
	}

	public function Salessummary()
	{

		$this->load->view('table/Salessummary');
	}

	public function Heavygas()
	{

		$this->load->view('table/Heavygas');
	}


	public function opening()
	{

		$this->load->view('table/opening');
	}


	public function Borrow()
	{

		$this->load->view('table/Borrow');
	}
}
