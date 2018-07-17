<?php

class BeritaController extends CI_Controller{
    
    public function __construct(){
		parent::__construct();
		$this->load->model(array('PostBeritaModel'=>'postberita'));
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
        $totalPost = $this->postberita->totalPost();
        $config = array(
            'base_url' => base_url('berita/halaman/'),
            'total_rows' => $totalPost,
            'per_page' => $perPage,
            'first_link' => 'First',
			'last_link' => 'Last',
			'next_link' => 'Next >',
			'prev_link' => '< Prev',
            'full_tag_open' => '<div class="pagination"><ul><li>',
            'full_tag_close' => '</li></ul></div>',
            'first_tag_open' => '<a>',
            'first_tag_close' => '</a>',
            // 'prev_tag_open' => '<a>',
            // 'prev_tag_close' => '</a>',
            // 'next_tag_open' => '<a>',
            // 'next_tag_close' => '</a>',
            'cur_tag_open' => '<a class="active-page">',
            'cur_tag_close' => '</a>',
			'last_tag_open' => '<a>',
			'last_tag_close' => '</a>',
			'num_links'		=> round($totalPost/$perPage),
            'use_page_numbers' => TRUE,
        );
        $this->pagination->initialize($config);

        $data['page'] = $this->pagination->create_links();
        $data['post'] = $this->postberita->all($perPage,$offset)->result();
        echo $this->page->tampil('website.landing-page.berita.index',$data);
    }

    public function detail($slug){
        $berita_slug = array('berita_slug' => $slug);
        $berita = $this->postberita->search($berita_slug)->first_row();
        $views = array(
            'berita_views' => ($berita->berita_views + 1)
        );
        $this->postberita->update($views,$berita_slug);
        $data['post'] = $this->postberita->search($berita_slug)->first_row();
        echo $this->page->tampil('website.landing-page.berita.detail.index',$data);
    }
}