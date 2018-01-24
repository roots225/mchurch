<?php

$config = array(
	'activities' => array(
		array(
			'field' => 'start_date',
	        'label' => 'Start date',
	        'rules' => 'trim'
		),
		array(
			'field' => 'end_date',
	        'label' => 'Start date',
	        'rules' => 'trim'
		),
		array(
			'field' => 'description',
	        'label' => 'Description',
	        'rules' => 'trim'
		),
		array(
			'field' => 'others',
	        'label' => 'Other details',
	        'rules' => 'trim'
		)
	),
	'members' => array(
		array(
			'field' => 'first_name',
	        'label' => 'First Name',
	        'rules' => 'trim|required'
		),
		array(
			'field' => 'last_name',
	        'label' => 'Last Name',
	        'rules' => 'trim|required'
		),
		array(
			'field' => 'phones',
	        'label' => 'Phones',
	        'rules' => 'trim|required'
		),
		array(
			'field' => 'email',
	        'label' => 'Email address',
	        'rules' => 'trim|valid_email'
		),
		array(
			'field' => 'birthday',
	        'label' => 'Birthday',
	        'rules' => 'trim|max_length[10]'
		),
		array(
			'field' => 'photo',
	        'label' => 'Photo',
	        'rules' => 'trim'
		),
		array(
			'field' => 'description',
	        'label' => 'description',
	        'rules' => 'trim'
		),
		array(
			'field' => 'others_details',
	        'label' => 'Others',
	        'rules' => 'trim'
		)
	),
	'ministries' => array(
		array(
			'field' => 'ministry_code',
	        'label' => 'Ministry code',
	        'rules' => 'trim|required|is_unique[minitries.ministry_code]'
		),
		array(
			'field' => 'ministry_name',
	        'label' => 'Ministry name',
	        'rules' => 'trim|required'
		),
		array(
			'field' => 'others_ministry_details',
	        'label' => 'Others detail of ministry',
	        'rules' => 'trim'
		)
	),
	'children' => array(
		array(
			'field' => 'parent_id',
	        'label' => 'Child parent',
	        'rules' => 'trim|required|numeric'
		),
		array(
			'field' => 'member_child_first_name',
	        'label' => 'Child First Name',
	        'rules' => 'trim|required'
		),
		array(
			'field' => 'member_child_last_name',
	        'label' => 'Child Last Name',
	        'rules' => 'trim|required'
		),
		array(
			'field' => 'birthday',
	        'label' => 'Child Birthday',
	        'rules' => 'trim'
		),
		array(
			'field' => 'photo',
	        'label' => 'Child Photo',
	        'rules' => 'trim'
		)
	),
	'messages' => array(
		array(
			'field' => 'message_predicateur',
	        'label' => 'Predicator Name',
	        'rules' => 'trim|required'
		),
		array(
			'field' => 'message_theme',
	        'label' => 'Thème',
	        'rules' => 'trim'
		),
		array(
			'field' => 'message_versets',
	        'label' => 'Bible verses',
	        'rules' => 'trim|required'
		),
		array(
			'field' => 'message_date',
	        'label' => 'Message date',
	        'rules' => 'trim'
		),
		array(
			'field' => 'message_resume',
	        'label' => 'Resume',
	        'rules' => 'trim'
		),
		array(
			'field' => 'message_others_details',
	        'label' => 'Others detail',
	        'rules' => 'trim'
		),
		array(
			'field' => 'audio',
	        'label' => 'Audio file',
	        'rules' => 'trim'
		),
		array(
			'field' => 'video',
	        'label' => 'Video file',
	        'rules' => 'trim'
		)
	)
);