<?php defined('BASEPATH') or exit('No direct script access allowed');

class Storage extends MY_Controller
{
    public function index()
    {
        if (isset($this->user_info['place_id'])) {

            $this->load->view('include/header', ['title' => 'shop', 'user' => $this->user_info]);
            $this->load->view('storage', MY_Controller::get_all_from_my_location());
        }
    }

    public function get_all()
    {
        print json_encode(MY_Controller::get_all());
    }


    public function get_types()
    {
        if (isset($this->user_info['place_id']) && isset($_POST['group_id'])) {
            print json_encode($this->Storage_model->get_types($this->user_info['place_id'], $_POST['group_id']));
        }
    }

    public function get_sizes()
    {
        if (isset($this->user_info['place_id']) && $_POST['group_id'] && isset($_POST['type_id'])) {
            print json_encode($this->Storage_model->get_sizes($this->user_info['place_id'], $_POST['group_id'], $_POST['type_id']));
        }

    }

    public function get_heights()
    {
        if (isset($this->user_info['place_id']) && $_POST['group_id'] && isset($_POST['type_id']) && $_POST['size']) {
            print json_encode($this->Storage_model->get_heights($this->user_info['place_id'], $_POST['group_id'], $_POST['type_id'], $_POST['size']));
        }

    }

    public function get_price()
    {
        if (isset($this->user_info['place_id']) && $_POST['group_id'] && isset($_POST['type_id'])) {
            print json_encode($this->Storage_model->get_prices($this->user_info['place_id'], $_POST));
        }

    }

    public function add()
    {
        echo json_encode($this->Storage_model->add($_POST));
    }

    public function sale_good()
    {
        $_POST['place_id'] = $this->user_info['place_id'];
        echo json_encode($this->Storage_model->sale_good($_POST));
    }

    public function move_good()
    {
        $_POST['place_id'] = $this->user_info['place_id'];
        echo json_encode($this->Storage_model->move_good($_POST));
    }

    public function search_goods()
    {
        if (isset($_POST) and isset($_POST['searchObject'])) {
            print json_encode($this->Storage_model->search($_POST['searchObject']));
        }
    }

    public function test()
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
