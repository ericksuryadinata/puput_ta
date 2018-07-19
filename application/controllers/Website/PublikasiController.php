<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PublikasiController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(array('PublikasiModel'=>'publikasi'));

	}

	public function index(){
		$data['csrf'] = $this->getCsrf();
		echo $this->page->tampil('website.landing-page.publikasi.index',$data);
	}

	public function datatables(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$list = $this->publikasi->get_data();
		$data = array();
		$allowed_type = array('xls|xlsx|doc|docx|ppt|pptx');
		$no = $_GET['start'];
		foreach ($list as $publikasi) {
			$no++;
			$row = array();
			$row[] = $no;
			if(isset($publikasi->publikasi_file)){
				$ext = pathinfo($publikasi->publikasi_file, PATHINFO_EXTENSION);
				if(in_array($ext,$allowed_type)){
					$row[] = '<a href="http://docs.google.com/gview?url='.base_url(upload_path('','files').$publikasi->publikasi_file).'" target="_blank"> <b>'.strtoupper($publikasi->publikasi_judul).'</b></a><br>'.$publikasi->publikasi_penulis.'';
				}else{
					$row[] = '<a href="'.base_url(upload_path('','viewerjs').$publikasi->publikasi_file).'" target="_blank"> <b>'.strtoupper($publikasi->publikasi_judul).'</b></a><br>'.$publikasi->publikasi_penulis.'';
				}
            }else{
                $row[] = '<a href="#"> <b>'.strtoupper($publikasi->publikasi_judul).'</b></a><br>'.$publikasi->publikasi_penulis.'';
            }
			if($publikasi->publikasi_semester == 1){
				$row[] = $publikasi->publikasi_tahun.' Gasal';
			}else{
				$row[] = $publikasi->publikasi_tahun.' Genap';
			}
			$data[] = $row;
		}

		$output = array('draw' => $_GET['draw'],
						'recordsTotal' => $this->publikasi->count_all(),
						'recordsFiltered' => $this->publikasi->count_filtered(),
						'data' => $data
						);
		echo json_encode($output);
	}

	private function getCsrf(){
		return array(
			'name' => $this->security->get_csrf_token_name(),
			'token' => $this->security->get_csrf_hash(),
		);
	}
}
