<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_m extends MY_Model{
    
     function jumlah_data($table=NULL,$filter=NULL){
        $this->db->select("*");
        $this->db->from($table);
        if($filter != NULL){
            $this->db->where($filter);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }
}