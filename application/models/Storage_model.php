<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Type_model $Type_model
 * @property Group_model $Group_model
 * @property Place_model $Place_model
 * @property Size_model $Size_model
 * @property Currency_model $Currency_model
 * @property Storage_model $Storage_model
 * @property Sale_model $Sale_model
 * @property User $User
 */
class Storage_model extends CI_Model
{
    public function getAll($sort = null)
    {
        if ($sort) {
            $this->db->order_by($sort);
        }
        return $this->db->get('storage')->result_array();
    }

    public function search($searchObject)
    {
        $data['groups'] = $this->Group_model->getAll();
        $data['types'] = $this->Type_model->getAll();
        $data['sizes'] = $this->Size_model->getAll();
        $data['heights'] = $this->Size_model->getAll();
        $data['places'] = $this->Place_model->getAll();
        $data['currency'] = $this->Currency_model->getAll();
        $i = 0;
        if (isset($this->user_info['place_id'])) {
            $first_data = $this->Storage_model->getAll();

            foreach ($first_data as $item) {
                $data['storage'][$i]['group'] = $data['groups'][array_search($item['group_id'], array_column($data['groups'], 'id'))];
                $data['storage'][$i]['type'] = $data['types'][array_search($item['type_id'], array_column($data['types'], 'id'))];
                $data['storage'][$i]['size'] = $item['size'];
                $data['storage'][$i]['height'] = $item['height'];
                $data['storage'][$i]['place'] = $data['places'][array_search($item['place_id'], array_column($data['places'], 'place_id'))];
                $data['storage'][$i]['currency'] = $data['currency'][array_search($item['currency_id'], array_column($data['currency'], 'id'))];
                $data['storage'][$i]['quantity'] = $item['quantity'];
                $i++;
            }
            return Storage_model::filterData($data['storage'], $searchObject);
        }
        return [];
    }

    static function filterData($data, $searchObject)
    {
        return array_filter($data, function ($item) use ($searchObject) {
            $isCorrect = true;
            if (!function_exists('str_contains')) {
                function str_contains(string $haystack, string $needle): bool
                {
                    return '' === $needle || false !== strpos($haystack, $needle);
                }
            }
            foreach($searchObject as $key => $value){
                if (isset($item[$key]['name']) && !str_contains(mb_strtolower((string)$item[$key]['name']), mb_strtolower((string)$value))) {
                    $isCorrect = false;
                }
                if (!isset($item[$key]['name']) && !str_contains(mb_strtolower((string)$item[$key]), mb_strtolower((string)$value))) {
                    $isCorrect = false;
                }
            }
            return $isCorrect;
        });
    }

    public function getByPlaceId($place_id)
    {
        $query = "SELECT * FROM storage WHERE place_id={$place_id}";
        $this->db->query($query);
        return $this->db->query($query)->result_array();
    }

    public function add($data)
    {
        if (!isset($data["size"])) $data["size"] = 0;
        if (!isset($data["height"])) $data["height"] = 0;
        $action = array(
            'action_id' => 1,
            'place_id' => $data["new_place_id"],
            'group_id' => $data["group_id"],
            'type_id' => $data["type_id"],
            'size' => $data["size"],
            'height' => $data["height"],
            'quantity' => $data["quantity"],
            'user_id' => $this->User->checkUser($_SESSION['userData'])

        );
        $storage = array(
            'place_id' => $data["new_place_id"],
            'group_id' => $data["group_id"],
            'type_id' => $data["type_id"],
            'size' => $data["size"],
            'height' => $data["height"],
            'quantity' => $data["quantity"],
            'price' => $data["price"],
            'currency_id' => $data["currency_id"],
            'user_id' => $this->User->checkUser($_SESSION['userData'])
        );
        $keys = implode(", ", array_keys($storage));
        $values = implode(", ", array_values($storage));
        $query = "INSERT INTO storage ($keys) VALUES($values) ON DUPLICATE KEY UPDATE quantity=quantity+{$data["quantity"]}";
        $this->db->insert("actions", $action);
        $this->db->query($query);
        return $action;
    }

