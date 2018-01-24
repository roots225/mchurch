<h1>Membres </h1>
<div >

	<a href="<?= base_url('members/add') ?>" class=" btn btn-red">Add</a>
	<a href="<?= base_url('members') ?>" class=" btn btn-red">Show</a>
	<hr>
</div>
<div id="content" class="table-responsive">
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>FirstName</th>
				<th>LastName</th>
				<th>Phones</th>
				<th>Email</th>
				<th>Photo</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($members as $item): ?>
			<tr>
				<td><input type="checkbox" name="id[]" value="<?= $item->member_id; ?>"></td>
				<td><?= $item->member_first_name; ?></td>
				<td><?= $item->member_last_name; ?></td>
				<td><a href="tel:<?= $item->member_phones; ?>"><?= $item->member_phones; ?></a></td>
				<td><a href="mailto:<?= $item->member_email_adress; ?>"><?= $item->member_email_adress; ?></a></td>
				<td><img src="<?= $item->member_photo; ?>" class="img-responsive" style="height:30px;"></td>
				<td>
					<a href="<?= base_url('members/edit/'.$item->member_id) ?>" id="edit#<?= $item->member_id; ?>" class="text-primary">
						<span class="glyphicon glyphicon-edit"></span>
					</a>
				</td>

				<td>
					<a href="<?= base_url('members/delete/'.$item->member_id) ?>" id="edit#<?= $item->member_id; ?>" class="text-danger">
						<span class="glyphicon glyphicon-trash"></span>
					</a>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>