<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KerjasamaController extends CI_Controller {

	public function index(){
		echo $this->page->tampil('admin.kerja-sama.index');
	}

}
