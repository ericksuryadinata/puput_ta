<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Carbon\Carbon;
class HomeController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(array('WebSettingsModel'=>'settings','PostBeritaModel'=>'postberita','SliderModel' => 'slider','InboxModel' => 'inbox'));
		$this->load->helper(array('text','form'));
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

	public function send(){
		$nama = $this->security->xss_clean($this->input->post('nama'));
		$email = $this->security->xss_clean($this->input->post('email'));
		$subjek = $this->security->xss_clean($this->input->post('subjek'));
		$pesan = $this->security->xss_clean($this->input->post('pesan'));
		$data = array(
			'inbox_nama' => $nama,
			'inbox_email' => $email,
			'inbox_subjek' => $subjek,
			'inbox_pesan' => $pesan,
			'created_at' => Carbon::now()
		);

		$insert = $this->inbox->save($data);
		if($insert){
			$this->session->set_flashdata(array('pesan' => 'Pesan Sukses Terkirim','status' =>'sukses'));
			redirect(route('home.hubungi-kami'));
		}else{
			$this->session->set_flashdata(array('pesan' => 'Pesan Tidak Terkirim','status' =>'error'));
			redirect(route('home.hubungi-kami'));
		}
	}

}
