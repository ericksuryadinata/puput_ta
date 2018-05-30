<?php

class AuthMiddleware{

    public function __construct(){
        $this->ci =& get_instance();
        $this->ci->load->library('session');
    }
    public function run(){
        if($this->is_home === TRUE){
            redirect(route('admin.dashboard'));
        }else{
            redirect(route('admin.auth.index'));
        }
    }

    private function is_home(){
        if($this->ci->session->userdata('logged_in') === TRUE) {
            return TRUE;
        }
    }

    private function is_login(){
        if($this->ci->session->userdata('login') === FALSE || empty($this->ci->session->userdata('login'))){
            return FALSE;
        }
    }
    
}