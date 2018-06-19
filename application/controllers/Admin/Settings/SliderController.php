<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Carbon\Carbon;

class SliderController extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->surename = $this->session->userdata('surename');
        $this->email = $this->session->userdata('email');
        $this->load->model('SliderModel','slider');
        $this->load->library(array('upload'));
		$this->page->sebar('ctrl',$this);
    }
    
    public function index(){
        $data['csrf'] = $this->getCsrf();
        $data['active_settings'] = 'active';
        $data['active_settings_slider'] = 'active';
        echo $this->page->tampil('admin.settings.slider.index',$data);
    }

    public function create(){
        $data['active_settings'] = 'active';
        $data['active_settings_slider'] = 'active';
        echo $this->page->tampil('admin.settings.slider.create',$data);
    }

    public function edit($id){
        $id_slider = array('id' => $id);
        $data['active_settings'] = 'active';
        $data['active_settings_slider'] = 'active';
		$data['slider'] = $this->slider->search($id_slider)->first_row();
		echo $this->page->tampil('admin.settings.slider.edit',$data);
    }

    public function delete(){
        if(!$this->input->is_ajax_request()){
            show_404();
        }
        $id = $this->input->post('id');
        $id_slider = array('id' => $id);
        $slider = $this->slider->search($id_slider)->first_row();
        if($this->slider->delete($id_slider) != false){
            remove_file(upload_path('slider').$slider->slider_gambar);
            echo json_encode($this->success('delete',array('pesan' => 'Berhasil hapus data')));
        }else{
            echo json_encode($this->error('delete',array('pesan' => 'Gagal hapus data')));
        }
    }

    public function aktifkan(){
        if(!$this->input->is_ajax_request()){
            show_404();
        }
        $id = $this->input->post('id');
        $aktif = $this->input->post('aktif');
        $id_slider = array('id' => $id);
        if($aktif === 'true'){
            $pesan = 'aktifkan';
            $status = array('slider_aktif' => 1);
        }else{
            $pesan = 'non aktifkan';
            $status = array('slider_aktif' => 0);
        }

        if($this->slider->update($status,$id_slider)){
            echo json_encode($this->success('update',array('pesan' => 'Berhasil '.$pesan.' slider')));
        }else{
            echo json_encode($this->error('update',array('pesan' => 'Gagal '.$pesan.' slider')));
        }

    }

    public function save(){
        $nama_slider = $this->security->xss_clean($this->input->post('nama_slider'));
        $gambar = $this->security->xss_clean($this->input->post('slider_gambar'));
        
        $filename = 'SLIDER_'.seo($nama_slider).'_'.date('Ymdhis');
		$this->upload->initialize($this->configUpload($filename));

        if(!empty($_FILES['slider_gambar']['name'])){
            if ($this->upload->do_upload('slider_gambar')){
				$gbr = $this->upload->data();
 
                $gambar = $gbr['file_name'];
            }else{
				$this->session->set_flashdata($this->error('save',array('pesan' => 'Gagal Simpan Data, '.$this->upload->display_errors())));
				redirect(route('admin.settings.slider.index'));
			}
                      
        }else{
			$gambar = '';
        }

        $data = array(
            'slider_nama' => $nama_slider,
            'slider_gambar' => $gambar,
            'slider_aktif' => 1,
            'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
			'created_by' => $this->session->userdata('userid'),
			'updated_by' => $this->session->userdata('userid'),
        );

        if($this->slider->save($data)){
			$this->session->set_flashdata($this->success('save',array('pesan' => 'Berhasil Simpan Data')));
			redirect(route('admin.settings.slider.index'));
		}else{
			$this->session->set_flashdata($this->error('save',array('pesan' => 'Gagal Simpan Data')));
			redirect(route('admin.settings.slider.index'));
		}
    }

    public function update(){
        $nama_slider = $this->security->xss_clean($this->input->post('nama_slider'));
        $gambar = $this->security->xss_clean($this->input->post('slider_gambar'));
        $id = $this->security->xss_clean($this->input->post('id'));

        // take the image name first we will need this for removing file
        $id_slider = array('id' => $id);
        $slider = $this->slider->search($id_slider)->first_row();
        $slider_gambar = $slider->slider_gambar;
        
        $filename = 'SLIDER_'.seo($nama_slider).'_'.date('Ymdhis');
		$this->upload->initialize($this->configUpload($filename));

        if(!empty($_FILES['slider_gambar']['name'])){
            if ($this->upload->do_upload('slider_gambar')){
				$gbr = $this->upload->data();
 
                $gambar = $gbr['file_name'];
            }else{
				$this->session->set_flashdata($this->error('save',array('pesan' => 'Gagal Simpan Data, '.$this->upload->display_errors())));
				redirect(route('admin.settings.slider.index'));
			}
                      
        }else{
			$gambar = '';
        }

        $data = array(
            'slider_nama' => $nama_slider,
            'slider_link' => $link_slider,
            'slider_gambar' => $gambar,
			'updated_at' => Carbon::now(),
			'updated_by' => $this->session->userdata('userid'),
        );

        if($this->slider->update($data,$id_slider)){
            remove_file(upload_path('slider').$slider_gambar);
			$this->session->set_flashdata($this->success('update',array('pesan' => 'Berhasil Update Data')));
			redirect(route('admin.settings.slider.index'));
		}else{
            remove_file(upload_path('slider').$gambar);
			$this->session->set_flashdata($this->error('update',array('pesan' => 'Gagal Update Data')));
			redirect(route('admin.settings.slider.index'));
		}
    }
    
    public function datatable(){
        if(!$this->input->is_ajax_request()){
            show_404();
        }
		$list = $this->slider->get_data();
		$data = array();
		$no = $_GET['start'];
		foreach ($list as $settings) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $settings->slider_nama;
            if(isset($settings->slider_gambar)){
                $row[] = '<img src="'.base_url(upload_path('slider').$settings->slider_gambar).'" height="55" width="190" style="object-fit:contain">';
            }else{
                $row[] = '<img src="'.base_url(default_image_for('long-ads')).'" height="55" width="190" style="object-fit:contain">';
            }
            if($settings->slider_aktif == 0 ){
                $row[] = 'Tidak Aktif';
                $row[] = '<button type="button" class="btn bg-indigo waves-effect aktifkan" data-id="'.$settings->id.'" data-action="aktif">Aktifkan</button> 
                <a href="'.route("admin.settings.slider.edit",['id'=>$settings->id]).'" class="btn bg-indigo waves-effect">Edit</a> 
                <button type="button" class="btn bg-red waves-effect hapus" data-id="'.$settings->id.'">Hapus</button>';
            }else{
                $row[] = 'Aktif';
                $row[] = '<button type="button" class="btn bg-grey waves-effect aktifkan" data-id="'.$settings->id.'" data-action="non aktif">Non Aktifkan</button> 
                <a href="'.route("admin.settings.slider.edit",['id'=>$settings->id]).'" class="btn bg-indigo waves-effect">Edit</a> 
                <button type="button" class="btn bg-red waves-effect hapus" data-id="'.$settings->id.'">Hapus</button>';
            }
			$data[] = $row;
		}

		$output = array('draw' => $_GET['draw'],
						'recordsTotal' => $this->slider->count_all(),
						'recordsFiltered' => $this->slider->count_filtered(),
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
		$config['upload_path'] = upload_path('slider'); //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['file_name'] = $filename;
		return $config;
	}

}