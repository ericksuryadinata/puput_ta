<?php

/**
 * Middleware untuk shared object dari website
 */

class WebsiteMiddleware{

    public function __construct(){
        $this->ci =& get_instance();
        $this->ci->load->database();
        $this->ci->load->model(array('LinkPartnerModel'=>'partner','PengumumanModel'=>'pengumuman','PostBeritaModel'=>'postberita'));
        $this->ci->load->library(array('page'));
    }

    public function run(){
        $this->partner_aktif = $this->ci->partner->aktif()->result();
        $this->pengumuman = $this->ci->pengumuman->newest(5)->result();
        $this->post_berita = $this->ci->postberita->newest(5)->result();
		$this->ci->page->sebar('ctrl',$this);
    }
}