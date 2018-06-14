<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WebSettingsController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('WebSettingsModel','settings');
		$this->surename = $this->session->userdata('surename');
		$this->email = $this->session->userdata('email');
		$this->page->sebar('ctrl',$this);
	}
	
	public function index(){
		$data['active_settings'] = 'active';
		$data['active_settings_web'] = 'active';
		$settings = $this->settings->all()->result();
		$hasil = [];
		if(count($settings) == 0){

		}else{
			foreach($settings as $k => $v){
				$hasil[$v->key] = $v->value;
			}
			$data['settings'] = $hasil;
		}
		echo $this->page->tampil('admin.settings.web.index',$data);
	}

	public function save(){
		$nama_universitas = $this->input->post('nama_universitas');
		$nama_fakultas = $this->input->post('nama_fakultas');
		$nama_jurusan = $this->input->post('nama_jurusan');
		$alamat_universitas = $this->input->post('alamat_universitas');
		$telepon = $this->input->post('telepon');
		$fax = $this->input->post('fax');
		$email = $this->input->post('email');
		$lat_long = $this->input->post('lat_long');

		$settings = $this->settings->all()->num_rows();

		if($settings == 0){
			$data = array(
				array(
					'key' => 'nama_universitas',
					'value' => $nama_universitas,
				),
				array(
					'key' => 'nama_fakultas',
					'value' => $nama_fakultas,
				),
				array(
					'key' => 'nama_jurusan',
					'value' => $nama_jurusan,
				),
				array(
					'key' => 'alamat_universitas',
					'value' => $alamat_universitas,
				),
				array(
					'key' => 'telepon',
					'value' => $telepon,
				),
				array(
					'key' => 'fax',
					'value' => $fax,
				),
				array(
					'key' => 'email',
					'value' => $email,
				),
				array(
					'key' => 'lokasi',
					'value' => $lat_long
				),
			);

			$this->settings->saveBatchData($data);
		}else{
			$data = array(
				array(
					'key' => 'nama_universitas',
					'value' => $nama_universitas,
				),
				array(
					'key' => 'nama_fakultas',
					'value' => $nama_fakultas,
				),
				array(
					'key' => 'nama_jurusan',
					'value' => $nama_jurusan,
				),
				array(
					'key' => 'alamat_universitas',
					'value' => $alamat_universitas,
				),
				array(
					'key' => 'telepon',
					'value' => $telepon,
				),
				array(
					'key' => 'fax',
					'value' => $fax,
				),
				array(
					'key' => 'email',
					'value' => $email,
				),
				array(
					'key' => 'lokasi',
					'value' => $lat_long
				),
			);

			$this->settings->updateBatchData($data);
		}

		redirect(route('admin.settings.web.index'));
		
	}

}
