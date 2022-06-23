<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sizes extends MY_Controller {

    public function index()
    {
        $data['sizes'] = $this->Size_model->getAll();
        $this->load->view('include/header',['title'=>'shop']);
        $this->load->view('sizes',$data);
    }
    public function get()
    {
        if(isset($_POST['r_id']) && $_POST['r_id']){
            $data['sizes'] = $this->Size_model->getSizesByGroup('1');
            //$data['sizes'] = $this->Size_model->getSizesByGroup($_POST['r_id']);
            echo $data['sizes'];
        }else{
            $data['sizes'] = $this->Size_model->getSizesByGroup('1');
            //$data['sizes'] = $this->Size_model->getAll();
        }
    }
    /*public function add()
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
    }*/
}
