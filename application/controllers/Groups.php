<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Groups extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Group_model');
    }

    public function index()
    {
        $data['groups'] = $this->Group_model->getAll();
        $this->load->view('include/header',['title'=>'shop']);
        $this->load->view('groups',$data);

    }
    public function add()
    {
        print_r($_POST);
        echo json_encode($this->Group_model->add($_POST));
    }

    public function delete()
    {
        echo $this->Group_model->delete($_POST['id']);
    }

    public function test()
    {
        echo $this->Group_model->check_id();

    }

    public function edit()
    {
        echo json_encode($this->Group_model->edit($_POST));
    }
}
