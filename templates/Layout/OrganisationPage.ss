<% include BoostrapWrap piece=open %>

<h1 class="pagetitle">$Title</h1>
<% if Logo %>
	$Logo.SetHeight(200)
<% end_if %>
$Content

<% if Members %>
	<table class="table organisation_memberslist">
		<thead>
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
			</tr>
		</thead>
		<tbody>
			<% loop Members %>
				<tr>
					<td>$FirstName</td>
					<td>$Surame</td>
					<td>$Email</td>
				</tr>
			<% end_loop %>
		</tbody>
	</table>
<% end_if %>

$Form

<% include BoostrapWrap piece=close %>