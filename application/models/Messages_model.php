<?php
defined("BASEPATH") or exit("No direct script allowed");

class Messages_model extends MY_Model{

	public $_table = 'messages';
	public $primary_key = 'message_id';

	public function __construct(){
		parent::__construct();
	}

	public function my_join_messages(){

		$query = $this->db->select("*");
		$query = $this->db->from($this->_table);
		$query = $this->db->join("members", "members.member_id = messages.message_predicateur");
		$query = $this->db->get();

		return $query->result();
	}
}