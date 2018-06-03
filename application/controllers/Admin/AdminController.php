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
		$data['active_dashboard'] = 'active';
		echo $this->page->tampil('admin.dashboard.index',$data);
	}

}
