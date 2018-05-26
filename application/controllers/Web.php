<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

	public function index()
	{
		echo $this->blade->tampil('website.landing-page.index');
	}

}
