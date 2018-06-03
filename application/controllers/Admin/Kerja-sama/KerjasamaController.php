<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KerjasamaController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->surename = $this->session->userdata('surename');
		$this->email = $this->session->userdata('email');
		$this->page->sebar('ctrl',$this);
	}
	
	public function index(){
		$data['active_kerja_sama'] = 'active';
		echo $this->page->tampil('admin.kerja-sama.index',$data);
	}

}
