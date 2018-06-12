<?php

class DosenController extends CI_Controller{

    public function __construct(){
        parent::__construct();
		$this->load->model('DosenModel','dosen');
		$this->halaman = 'dosen';
		$this->page->sebar('ctrl',$this);
	}
	
    public function index(){
        $data['csrf'] = $this->getCsrf();
        echo $this->page->tampil('website.landing-page.dosen.index',$data);
	}
	
	public function detail($id){
		$slug = goExplode($id,'-',1);
		$id = array('id' => $slug);
		$data['dosen'] = $this->dosen->search($id)->first_row();
		echo $this->page->tampil('website.landing-page.dosen.detail',$data);
	}

    public function datatables(){
		$list = $this->dosen->get_data();
		$data = array();
		$no = $_GET['start'];
		foreach ($list as $dosen) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $dosen->nama;
			$row[] = $dosen->posisi;
			$row[] = $dosen->email;
			$slug = 'stafuser-'.$dosen->id.'-informatika';
			$row[] = '<a href="'.route("dosen.detail",['id'=>$slug]).'" title=""><img src="'.base_url("assets/website/images/ico-search.png").'"></a>';
			$data[] = $row;
		}

		$output = array('draw' => $_GET['draw'],
						'recordsTotal' => $this->dosen->count_all(),
						'recordsFiltered' => $this->dosen->count_filtered(),
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