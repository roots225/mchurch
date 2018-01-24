<h1>{{ title }} </h1>
	
<div id="content">
	<ul class="list-unstyled">
		<li v-for="item in activities">
			<span>{{ activities.activity_id }}</span>
		</li>
	</ul>

	<div class="table-responsive">
		<table class="table table-hover">
			<tr>
				<td></td>
			</tr>
		</table>
	</div>
</div>