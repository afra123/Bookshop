<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tracker_model extends CI_Model
{  
    public function __construct()
	{
        $this->table = 'trackers';

        parent::__construct();
    }

    public function saveTrack(){

        $uid = $this->session->userdata('uid');
        $data = $this->db->get_where($this->table, array('uid' => $uid, 'bookid' => $this->input->get('id')))->row_array();
        if(count($data)==0){
            $data = array(
                'uid'    => $uid,
                'bookid' => $this->input->get('id'),
                'time'   => date('Y-m-d H:i:s', time()-32400),
            );
    
            $this->db->insert($this->table, $data);
        }

        $query = $this->db->query('select ci_books.coverImg, ci_books.id, count(ci_books.id) as count from ci_books left join (select ci_trackers.bookid, visiters.uid from ci_trackers left join (select uid from ci_trackers where bookid='.$this->input->get('id').')as visiters on visiters.uid = ci_trackers.uid) as books on ci_books.id=books.bookid group by id order by count desc limit 5');
        
        return $query->result_array();
    }

    public function getStats($id){
        $this->db->like('bookid', $id);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function getTotalCount(){
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}