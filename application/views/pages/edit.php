<h1>Edition : </h1>
<hr>
<div class="error_zone">
	<?= is_null($this->session->userdata('message')) ? ' ' : $this->session->userdata('message')?>
	<?= is_null(validation_errors()) ? '' : validation_errors() ?>
</div>

<div id="content">
	
	<div class="col-md-8">
		<?= $form ?>
	</div>
	<div class="col-md-4"></div>
</div>
