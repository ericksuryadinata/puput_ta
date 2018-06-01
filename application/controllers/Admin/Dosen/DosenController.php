<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DosenController extends CI_Controller {

	public function index(){
		echo $this->page->tampil('admin.dosen.index');
	}

}
