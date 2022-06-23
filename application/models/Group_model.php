<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Group_model extends CI_Model {
    public function getAll($sort=null){
        if($sort){
            $this->db->order_by($sort);
        }
        return $this->db->get('groups')->result_array();
    }
    public function add($group){
        print_r($group);
        $data = array(
            'name' => $group["name"],
            'r_id' => (int) $group["r_id"],
            'rt_id' => (int) $group["rt_id"]
        );
        $id = $this->check_id();
        if($id){
            $data['id'] = $id;
        }
        $this->db->insert("groups", $data);
        $data['id'] = $this->db->insert_id();
        return $data;
    }
    public function delete($id)
    {
        $this->db->delete('groups', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function check_id(){
        //$max_id = $this->db->select('MAX(id)+1 AS id')->get('groups')->row()->id;
        $groups = $this->getAll('id');
        //if(count($groups)!=$max_id){
            $last_id = 0;
            foreach ($groups as $group){
                $last_id++;
                if(($group['id'])!=$last_id){
                    return $last_id;
                }
            }
            return ++$last_id;
        //}
        //return false;
    }

    public function edit($group){

        //echo '<script>console.log("Hello"); </script>';

        $data = array(
            'name' => $group["name"],
            'r_id' => (int) $group["r_id"],
            'rt_id' => (int) $group["rt_id"]
        );
        //$data['id'] = $group["id"];


        $this->db->where('id', $group["id"])->update('groups', $data);
        //$data['id'] = $this->db->update_id();
        return $data;
    }
}
