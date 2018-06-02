<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SettingsController extends CI_Controller {

	public function index(){
		echo $this->page->tampil('admin.settings.index');
	}

}
