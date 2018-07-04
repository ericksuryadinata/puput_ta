<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Carbon\Carbon;
class InboxController extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->surename = $this->session->userdata('surename');
		$this->email = $this->session->userdata('email');
        $this->load->model('InboxModel','inbox');
        $this->load->helper(array('text'));
		$this->page->sebar('ctrl',$this);
    }

    public function index(){
        $data['csrf'] = $this->getCsrf();
        $data['active_inbox'] = 'active';
        echo $this->page->tampil('admin.inbox.index',$data);
    }

    public function datatable(){
		if(!$this->input->is_ajax_request()){
            show_404();
        }
		$list = $this->inbox->get_data();
		$data = array();
		$no = $_GET['start'];
		foreach ($list as $inbox) {
			$no++;
			$row = array();
            $row[] = $no;
            $row[] = $inbox->inbox_nama;
            $row[] = $inbox->inbox_email;
            $row[] = $inbox->inbox_subjek;
            $row[] = word_limiter($inbox->inbox_pesan,10);
            $row[] = '<button type="button" class="btn bg-indigo waves-effect baca" data-id="'.$inbox->id.'">Baca</button>
            <button type="button" class="btn bg-red waves-effect hapus" data-id="'.$inbox->id.'">Hapus</button>';
			$data[] = $row;
		}

        $output = array('draw' => $_GET['draw'],
                        'recordsTotal' => $this->inbox->count_all(),
						'recordsFiltered' => $this->inbox->count_filtered(),
                        'data' => $data
                        );
		echo json_encode($output);
    }
    
    public function read(){
        if(!$this->input->is_ajax_request()){
            show_404();
        }
        $id = $this->input->get('id');
        $where = array('id' => $id);
        $data = $this->inbox->search($where)->result();
        echo json_encode($data);
    }

    public function afterRead(){
        if(!$this->input->is_ajax_request()){
            show_404();
        }
        $id = $this->input->post('id');
        $data = array('inbox_read' => 1,'updated_at' => Carbon::now());
        $where = array('id' => $id);
        $this->inbox->update($data,$where);
        $return['csrf'] = $this->getCsrf();
        $return['status'] = 'success';
        echo json_encode($return);
    }

    /**
	 * Private function for this page only
	 */

	private function getCsrf(){
		return array(
			'name' => $this->security->get_csrf_token_name(),
			'token' => $this->security->get_csrf_hash(),
		);
	}
}