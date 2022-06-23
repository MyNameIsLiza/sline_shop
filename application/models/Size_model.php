<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Size_model extends CI_Model {
    public function getAll(){
        return $this->db->order_by('size_id')->order_by('convert(size, decimal)')->get('sizes')->result_array();
    }
    public function getSizesByGroup($group_id){
        $r_id = $this->db->where('id',$group_id)->get('groups')->row()->r_id;
        if($r_id == 0){
            return 0;
        }
        return $this->db->where('size_id',$r_id)->order_by('convert(size, decimal)')->get('sizes')->result_array();
    }
    public function getSizesBySizeID($r_id){
        return $this->db->where('size_id',$r_id)->order_by('convert(size, decimal)')->get('sizes')->result_array();
    }

    /*public function add($size){
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
    }*/
}
