<?php  defined('BASEPATH') OR exit('No direct script access allowed');


class Place_model extends CI_Model {
    public function getAll(){
        return $this->db->order_by('name')->get('places', 10)->result_array();
    }
    /*public function getTypesByGroup($group_id){
        return $this->db->where('group_id',$group_id)->order_by('name')->get('types')->result_array();
    }
    public function add($type){
        $data = [
            'name' => $type['name'],
            'group_id' => $type['group_id'],
            'user_id' => $type['user_info']['id']
        ];
        //$id = $this->check_id();
        /*        if($id){
                    $data['id'] = $id;
                }
        $this->db->insert("types", $data);
        $data['id'] = $this->db->insert_id();
        return $data;
    }
    public function delete($id)
    {
        $this->db->delete('types', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function check_id(){
        //$max_id = $this->db->select('MAX(id)+1 AS id')->get('types')->row()->id;
        $types = $this->getAll('id');
        //if(count($types)!=$max_id){
        $last_id = 0;
        foreach ($types as $type){
            $last_id++;
            if(($type['id'])!=$last_id){
                return $last_id;
            }
        }
        return ++$last_id;
        //}
        //return false;
    }

    public function edit($type){

        //echo '<script>console.log("Hello"); </script>';

        $data = array(
            'name' => $type["name"],
            'group_id' => $type['group_id'],
            'user_id' => $type['user_info']['id']
        );
        //$data['id'] = $type["id"];


        $this->db->where('id', $type["id"])->update('types', $data);
        //$data['id'] = $this->db->update_id();
        return $data;
    }*/
}
