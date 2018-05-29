<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

	public function index()
	{
		$this->session->set_userdata(array('role'=>'admin'));
		echo "Auth login page";
	}

	public function auth(){
		if($this->session->userdata('role') !== 'admin'){
            redirect(route('admin.auth.index'));
        }
		// $this->session->set_userdata('role');
		redirect(route('admin.dashboard'));
	}

	public function logout(){
		if($this->session->userdata('role') !== 'admin'){
            redirect(route('admin.auth.index'));
        }
		$this->session->unset_userdata('role');
		echo "Auth logout";
	}

}
