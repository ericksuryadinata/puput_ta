<?php

/**
 * Middleware untuk shared object dari website
 */

class WebsiteMiddleware{

    public function __construct(){
        $this->ci =& get_instance();
        $this->ci->load->database();
        $this->ci->load->model('LinkPartnerModel','partner');
        $this->ci->load->library('page');
    }

    public function run(){
        $this->partner_aktif = $this->ci->partner->aktif()->result();
		$this->ci->page->sebar('ctrl',$this);
    }
}