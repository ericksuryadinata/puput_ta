<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
	}

	public function index(){
		if (!$this->ion_auth->logged_in()){
			echo $this->page->tampil('admin.auth.index');
		}else{
			redirect(route('admin.dashboard'));
		}
	}

	public function auth(){

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() === TRUE){
			$remember = 0;
			if($this->input->post('rememberme') !== null){
				$remember = 1;
			}

			if ($this->ion_auth->login($this->input->post('username'), $this->input->post('password'),(bool)$remember))
			{
				$this->set_session();
				redirect(route('admin.dashboard'));
			}
			else
			{
				$data['message'] = 'Data yang dimasukkan tidak sesuai';
				$data['hidden'] = '';
				echo $this->page->tampil('admin.auth.index',$data);
			}
		}else{
			$data['message'] = 'Data yang dimasukkan tidak sesuai';
			$data['hidden'] = '';
			echo $this->page->tampil('admin.auth.index',$data);
		}
	}

	public function logout(){

		$logout = $this->ion_auth->logout();
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect(route('admin.auth.index'));
	}

	private function set_session(){
		$user = $this->ion_auth->user()->row();
		$user_group = $this->ion_auth->get_users_groups()->row();
        if ($this->agent->is_browser())
        {
            $agent = $this->agent->browser().' '.$this->agent->version();
        }
        elseif ($this->agent->is_robot())
        {
            $agent = $this->agent->robot();
        }
        elseif ($this->agent->is_mobile())
        {
            $agent = $this->agent->mobile();
        }
        else
        {
            $agent = 'Unidentified User Agent';
        }              
        $data = array(
            'username' => $user->username,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'surename' => $user->first_name.' '.$user->last_name,
            'email' => $user->email,
            'userid' => $user->id,
            'platform' => $this->agent->platform(),
            'browser' => $agent,
			'login' => true,
			'group' => $user_group->name,
            'log_tanggal' => $user->last_login,
        );
       
        $this->session->set_userdata($data);
    }

}
