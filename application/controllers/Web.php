<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

	public function index(){
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

	/**
	 * Publikasi Section
	 * TODO
	 * Kemungkinan akan pakai datatables serverside, tapi itu kalau datanya banyak
	 */
	public function publikasi(){
		echo $this->page->tampil('website.landing-page.publikasi.index');
	}

	/**
	 * Berita Section
	 */
	public function berita(){
		echo $this->page->tampil('website.landing-page.berita.index');
	}

	/**
	 * Pengumuman Section
	 */
	public function pengumuman(){
		echo $this->page->tampil('website.landing-page.pengumuman.index');
	}

	/**
	 * Kerja Sama Section
	 */
	public function kerja_sama(){
		echo $this->page->tampil('website.landing-page.kerja-sama.index');
	}

	/**
	 * Daftar Dosen
	 * TODO
	 * Kemungkinan ini juga pakai datatables serverside 
	 */
	public function dosen(){
		echo $this->page->tampil('website.landing-page.dosen.index');
	}

}
