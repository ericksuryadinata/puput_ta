<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->surename = $this->session->userdata('surename');
		$this->email = $this->session->userdata('email');
		$this->page->sebar('ctrl',$this);
	}
	
	public function index(){
		$data['csrf'] = $this->getCsrf();
		$data['active_dashboard'] = 'active';
		echo $this->page->tampil('admin.dashboard.index',$data);
	}


	/**
	 * Private function for this page only
	 */

	private function getCsrf(){
		return array(
			'name' => $this->security->get_csrf_token_name(),
			'token' => $this->security->get_csrf_hash(),
		);
	}

}
