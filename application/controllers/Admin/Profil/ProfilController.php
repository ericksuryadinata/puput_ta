<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfilController extends CI_Controller {

	public function sejarah(){
		echo $this->page->tampil('admin.profil.sejarah');
  }
    
  public function visi_misi(){
		echo $this->page->tampil('admin.profil.visi-misi');
  }
    
  public function fasilitas(){
		echo $this->page->tampil('admin.profil.fasilitas');
	}

}
