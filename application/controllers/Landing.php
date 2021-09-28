<?php defined('BASEPATH') or exit('No direct script access allowed');

class Landing extends CI_Controller
{

	public function index()
	{
		check_not_login();
		$data['judul'] = 'Dashboard';
		$this->template->load('template', 'home', $data);
	}
}
