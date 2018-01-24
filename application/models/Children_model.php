<?php
defined("BASEPATH") or exit("No direct script access allowed");

class Children_model extends MY_Model{

	public $_table = 'member_children';
	public $primary_key = 'member_children_id';
	public $belongs_to = array( 'members' => array( 'primary_key' => 'member_id' ));


	public function __construct(){
		parent::__construct();
	}

	public function my_join_children(){

		$query = $this->db->select('*');
		$query = $this->db->from($this->_table);
		$query = $this->db->join('members','member_children.parent_id = members.member_id');
		$query = $this->db->get();

		return $query->result();
	}
}