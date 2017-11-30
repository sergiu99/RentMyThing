<!DOCTYPE html>
<html>
<head>
	<title>This is an example view</title>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://pingendo.com/assets/bootstrap/bootstrap-4.0.0-beta.1.css" type="text/css">
	<script src="/js/bootstrap.js"></script>
</head>
<body>
<div class="container">
<h1>Register</h1>

<form method="post" action="/Login/signup" class="form-horizontal">
	<div class="form-group">
	<label for="first_name">First Name</label>
	<input type="text" class="form-control" name="first_name" id="first_name" />
	</div>
	<div class="form-group">
	<label for="last_name">Last Name</label>
	<input type="text" class="form-control" name="last_name" id="last_name" />
	</div>
	<div class="form-group">
	<label for="email">Email</label>
	<input type="text" class="form-control" name="email" id="email" required/>
	</div>
	<div class="form-group">
	<label for="display_name">Display Name</label>
	<input type="text" class="form-control" name="display_name" id="display_name" onchange='checkUsername()'/>
	<div id="name_feedback" class="form-control-feedback"></div>
	</div>
	<div class="form-group">
	<label for="password">Password</label>
	<input type="password" class="form-control" name="password" id="password" required/>
	</div>
	<div class="form-group">
	<label for="phone_number">Phone Number</label>
	<input type="number" class="form-control" name="phone_number" id="phone_number" />
	</div>
	<div class="form-group">
	<label for="street_address">Street Address</label>
	<input type="text" class="form-control" name="street_address" id="street_address" />
	</div>
	<div class="form-group">
	<label for="postal_code_address">Postal Code</label>
	<input type="text" class="form-control" name="postal_code_address" id="postal_code_address" required/>
	</div>
	<div class="form-group">
	<label for="city_address">City</label>
	<input type="text" class="form-control" name="city_address" id="city_address" required/>
	</div>
	<div class="form-group">
	<label for="province_address">Province</label>
	<input type="text" class="form-control" name="province_address" id="province_address" required/>
	</div>
	<div class="form-group">
	<input type="submit" class="btn btn-default" name="action" value="Register" id="submit_button"/>
	</form>
	<a href="/Login" class="btn btn-default" >Back to Login</a>
	</div>
<div>
</body>

<script>
	function checkUsername(){
		$.ajax({
			type: "GET",
			url: "/Login/checkUsername?value=" + encodeURIComponent(document.getElementById("display_name").value)
		}).done(function (data){
			console.log(data);
			if(data == 0){
				document.getElementById("display_name").class = "form-control form-control-success";
				document.getElementById("name_feedback").innerHTML = "";
				document.getElementById("submit_button").disabled = false;
			}else{
				document.getElementById("display_name").class = "form-control form-control-warning";
				document.getElementById("name_feedback").innerHTML = "Sorry, that username's taken. Try another?";
				document.getElementById("submit_button").disabled = true;
			}
		});
	}
</script>

</html>