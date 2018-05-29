<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PublikasiController extends CI_Controller {

	public function index(){
		echo $this->page->tampil('website.landing-page.publikasi.index');
	}

}
