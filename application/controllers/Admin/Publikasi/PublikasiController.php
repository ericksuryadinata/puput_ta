<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Carbon\Carbon;

class PublikasiController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->surename = $this->session->userdata('surename');
		$this->email = $this->session->userdata('email');
		$this->load->library(array('upload'));
		$this->load->helper('text');
        $this->load->model(array('PublikasiModel'=>'publikasi'));
		$this->page->sebar('ctrl',$this);
	}
	
	public function index(){
        $data['csrf'] = $this->getCsrf();
		$data['active_publikasi'] = 'active';
		echo $this->page->tampil('admin.publikasi.index',$data);
    }

    public function create(){
		$data['active_publikasi'] = 'active';
		echo $this->page->tampil('admin.publikasi.create',$data);
    }

    public function edit($id){
        $id_post = array('id' => $id);
        $data['active_publikasi'] = 'active';
		$data['post'] = $this->publikasi->search($id_post)->first_row();
		echo $this->page->tampil('admin.publikasi.edit',$data);
    }

    public function delete(){
        if(!$this->input->is_ajax_request()){
            show_404();
        }
        $id = $this->input->post('id');
		$id_post = array('id' => $id);
		$post = $this->publikasi->search($id_post)->first_row();
        if($this->publikasi->delete($id_post) != false){
			remove_file(upload_path('file').$post->publikasi_file);
            echo json_encode($this->success('delete',array('pesan' => 'Berhasil hapus data')));
        }else{
            echo json_encode($this->error('delete',array('pesan' => 'Gagal hapus data')));
        }
    }

    public function save(){
		$judul_publikasi = $this->security->xss_clean($this->input->post('judul_publikasi'));
		$penulis_publikasi = $this->security->xss_clean($this->input->post('penulis_publikasi'));
		$semester = $this->security->xss_clean($this->input->post('semester_publikasi'));
		$tahun = $this->security->xss_clean($this->input->post('tahun_publikasi'));
		$file = $this->security->xss_clean($this->input->post('file_publikasi'));
		
		$filename = 'PUBLIKASI_'.seo(word_limiter($judul_publikasi,4)).'_'.seo($penulis_publikasi);
		$this->upload->initialize($this->configUpload($filename));

        if(!empty($_FILES['file_publikasi']['name'])){
            if ($this->upload->do_upload('file_publikasi')){
				$files = $this->upload->data();
                $files_name = $files['file_name'];
            }else{
				$this->session->set_flashdata($this->error('save',array('pesan' => 'Gagal Simpan Data, '.$this->upload->display_errors())));
				redirect(route('admin.publikasi.index'));
			}
                      
        }else{
			$this->session->set_flashdata($this->error('save',array('pesan' => 'Gagal Simpan Data, file tidak boleh kosong ')));
			redirect(route('admin.publikasi.index'));
        }

        $data = array(
			'publikasi_judul' => $judul_publikasi,
			'publikasi_penulis' => $penulis_publikasi,
			'publikasi_semester' => $semester,
			'publikasi_tahun' => $tahun,
			'publikasi_file' => $files_name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'created_by' => $this->session->userdata('userid'),
            'updated_by' => $this->session->userdata('userid'),
        );

        if($this->publikasi->save($data)){
			$this->session->set_flashdata($this->success('save',array('pesan' => 'Berhasil Simpan Data')));
			redirect(route('admin.publikasi.index'));
		}else{
			$this->session->set_flashdata($this->error('save',array('pesan' => 'Gagal Simpan Data')));
			redirect(route('admin.publikasi.index'));
		}
    }

    public function update(){
        $judul_publikasi = $this->security->xss_clean($this->input->post('judul_publikasi'));
		$penulis_publikasi = $this->security->xss_clean($this->input->post('penulis_publikasi'));
		$semester = $this->security->xss_clean($this->input->post('semester_publikasi'));
		$tahun = $this->security->xss_clean($this->input->post('tahun_publikasi'));
		$file = $this->security->xss_clean($this->input->post('file_publikasi'));
		
		$id = $this->security->xss_clean($this->input->post('id'));
        $id_post = array('id' => $id);
		
		// take the image name first we will need this for removing file
        $post = $this->publikasi->search($id_post)->first_row();
		$post_file = $post->publikasi_file;
		
        $filename = 'PUBLIKASI_'.seo(word_limiter($judul_publikasi,4)).'_'.seo($penulis_publikasi);
		$this->upload->initialize($this->configUpload($filename));

        if(!empty($_FILES['file_publikasi']['name'])){
            if ($this->upload->do_upload('file_publikasi')){
				$files = $this->upload->data();
                $files_name = $files['file_name'];
            }else{
				$this->session->set_flashdata($this->error('update',array('pesan' => 'Gagal Update Data, '.$this->upload->display_errors())));
				redirect(route('admin.publikasi.index'));
			}
                      
        }else{
			$this->session->set_flashdata($this->error('update',array('pesan' => 'Gagal Update Data, file tidak boleh kosong ')));
			redirect(route('admin.publikasi.index'));
        }

        $data = array(
			'publikasi_judul' => $judul_publikasi,
			'publikasi_penulis' => $penulis_publikasi,
			'publikasi_semester' => $semester,
			'publikasi_tahun' => $tahun,
			'publikasi_file' => $files_name,
            'updated_at' => Carbon::now(),
            'updated_by' => $this->session->userdata('userid'),
        );


        if($this->publikasi->update($data,$id_post)){
			remove_file(upload_path('file').$post->publikasi_file);
			$this->session->set_flashdata($this->success('update',array('pesan' => 'Berhasil Simpan Data')));
			redirect(route('admin.publikasi.index'));
		}else{
			$this->session->set_flashdata($this->error('update',array('pesan' => 'Gagal Simpan Data')));
			redirect(route('admin.publikasi.index'));
		}
    }

    public function datatable(){
		if(!$this->input->is_ajax_request()){
            show_404();
        }
		$list = $this->publikasi->get_data();
		$data = array();
		$no = $_GET['start'];
		foreach ($list as $publikasi) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $publikasi->publikasi_judul;
			$row[] = $publikasi->publikasi_penulis;
			$row[] = $publikasi->publikasi_tahun;
			if($publikasi->publikasi_semester == 1){
				$row[] = 'Gasal';
			}else{
				$row[] = 'Genap';
			}
			if(isset($publikasi->publikasi_file)){
				$file = '<button type="button" class="btn bg-green waves-effect><a href="http://docs.google.com/gview?url='.base_url(upload_path('','files').$publikasi->publikasi_file).'" target="_blank">View</a></button>';
                $row[] = $publikasi->publikasi_file;
            }else{
				$file = '<button type="button" class="btn bg-green waves-effect><a href="#">View</a></button>';;
                $row[] = 'Tidak ada file';
            }
			$row[] = '<a href="'.route("admin.publikasi.edit",['id'=>$publikasi->id]).'" class="btn bg-indigo waves-effect">Edit</a> 
			<button type="button" class="btn bg-red waves-effect hapus" data-id="'.$publikasi->id.'">Hapus</button>'.$file;
			$data[] = $row;
		}

		$output = array('draw' => $_GET['draw'],
						'recordsTotal' => $this->publikasi->count_all(),
						'recordsFiltered' => $this->publikasi->count_filtered(),
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
		return $data;
	}

	private function configUpload($filename){
		$config['upload_path'] = upload_path('','files'); //path folder
		$config['allowed_types'] = 'xls|xlsx|pdf|doc|docx|odt|ods|ppt|pptx|csv'; //type yang dapat diakses bisa anda sesuaikan
		$config['file_name'] = $filename;
		return $config;
	}

}
