<?php

class BeritaController extends CI_Controller{
    
    public function index(){
		echo $this->page->tampil('website.landing-page.berita.index');
    }
}