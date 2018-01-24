<?php
defined("BASEPATH") or exit("No direct script allowed");

class Members_model extends MY_Model{

	public $_table = 'members';
	public $primary_key = 'member_id';

	public function __construct(){
		parent::__construct();
	}
}