<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Visiter_model extends CI_Model
{  
    public function __construct()
	{
        $this->table = 'visiters';

        parent::__construct();
    }

    public function setUid(){

        $query = $this->db->get_where($this->table, array('ip' => $this->input->ip_address()));

        $data = $query->row_array();

        $uid = '';

        if(count($data) == 0){
            $uid = uniqid();

            $this->db->insert($this->table, array('ip'=>$this->input->ip_address(), 'uid'=>$uid));
        }else{
            $uid = $data['uid'];
        }

        $this->session->set_userdata(array('uid'=>$uid));

        return $uid;
    }
}