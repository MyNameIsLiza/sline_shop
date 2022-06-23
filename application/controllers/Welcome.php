<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Storage.php");
class Welcome extends MY_Controller {
    /*function __construct() {
        parent::__construct();

        if(!isset($_SESSION['userData']) || !isset($_SESSION['userData']['email']) || !$_SESSION['userData']['email']){
            //redirect('/');
            Header("Location: /shop/user_authentication");
        };
    }*/

	public function index()
	{
        if(isset($this->user_info['place_id'])){

            $this->load->view('include/header', ['title' => 'shop', 'user' => $this->user_info]);
            $this->load->view('storage', MY_Controller::get_all_from_my_location());
        }
	}
}
