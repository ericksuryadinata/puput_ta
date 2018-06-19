<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(array('WebSettingsModel'=>'settings','PostBeritaModel'=>'postberita','SliderModel' => 'slider'));
		$this->load->helper(array('text'));
	}

	public function index(){
		$data['slider'] = $this->slider->newest(5)->result();
		$data['post'] = $this->postberita->newest(4)->result();
		echo $this->page->tampil('website.landing-page.home.index',$data);
	}

	public function hubungi_kami(){ 
		$data['dummy'] = 0;
		$settings = $this->settings->all()->result();
		$hasil = [];
		if(count($settings) == 0){

		}else{
			foreach($settings as $k => $v){
				$hasil[$v->key] = $v->value;
			}
			$data['settings'] = $hasil;
		}
		echo $this->page->tampil('website.landing-page.hubungi-kami.index',$data);
	}

}
