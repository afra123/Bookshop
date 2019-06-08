<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model
{  
    public function __construct()
	{
        $this->table = 'categories';

        parent::__construct();
    }

    public function getCategories(){
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    public function saveCategory()
    {
        $id = $this->input->post('id');
        $data = array(
            'name' => $this->input->post('name'),
            'created_at' => date('Y-m-d H:i:s', time()-32400),
            'updated_at' => date('Y-m-d H:i:s', time()-32400)
        );
        if($id == -1){
            
            $this->db->insert($this->table, $data);

            $id = $this->db->insert_id();
        }else{
            $this->db->where('id', $id);
            $this->db->update($this->table, $data);
        }

        return $id;
    }

    public function deleteCategory()
    {
        $id = $this->input->post('id');
        $query = $this->db->query('select count(id) as count from ci_books where category = '.$id);
        $data = -1;
        if($query->row('count') == 0){
            $this->db->delete($this->table, array('id' => $id));
            $data = 1;
        }
        return $data;        
    }

    public function getFirstCategoryId(){
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1); 
        $query = $this->db->get($this->table);

        $data = $query->result_array();
        $id = -1;
        if(count($data) > 0){
            $id = $data[0]['id'];
        }

        return $id;
    }
}