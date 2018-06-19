<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KerjaSamaController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(array('KerjaSamaModel'=>'kerja_sama'));
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
        $totalPost = $this->kerja_sama->totalPost();
        $config = array(
            'base_url' => base_url('kerja-sama/halaman/'),
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
        $data['post'] = $this->kerja_sama->all($perPage,$offset)->result();
        echo $this->page->tampil('website.landing-page.kerja-sama.index',$data);
    }

    public function detail($slug){
        $kerja_sama_slug = array('kerja_sama_slug' => $slug);
        $kerja_sama = $this->kerja_sama->search($kerja_sama_slug)->first_row();
        $views = array(
            'kerja_sama_views' => ($kerja_sama->kerja_sama_views + 1)
        );
        $this->kerja_sama->update($views,$kerja_sama_slug);
        $data['post'] = $this->kerja_sama->search($kerja_sama_slug)->first_row();
        echo $this->page->tampil('website.landing-page.kerja-sama.detail.index',$data);
    }

}
