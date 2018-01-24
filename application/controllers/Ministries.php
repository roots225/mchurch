<?php
defined("BASEPATH") or exit("No direct script access allowed");

class Ministries extends MY_Controller{

	public $ministries;

	public function __construct(){
		parent::__construct();
		$this->load->model('ministries_model');
		$this->load->library(array('generate_form', 'form_validation'));
		if($this->ministries === null){
			$this->ministries = $this->ministries_model->get_all();
		}
	}

	public function index(){

		$this->data['ministries'] = $this->ministries;

		$this->render('pages/ministries', 'public');
	}

	public function add(){

		if(isset($_POST)){
			$insert = array(
				'ministry_code' => $this->input->post('ministry_code'),
				'ministry_name' => $this->input->post('ministry_name'),
				'other_ministry_details' => $this->input->post('other_ministry_details')
			);
		}
		
		$inputs = array(
			'Ministry code' => array(
				'name' => 'ministry_code',
				'id' => 'ministry_code',
				'value' => set_value('ministry_code', '', true),
				'class' => 'form-control',
				'placeholder' => 'Code Minitère',
				
			),
			'Ministry name' => array(
				'class' => 'form-control',
				'name' => 'ministry_name',
				'value' => set_value('ministry_name', '', true),
				'placeholder' => 'Ministry name',
				'id' => 'ministry_name'
			)
		);

		$textarea = array(
			'Others details' => array(
				'class' => 'form-control',
				'name' => 'other_ministry_details',
				'placeholder' => 'Others ministry details',
				'id' => 'other_ministry_details',
				'value' => set_value('other_ministry_details', '', true)
			)
		);

		$button = array(
		    'button' => array(
			    'name'          => 'button',
			    'id'            => 'add',
			    'value'         => '',
			    'type'          => 'submit',
			    'class'          => 'btn btn-red',
			    'content'       => '<span>ADD</span><span>&nbsp;&nbsp;</span><span class="glyphicon glyphicon-plus"></span>'
			)
		);

		$form_text = $this->generate_form->generate_text_input($inputs);
		$form_text .= $this->generate_form->generate_textarea($textarea);
		$form_text .= $this->generate_form->generate_button($button);
		$link = base_url('ministries/add');
		$this->data['form'] = $this->generate_form->create_form($link, $form_text);

		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');

		if($this->form_validation->run('ministries') != false){
			if($this->ministries_model->insert($insert)){
				$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Ministère ajouté avec succès </div>');
				redirect('ministries', 'location', 301);
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Echec d\'enregistrement du ministère ! <br> Veuillez réessayer plutard !</div>');
			}
		}
		

		$this->render('pages/add');
	}

	public function edit($id){

		$ministry = $this->ministries_model->get($id);

		if(isset($_POST)){
			
			$insert = array(
				'ministry_code' => $this->input->post('ministry_code'),
				'ministry_name' => $this->input->post('ministry_name'),
				'other_ministry_details' => $this->input->post('other_ministry_details')
			);
		}

		
		$inputs = array(
			'Ministry code' => array(
				'name' => 'ministry_code',
				'id' => 'ministry_code',
				'value' => $ministry->ministry_code,
				'class' => 'form-control',
				'placeholder' => 'Code Minitère',
				
			),
			'Ministry name' => array(
				'class' => 'form-control',
				'name' => 'ministry_name',
				'value' => $ministry->ministry_name,
				'placeholder' => 'Ministry name',
				'id' => 'ministry_name'
			)
		);

		$textarea = array(
			'Others details' => array(
				'class' => 'form-control',
				'name' => 'other_ministry_details',
				'placeholder' => 'Others ministry details',
				'id' => 'other_ministry_details',
				'value' => $ministry->other_ministry_details
			)
		);

		$button = array(
		    'button' => array(
			    'name'          => 'button',
			    'id'            => 'add',
			    'value'         => '',
			    'type'          => 'submit',
			    'class'          => 'btn btn-red',
			    'content'       => '<span>EDIT</span><span>&nbsp;&nbsp;</span><span class="glyphicon glyphicon-edit"></span>'
			)
		);

		$form_text = $this->generate_form->generate_text_input($inputs);
		$form_text .= $this->generate_form->generate_textarea($textarea);
		$form_text .= $this->generate_form->generate_button($button);
		$link = base_url('ministries/edit/'.$id);
		$this->data['form'] = $this->generate_form->create_form($link, $form_text);

		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');

		if($this->form_validation->run('ministries') != false){
			if($this->ministries_model->update($id, $insert)){
				$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Ministère modifié avec succès </div>');
				redirect('ministries', 'location', 301);
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Echec de modification du ministère ! <br> Veuillez réessayer plutard !</div>');
			}
		}
		

		$this->render('pages/edit');
	}

	public function delete($id){

		if($this->ministries_model->delete($id)){
			$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>ministère supprimé avec succès </div>');
		}

		redirect('minitries', 'location', 301);
	}
}