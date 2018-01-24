<h1>Activités </h1>
<hr>
<div class="error_zone">
	<?= is_null($this->session->userdata('message')) ? ' ' : $this->session->userdata('message')?>
	<?= is_null(validation_errors()) ? '' : validation_errors() ?>
</div>
<hr>
<div >
	<a href="<?= base_url('activities/add') ?>" class=" btn btn-red">Add</a>
	<a href="#" class=" btn btn-red">Show</a>
	<hr>
</div>
<div id="content" class="table-responsive">
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Code</th>
				<th>Description</th>
				<th>Begin date</th>
				<th>End date</th>
				<th>Others details</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($activities as $item): ?>
			<tr>
				<td><input type="checkbox" name="id[]" value="<?= $item->activity_id; ?>"></td>
				<td><?= $item->activity_code; ?></td>
				<td><?= $item->activity_description; ?></td>
				<td><?= $item->activity_start_date; ?></td>
				<td><?= $item->activity_end_date; ?></td>
				<td><?= $item->others_activity_details; ?></td>
				<td>
					<a href="<?= base_url('activities/edit/').$item->activity_id ?>" id="edit#<?= $item->activity_id; ?>" class="text-primary">
						<span class="glyphicon glyphicon-edit"></span>
					</a>
				</td>

				<td>
					<a href="<?= base_url('activities/delete/').$item->activity_id ?>" id="delete#<?= $item->activity_id; ?>" class="text-danger">
						<span class="glyphicon glyphicon-trash"></span>
					</a>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>