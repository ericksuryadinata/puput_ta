<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Carbon\Carbon;
class KategoriBeritaController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->surename = $this->session->userdata('surename');
        $this->email = $this->session->userdata('email');
        $this->load->model('KategoriBeritaModel','kategoriberita');
		$this->page->sebar('ctrl',$this);
	}
	
	public function index(){
        $data['csrf'] = $this->getCsrf();
		$data['active_berita'] = 'active';
		$data['active_berita_kategori'] = 'active';
		echo $this->page->tampil('admin.berita.kategori.index',$data);
    }

    public function create(){
		$data['active_berita'] = 'active';
		$data['active_berita_kategori'] = 'active';
		echo $this->page->tampil('admin.berita.kategori.create',$data);
    }

    public function edit($id){
        $id_kategori = array('id' => $id);
        $data['active_berita'] = 'active';
        $data['active_berita_kategori'] = 'active';
		$data['kategori'] = $this->kategoriberita->search($id_kategori)->first_row();
		echo $this->page->tampil('admin.berita.kategori.edit',$data);
    }

    public function delete(){
        if(!$this->input->is_ajax_request()){
            show_404();
        }
        $id = $this->input->post('id');
        $id_kategori = array('id' => $id);
        if($this->kategoriberita->delete($id_kategori) != false){
            echo json_encode($this->success('delete',array('pesan' => 'Berhasil hapus data')));
        }else{
            echo json_encode($this->error('delete',array('pesan' => 'Gagal hapus data')));
        }
    }

    public function save(){
        $nama_kategori = $this->input->post('nama_kategori');

        $data = array(
            'nama_kategori' => $nama_kategori,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'created_by' => $this->session->userdata('userid'),
            'updated_by' => $this->session->userdata('userid'),
        );

        if($this->kategoriberita->save($data)){
			$this->session->set_flashdata($this->success('save',array('pesan' => 'Berhasil Simpan Data')));
			redirect(route('admin.berita.kategori.index'));
		}else{
			$this->session->set_flashdata($this->error('save',array('pesan' => 'Gagal Simpan Data')));
			redirect(route('admin.berita.kategori.index'));
		}
    }

    public function update(){
        $nama_kategori = $this->input->post('nama_kategori');
        $id = $this->input->post('id');
        $id_kategori = array('id' => $id);
        
        $data = array(
            'nama_kategori' => $nama_kategori,
            'updated_at' => Carbon::now(),
            'updated_by' => $this->session->userdata('userid'),
        );

        if($this->kategoriberita->update($data,$id_kategori)){
			$this->session->set_flashdata($this->success('save',array('pesan' => 'Berhasil Simpan Data')));
			redirect(route('admin.berita.kategori.index'));
		}else{
			$this->session->set_flashdata($this->error('save',array('pesan' => 'Gagal Simpan Data')));
			redirect(route('admin.berita.kategori.index'));
		}
    }

    public function datatable(){
		if(!$this->input->is_ajax_request()){
            show_404();
        }
		$list = $this->kategoriberita->get_data();
		$data = array();
		$no = $_GET['start'];
		foreach ($list as $kategoriberita) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $kategoriberita->nama_kategori;
			$row[] = '<a href="'.route("admin.berita.kategori.edit",['id'=>$kategoriberita->id]).'" class="btn bg-indigo waves-effect">Edit</a> 
			<button type="button" class="btn bg-red waves-effect hapus" data-id="'.$kategoriberita->id.'">Hapus</button>';
			$data[] = $row;
		}

		$output = array('draw' => $_GET['draw'],
						'recordsTotal' => $this->kategoriberita->count_all(),
						'recordsFiltered' => $this->kategoriberita->count_filtered(),
						'data' => $data
						);
		echo json_encode($output);
	}
    

    /**
	 * Private function for this page only
	 */

	private function getCsrf(){
		return array(
			'name' => $this->security->get_csrf_token_name(),
			'token' => $this->security->get_csrf_hash(),
		);
	}

	private function success($param,array $condition = []){
		foreach($condition as $key => $value){
			$data[$key]= $value; 
		}
		if($param === 'save'){
			$data['method'] = 'save';
		}else if($param === 'update'){
			$data['method'] = 'update';
		}else if($param === 'delete'){
            $data['method'] = 'delete';
        }

		$data['message'] = 'success';
		$data['csrf'] = $this->getCsrf();
        $data['active_settings'] = 'active';
        $data['active_settings_link'] = 'active';
		return $data;
	}

	private function error($param,array $condition = []){
		foreach($condition as $key => $value){
			$data[$key]= $value; 
		}
		if($param === 'save'){
			$data['method'] = 'save';
		}else if($param === 'update'){
			$data['method'] = 'update';
		}else if($param === 'delete'){
            $data['method'] = 'delete';
        }

		$data['message'] = 'error';
		$data['csrf'] = $this->getCsrf();
		$data['active_settings'] = 'active';
        $data['active_settings_link'] = 'active';
		return $data;
	}

}
