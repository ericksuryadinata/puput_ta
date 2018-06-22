<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Carbon\Carbon;

class AdminUserController extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model(array('AdminUserModel' => 'administrator'));
		$this->surename = $this->session->userdata('surename');
        $this->email = $this->session->userdata('email');
		$this->page->sebar('ctrl',$this);
    }
    
    public function index(){
        $data['csrf'] = $this->getCsrf();
        $data['active_settings'] = 'active';
        $data['active_settings_administrator'] = 'active';
        echo $this->page->tampil('admin.settings.administrator.index',$data);
    }

    public function create(){
        $data['active_settings'] = 'active';
        $data['active_settings_administrator'] = 'active';
        echo $this->page->tampil('admin.settings.administrator.create',$data);
    }

    public function edit($id){
        $id_administrator = array('id' => $id);
        $data['active_settings'] = 'active';
        $data['active_settings_administrator'] = 'active';
		$data['administrator'] = $this->site_auth->search_user($id_administrator);
		echo $this->page->tampil('admin.settings.administrator.edit',$data);
    }

    public function delete(){
        if(!$this->input->is_ajax_request()){
            show_404();
        }
        $total = $this->administrator->total();
        if($total <= 2){
            echo json_encode($this->error('delete',array('pesan' => 'Gagal hapus data, admin harus lebih dari 2')));
        }else{

            $id = $this->input->post('id');
            $id_administrator = array('id' => $id);
            if($this->site_auth->delete_user($id_administrator) != FALSE){
                echo json_encode($this->success('delete',array('pesan' => 'Berhasil hapus data')));
            }else{
                echo json_encode($this->error('delete',array('pesan' => 'Gagal hapus data')));
            }
        }
    }

    public function aktifkan(){
        if(!$this->input->is_ajax_request()){
            show_404();
        }
        $id = $this->input->post('id');
        $aktif = $this->input->post('aktif');
        $id_administrator = array('id' => $id);
        if($aktif === 'true'){
            $pesan = 'aktifkan';
            $status = array('active' => 1);
        }else{
            $pesan = 'non aktifkan';
            $status = array('active' => 0);
        }
        $total = $this->administrator->total();
        if($total <= 2){
            echo json_encode($this->error('delete',array('pesan' => 'Gagal '.$pesan.' administrator, admin harus lebih dari 2 untuk '.$pesan.'administrator')));
        }else{
            if($this->administrator->update($status,$id_administrator)){
                echo json_encode($this->success('update',array('pesan' => 'Berhasil '.$pesan.' administrator')));
            }else{
                echo json_encode($this->error('update',array('pesan' => 'Gagal '.$pesan.' administrator')));
            }
        }

    }

    public function save(){
        $firstname = $this->security->xss_clean($this->input->post('firstname'));
        $lastname = $this->security->xss_clean($this->input->post('lastname'));
        $identity = $this->security->xss_clean($this->input->post('username'));
        $email = $this->security->xss_clean($this->input->post('email'));
        $password = $this->security->xss_clean($this->input->post('password'));

        $additional_data = array(
            'first_name' => $firstname,
            'last_name' => $lastname,
        );

        if($this->site_auth->create_user($identity, $password, $email, $additional_data)){
			$this->session->set_flashdata($this->success('save',array('pesan' => 'Berhasil Simpan Data ')));
			redirect(route('admin.settings.administrator.index'));
		}else{
			$this->session->set_flashdata($this->error('save',array('pesan' => 'Gagal Simpan Data ')));
			redirect(route('admin.settings.administrator.index'));
		}
    }

    public function update(){
        $firstname = $this->security->xss_clean($this->input->post('firstname'));
        $lastname = $this->security->xss_clean($this->input->post('lastname'));
        $identity = $this->security->xss_clean($this->input->post('username'));
        $email = $this->security->xss_clean($this->input->post('email'));
        $password = $this->security->xss_clean($this->input->post('password'));
        
        $id = array(
            'id' => $this->security->xss_clean($this->input->post('id'))
        );

        $additional_data = array(
            'first_name' => $firstname,
            'last_name' => $lastname,
        );

        if($this->site_auth->update_user($id, $identity, $password, $email, $additional_data)){
			$this->session->set_flashdata($this->success('update',array('pesan' => 'Berhasil Update Data')));
			redirect(route('admin.settings.administrator.index'));
		}else{
			$this->session->set_flashdata($this->error('update',array('pesan' => 'Gagal Update Data')));
			redirect(route('admin.settings.administrator.index'));
		}
    }
    
    public function datatable(){
        if(!$this->input->is_ajax_request()){
            show_404();
        }
		$list = $this->administrator->get_data();
		$data = array();
		$no = $_GET['start'];
		foreach ($list as $admin) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $admin->username;
            $row[] = $admin->email;
            if($admin->active == 0 ){
                $row[] = 'Tidak Aktif';
                $row[] = '<button type="button" class="btn bg-indigo waves-effect aktifkan" data-id="'.$admin->id.'" data-action="aktif">Aktifkan</button> 
                <a href="'.route("admin.settings.administrator.edit",['id'=>$admin->id]).'" class="btn bg-indigo waves-effect">Edit</a> 
                <button type="button" class="btn bg-red waves-effect hapus" data-id="'.$admin->id.'">Hapus</button>';
            }else{
                $row[] = 'Aktif';
                $row[] = '<button type="button" class="btn bg-grey waves-effect aktifkan" data-id="'.$admin->id.'" data-action="non aktif">Non Aktifkan</button> 
                <a href="'.route("admin.settings.administrator.edit",['id'=>$admin->id]).'" class="btn bg-indigo waves-effect">Edit</a> 
                <button type="button" class="btn bg-red waves-effect hapus" data-id="'.$admin->id.'">Hapus</button>';
            }
			$data[] = $row;
		}

		$output = array('draw' => $_GET['draw'],
						'recordsTotal' => $this->administrator->count_all(),
						'recordsFiltered' => $this->administrator->count_filtered(),
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

}