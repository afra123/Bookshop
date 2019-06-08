<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Book_model extends CI_Model
{  
    public function __construct()
	{
        $this->table = 'books';

        parent::__construct();
    }

    public function getBooks(){
        $query = $this->db->query('select ci_books.id as id, ci_books.title as title, ci_books.author as author, ci_categories.name as category, ci_categories.id as categoryid from ci_books left join ci_categories on ci_books.category = ci_categories.id order by categoryid asc');
        return $query->result_array();
    }

    public function getBook($id){
        $query = $this->db->get_where($this->table, array('id' => $id));
        return $query->row_array();
    }

    public function saveBook($file)
    {
        $id = $this->input->post('bookId');
        $data = array(
            'title'       => $this->input->post('bookTitle'),
            'category'    => $this->input->post('categoryId'),
            'author'      => $this->input->post('author'),
            'description' => $this->input->post('description'),
            'coverImg'    => $file,
        );

        if($id == -1){
            
            $this->db->insert($this->table, $data);

            $id = $this->db->insert_id();
        }else{
            $this->db->where('id', $id);
            if($file == 'uploads/'){
                $data = array(
                    'title'       => $this->input->post('bookTitle'),
                    'category'    => $this->input->post('categoryId'),
                    'author'      => $this->input->post('author'),
                    'description' => $this->input->post('description'),
                );
            }
            $this->db->update($this->table, $data);
        }
        
        return $id;
    }

    public function deleteBook()
    {
        $id = $this->input->post('id');

        $query = $this->db->get_where($this->table, array('id' => $id));
        $imgFile = $query->row_array()['coverImg'];
        unlink($imgFile);
        $this->db->delete($this->table, array('id' => $id));
    }

    public function getTopBooks(){
        $query = $this->db->query('select ci_books.*, track.bookid from (select bookid, COUNT(id) as bCount from ci_trackers GROUP By bookid ORDER By bCount limit 5) as track left join ci_books on track.bookid = ci_books.id');

        return $query->result_array();
    }

    public function getBookWithCategory($id){
        if($id == -1){
            $query = $this->db->get($this->table);
            return $query->result_array();
        }else{
            $query = $this->db->get_where($this->table, array('category' => $id));
            return $query->result_array();
        }    
    }

    public function getCartData(){
        $idArray = json_decode($this->input->get('data'));

        $data = array();
        foreach($idArray as $id){
            $query = $this->db->get_where($this->table, array('id' => $id));
            $row = $query->row_array();
            array_push($data, $row);
        }

        return json_encode($data);
    }
}