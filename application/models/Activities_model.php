<?php
defined('BASEPATH') or exit("No script direct access allowed");

class Activities_model extends MY_Model{

	public $_table = "activities";
	public $primary_key = "activity_id";

	public function __construct(){
		parent::__construct();
	}
}