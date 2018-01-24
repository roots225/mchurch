<?php
defined("BASEPATH") or exit("No direct script access allowed");

class Members extends MY_Controller{

	protected $members;

	public function __construct(){
		parent::__construct();
		$this->load->model('members_model');
		$this->load->library(array('generate_form','form_validation', 'upload'));

		if($this->members === null){
			$this->members = $this->members_model->get_all();
		}
	}

	public function index(){

		$this->data['title'] = 'Members views pages';
		$this->data['members'] = $this->members;

		$this->render('pages/members', 'public');
	}

	public function add(){


		$inputs = array(
			'First Name' => array(
				'name' => 'first_name',
				'id' => 'first_name',
				'value' => set_value('first_name', '', true),
				'class' => 'form-control',
				'placeholder' => 'First Name',
				
			),
			'Last Name' => array(
				'class' => 'form-control',
				'name' => 'last_name',
				'value' => set_value('last_name', '', true),
				'placeholder' => 'Last Name',
				'id' => 'last_name'
			),
			'Phones' => array(
				'class' => 'form-control',
				'name' => 'phones',
				'value' => set_value('phones', '', true),
				'placeholder' => 'Phones numbers',
				'id' => 'phones'
			),
			'Email address' => array(
				'class' => 'form-control',
				'name' => 'email',
				'value' => set_value('email', '', true),
				'placeholder' => 'examples@email.com',
				'id' => 'email',
				'type' => 'email'
			),
			'Birthday' => array(
				'class' => 'form-control',
				'name' => 'birthday',
				'value' => set_value('birthday', '', true),
				'placeholder' => 'your birthday',
				'id' => 'birthday'
			)
		);

		$textarea = array(
			'Adresse Residentielle' => array(
				'class' => 'form-control',
				'name' => 'address',
				'placeholder' => 'Addresse residentiel',
				'id' => 'address',
				'value' => set_value('address', '', true)
			),
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

		$uploads = array(
			'Photo' => array(
				'name' => 'photo',
				'id' => 'photo',
				'value' => '',
				'class' => 'form-control',
				'multiple' => 'multiple'
			)
		);

		$form_text = $this->generate_form->generate_text_input($inputs);
		$form_text .= $this->generate_form->generate_upload($uploads);
		$form_text .= $this->generate_form->generate_textarea($textarea);
		$form_text .= $this->generate_form->generate_button($button);
		$link = base_url('members/add');
		$this->data['form'] = $this->generate_form->create_form_multi($link, $form_text);

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');

		if($this->form_validation->run('members') != false){
			if($this->upload->do_upload('photo')){

			$updata = $this->upload->data();
			$img_path = base_url('assets/uploads/').$updata['file_name'];

			$insert = array(
				'member_first_name' => $this->input->post('first_name'),
				'member_last_name' => $this->input->post('last_name'),
				'member_phones' => $this->input->post('phones'),
				'member_email_adress' => $this->input->post('email'),
				'other_member_details' => $this->input->post('others_details'),
				'member_address' => $this->input->post('address'),
				'member_birthday' => $this->input->post('birthday'),
				'member_photo' => $img_path
			);
			
			
			if($this->members_model->insert($insert)){
				$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> membre ajouté avec succès </div>');
				redirect('members', 'location', 301);
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Echec d\'enregistrement du membre ! <br> Veuillez réessayer plutard !</div>');
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Echec de chargement de la photo du membre ! <br> '.$this->upload->display_errors().'!</div>');
		}
		}

		$this->render('pages/add');
	}

	public function edit($id){

		$item = $this->members_model->get($id);

		$inputs = array(
			'First Name' => array(
				'name' => 'first_name',
				'id' => 'first_name',
				'value' => $item->member_first_name,
				'class' => 'form-control',
				'placeholder' => 'First Name',
				
			),
			'Last Name' => array(
				'class' => 'form-control',
				'name' => 'last_name',
				'value' => $item->member_last_name,
				'placeholder' => 'Last Name',
				'id' => 'last_name'
			),
			'Phones' => array(
				'class' => 'form-control',
				'name' => 'phones',
				'value' => $item->member_phones,
				'placeholder' => 'Phones numbers',
				'id' => 'phones'
			),
			'Email address' => array(
				'class' => 'form-control',
				'name' => 'email',
				'value' => $item->member_email_adress,
				'placeholder' => 'examples@email.com',
				'id' => 'email',
				'type' => 'email'
			),
			'Birthday' => array(
				'class' => 'form-control',
				'name' => 'birthday',
				'value' => $item->member_birthday,
				'placeholder' => 'your birthday',
				'id' => 'birthday'
			)
		);

		$textarea = array(
			'Adresse Residentielle' => array(
				'class' => 'form-control',
				'name' => 'address',
				'placeholder' => 'Addresse residentiel',
				'id' => 'address',
				'value' => $item->member_address
			),
			'Others' => array(
				'class' => 'form-control',
				'name' => 'others_details',
				'placeholder' => 'Others details of member',
				'id' => 'others_details',
				'value' => $item->other_member_details
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

		$uploads = array(
			'Photo' => array(
				'name' => 'photo',
				'id' => 'photo',
				'value' => '',
				'class' => 'form-control',
				'multiple' => 'multiple'
			)
		);

		$form_text = $this->generate_form->generate_text_input($inputs);
		$form_text .= $this->generate_form->generate_upload($uploads);
		$form_text .= $this->generate_form->generate_textarea($textarea);
		$form_text .= $this->generate_form->generate_button($button);
		$link = base_url('members/edit/'.$id);
		$this->data['form'] = $this->generate_form->create_form_multi($link, $form_text);

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');

		if($this->form_validation->run('members') != false){
			if($this->upload->do_upload('photo')){

				$updata = $this->upload->data();
				$img_path = base_url('assets/uploads/').$updata['file_name'];

				$insert = array(
					'member_first_name' => $this->input->post('first_name'),
					'member_last_name' => $this->input->post('last_name'),
					'member_phones' => $this->input->post('phones'),
					'member_email_adress' => $this->input->post('email'),
					'other_member_details' => $this->input->post('others_details'),
					'member_address' => $this->input->post('address'),
					'member_birthday' => $this->input->post('birthday'),
					'member_photo' => $img_path
				);
				
				
				if($this->members_model->update($id,$insert)){
					$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> membre modifié avec succès </div>');
					redirect('members', 'location', 301);
				}else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Echec de modification des infos du membre ! <br> Veuillez réessayer plutard !</div>');
				}
			}else{

				$insert = array(
					'member_first_name' => $this->input->post('first_name'),
					'member_last_name' => $this->input->post('last_name'),
					'member_phones' => $this->input->post('phones'),
					'member_email_adress' => $this->input->post('email'),
					'other_member_details' => $this->input->post('others_details'),
					'member_address' => $this->input->post('address'),
					'member_birthday' => $this->input->post('birthday')
				);

				if($this->members_model->update($id,$insert)){
					$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> membre modifié avec succès </div>');
					redirect('members', 'location', 301);
				}else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Echec de modification des infos du membre ! <br> Veuillez réessayer plutard !</div>');
				}
				
			}
		}

		$this->render('pages/edit');
	}

	public function delete($id){

		$member = $this->members_model->get($id);

		if(unlink(str_replace(base_url(), './', $member->member_photo))){
			if($this->members_model->delete($id)){
				$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> membre supprimé avec succès </div>');
				
			}
		}else{
			if($this->members_model->delete($id)){
				$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> membre supprimé avec succès <br> cependant la photo du membre na pas pu etre supprimer du serveur </div>');
			}
		}

		redirect('members', 'location', 301);
	}
}