    public function sale_good($data)
    {
        if (!isset($data["size"])) $data["size"] = 0;
        if (!isset($data["height"])) $data["height"] = 0;
        $action = array(
            'action_id' => 2,
            'place_id' => $data["place_id"],
            'group_id' => $data["group_id"],
            'type_id' => $data["type_id"],
            'size' => $data["size"],
            'height' => $data["height"],
            'quantity' => $data["quantity"],
            'user_id' => $this->User->checkUser($_SESSION['userData'])

        );

        $storage = array(
            'place_id' => $data["place_id"],
            'group_id' => $data["group_id"],
            'type_id' => $data["type_id"],
            'size' => $data["size"],
            'height' => $data["height"],
            'quantity' => $data["quantity"]
        );
        echo "Склад";
        print_r($storage);
        $where = "group_id = {$storage["group_id"]} and type_id = {$storage["type_id"]} and 
        size = {$storage["size"]} and height = {$storage["height"]}";

        $this->db->delete('storage', $storage);

        $query = "update storage SET quantity = quantity-{$storage["quantity"]}
        where quantity > {$storage["quantity"]} and $where";
        $this->db->query($query);
        echo $this->db->last_query();
        $this->db->insert("actions", $action);
        return $action;
    }

    public function move_good($data)
    {
        if (!isset($data["size"])) $data["size"] = 0;
        if (!isset($data["height"])) $data["height"] = 0;
        $action = array(
            'action_id' => 3,
            'place_id' => $data["new_place_id"],
            //'new_place_id' => $data["new_place_id"],
            'group_id' => $data["group_id"],
            'type_id' => $data["type_id"],
            'size' => $data["size"],
            'height' => $data["height"],
            'quantity' => $data["quantity"],
            'user_id' => $this->User->checkUser($_SESSION['userData'])
        );


        $where = "place_id = {$data["place_id"]} and group_id = {$data["group_id"]} and type_id = {$data["type_id"]} and 
        size = {$data["size"]} and height = {$data["height"]}";

        $query = "update storage SET place_id = {$data["new_place_id"]} 
        where quantity = {$data["quantity"]} and $where";
        $this->db->query($query);

        $query = "update storage SET quantity = quantity-{$data["quantity"]}
        where quantity > {$data["quantity"]} and $where";
        $this->db->query($query);

        $storage = array(
            'place_id' => $data["new_place_id"],
            'group_id' => $data["group_id"],
            'type_id' => $data["type_id"],
            'size' => $data["size"],
            'height' => $data["height"],
            'quantity' => $data["quantity"]
        );

        $this->db->insert("storage", $storage);
        $this->db->insert("actions", $action);
        return $action;
    }

    public function get_groups($place_id)
    {
        return $this->db->select('DISTINCT(group_id) AS id, name, r_id, rt_id')
            ->JOIN('groups', 'groups.id=storage.group_id')
            ->WHERE('place_id', $place_id)
            ->order_by('name')->get('storage')->result_array();
    }

    public function get_types($place_id, $group_id)
    {
        return $this->db->select('DISTINCT(type_id) AS id, name')
            ->JOIN('types', 'types.id=storage.type_id')
            ->WHERE('place_id', $place_id)
            ->WHERE('storage.group_id', $group_id)
            ->order_by('name')->get('storage')->result_array();
    }

    public function get_sizes($place_id, $group_id, $type_id)
    {
        return $this->db->select('DISTINCT(size) AS size')
            ->WHERE('place_id', $place_id)
            ->WHERE('group_id', $group_id)
            ->WHERE('type_id', $type_id)
            ->order_by('convert(size, decimal)')->get('storage')->result_array();
    }

    public function get_heights($place_id, $group_id, $type_id, $size)
    {
        return $this->db->select('DISTINCT(height) AS height')
            ->WHERE('place_id', $place_id)
            ->WHERE('group_id', $group_id)
            ->WHERE('type_id', $type_id)
            ->WHERE('size', $size)
            ->order_by('convert(height, decimal)')->get('storage')->result_array();

    }

    public function get_prices($place_id, $data)
    {
        $this->db->select('DISTINCT(price) AS price, currency_id, name, quantity')
            ->JOIN('currency', 'currency.id=storage.currency_id')
            ->WHERE('place_id', $place_id)
            ->WHERE('group_id', $data['group_id'])
            ->WHERE('type_id', $data['type_id']);
        if (isset($data['size'])) $this->db->WHERE('size', $data['size']);
        if (isset($data['height'])) $this->db->WHERE('height', $data['height']);
        return $this->db->order_by('convert(size, decimal)')->get('storage')->row_array();

    }
    /*
     * public function delete($id)
       {
           $this->db->delete('groups', ['id' => $id]);
           return $this->db->affected_rows();
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
