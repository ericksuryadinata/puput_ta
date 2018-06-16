<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Carbon\Carbon;

class DosenController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->surename = $this->session->userdata('surename');
		$this->email = $this->session->userdata('email');
		$this->load->model('DosenModel','dosen');
		$this->load->library(array('upload'));
		$this->page->sebar('ctrl',$this);
	}
	
	public function index(){
		$data['csrf'] = $this->getCsrf();
		$data['active_dosen'] = 'active';
		echo $this->page->tampil('admin.dosen.index',$data);
	}

	public function create(){
		$data['active_dosen'] = 'active';
		echo $this->page->tampil('admin.dosen.create',$data);
	}

	public function detail(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$id = $this->input->get('id');
		$where = array('id' => $id);
		$data = $this->dosen->search($where)->result();
		echo json_encode($data);
	}

	public function edit($id){
		$id_dosen = array('id'=>$id);
		$data['active_dosen'] = 'active';
		$data['dosen'] = $this->dosen->search($id_dosen)->first_row();
		echo $this->page->tampil('admin.dosen.edit',$data);
	}

	public function delete(){
		if(!$this->input->is_ajax_request()){
            show_404();
        }
        $id = $this->input->post('id');
        $id_dosen = array('id' => $id);
        $dosen = $this->dosen->search($id_dosen)->first_row();
        if($this->dosen->delete($id_dosen) != false){
			remove_file($this->uploadPath().$dosen->nama_foto);
            echo json_encode($this->success('delete',array('pesan' => 'Berhasil hapus data')));
        }else{
            echo json_encode($this->error('delete',array('pesan' => 'Gagal hapus data')));
        }
	}

	public function save(){
		$nidn = $this->security->xss_clean($this->input->post('nidn'));
		$nama_dosen = $this->security->xss_clean($this->input->post('nama_dosen'));
		$posisi = $this->security->xss_clean($this->input->post('posisi'));
		$alamat = $this->security->xss_clean($this->input->post('alamat'));
		$telepon = $this->security->xss_clean($this->input->post('telepon'));
		$fax = $this->security->xss_clean($this->input->post('fax'));
		$email = $this->security->xss_clean($this->input->post('email'));
		$laman_web = $this->security->xss_clean($this->input->post('laman_web'));
		$aktifitas = $this->security->xss_clean($this->input->post('aktifitas'));
		$peminatan = $this->security->xss_clean($this->input->post('minat_penelitian'));
		$gambar = $this->security->xss_clean($this->input->post('fotodosen'));
		
		$filename = 'DOSEN_'.seo($nama_dosen).'_'.date('Ymdhis');
		$this->upload->initialize($this->configUpload($filename));

        if(!empty($_FILES['fotodosen']['name'])){
            if ($this->upload->do_upload('fotodosen')){
				$gbr = $this->upload->data();
                //Compress Image
                $this->load->library('image_lib', $this->configResize($gbr));
                $this->image_lib->resize();
 
                $gambar = $gbr['file_name'];
            }else{
				$this->session->set_flashdata($this->error('save',array('pesan' => 'Gagal Simpan Data, '.$this->upload->display_errors())));
				redirect(route('admin.dosen.index'));
			}
                      
        }else{
			$gambar = '';
        }

		$data = array(
			'nidn' => $nidn,
			'nama' => $nama_dosen,
			'posisi' => $posisi,
			'alamat' => $alamat,
			'telepon' => $telepon,
			'fax' => $fax,
			'email' => $email,
			'laman_web' => $laman_web,
			'aktifitas' => $aktifitas,
			'peminatan' => $peminatan,
			'nama_foto' => $gambar,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
			'created_by' => $this->session->userdata('userid'),
			'updated_by' => $this->session->userdata('userid'),
		);
		if($this->dosen->save($data)){
			$this->session->set_flashdata($this->success('save',array('pesan' => 'Berhasil Simpan Data')));
			redirect(route('admin.dosen.index'));
		}else{
			$this->session->set_flashdata($this->error('save',array('pesan' => 'Gagal Simpan Data')));
			redirect(route('admin.dosen.index'));
		}
	}

	public function update(){
		$nidn = $this->security->xss_clean($this->input->post('nidn'));
		$nama_dosen = $this->security->xss_clean($this->input->post('nama_dosen'));
		$posisi = $this->security->xss_clean($this->input->post('posisi'));
		$alamat = $this->security->xss_clean($this->input->post('alamat'));
		$telepon = $this->security->xss_clean($this->input->post('telepon'));
		$fax = $this->security->xss_clean($this->input->post('fax'));
		$email = $this->security->xss_clean($this->input->post('email'));
		$laman_web = $this->security->xss_clean($this->input->post('laman_web'));
		$aktifitas = $this->security->xss_clean($this->input->post('aktifitas'));
		$peminatan = $this->security->xss_clean($this->input->post('minat_penelitian'));
		$id = $this->security->xss_clean($this->input->post('id'));
		$gambar = $this->security->xss_clean($this->input->post('fotodosen'));

		// ambil nama gambar yang disimpan buat didelete nanti
		$id_dosen = array('id' => $id);
		$dosen = $this->dosen->search($id_dosen)->first_row();
		$dosen_foto = $dosen->nama_foto;

		$filename = 'DOSEN_'.seo($nama_dosen).'_'.date('Ymdhis');
		$this->upload->initialize($this->configUpload($filename));

        if(!empty($_FILES['fotodosen']['name'])){
            if ($this->upload->do_upload('fotodosen')){
				$gbr = $this->upload->data();
                //Compress Image
                $this->load->library('image_lib', $this->configResize($gbr));
                $this->image_lib->resize();
 
                $gambar = $gbr['file_name'];
            }else{
				$this->session->set_flashdata($this->error('save',array('pesan' => 'Gagal Simpan Data, '.$this->upload->display_errors())));
				redirect(route('admin.dosen.index'));
			}
                      
        }else{
			$gambar = '';
        }

		$data = array(
			'nidn' => $nidn,
			'nama' => $nama_dosen,
			'posisi' => $posisi,
			'alamat' => $alamat,
			'telepon' => $telepon,
			'fax' => $fax,
			'email' => $email,
			'laman_web' => $laman_web,
			'aktifitas' => $aktifitas,
			'peminatan' => $peminatan,
			'nama_foto' => $gambar,
			'updated_at' => Carbon::now(),
			'updated_by' => $this->session->userdata('userid'),
		);

		if($this->dosen->update($data,$id_dosen)){
			remove_file($this->uploadPath().$dosen_foto);
			$this->session->set_flashdata($this->success('update',array('pesan' => 'Berhasil Update Data')));
			redirect(route('admin.dosen.index'));
		}else{
			remove_file($this->uploadPath().$gambar);
			$this->session->set_flashdata($this->error('update',array('pesan' => 'Gagal Update Data')));
			redirect(route('admin.dosen.index'));
		}
	}

	public function datatable(){
		if(!$this->input->is_ajax_request()){
            show_404();
        }
		$list = $this->dosen->get_data();
		$data = array();
		$no = $_GET['start'];
		foreach ($list as $dosen) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $dosen->nidn;
			$row[] = $dosen->nama;
			$row[] = $dosen->posisi;
			$row[] = $dosen->email;
			$row[] = '<button type="button" class="btn bg-light-green waves-effect detail" data-id="'.$dosen->id.'">Detail</button> 
			<a href="'.route("admin.dosen.edit",['id'=>$dosen->id]).'" class="btn bg-indigo waves-effect">Edit</a> 
			<button type="button" class="btn bg-red waves-effect hapus" data-id="'.$dosen->id.'">Hapus</button>';
			$data[] = $row;
		}

		$output = array('draw' => $_GET['draw'],
						'recordsTotal' => $this->dosen->count_all(),
						'recordsFiltered' => $this->dosen->count_filtered(),
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
		}else{
			$data['method'] = 'update';
		}
		$data['message'] = 'success';
		$data['csrf'] = $this->getCsrf();
		$data['active_dosen'] = 'active';
		return $data;
	}

	private function error($param,array $condition = []){
		foreach($condition as $key => $value){
			$data[$key]= $value; 
		}
		if($param === 'save'){
			$data['method'] = 'save';
		}else{
			$data['method'] = 'update';
		}
		$data['message'] = 'error';
		$data['csrf'] = $this->getCsrf();
		$data['active_dosen'] = 'active';
		return $data;
	}

	private function configUpload($filename){
		$config['upload_path'] = $this->uploadPath(); //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['file_name'] = $filename;
		return $config;
	}

	private function configResize($gbr){
		$config['image_library']='gd2';
		$config['source_image']= $this->uploadPath().$gbr['file_name'];
		$config['maintain_ratio']= TRUE;
		$config['width']= 275;
		$config['height']= 275;
		$config['new_image']= $this->uploadPath().$gbr['file_name'];
		return $config;
	}

	private function uploadPath(){
		return 'uploads/images/dosen/';
	}
}
