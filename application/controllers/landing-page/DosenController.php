<?php

class DosenController extends CI_Controller{
    
    public function index(){
		echo $this->page->tampil('website.landing-page.dosen.index');
    }
}