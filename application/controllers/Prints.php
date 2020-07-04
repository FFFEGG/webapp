<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prints extends HomeBase
{
	public function index()
	{
		$this->load->view('prints/index');
	}
}
