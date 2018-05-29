<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KerjaSamaController extends CI_Controller {

	public function index(){
		echo $this->page->tampil('website.landing-page.kerja-sama.index');
	}

}
