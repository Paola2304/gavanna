<?php 
	$id_rol=$this->session->userdata('rol');
	$log=$this->session->userdata('logueado');
	echo $id_rol;
	echo $log;
	if ($id_rol==1 && $log==true) {
	}else{
		redirect('home_controller','refresh');
	}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title><?= $title ?></title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('props/bootstrap/css/bootstrap.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('props/bootstrap/fonts/css/all.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('props/alertifyjs/css/alertify.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('props/alertifyjs/css/themes/default.min.css'); ?>">
	<script src="<?= base_url('props/bootstrap/js/jquery.js'); ?>"></script>
	<script src="<?= base_url('props/bootstrap/js/bootstrap.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('props/alertifyjs/alertify.min.js'); ?>"></script>
</head>
<body>