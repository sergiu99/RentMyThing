<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php'); ?>

<div class="container">
<br>
<br>
<h2>Contact Us</h2>
<form method="post" action="/Profile/contactUs" class="form-horizontal" enctype="multipart/form-data">
	<div class="form-group">
	<label for="name">Title</label>
	<input type="text" class="form-control" required="true" name="title" id="title" />
	</div>
	<div class="form-group">
	<label for="description">Description</label>
	<input type="text" class="form-control" required="true" name="description" id="description" />
	</div>
	<div class="form-group">
<label for="urgency">Urgency</label> <br>
<select class="custom-select" name="urgency" id="urgency">
  <option value="High">High</option>
  <option value="Mediocre">Medium</option>
  <option value="Low">Low</option>
</select>
</div>
	<div class="form-group">
	<input type="submit" class="btn btn-default" name="action" value="Create ticket" />
	</div>
</form>

</div>
</body>
</html>