<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfilController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('ProfilModel','profil');
	}

	public function sejarah(){
		$data['content'] = 'sejarah';
		$data['sejarah'] = $this->profil->loadDataSection('sejarah')->result();
		echo $this->page->tampil('website.landing-page.profil.index',$data);
	}

	public function visi_misi(){
		$data['content'] = 'visi-misi';
		$data['visi_misi'] = $this->profil->loadDataSection('visi-misi')->result();
		echo $this->page->tampil('website.landing-page.profil.index',$data);
	}

	public function fasilitas(){
		$data['content'] = 'fasilitas';
		$data['fasilitas'] = $this->profil->loadDataSection('fasilitas')->result();
		echo $this->page->tampil('website.landing-page.profil.index',$data);
	}

}
