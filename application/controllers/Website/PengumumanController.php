<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PengumumanController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(array('PengumumanModel'=>'pengumuman'));
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
        $totalPost = $this->pengumuman->totalPost();
        $config = array(
            'base_url' => base_url('pengumuman/halaman/'),
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
        $data['post'] = $this->pengumuman->all($perPage,$offset)->result();
        echo $this->page->tampil('website.landing-page.pengumuman.index',$data);
    }

    public function detail($slug){
        $pengumuman_slug = array('pengumuman_slug' => $slug);
        $pengumuman = $this->pengumuman->search($pengumuman_slug)->first_row();
        $views = array(
            'pengumuman_views' => ($pengumuman->pengumuman_views + 1)
        );
        $this->pengumuman->update($views,$pengumuman_slug);
        $data['post'] = $this->pengumuman->search($pengumuman_slug)->first_row();
        echo $this->page->tampil('website.landing-page.pengumuman.detail.index',$data);
    }
}
