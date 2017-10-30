<html>
<head>
	<title>This is an example view</title>
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.css" />
	<script src="/js/bootstrap.js"></script>
	<script src="/js/jquery-3.2.1.min.js"></script>
	<script>$.ajax({
		url: '/put/tryPut/',
		type: 'PUT',
		data: "name=John&location=Boston",
		success: function(data) {
			alert('Load was performed.');
		}
	});
	</script>
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
</form>
<div>
</body>
</html>
