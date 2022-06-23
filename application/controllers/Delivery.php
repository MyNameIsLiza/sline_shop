<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Delivery extends MY_Controller {
    public function index()
    {
        if (isset($this->user_info['place_id'])) {
            $data = MY_Controller::get_all();
            $this->load->view('include/header', ['title' => 'shop', 'user' => $this->user_info]);
            $this->load->view('delivery', $data);
            $this->load->view('storage', $data);
        }
    }
    public function get_types()
    {
        if (isset($_POST['group_id'])){
            print json_encode($this->Type_model->getTypesByGroup($_POST['group_id']));
        }

    }
    public function get_sizes()
    {
        if (isset($_POST['group_id'])){
            print json_encode($this->Size_model->getSizesByGroup($_POST['group_id']));
        }

    }
    public function add()
    {
        echo json_encode($this->Storage_model->add($_POST));
    }
    public function test()
    {

       /* echo '<img src="/shop/assets/img/uc_o.png" style="width: 100px; height: 100px"><pre>';
        print json_encode($this->Size_model->getSizesByGroup("1"));
        echo '</pre>';*/
        exit;


    }
}
