<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Carbon\Carbon;

class AkademikController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('AkademikModel','akademik');
		$this->surename = $this->session->userdata('surename');
		$this->email = $this->session->userdata('email');
		$this->page->sebar('ctrl',$this);
	}

	/** Kurikulum Section */
	public function kurikulum(){
		$data['active_akademik'] = 'active';
		$data['active_akademik_kurikulum'] = 'active';
		$data['kurikulum'] = $this->akademik->loadDataSection('kurikulum')->result();
		echo $this->page->tampil('admin.akademik.kurikulum.index',$data);
	}

	public function uploadKurikulum(){
		$kurikulum = $this->akademik->loadDataSection('kurikulum')->result();

		if(count($kurikulum) == 0){
			$data = array(
				'section' => 'kurikulum',
				'judul' => $this->input->post('judul'),
				'content' => htmlentities($this->input->post('content')),
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
				'created_by'=> $this->session->userdata('userid'),
				'updated_by'=> $this->session->userdata('userid')
			);
			$this->akademik->saveData($data);
		}else{
			$data = array(
				'section' => 'kurikulum',
				'judul' => $this->input->post('judul'),
				'content' => htmlentities($this->input->post('content')),
				'updated_at' => Carbon::now(),
				'updated_by'=> $this->session->userdata('userid')
			);
			$where = array('id'=>$kurikulum[0]->id);
			$this->akademik->updateData($data,$where);
		}
		
		redirect(route('admin.akademik.kurikulum'));
	}

	/** End Kurikulum Section */

}
