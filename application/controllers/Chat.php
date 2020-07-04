<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Chat extends HomeBase
{


	public function index()
	{
		$this->load->view('chat/index');
	}

}
