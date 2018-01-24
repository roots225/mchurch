<?php
defined("BASEPATH") or exit('No direct script allowed');

class Children extends MY_Controller{

	public $children;

	public function __construct(){
		parent::__construct();
		$this->load->model(array('children_model', 'members_model'));
		$this->load->library(array('generate_form', 'form_validation', 'upload'));
		
	}

	public function index(){

		$this->data['children'] = $this->children_model->my_join_children();
		

		$this->render('pages/children', 'public');
	}

	public function add(){

		$members = $this->members_model->get_all();
		$mb = array("" => "select on members as child parent");

		foreach($members as $member){
			$mb[$member->member_id] = $member->member_first_name." ".$member->member_last_name;
		}

		
		$inputs = array(
			'Child First Name' => array(
				'class' => 'form-control',
				'name' => 'member_child_first_name',
				'value' => set_value('member_child_first_name', '', true),
				'placeholder' => 'Child First Name',
				'id' => 'member_child_first_name'
			),
			'Child Last Name' => array(
				'class' => 'form-control',
				'name' => 'member_child_last_name',
				'value' => set_value('member_child_last_name', '', true),
				'placeholder' => 'Child Last Name',
				'id' => 'member_child_last_name'
			),
			'Child Birthday' => array(
				'class' => 'form-control',
				'name' => 'birthday',
				'value' => set_value('birthday', '', true),
				'placeholder' => 'Child Birthday',
				'id' => 'birthday'
			)
		);

		$uploads = array(
			'Child Photo' => array(
				'class' => 'form-control',
				'name' => 'photo',
				'value' => '',
				'id' => 'photo'
			)
		);

		$selects = array(
			'Child Parent' => array(0 => $mb)
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

		$form_text = $this->generate_form->generate_selects('parent_id', $selects, 'id="parent_id" class="form-control"');
		$form_text .= $this->generate_form->generate_text_input($inputs);
		$form_text .= $this->generate_form->generate_upload($uploads);
		$form_text .= $this->generate_form->generate_button($button);
		$link = base_url('children/add');
		$this->data['form'] = $this->generate_form->create_form_multi($link, $form_text);

		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');

		if($this->form_validation->run('children') != false){

			if($this->upload->do_upload('photo')){

				$updata = $this->upload->data();
				$img_path = base_url('assets/uploads/').$updata['file_name'];

				$insert = array(
					'member_child_photo' => $img_path,
					'parent_id' => $this->input->post('parent_id'),
					'member_child_first_name' => $this->input->post('member_child_first_name'),
					'member_child_last_name' => $this->input->post('member_child_last_name'),
					'member_child_birthday' => $this->input->post('birthday')
				);

				if($this->children_model->insert($insert)){
					$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Enfant ajouté avec succès </div>');
					redirect('children', 'location', 301);
				}else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Echec d\'enregistrement de l\'enfant ! <br> Veuillez réessayer plutard !</div>');
				}
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Impossible de charger la photo '.$this->upload->display_errors().'</div>');
			}
			
		}
		

		$this->render('pages/add');
	}

	public function edit($id){

		$child = $this->children_model->get($id);

		$members = $this->members_model->get_all();
		$mb = array("" => "select on members as child parent");

		foreach($members as $member){
			$mb[$member->member_id] = $member->member_first_name." ".$member->member_last_name;
		}

		
		$inputs = array(
			'Child First Name' => array(
				'class' => 'form-control',
				'name' => 'member_child_first_name',
				'value' => $child->member_child_first_name,
				'placeholder' => 'Child First Name',
				'id' => 'member_child_first_name'
			),
			'Child Last Name' => array(
				'class' => 'form-control',
				'name' => 'member_child_last_name',
				'value' => $child->member_child_last_name,
				'placeholder' => 'Child Last Name',
				'id' => 'member_child_last_name'
			),
			'Child Birthday' => array(
				'class' => 'form-control',
				'name' => 'birthday',
				'value' => $child->member_child_birthday,
				'placeholder' => 'Child Birthday',
				'id' => 'birthday'
			)
		);

		$uploads = array(
			'Child Photo' => array(
				'class' => 'form-control',
				'name' => 'photo',
				'value' => '',
				'id' => 'photo'
			)
		);

		$selects = array(
			'Child Parent' => array(
				$child->parent_id => $mb
			)
		);

		//$this->dd($selects);

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

		$form_text = $this->generate_form->generate_selects('parent_id', $selects,'id="parent_id" class="form-control"');
		$form_text .= $this->generate_form->generate_text_input($inputs);
		$form_text .= $this->generate_form->generate_upload($uploads);
		$form_text .= $this->generate_form->generate_button($button);
		$link = base_url('children/edit/'.$id);
		$this->data['form'] = $this->generate_form->create_form_multi($link, $form_text);

		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');

		if($this->form_validation->run('children') != false){

			if($this->upload->do_upload('photo')){

				$updata = $this->upload->data();
				$img_path = base_url('assets/uploads/').$updata['file_name'];

				$insert = array(
					'member_child_photo' => $img_path,
					'parent_id' => $this->input->post('parent_id'),
					'member_child_first_name' => $this->input->post('member_child_first_name'),
					'member_child_last_name' => $this->input->post('member_child_last_name'),
					'member_child_birthday' => $this->input->post('birthday')
				);

				if($this->children_model->update($id, $insert)){
					$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Enfant modifié avec succès </div>');
					redirect('children', 'location', 301);
				}else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Echec de modification des info enfant <br> Veuillez réessayer plutard !</div>');
				}
			}else{

				$insert = array(
					'parent_id' => $this->input->post('parent_id'),
					'member_child_first_name' => $this->input->post('member_child_first_name'),
					'member_child_last_name' => $this->input->post('member_child_last_name'),
					'member_child_birthday' => $this->input->post('birthday')
				);

				if($this->children_model->update($id,$insert)){
					$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Enfant modifié avec succès '.$this->upload->display_errors().'</div>');
					redirect('children', 'location', 301);
				}else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Echec de modification des info enfant <br> Veuillez réessayer plutard !</div>');
				}
			}
			
		}
		

		$this->render('pages/edit');
	}

	public function delete($id){

		$child = $this->children_model->get($id);
		if(unlink(str_replace(base_url(), './', $child->member_child_photo))){
			if($this->children_model->delete($id)){
				$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Enfant supprimé avec succès </div>');
			}
		}else{
			if($this->children_model->delete($id)){
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Enfant supprimer avec succès cependant <br>Impossible de supprimer les images enfants </div>');
			}
		}

		redirect('children', 'location', 301);
	}
}