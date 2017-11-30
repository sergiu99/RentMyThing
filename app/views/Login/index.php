<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.css" />
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

	<script src="/js/bootstrap.js"></script>
	<title>Login</title>
</head>
<body>
<div class="container">
	<h1>Log in</h1>
	<form action="" method="post" class="form-horizontal">
	<div class="form-group">
		<label for="username">Email:</label>
		<input type="text" class="form-control" name="email" id="email" />
	</div>
	<div class="form-group">
		<label for="password">Password:</label>
		<input type="password" class="form-control" name="password" id="password" />
	</div>
	<div class="form-group">
		<input class="btn btn-default" type="submit" name="action" value="Login" />
	
	</form>
	<a href="/Login/signup" class="btn btn-default" >Register</a>
	</div>
</div>
</body></html>