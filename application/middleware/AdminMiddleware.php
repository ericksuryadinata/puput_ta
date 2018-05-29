<?php

class AdminMiddleware{
    
    public function __construct(){
        $this->ci =& get_instance();
        $this->ci->load->library('session');
    }
    public function run(){
        if($this->ci->session->userdata('role') !== 'admin'){
            redirect(route('admin.auth.index'));
        }
    }
    
}