<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title><?= $title; ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?= $meta_description; ?>">
	<meta name="description" content="<?= $meta_keywords; ?>">

	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/styles.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/iziModal.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap-datepicker3.min.css') ?>">

	<script type="text/javascript" src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
</head>
<body>
	<script type="text/javascript">
		$(function(){
	        $('#mytopmenu .nav li').removeClass('active');
	        $('#menuvertical .nav li').removeClass('active');
	        var $uri = window.document.location;
	        var current_uri = $uri.href;
	        $("a[href='"+current_uri+"']").parent().addClass('active');

	        
	    })
	</script>
	<header>
		<nav id="menuhaut" class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mytopmenu">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?= base_url() ?>">Church Management</a>
				</div>
				<div class="collapse navbar-collapse" id="mytopmenu">
					<ul class="nav navbar-nav">
						<li class="active"><a href="<?= base_url() ?>">Home</a></li>
						<li><a href="<?= base_url('activities') ?>">Activités</a></li>
						<li><a href="<?= base_url('members') ?>">Membres</a></li>
						<li><a href="<?= base_url('ministries') ?>">Ministères</a></li>
						<li><a href="<?= base_url('children') ?>">Children</a></li>
						<li><a href="<?= base_url('messages') ?>">Messages</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
						<li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
<div id="app">
	<div class="contaner-fluid plr0">
		<div class="col-md-3 p0 hidden-xs" style="position:fixed;">
			<div id="menuvertical">
				<div class="avatar">
					<img src="<?= base_url('assets/images/html5css3.png') ?>" class="img-responsive">
					<div class="username">
						{{ username }}
					</div>
				</div>
				<ul class="nav nav-pills nav-stacked">
					<li><a href="<?= base_url('activities') ?>">Activités</a></li>
					<li class=""><a href="<?= base_url('members') ?>">Membres</a></li>
					<li class=""><a href="<?= base_url('ministries') ?>">Ministères</a></li>
					<li class=""><a href="<?= base_url('children') ?>">Children</a></li>
					<li class=""><a href="<?= base_url('messages') ?>">Messages</a></li>
				</ul>
			</div>
		</div>
		<div class="col-md-9 col-md-offset-3">
			