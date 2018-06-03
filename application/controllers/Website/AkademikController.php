<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AkademikController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('AkademikModel','akademik');
	}
	public function kurikulum(){
		$data['content'] = 'kurikulum';
		$data['kurikulum'] = $this->akademik->loadDataSection('kurikulum')->result();
		echo $this->page->tampil('website.landing-page.akademik.index',$data);
	}

}
