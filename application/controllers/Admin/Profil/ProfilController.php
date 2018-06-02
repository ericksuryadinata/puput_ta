<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Carbon\Carbon;

class ProfilController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('ProfilModel','profil');
	}
	/** Sejarah Section */
	public function sejarah(){
		$data['active_profil'] = 'active';
		$data['active_profil_sejarah'] = 'active';
		$data['sejarah'] = $this->profil->loadData('sejarah')->result();
		echo $this->page->tampil('admin.profil.sejarah',$data);
	}
	
	public function uploadSejarah(){
		$sejarah = $this->profil->loadData('sejarah')->result();

		if(count($sejarah) == 0){
			$data = array(
				'section' => 'sejarah',
				'content' => htmlentities($this->input->post('content')),
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
				'created_by'=> $this->session->userdata('userid'),
				'updated_by'=> $this->session->userdata('userid')
			);
			$this->profil->saveData($data);
		}else{
			$data = array(
				'section' => 'sejarah',
				'content' => htmlentities($this->input->post('content')),
				'updated_at' => Carbon::now(),
				'updated_by'=> $this->session->userdata('userid')
			);
			$where = array('id'=>$sejarah[0]->id);
			$this->profil->updateData($data,$where);
		}
		
		redirect(route('admin.profil.sejarah'));
	}

	/** End Sejarah Section */

	/** Visi Misi Section */
  	public function visi_misi(){
		$data['active_profil'] = 'active';
		$data['active_profil_visi_misi'] = 'active';
		$data['visi_misi'] = $this->profil->loadData('visi-misi')->result();
		echo $this->page->tampil('admin.profil.visi-misi',$data);
	}

	public function uploadVisiMisi(){
		$visimisi = $this->profil->loadData('visi-misi')->result();

		if(count($visimisi) == 0){
			$data = array(
				'section' => 'visi-misi',
				'content' => htmlentities($this->input->post('content')),
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
				'created_by'=> $this->session->userdata('userid'),
				'updated_by'=> $this->session->userdata('userid')
			);
			$this->profil->saveData($data);
		}else{
			$data = array(
				'section' => 'visi-misi',
				'content' => htmlentities($this->input->post('content')),
				'updated_at' => Carbon::now(),
				'updated_by'=> $this->session->userdata('userid')
			);
			$where = array('id'=>$visimisi[0]->id);
			$this->profil->updateData($data,$where);
		}
		
		redirect(route('admin.profil.visi-misi'));
	}
	/** End Visi Misi Section */
	

	/** Fasilitas Section */
  	public function fasilitas(){
		$data['active_profil'] = 'active';
		$data['active_profil_fasilitas'] = 'active';
		echo $this->page->tampil('admin.profil.fasilitas',$data);
	}

	public function uploadFasilitas(){
		$fasilitas = $this->profil->loadData('fasilitas')->result();

		if(count($fasilitas) == 0){
			$data = array(
				'section' => 'fasilitas',
				'content' => htmlentities($this->input->post('content')),
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
				'created_by'=> $this->session->userdata('userid'),
				'updated_by'=> $this->session->userdata('userid')
			);
			$this->profil->saveData($data);
		}else{
			$data = array(
				'section' => 'fasilitas',
				'content' => htmlentities($this->input->post('content')),
				'updated_at' => Carbon::now(),
				'updated_by'=> $this->session->userdata('userid')
			);
			$where = array('id'=>$fasilitas[0]->id);
			$this->profil->updateData($data,$where);
		}
		
		redirect(route('admin.profil.visi-misi'));
	}

	/** End Fasilitas Section */

}
