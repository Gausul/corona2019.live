<?php
class Admin_model extends CI_Model 
{

function moneselect($table,$index_name,$index_val){
	$this->db->select('*');
	$this->db->where($index_name,$index_val);
	$query=$this->db->get($table);
	return $query->row();
}

function total_count(){
    $this->db->select('sum(total_case) as total');
    $this->db->where('status',1);
    $query=$this->db->get('country_list');
    return $query->row();
}

function insert($table,$array){
    $this->db->insert($table,$array);
    return $this->db->insert_id();
}

function update($table,$array,$index_name,$index_val){
    $this->db->where($index_name,$index_val);
    $this->db->update($table,$array);
}


function moneselectresult($table,$index_name,$index_val){
    $this->db->select('*');
    $this->db->where($index_name,$index_val);
    $query=$this->db->get($table);
    return $query->result();
}

function moneselectresult2($table,$index_name,$index_val,$index_name2,$index_val2){
    $this->db->select('*');
    $this->db->where($index_name,$index_val);
    $this->db->where($index_name2,$index_val2);
    $query=$this->db->get($table);
    return $query->result();
}


function twoselect($table,$index_name,$index_val,$index_name2,$index_val2){
    $this->db->select('*');
    $this->db->where($index_name,$index_val);
    $this->db->where($index_name2,$index_val2);
    $query=$this->db->get($table);
    return $query->row();
}

function count_total_users(){
    $this->db->select('count(*) as c');
    $query=$this->db->get('users');
    return $query->row();
}

}
