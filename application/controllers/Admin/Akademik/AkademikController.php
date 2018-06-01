<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AkademikController extends CI_Controller {

	public function kurikulum(){
		echo $this->page->tampil('admin.akademik.kurikulum.index');
	}

}
