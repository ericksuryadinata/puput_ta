<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {

	public function index(){
		echo $this->page->tampil('website.landing-page.home.index');
	}

	public function hubungi_kami(){
		echo $this->page->tampil('website.landing-page.hubungi-kami.index');
	}

}
