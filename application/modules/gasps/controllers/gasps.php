<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gasps extends MX_Controller {
    

    
    
    function create($confession_id) {
        
        $data['module'] = "gasps";
        $data['view_file'] = "gasp_button";
        
        $data['confession_id'] = $confession_id;
        $data['number_of_gasps'] = modules::run('did_user_gasp/count_gasps', $data['confession_id']);

            if (isset($data['number_of_gasps'])) {
                $data['gasp_counter'] = '<span class="gasp-count">'.$data['number_of_gasps'].'</span>';
            } else {
                //no gasps yet
                $data['gasp_counter'] = '<span class="gasp-count">0</span>';
            }
        
        
        $this->load->view('gasp_button', $data);
    
    }
    

    
 
    //problem finding if it's been done or not
    function get_data_from_post() {
        
        //here
            
            $data = $this->get_data_from_db($this->input->post('confession_id', TRUE));
            if (!isset($data['number_of_gasps'])) {
                $data['number_of_gasps'] = 0;
            }

            $data['number_of_gasps'] = $data['number_of_gasps'] + 1;
            $data['confession_id'] = $this->input->post('confession_id', TRUE);
        
        return $data;
    }
    
    
    function get_data_from_db($id) {
        $query = $this->get_where_custom('confession_id', $id);
        foreach($query->result() as $row) {
            $data['id'] = $row->id;
            $data['number_of_gasps'] = $row->number_of_gasps;
            $data['confession_id'] = $row->confession_id;  
        }
        if (isset($data)) {
        return $data;
        } else {
            return false;
        }
    }
    
    //issue here
 
    
    function submit() {
    
		$this->load->library('session');
                $confession_id = $this->input->post('confession_id', TRUE);

                
                

                    //success
                    $data = $this->get_data_from_post();
                    if($this->session->userdata('logged_in')) {
                    $user_id = modules::run('users/get_user_id');
                    $did = modules::run('did_user_gasp/did_user_gasp', $confession_id, $user_id);
                        if ($did == FALSE) { 
                            
                            modules::run('did_user_gasp/add_user_gasp', $confession_id, $user_id);
                            //need to fix to know if it's updating
                            if ($data['number_of_gasps'] >= 1) {
                                //already had a gasp
                                $this->_update($confession_id, $data);
                                echo 'added 1';
                                //needs to refresh
                            } else {
                                //new                           
                                $this->_insert($confession_id, $data);                   
                                echo 'created 1 new';
                                //here also
                            }
                        } else {
                            echo "You already gasped!";
                        }
	
                   } else {
                       //pleas login
                        echo 'please login';
                   }
    }
    
    
 
function get($order_by){
    $this->load->model('mdl_gasps');
    $query = $this->mdl_gasps->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) {
    $this->load->model('mdl_gasps');
    $query = $this->mdl_gasps->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id){
    $this->load->model('mdl_gasps');
    $query = $this->mdl_gasps->get_where($id);
    return $query;
}

function get_where_custom($col, $value) {
    $this->load->model('mdl_gasps');
    $query = $this->mdl_gasps->get_where_custom($col, $value);
    return $query;
}

function _insert($data){
    $this->load->model('mdl_gasps');
    $this->mdl_gasps->_insert($data);
}

function _update($id, $data){
    $this->load->model('mdl_gasps');
    $this->mdl_gasps->_update($id, $data);
}

function _delete($id){
    $this->load->model('mdl_gasps');
    $this->mdl_gasps->_delete($id);
}

function count_where($column, $value) {
    $this->load->model('mdl_gasps');
    $count = $this->mdl_gasps->count_where($column, $value);
    return $count;
}

function get_max() {
    $this->load->model('mdl_gasps');
    $max_id = $this->mdl_gasps->get_max();
    return $max_id;
}

function _custom_query($mysql_query) {
    $this->load->model('mdl_gasps');
    $query = $this->mdl_gasps->_custom_query($mysql_query);
    return $query;
}

}