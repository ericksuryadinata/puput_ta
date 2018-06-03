<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('SettingsModel','settings');
	}

	public function index(){
		echo $this->page->tampil('website.landing-page.home.index');
	}

	public function hubungi_kami(){
		$settings = $this->settings->all()->result();
		$hasil = [];
		foreach($settings as $k => $v){
			$hasil[$v->key] = $v->value;
		}
		$data['settings'] = $hasil;
		echo $this->page->tampil('website.landing-page.hubungi-kami.index',$data);
	}

}
