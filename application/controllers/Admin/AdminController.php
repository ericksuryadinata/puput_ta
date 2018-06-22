<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(array('DashboardModel' => 'dashboard'));
		$this->load->helper(array('text'));
		$this->surename = $this->session->userdata('surename');
		$this->email = $this->session->userdata('email');
		$this->page->sebar('ctrl',$this);
	}
	
	public function index(){
		$data['csrf'] = $this->getCsrf();
		$data['active_dashboard'] = 'active';
		echo $this->page->tampil('admin.dashboard.index',$data);
	}

	public function log(){
		if(!$this->input->is_ajax_request()){
            show_404();
        }
		$list = $this->dashboard->get_data();
		$data = array();
		$no = $_GET['start'];
		foreach ($list as $dashboard) {
			$row = array();
			$requested = '';
			if($dashboard->requested_url == '/'){
				$requested = 'halaman awal';
			}else{
				if(strpos($dashboard->requested_url,'datatables') === FALSE){
					$explode = explode('/',$dashboard->requested_url);
					foreach($explode as $key => $string){
						if($key == 0){
							$requested .= $string;
						}else{
							$requested .= $string.', ';
						}
					}
				}else{
					$requested = preg_replace('/([^\s]{22})/', '$1<wbr>', $dashboard->requested_url);
				}
			}

			if(isset($dashboard->referer_page) && $dashboard->referer_page !== ''){
				$message = $dashboard->ip_address.' baru saja mengunjungi '.$requested.' dengan '.$dashboard->user_agent.' dari '.$dashboard->referer_page;
			}else{
				$message = $dashboard->ip_address.' baru saja mengunjungi '.$requested.' dengan '.$dashboard->user_agent;
			}
			$row[] = $message;
			$row[] = $dashboard->access_date;
			$data[] = $row;
		}

		$output = array('draw' => $_GET['draw'],
						'recordsTotal' => $this->dashboard->count_all(),
						'recordsFiltered' => $this->dashboard->count_filtered(),
						'data' => $data
						);
		echo json_encode($output);
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
