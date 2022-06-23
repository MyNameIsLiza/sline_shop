<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Types extends MY_Controller {

    public function index()
    {
        $data['groups'] = $this->Group_model->getAll();
        $data['types'] = $this->Type_model->getAll();
        $this->load->view('include/header',['title'=>'shop']);
        $this->load->view('type/index',$data);
    }
    public function get()
    {
        if(isset($_POST['group_id']) && $_POST['group_id']){
            $data['types'] = $this->Type_model->getTypesByGroup($_POST['group_id']);
        }else{
            $data['types'] = $this->Type_model->getAll();
        }
        echo $this->load->view('type/get',$data, true);
    }
    public function add()
    {
        echo json_encode($this->Type_model->add($_POST));
    }

    public function delete()
    {
        echo $this->Type_model->delete($_POST['id']);
    }

    public function test()
    {
        echo '<img src="/shop/assets/img/uc_o.png" style="width: 100px; height: 100px"><pre>';
        $name = "Liza";
        echo "Привіт, {$this->user_info['id']}";
        //print_r($this->user_info);
        echo '</pre>';
        exit;


    }

    public function edit()
    {
        echo json_encode($this->Type_model->edit($_POST));
    }
}
