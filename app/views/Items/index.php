<html>
<head>
	<title>This is an example view</title>
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.css" />
	<script src="/js/bootstrap.js"></script>
</head>
<body>
<div class="container">
<h1>Management</h1>
<form method="get" action="/Clients/search" class="form-inline">
<div class="form-group">
<label for="q">Search by firstName</label>
<input type="text" class="form-control" name="q" id="q" />
</div>
<div class="form-group">
<input type="submit" class="btn btn-default" name="action" value='search' />
</div>
</form><br>
<br>


<table class="table table-striped">
	<tr>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>Phone</th>
		<th>Country</th>
		<th>Action</th>
	</tr>
	<?php
	foreach($data['clients'] as $client){
		echo "<tr><td>$client->firstName</td>";
		echo "<td>$client->lastName</td>";
		echo "<td>$client->email</td>";
		echo "<td>$client->phone</td>";
		echo "<td>$client->country</td>";
		echo "<td><a href='/Clients/delete/$client->ID'>DELETE!!!!!</a></td></tr>";
	}
	?>
</table>

<form method="post" action="/Clients/newClient" class="form-horizontal">
	<div class="form-group">
	<label for="firstName">First Name</label>
	<input type="text" class="form-control" name="firstName" id="firstName" />
	</div>
	<div class="form-group">
	<label for="lastName">Last Name</label>
	<input type="text" class="form-control" name="lastName" id="lastName" />
	</div>
	<div class="form-group">
	<label for="email">Email</label>
	<input type="text" class="form-control" name="email" id="email" />
	</div>
	<div class="form-group">
	<label for="phone">Phone</label>
	<input type="text" class="form-control" name="phone" id="phone" />
	</div>
	<div class="form-group">
	<label for="country">Country</label>
	<input type="text" class="form-control" name="country" id="country" />
	</div>
	<div class="form-group">
	<input type="submit" class="btn btn-default" name="action" value="Save this record" />
	</div>
</form>


<div>
</body>
</html>