<?php
defined('BASEPATH') or exit("No direct script access allowed");

class Activities extends MY_Controller{

	protected $activities;

	public function __construct(){
		parent::__construct();
		$this->load->model('activities_model');
		$this->load->library(array('generate_form', 'form_validation'));
		if($this->activities === null){
			$this->activities = $this->activities_model->get_all();
		}
	}

	public function index(){

		$this->data['activities'] = $this->activities;

		$this->render('pages/activities', 'public');
	}

	public function add(){

		$nb = $this->activities_model->get_next_id();

		if(isset($_POST)){
			
			$insert = array(
				'activity_code' => "ACT-".$nb,
				'activity_description' => $this->input->post('description'),
				'activity_start_date' => $this->input->post('start_date'),
				'activity_end_date' => $this->input->post('end_date'),
				'others_activity_details' => $this->input->post('others_details')
			);
		}

		
		$inputs = array(
			'Start date' => array(
				'class' => 'form-control',
				'name' => 'start_date',
				'value' => set_value('start_date', '', true),
				'placeholder' => 'Activity start date',
				'id' => 'start_date'
			),
			'End date' => array(
				'class' => 'form-control',
				'name' => 'end_date',
				'value' => set_value('end_date', '', true),
				'placeholder' => 'Activity end date',
				'id' => 'end_date'
			)
		);

		$textarea = array(
			'Description' => array(
				'class' => 'form-control',
				'name' => 'description',
				'placeholder' => 'Description of activity',
				'id' => 'description',
				'value' => set_value('description', '', true)
			),
			'Others' => array(
				'class' => 'form-control',
				'name' => 'others_details',
				'placeholder' => 'Others details of activity',
				'id' => 'others_details',
				'value' => set_value('others_details', '', true)
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
		$link = base_url('activities/add');
		$this->data['form'] = $this->generate_form->create_form($link, $form_text);

		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');

		if($this->form_validation->run('activities') != false){
			if($this->activities_model->insert($insert)){
				$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Activité ajouté avec succès </div>');
				redirect('activities', 'location', 301);
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Echec d\'enregistrement de l\'activité ! <br> Veuillez réessayer plutard !</div>');
			}
		}
		

		$this->render('pages/add');
	}

	public function edit($id){

		$item = $this->activities_model->get($id);

		if(isset($_POST)){
			
			$update = array(
				'activity_description' => $this->input->post('description'),
				'activity_start_date' => $this->input->post('start_date'),
				'activity_end_date' => $this->input->post('end_date'),
				'others_activity_details' => $this->input->post('others_details')
			);
		}

		
		$inputs = array(
			'Code' => array(
				'name' => 'code',
				'id' => 'code',
				'value' => $item->activity_code,
				'class' => 'form-control',
				'placeholder' => 'Code',
				'disabled' => 'disabled'
			),
			'Start date' => array(
				'class' => 'form-control',
				'name' => 'start_date',
				'value' => $item->activity_start_date,
				'placeholder' => 'Activity start date',
				'id' => 'start_date'
			),
			'End date' => array(
				'class' => 'form-control',
				'name' => 'end_date',
				'value' => $item->activity_end_date,
				'placeholder' => 'Activity end date',
				'id' => 'end_date'
			)
		);

		$textarea = array(
			'Description' => array(
				'class' => 'form-control',
				'name' => 'description',
				'placeholder' => 'Description of activity',
				'id' => 'description',
				'value' => $item->activity_description
			),
			'Others' => array(
				'class' => 'form-control',
				'name' => 'others_details',
				'placeholder' => 'Others details of activity',
				'id' => 'others_details',
				'value' => $item->others_activity_details
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
		$link = base_url('activities/edit/'.$id);
		$this->data['form'] = $this->generate_form->create_form($link, $form_text);

		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');

		if($this->form_validation->run('activities') != false){
			if($this->activities_model->update($id, $update)){
				$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Activité modifié avec succès </div>');
				redirect('activities', 'location', 301);
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Echec de modification l\'activité ! <br> Veuillez réessayer plutard !</div>');
			}
		}
		

		$this->render('pages/edit');
	}

	public function delete($id){
		if($this->activities_model->delete($id)){
			$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Activité supprimé avec succès </div>');
			redirect('activities', 'location', 301);
		}
	}
}