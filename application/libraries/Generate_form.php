<?php
defined("BASEPATH") or exit("No direct script access allowed");

class Generate_form {

	public function __construct(){
		
	}

	public function generate_text_input($data){
		$inputs = '';

		foreach($data as $key => $field){
			
				$inputs .= '<div class="form-group">';
				$inputs .= form_label($key, $field['id']);
				$inputs .= form_input($field);
				$inputs .= '</div>';
			
		}

		return $inputs;
	}

	public function generate_hide_input($data){
		$inputs = '';

		foreach($data as $field){
			$inputs .= form_hidden($field);
		}

		return $inputs;
	}

	public function generate_upload($data){
		$inputs = '';

		foreach($data as $key => $field){
			$inputs .= '<div class="form-group">';
			$inputs .= form_label($key, $field['id']);
			$inputs .= form_upload($field);
			$inputs .= '</div>';
		}

		return $inputs;
	}

	public function generate_selects($name, $data, $attrs){
		$inputs = '';

		foreach($data as $key => $field){
			$inputs .= '<div class="form-group">';
			$inputs .= form_label($key, $key);
			foreach ($field as $id => $options) {
				$inputs .= form_dropdown($name, $options, $id, $attrs);
			}
			
			$inputs .= '</div>';
		}

		return $inputs;
	}

	public function generate_textarea($data){
		$inputs = '';

		foreach($data as $key => $field){
			$inputs .= '<div class="form-group">';
			$inputs .= form_label($key, $field['id']);
			$inputs .= form_textarea($field);
			$inputs .= '</div>';
		}

		return $inputs;
	}

	public function generate_button($data){
		$inputs = '';

		foreach($data as $key => $field){
			$inputs .= '<div class="form-group">';
			$inputs .= form_button($field);
			$inputs .= '</div>';
		}

		return $inputs;
	}

	public function create_form($link, $fields){

		$complete = '';

		$complete .= form_open($link);
		$complete .= $fields;

		return $complete;
	}

	public function create_form_multi($link, $fields){

		$complete = '';

		$complete .= form_open_multipart($link, array('enctype' => 'multipart/form-data'));
		$complete .= $fields;

		return $complete;
	}
}