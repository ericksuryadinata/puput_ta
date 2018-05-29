<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfilController extends CI_Controller {

	public function sejarah(){
		$data['content'] = 'sejarah';
		echo $this->page->tampil('website.landing-page.profil.index',$data);
	}

	public function visi_misi(){
		$data['content'] = 'visi-misi';
		echo $this->page->tampil('website.landing-page.profil.index',$data);
	}

	public function fasilitas(){
		$data['content'] = 'fasilitas';
		echo $this->page->tampil('website.landing-page.profil.index',$data);
	}

}
