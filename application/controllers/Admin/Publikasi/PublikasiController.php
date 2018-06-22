<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Carbon\Carbon;

class BeritaController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->surename = $this->session->userdata('surename');
		$this->email = $this->session->userdata('email');
		$this->load->library(array('upload','image_lib'));
		$this->load->helper(array('text'));
        $this->load->model(array('PostBeritaModel'=>'postberita','KategoriBeritaModel'=>'kategoriberita'));
		$this->page->sebar('ctrl',$this);
	}
	
	public function index(){
        $data['csrf'] = $this->getCsrf();
		$data['active_berita'] = 'active';
		$data['active_berita_post'] = 'active';
		echo $this->page->tampil('admin.berita.post.index',$data);
    }

    public function create(){
		$data['active_berita'] = 'active';
		$data['active_berita_post'] = 'active';
		$data['kategori'] = $this->kategoriberita->all()->result();
		echo $this->page->tampil('admin.berita.post.create',$data);
    }

    public function edit($id){
        $id_post = array('id' => $id);
        $data['active_berita'] = 'active';
		$data['active_berita_post'] = 'active';
		$data['kategori'] = $this->kategoriberita->all()->result();
		$data['post'] = $this->postberita->search($id_post)->first_row();
		echo $this->page->tampil('admin.berita.post.edit',$data);
    }

    public function delete(){
        if(!$this->input->is_ajax_request()){
            show_404();
        }
        $id = $this->input->post('id');
		$id_post = array('id' => $id);
		$post = $this->postberita->search($id_post)->first_row();
        if($this->postberita->delete($id_post) != false){
			$this->removeFile($post->berita_gambar,$this->imageSize('delete'));
            echo json_encode($this->success('delete',array('pesan' => 'Berhasil hapus data')));
        }else{
            echo json_encode($this->error('delete',array('pesan' => 'Gagal hapus data')));
        }
    }

    public function save(){
		$judul_berita = $this->security->xss_clean($this->input->post('judul_berita'));
		$isi_berita = $this->security->xss_clean($this->input->post('isi_berita'));
		$kategori = $this->security->xss_clean($this->input->post('kategori'));
		$gambar = $this->security->xss_clean($this->input->post('gambar_berita'));
		$slug = slug($judul_berita);
		
		$filename = 'BERITA_'.seo($judul_berita).'_'.date('Ymdhis');
		$this->upload->initialize($this->configUpload($filename));

        if(!empty($_FILES['gambar_berita']['name'])){
            if ($this->upload->do_upload('gambar_berita')){
				$gbr = $this->upload->data();
				$this->uploadResize($gbr,$this->imageSize('resize'));
                $gambar = $gbr['file_name'];
            }else{
				$this->session->set_flashdata($this->error('save',array('pesan' => 'Gagal Simpan Data, '.$this->upload->display_errors())));
				redirect(route('admin.berita.post.index'));
			}
                      
        }else{
			$gambar = '';
        }

        $data = array(
			'berita_judul' => $judul_berita,
			'berita_isi' => $isi_berita,
			'berita_slug' => $slug,
			'berita_gambar' => $gambar,
			'berita_kategori_id' => $kategori,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'created_by' => $this->session->userdata('userid'),
            'updated_by' => $this->session->userdata('userid'),
        );

        if($this->postberita->save($data)){
			$this->session->set_flashdata($this->success('save',array('pesan' => 'Berhasil Simpan Data')));
			redirect(route('admin.berita.post.index'));
		}else{
			$this->session->set_flashdata($this->error('save',array('pesan' => 'Gagal Simpan Data')));
			redirect(route('admin.berita.post.index'));
		}
    }

    public function update(){
        $judul_berita = $this->security->xss_clean($this->input->post('judul_berita'));
		$isi_berita = $this->security->xss_clean($this->input->post('isi_berita'));
		$kategori = $this->security->xss_clean($this->input->post('kategori'));
		$gambar = $this->security->xss_clean($this->input->post('gambar_berita'));
		$slug = slug($judul_berita);
		
		$id = $this->security->xss_clean($this->input->post('id'));
        $id_post = array('id' => $id);
		
		// take the image name first we will need this for removing file
        $post = $this->postberita->search($id_post)->first_row();
		$post_gambar = $post->berita_gambar;
		
        $filename = 'BERITA_'.seo($judul_berita).'_'.date('Ymdhis');
		$this->upload->initialize($this->configUpload($filename));

        if(!empty($_FILES['gambar_berita']['name'])){
            if ($this->upload->do_upload('gambar_berita')){
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
			'berita_judul' => $judul_berita,
			'berita_isi' => $isi_berita,
			'berita_slug' => $slug,
			'berita_gambar' => $gambar,
			'berita_kategori_id' => $kategori,
            'updated_at' => Carbon::now(),
            'updated_by' => $this->session->userdata('userid'),
        );


        if($this->postberita->update($data,$id_post)){
			$this->removeFile($post_gambar,$this->imageSize('delete'));
			$this->session->set_flashdata($this->success('update',array('pesan' => 'Berhasil Simpan Data')));
			redirect(route('admin.berita.post.index'));
		}else{
			$this->session->set_flashdata($this->error('update',array('pesan' => 'Gagal Simpan Data')));
			redirect(route('admin.berita.post.index'));
		}
    }

    public function datatable(){
		if(!$this->input->is_ajax_request()){
            show_404();
        }
		$list = $this->postberita->get_data();
		$data = array();
		$no = $_GET['start'];
		foreach ($list as $postberita) {
			$no++;
			$row = array();
			$row[] = $no;
			if(isset($postberita->berita_gambar)){
                $row[] = '<img src="'.base_url(upload_path('berita','original').$postberita->berita_gambar).'" height="75" width="75" style="object-fit:contain">';
            }else{
                $row[] = '<img src="'.base_url(default_image_for('untag')).'" height="75" width="75" style="object-fit:contain">';
            }
			$row[] = $postberita->berita_judul;
			$row[] = word_limiter($postberita->berita_isi,10);
			if(isset($postberita->berita_kategori_id)){
				$kategori = $this->kategoriberita->search(array('id'=>$postberita->berita_kategori_id))->first_row();
				$row[] = $kategori->nama_kategori;
			}
			$row[] = $postberita->berita_views;
			$row[] = '<a href="'.route("admin.berita.post.edit",['id'=>$postberita->id]).'" class="btn bg-indigo waves-effect">Edit</a> 
			<button type="button" class="btn bg-red waves-effect hapus" data-id="'.$postberita->id.'">Hapus</button>';
			$data[] = $row;
		}

		$output = array('draw' => $_GET['draw'],
						'recordsTotal' => $this->postberita->count_all(),
						'recordsFiltered' => $this->postberita->count_filtered(),
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
				'thumb' => array(300,250),
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
		$config['upload_path'] = upload_path('file'); //path folder
		$config['allowed_types'] = 'xls|xlsx|pdf|doc|docx|odt|ods|ppt|pptx|csv'; //type yang dapat diakses bisa anda sesuaikan
		$config['file_name'] = $filename;
		return $config;
	}

}
