<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HasilkaryaController extends CI_Controller {

	public function index(){
		echo $this->page->tampil('admin.hasil-karya.index');
	}

}
