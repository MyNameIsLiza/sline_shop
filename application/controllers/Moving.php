<?php defined('BASEPATH') or exit('No direct script access allowed');

class Moving extends MY_Controller
{
    public function index()
    {
        if ($this->user_info['access'] < 2) {
            Header("Location: /shop");
            return;
        }
        $data['places'] = $this->Place_model->getAll();
        $data['groups'] = $this->Storage_model->get_groups($this->user_info['place_id']);
        $first_data['group_id'] = $data['groups'][0]['id'];
        if (isset($data['groups'][0])) {
            $data['types'] = $this->Storage_model->get_types($this->user_info['place_id'], $data['groups'][0]['id']);
            $first_data['type_id'] = $data['types'][0]['id'];
            if (isset($data['types'][0])) {
                $data['sizes'] = $this->Storage_model->get_sizes($this->user_info['place_id'], $data['groups'][0]['id'], $data['types'][0]['id']);
                if (isset($data['sizes'][0]) and $data['sizes'][0]['size']) {
                    $first_data['size'] = $data['sizes'][0]['size'];
                    $data['heights'] = $this->Storage_model->get_heights($this->user_info['place_id'], $data['groups'][0]['id'], $data['types'][0]['id'], $data['sizes'][0]['size']);
                    $first_data['height'] = $data['heights'][0]['height'];
                }
            }
        }
        $data['price'] = $this->Storage_model->get_prices($this->user_info['place_id'], $first_data);

        $this->load->view('include/header', ['title' => 'shop']);
        $this->load->view('moving', $data);
        $this->load->view('storage', MY_Controller::get_all());

    }

    public
    function test()
    {
        $data['storage'] = $this->Storage_model->getAll();
        echo '<img src="/assets/img/uc_o.png" style="width: 100px; height: 100px"><pre>';
        print_r($data['storage']);
        echo '<BR>--------------------------<BR>';
        echo '</pre>';

        /* echo '<img src="/shop/assets/img/uc_o.png" style="width: 100px; height: 100px"><pre>';
         print json_encode($this->Size_model->getSizesByGroup("1"));
         echo '</pre>';*/
        exit;


    }
}
