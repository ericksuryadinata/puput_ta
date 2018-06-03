<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HasilkaryaController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->surename = $this->session->userdata('surename');
		$this->email = $this->session->userdata('email');
		$this->page->sebar('ctrl',$this);
	}
	
	public function index(){
		$data['active_hasil_karya'] = 'active';
		echo $this->page->tampil('admin.hasil-karya.index',$data);
	}

}
