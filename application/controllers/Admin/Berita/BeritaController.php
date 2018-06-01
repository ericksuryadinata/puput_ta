<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BeritaController extends CI_Controller {

	public function index(){
		echo $this->page->tampil('admin.berita.index');
	}

}
