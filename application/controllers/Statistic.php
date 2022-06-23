<?php defined('BASEPATH') or exit('No direct script access allowed');

class Statistic extends MY_Controller
{
    public function index()
    {
        if ($this->user_info['access'] < 3) {
            Header("Location: /shop");
            return;
        }
        $data['groups'] = $this->Group_model->getAll();
        $data['types'] = $this->Type_model->getAll();
        $data['sizes'] = $this->Size_model->getAll();
        $data['heights'] = $this->Size_model->getAll();
        $data['places'] = $this->Place_model->getAll();
        $data['currency'] = $this->Currency_model->getAll();
        $data['users'] = $this->User->getAll();
        $first_data = $this->Statistic_model->getAll();
        $i = 0;
        foreach ($first_data as $item) {
            $data['storage'][$item['action_id']][$i]['group'] = $data['groups'][array_search($item['group_id'], array_column($data['groups'], 'id'))];
            $data['storage'][$item['action_id']][$i]['type'] = $data['types'][array_search($item['type_id'], array_column($data['types'], 'id'))];
            $data['storage'][$item['action_id']][$i]['size'] = $item['size'];
            $data['storage'][$item['action_id']][$i]['height'] = $item['height'];
            $data['storage'][$item['action_id']][$i]['place'] = $data['places'][array_search($item['place_id'], array_column($data['places'], 'place_id'))];
            //$data['storage'][$item['action_id']][$i]['currency'] = $data['currency'][array_search($item['currency_id'], array_column($data['currency'], 'id'))];
            $data['storage'][$item['action_id']][$i]['quantity'] = $item['quantity'];
            $data['storage'][$item['action_id']][$i]['user'] = $data['users'][array_search($item['user_id'], array_column($data['users'], 'id'))];
            $data['storage'][$item['action_id']][$i]['creation_time'] = $item['creation_time'];
            $data['storage'][$item['action_id']][$i]['update_time'] = $item['update_time'];
            $i++;
        }

        $this->load->view('include/header', ['title' => 'shop', 'user' => $this->user_info]);
        $this->load->view('statistic', $data);
    }
}
