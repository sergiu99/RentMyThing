
<html>
<head>
	<title>This is an example view</title>
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.css" />
	<script src="/js/bootstrap.js"></script>
</head>
<body>
<div class="container">
<h1>Signup</h1>

<form method="post" action="/Login/signup" class="form-horizontal">
	<div class="form-group">
	<label for="firstName">First Name</label>
	<input type="text" class="form-control" name="first_name" id="first_name" />
	</div>
	<div class="form-group">
	<label for="lastName">Last Name</label>
	<input type="text" class="form-control" name="last_name" id="last_name" />
	</div>
	<div class="form-group">
	<label for="username">Email</label>
	<input type="text" class="form-control" name="email" id="email" />
	</div>
	<div class="form-group">
	<label for="username">Display Name</label>
	<input type="text" class="form-control" name="display_name" id="display_name" />
	</div>
	<div class="form-group">
	<label for="password">Password</label>
	<input type="password" class="form-control" name="password" id="password" />
	</div>
	<div class="form-group">
	<label for="username">Phone Number</label>
	<input type="number" class="form-control" name="phone_number" id="phone_number" />
	</div>
	<div class="form-group">
	<label for="username">Street Number</label>
	<input type="text" class="form-control" name="number_address" id="number_address" />
	</div>
	<div class="form-group">
	<label for="username">Street Name</label>
	<input type="text" class="form-control" name="street_address" id="street_address" />
	</div>
	<div class="form-group">
	<label for="username">Postal Code</label>
	<input type="text" class="form-control" name="postal_code_address" id="postal_code_address" />
	</div>
	<div class="form-group">
	<label for="username">City</label>
	<input type="text" class="form-control" name="city_address" id="city_address" />
	</div>
	<div class="form-group">
	<label for="username">Province</label>
	<input type="text" class="form-control" name="province_address" id="province_address" />
	</div>
	<div class="form-group">
	<input type="submit" class="btn btn-default" name="action" value="Register" />
	</div>

</form>


<div>
</body>
</html>