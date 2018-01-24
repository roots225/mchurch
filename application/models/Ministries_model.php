<?php
defined("BASEPATH") or exit("No direct script allowed");

class Ministries_model extends MY_Model{

	public $_table = 'ministries';
	public $primary_key = 'ministry_id';

	public function __construct(){
		parent::__construct();
	}
}