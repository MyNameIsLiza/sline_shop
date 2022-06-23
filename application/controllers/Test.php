<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Test extends MY_Controller {
    function __construct() {
        parent::__construct();

    }
    public function index()
    {
        //$this->load->view('include/header',['title'=>'shop']);
        echo '<a href="/shop">Home</a>';
        echo '&nbsp;&nbsp;<a href="/shop/types">Додати Тип</a>';
        echo '<pre><pre>';//$this->User->get
        echo '<pre>';
        //print_r ($this->User->get_by_email($_SESSION['userData']['email']));
        echo '<BR>--------------------------<BR>';
        print_r ($this->Storage_model->get_groups(1));
        print_r ($this->Storage_model->get_types(1, 1));
        print_r ($this->user_info);
        echo '<BR>--------------------------<BR>';
        echo '</pre>';


        //exit;

    }
}
