<?php
defined('BASEPATH') or exit("No direct script access allowed");

class Home extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library('generate_form');
	}

	public function index(){

		$this->render('pages/home', 'public');
	}
}