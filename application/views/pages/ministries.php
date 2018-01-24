<h1>Ministères </h1>
<hr>
<div class="error_zone">
	<?= is_null($this->session->userdata('message')) ? ' ' : $this->session->userdata('message')?>
	<?= is_null(validation_errors()) ? '' : validation_errors() ?>
</div>
<hr>
<div >
	<a href="<?= base_url('ministries/add') ?>" class=" btn btn-red">Add</a>
	<a href="<?= base_url('ministries') ?>" class=" btn btn-red">Show</a>
	<hr>
</div>
<div id="content" class="table-responsive">
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Code</th>
				<th>Name</th>
				<th>Others Details</th>
				
			</tr>
		</thead>
		<tbody>
			<?php foreach($ministries as $item): ?>
			<tr>
				<td><input type="checkbox" name="id[]" value="<?= $item->ministry_id; ?>"></td>
				<td><?= $item->ministry_code; ?></td>
				<td><?= $item->ministry_name; ?></td>
				<td><?= $item->other_ministry_details; ?></td>
				<td>
					<a href="<?= base_url('ministries/edit/'.$item->ministry_id) ?>" id="edit#<?= $item->ministry_id; ?>" class="text-primary">
						<span class="glyphicon glyphicon-edit"></span>
					</a>
				</td>

				<td>
					<a href="<?= base_url('ministries/delete/'.$item->ministry_id) ?>" id="edit#<?= $item->ministry_id; ?>" class="text-danger">
						<span class="glyphicon glyphicon-trash"></span>
					</a>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>