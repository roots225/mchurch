<h1>Children </h1>
<hr>
<div class="error_zone">
	<?= is_null($this->session->userdata('message')) ? ' ' : $this->session->userdata('message')?>
	<?= is_null(validation_errors()) ? '' : validation_errors() ?>
</div>
<hr>
<div >
	<a href="<?= base_url('children/add') ?>" class=" btn btn-red">Add</a>
	<a href="<?= base_url('children') ?>" class=" btn btn-red">Show</a>
	<hr>
</div>
<div id="content" class="table-responsive">
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Photo</th>
				<th>Parent</th>
				<th>FirstName</th>
				<th>LastName</th>
				<th>Birthday</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($children as $item): ?>
			<tr>
				<td><input type="checkbox" name="id[]" value="<?= $item->member_children_id; ?>"></td>
				<td><img src="<?= $item->member_child_photo; ?>" class="img-responsive" style="height:50px;"></td>
				<td><?= $item->member_first_name.' '.$item->member_last_name; ?></td>
				<td><?= $item->member_child_first_name; ?></td>
				<td><?= $item->member_child_last_name; ?></td>
				<td><?= $item->member_child_birthday; ?></td>
				<td>
					<a href="<?= base_url('children/edit/'.$item->member_children_id) ?>" id="edit#<?= $item->member_children_id; ?>" class="text-primary">
						<span class="glyphicon glyphicon-edit"></span>
					</a>
				</td>

				<td>
					<a href="<?= base_url('children/delete/'.$item->member_children_id) ?>" id="edit#<?= $item->member_children_id; ?>" class="text-danger">
						<span class="glyphicon glyphicon-trash"></span>
					</a>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>