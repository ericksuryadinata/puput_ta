<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Carbon\Carbon;
class PengumumanController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->surename = $this->session->userdata('surename');
		$this->email = $this->session->userdata('email');
		$this->load->library(array('upload','image_lib'));
		$this->load->helper(array('text'));
		$this->load->model(array('PengumumanModel'=>'pengumuman'));
		$this->page->sebar('ctrl',$this);
	}
	
	public function index(){
		$data['csrf'] = $this->getCsrf();
		$data['active_pengumuman'] = 'active';
		echo $this->page->tampil('admin.pengumuman.index',$data);
	}

	public function create(){
		$data['active_pengumuman'] = 'active';
		echo $this->page->tampil('admin.pengumuman.create',$data);
    }

    public function edit($id){
		$id_post = array('id' => $id);
		$data['active_pengumuman'] = 'active';
		$data['pengumuman'] = $this->pengumuman->search($id_post)->first_row();
		echo $this->page->tampil('admin.pengumuman.edit',$data);
    }

    public function delete(){
        if(!$this->input->is_ajax_request()){
            show_404();
        }
        $id = $this->input->post('id');
		$id_post = array('id' => $id);
		$post = $this->pengumuman->search($id_post)->first_row();
        if($this->pengumuman->delete($id_post) != false){
			$this->removeFile($post->pengumuman_gambar,$this->imageSize('delete'));
            echo json_encode($this->success('delete',array('pesan' => 'Berhasil hapus data')));
        }else{
            echo json_encode($this->error('delete',array('pesan' => 'Gagal hapus data')));
        }
    }

    public function save(){
		$judul_pengumuman = $this->security->xss_clean($this->input->post('judul_pengumuman'));
		$isi_pengumuman = $this->security->xss_clean($this->input->post('isi_pengumuman'));
		$gambar = $this->security->xss_clean($this->input->post('gambar_pengumuman'));
		$slug = slug($judul_pengumuman);
		
		$filename = 'PENGUMUMAN_'.seo($judul_pengumuman).'_'.date('Ymdhis');
		$this->upload->initialize($this->configUpload($filename));

        if(!empty($_FILES['gambar_pengumuman']['name'])){
            if ($this->upload->do_upload('gambar_pengumuman')){
				$gbr = $this->upload->data();
				$this->uploadResize($gbr,$this->imageSize('resize'));
                $gambar = $gbr['file_name'];
            }else{
				$this->session->set_flashdata($this->error('save',array('pesan' => 'Gagal Simpan Data, '.$this->upload->display_errors())));
				redirect(route('admin.pengumuman.index'));
			}
                      
        }else{
			$gambar = '';
        }

        $data = array(
			'pengumuman_judul' => $judul_pengumuman,
			'pengumuman_isi' => $isi_pengumuman,
			'pengumuman_slug' => $slug,
			'pengumuman_gambar' => $gambar,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'created_by' => $this->session->userdata('userid'),
            'updated_by' => $this->session->userdata('userid'),
        );

        if($this->pengumuman->save($data)){
			$this->session->set_flashdata($this->success('save',array('pesan' => 'Berhasil Simpan Data')));
			redirect(route('admin.pengumuman.index'));
		}else{
			$this->session->set_flashdata($this->error('save',array('pesan' => 'Gagal Simpan Data')));
			redirect(route('admin.pengumuman.index'));
		}
    }

    public function update(){
        $judul_pengumuman = $this->security->xss_clean($this->input->post('judul_pengumuman'));
		$isi_pengumuman = $this->security->xss_clean($this->input->post('isi_pengumuman'));
		$gambar = $this->security->xss_clean($this->input->post('gambar_pengumuman'));
		$slug = slug($judul_pengumuman);
		
		$id = $this->security->xss_clean($this->input->post('id'));
        $id_post = array('id' => $id);
		
		// take the image name first we will need this for removing file
        $post = $this->pengumuman->search($id_post)->first_row();
		$post_gambar = $post->pengumuman_gambar;
		
        $filename = 'PENGUMUMAN_'.seo($judul_pengumuman).'_'.date('Ymdhis');
		$this->upload->initialize($this->configUpload($filename));

        if(!empty($_FILES['gambar_pengumuman']['name'])){
            if ($this->upload->do_upload('gambar_pengumuman')){
				$gbr = $this->upload->data();
                $this->uploadResize($gbr,$this->imageSize('resize'));
                $gambar = $gbr['file_name'];
            }else{
				$this->session->set_flashdata($this->error('save',array('pesan' => 'Gagal Simpan Data, '.$this->upload->display_errors())));
				redirect(route('admin.settings.link.index'));
			}
                      
        }else{
			$gambar = '';
        }

        $data = array(
			'pengumuman_judul' => $judul_pengumuman,
			'pengumuman_isi' => $isi_pengumuman,
			'pengumuman_slug' => $slug,
			'pengumuman_gambar' => $gambar,
            'updated_at' => Carbon::now(),
            'updated_by' => $this->session->userdata('userid'),
        );


        if($this->pengumuman->update($data,$id_post)){
			$this->removeFile($post_gambar,$this->imageSize('delete'));
			$this->session->set_flashdata($this->success('update',array('pesan' => 'Berhasil Simpan Data')));
			redirect(route('admin.pengumuman.index'));
		}else{
			$this->session->set_flashdata($this->error('update',array('pesan' => 'Gagal Simpan Data')));
			redirect(route('admin.pengumuman.index'));
		}
    }

    public function datatable(){
		if(!$this->input->is_ajax_request()){
            show_404();
        }
		$list = $this->pengumuman->get_data();
		$data = array();
		$no = $_GET['start'];
		foreach ($list as $pengumuman) {
			$no++;
			$row = array();
			$row[] = $no;
			if(isset($pengumuman->pengumuman_gambar)){
                $row[] = '<img src="'.base_url(upload_path('pengumuman','original').$pengumuman->pengumuman_gambar).'" height="75" width="75" style="object-fit:contain">';
            }else{
                $row[] = '<img src="'.base_url(default_image_for('untag')).'" height="75" width="75" style="object-fit:contain">';
            }
			$row[] = $pengumuman->pengumuman_judul;
			$row[] = word_limiter($pengumuman->pengumuman_isi,10);
			$row[] = $pengumuman->pengumuman_views;
			$row[] = '<a href="'.route("admin.pengumuman.edit",['id'=>$pengumuman->id]).'" class="btn bg-indigo waves-effect">Edit</a> 
			<button type="button" class="btn bg-red waves-effect hapus" data-id="'.$pengumuman->id.'">Hapus</button>';
			$data[] = $row;
		}

		$output = array('draw' => $_GET['draw'],
						'recordsTotal' => $this->pengumuman->count_all(),
						'recordsFiltered' => $this->pengumuman->count_filtered(),
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

	private function imageSize($condition){
		if($condition === 'resize'){
			$sizes = array(
				'mobile' => array(75,75),
				'thumb' => array(300,200),
				'medium' => array(500,270),
				'large' => array(720,480),
				'extra' => array(900,675)
			);	
		}else{
			$sizes = array(
				'original',
				'mobile',
				'thumb',
				'medium',
				'large',
				'extra'
			);	
		}

		return $sizes;
	}

	private function configUpload($filename){
		$config['upload_path'] = upload_path('pengumuman','original'); //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['file_name'] = $filename;
		return $config;
	}
	
	private function uploadResize($gambar, $sizes){
		foreach($sizes as $key => $value){
			$config = array(
				'image_library' => 'gd2',
				'source_image' => upload_path('pengumuman','original').$gambar['file_name'],
				'new_image' => upload_path('pengumuman').$key.'/'.$gambar['file_name'],
				'maintain_ratio' => TRUE,
				'width' => $value[0],
				'height' => $value[1],
			);
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			$this->image_lib->clear();
		}
	}

	private function removeFile($gambar,$sizes){
		foreach($sizes as $key){
			remove_file(upload_path('pengumuman').$key.'/'.$gambar);
		}
	}

}
