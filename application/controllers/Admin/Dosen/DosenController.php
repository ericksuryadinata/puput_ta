<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DosenController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('Upload');
		$this->surename = $this->session->userdata('surename');
		$this->email = $this->session->userdata('email');
		$this->page->sebar('ctrl',$this);
	}
	
	public function index(){
		$data['active_dosen'] = 'active';
		echo $this->page->tampil('admin.dosen.index',$data);
	}

	public function upload(){
		
	}

}
