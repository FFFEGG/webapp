<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Xxzx extends HomeBase
{


	public function SplitUserWarehouseGoods()
	{
		$this->load->view('xxzx/SplitUserWarehouseGoods');
	}


	public function EditUserCollateralCharge()
	{
		$this->load->view('xxzx/EditUserCollateralCharge');
	}

	public function EditUserCollateral()
	{
		$this->load->view('xxzx/EditUserCollateral');
	}
	public function UserFreightList()
	{
		$this->load->view('xxzx/UserFreightList');
	}
}
