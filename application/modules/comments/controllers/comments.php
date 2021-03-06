<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments extends MX_Controller {

function __construct() {
    parent::__construct();
}

    function view($confession_id) {
        
        
        $this->load->model('mdl_comments');
       
        $data['query'] = $this->get_where_custom('confession_id', $confession_id);

       
        $data['module'] = "comments";
        $data['view_file'] = "confession_comments";
        //echo Modules::run('templates/general', $data);
        
        $this->load->view('confession_comments', $data);
                
    }
    
    function number_of_comments($confession_id) {
        $this->load->model('mdl_comments');
       
        $data['number_of_comments'] = $this->count_where_custom('confession_id', $confession_id);
        
        if ($data['number_of_comments'] == 1) {
            echo $data['number_of_comments'].' Comment';
        } elseif ($data['number_of_comments'] == 0) {
            echo 'No comments';
        } else {
            echo $data['number_of_comments'].' Comments';
        }
        
    }

    function create($confession_id) {
        
        $data = $this->get_data_from_post(); //creating a new
        $data['confession_id'] = $confession_id;
        
        
        //$data['module'] = "comments";
        //$data['view_file'] = "post_comment_form";
        
        $this->load->view('post_comment_form', $data); 
    
    }
    
     function get_data_from_post() {
        $data['comment'] = $this->input->post('comment', TRUE); 
        $data['comment_date_time'] = $this->input->post('comment_date_time', TRUE);
        $data['confession_id'] = $this->input->post('confession_id', TRUE);
        return $data;
    }
    
 
    
    
        function submit() {
    

		$this->load->library('form_validation');
                //checks
                $this->form_validation->set_rules('comment', 'Comment', 'required|min_length[5]|xss_clean|max_length[300]');
                
                
                
                
                if ($this->form_validation->run() == FALSE) {
                    //mistake
                    $data = $this->get_data_from_post();
                    $this->load->module('confessions');// load confessions
                                $query = $this->confessions->get_where($data[confession_id]); // place confession id to get array
                                foreach ($query->result() as $row) {
                                    $url = '/confessions/view/'.$row->page_id.'/#'.$row->id;                                    
                                }
                                //row 
                                $this->session->set_flashdata('errors', 'Minimum 5 characters');
                                $this->session->set_flashdata('id', $row->id);
                                redirect($url);
		}
		else
		{
                    //success
                    $data = $this->get_data_from_post();
                    $this->_insert($data);
                    $this->load->module('confessions');// load confessions
                    $query = $this->confessions->get_where($data[confession_id]); // place confession id to get array
                    foreach ($query->result() as $row) {
                        $url = '/confessions/view/'.$row->page_id.'/#'.$row->id;
                    }
                    //row 
                    redirect($url);
                     
                    
		}
        }



function get($order_by){
    $this->load->model('mdl_comments');
    $query = $this->mdl_comments->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) {
    $this->load->model('mdl_comments');
    $query = $this->mdl_comments->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id){
    $this->load->model('mdl_comments');
    $query = $this->mdl_comments->get_where($id);
    return $query;
}

function get_where_custom($col, $value) {
    $this->load->model('mdl_comments');
    $query = $this->mdl_comments->get_where_custom($col, $value);
    return $query;
}

function count_where_custom($col, $value) {
    $this->load->model('mdl_comments');
    $query = $this->mdl_comments->count_where_custom($col, $value);
    return $query;
}

function _insert($data){
    $this->load->model('mdl_comments');
    $this->mdl_comments->_insert($data);
}

function _update($id, $data){
    $this->load->model('mdl_comments');
    $this->mdl_comments->_update($id, $data);
}

function _delete($id){
    $this->load->model('mdl_comments');
    $this->mdl_comments->_delete($id);
}

function count_where($column, $value) {
    $this->load->model('mdl_comments');
    $count = $this->mdl_comments->count_where($column, $value);
    return $count;
}

function get_max() {
    $this->load->model('mdl_comments');
    $max_id = $this->mdl_comments->get_max();
    return $max_id;
}

function _custom_query($mysql_query) {
    $this->load->model('mdl_comments');
    $query = $this->mdl_comments->_custom_query($mysql_query);
    return $query;
}

}