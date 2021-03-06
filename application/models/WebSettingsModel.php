<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WebSettingsModel extends CI_Model{

    private $table = 'web_settings';
    
    public function saveData($data){
        $this->db->insert($this->table, $data);
    }

    public function updateData($data,$where){
        $this->db->update($this->table, $data, $where);
    }

    public function saveBatchData($data){
        $this->db->insert_batch($this->table, $data);
    }

    public function updateBatchData($data){
        $this->db->truncate($this->table);
        $this->db->insert_batch($this->table, $data);
    }

    public function loadDataSettings($data){
        $this->db->from($this->table);
        $this->db->where('key',$data);
        return $this->db->get();
    }

    public function all(){
        return $this->db->get('web_settings');
    }

}