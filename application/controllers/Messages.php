<?php
defined("BASEPATH") or exit("No direct script allowed");

class Messages extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model(array('messages_model','members_model'));
		$this->load->library(array('generate_form', 'form_validation','upload'));
		
	}

	public function index(){

		$this->data['messages'] = $this->messages_model->my_join_messages();

		$this->render('pages/messages');
	}

	public function add(){

	
		$members = $this->members_model->get_all();
		$mb = array('' => 'choose one member');

		foreach($members as $member){

			$mb[$member->member_id] = $member->member_first_name.' '.$member->member_last_name;
		}

		$inputs = array(
			'Message Theme' => array(
				'class' => 'form-control',
				'name' => 'message_theme',
				'value' => set_value('message_theme', '', true),
				'placeholder' => 'Message Theme',
				'id' => 'message_theme'
			),
			'Verses' => array(
				'class' => 'form-control',
				'name' => 'message_versets',
				'value' => set_value('message_versets', '', true),
				'placeholder' => 'message verses',
				'id' => 'message_versets'
			),
			'Message date' => array(
				'class' => 'form-control',
				'name' => 'message_date',
				'value' => set_value('message_date', '', true),
				'placeholder' => 'message date',
				'id' => 'message_date'
			)
		);


		$selects = array(
			'Child parent' => array(0 => $mb)
		);
		

		$textarea = array(
			'Message resume' => array(
				'class' => 'form-control',
				'name' => 'message_resume',
				'value' => set_value('message_resume', '', true),
				'placeholder' => 'message resume',
				'id' => 'message_resume'
			),
			'Others detail' => array(
				'class' => 'form-control',
				'name' => 'message_others_details',
				'placeholder' => 'Others details of message',
				'id' => 'message_others_details',
				'value' => set_value('message_others_details', '', true)
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
			'Message audio file' => array(
				'class' => 'form-control',
				'name' => 'audio',
				'value' => '',
				'id' => 'audio'
			),
			'Message video file' => array(
				'class' => 'form-control',
				'name' => 'video',
				'value' => '',
				'id' => 'video',
				'disabled' => 'disabled'
			)
		);

		$form_text = $this->generate_form->generate_selects('message_predicateur', $selects, 'id="message_predicateur" class="form-control"');
		$form_text .= $this->generate_form->generate_text_input($inputs);
		$form_text .= $this->generate_form->generate_upload($uploads);
		$form_text .= $this->generate_form->generate_textarea($textarea);
		$form_text .= $this->generate_form->generate_button($button);
		$link = base_url('messages/add');
		$this->data['form'] = $this->generate_form->create_form_multi($link, $form_text);

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');

		if($this->form_validation->run('messages') != false){
			if($this->upload->do_upload('audio')){

				$updata = $this->upload->data();
				$audio_path = base_url('assets/uploads/').$updata['file_name'];

				$insert = array(
					'message_predicateur' => $this->input->post('message_predicateur'),
					'message_theme' => $this->input->post('message_theme'),
					'message_versets' => $this->input->post('message_versets'),
					'message_date' => $this->input->post('message_date'),
					'message_resume' => $this->input->post('message_resume'),
					'message_others_details' => $this->input->post('message_others_details'),
					'message_audio_file' => $audio_path
				);
				
				
				if($this->messages_model->insert($insert)){
					$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> message ajouté avec succès </div>');
					redirect('messages', 'location', 301);
				}else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Echec d\'enregistrement du message ! <br> Veuillez réessayer plutard !</div>');
				}
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Echec de chargement du fichier audio du message ! <br> '.$this->upload->display_errors().'!</div>');
			}
		}

		$this->render('pages/add');
	}

	public function edit($id){

		$message = $this->messages_model->get($id);
		$members = $this->members_model->get_all();
		$mb = array('' => 'choose one member');

		foreach($members as $member){

			$mb[$member->member_id] = $member->member_first_name.' '.$member->member_last_name;
		}

		$inputs = array(
			'Message Theme' => array(
				'class' => 'form-control',
				'name' => 'message_theme',
				'value' => set_value('message_theme', '', true),
				'placeholder' => 'Message Theme',
				'id' => 'message_theme'
			),
			'Verses' => array(
				'class' => 'form-control',
				'name' => 'message_versets',
				'value' => set_value('message_versets', '', true),
				'placeholder' => 'message verses',
				'id' => 'message_versets'
			),
			'Message date' => array(
				'class' => 'form-control',
				'name' => 'message_date',
				'value' => set_value('message_date', '', true),
				'placeholder' => 'message date',
				'id' => 'message_date'
			)
		);


		$selects = array(
			'Child parent' => array(
				$message->message_predicateur => $mb
			)
		);
		

		$textarea = array(
			'Message resume' => array(
				'class' => 'form-control',
				'name' => 'message_resume',
				'value' => set_value('message_resume', '', true),
				'placeholder' => 'message resume',
				'id' => 'message_resume'
			),
			'Others detail' => array(
				'class' => 'form-control',
				'name' => 'message_others_details',
				'placeholder' => 'Others details of message',
				'id' => 'message_others_details',
				'value' => set_value('message_others_details', '', true)
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
			'Message audio file' => array(
				'class' => 'form-control',
				'name' => 'audio',
				'value' => '',
				'id' => 'audio'
			),
			'Message video file' => array(
				'class' => 'form-control',
				'name' => 'video',
				'value' => '',
				'id' => 'video',
				'disabled' => 'disabled'
			)
		);

		$form_text = $this->generate_form->generate_selects('message_predicateur', $selects, 'id="message_predicateur" class="form-control"');
		$form_text .= $this->generate_form->generate_text_input($inputs);
		$form_text .= $this->generate_form->generate_upload($uploads);
		$form_text .= $this->generate_form->generate_textarea($textarea);
		$form_text .= $this->generate_form->generate_button($button);
		$link = base_url('messages/add');
		$this->data['form'] = $this->generate_form->create_form_multi($link, $form_text);

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');

		if($this->form_validation->run('messages') != false){
			if($this->upload->do_upload('audio')){

				$updata = $this->upload->data();
				$audio_path = base_url('assets/uploads/').$updata['file_name'];

				$insert = array(
					'message_predicateur' => $this->input->post('message_predicateur'),
					'message_theme' => $this->input->post('message_theme'),
					'message_versets' => $this->input->post('message_versets'),
					'message_date' => $this->input->post('message_date'),
					'message_resume' => $this->input->post('message_resume'),
					'message_others_details' => $this->input->post('message_others_details'),
					'message_audio_file' => $audio_path
				);
				
				
				if($this->messages_model->insert($insert)){
					$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> message ajouté avec succès </div>');
					redirect('messages', 'location', 301);
				}else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Echec d\'enregistrement du message ! <br> Veuillez réessayer plutard !</div>');
				}
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Echec de chargement du fichier audio du message ! <br> '.$this->upload->display_errors().'!</div>');
			}
		}

		$this->render('pages/add');
	}

	public function delete($id){

		$message = $this->messages_model->get($id);

		if(unlink(str_replace(base_url(), './', $message->message_audio_file))){
			if($this->messages_model->delete($id)){
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Message supprimer avec succès </div>');
			}
		}else{
			if($this->messages_model->delete($id)){
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Message supprimer avec succès <br> sans suppression des fichiers </div>');
			}
		}
	}
}