<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Currency_model extends CI_Model {
    public function getAll($sort=null){
        if($sort){
            $this->db->order_by($sort);
        }
        return $this->db->get('currency')->result_array();
    }
}
