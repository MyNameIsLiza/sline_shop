<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Statistic_model extends CI_Model {
    public function getAll($sort = null){
        if ($sort) {
            $this->db->order_by($sort);
        }
        return $this->db->get('actions')->result_array();
    }
}
