<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MX_Controller {
    


    function create() {
        
        $data = $this->get_data_from_post(); //creating a new
        
        
        $data['module'] = "users";
        $data['view_file'] = "create_user";
        $data['title'] = "Sign Up";
        echo Modules::run('templates/general', $data); 
        
    
    }
    
    function login($error = NULL) {
        $data = $this->get_data_from_post(); //creating a new
        $data['error'] = $error; //error from loginsubmit()
        
        $data['module'] = "users";
        $data['view_file'] = "login";
        $data['title'] = "Login";
        
        echo Modules::run('templates/general', $data); 
    }
    
    function login_status() {
        
        //Do I need to pass data?s
        //$this->load->view('login_status'); 
        
        if($this->session->userdata('logged_in')) {
            //logged in
            //echo "You are currently logged in as: ";
            //$this->data['user_email'] = $this->session->userdata('user_email');
            //print_r($this->session->all_userdata());
            $user_data = $this->session->all_userdata(); //i know there is a better way of doing this.
            echo '<p class="sb-signin">';
            echo 'You are logged in as '.$user_data['user_email'].' ';
            echo anchor('users/logout', 'Logout').'</p>';            
        } else {
            //NOT logged in
            //echo "You are not logged in. ";
        }
    }
    
    function login_logout() {
        $this->load->library('SimpleLoginSecure');
        if($this->session->userdata('logged_in')) {
            echo '<li>'.anchor('users/logout', 'Logout').'</li>';            
        } else {
            //NOT logged in
            //echo "You are not logged in. ";
            echo '<li>'.anchor('users/login', 'Login').'</li>';
            echo '<li>'.anchor('users/create', 'Sign Up').'</li>';
        }
        
    }
    
    function get_user_id() {
        if($this->session->userdata('logged_in')) {
            $user_data = $this->session->all_userdata(); //better way can be used here
            return $user_data['user_id'];
            
        } else {
            redirect('users/login');
            //need to add flash data
        }
        
    }
    
    function logout() {
        //flash data needed here
        $this->simpleloginsecure->logout();
        redirect('pages/');
        //need to add flash data
    }
    
    function loginsubmit() {
        $this->load->library('SimpleLoginSecure');
        $data = $this->get_data_from_post();                                                                  
        if($this->simpleloginsecure->login($data['user_email'], $data['user_pass'])) {
            redirect('pages/');
        } else {
            $error = 'Email and password do not match.';
            $this->login($error);
        }        
    }
    
    
     function get_data_from_post() {
        $data['user_email'] = $this->input->post('user_email', TRUE);
        $data['user_pass'] = $this->input->post('user_pass', TRUE);
        return $data;
    }
    
        function submit() {
    

		$this->load->library('form_validation');

                //checks
                $this->form_validation->set_rules('user_email', 'User_email', 'required|min_length[3]|xss_clean|max_length[255]');
                $this->form_validation->set_rules('user_pass', 'User_pass', 'required|min_length[3]|xss_clean|max_length[60]valid_email|is_unique[users.user_email]');
		
                
               
                
                
                if ($this->form_validation->run($this) == FALSE) {
                    //mistake
                    $this->create();
		}
		else
		{
                    //success
                    $data = $this->get_data_from_post();
                                                                  
                    $this->simpleloginsecure->create($data['user_email'], $data['user_pass']);
                    redirect('/');
                    //need to add flash data that the account has been made or have it auto-login
                     
                    
		}
        }
        
    
    
    
    
    

function get($order_by){
    $this->load->model('mdl_users');
    $query = $this->mdl_users->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) {
    $this->load->model('mdl_users');
    $query = $this->mdl_users->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id){
    $this->load->model('mdl_users');
    $query = $this->mdl_users->get_where($id);
    return $query;
}

function get_where_custom($col, $value) {
    $this->load->model('mdl_users');
    $query = $this->mdl_users->get_where_custom($col, $value);
    return $query;
}

function _insert($data){
    $this->load->model('mdl_users');
    $this->mdl_users->_insert($data);
}

function _update($id, $data){
    $this->load->model('mdl_users');
    $this->mdl_users->_update($id, $data);
}

function _delete($id){
    $this->load->model('mdl_users');
    $this->mdl_users->_delete($id);
}

function count_where($column, $value) {
    $this->load->model('mdl_users');
    $count = $this->mdl_users->count_where($column, $value);
    return $count;
}

function get_max() {
    $this->load->model('mdl_users');
    $max_id = $this->mdl_users->get_max();
    return $max_id;
}

function _custom_query($mysql_query) {
    $this->load->model('mdl_users');
    $query = $this->mdl_users->_custom_query($mysql_query);
    return $query;
}

}