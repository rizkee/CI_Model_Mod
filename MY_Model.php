<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
 
Class MY_Model extends CI_Model
{
   public $table_name; 
   public $primary_key;
   
   public function __construct()
   {
       parent::__construct();
      
   }

   public function get_rows($filter)
   {
       
    foreach($filter as $col_op=>$condition)
     {
       foreach($condition as $col_name=>$value)
       {
        $this->db->$col_op($col_name,$value);   
       }   
       
     }    
   	return $this->db->get($this->table_name)->result();
   }
   
   public function page_entries($limit,$offset)
   {
   	 
   	 return $this->db->limit($limit,$offset)->get($this->table_name)->result();
	 #var_dump($this->db->last_query());
	}
   	
   public function insert($data)
   {
   	 return $this->db->insert($this->table_name,$data);
	
   }
   
   public function last_id()
   {
       return $this->db->insert_id();
   }
   
   public function update($id_array,$data)
   {
   	 return  $this->db->update($this->table_name,$data,$id_array);
   }
   
   public function delete($id)
   {
   	return  $this->db->where($this->primary_key, $id)
					 ->delete($this->table_name); 
   }
   
   public function multi_delete($id_array)
   {
   	return  $this->db->where_in($this->primary_key, $id_array)
					 ->delete($this->table_name); 
   }
  
   public function select_all()
   {
   	 return $this->db->get($this->table_name)->result();
	
   }
   
   public function total_rows()
   {
   	return $this->db->count_all($this->table_name);
   }
	
}

?>