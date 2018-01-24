<h1>Messages </h1>
<hr>
<div class="error_zone">
	<?= is_null($this->session->userdata('message')) ? ' ' : $this->session->userdata('message')?>
	<?= is_null(validation_errors()) ? '' : validation_errors() ?>
</div>
<hr>
<div >
	<a href="<?= base_url('messages/add') ?>" class=" btn btn-red">Add</a>
	<a href="<?= base_url('messages') ?>" class=" btn btn-red">Show</a>
	<hr>
</div>
<div id="content" class="table-responsive">
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Predicateur</th>
				<th>Theme</th>
				<th>Versets</th>
				<th>Date</th>
				<th>Resume</th>
				<th>Others details</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($messages as $item): ?>
			<tr>
				<td><input type="checkbox" name="id[]" value="<?= $item->message_id; ?>"></td>
				<td><?= $item->member_first_name.' '.$item->member_last_name; ?></td>
				<td><?= $item->message_theme; ?></td>
				<td><?= $item->message_versets; ?></td>
				<td><?= $item->message_date; ?></td>
				<td><?= $item->message_resume; ?></td>
				<td><?= $item->message_others_details; ?></td>
				<td>
					<a href="#" id="edit#<?= $item->message_id; ?>" class="text-primary">
						<span class="glyphicon glyphicon-edit"></span>
					</a>
				</td>

				<td>
					<a href="#" id="edit#<?= $item->message_id; ?>" class="text-danger">
						<span class="glyphicon glyphicon-trash"></span>
					</a>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>