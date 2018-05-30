<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

	public function index()
	{
		echo $this->page->tampil('admin.auth.index');
	}

	public function auth(){
		if($this->session->userdata('login') != true){
            redirect(route('admin.auth.index'));
        }
		// $this->session->set_userdata('login');
		redirect(route('admin.dashboard'));
	}

	public function logout(){
		if($this->session->userdata('login') != true){
            redirect(route('admin.auth.index'));
        }
		$this->session->unset_userdata('login');
		$this->session->sess_destroy();
		echo "Auth logout";
		redirect(route('admin.auth.index'));
	}

}
