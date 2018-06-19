<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HasilKaryaController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(array('HasilKaryaModel'=>'hasil_karya'));
        $this->load->helper(array('text'));
        $this->load->library(array('pagination'));
	}

    public function index($id = null){
        $perPage = 0;
        $offset = 0;
        if($id == null || !isset($id)){
            $perPage = 4;
            $offset = 0;
        }else{
            $perPage = 4;
            $offset = ($id - 1) * $perPage;
        }
        $totalPost = $this->hasil_karya->totalPost();
        $config = array(
            'base_url' => base_url('hasil-karya/halaman/'),
            'total_rows' => $totalPost,
            'per_page' => $perPage,
            'first_link' => 'First',
			'last_link' => 'Last',
			'next_link' => 'Next >',
			'prev_link' => '< Prev',
			'cur_tag_open' => '<a class="active-page">',
            'cur_tag_close' => '</a>',
            'full_tag_open' => '<div class="pagination"><ul><li>',
            'full_tag_close' => '</li></ul></div>',
            'first_tag_open' => '<a>',
			'first_tag_close' => '</a>',
			'last_tag_open' => '<a>',
			'last_tag_close' => '</a>',
			'num_links'		=> round($totalPost/$perPage),
            'use_page_numbers' => TRUE,
        );
        $this->pagination->initialize($config);

        $data['page'] = $this->pagination->create_links();
        $data['post'] = $this->hasil_karya->all($perPage,$offset)->result();
        echo $this->page->tampil('website.landing-page.hasil-karya.index',$data);
    }

    public function detail($slug){
        $hasil_karya_slug = array('hasil_karya_slug' => $slug);
        $hasil_karya = $this->hasil_karya->search($hasil_karya_slug)->first_row();
        $views = array(
            'hasil_karya_views' => ($hasil_karya->hasil_karya_views + 1)
        );
        $this->hasil_karya->update($views,$hasil_karya_slug);
        $data['post'] = $this->hasil_karya->search($hasil_karya_slug)->first_row();
        echo $this->page->tampil('website.landing-page.hasil-karya.detail.index',$data);
    }

}
