<?php defined('BASEPATH') or exit('No direct script access allowed');

class Search extends MY_Controller
{
    public function index()
    {
        if ($this->user_info['access'] < 1) {
            Header("Location: /shop");
            return;
        }
        if (isset($this->user_info['place_id'])) {
            $this->load->view('include/header', ['title' => 'shop', 'user' => $this->user_info]);
            $this->load->view('search', MY_Controller::get_all());
        }
    }
}
