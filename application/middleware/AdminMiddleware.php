<?php

/**
 * Middleware khusus admin
 * Dilakukan pengecekan dahulu sebelum bisa masuk ke dashboard
 */
class AdminMiddleware{

    public function __construct(){
        $this->ci =& get_instance();
        $this->ci->load->library('session');
    }
    
    public function run(){
        if($this->ci->session->userdata('login') == false  || empty($this->ci->session->userdata('login'))){
            redirect(route('admin.auth.index'));
        }

        // saya buat kayak gini, antisipasi adanya group baru
        // kemungkinan jika requirement ada yang baru maka akan menggunakan switch case
        if($this->ci->session->userdata('group') !== 'admin'){
            redirect(route('admin.auth.index'));
        }
    }
    
}