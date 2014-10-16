<h1 class="pagetitle">$Title</h1>
$Content
<% if Organisations %>
	<table class="table organisationstable">
		<thead>
			<tr>
				<th>Name</th>
				<th>Industry</th>
				<th>Website</th>
				<th>Phone</th>
			</tr>
		</thead>
		<tbody>
			<% loop Organisations %>
				<tr>
					<td>
						<a href="$ProfileLink">$Name</a>
					</td>
					<td>$Industry</td>
					<td>$Website</td>
					<td>$Phone</td>
				</tr>
			<% end_loop %>
		</tbody>
	</table>
<% end_if %>