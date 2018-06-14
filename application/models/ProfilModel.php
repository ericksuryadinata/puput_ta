<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfilModel extends CI_Model{

    private $table = 'profil';
    
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