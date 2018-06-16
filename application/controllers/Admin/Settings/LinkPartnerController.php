<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Carbon\Carbon;

class LinkPartnerController extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->surename = $this->session->userdata('surename');
        $this->email = $this->session->userdata('email');
        $this->load->model('LinkPartnerModel','partner');
        $this->load->library(array('upload'));
		$this->page->sebar('ctrl',$this);
    }
    
    public function index(){
        $data['csrf'] = $this->getCsrf();
        $data['active_settings'] = 'active';
        $data['active_settings_link'] = 'active';
        echo $this->page->tampil('admin.settings.link-partner.index',$data);
    }

    public function create(){
        $data['active_settings'] = 'active';
        $data['active_settings_link'] = 'active';
        echo $this->page->tampil('admin.settings.link-partner.create',$data);
    }

    public function edit($id){
        $id_partner = array('id' => $id);
        $data['active_settings'] = 'active';
        $data['active_settings_link'] = 'active';
		$data['partner'] = $this->partner->search($id_partner)->first_row();
		echo $this->page->tampil('admin.settings.link-partner.edit',$data);
    }

    public function delete(){
        if(!$this->input->is_ajax_request()){
            show_404();
        }
        $id = $this->input->post('id');
        $id_partner = array('id' => $id);
        $partner = $this->partner->search($id_partner)->first_row();
        if($this->partner->delete($id_partner) != false){
            remove_file(upload_path('partner').$partner->partner_gambar);
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
        $id_partner = array('id' => $id);
        if($aktif === 'true'){
            $pesan = 'aktifkan';
            $status = array('partner_aktif' => 1);
        }else{
            $pesan = 'non aktifkan';
            $status = array('partner_aktif' => 0);
        }

        if($this->partner->update($status,$id_partner)){
            echo json_encode($this->success('update',array('pesan' => 'Berhasil '.$pesan.' link partner')));
        }else{
            echo json_encode($this->error('update',array('pesan' => 'Gagal '.$pesan.' link partner')));
        }

    }

    public function save(){
        $nama_partner = $this->security->xss_clean($this->input->post('nama_partner'));
        $link_partner = $this->security->xss_clean($this->input->post('link_partner'));
        $gambar = $this->security->xss_clean($this->input->post('partner_gambar'));
        
        $filename = 'PARTNER_'.seo($nama_partner).'_'.date('Ymdhis');
		$this->upload->initialize($this->configUpload($filename));

        if(!empty($_FILES['partner_gambar']['name'])){
            if ($this->upload->do_upload('partner_gambar')){
				$gbr = $this->upload->data();
                //Compress Image
                $this->load->library('image_lib', $this->configResize($gbr));
                $this->image_lib->resize();
 
                $gambar = $gbr['file_name'];
            }else{
				$this->session->set_flashdata($this->error('save',array('pesan' => 'Gagal Simpan Data, '.$this->upload->display_errors())));
				redirect(route('admin.settings.link.index'));
			}
                      
        }else{
			$gambar = '';
        }

        $data = array(
            'partner_nama' => $nama_partner,
            'partner_link' => $link_partner,
            'partner_gambar' => $gambar,
            'partner_aktif' => 1,
            'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
			'created_by' => $this->session->userdata('userid'),
			'updated_by' => $this->session->userdata('userid'),
        );

        if($this->partner->save($data)){
			$this->session->set_flashdata($this->success('save',array('pesan' => 'Berhasil Simpan Data')));
			redirect(route('admin.settings.link.index'));
		}else{
			$this->session->set_flashdata($this->error('save',array('pesan' => 'Gagal Simpan Data')));
			redirect(route('admin.settings.link.index'));
		}
    }

    public function update(){
        $nama_partner = $this->security->xss_clean($this->input->post('nama_partner'));
        $link_partner = $this->security->xss_clean($this->input->post('link_partner'));
        $gambar = $this->security->xss_clean($this->input->post('partner_gambar'));
        $id = $this->security->xss_clean($this->input->post('id'));

        // take the image name first we will need this for removing file
        $id_partner = array('id' => $id);
        $partner = $this->partner->search($id_partner)->first_row();
        $partner_gambar = $partner->partner_gambar;
        
        $filename = 'PARTNER_'.seo($nama_partner).'_'.date('Ymdhis');
		$this->upload->initialize($this->configUpload($filename));

        if(!empty($_FILES['partner_gambar']['name'])){
            if ($this->upload->do_upload('partner_gambar')){
				$gbr = $this->upload->data();
                //Compress Image
                $this->load->library('image_lib', $this->configResize($gbr));
                $this->image_lib->resize();
 
                $gambar = $gbr['file_name'];
            }else{
				$this->session->set_flashdata($this->error('save',array('pesan' => 'Gagal Simpan Data, '.$this->upload->display_errors())));
				redirect(route('admin.settings.link.index'));
			}
                      
        }else{
			$gambar = '';
        }

        $data = array(
            'partner_nama' => $nama_partner,
            'partner_link' => $link_partner,
            'partner_gambar' => $gambar,
			'updated_at' => Carbon::now(),
			'updated_by' => $this->session->userdata('userid'),
        );

        if($this->partner->update($data,$id_partner)){
            remove_file(upload_path('partner').$partner_gambar);
			$this->session->set_flashdata($this->success('update',array('pesan' => 'Berhasil Update Data')));
			redirect(route('admin.settings.link.index'));
		}else{
            remove_file(upload_path('partner').$gambar);
			$this->session->set_flashdata($this->error('update',array('pesan' => 'Gagal Update Data')));
			redirect(route('admin.settings.link.index'));
		}
    }
    
    public function datatable(){
        if(!$this->input->is_ajax_request()){
            show_404();
        }
		$list = $this->partner->get_data();
		$data = array();
		$no = $_GET['start'];
		foreach ($list as $settings) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $settings->partner_nama;
            $row[] = $settings->partner_link;
            if(isset($settings->partner_gambar)){
                $row[] = '<img src="'.base_url(upload_path('partner').$settings->partner_gambar).'" height="55" width="190" style="object-fit:contain">';
            }else{
                $row[] = '<img src="'.base_url(default_image_for('long-ads')).'" height="55" width="190" style="object-fit:contain">';
            }
            if($settings->partner_aktif == 0 ){
                $row[] = 'Tidak Aktif';
                $row[] = '<button type="button" class="btn bg-indigo waves-effect aktifkan" data-id="'.$settings->id.'" data-action="aktif">Aktifkan</button> 
                <a href="'.route("admin.settings.link.edit",['id'=>$settings->id]).'" class="btn bg-indigo waves-effect">Edit</a> 
                <button type="button" class="btn bg-red waves-effect hapus" data-id="'.$settings->id.'">Hapus</button>';
            }else{
                $row[] = 'Aktif';
                $row[] = '<button type="button" class="btn bg-grey waves-effect aktifkan" data-id="'.$settings->id.'" data-action="non aktif">Non Aktifkan</button> 
                <a href="'.route("admin.settings.link.edit",['id'=>$settings->id]).'" class="btn bg-indigo waves-effect">Edit</a> 
                <button type="button" class="btn bg-red waves-effect hapus" data-id="'.$settings->id.'">Hapus</button>';
            }
			$data[] = $row;
		}

		$output = array('draw' => $_GET['draw'],
						'recordsTotal' => $this->partner->count_all(),
						'recordsFiltered' => $this->partner->count_filtered(),
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
		return $data;
	}

	private function configUpload($filename){
		$config['upload_path'] = upload_path('partner'); //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['file_name'] = $filename;
		return $config;
	}

	private function configResize($gbr){
		$config['image_library']='gd2';
		$config['source_image']= upload_path('partner').$gbr['file_name'];
		$config['maintain_ratio']= TRUE;
		$config['width']= 190;
		$config['height']= 55;
		$config['new_image']= upload_path('partner').$gbr['file_name'];
		return $config;
    }

}