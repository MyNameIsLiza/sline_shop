<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property User $User
 */
class User_Authentication extends CI_Controller {
    function __construct() {
        parent::__construct();

        // Load user model
        $this->load->model('User');
    }

    public function index(){
        $userData = array();

        if(isset($_SESSION['userData']) && isset($_SESSION['userData']['email']) && $_SESSION['userData']['email']){
            //redirect('/');
            Header("Location: /shop");
        } else {
            //$userData = $this->db->get('users')->row_array();
            //$this->session->set_userdata('userData', $userData);

            //Header("Location: /shop");
        };
        // Authenticate user with facebook






        // Load login/profile view
        $this->load->view('user_authentication/index');
    }

    public function logout() {

        // Remove user data from session
        $this->session->unset_userdata('userData');
        // Redirect to login page
        Header("Location: /shop/user_authentication");
        //redirect('user_authentication');
    }
    function check(){

        // Preparing data for database insertion
        if (isset($_POST['response'])){
            $user = $_POST['response'];

            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_uid']    = !empty($user['id'])?$user['id']:'';;
            $userData['first_name']    = !empty($user['first_name'])?$user['first_name']:'';
            $userData['last_name']    = !empty($user['last_name'])?$user['last_name']:'';
            $userData['email']        = !empty($user['email'])?$user['email']:'';
        }

        if (isset($_POST['user_data'])){
            $user = $_POST['user_data'];
            $userData['oauth_provider'] = 'google';
            $userData['oauth_uid']    = !empty($user['id'])?$user['id']:'';;
            $userData['first_name']   = !empty($user['first_name'])?$user['first_name']:'';
            $userData['last_name']    = !empty($user['second_name'])?$user['second_name']:'';
            $userData['email']        = !empty($user['email'])?$user['email']:'';
            $userData['picture']      = !empty($user['img'])?$user['img']:'';
        }

        // Insert or update user data to the database
        $userID = $this->User->checkUser($userData);

        // Check user data insert or update status
        if(!empty($userID)){
            $data['userData'] = $userData;

            // Store the user profile info into session
            $this->session->set_userdata('userData', $userData);
        }else{
            $data['userData'] = array();
        }

        Header('Location: /shop');
    }
}
