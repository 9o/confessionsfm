<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gasps extends MX_Controller {
    

    
    
    function create($confession_id) {
        
        $data['module'] = "gasps";
        $data['view_file'] = "gasp_button";
        
        $data['confession_id'] = $confession_id;
        $query = $this->get_where_custom('confession_id', $confession_id);
        foreach($query->result() as $row) {
            $data['number_of_gasps'] = $row->number_of_gasps;

        }
            if (isset($data['number_of_gasps'])) {
                echo '<br>'.$data['number_of_gasps'].' gasp(s)';
            } else {
                //no gasps yet
                echo '<br>Be the first to GASP!';
            }
        
        
        $this->load->view('gasp_button', $data);
    
    }
    

    
 
    //problem finding if it's been done or not
    function get_data_from_post() {
        
        //here
            
            $data = $this->get_data_from_db($this->input->post('confession_id', TRUE));
       
        if ($data['number_of_gasps'] < 1) {
            $data['number_of_gasps'] = $this->input->post('number_of_gasps', TRUE);
            $data['confession_id'] = $this->input->post('confession_id', TRUE);          
        } else {
            $data['number_of_gasps'] = $data['number_of_gasps'] + 1;
            $data['confession_id'] = $this->input->post('confession_id', TRUE);
        }
        
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
        }
    }
    
    //issue here
 
    
    function submit() {
    
		
                $confession_id = $this->input->post('confession_id', TRUE);

                
                

                    //success
                    $data = $this->get_data_from_post();
                    if($this->session->userdata('logged_in')) {
                    $user_id = modules::run('users/get_user_id');
                    $did = modules::run('did_user_gasp/did_user_gasp', $confession_id, $user_id);
                        if ($did == FALSE) { 
                            
                            modules::run('did_user_gasp/add_user_gasp', $confession_id, $user_id);
                            //need to fix to know if it's updating
                            if ($data['number_of_gasps'] > 1) {
                                //already had a gasp
                                $this->_update($confession_id, $data);
                                redirect('confession/view/');
                                //needs to refresh
                            } else {
                                //new                           
                                $this->_insert($data);                   
                                redirect('confession/view/');
                                //here also
                            }
                        } else {
                            echo "You already gasped!";
                        }
	
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