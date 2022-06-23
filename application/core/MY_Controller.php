<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property Type_model $Type_model
 * @property Group_model $Group_model
 * @property Place_model $Place_model
 * @property Size_model $Size_model
 * @property Currency_model $Currency_model
 * @property Storage_model $Storage_model
 * @property Sale_model $Sale_model
 * @property Statistic_model Statistic_model
 * @property User $User
 */
class MY_Controller extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Type_model');
        $this->load->model('Group_model');
        $this->load->model('Size_model');
        $this->load->model('Place_model');
        $this->load->model('Currency_model');
        $this->load->model('Storage_model');
        $this->load->model('Sale_model');
        $this->load->model('Statistic_model');
        $this->load->model('User');
        $this->user_info = [];
        if(!isset($_SESSION['userData']) || !isset($_SESSION['userData']['email']) || !$_SESSION['userData']['email']){
            Header("Location: /shop/user_authentication");
        } else {
            $this->user_info = $this->User->get_by_email($_SESSION['userData']['email']);
            $_POST['user_info'] = $this->user_info;
        };
    }

    public function get_all(){
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
            return $data;
        }
        return [];
    }

    public function get_all_from_my_location(){
        $data['groups'] = $this->Group_model->getAll();
        $data['types'] = $this->Type_model->getAll();
        $data['sizes'] = $this->Size_model->getAll();
        $data['heights'] = $this->Size_model->getAll();
        $data['places'] = $this->Place_model->getAll();
        $data['currency'] = $this->Currency_model->getAll();
        $i = 0;
        if (isset($this->user_info['place_id'])) {
            $first_data = $this->Storage_model->getByPlaceId($this->user_info['place_id']);

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
            return $data;
        }
        return [];
    }
}
