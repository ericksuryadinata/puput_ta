<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AkademikController extends CI_Controller {

	public function kurikulum(){
		$data['content'] = 'kurikulum';
		echo $this->page->tampil('website.landing-page.akademik.index',$data);
	}

}
