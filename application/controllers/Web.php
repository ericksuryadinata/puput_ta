<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

	public function index()
	{
		echo $this->page->tampil('website.landing-page.home.index');
	}

	public function hubungi_kami(){
		echo $this->page->tampil('website.landing-page.hubungi-kami.index');
	}

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

	public function kurikulum(){
		$data['content'] = 'kurikulum';
		echo $this->page->tampil('website.landing-page.akademik.index',$data);
	}

	public function publikasi(){
		echo $this->page->tampil('website.landing-page.publikasi.index');
	}

}
