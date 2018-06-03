<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AkademikModel extends CI_Model{

    protected $table = 'post';
    
    public function saveData($data){
        $this->db->insert($this->table, $data);
    }

    public function updateData($data,$where){
        $this->db->update($this->table, $data, $where);
    }

    public function loadDataSection($data){
        $this->db->from($this->table);
        $this->db->where('section',$data);
        return $this->db->get();
    }
}