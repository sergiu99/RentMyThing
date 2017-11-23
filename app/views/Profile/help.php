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
	<textarea rows="4" type="text" class="form-control" required="true" name="description" id="description"></textarea>
	</div>
	<div class="form-group  row col-sm-3">
<label for="urgency">Urgency</label> <br>
<select class="form-control" name="urgency" required="true" id="urgency">
  <option value="High">High</option>
  <option value="Medium">Medium</option>
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